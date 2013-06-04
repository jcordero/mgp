<?php 
include_once "presentation/selectarray.php";

class CDH_GISGRILLA extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		//$fld = $this->m_parent;
		//$grillas = $this->pedirGrillasUsig();
		//if(is_array($grillas)) {
                //    foreach($grillas as $grilla)
                //    {
                //            $opciones[$grilla] = $grilla;
                //   }
                //    $this->m_array = $opciones;
		//}
                $this->m_array = array(
                    "1" => "Barrios",
                    "2" => "Zonas de luminarias"
                );
	}
	
	private function pedirGrillasUsig()
	{
		$resp = array();
		
		//Existe el cache?
		if( file_exists(HOME_PATH."temp/delimitaciones.json") )
		{
			$delim = file_get_contents(HOME_PATH."temp/delimitaciones.json");
			return json_decode($delim);
		}
		
		//Pido via web service
		try
                {
			$host = $_SERVER["HTTP_HOST"];
                        $ch = curl_init("http://$host/direcciones/proxyjson.php?method=delimitacionesDisponibles");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT,20);
			$output = curl_exec($ch);
			if($output!=false)
			{
				$resp = json_decode($output);

				//Salvo al cache
				file_put_contents(HOME_PATH."temp/delimitaciones.json",$output);
			}    	
                }
                catch (SoapFault $ex) 
                        { 
                                error_log( "pedirGrillasUsig() delimitacionesDisponibles() ->".$ex->getMessage() );       
                        }
                catch (Exception $ex) 
                { 
                        error_log( "pedirGrillasUsig() delimitacionesDisponibles() ->".$ex->getMessage() );       
                }
                return $resp;
        }
}
?>