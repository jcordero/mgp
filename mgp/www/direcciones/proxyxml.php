<?php
//Proxy para los web services dela USIG
header("Content type: text/xml");
ini_set("error_log","c:\plataforma4\log\proxy_usig_xml.log");

//Recupero pedido
$method = (isset($_REQUEST['method']) ? $_REQUEST['method'] : "");
$p1 = (isset($_REQUEST['p1']) ? $_REQUEST['p1'] : "");
$p2 = (isset($_REQUEST['p2']) ? $_REQUEST['p2'] : "");
$p3 = (isset($_REQUEST['p3']) ? $_REQUEST['p3'] : "");

$client = new SoapClient("usig.wsdl",array("trace" => 1));
$json = "";

if($method=="delimitacionesDisponibles")
{
	try 
	{ 
		$delimitacionesDisponibles= $client->delimitacionesDisponibles();
		$json = wddx_serialize_vars("delimitacionesDisponibles"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php delimitacionesDisponibles() ->".$exception );       
	} 
}
else if($method=="geoCodificarPorCodigoCalleAltura")
{
	try 
	{ 
		$geoCodificarPorCodigoCalleAltura = $client->geoCodificarPorCodigoCalleAltura($p1,$p2);
		$json = wddx_serialize_vars("geoCodificarPorCodigoCalleAltura"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php geoCodificarPorCodigoCalleAltura() ->".$exception );   
		error_log($client->__getLastRequest());
		error_log($client->__getLastResponse());
	} 
}
else if($method=="geoCodificarPor2CodigosDeCalle")
{
	try 
	{ 
		$geoCodificarPor2CodigosDeCalle = $client->geoCodificarPor2CodigosDeCalle($p1,$p2);
		$json = wddx_serialize_vars("geoCodificarPor2CodigosDeCalle"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php geoCodificarPor2CodigosDeCalle() ->".$exception );       
	} 
}
else if($method=="consultarDelimitacion")
{
	try 
	{ 
		$consultarDelimitacion = $client->consultarDelimitacion($p1,$p2,$p3);
		$json = wddx_serialize_vars("consultarDelimitacion"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php consultarDelimitacion() ->".$exception );       
	} 
}
else if($method=="normalizarCalleAltura")
{
	try 
	{ 
		$normalizarCalleAltura = $client->normalizarCalleAltura($p1,$p2);
		$json = wddx_serialize_vars("normalizarCalleAltura"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php normalizarCalleAltura() ->".$exception );       
	} 
}
else if($method=="consultarDelimitacionesPorDireccion")
{
	try 
	{ 
		$consultarDelimitacionesPorDireccion = $client->consultarDelimitacionesPorDireccion($p1,$p2,$p3);
		$json = wddx_serialize_vars("consultarDelimitacionesPorDireccion"); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php consultarDelimitacionesPorDireccion() ->".$exception );       
	} 
}

error_log("proxyxml method=$method respuesta=$json");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo $json;
?>