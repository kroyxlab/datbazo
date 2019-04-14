# ->join()

Per la metodo `->join()` oni povos aliĝi la datumoj de du tabeloj.

La metodo ricevos asociecan `array` kiel unua parametro, enmetinte en la **"ŝlosilo"** la nomo de la tabelo kaj en la **"valoro"** la necesajn kolumnojn.

```php
$ekzemplo->join([
  'tabela_nomo1'=>'kolumno1, kolumno2, kolumno3',
  'tabela_nomo2'=>'kolumno1, kolumno2, kolumno3',
])...
```

Defaûlte la deklaro JOIN estos tipo INNER, sed oni povos ŝanĝi aldonante dua parametro(laûvola) al la deklaro. Ekzemple en la sekva kazo LEFT JOIN estos akirota kiel rezulto.

```php
$ekzemplo->join([
  'tabela_nomo1'=>'kolumno1, kolumno2, kolumno3',
  'tabela_nomo2'=>'kolumno1, kolumno2, kolumno3',
], 'LEFT')...

```

por identigi por kiuj kolumnoj estos aliĝota la konsulto oni devos uzi la metodon `->on()` kiu ricevos asociecan `array` kie oni devos enmeti en la **"ŝlosilo"** la nomon de la tabelo kaj en la **"valoro"** la nomon de la columno.

```php
$ekzemplo->join([
  'tabela_nomo1'=>'kolumno1, kolumno2, kolumno3',
  'tabela_nomo2'=>'kolumno1, kolumno2, kolumno3',
])->on([
  'tabela_nomo1'=>'kolumno1',
  'tabela_nomo2'=>'Kolumno_unu',
])->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->join([
  'uzantoj' => 'nomo, familinomo, nro_dni, aĝo',
  'carnets' => 'pasvorto, cargo, etaĝo, dni_uzanto'
])->on([
  'uzantoj' => 'nro_dni',
  'carnets' => 'dni_uzantoj'
])->execute();
```