<?php
include_once "beans/call_status.php";
include_once "beans/person_status.php";
include_once "beans/functions.php";

class ciu_ciudadanos_n_hooks extends cclass_maint_hooks
{
    
    //Despues de salvar los datos del ciudadano, hay que activar la sesion como identificado
    public function afterSaveDB()
    {
        global $primary_db;
        $contenido = array();
        $errores = array();
	$obj = $this->m_data;
	$m_session = new call_status();
	$m_person = new person_status();
			
        $ciu_code = $obj->getField("ciu_code")->getValue();
        $ciu_apellido = $obj->getField("ciu_apellido")->getValue();
        $ciu_nombres = $obj->getField("ciu_nombres")->getValue();
        $sexo = $obj->getField("ciu_sexo")->getValue();
        $nacimiento = $obj->getField("ciu_nacimiento")->getValue();
        $ciu_nacionalidad = $obj->getField("ciu_nacionalidad")->getValue();
        $tmp_doc = $obj->getField("tmp_doc")->getValue();
        
        if($ciu_apellido!="")
        {
            $m_person->person_status = 'IDENTIFICADO';
            $m_person->person_apellido = $ciu_apellido;
            $m_person->person_nombres = $ciu_nombres;
            $m_person->person_doc = $tmp_doc;
            $m_person->person_id = $ciu_code;
            $m_person->person_sexo = $sexo;
            $m_person->person_edad = calcularEdad($nacimiento);
            $m_person->person_pais = $ciu_nacionalidad;
   
            $m_person->saveSession();
            
            //Si esta conectado actualizo la base
            if($m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='{$ciu_code}' WHERE cse_code='{$m_session->talk_session}'";
                $primary_db->do_execute($sql);
            }
        }
        
        //Salvo el documento de esta persona
        $sql = "insert into ciu_identificacion(ciu_code, ciu_nro_doc) values(:ciu_code:, ':ciu_nro_doc:')";
        $params = array(
            'ciu_code'      => $ciu_code,
            'ciu_nro_doc'   => $tmp_doc
        );
        $primary_db->do_execute($sql,$errores,$params);
        
        return array($contenido,$errores);
    }
}
