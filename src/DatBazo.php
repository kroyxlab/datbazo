<?php namespace kroyxlab\datbazo;

  use \PDO;

  $db_config = parse_ini_file('DBconfig.ini', true);
  foreach($db_config['databazo'] as $key => $value){
    define(strtoupper($key), $value);
  }

  /**
   * DatBazo(Datuma Bazo, Database in Esperanto) is a SQL-query constructor using PDO.
   *
   * @author Kristian Soto <kroyxlab@gmail.com>
   * @license MIT
   * @version 1.2.0
   */
  class DatBazo{
    
    protected $_PDO;
    protected $_fetch;
    protected $_query;
    protected $_execute = [];
    protected $_output;

    /**
     * Show error messages
     *
     * @var array
     */
    public $error;

    /**
     * Initialize PDO conexion
     */
    public function __construct(){
      $this->_pdoConect();
    }
    
    /**
     * Connect to the database using PDO class
     */
    protected function _pdoConect(){
      try{
        $this->_PDO = new PDO(
          DB_DRIVER.":host=".DB_HOST."; dbname=".DB_NAME."; port=".DB_PORT,
          DB_USER,
          DB_PASSWORD,
          [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
          ]
        );
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }

    /**
     * With the method ->select() you can retrive the values from a table.
     * 
     * SELECT {Column} FROM {table}...
     *
     * @param mixed $select 'TableName' || ['TableName'=>'Column']
     */
    public function select($select){
      if(is_array($select)){
        $query = 'SELECT '.implode('', array_values($select)).' FROM '.implode('', array_keys($select)).' ';
      }else if(is_string($select)){
        $query = "SELECT * FROM {$select} ";
      }
      $this->_query = $query;
      return $this;
    }

    /**
     * With the method `->join()` you can join the information of two Tables.
     * 
     * SELECT {columnas...} FROM {table1} INNER JOIN {table2}...
     *
     * @param array $join ['TableName1'=>'Columns','TableName2'=>'Columns']
     * @param string $joinType INNER || LEFT || RIGHT
     */
    public function join(array $join = [], string $joinType = 'INNER'){
      $query = "SELECT {$this->_joinColumns($join, 0)}, {$this->_joinColumns($join, 1)} FROM ".array_keys($join)[0]." {$joinType} JOIN ".array_keys($join)[1]." ";
      $this->_query = $query;
      return $this;
    }

    /**
     * With the method `->on()` yo can to identify by which columns the query will be joineda
     * 
     * ON table1.column = table2.column
     *
     * @param array $columns ['TableName1'=>'Column','TableName2'=>'Column']
     */
    public function on($columns = []){
      $onStr = $this->_processArray(function($column, $table){
        return "{$table}.{$column} =";
      }, $columns);
      $onStr = rtrim($onStr, '= ');
      $query = "ON {$onStr} ";
      $this->_query .= $query;
      return $this;
    }

    /**
     * Use the SQL Query, GROUP BY. . .
     *
     * @param mixed $columns Coloca las columnas por la cual se agrupara la consulta
     */
    public function group(string $columns){
      if(is_string($columns)){
        $query = "GROUP BY {$columns} ";
      }else if(is_array($columns)){
        $query = "GROUP BY {$this->_joinColumns($columns, 0)}, {$this->_joinColumns($columns, 1)} ";
      }
      $this->_query .= $query;
      return $this;
    }
    
    /**
     * With the method `->insert()` you can insert data into a table.
     * 
     * INSERT INTO {table}(column1, column2, column3) VALUES (value1, value2, value3);
     *
     * @param string $tableName 
     * @param array $values '[column_name'=>'value',. . .]
     */
    public function insert(string $tableName, array $values = []){
      $insert = "INSERT INTO {$tableName}(".$this->_columns($values).") VALUES (".$this->_values($values).")";
      $this->_execute += $values;
      $this->_query .= $insert;
      
      return $this;
    }
    
    /**
     * With the method `->update()` yo can modify/update the values from a table
     * 
     * UPDATE table SET column1 = value1, column2 = value2. . .
     *
     * @param string $tableName Coloca el nombre de la table
     * @param array $values '[column_name'=>'value',. . .] 
     */
    public function update(string $tableName, array $values = ['column_name'=>'new_value']){
      $update = "UPDATE {$tableName} SET ".$this->_set($values)." ";
      $this->_execute += $values;
      $this->_query .= $update;
      return $this;
    }

    /**
     * With the method `->delete()` yo can delete rows from a table 
     *
     * Start the SQL Query, DELETE FROM. . .
     *
     * @param string $table Coloca el nombre de la table
     */
    public function delete(string $table){
      $delete = "DELETE FROM {$table} ";
      $this->_query .= $delete;
      return $this;
    }

    /**
     * With the method `->where()` yo can filter the results of the SQL-query
     * 
     * WHERE columa = value
     *
     * @param array $where
     */
    public function where(array $where){
      $wherePrepare = "WHERE {$this->_prepareWhereKeys($where, false)} ";
      $whereExecute = $this->_executeWhereValues($where);
      $this->_query .= $wherePrepare;
      $this->_execute += $whereExecute;
      return $this;
    }

    /**
     * Use the SQL Query, . . .ORDER BY. . .
     *
     * @param mixed $order
     */
    public function order(mixed $order){
      if(is_array($order)){
        $prepareOrder = array_reduce($order, function($a, $b){return "{$a} AND {$b}";}, '');
      }else{
        $prepareOrder = ' '.$order;
      }
      $order = "ORDER BY{$prepareOrder} ";
      $this->_query .= $order;
      return $this;
    }

    /**
     * Use the SQL Query, . . .LIMIT. . .
     *
     * @param number $limit
     */
    public function limit(number $limit){
      $limit = "LIMIT {$limit} ";
      $this->_query .= $limit;
      return $this;
    }

    /**
     * Use the SQL Query, . . .OFFSET. . .
     *
     * @param number $offset
     */
    public function offset(number $offset){
      $offset = "OFFSET {$offset} ";
      $this->_query .= $offset;
      return $this;
    }

    /**
     * Execute the SQL Query
     *
     */
    public function execute(){
      $execute = $this->_PDO->prepare($this->_query);
      $execute->execute($this->_execute);
      $this->_fetch = $execute;
      $this->error = $execute->errorInfo();
      $this->_query = NULL;
      $this->_execute = NULL;
    }    

    /**
     * Config data type of the results from the SQL-query
     *
     * @param string $type assoc || json || column || keyPair || unique || group || obj
     * @return void type fetch
     */
    public function fetch(string $type = ''){
      if($type !== ''){
        if(strtoupper($type) == 'ASSOC'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_ASSOC);}
        else if(strtoupper($type) == 'JSON'){$fetch = json_encode($this->_fetch->fetchAll(PDO::FETCH_OBJ));}
        else if(strtoupper($type) == 'COLUMN'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_COLUMN);}
        else if(strtoupper($type) == 'KEYPAIR'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_KEY_PAIR);}
        else if(strtoupper($type) == 'UNIQUE'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_UNIQUE);}
        else if(strtoupper($type) == 'GROUP'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_GROUP);}
        else if(strtoupper($type) == 'OBJ'){$fetch = $this->_fetch->fetchAll(PDO::FETCH_OBJ);}
        else{$fetch = $this->_fetch->fetchAll($type);}
      }
      
      $this->_output = $fetch;
      return $fetch;
    }

  /**
   * Render the result of the SQL query
   *
   * @param $render
   */
    public function render($render){
      $fetch = $this->_output;
      $output = array_map($render, $fetch, array_keys($fetch));
      $output = array_reduce($output, function($a, $b){return "{$a} {$b}";}, '');
      $output = ltrim($output, ' ');
      echo $output;
    }

    protected function _set(array $values){
      return $this->_processArray(function($value, $column){
        return "{$column} = :{$column}";
      }, $values);
    }

    protected function _values(array $values){
      return $this->_processArray(function($value, $column){
        return ":{$column}";
      }, $values);
    }

    protected function _columns(array $columns){
      return $this->_processArray(function($value, $column){
        return "{$column}";
      }, $columns);
    }

    protected function _processArray($func, $array){
      $map = array_map($func, $array, array_keys($array));
      $map = implode(', ', $map);
      $map = rtrim($map, ', :0');
      return $map;
    }

    protected function _joinColumns($join, $num){
      $colStr = array_values($join)[$num];
      $colArray = explode(',', $colStr);
      $colsStr = '';
      foreach($colArray as $table){
        $colArray = ltrim($table, ' ');
        $colsStr .= array_keys($join)[$num].'.'.$colArray.', ';
      }   
      $colsStr = rtrim($colsStr, ', ');
      return $colsStr;
    }

    protected function _prepareWhereKeys($keys, $coma = true){
      $keysArray = array_map(function($key, $value){
        if(is_array($value)){ return "{$key} {$value[0]} :where_{$key}";}
        else if(is_numeric($key)){ return $value;}
        else{return "{$key} = :where_{$key}";}
      }, array_keys($keys), $keys);
      $keyString = array_reduce(array_values($keysArray), function($a, $b){return "{$a}, {$b}";}, '');
      $keyString = ltrim($keyString, ', '); 
      if($coma){ return $keyString;}
      else{return $keyString = str_replace(',','',$keyString);}
    }

    protected function _executeWhereValues($keys){
      $values = [];
      foreach($keys as $key => $value){
        if(is_array($value)){ $values[":where_{$key}"] = $value[1];}
        else if(is_string($key)){ $values[":where_{$key}"] = $value;}
      }
      return $values;
    }
  }
