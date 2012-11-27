<?php
 include_once "common/cdatatypes.php";

class CDH_HOME_TERMINALES_AJAX extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
	}
	
	function render_eventos($p) {
		global $terminales_db;
		$total = 0;
		$bars = array();
		$sql = "select count(*), organismo from log l join terminales t on l.ip=t.ip where fecha>=(NOW() - INTERVAL {$p} DAY) group by organismo order by 1 desc";
		$rs = $terminales_db->do_execute($sql);
		while( $row = $terminales_db->_fetch_row($rs) ) {
			$bars[] = array("cant"=>intval($row[0]), "organismo"=>$row[1]);	
			$total+=intval($row[0]);
		}
		
		$pie = array();
		$sql = "select count(*), sitio from log l join terminales t on l.ip=t.ip where fecha>=(NOW() - INTERVAL {$p} DAY) group by sitio order by 1";
		$rs = $terminales_db->do_execute($sql);
		while( $row = $terminales_db->_fetch_row($rs) ) {
			$pie[] = array("cant"=>intval($row[0]), "organismo"=>$row[1]);	
		}
		
		return json_encode((object) Array("bars"=>$bars, "pie"=>$pie, "total"=>$total));
	}
	
	function render_eventos_tiempo($p) {
		global $terminales_db;
		list($dias, $terminal) = explode("|",$p);
		$total=0;		
		$spline = array();
		$sql = "select count(*), UNIX_TIMESTAMP(DATE(fecha)) from log l join terminales t on l.ip=t.ip where  t.organismo='{$terminal}' and fecha>=(NOW() - INTERVAL {$dias} DAY) group by TO_DAYS(fecha) order by 2";
		$rs = $terminales_db->do_execute($sql);
		while( $row = $terminales_db->_fetch_row($rs) ) {
			$spline[] = array("cant"=>intval($row[0]), "fecha"=>intval($row[1]));
			$total+=intval($row[0]);	
		}

		
		$pie = array();
		$sql = "select count(*), sitio from log l join terminales t on l.ip=t.ip where t.organismo='{$terminal}' and fecha>=(NOW() - INTERVAL {$dias} DAY) group by sitio order by 1";
		$rs = $terminales_db->do_execute($sql);
		while( $row = $terminales_db->_fetch_row($rs) ) {
			$pie[] = array("cant"=>intval($row[0]), "organismo"=>$row[1]);	
		}
				
		return json_encode((object) Array("spline"=>$spline, "pie"=>$pie, "total"=>$total));
	}
	
}