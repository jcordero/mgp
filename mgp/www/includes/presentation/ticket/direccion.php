<?php 
include_once "common/cdatatypes.php";

class CDH_DIRECCION extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	}
	
	function validarDireccion($p) {
		global $primary_db;
		
		list($calle,$altura) = explode('|',$p);
		
		//Convierto calle y altura en latitud y longitud
		$client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/2.php?wsdl", array("trace"=>1));
		try
		{
			$r = $client->coordenada_calle_altura($calle, $altura);
		}
		catch (SoapFault $exception)
		{
			error_log( "direccion.php coordenada_calle_altura() ->".$exception );
			return json_encode(array("resultado"	=> 	"error"));
		}
				
		//Recupero el barrio
		try
		{
			$b = $client->barrio_por_calle_altura($calle, $altura);
		}
		catch (SoapFault $exception)
		{
			error_log( "direccion.php barrio_por_calle_altura() ->".$exception );
			return json_encode(array("resultado"	=> 	"error"));
		}		
		
		//Busco el nombre de la calle posta
		$row = $primary_db->QueryArray("select gca_codigo,gca_descripcion from geo_calles where gca_codigo='{$calle}'");
		
		$o = array(
			"resultado"	=> 	"ok",	
			"latitud" 	=> 	$r->lat,
			"longitud"	=>	$r->lng,
			"barrio"	=>	$b->nombrebarrio,
			"calle"		=>	$row['gca_descripcion'],
			"cod_calle"	=> 	$row['gca_codigo']
		);
		
		error_log('CDH_DIRECCION::validarDireccion '.print_r($o,true));
		return json_encode($o);
	}
}
?>