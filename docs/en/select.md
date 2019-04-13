# ->Select()

With the method `->select()` you can make queries to the database.

To obtain all the records of a table, you need to use a `string` with the name of the table.

```php
$example->select('table_name')->execute();
```

To obtain specific columns, an associative `array` will be used where **"Key"** will be placed as the name of the table and as **"Value"** the columns that are required.

```php
$example->select(['table_name'=>'column1, column2, column3'])->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select([
  'users' => 'id, name, lastname, age, email'
  ])->execute();
```