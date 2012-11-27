<?php // Extension para implementar un metodo de impresion
include "barcode/php-barcode.php";

class creclamos_print extends cclass_maint_print 
{
	private $m_line;
	
	function __construct($data_obj) 
	{
		parent::__construct($data_obj);
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

		$estados = array(
			0	=>	"Iniciado",
			10 	=>	"Reiterado",
			50	=>	"Notificado",
			70	=>	"Verificado",
			90 	=>	"En tramite",
			95	=>	"Intervenido",
			100	=>	"Cumplido",
			110	=>	"Denegado"
		);
		
		$org_cgpc = array(
			"1"=>"CGPC 1",
			"2"=>"CGPC 2",
			"3"=>"CGPC 3",
			"6"=>"CGPC 4",
			"5"=>"CGPC 5",
			"7"=>"CGPC 6",
			"8"=>"CGPC 7",
			"9"=>"CGPC 8",
			"10"=>"CGPC 9",
			"11"=>"CGPC 10",
			"12"=>"CGPC 11",
			"13"=>"CGPC 12",
			"14"=>"CGPC 13",
			"15"=>"CGPC 14",
			"16"=>"CGPC 15"	);
		
		//Codigo de reclamo
		$numero=$p->getField("numero")->getValue();
		$anio=$p->getField("anio")->getValue();
		$codigo = "$numero/$anio";
		
		//Dibujo los bordes para posicionar las Tablas y los DIVs
		$bordes= ' border="1px" color="0000FF" ';
		$bordes1= '';
		
		//Creo el pdf, Inicio el JOB
		$page=1;
		$o.=$this->beginJob("Reclamo ".$codigo,"","DECRETO 630/08","0","P",false);
		
		//creo la primera pagina
		$o.=$this->newPage($p,$page);
		$img=0;
		
		//Encabezado
		$o.= '<div left="10mm" top="10mm" height="35mm" width="19cm"><img src="'.HOME_PATH.'www/images/default/banner_reclamos.jpg" width="19cm" height="25mm"></div>';
		
		//Marco fecha
		$motivo = $p->getField("motivo")->getValue();
		$estado = $estados[ $p->getField("estado")->getValue() ].($motivo!="" ? " ".$motivo : "");
		$plazo = $p->getField("plazo")->getValue();
		
		
		//Marco datos del reclamo
		$ext_calle_nombre = $p->getField("ext_calle_nombre")->getValue();
		$ext_calle_nombre2 = $p->getField("ext_calle_nombre2")->getValue();
		$callenro = $p->getField("callenro")->getValue();
		$ext_coordx = $p->getField("ext_coordx")->getValue();
		$ext_coordy = $p->getField("ext_coordy")->getValue();
		$barrio = $p->getField("barrio")->getValue();
		$zona = $p->getField("zona")->getValue();
		$cgpc = ( isset($org_cgpc[$zona]) ? $org_cgpc[$zona] : "");
		$domicilio = $ext_calle_nombre.($ext_calle_nombre2!="" ? " Y ".$ext_calle_nombre2 : " ".$callenro);
		$cod_prestacion = $p->getField("prestacion")->getValue();
		$prestacion = $this->fetchValue("select tpr_detalle from tic_prestaciones where tpr_code='$cod_prestacion' and tpr_tipo='RECLAMO'");
		$obs = $p->getField("obs")->getValue();
		$arch = '';
		if($ext_coordx>0 && $ext_coordy>0)
		{
			$url = "http://".$_SERVER["HTTP_HOST"]."/common/mapa.php?x=$ext_coordx&y=$ext_coordy&w=350&h=250&r=250";
			$img = file_get_contents($url);
			$arch = HOME_PATH."temp/".md5(time())."_mapa.jpg";
			
			//Salvo el PNG recibido. Esta entrelazado. Asi no anda en el PDF (350x250 px)
			$i = imagecreatefromstring($img);
			if($i)
			{
				$red = imagecolorallocate($i, 255, 0, 0);
				imagesetthickness($i,4); 
				imagearc($i, 175, 125, 20, 20, 0, 359, $red);
				imagejpeg($i,$arch);
			
				//Dibujo el mapa
				$o.= '<div width="6cm" height="4cm" top="55mm" left="14cm"><img src="'.$arch.'" width="60mm" height="43mm"></div>';
			}
		}
		$pa = '<div left="1cm" top="4cm" width="19cm"'.$bordes1.'>';
		$pa.= '<table><tr><td><b>Reclamo</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="2cm">Nro.:</td><td width="10cm"> <b>'.$codigo.'</b></td></tr>';
		$pa.= '<tr><td width="2cm">Fecha inicio:</td><td width="10cm"> <b>'.$p->getField("fechaingreso")->getValue().'</b></td></tr>';
		$pa.= '<tr><td width="2cm">Estado:</td><td width="10cm"> <b>'.$estado.'</b></td></tr>';
		$pa.= '<tr><td width="2cm">Plazo:</td><td width="10cm"> <b>'.$plazo.' días</b></td></tr>';
		$pa.= '</table><br>';
		$o.= utf8_decode($pa);
		
		$pa= '<table><tr><td><b>Ubicacion del reclamo</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="2cm">Domicilio:</td><td width="10cm">'.$this->splitLine($domicilio,70).'</td></tr>';
		$pa.= '<tr><td width="2cm">Barrio:</td><td width="10cm">'.$this->splitLine($barrio,70).'</td></tr>';
		$pa.= '<tr><td width="2cm">CGPC:</td><td width="10cm">'.$this->splitLine($cgpc,70).'</td></tr>';
		$pa.= '</table><br>';
		
		$pa.= '<table><tr><td><b>Prestación reclamada</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="2cm">Prestación:</td><td width="10cm">'.$this->splitLine($prestacion,70).'</td></tr>';
		$pa.= '<tr><td width="2cm">Nota:</td><td width="10cm">'.$this->splitLine($obs,70).'</td></tr>';
		$pa.= '</table><br>';
		$o.= utf8_decode($pa);
		
		$cont = $p->m_childs["creclamantes"];
		foreach($cont as $renglon) 
		{
			$nombre = $renglon->getField("quien")->getValue();
			$calle = $renglon->getField("quiendomcod")->readAltValue();
			$altura = $renglon->getField("quiendomnro")->getValue();
			$piso= $renglon->getField("quiendompiso")->getValue();
			$dpto= $renglon->getField("quiendomdpto")->getValue();
			$domicilio = $calle." ".$altura.($piso!="" ? " P".$piso : "").($dpto!="" ? " D".$dpto : "");
			$telefono = $renglon->getField("quientelfax")->getValue();
			$email = $renglon->getField("quienemail")->getValue();
		}
		$pa= '<table><tr><td><b>Reclamante</b></td></tr></table>';
		
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="3cm">Nombre:</td><td width="16cm">'.$this->splitLine($nombre,90).'</td></tr>';
		$pa.= '<tr><td width="3cm">Domicilio:</td><td width="16cm">'.$this->splitLine($domicilio,90).'</td></tr>';
		$pa.= '<tr><td width="3cm">Telefono:</td><td width="16cm">'.$this->splitLine($telefono,90).'</td></tr>';
		$pa.= '<tr><td width="3cm">EMail:</td><td width="16cm">'.$this->splitLine($email,90).'</td></tr>';
		$pa.= '</table><br>';
		$o.= utf8_decode($pa);
		
		
		//Marco encabezado detalle acciones
		$o.= '<table>';
		$o.= '<tr><td><b>Acciones</b></td></tr>';
		$o.= '</table>';
		
		$o.= '<table border="1mm">';
		$o.= '<tr>';
		$o.= '<td width="4cm"><b>Fecha</b></td>';
		$o.= '<td width="4cm"><b>Estado</b></td>';
		$o.= '<td width="11cm"><b>Nota</b></td>';
		$o.= '</tr>';
		
		//Marco detalle acciones
		$cont = $p->m_childs["creclaestados"];
		$k=0;
		foreach($cont as $renglon) 
		{
			$k++;
			$estadodestino = $estados[ $renglon->getField("estadodestino")->getValue() ];
			$fecha = $renglon->getField("fecha")->getValue();
			$obs = utf8_decode($renglon->getField("obs")->getValue());
			
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
		$pa.= '<cell next="bottom">El plazo indicado puede ser modificado durante el proceso de este reclamo.</cell>';
		$pa.= '<cell next="bottom">Interpretacion del valor de estado del reclamo:</cell>';
		$pa.= '<cell next="bottom"><b>Iniciado</b>, reclamo cargado en el sistema.</cell>';
		$pa.= '<cell next="bottom"><b>Notificado</b>, el encargado de resolver el reclamo se ha dado por enterado del problema.</cell>';
		$pa.= '<cell next="bottom"><b>Verificado</b>, se ha realizado una inspección del problema declarado.</cell>';
		$pa.= '<cell next="bottom"><b>En Tramite</b>, se requiere esperar un tiempo hasta la ejecución de una obra que resuelva el problema.</cell>';
		$pa.= '<cell next="bottom"><b>Intervenido</b>, se ha resuelto la parte que le corresponde al área (sin terminar de resolver el problema).</cell>';
		$pa.= '<cell next="bottom"><b>Cumplido</b>, se ha resuelto el problema.</cell>';
		$pa.= '<cell next="bottom"><b>Denegado</b>, no se puede resolver el problema. Ver campo Motivo para mas información.</cell>';
		$pa.= '<cell next="bottom">Para consultar el avance del reclamo, puede llamar al Call Center del GCBA (147) o en </cell>';
		$pa.= '<cell next="bottom">http://www/buenosaires.gob.ar</cell>';
		$pa.= '</div>';
		$o.= utf8_decode($pa);
		
		//hora de impresion
		$o.= '<div left="10cm" top="28cm">Impreso: '.date("d-m-Y h:i:s").'</div>';
		
		//Codigo de barra 
		$arch = HOME_PATH."temp/".md5(time())."_barcode.jpg";
		$bars = barcode_encode('1'.substr("0000000",0,11-strlen($numero.$anio)).$numero.$anio,"EAN");
		barcode_outimage($bars['text'],$bars['bars'], 3, "jpg", 0, '',$arch);
		if(file_exists($arch))
		{
			$o.= '<div left="145mm" top="255mm"><img src="'.$arch.'" width="5cm" height="2cm"></div>';
		}
		
		//Imprimo si esta definida la etiqueta <footer></footer>.
		$o.=$this->footer();

		//Fin de la impresion
		$o.=$this->endJob();

		//Salvo a un archivo temporal
		$html = "";
		$tempfolder = HOME_PATH."temp/";
		$arch = $tempfolder.session_id().".tmp";
		$h = file_put_contents($arch,$o);
		if($h==0)
		{
			$res[] = "ERROR No se puede escribir el archivo de impresion.";
		}
		else 
		{
			//Retorno un script para abrir el downloader...
			$html.=$this->doDownload("P","N");
			$this->m_pdml_file = $arch;
		}

		return array($ret_val,$html);
	}

	private function fetchValue($sql) 
	{
		global $primary_db;
		$rs = $primary_db->do_execute($sql);
		if($rs) 
		{
			if( $row = $primary_db->_fetch_row($rs,0) )
			{
				return $row[0];
			}
		}
		return "";
	}
}
?>