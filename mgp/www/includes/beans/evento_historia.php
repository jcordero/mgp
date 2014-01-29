<?php
include_once 'beans/functions.php';
include_once 'beans/ciudadano.php';

class evento_historia {
    /** Codigo interno del evento 
     *
     * @var int 
     */
    private $chi_code; 
    
    /** Codigo del ciudadano
     *
     * @var int
     */
    private $ciu_code; 
    
    /** Codigo de la sesion del call 
     *
     * @var int
     */
    public $cse_code; 
    
    /** Fecha y hora ISO8601
     *
     * @var string
     */
    public $chi_fecha; 
    
    /** Motivo 
     *
     * @var string
     */
    public $chi_motivo;
    
    /** Operador 
     *
     * @var int
     */
    public $use_code;
    
    /** Canal CALL, WEB, MOVIL 
     *
     * @var string
     */
    public $chi_canal; 
    
    /** Nota 
     *
     * @var string
     */
    public $chi_nota;
    
    /** Traza que identifica univocamente usuario, objeto, operacion
     *
     * @var string
     */
    public $chi_traza;
    
    function __construct() {
        $this->chi_code = 0;
        $this->ciu_code = 0;
        $this->cse_code = 0;
        $this->use_code = 0;        
        $this->chi_nota = "";
        $this->chi_motivo = "";
        $this->chi_canal = "";
        $this->chi_traza = "";
        $this->chi_fecha = DatetoISO8601();
    }
    
    /** 
     * 
     * @global type $primary_db
     * @param ciudadano $ciudadano
     * @return \evento
     */
    static function factoryByCiudadano(ciudadano $ciudadano) {
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
    
    function save(ciudadano $ciudadano=null) {
        global $primary_db,$sess;
        $errores = array();
        
        if($this->ciu_code==0 && is_object($ciudadano))
            $ciudadano->ciu_code;
        
        if($this->chi_code==0)
            $this->chi_code=$primary_db->Sequence('ciu_historial_contactos');
        
        if($this->chi_fecha=='')
            $this->chi_fecha=DatetoISO8601();
        
         if($this->use_code==0)
            $this->use_code=$sess->getUserId();
            
        if($this->chi_traza=="") {
            error_log("evento_historia::save() Falta definir la traza del evento.");
            return false;
        }
        //La traza ya existe? Evito duplicar el evento y no grabo nada
        $tr_check = $primary_db->QueryString("select count(*) from ciu_historial_contactos where chi_traza='{$this->chi_traza}'");
        if( $tr_check!="0" ) {
            error_log("evento_historia::save() La traza del evento ya existe.");
            return false;
        }
        
        $sql = "insert into ciu_historial_contactos(chi_code  ,ciu_code  ,chi_fecha    ,chi_motivo    ,use_code  , chi_canal   ,chi_traza    ) ". 
                                            "values(:chi_code:,:ciu_code:,':chi_fecha:',':chi_motivo:',:use_code:,':chi_canal:',':chi_traza:')";
        $params = array(
            'chi_code'   => $this->chi_code,
            'ciu_code'   => $this->ciu_code,
            'chi_fecha'  => ISO8601toDate($this->chi_fecha),
            'chi_motivo' => $this->chi_motivo,
            'use_code'   => intval($this->use_code,10),
            'chi_canal'  => $this->chi_canal,
            'chi_traza'  => $this->chi_traza
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return true;    
    }
    
    /** Creo el evento. Hay que llamar al metodo save() para terminar la operacion
     * 
     * @param int $ciu_code
     * @param string $motivo
     * @param string $nota
     * @param string $canal
     * @param string $traza
     */
    public function crearEvento($ciu_code, $motivo, $nota, $canal, $traza) {
        $this->ciu_code = $ciu_code;
        $this->chi_nota = $nota;
        $this->chi_motivo = $motivo;
        $this->chi_canal = $canal;
        $this->chi_traza = $traza;
    }
}
