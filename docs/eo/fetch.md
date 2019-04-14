# ->fetch()

Per la metodo `->fetch()` oni povas akiri la rezulton pri la SQL-konsulto kun la tipo de datumo ke oni celas akiri.

|Enira Tipo|Ricevita Fetch|
|-|:-:|
|Assoc|PDO::FETCH_ASSOC|
|Obj|PDO::FETCH_OBJ|
|Column|PDO::FETCH_COLUMN|
|Keypair|PDO::FETCH_KEY_PAIR|
|Unique|PDO::FETCH_UNIQUE|
|Group|PDO::FETCH_GROUP|
|Json|json_encode(... (PDO::FETCH_OBJ)|

```php
$ekzemplo->select('tabelo')->execute();
foreach($ekzemplo->fetch('ASSOC') as $ekzm){
  echo "
    <p>$ekzm['columno1']</p>
  ";
}
```

Se oni bezonas alian datuman tipon kiu ne estas en la tabelo, povas meti la datuman tipon kiu necesas. Sed tiu datumo devas esti ekceptita laû `PDO::FETCH`.

```php
$ekzemplo->select('tabelo')->execute();
$ekzemplo->fetch('PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE');
```

La metodo `->fetch()` ne nur revenordonas la resulton de la konsulto, ankaû povas esti uzita por stabli la tipon de fetch kiu estas uzota por la metodo [->render()](render.md)