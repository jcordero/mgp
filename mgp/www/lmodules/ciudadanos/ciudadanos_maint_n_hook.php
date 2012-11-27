<?php
include_once "homepage/callsession.php";

class ciu_ciudadanos_n_hooks extends cclass_maint_hooks
{
    
    //Despues de salvar los datos del ciudadano, hay que activar la sesion como identificado
    public function afterSaveDB()
    {
        global $primary_db;
        $contenido = array();
        $errores = array();
		$obj = $this->m_data;
		$m_session = new callsession();
		
        $ciu_code = $obj->getField("ciu_code")->getValue();
        $ciu_apellido = $obj->getField("ciu_apellido")->getValue();
        $ciu_nombres = $obj->getField("ciu_nombres")->getValue();
        $ciu_doc_nro = $obj->getField("ciu_doc_nro")->getValue();
        $sexo = $obj->getField("ciu_sexo")->getValue();
        $nacimiento = $obj->getField("ciu_nacimiento")->getValue();
        $ciu_nacionalidad = $obj->getField("ciu_nacionalidad")->getValue();
        
        //Tengo que convertir el documento al estilo SIGEHOS?
        list($tipo_doc,$nro_doc) = explode($ciu_doc_nro);
        $tipo_doc_sigehos = $this->PAIStoDOC($ciu_nacionalidad, $tipo_doc);
        
    	//Tengo el documento declarado?? Si en el DOC no puedo llamar a COPS
        if( $ciu_doc_nro!="" )
        {
			$cops_url = URL_SIGEHOS_COPS."/sigehos/cops/api/afiliado/?tipo_doc=$tipo_doc_sigehos&nro_doc=$nro_doc";
			$obj_cops = $this->askSigehos($cops_url);
			if($obj_cops)
			{
				if( isset($obj_cops->id) )	
				{
					$m_session->person_cops_id = $obj_cops->id;
				}
			}
        }
        
        if($ciu_apellido!="")
        {
            $m_session->person_status = 'IDENTIFICADO';
            $m_session->person_apellido = $ciu_apellido;
            $m_session->person_nombres = $ciu_nombres;
            $m_session->person_doc = $ciu_doc_nro;
            $m_session->person_id = $ciu_code;
            $m_session->person_sexo = $sexo;
    		$m_session->person_edad = $this->calcularEdad($nacimiento);
            $m_session->person_pais = $ciu_nacionalidad;
    		    	
            $m_session->saveSession("person");

            //Actualizo la sesion abierta
            $m_session->talk_session = $_SESSION['talk_session'];
            
            //Si esta conectado actualizo la base
            if($m_session->talk_session!=0)
            {
                $sql = "UPDATE ciu_sesiones SET ciu_code='$this->person_id' WHERE cse_code='$m_session->talk_session'";
                $primary_db->do_execute($sql);
            }
        }
        return array($contenido,$errores);
    }
    
     
    /**
     * Convertir el tipo de documento MAGICO que usa el SIGEHOS 
     * 
     * @param String $pais
     * @param String $tipo_doc
     */
	private function PAIStoDOC($pais, $tipo_doc) {
    	if($pais=="Bolivia") $tipo_doc = "CIBO";
        elseif($pais=="Brasil") $tipo_doc = "CIBR";
        elseif($pais=="Chile") $tipo_doc = "CICH";
        elseif($pais=="Paraguay") $tipo_doc = "CIPA";
        elseif($pais=="Peru") $tipo_doc = "CIPE";
        elseif($pais=="Uruguay") $tipo_doc = "CIUR";
        elseif($pais=="Argentina") { /* Acepto cualquier tipo de documento */}
		else $tipo_doc = "PAS";
		
		return $tipo_doc;
    }
    
	private function askSigehos($url)
    {
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$json = curl_exec($ch);
		curl_close($ch);
    	
		error_log("askSigehos($url) = $json");
		
		if($json=="")
		{
			return null;
		}
		return json_decode($json);
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