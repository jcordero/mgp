<?php 
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Codigo de empresa cliente*/
class CDH_REPORTES extends CDH_SELECTARRAY 
{
	private $m_colores = array("A2C180","3D7930","FF0000","00FF00","0000FF","FF8000","80FF00","0080FF","8080FF","FF80FF","CC8800","88EEAA","29DDAA","DE2200","66EEAA","3890BC",
							"12C180","FD7930","FF5000","44FF00","4400FF","558000","80FF60","DB80FF","8030FF","5080FF","CC3090","88409A","2929AA","202200","66EE80","38FFBC",
							"A2C180","3D7930","FF0000","00FF00","0000FF","FF8000","80FF00","0080FF","8080FF","FF80FF","CC8800","88EEAA","29DDAA","DE2200","66EEAA","3890BC",
							"12C180","FD7930","FF5000","44FF00","4400FF","558000","80FF60","DB80FF","8030FF","5080FF","CC3090","88409A","2929AA","202200","66EE80","38FFBC");
	
	function reporteOperador($params)
	{
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT 
qu.use_code,
us.use_name as operador,
count(*) as totales, 
sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
	FROM cal_queue qu JOIN sec_users us ON qu.use_code=us.use_code
	WHERE qu.cqu_estado='COMPLETADA' 
		and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y') and STR_TO_DATE('$hasta','%d/%m/%Y') or ('$desde'='' and '$hasta'=''))
	GROUP BY qu.use_code ORDER BY count(*)";
		$re = $primary_db->do_execute($sql);
		$rows = array();
		$totals = array('operador'=>0,'totales'=>0,'conforme'=>0,'noconforme'=>0,'nosabe'=>0,'positiva'=>0,'negativa'=>0,'neutral'=>0);
		while($row = $primary_db->_fetch_row($re))
		{
			$rows[]=array($row['operador'],$row['totales'],$row['conforme'],$row['noconforme'],$row['nosabe'],$row['positiva'],$row['negativa'],$row['neutral']);
			
			$totals['totales']+=$row['totales'];
			$totals['conforme']+=$row['conforme'];
			$totals['noconforme']+=$row['noconforme'];
			$totals['nosabe']+=$row['nosabe'];
			$totals['positiva']+=$row['positiva'];
			$totals['negativa']+=$row['negativa'];
			$totals['neutral']+=$row['neutral'];
		}
		$tot=array("TOTALES",$totals['totales'],$totals['conforme'],$totals['noconforme'],$totals['nosabe'],$totals['positiva'],$totals['negativa'],$totals['neutral']);
		return json_encode((object) array("result"=>"OK","rows"=>$rows,"columns"=>array("Operador","Total","Conforme","No conforme","No sabe","Actitud positiva","Actitud negativa","Actitud Neutral"),"totals"=>$tot));
	}
	
	function operador($params)
	{
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT 
qu.use_code,
us.use_name as operador,
count(*) as totales, 
sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
	FROM cal_queue qu JOIN sec_users us ON qu.use_code=us.use_code
	WHERE qu.cqu_estado='COMPLETADA' 
		and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y') and STR_TO_DATE('$hasta','%d/%m/%Y') or ('$desde'='' and '$hasta'=''))
	GROUP BY qu.use_code ORDER BY count(*)";

		
		$colores = "";
		$series1 = "";
		$series2 = "";
		$series3 = "";
		$labels = "";
		$j=0;
		$max = 0;
		
		$conforme = 0;
		$noconforme = 0;
		$nosabe = 0;
		
		$positiva=0;
		$negativa=0;
		$neutral =0;
		
		$max_total = 0;
		
		$re = $primary_db->do_execute($sql);
		while($row = $primary_db->_fetch_row($re))
		{
			if($j>0)
			{
				$colores.=",";
				$series1.="|";
				$series2.="|";
				$series3.="|";
				$labels.="|";
			}
			
			$colores.=$this->m_colores[$j];
			$series1.="{$row['conforme']},{$row['noconforme']},{$row['nosabe']}";
			$series2.="{$row['positiva']},{$row['neutral']},{$row['negativa']}";
			$series3.="{$row['totales']}";
			$labels.=$row['operador'];

			$conforme+=$row['conforme'];
			$noconforme+=$row['noconforme'];
			$nosabe+=$row['nosabe'];			

			$positiva+=$row['positiva'];
			$negativa+=$row['negativa'];
			$neutral+=$row['neutral'];
			
			$max_total = ($max_total<intval($row['totales']) ? intval($row['totales']) : $max_total);
		
			$j++;
		}
		
		$image = array();
		
		//Armo la URL - REPORTE POR RESULTADO		
		$max = ($conforme>$max ? $conforme : $max);
		$max = ($noconforme>$max ? $noconforme : $max);
		$max = ($nosabe>$max ? $nosabe : $max);
		$ejeX = "0:|Conforme|No Conforme|No Sabe";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['resultado'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=500x300&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series1.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+resultado">';
		
		//Armo la URL - REPORTE POR Atencion
		$max = 0;
		$max = ($positiva>$max ? $positiva : $max);
		$max = ($negativa>$max ? $negativa : $max);
		$max = ($neutral>$max ? $neutral : $max);
		$ejeX = "0:|Positiva|Neutral|Negativa";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['actitud'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=500x300&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series2.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+actitud">';
		
		//Armo la URL - REPORTE POR OPERADOR
		$scale = "0,$max_total";
		$scaleX = "0,0,$max_total";
		$image['operador'] = '<img src="http://chart.apis.google.com/chart?chxt=x&chxr='.$scaleX.'&chbh=a&chs=500x300&cht=bhg&chco='.$colores.'&chd=t:'.$series3.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+operador">';
		
		return json_encode((object) array("result"=>"OK","image"=>$image));
	}

	
	
	function barrio($params)
	{
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT 
	qu.cqu_barrio as barrio,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 	
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu 
WHERE qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'=''))
group by qu.cqu_barrio ORDER BY count(*)";

		
		$colores = "";
		$series1 = "";
		$series2 = "";
		$series3 = "";
		$labels = "";
		$j=0;
		$max = 0;
		
		$conforme = 0;
		$noconforme = 0;
		$nosabe = 0;
		
		$positiva=0;
		$negativa=0;
		$neutral =0;
		
		$max_total = 0;
		
		$re = $primary_db->do_execute($sql);
		while($row = $primary_db->_fetch_row($re))
		{
			if($j>0)
			{
				$colores.=",";
				$series1.="|";
				$series2.="|";
				$series3.="|";
				$labels.="|";
			}
			
			$colores.=$this->m_colores[$j];
			$series1.="{$row['conforme']},{$row['noconforme']},{$row['nosabe']}";
			$series2.="{$row['positiva']},{$row['neutral']},{$row['negativa']}";
			$series3.="{$row['totales']}";
			$labels.=$row['barrio'];

			$conforme+=$row['conforme'];
			$noconforme+=$row['noconforme'];
			$nosabe+=$row['nosabe'];			

			$positiva+=$row['positiva'];
			$negativa+=$row['negativa'];
			$neutral+=$row['neutral'];
			
			$max_total = ($max_total<intval($row['totales']) ? intval($row['totales']) : $max_total);
		
			$j++;
		}
		
		$image = array();
		
		//Armo la URL - REPORTE POR RESULTADO		
		$max = ($conforme>$max ? $conforme : $max);
		$max = ($noconforme>$max ? $noconforme : $max);
		$max = ($nosabe>$max ? $nosabe : $max);
		$ejeX = "0:|Conforme|No Conforme|No Sabe";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['resultado'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=350x850&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series1.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+resultado">';
		
		//Armo la URL - REPORTE POR Atencion
		$max = 0;
		$max = ($positiva>$max ? $positiva : $max);
		$max = ($negativa>$max ? $negativa : $max);
		$max = ($neutral>$max ? $neutral : $max);
		$ejeX = "0:|Positiva|Neutral|Negativa";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['actitud'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=350x850&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series2.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+actitud">';
		
		//Armo la URL - REPORTE POR BARRIO
		$scale = "0,$max_total";
		$scaleX = "0,0,$max_total";
		$image['barrio'] = '<img src="http://chart.apis.google.com/chart?chxt=x&chxr='.$scaleX.'&chbh=a&chs=350x850&cht=bhg&chco='.$colores.'&chd=t:'.$series3.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+Barrio">';
		
		return json_encode((object) array("result"=>"OK","image"=>$image));
	}
	
	
	function reporteBarrio($params)
	{	
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT 
	qu.cqu_barrio as barrio,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 	
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu 
WHERE qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'=''))
group by qu.cqu_barrio ORDER BY count(*)";
		$re = $primary_db->do_execute($sql);
		$rows = array();
		$totals = array('totales'=>0,'conforme'=>0,'noconforme'=>0,'nosabe'=>0,'positiva'=>0,'negativa'=>0,'neutral'=>0);
		while($row = $primary_db->_fetch_row($re))
		{
			$rows[]=array($row['barrio'],$row['totales'],$row['conforme'],$row['noconforme'],$row['nosabe'],$row['positiva'],$row['negativa'],$row['neutral']);
			
			$totals['totales']+=$row['totales'];
			$totals['conforme']+=$row['conforme'];
			$totals['noconforme']+=$row['noconforme'];
			$totals['nosabe']+=$row['nosabe'];
			$totals['positiva']+=$row['positiva'];
			$totals['negativa']+=$row['negativa'];
			$totals['neutral']+=$row['neutral'];
		}
		$tot=array("TOTALES",$totals['totales'],$totals['conforme'],$totals['noconforme'],$totals['nosabe'],$totals['positiva'],$totals['negativa'],$totals['neutral']);
		return json_encode((object) array("result"=>"OK","rows"=>$rows,"columns"=>array("Barrio","Total","Conforme","No conforme","No sabe","Actitud positiva","Actitud negativa","Actitud Neutral"),"totals"=>$tot));
	}	
	
	
	function prestacion($params)
	{
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT qu.cqu_prestacion as prestacion,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,	
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu where qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'=''))
group by qu.cqu_prestacion ORDER BY count(*) DESC";

		
		$colores = "";
		$series1 = "";
		$series2 = "";
		$series3 = "";
		$labels = "";
		$j=0;
		$max = 0;
		
		$conforme = 0;
		$noconforme = 0;
		$nosabe = 0;
		
		$positiva=0;
		$negativa=0;
		$neutral =0;

		$conforme_e = 0;
		$noconforme_e = 0;
		$nosabe_e = 0;
		
		$positiva_e=0;
		$negativa_e=0;
		$neutral_e=0;
		
		$max_total = 0;
		$total_e = 0;
		
		$re = $primary_db->do_execute($sql);
		while($row = $primary_db->_fetch_row($re))
		{
			if($j>0 && $j<20)
			{
				$colores.=",";
				$series1.="|";
				$series2.="|";
				$series3.="|";
				$labels.="|";
			}
			
			if($j<20)
			{
				$colores.=$this->m_colores[$j];
				$series1.="{$row['conforme']},{$row['noconforme']},{$row['nosabe']}";
				$series2.="{$row['positiva']},{$row['neutral']},{$row['negativa']}";
				$series3.="{$row['totales']}";
				$labels.="({$row['totales']}) ".htmlentities(substr($row['prestacion'],0,30));
	
				$conforme+=$row['conforme'];
				$noconforme+=$row['noconforme'];
				$nosabe+=$row['nosabe'];			
	
				$positiva+=$row['positiva'];
				$negativa+=$row['negativa'];
				$neutral+=$row['neutral'];
				
				$max_total = ($max_total<intval($row['totales']) ? intval($row['totales']) : $max_total);
			}
			else 
			{
				$conforme_e+=$row['conforme'];
				$noconforme_e+=$row['noconforme'];
				$nosabe_e+=$row['nosabe'];			
	
				$positiva_e+=$row['positiva'];
				$negativa_e+=$row['negativa'];
				$neutral_e+=$row['neutral'];
				
				$total_e+=$row['totales'];
			}		
			$j++;
		}
		
		if($j>20)
		{
			$colores.=",".$this->m_colores[25];
			$series1.="|{$conforme_e},{$noconforme_e},{$nosabe_e}";
			$series2.="|{$positiva_e},{$neutral_e},{$negativa_e}";
			$series3.="|{$total_e}";
			$labels.="|({$total_e}) Resto";
			$max_total = ($max_total<$total_e ? $total_e : $max_total);			
			
			$conforme+=$conforme_e;
			$noconforme+=$noconforme_e;
			$nosabe+=$nosabe_e;			
	
			$positiva+=$positiva_e;
			$negativa+=$negativa_e;
			$neutral+=$neutral_e;
		}
		
		$image = array();
		
		//Armo la URL - REPORTE POR RESULTADO		
		$max = ($conforme>$max ? $conforme : $max);
		$max = ($noconforme>$max ? $noconforme : $max);
		$max = ($nosabe>$max ? $nosabe : $max);
		$ejeX = "0:|Conforme|No Conforme|No Sabe";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['resultado'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=600x500&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series1.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+resultado">';
		
		//Armo la URL - REPORTE POR Atencion
		$max = 0;
		$max = ($positiva>$max ? $positiva : $max);
		$max = ($negativa>$max ? $negativa : $max);
		$max = ($neutral>$max ? $neutral : $max);
		$ejeX = "0:|Positiva|Neutral|Negativa";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['actitud'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=600x500&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series2.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+actitud">';
		
		//Armo la URL - REPORTE POR BARRIO
		$scale = "0,$max_total";
		$scaleX = "0,0,$max_total";
		$image['prestacion'] = '<img src="http://chart.apis.google.com/chart?chxt=x&chxr='.$scaleX.'&chbh=a&chs=600x500&cht=bhg&chco='.$colores.'&chd=t:'.$series3.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+Prestacion">';
		
		return json_encode((object) array("result"=>"OK","image"=>$image));
	}

function reportePrestacion($params)
{	
			global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT qu.cqu_prestacion as prestacion,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,	
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu where qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'=''))
group by qu.cqu_prestacion ORDER BY count(*) DESC";
		$re = $primary_db->do_execute($sql);
		$rows = array();
		$totals = array('totales'=>0,'conforme'=>0,'noconforme'=>0,'nosabe'=>0,'positiva'=>0,'negativa'=>0,'neutral'=>0);
		while($row = $primary_db->_fetch_row($re))
		{
			$rows[]=array($row['prestacion'],$row['totales'],$row['conforme'],$row['noconforme'],$row['nosabe'],$row['positiva'],$row['negativa'],$row['neutral']);
			
			$totals['totales']+=$row['totales'];
			$totals['conforme']+=$row['conforme'];
			$totals['noconforme']+=$row['noconforme'];
			$totals['nosabe']+=$row['nosabe'];
			$totals['positiva']+=$row['positiva'];
			$totals['negativa']+=$row['negativa'];
			$totals['neutral']+=$row['neutral'];
		}
		$tot=array("TOTALES",$totals['totales'],$totals['conforme'],$totals['noconforme'],$totals['nosabe'],$totals['positiva'],$totals['negativa'],$totals['neutral']);
		return json_encode((object) array("result"=>"OK","rows"=>$rows,"columns"=>array("Prestación","Total","Conforme","No conforme","No sabe","Actitud positiva","Actitud negativa","Actitud Neutral"),"totals"=>$tot));
}
	
	
function horarios($params)
	{
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT HOUR(cqu_egreso_fecha) as hora,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu where qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'='')) 
group by HOUR(cqu_egreso_fecha) ORDER BY 1";

		
		$colores = "";
		$series1 = "";
		$series2 = "";
		$series3 = "";
		$labels = "";
		$j=0;
		$max = 0;
		
		$conforme = 0;
		$noconforme = 0;
		$nosabe = 0;
		
		$positiva=0;
		$negativa=0;
		$neutral =0;
		
		$max_total = 0;
		
		$re = $primary_db->do_execute($sql);
		while($row = $primary_db->_fetch_row($re))
		{
			if($j>0)
			{
				$colores.=",";
				$series1.="|";
				$series2.="|";
				$series3.="|";
				$labels.="|";
			}
			
			$colores.=$this->m_colores[$j];
			$series1.="{$row['conforme']},{$row['noconforme']},{$row['nosabe']}";
			$series2.="{$row['positiva']},{$row['neutral']},{$row['negativa']}";
			$series3.="{$row['totales']}";
			$labels.=$row['hora'].":00";

			$conforme+=$row['conforme'];
			$noconforme+=$row['noconforme'];
			$nosabe+=$row['nosabe'];			

			$positiva+=$row['positiva'];
			$negativa+=$row['negativa'];
			$neutral+=$row['neutral'];
			
			$max_total = ($max_total<intval($row['totales']) ? intval($row['totales']) : $max_total);
		
			$j++;
		}
		
		$image = array();
		
		//Armo la URL - REPORTE POR RESULTADO		
		$max = ($conforme>$max ? $conforme : $max);
		$max = ($noconforme>$max ? $noconforme : $max);
		$max = ($nosabe>$max ? $nosabe : $max);
		$ejeX = "0:|Conforme|No Conforme|No Sabe";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['resultado'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=600x400&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series1.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+resultado">';
		
		//Armo la URL - REPORTE POR Atencion
		$max = 0;
		$max = ($positiva>$max ? $positiva : $max);
		$max = ($negativa>$max ? $negativa : $max);
		$max = ($neutral>$max ? $neutral : $max);
		$ejeX = "0:|Positiva|Neutral|Negativa";
		$scale = "0,$max,0,$max,0,$max";
		$scaleY = "1,0,$max";
		$image['actitud'] = '<img src="http://chart.apis.google.com/chart?chxt=x,y&chxr='.$scaleY.'&chbh=a&chs=600x400&cht=bvs&chxl='.$ejeX.'&chco='.$colores.'&chd=t:'.$series2.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+actitud">';
		
		//Armo la URL - REPORTE POR HORARIO
		$scale = "0,$max_total";
		$scaleX = "0,0,$max_total";
		$image['horarios'] = '<img src="http://chart.apis.google.com/chart?chxt=x&chxr='.$scaleX.'&chbh=a&chs=600x400&cht=bhg&chco='.$colores.'&chd=t:'.$series3.'&chds='.$scale.'&chdl='.$labels.'&chtt=Reporte+por+horario">';
		
		return json_encode((object) array("result"=>"OK","image"=>$image));
	}
	
	function reporteHorarios($params)
	{	
		global $primary_db;
		$ret = array();
		
		list($desde,$hasta) = explode("|",$params);
		
		$sql = "SELECT HOUR(cqu_egreso_fecha) as hora,
	count(*) as totales, 
	sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,
	sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme, 
	sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,
	sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,
	sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,
	sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral 
FROM cal_queue qu where qu.cqu_estado='COMPLETADA' 
	and (cqu_egreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('$hasta','%d/%m/%Y %k:%i:%s') or ('$desde'='' and '$hasta'='')) 
group by HOUR(cqu_egreso_fecha) ORDER BY 1";
		$re = $primary_db->do_execute($sql);
		$rows = array();
		$totals = array('totales'=>0,'conforme'=>0,'noconforme'=>0,'nosabe'=>0,'positiva'=>0,'negativa'=>0,'neutral'=>0);
		while($row = $primary_db->_fetch_row($re))
		{
			$rows[]=array($row['hora'].":00",$row['totales'],$row['conforme'],$row['noconforme'],$row['nosabe'],$row['positiva'],$row['negativa'],$row['neutral']);
			
			$totals['totales']+=$row['totales'];
			$totals['conforme']+=$row['conforme'];
			$totals['noconforme']+=$row['noconforme'];
			$totals['nosabe']+=$row['nosabe'];
			$totals['positiva']+=$row['positiva'];
			$totals['negativa']+=$row['negativa'];
			$totals['neutral']+=$row['neutral'];
		}
		$tot=array("TOTALES",$totals['totales'],$totals['conforme'],$totals['noconforme'],$totals['nosabe'],$totals['positiva'],$totals['negativa'],$totals['neutral']);
		return json_encode((object) array("result"=>"OK","rows"=>$rows,"columns"=>array("Hora","Total","Conforme","No conforme","No sabe","Actitud positiva","Actitud negativa","Actitud Neutral"),"totals"=>$tot));
	}
}
?>