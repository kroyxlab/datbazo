# ->render()

With the method `->render()` you can render the result of an SQL query using an anonymous function.

el metodo `->render()` will receive as an only parameter an anonymous function.

which will receive as a parameter a variable that will serve to go through each row of the table.

prior to the use of this method you must call the `->fetch();` method to set the type of fetch that will be used by the function.

```php
$example->select('table')->execute();
$example->fetch('ASSOC');
$example->render(function($row){
  return "
    <p>Hello my name is {$row['name']} and the link of my repository is {$row['repository']}</p>
  ";
});
```

## Example

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$users = new DatBazo;
$users->select(['users' => 'name, lastname, nro_dni, age'])
         ->where(['age' => ['>=', 30]])
         ->order('lastname')
         ->limit(6)
         ->execute();
$users->fetch('OBJ');
$users->render(function($usuario){
  return "
    <tr>
      <td>$usuario->name</td>
      <td>$usuario->lastname</td>
      <td>$usuario->nro_dni</td>
      <td>$usuario->age</td>
    </tr>
  ";
})
```