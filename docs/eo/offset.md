# ->offset()

Per la metodo `->offset()` ignoros la kvanton de montritaj registroj en la rezultoj de la  SQL-konsulto

ricevos kiel parametro `number` kun la kvanto de registroj kiu oni celas ignori.

```php
$ekzemplo->select('tabelo')->limit(10)->offset(7)->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select([
  'uzantoj' => 'id, nomo, familinomo, aĝo, correo'
  ])->where([
    'aĝo' => ['<=', 30]
  ])->limit(8)->offset(2)->execute();
```