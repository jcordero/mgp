<?php 

if(!class_exists('shortcuts'))
{
	include_once "homepage/callsession.php";
	
	class shortcuts
	{
  		private $m_session;
  		
		function __construct()
	    {
		    $this->m_session = new callsession();
		}
		
		public function Render($context)
		{
			global $sess,$primary_db;
			$html = "";			
			//Solo lo muestro para el home page "home_operator"
			if( strpos($sess->groups,"home_operator")!==false ) {
				$html.= "<div id=\"shortcuts\"><div class=\"titulo_texto\">Atajos</div><div id=\"shortcuts_result\">";
	
	            $sql = "SELECT sat_descripcion,sat_url FROM sho_atajos where sin_code in (1)";
	            $re = $primary_db->do_execute($sql);
	            while( $myrow = $primary_db->_fetch_row($re) )
	            {
	                $html.= '<div class="link"><a href="'.$myrow['sat_url'] .'" target="_new">'.$myrow['sat_descripcion'].' <img src="'.WEB_PATH.'/images/default/ico_links.gif" border="0"></a></div>';
	            }
	            $html.= '</div>'; //cierro shortcuts_result
	     		$html.= '</div>'; //cierro shortcuts
			}
			$content["shortcuts"] = $html;
			return array( $content, array() );
		}
	}
}

?>	
