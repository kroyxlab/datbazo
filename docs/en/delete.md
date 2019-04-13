# ->delete()

With the method `->delete()` se podra eliminar rows de una table

As the first parameter will receive a `string` with the name of the table where the row you want delete is located.

Then the method `->where()` must be added to specify the row that will be eliminated;

```php
$example->delete('table_name')
        ->where(['column2'=>'value'])
        ->execute();
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->delete('table')
         ->where(['name' => 'juan'])
         ->execute();
```