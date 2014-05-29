<?php
include_once 'beans/ticket.php';
include_once 'beans/prestacion.php';
include_once 'beans/georeferencias.php';

class cambio_estado_mgp {
    public $signature;  //  signature (como aparece en el instructivo)
    public $tic_identificador; //  tic_identificador
    public $tipo_ticket;  //  literal "ALUMBRADO", "BASURA" o "SEMAFORO"
    public $estado_actual;  //  ttp_estado (de la prestación del ticket)
    public $fecha_hora;  //  tav_tstamp_in del ultimo cambio de estado
    public $documento;  //  ciu_documento del solicitante
    public $apynom;   //  cadena en formato "ciu_apellido, ciu_nombres" del solicitante
    public $tel_movil;  //  obligatorio ciu_telefono_movil del solicitante
    public $tel_fijo;  //  ciu_telefono_fijo del solicitante
    public $email;   //  ciu_email del solicitante
    public $desc_prestacion; //  tpr_description o tpr_description_full de la prestación
    public $desc_ubicacion;  //  descripcion de la ubicacion del reclamo, usando calle, callenro, barrio, etc. de lugar del reclamo
    public $notas;   //  tav_nota o similar con respecto al cambio de estado
    
    private $tpr_code;
    /**
     * 
     * @param ticket $t
     */
    function loadFromTicket(ticket $t) {
        
        $this->signature;  //  signature (como aparece en el instructivo)
        $this->tic_identificador = $t->tic_identificador; //  tic_identificador
        $this->tipo_ticket = $this->determinarClaseTicket($t->getNro());  //  literal "ALUMBRADO", "BASURA" o "SEMAFORO"
        
        if(isset($t->prestaciones[0])) {
            $this->desc_prestacion  = $t->prestaciones[0]->tpr_description_full; //  tpr_description o tpr_description_full de la prestación
   
            $avance = $t->prestaciones[0]->getLastAvance();
            if($avance) {
                $this->estado_actual    = $avance->tic_estado_in ;  //  ttp_estado (de la prestación del ticket)
                $this->fecha_hora       = $avance->tav_tstamp_in;  //  tav_tstamp_in del ultimo cambio de estado
                $this->notas            = $avance->tav_nota;   //  tav_nota o similar con respecto al cambio de estado
            } else {
                $this->estado_actual    = "";  //  ttp_estado (de la prestación del ticket)
                $this->fecha_hora       = "";  //  tav_tstamp_in del ultimo cambio de estado
                $this->notas            = "";   //  tav_nota o similar con respecto al cambio de estado
            }
        }
        
        if(isset($t->solicitantes[0])) {
            $pers = $t->solicitantes[0];
            $this->documento        = $pers->ciu_documento;  //  ciu_documento del solicitante
            $this->apynom           = $pers->ciu_apellido." ".$pers->ciu_nombres;   //  cadena en formato "ciu_apellido, ciu_nombres" del solicitante
            $this->tel_movil        = $pers->ciu_telefono_movil;  //  obligatorio ciu_telefono_movil del solicitante
            $this->tel_fijo         = $pers->ciu_telefono_fijo;  //  ciu_telefono_fijo del solicitante
            $this->email            = $pers->ciu_email;   //  ciu_email del solicitante
        } else {
            $this->documento    = "";
            $this->apynom       = "";   //  cadena en formato "ciu_apellido, ciu_nombres" del solicitante
            $this->tel_movil    = "";  //  obligatorio ciu_telefono_movil del solicitante
            $this->tel_fijo     = "";  //  ciu_telefono_fijo del solicitante
            $this->email        = "";   //  ciu_email del solicitante
        }
        
        $this->desc_ubicacion   = $t->generarTextoDireccion();  //  descripcion de la ubicacion del reclamo, usando calle, callenro, barrio, etc. de lugar del reclamo 
    }
    
    private function determinarClaseTicket($tic_nro) {
        global $primary_db;
        
        //Que prestacion tiene?
        $this->tpr_code = $primary_db->QueryString("select tpr_code from tic_ticket_prestaciones where tic_nro=$tic_nro");
        
        switch( substr($this->tpr_code,0,2) ) {
            case "01":
                return "ALUMBRADO";
            case "03":
                return "BASURA";
            case "04":
                return "SEMAFORO";
            case "07":
                return "VEHICULO";
            case "08":
                return "TRANSPORTE";
            case "09":
                return "BROMATOLOGIA";
            case "10":
                return "INSCRIPCIONES";    
            default:
                return "DESCONOCIDO";
        }
    } 
}