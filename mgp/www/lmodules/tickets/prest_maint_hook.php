<?php

class class_tic_prestaciones_hooks extends cclass_maint_hooks
{
    public function afterSaveDB() {
        $res = array();
        $content = array();
        $obj = $this->m_data;
        
        //Reseteo el tree
        $tree = $obj->getField("tpr_code")->m_DataHandler;
        $key = md5($tree->m_fill_sql);
        if(function_exists("apc_clear_cache")){
            apc_clear_cache("user");
            error_log("class_tic_prestaciones_hooks::afterSaveDB() Elimino tree del cache");
        }
        
        return array($content,$res);
    }
}
