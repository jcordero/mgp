<?php

class miciudad_crossreference {
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
}