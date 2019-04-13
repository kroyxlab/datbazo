# ->where()

With the method `->where()` you can filter the records of the SQL query.

To verify if the value of the column is **equal to** the required value, an associative `array` will be used, placing in the **"Key"** the name of the column and in the **"Value"** the value with which you want to compare.

```php
$example->select(//...)
        ->where(['columna'=>'value']) // ... WHERE columna = value
        ->execute();
```

if you want to compare the column with the values = | <= | ! = | LIKE | ILIKE | the following syntax will be used:

```php
$example->select(//...)
        ->where([
          'columna'=>['>=','value'] // WHERE columna >= value
          ])
        ->execute();
```

To place more than one WHERE filter using AND | OR | NOT, they will be placed in the following way:

```php
$example->select(['table'=>'column1, columna4'])
        ->where([
          'column1'=>['>=', 'value'],
          'AND',
          'column2'=>['<=', 'value']
          ])
        ->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select([
  'users' => 'id, name, lastname, age, email'
  ])->where([
    'name' => ['LIKE', 'anton%'],
    'AND',
    'age' => ['>=', 30]
  ])->execute();
```