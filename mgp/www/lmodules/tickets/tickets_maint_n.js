/* @version {24-Jun-2013 13:25} 
 * 
 */

/** Ultimo marker elegido
 * 
 * @type google.marker
 */
var last_marker_clicked = null;

/** Mapa
 * 
 * @type google.maps
 */
var mapa = {};

/** Lista de luminarias o semaforos
 * 
 * @type Array
 */
var lista_elementos = [];

/** Marker donde va el domicilio ingresado
 * 
 * @type google.marker
 */
var marker_domicilio = null;

/** Codigo del layer del GIS del MGP
 * 
 * @type Number
 */
var gis_layer = 0;

/** Tipo de georeferencia usada
 * 
 * @type String
 */
var gis_tipo = "";

/** Listado de las playas
 * 
 * @type Array
 */
var playas = [];

/** Path del icono de la luminaria
 * 
 * @type String
 */
var luminariaIcon = sess_web_path+'/images/mapicons/luminaria.png';

/** Path del icono de la luminaria seleccionada
 * 
 * @type String
 */
var luminariaOnIcon = sess_web_path+'/images/mapicons/luminaria_on.png';

/** Path del icono de la luminaria ilegal
 * 
 * @type String
 */
var luminariaIlegalIcon = sess_web_path+'/images/mapicons/luminaria_ilegal.png';

/** Path del icono de la luminaria ilegal seleccionada
 * 
 * @type String
 */
var luminariaIlegalOnIcon = sess_web_path+'/images/mapicons/luminaria_ilegal_on.png';

/** Path del icono del semaforo
 * 
 * @type String
 */
var semaforoIcon = sess_web_path+'/images/mapicons/semaforo.png';

/** Path del icono del semaforo seleccionado
 * 
 * @type String
 */
var semaforoOnIcon = sess_web_path+'/images/mapicons/semaforo_on.png';

/** Inicializacion
 * 
 * @param {type} param
 */
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
 
    /* Boton de validar la direccion */
    $('#contenido_domicilio').after(
        '<div><button class="btn" id="valida_direccion"><i class="icon-globe"></i> Validar Dirección</button> '+
        '<button class="btn hide" id="cambia_direccion"><i class="icon-globe"></i> Cambiar Dirección</button></div>');
       
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

    /* Declaracion del los event handlers de los botones de direccion */
    $('#valida_direccion').click(valida_direccion);
    $('#cambia_direccion').hide().click(cambia_direccion);
    
});


/** Validar la dirección ingresada, pedir los elementos, ubicar el mapa en el lugar, poner un marker
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
        'gis':gis_layer,
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

                //Nombre de calle
                $('#m_calle_nombre').val(o.calle);

                //Nombre calle cruza
                $('#m_calle_nombre2').val(o.calle2);
                
                //Seteo mapa centrado en coordenadas
                var center = new google.maps.LatLng(o.latitud,o.longitud);
                mapa.setCenter(center);
                mapa.setZoom(18);
                
                //Marker en el domicilio
                if(marker_domicilio!==null)
                    marker_domicilio.setMap(null);
                    
                marker_domicilio = createMarker([o.latitud,o.longitud], o.calle + ' ' + o.nro + (o.calle2!=='' ? ' y '+o.calle2 : ''), mapa);
                
                //Ajuste del formulario
                direccion_validada();
                
                //Mostrar elementos
                if(gis_tipo=="LUMINARIA" || gis_tipo=="SEMAFORO") {
                    //Conjunto de luminarias proximas
                    lista_elementos = o.elementos;
                
                    //Creo los markers de las luminarias
                    var cant = lista_elementos.length;
                    for(var j=0;j<cant;j++) {
                        var pt = lista_elementos[j];

                        if(gis_layer==1) {
                            if(pt.com==="ILEGAL")
                                lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Ilegal "+pt.calle+' '+pt.altura,mapa,luminariaIlegalIcon,marker_click,j);
                            else
                                lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Luminaria "+pt.calle+' '+pt.altura,mapa,luminariaIcon,marker_click,j);
                        }

                        if(gis_layer==2) {
                            lista_elementos[j].marker = createMarker([pt.lat,pt.lng],"Semáforo "+pt.id,mapa,semaforoIcon,marker_click,j);
                        }

                        lista_elementos[j].com = pt.com; 
                    }
                    
                    if(gis_tipo=="LUMINARIA")
                        setAlertLuminaria();
                }            
            }
            else
            {
                alert_box("La dirección indicada no existe", "Validar dirección");
            }
    },"TICKET::DIRECCION","validarDireccion", JSON.stringify(params));
}

/** Muestro los campos editables nuevamente de la direccion
 * 
 * @returns {void}
 */
function cambia_direccion() {
    $("#lm_tic_barrio").html("");
    $("#lm_id_elemento").html("");
    
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
    
    //Limpio el nombre de la calle 
    $('#m_calle').val("");
    $('#hm_calle').val("");
    $('#m_calle2').val("");
    $('#hm_calle2').val("");
    $('#m_callenro').val("");
    
    //Reseteo el mapa
    if(mapa.setZoom)
        mapa = crearMapa('m_mapa');
    
    
    $('#alert_luminaria').remove();
}

/** Oculto los campos editables de la dirección, una vez validada la misma contra el server de google
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

/** Muestra el mensaje de aviso que debe elegir una luminaria 
 * 
 * @returns {void}
 */
function setAlertLuminaria() {
    if( $('#alert_luminaria').length===0 )
    $('#contenido_domicilio').append('<div id="alert_luminaria" class="alert alert-block" style="width: 700px;"> \n\
                <button type="button" class="close" data-dismiss="alert">&times;</button> \n\
                <h4>Atención!</h4> \n\
                    Debe seleccionar una luminaria en el mapa para terminar la georefencia y poder salvar el ticket. \n\
                </div>');
}

/** Procesa el click sobre un elemento
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
    
    //Datos de la luminaria - semaforo     
    $('#m_id_elemento').val(elem.id);
    $('#lm_id_elemento').html('#'+elem.id);
            
    //Cambio la direccion del reclamo si se puede
    if(elem.calle!=='' && elem.altura!=='' && elem.altura!=='0') {
         //Me aseguro que la modalidad sea calle y altura
        $('#m_alternativa_lum').val('NRO').trigger("change");
    
        //Nuevas coordenadas
        $('#m_tic_coordx').val(elem.lat);
        $('#m_tic_coordy').val(elem.lng);

        //Codigo y nombre de calle
        $('#m_calle').val('0');
        $('#hm_calle').val(elem.calle);
        $('#calle .fldl').html(elem.calle);

        //Nombre de la calle
        $('#m_calle_nombre').val(elem.calle);

        //Altura
        $('#m_callenro').val(elem.altura);
        $('#callenro .fldl').html(elem.altura);
    }

    //Validacion del campo
    calle.m_status = 'pass';
    calle2.m_status = 'pass';
    callenro.m_status = 'pass';
    
    $('#alert_luminaria').remove();
}

/** Borra todos los datos ingresados en el formulario (para cuando se cambia la prestacion)
 * 
 * @returns {void}
 */
function reset_form()
{
    //Oculto todos los bloques
    var divdomicilio = $("#bloque_domicilio");
    if(divdomicilio.length)
    {
    	divdomicilio.hide();
    	calle.m_mandatory = false;
    	callenro.m_mandatory = false;	
    	calle2.m_mandatory = false;
    	villa.m_mandatory = false;
        plaza.m_mandatory = false;
        playa.m_mandatory = false;
        cementerio.m_mandatory = false;
        orgpublico.m_mandatory = false;
        id_elemento.m_mandatory = false;
        col_linea.m_mandatory = false;

        cambia_direccion();

        $("#contenido_domicilio input,select,textarea").each (function(){
            if(this.id!="m_rubro" && this.id!="m_tic_nota_in") {
                if(this.type==="textarea")
                    $(this).html("");
                else
                    $(this).val("");
                $("#"+this.id.substr(2)).hide();
                //console.log("oculto "+this.id.substr(2));
            }
        });
        
        last_marker_clicked = null;
        marker_domicilio = null;
        mapa = {};
        lista_elementos = [];
        gis_layer = 0;
        gis_tipo = "";
        
        //Remuevo el cuestionario
        $("#m_cuestionario_placeholder").html("");
    }   
}

/**
 * Es invocada por el tree de prestaciones, cuando se elije una prestacion
 * @param {string} codigo
 * @returns {void}
 */
function cambio_prestacion(codigo)
{	    
    //Ocultar la georeferencia
    reset_form();
    
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

        //Tipo de georeferencia
        gis_tipo = jdata[0].tpr_ubicacion;
        setValuePair("m_tipo_georef",gis_tipo,gis_tipo);
        
        //Bloque de geo en el formulario
        var divobj = $("#bloque_domicilio");
        $("#bloque_domicilio .titulo_texto").html("Ubicación "+gis_tipo);    

        //Ajustes por cada tipo de geo
        switch(gis_tipo) {
            case '':
            case "DOMICILIO":
                calle.m_mandatory = true;
                callenro.m_mandatory = true;
                $("#calle").show();
                $("#callenro").show();
                $("#alternativa").show();
                $("#calle2").show();
                $("#piso").show();
                $("#dpto").show();
                $("#tic_barrio").show();
                $("#m_alternativa").val("NRO").trigger("change");
                break;
            case "VILLA":
                villa.m_mandatory = true;
                $("#villa").show();
                $("#vilmanzana").show();
                $("#vilcasa").show();
                break;
            case "PLAZA":
                plaza.m_mandatory = true;
                $("#plaza").show();
                break;
            case "PLAYA":
                playa.m_mandatory = true;
                $("#playa").show();
                
                //Completo el combo de opciones
                var combo = $("#m_playa");
                combo.empty();
                combo.append('<option data-id="-1" value="">');
                new rem_request(this,function(obj,json){
                    playas = JSON.parse(json);

                    for(var j=0;j<playas.length;j++) 
                        combo.append('<option data-id="'+j+'" value="'+playas[j].playa+'">'+playas[j].playa);

                },"TICKET::DIRECCION","listaDePlayas","");

                $("#valida_direccion").hide();
                break;
            case "COLECTIVO":
                col_linea.m_mandatory = true;
                $("#col_linea").show();
                $("#col_interno").show();
                $("#col_fecha_hora").show();
                
                break;
            case "CEMENTERIO":
                cementerio.m_mandatory = true;
                $("#cementerio").show();
                $("#sepultura").show();
                $("#sepsector").show();
                $("#sepcalle").show();
                $("#sepnumero").show();
                $("#sepfila").show();
                
                break;
            case "ORGAN.PUBLICO":
                orgpublico.m_mandatory = true;
                $("#orgpublico").show();
                break;
            case "LUMINARIA":
            case "SEMAFORO":
                calle.m_mandatory = true;
                callenro.m_mandatory = true;
                id_elemento.m_mandatory = false;

                $("#calle").show();
                $("#callenro").show();
                $("#id_elemento").show();
                $("#alternativa").show();
                $("#calle2").show();
                $("#tic_barrio").show();
                                
                $("#m_alternativa").val("NRO").trigger("change");

                //Determino el layer gis
                switch(gis_tipo) {
                    case "LUMINARIA":
                        gis_layer = 1;
                        break;
                    case "SEMAFORO":
                        gis_layer = 2;
                        break;
                }
                
                break;
            default:
                    alert_box("Tipo de georeferencia desconocida: "+gis_tipo,"Error");
        }
       
        divobj.show();
        
        //Activo el mapa interactivo en el centro de MDQ
        if(gis_tipo!="COLECTIVO") {
            $("#m_mapa").show();
            if(typeof mapa.setCenter === 'undefined') {
                mapa = crearMapa('m_mapa');
            } else {
                var center = new google.maps.LatLng(-38.0086358938483,-57.5388003290637);
                mapa.setCenter(center);
                mapa.setZoom(13);
            }
        }
        else
        {
            $("#m_mapa").hide();
            $("#valida_direccion").hide();
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
