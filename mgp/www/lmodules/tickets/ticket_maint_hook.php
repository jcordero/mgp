<?php
/** PROCESO UN TICKET 
 * 
 * @author jcordero
 *
 */
include_once 'beans/person_status.php';

include_once 'beans/ticket.php';

class class_tic_ticket_upd_hooks extends cclass_maint_hooks{
	
    public function afterLoadDB() {
        global $primary_db;
        $res = array();
        $obj = $this->m_data;
/*
 * {"tipo":"LUMINARIA",
 * "alternativa":"NRO",
 * "calle_nombre":"25 DE MAYO",
 * "calle":"00657",
 * "callenro":"5011",
 * "barrio":"Sin Barrio",
 * "comuna":"",
 * "lat":"-37.985398535245",
 * "lng":"-57.569807621037",
 * "id_luminaria":"2198",
 * "calle_nombre2":"",
 * "calle2":""}
 * 
 * {"tipo":"DOMICILIO",
 * "alternativa":"NRO",
 * "calle_nombre":"SAN ANTONIO",
 * "calle":"00931",
 * "callenro":"1200",
 * "piso":null,
 * "dpto":null,
 * "nombre_fantasia":"",
 * "barrio":"SAN ANTONIO",
 * "comuna":"",
 * "lat":"-38.0124753541254",
 * "lng":"-57.5946407142533",
 * "calle_nombre2":"",
 * "calle2":""}
 */
        $lugar = "";
        $obj_lugar = json_decode( $obj->getField("tic_lugar")->getValue() );
        if($obj_lugar) {
            if($obj_lugar->alternativa=='CALLE') {
                $lugar.=$obj_lugar->calle_nombre.' cruce con '.$obj_lugar->calle_nombre2;
            } else {
                $lugar.=$obj_lugar->calle_nombre.' '.$obj_lugar->callenro;
            }
            
            if(isset($obj_lugar->piso) && $obj_lugar->piso!=''){
                    $lugar.=" piso: {$obj_lugar->piso}";
            }
            if(isset($obj_lugar->dpto) && $obj_lugar->dpto!=''){
                    $lugar.=" dep: {$obj_lugar->dpto}";
            }
        }
        
        //Nombre del ciudadano
        $ciudadano = "";
        $ciu = ( isset($obj->m_childs['class_tic_ticket_ciudadano'][0]) ? $obj->m_childs['class_tic_ticket_ciudadano'][0] : null);
        if($ciu) {
            $ciu_code = $ciu->getField("ciu_code")->getValue();
            $row = $primary_db->QueryArray("select * from ciu_ciudadanos where ciu_code='{$ciu_code}'");
            $ciudadano = "{$row['ciu_nombres']} {$row['ciu_apellido']}";
        }
        
        //Determino la prestacion
        $desc_prest = "";
        $estado = "";
        $prest = ( isset($obj->m_childs['class_tic_ticket_prestaciones'][0]) ? $obj->m_childs['class_tic_ticket_prestaciones'][0] : null);
        if($prest) {
            $tpr_code = $prest->getField("tpr_code")->getValue();
            $estado = $prest->getField("ttp_estado")->getValue();
            $desc_prest = $primary_db->QueryString("select tpr_detalle from tic_prestaciones where tpr_code='{$tpr_code}'");
        }
        
        //Genero contenido para el mensaje de respuesta.
        $ct = $this->m_context;
        $ct->add_content('ciudadano',$ciudadano);
        $ct->add_content('plazo', $obj->getField("tic_tstamp_plazo")->getValue());
        $ct->add_content('lugar', $lugar);
        $ct->add_content('prestacion', $desc_prest);
        $ct->add_content('estado', $estado);
        
        return $res;
    }
    
}
