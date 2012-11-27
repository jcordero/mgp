//-------------------------------ALTURA DE LA CALLE-----------------------------------------------------------------

//Cambio de codigo => verifico la direccion
function chg_altura(objID) 
{
	var obj = document.getElementById(objID);
	if(obj.value=="")
	{
		alert("Complete la altura primero");
		return;
	}
	
	//Si cambio la altura, vuelvo a validar la direccion
	var clase = "";
	var orden = "";
	if(objID.substring(0,2)=="m_")
	{
		eval("var calle_id = " + objID.substring(2) + ".m_params;");
	}
	else
	{
		clase = objID.substring(3,objID.indexOf("_f"));
		orden = objID.substring(objID.indexOf("_f")+2);
		eval("var calle_id = " + clase + "_" + orden + ".m_params;");
	}
	
	if(!calle_id)
	{
		alert("No existe el campo asociado " + objID.substring(2));
		return;
	}

	//ID del campo calle
	if(objID.substring(0,2)=="m_")
	{
		chg_calle_h("m_" + calle_id);	
	}
	else
	{
		var objCalle = getField(clase,calle_id);
		chg_calle_h(objCalle.id);
	}
}
