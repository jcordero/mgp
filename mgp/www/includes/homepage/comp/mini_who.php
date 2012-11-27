<?php 

if(!class_exists('mini_who'))
{
	class mini_who
	{
		public function Render($context)
		{
			global $sess;
			
			//Busco el avatar del perfil, o uno por defecto si no esta declarado
			$arch = "'".$_SESSION["avatar"]."'";
			 			
			$html = '
				<script>$(document).ready(function(){ $("#userAvatarSmall").html("<img src='.$arch.'/>"); });</script>
				<div id="userName">'.$sess->user_name.'</div>
				<div id="userAvatarSmall"></div>';		
			
			$content["mini_who"] = $html;
			return array( $content, array() );
		}
	}
}

?>	
