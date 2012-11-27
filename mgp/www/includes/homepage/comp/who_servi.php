<?php 

if(!class_exists('who_servi'))
{
	class who_servi
	{
		public function Render($context)
		{
			global $sess;
			
			//Busco el avatar del perfil, o uno por defecto si no esta declarado
			$arch = "'".$_SESSION["avatar"]."'";
			 
			//Lista de grupos
			$grp = "";
			foreach(explode(",",$sess->groups) as $grp_name)
			{
				$grp_name = strtolower(trim($grp_name));
				if( substr($grp_name,0,5)=="home_" )
				{
					//Nada
				}	
				elseif( substr($grp_name,0,6)=="canal_" )
				{
					//Nada
				}
				elseif( substr($grp_name,0,13)=="gestionadora_" )
				{
					//Nada
				}	
				else
				{
					$grp.= $grp_name." ";
				}
			}
			if($grp=="") $grp="Ninguno";
			
			$html = '
			<div id="who">
				<script>$(document).ready(function(){ $("#userAvatar").html("<img src='.$arch.'/>"); });</script>
				<div id="userAvatar"></div>
				<div id="userName">'.$sess->user_name.'</div>  
				<div id="userGroup">Roles:'.$grp.'</div>
			</div>';		
			
			$content["who_servi"] = $html;
			return array( $content, array() );
		}
	}
}

?>	
