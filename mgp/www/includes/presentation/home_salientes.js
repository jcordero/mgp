function pedirLlamada()
{
	//Pido un ticket que este disponible 
	var json = rem_sync_request("HOME_SALIENTES","hacerLlamada",param_cgpc + "|" + param_barrio + "|" + param_tipo + "|" + param_estado + "|" + param_desde + "|" + param_hasta + "|" + session_id);
	if(!json)
    {
        alert_box("No se pudo realizar la consulta al servidor. Intente nuevamente.","ERROR");
        return;
    }
	var jdata = eval('(' + json + ')');
	
	if( jdata.status=="OK" )
	{
		document.location = jdata.url;
	}
	else
	{
		alert_box("No hay mas llamadas pendientes." + (param_cgpc!='' || param_barrio!='' || param_tipo!='' || param_estado!='' || param_desde!='' || param_hasta!='' ? " Para filtro "+param_cgpc+" "+param_barrio+" "+param_tipo+" "+param_estado+" "+param_desde+" "+param_hasta : ""),"AVISO");
	}
}

function go(place)
{
	var json = rem_request(this, function(obj,json){
		if(!json)
	    {
	        alert_box("No se pudo realizar la consulta al servidor. Intente nuevamente.","ERROR");
	        return;
	    }
		var jdata = eval('(' + json + ')');
		document.location = jdata;
	}, "HOME_SALIENTES", "go", place+"|" + session_id);
}

function mostrarEnCurso()
{
	try
	{
		//Pido los tickets en curso 
		var json = rem_request(this, function(obj,json){
			if(!json)
		    {
		        alert_box("No se pudo realizar la consulta al servidor. Intente nuevamente.","ERROR");
		        return;
		    }
			var jdata = eval('(' + json + ')');
			var b = "";
			if(jdata.length>0) {
				b+='<table class=""><thead><tr><th>Tipo</th><th>Nombre</th><th>Prestación</th><th>Acción</th></tr></thead>';
				b+='<tbody>';
				for(var j=0;j<jdata.length;j++) {
					var r = jdata[j];
					b+='<tr><td>'+r.cqu_tipo+'</td><td>'+r.cqu_nombre+'</td><td>'+r.cqu_prestacion+'</td><td><button onclick="document.location=\''+r.url+'\';">Cerrar</button></td></tr>';
				}
				b+='</tbody></table>';	
			} else {
				b+='<span>No tiene llamadas en abandonadas.</span>';
			}			
			$("#encurso").html(b);
		}, "HOME_SALIENTES", "llamadasEnCurso", sess_use_code + "|" + session_id);		
	}
	catch(err)
	{
		alert_box(err.description,"ERROR");
	}
}

function tabla_encurso_click(oArgs)
{
	var oRecord = this.getRecord(oArgs.target); 
    var url = oRecord.getData("url");
    
    //Ejecuto la transicion
    document.location = url;
}

$(document).ready( function(){
	mostrarEnCurso();
});