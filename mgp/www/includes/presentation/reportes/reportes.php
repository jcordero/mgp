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
        
        $rs = $primary_db->do_execute("select * from tic_ticket");
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
    
}