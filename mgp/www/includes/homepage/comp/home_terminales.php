<?php
if(!class_exists('home_terminales'))
{
	class home_terminales
	{
		public function Render($context)
		{
			global $sess;
	
			$html = '
				<script type="text/javascript" src="'.WEB_PATH.'/common/Highcharts-2.1.9/js/highcharts.js"></script>	
				<script type="text/javascript" src="'.WEB_PATH.'/includes/homepage/comp/home_terminales.js"></script>	
				
				<style>
					.botones {text-align:left; width:950px;margin:0 auto;}				
					#phome {text-align:left; width:950px; margin:0 auto; min-height:800px;}		
					#shortcuts {display:none;}		
					#graf_eventos {width:950px;height:320px;margin-top:10px;}
					#graf_sitios {width:950px;height:320px;;margin-top:10px;}
					#botones {border:solid 1px #ddd; border-radius:5px; padding:10px;text-align:right;height:50px;}
					#navegador {font: 18px Helvetica,Arial;font-weight:bold;float:left;}
					#fechas, #totales {font: 12px Helvetica,Arial;float:left;clear:left;}
					#volver {display:none;}
					#cambio_fecha {display:inline;}
				</style>
				<style media="print">
					#botones button, #volver, #main {display:none;}
				</style>
				

				<div class="botones">
					
				</div>		

				<div id="phome">
					<div id="botones">
						<div id="navegador"></div>
						<div id="fechas"></div>
						<div id="totales"></div>
						<div id="cambio_fecha">
							<button onclick="setDias(1)">Dia</button>
							<button onclick="setDias(7)">Semana</button>
							<button onclick="setDias(15)">Quincena</button>
							<button onclick="setDias(30)">Mes</button>
							<button onclick="setDias(180)">Semestre</button>
						</div>
						<button class="btn_imprimir" onclick="print()">Imprimir</button>
						<button  id="volver" onclick="goHome()">Volver atrás</button>
					</div>
				
					<div id="graf_eventos"></div>
					<div id="graf_sitios"></div>
				</div>
			';	
		
			$content["home_terminales"] = $html;
			$content["upload"] = "";
			return array( $content, array() );
		}
	}
}