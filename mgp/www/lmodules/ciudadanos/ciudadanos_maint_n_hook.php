<?php
include_once "beans/call_status.php";
include_once "beans/person_status.php";

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
            
        if($ciu_apellido!="")
        {
            $m_person->person_status = 'IDENTIFICADO';
            $m_person->person_apellido = $ciu_apellido;
            $m_person->person_nombres = $ciu_nombres;
            $m_person->person_doc = $ciu_doc_nro;
            $m_person->person_id = $ciu_code;
            $m_person->person_sexo = $sexo;
    		$m_person->person_edad = $this->calcularEdad($nacimiento);
            $m_person->person_pais = $ciu_nacionalidad;
    		    	
            $m_person->saveSession();

            //Actualizo la sesion abierta
            $m_session->talk_session = $_SESSION['talk_session'];
            
            //Si esta conectado actualizo la base
            if($m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='{$ciu_code}' WHERE cse_code='{$m_session->talk_session}'";
                $primary_db->do_execute($sql);
            }
        }
        return array($contenido,$errores);
    }
    
         
   	private function calcularEdad($nacimiento) {
    	try {
    		//Nacimiento 22/09/1968
    		$nacimiento = str_replace('/', '-', $nacimiento);
    		list($a,$m,$d) = explode("-",$nacimiento);
    		if($d>31)
    			list($d,$m,$a) = explode("-",$nacimiento);
    		
    		$ahora = date("Y");
    		
    		$edad = intval($ahora) - intval($a);
			if($edad)
	    		return $edad;
    	}
    	catch(Exception $e)
    	{
    		error_log("calcularEdad($nacimiento) $e");
    	}
    	return 0;
    }
    
}
?>