<?php

class ciudadano {
    
    public $ciu_code;
    public $ciu_nombres;
    public $ciu_apellido;
    public $ciu_sexo;
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
    
    static function updateCiudadano($ciudadano) {
        global $primary_db;
         $contenido=array();
         $errores=array();
         $ciudadano =(object)$ciudadano;
     
           $existe=$primary_db->QueryString("SELECT count(*) FROM ciu_ciudadanos where ciu_code= $ciudadano->ciu_code");
      
         if($existe<1)return array("El ciudadano no existe");
         $sql = "update ciu_ciudadanos SET " .
                " ciu_code = $ciudadano->ciu_code, ".
                " ciu_nombres  = '$ciudadano->ciu_nombres',".
                " ciu_apellido = '$ciudadano->ciu_apellido',".
                " ciu_sexo     = '$ciudadano->ciu_sexo', ".
                " ciu_nacimiento ='$ciudadano->ciu_nacimiento',".
                " ciu_email      = '$ciudadano->ciu_email',".
                " ciu_tel_fijo  = '$ciudadano->ciu_tel_fijo',".  
                " ciu_tel_movil  = '$ciudadano->ciu_tel_movil',".
                " ciu_horario_cont ='$ciudadano->ciu_horario_cont',".
                " ciu_no_llamar = '$ciudadano->ciu_no_llamar',".
                " ciu_no_email = '$ciudadano->ciu_no_email',".
                " ciu_dir_calle  = '$ciudadano->ciu_dir_calle',".
                " ciu_dir_nro =  '$ciudadano->ciu_dir_nro',".
                " ciu_dir_piso =  '$ciudadano->ciu_dir_piso',".
                " ciu_dir_dpto =  '$ciudadano->ciu_dir_dpto', ".
                " ciu_barrio=     '$ciudadano->ciu_barrio',".
                " ciu_localidad=   '$ciudadano->ciu_localidad',".
                " ciu_provincia =   '$ciudadano->ciu_provincia',".
                " ciu_pais       =  '$ciudadano->ciu_pais',".
                " ciu_cod_postal =  '$ciudadano->ciu_cod_pais',".
                " ciu_cgpc       = '$ciudadano->ciu_cgpc',".
              //  " ciu_coord_x    = $ciudadano->ciu_coord_x,".
              //  " ciu_coord_y    = $ciudadano->ciu_coord_y,".
                " ciu_trabaja   = '$ciudadano->ciu_trabaja',".
                " ciu_nivel_estudio = '$ciudadano->ciu_nivel_estudio',".
                " ciu_profesion    =  '$ciudadano->ciu_profesion',".
                " ciu_ultimo_acceso = '$ciudadano->ciu_ultimo_acceso',".
                " ciu_canal_ingreso = '$ciudadano->ciu_canal_ingreso',".
                " use_code          = $ciudadano->use_code,".
                " ciu_estado       = '$ciudadano->ciu_estado', ".
                " ciu_tstamp      = '$ciudadano->ciu_tstamp',".
                "ciu_tipo_persona = '$ciudadano->ciu_tipo_persona',".
                "ciu_razon_social = '$ciudadano->ciu_razon_social',".
               " ciu_nacionalidad = '$ciudadano->ciu_nacionalidad' WHERE ciu_code = $ciudadano->ciu_code";
                   
         //  documentos;
              //  eventos;
            //   tickets;
        //die($sql);
        $primary_db->do_execute($sql,$errores);
        
        return array($contenido,$errores);
        
        
    }
    
    // hay un problema porque no ingresa el id y es clave
    static function addCiudadano($ciudadano) {
         global $primary_db;
         $contenido=array();
         $errores=array();
         $ciudadano =(object)$ciudadano;
        
         $existe=$primary_db->QueryString("SELECT count(*) FROM ciu_identificacion  ciu_nro_doc = '" . $sEmisor . " " .$sTipoDoc . " " . $iNumeroDocumento . "'");
         if($existe>0)return array("El ciudadano  existe");
         $sql = "insert into ciu_ciudadanos(chi_code,ciu_code,chi_fecha,chi_motivo,use_code, chi_canal) values(:chi_code:,:ciu_code:,':chi_fecha:',':chi_motivo:',:use_code:,':chi_canal:')";
         $params = array(
            'chi_code'      => $evento->chi_code,
            'ciu_code'   => $evento->ciu_code,
             'chi_fecha'      =>$evento->chi_fecha,
             'chi_motivo'   => $evento->chi_motivo,
             'use_code'      => $evento->use_code,
             'chi_canal'   => $evento->chi_canal,
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return array($contenido,$errores);
        
        
    }
    
    
    
    
    
    static function  factoryById($id) {
         global $primary_db;
        $sql="select * from ciu_ciudadanos  where ciu_code = $id ";
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
        $primary_db->_free_result($re);
              
    }
    
    static function  factoryByDoc($sEmisor,$sTipoDoc,$iNumeroDocumento) {
         global $primary_db;
        $sql="select * from ciu_ciudadanos c JOIN ciu_identificacion i on c.ciu_code= i.ciu_code   where  ciu_nro_doc = '" . $sEmisor . " " .$sTipoDoc . " " . $iNumeroDocumento . "'";
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
        $primary_db->_free_result($re);
              
    }
    
    static function addEvento($evento) {
         global $primary_db;
         $contenido=array();
         $errores=array();
         $evento =(object)$evento;
        
         $existe=$primary_db->QueryString("SELECT count(*) FROM ciu_ciudadanos where ciu_code= $evento->ciu_code");
         if($existe<1)return array("El ciudadano no existe");
         $sql = "insert into ciu_historial_contactos(chi_code,ciu_code,chi_fecha,chi_motivo,use_code, chi_canal) values(:chi_code:,:ciu_code:,':chi_fecha:',':chi_motivo:',:use_code:,':chi_canal:')";
         $params = array(
            'chi_code'      => $evento->chi_code,
            'ciu_code'   => $evento->ciu_code,
             'chi_fecha'      =>$evento->chi_fecha,
             'chi_motivo'   => $evento->chi_motivo,
             'use_code'      => $evento->use_code,
             'chi_canal'   => $evento->chi_canal,
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return array($contenido,$errores);
        
        
    }
    
    function toJSON() {
        return json_encode($this);
    }
    
    
    
}

?>
