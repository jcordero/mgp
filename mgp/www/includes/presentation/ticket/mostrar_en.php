<?php 
include_once "presentation/checkboxes.php";

class CDH_MOSTRAR_EN extends CDH_CHECKBOXES
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_array = array(
				'web' 			=> 'Web',
				'movil' 		=> 'Móviles',
				'telefono'		=> 'Télefono',
				'en persona'	=> 'En persona'
		);
	}
}
?>