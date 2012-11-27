<?php 
/* Pantalla inicial para el operador de denuncias
 *
 * Muestra un tablero que indica:
 * 
 * Cantidad de Novedades
 * Cantidad de Denuncias abiertas
 * Ingresos / dia ultimos 30 dias
 * Cierres / dia ultimos 30 dias
 * Top 10 prestaciones ultimos 30 dias
 * 
 */
if(!class_exists('home_denuncias'))
{
    include_once "common/cfield.php";

	class home_denuncias
	{
		public function Render($context)
		{
			global $sess;
			$html = '<script type="text/javascript" src="/common/charts/FusionCharts.js"></script>';
            $html.= '<div id="home_denuncias" class="apTabs">';

//Estado de situacion
        	$organismos = $this->getOrganismos();
        	
            $html.= '<h2>Página de inicio para '.$sess->user_name.'</h2>';
         	$html.= '<div id="estado">';
			$html.= 'Novedades: <br><table><tr><th>Organismo</th><th>Cantidad</th></tr>';
         	$k=0;
			foreach($organismos as $org_code => $org_name)
            {
            	$cant = $this->getNovedades($org_code);
            	$html.= '<tr><td>'.$org_name.'</td><td>'.$cant.'</td></tr>';
            	$k+=$cant;
            }
            
            $html.= '<tr><td>TOTAL</td><td>'.$k.'</td></tr>';
            
         	$html.= '</table></div>'; // cierro estado

//Ingresos
			$j=0;
			$lista = "";
			foreach($organismos as $org_code => $org_name)
			{
				if($j++>0)
				{
					$lista.=",";
				}
				$lista.=$org_code;
			}
         	
			$html.= '<h2>Ingresos</h2>'; 
            $html.= '<div id="ingresos">';
            $dias = $this->getIngresos($lista);
            $xml = "";
            $j=30;
            $k=0;
            foreach($dias as $dia => $cant)
            {
            	if($j==0)
            	{
            		$xml.= "<set name='Hoy' value='$cant' />";
            	}
            	else
            	{
					$xml.= "<set name='$j' value='$cant' />";
            	}
            	$j--;
            	$k+=$cant;	
            }
           	$xml.= "</graph>";
            
           	if($k==0)
           	{
           		$xml = "<?xml version='1.0' encoding='UTF-8' ?><graph showNames='1' decimalPrecision='0' yaxismaxvalue='10' caption='Ingresos de denuncias (últimos 30 días)'>".$xml;
           	}
           	else
           	{
           		$xml = "<?xml version='1.0' encoding='UTF-8' ?><graph showNames='1' decimalPrecision='0' caption='Ingresos de denuncias (últimos 30 días)'>".$xml;
           	}
           	
           	$html.= '<div id="ingresosdiv" align="center">  </div>  
       			     <script type="text/javascript">
				   		var chart = new FusionCharts("/common/charts/FCF_Column3D.swf", "chartIngreso", "700", "400");
				   		chart.setDataXML("'.$xml.'");		   
				   		chart.render("ingresosdiv");
					</script>';
            	            $html.= '</div>'; //cierro ingresos

//Cierres
			$html.= '<h2>Cierres</h2>'; 
            $html.= '<div id="cierres">';
            $dias = $this->getCierres($lista);
            $xml = "";
            $j=30;
            $k=0;
            foreach($dias as $dia => $cant)
            {
            	if($j==0)
            	{
            		$xml.= "<set name='Hoy' value='$cant' />";
            	}
            	else
            	{
					$xml.= "<set name='$j' value='$cant' />";
            	}$j--;
            	$k+=$cant;	
            }
           	$xml.= "</graph>";
            
           	if($k==0)
           	{
	           	$xml = "<?xml version='1.0' encoding='UTF-8' ?><graph showNames='1' decimalPrecision='0' yaxismaxvalue='10' caption='Cierres de denuncias (últimos 30 días)'>".$xml;
           	}
           	else
           	{
           		$xml = "<?xml version='1.0' encoding='UTF-8' ?><graph showNames='1' decimalPrecision='0' caption='Cierres de denuncias (últimos 30 días)'>".$xml;
           	}
           	
           	$html.= '<div id="cierresdiv" align="center">  </div>  
       			     <script type="text/javascript">
				   		var chart = new FusionCharts("/common/charts/FCF_Column3D.swf", "chartCierre", "700", "400");
				   		chart.setDataXML("'.$xml.'");		   
				   		chart.render("cierresdiv");
					</script>';
           	
            $html.= '</div>'; //cierro cierres
            
//Distribucion
			$html.= '<h2>Distribución de prestaciones</h2>'; 
            $html.= '<div id="distribucion">';
			$prest = $this->getDistribucion($lista);
			$xml = "<?xml version='1.0' encoding='UTF-8' ?><graph showNames='1' decimalPrecision='0' caption='Distribución de prestaciones (último mes)'>";
            foreach($prest as $cant => $prestacion)
            {
            	$xml.= "<set name='$prestacion' value='$cant' />";	
            }
           	$xml.= "</graph>";
           
            $html.= '<div id="distribuciondiv" align="center">  </div>  
       			     <script type="text/javascript">
				   		var chart = new FusionCharts("/common/charts/FCF_Pie3D.swf", "chartDistribucion", "700", "600");
				   		chart.setDataXML("'.$xml.'");		   
				   		chart.render("distribuciondiv");
					</script>';
            $html.= '</div>'; //cierro distribución
            
			$html.= '</div>'; //cierro home_denuncias
			
			
			$content["home_denuncias"] = $html;
			return array( $content, array() );
		}
		
		private function getOrganismos()
		{
			global $sess;
		   	$sigla = array();
		   	
			if( isset($_SESSION['groups']) )
        	{
        		error_log("Grupos: ".$_SESSION['groups']);
            	$partes = explode(",",$_SESSION['groups']);
            	foreach($partes as $grupo)
            	{
            		$grp = strtoupper(trim($grupo));
                	if( substr($grp,0,10)=="ORGANISMO_" )
                	{
                    	$id = substr($grp,10);
                    	
                    	//Busco el codigo en la base
         				$row = $this->fetchRow("SELECT tor_code FROM tic_organismos WHERE tor_sigla='$id'");
         				if(count($row)>0)
         				{
         					$sigla[$row['tor_code']] = $id;
         				}           	
                	}
            	}	
        	}
     		
        	return $sigla;
		}

		private function getNovedades($org_code)
		{
			$row = $this->fetchRow("SELECT count(*) as cant FROM v_tickets WHERE tto_alerta=1 and tor_code=$org_code");
			if(count($row)>0)
   			{
         		return $row['cant'];
         	}
			return 0;
		}
		
		private function getIngresos($lista)
		{
			global $primary_db;
			$sql = "SELECT count(*) as cant,DAYOFYEAR(ttp_tstamp) as dia FROM v_tickets WHERE tor_code in ($lista) AND ttp_estado not in ('CUMPLIDA','DESESTIMADA') and DAYOFYEAR(ttp_tstamp) between (DAYOFYEAR(NOW())-30) and (DAYOFYEAR(NOW())) GROUP BY DAYOFYEAR(ttp_tstamp) order by 2";
			$conjunto = array();
			$rs = $primary_db->do_execute($sql);
			if($rs) 
			{
				$j=0;
				while( $row = $primary_db->_fetch_row($rs,$j++) )
				{
					$conjunto[ $row['dia'] ] = $row['cant'];
				}
			}
			
			//Completo dias faltantes
			for($dia=(date("z")-30); $dia<=date("z"); $dia++)
			{
				if( !isset($conjunto[$dia]) )
				{
					$conjunto[$dia] = 0;
				}	
			}
			ksort($conjunto);
			return $conjunto;
		}
		
		private function getCierres($lista)
		{
			global $primary_db;
			$sql = "SELECT count(*) as cant,DAYOFYEAR(ttp_tstamp) as dia FROM v_tickets WHERE tor_code in ($lista) AND ttp_estado in ('CUMPLIDA','DESESTIMADA') and DAYOFYEAR(ttp_tstamp) between (DAYOFYEAR(NOW())-30) and (DAYOFYEAR(NOW())) GROUP BY DAYOFYEAR(ttp_tstamp) order by 2";
			$conjunto = array();
			$rs = $primary_db->do_execute($sql);
			if($rs) 
			{
				$j=0;
				while( $row = $primary_db->_fetch_row($rs,$j++) )
				{
					$conjunto[ $row['dia'] ] = $row['cant'];
				}
			}
			
			//Completo dias faltantes
			for($dia=(date("z")-30); $dia<=date("z"); $dia++)
			{
				if( !isset($conjunto[$dia]) )
				{
					$conjunto[$dia] = 0;
				}	
			}
			ksort($conjunto);
			return $conjunto;
		}
		
		private function getDistribucion($lista)
		{
			global $primary_db;
			$conjunto = array();
			$sql = "SELECT count(*) as cant,vt.tpr_code,pr.tpr_detalle FROM v_tickets vt JOIN tic_prestaciones pr ON vt.tpr_code=pr.tpr_code WHERE tor_code in ($lista) and DAYOFYEAR(ttp_tstamp) between (DAYOFYEAR(NOW())-30) and (DAYOFYEAR(NOW())) GROUP BY vt.tpr_code order by 1 desc limit 10";
			$rs = $primary_db->do_execute($sql);
			if($rs) 
			{
				$j=0;
				while( $row = $primary_db->_fetch_row($rs,$j++) )
				{
					$conjunto[ $row['cant'] ] = $row['tpr_detalle'];
				}
			}
			return $conjunto;
		}
		
		private function fetchRow($sql) 
		{
			global $primary_db;
			$rs = $primary_db->do_execute($sql);
			if($rs) 
			{
				if( $row = $primary_db->_fetch_row($rs,0) )
				{
					return $row;
				}
			}
			return array();
		}
		
	}
}

?>	
