//DOC ID
// a + objID - combo tipo de documento
// b + objID - combo numero de documento
// Parametros:
// 1 - Nombres 
// 2 - Apellido
// 3 - Razon Social
// 4 - Calle
// 5 - Altura
// 6 - Piso
// 7 - Dpto
// 8 - Localidad
// 9 - CodPostal
// 10 - TipoPersona
// 11 - Sexo
// 12 - Profesion

function chg_docid(objID) 
{		
	var obj_nro = document.getElementById("b" + objID); 
	if(!obj_nro)
    {
        return; //No hay campo DOCID en el formulario
    }
    if(obj_nro.value=="")
	{
		return; //No hay un documento cargado para buscar
	}
	
	//El campo esta dentro de una TABLA? 
	var en_tabla = (objID.substring(0,2)=="m_" ? false : true);
	var label = "";
	var clase = "";
	var params = null;
	var nombres = null;
	var apellido = null;
	var razonsocial = null;
	var calle = null;
	var altura = null;
	var piso = null;
	var dpto = null;
	var localidad = null;
	var codpostal = null;
	var tipopersona = null;
	var sexo = null;
    var profesion = null;

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
	
	//Validan los datos ingresados?
	var validar = valDOCID("b"+objID,label);
	if(validar!="")
	{
		alert_box(validar,"ATENCION");
		return;
	}
	
	//TIPO DE DOCUMENTO?
	var id_type = "";
	var obj_tipo = document.getElementById("a" + objID); 
	var ix = obj_tipo.selectedIndex;
	if(ix!=-1)
	{
		id_type = obj_tipo.options[ix].text;
	}
	
	//Identificador compuesto
	var q = id_type + "|" + obj_nro.value;
	var json = rem_sync_request("DOCID","doBuscar",q);
    var jdata = eval('(' + json + ')');
	if(!jdata)
    {
        alert_box("La consulta al padron no arroja resultados","ERROR");
        return;
    }

	//Determino los objetos a actualizar
	if(en_tabla)
	{	
		nombres = getField4(clase,params[0]);
		apellido = getField4(clase,params[1]);
		razonsocial = getField4(clase,params[2]);
		calle = getField4(clase,params[3]);
		altura = getField4(clase,params[4]);
		piso = getField4(clase,params[5]);
		dpto = getField4(clase,params[6]);
		localidad = getField4(clase,params[7]);
		codpostal = getField4(clase,params[8]);
		tipopersona = getField4(clase,params[9]);
        sexo = getField4(clase,params[10]);
        profesion = getField4(clase,params[11]);
	}
	else
	{
		nombres = document.getElementById("m_"+params[0]);
		apellido = document.getElementById("m_"+params[1]);
		razonsocial = document.getElementById("m_"+params[2]);
		calle = document.getElementById("m_"+params[3]);
		altura = document.getElementById("m_"+params[4]);
		piso = document.getElementById("m_"+params[5]);
		dpto = document.getElementById("m_"+params[6]);
		localidad = document.getElementById("m_"+params[7]);
		codpostal = document.getElementById("m_"+params[8]);
		tipopersona = document.getElementById("m_"+params[9]);
        sexo = document.getElementById("m_"+params[10]);
        profesion = document.getElementById("m_"+params[11]);
	}
	
	//Retorno algo?
	if(jdata.length==0)
	{
		alert_box("No se hallan datos para el documento " + obj_nro.value,"ATENCION");
		nombres.value = "";
		apellido.value = "";
		razonsocial.value = "";
		calle.value = "";
		altura.value = "";
		piso.value = "";
		dpto.value = "";
		localidad.value = "";
		codpostal.value = "";
		tipopersona.value = "FISICA";
		sexo.value = "MASCULINO";
        profesion.value = "";
		return;
	}

//tipo_doc,matricula,sexo,apellido,nombre,domicilio,profesion
	nombres.value = jdata[0].nombre;		
	apellido.value = jdata[0].apellido;
	razonsocial.value = "";
	calle.value = jdata[0].domicilio;
	altura.value = '';
	piso.value = '';
	dpto.value = '';
	localidad.value = '';
	codpostal.value = '';
	tipopersona.value = 'FISICA';
	sexo.value = jdata[0].sexo;
    profesion.value = jdata[0].profesion;
}


function valDOCID(fldID,fldLabel) 
{
	var fld = document.getElementById(fldID);
	if(fld) 
	{
		var valor = fld.value;
		if(valor=="")
		{
			return "";
		}
		var re = new RegExp("^[0-9]{5,15}$");
		if( re.test(valor)==true ) 
		{
			return "";
		} 
		else
		{
			return "El campo " + fldLabel + " debe contener de 5 a 15 digitos sin espacios";
		}
	} 
	else 
	{
		return "campo " + fldID + " no se encuentra";
	}
}

function IniciarDocID(campo,params)
{
	//Solo si el formulario es para un alta y es argentino
	//ciu_nombres|ciu_apellido|ciu_razon_social|ciu_dir_calle|ciu_dir_nro|ciu_dir_piso|ciu_dir_dpto|ciu_localidad|ciu_cod_postal|ciu_tipo_persona|ciu_sexo|ciu_profesion|ciu_nacionalidad
	//    0           1               2                3             4         5            6            7              8               9            10          11            12
	var c = params.split("|");
	if( c.length>12 ) {
		var p = $("#m_"+c[12]).val();
		if( p=="Argentina" ) {
			if(typeof OP == "string" && OP=="N")
		    {
				chg_docid("m_"+campo);
		    }
		} else {
			$("#ciu_doc_nro img").hide();
		}
	}
}