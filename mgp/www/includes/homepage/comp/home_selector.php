<?php

class home_selector {
    public function Render($context)
    {
        $includes = array(); 
        
        //Crear un menu para elegir la home page
        $html = '<a id="home_selector" href="#"><img src="'.WEB_PATH.'/images/default/profile_large.gif"></a>';
        $html.= '<div class="hide" id="home_selector_panel">Home: <select onchange="cambio_home(this)">';
        
        $dh = (object) array("home"=>"", "groups"=>array());
        if( isset($_SESSION['dynhome']) ) {
            $dh = json_decode($_SESSION['dynhome']);
            $homes = $dh->groups;
        } else {
            $homes = $this->crearListaHomes();
        }
        
        foreach($homes as $gr) {
            if($gr == $dh->home)
                $html.= '<option value="'.$gr.'" selected>'.substr($gr,5);
            else
                $html.= '<option value="'.$gr.'">'.substr($gr,5);
        }

        
        $html.= '</select></div>';
        $style = "
        <style>
            #home_selector {heigth:32px; width:32px; cursor:hand;z-index:10;float:right;margin-top: -23px;}
            #home_selector_panel {position:absolute;padding:15px;border:1px solid #444;border-radius:8px;background:#ddd;top:40px;}
        </style>";
        
        $content["home_selector"] = $style.$html; //.'<script type="text/javascript">'.file_get_contents('./includes/homepage/comp/home_selector.js').'</script>';
        $includes[] = '<script type="text/javascript" src="./includes/homepage/comp/home_selector.js"></script>';
        return array( $content, $includes );
    }
    
    function crearListaHomes() {
        global $sess;

        $groups = $sess->getGroups();
        $home_groups = array();

        foreach($groups as $gr)
        {
            $usr_gr = strtolower(trim($gr));
            if(substr($usr_gr,0,5)=="home_")
                $home_groups[] = $usr_gr;
        }

        return $home_groups;
    }

}