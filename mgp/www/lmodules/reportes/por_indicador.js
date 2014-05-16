$(document).ready(function(){
    completar_html(); 
});

function completar_html() {
    $('#payload').append('<div id="reporte_ind"></div>');
    $('#actionSubmit').attr('onclick',null).click(ejecutar_consulta);
    $('#actionSubmit').html('Reportar');
    $('#bloque_filtro .titulo').addClass('accordion-heading').html('<a class="titulo_texto" href="#" onclick="plegar()">Filtro</a>');
    $('#bloque_filtro .contenido').addClass('accordion-body');
    $('#bloque_filtro').addClass('accordion');
}
    
function plegar() {
    $('#bloque_filtro .contenido').collapse('toggle');
}   


function ejecutar_consulta() {
    var barrio = $('#m_tmp_barrio').val();
    var fecha_desde  = $('#m_tmp_fecha').val();
    var fecha_hasta  = $('#hm_tmp_fecha').val();
    var prestacion = $('#m_tmp_prestacion').val();
    var estado_ticket = $('#m_tmp_estado_ticket').val();
    var estado_prestacion = $('#m_tmp_estado_prestacion').val();
    var canal = $('#m_tmp_canal').val();
    var organismo = $('#m_tmp_organismo').val();
    var params = {'barrio':barrio, 'fecha_desde':fecha_desde, 'fecha_hasta':fecha_hasta, 'prestacion':prestacion, 'estado_ticket':estado_ticket, 'estado_prestacion':estado_prestacion, 'canal':canal, 'organismo':organismo };
    
    $('#bloque_filtro .contenido').collapse('hide');
    
    new p4.rem_request(this,function(obj,json){
        var jdata = JSON.parse(json);

        //Hago el grafico
        $('#reporte_ind').highcharts(jdata);
        
    },"REPORTES::REPORTES","getIndicadores", JSON.stringify(params));
}
