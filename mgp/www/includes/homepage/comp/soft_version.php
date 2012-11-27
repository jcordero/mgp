<?php

if (!class_exists('soft_version')) {
    include_once "common/cfield.php";

    class soft_version {

        public function Render($context) {
            $html = "";

            $softversion = file_get_contents(HOME_PATH . "www/version.txt");
            $arrvers = explode("|", $softversion);

            $html.= "Versión " . $arrvers[0] . " fecha: " . $arrvers[1];
            $content["soft_version"] = $html;
            return array($content, array());
        }

    }

}
?>
