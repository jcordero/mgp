<?php

/* Pantalla inicial para el operador del call
 *
 * CASO ESPERA:
 *  Mensaje de espera
 *
 * CASO CONECTADO ANONIMO:
 *  Script de atencion, pedido de identificacion
 *  Acciones: Consulta de tickets, Consultas varias
 *
 * CASO CONECTADO IDENTIFICADO:
 *  Script de atencion
 *  Ultimos 10 tickets
 *  Ultimas 10 llamadas
 *
 */
include_once 'homepage/comp/talk.php';
include_once "common/cfield.php";

class home_operator {

    public function Render(ccontext $context) {
        $buscar_ticket = '  
            <div class="col-xs-6">
                <button onclick="boton_nuevo_ticket()" class="btn btn-primary"><i class="icon-pencil"></i> Nuevo Ticket</button>           
            </div>
            <div class="col-xs-6 ">
                <div class="form-inline pull-right">
                    <select class="input-sm" id="m_tickets_tipo">
                                <option value="RECLAMO">RECLAMO
                                <option value="SOLICITUD">SOLICITUD
                                <option value="DENUNCIA">DENUNCIA
                                <option value="QUEJA">QUEJA
                    </select>			          			
                    <input type="text" class="input-sm" placeholder="Número" id="m_tickets_nro">
                    <input type="text" class="input-sm" placeholder="Año" id="m_tickets_anio">
                    <button onclick="boton_buscar_tickets()" class="btn btn-sm"><i class="icon-search"></i> Buscar</button>
                </div>
            </div>
        ';
        
        $tab2 = '
         	
         	<div id="tickets">
                    <div class="row">         	
    	     		<div id="botones_turnos" class="col-xs-12">
                            '.$buscar_ticket.'
                        </div>
                    </div>
            	
                    <div class="row">
            		<div id="tickets_tbl" class="col-xs-12"></div>
                    </div>
         		
                    <div class="row">
            		<div class="col-xs-6">            		
                            
            		</div>
                    </div>
            	</div>'; // cierro tickets
                
//LLamadas anteriores
        $tab3 = '
         	<div id="calls">	
                    <div class="row">
                        <div id="calls_tbl" class="col-xs-12"></div>
                    </div>
	          	
                    <div class="row">         	    
                        <div class="col-xs-6">
                            <form class="form-inline" >
                                <input type="text" class="input-sm" placeholder="Desde" id="m_calls_fecha_desde">
                                <input type="text" class="input-sm" placeholder="Hasta" id="m_calls_fecha_hasta">
                                <button onclick="boton_buscar_contactos()" class="btn btn-sm"><i class="icon-search"></i> Buscar</button>
                            </form>
              		</div>
                    </div>
                </div>'; //cierro calls

//Ciudadanos por ANI
        $tab4 = '
         	<div id="ciudadanos">
                    <div class="row">
                        <div id="ciudadanos_tbl" class="col-xs-12"></div>
                    </div>
				
                    <div class="row">
	            	<div class="col-xs-6">
                            <form class="form-inline">
                                <input type="text" class="input-sm" placeholder="Teléfono" id="m_ciudadanos_ani">
                                <button onclick="boton_buscar_ani()" class="btn btn-sm"><i class="icon-search"></i> Buscar</button>
                            </form>
	            	</div>
	            </div>
                </div>'; //cierro ciudadanos
//Armo el TAB
        $html = '
                        <div id="offline" class="alert alert-info">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                            <strong>Atención!</strong>
                            Debe identificar al ciudadano al iniciar la atención 
                        </div>
                        
			<ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Tickets</a></li>
                            <li><a href="#tab2" data-toggle="tab">Contactos</a></li>
                            <li><a href="#tab3" data-toggle="tab">Ciudadanos con este teléfono.</a></li>
  			</ul>
		
			<div class="tab-content">
                            <div class="tab-pane active" id="tab1">' . $tab2 . '</div>
                            <div class="tab-pane" id="tab2">' . $tab3 . '</div>
                            <div class="tab-pane" id="tab3">' . $tab4 . '</div>	
			</div>	
	
		';

        $style = '
<style>
    .tab-pane, .tab-content {background:#fff;}
    #tickets table {margin-top:10px;}
    #tickets table button {margin-bottom:5px;width:100%;}
    .po_map {width:250px;height:250px;}
</style>
            ';
        
        //Bloque TALK
        $t = new talk();
        $t->Render($context);
               
        $context->add_content($context->m_key, $style.$html, true);
        
        return;
    }

}
