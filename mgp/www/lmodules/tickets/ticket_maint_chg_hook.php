<?php
include_once 'beans/ticket.php';

class class_tic_ticket_upd_hooks extends cclass_maint_hooks
{
    //Hago los cambios segun la operacion
    function beforeSaveDB() {
        $obj = $this->m_data;
        $err = array();
        
        //Cargo el ticket desde la base
        $tic = new ticket();
        $tic->tic_identificador = $obj->getField("tic_identificador")->getValue();
        $tic->load();
                
        //Accion a realizar
        $accion = $obj->getField("tmp_accion")->getValue();
        switch($accion) {
            case "CAMBIO ESTADO":
                $this->cambio_estado($tic);
                break;
            case "CAMBIO PRESTACION":
                $this->cambio_prestacion($tic);
                break;
            case "ASOCIAR":
                $this->asociar($tic);
                break;
            default:
                $err[] = "MENSAJE: Operación no reconocida.";
                break;
        }
        
        return $err;
    }
    
    //Salvo los cambios
    function canSaveDB() {
        return false;
    }
    
    private function cambio_estado($tic) {
        $obj = $this->m_data;
        
        //Identificador de ticket
        $tmp_prestacion     = $obj->getField("tmp_prestacion")->getValue();
        $tmp_nuevo_estado   = $obj->getField("tmp_nuevo_estado")->getValue();
        $tmp_nota           = $obj->getField("tmp_nota")->getValue();

        //Ejecuto el cambio
        $tic->cambiar_estado($tmp_prestacion, $tmp_nuevo_estado, $tmp_nota);
    }
    
    private function cambio_prestacion($tic) {
    }
    
    private function asociar($tic) {
    }
}