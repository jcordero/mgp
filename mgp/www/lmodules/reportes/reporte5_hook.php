<?php
include_once "beans/functions.php";

class rep5_hooks extends cclass_maint_hooks
{
    public function FilterRow($row) {
        global $primary_db;
        
        $tpr_code = $row['tpr_code'];
        $tmp_fecha = $row['tmp_fecha'];
        error_log("fila: ".print_r($row,true));
        
        $acc_lapso = 0;
        $cant = 0;
        $valores = array();
        $sql = "select tic_nro,tav_tstamp_in from tic_avance where tpr_code like '{$tpr_code}%' and tic_estado_in='pendiente'";
        
        if($tmp_fecha!="") {
            error_log("rango: ".$tmp_fecha);
        }
        
        //Buscar para la fecha los tiempos medios de todos los tickets de la prestacion
        $rs = $primary_db->do_execute($sql);
        while( $row2=$primary_db->_fetch_row($rs) ) {
            //Existe el evento de cierre de este ticket?
            $tic_nro = $row2['tic_nro'];
            
            //Pido la fecha y hora de cierre (si el ticket no esta cerrado da null)
            $row1 = $primary_db->QueryArray("select tav_tstamp_in from tic_avance where tic_nro={$tic_nro} and tic_estado_in in ('resuelto','cerrado','rechazado','rechazado indebido') order by tav_code;");
            if($row1) {
                $inicio = DateToTimestamp( $row2['tav_tstamp_in'] );
                $final = DateToTimestamp( $row1['tav_tstamp_in'] );
                $lapso = ($final-$inicio);
                $valores[] = $lapso;
                $acc_lapso+=$lapso;
                $cant++;
            }
        }
        
        if($cant>0) {            
            $row['tmp_media'] = timeToHuman($acc_lapso/$cant);
            $row['tmp_min'] = timeToHuman(min($valores));
            $row['tmp_max'] = timeToHuman(max($valores));
            $row['tmp_stddev'] = timeToHuman($this->standard_deviation($valores));
            $row['tmp_cant'] = $cant;
            
        } else {
            $row['tmp_media'] = "N/A";
            $row['tmp_min'] = "N/A";
            $row['tmp_max'] = "N/A";
            $row['tmp_stddev'] = "N/A";
            $row['tmp_cant'] = "N/A";
        }
                
    	return $row;
    }
    
   
    
}