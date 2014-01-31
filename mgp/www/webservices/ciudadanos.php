<?php
include_once 'common/sites.php';
include_once 'beans/ticket.php';
include_once 'beans/ciudadano.php';

ini_set("error_log", LOG_PATH.'api_ciudadanos.log');
error_log("\n------------------ INICIO PROCESO API -----------------------\n");

/**
 * Consulta de ciudadano
 * Metodo: GET /mgp/webservices/ciudadano/<pais>/<doc>/<nro>
 * 
 * Consulta de eventos de un ciudadano
 * Metodo: GET /mgp/webservices/ciudadano/<pais>/<doc>/<nro>/eventos
 * 
 * Consulta de tickets de un ciudadano
 * Metodo: GET /mgp/webservices/ciudadano/<pais>/<doc>/<nro>/tickets
 * 
 */
$ret['resultado'] = 'ERROR';
$ret['error'] = '';
$metodo = $_SERVER['REQUEST_METHOD'];   // GET, PUT 
$callback = '';

//validacion de la entrada
if($metodo!="GET") {
    $ret['error'] = 'Solo se acepta el metodo GET';
}
    
if($metodo==='GET' && $ret['error']==='') {
    error_log("URL GET = ".$_SERVER['REQUEST_URI']);    
    $p = explode('/', $_SERVER['REQUEST_URI']);
    $pais       = (isset($p[4]) ? strtoupper($p[4])    : '');  //Pais           
    $doc        = (isset($p[5]) ? strtoupper($p[5])    : '');  //Tipo doc         
    $nro        = (isset($p[6]) ? intval($p[6])        : 0);   //Nro doc   
    $det        = (isset($p[7]) ? strtoupper($p[7])    : 'BASICO');  //Info detallada "BASICO" y "DETALLES"           
    
    if(isset($_GET['callback']))
        $callback = $_GET['callback'];
    
    if( strlen($pais)!=3 )
        $ret['error'] = 'El parametro pais debe ser el codigo ISO 3 letras';
    
    if($doc!="DNI" && $doc!="CI" && $doc!="LC" && $doc!="LE" && $doc!="PASAPORTE" && $doc!="PRECARIA" ) {
        $ret['error'] = 'El parametro tipo de docuento solo puede ser DNI,CI,LC,LE,PASAPORTE o PRECARIA';
    }
    
    if($nro==0) {
        $ret['error'] = 'El parametro Nro de Documento es invalido';
    }
    
    //Limpio la porqueria del string detalle
    $d = explode('?',$det);
    $detalle = $d[0];
    
    $c = new ciudadano();
    $id = "$pais $doc $nro";
    $ciu_code = $c->existe($id);
    if( $ciu_code==0 ){
        $ret['error'] = 'El ciudadano solicitado no existe';
        error_log("Se solicita ciudadano $id que no existe");
    } else {
        $c->ciu_code = $ciu_code;
        $c->load('',$detalle);

        //Quito los datos confidenciales
        $c->ciu_email = '...';
        $c->ciu_tel_fijo = '...';
        $c->ciu_tel_movil = '...';

        $ret['resultado'] = 'OK';
        $ret['ciudadano'] = $c;           
    }            
}

ob_end_clean();

if($ret['resultado']!=='OK')
    header('HTTP/1.0 400 Bad Request');
            
if($callback==='')
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
else
    echo $callback.'('.json_encode($ret,JSON_UNESCAPED_UNICODE).')';

exit;

