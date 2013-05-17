
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
}
    
function ejecutar_consulta() {
    var barrio = $('#m_tmp_barrio').val();
    var fecha_desde  = $('#m_tmp_fecha').val();
    var fecha_hasta  = $('#hm_tmp_fecha').val();
    new rem_request(this,function(obj,json){
        var jdata = JSON.parse(json);

        var markers = [];
        for (var i = 0; i < jdata.length; i++) {
          var ticket = jdata[i];
          var latLng = new google.maps.LatLng(ticket.lat,ticket.lng);
          var marker = new google.maps.Marker({ position: latLng });
          markers.push(marker);
        }
        var markerCluster = new MarkerClusterer(map, markers);

    },"REPORTES::REPORTES","getTickets",barrio+'|'+fecha_desde+'|'+fecha_hasta);
}
    
    
    
    