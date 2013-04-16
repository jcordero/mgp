
function m_prestacion_onSelect(row)
{	
    var codigo = row.key;
    var texto = row.label;
    var type = row.type;
    if( codigo.length<4 )
    {
        return;
    }	
    var params = prestacion.m_params;
		
    //Borrar el cuestionario
    var cuest = document.getElementById("m_"+ params + "_placeholder");
    if(cuest)
    {
        cuest.innerHTML = "";
    }
    
    //Oculto el rubro
    var objrubro = document.getElementById("m_rubro");
    var divrubro = document.getElementById("rubro");
    if(divrubro)
    {
        divrubro.style.display = "none";
        rubro.m_mandatory = false;
    }

    //Ocultar la georeferencia
    ocultar_bloques();
    
    //Pedir datos sobre detalle de prestacion
    var json = rem_sync_request("PRESTACIONTREE","getDetails",codigo);
    if(json=="")
	{
    	alert("El servidor no esta respondiendo.");
		return; //No hay detalle de la prestacion
	}
    var jdata = eval('(' + json + ')');
  	if(!jdata)
	{
		return; //No hay detalle de la prestacion
	}
    else
    {
        //Activar el rubro si es una DENUNCIA
        if( jdata[0].tpr_tipo=="DENUNCIA" )
        {
             if(divrubro)
             {
                divrubro.style.display = "block";
                rubro.m_mandatory = true;
     
                //Completo el rubro
                json = rem_sync_request("PRESTACIONTREE","getRubroPrest",codigo);
                if(json=="")
            	{
                	alert("El servidor no esta respondiendo.");
            		return; //No hay detalle de la prestacion
            	}
                var jdata2 = eval('(' + json + ')');
                fillCombo(objrubro,jdata2,objrubro.id,"tru_code","","tru_detalle");
             }
        }

        //Tipo de domicilio
        var georef = jdata[0].tpr_ubicacion;
        var divobj = null;
    	setValuePair("m_tipo_georef",georef,georef);

        if(georef=="" || georef=="DOMICILIO")
        {
        	divobj = document.getElementById("bloque_domicilio");
        	calle.m_mandatory = true;
        	callenro.m_mandatory = true;
        }
        else if(georef=="VILLA")
        {
        	divobj = document.getElementById("bloque_villa");
        	villa.m_mandatory = true;
        }
        else if(georef=="PLAZA")
        {
        	divobj = document.getElementById("bloque_plaza");
        	plaza.m_mandatory = true;
        }
        else if(georef=="CEMENTERIO")
        {
        	divobj = document.getElementById("bloque_cementerio");
        	cementerio.m_mandatory = true;
        }
        else if(georef=="ORGAN.PUBLICO")
        {
        	divobj = document.getElementById("bloque_orgpublico");
        	orgpublico.m_mandatory = true;
        }
        
        if(divobj)
        {
        	divobj.style.display = "block";
        }
    }

    //Cargar el cuestionario
    if(cuest && jdata[1])
    {
        cuest.innerHTML = jdata[1];
    }
}


function ocultar_bloques()
{
	//Oculto todos los bloques
	var divdomicilio = document.getElementById("bloque_domicilio");
    if(divdomicilio)
    {
    	divdomicilio.style.display = "none";
    	calle.m_mandatory = false;
    	callenro.m_mandatory = false;	
    }
    
    var divvilla = document.getElementById("bloque_villa");
    if(divvilla)
    {
    	divvilla.style.display = "none";
    	villa.m_mandatory = false;
    }
    
    var divplaza = document.getElementById("bloque_plaza");
    if(divplaza)
    {
    	divplaza.style.display = "none";
    	plaza.m_mandatory = false;
    }
    
    var divcementerio = document.getElementById("bloque_cementerio");
    if(divcementerio)
    {
    	divcementerio.style.display = "none";
    	cementerio.m_mandatory = false;
    }
    
    var divorgpublico = document.getElementById("bloque_orgpublico");
    if(divorgpublico)
    {
    	divorgpublico.style.display = "none";
    	orgpublico.m_mandatory = false;
    }
        
    //Saco las validaciones
    
}