<?php
include_once 'beans/ticket.php';
include_once 'common/cfile.php';
include_once 'beans/archivo.php';
include_once 'beans/avance.php';

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
                //Solo agrego archivos adjuntos?
                break;
        }
        
        //Proceso los archivos adjuntos
        if(count($err)===0) {
            $tic_nro = $obj->getField("tic_nro")->getValue();
            
            //Agrego los archivos al ticket
            $e = archivo::saveFormFiles($tic_nro);
            if(count($e)>0) {
                $err = array_merge($err, $e);
            } else {
                //Agrego un registro de actividad
                //Como esta ahora, los avances se refieren a los cambios de estado del ticket
                //Se podria agregar a los eventos del ciudadano (se agrego foto ... al ticket #/2013)
            }  
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