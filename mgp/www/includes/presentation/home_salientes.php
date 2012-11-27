<?php
include_once "common/cdatatypes.php";
include_once "common/csession.php";

class CDH_HOME_SALIENTES extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
	}
	
	function hacerLlamada($params)
	{
		global $primary_db;
		
		list($cgpc,$barrio,$tipo,$estado,$desde,$hasta,$session_id) = explode("|",$params);
		
		//Cambio CGPC por Comuna
		if($cgpc!="")
		{
			$cgpc = "Comuna".substr($cgpc,strpos($cgpc," "));
		}		
		
		//Inicio la sesion copia del usuario
		session_id($session_id);
		$sess = new CSession();
				
		//Busco si hay una llamada libre
		$sql = "select cqu_codigo from cal_queue where cqu_estado='PENDIENTE' ";
		if($cgpc!="")
		{
			$sql.= " and cqu_cgpc='$cgpc'";
		}
		if($barrio!="")
		{
			$sql.= " and cqu_barrio='$barrio'";
		}
		if($tipo!="")
		{
			$sql.= " and cqu_tipo='$tipo'";
		}
		if($estado!="")
		{
			$sql.= " and cqu_estado_contacto='$estado'";
		}
		if($desde!="" && $hasta!="")
		{
			$sql.= " and cqu_con_ingreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y') and STR_TO_DATE('$hasta','%d/%m/%Y')";
		}
		if($desde!="" && $hasta=="")
		{
			$sql.= " and cqu_con_ingreso_fecha >= STR_TO_DATE('$desde','%d/%m/%Y')";
		}
		if($desde=="" && $hasta!="")
		{
			$sql.= " and cqu_con_ingreso_fecha < STR_TO_DATE('$hasta','%d/%m/%Y')";
		}
		$sql.= " limit 1";
		
		$cod = $primary_db->QueryString($sql);
		if($cod!="")
		{
			//Hay una llamada disponible?? - La marco como EN CURSO para que no se la den a otro operador y se arme lio
			$primary_db->QueryString("update cal_queue set cqu_estado='EN CURSO' where cqu_codigo='$cod'");
			$url = WEB_PATH."/lmodules/call/llamada_maint.php?OP=M&cqu_codigo=$cod";
			$ret = (object) array( "status"=>"OK","url"=>$sess->encodeURL($url) );
		}
		else
		{
			$ret = (object) array( "status"=>"ERROR no hay mas contactos","url"=>"" );
		}
		return json_encode( $ret );	
	}
	
	function llamadasEnCurso($params)
	{
		global $primary_db;

		list($use_code,$session_id) = explode("|",$params);
		
		//Inicio la sesion copia del usuario
		session_id($session_id);
		$sess = new CSession();
	
		$ret = array();
		$re = $primary_db->do_execute("select cqu_codigo,cqu_nombre,cqu_tipo,cqu_prestacion from cal_queue where cqu_estado='EN CURSO' and use_code='$use_code'");
		while( $row=$primary_db->_fetch_row($re) )
		{
			$fila = array();
			$url = WEB_PATH."/lmodules/call/llamada_maint.php?OP=M&cqu_codigo=".$row['cqu_codigo'];
			$fila["cqu_tipo"] = $row["cqu_tipo"];
			$fila["cqu_nombre"] = $row["cqu_nombre"];
			$fila["cqu_prestacion"] = $row["cqu_prestacion"];			
			$fila["url"] = $sess->encodeURL($url);
			$ret[] = $fila;
		}
		return json_encode( $ret );	
	}
	
	function go($params) {
		list($func,$session_id) = explode("|",$params);
		
		session_id($session_id);
		$sess = new CSession();
		
		if($func=="reportes")
			$url = WEB_PATH."/lmodules/call/reportes.php?OP=X";

		if($func=="ajustes")
			$url = WEB_PATH."/lmodules/call/ajustes.php?OP=M";

		if($func=="colallamadas")
			$url = WEB_PATH."/lmodules/call/colallamadasadm.php?OP=X";

		if($func=="colallamadasadm")
			$url = WEB_PATH."/lmodules/call/colallamadasadm.php?OP=X";
		
		if($func=="rep_operador")
			$url = WEB_PATH."/lmodules/call/rep_operador.php?OP=N&pagemode=off";
		
		if($func=="rep_barrio")
			$url = WEB_PATH."/lmodules/call/rep_barrio.php?OP=N&pagemode=off";
		
		if($func=="rep_prestacion")
			$url = WEB_PATH."/lmodules/call/rep_prestacion.php?OP=N&pagemode=off";
		
		if($func=="rep_horario")	
			$url = WEB_PATH."/lmodules/call/rep_horario.php?OP=N&pagemode=off";	
			
		$ret = $sess->encodeURL($url);	
		return json_encode( $ret );
	}
}