<?php
include_once 'beans/functions.php';

class eventbus_event {
    
    public $eev_code;
    public $eev_tstamp_in;
    public $eev_tstamp_out;
    public $eev_task;
    public $eev_data;
    public $eev_status;
    public $eev_error_msg;
    
    function save() {
        global $primary_db;
        $err=array();
                    
        $sql = "insert into eve_events(eev_code  , eev_tstamp_in, eev_tstamp_out, eev_task    , eev_data    , eev_status , eev_error_msg) 
                                values(:eev_code:, NOW()        , null          , ':eev_task:', ':eev_data:', 'pendiente', null         )";
        $params = array(
            'eev_code'      =>  $primary_db->Sequence('eve_events'),
            'eev_task'      =>  $this->eev_task, 
            'eev_data'      => json_encode($this->eev_data,JSON_UNESCAPED_UNICODE)
        );
        $primary_db->do_execute($sql,$err,$params);

        return $err;
    }
    
    public function load($row) {
        $this->eev_code = $row['eev_code'];
        $this->eev_tstamp_in = $row['eev_tstamp_in'];
        $this->eev_tstamp_out = $row['eev_tstamp_out'];
        $this->eev_task = $row['eev_task'];
        $this->eev_data = json_decode($row['eev_data']);
        $this->eev_status = $row['eev_status'];
        $this->eev_error_msg = $row['eev_error_msg'];
    }
    
    public function setStatus($status, $err, $update_tstamp=false) {
        global $primary_db;
        error_log("eventbus_event::setStatus(\$status=$status, \$err=$err)");
        $tstamp = ($update_tstamp ? ', eev_tstamp_out=NOW()' : '');
        $primary_db->do_execute("update eve_events set eev_status='{$status}', eev_error_msg='{$err}' {$tstamp} where eev_code='{$this->eev_code}'");
    }
}