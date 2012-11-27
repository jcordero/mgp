//DNI

function chg_dni(objID) 
{		
	var obj = document.getElementById(objID); //Nro documento
	if(obj.value=="")
		return;
	
	//El campo esta dentro de una TABLA? 
	var en_tabla = (objID.substring(0,2)=="m_" ? false : true);
	var expr = "";
	var label = "";
	var clase = "";
	var quien = null;
	var TipoDoc = null;
	var TelFax = null;
	var DomCod = null;
	var DomNro = null;
	var DomPiso = null;
	var DomDpto = null;
	var CodPostal = null;
	var Email = null;
	
	//Recupero los parametros de este objeto
	if(!en_tabla)
	{
		expr = "var params = " + objID.substring( objID.indexOf("_")+1 ) + ".m_params.split('|');";
		eval("label = " + objID.substring( objID.indexOf("_")+1 ) + ".m_label;");
	}
	else
	{
		clase = objID.substring(3,objID.indexOf("_f"));
		var orden = objID.substring(objID.indexOf("_f")+2);
		expr = "var params = " + clase + "_" + orden + ".m_params.split('|');";
		eval("label = " + clase + "_" + orden + ".m_label;");
	}
	eval(expr);
	
	//Validan los datos ingresados?
	if(!valDNI(objID,label))
		return;
		
	//Esta especificado el TIPO DE DOCUMENTO?
	var id_type = "";
	if(params.length>0)
	{
		if(!en_tabla)	
			TipoDoc = document.getElementById("m_" + params[0]); //Tipo de documento
		else
			TipoDoc = getField4(clase,params[0]);
		
		if(TipoDoc)
				id_type = TipoDoc.value;
	}
	else
	{
		return;
	}
	
	//Armo el SQL para la consulta a la base...
	var query = "SELECT TOP 1 [Quien],[QuienTipoDoc],[QuienTelFax],[QuienDomCod],[QuienDomNro],[QuienDomPiso],[QuienDomDpto],[QuienCodPostal],[QuienEmail] FROM v_Reclamantes WHERE [QuienNroDoc]='" + obj.value + "'";
	if(id_type!="")
		query += " AND [QuienTipoDoc]='" + id_type + "'";
		
	//Hago la consulta...
	var xmldata = new rem_sync_request(query);

	//Determino los objetos a actualizar
	if(en_tabla)
	{	
		quien = getField4(clase,params[1]);
		TelFax = getField4(clase,params[2]);
		Email = getField4(clase,params[3]);
		DomCod = getField4(clase,params[4]);
		DomNro = getField4(clase,params[5]);
		DomPiso = getField4(clase,params[6]);
		DomDpto = getField4(clase,params[7]);
		CodPostal = getField4(clase,params[8]);
	}
	else
	{
		quien = document.getElementById("m_"+params[1]);
		TelFax = document.getElementById("m_"+params[2]);
		Email = document.getElementById("m_"+params[3]);
		DomCod = document.getElementById("m_"+params[4]);
		DomNro = document.getElementById("m_"+params[5]);
		DomPiso = document.getElementById("m_"+params[6]);
		DomDpto = document.getElementById("m_"+params[7]);
		CodPostal = document.getElementById("m_"+params[8]);
	}
	
	//Retorno algo?
	var nodo = xmldata.getElementsByTagName("row");
	if(nodo.length==0)
	{
		alert("No se hallan datos para el documento " + obj.value);
		quien.value = "";
		TelFax.value = "";
		DomCod.value = "";
		DomNro.value = "";
		DomPiso.value = "";
		DomDpto.value = "";
		CodPostal.value = "";
		Email.value = "";
		chg_calle(DomCod.id);
		return;
	}

	nodo = xmldata.getElementsByTagName("quien");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		quien.value = valor;
	}
		
	nodo = xmldata.getElementsByTagName("quientipodoc");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		TipoDoc.value = valor;
	}
		
	nodo = xmldata.getElementsByTagName("quientelfax");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		TelFax.value = valor;
	}
		
	nodo = xmldata.getElementsByTagName("quiendomcod");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		DomCod.value = valor;
		chg_calle(DomCod.id);
	}
	
	nodo = xmldata.getElementsByTagName("quiendomnro");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		DomNro.value = valor;
	}
	
	nodo = xmldata.getElementsByTagName("quiendompiso");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		DomPiso.value = valor;
	}
	
	nodo = xmldata.getElementsByTagName("quiendomdpto");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		DomDpto.value = valor;
	}
	
	nodo = xmldata.getElementsByTagName("quiencodpostal");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		CodPostal.value = valor;
	}
	
	nodo = xmldata.getElementsByTagName("quienemail");
	if(nodo[0].firstChild)
	{
		var valor =  nodo[0].firstChild.nodeValue;
		Email.value = valor;
	}
}


function valDNI(fldID,fldLabel) 
{
	fld = document.getElementById(fldID);
	if(fld) 
	{
		valor = fld.value;
		if(valor=="")
		{
			return "";
		}
		re = new RegExp("^[0-9]{6,8}$");
		if( re.test(valor)==true ) 
		{
			return "";
		} 
		else
		{
			return "El campo " + fldLabel + " debe contener de 6 a 8 digitos sin espacios";
		}
	} 
	else 
	{
		return "campo " + fldID + " no se encuentra";
	}
}
