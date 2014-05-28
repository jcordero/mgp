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
include_once "common/cfield.php";

class home_tickets {

    public function Render(ccontext $context) {
        $includes = array();
        $html = '<div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 id="mi_titulo">Cargando sus tickets...</h4> 
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="col-xs-4"><button id="abiertos" class="btn btn-sm" onclick="mostrarPagina(pagnro,\'ABIERTOS\',\'\')"><i class="icon-inbox"></i> Abiertos</button>
                            &nbsp;<button id="cerrados" class="btn btn-sm" onclick="mostrarPagina(pagnro,\'CERRADOS\',\'\')"><i class="icon-ok-sign"></i> Cerrados</button>
                            &nbsp;<button id="vencidos" class="btn btn-sm" onclick="mostrarPagina(pagnro,\'VENCIDOS\',\'\')"><i class="icon-exclamation-sign"></i> Vencidos</button>
                        </div>
                                
                        <div class="col-xs-7 col-xs-offset-1">
                            <form class="form-search pull-right" id="buscador" onsubmit="return false">
                                <input type="text" class="input-medium search-query">
                                <button type="submit" class="btn btn-sm">Buscar</button>
                            </form>
                        </div>    
                    </div>
                            
                    <div class="row nav" style="margin-top:5px;">
                        <div class="col-xs-6">
                            <h5>Página <span id="nro_pagina">1</span> de <span id="total_paginas"></span></h5>
                        </div>
                        <div class="col-xs-6">
                            <form class="form-inline pull-right" id="navegador" onsubmit="return false">
                            </form>
                        </div>
                    </div>
                            
                    <div class="row">
                        <div class="col-xs-12">
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
                   <div class="col-xs-12 hide alert alert-info" id="sin_tickets">
                       No hay tickets 
                   </div>
                </div>
                <div class="row">
                       <div class="col-xs-12">
                           <div id="carga_tickets" class="progress progress-striped active">
                               <div class="bar" style="width: 100%;"></div>
                           </div>
                       </div>
                </div>
                ';

        $includes[] = '<script type="text/javascript" src="/mgp/includes/homepage/comp/home_tickets.js"></script>';

        $context->add_content($context->m_key, $html);
        $context->add_includes($includes);
        return;
    }

}
