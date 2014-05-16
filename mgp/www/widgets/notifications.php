<?php

class notifications {
    static private $h = '
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-bell-alt icon-animated-bell"></i>
                                <span class="badge badge-important">{{cantidad}}</span>
                            </a>

                            <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="icon-warning-sign"></i>
                                    {{cantidad}} Notificaciones
                                </li>
                                
                                {{notificaciones}}
                                
                                <li>
                                    <a href="{{url_notificaciones}}">
                                        Ver todas las notificaciones
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        ';
    static private $h_msg = '<li>
                                    <a href="{{url_mensaje}}">
                                        <div class="clearfix">
                                            <span class="pull-left">
                                                <i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
                                                {{mensaje}}
                                            </span>
                                            <span class="pull-right badge badge-success">{{cantidad}}</span>
                                        </div>
                                    </a>
                                </li>
                                ';

    
    function render(ccontext $context) {
        global $sess;

        $pars = array(
            "{{cantidad}}" => "0",
            "{{notificaciones}}" => "",
            "{{url_notificaciones}}" => $sess->encodeURL(""),
        );
        $html = str_replace(array_keys($pars), array_values($pars), self::$h);
        $context->add_content("html", $html, true);
    }
}
