<?php

class avance {
    private $tav_code;
    public $tav_tstamp_in;
    public $use_code_in;
    public $tic_estado_in;
    public $tav_nota; 
    public $tic_motivo; 
    public $tic_estado_out;
    public $tav_tstamp_out;
    public $use_code_out;
    
    function __construct() {
        $this->tic_estado_in    = 'INICIADO';
        $this->tic_motivo       = 'Ingreso del ticket'; 
        $this->tic_estado_out   = 'INICIADO';
            
    }
    
    function setCode($code) {
        $this->tav_code = $code;
    }
    
    function save($parent, $tpr_code) {
        global $primary_db, $sess;
        $errores = array();
        
        $this->tav_code = $primary_db->Sequence('tic_avance');
        
        //Creo un evento en el historial del ticket (tic_avance)
        $sql4 = "insert into tic_avance (tic_nro, tpr_code, tav_code, tav_tstamp_in, use_code_in, tic_estado_in, tav_nota, tic_motivo, tic_estado_out, tav_tstamp_out, use_code_out) 
                  values (:tic_nro:, ':tpr_code:', :tav_code:, ':tav_tstamp_in:', ':use_code_in:', ':tic_estado_in:', ':tav_nota:', ':tic_motivo:', ':tic_estado_out:', ':tav_tstamp_out:', ':use_code_out:')";
        $params4 = array(
            'tic_nro'         => $parent->getNro(), 
            'tpr_code'        => $tpr_code, 
            'tav_code'        => $this->tav_code, 
            'tav_tstamp_in'   => $this->tav_tstamp_in, 
            'use_code_in'     => $sess->getUserId(), 
            'tic_estado_in'   => $this->tic_estado_in, 
            'tav_nota'        => $this->tav_nota, 
            'tic_motivo'      => $this->tic_motivo, 
            'tic_estado_out'  => $this->tic_estado_out, 
            'tav_tstamp_out'  => $this->tav_tstamp_out, 
            'use_code_out'    => $sess->getUserId()
        );
        $primary_db->do_execute($sql4,$errores,$params4);
    }
    
    static function factory($tic_nro,$tpr_code) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_avance WHERE tic_nro='{$tic_nro}' and tpr_code='{$tpr_code}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $avance = new avance();
            $avance->setCode( $row['tav_code'] );
            $avance->tav_tstamp_in = DatetoISO8601($row['tav_tstamp_in']);
            $avance->use_code_in   = loadOperador($row['use_code_in']);
            $avance->tic_estado_in = $row['tic_estado_in'];
            $avance->tav_nota      = $row['tav_nota'];
            $avance->tic_motivo    = $row['tic_motivo'];
            $avance->tic_estado_out= $row['tic_estado_out'];
            $avance->tav_tstamp_out= DatetoISO8601($row['tav_tstamp_out']);
            $avance->use_code_out  = loadOperador($row['use_code_out']);
            $ret[] = $avance;
        }
        return $ret;
    }

}
?>
