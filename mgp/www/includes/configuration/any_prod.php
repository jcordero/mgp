<?php
include_once "common/cdbdata.php";

//Archivo de configuracion generado automaticamente. No cambiar a mano
$primary_db = new cdbdata("10.80.22.32","call","armada","callgcba","iso-8859-1","mysql");
$reclamos_db = new cdbdata("jorge","sa","armada","gcba2","iso-8859-1","mssql");
$suaci_db = new cdbdata("10.20.1.56","userlect","1s3rl3ct","SAC-TEST","utf-8","postgresql");
$terminales_db = new cdbdata("10.80.22.37","fbouzas","ax024","terminales","iso-8859-1","mysql");
$db_pool = array("primary_db"=>$primary_db, "reclamos_db"=>$reclamos_db,"suaci_db"=>$suaci_db,"terminales_db"=>$terminales_db);

define("LOG_PATH","/plataforma4_sites/call/log/");
define("HOME_PATH","/plataforma4_sites/call/");
define("APP_PATH","/plataforma4/");
define("APP_SHARED","");
define("TITLE","Sistema Call Center");
define("WEB_PATH","/call");
define("DEBUG",true);
define("DEBUG_SIGEHOS",true);

define("NO_YUI",true);
define("SUPERFISH",true);

define("CMD_UPDATE_SITE","ls");
define("CMD_UPDATE_PLATAFORMA","ls");


//define("PROXY_USIG","http://190.247.182.56/call/direcciones/proxyjson.php"); 
//define("PROXY_USIG","http://10.80.16.200/plat/direcciones/proxyjson.php");

//define("URL_SIGEHOS_COPS","http://sigehos-prueba.msgc.gcba");
define("URL_SIGEHOS_COPS","http://sigehos-produccion.msgc.gcba");
//define("URL_SIGEHOS_COPS","http://190.247.182.56");

//Fin de la configuracion
// http://sigehos-produccion.msgc.gcba/sigehos/common/api/efectores-telefonicos/
?>
