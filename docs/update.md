# ->update()
Con el método `->update()` se podra modificar los valores de la tabla

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que quieres insertar datos.

Como segundo parámetro recibirá un `array` asociativo colocando en la **"Clave"** el nombre de la columna y en el **"Valor"** el nuevo valor con el cual se quiera reemplazar.

Recuerda colocar el metodo `->where()` para especificar la fila que sera modificada;

```php
$ejemplo->insert('nombre_de_tabla', [
  'columna1'='nuevo_valor',
  'columna2'='nuevo_valor',
  'columna3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->where(['columa2'=>'valor'])->execute();
```

## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->insert('usuarios',[
  'nombre' => 'Juan',
  'edad' => '34',
  ])where([
    'nombre' => 'antonio'
  ])->execute();
```