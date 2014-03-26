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
    
    static function convertToText($val) {
        switch($val) {
            case 165:
                return "NO";
            case 166:
                return "SI";
            case 168:
                return "En el balneario";
            case 169:
                return "En la playa";
            case 170:
                return "En espacios verdes anexos";
            default:
                return $val;
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