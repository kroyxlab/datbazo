# ->insert()

With the method `->insert()` You can insert data to a table.

As the first parameter will receive a `string` with the name of the table in which you want to insert data.

As a second parameter you will receive a associative `array` where it would be placed in the **"Key"** with the name of the column and in the **"Value"** the data that will insert.

```php
$example->insert('table_name', [
  'column1'='new_value',
  'column2'='new_value',
  'column3'='new_value',
  'columna4'='new_value'
  ])->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->insert('users', [
  'name' => 'Antonio',
  'lastname' => 'Hayama',
  'nro_dni' => 123456789,
  'age' => 48,
  'email' => 'example@email.com'
])->execute();
```
