<?php
include_once "presentation/selectarray.php";

class CDH_PRESTACIONES extends CDH_SELECTARRAY 
{
	function __construct($parent) 
	{
            global $primary_db;
            parent::__construct($parent);
            
            //Esta el APC activo?
            if(function_exists('apc_fetch')) {
                $p = apc_fetch('lista_prestaciones');
                if($p!==false) {
                    $this->m_array = $p;
                    return;    
                }
            }
  
            //Busco la lista en la base
            $rs = $primary_db->do_execute("select tpr_code, tpr_detalle from tic_prestaciones where tpr_estado='ACTIVO' order by cast(tpr_code as UNSIGNED INTEGER)");
            while( $row=$primary_db->_fetch_row($rs) ) {
                $this->m_array[$row['tpr_code']] = "({$row['tpr_code']}) {$row['tpr_detalle']}";
            }
            
            //Salvo en el cache
            if(function_exists('apc_store')) 
                apc_store('lista_prestaciones',$this->m_array);
	}
}