<?php

include_once "common/cdatatypes.php";
include_once "beans/functions.php";
include_once "beans/georeferencias.php";

class CDH_DIRECCION extends CDataHandler {

    function __construct($parent) {
        parent::__construct($parent);
    }

    /** Procesa la validacion de la direccion
     * 
     * @param string $p objeto direccion en JSON
     * @return string
     */
    function validarDireccion($p) {
        /*
          'cod_calle':calle,
          'nom_calle':calle_nombre,
          'cod_calle2':calle2,
          'nom_calle2':calle2_nombre,
          'altura':altura,
          'gis':0,
          'alternativa':alternativa
         */
        $o = json_decode($p);

        //No tengo el codigo de calle?
        //Convierto calle y altura en latitud y longitud
        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/2.php?wsdl");
        $client_barrio = new SoapClient("http://gis.mardelplata.gob.ar/webservice/zonificacion.php?wsdl");

        if ($o->alternativa == 'NRO') {
            if ($o->cod_calle != '' && $o->altura != '') {
                try {
                    $r = $client->coordenada_calle_altura($o->cod_calle, $o->altura);
                } catch (SoapFault $exception) {
                    error_log("direccion.php coordenada_calle_altura() ->" . $exception);
                    return json_encode(array("resultado" => "error"), JSON_UNESCAPED_UNICODE);
                }

                //Recupero el barrio
                try {
                    $b = $client_barrio->zonificacion_latlong($r->lng, $r->lat, 1);
                    error_log("direccion.php zonificacion_latlong(long={$r->lng},lat={$r->lat},layer=1) ->" . print_r($b, true));
                } catch (SoapFault $exception) {
                    error_log("direccion.php zonificacion_latlong() ->" . $exception);
                    return json_encode(array("resultado" => "error"), JSON_UNESCAPED_UNICODE);
                }
            } else {
                error_log("Falta código de calle/altura! calle={$o->cod_calle} altura={$o->altura}");
                $r->lat = 0;
                $r->lng = 0;
                $b->descripcion = '';
            }
        } else {
            if ($o->cod_calle != '' && $o->cod_calle2 != '') {
                try {
                    $r = $client->coordenada_calle_calle($o->cod_calle, $o->cod_calle2);
                } catch (SoapFault $exception) {
                    error_log("direccion.php coordenada_calle_calle() ->" . $exception);
                    return json_encode(array("resultado" => "error"), JSON_UNESCAPED_UNICODE);
                }


                //Recupero el barrio
                try {
                    $b = $client_barrio->zonificacion_latlong($r->lng, $r->lat, 1);
                    error_log("direccion.php zonificacion_latlong(long={$r->lng},lat={$r->lat},layer=1) ->" . print_r($b, true));
                } catch (SoapFault $exception) {
                    error_log("direccion.php zonificacion_latlong() ->" . $exception);
                    return json_encode(array("resultado" => "error"), JSON_UNESCAPED_UNICODE);
                }
            } else {
                error_log("Faltan códigos de calles! calle={$o->cod_calle} calle2={$o->cod_calle2}");
                $r->lat = 0;
                $r->lng = 0;
                $b->descripcion = '';
            }
        }

        //Es una direccion imposible?
        if ($r->lat == 0 && $r->lng == 0) {
            $resultado = "error";
        } else {
            $resultado = "ok";
        }
        
        $res = array(
            "resultado" => $resultado,
            "latitud" => $r->lat,
            "longitud" => $r->lng,
            "barrio" => $b->descripcion,
            "calle" => $o->nom_calle,
            "cod_calle" => $o->cod_calle,
            "nro" => $o->altura,
            "calle2" => $o->nom_calle2,
            "cod_calle2" => $o->cod_calle2,
        );

        error_log("direccion::validarDireccion() " . print_r($res, true));

        //Hay que consultar las luminarias / semaforos?
        if ($o->gis > 0 && $r->lat != '' && $r->lng != '') {
            try {
                $distanciamaxima = 100;
                $cantidadmaxima = 100;
                $tipodesolicitud = $o->gis;
                $e = $client->elementos_fijos($tipodesolicitud, $r->lat, $r->lng, $distanciamaxima, $cantidadmaxima);

                //error_log("Listado de elementos layer #{$o->gis}: ".print_r($e,true));

                foreach ($e as $lum) {
                    $res['elementos'][] = array(
                        'id' => (int) $lum->id,
                        'lat' => (double) $lum->latitud,
                        'lng' => (double) $lum->longitud,
                        'calle' => $lum->calle,
                        'altura' => $lum->numero,
                        'sit' => $lum->situacion,
                        'com' => $lum->comentario
                    );
                }
            } catch (SoapFault $exception) {
                error_log("direccion.php elementos_fijos() ->" . $exception);
                return json_encode(array("resultado" => "error"), JSON_UNESCAPED_UNICODE);
            }
        }

        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    
    /** Dibuja el formulario en vista de solo lectura
     * 
     * @param cdbdata $cn
     * @param boolean $showlabel
     * @return string 
     */
    function RenderReadOnly($cn, $showlabel = false) {
        $fld = $this->m_parent;
        $html = "";
        $val = html_entity_decode($fld->getValue());
        $name = "m_" . $fld->m_Name;
        $mostrar = "";

        if ($fld->m_IsVisible) {
            $geo = new georeferencias();
            $geo->load($val);
            $mostrar = $geo->generarTextoDireccion();

            if ($showlabel) {
                $html   .="<div id=\"{$fld->m_Name}\" class=\"form-group input-sm\">"
                            . "<label class=\"col-xs-3 control-label\" for=\"{$name}\">{$fld->m_Label}</label>"
                            . "<div class=\"input-group col-xs-9\">"
                                . "<p class=\"form-control-static\" id=\"{$name}\">{$mostrar}</p>"
                            . "</div>"
                        . "</div>" . "\n";
            } else {
                $html.=$mostrar;
            }
        }

        return $html;
    }

    function RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "") {
        return parent::RenderTableEdit($cn, $frmname, $table = "", $row = 0, $ro = false, $name = "", $suffix = "");
    }

    function RenderFilterForm($cn, $name = "", $id = "", $suffix = "") {
        return $this->RenderReadOnly($cn, true);
    }

    function getHelperValue($cn, $val) {
        $geo = new georeferencias();
        $geo->load($val);
        return $geo->generarTextoDireccion(false);
    }

    function listaDePlayas($p) {
        global $primary_db;
        $lista = array();
        $rs = $primary_db->do_execute("select * from geo_lugares where glu_estado='ACTIVO' and glu_geo_tipo='PLAYA' order by glu_nombre");
        while ($row = $primary_db->_fetch_row($rs)) {
            $lista[] = array("playa" => $row["glu_nombre"], "lat" => $row["glu_lat"], "lng" => $row["glu_lng"]);
        }
        return json_encode($lista, JSON_UNESCAPED_UNICODE);
    }

}
