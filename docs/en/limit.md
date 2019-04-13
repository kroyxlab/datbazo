# ->limit()

With the method `->Limit()` the number of records that will be displayed as a result of the SQL query will be limited.

Will receive as a parameter you will receive a `number` with the number of records to be obtained.

```php
$example->select('table')->limit(5)->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select([
  'users' => 'id, name, lastname, age, email'
  ])->where([
    'age' => ['<=', 30]
  ])->limit(8)->execute();
```