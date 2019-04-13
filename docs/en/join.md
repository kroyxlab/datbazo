# ->join()

With the method `->join()` ou can join the information of two tables.

The method will receive a associative `array` como primer parámetro, colocando en la **"Key"** el name de la table and in the **"Value"** the columns that are required.

```php
$example->join([
  'table_name1'=>'column1, column2, column3',
  'table_name2'=>'column1, column2, column3',
])...
```

By default the JOIN statement will be of the INNER type, but it can be modified by adding a second parameter (Optional) to the query, for example in the following case it will result in a LEFT JOIN.

```php
$example->join([
  'table_name1'=>'column1, column2, column3',
  'table_name2'=>'column1, column2, column3',
], 'LEFT')...

```

To identify by which columns the query will be joined, the `->on()` method will be used, which will receive an associative `array` where it should be placed on the **"Key"** the name of the table and in the **"Value"** the name of the column.

```php
$example->join([
  'table_name1'=>'column1, column2, column3',
  'table_name2'=>'column1, column2, column3',
])->on([
  'table_name1'=>'column1',
  'table_name2'=>'Column_one',
])->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->join([
  'users' => 'name, lastname, nro_dni, age',
  'carnets' => 'code, charge, floor, user_id'
])->on([
  'users' => 'nro_dni',
  'carnets' => 'user_id'
])->execute();
```