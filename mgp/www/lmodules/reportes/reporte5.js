$(document).ready(function(){
   //Agrego botones
   $("#actionSubmit").remove();
   $("#enviar_todo").append('<button type="submit" class="maint submit btn btn-primary" id="actionReporte" onclick="reporte()">Reporte</button> ');
  // $("#enviar_todo").append('<button type="submit" class="maint submit btn btn-primary" id="actionGraficar" onclick="graficar()">Gráfico</button>');
   $("#payload").append('<div id="resultados"></div>');
});

function reporte() {
    var desde = $("#m_tmp_fecha").val();
    var hasta = $("#hm_tmp_fecha").val();
    var prestacion = $("#m_tpr_code").val();
    var rechazados = $("#m_tmp_rechazados:checked").val();
    
    var pars = {desde:desde,hasta:hasta,prestacion:prestacion,rechazados:rechazados};
    $("#resultados").html('Calculando... <div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
    new p4.rem_request(this,function(obj,json){
        $("#resultados").html(json);
    },"REPORTES::REPORTES","getTiemposMedios",JSON.stringify(pars));
}

function graficar() {
    
}