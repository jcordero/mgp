<?php
include_once 'common/sites.php';
global $primary_db;

ini_set("error_log", LOG_PATH.'api_maestro.log');
error_log("\n------------------ INICIO PROCESO API -----------------------\n");

/**
 * Consulta de maestros
 * Metodo: GET /mgp/webservices/maestro/<nombre del maestro>
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
    $maestro = (isset($p[4]) ? strtoupper($p[4])    : '');  //Maestro           
    
    //Viene una parte de callback JSONP?
    if(isset($_GET['callback'])) {
        $callback = $_GET['callback'];
        $maestro = substr($maestro, 0, strpos($maestro,'?'));
    }
        
    if($maestro!="PAISES" ) {
        $ret['error'] = 'El parametro maestro solo puede ser PAISES';
    }
    
    switch($maestro) {
        case 'PAISES':
            $rs = $primary_db->do_execute("SELECT cpa_code, cpa_descripcion FROM ciu_paises ORDER BY 2");
            while( $row=$primary_db->_fetch_row($rs) ) {
                $ret['maestro'][] = array("cod"=>$row['cpa_code'], "nombre"=>$row['cpa_descripcion']);
            }
            $ret['resultado'] = 'OK';
            break;
    }
}

ob_end_clean();

if($ret['resultado']!=='OK')
    header('HTTP/1.0 400 Bad Request');

if($callback==='')
    echo json_encode($ret);
else
    echo $callback.'('.json_encode($ret).')';

exit;

