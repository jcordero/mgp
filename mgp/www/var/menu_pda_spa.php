<?php
/* Archivo definicion menu PDA de la aplicacion
 * Generado automaticamente
 * NO MODIFICAR A MANO!
 */
	if(isset($_SESSION["cache_menu_pda"]) && $_SESSION["cache_menu_pda"]!="") 
	{ 
		echo $_SESSION["cache_menu_pda"]; 
	} 
	else 
	{
		include_once "common/csession.php";
		$sess = new CSession();
		$sess->Load();
		ob_flush();
		ob_start();
?>
<?php
		$_SESSION["cache_menu_pda_js"]=ob_get_contents();
	}
?>