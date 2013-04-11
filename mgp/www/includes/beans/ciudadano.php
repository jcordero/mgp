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
    
    static function update($ciudadano) {
        global $primary_db;
        
        
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
        $sql="select * from ciu_ciudadanos  where ciu_code = $id ";
        $re = $primary_db->do_execute($sql);
        if( $row=$primary_db->_fetch_array($re) )
        {
            return $row;
        }
        $primary_db->_free_result($re);
        
        
    }
    
    function addEvento($evento) {
         global $primary_db;
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
