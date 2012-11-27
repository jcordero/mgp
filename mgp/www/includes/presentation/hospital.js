//HOSPITAL

function init_hospital(id,params) {
	//Si es de tipo COPS busco los turnos libres directamente
	var modo =$("#m_tmp_tipo").val();
	if(modo=="COPS")
		chg_hospital(document.getElementById("m_tmp_hospital"));
}

function chg_hospital(obj) 
{	
	//Codigo del hospital seleccionado
	var hospital = $("#"+obj.id+" option:selected").val();
	if(typeof hospital=="undefined")
	{
		hospital = $("#"+obj.id).val();
	}	
	
	//Aborto las conexiones pendientes
	abortarConsultas();
	
	//Limpio los turnos al tocar el hospital
	//Ubicacion de los turnos
	$("#m_tmp_dia_week").html("");
	$("#m_tmp_agenda").html("");
	$("#m_tmp_servicio").html("");
	$("#agendas").html("");

	lista_agendas = [];
	lista_hospitales = [];
	lista_turnos = [];
	
	if(hospital=="")
		return;
	
	//El paciente es COPS? y estoy en modo cops
	var cops_id = $("#m_cops_id").val();
	var modo =$("#m_tmp_tipo").val();
	
	//NO ES COPS, MUESTRO EL COMBO SERVICIOS
	if(modo=="GENERAL")
	{
		var edad = $("#m_edad").val();
		var sexo = $("#m_sexo").val();
		esperar();
		var j = new rem_request(obj,function(obj,json){
			listo();
			if(json=="")
			{
				alert("No se pudo completar la operación, el servidor no responde.");
				return;
			}
			var jdata = eval('(' + json + ')');
			
			$("#m_tmp_servicio").append('<option value="0">');

			//Completo el combo servicios
			for(var j=0;j<jdata.length;j++)
			{
				var serv = jdata[j];
				$("#m_tmp_servicio").append('<option value="'+serv.codigo+'">'+serv.servicio);
			}

			if(jdata.length==0)
			{
				alert_box("No hay servicios telefonicos para este hospital","ATENCION");
			}
			
		},"HOSPITAL","AJAXgetServicios",hospital+"|"+ edad + "|" + sexo);
	}
	
	if(modo=="COPS")
	{
		//ES COPS VOY DIRECTO A LAS AGENDAS DEL PACIENTE
		//Recupero los valores a setear
		$("#tmp_servicio").hide();
		esperar("Recuperando agendas de COPS...");
		var j = new rem_request(obj,function(obj,json){
			listo();
			if(json=="")
			{
				alert("No se pudo completar la operación, el servidor no responde.");
				return;
			}
			var jdata = eval('(' + json + ')');

			//No hay medico asignado?
			if( jdata.error )
			{
				alert_box(jdata.error,"ATENCION");
				return;
			}
												
			if(jdata.length==0)
			{
				$("#lm_tmp_agenda").html("");
				alert_box("No hay agendas para este paciente","ATENCION");
				return;
			}

			//Limpio el ultimo resultado mostrado
			$('#m_tmp_dia_week').empty();

			//Completo el combo agenda
			for(var j=0;j<jdata.length;j++)
			{
				//cambio renglon?
				var agenda = jdata[j];
				
				if(agenda.agenda==null) {
					alert_box("No estan asignados los medicos para este paciente. Notificar en COPS.","ERROR");
					return;	
				}
				
				agenda.activa=true;
				var hospital = getHospital(agenda.hospital, agenda.hospital_desc);
				hospital.agendas.push(agenda);
				lista_agendas.push(agenda);
			}
			
			//Informo de la cantidad de agendas disponibles
			var msg = "<ul>";
			for(var j=0;j<lista_agendas.length;j++) {
				msg+='<li>'+lista_agendas[j].agenda+'</li>';
			}
			msg+='</ul>';
			$('#lm_tmp_agenda').html(msg);
			
			
			//Cargo todos los turnos para este servicio
			pidoTurnosLibres2();
			
		},"HOSPITAL","AJAXgetAgendas",hospital+"|0|COPS");
	}
}
