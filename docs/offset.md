# ->offset()

Con el método `->offset()` se omitiran el numero de registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `number` con la cantidad de registros que se quiera omitir.

```php
$ejemplo->select('tabla')->limit(10)->offset(7)->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select([
  'usuarios' => 'id, nombre, apellido, edad, correo'
  ])->where([
    'edad' => ['<=', 30]
  ])->limit(8)->offset(2)->execute();
```