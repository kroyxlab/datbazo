# ->execute()

La metodo `->execute()` estos uzata kiel lasta metodo por plenumi la SQL-konsulto.

```php
$ekzemplo->select('tabelo')->execute();
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select(['uzantoj' => 'id, nomo, familinomo, agxo, retposxto'])
         ->where(['agxo' => ['<=', 30]])
         ->order('agxo DESC')
         ->limit(8)
         ->offset(2)
         ->execute();
```