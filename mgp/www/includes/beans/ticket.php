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
    
    
    
      static function addTicket($ticket) {
         global $primary_db;
         $contenido=array();
         $errores=array();
         $ticket =(object)$ticket;
        // todo tpr_code ,tru_code ,ciu_documento , media , ciu_nombre,ciu_apellido,ciu_movil,ciu_email
      //   $existe=$primary_db->QueryString("SELECT count(*) FROM ciu_identificacion  ciu_nro_doc = '" . $sEmisor . " " .$sTipoDoc . " " . $iNumeroDocumento . "'");
      //   if($existe>0)return array("El ciudadano  existe");
         $primary_db->beginTransaction();
         // ingreso la prestacion
         
          $tic_nro = $primary_db->Sequence("tic_tickets");
         
           
           
         
            $ciudadano= new ciudadano;
            $ciudadano->ciu_apellido=$ticket->ciu_apellido;
            $ciudadano->ciu_nombre=$ticket->ciu_nombre;
            $ciudadano->ciu_movil=$ticket->ciu_movil;
            $ciudadano->ciu_movil=$ticket->ciu_email;
            $ciudadano->ciu_documento=$ticket->ciu_documento;
            if(ciudadano::existe($ticket->ciu_documento)){
                 ciudadano::addCiudadano($ciudadano);
            }


              $sql = "insert into tic_ticket(tic_nro,tic_tstamp_in,tic_nota_in,tic_lugar,tic_barrio,tic_cgpc,tic_coordx,tic_coordy,tic_calle_nombre,tic_nro_puerta) " .
                      " values($tic_nro,'$ticket->tic_tstamp_in','$ticket->tic_nota_in','$ticket->tic_lugar','$ticket->tic_barrio','$ticket->tic_cgpc',$ticket->tic_coordx,$ticket->tic_coordy,'$ticket->tic_calle_nombre',$ticket->tic_nro_puerta )";



             $primary_db->do_execute($sql,$errores);
             
           //  die($sql);
          //   $sql = "insert into tic_ticket_prestaciones(tic_nro,tpr_code,tru_code) " .
         //        " values($tic_nro,$ticket->tpr_code,$ticket->tru_code)";
        
         //  $primary_db->do_execute($sql,$errores);
         
           if (count($errores) > 0 )
	    {	
  	      $res[]="MENSAJE: error. $sql";
              $primary_db->rollbackTransaction();
  	      return $res;
	    } 	
            $primary_db->commitTransaction();
             return array($contenido,$errores);

        
    }
    
    static function  factoryByCiudadano($idCiudadano) {
         global $primary_db;
        $sql="select * from tic_ticket t  join tic_ticket_ciudadano ci on t.tic_nro=ci.tic_nro  where ciu_code=$idCiudadano";
        $re = $primary_db->do_execute($sql);
       
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
             $a["prestaciones"]= ticket::getPrestaciones($row["tic_nro"]);
             $a["solicitantes"]= ticket::getSolicitantes($row["tic_nro"]);
             $a["reiteraciones"]= ticket::getReiteraciones($row["tic_nro"]); 
             $a["asociados"]= ticket::getAsociados($row["tic_nro"]);
          //   $a["organismos"]= ticket::getOrganismos($row["tic_nro"]); 
             
             
             return  (object)$a;
        }
        else{
            return array("el ticket no existe");
        }
        $primary_db->_free_result($re);
              
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
                 $a[$key] = $row[$key];   
             }
             $a["prestaciones"]= ticket::getPrestaciones($row["tic_nro"]);
             $a["solicitantes"]= ticket::getSolicitantes($row["tic_nro"]);
             $a["reiteraciones"]= ticket::getReiteraciones($row["tic_nro"]); 
             $a["asociados"]= ticket::getAsociados($row["tic_nro"]);
          //   $a["organismos"]= ticket::getOrganismos($row["tic_nro"]); 
             
             
             return  (object)$a;
        }
        else{
            return array("el ticket no existe");
        }
        $primary_db->_free_result($re);
              
    }
    private static function getCuestionario($id){
      
       //falta la respuestas
        global $primary_db;
        $sql="select  tpr_code ,tpr_preg , ' 'as  tpr_resp from tic_prestaciones_cuest where tpr_code=$id";
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
    
     private static function getPrestaciones($idTicket){
       
       //falta la descripcion
        global $primary_db;
        $sql="select  tpr_code ,'' as tpr_description , tru_code   , ttp_estado   from tic_ticket_prestaciones    where tic_nro=$idTicket";
      
        $re = $primary_db->do_execute($sql);
      
        
        if( $row=$primary_db->_fetch_array($re) )
        {
             $a=array();
             foreach($row as $key => $value)
             {
                if(!is_numeric($key))
                 $a[$key] = $row[$key];   
             }
            
            $a["cuestionario"]=ticket::getCuestionario($row["tpr_code"]);
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
