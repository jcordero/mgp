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

if(!class_exists('home_operator'))
{
	class home_operator
	{
            public function Render($context)
            {
                $content = array(); 
                $errors = array(); 
                                 
         	$tab2 = '
         	<div id="offline" class="alert">
	  				<button type="button" class="close" data-dismiss="alert">&times;</button>
	  				<strong>Atención!</strong>
	  				Debe identificar al ciudadano al iniciar la atención 
			</div>
	
         	<div id="tickets" class="container">
         		<div class="row">         	
    	     		<div id="botones_turnos" class="span2">
			    		<button onclick="boton_nuevo_ticket()" class="btn btn-primary"><i class="icon-pencil"></i> Nuevo Ticket</button>
         			</div>
         		</div>
            	
            	<div class="row">
            		<div id="tickets_tbl" class="span12"></div>
            	</div>
         		
         		<div class="row">
            		<div class="span6">            		
	            		<form class="form-inline">
			          		<select class="input-medium" id="m_tickets_tipo">
			          			<option value="RECLAMO">RECLAMO
			          			<option value="SOLICITUD">SOLICITUD
			          			<option value="DENUNCIA">DENUNCIA
			          			<option value="QUEJA">QUEJA
			          		</select>			          			
			          		<input type="text" class="input-small" placeholder="Número" id="m_tickets_nro">
  							<input type="text" class="input-small" placeholder="Año" id="m_tickets_anio">
			          		<button onclick="boton_buscar_tickets()" class="btn"><i class="icon-search"></i> Buscar</button>
	            		</form>
            		</div>
            	</div>
            	
        	</div>'; // cierro tickets

            
//LLamadas anteriores
         	$tab3 = '
         	<div id="calls" class="container">	
	          	<div class="row">
	          		<div id="calls_tbl" class="span12"></div>
	          	</div>
	          	
	          	<div class="row">         	    
                    <div class="span6">
            			<form class="form-inline" >
            				<input type="text" class="input-small" placeholder="Desde" id="m_calls_fecha_desde">
  							<input type="text" class="input-small" placeholder="Hasta" id="m_calls_fecha_hasta">
				          	<button onclick="boton_buscar_contactos()" class="btn"><i class="icon-search"></i> Buscar</button>
            			</form>
              		</div>
              	</div>
              	
			</div>'; //cierro calls

			
			
//Ciudadanos por ANI
         	$tab4 = '
         	<div id="ciudadanos" class="container">
				<div class="row">
					<div id="ciudadanos_tbl" class="span12"></div>
				</div>
				
				<div class="row">
	            	<div class="span6">
	            		<form class="form-inline">
		            		<input type="text" class="input-small" placeholder="Teléfono" id="m_ciudadanos_ani">
	                		<button onclick="boton_buscar_ani()" class="btn"><i class="icon-search"></i> Buscar</button>
	            		</form>
	            	</div>
	            </div>
	            
			</div>'; //cierro ciudadanos

						
//Armo el TAB
			$html = '
		
			<ul class="nav nav-tabs" data-tabs="tabs">
    			<li class="active"><a href="#tab1" data-toggle="tab">Tickets</a></li>
    			<li>			   <a href="#tab2" data-toggle="tab">Contactos anteriores</a></li>
    			<li>			   <a href="#tab3" data-toggle="tab">Ciudadanos con este nro.</a></li>
  			</ul>
		
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">'.$tab2.'</div>

    			<div class="tab-pane" id="tab2">'.$tab3.'</div>

    			<div class="tab-pane" id="tab3">'.$tab4.'</div>	
			</div>	
	
		';
			
			//Bloque TALK
			$t = new talk();
			list($cnt,$err,$includes) = $t->Render($context);
                        
			$content["home_operator"] = $cnt['talk'].$html;
			return array( $content, $errors, $includes );
		}
	}
}

?>	
