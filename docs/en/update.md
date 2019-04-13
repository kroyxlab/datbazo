# ->update()

With the method `->update()` se podra modificar los valores de la table

As the first parameter will receive a `string` with the name of the table en la que quieres insertar datos.

As a second parameter you will receive a associative `array` colocando en la **"Key"** the name of the column and in the **"Value"** the new value with which you want to replace.

Remember to place the `->where()` method to specify the row that will be modified.

```php
$example->insert('table_name', [
  'column1'='new_value',
  'column2'='new_value',
  'column3'='new_value',
  'columna4'='new_value'
  ])->where(['column2'=>'value'])->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->insert('users',[
  'name' => 'Juan',
  'age' => '34',
  ])where([
    'name' => 'antonio'
  ])->execute();
```