# ->execute()

Con el método `->execute()` se colocara como ultimo metodo de la consulta para ejecutar la consulta SQL. Este metodo atraves de los metodos `prepare` y `execute` de Pdo evita las injecciones SQL.

```php
$ejemplo->select('tabla')->execute();
```
## Ejemplo:

```php
use kroyxlab\klpdo\KLPdo as KLPdo;

$usuarios = new KLPdo;
$usuarios->select(['usuarios' => 'id, nombre, apellido, edad, correo'])
         ->where(['edad' => ['<=', 30]])
         ->order('edad DESC')
         ->limit(8)
         ->offset(2)
         ->execute();
```