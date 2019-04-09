# ->where()

Con el método `->where()` se pueden filtrar los registros de la consulta SQL.

para verificar si el valor de la columa es **igual** al valor requerido se utilizara una `array` asociativo colocando en la **"Clave"** el nombre de la columna y en el **"Valor"** el valor con el que se quiera comparar.

```php
$ejemplo->select(//...)
        ->where(['columna'=>'valor']) // ... WHERE columna = valor
        ->execute();
```

si se quiere comparar la columna con los valores = | <= | != | LIKE | ILIKE | se utilizara la siguiente sintaxis:

```php
$ejemplo->select(//...)
        ->where([
          'columna'=>['>=','valor'] // WHERE columna >= valor
          ]) 
        ->execute();
```

Para colocar mas de un filtro WHERE utilizando AND | OR | NOT, se colocaran de la siguiente forma:

```php
$ejemplo->select(['tabla'=>'columna1, columna4'])
        ->where([
          'columna1'=>['>=', 'valor'],
          'AND',
          'columna2'=>['<=', 'valor']
          ])
        ->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select([
  'usuarios' => 'id, nombre, apellido, edad, correo'
  ])->where([
    'nombre' => ['LIKE', 'anton%'],
    'AND',
    'edad' => ['>=', 30]
  ])->execute();
```