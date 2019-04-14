# ->where()

Per la metodo `->where()` oni povas filtri la rezulton de la SQL-konsulto.

Por konfirmi se la valoron de la kolumno estas **egale** al alia necesa valoro oni uzos asocieca `array` enmetinte en la **"ŝlosilo"** el nomon de la columno kaj en la **"valoro"**  valoron kiu oni celas kompari.

```php
$ekzemplo->select(//...)
        ->where(['kolumno'=>'valoro']) // ... WHERE kolumno = valoro
        ->execute();
```

se oni volas kompari uzante la valorojn = | <= | != | LIKE | ILIKE | oni devos uzi la sekva sintakso:

```php
$ekzemplo->select(//...)
        ->where([
          'kolumno'=>['>=','valoro'] // WHERE kolumno >= valoro
          ])
        ->execute();
```

Por uzi pli ol unu filtro WHERE kiel AND | OR | NOT, oni devos enmeti ĉi tiel:

```php
$ekzemplo->select(['tabelo'=>'kolumno1, columna4'])
        ->where([
          'kolumno1'=>['>=', 'valoro'],
          'AND',
          'kolumno2'=>['<=', 'valoro']
          ])
        ->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select([
  'uzantoj' => 'id, nomo, familinomo, aĝo, correo'
  ])->where([
    'nomo' => ['LIKE', 'anton%'],
    'AND',
    'aĝo' => ['>=', 30]
  ])->execute();
```