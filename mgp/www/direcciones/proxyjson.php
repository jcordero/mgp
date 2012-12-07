<?php
//
//Proxy para los web services dela USIG usando AJAX
// Jorge Cordero - jorge.cordero@commsys.com.ar
// 2008
//
include_once 'common/sites.php';
ini_set("error_log",LOG_PATH."proxy_usig_json.log");

//Recupero pedido
$method = (isset($_REQUEST['method']) ? $_REQUEST['method'] : "");
$p1 = (isset($_REQUEST['p1']) ? $_REQUEST['p1'] : "");
$p2 = (isset($_REQUEST['p2']) ? $_REQUEST['p2'] : "");
$p3 = (isset($_REQUEST['p3']) ? $_REQUEST['p3'] : "");
$bustcache = (isset($_REQUEST['bustcache']) ? $_REQUEST['bustcache'] : "");

if( defined("PROXY_USIG") )
{
	header("Content type: text/json");
    $p1 = rawurlencode($p1);
    $p2 = rawurlencode($p2);
    $p3 = rawurlencode($p3);
    $url = PROXY_USIG."?bustcache=$bustcache&method=$method&p2=$p2&p3=$p3&p1=$p1";
    $fc = file_get_contents($url);
    echo str_replace("'","\"",$fc);
    exit();
}

$client = new SoapClient("usig.wsdl",array("trace" => 1));
$xml_return = "";
$obj_return = null;

if($method=="delimitacionesDisponibles")
{
	try 
	{
        //Retorna un array con las opciones
		$obj_return = $client->delimitacionesDisponibles();
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "delimitacionesDisponibles() ->".$exception );       
	} 
}
else if($method=="geoCodificarPorCodigoCalleAltura")
{
	try 
	{ 
		$obj_return = $client->geoCodificarPorCodigoCalleAltura($p1,$p2);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "geoCodificarPorCodigoCalleAltura() ->".$exception );   
		error_log($client->__getLastRequest());
		error_log($client->__getLastResponse());
	} 
}
else if($method=="geoCodificarPor2CodigosDeCalle")
{
	try 
	{ 
		$obj_return = $client->geoCodificarPor2CodigosDeCalle($p1,$p2);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "geoCodificarPor2CodigosDeCalle() ->".$exception );       
	} 
}
else if($method=="consultarDelimitacion")
{
	try 
	{ 
		$obj_return = $client->consultarDelimitacion($p1,$p2,$p3);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "consultarDelimitacion() ->".$exception );       
	} 
}
else if($method=="normalizarCalleAltura")
{
	try 
	{ 
		$obj_return = $client->normalizarCalleAltura($p1,$p2);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "normalizarCalleAltura() ->".$exception );       
	} 
}
else if($method=="consultarDelimitacionesPorDireccion")
{
	try 
	{ 
		$obj_return = $client->consultarDelimitacionesPorDireccion($p1,$p2,$p3);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "consultarDelimitacionesPorDireccion() ->".$exception );       
	} 
}
else if($method=="consultarDelimitaciones")
{
	try 
	{ 
		$obj_return = $client->consultarDelimitaciones($p1,$p2,$p3);
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "consultarDelimitaciones() ->".$exception );       
	} 
}
//--------------- ENVIO LA RESPUESTA AL CLIENTE -----------------------
/*
header("Content type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
$xml_return = wddx_serialize_vars("obj_return"); 
*/
header("Content type: text/json");
$xml_return = json_encode($obj_return);
echo $xml_return;
?>
