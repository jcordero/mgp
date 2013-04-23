<?php

class cuestionario {
    public $tcu_code; 
    public $tpr_preg; 
    public $tpr_tipo_preg; 
    public $tpr_respuesta; 
    public $tpr_miciudad;
    
    function __construct() {
        
    }
    
    function save($parent, $tpr_code) {
        global $primary_db;
        $errores = array();
        
        //salvo la pregunta (tic_ticket_cuestionario)
        $sql3 = "insert into tic_ticket_cuestionario (tic_nro  , tpr_code   , tcu_code , tpr_preg   , tpr_tipo_preg   , tpr_respuesta   , tpr_miciudad) 
                                              values (:tic_nro:,':tpr_code:',:tcu_code:,':tpr_preg:',':tpr_tipo_preg:',':tpr_respuesta:',':tpr_miciudad:')";
        $params3 = array(
              'tic_nro'         => $parent->getNro(), 
              'tpr_code'        => $tpr_code, 
              'tcu_code'        => $this->tcu_code, 
              'tpr_preg'        => $this->tpr_preg,
              'tpr_tipo_preg'   => $this->tpr_tipo_preg,
              'tpr_respuesta'   => $this->tpr_respuesta,
              'tpr_miciudad'    => $this->tpr_miciudad
        );
        $primary_db->do_execute($sql3,$errores,$params3);

    }
    
    static function factory($tic_nro_ticket,$tpr_code) {
        if(is_object($tic_nro_ticket))
            return self::factoryJSON ($tic_nro_ticket);
        else 
            return self::factoryDB ($tic_nro_ticket, $tpr_code);
    }
    
    static function factoryJSON($ticket) {
        global $primary_db;
        $res = array();
        
        foreach( $ticket->ttp_cuestionario as $preg ) {
            $cuest = new cuestionario();
            
            //Busco la pregunta loca segun el identificador de miciudad
            $row = $primary_db->QueryArray("select * from tic_prestaciones_cuest where tpr_miciudad='{$preg->tpr_miciudad}'");
            if($row) {
                $cuest->tcu_code = $row['tcu_code'];
                $cuest->tpr_miciudad = $preg->tpr_miciudad;
                $cuest->tpr_preg = $row['tpr_preg'];
                $cuest->tpr_tipo_preg = $row['tpr_tipo_preg'];
                $cuest->tpr_respuesta = $preg->tpr_respuesta;       
                $res[] = $cuest;
            }
        }
        
        return $res;
    }
    
    static function factoryDB($tic_nro,$tpr_code) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_cuestionario WHERE tic_nro='{$tic_nro}' and tpr_code='{$tpr_code}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $cuest = new cuestionario();
            
            $cuest->tcu_code      = $row['tcu_code']; 
            $cuest->tpr_preg      = $row['tpr_preg']; 
            $cuest->tpr_tipo_preg = $row['tpr_tipo_preg']; 
            $cuest->tpr_respuesta = $row['tpr_respuesta']; 
            $cuest->tpr_miciudad  = $row['tpr_miciudad'];                
           
            $ret[] = $cuest;
        }
        return $ret;
    }
    
    
    function fromJSON($frag) {
        global $primary_db;
        
        $this->tpr_miciudad = _g($frag,'tpr_miciudad');
        $this->tpr_respuesta = _g($frag,'tpr_respuesta');
         
        if( $this->tpr_miciudad!=='' ) {
            $row = $primary_db->QueryArray("select * from tic_ticket_cuestionario WHERE tpr_miciudad='{$this->tpr_miciudad}'");
            $this->tcu_code = $row['tcu_code']; 
            $this->tpr_preg = $row['tpr_preg']; 
            $this->tpr_tipo_preg = $row['tpr_tipo_preg'];         
        }
    }

}
?>
