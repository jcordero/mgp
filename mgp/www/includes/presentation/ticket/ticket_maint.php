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
        $b = '<form class="form-horizontal">';
    
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
                    $estados = '<option>en curso
                                <option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'en curso':
                    $estados = '<option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>rechazado indebido'.
                                //'<option>cerrado'.
                                '<option>finalizado'.
                                '<option>certificación';
                    break;
                case 'en espera':
                    $estados = '<option>resuelto
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
                case 'rechazado indebido':
                    $estados = '';
                    break;
                case 'transferido':
                    $estados = '';
                    break;
                case 'cerrado':
                    $estados = '';
                    break;
                case 'finalizado':
                    $estados = '';
                    break;
                case 'certificación':
                    $estados =  //'<option>cerrado'.
                                '<option>finalizado';
                    break;
                default:
                    $estados = '';
            }
            
            $b.= '  <p id="lblPrestacion'.$ix.'" data-prestacion="'.$codigo.'">Prestación: '.$leyenda.' actualmente: <b>'.$actual.'</b></p> 
                    <div class="control-group"> 
                        <label class="control-label" for="nvoEstado'.$ix.'">Estado:</label>
                        <div class="controls"> 
                            <select id="nvoEstado'.$ix.'">'.$estados.'</select>
                        </div> 
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="nvoNota'.$ix.'">Nota:</label> 
                        <div class="controls"> 
                            <textarea id="nvoNota'.$ix.'" cols="50" rows="5"></textarea>
                        </div>
                    </div>';
        }
        $b.='    </form>';

       return $b;
    }

    function getDialogAsociar($p) {
    
        error_log("CDH_TICKET_MAINT::getDialogAsociar($p)");

        //Prestaciones que tiene este ticket
        $tic = new ticket();
        $tic->setIdent($p);
        $tic->load();
        
        $b = '<form class="form-horizontal">';
        $b.= '  <p id="miTicket">Ticket: '.$tic->tic_identificador.'</p> 

                <div class="control-group"> 
                    <label class="control-label" for="asociado">Asociar a ticket:</label>
                    <div class="controls"> 
                        <input id="asociado" type="text">
                    </div> 
                </div> 
                <div class="control-group">
                    <label class="control-label" for="asocNota">Nota:</label> 
                    <div class="controls"> 
                        <textarea id="asocNota" cols="50" rows="5"></textarea>
                    </div>
                </div>';        
        $b.='    </form>';

       return $b;
    }

    function getDialogCambioPrestacion($p) {
        global $primary_db;
        
        $b = '<form class="form-horizontal">';
    
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
            if(strlen($tpr_code)===intval($ult))
                $prestaciones.='<option value="'.$row['tpr_code'].'"> ('.$row['tpr_code'].') '.$row['tpr_detalle']."\n";
        }
        
        //Repetir el bloque por cada prestacion que se pueda modificar
        $ix=0;
        foreach($tic->prestaciones as $prest) {
            $leyenda = $prest->tpr_code.' - '.$prest->tpr_description;
            $codigo = $prest->tpr_code;
            $ix++;
            
            $b.= '  <p id="lblPrestacion'.$ix.'" data-prestacion="'.$codigo.'">Prestación: '.$leyenda.'</p> 
                <div class="control-group"> 
                    <label class="control-label" for="nvaPrestacion'.$ix.'">Nueva prestacion:</label>
                    <div class="controls"> 
                        <select id="nvaPrestacion'.$ix.'">'.$prestaciones.'</select>
                    </div> 
                </div> 
                <div class="control-group">
                    <label class="control-label" for="nvaNota'.$ix.'">Nota:</label> 
                    <div class="controls"> 
                        <textarea id="nvaNota'.$ix.'" cols="50" rows="5"></textarea>
                    </div>
                </div>';
        }
        
        $b.='    </form>';

       return $b;
    }
}
?>