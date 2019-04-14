# ->update()

Per la metodo `->update()` oni povos ĝisdatigi la valorojn de la tabelo.

kiel unua parametro ricevos `string` kun la nomo de la tabelo kie vi celas ĝisdatigi la datumojn.

Kiel dua parametro ricevos asocieca `array` enmetinte en la **"ŝlosilo"** el nomo de la columno kaj en la **"valoro"** la novan valoron kiu vi celas reenmeti.

Memori nomi poste la meteodon `->where()` por specifi la vico kiu oni volas esti ĝisdatigi;

```php
$ekzemplo->insert('tabela_nomo', [
  'kolumno1'='nuevo_valor',
  'kolumno2'='nuevo_valor',
  'kolumno3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->where(['kolumno2'=>'valoro'])->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->insert('uzantoj',[
  'nomo' => 'Juan',
  'aĝo' => '34',
  ])where([
    'nomo' => 'antonio'
  ])->execute();
```