$(document).ready(function(){
    
    //Opciones
    var url = 'http://147.mardelplata.gob.ar/mgp/webservices/maestro/paises'; 
    $.ajax({
        url : url,
        dataType : 'jsonp'
    }).done(function(json) {
        var paises = JSON.parse(json);
        var p = '';
        var pl = paises.maestro.length;
        for(var j=0;j<pl;j++) {
            p += '<option value="'+paises.maestro[j].cod+'">'+paises.maestro[j].nombre; 
        }
        $('#pais').append(p).val( $('#pais').attr('data-selected') );
    });
    
    $('#documento').append('<option value=\"DNI\">DNI<option value=\"LE\" >LE<option value=\"LC\" >LC<option value=\"PAS\">PAS<option value=\"CI\" >CI<option value=\"PRE\">PRE');
    
    //Boton BUSCAR
    $('#buscar').click(function(){
        
        //Pido los tickets
        var pais = $('#pais').val();
        var documento = $('#documento').val();
        var numero = $('#numero').val();
        var url = 'http://147.mardelplata.gob.ar/mgp/webservices/ciudadanos/'+pais+'/'+documento+'/'+numero;
        $.ajax({
            url : url,
            dataType : 'jsonp'
        }).done(function(json) {
            var perfil = JSON.parse(json);
                        
            //Completo datos del ciudadano
            var c = 'Tickets de ' + perfil.ciudadano.ciu_nombres + ' ' + perfil.ciudadano.ciu_apellido;
            $('#ciudadano').html(c);
            
            //Completo los datos de los tickets (3 por fila)
            var col = 0;
            var t = '<div class="row-fluid">';
            for(var j=0; j<perfil.ciudadano.tickets.length; j++) {
                
                //Dibujo la pastilla del ticket
                t+=generarHTMLdeTicket(perfil.ciudadano.tickets[j]);
                
                //Cambio de fila
                col++;
                if(col===3) {
                    t+='</div><div class="row-fluid">';
                    col=0;
                }
            }
            
            //Cierre ultima fila
            t+='</div>';
            
            $('#tickets').html(t);
            
            //Dibujo los mapas
            $('.mapa').each(function(){
                var mapa = $(this);
                var lat = mapa.attr('data-lat');
                var lng = mapa.attr('data-lng');
                var w = mapa.width();
                mapa.append('<img src="http://maps.googleapis.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=17&size='+w+'x200&maptype=roadmap&markers=color:blue%7Clabel:%7C'+lat+','+lng+'&sensor=false">');
            });
        }).error(function(err){
            var perfil = JSON.parse(err.responseText);
            
            $('#ciudadano').html(perfil.error);
            $('#tickets').html('');
            return;
        });
    });
});

function generarHTMLdeTicket(ticket) {
    var t = '<div class="span4"><h2>'+ticket.tic_identificador+'</h2>';
    
    if(ticket.prestaciones.length>0)
        t+='<p>Prestación: '+ticket.prestaciones[0].tpr_description+'</p>';
    
    
    //Direccion
    if(ticket.tic_lugar) {
        t+='<p>En '+ ticket.tic_lugar.calle_nombre + ' ' + ticket.tic_lugar.callenro +'</p>';
    
        //Mapa
        if(ticket.tic_lugar.lat)
            t+='<div class="mapa" data-lat="'+ticket.tic_lugar.lat+'" data-lng="'+ticket.tic_lugar.lng+'"></div>';
    }
    
    //Nota
    t+='<p>Nota: '+ ticket.tic_nota_in +'</p>';
    
    //Estado
    t+=' Estado: '+ticket.tic_estado+'</p>';
    
    //Link a detalles
    t+='<p><a class="btn" href="ticket.html#'+escape(ticket.tic_identificador)+'">Ver detalles &raquo;</a></p></div>';
    return t;
}
