<?php

include_once "beans/call_status.php";
include_once "beans/person_status.php";
include_once "beans/functions.php";

class ciu_ciudadanos_n_hooks extends cclass_maint_hooks
{
    public function afterSaveDB()
    {
        $contenido = array();
        $errores = array();
        $obj = $this->m_data;
	
        //Reseteo la data del usuario (ahora que se modifico el perfil)
        $p = new person_status();
        $p->person_nombres  = $obj->getField("ciu_nombres")->getValue();
        $p->person_apellido = $obj->getField("ciu_apellido")->getValue();
        $p->person_sexo     = $obj->getField("ciu_sexo")->getValue();
        $p->person_edad     = calcularEdad($obj->getField("ciu_nacimiento")->getValue());
        $p->person_pais     = $obj->getField("ciu_nacionalidad")->getValue();
        
        $p->saveSession();
        
        return array($contenido,$errores);
    }
}
