<?php

class organismo {
    public $tor_code; 
    public $tto_figura;
    public $tor_activo; 
    public $tor_description;
            
    function save($parent, $tpr_code) {
        global $primary_db;
        $errores = array();
        
        //Lo asigno a un organismo (tic_ticket_organismos)
        $sql3 = "insert into tic_ticket_organismos (tic_nro, tpr_code, tor_code, tto_figura) 
                    values (:tic_nro:, ':tpr_code:', :tor_code:, ':tto_figura:')";
        $params3 = array(
              'tic_nro'     => $parent->getNro(), 
              'tpr_code'    => $tpr_code, 
              'tor_code'    => $this->tor_code, 
              'tto_figura'  => $this->tto_figura
        );
        $primary_db->do_execute($sql3,$errores,$params3);

    }
    
    
    static function factory($tic_nro, $tpr_code) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_organismos tto 
                    LEFT OUTER JOIN tic_organismos tor ON tto.tor_code=tor.tor_code
                WHERE tto.tic_nro='{$tic_nro}' and tto.tpr_code='{$tpr_code}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            
            $org = new organismo();
            
            $org->tor_code         = $row['tor_code'];
            $org->tto_figura       = $row['tto_figura'];
            $org->tor_activo       = $row['tor_estado']; 
            $org->tor_description  = $row['tor_nombre'];
            
            $ret[] = $org;
        }
        return $ret;
    }

}
?>
