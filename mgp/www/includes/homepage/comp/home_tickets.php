<?php 
/* Pantalla inicial para el area que responde a los tickets
 *
 * Muestra un tablero que indica:
 * 
 * inbox
 * 
 * Cantidad de Novedades
 * Cantidad de Denuncias abiertas
 * Ingresos / dia ultimos 30 dias
 * Cierres / dia ultimos 30 dias
 * Top 10 prestaciones ultimos 30 dias
 * 
 */
if(!class_exists('home_tickets'))
{
    include_once "common/cfield.php";

	class home_tickets
	{
            public function Render($context)
            {
                $includes = array();
                $content = array();
                $errors = array();    
                $html = '<div class="container">
                             <div class="row">
                                <div class="span12">
                                    <h4 id="mi_titulo">Cargando sus tickets...</h4> 
                                </div>
                         </div>
                            
                            <div class="row">
                                <div class="span1"><button id="abiertos" class="btn btn-small" onclick="mostrarPagina(pagnro,\'ABIERTOS\')"><i class="icon-inbox"></i> Abiertos</button></div>
                                <div class="span1"><button id="cerrados" class="btn btn-small" onclick="mostrarPagina(pagnro,\'CERRADOS\')"><i class="icon-ok-sign"></i> Cerrados</button></div>
                                <div class="span1"><button id="vencidos" class="btn btn-small" onclick="mostrarPagina(pagnro,\'VENCIDOS\')"><i class="icon-exclamation-sign"></i> Vencidos</button></div>
                                
                                <div class="span9">
                                    <form class="form-search" id="buscador" onsubmit="return false">
                                        <input type="text" class="input-medium search-query">
                                        <button type="submit" class="btn">Buscar</button>
                                    </form>
                                </div>    
                            </div>
                            
                            <div class="row nav" >
                                <div class="span6">
                                    <h5>Página <span id="nro_pagina">1</span> de <span id="total_paginas"></span></h5>
                                </div>
                                <div class="span6">
                                    <form class="form-inline" id="navegador" onsubmit="return false">
                                    </form>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="span12">
                                    <table id="mis_tickets" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha/Id</th>
                                                <th>Prestación/Nota</th>
                                                <th>Dirección</th>
                                                <th>Estados</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                         
                         <div class="row">
                            <div class="span12 hide alert alert-info" id="sin_tickets">
                                No hay tickets 
                            </div>
                         </div>
                         <div class="row">
                                <div class="span12">
                                    <div id="carga_tickets" class="progress progress-striped active">
                                        <div class="bar" style="width: 100%;"></div>
                                    </div>
                                </div>
                         </div>
                ';

                $includes[] = '<script type="text/javascript" src="/mgp/includes/homepage/comp/home_tickets.js"></script>';
                
		$content["home_tickets"] = $html;
		return array( $content, $errors, $includes );
	}		
    }
}

?>	
