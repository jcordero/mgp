$(document).ready(function(){
    
    //Inserto una barra de acciones
    var h = '<div class="row"><div class="span12 alert alert-info"> \n\
            <h4>Tarea a realizar:</h4> \n\
            <p id="operaciones"> \n\
            <button class="btn btn-large" id="cambio_estado"><i class="icon-edit"></i> Cambio Estado</button> \n\
            <button class="btn btn-large" id="cambio_prestacion"><i class="icon-tag"></i> Cambio Prestacion</button> \n\
            <button class="btn btn-large" id="asociar_ticket"><i class="icon-th"></i> Asociar a otro ticket</button> \n\
            </p></div></div>';
    $('#bloque_ticket').after(h);
    
    $('#cambio_estado').click(cambio_estado);
    $('#cambio_prestacion').click(cambio_prestacion);
    $('#asociar_ticket').click(asociar_ticket);
    
});

function cambio_estado() {
    
    var identificador = $('#m_tic_identificador').val();
    
    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal hide fade" id="cambio_estado_dialog"> \n\
        <div class="modal-header"> \n\
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> \n\
          <h3>Cambio de estado</h3> \n\
        </div> \n\
        <div class="modal-body"> \n\
        </div> \n\
        <div class="modal-footer"> \n\
          <button class="btn" data-dismiss="modal">Cancelar</button> \n\
          <button class="btn btn-primary">Confirmar</button> \n\
        </div> \n\
    </div>';
    $(document.body).append(h);
    var url = sess_web_path+'/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogCambioEstado&args='+encodeURIComponent(identificador)+'&cache=' + new Date().getTime();
    $('#cambio_estado_dialog').modal({remote:url});
    $('#cambio_estado_dialog .btn-primary').click(cambio_estado_ok);
}

function cambio_estado_ok() {
    $('#cambio_estado_dialog').modal('hide');    
    
    var j = 1;
    while( $('#nvoEstado'+j).length===1 ) {
    //Prestaciones pueden existir varias
        var prestacion_desc = $('#lblPrestacion'+j).html();
        var estado = $('#nvoEstado'+j).val();
        var nota = $('#nvoNota'+j).val();
        var prestacion = $('#lblPrestacion'+j).attr('data-prestacion');
        
        $('#operaciones').html('<br><p>Cambiar estado de '+prestacion_desc+' a estado ' + estado +
            '<p>Recuerde que debe confirmar la operación con el botón continuar al pie de este formulario.');
    
        $('#m_tmp_accion').val('CAMBIO ESTADO');
        $('#m_tmp_nuevo_estado').val(estado);
        $('#m_tmp_nota').val(nota);
        $('#m_tmp_prestacion').val(prestacion);
        
        j++;
    }
    $('#cambio_estado_dialog').html('').remove();
}


function cambio_prestacion() {
        var identificador = $('#m_tic_identificador').val();
    
    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal hide fade" id="cambio_prestacion_dialog"> \n\
        <div class="modal-header"> \n\
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> \n\
          <h3>Cambio de Prestación</h3> \n\
        </div> \n\
        <div class="modal-body"> \n\
        </div> \n\
        <div class="modal-footer"> \n\
          <button class="btn" data-dismiss="modal">Cancelar</button> \n\
          <button class="btn btn-primary">Confirmar</button> \n\
        </div> \n\
    </div>';
    $(document.body).append(h);
    var url = sess_web_path+'/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogCambioPrestacion&args='+encodeURIComponent(identificador)+'&cache=' + new Date().getTime();
    $('#cambio_prestacion_dialog').modal({remote:url});
    $('#cambio_prestacion_dialog .btn-primary').click(cambio_prestacion_ok);
}


function cambio_prestacion_ok() {
    $('#cambio_prestacion_dialog').modal('hide');   
    
    
    $('#cambio_prestacion_dialog').html('').remove();
}

function asociar_ticket() {
        var identificador = $('#m_tic_identificador').val();
    
    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal hide fade" id="asociar_ticket_dialog"> \n\
        <div class="modal-header"> \n\
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> \n\
          <h3>Asociar a otro ticket</h3> \n\
        </div> \n\
        <div class="modal-body"> \n\
        </div> \n\
        <div class="modal-footer"> \n\
          <button class="btn" data-dismiss="modal">Cancelar</button> \n\
          <button class="btn btn-primary">Confirmar</button> \n\
        </div> \n\
    </div>';
    $(document.body).append(h);
    var url = sess_web_path+'/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogAsociar&args='+encodeURIComponent(identificador)+'&cache=' + new Date().getTime();
    $('#asociar_ticket_dialog').modal({remote:url});
    $('#asociar_ticket_dialog .btn-primary').click(asociar_ticket_ok);
}

function asociar_ticket_ok() {
    $('#asociar_ticket_dialog').modal('hide');   
    
    
    $('#asociar_ticket_dialog').html('').remove();
}
