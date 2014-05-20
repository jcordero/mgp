var map = null;

$(document).ready(function(){
    initialize(); 
    
    $('#canal')
            .val(dash_config.canal)
            .change(function(){
                dash_config.canal=$(this).val();
                dibujar_filtros();
                refrescarDash();
            });
    $('#barrio')
            .val(dash_config.barrio)
            .change(function(){
                dash_config.barrio=$(this).val();
                dibujar_filtros();
                refrescarDash();
            });
    $('#organismo')
            .val(dash_config.organismo.codigo)
            .change(function(){
                dash_config.organismo.codigo=$(this).val();
                dash_config.organismo.nombre=$(this).children(':selected').text();
                dibujar_filtros();
                refrescarDash();
            });
    $('#prestacion')
            .val(dash_config.prestacion.codigo)
            .change(function(){
                dash_config.prestacion.codigo=$(this).val();
                dash_config.prestacion.nombre=$(this).children(':selected').text();
                dibujar_filtros();
                refrescarDash();
            });

    dibujar_filtros();
    $("#filtros button").on("click",function(){
        $("#filtro_dialog").modal('show');
    });
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

function dibujar_filtros() {
    var h = '<div class="row">'+
            '   <div class="col-xs-6">Canal: '+(dash_config.canal=="" ? "todos" : dash_config.canal)+'</div>' +
            '   <div class="col-xs-6">Barrio: '+(dash_config.barrio=="" ? "todos" : dash_config.barrio)+'</div>' +
            '</div>'+
            '<div class="row">'+
            '   <div class="col-xs-6">Organismo: '+(dash_config.organismo.codigo=="" ? "todos" : dash_config.organismo.nombre)+'</div>' +
            '   <div class="col-xs-6">Prestación: '+(dash_config.prestacion.codigo=="" ? "todos" : dash_config.prestacion.nombre)+'</div>'+
            '</div>';
    $("#filtros .actuales").html(h);
}

var gMarkers = [];
var gMarkerCluster = {};

function ejecutar_consulta(tipo) {
    //Muestro un espera..
    $('#cargando').show();

    $('#bAbiertos').removeClass('btn-danger');
    $('#bCerrados').removeClass('btn-danger');
    $('#bVencidos').removeClass('btn-danger');

    switch(tipo) {
        case "ABIERTOS":
            $('#bAbiertos').addClass('btn-danger');
            break;
        case "CERRADOS":
            $('#bCerrados').addClass('btn-danger');
            break;
        case "VENCIDOS":
            $('#bVencidos').addClass('btn-danger');
            break;
        default:
            console.error("home_dashboard ejecutar_consulta() tipo no conocido ["+tipo+"]");
    }
    dash_config.boton = tipo;
    
    refrescarDash();
}

function refrescarDash() {
    $('#cargando').show();
    new p4.rem_request(this,function(obj,json){
        $('#cargando').hide();
        var jdata = JSON.parse(json);
        
        //Refresco el valor de los Contadores
        $('#cAbiertos').html(jdata.contadores.abiertos);
        $('#cCerrados').html(jdata.contadores.cerrados);
        $('#cVencidos').html(jdata.contadores.vencidos);
        
        //Reseteo los markers anteriores
        if(typeof gMarkerCluster.clearMarkers === "function"){
            gMarkerCluster.clearMarkers();
        }
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

    new p4.rem_request(this,function(obj,html){
        var infowindow = new google.maps.InfoWindow({
            content: html
        });
        infowindow.open(map,marker);    
        $('#cargando').hide();

    },"HOME::DASHBOARD","getTicketInfo",marker.title);
}


