# ->limit()

Con el método `->Limit()` se limitara el numero de registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `number` con la cantidad de registros que se quiera obtener.

```php
$ejemplo->select('tabla')->limit(5)->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select([
  'usuarios' => 'id, nombre, apellido, edad, correo'
  ])->where([
    'edad' => ['<=', 30]
  ])->limit(8)->execute();
```