<?php
include_once "homepage/callsession.php";

class class_ciu_sesiones_hooks extends cclass_maint_hooks
{

    //Tomo de la sesion los datos que corresponden a la sesion
    //Esto permitirá cargar el registro desde la base
    //Al ejecutarse, ya se cargaron los parametros del POST, pero todavia no se leyeron datos de la base
    public function afterLoadForm()
    {
        global $primary_db;
		$obj = $this->m_data;
        $cse_code = $obj->getField("cse_code")->getValue();
        if($cse_code=="")
        {
            $cse_code = $_SESSION['talk_session'];
            $obj->getField("cse_code")->setValue($cse_code);
            $obj->m_old_pkey = "cse_code=$cse_code|";

            //Cierro la sesion - indicando la duracion de la misma en segundos
            $sql = "UPDATE ciu_sesiones SET cse_duracion=TIMESTAMPDIFF(SECOND,cse_tstamp,NOW()),cse_estado='CERRADA' WHERE cse_code='$cse_code' ";
            $primary_db->do_execute($sql);

            $m_session = new callsession();
            $m_session->person_status = 'ANONIMO';
            $m_session->person_doc = '';
            $m_session->person_nombres = '';
            $m_session->person_apellido = '';
            $m_session->person_id = 0;

            $m_session->talk_status = 'EN ESPERA';
            $m_session->talk_begin = 0;
            $m_session->talk_end = 0;
            $m_session->talk_last_ani = $m_session->talk_ani;
            $m_session->talk_ani = '';
            $m_session->talk_entry_point = '';
            $m_session->talk_last_session = $m_session->talk_session;
            $m_session->talk_session = 0;
            $m_session->saveSession();

            //Creo un speech de sarasa para el operador sobre la sesion que termina
        }
        return array();
    }

}
?>