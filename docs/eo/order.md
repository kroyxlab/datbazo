# ->order()

Per la metodo `->order()` oni ordigos la registroj en la rezulto de la SQL-konsulto

Ricevos kiel unua parametro `string` kun la necesa ordono.

```php
$ekzemplo->select('tabelo')->order('kolumno ASC')->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select('uzantoj')->order('apellidos')->execute();
```