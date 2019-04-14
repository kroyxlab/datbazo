# ->render()

Per la metodo `->render()` oni povos redoni la rezulton de SQL-konsulto per anonima funkcio.

La metodo `->render()` ricevos kiel unika parametro anoniman funkcion.

antaue al la uzo de ĉi metodo oni devas nomi la metodo `->fetch()` por establi la datuman tipon kiu estos uzita en la funkcio.

```php
$ekzemplo->select('tabelo')->execute();
$ekzemplo->fetch('ASSOC');
$ekzemplo->render(function($vico){
  return "
    <p>Hola mi nomo es {$vico['nomo']} y el link de mi repositorio es {$vico['repositorio']}</p>
  ";
});
```

## Ekzemplo

```php
use kroyxlab\datbazo\DatBazo as DatBazo;

$uzantoj = new DatBazo;
$uzantoj->select(['uzantoj' => 'nomo, familinomo, nro_dni, aĝo'])
         ->where(['aĝo' => ['>=', 30]])
         ->order('familinomo')
         ->limit(6)
         ->execute();
$uzantoj->fetch('OBJ');
$uzantoj->render(function($uzanto){
  return "
    <tr>
      <td>$uzanto->nomo</td>
      <td>$uzanto->familinomo</td>
      <td>$uzanto->nro_dni</td>
      <td>$uzanto->aĝo</td>
    </tr>
  ";
})
```