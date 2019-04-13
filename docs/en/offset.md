# ->offset()

With the method `->offset()` the number of records that will be displayed as a result of the SQL query will be ignored.

Will receive as a parameter you will receive a `number` with the number of records that you want to omit.

```php
$example->select('table')->limit(10)->offset(7)->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select([
  'users' => 'id, name, lastname, age, email'
  ])->where([
    'age' => ['<=', 30]
  ])->limit(8)->offset(2)->execute();
```