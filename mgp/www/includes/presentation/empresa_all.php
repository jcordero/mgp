<?php 
include_once "common/cdatatypes.php";

/** Hereda de implementacion servitruck. Aca no sirve*/
class CDH_EMPRESA_ALL extends CDataHandler 
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
	}
			
}
?>