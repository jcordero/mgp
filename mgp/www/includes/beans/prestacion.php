<?php

include_once 'beans/avance.php';
include_once 'beans/organismo.php';
include_once 'beans/cuestionario.php';

class prestacion {
    public $tpr_code; 
    public $tpr_description;
    public $tru_code; 
    public $tru_description;
    public $ttp_estado; 
    public $ttp_prioridad; 
    public $ttp_tstamp_plazo; 
    public $ttp_alerta;

    public $cuestionario; 
    public $avance;
    public $organismos;
    
    /** Plazo (numerico) */
    private $plazo;
    private $plazo_unit;
    
    /** Tipo de prestacion: RECLAMO, DENUNCIA, SOLICITUD o QUEJA */
    private $tpr_tipo; 
    
    function __construct() {
        $this->cuestionario = array(); 
        $this->avance = array();
        $this->organismos = array();       
        $this->ttp_alerta = 0;
        $this->ttp_prioridad = '1.1';
        $this->plazo = 10;
        $this->plazo_unit = 'DAY';
    }
    
    function getTipoPrestacion() {
        return $this->tpr_tipo;
    }
    
    function getPlazo() {
        return $this->plazo;
    }

    function getPlazoUnit() {
        return $this->plazo_unit;
    }

    function getLastAvance() {
        return $this->avance[ count($this->avance)-1 ];
    }
    
    function save($parent) {
        global $primary_db;
        $errores = array();
          
        //Creo una prestacion (tic_ticket_prestaciones)
        $sql2 = "insert into tic_ticket_prestaciones (tic_nro  , tpr_code    , tru_code  , ttp_estado, ttp_prioridad    , ttp_tstamp_plazo                     , ttp_alerta) 
                                              values (:tic_nro:, ':tpr_code:', :tru_code:, 'INICIADO', ':ttp_prioridad:', NOW() + INTERVAL :plazo: :plazo_unit:, ':ttp_alerta:')";
        $params2 = array(
            'tic_nro'             => $parent->getNro(), 
            'tpr_code'            => $this->tpr_code, 
            'tru_code'            => ($this->tru_code!=='' ? $this->tru_code : 'null'), 
            'ttp_prioridad'       => $this->ttp_prioridad, 
            'plazo'               => $this->plazo,
            'plazo_unit'          => $this->plazo_unit,
            'ttp_alerta'          => $this->ttp_alerta
        );
        $primary_db->do_execute($sql2,$errores,$params2);
                
        //Le creo un primer registro de avance
        foreach($this->avance as $av)
            $av->save($parent, $this->tpr_code);
         
        //Salvo los organismos
        foreach($this->organismos as $org)
            $org->save($parent, $this->tpr_code);

        //Salvo el cuestionario
        foreach($this->cuestionario as $preg)
            $preg->save($parent, $this->tpr_code);
    }
    
    
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

    /**
     * Cargo una prestacion desde el ticket que viene de la API de MiCiudad
     * @param type $ticket
     */
    static function fromJSON($ticket, $parent) {
        global $primary_db;
        $prest = new prestacion();
        
        $prest->tpr_code    = _g($ticket,'tpr_code');
        $prest->tru_code    = _g($ticket,'tru_code'); 
        $prest->tpr_description = $primary_db->QueryString("select tpr_detalle from tic_prestaciones where tpr_code='{$prest->tpr_code}'");
        $prest->tru_description = ($prest->tru_code!=='' ? $primary_db->QueryString("select tru_detalle from tic_rubros where tru_code='{$prest->tru_code}'") : '');
                
        $prest->cuestionario = cuestionario::factoryJSON($ticket,$parent,$prest);

        //Cargo los valores por defecto
        $avance = new avance();
        $avance->tav_nota = _g($ticket,'tic_nota_in');
        $avance->tav_tstamp_in = DatetoISO8601();
        $avance->tic_estado_in = 'pendiente';
        $avance->tic_motivo = 'Ingreso desde movil';
        $avance->use_code_in = loadOperador();
        $prest->avance[] = $avance;
        
        //Hay que determinar que roles hay que levantar desde la definicion del GIS de prestaciones.
        
        //PRESTADOR
        $org = new organismo();
        $org->tor_activo = 'ACTIVO';
        $org->tor_code = 1;
        $org->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$org->tor_code}'");
        $org->tto_figura = 'PRESTADOR';        
        $prest->organismos[] = $org;

        //RESPONSABLE
        $org2 = new organismo();
        $org2->tor_activo = 'ACTIVO';
        $org2->tor_code = 1;
        $org2->tor_description = $primary_db->QueryString("select tor_nombre from tic_organismos where tor_code='{$org2->tor_code}'");
        $org2->tto_figura = 'RESPONSABLE';        
        $prest->organismos[] = $org2;
        
        //En esta API solo se postea una prestacion
        return array($prest);
    }
    
    
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
        
        $row = $primary_db->QueryArray("select tpr_tipo,tpr_detalle,tpr_plazo from tic_prestaciones where tpr_code='{$p->tpr_code}'");
        if( $row )
        {
            $p->tpr_description = $row['tpr_detalle'];
            $p->tpr_tipo = $row['tpr_tipo'];
            
            //El plazo viene en dos partes, una donde esta la cantidad y otra donde esta la unidad. Ejemplo: 2 dias
            $plazo = explode(' ',$row['tpr_plazo']);
            $p->plazo = (double) $plazo[0];
            if(isset($plazo[1])) {
                switch ($plazo[1]) {
                    case 'Días':
                        $p->plazo_unit = 'DAY';
                        break;
                    case 'Horas':
                        $p->plazo_unit = 'HOUR';
                        break;
                    case 'Minutos':
                        $p->plazo_unit = 'MINUTE';
                        break;
                    default:
                        $p->plazo_unit = 'DAY';
                }
            } else {
                $p->plazo_unit = 'DAY';
            }
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
        return array( self::procesarGeoRef($obj, $p) );        
    }
    
    /** Averiguo los organismos que deben ver o procesar este ticket
     * 
     * @global type $primary_db
     * @param type $prestacion
     * @param type $coordx
     * @param type $coordy
     * @return type
     */
    static function procesarGeoRef($obj, $p)
    {
        global $primary_db;
        
        $sql = "select tpg.tpg_usa_gis, tpg.tpg_gis_campo, tpg.tpg_gis_valor, tpg.tor_code, tpg.tto_figura, tor_nombre FROM 
                    tic_prestaciones_gis tpg JOIN tic_organismos tor ON tpg.tor_code=tor.tor_code
                    WHERE tpg.tpr_code='{$p->tpr_code}'";
        $re = $primary_db->do_execute($sql);
        
        $coordx = (double) _F($obj,"tic_coordx");
        $coordy = (double) _F($obj,"tic_coordy");
            
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
                $p->organismos[] = $o;                
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
                    $p->organismos[] = $o;                
                }
            }
        }
        return $p;
    }

    //Consultar en la USIG por la georeferenciacion de un punto
    static function consultarGIS($grilla,$coordx,$coordy)
    {
        /*
        //Llamar al web service de GIS MGP
        
        //Obtengo el nombre del server usado
    	$host = $_SERVER["HTTP_HOST"];
    	$ch = curl_init("http://$host/direcciones/proxyjson.php?method=consultarDelimitaciones&p1=$coordx&p2=$coordy&p3=".rawurlencode($grilla));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT,20);
    	$output = curl_exec($ch);
		if($output=="")
		{
			return "";
		}    	
        $ans = json_decode($output);
         
         */
        return '';
    }
}
