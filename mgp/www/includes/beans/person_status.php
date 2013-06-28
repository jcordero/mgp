<?php

class person_status
{
    public $person_status;
    public $person_doc;
    public $person_nombres;
    public $person_apellido;
    public $person_id;
    public $person_cops_id;
    public $person_sexo;
    public $person_edad;
    public $person_pais;
    
    function __construct()
    {
	$this->loadSession();
    }

    public function loadSession()
    {
        if( isset($_SESSION['person_status']) )
        {
            $ps = unserialize($_SESSION['person_status']);
            $this->person_status 	= $ps->person_status;
            $this->person_doc 		= $ps->person_doc;
            $this->person_nombres 	= $ps->person_nombres;
            $this->person_apellido 	= $ps->person_apellido;
            $this->person_id	 	= $ps->person_id;
            $this->person_cops_id 	= $ps->person_cops_id;
            $this->person_sexo 		= $ps->person_sexo;
            $this->person_edad 		= $ps->person_edad;
            $this->person_pais 		= $ps->person_pais;
        }
	else                
        {
            $this->reset();
        }
    }

    public function saveSession()
    {
    	$_SESSION['person_status'] = serialize($this);
    }
    
    public function reset() {
    	$this->person_status 	= 'ANONIMO';
    	$this->person_doc 	= '';
    	$this->person_nombres 	= '';
    	$this->person_apellido 	= '';
    	$this->person_id 	= 0;
    	$this->person_cops_id 	= 0;
    	$this->person_sexo 	= 'N';
    	$this->person_edad 	= 0;
    	$this->person_pais 	= "ARG";
    }
    
    public function toJSON() {
    	return json_encode($this);
    }
}

?>