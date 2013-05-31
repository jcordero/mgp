<?php
include_once 'beans/functions.php';

class evento {
    /** Codigo interno del evento */
    private $chi_code; 
    
    /** Codigo del ciudadano */
    private $ciu_code; 
    
    /** Codigo de la sesion del call */
    public $cse_code; 
    
    /** Fecha y hora */
    public $chi_fecha; 
    
    /** Motivo */
    public $chi_motivo;
    
    /** Operador */
    public $use_code;
    
    /** Canal CALL, WEB, MOVIL */
    public $chi_canal; 
    
    /** Nota */
    public $chi_nota;
    
    static function factoryByCiudadano($ciudadano) {
        global $primary_db;
        $eventos = array();
        $rs = $primary_db->do_execute("select * from ciu_historial_contactos where ciu_code='{$ciudadano->ciu_code}' order by chi_fecha desc");
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ev = new evento();
            $ev->chi_canal  = $row['chi_canal'];
            $ev->chi_code   = $row['chi_code'];
            $ev->chi_fecha  = DatetoISO8601($row['chi_fecha']);
            $ev->chi_motivo = $row['chi_motivo'];
            $ev->chi_nota   = $row['chi_nota'];
            $ev->ciu_code   = $row['ciu_code'];
            $ev->cse_code   = $row['cse_code'];
            $ev->use_code   = loadOperador($row['use_code']);
            
            $eventos[] = $ev;
        }
        return $eventos;
    }
    
    function save($ciudadano) {
        global $primary_db;
        $errores = array();
        
        if($this->ciu_code==='')
            $ciudadano->ciu_code;
        
        if($this->chi_code==='')
            $this->chi_code=$primary_db->Sequence('ciu_historial_contactos');
        
        if($this->chi_fecha==='')
            $this->chi_fecha=DatetoISO8601();
            
        $sql = "insert into ciu_historial_contactos(chi_code  ,ciu_code  ,chi_fecha    ,chi_motivo    ,use_code  , chi_canal   ) 
                                             values(:chi_code:,:ciu_code:,':chi_fecha:',':chi_motivo:',:use_code:,':chi_canal:')";
        $params = array(
            'chi_code'   => $this->chi_code,
            'ciu_code'   => $this->ciu_code,
            'chi_fecha'  => ISO8601toDate($this->chi_fecha),
            'chi_motivo' => $this->chi_motivo,
            'use_code'   => $this->use_code,
            'chi_canal'  => $this->chi_canal,
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return true;    
    }
}
