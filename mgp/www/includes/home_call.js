/* 
 * Funciones usadas en la home page del call center
 */
var g_goto = "";

$(document).ready(function() {
	
    //Solo hago la busqueda si el estado es IDENTIFICADO
    if(document.getElementById("talk_nominal"))
    {
    	armar_home_page();
    	armar_panel();    
    }    
    
    kendo.culture("es-AR");
    $("#m_calls_fecha_desde").kendoDatePicker();
    $("#m_calls_fecha_hasta").kendoDatePicker();
});

/** Armar la home. Muestra los tickets del fulano y los contactos anteriores
 * 
 * @returns {void}
 */
function armar_home_page() {
    try {
        if(person.person_status==="IDENTIFICADO")
        {
            //Cargo los tickets abiertos por el ciudadano
            buscar_tickets_ciudadano();

            //Busco los contactos (sesiones anteriores)
            boton_buscar_contactos();
        }
    }
    catch(err) {
        alert_box(err,"ATENCION");
    }
}

/** Armar el panel con los datos del ciudadano
 * 
 * @returns {void}
 */
function armar_panel() {
    //Indicador ANONIMO
    if(person.person_status==="ANONIMO")
    {
        $('#identificado').hide();
        $('#talk_btn_anonimo').hide();
        $('#talk_btn_modificar').hide();
        $('#turnos').hide();
        $('#tickets').hide();
        $('#calls').hide();
        $('#ciudadanos').hide();
        $('#person_status').html("ANONIMO");
        $('#person_status').removeClass("btn-success");
        $('#talk_search').show();
        $('#offline').show();		
    }	
    else
    {
        $('#talk_search').hide();
        $('#offline').hide();
        $('#turnos').show();
        $('#tickets').show();
        $('#calls').show();
        $('#ciudadanos').show();

        $('#person_status').html("IDENTIFICADO");
        $('#person_status').addClass("btn-success");
        $('#identificado').show();
        $('#talk_btn_anonimo').show();
        $('#talk_btn_modificar').show();

        //Armo el texto de descripcion Nombre, Apellido y debajo Tipo y nro de doc
        var d = (person.person_doc!=='' ? person.person_doc.split(' ') : ['ARG','DNI','']);
        var b="<h4>"+person.person_nombres+", "+person.person_apellido+"</h4>"+d[1]+" "+d[2]+" ("+d[0]+")";
        b+="<br/>Sexo: <b>"+person.person_sexo+"</b><br/>";
        if(person.person_edad>0 && person.person_edad<200)
            b+="Edad: <b>"+person.person_edad+" años</b>";
        $("#talk_nominal").html(b);
    }

    //Indicador EN ESPERA - CONECTADO
    if(talk.talk_status==="EN ESPERA")
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


/** IDENTIFICACION DEL CIUDADANO 
 * - Buscar entre los ciudadanos registrados previamente por documento o por nombre y apellido. 
 * Si mas de uno, se debe elegir cual de todos es o bien ingresar uno nuevo
 * 
 * @returns {Boolean}
 */
function boton_buscar()
{
    var pais = $('#pm_person_doc :selected').val();
    var doc_tipo = $('#tm_person_doc').val();
    var doc_nro = $('#nm_person_doc').val();
    var nombres = '';
    var apellido = '';
    
    if(doc_nro==="")
    {
        alert_box('Debe ingresar primero un número de documento','ATENCION');
        return false;
    }

    //Pongo en espera...
    esperar("Buscando datos del ciudadano...");
	
    //Identificador compuesto del DOC
    var doc = pais + " " + doc_tipo + " " + doc_nro;
    person.person_doc = doc;
	
    new rem_request(this,function(obj,json){
    	var jdata = JSON.parse(json);
    	if(!jdata)
        {
            listo();
            alert_box("Buscar no retorna resultados","ERROR");
        }
        else
        {
            //si el array esta vacio... No hay coincidencias
            if(jdata.url!=='')
            {
                listo();
                confirm_box('Es la primera vez que se ingresa este documento. Se pasará a la pantalla de carga de datos personales.', "ATENCION",function(){
                    irA(jdata.url);
                });
            }
            else
            {
            	//Se identifico a la persona?
            	var p = jdata.ciudadanos[0];
            	person.person_status 	= 'IDENTIFICADO';
            	person.person_doc 	= doc;
            	person.person_nombres 	= p.ciu_nombres;
            	person.person_apellido 	= p.ciu_apellido;
            	person.person_id 	= p.ciu_code;
            	person.person_cops_id 	= p.cops_id;
            	person.person_sexo 	= p.sexo;
            	person.person_edad 	= p.edad;
            	person.person_pais 	= p.pais;
            	            	                
            	armar_panel();
            	armar_home_page();
                listo();
            }
        }	
    },"HOME","doBuscar",doc + '|' + nombres + '|' + apellido + '|' + talk.talk_ani + '|' + pais);
}

/** Iniciar la sesion con el ciudadano identificado
 * 
 * @returns {void}
 */
function boton_iniciar()
{
    var ani = $('#m_talk_ani').val();
    //$ani | $call_id | $entry_point | $skill 
    var params = ani + "|||";
    new rem_request(this,function(obj,json){
    	if(json==='')
        {
            alert_box("Iniciar no retorna resultados", "ERROR");
        }
        else
        {
            //Los retornos posibles son:
            //Sesion abierta -> ya esta abierta la sesion para este ANI
            //Sesion cerrada -> mostrar la pagina de cierre de sesion
            //Array() -> Lista de ciudadanos que son candidatos por haber usado el ANI anteriormente
            var jdata = JSON.parse(json);
        	
            if(jdata==="Sesion abierta" || jdata==="Sesion arrastrada")
                return;
            
            if(jdata==="Sesion cerrada")
            {
                document.location = sess_web_path+'/lmodules/ciudadanos/sesion_cierre.php';
                return;
            }  
            
            //Recargo la home
            document.location = sess_web_path+'/index.php';
        }	
    },"HOME","doIniciar",params);
}

/** Cerrar la sesion actual
 * 
 * @returns {undefined}
 */
function boton_terminar()
{
    new rem_request(this,function(obj,json){
    	if(json==='')
        {
            alert_box("Terminar no retorna resultados", "ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            document.location = jdata.url;
        }	
    },"HOME","doTerminar",'');
}

/** Iniciar una sesion anonima
 * 
 * @returns {void}
 */
function boton_anonimo()
{
    new rem_request(this,function(obj,json){
    	if(json==='')
        {
            alert_box("doAnonimo no retorna resultados", "ERROR");
        }
        else
        {
            //vuelvo a la home page        
            document.location = sess_web_path+"/index.php";
        }	
    },"HOME","doAnonimo",'');
}

/** Modificar o completar los datos del ciudadano identificado
 * 
 * @returns {void}
 */
function boton_modificar()
{
    new rem_request(this,function(obj,json){
    	if(json==="")
        {
            alert_box("doModificar no retorna resultados", "ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            document.location.href = jdata.url;
        }	
    },"HOME","doModificar",'');
}

/** Buscar el ANI de la llamada en la base
 * 
 * @returns {void}
 */
function boton_buscar_ani()
{
    var ani = $('#m_ciudadanos_ani').val();
    buscar_ani(ani,"0","",""); //No cambia el estado de la conexion, otro valor si lo hace
}

/** Buscar ciudadanos que hayan usado un ANI - Llamado por boton_buscar_ani() y por miraClipboard()
 * 
 * @param {string} ani
 * @param {string} entry_point
 * @param {string} call_id
 * @param {string} skill
 * @returns {void}
 */
function buscar_ani(ani,entry_point,call_id,skill)
{
    var params =  ani + '|' + entry_point + '|' + call_id + '|' + skill;
    new rem_request(this,function(obj,json){
    	if(json==='')
        {
            alert_box("BuscarContactos no retorna resultados", "ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
        	
            //Inicio de sesion automatico por CTI
            if(entry_point!=="0")
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

/** BUSCAR CONTACTOS - Buscar otros contactos(sesiones) de este ciudadano
 * 
 * @returns {void}
 */
function boton_buscar_contactos()
{
    var fecha_desde = $('#m_calls_fecha_desde').val();
    var fecha_hasta = $('#m_calls_fecha_hasta').val();
    
    var params =  fecha_desde + '|' + fecha_hasta;
    new rem_request(this,function(obj,json) {
    	if(json==='')
        {
            alert_box("BuscarContactos no retorna resultados", "ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            completar_tabla_contactos(jdata);
        }
    },"HOME","doBuscarContactos",params);
}

/** BUSCAR TICKETS - Buscar cualquier ticket
 * 
 * @returns {void}
 */
function boton_buscar_tickets()
{
    var tipo = $('#m_tickets_tipo').val();
    var nro = $('#m_tickets_nro').val();
    var anio = $('#m_tickets_anio').val();
    
    var params =  tipo + '|' + nro + '|' + anio;
    new rem_request(this,function(obj,json){
    	if(json==='')
        {
            alert_box("BuscarTickets no retorna resultados", "ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            if( jdata && jdata.length>0 )
                completar_tabla_tickets(jdata);
            else
                alert_box("El ticket solicitado no se encuentra.","Buscar");
        }	
    },"HOME","doBuscarTickets",params);
}

/** Buscar tickets del ciudadano
 * 
 * @returns {void}
 */
function buscar_tickets_ciudadano()
{
    var id = $('#m_person_id').val();
    if(id===0 || id==="")
    {
    	completar_tabla_tickets(null);
    	return;
    }
    new rem_request(this, function(obj,json){
    	if(json==='')
        {
            alert_box("BuscarTickets no retorna resultados","ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            completar_tabla_tickets(jdata);
        }
    },"HOME","doBuscarTickets",id);
}

/** NUEVO TICKET
 * 
 * @returns {void}
 */
function boton_nuevo_ticket()
{
    new rem_request(this,function(obj,json){
        if(json=="")
        {
            alert_box("doNuevoTicket no retorna resultados","ERROR");
        }
        else
        {
            var jdata = JSON.parse(json);
            document.location.href = jdata.url;
        }	
    },"HOME","doNuevoTicket",'');
}





/** UTILIDADES - Completar una tabla, dado un array 2D. En el parametro tabla se espera recibir un nodo <TBODY>
 * 
 * @param {json} datos
 * @returns {void}
 */
function completar_tabla_tickets(datos)
{
    var j=0;
    var b = "<table class=\"table table-striped\">" +
                    "  <thead>" +
                    "    <tr>" +
                    "		<th>Ticket</th>" +
                    "		<th>Estado</th>" +
                    "		<th>Fechas</th>" +
                    "		<th>Prestaciones</th>" +
                    "		<th>Ubicación</th>" +
                    "		<th>Acción</th>" +
                    "	 </tr>" +
                    "  </thead>" +
                    "  <tbody>";
	
    if(datos) 
    {
        for(j=0;j<datos.length;j++)
        {
            var estado = datos[j].estado==='ABIERTO' ? '<span class="badge badge-info">Abierto</span>' : '<span class="badge badge-success">Cerrado</span>';
            var cerrado = datos[j].cerrado!=='' ? "<br> Cerrado: "+datos[j].cerrado : '';
            var reiterado = datos[j].reiterado!=='' ? "<br>Reiterado: "+datos[j].reiterado : '';
            var v = parseInt(datos[j].vencido);
            var vencido = v>0 ? '<br><span class="badge badge-important">Vencido '+v+(v===1 ? ' día' : ' días')+'</span>' : '';
            b+="<tr>" +
               "  <td>"+datos[j].identificador+"</td>" + 
               "  <td>"+estado+vencido+"</td>" +
               "  <td>Ingreso: "+datos[j].ingreso+"<br>Estimado: "+datos[j].estimado+reiterado+cerrado+"</td>" +
               "  <td>"+datos[j].prestacion+"<br/><em>"+datos[j].nota+"<em></td>" +
               "  <td>"+renderDireccion(datos[j].ubicacion)+"</td>" +
               "  <td>";
            if(datos[j].url_ver!=="")
                b+="<button onclick=\"irA('"+datos[j].url_ver+"')\" class=\"btn\">Ver</button>  ";

            if(datos[j].url_reiterar!=="")
                b+="<button onclick=\"irA('"+datos[j].url_reiterar+"')\" class=\"btn\">Reiterar</button>";
            
            b+="  </td>" +
               "</tr>";
        }
    }
    if(j===0)
    {
        b+='<tr><td colspan="7">Sin datos</td></tr>';
    }
    b+="</tbody></table>";

    $("#tickets_tbl").html(b);		
    $("#tickets_tbl a").popover();
}

/** Genera el HTML con la direccion
 * 
 * @param {object} objDir
 * @returns {string}
 */
function renderDireccion(objDir) {
    if(objDir && objDir.lat && objDir.lng) {
        var mapa = "<img id=\'mapa\' src=\'" + sess_web_path + "/common/mapa.php?x=" + objDir.lat + "&y=" + objDir.lng + "&w=250&h=250&r=250\'>";
        var d = objDir.calle_nombre + " " + objDir.callenro + " <a href=\"#\" data-toggle=\"popover\" title=\"Ubicación\" data-html=\"true\" data-content=\"" + mapa + "\" ><i class=\"icon-globe\"></i></a><br>";
        if(objDir.piso)
            d+=" Piso:" + objDir.piso;
        if(objDir.dpto)
            d+=" Dpto:" + objDir.dpto;
        if(objDir.barrio)    
            d+=" Barrio:" + objDir.barrio;
        return d;
    } 
    return "Sin dirección";
}

/** Hacer la transcicion a la pagina
 * 
 * @param {string} url
 * @returns {void}
 */
function irA(url)
{
    document.location = url;
}	
    

/** Cuando hay ambiguedad, se debe elegir el ciudadano correcto y luego se llama a esta funcion - Que define al usuario conectado
 * 
 * @param {string} ciu_code
 * @returns {undefined}
 */
function setSession(ciu_code)
{
    var params =  ciu_code + '|' + '';
    new rem_request(this, function(obj,json){
        var jdata = JSON.parse(json);
        if(!jdata)
        {
            alert_box("setSession no retorna resultados", "ERROR");
        }
        else
        {
            document.location = sess_web_path+"/index.php";
        }    
    },"HOME","doSetSession",params);
}

/** Completar la tabla de contactos previos
 * 
 * @param {object} datos
 * @returns {void}
 */
function completar_tabla_contactos(datos)
{
    var j=0;
    var b = "<table class=\"table table-striped\">" +
                    "	<thead>" +
                    "		<tr>" +
                    "			<th>Fecha</th>" +
                    "			<th>Sesión</th>" +
                    "			<th>Motivo</th>" +
                    "			<th>Nota</th>" +
                    "			<th>Canal</th>" +
                    "			<th>Acciones</th>" +
                    "		</tr>" +
                    "	</thead>" +
                    "  <tbody>";
    if(datos)
    {
        for(j=0;j<datos.length;j++)
        {
            b+="<tr><td>"+datos[j].fecha+"</td>";
            b+="<td>"+datos[j].cse_code+"</td>";
            b+="<td>"+datos[j].motivo+"</td>";
            b+="<td>"+datos[j].nota+"</td>";
            b+="<td>"+datos[j].canal+"</td>";

            //Acciones    
            b+="<td></td></tr>";
        }
    }
    if(j===0)
    {
        b+='<tr><td colspan="6">Sin datos</td></tr>';
    }
    b+="</tbody></table>";

    $("#calls_tbl").html(b);
}


/** Completar todos los fulanos que matchean con este ANI 
 * 
 * @param {object} datos
 * @returns {void}
 */
function completar_tabla_ani(datos)
{
    var j=0;
    var b = "<table class=\"table table-striped\">" +
                    "	<thead>" +
                    "		<tr>" +
                    "			<th>Apellido</th>" +
                    "			<th>Nombre</th>" +
                    "			<th>Documento</th>" +
                    "			<th>Acción</th>" +
                    "		</tr>" +
                    "	</thead>" +
                    "  <tbody>";
    if(datos)
    {
        for(j=0;j<datos.length;j++)
        {
            b+="<tr><td>"+datos[j].ciu_apellido+"</td>";
            b+="<td>"+datos[j].ciu_nombres+"</td>";
            b+="<td>"+datos[j].ciu_doc_nro+"</td>";

            b+="<td>";

            if(datos[j].btn_detalle!=="")
            {
                b+="<button onclick=\"getCiudadano('"+datos[j].detalle+"')\" class=\"btn\">Detalles</button>";
            }

            if(datos[j].btn_sesion!=="")
            {
                b+="<button onclick=\"setSession('"+datos[j].sesion+"')\" class=\"btn\">Sesión</button>";
            }

            b+="</td></tr>";
        }
    }
    if(j===0)
    {
        b+='<tr><td colspan="4">Sin datos</td></tr>';
    }
    b+="</tbody></table>";

    $("#ciudadanos_tbl").html(b);	
}

/** Reiterar el ticket 
 * Muestro un dialog para confirmar la reiteración y registrar una nota
 * 
 * @param {int} tic_nro codigo interno del ticket
 * @returns {void}
 */
function reiterar(tic_nro) {
    //Muestro el dialogo de reiteracion
    var h = '<div class="modal hide fade" id="reiteracion_dialog"> \n\
        <div class="modal-header"> \n\
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> \n\
          <h3>Reiterar ticket</h3> \n\
        </div> \n\
        <div class="modal-body"> \n\
            <div class="control-group"> \n\
                <label class="control-label" for="reitNota">Nota</label> \n\
                <div class="controls"> \n\
                    <textarea id="reitNota"></textarea> \n\
                </div> \n\
            </div> \n\
        </div> \n\
        <div class="modal-footer"> \n\
          <button class="btn" data-dismiss="modal">Cancelar</button> \n\
          <button class="btn btn-primary">Confirmar</button> \n\
        </div> \n\
    </div>';
    $(document.body).append(h);
    $('#reiteracion_dialog').modal();
    $('#reiteracion_dialog .btn-primary').click(function(){
        $('#reiteracion_dialog').modal('hide');
        //Pido la reiteracion el backend
        var nota = $('#reitNota').val();
        new rem_request(this,function(obj,json){
            //No responde nada
            $('#reiteracion_dialog').html('').remove();
        },"HOME","reiterarTicket",tic_nro + '|' + nota);
    });
 
}
