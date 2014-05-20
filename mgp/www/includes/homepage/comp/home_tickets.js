$(document).ready(function(){
    //Recupero los tickets para los organismos del usuario
    mostrarPagina(1,"ABIERTOS");
    $('#buscador button').on("click",buscar);
});
                    
var mostrarPaginaBusy = false;
var pagnro = 1;
var filtro = "";

function mostrarPagina(nro,filt) {
    if(mostrarPaginaBusy)
        return;
    mostrarPaginaBusy = true;

    pagnro = nro;

    var b = $("#mis_tickets tbody").html("");
    $("#carga_tickets").show();
    $("#mi_titulo").html("Cargando tickets...");
    $("#sin_tickets").hide();

    //Cambio de color el filtro
    if(filtro!=filt) {
        filtro = filt;
        pagnro = 1;
        $('#abiertos').removeClass('btn-danger');
        $('#cerrados').removeClass('btn-danger');
        $('#vencidos').removeClass('btn-danger');

        if(filtro=="ABIERTOS") {
            $('#abiertos').addClass('btn-danger');
        }
        if(filtro=="CERRADOS") {
            $('#cerrados').addClass('btn-danger');
        }
        if(filtro=="VENCIDOS") {
            $('#vencidos').addClass('btn-danger');
        }
    }
    
    var params = pagnro+"|"+filtro+"|"+buscar;
    new p4.rem_request(this,function(obj,json){
        var obj = JSON.parse(json);
        var o = obj.tickets;
        var l = o.length;
        for(var j=0;j<l;j++) {
            var est_prest = (o[j].estado_prest=="resuelto" ? " badge-success" : " badge-warning");
            var v = parseInt(o[j].vencido);
            var vencido = v>0 ? '<br><span class="badge badge-important">Vencido '+v+(v===1 ? ' día' : ' días')+'</span>' : '';
            
            var h = "<tr><td style=\"width:150px;font-size:0.8em;\">Ingreso:<br>" + o[j].fecha + "<br>Estimado:<br>" + o[j].plazo + "<br><b>" + o[j].identificador +"</b>"+ vencido+"</td>" +
                    "<td><span style=\"font-size:1.1em;\">" + o[j].prestacion + "</span><br><span class=\"it\">" + o[j].nota + "</span></td>" +
                    "<td>" + o[j].texto_dir + "</td>" +
                    "<td>" + renderEstado( o[j].estado_prest ) + "<br>" + o[j].rol + "</td>" +
                    "<td><button style=\"width:100px;\" class=\"btn btn-sm\" onclick=\"trabajar(\'" + o[j].ticket + "\')\"><i class=\"icon-wrench\"></i> Trabajar</button><br><br> " + renderDireccion(o[j].direccion) + 
                    "</td></tr>";
            b.append(h);
        }

        if(l==0) {
            $("#sin_tickets").html("Sin tickets "+filtro).show();
        }
        $("#mis_tickets .mapa").popover();
        $("#carga_tickets").hide();
        $("#mi_titulo").html(obj.titulo);
        
        //Cantidad de paginas
        $('#nro_pagina').html(nro);
        $('#total_paginas').html(obj.paginas);
        
        renderPaginador(nro,obj.paginas);
        mostrarPaginaBusy = false;
    },"TICKET::TICKETS","crearPagina",params);    
}
                    
function renderDireccion(o) {
    if(o && o.lat && o.lng) {
        var mapa = "<div style='width:250px;height:250px;'><img id='mapa' src='" + sess_web_path + "/common/mapa.php?x=" + o.lat + "&y=" + o.lng + "&w=250&h=250&r=250'></div>";
        var d = " <button style=\"width:100px;\" class=\"btn btn-sm mapa\" data-toggle=\"popover\" title=\"Ubicación\" data-html=\"true\" data-content=\"" + mapa + "\" ><i class=\"icon-globe\"></i> Mapa</button>";
        
        return d;
    } 
    return "Sin dirección";
}

var trabajarBusy = false;
function trabajar(ticket) {
    if(trabajarBusy)
        return;
    trabajarBusy = true;

    new p4.rem_request(this,function(obj,json){
        document.location.href = json;
    },"TICKET::TICKETS","updateTicket",ticket);
}

function renderPaginador(pag,total) {
    var h = '';
    //Tiene boton atras?
    if(pag>1)
        h+='<button onclick="mostrarPagina(pagnro-1,filtro)"><<</button>';
    
    //Tiene boton primera pagina
    if(pag>5)
        h+='<button onclick="mostrarPagina(1,filtro)">1</button> ... ';
        
    //Botones intermedios (son 5)
    if(pag>=3 && pag<total-2) {
        for(var j=pag-2;j<=pag+2;j++)
            h+='<button onclick="mostrarPagina('+j+',filtro)">'+j+'</button>';
    }
    else {
        if(pag<3) {
            for(var j=1;j<=5 && j<=total;j++)
                h+='<button onclick="mostrarPagina('+j+',filtro)">'+j+'</button>';
        }
        else {
            for(var j=pag-4;j<=total;j++)
                h+='<button onclick="mostrarPagina('+j+',filtro)">'+j+'</button>';            
        }
    }
    
    //tiene boton ultima pagina
    if(pag+2<total)
        h+=' ... <button onclick="mostrarPagina('+total+',filtro)">'+total+'</button>';
        
    //Tiene boton adelante?
    if(total>pag)
        h+='<button onclick="mostrarPagina(pagnro+1,filtro)">>></button>';
    
    $('#navegador').html(h);
}

function renderEstado(estado) {
    var c = "";
    switch(estado) {
        case "pendiente":
            c = "";
            break;
        case "en curso":
            c = "badge-info";
            break;
        case "en espera":
            c = "badge-warning";
            break;
        case "rechazado":
            c = "badge-important";
            break;
        case "rechazado indebido":
            c = "badge-important";
            break;
        case "finalizado":
            c = "badge-success";
            break;
        case "resuelto":
            c = "badge-success";
            break;
    }
    return "<span class=\"badge "+c+"\">" + estado + "</span>";
}

function buscar() {
    var t = $('#buscador input').val();
    if(t!='') {
        alert('Buscar: '+t);
    }
}