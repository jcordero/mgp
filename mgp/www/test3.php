<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getKeyFromURL($url) {
    $query = array();
    $partes = parse_url($url);
    parse_str($partes['query'], $query);
    $path = pathinfo($partes['path']);
    return $path['basename'].'-'.$query['do'];
}

$url = 'http://misitio.com/module/pagina.php?do=SADADSADAJHER7&next=caca';
echo '<br>URL='.$url.' key='.  getKeyFromURL($url);

$url = '/module/pagina.php?do=SADADSADAJHER7&next=caca';
echo '<br>URL='.$url.' key='.  getKeyFromURL($url);

$url = 'pagina.php?do=SADADSADAJHER7&next=caca';
echo '<br>URL='.$url.' key='.  getKeyFromURL($url);

?>
