<?php

include_once 'beans/avance.php';
include_once 'beans/organismo.php';
include_once 'beans/cuestionario.php';
include_once 'beans/eventbus_event.php';

class prestacion {
    /** codigo de prestacion */
    public $tpr_code; 
    
    /** nombre de la prestacion */
    public $tpr_description;
    
    /** codigo de rubro */
    public $tru_code; 
    
    /** nombre del rubro */
    public $tru_description;
    
    /** estado de la prestacion */
    public $ttp_estado; 
    
    /** prioridad */
    public $ttp_prioridad;
    
    /** fecha prevista de cierre */
    public $ttp_tstamp_plazo; 
    
    /** Flag de alerta */
    public $ttp_alerta;

    /** Array de pregunstas que forman el cuestionario */
    public $cuestionario; 
    
    /** Array de eventos de avance */
    public $avance;
    
    /** Array de organismos vinculados a esta prestacion */
    public $organismos;
    
    /** Plazo (numerico) */
    private $plazo;
    
    /** Plazo (unidad) */
    private $plazo_unit;
    
    /** Tipo de prestacion: RECLAMO, DENUNCIA, SOLICITUD o QUEJA */
    private $tpr_tipo; 
    
    /** Tarea del event bus */
    private $eev_task;
    
    /** Constructor del objeto
     * 
     */
    function __construct() {
        $this->cuestionario = array(); 
        $this->avance = array();
        $this->organismos = array();       
        $this->ttp_alerta = 0;
        $this->ttp_prioridad = '1.1';
        $this->plazo = 10;
        $this->plazo_unit = 'DAY';
    }
    
    /** getter para el tipo de prestacion
     * 
     * @return type
     */
    function getTipoPrestacion() {
        return $this->tpr_tipo;
    }
    
    /** getter para el plazo
     * 
     * @return type
     */
    function getPlazo() {
        return $this->plazo;
    }

    /** getter para la unidad del plazo (DAY, HOUR, MINUTE)
     * 
     * @return type
     */
    function getPlazoUnit() {
        return $this->plazo_unit;
    }

    /** Recupera el ultimo registro de avance
     * 
     * @return type
     */
    function getLastAvance() {
        return $this->avance[ count($this->avance)-1 ];
    }
    
    /**
     * Salva la prestacion al crear un ticket
     * Debe notificar al event bus
     * 
     * @global type $primary_db
     * @param type $parent
     */
    function save($ticket) {
        global $primary_db;
        $errores = array();
          
        //Creo una prestacion (tic_ticket_prestaciones)
        $sql2 = "insert into tic_ticket_prestaciones (tic_nro  , tpr_code    , tru_code  , ttp_estado    , ttp_prioridad    , ttp_tstamp_plazo                     , ttp_alerta) 
                                              values (:tic_nro:, ':tpr_code:', :tru_code:, ':ttp_estado:', ':ttp_prioridad:', NOW() + INTERVAL :plazo: :plazo_unit:, ':ttp_alerta:')";
        $params2 = array(
            'tic_nro'             => $ticket->getNro(), 
            'tpr_code'            => $this->tpr_code, 
            'tru_code'            => ($this->tru_code!=='' ? $this->tru_code : 'null'), 
            'ttp_prioridad'       => $this->ttp_prioridad, 
            'plazo'               => $this->plazo,
            'plazo_unit'          => $this->plazo_unit,
            'ttp_alerta'          => $this->ttp_alerta,
            'ttp_estado'          => $this->ttp_estado
        );
        $primary_db->do_execute($sql2,$errores,$params2);
                
        //Le creo un primer registro de avance
        foreach($this->avance as $av)
            $av->save($ticket, $this->tpr_code);
         
        //Salvo los organismos
        foreach($this->organismos as $org)
            $org->save($ticket, $this->tpr_code);

        //Salvo el cuestionario
        foreach($this->cuestionario as $preg)
            $preg->save($ticket, $this->tpr_code);
        
        //Notifica al event bus
        $eev_task = $primary_db->QueryString("select eev_task from tic_prestaciones where tpr_code='{$this->tpr_code}'");
        if($eev_task!=='') {
            $ev = new eventbus_event();
            $ev->eev_task = $eev_task;
            $ev->eev_data = array(
                'op'        =>  'ingreso ticket',
                'ticket'    =>  $ticket->getNro(),
                'prestacion'=>  $this->tpr_code
            );
            $ev->save();        
        }
    }
    
    /**
     * Carga un array con las prestaciones que se corresponden a un ticket
     * 
     * @global type $primary_db
     * @param type $tic_nro
     * @return \prestacion
     */
    static function factory($tic_nro) {
        global $primary_db;
        $ret = array();
        $sql = "select * from tic_ticket_prestaciones ttp 
                    LEFT OUTER JOIN tic_prestaciones tpr ON ttp.tpr_code=tpr.tpr_code
                    LEFT OUTER JOIN tic_rubros tru ON ttp.tru_code=tru.tru_code    
                WHERE ttp.tic_nro='{$tic_nro}'";
        $rs = $primary_db->do_execute($sql);
        while( $row=$primary_db->_fetch_row($rs) ) {
            $prest = new prestacion();
            
            $prest->tpr_code          = $row['tpr_code'];
            $prest->tpr_description   = $row['tpr_detalle'];
            $prest->tru_code          = $row['tru_code'];
            $prest->tru_description   = $row['tru_detalle'];
            $prest->ttp_estado        = $row['ttp_estado'];
            $prest->ttp_prioridad     = $row['ttp_prioridad'];
            $prest->ttp_tstamp_plazo  = DatetoISO8601($row['ttp_tstamp_plazo']); 
            $prest->ttp_alerta        = $row['ttp_alerta'];
            $prest->avance            = avance::factory($tic_nro, $row['tpr_code']);
            $prest->organismos        = organismo::factory($tic_nro, $row['tpr_code']);
            $prest->cuestionario      = cuestionario::factory($tic_nro, $row['tpr_code']); 
            
            $ret[] = $prest;
        }
        return $ret;
    }

    /** Cargo una prestacion desde el ticket que viene de la API de MiCiudad
     * 
     * @global type $primary_db
     * @param type $ticket
     * @param type $parent
     * @return type
     */
    static function fromJSON($ticket_json, $ticket) {
        global $primary_db;
        
        $prest = new prestacion();
        $prest->tpr_code = _g($ticket_json,'tpr_code');
        $prest->ttp_estado = 'pendiente';
        
        //Datos de la prestacion
        $row = $primary_db->QueryArray("select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='{$prest->tpr_code}'");
        if( $row )
        {
            $prest->tpr_description = $row['tpr_detalle'];
            $prest->tpr_tipo = $row['tpr_tipo'];
            
            //El plazo viene en dos partes, una donde esta la cantidad y otra donde esta la unidad. Ejemplo: 2 dias
            list($prest->plazo, $prest->plazo_unit) = self::plazoComponents($row['tpr_plazo']);
        }

        //Rubros
        //Si es una denuncia entonces el rubro esta definido,
        //busco la prioridad ahi. Caso contrario se inician todos los tickets
        //con la misma prioridad.
        //Si esta declarada la georeferencia ahi, entonces le doy precedencia sobre la declarada en la prestación
        if($prest->tpr_tipo=="DENUNCIA")
        {
            $prest->tru_code = _g($ticket_json,"rubro");
            $prest->tru_description = $primary_db->QueryString("select tru_detalle from tic_rubros where tru_code='{$prest->tru_code}'");
                    
            $row = $primary_db->QueryArray("select tpr_prioridad,tor_code,tto_figura from tic_prestaciones_rubros where tpr_code='{$prest->tpr_code}' and tru_code='{$prest->tru_code}'");
            if( $row )
            {
                $prest->ttp_prioridad = $row['tpr_prioridad'];
                $tor_code = $row['tor_code'];
                $tto_figura= $row['tto_figura'];
                
                //Agrego el organismo indicado en el rubro
                if($tor_code!='') {
                    $org = new organismo();
                    $org->tor_activo = 'ACTIVO';
                    $org->tor_code = $tor_code;
                    $org->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$tor_code}'");
                    $org->tto_figura = $tto_figura;        
                    $prest->organismos[] = $org;
                }
            } 
            
            //Esta declarada la prioridad?
            if($prest->ttp_prioridad=="")
            {
                $prest->ttp_prioridad = "1.1";
            }
        }
        else
        {
            //Queja, Reclamo, Solicitud
            $prest->tru_code = 0;
            $prest->tru_description = '';
            $prest->ttp_prioridad = "1.1";
        }

        //Cargo las preguntas del cuestionario
        $prest->cuestionario    = cuestionario::factoryJSON($ticket_json,$ticket,$prest);

        //Creo un registro de avance
        $avance                 = new avance();
        $avance->tav_nota       = _g($ticket_json,'tic_nota_in');
        $avance->tav_tstamp_in  = DatetoISO8601();
        $avance->tic_estado_in  = 'pendiente';
        $avance->tic_motivo     = 'Ingreso desde móvil';
        $avance->use_code_in    = loadOperador();
        $prest->avance[]        = $avance;
        
        //En esta API solo se postea una prestacion
        //Hay que determinar que roles hay que levantar desde la definicion del GIS de prestaciones.
        $coordx = _g($ticket_json,'tic_coordx');
        $coordy = _g($ticket_json,'tic_coordy');
        return array( self::procesarGeoRef($prest, $coordx, $coordy) );  //Retorna un array con un solo objeto prestacion
    }
    
    /**
     * Cambia el estado de la prestacion
     * 
     * @global type $primary_db
     * @param type $parent
     * @param type $nuevo_estado
     * @param type $nota
     */
    function cambiar_estado($parent, $nuevo_estado,$nota) {
        global $primary_db;
        $errores = array();
        
        //Ajusto el ultimo avance
        $ult_avance = $this->avance[ count($this->avance)-1 ];
        $ult_avance->tav_tstamp_out = DatetoISO8601(); 
        $ult_avance->tic_estado_out = $nuevo_estado;
        $ult_avance->use_code_out = loadOperador('current');        
        $ult_avance->update($parent, $this->tpr_code);
                
        //Agrego un avance nuevo al stack
        $avance = new avance();
        $avance->tav_nota = $nota;
        $avance->tav_tstamp_in = DatetoISO8601();
        $avance->tic_estado_in = $nuevo_estado;
        $avance->tic_motivo = 'Cambio de estado';
        $avance->use_code_in = loadOperador('current');
        $this->avance[] = $avance;
        $avance->save($parent, $this->tpr_code);
        
        //Cambio el estado a la prestacion
        $this->ttp_estado = $nuevo_estado;
        
        //Salvo el cambio a la base
        $sql2 = "update tic_ticket_prestaciones set ttp_estado=':ttp_estado:' WHERE tic_nro=:tic_nro: AND tpr_code=':tpr_code:'";
        $params2 = array(
            'tic_nro'             => $parent->getNro(), 
            'tpr_code'            => $this->tpr_code, 
            'ttp_estado'          => $nuevo_estado
        );
        $primary_db->do_execute($sql2,$errores,$params2);   
    }
    
    static function plazoComponents($tpr_plazo) {
        if($tpr_plazo=="")
            return array("10", "DAY");
        
        $p = explode(' ',$tpr_plazo);
        $plazo = (double) $p[0];
        if(isset($p[1])) {
            switch ($p[1]) {
                case 'Días':
                    $plazo_unit = 'DAY';
                    break;
                case 'Horas':
                    $plazo_unit = 'HOUR';
                    break;
                case 'Minutos':
                    $plazo_unit = 'MINUTE';
                    break;
                default:
                    $plazo_unit = 'DAY';
            }
        } else {
            $plazo_unit = 'DAY';
        }
        
        return array($plazo, $plazo_unit);
    }
    
    
    /**
     * Cargar la prestacion desde la UI
     * 
     * @global type $primary_db
     * @param type $obj
     * @return type
     */
    static function fromForm($obj) {
        global $primary_db;
        
        $p = new prestacion();
        
        //El formulario de alta solo tiene una prestacion
        $p->tpr_code = _F($obj,"prestacion");
        $p->ttp_estado = 'pendiente';
        
        //Datos de la prestacion
        $row = $primary_db->QueryArray("select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='{$p->tpr_code}'");
        if( $row )
        {
            $p->tpr_description = $row['tpr_detalle'];
            $p->tpr_tipo = $row['tpr_tipo'];
            
            //El plazo viene en dos partes, una donde esta la cantidad y otra donde esta la unidad. Ejemplo: 2 dias
            list($p->plazo, $p->plazo_unit) = self::plazoComponents($row['tpr_plazo']);
        }
        
        
        //Si es una denuncia entonces el rubro esta definido,
        //busco la prioridad ahi. Caso contrario se inician todos los tickets
        //con la misma prioridad.
        //Si esta declarada la georeferencia ahi, entonces le doy precedencia sobre la declarada en la prestación
        if($p->tpr_tipo=="DENUNCIA")
        {
            $p->tru_code = _F($obj,"rubro");
            $p->tru_description = $primary_db->QueryString("select tru_detalle from tic_rubros where tru_code='{$p->tru_code}'");
                    
            $row = $primary_db->QueryArray("select tpr_prioridad,tor_code,tto_figura from tic_prestaciones_rubros where tpr_code='{$p->tpr_code}' and tru_code='{$p->tru_code}'");
            if( $row )
            {
                $p->ttp_prioridad = $row['tpr_prioridad'];
                $tor_code = $row['tor_code'];
                $tto_figura= $row['tto_figura'];
                
                //Agrego el organismo indicado en el rubro
                if($tor_code!='') {
                    $org = new organismo();
                    $org->tor_activo = 'ACTIVO';
                    $org->tor_code = $tor_code;
                    $org->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$tor_code}'");
                    $org->tto_figura = $tto_figura;        
                    $p->organismos[] = $org;
                }
            } 
            
            //Esta declarada la prioridad?
            if($p->ttp_prioridad=="")
            {
                $p->ttp_prioridad = "1.1";
            }
        }
        else
        {
            //Queja, Reclamo, Solicitud
            $p->tru_code = 0;
            $p->tru_description = '';
            $p->ttp_prioridad = "1.1";
        }

        //Primer registro de avance de la prestacion
        $avance = new avance();
        $avance->tav_nota = _F($obj,'tic_nota_in');
        $avance->tav_tstamp_in = DatetoISO8601();
        $avance->tic_estado_in = 'pendiente';
        $avance->tic_motivo = 'Ingreso por operador';
        $avance->use_code_in = loadOperador();
        $p->avance[] = $avance;
        
        //Cuestionario de la prestacion
        $p->cuestionario = cuestionario::fromForm($obj, $p);
        
        //Hay que determinar que roles hay que levantar desde la definicion del GIS de prestaciones.
        $coordx = (double) _F($obj,"tic_coordx");
        $coordy = (double) _F($obj,"tic_coordy");

        return array( self::procesarGeoRef($p, $coordx, $coordy) );        
    }
    
    /** Averiguo los organismos que deben ver o procesar este ticket
     * 
     * @global type $primary_db
     * @param type $obj (un objeto que contenga los campos tic_coordx, tic_coordy)
     * @param type $p (objeto prestacion)
     * @return type
     */

    static function procesarGeoRef($prest, $coordx, $coordy)
    {
        global $primary_db;
        
        $sql = "select tpg.tpg_usa_gis, tpg.tpg_gis_campo, tpg.tpg_gis_valor, tpg.tor_code, tpg.tto_figura, tpg.tpr_plazo, tor_nombre FROM 
                    tic_prestaciones_gis tpg JOIN tic_organismos tor ON tpg.tor_code=tor.tor_code
                    WHERE tpg.tpr_code='{$prest->tpr_code}'";
        $re = $primary_db->do_execute($sql);
                    
        while( $row=$primary_db->_fetch_row($re) )
        {
            if( $row['tpg_usa_gis']=="NO" )
            {
                //No hace falta ir a la USIG, asigno organismo directamente
                $o = new organismo();
                $o->tor_activo = 'ACTIVO';
                $o->tor_code = $row['tor_code'];
                $o->tor_description = $row['tor_nombre'];
                $o->tto_figura = $row['tto_figura'];
                $prest->organismos[] = $o;                
            }
            else
            {
                //Consulto la grilla en la usig
                $valor = self::consultarGIS($row['tpg_gis_campo'], $coordx, $coordy);
                
                //La dirección se corresponde con la zona pedida en la regla?
                if( strcasecmp($valor,$row['tpg_gis_valor'])==0 )
                {
                    $o = new organismo();
                    $o->tor_activo = 'ACTIVO';
                    $o->tor_code = $row['tor_code'];
                    $o->tor_description = $row['tor_nombre'];
                    $o->tto_figura = $row['tto_figura'];
                    $prest->organismos[] = $o;
                    
                    //Hay un plazo indicado?
                    if( $row['ttp_plazo']!="" ) {
                        list($prest->plazo, $prest->plazo_unit) = self::plazoComponents($row['tpr_plazo']);
                    }
                }
            }
        }
        return $prest;
    }

    /**
     * Consulta al layer del GIS del MGP (no esta listo el backend)
     * 
     * @param type $grilla
     * @param type $coordx
     * @param type $coordy
     * @return string
     */
    static function consultarGIS($grilla,$lat,$lng)
    {
        $client = new SoapClient("http://gis.mardelplata.gob.ar/webservice/zonificacion.php?wsdl");
        $resultado = "";
        try
        {
            $b = $client->zonificacion_latlong($lat,$lng,$grilla);
            if(isset($b->descripcion))
                $resultado = $b->descripcion;
            error_log("prestacion::consultarGIS() zonificacion_latlong() ->".print_r($b,true));
        }
        catch (SoapFault $exception)
        {
            error_log( "direccion.php zonificacion_latlong() ->".$exception );
        }		 

        return $resultado;
    }
}
