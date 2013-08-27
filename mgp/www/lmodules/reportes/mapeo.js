
$(document).ready(function(){
    completar_html();
    initialize(); 
});

var map = null;

function initialize() {
    var center = new google.maps.LatLng(-37.995114083904, -57.544226218087);

    map = new google.maps.Map(document.getElementById('reporte_mapa'), {
      zoom: 14,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl: true
    });

}

function completar_html() {
    $('#payload').append('<div id="reporte_mapa"></div>');
    $('#actionSubmit').attr('onclick',null).click(ejecutar_consulta);
    $('#actionSubmit').html('Graficar');
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
    var vencidos = $('#m_tmp_vencido:checked').val();
    var params = {'barrio':barrio, 'fecha_desde':fecha_desde, 'fecha_hasta':fecha_hasta, 'prestacion':prestacion, 'estado_ticket':estado_ticket, 'estado_prestacion':estado_prestacion, 'canal':canal, 'organismo':organismo, 'vencidos':vencidos };
    
    $('#bloque_filtro .contenido').collapse('hide');
    
    new rem_request(this,function(obj,json){
        var jdata = JSON.parse(json);

        var markers = [];
        for (var i = 0; i < jdata.length; i++) {
          var ticket = jdata[i];
          var latLng = new google.maps.LatLng(ticket.lat,ticket.lng);
          var marker = new google.maps.Marker({ position: latLng, title:ticket.id });
          markers.push(marker);
          google.maps.event.addListener(marker, 'click', mostrar_ticket);

        }
        var markerCluster = new MarkerClusterer(map, markers);

    },"REPORTES::REPORTES","getTickets",JSON.stringify(params));
}
    
    
function mostrar_ticket(ev) {
    var marker = this;
    new rem_request(this,function(obj,html){
        var infowindow = new google.maps.InfoWindow({
            content: html
        });
        infowindow.open(map,marker);    
    },"REPORTES::REPORTES","getTicketInfo",marker.title);
}
    
    