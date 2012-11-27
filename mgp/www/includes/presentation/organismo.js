
function chg_organismo_h(objname) 
{
	var obj = document.getElementById(objname);
	if(obj.value=="") 
	{
		return;
	}
    var json = rem_sync_request("ORGANISMO","getList",obj.value);
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
			alert("No existe un organismo con este nombre");
			return;
	} 
	else 
	{
		if(jdata.length==1)
		{
			var codcli_bej =  jdata[0].tor_code;
			var cem_name = jdata[0].tor_nombre;
			setValuePair(campo,codcli_bej,cem_name);			
		}
		else
		{
			listHelper(campo,jdata);
		}
	}
}

//Cambio de codigo => completo descripcion
function chg_organismo(objname) 
{
	var obj = document.getElementById(objname);
	if(obj.value=="")
		return;
		
	var json = rem_sync_request("ORGANISMO","getCodeDescription",obj.value);
    var jdata = eval('(' + json + ')');
    if(!jdata)
	{
        alert("No se puede acceder al servidor");
		return;
	}
	var campo = obj.id;
	if(jdata.length==0)
	{
		setValuePair(campo,"","");
		alert("No existe un organismo con este codigo");
		return;
	} 
	
	var valor =  jdata[0].tor_code;
	var valor_h =  jdata[0].tor_nombre;
	setValuePair(campo,valor,valor_h);	
}

//Generacion de un string con el codigo y nombre del material
function chg_organismo_t(obj_name)
{
	objk = document.getElementById(obj_name).value;
	objh = document.getElementById("h"+obj_name).value;
	
	if(objh=="")
	{
        return objk;
    }
	else
	{
        return '(' + objk + ') ' + objh;
    }
}
