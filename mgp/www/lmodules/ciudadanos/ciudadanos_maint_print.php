<?php // Extension para implementar un metodo de impresion
require_once "common/code128barcode.class.php";
require_once "pdml/pdml.php";

class ciu_ciudadanos_n_print extends cclass_maint_print
{
	function __construct($data_obj)
	{
		parent::__construct($data_obj);
	}
	private $m_line;

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

		//Codigo de inscripcion
		$dpr_code=$p->getField("ciu_code")->getValue();
		$codigo = $dpr_code;

		//Dibujo los bordes para posicionar las Tablas y los DIVs
		$bordes= ' border="1px" color="0000FF" ';
		$bordes1= '';

		//Creo el pdf, Inicio el JOB
		$page=1;
		$o.=$this->beginJob("Inscripcion ".$codigo,"","DECRETO 630/08","0","P",false);

		//creo la primera pagina
		$o.=$this->newPage($p,$page);
		$img=0;

		//Encabezado
		$o.= '<div left="10mm" top="10mm" height="30mm" width="19cm">';
		$o.= '<img src="/images/default/header_gcba2.jpg" width="10cm" height="30mm"></div>';

		//Marco fecha
		$pa = '<div left="150mm" top="60mm" height="20mm" width="19cm"><table>';
		$pa.= '<tr><td>Inscripción Nro.: <b>'.$codigo.'</b></td></tr>';
		$pa.= '<tr><td>Fecha: <b>'.$p->getField("ciu_tstamp")->getValue().'</b></td></tr>';
		$pa.= '</table></div>';
		$o.= $pa;

		//Marco datos personales
		$dpr_apellido = $p->getField("ciu_apellido")->getValue();
		$dpr_nombres = $p->getField("ciu_nombres")->getValue();
		$dpr_nacimiento = $p->getField("ciu_nacimiento")->getValue();
		$dpr_tipo_doc = "";
		$dpr_doc_nro = $p->getField("ciu_doc_nro")->getValue();
			

		$pa= '<div left="1cm" top="6cm" width="19cm"'.$bordes1.'>';
		$pa.= '<table><tr><td><b>Datos personales</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="3.5cm">Nombre:</td><td width="9cm">'.$this->splitLine($dpr_apellido.', '.$dpr_nombres,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Fecha de Nacimiento:</td><td width="9cm">'.$this->splitLine($dpr_nacimiento,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Documento:</td><td width="9cm">'.$this->splitLine($dpr_tipo_doc.' '.$dpr_doc_nro,70).'</td></tr>';
		$pa.= '</table><br>';
		$o.= $pa;


		//Marco direccion
		$dpr_dir_calle = $p->getField("ciu_dir_calle")->getValue();
		$dpr_dir_nro = $p->getField("ciu_dir_nro")->getValue();
		$dpr_dir_piso = $p->getField("ciu_dir_piso")->getValue();
		$dpr_dir_dpto = $p->getField("ciu_dir_dpto")->getValue();
		$dpr_barrio = $p->getField("ciu_barrio")->getValue();
		$dpr_cod_postal = $p->getField("ciu_cod_postal")->getValue();
		$dpr_localidad = $p->getField("ciu_localidad")->getValue();
		$dpr_provincia = $p->getField("ciu_provincia")->getValue();
		$dpr_pais = $p->getField("ciu_pais")->getValue();

		$pa = '<table><tr><td><b>Dirección</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="3.5cm">Calle:</td><td width="9cm">'.$this->splitLine($dpr_dir_calle.' '.$dpr_dir_nro,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Piso y Depto:</td><td width="9cm">'.$this->splitLine($dpr_dir_piso.' '.$dpr_dir_dpto,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Barrio:</td><td width="9cm">'.$this->splitLine($dpr_barrio,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Codigo Postal:</td><td width="9cm">'.$this->splitLine($dpr_cod_postal,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Localidad</td><td width="9cm">'.$this->splitLine($dpr_localidad,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Provincia</td><td width="9cm">'.$this->splitLine($dpr_provincia,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Pais</td><td width="9cm">'.$this->splitLine($dpr_pais,70).'</td></tr>';
		$pa.= '</table><br>';
		$o.= $pa;


		//Marco contacto
		$dpr_desea_llamados = $p->getField("ciu_no_llamar")->getValue();
		$dpr_desea_emails = $p->getField("ciu_no_email")->getValue();
		$dpr_tel_fijo = $p->getField("ciu_tel_fijo")->getValue();
		$dpr_tel_movil = $p->getField("ciu_tel_movil")->getValue();
		$dpr_email = $p->getField("ciu_email")->getValue();
		$dpr_horario_cont = $p->getField("ciu_horario_cont")->getValue();
		$pa = '<table><tr><td><b>Información de contacto</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="3.5cm">Desea recibir llamados</td><td width="9cm">'.$this->splitLine($dpr_desea_llamados,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Desea recibir E-mails</td><td width="9cm">'.$this->splitLine($dpr_desea_emails,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Teléfono fijo:</td><td width="9cm">'.$this->splitLine($dpr_tel_fijo,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Teléfono móvil:</td><td width="9cm">'.$this->splitLine($dpr_tel_movil,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Correo electrónico:</td><td width="9cm">'.$this->splitLine($dpr_email,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Horario de Contacto:</td><td width="9cm">'.$this->splitLine($dpr_horario_cont,70).'</td></tr>';
		$pa.= '</table><br>';
		$o.= $pa;

		//Marco Laboral/Estudios
		$dpr_trabaja = $p->getField("ciu_trabaja")->getValue();
		$dpr_estudios = $p->getField("ciu_nivel_estudio")->getValue();
		$dpr_tipo_persona = $p->getField("ciu_tipo_persona")->getValue();
		$dpr_razon_social = $p->getField("ciu_razon_social")->getValue();
		$pa = '<table><tr><td><b>Información Laboral-Estudios</b></td></tr></table>';
		$pa.= '<table border="1mm">';
		$pa.= '<tr><td width="3.5cm">Trabaja</td><td width="9cm">'.$this->splitLine($dpr_trabaja,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Estudios</td><td width="9cm">'.$this->splitLine($dpr_estudios,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Tipo de Persona</td><td width="9cm">'.$this->splitLine($dpr_tipo_persona,70).'</td></tr>';
		$pa.= '<tr><td width="3.5cm">Razon Social</td><td width="9cm">'.$this->splitLine($dpr_razon_social,70).'</td></tr>';	
		$pa.= '</table><br>';
		$o.= $pa;
			

		//Codigo de barra - hora de impresion
		$arch_barras = HOME_PATH."temp/".md5(time())."a.jpg";
		$cod_barras = 'CIU '.$codigo;
		$barcode = new code128barcode();
		$bars = array("bars"=>$barcode->output($cod_barras), "text"=>$cod_barras);
		barcode_outimage($bars['text'],$bars['bars'], 3, "jpg", 0, '',$arch_barras);
		$o.= '<div left="1cm" top="28cm">Impreso: '.date("d-m-Y h:i:s").'</div>';
		$o.= '<div left="145mm" top="255mm"><img src="'.$arch_barras.'" width="5cm" height="2cm"></div>';

		//Imprimo si esta definida la etiqueta <footer></footer>.
		$o.=$this->footer();

		//Fin de la impresion
		$o.=$this->endJob();
		
		//Creo el PDF en un archivo temporal
		$html = "";
		$tempfolder = HOME_PATH."temp/";
		$arch = $tempfolder.md5(session_id().time()).".pdf";

		$pdml = new PDML('P','pt','A4');
		$pdml->compress=0;
		$pdml->ParsePDML( utf8_decode($o) );
		$pdml->Output($arch,"F");
		if(is_file($arch)==true)
		{
			//Retorno un script para abrir el downloader...			
			$nl = "\n";
			$html.=  "<script language=\"javascript\">".$nl;
			$html.= '	doDownload( "'.WEB_PATH.'/common/download.php?tmp='.basename($arch).'&mime='. urlencode("application/pdf").'");'.$nl;
			$html.= "</script>".$nl;
		
		}
				
		unlink($arch_barras);
		
		return array($ret_val,$html);
	}

	private function fetchValue($sql)
	{
		global $primary_db;
		$rs = $primary_db->do_execute($sql);
		if($rs)
		{
			if( $row = $primary_db->_fetch_row($rs) )
			{
				return $row[0];
			}
		}
		return "";
	}
}
?>