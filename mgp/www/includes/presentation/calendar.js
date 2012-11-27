var act_calendario = function(a,b,c)
{ 
	var f = document.getElementById(c);
	
	//Formatear la salida original AAAA,MM,DD
	f.value = b[0][0][2] + "/" + b[0][0][1] + "/" + b[0][0][0];	
	
	//Hay una función declarada en el onclick?
	if(calendar_onclick)
	{
		calendar_onclick(c);
	}
};

function createCalendar(idPos,idField)
{
	var cal1 = new YAHOO.widget.Calendar(idPos,{"navigator":true});
	cal1.cfg.setProperty("MONTHS_SHORT",   ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]); 
	cal1.cfg.setProperty("MONTHS_LONG",    ["Enero", "Febrero", "Marzo", "Abril", "May", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]); 
	cal1.cfg.setProperty("WEEKDAYS_1CHAR", ["D", "L", "M", "M", "J", "V", "S"]); 
	cal1.cfg.setProperty("WEEKDAYS_SHORT", ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]); 
	cal1.cfg.setProperty("WEEKDAYS_MEDIUM",["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"]); 
	cal1.cfg.setProperty("WEEKDAYS_LONG",  ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"]);
	cal1.selectEvent.subscribe( act_calendario, idField);
	cal1.render();
	return cal1;
}
