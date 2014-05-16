<?php

if (!class_exists('softversion')) {
    include_once "common/cfield.php";

    class softversion {

        public function Render(ccontext $context) {
            $html = "";
            
            $softversion = file_get_contents(HOME_PATH . "www/version.txt");
            $arrvers = explode("|", $softversion);

            $html.= "Versión " . $arrvers[0] . " fecha: " . $arrvers[1];
            $context->add_content($context->m_key, $html);
            
            return;
        }

    }

}

