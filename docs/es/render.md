# ->render()

Con el método `->render()` podras renderizar el resultado de una consulta SQL mediante una funcion anonima

el metodo `->render()` recibira como unico parametro una funcion anonima 

la cual recibira como parametro una variable que servira para recorrer cada fila de la tabla.

Anterior a la utilizacion de esta tabla se debera llamar al metodo `->fetch();` para establecer el tipo de fetch que sera utilizado por la funcion.

```php
$ejemplo->select('tabla')->execute();
$ejemplo->fetch('ASSOC');
$ejemplo->render(function($fila){
  return "
    <p>Hola mi nombre es {$fila['nombre']} y el link de mi repositorio es {$fila['repositorio']}</p>
  ";
});
```

## Ejemplo

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select(['usuarios' => 'nombre, apellido, nro_dni, edad'])
         ->where(['edad' => ['>=', 30]])
         ->order('apellido')
         ->limit(6)
         ->execute();
$usuarios->fetch('OBJ');
$usuarios->render(function($usuario){
  return "
    <tr>
      <td>$usuario->nombre</td>
      <td>$usuario->apellido</td>
      <td>$usuario->nro_dni</td>
      <td>$usuario->edad</td>
    </tr>
  ";
})
```