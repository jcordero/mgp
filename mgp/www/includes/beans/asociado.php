<?php

class asociado {
    public $tic_identificador;
    public $tta_tstamp;
    public $use_code;
    public $tta_motivo;
    
    function __construct() {
        global $sess;
        $this->tta_tstamp = DatetoISO8601();
        $this->use_code = $sess->getUserId();
    }
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_asociado tta 
                    JOIN tic_ticket tti ON tta.tic_nro_asoc=tti.tic_nro
                WHERE tta.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ticket = new asociado();          
            
            $ticket->tic_identificador  = $row['tic_identificador'];
            $ticket->tta_tstamp         = DatetoISO8601($row['tta_tstamp']);
            $ticket->use_code           = $this->loadOperador($row['use_code']);
            $ticket->tta_motivo         = $row['tta_motivo'];
            
            $ret[] = $ticket;
        }
        return $ret;
    }
    
    
    function save($parent) {
        global $primary_db;
        $errores = array();
        
        //Lo asigno a un organismo (tic_ticket_organismos)
        $sql3 = "insert into tic_ticket_asociado(tic_nro  , tic_nro_asoc    , tta_tstamp, use_code   , tta_motivo   ) 
                                         values (:tic_nro:, ':tic_nro_asoc:', NOW()     ,':use_code:',':tta_motivo:')";
        $params3 = array(
              'tic_nro'     => $parent->getNro(), 
              'tic_nro_asoc'=> $this->tic_identificador, 
              'use_code'    => ( isset($this->use_code) ? $this->use_code->use_code : ''), 
              'tta_motivo'  => $this->tta_motivo
        );
        $primary_db->do_execute($sql3,$errores,$params3);

    }
}
?>
