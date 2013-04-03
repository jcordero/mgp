<?php

class call_status
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
    
    function __construct()
    {
		$this->loadSession();
	}

    public function loadSession()
    {
        if( isset($_SESSION['call_status']) )
        {
            $cs = unserialize( $_SESSION['call_status'] );
            $this->talk_status = $cs->talk_status;
            $this->talk_begin = $cs->talk_begin;
            $this->talk_end = $cs->talk_end;
            $this->talk_ani = $cs->talk_ani;
            $this->talk_last_ani = $cs->talk_last_ani;
            $this->talk_entry_point = $cs->talk_entry_point;
            $this->talk_session = $cs->talk_session;
            $this->talk_last_session = $cs->talk_last_session;
            $this->talk_call_id = $cs->talk_call_id;
            $this->talk_skill = $cs->talk_skill;
            $this->session = session_id();
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
            $this->session = session_id();
        }
    }

    public function saveSession()
    {
    	$_SESSION['call_status'] = serialize($this);
    }
    
    public function toJSON() {
    	return json_encode($this);
    }
}

?>