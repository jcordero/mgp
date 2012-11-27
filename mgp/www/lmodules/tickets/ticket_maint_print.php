<?php 
include APP_PATH."common/phpqrcode/qrlib.php";

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
		$numero=$p->getField("tic_nro")->getValue();
		$anio=$p->getField("tic_anio")->getValue();
		$tipo=$p->getField("tic_tipo")->getValue();
		return "{$tipo}_{$numero}_{$anio}.pdf";
	}
	
	public function do_print() 
	{
		global $sess,$primary_db;
		$ret_val = array();
		$o=""; 
		$p = $this->m_data;
		if(!$p) 
		{
			$ret_val[] = "No esta definido el contenido...";
			return $ret_val;
		}

		//Codigo del ticket
		$numero=$p->getField("tic_nro")->getValue();
		$anio=$p->getField("tic_anio")->getValue();
		$tipo=$p->getField("tic_tipo")->getValue();
		$codigo = "$tipo $numero/$anio";
		
		//Dibujo los bordes para posicionar las Tablas y los DIVs
		$bordes= ' border="1px" color="0000FF" ';
		$bordes1= '';
		
		//Creo el pdf, Inicio el JOB
		$page=1;
		$o.=$this->beginJob($codigo,"","DECRETO 630/08","0","P",false);
		
		//creo la primera pagina
		$o.=$this->newPage($p,$page);
		$img=0;
		
		//Encabezado
		$o.= '<div left="10mm" top="10mm" height="35mm" width="19cm"><img src="'.HOME_PATH.'www/images/default/banner_reclamos.jpg" width="190mm" height="25mm"></div>';
		
		//Marco fecha
		$estado = $p->getField("tic_estado")->getValue();
		$plazo = $p->getField("tic_tstamp_plazo")->getValue();
		
		//Marco datos del ticket
		$ext_coordx = (double) $p->getField("tic_coordx")->getValue();
		$ext_coordy = (double) $p->getField("tic_coordy")->getValue();
		$obs = $p->getField("tic_nota_in")->getValue();
		$arch = '';
		error_log("impresion ticket: Mapa en: $ext_coordx $ext_coordy");
		if($ext_coordx>0 && $ext_coordy>0)
		{
			$url = "http://".$_SERVER["HTTP_HOST"].WEB_PATH."/common/mapa.php?x=$ext_coordx&y=$ext_coordy&w=350&h=250&r=250";
			$img = file_get_contents($url);
			$arch = HOME_PATH."temp/".md5(time())."_mapa.jpg";
			
			if($img) {
				file_put_contents($arch, $img);
				$o.= '<div width="6cm" height="4cm" top="45mm" left="14cm"><img src="'.$arch.'" width="60mm" height="43mm"></div>';
			} else
				error_log("impresion ticket: Mapa: ERROR no se puede descargar: $url");
	/*		
			//Salvo el PNG recibido. Esta entrelazado. Asi no anda en el PDF (350x250 px)
			$i = imagecreatefromstring($img);
			if($i)
			{
				$red = imagecolorallocate($i, 255, 0, 0);
				imagesetthickness($i,4); 
				imagearc($i, 175, 125, 20, 20, 0, 359, $red);
				imagejpeg($i,$arch);
			
				//Dibujo el mapa
				$o.= '<div width="6cm" height="4cm" top="45mm" left="14cm"><img src="'.$arch.'" width="60mm" height="43mm"></div>';
			}*/
		}
		$pa = '<div left="1cm" top="4cm" width="19cm"'.$bordes1.'>';
		$pa.= '<table><tr><td><b>Ticket</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Nro.:</td><td width="10cm"> <b>'.$codigo.'</b></td></tr>';
		$pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Fecha inicio:</td><td width="10cm"> <b>'.$p->getField("tic_tstamp_in")->getValue().'</b></td></tr>';
		$pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Estado:</td><td width="10cm"> <b>'.$estado.'</b></td></tr>';
		$pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Plazo:</td><td width="10cm"> <b>'.$plazo.'</b></td></tr>';
		$pa.= '<tr><td width="2cm" fillcolor="#B0B0B0">Nota:</td><td width="10cm">'.$this->splitLine($obs,70).'</td></tr>';
		$pa.= '</table><br>';
		$o.= $pa;
		
			
		//Extraigo el nombre de la calle y la altura
		$tic_lugar = html_entity_decode( $p->getField("tic_lugar")->getValue() );

		//Convierto el XML de la georeferencia en algo entendible por el usuario
        $xmldoc = new DOMDocument();
        $xsldoc = new DOMDocument();
        $xslproc = new XSLTProcessor();
        if(!$xmldoc->loadXML($tic_lugar))
        {
            error_log("ticket_maint_print.php error de parseo del xml para: $tic_lugar");
        }
		else
		{
            //Que tipo de GeoRef esta usando?
            $direcciones = $xmldoc->getElementsByTagName("direccion");
            $cant = $direcciones->length; 
            if( $cant > 0)
            {
            	$tipo = $direcciones->item(0)->firstChild->nodeName;
	            $xsl = HOME_PATH."www/includes/georef/".$tipo."_pdml.xsl";

    	        //Cargo el template
        	    $xsldoc->load($xsl);
            	$xslproc->importStyleSheet($xsldoc);

            	//Hago la transformacion
            	$pa = $xslproc->transformToXML($xmldoc);
            }
            else
            {
            	$pa = "";
            }
		}
		$o.= $pa;
		
		$pa= '<table><tr><td><b>Prestaciones</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr>';
		$pa.= '<td width="3cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
		$pa.= '<td width="3cm" fillcolor="#B0B0B0"><b>Estado</b></td>';
		$pa.= '<td width="6cm" fillcolor="#B0B0B0"><b>Prestación</b></td>';
		$pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Rubro</b></td>';
		$pa.= '</tr>';
		
		$cont = $p->m_childs["class_tic_ticket_prestaciones"];
		foreach($cont as $renglon) 
		{
			$fecha = $renglon->getField("ttp_tstamp")->getValue();
			$estado = $renglon->getField("ttp_estado")->getValue();
			$cod_prestacion = $renglon->getField("tpr_code")->getValue();
			$cod_rubro = $renglon->getField("tru_code")->getValue();
			$prestacion = $primary_db->QueryString("SELECT tpr_detalle FROM tic_prestaciones WHERE tpr_code='$cod_prestacion'");
			$rubro = $primary_db->QueryString("SELECT tru_detalle FROM tic_rubros WHERE tru_code='$cod_rubro'");
			$cuestionario[] = $renglon->getField("ttp_cuestionario")->getValue();
			
			$pa.= '<tr>';
			$pa.= '<td width="3cm">'.$fecha.'</td>';
			$pa.= '<td width="3cm">'.$estado.'</td>';
			$pa.= '<td width="6cm">'.$this->splitLine($prestacion,45).'</td>';
			$pa.= '<td width="7cm">'.$this->splitLine($rubro,50).'</td>';
			$pa.= '</tr>';
		}
		$pa.= '</table><br>';
		$o.= $pa;
		
		
		//Cuestionario
		foreach($cuestionario as $cuest_xml)
		{
			if($cuest_xml!="" && $cuest_xml!='<?xml version="1.0" encoding="UTF-8"?><cuestionarioresultado></cuestionarioresultado>')
			{
				$xmldoc = new DOMDocument();
		        $xsldoc = new DOMDocument();
		        $xslproc = new XSLTProcessor();
		        if(!$xmldoc->loadXML($cuest_xml))
		        {
		            error_log("ticket_maint_print.php error de parseo del xml para: $tic_lugar");
		            $pa = "";
		        }
				else
				{
			    	$xsl = "cuestionario_pdml.xsl";
		
		    	    //Cargo el template
		        	$xsldoc->load($xsl);
		          	$xslproc->importStyleSheet($xsldoc);
		
		           	//Hago la transformacion
		            $pa = $xslproc->transformToXML($xmldoc);
				}
				$o.= $pa;
			}
		}		
		
		$cont = $p->m_childs["class_tic_ticket_ciudadano"];
		$pa= '<table><tr><td><b>Reclamante</b> '.(count($cont)==0 ? "Anónimo" : "").'</td></tr></table>';
		
		if(count($cont)>0)
		{
			$pa.= '<table border="1mm">';
			foreach($cont as $renglon) 
			{
				$ciu_code = $renglon->getField("ciu_code")->getValue();
				$ttc_tstamp= $renglon->getField("ttc_tstamp")->getValue();
				$ttc_nota= $renglon->getField("ttc_nota")->getValue();
				
				/* Con el codigo de ciudadano recupero el resto de los datos */
				$row = $primary_db->QueryArray("SELECT ciu_nombres,ciu_apellido,ciu_doc_nro,ciu_email,ciu_tel_fijo,ciu_tel_movil,ciu_dir_calle,ciu_dir_nro,ciu_dir_piso,ciu_dir_dpto FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'");
				$nombre = $row['ciu_nombres']." ".$row['ciu_apellido'];
				$calle = $row['ciu_dir_calle'];
				$altura = $row['ciu_dir_nro'];
				$piso= $row['ciu_dir_piso'];
				$dpto= $row['ciu_dir_dpto'];
				$domicilio = $calle." ".$altura.($piso!="" ? " P".$piso : "").($dpto!="" ? " D".$dpto : "");
				$telefono = $row['ciu_tel_fijo'];
				$movil = $row['ciu_tel_movil'];
				$email = $row['ciu_email'];
				$dni = $row['ciu_doc_nro'];
				
				$pa.= '<tr>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Nombre</b></td>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Dirección</b></td>';
				$pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Nota</b></td>';
				$pa.= '</tr>';
				
				$pa.= '<tr>';
				$pa.= '<td width="4cm">'.$ttc_tstamp.'</td>';
				$pa.= '<td width="4cm">'.$this->splitLine($nombre,30).'</td>';
				$pa.= '<td width="4cm">'.$this->splitLine($direccion,30).'</td>';
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
		$o.= $pa;
		

		$cont = $p->m_childs["class_tic_ticket_ciudadano_reit"];
		$pa= '<table><tr><td><b>Reiteraciones</b> '.(count($cont)==0 ? "No tiene" : "").'</td></tr></table>';
		if(count($cont)>0)
		{
			$pa.= '<table border="1mm">';
			foreach($cont as $renglon) 
			{
				$ciu_code = $renglon->getField("ciu_code")->getValue();
				$ttc_tstamp= $renglon->getField("ttc_tstamp")->getValue();
				$ttc_nota= $renglon->getField("ttc_nota")->getValue();
				
				/* Con el codigo de ciudadano recupero el resto de los datos */
				$row = $primary_db->QueryArray("SELECT ciu_nombres,ciu_apellido,ciu_doc_nro,ciu_email,ciu_tel_fijo,ciu_tel_movil,ciu_dir_calle,ciu_dir_nro,ciu_dir_piso,ciu_dir_dpto FROM ciu_ciudadanos WHERE ciu_code='$ciu_code'");
				$nombre = $row['ciu_nombres']." ".$row['ciu_apellido'];
				$calle = $row['ciu_dir_calle'];
				$altura = $row['ciu_dir_nro'];
				$piso= $row['ciu_dir_piso'];
				$dpto= $row['ciu_dir_dpto'];
				$domicilio = $calle." ".$altura.($piso!="" ? " P".$piso : "").($dpto!="" ? " D".$dpto : "");
				$telefono = $row['ciu_tel_fijo'];
				$movil = $row['ciu_tel_movil'];
				$email = $row['ciu_email'];
				$dni = $row['ciu_doc_nro'];
				
				$pa.= '<tr>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Nombre</b></td>';
				$pa.= '<td width="4cm" fillcolor="#B0B0B0"><b>Dirección</b></td>';
				$pa.= '<td width="7cm" fillcolor="#B0B0B0"><b>Nota</b></td>';
				$pa.= '</tr>';
				
				$pa.= '<tr>';
				$pa.= '<td width="4cm">'.$ttc_tstamp.'</td>';
				$pa.= '<td width="4cm">'.$this->splitLine($nombre,30).'</td>';
				$pa.= '<td width="4cm">'.$this->splitLine($direccion,30).'</td>';
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
		$o.= $pa;
		
		
		
		//Marco encabezado detalle acciones
		$o.= '<table>';
		$o.= '<tr><td><b>Acciones</b></td></tr>';
		$o.= '</table>';
		
		$o.= '<table border="1mm">';
		$o.= '<tr>';
		$o.= '<td width="4cm" fillcolor="#B0B0B0"><b>Fecha</b></td>';
		$o.= '<td width="4cm" fillcolor="#B0B0B0"><b>Estado</b></td>';
		$o.= '<td width="11cm" fillcolor="#B0B0B0"><b>Nota</b></td>';
		$o.= '</tr>';
		
		//Marco detalle acciones
		$cont = $p->m_childs["class_tic_avance"];
		$k=0;
		foreach($cont as $renglon) 
		{
			$k++;
			$estadodestino = $renglon->getField("tic_estado_out")->getValue();
			$fecha = $renglon->getField("tav_tstamp")->getValue();
			$obs = $renglon->getField("tav_nota")->getValue();
			
			//Mando el detalle
			$o.= '<tr>';
			$o.= '<td width="4cm">'.$this->splitLine($fecha,30).'</td>';
			$o.= '<td width="4cm">'.$this->splitLine($estadodestino,30).'</td>';
			$o.= '<td width="11cm">'.$this->splitLine($obs,60).'</td>';
			$o.= '</tr>';
		}
	
		if($k==0)
		{ 
			$o.= '<tr><td align="center" colspan="3">-- No posee --</td></tr>';
		}
		$o.= '</table></div>';
		
		//Mensaje fijo
		
		//Instrucciones
		$pa = '<div left="1cm" top="245mm" >';
		$pa.= '<cell next="bottom" border="0.1mm" width="19cm"><b>Notas</b></cell>';
		$pa.= '<cell next="bottom">El plazo indicado puede ser modificado durante el proceso de este ticket.</cell>';
		$pa.= '<cell next="bottom">Para consultar el avance del ticket, puede llamar al Call Center del GCBA (147) o en </cell>';
		$pa.= '<cell next="bottom">http://www/buenosaires.gob.ar</cell>';
		$pa.= '</div>';
		$o.= $pa;
		
		//hora de impresion
		$o.= '<div left="10cm" top="28cm">Impreso: '.date("d-m-Y h:i:s").'</div>';
		
/*		
		//Codigo de barra - hora de impresion
		$arch_barras = HOME_PATH."temp/".md5(time())."a.jpg";
		$cod_barras = '1'.substr("0000000",0,11-strlen($numero.$anio)).$numero.$anio;
		$this->createBarcode($cod_barras, $arch_barras);
		if(file_exists($arch_barras))
		{
			$o.= '<div left="145mm" top="255mm"><img src="'.$arch_barras.'" width="5cm" height="2cm"></div>';
		}
*/

		//CODIGO QR
		$url = "http://www.buenosaires.gob.ar/call/estado.php?{$numero}_{$anio}";
		$arch_barras = HOME_PATH."temp/qr_{$numero}_{$anio}.png";
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
}
?>