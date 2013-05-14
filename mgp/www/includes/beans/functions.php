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
        global $primary_db,$sess;
        
        if($use_code==='' || intval($use_code)===0)
            return (object) array('use_code'=>'','use_name'=>'Sin especificar');

        if(strtolower($use_code)==='current')
            return (object) array(
                'use_code'  =>  $sess->getUserId(),
                'use_name'  =>  $sess->getUserName()
        );    
        
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

    function _F($obj, $campo) {
        global $primary_db;
        return $primary_db->Filtrado($obj->getField($campo)->getValue());
    }

    function calcularEdad($nacimiento) {
    	try {
            //Nacimiento 22/09/1968
            $nacimiento = str_replace('/', '-', $nacimiento);
            list($a,$m,$d) = explode("-",$nacimiento);
            if($d>31)
    		list($d,$m,$a) = explode("-",$nacimiento);
    		
            $ahora = date("Y");
            $anios = intval($ahora) - intval($a);
            
            //Ya cumplio?
            if( date("n")<$m || (date("n")==$m && date("j")<$d))
                $anios--;
            
            if($anios)
	    	return $anios;
    	}
    	catch(Exception $e)
    	{
    		error_log("calcularEdad($nacimiento) $e");
    	}
    	return 0;
   }