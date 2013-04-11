$(document).ready(function() {
    var divrubro = $("#rubro");
    if(divrubro.length===1)
    {
        divrubro.hide();
        rubro.m_mandatory = false;
    }
    
    //Inhabilito las direcciones
    $("#bloque_domicilio").hide();
    $("#bloque_villa").hide();
    $("#bloque_plaza").hide();
    $("#bloque_cementerio").hide();
    $("#bloque_orgpublico").hide();

    //campos extra en las direcciones
    $('#calle .fldm').append('<div class="fldl"></div>');
    $('#callenro .fldm').append('<div class="fldl"></div>');
    $('#piso .fld').append('<div class="fldl"></div>');
    $('#dpto .fld').append('<div class="fldl"></div>');
    
    /* Boton de validar la direccion */
    $('#contenido_domicilio').after(
            '<div><button class="btn" id="valida_direccion">Validar Dirección</button> <button class="btn hide" id="cambia_direccion">Cambiar Dirección</button></div>');
    
    $('#valida_direccion').click(function(){
    	var calle = $('#m_calle').val();
    	var altura = $('#m_callenro').val();
    	
    	if(calle==='') {
            alert_box('Debe completar la calle antes de validar la dirección');
    	return;
    	}

    	if(altura==='') {
            alert_box('Debe completar la altura antes de validar la dirección');
            return;
    	}

    	new rem_request(this,function(obj,json){
    		var o = JSON.parse(json);
    		//Actualizo los valores
    		$('#m_tic_coordx').val(o.latitud);
    		$('#m_tic_coordy').val(o.longitud);
    		$('#m_tic_barrio').val(o.barrio);
    		$('#lm_tic_barrio').html(o.barrio);
    		$('#m_calle').val(o.cod_calle);
    		$('#hm_calle').val(o.calle);
    		$('#m_calle_nombre').val(o.calle);
    		
    		//Cargo el mapa 350 x 250px
    		/* GoogleMaps
    		 * $('#m_mapa img').attr('src','http://maps.googleapis.com/maps/api/staticmap?center='+o.longitud+','+o.latitud+'&zoom=17&size=350x250&maptype=roadmap&markers=color:blue%7Clabel:%7C'+o.longitud+','+o.latitud+'&sensor=false');
    		 * 
    		 * OpenStreetMap
    		 * $('#m_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + o.latitud + "&y=" + o.longitud + "&w=350&h=250&r=250");
    		 */
    		$('#m_mapa img').attr('src',sess_web_path + "/common/mapa.php?x=" + o.latitud + "&y=" + o.longitud + "&w=350&h=250&r=250");
    		    		
                direccion_validada();
    	},"TICKET::DIRECCION","validarDireccion", calle+'|'+altura);
    });
    
    $('#cambia_direccion').hide().click(function(){
    	//Oculto los campos read only
        $('#calle .fldl').hide();
        $('#callenro .fldl').hide();
        $('#piso .fldl').hide();
        $('#dpto .fldl').hide();
    	
    	//Muestro los campo editables
    	$('#calle .fldm input').show();
        $('#calle .fldm img').show();
        $('#callenro .fldm input').show();
        $('#piso .fld input').show();
        $('#dpto .fld input').show();

        //Muestro los botones
        $('#cambia_direccion').hide();
        $('#valida_direccion').show();

    });
    
});


function direccion_validada() {
    //Oculto la calle y altura
    $('#calle .fldm input').hide();
    $('#calle .fldm img').hide();
    $('#callenro .fldm input').hide();
    $('#piso .fld input').hide();
    $('#dpto .fld input').hide();

    //Pongo los campos ReadOnly
    $('#calle .fldl').html( $('#hm_calle').val() ).show();
    $('#callenro .fldl').html( $('#m_callenro').val() ).show();
    $('#piso .fldl').html( $('#m_piso').val() ).show();
    $('#dpto .fldl').html( $('#m_dpto').val() ).show();

    //Cambio los botones
    $('#valida_direccion').hide();
    $('#cambia_direccion').show();
}