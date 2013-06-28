var map = null;

$(document).ready(function(){
    initialize(); 
    ejecutar_consulta();
});

function initialize() {
    var center = new google.maps.LatLng(-37.995114083904, -57.544226218087);

    map = new google.maps.Map(document.getElementById('reporte_mapa'), {
      zoom: 14,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl: true
    });

}


function ejecutar_consulta() {
    
    new rem_request(this,function(obj,json){
        var jdata = JSON.parse(json);

        //Contadores
        $('#cAbiertos').html(jdata.contadores.abiertos);
        $('#cCerrados').html(jdata.contadores.cerrados);
        $('#cVencidos').html(jdata.contadores.vencidos);
        
        var tickets = jdata.tickets;
        var markers = [];
        for (var i = 0; i < tickets.length; i++) {
          var ticket = tickets[i];
          var latLng = new google.maps.LatLng(ticket.lat,ticket.lng);
          var marker = new google.maps.Marker({ position: latLng, title:ticket.id });
          markers.push(marker);
          google.maps.event.addListener(marker, 'click', mostrar_ticket);

        }
        var markerCluster = new MarkerClusterer(map, markers);
        markerCluster.setMaxZoom(14);

    },"HOME::DASHBOARD","getTickets",'');
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


