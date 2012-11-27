<?php
/*
	Presenta al operador un botón para pedir una ticket de llamada
	Muestra un panel de las llamadas en curso
	
	Todo por ajax
*/
if(!class_exists('home_salientes'))
{
	class home_salientes
	{
		public function Render($context)
		{
			global $sess,$primary_db;
			$nl = "\n";
			$html="";
			
			list($filtro_msg,$filtro_sql, $js) = $this->determinarFiltro();
			
			$disponibles = $primary_db->QueryString("select count(*) from cal_queue where cqu_estado='PENDIENTE' $filtro_sql");
			$html.= '<style>
				#toolbar_salientes {height:200px;}
				.toolbar_box {
					float: left;
					width: 140px;
					height: 160px;
					cursor: pointer;
					border: solid 2px #888;
					border-radius: 5px;
					margin: 10px;
					box-shadow: 5px 5px 5px #CCC;text-align: center;
					font: bold 12px Arial,Helvetica;
				}
				.bubble {
					position: absolute;
					width: 30px;
					height: 15px;
					border: solid 2px #F88;
					border-radius: 5px;
					margin: 3px;
					left: 120px;
					background: #FEE;
				}
				.toolbar_box img { clear:none; }
				table {
					border-spacing: 0;
					border-collapse: collapse;
				}
				th {
					background: #6199DF;
					color: white;
					border: 1px solid #4D90F0;
					padding: 6px 10px;
				}
				td {
					border: 1px solid #BBB;
					vertical-align: top;
					padding: 6px 10px;
				}
				#encurso span {font-style: italic;
color: #444;
font-weight: bold;}
			</style>';
			$html.= '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/home_salientes.js"></script>'."\n";
			
			//Script para animar los botones
			$html.= '<script type="text/javascript">
			$(document).ready(function(){
				$(".toolbar_box").hover(function(){
					$(this).animate({width:"130px",height:"150px"},{queue:false,duration:300});
					$(this).find("img").animate({width:"120px",height:"120px"},{queue:false,duration:300});
				},
				function(){
					$(this).animate({width:"140px",height:"160px"},{queue:false,duration:300});
					$(this).find("img").animate({width:"128px",height:"128px"},{queue:false,duration:300});
				});			
			});
			</script>';		
			
			$html.= $js;
			$html.= '
			<h3>Call Saliente</h3>
			<h4>Filtrando contactos: '.$filtro_msg.'</h4>
			<div id="toolbar_salientes">
				<div class="toolbar_box" onclick="pedirLlamada()">
					<div class="bubble">'.$disponibles.'</div>
					<image src="/call/images/icons_big/ChatBubble.png">
					Iniciar LLamada
				</div>
				
				<div class="toolbar_box" onclick="go(\'reportes\')">
					<image src="/call/images/icons_big/Document.png">
					Reportes
				</div>
				
				<div class="toolbar_box" onclick="go(\'ajustes\')">
					<image src="/call/images/icons_big/Tool.png">
					Configurar campaña
				</div>

				<div class="toolbar_box" onclick="go(\'colallamadas\')">
					<image src="/call/images/icons_big/Phone.png">
					Llamadas realizadas
				</div>
				
			</div>
			
			<div id="salientes">				
				<div id="estado">Llamadas en curso actualmente:
					<div id="encurso"><img src="/call/images/default/loading2.gif"></div>
				</div>
			</div>
			'.$nl;
			
			$content["home_salientes"] = $html;
			return array( $content, array() );
		}
		
		private function determinarFiltro() {
			global $sess,$primary_db;
			
			$cgpc = $sess->getParameter($primary_db,"cgpc");
			$barrio = $sess->getParameter($primary_db,"barrio");
			$tipo = $sess->getParameter($primary_db,"tipo_contacto");
			$estado = $sess->getParameter($primary_db,"estado_contacto");
			$desde = $sess->getParameter($primary_db,"desde_contacto");
			$hasta = $sess->getParameter($primary_db,"hasta_contacto");
			$sql = "";							
			$filtro = "";
						
			if($cgpc!="")
			{
				$filtro .= " $cgpc";
				$my_cgpc = "Comuna".substr($cgpc,strpos($cgpc," "));
				$sql .= " AND cqu_cgpc='$my_cgpc'";
			}
			
			if($barrio!="")
			{
				$filtro .= " Barrio $barrio";
				$sql .= " AND cqu_barrio='$barrio'";
			}

			if($tipo!="")
			{
				$filtro .= " Tipo de contacto $tipo";
				$sql .= " AND cqu_tipo='$tipo'";
			}
		
			if($estado!="")
			{
				$filtro .= " Estado del contacto $estado";
				$sql .= " AND cqu_estado_contacto='$estado'";
			}
			if($desde!="" && $hasta!="")
			{
				$filtro.=" Ingresado entre $desde y $hasta";
				$sql.= " AND cqu_con_ingreso_fecha between STR_TO_DATE('$desde','%d/%m/%Y') and STR_TO_DATE('$hasta','%d/%m/%Y')";
			}
			if($desde!="" && $hasta=="")
			{
				$filtro.=" Ingresado a partir del $desde";
				$sql.= " AND cqu_con_ingreso_fecha >= STR_TO_DATE('$desde','%d/%m/%Y')";
			}
			if($desde=="" && $hasta!="")
			{
				$filtro.=" Ingresado hasta el $desde";
				$sql.= " AND cqu_con_ingreso_fecha < STR_TO_DATE('$desde','%d/%m/%Y')";
			}
			
			if($sql=="")
				$filtro = "(Sin filtros)";
			
			$js = "<script type=\"text/javascript\">var param_cgpc = '$cgpc'; var param_barrio = '$barrio'; var param_tipo = '$tipo'; var param_estado = '$estado'; var param_desde = '$desde'; var param_hasta='$hasta';</script>\n";
			
			return array($filtro,$sql,$js);
		}
	}
}