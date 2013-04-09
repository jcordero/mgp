<?php

class ticket {
    public $tic_identificador;
    public $tic_nro_asociado;
    public $tic_tstamp_in;
    public $use_code;
    public $tic_nota_in;
    public $tic_estado;
    public $tic_lugar;
    public $tic_barrio;
    public $tic_cgpc;
    public $tic_coordx;
    public $tic_coordy;
    public $tic_canal;
    public $tic_tstamp_plazo;
    public $tic_tstamp_cierre;
    public $tic_calle_nombre;
    public $tic_nro_puerta;
    public $prestaciones;
    public $solicitantes;
    public $reiteraciones;
    public $asociados;
    public $organismos;

    function __construct() {
        $this->prestaciones = array();
        $this->solicitantes = array();
        $this->reiteraciones = array();
        $this->asociados = array();
        $this->organismos = array();
    }
    
    function load($identificador) {
        
    }
    
    function save() {
        
    }
    
    function toJSON() {
        return json_encode($this);
    }
}


?>
