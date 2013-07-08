var map = null;

$(document).ready(function(){
    initialize(); 
    $('#canal').val(dash_config.canal).change(function(){dash_config.canal=$(this).val();refrescarDash();});
    $('#barrio').val(dash_config.barrio).change(function(){dash_config.barrio=$(this).val();refrescarDash();});
    $('#organismo').val(dash_config.organismo).change(function(){dash_config.organismo=$(this).val();refrescarDash();});
    $('#prestacion').val(dash_config.prestacion).change(function(){dash_config.prestacion=$(this).val();refrescarDash();});

    ejecutar_consulta(dash_config.boton);
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

var gMarkers = [];
var gMarkerCluster = {};

function ejecutar_consulta(tipo) {
    //Muestro un espera..
    $('#cargando').show();

    $('#bAbiertos').removeClass('btn-danger');
    $('#bCerrados').removeClass('btn-danger');
    $('#bVencidos').removeClass('btn-danger');

    if(tipo==="ABIERTOS")
        $('#bAbiertos').addClass('btn-danger');
    if(tipo==="CERRADOS")
        $('#bCerrados').addClass('btn-danger');
    if(tipo==="VENCIDOS")
        $('#bVencidos').addClass('btn-danger');
    
    dash_config.boton = tipo;
    refrescarDash();
}

function refrescarDash() {
    new rem_request(this,function(obj,json){
        var jdata = JSON.parse(json);
        $('#cargando').hide();
        
        //Refresco el valor de los Contadores
        $('#cAbiertos').html(jdata.contadores.abiertos);
        $('#cCerrados').html(jdata.contadores.cerrados);
        $('#cVencidos').html(jdata.contadores.vencidos);
        
        //Reseteo los markers anteriores
        if(typeof gMarkerCluster.clearMarkers === "function")
            gMarkerCluster.clearMarkers();
        gMarkers = [];
        
        //Creo los markers nuevos
        var tickets = jdata.tickets;
        for (var i = 0; i < tickets.length; i++) {
          var ticket = tickets[i];
          var latLng = new google.maps.LatLng(ticket.lat,ticket.lng);
          var marker = new google.maps.Marker({ position: latLng, title:ticket.id });
          gMarkers.push(marker);
          google.maps.event.addListener(marker, 'click', mostrar_ticket);

        }
        gMarkerCluster = new MarkerClusterer(map, gMarkers);
        gMarkerCluster.setMaxZoom(14);

    },"HOME::DASHBOARD","getTickets",JSON.stringify(dash_config));
}
    
    
function mostrar_ticket(ev) {
    var marker = this;
    $('#cargando').show();

    new rem_request(this,function(obj,html){
        var infowindow = new google.maps.InfoWindow({
            content: html
        });
        infowindow.open(map,marker);    
        $('#cargando').hide();

    },"HOME::DASHBOARD","getTicketInfo",marker.title);
}


