<?php
include_once 'common/sites.php';
include_once 'beans/ticket.php';
ini_set("error_log", LOG_PATH.'api_tickets.log');
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
$callback = '';

//validacion de la entrada
if($metodo!="GET" && $metodo!="PUT") {
    $ret['error'] = 'Solo se acepta el metodo GET o PUT';
}
    
if($metodo==='GET' && $ret['error']==='') {
    error_log("URL GET = ".$_SERVER['REQUEST_URI']);    
    $p = explode('/', $_SERVER['REQUEST_URI']);
    $tipo = strtoupper($p[4]);      //RECLAMO SOLICITUD DENUNCIA QUEJA           
    $anio = intval($p[5]);          //Año         

    error_log("Metodo GET recibido: ".print_r($p,true));

    //Viene una parte de callback JSONP?
    if(isset($_GET['callback'])) {
        $callback = $_GET['callback'];
        $nro = intval( substr($p[6], 0, strpos($p[6],'?')) );
    } else {
        $nro = intval($p[6]);       //Nro   
    }
    
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

    error_log("Metodo PUT recibido: ".print_r($post_vars,true));
    
    //Valido json y sign
    $obj = json_decode($json); 
    if(!$obj) {
        $ret['resultado'] = 'El contenido JSON es invalido';
    } else {
        if(isset($obj->object) && $obj->object=='ingreso_ticket' ) {
            $ret = ingreso_ticket($obj);
        }

        if(isset($obj->object)  && $obj->object=='cambio_estado_ticket') {
            $p = explode('/', $_SERVER['REQUEST_URI']);
            $tipo = strtoupper($p[4]);  //RECLAMO SOLICITUD DENUNCIA QUEJA           
            $anio = intval($p[5]);      //Año         
            $nro = intval($p[6]);       //Nro   

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
            
if($callback==='')
    echo json_encode($ret);
else
    echo $callback.'('.json_encode($ret).')';

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
    $identificador = $tic->getStatus() ? $tic->tic_identificador : '';
    
    return array(
        'resultado'         => $resultado,
        'error'             => $tic->getErrorString(),
        'tic_identificador' => $identificador
    );
}

function actualizo_ticket($tipo,$anio,$nro,$cambio_estado_ticket) {
    
    $tic = new ticket();
    $identificador = "{$tipo} {$nro}/{$anio}";
    $tic->cambiar_estado_fromJSON($identificador, $cambio_estado_ticket);
    $resultado = $tic->getStatus() ? 'OK' : 'ERROR';
    
    return array(
        'resultado'         => $resultado,
        'error'             => $tic->getErrorString(),
        'tic_identificador' => $tic->tic_identificador
    );
}

?>
