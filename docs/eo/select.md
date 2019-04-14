# ->Select()

Per la metodo `->select()` oni povos fari konsultojn al datuma bazo.

Por obteni ĉiujn la registrojn oni devas uzi `string` kun la tabela nomo.

```php
$ekzemplo->select('nombre_de_la_tabla')->execute();
```

Por obteni specifajn kolumnojn oni devas uzi asocieca `array` kie oni enmetas kiel **"ŝlosilo"** la tabelan nomon kaj kiel **"valoro"** la necesajn kolumnojn.

```php
$ekzemplo->select(['nombre_de_la_tabla'=>'kolumno1, kolumno2, kolumno3'])->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select([
  'uzantoj' => 'id, nomo, familinomo, aĝo, correo'
  ])->execute();
```