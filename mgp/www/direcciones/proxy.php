<?php
//Proxy para los web services dela USIG
header("Content type: text/json");
ini_set("error_log","c:\plataforma4\log\proxy_usig.log");

//Recupero pedido
$method = (isset($_REQUEST['method']) ? $_REQUEST['method'] : "");
$p1 = (isset($_REQUEST['p1']) ? $_REQUEST['p1'] : "");
$p2 = (isset($_REQUEST['p2']) ? $_REQUEST['p2'] : "");
$p3 = (isset($_REQUEST['p3']) ? $_REQUEST['p3'] : "");
$jsonp = (isset($_REQUEST['jsonp']) ? $_REQUEST['jsonp'] : "");
$client = new SoapClient("usig.wsdl",array("trace" => 1));
$json = "";

if($method=="delimitacionesDisponibles")
{
	try 
	{ 
		$json = json_encode($client->delimitacionesDisponibles()); 
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
		$json = json_encode($client->geoCodificarPorCodigoCalleAltura($p1,$p2)); 
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
		$json = json_encode($client->geoCodificarPor2CodigosDeCalle($p1,$p2)); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php geoCodificarPor2CodigosDeCalle() ->".$exception );       
	} 
}
else if($method=="consultarDelimitaciones")
{
	try 
	{ 
		//  X, Y,delimitaciones
		$json = json_encode($client->consultarDelimitaciones($p1,$p2,$p3)); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php consultarDelimitaciones() ->".$exception );       
	} 
}
else if($method=="normalizarCalleAltura")
{
	try 
	{ 
		$json = json_encode($client->normalizarCalleAltura($p1,$p2)); 
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
		$json = json_encode($client->consultarDelimitacionesPorDireccion($p1,$p2,$p3)); 
	} 
	catch (SoapFault $exception) 
	{ 
		error_log( "proxy.php consultarDelimitacionesPorDireccion() ->".$exception );       
	} 
}




echo $jsonp."(".$json.")";
?>