# ->order()

Con el método `->order()` se ordenaran los registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `string` con el orden que se requiera.

```php
$ejemplo->select('tabla')->order('columna ASC')->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select('usuarios')->order('apellidos')->execute();
```