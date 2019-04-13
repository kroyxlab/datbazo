# ->execute()

With the method `->execute()` will be placed as the last method of the query to execute the SQL query.

```php
$example->select('table')->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select(['users' => 'id, name, lastname, age, email'])
         ->where(['age' => ['<=', 30]])
         ->order('age DESC')
         ->limit(8)
         ->offset(2)
         ->execute();
```