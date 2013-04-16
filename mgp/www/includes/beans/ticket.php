<?php
include_once 'common/cfile.php';
include_once 'beans/ciudadano.php';

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
         global $primary_db,$sess;
         $errores=array();
         
         //Validacion de los datos recibidos. Datos minimos para crear un ticket
         if(!isset($ticket->tic_tipo))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tic_tipo faltante");

         if(!isset($ticket->tic_coordx))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tic_coordx faltante");

         if(!isset($ticket->tic_coordy))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tic_coordy faltante");

         if(!isset($ticket->tic_calle_nombre))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tic_calle_nombre faltante");

         if(!isset($ticket->tic_nro_puerta))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tic_nro faltante");
         
         if(!isset($ticket->tpr_code))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio tpr_code faltante");

         if(!isset($ticket->ciu_documento))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio ciu_documento faltante");

         if(!isset($ticket->ciu_nombre))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio ciu_nombre faltante");
         
         if(!isset($ticket->ciu_apellido))
             return array('tic_nro' => '', 'resultado'=>'ERROR', 'error' => "Campo obligatorio ciu_apellido faltante");

         //Salvo el ticket
         $primary_db->beginTransaction();
         
          //Codigo interno del ticket
          $tic_nro = $primary_db->Sequence("tic_tickets");
          
          //Codigo del ticket publico
          $tic_anio = date("Y"); //Año actual
          $tic_numero = self::generaCodigoTicket($ticket->tic_tipo, $tic_anio);
          $tic_identificador = $ticket->tic_tipo.' '.$tic_numero.'/'.$tic_anio;
           
          //Existe el reportante?
          $ciu_code = ciudadano::existe($ticket->ciu_documento);
          if($ciu_code===0){
            $ciudadano= new ciudadano;
            $ciudadano->ciu_apellido    =$ticket->ciu_apellido;
            $ciudadano->ciu_nombre      =$ticket->ciu_nombre;
            $ciudadano->ciu_movil       =(isset($ticket->ciu_movil) ? $ticket->ciu_movil : '');
            $ciudadano->ciu_movil       =(isset($ticket->ciu_email) ? $ticket->ciu_email : '');
            $ciudadano->ciu_documento   =$ticket->ciu_documento;  
            $ciu_code = $ciudadano->Save();
          }  
          
          //Esta especificada la fecha de ingreso?
          if(!isset($ticket->tic_tstamp_in))
              $ticket->tic_tstamp_in = date('Y-m-d H:i:s');
          else
              $ticket->tic_tstamp_in = self::ISO8601toDate($ticket->tic_tstamp_in);
                            
          //Calculo el plazo de vencimiento
          $plazo = 10;
          $plazo_unit = 'DAY';

          //Nota opcional
          if(!isset($ticket->tic_nota_in))
              $ticket->tic_nota_in = '';
          
          //Ubicacion en JSON
          $lugar = self::createLugar($ticket);
          
          //Salvo el ticket (tic_ticket)
          $sql1 = "insert into tic_ticket (tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador) 
                    values (:tic_nro:, :tic_numero:, :tic_anio:, ':tic_tipo:', ':tic_tstamp_in:', ':use_code:', ':tic_nota_in:', 'ABIERTO', ':tic_lugar:', ':tic_barrio:', ':tic_cgpc:', :tic_coordx:, :tic_coordy:, 0, 0, 'movil', NOW() + INTERVAL :plazo: :plazo_unit:, null, ':tic_calle_nombre:', :tic_nro_puerta:, null, ':tic_identificador:')";
          $params1 = array(
                'tic_nro'           => $tic_nro,
                'tic_numero'        => $tic_numero, 
                'tic_anio'          => $tic_anio, 
                'tic_tipo'          => $ticket->tic_tipo, 
                'tic_tstamp_in'     => $ticket->tic_tstamp_in, 
                'use_code'          => $sess->getUserId(), 
                'tic_nota_in'       => $ticket->tic_nota_in, 
                'tic_lugar'         => $lugar, 
                'tic_barrio'        => (isset($ticket->tic_barrio) ? $ticket->tic_barrio : ''), 
                'tic_cgpc'          => (isset($ticket->tic_cgpc) ? $ticket->tic_cgpc : ''), 
                'tic_coordx'        => $ticket->tic_coordx, 
                'tic_coordy'        => $ticket->tic_coordy, 
                'plazo'             => $plazo, 
                'plazo_unit'        => $plazo_unit, 
                'tic_calle_nombre'  => $ticket->tic_calle_nombre, 
                'tic_nro_puerta'    => $ticket->tic_nro_puerta, 
                'tic_identificador' => $tic_identificador
                );
          $primary_db->do_execute($sql1,$errores,$params1);
         
          //Armo el cuestionario en JSON
          $cuestionario = self::createCuestionario($ticket);
          
          //Prioridad
          $prioridad = '1.1';
                    
          //Creo una prestacion (tic_ticket_prestaciones)
          $sql2 = "insert into tic_ticket_prestaciones (tic_nro, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta) 
                    values (:tic_nro:, ':tpr_code:', :tru_code:, ':ttp_cuestionario:', 'INICIADO', ':ttp_prioridad:', NOW() + INTERVAL :plazo: :plazo_unit:, '0')";
          $params2 = array(
              'tic_nro'             => $tic_nro, 
              'tpr_code'            => $ticket->tpr_code, 
              'tru_code'            => (isset($ticket->tru_code) ? $ticket->tru_code : 'null'), 
              'ttp_cuestionario'    => $cuestionario, 
              'ttp_prioridad'       => $prioridad, 
              'plazo'               => $plazo,
              'plazo_unit'          => $plazo_unit
          );
          $primary_db->do_execute($sql2,$errores,$params2);
         
          //Organismo que atiende el ticket (PRESTADOR)
          $prestador = '1';
          
          //Organismo que atiende el ticket (RESPONSABLE)
          $responsable = '1';
                  
          //Lo asigno a un organismo (tic_ticket_organismos)
          $sql3 = "insert into tic_ticket_organismos (tic_nro, tpr_code, tor_code, tto_figura) 
                    values (:tic_nro:, ':tpr_code:', :tor_code:, ':tto_figura:')";
          $params3 = array(
              'tic_nro'     => $tic_nro, 
              'tpr_code'    => $ticket->tpr_code, 
              'tor_code'    => $prestador, 
              'tto_figura'  => 'PRESTADOR'
          );
          $primary_db->do_execute($sql3,$errores,$params3);
         
          $params3b = array(
              'tic_nro'     => $tic_nro, 
              'tpr_code'    => $ticket->tpr_code, 
              'tor_code'    => $responsable, 
              'tto_figura'  => 'RESPONSABLE'
          );
          $primary_db->do_execute($sql3,$errores,$params3b);
          
          //Creo un evento en el historial del ticket (tic_avance)
          $sql4 = "insert into tic_avance (tic_nro, tpr_code, tav_code, tav_tstamp_in, use_code_in, tic_estado_in, tav_nota, tic_motivo, tic_estado_out, tav_tstamp_out, use_code_out) 
                    values (:tic_nro:, ':tpr_code:', :tav_code:, ':tav_tstamp_in:', ':use_code_in:', ':tic_estado_in:', ':tav_nota:', ':tic_motivo:', ':tic_estado_out:', ':tav_tstamp_out:', ':use_code_out:')";
          $params4 = array(
              'tic_nro'         => $tic_nro, 
              'tpr_code'        => $ticket->tpr_code, 
              'tav_code'        => $primary_db->Sequence('tic_avance'), 
              'tav_tstamp_in'   => $ticket->tic_tstamp_in, 
              'use_code_in'     => $sess->getUserId(), 
              'tic_estado_in'   => 'INICIADO', 
              'tav_nota'        => $ticket->tic_nota_in, 
              'tic_motivo'      => 'Ingreso del ticket', 
              'tic_estado_out'  => 'INICIADO', 
              'tav_tstamp_out'  => $ticket->tic_tstamp_in, 
              'use_code_out'    => $sess->getUserId()
          );
          $primary_db->do_execute($sql4,$errores,$params4);
         
          //Lo asocio al ciudadano que lo reporta (tic_ticket_ciudadano)
          $sql5 = "insert into tic_ticket_ciudadano (tic_nro, ciu_code, ttc_tstamp, ttc_nota) 
                    values (:tic_nro:, :ciu_code:, NOW(), ':ttc_nota:')";
          $params5 = array(
              'tic_nro'     => $tic_nro, 
              'ciu_code'    => $ciu_code, 
              'ttc_nota'    => $ticket->tic_nota_in
          );
          $primary_db->do_execute($sql5,$errores,$params5);
         
          //Creo un evento en el historial del ciudadano (ciu_historial_contactos)
          $sql6 = "insert into ciu_historial_contactos (chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal, chi_nota) 
                    values (:chi_code:, :ciu_code:, null, NOW(), 'Ingreso de ticket', ':use_code:', 'movil', ':chi_nota:')";
          $params6 = array(
              'chi_code'    => $primary_db->Sequence('ciu_historial_contactos'), 
              'ciu_code'    => $ciu_code, 
              'use_code'    => $sess->getUserId(), 
              'chi_nota'    => $ticket->tic_nota_in
          );
          $primary_db->do_execute($sql6,$errores,$params6);
         
          //Mando una foto? La salvo como un adjunto
          if(isset($ticket->media) && $ticket->media!=='') {
              self::addPhotoBase64($tic_nro, $ticket->media);
          }
          
          if (count($errores) > 0 ) {
            $primary_db->rollbackTransaction();
            return array('tic_nro' => '', 'resultado' => 'ERROR', 'error' => 'Error al crear el ticket');
          } else { 
            $primary_db->commitTransaction();
          }
          
          return array('tic_nro' => $tic_identificador, 'resultado' => 'OK');
    }
    
    
    static private function ISO8601toDate($tstamp) {
        return date('Y-m-d H:i:s');
    }
    
    
    static private function createCuestionario($ticket) {
        return '';
    }
    
    
    static private function generaCodigoTicket($tipo,$anio)
    {
        global $primary_db;
        $codigo = $primary_db->Sequence("$tipo-$anio");
        return $codigo;
    }
    
    static private function addPhotoBase64($tic_nro, $media) {
        global $primary_db,$sess;
        
        if($media=='')
            return '';
        
        //Decodifico la foto
        $f = base64_decode($media);
        
        //Verifico que es una foto...
        
        //Datos de la foto
        $f_name = "foto_movil.jpg"; 
        $f_storage = md5($f_name.rand()).'.jpg';
        
        //Creo el lugar en el storage
        $f_path = _CFile::get_path($f_storage);
        file_put_contents($f_path.$f_storage, $f);
        
        //La relaciono al ticket (doc_documents)
        $doc_code = 'ticket:'.$tic_nro;
        $sql1 = "insert into doc_documents (doc_code, doc_storage, doc_name, doc_tstamp, doc_mime, doc_size, acl_code, use_code, doc_extension, doc_version, doc_note, doc_deleted, doc_public) 
                    values (':doc_code:', ':doc_storage:', ':doc_name:', NOW(), 'image/jpeg', ':doc_size:', null, ':use_code:', '.jpg', '1', 'Foto tomada con el móvil', null, 'Y')";
          $params1 = array(
              'doc_code'    =>  $doc_code, 
              'doc_storage' =>  $f_storage, 
              'doc_name'    =>  $f_name, 
              'doc_size'    =>  strlen($f), 
              'use_code'    =>  $sess->getUserId() 
          );
          $primary_db->do_execute($sql1,$errores,$params1);
          
          if(count($errores)==0)
              return '';
          else
              return 'Error al salvar la foto';
    }
    
    static function  factoryByCiudadano($idCiudadano) {
         global $primary_db;
        $sql="select * from tic_ticket t  join tic_ticket_ciudadano ci on t.tic_nro=ci.tic_nro  where ciu_code=$idCiudadano";
        $re = $primary_db->do_execute($sql);
        $tickets = array();
        
        while( $row=$primary_db->_fetch_row($re) )
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
             
      
             $tickets[]=  (object)$a;
        }
       // else{
       //     return array("el ticket no existe");
       // }
        $primary_db->_free_result($re);
        return $tickets;
              
    }
   
    
    
  
      static function  factoryByIdent($tipo,$nro,$anio) {
        
         
          global $primary_db;
        $sql="select * from tic_ticket   where tic_identificador ='$tipo" . " " .$nro . "/$anio'";
       $re = $primary_db->do_execute($sql);
        ;
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
          
              $primary_db->_free_result($re);
             return  (object)$a;
        }
        else{
            return array("el ticket no existe");
        }
       
              
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
    
    
    static private function createLugar($ticket) {
        global $primary_db;
		    
        $geo = array(
            'tipo'		=> 'DOMICILIO',
            'calle_nombre' 	=> $primary_db->Filtrado($ticket->tic_calle_nombre),
            'calle' 		=> 0,
            'callenro' 		=> $primary_db->Filtrado($ticket->tic_nro_puerta),
            'piso' 		=> $primary_db->Filtrado((isset($ticket->tic_piso) ? $ticket->tic_piso : '')),
            'dpto' 		=> $primary_db->Filtrado((isset($ticket->tic_dpto) ? $ticket->tic_dpto : '')),
            'nombre_fantasia' 	=> $primary_db->Filtrado((isset($ticket->tic_lugar) ? $ticket->tic_lugar : '')),
            'barrio' 		=> $primary_db->Filtrado((isset($ticket->tic_barrio) ? $ticket->tic_barrio : '')),
            'comuna' 		=> $primary_db->Filtrado((isset($ticket->tic_cgpc) ? $ticket->tic_cgpc : '')),
            'lat'		=> $primary_db->Filtrado($ticket->tic_coordx),
            'lng'		=> $primary_db->Filtrado($ticket->tic_coordy),
        );
       	
    	$ret = json_encode($geo);
       	error_log("createLugar() $ret");
    	return $ret;
    }
}


?>
