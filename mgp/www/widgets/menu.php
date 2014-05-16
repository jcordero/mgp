<?php

class menu {
    function render(ccontext $context) {
        
        if(function_exists('apc_fetch')) {
            $m = apc_fetch('menu_'.session_id());
            if($m!==false) {
                $context->add_content("html",$m);
                error_log("menu desde cache APC");
                return;
            }
        }

        if(file_exists(WWW_PATH."temp/".session_id().".htm")) {
            $m = file_get_contents(WWW_PATH."temp/".session_id().".htm");
        } elseif (file_exists(WWW_PATH."temp/".session_id().".js")) {
            $m = file_get_contents(WWW_PATH."temp/".session_id().".js");
        } else {
            error_log("getmenu NO ENCONTRO EL MENU !!! path".WWW_PATH."temp/".session_id().".htm");
        }
        error_log("menu desde cache archivo en disco");
        
        if(function_exists('apc_fetch')) {
            apc_store('menu_'.session_id(), $m, (defined("A4609_SESS_TIMEOUT") ? A4609_SESS_TIMEOUT : 20)*60);
        }

        $context->add_content("html", $m);
    }
}
