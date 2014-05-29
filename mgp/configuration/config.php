<?php
include_once "common/cdbdata.php";

//Archivo de configuracion generado automaticamente. No cambiar a mano
$primary_db = new cdbdata("localhost","root","armada","mgp","utf-8","mysql");
$padron_db = new cdbdata("localhost","root","armada","padron_2013","utf-8","mysql");
$db_pool = array("primary_db"=>$primary_db, "padron_db"=>$padron_db);

//define("LOG_PATH",	"/Users/jcordero/plataforma4_sites/mgp_git/mgp/log/");
define("HOME_PATH",	"/Users/jcordero/plataforma4_sites/mgp_git/mgp/");
define("APP_PATH",	"/Users/jcordero/plataforma4/Plataforma4/");

define("APP_SHARED","");
define("TITLE",	   "Sistema Call Center");
define("WEB_PATH", "/mgp");
define('HOSTNAME', "mgp");

define("JQUERY_LIB",true);
define("JQUERY_UI_LIB",true);
define("KENDO_LIB",	true);
define("KENDO_MENU_LIB",true);

define("CMD_UPDATE_SITE","ls");
define("CMD_UPDATE_PLATAFORMA","ls");

define("PHP_CMD","/usr/bin/php -c /opt/local/etc/php54/php.ini -d include_path=.:/Users/jcordero/plataforma4/Plataforma4/includes:/Users/jcordero/plataforma4_sites/mgp_git/mgp/www/includes");

define("MICIUDAD_RUBRO",325);
define("DEBUG",		true);
define("DEFAULT_SMTP",1);

define("DEBUG_EMAIL","jorge.cordero@commsys.com.ar");