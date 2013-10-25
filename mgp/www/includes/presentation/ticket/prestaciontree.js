
function m_prestacion_onSelect(row)
{	
    var codigo = row.key;
    //var texto = row.label;
    //var type = row.type;
    var params = prestacion.m_params;

    //Hay que abrir el cuestionario, geo, etc... o es un nodo intermedio
   
    //Borrar el cuestionario
    var cuest = document.getElementById("m_"+ params + "_placeholder");
    $(cuest).html('');
    
    //Oculto el rubro
    $("#m_rubro").hide();
    $("#rubro").hide();
    rubro.m_mandatory = false;
    
    cambio_prestacion(codigo);    
}


