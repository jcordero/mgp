<?php
include_once 'common/sites.php';
include_once 'beans/ticket.php';
ini_set("error_log", LOG_PATH.'api_miciudad.log');
error_log("\n------------------ INICIO PROCESO API -----------------------\n");

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
$ret['resultado'] = 'ERROR';
$ret['error'] = '';
$metodo = $_SERVER['REQUEST_METHOD'];   // GET, PUT 

//validacion de la entrada
if($metodo!="GET" && $metodo!="PUT") {
    $ret['error'] = 'Solo se acepta el metodo GET o PUT';
}
    
if($metodo==='GET' && $ret['error']==='') {
    $tipo = strtoupper($_GET['tipo']);      //RECLAMO SOLICITUD DENUNCIA QUEJA
    $anio = intval($_GET['anio']);          //Nro
    $nro = intval($_GET['nro']);            //Nro
    
    if($tipo!="RECLAMO" && $tipo!="SOLICITUD" && $tipo!="DENUNCIA" && $tipo!="QUEJA") {
        $ret['error'] = 'El parametro tipo solo puede ser RECLAMO, SOLICITUD, DENUNCIA o QUEJA';
    }
    
    if($anio==0) {
        $ret['error'] = 'El parametro anio es invalido';
    }

    if($nro==0) {
        $ret['error'] = 'El parametro nro es invalido';
    }

    $t = new ticket();
    $t->setTipoNroAnio($tipo, $nro, $anio);
    if( $t->load() ) {
        $ret['resultado'] = 'OK';
        $ret['ticket'] = $t;
    }
    else
        $ret['error'] = 'El ticket solicitado no existe';
}

if($metodo=='PUT' && $ret['error']==='') {
    $post_vars = null;
    parse_str(file_get_contents("php://input"),$post_vars);
    $json = $post_vars['payload']; //Payload del post
    $sign = $post_vars['signature']; //Firma

    //Valido json y sign
    $obj = json_decode($json); 
    if(!$obj) {
        $ret['resultado'] = 'El contenido JSON es invalido';
    } else {
        if(isset($obj->object) && $obj->object=='ingreso_ticket' ) {
            $ret = ingreso_ticket($obj);
        }

        if(isset($obj->object)  && $obj->object=='cambio_estado_ticket') {
            $ret = actualizo_ticket($tipo,$anio,$nro,$obj);
        }
    }
}

ob_end_clean();

//No es ni GET o PUT
if($ret['resultado']==='ERROR' && $ret['error']==='')
    $ret['error']='metodo no implementado';

if($ret['resultado']!=='OK')
    header('HTTP/1.0 400 Bad Request');
            
echo json_encode($ret);
exit;

/*******************************************************************************/

function consulta_ticket($tipo,$anio,$nro) {
    /* TODO: Escribir consulta a objeto ticket
     */
    $ret = ticket::factoryByIdent($tipo, $nro, $anio);
    return $ret;
}

function ingreso_ticket($ingreso_ticket) {
    $tic = new ticket();
    $tic->fromJSON($ingreso_ticket);
    $tic->save();
    
    $resultado = $tic->getStatus() ? 'OK' : 'ERROR';
    return array(
        'resultado'         => $resultado,
        'error'             => $tic->getErrorString(),
        'tic_identificador' => $tic->tic_identificador
    );
}

function actualizo_ticket($tipo,$anio,$nro,$cambio_estado_ticket) {
    /* TODO: cambiar de estado el ticket
     * 
     */
    $ret = array('resultado' => 'no implementado');
    return $ret;
}

?>
