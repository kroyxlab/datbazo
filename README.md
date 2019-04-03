# KLPdo

KLPdo Es un microframework con el cual podrás crear SQL querys e interactuar con la base de datos.

## Indice

* [Dependencias](#Dependencias)
* [Instalar](#Instalar)
* [Para empezar](#Para_empezar)
* [Métodos](#Métodos)
  * [Select()](#Select)
  * [join()](#join)
  * [Insert()](#Insert)
  * [Where()](#Where)
  * [Update()](#Update)
  * [Delete()](#Delete)
  * [Limit()](#Limit)
  * [Offset()](#Offset)
  * [group()](#Group)
  * [order()](#order)
  * [render()](#render)
* [Autor](#Autor)
* [Licencia](#Licencia)



## Dependencias

Este paquete requiere de PHP 7 o superior.

## Instalar

Instala KLPdo vía composer

```
composer require kroyxlab/klpdo
```
o copia el repositorio directo en tu proyecto y requiere la clase.

```php
require_once 'directoria_del_proyecto/klpdo/src/KLPdo.php';
use kroyxlab\klpdo\KLPdo as KLPdo;
```

## Para empezar

Modifica el archivo KLPdo.ini ubicado en la carpeta /src/ y modifica los valores para configurar la conexión a la base de datos.

```ini
  [database]
  db_driver = Mysql, sqlite3, pgsql
  db_host = Nombre_del_Host
  db_port = Puerto
  db_name = Nombre_de_la_base_de_datos
  db_user = usuario
  db_password = contraseña
  db_charset = UTF8
```

Si todo esta configurado correctamente podrás comenzar a usar la librería.

```php

require_once "vendor/autoload.php";
use kroyxlab\klpdo\KLPdo as KLPdo;

// instancia la clase KLPdo
$productos = new KLPdo;

// Crea una sentencia SQL mediante los métodos de la clase KLPdo
$productos->select(['productos'=>'nombre, precio'])
          ->where(['precio'=>['>=', 12.5]])
          ->order('precio')
          ->execute();

// Usa el Método ->render(); para dar salida y formato al resultado de la consulta sql
$productos->render(function($producto){

  return "<p>El producto de nombre {$producto['nombre']} tiene un valor de {$producto['precio']}</p>";

});

```

## Métodos:

### **Select()**

Con el método `->select()` podrás hacer consultas a la base de datos.

```php
// en caso de querer todas las columnas de una tabla 
$ejemplo->select('nombre_de_la_tabla')->execute();

// para especificar las columnas a utilizar se usara un array asociativo
$ejemplo->select(['nombre_de_la_tabla'=>'columna1, columna2, columna3'])->execute();
```

### **Join()**

Con el método `->selectJoin()` podrás unir la información de dos tablas.

El método recibirá un `array` asociativo como primer parámetro con el nombre de la tabla y las columnas correspondientes que se requieran.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
])...
```

por defecto la sentencia JOIN sera de tipo INNER, pero se podrá modificar añadiendo colocando un segundo parámetro(Opcional) a la consulta, por ejemplo en el siguiente caso dará como resultado un LEFT JOIN.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
], 'LEFT')...

```

y para identificar por cuales columnas sera unida la consulta se utilizara el método `->on()` el cual recibirá un `array` asociativo donde se deberá colocar el nombre de la tabla y el nombre de la columna.

```php
$ejemplo->join([
  'nombre_de_la_tabla1'=>'columna1, columna2, columna3',
  'nombre_de_la_tabla2'=>'columna1, columna2, columna3',
])->on([
  'nombre_de_la_tabla1'=>'columna1',
  'nombre_de_la_tabla2'=>'Columna_uno',
])->execute();
```
### **Insert()**

Con el método `->insert()` podrás insertar datos a una tabla.

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que quieres insertar datos.

Como segundo parámetro recibirá un `array` sociativo con el nombre de la columna y el valor que se quiera insertar.

```php
$ejemplo->insert('nombre_de_tabla', [
  'columna1'='nuevo_valor',
  'columna2'='nuevo_valor',
  'columna3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->execute();
```

### **Where()**

Con el método `->where()` se pueden filtrar los resultados de la consulta SQL

```php
// ... WHERE columa1 = 'valor';
$ejemplo->select(['tabla'=>'columna1, columna4'])
        ->where(['columna1'=>'valor'])
        ->execute();

// ...WHERE columna >= 'valor';
// tambien se pueden usar los valores:  >= || <= || != || LIKE || ILIKE
$ejemplo->select(['tabla'=>'columna1, columna4'])
        ->where(['columna1'=>['>=','valor']]) 
        ->execute();
```

Para colocar mas de un filtro WHERE se colocaran de la siguiente forma

```php
$ejemplo->select(['tabla'=>'columna1, columna4'])
        ->where([
          'columna1'=>['>=', 1500],
          'AND', // tambien se podra colocar OR
          'columna2'=>['<=', 3000]
          ])
        ->execute();
```

### **update()**
Con el método `->update()` se podra modificar los valores de la tabla

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que quieres insertar datos.

Como segundo parámetro recibirá un `array` sociativo con el nombre de la columna y el valor que se quiera actualizar.

Luego debe adicionarse el metodo `->where()` para especificar la fila que sera modificada;

```php
$ejemplo->insert('nombre_de_tabla', [
  'columna1'='nuevo_valor',
  'columna2'='nuevo_valor',
  'columna3'='nuevo_valor',
  'columna4'='nuevo_valor'
  ])->where(['columa2'=>1245])->execute();
```

### **Delete()**
Con el método `->delete()` se podra eliminar filas de una tabla

Como primer parámetro recibirá un `string` con el nombre de la tabla en la que se encuentra la fila que quieres eliminar.

Luego debe adicionarse el metodo `->where()` para especificar la fila que sera eliminada;

```php
$ejemplo->delete('nombre_de_tabla')
        ->where(['columa2'=>1245])
        ->execute();
```

### **Limit()**

Con el método `->Limit()` se limitara el numero de registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `number` con la cantidad de registros que se quiera obtener.

```php
$ejemplo->select('tabla')->limit(5)->execute();
```

### **Offset()**

Con el método `->offset()` se omitiran el numero de registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `number` con la cantidad de registros que se quiera omitir.

```php
$ejemplo->select('tabla')->limit(10)->offset(7)->execute();
```

### **Group()**

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

### **Order()**

Con el método `->order()` se ordenaran los registros que se mostraran como resultado de la consulta SQL

recibira como parámetro recibirá un `string` con el orden que se requiera.

```php
$ejemplo->select('tabla')->order('columna ASC')->execute();
```


### **Execute()**

Con el método `->execute()` se colocara como ultimo metodo de la consulta para ejecutar la consulta SQL

```php
$ejemplo->select('tabla')->execute();
```


### **Render()**

Con el método `->render()` podras renderizar el resultado de una consulta SQL mediante una funcion anonima

el metodo `->render()` recibira como unico parametro una funcion anonima 

la cual recibira como parametro una variable que servira para recorrer cada fila de la tabla

```php
$ejemplo->select('tabla')->execute();

$ejemplo->render(function($fila){
  return "
    <p>Hola mi nombre es {$fila['nombre']} y el link de mi repositorio es {$fila['repositorio']}</p>
  ";
});
```

## **Autor**

* **Kristian Soto (KroyxLab)** - [Github](https://github.com/KroyxLab) | [Gitlab](https://gitlab.com/KroyxLab)

## **Licencia**

This project is licensed under the MIT License - see the [MIT.md](license.md) file for details