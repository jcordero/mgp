$(document).ready(function(){

    //campos extra en las direcciones
    $('#ciu_dir_calle .fldm').append('<div class="fldl"></div>');
    $('#ciu_dir_nro .fldm').append('<div class="fldl"></div>');
    $('#ciu_dir_piso .fld').append('<div class="fldl"></div>');
    $('#ciu_dir_dpto .fld').append('<div class="fldl"></div>');
    $('#ciu_cod_postal .fld').append('<div class="fldl"></div>');
    
    /* Boton de validar la direccion / cambiar direccion */
    if(OP==='N' || OP==='M') {
        $('#contenido_direccion').after(
            '<div><button class="btn" id="valida_direccion">Validar Dirección</button> <button class="btn hide" id="cambia_direccion">Cambiar Dirección</button></div>');
    }
    
    /* Inicializacion del mapa para ver y modificar */
    if(OP==='V' || OP==='M') {
        //Deben estar las coordenadas activas
        var lat = $('#m_ciu_coord_x').val();
    	var lng = $('#m_ciu_coord_y').val();
        if(lat!=='' && lng!=='') {
            $('#m_tmp_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + lat + "&y=" + lng + "&w=350&h=250&r=250");
            direccion_validada();
        }
    }
    
    $('#valida_direccion').click(function(){
    	var calle = $('#m_ciu_dir_calle').val();
    	var altura = $('#m_ciu_dir_nro').val();
    	
    	if(calle==='') {
            alert_box('Debe completar la calle antes de validar la dirección');
    	return;
    	}

    	if(altura==='') {
            alert_box('Debe completar la altura antes de validar la dirección');
            return;
    	}

        //$calle,$calle2,$altura,$luminarias,$alternativa
        var params = calle + '||' + altura + '||NRO';
    	new rem_request(this,function(obj,json){
    		var o = JSON.parse(json);
    		//Actualizo los valores
    		$('#m_ciu_coord_x').val(o.latitud);
    		$('#m_ciu_coord_y').val(o.longitud);
    		$('#m_ciu_barrio').val(o.barrio);
    		$('#lm_ciu_barrio').html(o.barrio);
    		$('#m_ciu_dir_calle').val(o.cod_calle);
    		$('#hm_ciu_dir_calle').val(o.calle);
    		
    		//Cargo el mapa 350 x 250px
    		/* GoogleMaps
    		 * $('#m_mapa img').attr('src','http://maps.googleapis.com/maps/api/staticmap?center='+o.longitud+','+o.latitud+'&zoom=17&size=350x250&maptype=roadmap&markers=color:blue%7Clabel:%7C'+o.longitud+','+o.latitud+'&sensor=false');
    		 * 
    		 * OpenStreetMap
    		 * $('#m_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + o.latitud + "&y=" + o.longitud + "&w=350&h=250&r=250");
    		 */
    		$('#m_tmp_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + o.latitud + "&y=" + o.longitud + "&w=350&h=250&r=250");
    		    		
    		direccion_validada();
    		
    	},"TICKET::DIRECCION","validarDireccion", params);
    });

    $('#cambia_direccion').click(function(){
        //oculto los campos read-only
        $('#ciu_dir_calle .fldl').hide();
        $('#ciu_dir_nro .fldl').hide();
        $('#ciu_dir_piso .fldl').hide();
        $('#ciu_dir_dpto .fldl').hide();
        $('#ciu_cod_postal .fldl').hide();

        //muestro de nuevo los campos del formulario
        $('#ciu_dir_calle .fldm input').show();
        $('#ciu_dir_calle .fldm img').show();
        $('#ciu_dir_nro .fldm input').show();
        $('#ciu_dir_piso .fld input').show();
        $('#ciu_dir_dpto .fld input').show();
        $('#ciu_cod_postal .fld input').show();

        //Cambio los botones
        $('#cambia_direccion').hide();
        $('#valida_direccion').show();
    });


    //Busco el DNI en la base de datos
    if(OP==='N') {
        initDNI('tmp_doc', null);
        chg_docid(document.getElementById('bm_tmp_doc'));
    }
});

function direccion_validada() {
    //Oculto la calle y altura
    $('#ciu_dir_calle .fldm input').hide();
    $('#ciu_dir_calle .fldm img').hide();
    $('#ciu_dir_nro .fldm input').hide();
    $('#ciu_dir_piso .fld input').hide();
    $('#ciu_dir_dpto .fld input').hide();
    $('#ciu_cod_postal .fld input').hide();

    //Pongo los campos ReadOnly
    $('#ciu_dir_calle .fldl').html( $('#hm_ciu_dir_calle').val() ).show();
    $('#ciu_dir_nro .fldl').html(   $('#m_ciu_dir_nro').val() ).show();
    $('#ciu_dir_piso .fldl').html(  $('#m_ciu_dir_piso').val() ).show();
    $('#ciu_dir_dpto .fldl').html(  $('#m_ciu_dir_dpto').val() ).show();
    $('#ciu_cod_postal .fldl').html($('#m_ciu_cod_postal').val() ).show();

    //Cambio los botones
    $('#valida_direccion').hide();
    $('#cambia_direccion').show();
}