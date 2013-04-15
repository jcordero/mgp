<?php

include_once 'common/sites.php';
include_once 'beans/tickets.php';

/**
 * Ingreso de ticket
 * Metodo: PUT
 * En el payload del PUT va un objeto JSON con los datos del ticket
 * 
 * Consulta de ticket
 * Metodo: GET
 * URL: /mgp/webservices/tickets/<tipo>/<año>/<nro>
 * Parametros: tipo, anio, nro
 * 
 * Actualizacion de un ticket
 * Metodo: PUT
 * En el payload del PUT va un objeto JSON con los datos del ticket
 */

$metodo = $_SERVER['REQUEST_METHOD']; // GET, POST, PUT 
$tipo = $_REQUEST['tipo'];
$anio = $_REQUEST['anio'];
$nro = $_REQUEST['nro'];
$json = $_POST['json'];
$ret = array('resultado' => 'metodo desconocido');

if($metodo=='GET') {
    $ret = consulta_ticket($tipo,$anio,$nro);
}

if($metodo=='PUT') {
    $obj = json_decode($json);
    if($obj && isset($obj->ingreso_ticket) ) {
        $ret = ingreso_ticket($tipo,$anio,$nro,$obj->ingreso_ticket);
    }
    
    if($obj && isset($obj->cambio_estado_ticket) ) {
        $ret = actualizo_ticket($tipo,$anio,$nro,$obj->cambio_estado_ticket);
    }
}

echo json_encode($ret);
exit;

/*******************************************************************************/

function consulta_ticket($tipo,$anio,$nro) {
    /* TODO: Escribir consulta a objeto ticket
     */
    $ret = ticket::factoryByIdent($tipo, $nro, $anio);
    return $ret;
}

function ingreso_ticket($tipo,$anio,$nro,$ingreso_ticket) {
    /* TODO: Ingresar ticket 
     * 
     */
    $ret = array('resultado' => 'no implementado');
    return $ret;
}

function actualizo_ticket($tipo,$anio,$nro,$cambio_estado_ticket) {
    /* TODO: cambiar de estado el ticket
     * 
     */
    $ret = array('resultado' => 'no implementado');
    return $ret;
}

?>
