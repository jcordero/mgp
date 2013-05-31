<?php
include_once 'beans/functions.php';

class sesion {
    private $cse_code;
    private $ciu_code;
    public $cse_ani;
    public $cse_tstamp;
    public $cse_duracion;
    public $use_code;
    public $cse_nota;
    public $cse_derivado;
    public $cse_call_id;
    public $cse_skill;
    public $cse_estado;
    
    static function factoryByCiudadano($ciudadano) {
        global $primary_db;
        $sesiones = array();
        
        $rs = $primary_db->do_execute("select * from ciu_sesiones where ciu_code='{$ciudadano->ciu_code}' order by cse_tstamp desc");
        while( $row=$primary_db->_fetch_row($rs) ) {
            $se = new sesion();
            $this->cse_code         = $row['cse_code'];
            $this->ciu_code         = $row['ciu_code'];
            $this->cse_ani          = $row['cse_ani'];
            $this->cse_tstamp       = DatetoISO8601($row['cse_tstamp']);
            $this->cse_duracion     = $row['cse_duracion'];
            $this->use_code         = loadOperador($row['use_code']);
            $this->cse_nota         = $row['cse_nota'];
            $this->cse_derivado     = $row['cse_derivado'];
            $this->cse_call_id      = $row['cse_call_id'];
            $this->cse_skill        = $row['cse_skill'];
            $this->cse_estado       = $row['cse_estado'];
            
            $sesiones[] = $se;
        }
        return $sesiones;
    }
    
    function save($ciudadano) {
        global $primary_db;
        $errores = array();
        
        if($this->ciu_code==='')
            $ciudadano->ciu_code;
        
        if($this->cse_code==='')
            $this->cse_code=$primary_db->Sequence('ciu_sesiones');
        
        if($this->cse_tstamp==='')
            $this->cse_tstamp=DatetoISO8601();
            
        $sql = "insert into ciu_sesiones(cse_code  , ciu_code  , cse_ani    , cse_tstamp    , cse_duracion    , use_code    , cse_nota    , cse_derivado    , cse_call_id    , cse_skill    , cse_estado    ) 
                                  values(:cse_code:, :ciu_code:, ':cse_ani:', ':cse_tstamp:', ':cse_duracion:', ':use_code:', ':cse_nota:', ':cse_derivado:', ':cse_call_id:', ':cse_skill:', ':cse_estado:')";
        $params = array(
            'cse_code'      =>  $this->cse_code, 
            'ciu_code'      =>  $this->ciu_code, 
            'cse_ani'       =>  $this->cse_ani, 
            'cse_tstamp'    =>  $this->cse_tstamp, 
            'cse_duracion'  =>  $this->cse_duracion, 
            'use_code'      =>  $this->use_code, 
            'cse_nota'      =>  $this->cse_nota, 
            'cse_derivado'  =>  $this->cse_derivado, 
            'cse_call_id'   =>  $this->cse_call_id, 
            'cse_skill'     =>  $this->cse_skill, 
            'cse_estado'    =>  $this->cse_estado
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return true;    
    }
}
