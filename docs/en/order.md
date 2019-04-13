# ->order()

With the method `->order()` the records that will be displayed as a result of the SQL query will be sorted.

Will receive as a parameter you will receive a `string` with the order that is required.

```php
$example->select('table')->order('columna ASC')->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select('users')->order('lastname')->execute();
```