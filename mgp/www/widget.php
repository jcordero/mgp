<?php
define("SESSION_UPDATE",false);
include_once "common/sites.php";
include_once "common/ccontext.php";

$q = filter_input(INPUT_SERVER,"QUERY_STRING",FILTER_SANITIZE_URL);
$context = new ccontext();

//Hay una sesion activa
//error_log("widget.php session=".print_r($_SESSION,true));
if(!$sess->isActive()){
    error_log("widget.php acceso a widget sin sesion activa. ($q)");
    exit();
}

//como es la clase?
$c = explode("?",$q); //separo path de query string
$p = explode("/",$c[0]);
$clase = array_pop($p);

//Existe el archivo? (el replace es para evitar que pongan ../../)
$arch = HOME_PATH."www/widgets".str_replace(".", "", $q).".php";
if(file_exists($arch)) {
    include $arch;
    if(class_exists($clase)) {
        $obj = new $clase();
        if(isset($c[1])) {
            $context->set_params(explode("&",$c[1]),$clase);
        }
        $obj->render($context);
        ob_end_clean();
        echo $context->m_content["html"];
    }
}