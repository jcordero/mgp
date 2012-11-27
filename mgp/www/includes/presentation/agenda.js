//AGENDA
// Parametros:
//	1 - Hospital
//	2 - Cuestionario
//
function chg_agenda(obj) 
{	
	//Codigo de la agenda seleccionada
	var ix = obj.selectedIndex;
	var agenda = "";
	if(ix!=-1)
	{
		agenda = obj.options[ix].value;
	}
	
	if(agenda=="")
	{
		return;
	}

	//El campo esta dentro de una TABLA?
	var objID = obj.id;
	var en_tabla = (objID.substring(0,2)=="m_" ? false : true);
	var label = "";
	var clase = "";
	var params = null;
	
	//Recupero los parametros de este objeto
	if(!en_tabla)
	{
		params = eval( objID.substring( objID.indexOf("_")+1 ) + ".m_params.split('|')" );
		label = eval( objID.substring( objID.indexOf("_")+1 ) + ".m_label" );
	}
	else
	{
		clase = objID.substring(3,objID.indexOf("_f"));
		var orden = objID.substring(objID.indexOf("_f")+2);
		params = eval( clase + "_" + orden + ".m_params.split('|')" );
		label = eval( clase + "_" + orden + ".m_label" );
	}

	var mi_hospital = null;
	var mi_cuestionario = null;

	//Determino los objetos a actualizar
	if(en_tabla)
	{	
		mi_hospital = getField4(clase,params[0]);
		mi_cuestionario = getField4(clase,params[1]);
	}
	else
	{
		mi_hospital = document.getElementById("m_"+params[0]);
		mi_cuestionario = document.getElementById("m_"+params[1]+"_placeholder");
	}

	//Cual es el hospital?
	var hospital = "";
	if(mi_hospital.selectedIndex)
	{
		var ix = mi_hospital.selectedIndex;
		if(ix!=-1)
		{
			hospital = mi_hospital.options[ix].value;
		}
		else
		{
			return;
		}
	}
	else
	{
		hospital = mi_hospital.value;
	}
	
	//Pido el HTML del cuestionario correspondiente
	if(mi_cuestionario)
	{
		var json = rem_sync_request("HOSPITAL","AJAXgetCuestionario",hospital + "|" + agenda);
		if(json=="")
		{
			alert("No se pudo completar la operación, el servidor no responde.");
			return;
		}
		var jdata = eval('(' + json + ')');
	
		//Completo el cuestionario
		mi_cuestionario.innerHTML = jdata;
	}
	
	//Pido los turnos libres de la semana
	pidoTurnosLibres2();
}


function init_agenda(id, params)
{
	var p = params.split("|");
	var hosp = p[0];
	var hosp_obj = document.getElementById("m_"+hosp);
	if(hosp_obj && hosp_obj.value)
	{
		if( hosp_obj.value != "" )
		{
			//Pido las agendas...
			chg_hospital(hosp_obj);
		}
		
	}
}
