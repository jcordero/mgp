
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
function chg_plaza(obj)
{
        var ix = $("#"+obj.id+" option:selected").attr("data-id");
	if(ix=="-1")
            return;

	//Recupero los valores a setear
        var pl = playas[ix];
        
	var params = extractParams(obj.id);
        
        if(params.lat)
            $("#m_"+params.lat).val(pl.lat);
        
        if(params.lng)
            $("#m_"+params.lng).val(pl.lng);
        
}

