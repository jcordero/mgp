<?php

/* Los indicadores se acumulan por horas y por días */
class probe {
    function measure($name, $value) {
        global $primary_db;
        
        //Codigo del probe tin_code, tor_code, tim_tstamp, tim_valor
        $tin_code = self::getCode($name);
        
        //Existe la muestra de la hora?
    }
    
    static function getCode($name) {
        global $primary_db;
        
        //Lo busco en el cache
        if(function_exists('apc_fetch')) {
            $c = apc_fetch('probe.'.$name);
            if($c!==false)
                return $c;
        }
        
        //Lo busco en la tabla
        $c = $primary_db->QueryString("select tin_code from tic_indicadores where tin_nombre='{$name}'");
        if($c!=='' && function_exists('apc_store'))
            apc_store ('probe.'.$name, $c);
        
        return $c;
    }
}