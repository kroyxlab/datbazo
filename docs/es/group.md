# ->group()

Con el método `->group()` se agruparan los registros tomando en cuenta las columnas que se le especifiquen

```php
$ejemplo->select(['tabla'=>'columna1, columna2, columna3'])
        ->group('columna2')->execute();
```

en caso de que existan mas de una tabla en la consulta se usara un array asociativo para identificar que columna pertenece a cada tabla

```php
$ejemplo->join([
  'tabla1'=>'columna1, columna2, columna3',
  'tabla2'=>'columna1, columna2, columna3'
])->on([
  'tabla1'=>'columna1'
  'tabla2'=>'columna3'
])->group([
  'tabla1'=>'columa1',
  'tabla2'=>'columa2'
])->execute();
```
