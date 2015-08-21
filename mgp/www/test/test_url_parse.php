<?php
/* Obtener una key para identificar la pagina llamada sin importar si la URL es completa, parcial o relativa
 * 
 */

function getKeyFromURL($url) {
    $query = array();
    $partes = parse_url($url);
    parse_str($partes['query'], $query);
    $path = pathinfo($partes['path']);
    return $path['basename'].'-'.$query['do'];
}

$url = 'http://misitio.com/module/pagina.php?do=SADADSADAJHER7&next=caca';
echo '<hr>URL='.$url.'<br/> key='.  getKeyFromURL($url);

$url = '/module/pagina.php?do=SADADSADAJHER7&next=caca';
echo '<hr>URL='.$url.'<br/> key='.  getKeyFromURL($url);

$url = 'pagina.php?do=SADADSADAJHER7&next=caca';
echo '<br>URL='.$url.'<br/> key='.  getKeyFromURL($url);

