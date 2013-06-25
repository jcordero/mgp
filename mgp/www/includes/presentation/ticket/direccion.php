<?php 
include_once "common/cdatatypes.php";

class CDH_DIRECCION extends CDataHandler 
{
    function __construct($parent) 
    {
        parent::__construct($parent);
    }
	
    function validarDireccion($p) {
        
        /*
            'cod_calle':calle,
            'nom_calle':calle_nombre,        
            'cod_calle2':calle2,
            'nom_calle2':calle2_nombre,
            'altura':altura,
            'luminarias':'SI',
            'alternativa':alternativa
        */
        $o = json_decode($p);

        //No tengo el codigo de calle?
        
       
        //Convierto calle y altura en latitud y longitud
        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/2.php?wsdl");
	$client_barrio = new SoapClient("http://gis.mardelplata.gob.ar/webservice/zonificacion.php?wsdl");
        
        if($o->alternativa=='NRO') {
            if($o->cod_calle!='' && $o->altura!='') {
                try
                {
                    $r = $client->coordenada_calle_altura($o->cod_calle, $o->altura);
                }
                catch (SoapFault $exception)
                {
                    error_log( "direccion.php coordenada_calle_altura() ->".$exception );
                    return json_encode(array("resultado"	=> 	"error"));
                }

                //Recupero el barrio
                try
                {
                    $b = $client_barrio->zonificacion_latlong($r->lng,$r->lat,1);
                    error_log("direccion.php zonificacion_latlong(long={$r->lng},lat={$r->lat},layer=1) ->".print_r($b,true));
                }
                catch (SoapFault $exception)
                {
                    error_log( "direccion.php zonificacion_latlong() ->".$exception );
                    return json_encode(array("resultado"	=> 	"error"));
                }		 
            }
            else
            {
                error_log("Falta código de calle/altura! calle={$o->cod_calle} altura={$o->altura}");
                $r->lat=0;
                $r->lng=0;
                $b->descripcion = '';
            }
        }
        else
        {
            if($o->cod_calle!='' && $o->cod_calle2!='') {
                try
                {
                    $r = $client->coordenada_calle_calle($o->cod_calle, $o->cod_calle2);
                }
                catch (SoapFault $exception)
                {
                    error_log( "direccion.php coordenada_calle_calle() ->".$exception );
                    return json_encode(array("resultado"	=> 	"error"));
                }


                //Recupero el barrio
                try
                {
                    $b = $client_barrio->zonificacion_latlong($r->lng,$r->lat,1);
                    error_log("direccion.php zonificacion_latlong(long={$r->lng},lat={$r->lat},layer=1) ->".print_r($b,true));
                }
                catch (SoapFault $exception)
                {
                    error_log( "direccion.php zonificacion_latlong() ->".$exception );
                    return json_encode(array("resultado"	=> 	"error"));
                }		 
            }
            else
            {
                error_log("Faltan códigos de calles! calle={$o->cod_calle} calle2={$o->cod_calle2}");
                $r->lat=0;
                $r->lng=0;
                $b->descripcion = '';
            }
        }
                
        //Es una direccion imposible?
        if( $r->lat==0 && $r->lng==0 )
            $resultado = "error";
        else
            $resultado = "ok";

        $res = array(
            "resultado"	=> 	$resultado,	
            "latitud" 	=> 	$r->lat,
            "longitud"	=>	$r->lng,
            "barrio"    =>      $b->descripcion,
            "calle"	=>	$o->nom_calle,
            "cod_calle"	=> 	$o->cod_calle,
            "nro"       =>      $o->altura,
            "calle2"    =>      $o->nom_calle2,
            "cod_calle2"=>      $o->cod_calle2,
        );

        error_log("direccion::validarDireccion() ".print_r($res,true));
                
        //Hay que consultar las luminarias?
        if($o->luminarias==='SI' && $r->lat!='' && $r->lng!='') {
            try
            {
                $distanciamaxima = 100;
                $cantidadmaxima = 100;
                $tipodesolicitud = '01';
                $e = $client->elementos_fijos($tipodesolicitud,$r->lat,$r->lng,$distanciamaxima,$cantidadmaxima);

                foreach($e as $lum) {
                    $res['luminarias'][] = array(
                        'id'    => (int) $lum->id,
                        'lat'   => (double) $lum->latitud,
                        'lng'   => (double) $lum->longitud,
                        'calle' => $lum->calle,
                        'altura'=> $lum->numero,
                        'sit'   => $lum->situacion
                    );
                }
            }
            catch (SoapFault $exception)
            {
                error_log( "direccion.php elementos_fijos() ->".$exception );
                return json_encode(array("resultado"	=> 	"error"));
            }   
        }
                
        return json_encode($res);
    }

    
    
    
    function RenderReadOnly($cn,$showlabel=false)
    {
		$fld = $this->m_parent;
		$html="";
		$val = html_entity_decode( $fld->getValue() );
		$name = "m_".$fld->m_Name;
		$mostrar = "";
		
                $id = $name;
                //$hval = str_replace('"', '&#34;', $val);
		//$html.="<input type=\"hidden\" name=\"$name\" id=\"$id\" value=\"$hval\"/>"."\n";

		if($fld->m_IsVisible)
		{    
                    $obj = json_decode($val);
                    if($obj) {
                        if($obj->alternativa=="NRO")
                            $mostrar .= (isset($obj->calle_nombre) && $obj->calle_nombre!='' ? $obj->calle_nombre.' '.$obj->callenro.'<br/>' : '');
                        else
                            $mostrar .= (isset($obj->calle_nombre) && $obj->calle_nombre!='' ? $obj->calle_nombre.' y '.$obj->calle_nombre2.'<br/>' : '');
                        
                        $mostrar .= (isset($obj->piso) && $obj->piso!='' ? 'Piso: '.$obj->piso : ''); 
                        $mostrar .= (isset($obj->dpto) && $obj->dpto!='' ? 'Departamento:'.$obj->dpto.'<br/>' : '');
                        //$mostrar .= (isset($obj->barrio) && $obj->barrio!='' ? 'Barrio: '.$obj->barrio : '');
                    }
            
                    if($showlabel)
                    {
			$html.="<div class=\"itm\"><div class=\"desc\">$fld->m_Label</div><div class=\"fldro\">$mostrar</div></div>"."\n";
                    }
                    else
                    {
                        $html.=$mostrar;
                    }
		}
		
		return $html;
	}
	
	function RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="") 
	{
		return parent::RenderTableEdit($cn,$frmname,$table="",$row=0,$ro=false,$name="",$suffix="");	
	}

	function RenderFilterForm($cn,$name="",$id="",$suffix="") 
	{
		return $this->RenderReadOnly($cn,true);
		//return parent::RenderFilterForm($cn,$name="",$id="",$suffix="");
	}
}
?>