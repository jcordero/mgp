<?php

include_once 'common/sites.php';
include_once 'beans/ciudadano.php';

/**
 * 
 * urls:
    /mgp/webservices/ciudadanos/<id>
    /mgp/webservices/ciudadanos/<emisor>/<tipo-doc>/<numero-doc>

    operación: GET
    parámetros: id (número) o tipo-doc (enumeración) y doc (numero) y emisor
    (código país ISO 3 letras) o nombre (string)
    retorna:
    200 ok (si el ciudadano existe)
    404 not found (si el ciudadano pedido no existe en el sistema)
    400 bad request (si los parámetros de búsqueda no existen o están mal formados)
 * 
 * *************************************************************************************
 * Actualización de datos de un ciudadano

        url: /mgp/webservices/ciudadanos/<id>
        operación: PUT
        contenido del POST: ciudadano (objeto JSON) y firma (string)
        retorna:
        200 ok (si el ciudadano existe)
        404 not found (si el ciudadano pedido no existe en el sistema)
        400 bad request (si los parámetro id no existen o están mal formado. O el objeto
        ciudadano está mal formado)
 ******************************************************************************************+
 * url: /mgp/webservices/ciudadanos/<id>/eventos
    operación: PUT
    contenido del POST: evento (objeto JSON) y firma (string)
    retorna:
            200 ok (si el ciudadano existe)
            404 not found (si el ciudadano pedido no existe en el sistema)
            400 bad request (si los parámetro id no existen o están mal formado. O el objeto
            evento esta mal forma
 */

$metodo = $_SERVER['REQUEST_METHOD']; // GET, POST, PUT 
$id = $_REQUEST['id'];
$sEmisor = $_REQUEST['emisor'];
$sTipoDoc = $_REQUEST['tipo_doc'];
$iNumeroDocumento = $_REQUEST['numero_doc'];   
$sFirma= $_REQUEST['firma'];
$json = $_POST['json'];
$ret = array('resultado' => 'metodo desconocido');

if($metodo=='GET') {
   if (! isset($id)) $ret = consulta_ciudadano($sEmisor,$sTipoDoc,$iNumeroDocumento);
   else  $ret = consulta_ciudadano($id);
    
}

if($metodo=='PUT') {
    $obj = json_decode($json);
    if($obj && isset($obj->ciudadano) ) {
        $ret = update_ticket($sFirma,$obj->ciudadano);
    }
    
    if($obj && isset($obj->evento) ) {
        $ret = nuevo_evento($sFirma,$obj->evento);
    }
}

echo json_encode($ret);
exit;

/*******************************************************************************/

function consulta_ciudadano($tipo,$anio,$nro) {
    /* TODO: Escribir consulta a objeto ticket
     */
    $ret = array('resultado' => 'no implementado');
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
