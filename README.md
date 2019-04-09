# KLPdo

KLPdo Es un microframework con el cual podrás crear SQL querys e interactuar con la base de datos.

## Indice

* [Dependencias](#Dependencias)
* [Instalar](#Instalar)
* [Para empezar](#Para-empezar)
* [Métodos](#Métodos)
* [Autor](#Autor)
* [Licencia](#Licencia)

## Dependencias

Este paquete requiere de PHP 7 o superior.

## Instalar

**vía composer:**

```
composer require kroyxlab/klpdo
```
**Via repositorio repositorio**

Copia el repositorio directo en tu proyecto y requiere la clase.

```php
require_once 'directoria_del_proyecto/klpdo/src/KLPdo.php';
use kroyxlab\klpdo\KLPdo as KLPdo;
```

## Para empezar

Modifica el archivo KLPdo.ini ubicado en la carpeta `vendor/kroyxlab/klpdo/src/KLPDO.ini` y modifica los valores para configurar la conexión a la base de datos.

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

## Métodos

Los metodos de la clase KLPdo ayudan a crear una sentencia SQL la cual sera ejecuta atraves de los metodos `prepare` y `execute` de Pdo evitando asi las injecciones SQL.

### **Lista de metodos:**

* [Select()](./docs/select)
* [join()](./docs/join)
* [Insert()](./docs/insert)
* [Where()](./docs/where)
* [Update()](./docs/update)
* [Delete()](./docs/delete)
* [Limit()](./docs/limit)
* [Offset()](./docs/offset)
* [Group()](./docs/group)
* [Order()](./docs/order)
* [Execute()](./docs/execute)
* [Fetch()](./docs/fetch)
* [Render()](./docs/render)

## **Autor**

* **Kristian Soto (KroyxLab)** - [Github](https://github.com/KroyxLab) | [Gitlab](https://gitlab.com/KroyxLab)

## **Licencia**

This project is licensed under the MIT License - see the [MIT.md](license.md) file for details