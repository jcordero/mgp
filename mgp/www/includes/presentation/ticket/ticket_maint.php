<?php 
include_once "common/cdatatypes.php";
include_once 'beans/ticket.php';

class CDH_TICKET_MAINT extends CDataHandler 
{
    function __construct($parent) 
    {
        parent::__construct($parent);
    }

    function getDialogCambioEstado($p) {
        $b = '<div class="modal-header">'.
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'.
                    '<h3>Cambio de estado</h3>'.
                '</div>'.
                '<div class="modal-body">'.
                    '<form class="form-horizontal">';
    
        error_log("CDH_TICKET_MAINT::getDialogCambioEstado($p)");

        //Prestaciones que tiene este ticket
        $tic = new ticket();
        $tic->setIdent($p);
        $tic->load();
        
        //Repetir el bloque por cada prestacion que se pueda modificar
        $ix=0;
        foreach($tic->prestaciones as $prest) {
            $leyenda = $prest->tpr_code.' - '.$prest->tpr_description;
            $codigo = $prest->tpr_code;
            $ix++;
            
            //Lista de estados posibles, segun el estado actual
            $actual = $prest->ttp_estado;
            
            switch($actual) {
                case 'pendiente':
                    $estados = '<option>inspección
                                <option>en curso
                                <option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                case 'inspección':
                    $estados = '<option>inspección
                                <option>en curso
                                <option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'en curso':
                    $estados = '<option>en curso
                                <option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'en espera':
                    $estados = '<option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'resuelto':
                    $estados = '<option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'rechazado':
                    $estados = '<option>rechazado';
                    break;
                case 'rechazado indebido':
                    $estados = '<option>rechazado indebido';
                    break;
                case 'transferido':
                    $estados = '<option>transferido';
                    break;
                case 'cerrado':
                    $estados = '<option>cerrado';
                    break;
                case 'finalizado':
                    $estados = '<option>finalizado';
                    break;
                case 'certificación':
                    $estados =  //'<option>cerrado'.
                                '<option>certificación'.
                                '<option>finalizado';
                    break;
                default:
                    $estados = '';
            }
            
            $b.= '  <p id="lblPrestacion'.$ix.'" data-codigo="'.$prest->tpr_code.'" data-nombre="'.$prest->tpr_description.'" data-estado="'.$actual.'">Prestación: '.$leyenda.'<br>Estado actual: <b>'.$actual.'</b></p> 
                    
                    <div class="control-group" > 
                        <label class="control-label col-xs-3" for="nvoEstado'.$ix.'">Estado:</label>
                        <div class="col-xs-9"> 
                            <select class="form-control" id="nvoEstado'.$ix.'">'.$estados.'</select>
                        </div> 
                    </div>
                    
                    <div class="control-group" style="height:120px;">
                        <label class="control-label col-xs-3" for="nvoNota'.$ix.'">Nota:</label> 
                        <div class="col-xs-9"> 
                            <textarea class="form-control" id="nvoNota'.$ix.'" rows="5"></textarea>
                        </div>
                    </div>';
        }
        $b.='    </form>'.
            '</div>'.
            '<div class="modal-footer">'.
                '<button class="btn" data-dismiss="modal">Cancelar</button>'.
                '<button class="btn btn-primary">Confirmar</button>'.
            '</div>';

       return $b;
    }

    function getDialogAsociar($p) {
    
        error_log("CDH_TICKET_MAINT::getDialogAsociar($p)");

        //Prestaciones que tiene este ticket
        $tic = new ticket();
        $tic->setIdent($p);
        $tic->load();
        
        $b = '<div class="modal-header">'.
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'.
                    '<h3>Asociar a otro ticket</h3>'.
                '</div>'.
                '<div class="modal-body">'.
                    '<form class="form-horizontal">';
        
        $b.= '  <p id="miTicket">Ticket: '.$tic->tic_identificador.'</p> 

                <div class="control-group"> 
                    <label class="control-label col-xs-3" for="asociado">Asociar a ticket:</label>
                    <div class="col-xs-9"> 
                        <input class="form-control" id="asociado" type="text">
                    </div> 
                </div> 
                
                <div class="control-group" style="height:120px;">
                    <label class="control-label col-xs-3" for="asocNota">Nota:</label> 
                    <div class="col-xs-9"> 
                        <textarea id="asocNota" class="form-control" rows="5"></textarea>
                    </div>
                </div>';        
        
        $b.='    </form>'.
            '</div>'.
            '<div class="modal-footer">'.
                '<button class="btn" data-dismiss="modal">Cancelar</button>'.
                '<button class="btn btn-primary">Confirmar</button>'.
            '</div>';

       return $b;
    }

    function getDialogCambioPrestacion($p) {
        global $primary_db;
        
        $b = '<div class="modal-header">'.
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'.
                    '<h3>Cambiar prestacion</h3>'.
                '</div>'.
                '<div class="modal-body">'.
                    '<form class="form-horizontal">';
    
        error_log("CDH_TICKET_MAINT::getDialogCambioPrestacion($p)");

        //Prestaciones que tiene este ticket
        $tic = new ticket();
        $tic->setIdent($p);
        $tic->load();
        
        //Lista de todas las prestaciones activas (que sean las ultimas ramas)
        $prestaciones = '';
        $rs = $primary_db->do_execute("select tpr_code,tpr_detalle from tic_prestaciones where tpr_estado='ACTIVO' order by 1");
        while($row=$primary_db->_fetch_row($rs)) {
            //Es la ultima rama?
            $tpr_code = $row['tpr_code'];
            $ult = $primary_db->QueryString("select max(length(tpr_code)) from tic_prestaciones where tpr_code like '{$tpr_code}%' and tpr_estado='ACTIVO'");
            if(strlen($tpr_code)===intval($ult)) {
                $prestaciones.='<option value="'.$row['tpr_code'].'"> ('.$row['tpr_code'].') '.$row['tpr_detalle']."</option>\n";
            }
        }
        
        //Repetir el bloque por cada prestacion que se pueda modificar
        $ix=0;
        foreach($tic->prestaciones as $prest) {
            $leyenda = $prest->tpr_code.' - '.$prest->tpr_description;
            $ix++;
            
            $b.= 
               '<p id="lblPrestacion'.$ix.'" data-codigo="'.$prest->tpr_code.'" data-nombre="'.$prest->tpr_description.'">Prestación: '.$leyenda.'</p> 
                <div class="control-group"> 
                    <label class="control-label col-xs-3" for="nvaPrestacion'.$ix.'">Nueva:</label>
                    <div class="col-xs-9"> 
                        <select class="form-control" id="nvaPrestacion'.$ix.'">'.$prestaciones.'</select>
                    </div> 
                </div> 
                
                <div class="control-group" style="height:120px;">
                    <label class="control-label col-xs-3" for="nvaNota'.$ix.'">Nota:</label> 
                    <div class="col-xs-9"> 
                        <textarea class="form-control" id="nvaNota'.$ix.'" rows="5"></textarea>
                    </div>
                </div>';
        }
        
        $b.='    </form>'.
            '</div>'.
            '<div class="modal-footer">'.
                '<button class="btn" data-dismiss="modal">Cancelar</button>'.
                '<button class="btn btn-primary">Confirmar</button>'.
            '</div>';

       return $b;
    }
}
