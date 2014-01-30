<?php 
include_once APP_PATH."common/phpqrcode/qrlib.php";
include_once 'beans/functions.php';
include_once 'beans/georeferencias.php';

// Extension para implementar un metodo de impresion
class class_tic_ticket_upd_print extends cclass_maint_print 
{
	private $m_line;
	
	function __construct($data_obj) 
	{
            parent::__construct($data_obj);
	}
		
	public function createName()
	{
            $p = $this->m_data;
            $id = $p->getField("tic_identificador")->getValue();
            return str_replace(array(' ','/'), array('_','_'), $id).".pdf";
	}
	
	public function do_print() 
	{
            $ret_val = array();
            $o=""; 
            $p = $this->m_data;
            if(!$p) 
            {
                $ret_val[] = "No esta definido el contenido...";
                return $ret_val;
            }

            //Codigo del ticket
            $codigo = _F($p,"tic_identificador");
            $tic_nro = _F($p,"tic_nro");
            
            //Creo el pdf, Inicio el JOB
            $page=1;
            $o.=$this->beginJob($codigo,"","","0","P",false);
		
            //creo la primera pagina
            $o.=$this->newPage($p,$page);
            $img=0;
		
            //Encabezado
            $o.= '<div left="10mm" top="10mm" height="35mm" width="19cm">
                    <img src="'.HOME_PATH.'www/images/mdq.jpg" width="100mm" height="20mm">
                  </div>';
		
            //Marco fecha
            $estado = _F($p,"tic_estado");
            $plazo = _F($p,"tic_tstamp_plazo");

            //Marco datos del ticket
            $ext_coordx = (double) _F($p,"tic_coordx");
            $ext_coordy = (double) _F($p,"tic_coordy");
            $obs = _F($p,"tic_nota_in");
	
            $arch = '';
            if($ext_coordx!=0 && $ext_coordy!=0)
            {
                if(!defined('HOSTNAME'))
                    define('HOSTNAME', $_SERVER["HTTP_HOST"]);
                $url = 'http://'.HOSTNAME.WEB_PATH."/common/mapa.php?x={$ext_coordx}&y={$ext_coordy}&w=350&h=250&r=250";
                $img = file_get_contents($url);
                $arch = HOME_PATH."temp/".md5(time())."_mapa.jpg";
                error_log("impresion ticket: Mapa url: $url");

                if($img) {
                    file_put_contents($arch, $img);
                    $o.= '<div width="6cm" height="4cm" top="45mm" left="14cm"><img src="'.$arch.'" width="60mm" height="43mm"></div>';
                } else
                    error_log("impresion ticket: Mapa: ERROR no se puede descargar: $url");
            }
            
            $pa = '<div left="1cm" top="4cm" width="19cm">';
            $pa.= '<table><tr><td><b>Ticket</b></td></tr></table>';
            $pa.= '<table border="1mm">';
            $pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Nro.:</td><td width="10cm"> <b>'.$codigo.'</b></td></tr>';
            $pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Fecha inicio:</td><td width="10cm"> <b>'._F($p,"tic_tstamp_in").'</b></td></tr>';
            $pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Estado:</td><td width="10cm"> <b>'.$estado.'</b></td></tr>';
            $pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Plazo:</td><td width="10cm"> <b>'.$plazo.'</b></td></tr>';
            $pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Nota:</td><td width="10cm">'.$this->splitLine($obs,70).'</td></tr>';
            $pa.= '</table><br>';
            $o.= $pa;

			            
            //Ubicación del ticket
            $o.= $this->createLugarPDML();
            
            //Lista de prestaciones
            $o.= $this->createPrestacionesPDML();
		
            //Ciudadanos que reclaman
            $o.= $this->createCiudadanosPDML();
		
            
            //Reiteraciones
            $o.= $this->createPrestacionesPDML();
		
		
            //Marco encabezado detalle acciones
            $o.= $this->createAccionesPDML();	
            
//Mensaje fijo
		
            //Instrucciones
            $pa = '<div left="1cm" top="245mm" >';
            $pa.= '<cell next="bottom" border="0.1mm" width="19cm"><b>Notas</b></cell>';
            $pa.= '<cell next="bottom">El plazo indicado puede ser modificado durante el proceso de este ticket.</cell>';
            $pa.= '<cell next="bottom">Para consultar el avance del ticket, puede llamar al Call Center al 147 o en </cell>';
            $pa.= '<cell next="bottom">http://www.mardelplata.gob.ar/147</cell>';
            $pa.= '</div>';
            $o.= $pa;
		
            //hora de impresion
            $o.= '<div left="10cm" top="28cm">Impreso: '.date("d-m-Y h:i:s").'</div>';
		
 //CODIGO QR
            $preclamo = explode(' ',$codigo);
            $url = "http://appsb.mardelplata.gob.ar/Consultas/nConsultaSolicitudes147/Solicitud.aspx?param={$preclamo[1]}";
            $arch_barras = HOME_PATH."temp/qr_{$tic_nro}.png";
            $errorCorrectionLevel = 'L';
            $matrixPointSize = 4;
            QRcode::png($url, $arch_barras, $errorCorrectionLevel, $matrixPointSize, 2);

            if(file_exists($arch_barras))
            {
                $o.= '<div left="15cm" top="25cm"><img src="'.$arch_barras.'" width="4cm" height="4cm"></div>';
            }
		
            //Imprimo si esta definida la etiqueta <footer></footer>.
            $o.=$this->footer();

            //Fin de la impresion
            $o.=$this->endJob();

            //Creo el PDF en un archivo temporal
            $tempfolder = HOME_PATH."temp/";
            $arch = $tempfolder.md5(session_id().time()).".pdf";

            $html = $this->doDownload($o,"P","A4");
			
            //unlink($arch_barras);
            return array($ret_val,$html);
	}
        
        
        private function createLugarPDML() {
            $p = $this->m_data;
            $obj_lugar = json_decode( _F($p,"tic_lugar") );
            $lugar = "";
            
            if($obj_lugar->tipo=="LUMINARIA" || $obj_lugar->tipo=="SEMAFORO" || $obj_lugar->tipo=="DOMICILIO") {
                $geo = new georeferencias();
                $geo->load(_F($p,"tic_lugar"));
                $lugar = $geo->generarTextoDireccion(true,false);
            }
            
            $pdml = '<table><tr><td><b>Ubicación</b></td></tr></table>
                <table border="1mm">';

            switch($obj_lugar->tipo) {
                case "LUMINARIA":
                case "SEMAFORO":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Calle</td><td width="10cm"> '.$this->splitLine($lugar,70).'</td></tr>';

                    if($obj_lugar->barrio!='')
                       $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Barrio</td><td width="10cm"> <b>'.$obj_lugar->barrio.'</b></td></tr>';
                    
                    if($obj_lugar->comuna!='')
                        $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Comuna</td><td width="10cm"> <b>'.$obj_lugar->comuna.'</b></td></tr>';
                    
                    break;
                case "DOMICILIO":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Calle</td><td width="10cm"> '.$this->splitLine($lugar,70).'</td></tr>';

                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Piso</td><td width="10cm"> <b>'.$obj_lugar->piso.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Depto</td><td width="10cm"> <b>'.$obj_lugar->dpto.'</b></td></tr>';
                    
                    if($obj_lugar->nombre_fantasia!='')
                        $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Comercio</td><td width="10cm"> <b>'.$obj_lugar->nombre_fantasia.'</b></td></tr>';

                    if($obj_lugar->barrio!='')
                        $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Barrio</td><td width="10cm"> <b>'.$obj_lugar->barrio.'</b></td></tr>';
                    
                    if($obj_lugar->comuna!='')
                        $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Comuna</td><td width="10cm"> <b>'.$obj_lugar->comuna.'</b></td></tr>';
                    
                    break;
                case "VILLA":
                    
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">NHT</td><td width="10cm"> <b>'.$obj_lugar->villa.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Manzana</td><td width="10cm"> <b>'.$obj_lugar->manzana.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Casa</td><td width="10cm"> <b>'.$obj_lugar->casa.'</b></td></tr>';
                    
                    break;
                case "PLAZA":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Plaza</td><td width="10cm"> <b>'.$obj_lugar->plaza.'</b></td></tr>';
                    
                    break;
                case "PLAYA":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Playa</td><td width="10cm"> <b>'.$obj_lugar->playa.'</b></td></tr>';
                    
                    break;
                case "CEMENTERIO":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Cementerio</td><td width="10cm"> <b>'.$obj_lugar->cementerio.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Sepultura</td><td width="10cm"> <b>'.$obj_lugar->sepultura.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Sector</td><td width="10cm"> <b>'.$obj_lugar->sector.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Calle</td><td width="10cm"> <b>'.$obj_lugar->calle.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Número</td><td width="10cm"> <b>'.$obj_lugar->numero.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Fila</td><td width="10cm"> <b>'.$obj_lugar->fila.'</b></td></tr>';

                    break;
                case "ORGAN.PUBLICO":
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Organismo</td><td width="10cm"> <b>'.$obj_lugar->organismo.'</b></td></tr>';
                    $pdml.= '<tr><td width="2cm" fillcolor="#B0B0B0">Sector</td><td width="10cm"> <b>'.$obj_lugar->sector.'</b></td></tr>';

                    break;
                default:
                    break;
            }
    	 
            $pdml.= '</table><br>';
            
            return $pdml;
        }

        private function createPrestacionesPDML() {
            global $primary_db;
            $p = $this->m_data;
            $tic_nro = _F($p,"tic_nro");
            
            $pa = '<table><tr><td><b>Prestaciones</b></td></tr></table>';
            $pa.= '<table border="1mm">';
            $pa.= '<tr>';
            $pa.= '<td width="6cm" fillcolor="#B0B0B0"><b>Prestación</b></td>';
            $pa.= '<td width="3cm" fillcolor="#B0B0B0"><b>Estado</b></td>';
            $pa.= '<td width="3cm" fillcolor="#B0B0B0"><b>Rubro</b></td>';
            $pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Cuestionario</b></td>';
            $pa.= '</tr>';
		
            $cont1 = $p->m_childs["class_tic_ticket_prestaciones"];
            foreach($cont1 as $renglon) 
            {
                $plazo          = _F($renglon,'ttp_tstamp_plazo');
                $estado         = _F($renglon,"ttp_estado");
                $cod_prestacion = _F($renglon,"tpr_code");
                $cod_rubro      = _F($renglon,"tru_code");
                $prestacion     = $primary_db->QueryString("SELECT tpr_detalle FROM tic_prestaciones WHERE tpr_code='{$cod_prestacion}'");
                $rubro          = $primary_db->QueryString("SELECT tru_detalle FROM tic_rubros WHERE tru_code='{$cod_rubro}'");
                
                //Cuestionario
                //tic_nro, tpr_code, tcu_code, tpr_preg, tpr_tipo_preg, tpr_respuesta, tpr_miciudad
                $cuest = '';
                $rs = $primary_db->do_execute("select * from tic_ticket_cuestionario where tic_nro={$tic_nro} and tpr_code='{$cod_prestacion}'");
                while( $row=$primary_db->_fetch_row($rs) )
                {
                    $cuest.= $row['tpr_preg'].' '.$row['tpr_respuesta'].'<br>';
                }
                
                $pa.= '<tr>';
                $pa.= '<td width="6cm">'.$this->splitLine($prestacion,50).'</td>';
                $pa.= '<td width="3cm">'.$estado.'</td>';
                $pa.= '<td width="3cm">'.$this->splitLine($rubro,40).'</td>';
                $pa.= '<td width="7cm">'.$this->splitLine($cuest,50).'</td>';
                $pa.= '</tr>';
            }
            $pa.= '</table><br>';
            
            return $pa;
        }
        
        private function createCiudadanosPDML() {
            global $primary_db;
            $p = $this->m_data;

            $cont2 = $p->m_childs["class_tic_ticket_ciudadano"];
            $pa= '<table><tr><td><b>Reclamante</b> '.(count($cont2)==0 ? "Anónimo" : "").'</td></tr></table>';

            if(count($cont2)>0)
            {
                $pa.= '<table border="1mm">';
                foreach($cont2 as $renglon) 
                {
                    $ciu_code = $renglon->getField("ciu_code")->getValue();
                    $ttc_tstamp= $renglon->getField("ttc_tstamp")->getValue();
                    $ttc_nota= $renglon->getField("ttc_nota")->getValue();
				
                    /* Con el codigo de ciudadano recupero el resto de los datos */
                    $row = $primary_db->QueryArray("SELECT ciu_code,ciu_nombres,ciu_apellido,ciu_email,ciu_tel_fijo,ciu_tel_movil,ciu_dir_calle,ciu_dir_nro,ciu_dir_piso,ciu_dir_dpto FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'");
                    $nombre = $row['ciu_nombres']." ".$row['ciu_apellido'];
                    $calle = $row['ciu_dir_calle'];
                    $altura = $row['ciu_dir_nro'];
                    $piso= $row['ciu_dir_piso'];
                    $dpto= $row['ciu_dir_dpto'];
                    $domicilio = $calle." ".$altura.($piso!="" ? " P".$piso : "").($dpto!="" ? " D".$dpto : "");
                    $telefono = $row['ciu_tel_fijo'];
                    $movil = $row['ciu_tel_movil'];
                    $email = $row['ciu_email'];
                    $dni = $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}'");

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Nombre</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Dirección</b></td>';
                    $pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Nota</b></td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm">'.$ttc_tstamp.'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($nombre,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($domicilio,30).'</td>';
                    $pa.= '<td width="7cm">'.$this->splitLine($ttc_nota,40).'</td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Doc</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Tel Fijo</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Tel Movil</b></td>';
                    $pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>EMail</b></td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm">'.$this->splitLine($dni,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($telefono,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($movil,30).'</td>';
                    $pa.= '<td width="7cm">'.$this->splitLine($email,40).'</td>';
                    $pa.= '</tr>';

                }
                $pa.= '</table><br>';
            }
            
            return $pa;
        }
        
        private function createReiteracionesPDML() {
            global $primary_db;
            $p = $this->m_data;

            $cont3 = $p->m_childs["class_tic_ticket_ciudadano_reit"];
            $pa= '<table><tr><td><b>Reiteraciones</b> '.(count($cont3)==0 ? "No tiene" : "").'</td></tr></table>';
            if(count($cont3)>0)
            {
                $pa.= '<table border="1mm">';
                foreach($cont3 as $renglon) 
                {
                    $ciu_code = $renglon->getField("ciu_code")->getValue();
                    $ttc_tstamp= $renglon->getField("ttc_tstamp")->getValue();
                    $ttc_nota= $renglon->getField("ttc_nota")->getValue();
				
                    /* Con el codigo de ciudadano recupero el resto de los datos */
                    $row = $primary_db->QueryArray("SELECT ciu_code,ciu_nombres,ciu_apellido,ciu_email,ciu_tel_fijo,ciu_tel_movil,ciu_dir_calle,ciu_dir_nro,ciu_dir_piso,ciu_dir_dpto FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'");
                    $nombre = $row['ciu_nombres']." ".$row['ciu_apellido'];
                    $calle = $row['ciu_dir_calle'];
                    $altura = $row['ciu_dir_nro'];
                    $piso= $row['ciu_dir_piso'];
                    $dpto= $row['ciu_dir_dpto'];
                    $domicilio = $calle." ".$altura.($piso!="" ? " P".$piso : "").($dpto!="" ? " D".$dpto : "");
                    $telefono = $row['ciu_tel_fijo'];
                    $movil = $row['ciu_tel_movil'];
                    $email = $row['ciu_email'];
                    $dni = $primary_db->QueryString("select ciu_nro_doc from ciu_identificacion where ciu_code='{$row['ciu_code']}'");

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Nombre</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Dirección</b></td>';
                    $pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Nota</b></td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm">'.$ttc_tstamp.'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($nombre,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($domicilio,30).'</td>';
                    $pa.= '<td width="7cm">'.$this->splitLine($ttc_nota,40).'</td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Doc</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Tel Fijo</b></td>';
                    $pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Tel Movil</b></td>';
                    $pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>EMail</b></td>';
                    $pa.= '</tr>';

                    $pa.= '<tr>';
                    $pa.= '<td width="4cm">'.$this->splitLine($dni,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($telefono,30).'</td>';
                    $pa.= '<td width="4cm">'.$this->splitLine($movil,30).'</td>';
                    $pa.= '<td width="7cm">'.$this->splitLine($email,40).'</td>';
                    $pa.= '</tr>';
                }
                $pa.= '</table><br>';
            }
            return $pa;
        }
        
        private function createAccionesPDML() {
            global $primary_db;
            $p = $this->m_data;

            $o = '<table>
                    <tr><td><b>Acciones</b></td></tr>
                  </table>

                  <table border="1mm">
                    <tr>
                        <td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>
                        <td width="4cm" fillcolor="#B0B0B0"><b>Estado</b></td>
                        <td width="11cm" fillcolor="#B0B0B0"><b>Nota</b></td>
                    </tr>';

            //Marco detalle acciones
            $cont = $p->m_childs["class_tic_avance"];
            $k=0;
            foreach($cont as $renglon) 
            {
                $k++;
                $estadoorigen = _F($renglon,"tic_estado_in");
                $estadodestino = _F($renglon,"tic_estado_out");
                $fechaorigen = _F($renglon,"tav_tstamp_in");
                $fechadestino = _F($renglon,"tav_tstamp_out");
                $obs = _F($renglon,"tav_nota");

                //Mando el detalle
                $o.= '<tr>';
                $o.= '<td width="4cm">'.$this->splitLine($fechaorigen,30).'</td>';
                $o.= '<td width="4cm">'.$this->splitLine($estadoorigen,30).'</td>';
                $o.= '<td width="11cm">'.$this->splitLine($obs,60).'</td>';
                $o.= '</tr>';
            }
	
            if($k==0)
            { 
                $o.= '<tr><td align="center" colspan="3">-- No posee --</td></tr>';
            }
            $o.= '</table></div>';
            
            return $o;
        }
}

error_log('fin del hook print');