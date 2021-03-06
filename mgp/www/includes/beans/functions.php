<?php

   function DatetoISO8601($tstamp='') {
        if($tstamp==='')
            $tstamp=date('Y-m-d H:i:s');
        return str_replace(array('-',':',' '),array('','','T'),$tstamp);
   }
   
   function DatetoLocale($tstamp='') {
        if($tstamp==='')
            $tstamp=date('d/m/Y H:i:s');
        $p = explode('-',  str_replace(array(':','/',' ','Z'), array('-','-','-','-'), $tstamp));
        
        if(count($p)==6)
            return $p[2]."/".$p[1]."/".$p[0]." ".$p[3].":".$p[4].":".$p[5];
        else
            return $p[2]."/".$p[1]."/".$p[0];
   }
   
   /** Convertir de los formatos de ISO8601 al formato Date de MYSQL
    *  
    * @param type $tstamp
    * @return type
    */
   function ISO8601toDate($tstamp='') {
        if($tstamp==='')
            return date('Y-m-d H:i:s');
        
        $a = $m = $d = $h = $n = $s = 0;    
        $p = explode('T',  str_replace(array(':','/',' ','Z'), array('','','',''), $tstamp));
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
            //Time Zone (no le doy bola)
            return "{$a}-{$m}-{$d} {$h}:{$n}:{$s}";
        }
        elseif(count($p)==1)
        {
            //Solo Fecha
            if(strlen($p[0])==8) {
                $a = substr($p[0], 0, 4);
                $m = substr($p[0], 4, 2);
                $d = substr($p[0], 6, 2);
            }
            return "{$a}-{$m}-{$d}";            
        }

        return date('Y-m-d H:i:s');
    }

    // 2013-08-17 12:29:38
    function DateToTimestamp($tstamp) {
        $p = explode(":",str_replace(array("-"," "), array(":",":"), $tstamp));
        //error_log("DateToTimestamp($tstamp) ".print_r($tstamp));
        if(count($p)==6)
            return mktime(intval($p[3],10), intval($p[4],10), intval($p[5],10), intval($p[1],10), intval($p[2],10), intval($p[0],10));
        else
            return null;
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
        
        if($nacimiento=='')
            return 0;
        
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
   
   
   
   
   function timeToHuman($sec) {
        $meses = intval( $sec / (86400*30), 10);
        $semanas = intval( ($sec - ($meses * 86400*30)) / (86400*7), 10);
        $dias = intval( ($sec - ($meses * 86400*30) - ($semanas * 86400 * 7)) / 86400, 10);
        $horas = intval( ($sec - ($meses * 86400*30) - ($semanas * 86400 * 7) - ($dias*86400)) / 3600, 10);
        $minutos = intval( ($sec - ($meses * 86400*30) - ($semanas * 86400 * 7) - ($dias*86400) - ($horas*3600)) / 60, 10);
        
        return ($meses==1 ? "1 mes " : "").($meses>1 ? "{$meses} meses " : "").
               ($semanas==1 ? "1 sem. " : "").($semanas>1 ? "{$semanas} sem. " : "").
               ($dias==1 ? "1 día " : "").($dias>1 ? "{$dias} días " : "").
               ($horas==1 ? "1 hora " : "").($horas>1 ? "{$horas} horas " : "").
               ($minutos==1 ? "1 min. " : "").($minutos>1 ? "{$minutos} min. " : "");
    }
    
     /**
     * Calcular la desviacion standard
     * 
     * @param float[] $aValues
     * @param boolean $bSample
     * @return float
     */
    function standard_deviation($aValues, $bSample = false)
    {
        $fMean = array_sum($aValues) / count($aValues);
        $fVariance = 0.0;
        foreach ($aValues as $i)
        {
            $fVariance += pow($i - $fMean, 2);
        }
        $fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );
        return (float) sqrt($fVariance);
    }
    
       /** Convertir de los formatos de ISO8601 al formato Date de MYSQL
    *  
    * @param type $tstamp
    * @return type
    */
   function ISO8601toLocale($tstamp='') {
        if($tstamp=='')
            return date('d/m/Y H:i:s');
        
        $a = $m = $d = $h = $n = $s = 0;    
        $p = explode('T',  str_replace(array(':','/',' ','Z'), array('','','',''), $tstamp));
        
        //Si tiene dos partes, es porque hay fecha y hora
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
            //Time Zone (no le doy bola)
            return "{$d}/{$m}/{$a} {$h}:{$n}:{$s}";
        }
        elseif(count($p)==1)
        {
            //Tiene una sola parte, Solo Fecha
            if(strlen($p[0])==8) {
                $a = substr($p[0], 0, 4);
                $m = substr($p[0], 4, 2);
                $d = substr($p[0], 6, 2);
            }
            return "{$d}/{$m}/{$a}";            
        }

        return date('d/m/Y H:i:s');
    }

    function localeToISO8601($tstamp='') {
        if($tstamp==='')
            return date('YmdTHis');
        
        $a = $m = $d = $h = $n = $s = 0;    
        $p = explode(':',  str_replace(array(':','/','-',' '), array(':',':',':',':'), $tstamp));
        if(count($p)==6) {
            //Fecha
            $a = sprintf("%04d",intval($p[2],10));
            $m = sprintf("%02d",intval($p[1],10));
            $d = sprintf("%02d",intval($p[0],10));
            
            //Hora
            $h = sprintf("%02d",intval($p[3],10));
            $n = sprintf("%02d",intval($p[4],10));
            $s = sprintf("%02d",intval($p[5],10));
             
            //Time Zone (no le doy bola)
            return "{$a}{$m}{$d}T{$h}{$n}{$s}";
        }
        elseif(count($p)==3)
        {
            //Solo Fecha
            $a = sprintf("%04d",intval($p[2],10));
            $m = sprintf("%02d",intval($p[1],10));
            $d = sprintf("%02d",intval($p[0],10));
            return "{$a}{$m}{$d}";            
        }

        return date('d/m/Y H:i:s');
    }
    
    /** Convierte una lista separada por comas en un string apto para el sql
     * 
     * @param string $lista
     * @return string
     */
    function toSqlList($lista) {
        $sql = "";
        foreach( explode(",",$lista) as $opc) {
            $sql .= ($sql!="" ? "," : "")."'".trim($opc)."'";
        }
        return $sql;
    }