# ->Select()

Con el método `->select()` podrás hacer consultas a la base de datos.

Para obtener todos los registros de una tabla se colocara un `string` con el nombre de la tabla.

```php
$ejemplo->select('nombre_de_la_tabla')->execute();
```

Para obtener columnas especificas se utilizara un `array` asociativo dond se colocara como **"Clave"** el nombre de la tabla y como **"Valor"** las columnas que se requieran

```php
$ejemplo->select(['nombre_de_la_tabla'=>'columna1, columna2, columna3'])->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select([
  'usuarios' => 'id, nombre, apellido, edad, correo'
  ])->execute();
```