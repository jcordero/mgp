<?php
include_once "presentation/selectarray.php";

class CDH_ESTADO_PRESTACION extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $this->m_array = array(
                'pendiente'             =>  "<span class='label label-info'>pendiente</span>",
                'inspección'            =>  "<span class='label label-info'>inspección</span>",
                'en curso'              =>  "<span class='label label-warning'>en curso</span>",
                'en espera'             =>  "<span class='label label-warning'>en espera</span>",
                'resuelto'              =>  "<span class='label label-success'>resuelto</span>",
                'rechazado'             =>  "<span class='label label-inverse'>rechazado</span>",
                'rechazado indebido'    =>  "<span class='label label-inverse'>rechazado indebido</span>",
                'cerrado'               =>  "<span class='label label-success'>cerrado</span>",
                'certificación'         =>  "<span class='label label-info'>certificación</span>"
            );
        }
}