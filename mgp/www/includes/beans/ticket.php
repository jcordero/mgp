<?php
include_once 'beans/functions.php';
include_once 'common/cfile.php';
include_once 'beans/ciudadano.php';
include_once 'beans/prestacion.php';
include_once 'beans/solicitante.php';
include_once 'beans/reiteracion.php';
include_once 'beans/asociado.php';
include_once 'common/cmessaging.php';

class ticket {
    /** Nro interno del ticket */
    private $tic_nro;
    
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
    private $tic_barrio;
    
    /** Campo de busqueda comuna */
    private $tic_cgpc;
    
    /** Campo de busqueda Latitud */
    private $tic_coordx;
    
    /** Campo de busqueda Longitud */
    private $tic_coordy;
    
    /** Canal de ingreso: web, movil, call, presencial */
    public $tic_canal;
    
    /** Fecha de vencimiento del ticket */
    public $tic_tstamp_plazo;
    
    /** Fecha en la que se cierra o cancela el ticket */
    public $tic_tstamp_cierre;
    
    /** Tipo de geo referencia DOMICILIO, CEMENTERIO, VILLA, LUMINARIA, PLAZA, ORGAN.PUBLICO */
    private $tipo_georef;
 
    /** Nombre del lugar, como Hospital Pirulo */
    private $tic_nombre_fantasia;
    
    /** Nombre de la calle */
    private $tic_calle_nombre;

    /** Código de la calle */
    private $tic_calle;

    /** Nombre de la calle que cruza */
    private $tic_calle_nombre2;

    /** Código de la calle que cruza*/
    private $tic_calle2;
    
    /** Usa calle nro (NRO) o calle y calle (CALLE) */
    private $alternativa;

    /** Numero de la puerta */
    private $tic_nro_puerta;

    /** Piso */
    private $tic_piso;

    /** Departamento */
    private $tic_dpto;

    /** Identificador de la luminaria */
    private $id_luminaria;
    
    /** Array con las prestaciones */
    public $prestaciones;
    
    /** Array con las personas que solicitan el ticket */ 
    public $solicitantes;
    
    /** Array con las personas que han reiterado este ticket */
    public $reiteraciones;
    
    /** Lista de tickets */
    public $asociados;
    
    /** Foto */
    private $media;
    
    /** Array de errores de proceso */
    private $errors;
    
    /** Villa */
    private $villa;
    private $vilmanzana;
    private $vilcasa;
         
    /** Plaza */
    private $plaza;
    
    /** Organismo publico */
    private $orgpublico;
    private $orgsector;
    
    /** Cementerio */
    private $cementerio;
    private $sepultura;
    private $sepsector;
    private $sepcalle;
    private $sepnumero;
    private $sepfila;

    /** Identificador de cuadra */
    private $id_cuadra;
    
    function __construct() {
        $this->prestaciones = array();
        $this->solicitantes = array();
        $this->reiteraciones = array();
        $this->asociados = array();
        $this->errors = array();
    }
    
    function getErrors() {
        return $this->errors;
    }

    function getErrorString() {
        $ret = '';
        foreach($this->errors as $err)
            $ret.=($ret==='' ? '' : '; ').$err;
        
        return $ret;
    }
    
    function addError($msg) {
        $this->errors[] = $msg;
    }

    function getStatus() {
        return (count($this->errors)===0 ? true : false);
    }

    /**
     * Agrega un ticket al sistema
     * 
     * @global type $primary_db
     * @global type $sess
     * @param type $ticket (un objeto ticket anonimo desde JSON)
     * @return type
     */    
     function fromJSON($ticket) {
        error_log("ticket::fromJSON() ticket->".print_r($ticket,true));
        if( $ticket->object==='ingreso_ticket') {
            $this->tic_tipo         = _g($ticket,'tic_tipo');
            $this->tic_tstamp_in    = _g($ticket,'tic_tstamp_in'); 
            $this->tic_nota_in      = _g($ticket,'tic_nota_in');
    
            //Fecha de carga
            if( $this->tic_tstamp_in==='' )
                $this->tic_tstamp_in = DatetoISO8601('');

            
            //Ubicacion
            $this->tic_barrio       = _g($ticket,'tic_barrio');
            $this->tic_cgpc         = _g($ticket,'tic_cgpc');
            $this->tic_coordx       = _g($ticket,'tic_coordx');
            $this->tic_coordy       = _g($ticket,'tic_coordy');
            $this->tic_nombre_fantasia = _g($ticket,'tic_lugar');
            $this->tic_calle_nombre = _g($ticket,'tic_calle_nombre');
            $this->tic_nro_puerta   = _g($ticket,'tic_nro_puerta');
            $this->tic_piso         = _g($ticket,'tic_piso');
            $this->tic_dpto         = _g($ticket,'tic_dpto');
            $this->id_luminaria     = _g($ticket,'id_luminaria');
            $this->tic_lugar = $this->createLugar();
            
            //Agrego Prestacion
            $this->prestaciones = prestacion::fromJSON($ticket,$this);
            
            //Agrego Ciudadano Solicitante
            $ciu = new solicitante();
            $ciu->ciu_nombres       = _g($ticket,'ciu_nombre');
            $ciu->ciu_apellido      = _g($ticket,'ciu_apellido');
            $ciu->ciu_telefono_movil = _g($ticket,'ciu_movil');
            $ciu->ciu_email         = _g($ticket,'ciu_email');
            $ciu->ciu_documento     = _g($ticket,'ciu_documento');
            $ciu->ttc_tstamp        = $this->tic_tstamp_in;
            $this->solicitantes[] = $ciu;
                                
            //Foto
            $this->media = _g($ticket,'media');
            
    //Defaults que hay que meter si no estan en el JSON
                
            //Canal de ingreso
            $this->tic_canal = 'movil';
            
            //Estado del ticket
            $this->tic_estado = 'ABIERTO';
            
            //Plazo de ejecución
            $this->tic_tstamp_plazo  = $this->prestaciones[0]->ttp_tstamp_plazo;
            
            //Operador
            $this->use_code = loadOperador();
        }
        
    }
        
    static private function generaCodigoTicket($tipo,$anio)
    {
        global $primary_db;
        return $primary_db->Sequence("$tipo-$anio");
    }
    
    static private function addPhotoBase64($tic_nro, $media) {
        global $primary_db,$sess;
        $errores = array();
        
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
                $n = $q[0];
                $a = $q[1];
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
    
    function getNro() {
        return $this->tic_nro;
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
            $this->tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$this->tic_identificador}'");
            if( intval($this->tic_nro)==0 ) 
                return false; //El ticket pedido no existe               
        }
        
        
        //Ya se en este punto que el ticket existe. Lo cargo ahora completo desde la base
        $row = $primary_db->QueryArray("select * from tic_ticket where tic_nro='{$this->tic_nro}'");
    
        $this->tic_tipo = $row['tic_tipo'];
        $this->tic_nro_asociado = $row['tic_nro_asociado'];
        $this->tic_tstamp_in = DatetoISO8601($row['tic_tstamp_in']);
        $this->use_code = loadOperador($row['use_code']);
        $this->tic_nota_in = $row['tic_nota_in'];
        $this->tic_estado = $row['tic_estado'];
        $this->tic_lugar = json_decode($row['tic_lugar']);
        $this->tic_barrio = $row['tic_barrio'];
        $this->tic_cgpc = $row['tic_cgpc'];
        $this->tic_coordx = $row['tic_coordx'];
        $this->tic_coordy = $row['tic_coordy'];
        $this->tic_canal = $row['tic_canal'];
        $this->tic_tstamp_plazo = DatetoISO8601($row['tic_tstamp_plazo']);
        $this->tic_tstamp_cierre = DatetoISO8601($row['tic_tstamp_cierre']);
        $this->tic_calle_nombre = $row['tic_calle_nombre'];
        $this->tic_nro_puerta = $row['tic_nro_puerta'];
        $this->tic_cruza_calle = $row['tic_cruza_calle'];
       
        $this->prestaciones = prestacion::factory($this->tic_nro);
        $this->solicitantes = solicitante::factory($this->tic_nro);
        $this->reiteraciones = reiteracion::factory($this->tic_nro);
        $this->asociados = asociado::factory($this->tic_nro);
        
        return true;
    }
 
    
    function save() {
         global $primary_db,$sess;
         $errores=array();
         
         //Validacion de los datos recibidos. Datos minimos para crear un ticket
         if($this->tic_tipo==='')
             $this->errors[] = "Campo obligatorio tic_tipo faltante";

         if($this->tic_coordx==='')
             $this->errors[] = "Campo obligatorio tic_coordx faltante";

         if($this->tic_coordy==='')
             $this->errors[] = "Campo obligatorio tic_coordy faltante";

         if($this->tic_calle_nombre==='')
             $this->errors[] = "Campo obligatorio tic_calle_nombre faltante";

         if($this->tic_nro_puerta==='' && $this->tic_cruza_calle==='')
             $this->errors[] = "Campo obligatorio tic_nro_puerta o tic_cruza_calle faltante";
         
         //Prestacion
         if(!isset($this->prestaciones[0]))
             $this->errors[] = "Debe incluir una prestacion como minimo";
         elseif($this->prestaciones[0]->tpr_code==='')
             $this->errors[] = "Campo obligatorio tpr_code faltante";
             
         //Solicitante
         if(!isset($this->solicitantes[0]))
             $this->errors[] = "Debe incluir por lo menos un solicitante";
         else 
         {    
            $sol = $this->solicitantes[0];
            if($sol->ciu_documento==='')
                $this->errors[] = "Campo obligatorio ciu_documento faltante";

            if($sol->ciu_nombres==='')
                $this->errors[] = "Campo obligatorio ciu_nombre faltante";

            if($sol->ciu_apellido==='')
                $this->errors[] = "Campo obligatorio ciu_apellido faltante";
         }
         
         //Se produjo algun error?
         if(!$this->getStatus())
             return false;
         
         //Salvo el ticket
         $primary_db->beginTransaction();
         
         //Codigo interno del ticket
         $this->tic_nro = $primary_db->Sequence("tic_tickets");
          
         //Codigo del ticket publico
         $tic_anio = date("Y"); //Año actual
         $tic_numero = self::generaCodigoTicket($this->tic_tipo, $tic_anio);
         $this->tic_identificador = $this->tic_tipo.' '.$tic_numero.'/'.$tic_anio;
           
         //Determino el plazo del ticket
         $plazo = $this->prestaciones[0]->getPlazo();
         $plazo_unit = $this->prestaciones[0]->getPlazoUnit();

         //Salvo el ticket (tic_ticket)
         $sql1 = "insert into tic_ticket (tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador) 
                    values (:tic_nro:, :tic_numero:, :tic_anio:, ':tic_tipo:', ':tic_tstamp_in:', ':use_code:', ':tic_nota_in:', 'ABIERTO', ':tic_lugar:', ':tic_barrio:', ':tic_cgpc:', :tic_coordx:, :tic_coordy:, 0, 0, 'movil', NOW() + INTERVAL :plazo: :plazo_unit:, null, ':tic_calle_nombre:', :tic_nro_puerta:, null, ':tic_identificador:')";
         $params1 = array(
                'tic_nro'           => $this->tic_nro,
                'tic_numero'        => $tic_numero, 
                'tic_anio'          => $tic_anio, 
                'tic_tipo'          => $this->tic_tipo, 
                'tic_tstamp_in'     => $this->tic_tstamp_in, 
                'use_code'          => $sess->getUserId(), 
                'tic_nota_in'       => $this->tic_nota_in, 
                'tic_lugar'         => json_encode($this->tic_lugar), 
                'tic_barrio'        => $this->tic_barrio, 
                'tic_cgpc'          => $this->tic_cgpc, 
                'tic_coordx'        => $this->tic_coordx, 
                'tic_coordy'        => $this->tic_coordy, 
                'plazo'             => $plazo, 
                'plazo_unit'        => $plazo_unit, 
                'tic_calle_nombre'  => $this->tic_calle_nombre, 
                'tic_nro_puerta'    => $this->tic_nro_puerta, 
                'tic_identificador' => $this->tic_identificador
         );
         $primary_db->do_execute($sql1,$errores,$params1);
         
         //Salvo las prestaciones
         foreach($this->prestaciones as $prest) 
             $prest->save($this); 
          
         //Salvo los solicitantes
         foreach($this->solicitantes as $so)
             $so->save($this);
         
         //Salvo los reiterantes
         foreach($this->reiteraciones as $re)
             $re->save($this);

         //Salvo los tickets asociados a este
         foreach($this->asociados as $asoc)
             $asoc->save($this);

         //Mando una foto? La salvo como un adjunto
         if($this->media!=='') {
              self::addPhotoBase64($this->tic_nro, $this->media);
         }
          
         if (count($errores) > 0 ) {
            $primary_db->rollbackTransaction();
            $this->errors[] = 'Error al crear el ticket';
         } else { 
            $primary_db->commitTransaction();
         }
          
         return true;
    }
    
    function toJSON() {
        return json_encode($this);
    }
    
    
    private function createLugar() {
	
        /** Tipo de geo referencia DOMICILIO, CEMENTERIO, VILLA, LUMINARIA, PLAZA, ORGAN.PUBLICO */
        switch($this->tipo_georef) {
            case "LUMINARIA":
                $geo = array(
                    'tipo'		=> 'LUMINARIA',
                    'alternativa'       => $this->alternativa,
                    'calle_nombre' 	=> $this->tic_calle_nombre,
                    'calle'             => $this->tic_calle,
                    'callenro'          => $this->tic_nro_puerta,
                    'barrio'            => $this->tic_barrio,
                    'comuna'            => $this->tic_cgpc,
                    'lat'		=> $this->tic_coordx,
                    'lng'		=> $this->tic_coordy,
                    'id_luminaria'      => $this->id_luminaria,
                    'calle_nombre2' 	=> $this->tic_calle_nombre2,
                    'calle2'            => $this->tic_calle2,
                );
                break;
            case "DOMICILIO":
                $geo = array(
                    'tipo'              => 'DOMICILIO',
                    'alternativa'       => $this->alternativa,
                    'calle_nombre'      => $this->tic_calle_nombre,
                    'calle'             => $this->tic_calle,
                    'callenro'          => $this->tic_nro_puerta,
                    'piso'              => $this->tic_piso,
                    'dpto'              => $this->tic_dpto,
                    'nombre_fantasia'   => $this->tic_nombre_fantasia,
                    'barrio'            => $this->tic_barrio,
                    'comuna'            => $this->tic_cgpc,
                    'lat'               => $this->tic_coordx,
                    'lng'               => $this->tic_coordy,
                    'calle_nombre2' 	=> $this->tic_calle_nombre2,
                    'calle2'            => $this->tic_calle2,
                );
                break;
            case "VILLA":
                $geo = array(
    			'tipo'		=> 'VILLA',
	    		'villa' 	=> $this->villa,
	    		'manzana' 	=> $this->vilmanzana,
	    		'casa' 		=> $this->vilcasa,
    			'lat'		=> $this->tic_coordx,
    			'lng'		=> $this->tic_coordy,
    		);
                break;
            case "PLAZA":
                $geo = array(
    			'tipo'          => 'PLAZA',
    			'plaza'         => $this->plaza,
                        'lat'           => $this->tic_coordx,
    			'lng'           => $this->tic_coordy,
    		);
                break;
            case "CEMENTERIO":
                $geo = array(
    			'tipo'		=> 'CEMENTERIO',
	    		'cementerio' 	=> $this->cementerio,
	    		'sepultura' 	=> $this->sepultura,
	    		'sector' 	=> $this->sepsector,
	    		'calle' 	=> $this->sepcalle,
	    		'numero' 	=> $this->sepnumero,
	    		'fila' 		=> $this->sepfila,
    			'lat'		=> $this->tic_coordx,
    			'lng'		=> $this->tic_coordy,
    		);
                break;
            case "ORGAN.PUBLICO":
                $geo = array(
   			'tipo'          => 'ORGAN.PUBLICO',
	    		'organismo'	=> $this->orgpublico,
	    		'sector' 	=> $this->orgsector,
    			'lat'		=> $this->tic_coordx,
    			'lng'		=> $this->tic_coordy,
    		);	
                break;
            default:
                break;
        }
    	 
    	return $geo;
    }
    
    function prestacionesTerminadas() {
        $cerradas = 0;
       
        foreach($this->prestaciones as $pres) {
            if( $pres->ttp_estado==='cerrado' || $pres->ttp_estado==='rechazado' )
                $cerradas++;
        }
        
        return ($cerradas==count($this->prestaciones)-1 ? true : false);            
    }
    
    function cambiar_estado($tpr_code,$nuevo_estado,$nota) {
        global $primary_db;
        $estado = strtolower($nuevo_estado);
        
        error_log("ticket::cambiar_estado($tpr_code,$nuevo_estado,$nota)");
        
        //Salvo el ticket
        $primary_db->beginTransaction();
         
        //Busco la prestacion a modificar
        foreach($this->prestaciones as $pres) {
            if( $pres->tpr_code===$tpr_code ) {
        
                //Modificar el estado de la prestacion del ticket
                //Agregar un evento de avance a la prestacion
                $pres->cambiar_estado($this,$nuevo_estado,$nota);
                        
                //Se cerro todo el ticket? Cambio de estado al ticket
                $pres->ttp_estado = $estado;
                if( $estado==='cerrado' || $estado==='rechazado' ) {
                    if( $this->prestacionesTerminadas() ) {
                        $this->tic_estado = 'CERRADO';
                    }
                }

                //Grabo los cambios
                $this->update();
                
                //Aviso al WS MiCiudad si el ticket es del canal movil.
                if($this->tic_canal==='movil') {
                    //Creo un evento para notificacion asincronica
                }
                    
                //Si se cerró el ticket, envio las notificaciones
                if( $this->tic_estado=='CERRADO' ) {
                    //Definicion de la prestacion
                    $al_final = $primary_db->QueryString("select tpr_al_final from tic_prestaciones where tpr_code='{$pres->tpr_code}'");

                    //Aviso x mail si es el fin de la prestacion a los responsables
                    if( $al_final!='' ) {
                        $this->notificarEmail('aviso_cierre_interno', $pres, $nota, $al_final);                
                    }

                    //Aviso x mail a los ciudadanos interesados (y registro esto en su historia)
                    $this->notificarSolicitantes('aviso_cierre', $pres, $nota);
                }
            }
        }
        
        if(count($this->errors)>0) {
            $primary_db->rollbackTransaction();
            $this->errors[] = 'Error al crear el ticket';
        } else { 
            $primary_db->commitTransaction();
        }
    }
    
    function update() {
         global $primary_db;
         $errores=array();
                        
         //Actualizo el ticket (tic_ticket)
         $sql1 = "update tic_ticket set tic_estado=':tic_estado:', tic_tstamp_cierre=':tic_tstamp_cierre:' where tic_nro=:tic_nro:";
         $params1 = array(
            'tic_nro'           => $this->tic_nro,
            'tic_tstamp_cierre' => $this->tic_tstamp_cierre, 
            'tic_estado'        => $this->tic_estado
         );
         $primary_db->do_execute($sql1,$errores,$params1);
        
         if(count($errores)>0)
             $this->errors = array_merge($this->errors, $errores);
    }
    
    //Envia un mensaje a cada solicitante y crea un registro en su historia
    function notificarSolicitantes($template, $prestacion, $nota) {
        
        foreach($this->solicitantes as $sol) {
            $email = $sol->ciu_email;
            if($email!='') {
                $this->notificarEmail($template, $prestacion, $nota, $email,$sol->ciu_nombres,$sol->ciu_apellido);
           }
        }
    }
    
    
    //Envia un mensaje a cada solicitante y crea un registro en su historia
    function notificarEmail($template, $prestacion, $nota, $email, $nombres='', $apellido='') {
        
        $subject = 'Cambio de estado de ticket';        
        if($email!='') {

            //Armo la dirección
            $direccion = $this->tic_calle_nombre.' '.$this->tic_nro.' '.($this->tic_cruza_calle!='' ? 'y '.$this->tic_cruza_calle : '');
            if($this->tic_nro!='') {
                $direccion.= ($this->tic_piso!='' ? ' piso '.$this->tic_piso : '');
                $direccion.= ($this->tic_dpto!='' ? ' dpto '.$this->tic_dpto : '');
            }

            $last_avance = $prestacion->getLastAvance();

            //Campos del template
            $tem_fld = json_encode(array(
                'ticket'        => $this->tic_identificador,
                'prestacion'    => $prestacion->tpr_description,
                'direccion'     => $direccion,
                'lat'           => $this->tic_coordx,
                'lng'           => $this->tic_coordy,
                'nombre'        => $nombres,
                'apellido'      => $apellido,
                'estado_ticket' => $this->tic_estado,
                'fecha'         => ISO8601toDate($last_avance->tav_tstamp_in),
                'estado_prest'  => $prestacion->ttp_estado,
                'nota'          => $nota
            ));

            $msg = new cmessage();
            $mt = new cmail_type("HTML",'','',$template);
            $headers = array();
            $r = $msg->Send(DEFAULT_SMTP,$email,$mt,$headers,$subject,$tem_fld);
        }    
    }

    /** Ticket creado en la UI por un operador
     * 
     */
    function fromForm($obj) {
        
        //Recupero los campos del form
        $this->tic_nota_in = _F($obj,"tic_nota_in");
                        
        //ESTILO DE GEOREFERENCIA
        $this->tipo_georef = _F($obj,"tipo_georef");
        
        switch($this->tipo_georef) {
            case 'DIRECCION':        
                $this->alternativa          = _F($obj,"alternativa");
                $this->tic_barrio           = _F($obj,"tic_barrio");
                $this->tic_cgpc             = _F($obj,"tic_cgpc");
                $this->tic_coordx           = _F($obj,"tic_coordx");
                $this->tic_coordy           = _F($obj,"tic_coordy");
                $this->tic_nro_puerta       = _F($obj,"callenro");
                $this->tic_calle_nombre     = _F($obj,"calle_nombre");
                $this->tic_nombre_fantasia  = _F($obj,"nombre_fantasia");
                $this->tic_calle_nombre2    = _F($obj,"calle_nombre2");
                $this->tic_calle            = _F($obj,"calle");
                $this->tic_calle2           = _F($obj,"calle2");
                $this->id_cuadra            = _F($obj,"tic_id_cuadra");
                break;
            case 'VILLA':
                $this->villa          = _F($obj,"villa");
                $this->vilmanzana     = _F($obj,"vilmanzana");
                $this->vilcasa        = _F($obj,"vilcasa");
                $this->tic_coordx     = _F($obj,"tic_coordx");
                $this->tic_coordy     = _F($obj,"tic_coordy");
                break;
            case 'PLAZA':
                $this->plaza        = _F($obj,"plaza");
                $this->tic_coordx   = _F($obj,"tic_coordx");
                $this->tic_coordy   = _F($obj,"tic_coordy");
                break;
            case 'ORGA.PUBLICO':
                $this->orgpublico     = _F($obj,"orgpublico");
                $this->orgsector      = _F($obj,"orgsector");
                $this->tic_coordx     = _F($obj,"tic_coordx");
                $this->tic_coordy     = _F($obj,"tic_coordy");
                break;
            case 'CEMENTERIO':
                $this->cementerio = _F($obj,"cementerio");
                $this->sepultura  = _F($obj,"sepultura");
                $this->sepsector  = _F($obj,"sepsector");
                $this->sepcalle   = _F($obj,"sepcalle");
                $this->sepnumero  = _F($obj,"sepnumero");
                $this->sepfila    = _F($obj,"sepfila");
                $this->tic_coordx = _F($obj,"tic_coordx");
                $this->tic_coordy = _F($obj,"tic_coordy");
                break;
            case 'LUMINARIA':
                $this->alternativa        = _F($obj,"alternativa_lum");
                $this->tic_barrio         = _F($obj,"tic_barrio_lum");
                $this->tic_cgpc           = _F($obj,"tic_cgpc_lum");
                $this->tic_nro_puerta     = _F($obj,"callenro_lum");
                $this->tic_calle_nombre   = _F($obj,"calle_nombre_lum");
                $this->tic_calle_nombre2  = _F($obj,"calle_nombre2_lum");
                $this->id_luminaria       = _F($obj,"id_luminaria");
                $this->tic_calle          = _F($obj,"calle_lum");
                $this->tic_calle2         = _F($obj,"calle2_lum");
                $this->id_cuadra          = _F($obj,"tic_id_cuadra");
                $this->tic_coordx         = _F($obj,"tic_coordx");
                $this->tic_coordy         = _F($obj,"tic_coordy");

                break;
            default:
                $this->addError('Opción de GEOREFERENCIA desconocida: '.$this->tipo_georef);
        }
        
        //Tipo de prestacion y descripción
        $this->prestaciones = prestacion::fromForm($obj);
       
        //Tipo de ticket es igual al tipo de la prestacion ingresada (RECLAMO, DENUNCIA,...)
        $this->tic_tipo = $this->prestaciones[0]->getTipoPrestacion();

        //Amplio la nota.
        switch($this->tipo_georef) {
            case "VILLA":
                $this->tic_nota_in = trim($this->tic_nota_in)." En villa: {$this->villa} manzana: {$this->vilmanzana} casa: {$this->vilcasa}";
                break;
            case "PLAZA":
                $this->tic_nota_in = trim($this->tic_nota_in)." En plaza: {$this->plaza}";
                break;
            case "CEMENTERIO":
                $this->tic_nota_in = trim($this->tic_nota_in)." En cementerio: {$this->cementerio} sep: {$this->sepultura} sect: {$this->sepsector} calle: {$this->sepcalle} número: {$this->sepnumero} fila: {$this->sepfila}";
                break;    
            case "DOMICILIO":
            case "LUMINARIA":
                if($this->tic_nombre_fantasia!=='' && $this->tic_tipo=="RECLAMO")
                    $this->tic_nota_in = trim($this->tic_nota_in)." Nombre fantasía: {$this->tic_nombre_fantasia}";
                break;
            default:
                break;
        }
        
        //Valido la altura de la calle
        if($this->tic_nro_puerta=="")
            $this->tic_nro_puerta = 1;
        
        //La altura de la calle no puede ser blanco, si no esta definido debe ser 0
        $this->id_cuadra = ($this->id_cuadra=="" ? 0 : $this->id_cuadra);
        
        //Las coordeanadas no pueden estar en blanco
        $this->tic_coordx = ($this->tic_coordx=="" ? 0 : $this->tic_coordx);
        $this->tic_coordy = ($this->tic_coordy=="" ? 0 : $this->tic_coordy);
        
        //Creo la descripcion del lugar
        $this->tic_lugar = $this->createLugar();
        
        //Usuario que esta creando el ticket
        $this->solicitantes = solicitante::fromForm($obj);
        
        //Canal de ingreso del ticket
        $this->tic_canal = $this->determinarCanal();
                 
    }
    
    //Determina el canal de ingreso, mirando en los atributos del usuario
    private function determinarCanal()
    {
        $canal = "CALL";

        //Reviso los grupos del usurio logeado busco uno que diga canal_
        if( isset($_SESSION['groups']) )
        {
            $partes = explode(",",$_SESSION['groups']);
            foreach($partes as $grupo)
            {
            	$grp = strtoupper(trim($grupo));
                if( substr($grp,0,6)=="CANAL_" )
                {
                    $canal = substr($grupo,7);
                    break;
                }
            }
        }
        
        return $canal;
    }

       
   
}


?>
