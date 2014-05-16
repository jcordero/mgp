<?php

class messages {

    static private $h = '
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-envelope icon-animated-vertical"></i>
                                <span class="badge badge-success">{{cantidad}}</span>
                            </a>

                            <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="icon-envelope-alt"></i>
                                    {{cantidad}} Mensajes
                                </li>
                                
                                {{mensajes}}
                                
                                <li>
                                    <a href="{{url_ver_mensajes}}">
                                        Ver todos los mensajes
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        ';
    static private $h_msg = '
                                <li>
                                    <a href="#">
                                        <img src="{{url_avatar}}" class="msg-photo" alt="{{alt_avatar}}" />
                                        <span class="msg-body">
                                            <span class="msg-title">
                                                <span class="blue">{{nombre}}:</span>
                                                {{encabezado}}
                                            </span>

                                            <span class="msg-time">
                                                <i class="icon-time"></i>
                                                <span>{{cuando}}</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            ';

    function render(ccontext $context) {
        global $sess, $primary_db;
        
        $msgs = "";
        $rs = $primary_db->do_execute("select * from avi_messages where ame_to='{$sess->getUserId()}' order by ame_tstamp desc limit 5");
        while( $row=$primary_db->_fetch_row($rs) ){
            $pars = array(
                "{{url_avatar}}"    =>  $row["ame_avatar"],
                "{{alt_avatar}}"    =>  $row["ame_avatar_alt"],
                "{{nombre}}"        =>  $row["ame_subject"],
                "{{encabezado}}"    =>  $row["ame_body"],
                "{{cuando}}"        =>  $row["ame_tstamp"]
            );
            $msgs .= str_replace(array_keys($pars), array_values($pars), self::$h_msg);
        }

        $cant = $primary_db->QueryString("select count(*) from avi_messages where ame_to='{$sess->getUserId()}' and ame_status='PENDIENTE'");
        
        $pars = array(
            "{{cantidad}}" => $cant,
            "{{mensajes}}" => $msgs,
            "{{url_ver_mensajes}}" => "/index.php?h=inbox",
        );
        $html = str_replace(array_keys($pars), array_values($pars), self::$h);
        $context->add_content("html", $html, true);
    }

}
