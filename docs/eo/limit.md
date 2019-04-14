# ->limit()

Per la metodo `->Limit()` oni limigota la nombron de registroj kiu estos montrita en la rezulto de la SQL-konsulto

Kiel unua parametro ricevos `number` kun la kvanto de registroj kiu oni celas recibi.

```php
$ekzemplo->select('tabelo')->limit(5)->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select([
  'uzantoj' => 'id, nomo, familinomo, aĝo, correo'
  ])->where([
    'aĝo' => ['<=', 30]
  ])->limit(8)->execute();
```