<?php
include_once "beans/functions.php";

class rep4_hooks extends cclass_maint_hooks
{
    public function FilterRow($row) {
        global $primary_db;
        
        $tic_nro = $row['tic_nro'];
        $tpr_code = $row['tpr_code'];
        
        //Se puede hacer la cuenta de tiempo?
        $ttp_estado = $row['ttp_estado'];
        if( $ttp_estado=="resuelto" || $ttp_estado=="cerrado" || $ttp_estado=="rechazado" || $ttp_estado=="rechazado indebido" )
        {           
            //Pido la fecha y hora de inicio 
            $inicio = DateToTimestamp( $row['tic_tstamp_in'] );

            //Pido la fecha y hora de cierre (si el ticket no esta cerrado da null)
            $row1 = $primary_db->QueryArray("select tav_tstamp_in,tic_estado_in from tic_avance where tic_nro={$tic_nro} and tic_estado_in in ('resuelto','cerrado','rechazado','rechazado indebido') order by tav_code;");
            if($row1) {
                $final = DateToTimestamp( $row1['tav_tstamp_in'] );
                $estado = $row1['tic_estado_in'];
            }
            else
            {
                //Medio que es imposible que llegue aca, pero por las dudas...
                $final = time();
                $estado = $ttp_estado;
            }
            $plazo = DateToTimestamp( $row['tic_tstamp_plazo'] );
            
            $lapso = ($final-$inicio);
            $row['tmp_duracion'] = timeToHuman($lapso) . "($estado)";
            $row['tmp_tstamp_out'] = date("Y-m-d H:i:s",$final);
            
            if($final>$plazo) {
                $row['tmp_excedido'] = timeToHuman($final-$plazo);
            }
            else
            {
                $row['tmp_excedido'] = "";
            }
        }
        else
        {
            $row['tmp_duracion'] = "N/A";
        }
        
    	return $row;
    }
    
}