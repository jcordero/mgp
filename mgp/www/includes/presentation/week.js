function week_move(direccion)
{
	var nueva_fecha = new Date(fecha_proceso);
	nueva_fecha.setDate(nueva_fecha.getDate()+7*direccion);
	
	//La nueva fecha es legal?
	if(nueva_fecha<fecha_maxima && nueva_fecha>=fecha_minima) {
		fecha_proceso = nueva_fecha;

		//Actualizo la leyenda
		barraNavegacion();
		
		//Reseteo los turnos
		pidoTurnosLibres2();
	}
}