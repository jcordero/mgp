<?php

include_once 'beans/avance.php';
include_once 'beans/organismo.php';
include_once 'beans/cuestionario.php';

class prestacion {
    public $tpr_code; 
    public $tpr_description;
    public $tru_code; 
    public $tru_description;
    public $ttp_estado; 
    public $ttp_prioridad; 
    public $ttp_tstamp_plazo; 
    public $ttp_alerta;

    public $cuestionario; 
    public $avance;
    public $organismos;
    
    private $plazo;
    private $plazo_unit;
    
    function __construct() {
        $this->cuestionario = array(); 
        $this->avance = array();
        $this->organismos = array();       
        $this->ttp_alerta = 0;
        $this->ttp_prioridad = '1.1';
        $this->plazo = 10;
        $this->plazo_unit = 'DAY';
    }
    
    function getPlazo() {
        return $this->plazo;
    }

    function getPlazoUnit() {
        return $this->plazo_unit;
    }

    function getLastAvance() {
        return $this->avance[ count($this->avance)-1 ];
    }
    
    function save($parent) {
        global $primary_db;
        $errores = array();
          
        //Creo una prestacion (tic_ticket_prestaciones)
        $sql2 = "insert into tic_ticket_prestaciones (tic_nro  , tpr_code    , tru_code  , ttp_estado, ttp_prioridad    , ttp_tstamp_plazo                     , ttp_alerta) 
                                              values (:tic_nro:, ':tpr_code:', :tru_code:, 'INICIADO', ':ttp_prioridad:', NOW() + INTERVAL :plazo: :plazo_unit:, ':ttp_alerta:')";
        $params2 = array(
            'tic_nro'             => $parent->getNro(), 
            'tpr_code'            => $this->tpr_code, 
            'tru_code'            => ($this->tru_code!=='' ? $this->tru_code : 'null'), 
            'ttp_prioridad'       => $this->ttp_prioridad, 
            'plazo'               => $this->plazo,
            'plazo_unit'          => $this->plazo_unit,
            'ttp_alerta'          => $this->ttp_alerta
        );
        $primary_db->do_execute($sql2,$errores,$params2);
                
        //Le creo un primer registro de avance
        foreach($this->avance as $av)
            $av->save($parent, $this->tpr_code);
         
        //Salvo los organismos
        foreach($this->organismos as $org)
            $org->save($parent, $this->tpr_code);

        //Salvo el cuestionario
        foreach($this->cuestionario as $preg)
            $preg->save($parent, $this->tpr_code);
    }
    
    
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_prestaciones ttp 
                    LEFT OUTER JOIN tic_prestaciones tpr ON ttp.tpr_code=tpr.tpr_code
                    LEFT OUTER JOIN tic_rubros tru ON ttp.tru_code=tru.tru_code    
                WHERE ttp.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $prest = new prestacion();
            
            $prest->tpr_code          = $row['tpr_code'];
            $prest->tpr_description   = $row['tpr_detalle'];
            $prest->tru_code          = $row['tru_code'];
            $prest->tru_description   = $row['tru_detalle'];
            $prest->ttp_estado        = $row['ttp_estado'];
            $prest->ttp_prioridad     = $row['ttp_prioridad'];
            $prest->ttp_tstamp_plazo  = DatetoISO8601($row['ttp_tstamp_plazo']); 
            $prest->ttp_alerta        = $row['ttp_alerta'];
            $prest->avance            = avance::factory($tic_nro, $row['tpr_code']);
            $prest->organismos        = organismo::factory($tic_nro, $row['tpr_code']);
            $prest->cuestionario      = cuestionario::factory($tic_nro, $row['tpr_code']); 
            
            $ret[] = $prest;
        }
        return $ret;
    }

    /**
     * Cargo una prestacion desde el ticket que viene de la API de MiCiudad
     * @param type $ticket
     */
    function fromJSON($ticket) {
        global $primary_db;
        
        $this->tpr_code    = _g($ticket,'tpr_code');
        $this->tru_code    = _g($ticket,'tru_code'); 
        $this->tpr_description = $primary_db->QueryString("select tpr_detalle from tic_prestaciones where tpr_code='{$this->tpr_code}'");
        $this->tru_description = ($this->tru_code!=='' ? $primary_db->QueryString("select tru_detalle from tic_rubros where tru_code='{$this->tru_code}'") : '');
                
        if(isset($ticket->ttp_cuestionario)) {
            foreach( $ticket->ttp_cuestionario as $pr ) {
                $cuest = new cuestionario(); 
                $cuest->fromJSON($pr);
                $this->cuestionario[] = $cuest;                
            }
        }

        //Cargo los valores por defecto
        $avance = new avance();
        $avance->tav_nota = _g($ticket,'tic_nota_in');
        $avance->tav_tstamp_in = DatetoISO8601();
        $avance->tic_estado_in = 'pendiente';
        $avance->tic_motivo = 'Ingreso desde movil';
        $avance->use_code_in = loadOperador();
        $this->avance[] = $avance;
        
        //Hay que determinar que roles hay que levantar desde la definicion del GIS de prestaciones.
        
        //PRESTADOR
        $org = new organismo();
        $org->tor_activo = 'ACTIVO';
        $org->tor_code = 1;
        $org->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$org->tor_code}'");
        $org->tto_figura = 'PRESTADOR';        
        $this->organismos[] = $org;

        //RESPONSABLE
        $org = new organismo();
        $org->tor_activo = 'ACTIVO';
        $org->tor_code = 1;
        $org->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$org->tor_code}'");
        $org->tto_figura = 'RESPONSABLE';        
        $this->organismos[] = $org;
    }
    
    
    function cambiar_estado($parent, $nuevo_estado,$nota) {
        global $primary_db;
        $errores = array();
        
        //Ajusto el ultimo avance
        $ult_avance = $this->avance[ count($this->avance)-1 ];
        $ult_avance->tav_tstamp_out = DatetoISO8601(); 
        $ult_avance->tic_estado_out = $nuevo_estado;
        $ult_avance->use_code_out = loadOperador('current');        
        $ult_avance->update($parent, $this->tpr_code);
                
        //Agrego un avance nuevo al stack
        $avance = new avance();
        $avance->tav_nota = $nota;
        $avance->tav_tstamp_in = DatetoISO8601();
        $avance->tic_estado_in = $nuevo_estado;
        $avance->tic_motivo = 'Cambio de estado';
        $avance->use_code_in = loadOperador('current');
        $this->avance[] = $avance;
        $avance->save($parent, $this->tpr_code);
        
        //Cambio el estado a la prestacion
        $this->ttp_estado = $nuevo_estado;
        
        //Salvo el cambio a la base
        $sql2 = "update tic_ticket_prestaciones set ttp_estado=':ttp_estado:' WHERE tic_nro=:tic_nro: AND tpr_code=':tpr_code:'";
        $params2 = array(
            'tic_nro'             => $parent->getNro(), 
            'tpr_code'            => $this->tpr_code, 
            'ttp_estado'          => $nuevo_estado
        );
        $primary_db->do_execute($sql2,$errores,$params2);   
    }
}
?>
