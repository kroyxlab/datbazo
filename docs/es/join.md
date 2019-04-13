# ->join()

Con el método `->join()` podrás unir la información de dos tablas.

El método recibirá un `array` asociativo como primer parámetro, colocando en la **"Clave"** el nombre de la tabla y en el **"Valor"** las columnas que se requieran.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
])...
```

Por defecto la sentencia JOIN sera de tipo INNER, pero se podrá modificar añadiendo colocando un segundo parámetro(Opcional) a la consulta, por ejemplo en el siguiente caso dará como resultado un LEFT JOIN.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
], 'LEFT')...

```

Para identificar por cuales columnas sera unida la consulta se utilizara el método `->on()` el cual recibirá un `array` asociativo donde se deberá colocar el la **"Clave"** el nombre de la tabla y en el **"Valor"** el nombre de la columna.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
])->on([
  'nombre_de_la_tabla1'=>'columna1',
  'nombre_de_la_tabla2'=>'Columna_uno',
])->execute();
```

## Ejemplo

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->join([
  'usuarios' => 'nombre, apellido, nro_dni, edad',
  'carnets' => 'codigo, cargo, piso, dni_usuario'
])->on([
  'usuarios' => 'nro_dni',
  'carnets' => 'dni_usuario'
])->execute();
```