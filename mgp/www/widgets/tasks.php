<?php

class tasks {

    static private $h = '   <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon-tasks"></i>
                                <span class="badge badge-grey">{{cantidad}}</span>
                            </a>

                            <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="icon-ok"></i>
                                    {{cantidad}} Tareas pendientes
                                </li>
                                
                                {{tareas}}
                                
                                <li>
                                    <a href="{{url_tareas}}">
                                        Ver todas las tareas
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        ';
    static private $h_msg = '   <li>
                                    <a href="{{url_tarea}}">
                                        <div class="clearfix">
                                            <span class="pull-left">{{tarea}}</span>
                                            <span class="pull-right">{{avance_tarea}}</span>
                                        </div>

                                        <div class="progress progress-mini ">
                                            <div style="width:{{avance_tarea}}" class="progress-bar "></div>
                                        </div>
                                    </a>
                                </li>
                            ';
                     
     function render(ccontext $context) {
        global $sess;

        $pars = array(
            "{{cantidad}}" => "0",
            "{{tareas}}" => "",
            "{{url_tareas}}" => $sess->encodeURL(""),
        );
        $html = str_replace(array_keys($pars), array_values($pars), self::$h);
        $context->add_content("html", $html, true);
    }

}
