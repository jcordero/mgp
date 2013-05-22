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
                $html = '<div class="container">
                            <div class="row">
                                <div class="span12">
                                    <h4 id="mi_titulo">Tablero indicador 147</h4> 
                                </div>
                            </div>
                            
                            <div class="row" id="contadores">
                                <div class="span1"><button class="btn btn-small"><h4><i class="icon-inbox"></i> <span id="cAbiertos"></span></h4> Abiertos</button></div>
                                <div class="span1"><button class="btn btn-small"><h4><i class="icon-ok-sign"></i> <span id="cCerrados"></span></h4> Cerrados</button></div>
                                <div class="span1"><button class="btn btn-small"><h4><i class="icon-exclamation-sign"></i> <span id="cVencidos"></span></h4> Vencidos</button></div>
                            </div>
                            
                            <div class="row">
                                <div id="reporte_mapa"></div>
                            </div>
                ';

                $includes[] = '<script type="text/javascript" src="common/Highcharts-3/js/highcharts.js"></script>';
                $includes[] = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDbNPUeZ1qDaGdShuVhRIT9Cgb_NZzuPRw&amp;sensor=false"></script>';
                $includes[] = '<script type="text/javascript" src="lmodules/reportes/markerclusterer.js"></script>';
                $includes[] = '<script type="text/javascript" src="includes/homepage/comp/home_dashboard.js"></script>';
                
                $css = '
<style>
    #reporte_mapa {width:100%; height:400px;}
    #reporte_mapa label { width: auto; display:inline; }
    #reporte_mapa img { max-width: none; max-height: none; }
    .iwimg {height: 128px;width: auto;}
    #contadores {margin-top:10px; margin-bottom:10px;}
</style>';
                
		$content["home_dashboard"] = $css.$html;
		return array( $content, $errors, $includes );
	}		
    }
}

?>	
