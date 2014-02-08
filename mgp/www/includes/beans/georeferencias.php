<?php

class georeferencias {

     /** Tipo de geo referencia DOMICILIO, CEMENTERIO, VILLA, LUMINARIA, PLAZA, ORGAN.PUBLICO, SEMAFORO, PLAYA */
    public $tipo_georef;
 
    /** Nombre del lugar, como Hospital Pirulo */
    public $tic_nombre_fantasia;
    
    /** Nombre de la calle */
    public $tic_calle_nombre;

    /** Código de la calle */
    public $tic_calle;

    /** Nombre de la calle que cruza */
    public $tic_calle_nombre2;

    /** Código de la calle que cruza*/
    public $tic_calle2;
    
    /** Usa calle nro (NRO) o calle y calle (CALLE) */
    public $alternativa;

    /** Numero de la puerta */
    public $tic_nro_puerta;

    /** Piso */
    public $tic_piso;

    /** Departamento */
    public $tic_dpto;

    /** Identificador de la luminaria o semaforo*/
    public $id_elemento;
    
     /** Campo de busqueda barrio */
    public $tic_barrio;
    
    /** Campo de busqueda comuna */
    public $tic_cgpc;
    
    /** Campo de busqueda Latitud */
    public $tic_coordx;
    
    /** Campo de busqueda Longitud */
    public $tic_coordy;
    
     /** Villa */
    public $villa;
    public $vilmanzana;
    public $vilcasa;
         
    /** Plaza  */
    public $plaza;
    
    /** Playa */
    public $playa;
    
    /** Organismo publico */
    public $orgpublico;
    public $orgsector;
    
    /** Cementerio */
    public $cementerio;
    public $sepultura;
    public $sepsector;
    public $sepcalle;
    public $sepnumero;
    public $sepfila;

    /** Identificador de cuadra */
    public $id_cuadra;

    /** Colectivo */
    public $col_linea;
    public $col_interno;
    public $col_fecha_hora;

    public function load($json) {
        $obj = json_decode($json);
        $this->tipo_georef = $obj->tipo;
        
        switch($this->tipo_georef) {
            case "LUMINARIA":
                    $this->alternativa = $obj->alternativa;
                    $this->tic_calle_nombre = $obj->calle_nombre;
                    $this->tic_calle = $obj->calle;
                    $this->tic_nro_puerta = $obj->callenro;
                    $this->tic_barrio = $obj->barrio;
                    $this->tic_cgpc = $obj->comuna;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                    $this->id_elemento = $obj->id_luminaria;
                    $this->tic_calle_nombre2 = $obj->calle_nombre2;
                    $this->tic_calle2 = $obj->calle2;
                    break;
            case "SEMAFORO":
                    $this->alternativa = $obj->alternativa;
                    $this->tic_calle_nombre = $obj->calle_nombre;
                    $this->tic_calle = $obj->calle;
                    $this->tic_nro_puerta = $obj->callenro;
                    $this->tic_barrio = $obj->barrio;
                    $this->tic_cgpc = $obj->comuna;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                    $this->id_elemento = $obj->id_semaforo;
                    $this->tic_calle_nombre2 = $obj->calle_nombre2;
                    $this->tic_calle2 = $obj->calle2;
                break;
            case "DOMICILIO":
                    $this->alternativa = $obj->alternativa;
                    $this->tic_calle_nombre = $obj->calle_nombre;
                    $this->tic_calle = $obj->calle;
                    $this->tic_nro_puerta = $obj->callenro;
                    $this->tic_piso = $obj->piso;
                    $this->tic_dpto = $obj->dpto;
                    $this->tic_nombre_fantasia = $obj->nombre_fantasia;
                    $this->tic_barrio = $obj->barrio;
                    $this->tic_cgpc = $obj->comuna;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                    $this->tic_calle_nombre2 = $obj->calle_nombre2;
                    $this->tic_calle2 = $obj->calle2;
                break;
            case "VILLA":
                    $this->villa = $obj->villa;
                    $this->vilmanzana = $obj->manzana;
                    $this->vilcasa = $obj->casa;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                break;
            case "PLAZA":
                    $this->plaza = $obj->plaza;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
            case "PLAYA":
                    $this->playa = $obj->playa;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                break;
            case "CEMENTERIO":
                    $this->cementerio = $obj->cementerio;
                    $this->sepultura = $obj->sepultura;
                    $this->sepsector = $obj->sector;
                    $this->sepcalle = $obj->calle;
                    $this->sepnumero = $obj->numero;
                    $this->sepfila = $obj->fila;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                break;
            case "ORGAN.PUBLICO":
                    $this->orgpublico = $obj->organismo;
                    $this->orgsector = $obj->sector;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                break;
            case "COLECTIVO":
                    $this->col_linea = $obj->linea;
                    $this->col_interno = $obj->interno;
                    $this->col_fecha_hora = $obj->fecha_hora;
                    $this->tic_coordx = $obj->lat;
                    $this->tic_coordy = $obj->lng;
                break;
            default:
                break;
        }
    }
    
    public function fromForm($obj) {
        $this->tipo_georef =  _F($obj,"tipo_georef") ;
        
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
                //$this->id_cuadra            = _F($obj,"tic_id_cuadra");
                break;
            case 'VILLA':
                $this->villa          = _F($obj,"villa");
                $this->vilmanzana     = _F($obj,"vilmanzana");
                $this->vilcasa        = _F($obj,"vilcasa");
                $this->tic_coordx     = (double) _F($obj,"tic_coordx");
                $this->tic_coordy     = (double) _F($obj,"tic_coordy");
                break;
            case 'COLECTIVO':
                $this->col_linea        = _F($obj,"col_linea");
                $this->col_interno      = _F($obj,"col_interno");
                $this->col_fecha_hora   = localeToISO8601( _F($obj,"col_fecha_hora") );
                $this->tic_coordx       = (double) _F($obj,"tic_coordx");
                $this->tic_coordy       = (double) _F($obj,"tic_coordy");
                break;
            case 'PLAZA':
                $this->plaza        = _F($obj,"plaza");
                $this->tic_coordx   = (double) _F($obj,"tic_coordx");
                $this->tic_coordy   = (double) _F($obj,"tic_coordy");
                break;
            case 'PLAYA':
                $this->playa        = _F($obj,"playa");
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
            case 'SEMAFORO':
                $this->alternativa        = _F($obj,"alternativa");
                $this->tic_barrio         = _F($obj,"tic_barrio");
                $this->tic_cgpc           = _F($obj,"tic_cgpc");
                $this->tic_nro_puerta     = (int) _F($obj,"callenro");
                $this->tic_calle_nombre   = _F($obj,"calle_nombre");
                $this->tic_calle_nombre2  = _F($obj,"calle_nombre2");
                $this->id_elemento        = intval(_F($obj,"id_elemento"),10);
                $this->tic_calle          = _F($obj,"calle");
                $this->tic_calle2         = _F($obj,"calle2");
                $this->id_cuadra          = _F($obj,"tic_id_cuadra");
                $this->tic_coordx         = (double) _F($obj,"tic_coordx");
                $this->tic_coordy         = (double) _F($obj,"tic_coordy");

                break;
            default:
                $this->addError('Opción de GEOREFERENCIA desconocida: >'.$this->getTipoGeoRef().'<');
        }
    }
    
    /** Creo el objeto de georeferencia a partir del JSON enviado por MiCiudad
     * 
     * @param string $obj
     * @param ticket $ticket
     */
    public function fromJSON($obj, ticket $ticket) {
        global $primary_db;
        $tpr_code = "";
        
        $this->id_elemento     = (int) _g($obj,'id_luminaria');
        $this->tic_coordx       = (double) _g($obj,'tic_coordx');
        $this->tic_coordy       = (double) _g($obj,'tic_coordy');
        
        //Que tipo de georeferencia tiene esta prestacion?
        $prest = $ticket->getFirstPrestacion();
        if($prest)
            $tpr_code = $prest->tpr_code;
        $this->tipo_georef = $primary_db->QueryString("select tpr_ubicacion from tic_prestaciones where tpr_code='{$tpr_code}' limit 1");
        
        //$this->tipo_georef = _g($obj,'tipo_georef');
        if($this->tipo_georef==='')
            $this->tipo_georef = ($this->id_elemento===0 ? 'DOMICILIO' : 'LUMINARIA');
        
        //Ajustes segun el tipo de geo en la prestacion
        switch($this->tipo_georef) {
            case "LUMINARIA":
                break;
            case "SEMAFORO":
                $this->id_elemento = (int) _g($obj,'id_semaforo');
                break;
            case "DOMICILIO":
                $this->id_elemento = "";
                break;
            case "PLAYA":
                $this->playa = "";
                //Determino la playa usando el GIS
                $ws = new SoapClient("http://gis.mardelplata.gob.ar/webservice/zonificacion.php?wsdl");
                try
                {
                    $b = $ws->zonificacion_latlong($this->tic_coordx,$this->tic_coordy,3);
                    $this->playa = $b->descripcion;
                    error_log("georeferencias::fromJSON() Playa (long={$this->tic_coordx},lat={$this->tic_coordy}) ->".print_r($b,true));
                }
                catch (SoapFault $exception)
                {
                    error_log( "georeferencias::fromJSON() Playa ->".$exception );
                }		 
                break;
            case "COLECTIVO":
                $this->id_elemento = "";
                break;
            default:
                break;
        }
        
        //Ubicacion
        $this->alternativa      = "NRO";
        $this->tic_barrio       = _g($obj,'tic_barrio');
        $this->tic_cgpc         = _g($obj,'tic_cgpc');
        
        $this->tic_nombre_fantasia = _g($obj,'tic_lugar');
        $this->tic_calle_nombre = _g($obj,'tic_calle_nombre');
        $this->tic_nro_puerta   = (int) _g($obj,'tic_nro_puerta');
        $this->tic_piso         = _g($obj,'tic_piso');
        $this->tic_dpto         = _g($obj,'tic_dpto');
    }
    
    
    public function createLugar() {
	
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
                    'id_luminaria'      => $this->id_elemento,
                    'calle_nombre2' 	=> $this->tic_calle_nombre2,
                    'calle2'            => $this->tic_calle2,
                );
                break;
            case "SEMAFORO":
                $geo = array(
                    'tipo'		=> 'SEMAFORO',
                    'alternativa'       => $this->alternativa,
                    'calle_nombre' 	=> $this->tic_calle_nombre,
                    'calle'             => $this->tic_calle,
                    'callenro'          => $this->tic_nro_puerta,
                    'barrio'            => $this->tic_barrio,
                    'comuna'            => $this->tic_cgpc,
                    'lat'		=> $this->tic_coordx,
                    'lng'		=> $this->tic_coordy,
                    'id_semaforo'       => $this->id_elemento,
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
            case "PLAYA":
                $geo = array(
    			'tipo'          => 'PLAYA',
    			'playa'         => $this->playa,
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
            case "COLECTIVO":
                $geo = array(
   			'tipo'          => 'COLECTIVO',
	    		'linea'         => $this->col_linea,
	    		'interno' 	=> $this->col_interno,
                        'fecha_hora'    => $this->col_fecha_hora,
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
    
    function generarTextoDireccion($use_html=true,$mostrar_elemento=true) {
       $mostrar = "";
       
       $cnro = intval($this->tic_nro_puerta,10);
       $calle_nro = ($cnro>0 ? $cnro : "");
       
       switch ( $this->tipo_georef ) {
            case "DOMICILIO":
            case "":
            case "LUMINARIA":
                if($this->alternativa=="CALLE")
                     $mostrar.= (isset($this->tic_calle_nombre) && $this->tic_calle_nombre!='' ? $this->tic_calle_nombre.' y '.$this->tic_calle_nombre2.'<br/>' : '(sin calle y cruce)<br/>');
                 else
                     $mostrar.= (isset($this->tic_calle_nombre) && $this->tic_calle_nombre!='' ? $this->tic_calle_nombre.' '.$calle_nro.'<br/>' : '(sin calle-nro)<br/>');

                 $mostrar.= (isset($this->tic_piso) && $this->tic_piso!='' ? '<b>Piso:</b> '.$this->tic_piso : ''); 
                 $mostrar.= (isset($this->tic_dpto) && $this->tic_dpto!='' ? '<b>Departamento:</b> '.$this->tic_dpto.'<br/>' : '');
                 $mostrar.= (isset($this->tic_barrio) && $this->tic_barrio!='' ? '<b>Barrio:</b> '.$this->tic_barrio.'<br/>' : '');
                 if($mostrar_elemento)
                    $mostrar.= (isset($this->id_elemento) && $this->id_elemento!='' ? '<b>Luminaria:</b> '.$this->id_elemento : '');
                 break;
            case "SEMAFORO":
                 if($this->alternativa=="CALLE")
                     $mostrar.= (isset($this->tic_calle_nombre) && $this->tic_calle_nombre!='' ? $this->tic_calle_nombre.' y '.$this->tic_calle_nombre2.'<br/>' : '(sin calle y cruce)<br/>');
                 else
                     $mostrar.= (isset($this->tic_calle_nombre) && $this->tic_calle_nombre!='' ? $this->tic_calle_nombre.' '.$calle_nro.'<br/>' : '(sin calle-nro)<br/>');

                 $mostrar.= (isset($this->tic_piso) && $this->tic_piso!='' ? '<b>Piso:</b> '.$this->tic_piso : ''); 
                 $mostrar.= (isset($this->tic_dpto) && $this->tic_dpto!='' ? '<b>Departamento:</b> '.$this->tic_dpto.'<br/>' : '');
                 $mostrar.= (isset($this->tic_barrio) && $this->tic_barrio!='' ? '<b>Barrio:</b> '.$this->tic_barrio.'<br/>' : '');
                 if($mostrar_elemento)
                     $mostrar.= (isset($this->id_elemento) && $this->id_elemento!='' ? '<b>Semáforo:</b> '.$this->id_elemento : '');
                 break;

            case "COLECTIVO":
                 $mostrar.= '<b>Linea:</b> '.$this->col_linea.'<br/>';
                 $mostrar.= (isset($this->col_interno) && $this->col_interno!="" ? '<b>Interno:</b> '.$this->col_interno.'<br/>' : "" );
                 $mostrar.= (isset($this->col_fecha_hora) && $this->col_fecha_hora!="" ? '<b>Fecha:</b> '.ISO8601toLocale($this->col_fecha_hora).'<br/>' : "" );
                 break;

            case "PLAYA":
                $mostrar.= '<b>Playa:</b> '.$this->playa.'<br/>';
                break;
            case "PLAZA":
                $mostrar.= '<b>Plaza:</b> '.$this->plaza.'<br/>';
                break;
            default:
                break;
       }
       
       if($use_html==false) {
           $mostrar = str_replace(array("<br/>","<b>","</b>"), array("/n","",""), $mostrar);
       }
       
       return $mostrar;
   }
}
