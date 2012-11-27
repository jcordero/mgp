
//Al seleccionar el servicio y el hospital puedo preguntar por las agendas.
//Esto solo sucede cuando la personas NO ESTA AFILIADA A COPS
function chg_servicio(obj) {

	var servicio = $("#"+obj.id+" option:selected").val();
	var hospital = $("#m_tmp_hospital option:selected").val();
	var modo =$("#m_tmp_tipo").val();
	
	//Limpio los turnos de la ultima consulta
	$("#m_tmp_dia_week").html("");
	lista_hospitales = [];
	lista_agendas = [];
	lista_turnos = [];
	
	//No hay nada que hacer?
	if(hospital=="" && servicio=="")
	{
		return;
	}
	
	//Pido las agendas: Si el modo es "SERVICIO" pido solo las agendas para el hospital pedido
	//Si el modo es "PRIMERO" cargo las agendas de todos los hospitales que prestan el servicio
	
	esperar("Recupero agendas...");
	var j = new rem_request(obj,function(obj,json){
		listo();
		if(json=="")
		{
			alert("No se pudo completar la operación, el servidor no responde.");
			return;
		}
		var jdata = eval('(' + json + ')');
		$("#lm_tmp_agenda").html("");
		if(jdata.length==0)
		{
			alert_box("No hay agendas para este servicio","ATENCION");
			return;
		}
		
		//Cargo las agendas en los hospitales
		for(var j=0;j<jdata.length;j++)
		{
			var agenda = jdata[j];
			agenda.activa = true;
			
			//Existe el hospital?
			var hospital = getHospital(agenda.hospital, agenda.hospital_desc);
			hospital.agendas.push(agenda);
			lista_agendas.push(agenda);
		}
		
		//Informo de la cantidad de agendas disponibles
		$('#lm_tmp_agenda').html('Disponibles '+lista_agendas.length+" agendas.");
		
		//Cargo todos los turnos para este servicio
		pidoTurnosLibres2();
		
	},"HOSPITAL","AJAXgetAgendas",hospital+"|"+servicio+"|"+modo);
}

/** Depende del modo de operacion, se cargan todos los servicios disponibles o solo aquellos que presta el hospital
 * 
 * @param id
 * @param params
 */
function init_servicio(id,params) 
{
	var modo = $("#m_tmp_tipo").val();
	var edad = $("#m_edad").val();
	var sexo = $("#m_sexo").val();
	
	if(modo=="SERVICIO" || modo=="PRIMERO") 
	{
		esperar("Cargando servicios...");
		var j = new rem_request(id,function(id,json)
		{
			listo();
			if(json=="")
			{
				alert_box("No se pudo completar la operación, el servidor no responde.","ERROR");
				return;
			}
			var jdata = eval('(' + json + ')');
			
			$('#m_tmp_servicio').html("");
			if(jdata.length==0)
			{
				alert_box("No hay agendas para este servicio","ATENCION");
				return;
			}

			//Completo el combo servicios
			$('#m_tmp_servicio').append('<option name="">');
			for(var j=0;j<jdata.length;j++)
			{
				var s = jdata[j];
				$('#m_tmp_servicio').append('<option value="'+s.codigo+'">'+s.servicio);				
			}
		},"HOSPITAL","AJAXgetTodosLosServicios", edad + "|" + sexo);
	}
}
