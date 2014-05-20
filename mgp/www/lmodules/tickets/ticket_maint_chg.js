$(document).ready(function() {

    //Inserto una barra de acciones
    var h = '<div class="row">'+
                '<div class="col-xs-12 alert alert-info">'+
                    '<h4>Tarea a realizar:</h4>'+
                    '<p id="operaciones">'+
                        '<button class="btn btn-large btn-primary" id="cambio_estado"><i class="icon-edit"></i> Cambio Estado</button>'+
                        '&nbsp;<button class="btn btn-large" id="cambio_prestacion"><i class="icon-tag"></i> Cambio Prestación</button>'+
                        '&nbsp;<button class="btn btn-large" id="asociar_ticket"><i class="icon-th"></i> Asociar a otro ticket</button>'+
                    '</p>'+
                '</div>'+
            '</div>';
    $('#bloque_ticket').after(h);

    $('#cambio_estado').click(cambio_estado);
    $('#cambio_prestacion').click(cambio_prestacion);
    $('#asociar_ticket').click(asociar_ticket);

});

function cambio_estado() {

    var identificador = $('#m_tic_identificador').val();

    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal fade" id="cambio_estado_dialog">' +
                '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '</div>' +
                '</div>' +
            '</div>';
    $(document.body).append(h);
    var url = sess_web_path + '/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogCambioEstado&args=' + encodeURIComponent(identificador) + '&cache=' + new Date().getTime();
    $('#cambio_estado_dialog')
            .on('hidden.bs.modal', function() {
                $('#cambio_estado_dialog').html('').remove();
            })
            .on('loaded.bs.modal', function() {
                $('#cambio_estado_dialog .btn-primary').click(cambio_estado_ok);
            })
            .modal({remote: url, show:true});
}

function cambio_estado_ok() {

    var j = 1;
    while ($('#nvoEstado' + j).length === 1) {
        //Prestaciones pueden existir varias
        var prestacion = $('#lblPrestacion' + j).attr('data-codigo');
        var prestacion_desc = $('#lblPrestacion' + j).attr("data-nombre");
        var anterior = $('#lblPrestacion' + j).attr('data-estado');
        var estado = $('#nvoEstado' + j).val();
        var nota = $('#nvoNota' + j).val();
        
        $('#operaciones').html(
                '<br><p>Cambiar estado de [' + prestacion_desc + '] de [' + anterior + '] -> [' + estado + ']' +
                '<p>Recuerde que debe confirmar la operación con el botón continuar al pie de este formulario.'
        );

        $('#m_tmp_accion').val('CAMBIO ESTADO');
        $('#m_tmp_nuevo_estado').val(estado);
        $('#m_tmp_nota').val(nota);
        $('#m_tmp_prestacion').val(prestacion);

        j++;
    }
    $('#cambio_estado_dialog').modal('hide');
}


function cambio_prestacion() {
    var identificador = $('#m_tic_identificador').val();

    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal fade" id="cambio_prestacion_dialog">' +
                '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '</div>' +
                '</div>' +
            '</div>';

    $(document.body).append(h);
    var url = sess_web_path + '/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogCambioPrestacion&args=' + encodeURIComponent(identificador) + '&cache=' + new Date().getTime();
    $('#cambio_prestacion_dialog')
            .on('hidden.bs.modal', function() {
                $('#cambio_prestacion_dialog').html('').remove();
            })
            .on('loaded.bs.modal', function() {
                $('#cambio_prestacion_dialog .btn-primary').click(cambio_prestacion_ok);
            })
            .modal({remote: url});
    
}


function cambio_prestacion_ok() {
    $('#cambio_prestacion_dialog').modal('hide');
}

function asociar_ticket() {
    var identificador = $('#m_tic_identificador').val();

    //Muestro el dialogo de cambio de estado
    var h = '<div class="modal fade" id="asociar_ticket_dialog">' +
                '<div class="modal-dialog">' +
                    '<div class="modal-content">' +
                    '</div>' +
                '</div>' +
            '</div>';

    $('#mainform').append(h);
    var url = sess_web_path + '/common/rem_request.php?presentation=TICKET::TICKET_MAINT&func=getDialogAsociar&args=' + encodeURIComponent(identificador) + '&cache=' + new Date().getTime();
    $('#asociar_ticket_dialog')
            .on('hidden.bs.modal', function() {
                $('#asociar_ticket_dialog').html('').remove();
            })
            .on('loaded.bs.modal', function() {
                $('#asociar_ticket_dialog .btn-primary').click(asociar_ticket_ok);
            })
            .modal({remote: url});
    
}

function asociar_ticket_ok() {
    $('#asociar_ticket_dialog').modal('hide');
}
