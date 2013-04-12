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
    
  
      static function  factoryByIdent($tipo,$nro,$anio) {
         global $primary_db;
        $sql="select * from tic_ticket   where tic_identificador ='$tipo" . " " .$nro . "/$anio'";
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row["tic_nro"];   
             }
             $a["prestaciones"]= ticket::getPrestaciones($row["tic_nro"]);
             $a["solicitantes"]= ticket::getSolicitantes($row["tic_nro"]);
             $a["reiteraciones"]= ticket::getReiteraciones($row["tic_nro"]); 
              $a["asociados"]= ticket::getAsociados($row["tic_nro"]);
             $a["organismos"]= ticket::getOrganismos($row["tic_nro"]); 
             
             
             return  (object)$a;
        }
        else{
            return array("el ticket no existe");
        }
        $primary_db->_free_result($re);
              
    }
    
    
     private static function getPrestaciones($idTicket){
       
       //falta la descripcion
        global $primary_db;
        $sql="select  tpr_code , tpr_description , true_code , ''  as  tru_description  , ttp_estado   tr from tic_ticket_prestaciones_cuest   v join ciu_identificacion ci  on ci.ciu_code= v.ciu_code   where tic_nro=$idTicket";
       
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
            
             
            
             return  (object)$a;
        }
        
    }
    
    
    
    
    private static function getSolicitantes($idTicket){
       
       
        global $primary_db;
        $sql="select ciu_nro_doc as ciu_documentos , ciu_nombres , ciu_apellido , ciu_email ,ciu_tel_fijo as ciu_telefono_fijo,ciu_tel_movil as ciu_telefono_movil from v_ticket_ciu  v join ciu_identificacion ci  on ci.ciu_code= v.ciu_code   where tic_nro=$idTicket";
       
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
            
             
            
             return  (object)$a;
        }
        
    }
    
    
    private static function getReiteraciones($idTicket){
       
       
        global $primary_db;
        $sql="select ciu_nro_doc as ciu_documentos , ciu_nombres , ciu_apellido , ciu_email ,ciu_tel_fijo as ciu_telefono_fijo,ciu_tel_movil as ciu_telefono_movil from v_ticket_reit  v join ciu_identificacion ci  on ci.ciu_code= v.ciu_code   where tic_nro=$idTicket";
       
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
            
             
            
             return  (object)$a;
        }
        
    }
    
    
    private static function getAsociados($idTicket){
       
       
        global $primary_db;
        $sql="select tic_identificador from tic_ticket   t join tic_ticket_asociado  a  on a.tic_nro_asoc= t.tic_nro   where t.tic_nro=$idTicket";
       
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
            
             
            
             return  (object)$a;
        }
        
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
