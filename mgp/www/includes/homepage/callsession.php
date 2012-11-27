<?php

class callsession
{
    public $talk_status;
    public $talk_begin;
    public $talk_end;
    public $talk_ani;
    public $talk_last_ani;
    public $talk_entry_point;
    public $talk_session;
    public $talk_last_session;
    public $talk_call_id;
    public $talk_skill;

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
        if( isset($_SESSION['talk_status']) )
        {
            $this->talk_status = $_SESSION['talk_status'];
            $this->talk_begin = $_SESSION['talk_begin'];
            $this->talk_end = $_SESSION['talk_end'];
            $this->talk_ani = $_SESSION['talk_ani'];
            $this->talk_last_ani = $_SESSION['talk_last_ani'];
            $this->talk_entry_point = $_SESSION['talk_entry_point'];
            $this->talk_session = $_SESSION['talk_session'];
            $this->talk_last_session = $_SESSION['talk_last_session'];
            $this->talk_call_id = $_SESSION['talk_call_id'];
            $this->talk_skill = $_SESSION['talk_skill'];
        }
        else
        {
            $this->talk_status = 'EN ESPERA';
            $this->talk_begin = 0;
            $this->talk_end = 0;
            $this->talk_ani = '';
            $this->talk_last_ani = '';
            $this->talk_entry_point = '';
            $this->talk_session = 0;
            $this->talk_last_session = 0;
            $this->talk_call_id = "";
            $this->talk_skill = "";
            $this->saveSession("talk");
        }

        if( isset($_SESSION['person_status']) )
        {
            $this->person_status = $_SESSION['person_status'];
            $this->person_doc = $_SESSION['person_doc'];
            $this->person_nombres = $_SESSION['person_nombres'];
            $this->person_apellido = $_SESSION['person_apellido'];
            $this->person_id = $_SESSION['person_id'];
            $this->person_cops_id = $_SESSION['person_cops_id'];
            $this->person_sexo = $_SESSION['person_sexo'];
            $this->person_edad = $_SESSION['person_edad'];
            $this->person_pais = $_SESSION['person_pais'];
            error_log("CallSession -> Cargo doc:{$this->person_doc} pais:{$this->person_pais}");
        }
        else
        {
            $this->person_status = 'ANONIMO';
            $this->person_doc = '';
            $this->person_nombres = '';
            $this->person_apellido = '';
            $this->person_id = 0;
            $this->person_cops_id = 0;
            $this->person_sexo = 'N';
            $this->person_edad = 0;
            $this->person_pais = "Argentina";
            
            $this->saveSession("person");
        }
    }

    public function saveSession($part="all")
    {
        if($part=="all" || $part=="talk")
        {
            $_SESSION['talk_status'] = $this->talk_status;
            $_SESSION['talk_begin'] = $this->talk_begin;
            $_SESSION['talk_end'] = $this->talk_end;
            $_SESSION['talk_ani'] = $this->talk_ani;
            $_SESSION['talk_last_ani'] = $this->talk_last_ani;
            $_SESSION['talk_entry_point'] = $this->talk_entry_point;
            $_SESSION['talk_session'] = $this->talk_session;
            $_SESSION['talk_last_session'] = $this->talk_last_session;
            $_SESSION['talk_call_id'] = $this->talk_call_id;
            $_SESSION['talk_skill'] = $this->talk_skill;
        }

        if($part=="all" || $part=="person")
        {
            $_SESSION['person_status'] = $this->person_status;
            $_SESSION['person_doc'] = $this->person_doc;
            $_SESSION['person_nombres'] = $this->person_nombres;
            $_SESSION['person_apellido'] = $this->person_apellido;
            $_SESSION['person_id'] = $this->person_id;
            $_SESSION['person_cops_id'] = $this->person_cops_id;
            $_SESSION['person_sexo'] = $this->person_sexo;
            $_SESSION['person_edad'] = $this->person_edad;
            $_SESSION['person_pais'] = $this->person_pais;
                        
            error_log("CallSession -> Salvo doc:{$_SESSION['person_doc']} pais:{$_SESSION['person_pais']}");
        }
    }
}

?>