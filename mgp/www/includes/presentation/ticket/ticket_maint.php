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
                                <option>cerrado
                                <option>certificación';
                case 'inspección':
                    $estados = '<option>en curso
                                <option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>cerrado
                                <option>certificación';
                    break;
                case 'en curso':
                    $estados = '<option>en espera
                                <option>resuelto
                                <option>rechazado
                                <option>cerrado
                                <option>certificación';
                    break;
                case 'en espera':
                    $estados = '<option>resuelto
                                <option>rechazado
                                <option>cerrado
                                <option>certificación';
                    break;
                case 'resuelto':
                    $estados = '<option>resuelto
                                <option>rechazado
                                <option>cerrado
                                <option>certificación';
                    break;
                case 'rechazado':
                    $estados = '';
                    break;
                case 'transferido':
                    $estados = '';
                    break;
                case 'cerrado':
                    $estados = '';
                    break;
                case 'certificación':
                    $estados = '<option>cerrado';
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

    }

    function getDialogCambioPrestacion($p) {

    }
}
?>