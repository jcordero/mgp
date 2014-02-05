
function m_prestacion_onSelect(row)
{	
    var codigo = row.key;
   
    //Minimizo el tree
    $("#m_prestacion_div").hide();
    
    //Si no existe el boton CAMBIAR lo creo
    if( $("#prestacion_cambiar").length==0 ) {
        $("#tm_prestacion").after("  <button id=\"prestacion_cambiar\" class=\"maint cancel btn\" onclick=\"cambiar_prest()\"><i class=\"icon-pencil\"></i> Cambiar</button>");
    } else {
        $("#prestacion_cambiar").show();
    }
    
    //Ejecuto todo lo que haga falta una vez elegida la prestacion (ver tickets_maint_n.js)
    cambio_prestacion(codigo);    
}

function cambiar_prest() {
    $("#m_prestacion_div").show();
    $("#prestacion_cambiar").hide();
}
