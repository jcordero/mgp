<?php

   function DatetoISO8601($tstamp='') {
        if($tstamp==='')
            $tstamp=date('Y-m-d H:i:s');
        return str_replace(array('-',':',' '),array('','','T'),$tstamp);
   }
   
   function ISO8601toDate($tstamp='') {
        if($tstamp==='')
            return date('Y-m-d H:i:s');
        
        $a = $m = $d = $h = $n = $s = 0;    
        $p = explode('T',$tstamp);
        if(count($p)==2) {
            //Fecha
            if(strlen($p[0])==8) {
                $a = substr($p[0], 0, 4);
                $m = substr($p[0], 4, 2);
                $d = substr($p[0], 6, 2);
            }
            //Hora
            if(strlen($p[1])==6) {
                $h = substr($p[1], 0, 2);
                $n = substr($p[1], 2, 2);
                $s = substr($p[1], 4, 2);
            } 
            return "{$a}-{$m}-{$d} {$h}:{$n}:{$s}";
        }
        elseif(count($p)==1)
        {
            //Fecha
            if(strlen($p[0])==8) {
                $a = substr($p[0], 0, 4);
                $m = substr($p[0], 4, 2);
                $d = substr($p[0], 6, 2);
            }
            return "{$a}-{$m}-{$d}";            
        }

        return date('Y-m-d H:i:s');
    }


    function loadOperador($use_code='') {
        global $primary_db;
        
        if($use_code==='' || intval($use_code)===0)
            return (object) array('use_code'=>'','use_name'=>'Sin especificar');
        
        return (object) array(
            'use_code'  =>  $use_code,
            'use_name'  =>  $primary_db->QueryString("select use_name from sec_users where use_code='{$use_code}'")
        );
    }

    function _g($obj,$fld) {
        if( property_exists($obj,$fld) )
            return $obj->$fld;
        else 
            return '';    
    }
