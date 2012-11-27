
/*
 * Completa el resto de los campos con la info de georeferencia
 * Parametros:
 * 		calle	(codigo de calle usig)
 * 		callenro (altura)
 * 		calle_nombre
 * 		tic_coordx (para mapa)
 * 		tic_coordy
 * 		tic_barrio
 * 		tic_cgpc (nombre del cgpc en forma 'Comuna X')
 * 		
 */
function chg_cementerio(obj)
{
	//Cual es la plaza elegida?
	var ix = obj.selectedIndex;
	var plaza = "";
	if(ix!=-1)
	{
		plaza = obj.options[ix].value;
	}
	else
	{
		return;
	}

	//Recupero los valores a setear
	var json = rem_sync_request("CEMENTERIO","getCementerioDetails",plaza);
	if(json=="")
	{
		alert("No se pudo completar la operación, el servidor no responde.");
		return;
	}
	var jdata = eval('(' + json + ')');

	//Busco la lista de campos
	var params = extractParams(obj.id);
	if(params.length!=7)
	{
		alert("El objeto CEMENTERIO requiere 7 parametros");
		return;
	}
	
	//Busco los campos
	var obj_calle = null;
	var obj_callenro = null;
	var obj_calle_nombre = null;
	var obj_tic_coordx = null;
	var obj_tic_coordy = null;
	var obj_tic_barrio = null;
	var obj_tic_cgpc = null;
	
	var objID = obj.id;
	var en_tabla = (objID.substring(0,2)=="m_" ? false : true);
	if(en_tabla)
	{	
		var clase = objID.substring(3,objID.indexOf("_f"));
		obj_calle = getField4(clase,params[0]);
		obj_callenro = getField4(clase,params[1]);
		obj_calle_nombre = getField4(clase,params[2]);
		obj_tic_coordx = getField4(clase,params[3]);
		obj_tic_coordy = getField4(clase,params[4]);
		obj_tic_barrio = getField4(clase,params[5]);
		obj_tic_cgpc = getField4(clase,params[6]);
	}
	else
	{
		obj_calle = document.getElementById("m_"+params[0]);
		obj_callenro = document.getElementById("m_"+params[1]);
		obj_calle_nombre = document.getElementById("m_"+params[2]);
		obj_tic_coordx = document.getElementById("m_"+params[3]);
		obj_tic_coordy = document.getElementById("m_"+params[4]);
		obj_tic_barrio = document.getElementById("m_"+params[5]);
		obj_tic_cgpc = document.getElementById("m_"+params[6]);
	}
	
	//Seteo los valores en los campos
	obj_calle.value = jdata[0].tge_calle;
	obj_calle_nombre.value = jdata[0].tge_calle_nombre;
	obj_callenro.value = jdata[0].tge_altura;
	obj_tic_coordx.value = jdata[0].tge_coordx;
	obj_tic_coordy.value = jdata[0].tge_coordy;
	obj_tic_barrio.value = jdata[0].tge_barrio;
	obj_tic_cgpc.value = jdata[0].tge_cgpc;
}

