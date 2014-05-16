<?php

class breadcrumb {
    static private $h = '<li>
                            <i class="icon-home home-icon"></i>
                            <a href="/index.php">Home</a>
                        </li>';
/*
                        <li>
                            <a href="#">Other Pages</a>
                        </li>
                        <li class="active">Blank Page</li>';
 */
    function render(ccontext $context) {
        if(isset($context->m_content["title"])) {
            $html = self::$h." <li>".
                                "<a href=\"#\">{$context->m_content["title"]}</a>".
                            " </li>";
            $context->add_content("html",$html,true);
        } else {
            $context->add_content("html",self::$h,true);
        }
    }
}

