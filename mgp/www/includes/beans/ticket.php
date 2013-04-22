<?php
include_once 'common/cfile.php';
include_once 'beans/ciudadano.php';

class ticket {
    /** Identificador publico del ticket "TIPO NRO/AÑO" */
    public $tic_identificador;
        
    /** Tipo de ticket (RECLAMO, DENUNCIA, QUEJA, SOLICITUD) */
    public $tic_tipo;
    
    /** Codigo del ticket al que este esta asociado este */
    public $tic_nro_asociado;
    
    /** Fecha de ingreso del ticket */
    public $tic_tstamp_in;
    
    /** Operador que ingreso el ticket */
    public $use_code;
    
    /** Nota cargada al ingresar el ticket */
    public $tic_nota_in;
    
    /** Estado global del ticket ABIERTO / CERRADO / CANCELADO */
    public $tic_estado;
    
    /** Objeto que contiene la información del lugar */
    public $tic_lugar;
    
    /** Campo de busqueda barrio */
    public $tic_barrio;
    
    /** Campo de busqueda comuna */
    public $tic_cgpc;
    
    /** Campo de busqueda Latitud */
    public $tic_coordx;
    
    /** Campo de busqueda Longitud */
    public $tic_coordy;
    
    /** Canal de ingreso: web, movil, call, presencial */
    public $tic_canal;
    
    /** Fecha de vencimiento del ticket */
    public $tic_tstamp_plazo;
    
    /** Fecha en la que se cierra o cancela el ticket */
    public $tic_tstamp_cierre;
    
    /** Nombre de la calle */
    public $tic_calle_nombre;
    
    /** Numero de la puerta */
    public $tic_nro_puerta;

    /** Nombre de la calle que se cruza */
    public $tic_cruza_calle;

    /** Array con las prestaciones */
    public $prestaciones;
    
    /** Array con las personas que solicitan el ticket */ 
    public $solicitantes;
    
    /** Array con las personas que han reiterado este ticket */
    public $reiteraciones;
    
    /** Lista de tickets */
    public $asociados;
    
    function __construct() {
        $this->prestaciones = array();
        $this->solicitantes = array();
        $this->reiteraciones = array();
        $this->asociados = array();
    }
    
    
    /**
     * Agrega un ticket al sistema
     * 
     * @global type $primary_db
     * @global type $sess
     * @param type $ticket (un objeto ticket)
     * @return type
     */    
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
    
    static private function DatetoISO8601($tstamp) {
        return str_replace(array('-',':',' '),array('','','T'),$tstamp);
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
    }
   
    /**
     * Cargo el identificador compuesto del ticket
     * @param type $identificador
     */
    function setIdent($identificador) {
        $p = explode(' ',$identificador);
        if( count($p)==2 ) {
            $t = $p[0];
            $q = explode('/',$p[1]);
            if( count($q)==2 ) {
                $n = $p[0];
                $a = $p[1];
                $this->setTipoNroAnio($t, $n, $a);
            }
        }
    }
    
    /** Cargo los datos para identificar al ticket 
     * 
     * @param type $tipo
     * @param type $nro
     * @param type $anio
     * @return type
     */
    function setTipoNroAnio($tipo,$nro,$anio) {
        $t = strtoupper($tipo);
        if($t!="RECLAMO" && $t!="SOLICITUD" && $t!="QUEJA" && $t!="DENUNCIA")
            return;
        
        $tic_numero = intval($nro);
        $tic_anio = intval($anio);
        $this->tic_tipo = $t;
        $this->tic_identificador = "{$this->tic_tipo} {$tic_numero}/{$tic_anio}";
    }
    
    /**
     * Crea un ticket dado su tipo numero y año.
     * 
     * @global type $primary_db
     * @param type $tipo
     * @param type $nro
     * @param type $anio
     * @return type
     */
    static function  factoryByIdent($tipo,$nro,$anio) {
        $t = new ticket();
        $t->setTipoNroAnio($tipo, $nro, $anio);
        if( $t->load() )
            return $t;
        else
            return null;
    }
    
    
    
    
    /**
     * Carga el ticket desde la base de datos.
     * @global type $primary_db
     */   
    function load() {
        global $primary_db;
        
        //Esta el identificador cargadado?
        if( $this->tic_identificador=='' ) { 
            return false; //No se puede cargar el registro, sin indicar primero cual se busca   
        } else {
            $tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$this->tic_identificador}'");
            if( intval($tic_nro)==0 ) 
                return false; //El ticket pedido no existe               
        }
        
        
        //Ya se en este punto que el ticket existe. Lo cargo ahora completo desde la base
        $row = $primary_db->QueryArray("select * from tic_ticket where tic_nro='{$tic_nro}'");
    
        $this->tic_tipo = $row['tic_tipo'];
        $this->tic_nro_asociado = $row['tic_nro_asociado'];
        $this->tic_tstamp_in = ticket::DatetoISO8601($row['tic_tstamp_in']);
        $this->use_code = $this->loadOperador($row['use_code']);
        $this->tic_nota_in = $row['tic_nota_in'];
        $this->tic_estado = $row['tic_estado'];
        $this->tic_lugar = json_decode($row['tic_lugar']);
        $this->tic_barrio = $row['tic_barrio'];
        $this->tic_cgpc = $row['tic_cgpc'];
        $this->tic_coordx = $row['tic_coordx'];
        $this->tic_coordy = $row['tic_coordy'];
        $this->tic_canal = $row['tic_canal'];
        $this->tic_tstamp_plazo = ticket::DatetoISO8601($row['tic_tstamp_plazo']);
        $this->tic_tstamp_cierre = ticket::DatetoISO8601($row['tic_tstamp_cierre']);
        $this->tic_calle_nombre = $row['tic_calle_nombre'];
        $this->tic_nro_puerta = $row['tic_nro_puerta'];
        $this->tic_cruza_calle = $row['tic_cruza_calle'];
       
        $this->prestaciones = $this->loadPrestaciones($tic_nro);
        $this->solicitantes = $this->loadSolicitantes($tic_nro);
        $this->reiteraciones = $this->loadReiteraciones($tic_nro);
        $this->asociados = $this->loadAsociados($tic_nro);
        
        return true;
    }

    private function loadPrestaciones($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_prestaciones ttp 
                    LEFT OUTER JOIN tic_prestaciones tpr ON ttp.tpr_code=tpr.tpr_code
                    LEFT OUTER JOIN tic_rubros tru ON ttp.tru_code=tru.tru_code    
                WHERE ttp.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $prestacion = (object) array(                
                'tpr_code'          => $row['tpr_code'],
                'tpr_description'   => $row['tpr_detalle'],
                'tru_code'          => $row['tru_code'], 
                'tru_description'   => $row['tru_detalle'],
                'ttp_estado'        => $row['ttp_estado'],
                'ttp_prioridad'     => $row['ttp_prioridad'], 
                'ttp_tstamp_plazo'  => $this->DatetoISO8601($row['ttp_tstamp_plazo']), 
                'ttp_alerta'        => $row['ttp_alerta'],
                'avance'            => $this->loadAvance($tic_nro, $row['tpr_code']),
                'organismos'        => $this->loadOrganismos($tic_nro),
                'cuestionario'      => $this->loadCuestionario($tic_nro, $row['tpr_code']), 
            );
            $ret[] = $prestacion;
        }
        return $ret;
    }
 
    private function loadSolicitantes($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_ciudadano tci 
                    JOIN ciu_ciudadanos cci ON tci.ciu_code=cci.ciu_code
                WHERE tci.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ciudadano = (object) array(                
                'ciu_documento'         => $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}' limit 1"), 
                'ciu_nombres'           => $row['ciu_nombres'],
                'ciu_apellido'          => $row['ciu_apellido'],
                'ciu_email'             => $row['ciu_email'],
                'ciu_telefono_fijo'     => $row['ciu_tel_fijo'],
                'ciu_telefono_movil'    => $row['ciu_tel_movil'],        
                'ttc_tstamp'            => $this->DatetoISO8601($row['ttc_tstamp']), 
                'ttc_nota'              => $row['ttc_nota']
            );
            $ret[] = $ciudadano;
        }
        return $ret;
    }
    
    private function loadReiteraciones($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_ciudadano_reit tci 
                    JOIN ciu_ciudadanos cci ON tci.ciu_code=cci.ciu_code
                WHERE tci.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ciudadano = (object) array(                
                'ciu_documento'         => $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}' limit 1"), 
                'ciu_nombres'           => $row['ciu_nombres'],
                'ciu_apellido'          => $row['ciu_apellido'],
                'ciu_email'             => $row['ciu_email'],
                'ciu_telefono_fijo'     => $row['ciu_tel_fijo'],
                'ciu_telefono_movil'    => $row['ciu_tel_movil'],
                'ttc_tstamp'            => $this->DatetoISO8601($row['ttc_tstamp']), 
                'ttc_nota'              => $row['ttc_nota']        
            );
            $ret[] = $ciudadano;
        }
        return $ret;
    }
 
    private function loadAsociados($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_asociado WHERE tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $ticket = (object) array(          
                'tic_nro_asoc'  => $row['tic_nro_asoc'],
                'tta_tstamp'    => $this->DatetoISO8601($row['tta_tstamp']),
                'use_code'      => $this->loadOperador($row['use_code']),
                'tta_motivo'    => $row['tta_motivo']
            );
            $ret[] = $ticket;
        }
        return $ret;
    }
 
    private function loadOperador($use_code) {
        global $primary_db;
        
        if($use_code==='' || intval($use_code)===0)
            return (object) array('use_code'=>'','use_name'=>'Sin especificar');
        
        return (object) array(
            'use_code'  =>  $use_code,
            'use_name'  =>  $primary_db->QueryString("select use_name from sec_users where use_code='{$use_code}'")
        );
    }
    
    private function loadOrganismos($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_organismos tto 
                    LEFT OUTER JOIN tic_organismos tor ON tto.tor_code=tor.tor_code
                WHERE tto.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $organismo = (object) array(                
                'tor_code'          => $row['tor_code'],
                'tto_figura'        => $row['tto_figura'],
                'tor_activo'        => $row['tor_estado'], 
                'tor_description'   => $row['tor_nombre']
            );
            $ret[] = $organismo;
        }
        return $ret;
    }

    private function loadAvance($tic_nro,$tpr_code) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_avance WHERE tic_nro='{$tic_nro}' and tpr_code='{$tpr_code}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $avance = (object) array(          
                'tav_code'      => $row['tav_code'],
                'tav_tstamp_in' => $this->DatetoISO8601($row['tav_tstamp_in']),
                'use_code_in'   => $this->loadOperador($row['use_code_in']),
                'tic_estado_in' => $row['tic_estado_in'],
                'tav_nota'      => $row['tav_nota'],
                'tic_motivo'    => $row['tic_motivo'],
                'tic_estado_out'=> $row['tic_estado_out'],
                'tav_tstamp_out'=> $this->DatetoISO8601($row['tav_tstamp_out']),
                'use_code_out'  => $this->loadOperador($row['use_code_out'])
            );
            $ret[] = $avance;
        }
        return $ret;
    }

    private function loadCuestionario($tic_nro,$tpr_code) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_cuestionario WHERE tic_nro='{$tic_nro}' and tpr_code='{$tpr_code}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $pregunta = (object) array(          
                'tcu_code'      => $row['tcu_code'], 
                'tpr_preg'      => $row['tpr_preg'], 
                'tpr_tipo_preg' => $row['tpr_tipo_preg'], 
                'tpr_respuesta' => $row['tpr_respuesta'], 
                'tpr_miciudad'  => $row['tpr_miciudad']                
            );
            $ret[] = $pregunta;
        }
        return $ret;
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
