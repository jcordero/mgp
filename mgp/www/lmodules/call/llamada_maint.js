//Inicio del formulario
$(document).ready(function(){
	if(OP!="M")
	{
		return;
	}

	$("#mapa").css({'position': 'absolute', 'margin-left': '450px'});
	$("#bloque_ubicacion").css('height','300px');

	//OCULTO LOS CAMPOS QUE SOLO SE VEN CUANDO HAY DIFERENTE A "EN CURSO" EN EL ESTADO DE LA LLAMADA
	cierro_todo();
	
	//HANDLER DEL CAMBIO DE ESTADO
	$("#m_cqu_estado").change(call_estado_change);
});

function cierro_todo() {
	var obj_resuelto = $("#cqu_resuelto");
	if(obj_resuelto.length>0)
	{
		obj_resuelto.hide();
		cqu_resuelto.m_mandatory=false;
	}
	
	var obj_resultado = $("#cqu_resultado");
	if(obj_resultado.length>0)
	{
		obj_resultado.hide();
		cqu_resultado.m_mandatory=false;
	}
	
	var obj_motivo = $("#cqu_motivo_no_conforme");
	if(obj_motivo.length>0)
	{
		obj_motivo.hide();
		cqu_motivo_no_conforme.m_mandatory=false;
	}
	
	var obj_actitud = $("#cqu_actitud");
	if(obj_actitud.length>0)
	{
		obj_actitud.hide();
		cqu_actitud.m_mandatory=false;	
	}
	
	var obj_seguir = $("#cqu_seguir");
	if(obj_seguir.length>0)
	{
		obj_seguir.hide();
		cqu_seguir.m_mandatory=false;	
	}	
}

//Cambio de estado de RESUELTO ?
function call_resuelto_change(obj)
{
	var obj_resultado = $("#cqu_resultado");
	if(obj_resultado.length>0)
	{
		obj_resultado.show();
		cqu_resultado.m_mandatory=true;
	}		
}

//Cambio de estado de CONFORME ?
function call_resultado_change(obj)
{
	var opcion = obj.value;
	var obj_motivo = $("#cqu_motivo_no_conforme");
	var obj_seguir = $("#cqu_seguir");
	
	if(obj_motivo.length==0 || obj_seguir.length==0)
	{
		return false;
	}
	
	if( opcion=="NO CONFORME" )
	{
		obj_motivo.show();
		obj_seguir.show();
		
		cqu_motivo_no_conforme.m_mandatory=true;
		cqu_seguir.m_mandatory=true;
	}
	else
	{
		obj_motivo.hide();
		obj_seguir.hide();
		
		cqu_motivo_no_conforme.m_mandatory=false;
		cqu_seguir.m_mandatory=false;	
	}
}


//Cambio de un estado a otro
function call_estado_change(ev) {
	var estado = $(this).val();
	if(estado=="CANCELADA") {
		cierro_todo();
	}
	if(estado=="COMPLETADA") {
		var obj_resuelto = $("#cqu_resuelto");
		if(obj_resuelto.length>0)
		{
			obj_resuelto.show();
			cqu_resuelto.m_mandatory=true;
		}
	}
	if(estado=="REINTENTAR") {
		cierro_todo();
	}
	if(estado=="EN CURSO") {
		cierro_todo();
	}
}

