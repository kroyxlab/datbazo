# ->delete()

Con el método `->delete()` se podra eliminar filas de una tabla

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que se encuentra la fila que quieres eliminar.

Luego debe adicionarse el metodo `->where()` para especificar la fila que sera eliminada;

```php
$ejemplo->delete('nombre_de_tabla')
        ->where(['columa2'=>'valor'])
        ->execute();
```

## Ejemplo

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->delete('tabla')
         ->where(['nombre' => 'juan'])
         ->execute();
```