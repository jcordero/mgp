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
                
                $dash_config = (isset($_SESSION["dash_config"]) ? $_SESSION["dash_config"] : (object) array("boton"=>"ABIERTOS","canal"=>"","organismo"=>"","prestacion"=>"","barrio"=>""));
                
                $html = '   <script type="text/javascript">
                                var dash_config = '.json_encode($dash_config,JSON_UNESCAPED_UNICODE).';
                            </script>
                            
                            <div class="row">
                                <div class="span12">
                                    <h4 id="mi_titulo">Tablero indicador 147</h4> 
                                </div>
                            </div>
                            
                            <div class="row" id="contadores">
                                <div class="span2"><button id="bAbiertos" class="btn btn-large" onclick="ejecutar_consulta(\'ABIERTOS\')"><h4><i class="icon-inbox"></i> <span id="cAbiertos"></span></h4> Pendientes<br>En Curso</button></div>
                                <div class="span2"><button id="bCerrados" class="btn btn-large" onclick="ejecutar_consulta(\'CERRADOS\')"><h4><i class="icon-ok-sign"></i> <span id="cCerrados"></span></h4> Resueltos Rechazados</button></div>
                                <div class="span2"><button id="bVencidos" class="btn btn-large" onclick="ejecutar_consulta(\'VENCIDOS\')"><h4><i class="icon-exclamation-sign"></i> <span id="cVencidos"></span></h4> Tickets<br>Vencidos</button></div>
                                <div class="span6">
                                    <div class="form-inline">
                                        <label class="control-label" for="canal">Canal</label> '.$this->makeSelect('canal').'
                                        <label class="control-label" for="organismo">Organismo</label> '.$this->makeSelect('organismo').'
                                    </div>
                                    <div class="form-inline">
                                        <label class="control-label" for="prestacion">Prestación</label> '.$this->makeSelect('prestacion').'
                                    </div>
                                    <div class="form-inline">
                                        <label class="control-label" for="barrio">Barrio</label> '.$this->makeSelect('barrio').'
                                    </div>
                                    <div class="progress progress-striped active" id="cargando">
                                        <div class="bar"></div>
                                    </div>
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
        
        private function makeSelect($tipo) {
            global $primary_db;
            $html = '<select name="'.$tipo.'" id="'.$tipo.'"><option value="">todos'; 
            
            switch ($tipo) {
                case "canal":
                    $html.= '<option value="CALL">Teléfono<option value="INTERNET">Internet<option value="MOVIL">Móvil<option value="PRESENCIAL">presencial';
                    break;
                case "organismo":
                    $rs1 = $primary_db->do_execute("select tor_code,tor_sigla from tic_organismos order by 1");
                    while( $row1=$primary_db->_fetch_row($rs1) ) {
                        $html.= '<option value="'.$row1[0].'">'.$row1[1];
                    } 
                    break;
                case "prestacion":
                    $rs2 = $primary_db->do_execute("select tpr_code,tpr_detalle from tic_prestaciones order by 2");
                    while( $row2=$primary_db->_fetch_row($rs2) ) {
                        $html.= '<option value="'.$row2[0].'">('.$row2[0].') '.$row2[1];
                    } 
                    break;
                case "barrio":
                    $barrios = array(
                    "GENERAL BELGRANO",
                    "DON EMILIO",
                    "ROLDAN BELISARIO",
                    "CARIBE",
                    "PARQUE CAMET",
                    "LAS MARGARITAS",
                    "SANTA ROSA DEL MAR DE PERALTA RAMOS",
                    "ALFAR",
                    "FARO NORTE",
                    "SANCHEZ FLORENCIO",
                    "LAS CANTERAS",
                    "PARQUE PALERMO",
                    "CERRITO SUR",
                    "JURAMENTO",
                    "SANTA MONICA",
                    "SANTA RITA",
                    "RIVADAVIA BERNARDINO",
                    "CORONEL DORREGO",
                    "NEWBERY JORGE",
                    "MALVINAS ARGENTINAS",
                    "VIRGEN DE LUJAN",
                    "LOS TRONCOS",
                    "SAN CARLOS",
                    "PLAZA PERALTA RAMOS",
                    "CAMET FELIX U.",
                    "ESTACION CAMET",
                    "DOS DE ABRIL",
                    "HIPODROMO",
                    "COLINA ALEGRE",
                    "PARQUE HERMOSO Y VALLE HERMOSO",
                    "GENERAL SAN MARTIN",
                    "SANTA CELINA",
                    "LOS ACANTILADOS",
                    "SAN PATRICIO",
                    "PLAYA SERENA",
                    "SAN JACINTO",
                    "QUEBRADAS DE PERALTA RAMOS",
                    "EL MARTILLO",
                    "GENERAL PUEYRREDON",
                    "DE LAS HERASJUAN GREGORIO",
                    "CAMINO A NECOCHEA",
                    "BOSQUE GRANDE",
                    "BOSQUE ALEGRE",
                    "EL GAUCHO",
                    "LAS AMERICAS",
                    "PERALTA RAMOS OESTE",
                    "EL PROGRESO",
                    "DEL PUERTO",
                    "PUNTA MOGOTES",
                    "COLINAS DE PERALTA RAMOS",
                    "CERRITO Y SAN SALVADOR",
                    "TERMAS  HUINCO",
                    "VILLA LOURDES",
                    "LAS AVENIDAS",
                    "REGIONAL",
                    "LAS LILAS",
                    "SAN JOSE",
                    "LOS ANDES",
                    "SAN CAYETANO",
                    "SARMIENTO DOMINGO FAUSTINO",
                    "NUEVE DE JULIO",
                    "ESTACION NORTE",
                    "NUEVA POMPEYA",
                    "LA PERLA",
                    "VILLA PRIMERA",
                    "PARQUE LURO",
                    "LOS PINARES",
                    "SANTA ROSA DE LIMA",
                    "SAN JORGE",
                    "AMEGHINO FLORENTINO",
                    "LIBERTAD",
                    "CONSTITUCIÓN",
                    "ZACAGNINI JOSE MANUEL",
                    "PARQUE MONTEMAR-EL GROSELLAR",
                    "LOPEZ DE GOMARA",
                    "LOS TILOS",
                    "AEROPARQUE",
                    "LA FLORIDA",
                    "ESTRADA JOSE MANUEL",
                    "PLAYA GRANDE",
                    "EL JARDIN DE PERALTA RAMOS",
                    "AUTODROMO",
                    "BOSQUE PERALTA RAMOS",
                    "PARQUE INDEPENDENCIA",
                    "EL JARDIN DE STELLA MARIS",
                    "DE LA PLAZA FORTUNATO",
                    "SAN ANTONIO",
                    "PARQUE EL CASAL",
                    "SANTA PAULA",
                    "SIERRA DE LOS PADRES",
                    "LA PEREGRINA",
                    "LA GLORIA DE LA PEREGRINA",
                    "EL BOQUERON",
                    "PLAYA LOS LOBOS",
                    "PLAYA CHAPADMALAL",
                    "ARROYO CHAPADMALAL",
                    "SAN EDUARDO DE CHAPADMALAL",
                    "EL MARQUESADO",
                    "SAN EDUARDO DEL MAR",
                    "LOMAS DE STELLA MARIS",
                    "ESTACION CHAPADMALAL",
                    "LA HERRADURA",
                    "JOSE HERNÁNDEZ",
                    "LOMAS DEL GOLF",
                    "COLONIA BARRAGAN",
                    "LA GERMANA",
                    "PARQUE INDUSTRIAL",
                    "FRAY LUIS BELTRAN",
                    "FUNES Y SAN LORENZO",
                    "PINOS DE ANCHORENA",
                    "PRIMERA JUNTA",
                    "SAN JUAN",
                    "DON BOSCO",
                    "ESTACIÓN TERMINAL",
                    "GENERAL ROCA",
                    "LEANDRO N. ALEM",
                    "EL COLMENAR",
                    "LAS RETAMAS",
                    "VILLA SERRANA",
                    "BATAN",
                    "DIVINO ROSTRO",
                    "NUEVO GOLF",
                    "LOMAS DE BATAN",
                    "AREA CENTRO" 
                    );

                    //Ordeno los barrios alfabeticamente
                    asort($barrios);
                
                    foreach($barrios as $n)
                        $html.= '<option value="'.$n.'">'.$n;     

                    break;
                default:
            }
            
            $html.= '</select>';
            return $html;
        }

    }
    
}

?>	
