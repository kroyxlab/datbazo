# ->group()

With the method `->group()` the records will be grouped taking into account the columns that are specified

```php
$example->select(['table'=>'column1, column2, column3'])
        ->group('column2')->execute();
```

In case there are more than one table in the query you will have to use an associative array to identify which column belongs to each table

```php
$example->join([
  'table1'=>'column1, column2, column3',
  'table2'=>'column1, column2, column3'
])->on([
  'table1'=>'column1'
  'table2'=>'column3'
])->group([
  'table1'=>'columa1',
  'table2'=>'column2'
])->execute();
```
