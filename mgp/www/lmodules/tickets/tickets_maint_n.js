/* @version {24-Jun-2013 13:25} 
 * 
 * @type marker
 */
var last_marker_clicked = null;
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
    $('#alternativa .fld').append('<div class="fldl"></div>');
    $('#calle .fld').append('<div class="fldl"></div>');
    $('#calle2 .fld').append('<div class="fldl"></div>');
    $('#callenro .fld').append('<div class="fldl"></div>');
    $('#piso .fld').append('<div class="fldl"></div>');
    $('#dpto .fld').append('<div class="fldl"></div>');

    //campos extra en las luminarias 
    $('#alternativa_lum .fld').append('<div class="fldl"></div>');
    $('#calle_lum .fld').append('<div class="fldl"></div>');
    $('#callenro_lum .fld').append('<div class="fldl"></div>');
    $('#calle2_lum .fld').append('<div class="fldl"></div>');
    
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
    
});


/* ---------- SECCION DOMICILIO -------------------------*/

/** Validar la dirección ingresada
 * 
 * @returns {void}
 */
function valida_direccion() {
    var calle = $('#m_calle').val();
    var calle_nombre = $('#hm_calle').val();
    var calle2 = $('#m_calle2').val();
    var calle2_nombre = $('#hm_calle2').val();
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
    var params = { 
        'cod_calle':calle,
        'nom_calle':calle_nombre,        
        'cod_calle2':calle2,
        'nom_calle2':calle2_nombre,
        'altura':altura,
        'luminarias':'NO',
        'alternativa':alternativa
    };
    new rem_request(this,function(obj,json){
            var o = JSON.parse(json);
            $('#progress1').remove();
            if(o.resultado==='ok') {
                //Coordenadas
                $('#m_tic_coordx').val(o.latitud);
                $('#m_tic_coordy').val(o.longitud);
                
                //Barrio
                $('#m_tic_barrio').val(o.barrio);
                $('#lm_tic_barrio').html(o.barrio);

                //Codigo calle
                //$('#m_calle').val(o.cod_calle);
                //$('#hm_calle').val(o.calle);
                
                //Nombre de calle
                $('#m_calle_nombre').val(o.calle);

                //Codigo de calle cruza
                //$('#m_calle2').val(o.cod_calle2);
                //$('#hm_calle2').val(o.calle2);
                
                //Nombre calle cruza
                $('#m_calle_nombre2').val(o.calle2);
                
                //Seteo mapa centrado en coordenadas
                mapa_domicilio.setView([o.latitud,o.longitud],18);
                
                //Marker en el domicilio
                if(marker_domicilio!==null)
                    mapa_domicilio.removeOverlay(marker_domicilio);
                    
                marker_domicilio = createMarker([o.latitud,o.longitud], o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : ''), mapa_domicilio);
                direccion_validada();
            }
            else
            {
                alert_box("La dirección indicada no existe", "Validar dirección");
            }
    },"TICKET::DIRECCION","validarDireccion", JSON.stringify(params));
}

/** Muestro los campos editables nuevamente
 * 
 * @returns {void}
 */
function cambia_direccion() {
    var calle = $('#m_calle').val();
    var calle2 = $('#m_calle2').val();

    //Oculto los campos read only
    $('#calle .fldl').hide();
    $('#callenro .fldl').hide();
    $('#piso .fldl').hide();
    $('#dpto .fldl').hide();

    //Muestro los campo editables
    $('#alternativa').show();
    $('#calle .fld input').show();
    $('#calle .fld img').show();
    $('#callenro .fld input').show();
    $('#piso .fld input').show();
    $('#dpto .fld input').show();
    $('#calle2 .fld input').show();
    $('#calle2 .fld img').show();
    $('#callenro2 .fld input').show();

    //Muestro los botones
    $('#cambia_direccion').hide();
    $('#valida_direccion').show();
    
    //Limpio el nombre de la calle si no tiene el codigo cargado
    if(calle==='') {
        $('#hm_calle').val('');
        $('#m_calle_nombre').val('');
        $('#m_callenro').val('');
    }
    
    if(calle2==='') {
        $('#hm_calle2').val('');
    }

    //Reseteo el mapa
    mapa_domicilio = crearMapa('m_mapa');
}

/** Oculto los campos editables de la dirección
 * 
 * @returns {void}
 */
function direccion_validada() {
    //Oculto la calle y altura
    $('#alternativa').hide();
    $('#calle .fld input').hide();
    $('#calle .fld img').hide();
    $('#callenro .fld input').hide();
    $('#piso .fld input').hide();
    $('#dpto .fld input').hide();
    $('#calle2 .fld input').hide();
    $('#calle2 .fld img').hide();
   
    //Pongo los campos ReadOnly
    $('#calle .fldl').html( $('#hm_calle').val() ).show();
    $('#callenro .fldl').html( $('#m_callenro').val() ).show();
    $('#piso .fldl').html( $('#m_piso').val() ).show();
    $('#dpto .fldl').html( $('#m_dpto').val() ).show();
    $('#calle2 .fldl').html( $('#hm_calle2').val() ).show();

    //Cambio los botones
    $('#valida_direccion').hide();
    $('#cambia_direccion').show();
    
    calle2.m_status = 'pass';
    calle.m_status = 'pass';
    callenro.m_status = 'pass';
}



/* ---------- SECCION LUMINARIAS -------------------------*/

/** Validar la dirección ingresada y mostrar las luminarias proximas
 * 
 * @returns {void}
 */
function valida_direccion_lum(){
    var calle = $('#m_calle_lum').val();
    var calle_nombre = $('#hm_calle_lum').val();
    var calle2 = $('#m_calle2_lum').val();
    var calle2_nombre = $('#hm_calle2_lum').val();
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
    var params = { 
        'cod_calle':calle,
        'nom_calle':calle_nombre,        
        'cod_calle2':calle2,
        'nom_calle2':calle2_nombre,
        'altura':altura,
        'luminarias':'SI',
        'alternativa':alternativa
    };
    new rem_request(this,function(obj,json){
        var o = JSON.parse(json);
        $('#progress').remove();
        if(o.resultado==='ok') {
    
            //Coordenadas
            $('#m_tic_coordx').val(o.latitud);
            $('#m_tic_coordy').val(o.longitud);
            
            //Barrio
            $('#m_tic_barrio_lum').val(o.barrio);
            $('#lm_tic_barrio_lum').html(o.barrio);
            
            //Codigo de calle
            //$('#m_calle_lum').val(o.cod_calle);
            //$('#hm_calle_lum').val(o.calle);
            
            //Nombre de la calle
            $('#m_calle_nombre_lum').val(o.calle);

            //Codigo de la calle que cruza
            //$('#m_calle2_lum').val(o.cod_calle2);
            //$('#hm_calle2_lum').val(o.calle2);
            
            //Nombre de la calle que cruza
            $('#m_calle_nombre2_lum').val(o.calle2);

            //Conjunto de luminarias proximas
            lista_luminarias = o.luminarias;

            //Cargo el mapa con un marker azul en la dirección elegida
            mapa_luminaria.setView([o.latitud,o.longitud],18);
            marker_luminarias = createMarker([o.latitud,o.longitud], (o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : '')), mapa_luminaria);
            
            //Creo los markers de las luminarias
            var cant = lista_luminarias.length;
            for(var j=0;j<cant;j++) {
                var pt = lista_luminarias[j];
                
                if(pt.com==="ILEGAL")
                    lista_luminarias[j].marker = createMarker([pt.lat,pt.lng],"Ilegal",mapa_luminaria,{icon: luminariaIlegalIcon}, marker_click);
                else
                    lista_luminarias[j].marker = createMarker([pt.lat,pt.lng],"Luminaria",mapa_luminaria,{icon: luminariaIcon},marker_click);
                
                lista_luminarias[j].com = pt.com; 
            }
            
            direccion_validada_lum();
            setAlertLuminaria();
        }         
        else
        {
            alert_box("La dirección indicada no existe", "Validar dirección");
        }
    },"TICKET::DIRECCION","validarDireccion", JSON.stringify(params));
}

/** Muestra los campos de edicion para volver a valiar la dirección
 * 
 * @returns {void}
 */
function cambia_direccion_lum(){
    var calle = $('#m_calle_lum').val();
    var calle2 = $('#m_calle2_lum').val();
    
    //Oculto los campos read only
    $('#calle_lum .fldl').hide();
    $('#calle2_lum .fldl').hide();
    $('#callenro_lum .fldl').hide();

    //Muestro los campo editables
    $('#alternativa_lum').show();
    $('#calle_lum .fld input').show();
    $('#calle_lum .fld img').show();
    $('#callenro_lum .fld input').show();
    $('#calle2_lum .fld input').show();
    $('#calle2_lum .fld img').show();

    //Muestro los botones
    $('#cambia_direccion_lum').hide();
    $('#valida_direccion_lum').show();
    
    $('#m_id_luminaria').val('');
    $('#lm_id_luminaria').html('');

    //Limpio el nombre de la calle si no tiene el codigo cargado
    if(calle==='') {
        $('#hm_calle_lum').val('');
        $('#m_calle_nombre_lum').val('');
        $('#m_callenro_lum').val('');
    }
    
    if(calle2==='') {
        $('#hm_calle2_lum').val('');
    }
    
    //Reseteo el mapa
    mapa_luminaria = crearMapa('m_mapa_lum');

    setAlertLuminaria();
}


/** Muestra el mensaje de aviso que debe elegir una luminaria 
 * 
 * @returns {void}
 */
function setAlertLuminaria() {
    if( $('#alert_luminaria').length===0 )
    $('#contenido_luminaria').append('<div id="alert_luminaria" class="alert alert-block" style="width: 700px;"> \n\
                <button type="button" class="close" data-dismiss="alert">&times;</button> \n\
                <h4>Atención!</h4> \n\
                    Debe seleccionar una luminaria en el mapa para terminar la georefencia y poder salvar el ticket. \n\
                </div>');
}

/** Oculta los campos editables una vez validada la dirección
 * 
 * @returns {void}
 */
function direccion_validada_lum() {
    //Alternativa calle altura / calle cruza calle
    $('#alternativa_lum').hide();
    
    //codigo de calle y descripcion
    $('#calle_lum .fld input').hide();
    $('#calle_lum .fld img').hide();
    
    //Altura
    $('#callenro_lum .fld input').hide();
    
    //Calle que cruza
    $('#calle2_lum .fld input').hide();
    $('#calle2_lum .fld img').hide();
    
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

/** Procesa el click sobre la luminaria
 * 
 * @param {event} e
 * @returns {void}
 */
function marker_click(e) {
    var lat = e.lat();
    var lng = e.lng();
    var cant = lista_luminarias.length;
    for(var j=0;j<cant;j++) {
        var lum = lista_luminarias[j];
        if( lum.lng===lng && lum.lat===lat ) {
            
            //Cambio el icono del marker
            if(last_marker_clicked!==null) {
                mapa_luminaria.removeOverlay(last_marker_clicked.marker);
                if( last_marker_clicked.com === "ILEGAL" ) {
                    last_marker_clicked.marker = createMarker([lat,lng],"Ilegal",mapa_luminaria,{icon: luminariaIlegalIcon}, marker_click);
                } else {    
                    last_marker_clicked.marker = createMarker([lat,lng],"Luminaria",mapa_luminaria,{icon: luminariaIcon}, marker_click);
                }
            }
            
            mapa_luminaria.removeOverlay(lum.marker);
            if( lum.com === "ILEGAL" ) 
                lum.marker = createMarker([lat,lng],"Ilegal",mapa_luminaria,{icon: luminariaIlegalOnIcon}, marker_click);
            else
                lum.marker = createMarker([lat,lng],"Luminaria",mapa_luminaria,{icon: luminariaOnIcon}, marker_click);
 
            last_marker_clicked = lum;

            //Me aseguro que la modalidad sea calle y altura
            $('#m_alternativa_lum').val('NRO');
            $('#calle2_lum').hide();
            $('#callenro_lum').show();
            callenro_lum.m_mandatory = true;
            calle2_lum.m_mandatory = false;
            
            //Completo la direccion de la luminaria
            //(solo si los datos estan completos)
            $('#m_id_luminaria').val(lum.id);
            $('#lm_id_luminaria').html('#'+lum.id);
            
            //Cambio la direccion del reclamo
            if(lum.calle!=='' && lum.altura!=='' && lum.altura!=='0') {
                //Nuevas coordenadas
                $('#m_tic_coordx').val(lum.lat);
                $('#m_tic_coordy').val(lum.lng);
                
                //Codigo y nombre de calle
                $('#m_calle_lum').val('0');
                $('#hm_calle_lum').val(lum.calle);
                $('#calle_lum .fldl').html(lum.calle);

                //Nombre de la calle
                $('#m_calle_nombre_lum').val(lum.calle);

                //Altura
                $('#m_callenro_lum').val(lum.altura);
                $('#callenro_lum .fldl').html(lum.altura);
            }
            //Validacion del campo
            calle_lum.m_status = 'pass';
            calle2_lum.m_status = 'pass';
            callenro_lum.m_status = 'pass';
            break;
        }
    }
    $('#alert_luminaria').remove();
}


