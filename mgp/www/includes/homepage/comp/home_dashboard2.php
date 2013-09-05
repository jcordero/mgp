<?php 
if(!class_exists('home_dashboard2'))
{
	class home_dashboard2
	{
            public function Render($context)
            {
                $includes = array();
                $content = array();
                $errors = array();
                                
                $html = '';
                
		$content["home_dashboard2"] = $html;
		return array( $content, $errors, $includes );
	}
        
    }
    
}

