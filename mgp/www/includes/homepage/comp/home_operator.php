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

if(!class_exists('home_operator'))
{
    include_once "common/cfield.php";

	class home_operator
	{
		public function Render($context)
		{
			global $sess,$primary_db;
			$nl = "\n";
            
            
//Consulta de turnos                        
         	$tab1 = "<div class=\"bloque\" id=\"turnos\">".$nl;
			
         	            	
            //Botones de turnos
            $boton_general		= $sess->encodeURL(WEB_PATH."/lmodules/sigehos/nuevoturno.php?OP=N");
            $boton_servicio		= $sess->encodeURL(WEB_PATH."/lmodules/sigehos/nuevoturno_servicio.php?OP=N");
            $boton_cops			= $sess->encodeURL(WEB_PATH."/lmodules/sigehos/nuevoturno_cops.php?OP=N");
            $boton_profesional	= $sess->encodeURL(WEB_PATH."/lmodules/sigehos/nuevoturno_profesional.php?OP=N");
            $boton_primero 		= $sess->encodeURL(WEB_PATH."/lmodules/sigehos/nuevoturno_primero.php?OP=N");
            
            $tab1.= "
            <div id=\"botones_turnos\">
            	<button id=\"nuevo_turno\" onclick=\"document.location.href = '{$boton_general}';\">Nuevo Turno</button>
            	<button id=\"nuevo_turno_serv\" onclick=\"document.location.href = '{$boton_servicio}';\">Turno por servicio</button>
            	<button id=\"nuevo_turno_cops\" onclick=\"document.location.href = '{$boton_cops}';\">Turno COPS</button>
            	<button id=\"nuevo_turno_prof\" onclick=\"document.location.href = '{$boton_profesional}';\">Turno por profesional</button>
            	<button id=\"nuevo_turno_primero\" onclick=\"document.location.href = '{$boton_primero}';\">Primer turno disponible</button>	
            </div>";
            
            $tab1.= "
			<div class=\"titulo\">
				<div class=\"titulo_texto\">Turnos</div>
			</div> ".$nl;
         	
            //Resultado de la busqueda
            $tab1.= '<div id="turnos_tbl"></div>';
            $tab1.= '</div>'; // cierro turnos
                     
            
//Consulta de tickets
            $nro = new CField(array("presentation"=>"INT","name"=>"tickets_nro","label"=>"Número","isvisible"=>true,"cols"=>10,"search"=>"fix"));
            $anio = new CField(array("presentation"=>"INT","name"=>"tickets_anio","label"=>"Año","isvisible"=>true,"cols"=>10,"search"=>"fix"));
            
         	$tab2 = "<div class=\"bloque\" id=\"tickets\">".$nl;
         	
         	$tab2.= "
         	<div id=\"botones_turnos\">
		    	<button onclick=\"boton_nuevo_ticket()\">Nuevo Ticket</button>
         	</div>";
         	
			$tab2.= "<div class=\"titulo\"><div class=\"titulo_texto\">Tickets</div></div>".$nl;
                        
         	$tab2.= '<div id="tickets_form_sec">';
            $tab2.= '	<form id="tickets_form" method="post" >';
            $tab2.=$nro->RenderFilterForm($primary_db);
            $tab2.=$anio->RenderFilterForm($primary_db);
            $tab2.= '	</form>';
            
            $tab2.= '	<div class="buscar">';
          	$tab2.= '		<button onclick="boton_buscar_tickets()">Buscar</button>';
            $tab2.= '	</div>'; //Cierro botones
            $tab2.= '</div>'; //Cierro panel buscar
            
            //Resultado de la busqueda
            $tab2.= '<div id="tickets_tbl"></div>';
        
   	        $tab2.= '</div>'; // cierro tickets

            
//LLamadas anteriores
         	$tab3 = "<div class=\"bloque\" id=\"calls\">".$nl;
			$tab3.= "<div class=\"titulo\"><div class=\"titulo_texto\">Contactos</div></div>".$nl;
            
            $fecha = new CField(array("presentation"=>"DATERANGE","name"=>"calls_fecha","label"=>"Fecha","isvisible"=>true));

            $tab3.= '<div id="calls_form_sec">';
            $tab3.= '<form id="calls_form" method="post" >';
            $tab3.=$fecha->RenderFilterForm($primary_db);
            $tab3.= '</form>';
            $tab3.= '<div class="buscar3">';
            $tab3.= '<button onclick="boton_buscar_contactos()">Buscar</button>';
            $tab3.= '</div>'; 
            $tab3.= '</div>'; //cierro calls_form_sec

        //Resultado de la busqueda
	        $tab3.= '<div id="calls_tbl"></div>';
			$tab3.= '</div>'; //cierro calls

//Ciudadanos por ANI
         	$tab4 = "<div class=\"bloque\" id=\"ciudadanos\">".$nl;
			$tab4.= "<div class=\"titulo\"><div class=\"titulo_texto\">Ciudadanos</div></div>".$nl;
     		
            $fecha = new CField(array("presentation"=>"INT","name"=>"ciudadanos_ani","label"=>"Teléfono","isvisible"=>true));

            $tab4.= '<div id="ciudadanos_form_sec">';
            $tab4.= '<form id="ciudadanos_form" method="post" >';
            $tab4.=$fecha->RenderFilterForm($primary_db);
            $tab4.= '</form>';
            $tab4.= '<div class="buscar">';
            $tab4.= '<button onclick="boton_buscar_ani()">Buscar</button>';
            $tab4.= '</div>';
            $tab4.= '</div>';

//Resultado de la busqueda
			$tab4.= '<div id="ciudadanos_tbl"></div>';
			$tab4.= '</div>'; //cierro ciudadanos

			$tab4.= '</div>'; //cierro home_operator
						
//Armo el TAB
			$html = '<div id="home_operator">
            <div id="tabs">
			   <ul>
			      <li><a href="#tabs-1">Turnos</a></li>
			      <li><a href="#tabs-2">Tickets</a></li>
			      <li><a href="#tabs-3">Llamadas</a></li>
			      <li><a href="#tabs-4">Ciudadanos</a></li>
			   </ul>
			   <div id="tabs-1">
			   <div id="offline"><h3>Para comenzar la atención, deberá ingresar el tipo y número de documento y hacer click sobre el botón "Buscar".</h3></div>
			   <p>'.$tab1.'</p>
			   </div>
			   <div id="tabs-2">
			   <p>'.$tab2.'</p>
			   </div>
			   <div id="tabs-3">
			   <p>'.$tab3.'</p>
			   </div>
			   <div id="tabs-4">
			   <p>'.$tab4.'</p>
			   </div>
			</div>
			</div>
			<script type="text/javascript">$("#tabs").tabs();</script>
			';
			$style = '<style>
			#indicadores {width: 200px;border: solid 1px;border-radius: 5px;padding: 10px;text-align: center;float: right;background:#eee;}
			#indicadores div {padding:3px;margin:3px;}
			#talk {height: 190px;}
			#talk_search {width: 500px;float: left;height: 100px;}
			#talk_search button {margin-left:308px;margin-top:10px;}
			#talk_btn_anonimo, #talk_btn_modificar, #talk_btn_terminar {display:none} 
			#botones_turnos {float: right;margin-top: 3px;}
			.buscar {background:none;border:none;text-align:left;}
			table {border-spacing: 0px;}
			th {background:#eee;padding: 5px;}
			td {border-bottom:solid 1px #ddd;padding:3px;min-heigth:38px;}
			table table {width:300px;border:solid 1px #ddd;}
			table table td {border:none;}
			#turnos_tbl tr {height: 38px;}
			</style>
			<script type="text/javascript" src="'.WEB_PATH.'/includes/home_call.js"></script>
			';
			$t = new talk();
			list($cnt,$err) = $t->Render($context);
			$content["home_operator"] = $style.$cnt['talk'].$html;
			return array( $content, array() );
		}
	}
}

?>	
