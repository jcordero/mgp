
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
    
    //Minimizo el tree
    $("#m_prestacion_div").hide();
    if( $("#prestacion_cambiar").length==0 ) {
        $("#tm_prestacion").after("  <button id=\"prestacion_cambiar\" class=\"maint cancel btn\" onclick=\"cambiar_prest()\">Cambiar</button>");
    } else {
        $("#prestacion_cambiar").show();
    }
    cambio_prestacion(codigo);    
}

function cambiar_prest() {
    $("#m_prestacion_div").show();
    $("#prestacion_cambiar").hide();
}
