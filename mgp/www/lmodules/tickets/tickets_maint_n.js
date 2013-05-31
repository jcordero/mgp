var last_marker_clicked = null;
var luminariaOnIcon = null;
var luminariaIcon = null;
var mapa_luminaria = {};
var mapa_domicilio = {};
var lista_luminarias = [];
var marker_domicilio = null;
var marker_luminarias = null;

$(document).ready(function() {
    
    var divrubro = $("#rubro");
    if(divrubro.length===1)
    {
        divrubro.hide();
        rubro.m_mandatory = false;
    }
    
    //campos extra en las direcciones
    $('#alternativa .fldm').append('<div class="fldl"></div>');
    $('#calle .fldm').append('<div class="fldl"></div>');
    $('#calle2 .fldm').append('<div class="fldl"></div>');
    $('#callenro .fldm').append('<div class="fldl"></div>');
    $('#piso .fld').append('<div class="fldl"></div>');
    $('#dpto .fld').append('<div class="fldl"></div>');

    //campos extra en las luminarias 
    $('#alternativa_lum .fldm').append('<div class="fldl"></div>');
    $('#calle_lum .fldm').append('<div class="fldl"></div>');
    $('#callenro_lum .fldm').append('<div class="fldl"></div>');
    $('#calle2_lum .fldm').append('<div class="fldl"></div>');
    
    /* Boton de validar la direccion */
    $('#contenido_domicilio').after(
            '<div><button class="btn" id="valida_direccion">Validar Dirección</button> <button class="btn hide" id="cambia_direccion">Cambiar Dirección</button></div>');
    
    /* Boton de validar la direccion en luminarias */
    $('#contenido_luminaria').after(
            '<div><button class="btn" id="valida_direccion_lum">Validar Dirección</button> <button class="btn hide" id="cambia_direccion_lum">Cambiar Dirección</button></div>');
    
    /* Opcion de escribir la direccion */
    $('#m_alternativa').change(function(){
        if( $(this).val()==='NRO' ) {
            $('#calle2').hide();
            $('#callenro').show();
            callenro.m_mandatory = true;
            calle2.m_mandatory = false;
        } else {
            $('#callenro').hide();
            $('#calle2').show();
            callenro.m_mandatory = false;
            calle2.m_mandatory = true;
        }
        $('#m_calle2').val('');
        $('#m_callenro').val('');
    });

    /* Opcion de escribir la direccion en Luminarias */
    $('#m_alternativa_lum').change(function(){
        if( $(this).val()==='NRO' ) {
            $('#calle2_lum').hide();
            $('#callenro_lum').show();
            callenro_lum.m_mandatory = true;
            calle2_lum.m_mandatory = false;
        } else {
            $('#callenro_lum').hide();
            $('#calle2_lum').show();
            callenro_lum.m_mandatory = false;
            calle2_lum.m_mandatory = true;
        }         
        $('#m_calle2_lum').val('');
        $('#m_callenro_lum').val('');
    });

    $('#valida_direccion').click(valida_direccion);
    $('#cambia_direccion').hide().click(cambia_direccion);
    
    $('#valida_direccion_lum').click(valida_direccion_lum);
    $('#cambia_direccion_lum').hide().click(cambia_direccion_lum);
    
    luminariaOnIcon = L.icon({
        iconUrl:    sess_web_path+'/images/mapicons/luminaria_on.png',
        iconSize:     [32, 37], // size of the icon
        iconAnchor:   [16, 38], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    luminariaIcon = L.icon({
        iconUrl:    sess_web_path+'/images/mapicons/luminaria.png',
        iconSize:     [32, 37], // size of the icon
        iconAnchor:   [16, 38], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

});


/* ---------- SECCION DOMICILIO -------------------------*/

function valida_direccion() {
    var calle = $('#m_calle').val();
    var calle2 = $('#m_calle2').val();
    var altura = $('#m_callenro').val();
    var alternativa = $('#m_alternativa').val();
    	
    if(calle.length!==5) {
        alert_box('Debe completar la calle antes de validar la dirección');
    return;
    }

    if(altura==='' && alternativa==='NRO') {
        alert_box('Debe completar la altura antes de validar la dirección');
        return;
    }

    if(calle2.length!==5 && alternativa==='CALLE') {
        alert_box('Debe completar la calle que cruza antes de validar la dirección');
        return;
    }

    $('#m_mapa').parent().append('<div id="progress1" class="progress progress-striped active"><div class="bar" style="width:100%;"></div></div>');

    new rem_request(this,function(obj,json){
            var o = JSON.parse(json);
            $('#progress1').remove();
            if(o.resultado==='ok') {
                //Actualizo los valores
                $('#m_tic_coordx').val(o.latitud);
                $('#m_tic_coordy').val(o.longitud);
                $('#m_tic_barrio').val(o.barrio);
                $('#lm_tic_barrio').html(o.barrio);

                $('#m_calle').val(o.cod_calle);
                $('#hm_calle').val(o.calle);
                $('#m_calle_nombre').val(o.calle);

                $('#m_calle2').val(o.cod_calle2);
                $('#hm_calle2').val(o.calle2);
                $('#m_calle_nombre2').val(o.calle2);

                //Cargo el mapa estatico 350 x 250px
                /* GoogleMaps
                 * $('#m_mapa img').attr('src','http://maps.googleapis.com/maps/api/staticmap?center='+o.longitud+','+o.latitud+'&zoom=17&size=350x250&maptype=roadmap&markers=color:blue%7Clabel:%7C'+o.longitud+','+o.latitud+'&sensor=false');
                 * 
                 * OpenStreetMap
                 * $('#m_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + o.latitud + "&y=" + o.longitud + "&w=350&h=250&r=250");
                 */
                //$('#m_mapa img').attr('src','http://maps.googleapis.com/maps/api/staticmap?center='+o.latitud+','+o.longitud+'&zoom=17&size=350x250&maptype=roadmap&markers=color:blue%7Clabel:%7C'+o.latitud+','+o.longitud+'&sensor=false');
                
                mapa_domicilio.setView([o.latitud,o.longitud],18);
                if(marker_domicilio===null)
                    marker_domicilio = L.marker([o.latitud,o.longitud]).addTo(mapa_domicilio).bindPopup(o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : ''));
                else
                    marker_domicilio.setLatLng([o.latitud,o.longitud]).unbindPopup().bindPopup(o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : '')).update();
                
                direccion_validada();
            }
            else
            {
                alert_box("La dirección indicada no existe", "Validar dirección");
            }
    },"TICKET::DIRECCION","validarDireccion", calle+'|'+calle2+'|'+altura+'|NO|'+alternativa);
}


function cambia_direccion() {
    //Oculto los campos read only
    $('#calle .fldl').hide();
    $('#callenro .fldl').hide();
    $('#piso .fldl').hide();
    $('#dpto .fldl').hide();

    //Muestro los campo editables
    $('#alternativa').show();
    $('#calle .fldm input').show();
    $('#calle .fldm img').show();
    $('#callenro .fldm input').show();
    $('#piso .fld input').show();
    $('#dpto .fld input').show();
    $('#calle2 .fldm input').show();
    $('#calle2 .fldm img').show();
    $('#callenro2 .fldm input').show();

    //Muestro los botones
    $('#cambia_direccion').hide();
    $('#valida_direccion').show();
    
    //Reseteo el mapa
    mapa_domicilio = crearMapa('m_mapa');
}


function direccion_validada() {
    //Oculto la calle y altura
    $('#alternativa').hide();
    $('#calle .fldm input').hide();
    $('#calle .fldm img').hide();
    $('#callenro .fldm input').hide();
    $('#piso .fld input').hide();
    $('#dpto .fld input').hide();
    $('#calle2 .fldm input').hide();
    $('#calle2 .fldm img').hide();
   
    //Pongo los campos ReadOnly
    $('#calle .fldl').html( $('#hm_calle').val() ).show();
    $('#callenro .fldl').html( $('#m_callenro').val() ).show();
    $('#piso .fldl').html( $('#m_piso').val() ).show();
    $('#dpto .fldl').html( $('#m_dpto').val() ).show();
    $('#calle2 .fldl').html( $('#hm_calle2').val() ).show();

    //Cambio los botones
    $('#valida_direccion').hide();
    $('#cambia_direccion').show();
}



/* ---------- SECCION LUMINARIAS -------------------------*/

/** Validar la dirección ingresada y mostrar las luminarias proximas
 * 
 * @returns {void}
 */
function valida_direccion_lum(){
    var calle = $('#m_calle_lum').val();
    var calle2 = $('#m_calle2_lum').val();
    var altura = $('#m_callenro_lum').val();
    var alternativa = $('#m_alternativa_lum').val();

    if(calle.length!==5) {
        alert_box('Debe completar la calle antes de validar la dirección');
        return;
    }

    if(altura==='' && alternativa==='NRO') {
        alert_box('Debe completar la altura antes de validar la dirección');
        return;
    }

    if(calle2.length!==5 && alternativa==='CALLE') {
        alert_box('Debe completar la calle que cruza antes de validar la dirección');
        return;
    }

    $('#m_mapa_lum').parent().append('<div id="progress" class="progress progress-striped active"><div class="bar" style="width:100%;"></div></div>');

    new rem_request(this,function(obj,json){
        var o = JSON.parse(json);
        $('#progress').remove();
        if(o.resultado==='ok') {
            //Actualizo los valores
            $('#m_tic_coordx').val(o.latitud);
            $('#m_tic_coordy').val(o.longitud);
            $('#m_tic_barrio_lum').val(o.barrio);
            $('#lm_tic_barrio_lum').html(o.barrio);
            $('#m_calle_lum').val(o.cod_calle);

            $('#hm_calle_lum').val(o.calle);
            $('#m_calle_nombre_lum').val(o.calle);

            $('#m_calle2_lum').val(o.cod_calle2);

            $('#hm_calle2_lum').val(o.calle2);
            $('#m_calle_nombre2_lum').val(o.calle2);

            lista_luminarias = o.luminarias;

            //Cargo el mapa con un marker azul en la dirección elegida
            mapa_luminaria.setView([o.latitud,o.longitud],18);
            marker_luminarias = L.marker([o.latitud,o.longitud]).addTo(mapa_luminaria).bindPopup(o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : ''));
            
            //Creo los markers de las luminarias
            var cant = o.luminarias.length;
            for(var j=0;j<cant;j++) {
                var pt = o.luminarias[j];
                L.marker([pt.lat,pt.lng], {icon: luminariaIcon}).addTo(mapa_luminaria).on('click',marker_click);
                //.bindPopup(pt.dir + '<br>id: '+ pt.id + '<br>Situación: '+pt.sit);
            }
            
            direccion_validada_lum();
            setAlertLuminaria();
        }         
        else
        {
            alert_box("La dirección indicada no existe", "Validar dirección");
        }
    },"TICKET::DIRECCION","validarDireccion", calle+'|'+calle2+'|'+altura+'|SI|'+alternativa);
}


function cambia_direccion_lum(){
    
    //Oculto los campos read only
    $('#calle_lum .fldl').hide();
    $('#calle2_lum .fldl').hide();
    $('#callenro_lum .fldl').hide();

    //Muestro los campo editables
    $('#alternativa_lum').show();
    $('#calle_lum .fldm input').show();
    $('#calle_lum .fldm img').show();
    $('#callenro_lum .fldm input').show();
    $('#calle2_lum .fldm input').show();
    $('#calle2_lum .fldm img').show();

    //Muestro los botones
    $('#cambia_direccion_lum').hide();
    $('#valida_direccion_lum').show();
    
    $('#m_id_luminaria').val('');
    $('#lm_id_luminaria').html('');

    //Reseteo el mapa
    mapa_luminaria = crearMapa('m_mapa_lum');

    setAlertLuminaria();
}

function crearMapa(id) {
    var p = $('#'+id).parent();
    $('#'+id).remove();
    p.append('<div id="' + id + '"></div>');
    var mapa = new L.map(id).setView([-38.0086358938483,-57.5388003290637], 13);

    // add an OpenStreetMap tile layer
    var osm = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png');
    var ggl = new L.Google();
    mapa.addLayer(osm);
    mapa.addControl(new L.Control.Layers( {'Vista calles':osm, 'Vista satélite':ggl}, {}));
    return mapa;
}


function setAlertLuminaria() {
    if( $('#alert_luminaria').length===0 )
    $('#contenido_luminaria').append('<div id="alert_luminaria" class="alert alert-block" style="width: 700px;"> \n\
                <button type="button" class="close" data-dismiss="alert">&times;</button> \n\
                <h4>Atención!</h4> \n\
                    Debe seleccionar una luminaria en el mapa para terminar la georefencia y poder salvar el ticket. \n\
                </div>');
}


function direccion_validada_lum() {
    //Oculto la calle y altura
    $('#alternativa_lum').hide();
    
    $('#calle_lum .fldm input').hide();
    $('#calle_lum .fldm img').hide();
    
    $('#callenro_lum .fldm input').hide();
    
    $('#calle2_lum .fldm input').hide();
    $('#calle2_lum .fldm img').hide();
    
    //Pongo los campos ReadOnly
    $('#calle_lum .fldl').html( $('#hm_calle_lum').val() ).show();
    $('#callenro_lum .fldl').html( $('#m_callenro_lum').val() ).show();
    $('#calle2_lum .fldl').html( $('#hm_calle2_lum').val() ).show();
    
    //Cambio los botones
    $('#valida_direccion_lum').hide();
    $('#cambia_direccion_lum').show();
    
    calle2_lum.m_status = 'pass';
    calle_lum.m_status = 'pass';
    callenro_lum.m_status = 'pass';
}


function marker_click(e) {
    var marker = e.target;
    var pt = marker.getLatLng();
    var cant = lista_luminarias.length;
    for(var j=0;j<cant;j++) {
        var lum = lista_luminarias[j];
        if( lum.lng===pt.lng && lum.lat===pt.lat ) {
            
            //Cambio el icono del marker
            if(last_marker_clicked!==null)
                last_marker_clicked.setIcon(luminariaIcon);
            marker.setIcon(luminariaOnIcon);
            last_marker_clicked = marker;

            //Me aseguro que la modalidad sea calle y altura
            $('#m_alternativa_lum').val('NRO');
            $('#calle2_lum').hide();
            $('#callenro_lum').show();
            callenro_lum.m_mandatory = true;
            calle2_lum.m_mandatory = false;
            
            //Completo la direccion de la luminaria
            $('#m_id_luminaria').val(lum.id);
            $('#lm_id_luminaria').html(lum.id + ' (' + lum.sit + ')');
            
            //Cambio la direccion del reclamo
            $('#m_tic_coordx').val(lum.lat);
            $('#m_tic_coordy').val(lum.lng);
            
          
            $('#hm_calle_lum').val(lum.calle);
            $('#hm_calle_lum').val(lum.calle);
            $('#calle_lum .fldl').html(lum.calle);
            
            $('#m_calle_nombre_lum').val(lum.calle);
            
            $('#m_callenro_lum').val(lum.altura);
            $('#callenro_lum .fldl').html(lum.altura);

            //Validacion del campo
            calle_lum.m_status = 'pass';
            break;
        }
    }
    $('#alert_luminaria').remove();
}


