<?php
/** PROCESO DE ALTA DE UN NUEVO TICKET 
 * 
 * @author jcordero
 *
 */
include_once 'beans/person_status.php';
include_once 'beans/ticket.php';

class class_tic_ticket_hooks extends cclass_maint_hooks
{
    private $m_prestacion_detalle;
    private $m_identificador;
    private $m_ps;
	
    public function afterLoadForm() {
        $this->m_ps = new person_status();
        if( $this->m_ps->person_status=='ANONIMO' ) {
                return array('MENSAJE:ERROR: No se pueden emitir tickets anonimos');
        } 	
        return array();
    }
    
   
    //
    // Se ejecuta antes de salvar el objeto a la base de datos
    // Hay que completar el nro y el año del ticket
    // Si es un reclamo, salvar al SUR viejo, caso contrario en base local
    //
    // Retorna una lista de errores o un array vacio si todo esta OK
    public function beforeSaveDB()
    {
        $obj = $this->m_data;
        $res = array();
        
        $ticket = new ticket();
        $ticket->fromForm($obj);
        $ticket->save();

        //Completo los valores que se van a usar mas adelante
        $this->m_prestacion_detalle = $ticket->prestaciones[0]->tpr_description;
        $this->m_identificador = $ticket->tic_identificador;
        
        return $res;
    }

    //Retorna FALSE x que ya salve el reclamo a mano
    public function canSaveDB()
    {
        return false;
    }

    //Genera informacion para el operador despues de grabar
    //Asi le puede informar al ciudadano del resultado del registro de su
    //ticket.
    //Si se produjo un error en beforeSaveDB esta funcion NO SE EJECUTA
    public function afterSaveDB()
    {
        $res = array();
        $obj = $this->m_data;

        $prestacion = $obj->getField("prestacion")->getValue();
        $descripcion = $this->m_prestacion_detalle; 
        $identificador = $this->m_identificador;
       
        //Genero contenido para el mensaje de respuesta.
        $content['nroticket'] = $identificador;
        $content['prestacion'] = "$prestacion - $descripcion";
        $content['plazo'] = $obj->getField("tic_tstamp_plazo")->getValue();
        
        return array($content,$res);
    }
    
}
?>