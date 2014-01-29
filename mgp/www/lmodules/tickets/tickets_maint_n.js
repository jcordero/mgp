/* @version {24-Jun-2013 13:25} 
 * 
 */


var last_marker_clicked = null;
var mapa_elemento = {};
var mapa_domicilio = {};
var lista_elementos = [];
var marker_domicilio = null;
var marker_elementos = null;
var gis_layer = 0;
var gis_tipo = "";
var playas = [];

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
        '<div><button class="btn" id="valida_direccion"><i class="icon-globe"></i> Validar Dirección</button> <button class="btn hide" id="cambia_direccion"><i class="icon-globe"></i> Cambiar Dirección</button></div>');
    
    /* Boton de validar la direccion en luminarias / semaforos */
    $('#contenido_luminaria').after(
        '<div><button class="btn" id="valida_direccion_lum"><i class="icon-globe"></i> Validar Dirección</button> <button class="btn hide" id="cambia_direccion_lum"><i class="icon-globe"></i> Cambiar Dirección</button></div>');
    
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
        'gis':0,
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
                var center = new google.maps.LatLng(o.latitud,o.longitud);
                mapa_domicilio.setCenter(center);
                mapa_domicilio.setZoom(18);
                
                //Marker en el domicilio
                if(marker_domicilio!==null)
                    marker_domicilio.setMap(null);
                    
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

/** Validar la dirección ingresada y mostrar las luminarias/semaforos proximas
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
        'gis':layer_gis,
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
            lista_elementos = o.elementos;

            //Cargo el mapa con un marker azul en la dirección elegida
            var center = new google.maps.LatLng(o.latitud,o.longitud);
            mapa_elemento.setCenter(center);
            mapa_elemento.setZoom(18);
                
            //Marker en el domicilio
            if(marker_elementos!==null)
                marker_elementos.setMap(null);

            marker_elementos = createMarker([o.latitud,o.longitud], o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : ''), mapa_elemento);
            
            //Creo los markers de las luminarias
            var cant = lista_elementos.length;
            for(var j=0;j<cant;j++) {
                var pt = lista_elementos[j];
                
                if(layer_gis==1) {
                    if(pt.com==="ILEGAL")
                        lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Ilegal "+pt.calle+' '+pt.altura,mapa_elemento,luminariaIlegalIcon,marker_click,j);
                    else
                        lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Luminaria "+pt.calle+' '+pt.altura,mapa_elemento,luminariaIcon,marker_click,j);
                }
                
                if(layer_gis==2) {
                    lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Semáforo "+pt.id,mapa_elemento,semaforoIcon,marker_click,j);
                }
                
                lista_elementos[j].com = pt.com; 
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
    
    $('#m_id_elemento').val('');
    $('#lm_id_elemento').html('');

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
    mapa_elemento = crearMapa('m_mapa_lum');

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
 * @param {event} event
 * @returns {void}
 */
function marker_click(event) {
    var index = this.lum_index;
    var elem = lista_elementos[index];
            
    //Cambio el icono del marker de seleccionado a normal
    if(last_marker_clicked!==null) {
        if(gis_tipo=="LUMINARIA") {
            if( last_marker_clicked.com === "ILEGAL" ) {
                last_marker_clicked.marker.setIcon(luminariaIlegalIcon);
            } else {    
                last_marker_clicked.marker.setIcon(luminariaIcon);
            }
        }
        if(gis_tipo=="SEMAFORO") {
            last_marker_clicked.marker.setIcon(semaforoIcon);
        }
    }
            
    //Paso el marker seleccionado a estado activo
    if(gis_tipo=="LUMINARIA") {
        if( elem.com === "ILEGAL" ) 
            elem.marker.setIcon(luminariaIlegalOnIcon);
        else
            elem.marker.setIcon(luminariaOnIcon);
    }
    if(gis_tipo=="SEMAFORO") {
        elem.marker.setIcon(semaforoOnIcon);
    }
    last_marker_clicked = elem;

    //Me aseguro que la modalidad sea calle y altura
    $('#m_alternativa_lum').val('NRO');
    $('#calle2_lum').hide();
    $('#callenro_lum').show();
    callenro_lum.m_mandatory = true;
    calle2_lum.m_mandatory = false;
            
    //Completo la direccion de la luminaria
    //(solo si los datos estan completos)
    $('#m_id_elemento').val(elem.id);
    $('#lm_id_elemento').html('#'+elem.id);
            
    //Cambio la direccion del reclamo
    if(elem.calle!=='' && elem.altura!=='' && elem.altura!=='0') {
        //Nuevas coordenadas
        $('#m_tic_coordx').val(elem.lat);
        $('#m_tic_coordy').val(elem.lng);

        //Codigo y nombre de calle
        $('#m_calle_lum').val('0');
        $('#hm_calle_lum').val(elem.calle);
        $('#calle_lum .fldl').html(elem.calle);

        //Nombre de la calle
        $('#m_calle_nombre_lum').val(elem.calle);

        //Altura
        $('#m_callenro_lum').val(elem.altura);
        $('#callenro_lum .fldl').html(elem.altura);
    }

    //Validacion del campo
    calle_lum.m_status = 'pass';
    calle2_lum.m_status = 'pass';
    callenro_lum.m_status = 'pass';
    
    $('#alert_luminaria').remove();
}


function ocultar_bloques_geo()
{
    //Oculto todos los bloques
    var divdomicilio = document.getElementById("bloque_domicilio");
    if(divdomicilio)
    {
    	$(divdomicilio).hide();
    	calle.m_mandatory = false;
    	callenro.m_mandatory = false;	
    	calle2.m_mandatory = false;
    }
    
    var divvilla = document.getElementById("bloque_villa");
    if(divvilla)
    {
    	$(divvilla).hide();
    	villa.m_mandatory = false;
    }
    
    var divplaza = document.getElementById("bloque_plaza");
    if(divplaza)
    {
    	$(divplaza).hide();
    	plaza.m_mandatory = false;
    }
    
    var divcementerio = document.getElementById("bloque_cementerio");
    if(divcementerio)
    {
    	$(divcementerio).hide();
    	cementerio.m_mandatory = false;
    }
    
    var divorgpublico = document.getElementById("bloque_orgpublico");
    if(divorgpublico)
    {
    	$(divorgpublico).hide();
    	orgpublico.m_mandatory = false;
    }

    var divluminaria = document.getElementById("bloque_luminaria");
    if(divluminaria)
    {
    	$(divluminaria).hide();
        calle_lum.m_mandatory = false;
        callenro_lum.m_mandatory = false;
        id_elemento.m_mandatory = false;
        calle2_lum.m_mandatory = false;
    }   
}

/**
 * Es invocada por el tree de prestaciones
 * @param {type} codigo
 * @returns {undefined}
 */
function cambio_prestacion(codigo)
{	    
    //Ocultar la georeferencia
    ocultar_bloques_geo();
    
    //Pedir datos sobre detalle de prestacion
    new rem_request(this,function(obj,json){
        
        if(json==="")
        {
            alert_box("El servidor no esta respondiendo.",'Error');
            return; //No hay detalle de la prestacion
        }
        var jdata = JSON.parse(json);
        if(!jdata)
        {
            return; //No hay detalle de la prestacion
        }
        
        //Activar el rubro si es una DENUNCIA
        if( jdata[0].tpr_tipo==="DENUNCIA" )
        {
            if(divrubro)
            {
                divrubro.style.display = "block";
                rubro.m_mandatory = true;

                //Completo el combo rubro
                new rem_request(this,function(obj,json){
                    if(json==="")
                    {
                        alert_box("El servidor no esta respondiendo.",'Error');
                        return; //No hay detalle de la prestacion
                    }
                    var jdata2 = JSON.parse( json );
                    fillCombo(objrubro,jdata2,objrubro.id,"tru_code","","tru_detalle");    
                },"TICKET::PRESTACIONTREE","getRubroPrest",codigo);
            }
        }

        //Tipo de domicilio
        gis_tipo = jdata[0].tpr_ubicacion;
        var divobj = null;
        setValuePair("m_tipo_georef",gis_tipo,gis_tipo);

        calle_lum.m_mandatory = false;
        callenro_lum.m_mandatory = false;
        id_elemento.m_mandatory = false;
        villa.m_mandatory = false;
        plaza.m_mandatory = false;
        cementerio.m_mandatory = false;
        orgpublico.m_mandatory = false;
        col_linea.m_mandatory = false;
            
        switch(gis_tipo) {
            case '':
            case "DOMICILIO":
                divobj = $("#bloque_domicilio").show();
                calle.m_mandatory = true;
                callenro.m_mandatory = true;

                //Activo el mapa interactivo en el centro de MDQ
                if(typeof mapa_domicilio.setCenter === 'undefined') {
                    mapa_domicilio = crearMapa('m_mapa');
                } else {
                    var center = new google.maps.LatLng(-38.0086358938483,-57.5388003290637);
                    mapa_domicilio.setCenter(center);
                    mapa_domicilio.setZoom(13);
                }
                break;
            case "VILLA":
                divobj = $("#bloque_villa").show();
                villa.m_mandatory = true;
                break;
            case "PLAZA":
                divobj = $("#bloque_plaza").show();
                plaza.m_mandatory = true;
                
                $("#plaza .desc").html("Plaza");
                $("#bloque_plaza .titulo_texto").html("Ubicación PLAZA");
                break;
            case "PLAYA":
                divobj = $("#bloque_plaza").show();
                plaza.m_mandatory = true;
                
                $("#plaza .desc").html("Playa");
                $("#bloque_plaza .titulo_texto").html("Ubicación PLAYA");

                //Completo el combo de opciones
                var combo = $("#m_plaza");
                combo.empty();
                combo.append('<option data-id="-1" value="">');
                new rem_request(this,function(obj,json){
                    playas = JSON.parse(json);

                    for(var j=0;j<playas.length;j++) 
                        combo.append('<option data-id="'+j+'" value="'+playas[j].playa+'">'+playas[j].playa);

                },"TICKET::DIRECCION","listaDePlayas","");

                break;
            case "COLECTIVO":
                divobj = $("#bloque_colectivo").show();
                col_linea.m_mandatory = true;
                break;
            case "CEMENTERIO":
                divobj = $("#bloque_cementerio").show();
                cementerio.m_mandatory = true;
                break;
            case "ORGAN.PUBLICO":
                divobj = $("#bloque_orgpublico").show();
                orgpublico.m_mandatory = true;
                break;
            case "LUMINARIA":
            case "SEMAFORO":
                divobj = $("#bloque_luminaria").show();
                calle_lum.m_mandatory = true;
                callenro_lum.m_mandatory = true;
                id_elemento.m_mandatory = false;

                //Determino el layer gis
                switch(gis_tipo) {
                    case "LUMINARIA":
                        layer_gis = 1;
                        break;
                    case "SEMAFORO":
                        layer_gis = 2;
                        break;
                }

                //Activo el mapa interactivo en el centro de MDQ (ver mapa.js)
                if(typeof mapa_elemento.setCenter === 'undefined') { 
                    mapa_elemento = crearMapa('m_mapa_lum');
                } else {
                    var center = new google.maps.LatLng(-38.0086358938483,-57.5388003290637);
                    mapa_elemento.setCenter(center);
                    mapa_elemento.setZoom(13);
                }
                break;
            default:
                    alert_box("Tipo de georeferencia desconocida: "+gis_tipo,"Error");
        }
       
        //Cargar el cuestionario?
        var params = prestacion.m_params;
        var cuest = document.getElementById("m_"+ params + "_placeholder");
        if(cuest && jdata[1])
        {
            cuest.innerHTML = jdata[1];
        }
    
    },"TICKET::PRESTACIONTREE","getDetails",codigo);
    
}

function minimizar_prestacion() {
    
}