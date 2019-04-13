# ->insert()

Con el método `->insert()` podrás insertar datos a una tabla.

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que quieres insertar datos.

Como segundo parámetro recibirá un `array` asociativo donde se colocara en la **"Clave"** el nombre de la columna y en el **"Valor"** el dato que insertara.

```php
$ejemplo->insert('nombre_de_tabla', [
  'columna1'='nuevo_valor',
  'columna2'='nuevo_valor',
  'columna3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->execute();
```

## Ejemplo

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->insert('usuarios', [
  'nombre' => 'Antonio',
  'apellido' => 'Hayama',
  'nro_dni' => 123456789,
  'edad' => 48,
  'correo' => 'ejemplo@email.com'
])->execute();
```
