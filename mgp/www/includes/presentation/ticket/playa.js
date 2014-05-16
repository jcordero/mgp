
/*
 * Completa el resto de los campos con la info de georeferencia
 * Parametros:
 * 		calle	(codigo de calle usig)
 * 		callenro (altura)
 * 		calle_nombre
 * 		tic_coordx (para mapa)
 * 		tic_coordy
 * 		tic_barrio
 * 		tic_cgpc (nombre del cgpc en forma 'Comuna X')
 * 		
 */
function chg_playa(obj)
{
        var ix = $("#"+obj.id+" option:selected").attr("data-id");
	if(ix=="-1")
            return;

	//Recupero los valores a setear
        var pl = playas[ix];
        
        //Seteo mapa centrado en coordenadas
        var center = new google.maps.LatLng(pl.lat,pl.lng);
        mapa.setCenter(center);
        mapa.setZoom(18);
                
        //Marker en el domicilio
        if(marker_domicilio!==null)
            marker_domicilio.setMap(null);

        marker_domicilio = createMarker([pl.lat,pl.lng], 'Playa ' + pl.playa, mapa);
        
        //Seteo los campos del form
	var params = p4.extractParams(obj.id);
        
        if(params.lat)
            $("#m_"+params.lat).val(pl.lat);
        
        if(params.lng)
            $("#m_"+params.lng).val(pl.lng);
        
}

