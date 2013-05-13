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
                                    <div id="carga_tickets" class="progress progress-striped active">
                                        <div class="bar" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="span1"><button class="btn btn-small" onclick="mostrarPagina(pagnro,\'ABIERTOS\')"><i class="icon-inbox"></i> Abiertos</button></div>
                                <div class="span1"><button class="btn btn-small" onclick="mostrarPagina(pagnro,\'CERRADOS\')"><i class="icon-ok-sign"></i> Cerrados</button></div>
                                <div class="span1"><button class="btn btn-small" onclick="mostrarPagina(pagnro,\'VENCIDOS\')"><i class="icon-exclamation-sign"></i> Vencidos</button></div>
                            </div>
                            
                            <div class="row">
                                <div class="span12">
                                    <table id="mis_tickets" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha/Id</th>
                                                <th>Prestación/Nota</th>
                                                <th>Dirección</th>
                                                <th>Rol</th>
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

                ';

                $includes[] = '
                <script type="text/javascript">
                    $(document).ready(function(){
                        //Recupero los tickets para los organismos del usuario
                        mostrarPagina(1,"ABIERTOS");
                    });
                    
                    var mostrarPaginaBusy = false;
                    var pagnro = 1;
                    
                    function mostrarPagina(nro,filtro) {
                        if(mostrarPaginaBusy)
                            return;
                        mostrarPaginaBusy = true;
                        var b = $("#mis_tickets tbody").html("");
                        $("#carga_tickets").show();
                        $("#mi_titulo").html("Cargando tickets...");
                        $("#sin_tickets").hide();
                        
                        new rem_request(this,function(obj,json){
                            var obj = JSON.parse(json);
                            var o = obj.tickets;
                            var l = o.length;
                            for(var j=0;j<l;j++) {
                                var est_prest = (o[j].estado_prest=="resuelto" ? " badge-success" : " badge-warning");
                                var h = "<tr><td>" + o[j].fecha + "<br>" + o[j].identificador + "</td>" +
                                        "<td>" + o[j].prestacion + "<br><span class=\"it\">" + o[j].nota + "</span></td>" +
                                        "<td>" + renderDireccion(o[j].direccion) + "</td>" +
                                        "<td>" + o[j].rol + "</td>" +
                                        "<td><span class=\"badge badge-info\">" + o[j].estado + "</span><br><span class=\"badge"+est_prest+"\">" + o[j].estado_prest + "</span></td>" +
                                        "<td><button class=\"btn btn-small\" onclick=\"trabajar(\'" + o[j].ticket + "\')\">Trabajar</button></td></tr>";
                                b.append(h);
                            }
                            
                            if(l==0)
                                $("#sin_tickets").html("Sin tickets "+filtro).show();
                        
                            $("#mis_tickets a").popover();
                            $("#carga_tickets").hide();
                            $("#mi_titulo").html(obj.titulo);
                            mostrarPaginaBusy = false;
                        },"TICKET::TICKETS","crearPagina",nro+"|"+filtro);    
                    }
                    
                    function renderDireccion(o) {
                        if(o && o.lat && o.lng) {
                            var mapa = "<img id=\'mapa\' src=\'" + sess_web_path + "/common/mapa.php?x=" + o.lat + "&y=" + o.lng + "&w=250&h=250&r=250\'>";
                            var d = o.calle_nombre + " " + o.callenro + " <a href=\"#\" data-toggle=\"popover\" title=\"Ubicación\" data-html=\"true\" data-content=\"" + mapa + "\" ><i class=\"icon-globe\"></i></a><br>";
                            if(o.piso)
                                d+=" Piso:" + o.piso;
                            if(o.dpto)
                                d+=" Dpto:" + o.dpto;
                            if(o.barrio)    
                                d+=" Barrio:" + o.barrio;
                            return d;
                        } 
                        return "Sin dirección";
                    }
                    
                    var trabajarBusy = false;
                    function trabajar(ticket) {
                        if(trabajarBusy)
                            return;
                        trabajarBusy = true;
                        
                        new rem_request(this,function(obj,json){
                            document.location.href = json;
                        },"TICKET::TICKETS","updateTicket",ticket);
                    }
                                        
                </script>    
                ';
                
		$content["home_tickets"] = $html;
		return array( $content, $errors, $includes );
	}		
    }
}

?>	
