<?php
include_once 'beans/evento_historia.php';

class reiteracion {
    /** Identificador del ciudadano
     * PAIS TIPO NRO
     * @var string 
     */
    public $ciu_documento;
    
    /** Nombres del ciudadano
     *
     * @var string
     */
    public $ciu_nombres;
    
    /** Apellido del ciudadano
     *
     * @var string
     */
    public $ciu_apellido;
    
    /** Correo electronico del ciudadano
     *
     * @var string
     */
    public $ciu_email;
    
    /** Número de telefono fijo
     *
     * @var string
     */
    public $ciu_telefono_fijo;
    
    /** Número de telefono celular
     *
     * @var string 
     */
    public $ciu_telefono_movil;
    
    /** Fecha del evento
     * 
     * @var date 
     */
    public $ttc_tstamp;
    
    /** Nota al momento de la reiteracion
     *
     * @var string
     */
    public $ttc_nota;
    
    /**
     * Codigo interno del ciudadano
     * @var int 
     */
    private $ciu_code;
    
    
    /** Crea un array de objetos reiteración relacionados al ticket
     * 
     * @global cdbdata $primary_db
     * @param int $tic_nro
     * @return array reiteracion
     */
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_ciudadano_reit tci 
                    JOIN ciu_ciudadanos cci ON tci.ciu_code=cci.ciu_code
                WHERE tci.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ciudadano = new reiteracion();                
            
            $ciudadano->ciu_code              = $row['ciu_code'];
            $ciudadano->ciu_documento         = $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}' limit 1");
            $ciudadano->ciu_nombres           = $row['ciu_nombres'];
            $ciudadano->ciu_apellido          = $row['ciu_apellido'];
            $ciudadano->ciu_email             = $row['ciu_email'];
            $ciudadano->ciu_telefono_fijo     = $row['ciu_tel_fijo'];
            $ciudadano->ciu_telefono_movil    = $row['ciu_tel_movil'];        
            $ciudadano->ttc_tstamp            = DatetoISO8601($row['ttc_tstamp']); 
            $ciudadano->ttc_nota              = $row['ttc_nota'];
            
            $ret[] = $ciudadano;
        }
        return $ret;
    } 
    
    /** Salva una reiteracion
     * Debe estar declarado ciu_documento y ttc_nota como minimo
     * @global cdbdata $primary_db
     * @global type $sess
     * @param ticket $ticket
     */
    function save(ticket $ticket) {
        global $primary_db;
        $errores = array();
        
        //Existe el ciudadano?
        $this->ciu_code = $primary_db->QueryString("select ciu_code from ciu_identificacion where ciu_nro_doc='{$this->ciu_documento}'");
        
        //Caso que no exista el ciudadano
        if($this->ciu_code==='') {
            $this->ciu_code = $primary_db->Sequence('ciu_ciudadanos');
            $nac = substr($this->ciu_documento,0,3);
            
            $sql1 = "insert into ciu_ciudadanos (ciu_code  , ciu_nombres   , ciu_apellido   , ciu_email   , ciu_tel_fijo   , ciu_tel_movil   , ciu_ultimo_acceso, ciu_canal_ingreso   , ciu_estado, ciu_tstamp, ciu_tipo_persona, ciu_nacionalidad    ) ".
                                        "values (:ciu_code:,':ciu_nombres:',':ciu_apellido:',':ciu_email:',':ciu_tel_fijo:',':ciu_tel_movil:',NOW()             ,':ciu_canal_ingreso:','ACTIVO'   , NOW()     , 'FISICA'        , ':ciu_nacionalidad:')";
            $params1 = array(
                  'ciu_code'            => $this->ciu_code, 
                  'ciu_nombres'         => $this->ciu_nombres, 
                  'ciu_apellido'        => $this->ciu_apellido,
                  'ciu_email'           => $this->ciu_email,
                  'ciu_tel_fijo'        => $this->ciu_telefono_fijo,
                  'ciu_tel_movil'       => $this->ciu_telefono_movil,
                  'ciu_canal_ingreso'   => $ticket->tic_canal,
                  'ciu_nacionalidad'    => $nac,
            );
            $primary_db->do_execute($sql1,$errores,$params1);
            
            $sql2 = "insert into ciu_identificacion (ciu_code  , ciu_nro_doc   ) ".
                                            "values (:ciu_code:,':ciu_nro_doc:')";
            $params2 = array(
                  'ciu_code'            => $this->ciu_code, 
                  'ciu_nro_doc'         => $this->ciu_documento, 
            );
            $primary_db->do_execute($sql2,$errores,$params2);
        }
        
        //El ciudadano esta identificado o creado...
        
        //Lo asocio al ciudadano que lo reporta (tic_ticket_ciudadano_reit)
        $sql5 = "insert into tic_ticket_ciudadano_reit (tic_nro, ciu_code, ttc_tstamp, ttc_nota) ".
                   "values (:tic_nro:, :ciu_code:, NOW(), ':ttc_nota:')";
        $params5 = array(
              'tic_nro'     => $ticket->getNro(), 
              'ciu_code'    => $this->ciu_code, 
              'ttc_nota'    => $this->ttc_nota
        );
        $primary_db->do_execute($sql5,$errores,$params5);
         
        //Creo un evento en el historial del ciudadano
        $traza = $ticket->getNro()."-".$this->ciu_code."-REITERO TICKET";
        $ev = new evento_historia();
        $ev->crearEvento($this->ciu_code, 'Reitero ticket '.$ticket->tic_identificador, $ticket->tic_nota_in, $ticket->tic_canal, $traza);
        $ev->save();
                    
    }

}
?>
