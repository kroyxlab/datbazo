# ->insert()

Per la metodo `->insert()` oni povos enigi datumojn al la tabelo.

kiel unua parametro ricevos `string` kun la nomo de la tabelo en kie vi celas enigi datumojn.

Kiel dua parametro ricevos asociecan `array` kie vi debas meti en la **"ŝlosilo"** la nomo de la columno kaj en la **"valoro"** la datumo ke oni volas enigi.

```php
$ekzemplo->insert('tabela_nomo', [
  'kolumno1'='nuevo_valor',
  'kolumno2'='nuevo_valor',
  'kolumno3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->insert('uzantoj', [
  'nomo' => 'Antonio',
  'familinomo' => 'Hayama',
  'nro_dni' => 123456789,
  'aĝo' => 48,
  'correo' => 'ejemplo@email.com'
])->execute();
```
