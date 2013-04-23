<?php
include_once 'beans/functions.php';
include_once 'common/cfile.php';
include_once 'beans/ciudadano.php';
include_once 'beans/prestacion.php';
include_once 'beans/solicitante.php';
include_once 'beans/reiteracion.php';
include_once 'beans/asociado.php';

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
    
    /** Nombre del lugar, como Hospital Pirulo */
    private $tic_nombre_fantasia;
    
    /** Nombre de la calle */
    private $tic_calle_nombre;
    
    /** Numero de la puerta */
    private $tic_nro_puerta;

    /** Piso */
    private $tic_piso;

    /** Departamento */
    private $tic_dpto;

    /** Nombre de la calle que se cruza */
    private $tic_cruza_calle;

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
            $prest = new prestacion();
            $prest->fromJSON($ticket);
            $this->prestaciones[] = $prest;
            
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
            $this->media = $ticket->media;
            
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
        $codigo = $primary_db->Sequence("$tipo-$anio");
        return $codigo;
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
            $tic_nro = $primary_db->QueryString("select tic_nro from tic_ticket where tic_identificador='{$this->tic_identificador}'");
            if( intval($tic_nro)==0 ) 
                return false; //El ticket pedido no existe               
        }
        
        
        //Ya se en este punto que el ticket existe. Lo cargo ahora completo desde la base
        $row = $primary_db->QueryArray("select * from tic_ticket where tic_nro='{$tic_nro}'");
    
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
       
        $this->prestaciones = prestacion::factory($tic_nro);
        $this->solicitantes = solicitante::factory($tic_nro);
        $this->reiteraciones = reiteracion::factory($tic_nro);
        $this->asociados = asociado::factory($tic_nro);
        
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
        global $primary_db;
	
        //Es una luminaria?
        if($this->id_luminaria!=='') {
            $geo = array(
                'tipo'		=> 'LUMINARIA',
                'calle_nombre' 	=> $primary_db->Filtrado($this->tic_calle_nombre),
                'calle'         => 0,
                'callenro' 	=> $primary_db->Filtrado($this->tic_nro_puerta),
                'cruza_calle'   => $primary_db->Filtrado($this->tic_cruza_calle),
                'barrio' 	=> $primary_db->Filtrado($this->tic_barrio),
                'comuna' 	=> $primary_db->Filtrado($this->tic_cgpc),
                'lat'		=> $primary_db->Filtrado($this->tic_coordx),
                'lng'		=> $primary_db->Filtrado($this->tic_coordy),
                'id_luminaria'  => $primary_db->Filtrado($this->id_luminaria),
            );
            
        }
        else
        {
            $geo = array(
                'tipo'              => 'DOMICILIO',
                'calle_nombre'      => $primary_db->Filtrado($this->tic_calle_nombre),
                'calle'             => 0,
                'callenro'          => $primary_db->Filtrado($this->tic_nro_puerta),
                'cruza_calle'       => $primary_db->Filtrado($this->tic_cruza_calle),
                'piso'              => $primary_db->Filtrado($this->tic_piso),
                'dpto'              => $primary_db->Filtrado($this->tic_dpto),
                'nombre_fantasia'   => $primary_db->Filtrado($this->tic_nombre_fantasia),
                'barrio'            => $primary_db->Filtrado($this->tic_barrio),
                'comuna'            => $primary_db->Filtrado($this->tic_cgpc),
                'lat'               => $primary_db->Filtrado($this->tic_coordx),
                'lng'               => $primary_db->Filtrado($this->tic_coordy),
            );
        }
    	
    	return $geo;
    }
}


?>
