<?php 
if(!class_exists('home_dashboard'))
{
	class home_dashboard
	{
            public function Render($context)
            {
                $includes = array();
                $content = array();
                $errors = array();    
                $html = '
                            <div class="row">
                                <div class="span12">
                                    <h4 id="mi_titulo">Tablero indicador 147</h4> 
                                </div>
                            </div>
                            
                            <div class="row" id="contadores">
                                <div class="span2"><button id="bAbiertos" class="btn btn-large" onclick="ejecutar_consulta(\'ABIERTOS\')"><h4><i class="icon-inbox"></i> <span id="cAbiertos"></span></h4> Pendientes<br>En Curso</button></div>
                                <div class="span2"><button id="bCerrados" class="btn btn-large" onclick="ejecutar_consulta(\'CERRADOS\')"><h4><i class="icon-ok-sign"></i> <span id="cCerrados"></span></h4> Resueltos Rechazados</button></div>
                                <div class="span2"><button id="bVencidos" class="btn btn-large" onclick="ejecutar_consulta(\'VENCIDOS\')"><h4><i class="icon-exclamation-sign"></i> <span id="cVencidos"></span></h4> Tickets<br>Vencidos</button></div>
                                <div class="span4 progress progress-striped active" id="cargando">
                                    <div class="bar"></div>
                                </div>
                            </div>
                  
                            
                            <div class="row">
                                <div id="reporte_mapa"></div>
                            </div>
                ';

                //$includes[] = '<script type="text/javascript" src="common/Highcharts-3/js/highcharts.js"></script>';
                $includes[] = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDbNPUeZ1qDaGdShuVhRIT9Cgb_NZzuPRw&amp;sensor=false"></script>';
                $includes[] = '<script type="text/javascript" src="lmodules/reportes/markerclusterer.js"></script>';
                $includes[] = '<script type="text/javascript" src="includes/homepage/comp/home_dashboard.js"></script>';
                
                $css = '
<style>
    #reporte_mapa {width:100%; height:700px;}
    #reporte_mapa label { width: auto; display:inline; }
    #reporte_mapa img { max-width: none; max-height: none; }
    .iwimg {height: 128px;width: auto;}
    #contadores {margin-top:10px; margin-bottom:10px;}
    .bar {width: 100%!important;}
    #cargando {display:none;}
</style>';
                
		$content["home_dashboard"] = $css.$html;
		return array( $content, $errors, $includes );
	}		
    }
}

?>	
