/* 
 * Funciones usadas en la home page del call center
 */

$(document).ready(function() {
	
    //Solo hago la busqueda si el estado es IDENTIFICADO
    if(document.getElementById("talk_nominal"))
    {
    	armar_home_page();
    	armar_panel();    
    }
    
    //Cambio de pais
    $("#m_person_pais").change(function(){
    	var p = $(this).val();
    	if(p=="Brasil" || p=="Bolivia" || p=="Chile" || p=="Paraguay" || p=="Uruguay" || p=="Perú") {
    		$("#am_person_doc").html('<option value="CI">CI');
    		$("#am_person_doc").val("CI");
    	} else {
    		if(p!="Argentina") {
    			$("#am_person_doc").html('<option value="PAS">PAS');
    			$("#am_person_doc").val("PAS");
    		} else {
    			$("#am_person_doc").html('<option value="DNI">DNI<option value="LE">LE<option value="LC">LC<option value="CIPF">CIPF<option value="PAS">PAS');
    			$("#am_person_doc").val("DNI");
    		}
    	}
    });
});

function armar_home_page() {
	try {
		var person_status = $('#m_person_status').val();
		if(person_status=="IDENTIFICADO")
		{
			esperar();
		    //boton_buscar_turnos();
			//buscar_orientacion();
			
		    //Busco los contactos (sesiones anteriores)
		    boton_buscar_contactos();
		
		    //Cargo los tickets abiertos por el ciudadano
		    buscar_tickets_ciudadano();
		    listo();
		}
	}
	catch(err) {
	    listo();
	    alert_box(err,"ATENCION");
	}
}

function armar_panel() {
	//Indicador ANONIMO
	var person_status = $('#m_person_status').val();
	if(person_status=="ANONIMO")
	{
		$('#identificado').hide();
		$('#talk_btn_anonimo').hide();
		$('#talk_btn_modificar').hide();
		$('#person_status').html("ANONIMO");
		$('#person_status').css("background","#DDD");
		$('#talk_search').show();
		$('#offline').show();
		
		$('#turnos').hide();
		$('#tickets').hide();
		$('#calls').hide();
		$('#ciudadanos').hide();
	}	
	else
	{
		$('#turnos').show();
		$('#tickets').show();
		$('#calls').show();
		$('#ciudadanos').show();

		$('#person_status').html("IDENTIFICADO");
		$('#person_status').css("background","#AFA");
		$('#identificado').show();
		$('#talk_btn_anonimo').show();
		$('#talk_btn_modificar').show();
		$('#talk_search').hide();
		$('#offline').hide();
			
		var ciu_apellido = $("#m_person_apellido").val();
    	var ciu_nombres = $("#m_person_nombres").val();
    	var tipo_doc = $("#am_person_doc").val();
    	var nro_doc = $("#bm_person_doc").val();
    	//var cops_id = $("#m_cops_id").val();
    	var sexo = $("#m_sexo").val();
    	var edad = $("#m_edad").val();
    	var pais = $("#m_person_pais").val();
    	var id = $("#m_person_id").val();
    	
    	//Armo el texto de descripcion Nombre, Apellido y debajo Tipo y nro de doc
    	var b="<h3>"+ciu_nombres+", "+ciu_apellido+"</h3>"+tipo_doc+" "+nro_doc+" ("+pais+")";
		b+="<br/><br/>ID: <b>"+id+"</b>";
    	
    	//Es afiliado a COPS?
/*    	if(cops_id!=0)
    	{
    		b+="<br/><br/>Afiliado COPS: <b>"+cops_id+"</b>";
    	}
    	else
    	{
    		$('#nuevo_turno_cops').hide();
    	}*/
    	b+="<br/>Sexo: <b>"+sexo+"</b><br/>Edad: <b>"+edad+" años</b>";
    	
    	$("#talk_nominal").html(b);
	}
	
	//Indicador EN ESPERA - CONECTADO
	var talk_status = $('#m_talk_status').val();
	if(talk_status=="EN ESPERA")
	{
		$('#talk_btn_terminar').hide();
		$('#talk_status').html("EN ESPERA");
		$('#talk_status').css("background","#DDD");
	}
	else
	{
		$('#talk_btn_terminar').show();
		$('#talk_status').html("CONECTADO");
		$('#talk_status').css("background","#AFA");
	}
}
//IDENTIFICACION DEL CIUDADANO

//Buscar entre los ciudadanos registrados previamente
//por documento o por nombre y apellido
//Si mas de uno, se debe elegir cual de todos es o bien ingresar uno nuevo
var g_goto = "";
function boton_buscar()
{
    var doc_tipo = $('#am_person_doc').val();
    var doc_nro = $('#bm_person_doc').val();
    var nombres = $('#m_person_nombres').val();
    var apellido = $('#m_person_apellido').val();
    var ani = $('#m_talk_ani').val();
    var session = $('#m_user_session').val();
    var pais = $('#m_person_pais :selected').val();
    	
	if(doc_nro=="")
	{
		alert_box('Debe ingresar primero un número de documento','ATENCION');
		return false;
	}
		
	//Fix NEGRO NEGRO para el SIGEHOS
	if(pais=="Bolivia" || pais=="Perú" || pais=="Uruguay" || pais=="Brasil" || pais=="Paraguay" || pais=="Chile")
	{
		doc_tipo = "CI";
		$('#am_person_doc').val("CI");
	}
	if( pais!="Argentina" && pais!="Bolivia" && pais!="Perú" && pais!="Uruguay" && pais!="Brasil" && pais!="Paraguay" && pais!="Chile")
	{
		doc_tipo = "PAS";
		$('#am_person_doc').val("PAS");		
	}	
	
	//Pongo en espera...
	esperar("Buscando datos del ciudadano...");
	
	//Identificador compuesto del DOC
	var doc = doc_tipo + " " + doc_nro;
    var params = doc + '|' + nombres + '|' + apellido + '|' + ani + '|' + session + '|' + pais;
    new rem_request(this,function(obj,json){
    	listo();
    	var jdata = eval('(' + json + ')');
    	if(!jdata)
        {
            alert_box("Buscar no retorna resultados","ERROR");
        }
        else
        {
            //si el array esta vacio... No hay coincidencias
            if( jdata.url != "")
            {
            	g_goto = jdata.url;
                confirm_box('Es la primera vez que se ingresa este documento. Se pasará a la pantalla de carga de datos personales.', "ATENCION",showCiudadano);
            }
            else
            {
            	//Se identifico a la persona?
            	$("#m_person_id").val(jdata.ciudadanos[0].ciu_code);
            	$("#m_person_status").val("IDENTIFICADO");
            	$("#m_person_apellido").val(jdata.ciudadanos[0].ciu_apellido);
            	$("#m_person_nombres").val(jdata.ciudadanos[0].ciu_nombres);
            	
            	$("#m_cops_id").val(jdata.ciudadanos[0].cops_id);
            	$("#m_sexo").val(jdata.ciudadanos[0].sexo);
            	$("#m_edad").val(jdata.ciudadanos[0].edad);
            	$("#m_person_pais").val(jdata.ciudadanos[0].pais);
                
            	armar_home_page();
            	armar_panel();
            }
        }	
    },"HOME","doBuscar",params);
}


//Muestra la pagina de carga de datos para un nuevo ciudadano
function showCiudadano()
{
    document.location.href = g_goto;	
}

//Iniciar la sesion con el ciudadano identificado
function boton_iniciar()
{
    var session = $('#m_user_session').val();
    var ani = $('#m_talk_ani').val();
    var params = ani + '|' + session + "| ";
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("Iniciar no retorna resultados", "ERROR");
        }
        else
        {
            //Los retornos posibles son:
            //Sesion abierta -> ya esta abierta la sesion para este ANI
            //Sesion cerrada -> mostrar la pagina de cierre de sesion
            //Array() -> Lista de ciudadanos que son candidatos por haber usado el ANI anteriormente
        	var jdata = eval('(' + json + ')');
        	
        	if(jdata=="Sesion abierta")
            {
                return;
            }
            if(jdata=="Sesion arrastrada")
            {
                return;
            }
            if(jdata=="Sesion cerrada")
            {
                document.location = sess_web_path+'/lmodules/ciudadanos/sesion_cierre.php';
                return;
            }  
            document.location = sess_web_path+'/index.php';
        }	
    },"HOME","doIniciar",params);
}

//Cerrar la sesion actual
function boton_terminar()
{
    var session = $('#m_user_session').val();
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("Terminar no retorna resultados", "ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
        	document.location = jdata.url;
        }	
    },"HOME","doTerminar",session);
}

//Iniciar una sesion anonima
function boton_anonimo()
{
    var session = document.getElementById('m_user_session');
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("doAnonimo no retorna resultados", "ERROR");
        }
        else
        {
        	//vuelvo a la home page        
        	document.location = sess_web_path+"/index.php";
        }	
    },"HOME","doAnonimo",session.value);
}

//Modificar o completar los datos del ciudadano identificado
function boton_modificar()
{
    var session = $('#m_user_session').val();
    var doc = $('#m_person_id').val();
    var pars = session + "|" + doc;
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("doModificar no retorna resultados", "ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
            document.location.href = jdata.url;
        }	
    },"HOME","doModificar",pars);
}

function boton_buscar_ani()
{
    var ani = $('#m_ciudadanos_ani').val();
    buscar_ani(ani,"0","",""); //No cambia el estado de la conexion, otro valor si lo hace
}

//Buscar ciudadanos que hayan usado un ANI
//Llamado por boton_buscar_ani() y por miraClipboard()
function buscar_ani(ani,entry_point,call_id,skill)
{
    var session = $('#m_user_session').val();
    var params =  ani + '|' + entry_point + '|' + session + '|' + call_id + '|' + skill;
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("BuscarContactos no retorna resultados", "ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
        	
            //Inicio de sesion automatico por CTI
            if(entry_point!="0")
            {
                if(jdata.length)
                {
                    if(jdata.length>1) //Hay mas de un ciudadano con este ANI
                    {
                        var con = document.getElementById('talk_status');
                        if(con)
                        {
                            con.id = "talk_status_on";
                            con.innerHTML = "CONECTADO";
                        }
                        completar_tabla_ani(jdata); //El operador debe elegir
                        return;
                    }
                }
                document.location = sess_web_path+'/index.php';
                return;
            }

            //Boton de buscar ANI
            if(jdata.length>0) //Hay mas de un ciudadano con este ANI
            {
            	completar_tabla_ani(jdata);
            }
            else
            {
            	var div = document.getElementById("ciudadanos_tbl");
            	div.innerHTML = "";
            	alert_box("No se ha encontrado ningún registro","Búsqueda por nro. teléfonico");
            }
        }
    	
    },"HOME","doBuscarAni",params);
}

//BUSCAR CONTACTOS
//Buscar otros contactos(sesiones) de este ciudadano
function boton_buscar_contactos()
{
    var	id = $('#m_person_id').val();
    if(!document.getElementById("calls_tbl") || id==0 || id=="")
    {
        completar_tabla_contactos(null);
        return; //No hay tabla de resultado
    }

    var fecha_desde = $('#m_calls_fecha').val();
    var fecha_hasta = $('#hm_calls_fecha').val();
    var session = $('#m_user_session').val();
    
    var params =  id + '|' + fecha_desde + '|' + fecha_hasta + '|' + session;
    new rem_request(this,function(obj,json) {
    	if(json=="")
        {
            alert_box("BuscarContactos no retorna resultados", "ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
            completar_tabla_contactos(jdata);
        }
    },"HOME","doBuscarContactos",params);
}

//BUSCAR TICKETS
//Buscar cualquier ticket.
function boton_buscar_tickets()
{
    var nro = document.getElementById('m_tickets_nro');
    var anio = document.getElementById('m_tickets_anio');
    
    var params =  nro.value + '|' + anio.value;
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("BuscarTickets no retorna resultados", "ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
        	completar_tabla_tickets(jdata);
        }	
    },"HOME","doBuscarTickets",params);
}

//BUSCAR TURNOS
function boton_buscar_turnos()
{
  var id = $('#m_person_id').val();
  if(!document.getElementById("turnos_tbl") || id==0 || id=="")
  {
	  completar_tabla_turnos(null);
      return; //No hay tabla de resultado
  }

  var session = $('#m_user_session').val();  
  new rem_request(this,function(obj,json)
  {
	  if(json=="")
	  {
	      alert_box("BuscarTurnos no retorna resultados","ERROR");
	  }
	  else
	  {
		  var jdata = eval('(' + json + ')');
	      completar_tabla_turnos(jdata);
	  }  
  },"HOME","doBuscarTurnos",id + '|' + session);
}


//Buscar tickets del ciudadano.
function buscar_tickets_ciudadano()
{
	var id = $('#m_person_id').val();
    if(id==0 || id=="")
    {
    	completar_tabla_tickets(null);
    	return;
    }
    new rem_request(this, function(obj,json){
    	if(json=="")
        {
            alert_box("BuscarTickets no retorna resultados","ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
        	completar_tabla_tickets(jdata);
        }
    },"HOME","doBuscarTickets",id);
}

//NUEVO TICKET
function boton_nuevo_ticket()
{
	var session = $('#m_user_session').val();
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("doNuevoTicket no retorna resultados","ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
            document.location.href = jdata.url;
        }	
    },"HOME","doNuevoTicket",session);
}





//UTILIDADES
//Completar una tabla, dado un array 2D. En el parametro tabla
//se espera recibir un nodo <TBODY>
function completar_tabla_tickets(datos)
{
	var j=0;
	var b = "<table><thead><tr><th>Tipo</th><th>Estado</th><th>Nro</th><th>Año</th><th>Prestación</th><th>Ubicación</th><th>Acción</th></tr></thead>";
	b+="<tbody>";
	var s="cajadato_par";
	if(datos) 
	{
		for(j=0;j<datos.length;j++)
		{
			if(s=="cajadato_par")
			{
				s="cajadato_impar";
			}	
			else
			{
				s="cajadato_par";
			}
			b+="<tr class=\""+s+"\"><td>"+datos[j].tipo+"</td>";
			b+="<td>"+datos[j].estado+"</td>";
			b+="<td>"+datos[j].numero+"</td>";
			b+="<td>"+datos[j].anio+"</td>";
			b+="<td>"+datos[j].prestacion+"</td>";
			b+="<td>"+datos[j].ubicacion_text+"</td>";
			
			
			b+="<td>";
			if(datos[j].ver_ticket!="")
			{
				b+="<button onclick=\"clickTicket1('"+datos[j].url_ver+"')\">Ver</button>";
			}
			if(datos[j].ver_reclamo!="")
			{
				b+="<button onclick=\"clickTicket2('"+datos[j].url_ver+"')\">Ver</button>";
			}
			if(datos[j].reiterar!="")
			{
				b+="<button onclick=\"clickTicket3('"+datos[j].url_reiterar+"')\">Reiterar</button>";
			}		
			b+="</td></tr>";
		}
	}
	if(j==0)
	{
		b+='<tr><td colspan="7">Sin datos</td></tr>';
	}
	b+="</tbody></table>";
	
	$("#tickets_tbl").html(b);		
	$("#tickets_tbl table").kendoGrid({
        height: 250
    });
}


function clickTicket1(url)
{
    document.location = url;
}	
    
function clickTicket2(url)
{
	document.location = url;
}
    
function clickTicket3(url)
{
	document.location = url;
}

function cancelaTurno(ix)
{
	document.location = ix;
}


//Traer detalle del contacto mostrado (o sea la actividad realizada durante una sesion X)
function getContacto(ix)
{
	document.location = ix;
}

//Traer detalle del ciudadano, como para editar el perfil
function getCiudadano(ix)
{    
	document.location = ix;
}


//Cuando hay ambiguedad, se debe elegir el ciudadano correcto y luego se llama a esta funcion
//Que define al usuario conectado
function setSession(ciu_code)
{
    var session = document.getElementById('m_user_session');
    var params =  ciu_code + '|' + session.value;
    var json = rem_sync_request("HOME","doSetSession",params);
    var jdata = eval('(' + json + ')');
    if(!jdata)
    {
        alert_box("setSession no retorna resultados", "ERROR");
    }
    else
    {
        document.location = sess_web_path+"/index.php";
    }
}

function completar_tabla_contactos(datos)
{
	var j=0;
	var b = "<table><thead><tr><th>Fecha</th><th>Sesión</th><th>Operador</th><th>Teléfono</th><th>Nota</th><th>Acciones</th></tr></thead>";
	b+="<tbody>";
	var s="cajadato_par";
	if(datos)
	{
		for(j=0;j<datos.length;j++)
		{
			if(s=="cajadato_par")
			{
				s="cajadato_impar";
			}	
			else
			{
				s="cajadato_par";
			}
	
			b+="<tr class=\""+s+"\"><td>"+datos[j].cse_tstamp+"</td>";
			b+="<td>"+datos[j].cse_duracion+"</td>";
			b+="<td>"+datos[j].use_code+"</td>";
			b+="<td>"+datos[j].cse_ani+"</td>";
			b+="<td>"+datos[j].cse_nota+"</td>";
			
			if(datos[j].acciones=="Detalle")
			{
				b+="<td><button onclick=\"getContacto('"+datos[j].detalle+"')\">Ver Contacto</button></td></tr>";
			}
			else
			{	
				b+="<td></td></tr>";
			}
		}
	}
	if(j==0)
	{
		b+='<tr><td colspan="6">Sin datos</td></tr>';
	}
	b+="</tbody></table>";
	
	$("#calls_tbl").html(b);
	$("#calls_tbl table").kendoGrid({
        height: 250
    });
}

function completar_tabla_turnos(datos)
{	
	var j=0;
	var b = "<table><thead><tr><th>Hospital</th><th>Servicio</th><th>Fecha</th><th>Estado</th><th>Acción</th></tr></thead>";
	b+="<tbody>";
	var s="cajadato_par";
	if(datos) 
	{
		for(j=0;j<datos.length;j++)
		{
			if(s=="cajadato_par")
			{
				s="cajadato_impar";
			}	
			else
			{
				s="cajadato_par";
			}
			b+="<tr class=\""+s+"\"><td>"+datos[j].hospital+"</td>";
			b+="<td>"+datos[j].servicio+"</td>";
			b+="<td>"+datos[j].fecha+"</td>";
			b+="<td>"+datos[j].estado+"</td>";
			
			if(datos[j].acciones=="Cancelar")
			{
				b+="<td><button onclick=\"cancelaTurno('"+datos[j].cancelar+"')\">Cancelar</button></td></tr>";
			}
			else
			{	
				b+="<td></td></tr>";
			}
		}
	}
	if(j==0)
	{
		b+='<tr><td colspan="5">Sin datos</td></tr>';
	}
	b+="</tbody></table>";
	
	$("#turnos_tbl").html(b);	
	$("#turnos_tbl table").kendoGrid({
        height: 250
    });
}


function completar_tabla_ani(datos)
{
	var j=0;
	var b = "<table><thead><tr><th>Apellido</th><th>Nombre</th><th>Documento</th><th>Acción</th></tr></thead>";
	b+="<tbody>";
	var s="cajadato_par";
	if(datos)
	{
		for(j=0;j<datos.length;j++)
		{
			if(s=="cajadato_par")
			{
				s="cajadato_impar";
			}	
			else
			{
				s="cajadato_par";
			}
	
			b+="<tr class=\""+s+"\"><td>"+datos[j].ciu_apellido+"</td>";
			b+="<td>"+datos[j].ciu_nombres+"</td>";
			b+="<td>"+datos[j].ciu_doc_nro+"</td>";
			
			b+="<td>";
			
			if(datos[j].btn_detalle!="")
			{
				b+="<button onclick=\"tabla_ani_click1('"+datos[j].detalle+"')\">Detalles</button>";
			}
	
			if(datos[j].btn_sesion!="")
			{
				b+="<button onclick=\"tabla_ani_click2('"+datos[j].sesion+"')\">Sesión</button>";
			}
	
			b+="</td></tr>";
		}
	}
	if(j==0)
	{
		b+='<tr><td colspan="4">Sin datos</td></tr>';
	}
	b+="</tbody></table>";
	
	$("#ciudadanos_tbl").html(b);	
	$("#ciudadanos_tbl table").kendoGrid({
        height: 250
    });
}

//ix = ciudadano
function tabla_ani_click1(ix)
{
    getCiudadano(ix);
}

//id = session
function tabla_ani_click2(id)
{
   setSession(id);
}


//NUEVA ORIENTACION
function boton_nueva_orientacion()
{
	var session = $('#m_user_session').val();
    new rem_request(this,function(obj,json){
    	if(json=="")
        {
            alert_box("doNuevaOrientacion no retorna resultados","ERROR");
        }
        else
        {
        	var jdata = eval('(' + json + ')');
            document.location.href = jdata.url;
        }	
    },"HOME","doNuevaOrientacion",session);
}

//BUSCAR ORIENTACION
function buscar_orientacion()
{
  var id = $('#m_person_id').val(); 
  if( $("#orientacion_tbl").length==0 || id==0 || id=="")
  {
      return; //No hay tabla de resultado
  }

  var session = $('#m_user_session').val();  
  new rem_request(this, function(obj,json){
	  if(json=="")
	  {
	      alert_box("doBuscarOrientacion no retorna resultados","ERROR");
	  }
	  else
	  {
		  var jdata = eval('(' + json + ')');
	      completar_tabla_orientacion(jdata);
	  }
  },"HOME","doBuscarOrientacion",id + '|' + session);
}

//TABLA ORIENTACION
function completar_tabla_orientacion(datos)
{
	var j=0;
	var b = "<table><thead><tr><th>Fecha</th><th>Motivo</th><th>Nota</th></tr></thead>";
	b+="<tbody>";
	var s="cajadato_par";
	if(datos)
	{	
		for(j=0;j<datos.length;j++)
		{
			if(s=="cajadato_par")
			{
				s="cajadato_impar";
			}	
			else
			{
				s="cajadato_par";
			}
			b+="<tr class=\""+s+"\"><td>"+datos[j].cor_tstamp+"</td>";
			b+="<td>"+datos[j].cor_motivo+"</td>";
			b+="<td>"+datos[j].cor_nota+"</td>";
		}
	}
	if(j==0)
	{
		b+='<tr><td colspan="3">Sin datos</td></tr>';
	}
	b+="</tbody></table>";
	
	$("#orientacion_tbl").html(b);	
	$("#orientacion_tbl table").kendoGrid({
        height: 250
    });
}