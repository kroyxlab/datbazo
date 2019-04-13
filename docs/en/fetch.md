# ->fetch()

With the method `->fetch()` you can obtain the result of the sql queries with the type of data that you want to obtain.

|Type Entered|Fetch Received|
|-|:-:|
|Assoc|PDO::FETCH_ASSOC|
|Obj|PDO::FETCH_OBJ|
|Column|PDO::FETCH_COLUMN|
|Keypair|PDO::FETCH_KEY_PAIR|
|Unique|PDO::FETCH_UNIQUE|
|Group|PDO::FETCH_GROUP|
|Json|json_encode(... (PDO::FETCH_OBJ)|

```php
$example->select('table')->execute();
foreach($example->fetch('ASSOC') as $ejm){
  echo "
    <p>$ejm['columa1']</p>
  ";
}
```

If you need another type of data that is not on the table, you can place the type that is needed as long as it is a data admitted by the `PDO::FETCH`

```php
$example->select('table')->execute();
$example->fetch('PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE');
```

The method `->fetch()` not only returns the result of the query, it can also be used to set the type of fetch that will be used by the method [->render()](render.md)