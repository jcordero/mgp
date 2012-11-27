<?php 
include_once "presentation/selectarray.php";

class CDH_DERECHO extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(
"Confidencialidad, intimidad personal y familiar",
"Convivencia familiar",
"Descanso, esparcimiento, juego, actividades recreativas, culturales y deportivas",
"Educación",
"Identidad",
"Identificación y documentación",
"Medio ambiente saludable",
"No discriminación",
"Participación y asociación",
"Protección contra la explotación, trata, tráfico y secuestro",
"Protección contra la privación ilegal o arbitraria de la libertad",
"Protección contra la violencia, abuso y malos tratos",
"Protección y asistencia humanitaria en condición de refugiados y/o migrantes",
"Requerir y recibir información, ser oído y opinar",
"Salud integral",
"Seguridad jurídica y debido proceso en instancias administrativas y judiciales",
"Violencia institucional",
"Vivienda",
"Niños con capacidades diferenciadas"        );
	}
}
?>


