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

    /**
     * 
     * @global type $primary_db
     * @param type $ticket_json
     * @param type $ticket
     * @param type $prestacion
     * @return \cuestionario
     */
    static function factoryJSON($ticket_json,$ticket,$prestacion) {
        global $primary_db;
        $res = array();
        
        if(isset($ticket_json->ttp_cuestionario)) {
            foreach( $ticket_json->ttp_cuestionario as $preg ) {
                $cuest = new cuestionario();

                //Busco la pregunta loca segun el identificador de miciudad
                $row = $primary_db->QueryArray("select * from tic_prestaciones_cuest where tpr_miciudad='{$preg->tpr_miciudad}' and tpr_code='{$prestacion->tpr_code}'");
                if($row) {
                    $cuest->tcu_code = $row['tcu_code'];
                    $cuest->tpr_miciudad = $preg->tpr_miciudad;
                    $cuest->tpr_preg = $row['tpr_preg'];
                    $cuest->tpr_tipo_preg = $row['tpr_tipo_preg'];
                    
                    if($row['tpr_tipo_preg']=='CHECKBOX')
                        $respuesta = ($preg->tpr_respuesta==1 ? 'SI' : 'NO');
                    else 
                        $respuesta = $preg->tpr_respuesta;
                        
                    
                    $cuest->tpr_respuesta = $respuesta;       
                    $res[] = $cuest;
                }
                else
                {
                    //El atributo extendido de miCiudad no se encuentra
                    $ticket->addError("El atributo {$preg->tpr_miciudad} no se encuentra en el sistema.");
                }
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
    
    
    /**
     * Cargo el cuestionario desde la UI
     * 
     * @global type $primary_db
     * @param type $obj
     * @param type $p
     * @return \cuestionario
     */
    static function fromForm($obj, $p) {
        global $primary_db;
        $pregs = array();
        
        //Busco las preguntas del cuestionario que correponde a la prestación
        $rs = $primary_db->do_execute("select * from tic_prestaciones_cuest where tpr_code='{$p->tpr_code}'");
        while( $row = $primary_db->_fetch_row($rs) ) {
            $c = new cuestionario();
            $c->tcu_code = $row['tcu_code'];
            $c->tpr_miciudad = $row['tpr_miciudad'];
            $c->tpr_preg = $row['tpr_preg'];
            $c->tpr_respuesta = $_POST['cuest_'.$c->tcu_code];
            $c->tpr_tipo_preg = $row['tpr_tipo_preg'];        
        
            $pregs[] = $c;
        }
        
        return $pregs;
    }
}
?>
