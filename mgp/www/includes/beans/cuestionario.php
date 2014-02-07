<?php
include_once 'beans/miciudad_crossreference.php';

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
     * @global cdbdata $primary_db
     * @param string $ticket_json
     * @param ticket $ticket
     * @param prestacion $prestacion
     * @return \cuestionario[]
     */
    static function factoryJSON($ticket_json, ticket $ticket,  prestacion $prestacion) {
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
                    
                    if($row['tpr_tipo_preg']=='CHECKBOX') {
                        $respuesta = ($preg->tpr_respuesta==1 ? 'SI' : 'NO');
                    } else { 
                        $respuesta = $preg->tpr_respuesta;
                    }
                    
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
    
    /** Proceso mensaje recibido desde MiCiudad donde son atributos extendidos
     * 
     * @global cdbdata $primary_db
     * @param string $frag
     */
    function fromJSON($frag) {
        global $primary_db;
        
        $this->tpr_miciudad = _g($frag,'tpr_miciudad');
        $this->tpr_respuesta = _g($frag,'tpr_respuesta');
         
        //Usando el codigo unico de MiCiudad se consigue el codigo de pregunta local
        if( $this->tpr_miciudad!=='' ) {
            $row = $primary_db->QueryArray("select * from tic_ticket_cuestionario WHERE tpr_miciudad='{$this->tpr_miciudad}'");
            $this->tcu_code = $row['tcu_code']; //codigo de pregunta local
            $this->tpr_preg = $row['tpr_preg']; //pregunta
            $this->tpr_tipo_preg = $row['tpr_tipo_preg']; //tipo de pregunta        
            
            //Convierto los codigos a texto
            $this->tpr_respuesta = miciudad_crossreference::convertToText($this->tpr_respuesta);
        }
    }
    
    
    /**
     * Cargo el cuestionario desde la UI. Es un metodo factory que retorna un array de objetos "cuestionario"
     * 
     * @global type $primary_db
     * @param prestacion $p
     * @return cuestionario[]
     */
    static function fromForm(prestacion $p) {
        global $primary_db;
        $pregs = array();
        
        
        //Busco las preguntas del cuestionario que correponde a la prestación
        $rs = $primary_db->do_execute("select * from tic_prestaciones_cuest where tpr_code='{$p->tpr_code}'");
        while( $row = $primary_db->_fetch_row($rs) ) {
            
            $r = $_POST['cuest_'.$row['tcu_code']];
            $tipo = $row['tpr_tipo_preg'];
            $respuesta = "";
            
            //Determino la respuesta
            if( is_array($r) ) {
                foreach($r as $opc) {
                    $respuesta.= ($respuesta!="" ? "|" : "").$opc;
                }
            } else {
                if( $tipo=='CHECKBOX' ) {
                    $respuesta = ($r=='on' ? 'SI' : 'NO');
                } else {
                    $respuesta = $r; 
                }
            }
                    
            $c = new cuestionario();
            $c->tcu_code        = $row['tcu_code'];
            $c->tpr_miciudad    = $row['tpr_miciudad'];
            $c->tpr_preg        = $row['tpr_preg'];
            $c->tpr_respuesta   = $respuesta;
            $c->tpr_tipo_preg   = $row['tpr_tipo_preg'];        
        
            $pregs[] = $c;
        }
        
        return $pregs;
    }
}
