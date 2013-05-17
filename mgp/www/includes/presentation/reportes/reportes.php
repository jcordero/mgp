<?php
include_once "common/cdatatypes.php";

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
    
}