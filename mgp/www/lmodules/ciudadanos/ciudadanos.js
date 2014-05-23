$(document).ready(function(){
    //Ajuste del ancho de la direccion
    
    $("#bloque_datos_personales").after(
            "<div class=\"row\">"+
            "   <div id=\"para_direccion\" class=\"col-xs-6\"></div>"+
            "   <div id=\"para_mapa\" class=\"col-xs-6\"></div>"+
            "</div>");
    var blq = $("#bloque_direccion").detach();
    $("#para_direccion").append(blq);
    var mp = $("#m_tmp_mapa").detach();
    $("#para_mapa").append(mp);
    
    
    //campos extra en las direcciones
    $('#m_ciu_dir_calle').after('<p class="form-control-static"></p>');
    $('#m_ciu_dir_nro').after('<p class="form-control-static"></p>');
    $('#m_ciu_dir_piso').after('<p class="form-control-static"></p>');
    $('#m_ciu_dir_dpto').after('<p class="form-control-static"></p>');
    $('#m_ciu_cod_postal').after('<p class="form-control-static"></p>');
    
    /* Boton de validar la direccion / cambiar direccion */
    if(OP==='N' || OP==='M') {
        $('#contenido_direccion').after(
            '<div>'+
            '   <button class="btn" id="valida_direccion">Validar Dirección</button> '+
            '   <button class="btn" id="cambia_direccion">Cambiar Dirección</button>'+
            '</div>');
        $("#cambia_direccion").hide();
    }
    
    var mh = Math.floor( $("#para_direccion").height()/256 )*256;
    var mw = Math.floor( $("#para_mapa").width()/256 )*256;

    $("#para_mapa").height(mh);
    $("#para_mapa").width(mw);
    
        
    $('#valida_direccion').click(function(){
    	var c = $('#m_ciu_dir_calle').val().split("|");
        var calle_cod = c[0];
        var calle_nom = c[1];
    	var altura = $('#m_ciu_dir_nro').val();
    	
    	if(calle_cod==='') {
            p4.alert_box('Debe completar la calle antes de validar la dirección');
            return;
    	}

    	if(altura==='') {
            p4.alert_box('Debe completar la altura antes de validar la dirección');
            return;
    	}

        //$calle,$calle2,$altura,$luminarias,$alternativa
        var params = {
            'cod_calle':calle_cod,
            'nom_calle':calle_nom,
            'cod_calle2':0,
            'nom_calle2':'',
            'altura':altura,
            'gis':0,
            'alternativa': 'NRO',
            'prestacion' : ''
        };
    	new p4.rem_request(this,function(obj,json){
    		var o = JSON.parse(json);
    		//Actualizo los valores
    		$('#m_ciu_coord_x').val(o.latitud);
    		$('#m_ciu_coord_y').val(o.longitud);
    		$('#m_ciu_barrio').val(o.barrio);
    		$('#lm_ciu_barrio').html(o.barrio);
    		$('#m_ciu_dir_calle').val(o.cod_calle+"|"+o.calle);
    		$('#hm_ciu_dir_calle').val(o.calle);
    		   		    		
                tmp_mapa.obj.MostrarMapa('m_tmp_mapa');          
    		direccion_validada();
    		
    	},"TICKET::DIRECCION","validarDireccion", JSON.stringify(params));
    });

    $('#cambia_direccion').click(function(){
        //oculto los campos read-only
        $('#ciu_dir_calle p').hide();
        $('#ciu_dir_nro p').hide();
        $('#ciu_dir_piso p').hide();
        $('#ciu_dir_dpto p').hide();
        $('#ciu_cod_postal p').hide();

        //muestro de nuevo los campos del formulario
        $('#ciu_dir_calle input').show();
        $('#ciu_dir_calle span').show();
        $('#ciu_dir_nro input').show();
        $('#ciu_dir_piso input').show();
        $('#ciu_dir_dpto input').show();
        $('#ciu_cod_postal input').show();

        //Cambio los botones
        $('#cambia_direccion').hide();
        $('#valida_direccion').show();
        
        //Reset del mapa
        tmp_mapa.obj.mapa = null;
        $("#m_tmp_mapa").html('');
    });


    //Busco el DNI en la base de datos
    if(OP==='N') {
        initDNI('tmp_doc', null);
        chg_docid(document.getElementById('nm_tmp_doc'));
    }
    
    /* Inicializacion del mapa para ver y modificar */
    if(OP==='V' || OP==='M') {
        //Deben estar las coordenadas activas
        var lat = $('#m_ciu_coord_x').val();
    	var lng = $('#m_ciu_coord_y').val();
        if(lat!=='' && lng!=='') {
            //$('#m_tmp_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + lat + "&y=" + lng + "&w=350&h=250&r=250");
            direccion_validada();
        }
    }

});

function direccion_validada() {
    //Oculto la calle y altura
    $('#ciu_dir_calle input').hide();
    $('#ciu_dir_calle span').hide();
    $('#ciu_dir_nro input').hide();
    $('#ciu_dir_piso input').hide();
    $('#ciu_dir_dpto input').hide();
    $('#ciu_cod_postal input').hide();

    //Pongo los campos ReadOnly
    $('#ciu_dir_calle p').html( $('#hm_ciu_dir_calle').val() ).show();
    $('#ciu_dir_nro p').html(   $('#m_ciu_dir_nro').val() ).show();
    $('#ciu_dir_piso p').html(  $('#m_ciu_dir_piso').val() ).show();
    $('#ciu_dir_dpto p').html(  $('#m_ciu_dir_dpto').val() ).show();
    $('#ciu_cod_postal p').html($('#m_ciu_cod_postal').val() ).show();

    //Cambio los botones
    $('#valida_direccion').hide();
    $('#cambia_direccion').show();
}
