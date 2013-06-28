<?php
include_once "common/cdatatypes.php";
include_once "beans/ticket.php";
include_once "beans/functions.php";

class CDH_REPORTES extends CDataHandler {
    function __construct($parent) 
    {
        parent::__construct($parent);
    }
    
    function getTickets($p) {
        global $primary_db;
        $conjunto = array();
        
        $opc = json_decode($p);
      
        $sql = "select tic_coordx,tic_coordy,tic_identificador from tic_ticket tic join tic_ticket_prestaciones tpr on tic.tic_nro=tpr.tic_nro left outer join tic_ticket_organismos tor on tpr.tic_nro=tor.tic_nro and tpr.tpr_code=tor.tpr_code WHERE 1=1 ";
        
        //Prestaciones
        if($opc->prestacion!='')
            $sql.=" and tpr.tpr_code like '{$opc->prestacion}%'";
        
        //Estado
        if($opc->estado_ticket!='')
            $sql.=" and tic_estado='{$opc->estado_ticket}'";

        if($opc->estado_prestacion!='')
            $sql.=" and ttp_estado='{$opc->estado_prestacion}'";

        //Barrio
        if($opc->barrio!='')
            $sql.=" and tic_barrio='{$opc->barrio}'";

        //Canal 
        if($opc->canal!='')
            $sql.=" and tic_canal='{$opc->canal}'";
        
        //Organismo
        if($opc->organismo!='')
            $sql.=" and tor_code='{$opc->organismo}'";
        
        //Fecha desde
        if($opc->fecha_desde!='')
            $sql.=" and tic_tstamp_in > STR_TO_DATE('{$opc->fecha_desde}', '%d/%m/%Y')";
            
            
        //Fecha hasta
        if($opc->fecha_hasta!='')
            $sql.=" and tic_tstamp_in <= STR_TO_DATE('{$opc->fecha_hasta}', '%d/%m/%Y')";
        
        
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $conjunto[] = array(
                'lat'=>$row['tic_coordx'],
                'lng'=>$row['tic_coordy'],
                'id'=>$row['tic_identificador']
            ); 
        }
        
        return json_encode($conjunto);
    }
    
    function getTicketInfo($p) {
        
        $tic = new ticket();
        $tic->setIdent($p);
        if( $tic->load('archivos') ) {
            $pres = $tic->prestaciones[0];
            $h = '<h4>'.$tic->tic_identificador.'</h4>';
            $h.= $pres->tpr_code.' '.$pres->tpr_description.'<br>Estado: '.$tic->tic_estado.' Ingreso: '.ISO8601toDate($tic->tic_tstamp_in).'<br>';
            $h.= 'Nota: '.$tic->tic_nota_in.'<br>';
            
            //Fotos
            foreach($tic->archivos as $f) {
                $h .= '<img class="iwimg" src="'.WEB_PATH.'/webservices/foto/'.$f->doc_storage.'"><br>';
            }
            return $h;
        }
        
        return '';    
    }
    
    function getIndicadores($p) {
        global $primary_db;
        $opc = json_decode($p);
        
        $valores = array();
        $dias = array();
        $sql = "select count(*), DATE(tic_tstamp_in) from tic_ticket tic join tic_ticket_prestaciones tpr on tic.tic_nro=tpr.tic_nro left outer join tic_ticket_organismos tor on tpr.tic_nro=tor.tic_nro and tpr.tpr_code=tor.tpr_code WHERE 1=1 ";
        
        //Prestaciones
        if($opc->prestacion!='')
            $sql.=" and tpr.tpr_code like '{$opc->prestacion}%'";
        
        //Estado
        if($opc->estado_ticket!='')
            $sql.=" and tic_estado='{$opc->estado_ticket}'";

        if($opc->estado_prestacion!='')
            $sql.=" and ttp_estado='{$opc->estado_prestacion}'";

        //Barrio
        if($opc->barrio!='')
            $sql.=" and tic_barrio='{$opc->barrio}'";

        //Canal 
        if($opc->canal!='')
            $sql.=" and tic_canal='{$opc->canal}'";
        
        //Organismo
        if($opc->organismo!='')
            $sql.=" and tor_code='{$opc->organismo}'";
        
        //Fecha desde
        if($opc->fecha_desde!='')
            $sql.=" and tic_tstamp_in > STR_TO_DATE('{$opc->fecha_desde}', '%d/%m/%Y')";
            
            
        //Fecha hasta
        if($opc->fecha_hasta!='')
            $sql.=" and tic_tstamp_in <= STR_TO_DATE('{$opc->fecha_hasta}', '%d/%m/%Y')";
        
        //Orden
        $sql.=" GROUP BY DATE(tic_tstamp_in) ORDER by 2";
        
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $valores[] = (double) $row[0];
            $fecha = explode('-',$row[1]);
            $dias[] = $fecha[2]."/".$fecha[1];
        }

        $r = array(
            'chart' => array(
                'type'          => 'line',
                'marginRight'   =>  130,
                'marginBottom'  =>  25
            ),
            'title' => array(
                'text'  => 'Reporte de indicadores',
                'x'     => -20
            ),
            'subtitle' => array(
                'text'  =>  'Periodo ',
                'x'     =>  -20
            ),
            'xAxis' => array(
                /* DIAS */
                'categories'    => $dias
            ),
            'yAxis' => array(
                'title'     => array(
                    'text'  =>  'Cantidad'
                ),
                'plotlines' => array(
                    array(
                        'value' =>  0,
                        'width' =>  1,
                        'color' =>  '#808080'
                    )
                )
                
            ),
            'tooltip' =>array(
                'valueSuffix'   =>  'x'
            ),
            'legend'    => array(
                'layout'        =>  'vertical',
                'align'         =>  'right',
                'verticalAlign' =>  'top',
                'x'             =>  -10,
                'y'             =>  100,
                'borderWidth'   =>  0
            ),
            'series'    => array(
                array(
                    'name'  => 'tickets',
                    /* Medicion por día */
                    'data'  => $valores
                )
            )
        );
        return json_encode($r);
    } 
    
}