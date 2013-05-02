
function m_prestacion_onSelect(row)
{	
    var codigo = row.key;
    var texto = row.label;
    var type = row.type;
    var params = prestacion.m_params;

    //Hay que abrir el cuestionario, geo, etc... o es un nodo intermedio
    
    
    //Borrar el cuestionario
    var cuest = document.getElementById("m_"+ params + "_placeholder");
    $(cuest).html('');
    
    //Oculto el rubro
    var objrubro = $("#m_rubro").hide();
    var divrubro = $("#rubro").hide();
    rubro.m_mandatory = false;
    
    //Ocultar la georeferencia
    ocultar_bloques();
    
    //Pedir datos sobre detalle de prestacion
    new rem_request(this,function(obj,json){
        
        if(json==="")
        {
            alert_box("El servidor no esta respondiendo.",'Error');
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
            if( jdata[0].tpr_tipo==="DENUNCIA" )
            {
                 if(divrubro)
                 {
                    divrubro.style.display = "block";
                    rubro.m_mandatory = true;

                    //Completo el rubro
                    new rem_request(this,function(obj,json){
                        if(json==="")
                        {
                            alert_box("El servidor no esta respondiendo.",'Error');
                            return; //No hay detalle de la prestacion
                        }
                        var jdata2 = eval('(' + json + ')');
                        fillCombo(objrubro,jdata2,objrubro.id,"tru_code","","tru_detalle");    
                    },"PRESTACIONTREE","getRubroPrest",codigo);
                 }
            }

            //Tipo de domicilio
            var georef = jdata[0].tpr_ubicacion;
            var divobj = null;
            setValuePair("m_tipo_georef",georef,georef);

            if(georef==='' || georef==="DOMICILIO")
            {
                divobj = $("#bloque_domicilio").show();
                calle.m_mandatory = true;
                callenro.m_mandatory = true;
            }
            else if(georef==="VILLA")
            {
                divobj = $("#bloque_villa").show();
                villa.m_mandatory = true;
            }
            else if(georef==="PLAZA")
            {
                divobj = $("#bloque_plaza").show();
                plaza.m_mandatory = true;
            }
            else if(georef==="CEMENTERIO")
            {
                divobj = $("#bloque_cementerio").show();
                cementerio.m_mandatory = true;
            }
            else if(georef==="ORGAN.PUBLICO")
            {
                divobj = $("#bloque_orgpublico").show();
                orgpublico.m_mandatory = true;
            }
            else if(georef==="LUMINARIA")
            {
                divobj = $("#bloque_luminaria").show();
                calle_lum.m_mandatory = true;
                callenro_lum.m_mandatory = true;
                id_luminaria.m_mandatory = true;
                
                //Activo el mapa interactivo en el centro de MDQ
                $('#m_mapa_lum').html('');
                mapa_luminaria = L.map('m_mapa_lum').setView([-38.0086358938483,-57.5388003290637], 13);
                
                // add an OpenStreetMap tile layer
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(mapa_luminaria);                
            }
        }

        //Cargar el cuestionario
        if(cuest && jdata[1])
        {
            cuest.innerHTML = jdata[1];
        }
    
    },"PRESTACIONTREE","getDetails",codigo);
    
}


function ocultar_bloques()
{
    //Oculto todos los bloques
    var divdomicilio = document.getElementById("bloque_domicilio");
    if(divdomicilio)
    {
    	$(divdomicilio).hide();
    	calle.m_mandatory = false;
    	callenro.m_mandatory = false;	
    	calle2.m_mandatory = false;
    }
    
    var divvilla = document.getElementById("bloque_villa");
    if(divvilla)
    {
    	$(divvilla).hide();
    	villa.m_mandatory = false;
    }
    
    var divplaza = document.getElementById("bloque_plaza");
    if(divplaza)
    {
    	$(divplaza).hide();
    	plaza.m_mandatory = false;
    }
    
    var divcementerio = document.getElementById("bloque_cementerio");
    if(divcementerio)
    {
    	$(divcementerio).hide();
    	cementerio.m_mandatory = false;
    }
    
    var divorgpublico = document.getElementById("bloque_orgpublico");
    if(divorgpublico)
    {
    	$(divorgpublico).hide();
    	orgpublico.m_mandatory = false;
    }

    var divluminaria = document.getElementById("bloque_luminaria");
    if(divluminaria)
    {
    	$(divluminaria).hide();
        calle_lum.m_mandatory = false;
        callenro_lum.m_mandatory = false;
        id_luminaria.m_mandatory = false;
        calle2_lum.m_mandatory = false;
    }

    
}