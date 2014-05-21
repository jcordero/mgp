<?php
include_once 'common/cuser.php';

class identity {
    static private $h = '
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="{{url_avatar}}" alt="{{alt_avatar}}" />
                                <span class="user-info">
                                    <small>Bienvenido,</small>
                                    {{nombre}}
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <!--    <li>
                                    <a href="{{url_ajustes}}">
                                        <i class="icon-cog"></i>
                                        Ajustes
                                    </a>
                                </li> -->

                                <li>
                                    <a href="{{url_perfil}}">
                                        <i class="icon-user"></i>
                                        Perfil
                                    </a>
                                </li>

                                <li class="divider"></li>

                                    {{home_pages}}
                                    
                                <li class="divider"></li>

                                <li>
                                    <a href="{{url_salir}}">
                                        <i class="icon-off"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        ';
            
    function render(ccontext $context) {
        global $sess;
        $usr = cuser::factoryFromSession();
        
        //Determino las homes de este usuario
        //Lista de grupos
        $homes = "";
        foreach(explode(",",$sess->groups) as $grp_name)
        {
            $grp_name = strtolower(trim($grp_name));
            if( substr($grp_name,0,5)=="home_" )
            {
                $home = substr($grp_name, 5);
                $homes .= '<li>
                                <a href="/mgp/index.php?h='.$grp_name.'">
                                    <i class="glyphicon glyphicon-home"></i>
                                    '.$home.'
                                </a>
                            </li>';
            }	
        }
        
        
        $pars = array(
            "{{url_avatar}}"    =>  $usr->getAvatar(),
            "{{alt_avatar}}"    =>  $usr->getUserName(),
            "{{nombre}}"        =>  $usr->getUserName(),
            "{{url_ajustes}}"   =>  $sess->encodeURL(""),
            "{{url_perfil}}"    =>  $sess->encodeURL("/mgp/modules/security/mydata.php?OP=M"),
            "{{url_salir}}"     =>  $sess->encodeURL("/mgp/modules/security/logout.php"),
            "{{home_pages}}"    =>  $homes
        );
        $html = str_replace( array_keys($pars), array_values($pars), self::$h);
        $context->add_content("html",$html,true);
    }
}

