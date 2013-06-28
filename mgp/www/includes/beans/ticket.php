<?php
include_once 'beans/functions.php';
include_once 'common/cfile.php';
include_once 'beans/ciudadano.php';
include_once 'beans/prestacion.php';
include_once 'beans/solicitante.php';
include_once 'beans/reiteracion.php';
include_once 'beans/asociado.php';
include_once 'common/cmessaging.php';
include_once 'beans/archivo.php';
include_once 'beans/eventbus_event.php';

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
    
    /** Array con los archivos adjuntos */
    public $archivos;
    
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
        $this->archivos = array();
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
        
         //error_log("ticket::fromJSON() ticket->".print_r($ticket,true));
        
        if( $ticket->object==='ingreso_ticket') {
            $this->tic_tipo         = _g($ticket,'tic_tipo');
            $this->tic_tstamp_in    = _g($ticket,'tic_tstamp_in'); 
            $this->tic_nota_in      = _g($ticket,'tic_nota_in');
    
            //Fecha de carga
            if( $this->tic_tstamp_in==='' )
                $this->tic_tstamp_in = DatetoISO8601('');

            //Tipo de georeferencia
            $this->id_luminaria     = (int) _g($ticket,'id_luminaria');
            $this->tipo_georef      = _g($ticket,'tipo_georef');
            if($this->tipo_georef==='')
                $this->tipo_georef = ($this->id_luminaria===0 ? 'DOMICILIO' : 'LUMINARIA');
            
            //Ubicacion
            $this->tic_barrio       = _g($ticket,'tic_barrio');
            $this->tic_cgpc         = _g($ticket,'tic_cgpc');
            $this->tic_coordx       = (double) _g($ticket,'tic_coordx');
            $this->tic_coordy       = (double) _g($ticket,'tic_coordy');
            $this->tic_nombre_fantasia = _g($ticket,'tic_lugar');
            $this->tic_calle_nombre = _g($ticket,'tic_calle_nombre');
            $this->tic_nro_puerta   = (int) _g($ticket,'tic_nro_puerta');
            $this->tic_piso         = _g($ticket,'tic_piso');
            $this->tic_dpto         = _g($ticket,'tic_dpto');
            $this->tic_lugar        = $this->createLugar();
            
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
            $this->tic_canal = strtoupper( _g($ticket,'tic_canal') );
            if($this->tic_canal=='')
                $this->tic_canal = 'MOVIL';
            
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
    
    static private function addPhotoBase64($tic_nro, $media, $f_name='', $nota='', $mime='image/jpeg', $publico='SI') {
        global $primary_db,$sess;
        $errores = array();
        
        if($media=='')
            return '';
        
        //Decodifico la foto
        $f = base64_decode($media);
        
        //Verifico que es una foto...
        
        //Datos de la foto
        if( $f_name==='' )
            $f_name = "foto_movil.jpg";
        
        //Nombre en el storage
        $ext = pathinfo($f_name, PATHINFO_EXTENSION);
        $f_storage = md5($f_name.rand()).'.'.$ext;
        
        //Creo el lugar en el storage
        $f_path = _CFile::get_path($f_storage);
        file_put_contents($f_path.$f_storage, $f);
        
        //Nota
        if( $nota==='' )
            $nota = 'Foto tomada con el móvil';
                
        //La relaciono al ticket (doc_documents)
        $doc_code = 'ticket:'.$tic_nro;
        $sql1 = "insert into doc_documents (doc_code    , doc_storage    , doc_name    , doc_tstamp, doc_mime    , doc_size    , acl_code, use_code    , doc_extension, doc_version, doc_note    , doc_deleted, doc_public) 
                                    values (':doc_code:', ':doc_storage:', ':doc_name:', NOW()     , ':doc_mime:', ':doc_size:', null    , ':use_code:', ':doc_extension:'       , '1'        , ':doc_note:', null       , ':doc_public:')";
          $params1 = array(
              'doc_code'    =>  $doc_code, 
              'doc_storage' =>  $f_storage, 
              'doc_name'    =>  $f_name, 
              'doc_size'    =>  strlen($f), 
              'use_code'    =>  $sess->getUserId(),
              'doc_note'    =>  $nota,
              'doc_public'  => ($publico==='SI' ? 'Y' : 'N'),
              'doc_extension'=> $ext,
              'doc_mime'    =>  $mime
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

    /** Numero interno del ticket
     * 
     * @param type $tic_nro
     */
    function setNro($tic_nro) {
        $this->tic_nro = $tic_nro;
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
    
    /** Numero interno del ticket
     * 
     * @return type
     */
    function getNro() {
        return $this->tic_nro;
    }
    
    /**
     * Numero del ticket (del identificador)
     * 
     * @return type
     */
    function getNroTicket() {
        // RECLAMO 4/2013
        $p = explode(' ',  str_replace('/',' ',$this->tic_identificador));
        return $p[1];
    }

    /**
     * Año del ticket (del identificador)
     * 
     * @return type
     */
    function getAnioTicket() {
        // RECLAMO 4/2013
        $p = explode(' ',  str_replace('/',' ',$this->tic_identificador));
        return $p[2];
    }
    
    /**
     * Carga el ticket desde la base de datos.
     * 
     * @global type $primary_db
     * @param type $opcion (todo, basico)
     * @return boolean
     */
    function load($opcion='todo') {
        global $primary_db;
        
        //Esta el identificador cargadado?
        if( $this->tic_identificador=='' && ($this->tic_nro=='' || $this->tic_nro==0) ) { 
            return false; //No se puede cargar el registro, sin indicar primero cual se busca   
        } else {
            if($this->tic_nro==0 || $this->tic_nro=='') {
                $this->tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$this->tic_identificador}'");
                if( intval($this->tic_nro)==0 ) 
                    return false; //El ticket pedido no existe         
            }      
        }
                
        //Ya se en este punto que el ticket existe. Lo cargo ahora completo desde la base
        $row = $primary_db->QueryArray("select * from tic_ticket where tic_nro='{$this->tic_nro}'");

        $this->tic_identificador = $row['tic_identificador'];
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
        //$this->tic_calle = ...
        $this->tic_nro_puerta = $row['tic_nro_puerta'];
        $this->tic_calle_nombre2 = $row['tic_cruza_calle'];
        //$this->tic_calle2 = ...
        
        $this->prestaciones = prestacion::factory($this->tic_nro);
        
        if($opcion=='archivos' || $opcion=='todo') {
            $this->archivos = archivo::factory($this->tic_nro);
        }
        
        if($opcion=='todo') {
            $this->solicitantes = solicitante::factory($this->tic_nro);
            $this->reiteraciones = reiteracion::factory($this->tic_nro);
            $this->asociados = asociado::factory($this->tic_nro);
        }
        
        return true;
    }
 
    /**
     * Crea un nuevo ticket en el sistema
     *  Si el ticket va a un sistema externo, entonces se debe crear una entrada en el event bus
     * 
     * * @global type $primary_db
     * @global type $sess
     * @return boolean
     */
    function save($transaction=true) {
         global $primary_db,$sess;
         $errores=array();
         
         //Validacion de los datos recibidos. Datos minimos para crear un ticket
         if($this->tic_tipo==='')
             $this->addError("Campo obligatorio tic_tipo faltante");

         if((double)$this->tic_coordx===0)
             $this->addError("Campo obligatorio tic_coordx faltante");

         if((double)$this->tic_coordy===0)
             $this->addError("Campo obligatorio tic_coordy faltante");

         if($this->tic_calle_nombre==='')
             $this->addError("Campo obligatorio tic_calle_nombre faltante");

         if((int)$this->tic_nro_puerta===0 && $this->tic_cruza_calle==='')
             $this->addError("Campo obligatorio tic_nro_puerta o tic_cruza_calle faltante");
         
         //Prestacion
         if(!isset($this->prestaciones[0]))
             $this->addError("Debe incluir una prestacion como minimo");
         elseif($this->prestaciones[0]->tpr_code==='')
             $this->addError("Campo obligatorio tpr_code faltante");
             
         //Solicitante
         if(!isset($this->solicitantes[0]))
             $this->addError("Debe incluir por lo menos un solicitante");
         else 
         {    
            $sol = $this->solicitantes[0];
            if($sol->ciu_documento==='')
                $this->addError("Campo obligatorio ciu_documento faltante");

            if($sol->ciu_nombres==='')
                $this->addError("Campo obligatorio ciu_nombre faltante");

            if($sol->ciu_apellido==='')
                $this->addError("Campo obligatorio ciu_apellido faltante");
         }
         
         //Se produjo algun error?
         if(!$this->getStatus())
             return false;
         
         //Salvo el ticket
         if($transaction)
             $primary_db->beginTransaction();
         
         //Codigo interno del ticket
         $this->tic_nro = $primary_db->Sequence("tic_tickets");
          
         //Codigo del ticket publico
         $tic_anio = date("Y"); //Año actual
         $tic_numero = self::generaCodigoTicket($this->tic_tipo, $tic_anio);
         $this->tic_identificador = $this->tic_tipo.' '.$tic_numero.'/'.$tic_anio;
           
         //Salvo el ticket (tic_ticket)
         $sql1 = "insert into tic_ticket (tic_nro  ,tic_numero  ,tic_anio  ,tic_tipo    ,tic_tstamp_in    ,use_code    ,tic_nota_in    ,tic_estado,tic_lugar    ,tic_barrio    ,tic_cgpc    ,tic_coordx  ,tic_coordy  ,tic_id_cuadra,tic_forms,tic_canal    , tic_tstamp_plazo    ,tic_tstamp_cierre,tic_calle_nombre    ,tic_nro_puerta  ,tic_nro_asociado,tic_identificador    ) 
                                  values (:tic_nro:,:tic_numero:,:tic_anio:,':tic_tipo:',':tic_tstamp_in:',':use_code:',':tic_nota_in:','ABIERTO' ,':tic_lugar:',':tic_barrio:',':tic_cgpc:',:tic_coordx:,:tic_coordy:,0            ,0        ,':tic_canal:', ':tic_tstamp_plazo:',null             ,':tic_calle_nombre:',:tic_nro_puerta:,null            ,':tic_identificador:')";
         $params1 = array(
                'tic_nro'           => $this->tic_nro,
                'tic_numero'        => $tic_numero, 
                'tic_anio'          => $tic_anio, 
                'tic_tipo'          => $this->tic_tipo, 
                'tic_tstamp_in'     => ISO8601toDate($this->tic_tstamp_in), 
                'use_code'          => $sess->getUserId(), 
                'tic_nota_in'       => $this->tic_nota_in, 
                'tic_lugar'         => json_encode($this->tic_lugar), 
                'tic_barrio'        => $this->tic_barrio, 
                'tic_cgpc'          => $this->tic_cgpc, 
                'tic_coordx'        => $this->tic_coordx, 
                'tic_coordy'        => $this->tic_coordy, 
                'tic_calle_nombre'  => $this->tic_calle_nombre, 
                'tic_nro_puerta'    => $this->tic_nro_puerta, 
                'tic_identificador' => $this->tic_identificador,
                'tic_canal'         => $this->tic_canal,
                'tic_tstamp_plazo'  => $this->tic_tstamp_plazo
         );
         $primary_db->do_execute($sql1,$errores,$params1);
         if(count($errores)>0)  
            $this->addError("Error al salvar el ticket en la base de datos");
         
         //Salvo las prestaciones
         if( $this->getStatus() ) {
            foreach($this->prestaciones as $prest) 
                $prest->save($this); 
         }
         
         //Salvo los solicitantes (y les mando un mail)
         if( $this->getStatus() ) {
            foreach($this->solicitantes as $so)
                $so->save($this);
         }
         
         //Salvo los reiterantes
         if( $this->getStatus() ) {
            foreach($this->reiteraciones as $re)
                $re->save($this);
         }
         
         //Salvo los tickets asociados a este
         if( $this->getStatus() ) {
            foreach($this->asociados as $asoc)
                $asoc->save($this);
         }
         
         //Mando una foto? La salvo como un adjunto
         if( $this->getStatus() ) {
           if($this->media!=='') {
                 self::addPhotoBase64($this->tic_nro, $this->media);
            }
         }
         
         if($transaction) {
            if( !$this->getStatus() ) {
               $primary_db->rollbackTransaction();
               $this->addError('Error al crear el ticket');
               error_log("ticket::save() Errores: ".$this->getErrorString());
               return false;
            } else { 
               $primary_db->commitTransaction();
            }
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
                $geo = array();
                break;
        }
    	 
    	return $geo;
    }
    
    function prestacionesTerminadas() {
        $cerradas = 0;
        $total = count($this->prestaciones);
        foreach($this->prestaciones as $pres) {
            $estado = strtolower($pres->ttp_estado);
            if( $estado==='cerrado' || $estado==='rechazado' )
                $cerradas++;
        }
        error_log("ticket::prestacionesTerminadas() Total:{$total} Cerradas:{$cerradas}");
        return ($cerradas==$total ? true : false);            
    }
    
    /**
     * Cambio de estado y agregado de archivos desde JSON (api)
     * 
     * @global type $primary_db
     * @param type $identificador
     * @param type $avance_json
     */
    function cambiar_estado_fromJSON($identificador, $avance_json) {
        global $primary_db;
        
        error_log("ticket::cambiar_estado_fromJSON(\$identificador=$identificador, \$avance_json)");
        /*
         * 
         * VALIDAR CAMBIOS DE ESTADO IMPOSIBLES
         * 
         * VALIDAR Tipo de documento aceptable
         */
        $primary_db->beginTransaction();

        $this->setIdent($identificador);
        $this->load('archivos');
        
        //Cambio de estado de la prestacion
        $avance = _g($avance_json, 'avance');
        $tpr_code = (isset($avance->tpr_code) ? $avance->tpr_code : '');
        $nuevo_estado = (isset($avance->tic_estado_in) ? $avance->tic_estado_in : '');
        $fecha = (isset($avance->tav_tstamp_in) ? $avance->tav_tstamp_in : '');
        $nota = (isset($avance->nota) ?  $avance->nota : '');
                
        if($tpr_code!=='' && $nuevo_estado!=='')
            $this->cambiar_estado($tpr_code, $nuevo_estado, $nota, $fecha, false);
        else
            $this->addError('Es obligatorio indicar la prestacion y el estado');
        
        //Agrego los archivos (si el cambio de estado fue OK)
        if($this->getStatus()) {

            $archivos = _g($avance_json,'archivos');
            if(is_array($archivos)) {
                foreach($archivos as $arch) {
                    //$tic_nro, $media, $f_name='', $nota='', $mime='image/jpeg', $publico='SI'
                    $media      = (isset($arch->media) ? $arch->media : ''); 
                    $nombre     = (isset($arch->nombre) ? $arch->nombre : 'foto.jpg'); 
                    $nota       = (isset($arch->nota) ? $arch->nota : ''); 
                    $tipo       = (isset($arch->tipo) ? $arch->tipo : 'image/jpeg'); 
                    $publico    = (isset($arch->publico) ? $arch->publico : 'SI');
                    
                    if($media!='')
                        self::addPhotoBase64($this->tic_nro, $media, $nombre, $nota, $tipo, $publico);
                    else
                        $this->addError ('Ha solicitado agregar un archivo vacío');
                }
            } else {
                $this->addError("La propiedad archivos debe ser un array.");
            }            
        }
        
        if( $this->getStatus() ) {
            $primary_db->commitTransaction();
        } else {           
            $primary_db->rollbackTransaction();
            $this->addError('Error al agregar archivos al ticket');
        }
    }
    
    function cambiar_estado($tpr_code,$nuevo_estado,$nota,$fecha='',$transaction=true) {
        global $primary_db;
        $estado = strtolower($nuevo_estado);
        
        error_log("ticket::cambiar_estado(\$tpr_code=$tpr_code,\$estado=$estado,\$nota=$nota,\$fecha=$fecha)");
        
        //Salvo el ticket
        if($transaction)
            $primary_db->beginTransaction();
        
        //Hay que corregir el codigo de prestacion? (porque le falta un cero delante)
        $lp = strlen($tpr_code);
        if( $lp % 2 !== 0 ) {
            $tpr_code = "0".$tpr_code;
            error_log("ticket::cambiar_estado(\$tpr_code=$tpr_code) se corrige codigo de prestacion");        
        }
        
        //Busco la prestacion a modificar
        $encontrada = false;
        foreach($this->prestaciones as $pres) {
            if( $pres->tpr_code===$tpr_code ) {
                $encontrada = true;
                
                //Modificar el estado de la prestacion del ticket
                //Agregar un evento de avance a la prestacion
                $pres->cambiar_estado($this,$estado,$nota);
                                        
                //Aviso al WS MiCiudad si el ticket es del canal movil.
                $canal = strtolower($this->tic_canal);
                if($canal==='movil' || $canal==='internet') {
                    $ev = new eventbus_event();
                    $ev->eev_task = 'miciudad';
                    $ev->eev_data = array(
                        'op'        =>  'cambio_estado',
                        'ticket'    =>  $this->tic_nro,
                        'prestacion'=>  $pres->tpr_code
                    );
                    $ev->save();        
                }
        
                //Notifica al event bus (si la prestacion lo requiere)
                $eev_task = $primary_db->QueryString("select eev_task from tic_prestaciones where tpr_code='{$pres->tpr_code}'");
                if($eev_task!=='') {
                    $ev = new eventbus_event();
                    $ev->eev_task = $eev_task;
                    $ev->eev_data = array(
                        'op'        =>  'cambio_estado',
                        'ticket'    =>  $this->tic_nro,
                        'prestacion'=>  $pres->tpr_code
                    );
                    $ev->save();        
                }                
                
                //Si se cerró el ticket, envio las notificaciones
                if( $this->tic_estado=='ABIERTO' ) {
                    if( $this->prestacionesTerminadas() ) {
                        $this->tic_estado = 'CERRADO';
                        error_log("ticket::cambiar_estado() CIERRO TICKET");

                        //Definicion de la prestacion
                        $al_final = $primary_db->QueryString("select tpr_al_final from tic_prestaciones where tpr_code='{$pres->tpr_code}'");

                        //Aviso x mail si es el fin de la prestacion a los responsables
                        if( $al_final!='' ) {
                            $this->notificarEmail('aviso_cierre_interno', $pres, $nota, $al_final);                
                        }

                        //Aviso x mail a los ciudadanos interesados (y registro esto en su historia)
                        $this->notificarSolicitantes('aviso_cierre', $pres, $nota);
                    } else {
                        //Cambio de estado intermedio
                        $this->notificarSolicitantes('aviso_cambio_estado', $pres, $nota);
                    }
                }
                
                //Grabo los cambios (solo la parte del ticket
                $this->update();
            }
        }
        
        if(!$encontrada)
            $this->addError('La prestación pedida no se encuentra en el ticket');
        
        if($transaction) {
            if(!$this->getStatus()) {
                $primary_db->rollbackTransaction();
                $this->addError('Error al cambiar de estado el ticket');
            } else { 
                $primary_db->commitTransaction();
            }
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
        error_log("notificarEmail(\$template={$template}, \$prestacion, \$nota={$nota}, \$email={$email}, \$nombres={$nombres}, \$apellido={$apellido}");
        $subject = '';        
        if($email!='') {

            //Armo la dirección
            $direccion = $this->tic_calle_nombre.' '.($this->tic_calle_nombre2!='' ? 'y '.$this->tic_calle_nombre2 : $this->tic_nro);
            if($this->tic_nro!='') {
                $direccion.= ($this->tic_piso!='' ? ' piso '.$this->tic_piso : '');
                $direccion.= ($this->tic_dpto!='' ? ' dpto '.$this->tic_dpto : '');
            }

            $last_avance = $prestacion->getLastAvance();

            //Campos del template
            $tem_fld = json_encode( array(
                'tic_identificador' => $this->tic_identificador,
                'prestacion'    => $prestacion->tpr_description,
                'lugar'         => $direccion,
                'lat'           => $this->tic_coordx,
                'lng'           => $this->tic_coordy,
                'nombre'        => $nombres,
                'apellido'      => $apellido,
                'estado_ticket' => $this->tic_estado,
                'fecha'         => ISO8601toDate($last_avance->tav_tstamp_in),
                'estado_prest'  => $prestacion->ttp_estado,
                'nota'          => $nota,
                'plazo'         => $this->tic_tstamp_plazo,
                'tic_tipo'      => $this->tic_tipo
            ));

            $msg = new cmessage();
            $mt = new cmail_type("HTML",'','',$template);
            $headers = array();
            $r = $msg->Send(DEFAULT_SMTP,$email,$mt,$headers,$subject,$tem_fld);
            error_log("notificarEmail() Resultado: {$r}");
        }    
    }

    /** Ticket creado en la UI por un operador
     * 
     */
    function fromForm($obj) {
        
        //Recupero los campos del form
        $this->tic_nota_in = _F($obj,"tic_nota_in");
        
        //Fecha de ingreso
        $this->tic_tstamp_in = DatetoISO8601(_F($obj,"tic_tstamp_in"));

        //Canal de ingreso
        $this->tic_canal = 'CALL';
        
        //ESTILO DE GEOREFERENCIA
        $this->tipo_georef = _F($obj,"tipo_georef");
        
        switch($this->tipo_georef) {
            case 'DOMICILIO':        
                $this->alternativa          = _F($obj,"alternativa");
                $this->tic_barrio           = _F($obj,"tic_barrio");
                $this->tic_cgpc             = _F($obj,"tic_cgpc");
                $this->tic_coordx           = (double) _F($obj,"tic_coordx");
                $this->tic_coordy           = (double) _F($obj,"tic_coordy");
                $this->tic_nro_puerta       = (int) _F($obj,"callenro");
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
                $this->tic_coordx     = (double) _F($obj,"tic_coordx");
                $this->tic_coordy     = (double) _F($obj,"tic_coordy");
                break;
            case 'PLAZA':
                $this->plaza        = _F($obj,"plaza");
                $this->tic_coordx   = (double) _F($obj,"tic_coordx");
                $this->tic_coordy   = (double) _F($obj,"tic_coordy");
                break;
            case 'ORGA.PUBLICO':
                $this->orgpublico     = _F($obj,"orgpublico");
                $this->orgsector      = _F($obj,"orgsector");
                $this->tic_coordx     = (double) _F($obj,"tic_coordx");
                $this->tic_coordy     = (double) _F($obj,"tic_coordy");
                break;
            case 'CEMENTERIO':
                $this->cementerio = _F($obj,"cementerio");
                $this->sepultura  = _F($obj,"sepultura");
                $this->sepsector  = _F($obj,"sepsector");
                $this->sepcalle   = _F($obj,"sepcalle");
                $this->sepnumero  = _F($obj,"sepnumero");
                $this->sepfila    = _F($obj,"sepfila");
                $this->tic_coordx = (double) _F($obj,"tic_coordx");
                $this->tic_coordy = (double) _F($obj,"tic_coordy");
                break;
            case 'LUMINARIA':
                $this->alternativa        = _F($obj,"alternativa_lum");
                $this->tic_barrio         = _F($obj,"tic_barrio_lum");
                $this->tic_cgpc           = _F($obj,"tic_cgpc_lum");
                $this->tic_nro_puerta     = (int) _F($obj,"callenro_lum");
                $this->tic_calle_nombre   = _F($obj,"calle_nombre_lum");
                $this->tic_calle_nombre2  = _F($obj,"calle_nombre2_lum");
                $this->id_luminaria       = (int) _F($obj,"id_luminaria");
                $this->tic_calle          = _F($obj,"calle_lum");
                $this->tic_calle2         = _F($obj,"calle2_lum");
                $this->id_cuadra          = _F($obj,"tic_id_cuadra");
                $this->tic_coordx         = (double) _F($obj,"tic_coordx");
                $this->tic_coordy         = (double) _F($obj,"tic_coordy");

                break;
            default:
                $this->addError('Opción de GEOREFERENCIA desconocida: >'.$this->tipo_georef.'<');
        }
        
        //Tipo de prestacion y descripción
        $this->prestaciones = prestacion::fromForm($obj);
       
        //Tipo de ticket es igual al tipo de la prestacion ingresada (RECLAMO, DENUNCIA,...)
        $this->tic_tipo = $this->prestaciones[0]->getTipoPrestacion();
        
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
        
        //Fecha de vencimiento del ticket
        $this->tic_tstamp_plazo = $this->prestaciones[0]->ttp_tstamp_plazo;
        
        $this->tic_estado = 'ABIERTO';
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

       
    static function factoryByCiudadano($ciu_code, $parte='tickets') {
        global $primary_db;        
        $res = array();
        
        switch($parte) {
            case 'tickets':

                $rs = $primary_db->do_execute("select * from tic_ticket_ciudadano where ciu_code='{$ciu_code}'");
                while( $row=$primary_db->_fetch_row($rs) )
                {
                    $tic_nro = $row['tic_nro'];

                    $t = new ticket();
                    $t->tic_nro = $tic_nro;
                    $t->load('basico');
                    $res[] = $t;
                }
                break;
            case 'reiterados':
                $rs2 = $primary_db->do_execute("select * from tic_ticket_ciudadano_reit where ciu_code='{$ciu_code}'");
                while( $row2=$primary_db->_fetch_row($rs2) )
                {
                    $tic_nro = $row2['tic_nro'];

                    $t = new ticket();
                    $t->tic_nro = $tic_nro;
                    $t->load('basico');
                    $res = $t;
                }
                break;
            default:
        }
        
        return $res;
    }
   
    /** Reiterar un ticket
     * 
     * @global cdbdata $primary_db
     * @param string $nota
     * @param string $documento
     * @param string $canal
     * @return boolean
     */
    function reiterar($nota, $documento, $canal) {
        global $primary_db;
        
        $primary_db->beginTransaction();
        $this->tic_canal = $canal;
        
        $r = new reiteracion();
        $r->ciu_documento = $documento;
        $r->ttc_nota = $nota;
        $r->save($this);
        $this->reiteraciones[] = $r;
        
        if( !$this->getStatus() ) {
            $primary_db->rollbackTransaction();
            $this->addError('Error al reiterar el ticket');
            error_log("ticket::reiterar() Errores: ".$this->getErrorString());
            return false;
        } else { 
            $primary_db->commitTransaction();
        }
        
        return true;
    }
}
