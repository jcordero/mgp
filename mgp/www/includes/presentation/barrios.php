<?php
include_once "presentation/selectarray.php";

/** 	Tipo de dato: Listado de barrios de Capital Federal*/
class CDH_BARRIOS extends CDH_SELECTARRAY
{
	function __construct($parent)
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
		"Agronomia"=>"Agronomia",
		"Almagro"=>"Almagro",
		"Balvanera"=>"Balvanera",
		"Barracas"=>"Barracas",
		"Belgrano"=>"Belgrano",
		"Boca"=>"Boca",
		"Boedo"=>"Boedo",
		"Caballito"=>"Caballito",
		"Chacarita"=>"Chacarita",
		"Coghlan"=>"Coghlan",
		"Colegiales"=>"Colegiales",
		"Constitucion"=>"Constitucion",
		"Flores"=>"Flores",
		"Floresta"=>"Floresta",
		"Liniers"=>"Liniers",
		"Mataderos"=>"Mataderos",
		"Monte Castro"=>"Monte Castro",
		"Monserrat"=>"Monserrat",
		"Nueva Pompeya"=>"Nueva Pompeya",
		"Nuñez"=>"Nuñez",
		"Palermo"=>"Palermo",
		"Parque Avellaneda"=>"Parque Avellaneda",
		"Parque Chacabuco"=>"Parque Chacabuco",
		"Parque Chas"=>"Parque Chas",
		"Parque Patricios"=>"Parque Patricios1",
		"Paternal"=>"Paternal",
		"Puerto Madero"=>"Puerto Madero",
		"Recoleta"=>"Recoleta",
		"Retiro"=>"Retiro",
		"Saavedra"=>"Saavedra",
		"San Cristobal"=>"San Cristobal",
		"San Nicolas"=>"San Nicolas",
		"San Telmo"=>"San Telmo",
		"Velez Sarsfield"=>"Velez Sarsfield",
		"Versalles"=>"Versalles",
		"Villa Crespo"=>"Villa Crespo",
		"Villa Del Parque"=>"Villa Del Parque",
		"Villa Devoto"=>"Villa Devoto",
		"Villa Gral. Mitre"=>"Villa Gral. Mitre",
		"Villa Lugano"=>"Villa Lugano",
		"Villa Luro"=>"Villa Luro",
		"Villa Ortuzar"=>"Villa Ortuzar",
		"Villa Pueyrredon"=>"Villa Pueyrredon",
		"Villa Real"=>"Villa Real",
		"Villa Riachuelo"=>"Villa Riachuelo",
		"Villa Santa Rita"=>"Villa Santa Rita",
		"Villa Soldati"=>"Villa Soldati",
		"Villa Urquiza"=>"Villa Urquiza"
		
		);
	}

}
?>