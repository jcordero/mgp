<?php

class ciudadano {
    
    public $ciu_code;
    public $ciu_nombres;
    public $ciu_apellido;
    public  $ciu_sexo;
    public $ciu_nacimiento;
    public $ciu_email;
    public $ciu_tel_fijo;
    public $ciu_tel_movil;
    public $ciu_horario_cont;
    public $ciu_no_llamar;
    public $ciu_no_email;
    public $ciu_dir_calle;
    public $ciu_dir_nro;
    public $ciu_dir_piso;
    public $ciu_dir_dpto;
    public $ciu_barrio;
    public $ciu_localidad;
    public $ciu_provincia;
    public $ciu_pais;
    public $ciu_cod_postal;
    public $ciu_cgpc;
    public $ciu_coord_x;
    public $ciu_coord_y;
    public $ciu_trabaja;
    public $ciu_nivel_estudio;
    public $ciu_profesion;
    public $ciu_ultimo_acceso;
    public $ciu_canal_ingreso;
    public $use_code;
    public $ciu_estado;
    public $ciu_tstamp;
    public $ciu_tipo_persona;
    public $ciu_razon_social;
    public $ciu_nacionalidad;
    public $documentos;
    public $eventos;
    public $tickets;
    public $reiteraciones;
  

    function __construct() {
        $this->documentos = array();
        $this->eventos = array();
        $this->reiteraciones = array();
        $this->tickets = array();
       
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
