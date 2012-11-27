var chart1 = null;
var chart2 = null;
var dias = 7;
var drilling = "";

$(document).ready(function() {

	Highcharts.setOptions({
		   global: {
		      useUTC: false
		   }
	});

	setDias(7);
});

function actualiza_eventos() {
	new rem_request(this,function(obj,json){
		var jdata = eval("("+json+")");
		
		$("#totales").html("Total eventos: "+jdata.total);
		$("#cambio_fecha").show();

		chart1=null;
		var options = {
	        chart: {
	           renderTo: 'graf_eventos',
	           defaultSeriesType: 'column',
	           height: 300,
	           width: 950
	        },
	        title: {
	           text: 'Eventos por terminal'
	        },
	        xAxis: {
	            categories: ['Terminal']
	        },
	        yAxis: {
	           title: {
	              text: 'Eventos'
	           }
	        },
	        series: [],
	        credits: { enabled: false },
	        plotOptions: {
	            column: {
	               cursor: 'pointer',
	               point: { events: {'click':drill_eventos} }
	            }               
	         }
	     };	

		var bars = jdata.bars;
		for( var k=0; k<bars.length; k++) {
			var n = bars[k].organismo;
			var v = bars[k].cant;
			options.series.push( {"name":n, "data":[v], dataLabels: {
				enabled: true,
				rotation: 0,
				color: '#444444',
				align: 'right',
				x: -3,
				y: -3,
				formatter: function() {
					return this.y;
				},
				style: {
					font: 'normal 13px Verdana, sans-serif'
				}
			} } );
		}
				
		chart1 = new Highcharts.Chart(options);	
		
		
		chart2=null;
		
		var options = {
	        chart: {
	           renderTo: 'graf_sitios',
	           defaultSeriesType: 'pie',
	           height: 300,
	           width: 950
	        },
	        title: {
	           text: 'Eventos por sitio'
	        },
	        plotOptions: {
	            pie: {
	               allowPointSelect: true,
	               cursor: 'pointer',
	               dataLabels: {
	                  enabled: true,
	                  color: '#000000',
	                  connectorColor: '#000000',
	                  formatter: function() {
	                     return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 0) +' %';
	                  }
	               }
	            }
	        },
	        series: [{"name":"pie", "type":"pie", "data":[] }],
	        credits: { enabled: false },
	        tooltip: {
	            formatter: function() { 
	            	return Highcharts.numberFormat(this.y, 0)+ " eventos";
	            }
	         }
	     };	

		var pie = jdata.pie;
		for( var k=0; k<pie.length; k++) {
			var n = pie[k].organismo;
			var v = pie[k].cant;
			options.series[0].data.push( {"name":n, "y":v} );
		}
				
		chart2 = new Highcharts.Chart(options);	

	},"HOME_TERMINALES_AJAX","render_eventos",dias);
}


function setDias(cant) {
	
	dias = cant;
	chart1=null;
	chart2=null;
	actualiza_eventos();
	
	if(cant==1) {
		$("#navegador").html("Datos de las últimas 24hs.");
		var hoy = new Date();
		$("#fechas").html( date_to_string(hoy) );
	}
	if(cant==7) {
		$("#navegador").html("Datos de los últimos 7 días.");
		var hasta = new Date();
		var desde = new Date();
		desde.setDate(desde.getDate()-7);
		$("#fechas").html( date_to_string(desde) + " al " + date_to_string(hasta) );
	}
	if(cant==15) {
		$("#navegador").html("Datos de los últimos 15 días.");
		var hasta = new Date();
		var desde = new Date();
		desde.setDate(desde.getDate()-15);
		$("#fechas").html( date_to_string(desde) + " al " + date_to_string(hasta) );
	}
	if(cant==30) {
		$("#navegador").html("Datos de los últimos 30 días.");
		var hasta = new Date();
		var desde = new Date();
		desde.setDate(desde.getDate()-30);
		$("#fechas").html( date_to_string(desde) + " al " + date_to_string(hasta) );
	}
	if(cant==180) {
		$("#navegador").html("Datos de los últimos 6 meses.");
		var hasta = new Date();
		var desde = new Date();
		desde.setDate(desde.getDate()-180);
		$("#fechas").html( date_to_string(desde) + " al " + date_to_string(hasta) );
	}
}

function date_to_string( d) {
	var e = "DomLunMarMieJueVieSab";
	return e.substr(d.getDay()*3, 3) + " " + d.getDate() + "/" + (d.getMonth()+1.0) + "/" + d.getFullYear();
}

function drill_eventos(e) {
	
	drilling = e.point.series.name;
	
	var j = new rem_request(this,function(obj,json){
		var jdata = eval("("+json+")");
		
			$("#totales").html("Total eventos: "+jdata.total);
			$("#volver").show();
			$("#cambio_fecha").hide();

			chart1 = null;			
			var options = {
		        chart: {
		           renderTo: 'graf_eventos',
		           defaultSeriesType: 'spline',
		           height: 300,
		           width: 950
		        },
		        title: {
		           text: 'Eventos de terminal '+drilling
		        },
		        xAxis: {
		        	type: 'datetime',
		            tickPixelInterval: 150
		        },
		        yAxis: {
		           title: {text: 'Eventos'},
		           plotLines: [{
		               value: 0,
		               width: 1,
		               color: '#808080'
		            }]
		        },
		        series: [{name:"Eventos", data:[] }],
		        credits: { enabled: false },
		        tooltip: {
		            formatter: function() {
		           
		            	return Dia(Highcharts.dateFormat('%a', this.x)) + " " + Highcharts.dateFormat('%d-%m-%Y', this.x) +'<br/>Eventos: '+ Highcharts.numberFormat(this.y, 2);
		            }
		         }
		     };	

			var spline = jdata.spline;
			for( var k=0; k<spline.length; k++) {
				var t = spline[k].fecha; //Formato unix timestamp
				var v = spline[k].cant;
				options.series[0].data.push( {'x':t*1000,'y':v} );
			}
					
			chart1 = new Highcharts.Chart(options);	
		
			
			chart2=null;
			
			var options = {
		        chart: {
		           renderTo: 'graf_sitios',
		           defaultSeriesType: 'pie',
		           height: 300,
		           width: 950
		        },
		        title: {
		           text: 'Eventos por sitio de ' + drilling
		        },
		        plotOptions: {
		            pie: {
		               allowPointSelect: true,
		               cursor: 'pointer',
		               dataLabels: {
		                  enabled: true,
		                  color: '#000000',
		                  connectorColor: '#000000',
		                  formatter: function() {
		                     return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 0) +' %';
		                  }
		               }
		            }
		        },
		        series: [{"name":"pie", "type":"pie", "data":[] }],
		        credits: { enabled: false },
		        tooltip: {
		            formatter: function() { 
		            	return Highcharts.numberFormat(this.y, 0)+" eventos";
		            }
		         }
		     };	

			var pie = jdata.pie;
			for( var k=0; k<pie.length; k++) {
				var n = pie[k].organismo;
				var v = pie[k].cant;
				options.series[0].data.push( {"name":n, "y":v} );
			}
					
			chart2 = new Highcharts.Chart(options);	

	},"HOME_TERMINALES_AJAX","render_eventos_tiempo",dias+"|"+drilling);	
}


function Dia(eng) {
	var i = "MonTueWedThuFriSatSun";
	var e = "LunMarMieJueVieSabDom";
	return e.substr(i.indexOf(eng, 0), 3);
}

function goHome() {
	$("#volver").hide();
	setDias(dias);
}