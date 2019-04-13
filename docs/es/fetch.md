# ->fetch()

Con el método `->fetch()` puedes obtener el resultado de los consulta sql con el tipo de dato que desees obtener.

El metodo `->fetch()` recibe como parametro un `string` donde se especificara el tipo de fetch que se desee recibir.

|Tipo Ingresado|Fetch Recibido|
|-|:-:|
|Assoc|PDO::FETCH_ASSOC|
|Obj|PDO::FETCH_OBJ|
|Column|PDO::FETCH_COLUMN|
|Keypair|PDO::FETCH_KEY_PAIR|
|Unique|PDO::FETCH_UNIQUE|
|Group|PDO::FETCH_GROUP|
|Json|json_encode(... (PDO::FETCH_OBJ)|

```php
$ejemplo->select('tabla')->execute();
foreach($ejemplo->fetch('ASSOC') as $ejm){
  echo "
    <p>$ejm['columa1']</p>
  ";
}
```

Si se necesita otro tipo de dato que no este en la tabla, se podra colocar el tipo que se necesite siempre que sea un dato admitido por el `PDO::FETCH`

```php
$ejemplo->select('tabla')->execute();
$ejemplo->fetch('PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE');
```

El metodo `->fetch()` no solo devuelve el resultado de la consulta, tambien puede ser utilizado para establecer el tipo de fetch que sera utilizado por el metodo [->render()](render)