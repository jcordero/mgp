<?php

class miciudad_crossreference {
    public static $rubros = array(
        176 => array(1, "Supermercado"), 
        177 => array(2, "Despensa"),
        178 => array(3, "Fiambrería"),
        179 => array(4, "Restaurante"),
        180 => array(5, "Comidas para llevar"),
        181 => array(6, "Rotisería"), 
        182 => array(7, "Pizzería"),
        183 => array(8, "Parrilla"),
        184 => array(9, "Venta Mayorista"),
    );
    
    public static $valores = array(
        165 => "NO",
        166 => "SI",
        168 => "En el balneario",
        169 => "En la playa",
        170 => "En espacios verdes anexos",
        
        171 => "Bebidas",
        172 => "Conservas", 
        173 => "Productos frescos",
        174 => "Comidas elaboradas y envasadas",
        
        175 => "Productos frescos",
        176 => "Comidas elaboradas y envasadas",
   
        177 => "1 a 5",
        178 => "6 a 10",
        179 => "Más de 10",
        
        180 => "Bebidas",
        181 => "Conservas",
        182 => "Productos frescos",
        183 => "Comidas elaboradas y envasadas",
        
        184 => "Productos frescos",
        185 => "Comidas elaboradas y envasadas"
    );
    
    static function convertToText($val) {
        if(isset(self::$valores[$val])) {
            return self::$valores[$val];
        } else {
            return "";
        }         
    }
    
    static function convertToRubro($val) {
        if(isset(self::$rubros[$val])) {
            return self::$rubros[$val];
        } else {
            return array(0,"");
        }         
    }
}