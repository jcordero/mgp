$(document).ready(function(){
    var id = unescape(window.location.hash).replace('/',' ').substr(1);
    var p =id.split(' ');
    if(p.length!==3)
        return;
    
    var tipo = p[0];
    var nro  = p[1];
    var anio = p[2];
    var url = "http://147.mardelplata.gob.ar/mgp/webservices/tickets/"+tipo+"/"+anio+"/"+nro;
    
    $('#titulo').html(tipo+' '+nro+'/'+anio);
    
    //Recupero el ticket
    $.ajax({
        url : url,
        dataType : 'jsonp'
    }).done(function(json) {
        var resultado = JSON.parse(json);
        var ticket = resultado.ticket;
        
        var t = '<div class="row"><div class="span8">';
    
        if(ticket.prestaciones.length>0)
            t+='<h3>Prestación: '+ticket.prestaciones[0].tpr_description+'</h3>';

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
        t+=' Estado: <span class="label label-success">'+ticket.tic_estado+'</span> Ingresado: '+ISO8601toString(ticket.tic_tstamp_in)+'</p>';

        //Actividad
        t+='<h3>Actividad</h3>' + generarHTMLdeActividad(ticket.prestaciones[0].avance) + '</div>';

        //Fotos (span 4) (cierro row)        
        t+='<div class="span4"><h3>Fotos</h3>'+ generarHTMLdeFotos(ticket.archivos) +'</div></div>';
        
        $('#ticket').html(t);
        
        //Dibujo los mapas
        $('.mapa').each(function(){
            var mapa = $(this);
            var lat = mapa.attr('data-lat');
            var lng = mapa.attr('data-lng');
            var w = ( mapa.width()<640 ? mapa.width() : 640 );
            mapa.append('<img src="http://maps.googleapis.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=17&size='+w+'x200&maptype=roadmap&markers=color:blue%7Clabel:%7C'+lat+','+lng+'&sensor=false">');
        });
        
        //Activo las fotos
        $('#myCarousel').carousel();

    }).error(function(err){
        var resultado = JSON.parse(err.responseText);
        $('#ticket').html('<p>'+resultado.error+'</p>');
    });
});

function ISO8601toString(fecha) {
    var fh = fecha.split('T');
    var f = fh[0];
    var h = (fh.length===2 ? fh[1] : '');
    var r = f.substr(6,2) + '/' + f.substr(4,2) + '/' + f.substr(0,4);
    if(h!=='')
        r+=' '+ h.substr(0,2) + ':' + h.substr(2,2) + ':' + h.substr(4,2);
    return r;
}

function generarHTMLdeActividad(act) {
    var a = '<table class="table table-striped"><thead><tr><th>Fecha</th><th>Estado</th><th>Nota</th></tr></thead><tbody>';
    for(var j=0;j<act.length;j++) {
        a+='<tr><td>'+ ISO8601toString(act[j].tav_tstamp_in) + '</td><td>' + act[j].tic_estado_in + '</td><td>' + act[j].tav_nota + '</td></tr>';
    }
    a+='</table>';
    return a;
}

function generarHTMLdeFotos(fotos) {
    var f = '<div id="myCarousel" class="carousel slide"><ol class="carousel-indicators">';
    for(var j=0;j<fotos.length;j++) {
        var active = (j===0 ? ' class="active"' : '');
        f+='<li data-target="#myCarousel" data-slide-to="'+j+'"'+active+'></li>';
    }
    f+='</ol>';
  
    //<!-- Carousel items -->
    f+='<div class="carousel-inner">';
    for(var j=0;j<fotos.length;j++) {
        var active = (j===0 ? 'active ' : '');
        f+='<div class="'+active+'item"><center><img src="http://mgp/mgp/webservices/foto/'+fotos[j].doc_storage+'"></center>';
        f+='<div class="carousel-caption">'+fotos[j].doc_note+'</div></div>';
    }
    f+='</div>';
  
    //<!-- Carousel nav -->
    f+='<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a></div>';
    return f;
}