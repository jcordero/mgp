<?php 
include_once "common/cdatatypes.php";

class CDH_LUMINARIA extends CDataHandler
{
    function __construct($parent) 
    {
        parent::__construct($parent);
    }

    function objectFactoryQuery($relax) 
    {
        $fld = $this->m_parent;
        $val = $fld->getValue();
        $name = strtolower($fld->m_Name);

        if($val!=="") 
        {
            $sql=$name." LIKE '%\"id_luminaria\":{$val},%'";
        } 
        else
        {
            $sql="";
        }

        return $sql;
    }
	

}