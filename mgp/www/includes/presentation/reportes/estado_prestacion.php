<?php
include_once "presentation/selectarray.php";

class CDH_ESTADO_PRESTACION extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
            parent::__construct($parent);
            $this->m_array = array(
                'pendiente'     =>  'pendiente',
                'inspección'    =>  'inspección',
                'en curso'      =>  'en curso',
                'en espera'     =>  'en espera',
                'resuelto'      =>  'resuelto',
                'rechazado'     =>  'rechazado',
                'cerrado'       =>  'cerrado',
                'certificación' =>  'certificación'
            );
        }
}