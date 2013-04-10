<?php
include 'common/sites.php';
include 'beans/ticket.php';
include 'beans/ciudadano.php';
echo  'Creo objeto ticket <pre>';
$t = new ticket();
echo $t->toJSON();
echo '</pre>';
echo  'obtengo un ciudadano <pre>';
$ret = array('resultado' => ciudadano::FactoryById(36));
echo json_encode($ret);
echo '</pre>';
