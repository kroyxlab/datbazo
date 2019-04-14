# ->group()

Per la metodo `->group()` se agruparan los registros tomando en cuenta las kolumnoj que se le especifiquen

```php
$ekzemplo->select(['tabelo'=>'kolumno1, kolumno2, kolumno3'])
        ->group('kolumno2')->execute();
```

En la kazo, ke ekzistas pli ol unu tabelo en la konsulto, asociecan `array` debos esti uzita por identigi, kiu kolono apartenas al ĉiu tabelo.

```php
$ekzemplo->join([
  'tabla1'=>'kolumno1, kolumno2, kolumno3',
  'tabla2'=>'kolumno1, kolumno2, kolumno3'
])->on([
  'tabla1'=>'kolumno1'
  'tabla2'=>'kolumno3'
])->group([
  'tabla1'=>'kolumno1',
  'tabla2'=>'kolumno2'
])->execute();
```
