<p align="center">
  <img width="460" src="./DatBazo.png">
</p>

# DatBazo

DatBazo(Datuma Bazo) estas malgranda biblioteko per kiu vi povas krei demandojn al la datumbazo uzante la metodojn "Prepare" kaj "Execute" de PDO por tiumaniere eviti SQL-injekton.

## Indice

* [Dependencoj](#Dependencoj)
* [Instali](#Instali)
* [Por komenci](#Por-komenci)
* [Metodoj](#Metodoj)
* [Aûtoro](#Aûtoro)
* [Permisilo](#Permisilo)

## Dependencoj

Oni bezonas PHP7 aû supera.

## Instali

### Tra composer

```console
composer require kroyxlab/datbazo
```

### Kopiante deponejo

Kopiu ĉi deponejon en via proĵekta dosierujo kaj bezonu la klaso.

```php
require_once 'proĵektaDozierujo/datbazo/src/DatBazo.php';
use kroyxlab\datbazo\DatBazo as DatBazo;
```

## Por komenci

Modifu la dosiero DBconfig.ini kiu estas en `vendor/kroyxlab/DatBazo/src/DBconfig.ini` kaj ŝanĝu la valoroj por agordi la konekto al la data bazo.

```ini
  [database]
  db_driver = Mysql, sqlite3, pgsql
  db_host = Host_nomo
  db_port = Puerto
  db_name = Data_baza_nomo
  db_user = uzanta_nomo
  db_password = pasvorto
  db_charset = UTF8
```

Se ĉio estas ĝuste agordita, oni povas ekuzi ĝin.

```php
require_once "vendor/autoload.php";
use kroyxlab\datbazo\DatBazo as DatBazo;

// Generi la Klaso DatBazo
$produktoj = new DatBazo;

// Krei la SQL-konsulto uzante la metodoj de la klaso
$produktoj->select(['produktoj'=>'nomo, prezo'])
          ->where(['prezo'=>['>=', 12.5]])
          ->order('prezo')
          ->execute();

// Uzu la metodo ->fetch(); por eligi la rezulton de la konsulto...

$produktoj->fetch();

// kaj uzu ĝin en foreach buklo

foreach($produktoj->fetch() as $produkto){
  echo "
    <tr>
      <td>$produkto['nomo']</td>
      <td>$produkto['prezo']</td>
    </tr>
  ";
}

```

## Metodoj

La metodoj de la klaso DatBazo helpas krei SQL-prepoziciojn kiuj estos plenumi tra la PDO metodoj `prepare` kaj `execute` evitante SQL-injektoj

### **Listo de metodoj:**

* [Select()](./docs/eo/select.md)
* [join()](./docs/eo/join.md)
* [Insert()](./docs/eo/insert.md)
* [Where()](./docs/eo/where.md)
* [Update()](./docs/eo/update.md)
* [Delete()](./docs/eo/delete.md)
* [Limit()](./docs/eo/limit.md)
* [Offset()](./docs/eo/offset.md)
* [Group()](./docs/eo/group.md)
* [Order()](./docs/eo/order.md)
* [Execute()](./docs/eo/execute.md)
* [Fetch()](./docs/eo/fetch.md)
* [Render()](./docs/eo/render.md)

## **Aûtoro**

* **Kristian Soto (KroyxLab)** - [Github](https://github.com/KroyxLab) | [Gitlab](https://gitlab.com/KroyxLab)

## **Permisilo**

This project is licensed under the MIT License - see the [MIT.md](license.md) file for details