<?php namespace kroyxlab\klpdo;

  use \PDO;

  $db_config = parse_ini_file('KLPdo.ini', true);
  foreach($db_config['database'] as $key => $value){
    define(strtoupper($key), $value);
  }

  /**
   * KLPdo Es un microframework con el cual podrás crear SQL querys e interactuar con la base de datos.
   * 
   * @author Kristian Soto <kroyxlab@gmail.com>
   * @license MIT
   * @version 1.0.0
   */
  class KLPdo{
    
    protected $_PDO;

    protected $_fetch;

    protected $_query;

    protected $_execute = [];

    /**
     * Muestra el mensaje de error de la consulta
     *
     * @var array
     */
    public $error;

    /**
     * Inicializa la conexion PDO
     */
    public function __construct(){
      $this->_pdoConect();
    }
    
    /**
     * Crea la conexion a la base de datos por PDO
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
     * Con el método ->select() podrás hacer consultas a la base de datos.
     * 
     * SELECT {Columna} FROM {Tabla}...
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
     * Con el método `->join()` podrás unir la información de dos tablas.
     * 
     * SELECT {columnas...} FROM {tabla1} INNER JOIN {tabla2}...
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
     * Con el método `->on()` se utiliza para identificar por cuales columnas sera unida la consulta
     * 
     * ON tabla1.columna = tabla2.columna
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
     * Con el método `->insert()` podrás insertar datos a una tabla.
     * 
     * INSERT INTO {tabla}(columna1, columna2, columna2) VALUES (valor1, valor2, valor3);
     *
     * @param string $tableName Coloca el nombre de la tabla
     * @param array $values '[nombre_de_la_columna'=>'valor',. . .]
     */
    public function insert(string $tableName, array $values = []){
      $insert = "INSERT INTO {$tableName}(".$this->_columns($values).") VALUES (".$this->_values($values).")";
      $this->_execute += $values;
      $this->_query .= $insert;
      
      return $this;
    }
    
    /**
     * Con el método `->update()` se podra modificar/acualizar los valores de la tabla
     * 
     * UPDATE tabla SET columna1 = valor1, columna2 = valor2. . .
     *
     * @param string $tableName Coloca el nombre de la tabla
     * @param array $values '[nombre_de_la_columna'=>'valor',. . .] 
     */
    public function update(string $tableName, array $values = ['column_name'=>'new_value']){
      $update = "UPDATE {$tableName} SET ".$this->_set($values)." ";
      $this->_execute += $values;
      $this->_query .= $update;
      return $this;
    }

    /**
     * Con el método `->delete()` se podra eliminar filas de una tabla 
     *
     * Start the SQL Query, DELETE FROM. . .
     *
     * @param string $table Coloca el nombre de la tabla
     */
    public function delete(string $table){
      $delete = "DELETE FROM {$table} ";
      $this->_query .= $delete;
      return $this;
    }

    /**
     * Con el método `->where()` se pueden filtrar los resultados de la consulta SQL
     * 
     * WHERE columa = valor
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
      $this->_fetch = $execute->fetchAll(PDO::FETCH_ASSOC);
      $this->error = $execute->errorInfo();
      $this->_query = NULL;
      $this->_execute = NULL;
    }    

  /**
   * Render the result of the SQL query
   *
   * @param $render
   */
    public function render($render){
      $fetch = $this->_fetch;
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