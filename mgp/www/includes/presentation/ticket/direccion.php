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
        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/2.php?wsdl");
	$client_barrio = new SoapClient("http://gis.mardelplata.gob.ar/webservice/zonificacion.php?wsdl");
        
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
/*
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
 */           
            //Recupero el barrio
            try
            {
                $b = $client_barrio->zonificacion_latlong($r->lat,$r->lng,1);
                error_log("direccion.php zonificacion_latlong() ->".print_r($b,true));
            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php zonificacion_latlong() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }		 
  

        }
        else
        {
            try
            {
                $r = $client->coordenada_calle_calle($calle, $calle2);
            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php coordenada_calle_calle() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }

            //Recupero el barrio
/*            try
            {
                $b = $client->barrio_por_calle_calle($calle, $calle2);
                error_log( "direccion.php barrio_por_calle_calle() ->".print_r($b,true) );
            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php barrio_por_calle_calle() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }
 */
            
            //Recupero el barrio
            try
            {
                $b = $client_barrio->zonificacion_latlong($r->lat,$r->lng,1);
                error_log("direccion.php zonificacion_latlong() ->".print_r($b,true));
            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php zonificacion_latlong() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }		 

        }
                
 		
        //Busco el nombre de la calle posta
        $row1 = $primary_db->QueryArray("select gca_codigo,gca_descripcion from geo_calles where gca_codigo='{$calle}'");

        if($calle2!=='') {
            $row2 = $primary_db->QueryArray("select gca_codigo,gca_descripcion from geo_calles where gca_codigo='{$calle2}'");
            if($row2==null)
                $row2 = array('gca_descripcion'=>'', 'gca_codigo'=>$calle2);
        } else
            $row2 = array('gca_descripcion'=>'', 'gca_codigo'=>0);
                
        //Es una direccion imposible?
        if( $r->lat=="0" && $r->lng=="0" )
            $resultado = "error";
        else
            $resultado = "ok";

        $o = array(
            "resultado"	=> 	$resultado,	
            "latitud" 	=> 	$r->lat,
            "longitud"	=>	$r->lng,
            /*"barrio"	=>	$b->nombrebarrio,*/
            "barrio"    =>      $b->descripcion,
            "calle"	=>	$row1['gca_descripcion'],
            "cod_calle"	=> 	$row1['gca_codigo'],
            "nro"       =>      $altura,
            "calle2"    =>      $row2['gca_descripcion'],
            "cod_calle2"=>      $row2['gca_codigo'],
        );

        error_log("direccion::validarDireccion() ".print_r($o,true));
                
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
                        'calle' => $lum->calle,
                        'altura'=> $lum->numero,
                        'sit'   => $lum->situacion
                    );
                
                //error_log("direccion::validarDireccion() ".print_r($e,true));

            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php elementos_fijos() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }   
        }
                
        return json_encode($o);
    }
}
?>