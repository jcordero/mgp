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
		
		list($calle,$calle2,$altura,$luminarias,$alternativa) = explode('|',$p);
		
		//Convierto calle y altura en latitud y longitud
		$client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/2.php?wsdl", array("trace"=>1));
		
                if($alternativa=='NRO') {
                    try
                    {
                        $r = $client->coordenada_calle_altura($calle, $altura);
                    }
                    catch (SoapFault $exception)
                    {
                        error_log( "direccion.php coordenada_calle_altura() ->".$exception );
                        return json_encode(array("resultado"	=> 	"error"));
                    }
                }
                else
                {
                    try
                    {
                        $r = $client->coordenada_calle_altura($calle, $calle2);
                    }
                    catch (SoapFault $exception)
                    {
                        error_log( "direccion.php coordenada_calle_altura() ->".$exception );
                        return json_encode(array("resultado"	=> 	"error"));
                    }
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
			"cod_calle"	=> 	$row['gca_codigo'],
                        "nro"           =>      $altura,
                        "calle2"        =>      '',
                        "cod_calle2"    =>      0
		);

                
                //Hay que consultar las luminarias?
                if($luminarias==='SI') {
                    try
                    {
                        $distanciamaxima = 100;
                        $cantidadmaxima = 100;
                        $tipodesolicitud = '01';
                        $e = $client->elementos_fijos($tipodesolicitud,$r->lat,$r->lng,$distanciamaxima,$cantidadmaxima);
                
                        foreach($e as $lum)
                            $o['luminarias'][] = array(
                                'id'    => (int) $lum->id,
                                'lat'   => (double) $lum->latitud,
                                'lng'   => (double) $lum->longitud,
                                'dir'   => $lum->calle.' '.$lum->numero,
                                'sit'   => $lum->situacion
                            );
                    }
                    catch (SoapFault $exception)
                    {
                        error_log( "direccion.php elementos_fijos() ->".$exception );
                        return json_encode(array("resultado"	=> 	"error"));
                    }   
                }
                
		
		error_log('CDH_DIRECCION::validarDireccion '.print_r($o,true));
		return json_encode($o);
	}
}
?>