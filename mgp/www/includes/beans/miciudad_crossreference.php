<?php

class miciudad_crossreference {
    static function convertToText($val) {
        switch($val) {
            case 165:
                return "NO";
            case 166:
                return "SI";
            case 168:
                return "En el Balneario";
            case 169:
                return "En la Playa";
            case 170:
                return "En Espacios Verdes Anexos";
            default:
                return $val;
        }
    }
}