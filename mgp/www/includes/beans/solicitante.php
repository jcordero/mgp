<?php
include_once 'beans/person_status.php';
include_once 'common/cmessaging.php';

class solicitante {
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
    
    /** Correo electronico
     *
     * @var string
     */
    public $ciu_email;
    
    /** Telefono fijo
     *
     * @var string 
     */
    public $ciu_telefono_fijo;
    
    /** Teléfono móvil
     *
     * @var string
     */
    public $ciu_telefono_movil;
    
    /** Fecha de creacion
     *
     * @var date 
     */
    public $ttc_tstamp;
    
    /** Nota
     *
     * @var string
     */
    public $ttc_nota;
    
    /** Codigo interno del ciudadano
     *
     * @var int 
     */
    private $ciu_code;
    
    /** Crea un array de solicitantes que estan relacionados con este ticket
     * 
     * @global cdbdata $primary_db
     * @param int $tic_nro
     * @return solicitante[]
     */
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_ciudadano tci 
                    JOIN ciu_ciudadanos cci ON tci.ciu_code=cci.ciu_code
                WHERE tci.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ciudadano = new solicitante();                
            
            $ciudadano->ciu_documento         = $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}' limit 1");
            $ciudadano->ciu_nombres           = $row['ciu_nombres'];
            $ciudadano->ciu_apellido          = $row['ciu_apellido'];
            $ciudadano->ciu_email             = $row['ciu_email'];
            $ciudadano->ciu_telefono_fijo     = $row['ciu_tel_fijo'];
            $ciudadano->ciu_telefono_movil    = $row['ciu_tel_movil'];        
            $ciudadano->ttc_tstamp            = DatetoISO8601($row['ttc_tstamp']); 
            $ciudadano->ttc_nota              = $row['ttc_nota'];
            $ciudadano->ciu_code              = $row['ciu_code'];
            
            $ret[] = $ciudadano;
        }
        return $ret;
    }

    /** Salva el solicitante en la base
     * 
     * @global cdbdata $primary_db
     * @global CSession $sess
     * @param ticket $ticket
     */
    function save($ticket) {
        global $primary_db, $sess;
        $errores = array();
        
        //Existe el ciudadano?
        $this->ciu_code = $primary_db->QueryString("select ciu_code from ciu_identificacion where ciu_nro_doc='{$this->ciu_documento}'");
        
        //Caso que no exista el ciudadano
        if($this->ciu_code==='') {
            $this->ciu_code = $primary_db->Sequence('ciu_ciudadanos');
            $nac = substr($this->ciu_documento,0,3);
            
            $sql1 = "insert into ciu_ciudadanos (ciu_code  , ciu_nombres   , ciu_apellido   , ciu_email   , ciu_tel_fijo   , ciu_tel_movil   , ciu_ultimo_acceso, ciu_canal_ingreso   , ciu_estado, ciu_tstamp, ciu_tipo_persona, ciu_nacionalidad) 
                                         values (:ciu_code:,':ciu_nombres:',':ciu_apellido:',':ciu_email:',':ciu_tel_fijo:',':ciu_tel_movil:',NOW()             ,':ciu_canal_ingreso:','ACTIVO'   , NOW()     , 'FISICA'        , ':ciu_nacionalidad:')";
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
            
            $sql2 = "insert into ciu_identificacion (ciu_code  , ciu_nro_doc   ) 
                                             values (:ciu_code:,':ciu_nro_doc:')";
            $params2 = array(
                  'ciu_code'            => $this->ciu_code, 
                  'ciu_nro_doc'         => $this->ciu_documento, 
            );
            $primary_db->do_execute($sql2,$errores,$params2);
            
        }
        else
        {
            //El ciudadano esta identificado o creado... ciu_code y ciu_documento son conocidos
            //Esto carga el telefono y el mail.
            $this->load();
        }
        
        //Lo asocio al ciudadano que lo reporta (tic_ticket_ciudadano)
        $sql5 = "insert into tic_ticket_ciudadano (tic_nro, ciu_code, ttc_tstamp, ttc_nota) 
                    values (:tic_nro:, :ciu_code:, NOW(), ':ttc_nota:')";
        $params5 = array(
              'tic_nro'     => $ticket->getNro(), 
              'ciu_code'    => $this->ciu_code, 
              'ttc_nota'    => $ticket->tic_nota_in
        );
        $primary_db->do_execute($sql5,$errores,$params5);
         
         //Creo un evento en el historial del ciudadano (ciu_historial_contactos)
         $sql6 = "insert into ciu_historial_contactos (chi_code  , ciu_code  , cse_code, chi_fecha, chi_motivo    , use_code    , chi_canal  , chi_nota    ) 
                                               values (:chi_code:, :ciu_code:, null    , NOW()    , ':chi_motivo:', ':use_code:', 'chi_canal', ':chi_nota:')";
         $params6 = array(
              'chi_code'    =>  $primary_db->Sequence('ciu_historial_contactos'), 
              'ciu_code'    =>  $this->ciu_code, 
              'use_code'    =>  $sess->getUserId(), 
              'chi_nota'    =>  $ticket->tic_nota_in,
              'chi_motivo'  =>  'Ingreso '.$ticket->tic_identificador,
              'chi_canal'   =>  $ticket->tic_canal
         );
         $primary_db->do_execute($sql6,$errores,$params6);

         
         //Creo un mensaje de mail para el ciudadano
         if( $this->ciu_email!=='' ) {
            $mt = new cmail_type("ADJUNTO", "www/lmodules/tickets/ticket_maint.php", "tic_nro=".$ticket->getNro(),"aviso_nuevo_ticket");
            $msg = new cmessage();
            $msg->send(DEFAULT_SMTP,$this->ciu_email,$mt);
         }
    }
    
    /** Toma los datos del solicitante desde un formulario 
     * 
     * @global cdbdata $primary_db
     * @param cdatatype $obj
     * @return solicitante[]
     */
    static function fromForm($obj) {
        global $primary_db;
        
        //Ciudadano identificado
        $ps = new person_status();
        
        $s = new solicitante();
        $s->ciu_apellido = $ps->person_apellido;
        $s->ciu_code = $ps->person_id;
        $s->ciu_documento = $ps->person_doc;
        $s->ciu_nombres = $ps->person_nombres;
        
        //Busco algunos datos que no tengo, en la base de datos
        $row = $primary_db->QueryArray("select ciu_email,ciu_tel_fijo,ciu_tel_movil from ciu_ciudadanos where ciu_code='{$s->ciu_code}'");
        if($row) {
            $s->ciu_email = $row['ciu_email'];
            $s->ciu_telefono_fijo = $row['ciu_tel_fijo'];
            $s->ciu_telefono_movil = $row['ciu_tel_movil'];
        }                
        
        return array($s);
    }
    
    
    public function load() {
        global $primary_db;
        
        //Ciudadano identificado ?
        if($this->ciu_code==='')
            return false;
        
        //Busco algunos datos que no tengo, en la base de datos
        $row = $primary_db->QueryArray("select ciu_code, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, use_code, ciu_estado, ciu_tstamp, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad from ciu_ciudadanos where ciu_code='{$s->ciu_code}'");
        if($row) {
            $this->ciu_email            = $row['ciu_email'];
            $this->ciu_telefono_fijo    = $row['ciu_tel_fijo'];
            $this->ciu_telefono_movil   = $row['ciu_tel_movil'];
            $this->ciu_nombres          = $row['ciu_nombres'];
            $this->ciu_apellido         = $row['ciu_apellido'];
        }                
        
        return true;
    }
    
}
?>
