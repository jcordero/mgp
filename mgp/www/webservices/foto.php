<?php
include_once 'common/sites.php';
$arch = '';
ini_set("error_log", LOG_PATH.'api_web.log');
error_log("\n------------------ INICIO PROCESO API -----------------------\n");

/**
 * Consulta de maestros
 * Metodo: GET /mgp/webservices/maestro/<nombre del maestro>
 * 
 */
$ret['resultado'] = 'ERROR';
$ret['error'] = '';
$metodo = $_SERVER['REQUEST_METHOD'];   // GET, PUT 
$ext = '';

//validacion de la entrada
if($metodo!="GET") {
    $ret['error'] = 'Solo se acepta el metodo GET';
}
    
if($metodo==='GET' && $ret['error']==='') {
    error_log("URL GET = ".$_SERVER['REQUEST_URI']);    
    $p = explode('/', $_SERVER['REQUEST_URI']);
    $foto = (isset($p[4]) ? substr(strtolower($p[4]),0,37)    : '');  //Foto           

    if($foto==='' ) {
        return;
    }
    
    //Busco la foto en la carpeta de documentos
    $ext = pathinfo($arch,PATHINFO_EXTENSION);
    $arch = HOME_PATH.'documents/'.substr($foto,0,2).'/'.substr($foto,2,2).'/'.substr($foto,4,2).'/'.substr($foto,6,2).'/'.substr($foto,8,2).'/'.$foto;
    
}
else {
    exit();
}

if( file_exists($arch) )
{
    //Tipo de archivo?
    if( $ext==='jpg' || $ext==='jpeg' )
        header("Content-Type: image/jpeg"); 
    
    if( $ext==='png' )
        header("Content-Type: image/png"); 
        
    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Disposition: inline"); 
    header("Content-Transfer-Encoding: binary"); 
   
    ob_clean(); 
    flush(); 
    readfile( $arch ); 
} 
else
{
    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Type: image/png"); 
    header("Content-Disposition: inline"); 
    header("Content-Transfer-Encoding: binary"); 
   
    ob_clean(); 
    flush(); 
    readfile( WWW_PATH.'images/default/dialog-warning.png' );
}

