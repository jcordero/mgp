<?php

class home_dashboard {

    public function Render(ccontext $context) {
        $includes = array();

        $dash_config = (isset($_SESSION["dash_config"]) ? $_SESSION["dash_config"] : (object) array(
                            "boton" => "ABIERTOS",
                            "canal" => "",
                            "organismo" => array("codigo" => "", "nombre" => ""),
                            "prestacion" => array("codigo" => "", "nombre" => ""),
                            "barrio" => ""
        ));
        ob_start();
        ?>
        <script type="text/javascript">
            var dash_config = <?php echo json_encode($dash_config, JSON_UNESCAPED_UNICODE); ?>
        </script>

        <div class="row" id="contadores">
            <div class="col-xs-6">
                <button id="bAbiertos" class="btn estados" onclick="ejecutar_consulta('ABIERTOS')">
                    <h4><i class="glyphicon glyphicon-inbox"></i> <span id="cAbiertos"></span></h4> Pendientes, En Curso
                </button>&nbsp;
                <button id="bCerrados" class="btn estados" onclick="ejecutar_consulta('CERRADOS')">
                    <h4><i class="glyphicon glyphicon-ok"></i> <span id="cCerrados"></span></h4> Resueltos, Rechazados
                </button>&nbsp;
                <button id="bVencidos" class="btn estados" onclick="ejecutar_consulta('VENCIDOS')">
                    <h4><i class="glyphicon glyphicon-warning-sign"></i> <span id="cVencidos"></span></h4> Vencidos
                </button>
            </div>
            <div class="col-xs-6">
                <div class="panel panel-default">
                    <div id="filtros" class="panel-body">
                        <div class="col-xs-8 actuales">

                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-sm btn-primary pull-right"><i class="glyphicon glyphicon-cog"></i> Cambiar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="reporte_mapa"></div>
            </div>

            <div class="modal fade" id="filtro_dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="canal">Canal</label>
                                    <div class="col-sm-10"><?php $this->makeSelect('canal', $dash_config->canal); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="organismo">Organismo</label> 
                                    <div class="col-sm-10"><?php $this->makeSelect('organismo', $dash_config->organismo->codigo) ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="prestacion">Prestación</label> 
                                    <div class="col-sm-10"><?php $this->makeSelect('prestacion', $dash_config->prestacion->codigo) ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="barrio">Barrio</label> 
                                    <div class="col-sm-10"><?php $this->makeSelect('barrio', $dash_config->barrio) ?></div>
                                </div>

                                <div class="progress progress-striped active" id="cargando">
                                    <div class="bar"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>
        <?php
        $html = ob_get_clean();

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
    #contadores .Xestados {width:100%;}
    .bar {width: 100%!important;}
    #cargando {display:none;}
</style>';

        $context->add_content($context->m_key, $css . $html);
        $context->add_includes($includes);
        return;
    }

    private function makeSelect($tipo, $actual) {
        global $primary_db;
        error_log("home_dashboard::makeSelect($tipo, $actual)");
        $html = '<select class="form-control input-sm" name="' . $tipo . '" id="' . $tipo . '"><option value="">todos';

        switch ($tipo) {
            case "canal":
                $canales = array("CALL" => "Teléfono", "INTERNET" => "Internet", "MOVIL" => "Móvil", "PRESENCIAL" => "Presencial");
                foreach ($canales as $ix => $ca) {
                    $html.= '<option value="' . $ix . '">' . $ca . '</option>';
                }
                break;
            case "organismo":
                $rs1 = $primary_db->do_execute("select tor_code,tor_sigla from tic_organismos order by 1");
                while ($row1 = $primary_db->_fetch_row($rs1)) {
                    $html.= '<option value="' . $row1[0] . '">' . $row1[1] . '</option>';
                }
                break;
            case "prestacion":
                $rs2 = $primary_db->do_execute("select tpr_code,tpr_detalle from tic_prestaciones order by 2");
                while ($row2 = $primary_db->_fetch_row($rs2)) {
                    $html.= '<option value="' . $row2[0] . '">(' . $row2[0] . ') ' . $row2[1] . '</option>';
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

                foreach ($barrios as $n) {
                    $html.= '<option value="' . $n . '">' . $n . '</option>';
                }
                break;
            default:
        }

        $html.= '</select>';
        echo $html;
    }

}
