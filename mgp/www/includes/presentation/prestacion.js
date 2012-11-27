//-------------------------------PRESTACION-----------------------------------------------------------------
//Cambio de descripcion => completo el codigo 
function chg_prestacion_h(objname) 
{
	var obj = document.getElementById(objname);
	if(obj.value=="") 
	{
		return;
	}
	var json = rem_sync_request("PRESTACION","getList",obj.value);
    if(json=="")
	{
        alert("No se puede acceder al servidor");
		return;
	}
    var jdata = eval('(' + json + ')');
  	
    var campo = obj.id.substring(1);
	if(jdata.length==0)
	{
		setValuePair(campo,"","");
		alert("No existe una prestacion con este nombre");
		return;
	} 
	else 
	{
		if(jdata.length==1)
		{
			var code =  jdata[0].tpr_code;
			var detail = jdata[0].tpr_detalle;
			setValuePair(campo,code,detail);			
		}
		else
		{
			//Hay mas de una posibilidad
			listHelper(campo,jdata);
		}
	}
}

//Cambio de codigo => completo descripcion
function chg_prestacion(objname) 
{
	var obj = document.getElementById(objname);
	if(obj.value=="")
		return;
		
	var json = rem_sync_request("PRESTACION","getCodeDescription",obj.value);
    if(json=="")
	{
        alert("No se puede acceder al servidor");
		return;
	}
    var jdata = eval('(' + json + ')');
    
	var campo = obj.id;
	if(jdata.length==0)
	{
		setValuePair(campo,"","");
		alert("No existe una prestacion con este codigo");
		return;
	} 
	
	var valor =  jdata[0].tpr_code;
	var valor_h =  jdata[0].tpr_detalle;
	setValuePair(campo,valor,valor_h);	
}
