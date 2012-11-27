

$(document).ready(function() {
	$("#enviar_todo").html("");
	$("#enviar_todo").append("<button onclick='graficar()'>Graficar</button>");	
	$("#enviar_todo").append("<button onclick='reportar()'>Reporte</button>");
	$("#enviar_todo").append("<button onclick='window.print()'>Imprimir</button>");
	$("#enviar_todo").append("<button onclick='history.go(-1)'>Cancelar</button>");
	$("#tmp_graph .fld").css({'margin-left':'0px'});
	$("#tmp_graph .desc").css({'display':'none'});

});

function graficar()
{
	//Parametros
	var desde = $("#m_fecha_inicio").val();
	var hasta = $("#m_fecha_fin").val();
	$("#tmp_graph .fld").html('<img src="'+sess_web_path+'/images/default/loading2.gif">');
	
	//Llamo al presentation REPORTES
	var url = sess_web_path+"/common/rem_request.php?presentation=REPORTES&func=prestacion&args="+desde+"|"+hasta;
	$.getJSON(url, function(data) {		
		$("#tmp_graph .fld").html("");
		if(data.result=="OK")
		$("#tmp_graph .fld").append("<div class='graficos'>"+data.image.resultado + data.image.actitud + data.image.prestacion + "</div>");
	});	
}

function reportar()
{
	//Parametros
	var desde = $("#m_fecha_inicio").val();
	var hasta = $("#m_fecha_fin").val();
	var p = $("#tmp_graph .fld");
	p.html('<img src="'+sess_web_path+'/images/default/loading2.gif">');
	
	//Llamo al presentation REPORTES
	var url =sess_web_path+ "/common/rem_request.php?presentation=REPORTES&func=reportePrestacion&args="+desde+"|"+hasta;
	$.getJSON(url, function(data) {		
		p.html("");
		if(data.result=="OK")
		{
			var b ="<div><table class='reporte'><thead><tr>";
			for(var j=0;j<data.columns.length;j++)
			{
				b+="<th>"+data.columns[j]+"</th>";
			}

			b+="</tr></thead><tbody>";
			for(var j=0;j<data.rows.length;j++)
			{
				var row = data.rows[j];
				b+="<tr>";
				for(var k=0;k<row.length;k++)
				{
					b+="<td>"+row[k]+"</td>";					
				}
				b+="</tr>";					
			}	
			
			if(data.totals)
			{
				b+="<tr class=\"to\">";
				for(var k=0;k<data.totals.length;k++)
				{
					b+="<td>"+data.totals[k]+"</td>";					
				}
				b+="</tr>";					
			}
			
			b+="</tbody></table></div>";
			p.append(b);
			$('table.reporte tbody tr:odd').addClass('cl');
			$('table.reporte tbody tr:even').addClass('os');
		}
	});	
}
