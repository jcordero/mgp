<?php 
include_once "presentation/selectarray.php";

class CDH_MOTIVO extends CDH_SELECTARRAY
{
	function __construct($parent) 
	{
		parent::__construct($parent);
		$fld = $this->m_parent;
		$this->m_array = array(

				//Confidencialidad, intimidad personal y familiar
				"Intimidad",
				"Otros Confidencialidad, intimidad personal y familiar",
				"Protección de datos personales",

				//Convivencia familiar
				"Abandono",
				"Adopción",
				"Autorizaciones",
				"Guarda",
				"Impedimento de contacto",
				"niñas/niños en situación de calle (solo)",
				"Niño perdido",
				"Otros Convivencia familiar",
				"Patria potestad",
				"Problemas en las relaciones familiares",
				"Revinculación",
				"Se fue de la casa",
				"Tenencia",
				"Tutela",
				"Visitas",

				//Descanso, esparcimiento, juego, actividades recreativas, culturales y deportivas
				"Actividades culturales",
				"Actividades deportivas",
				"Colonia de vacaciones",
				"Educación informal",
				"Juegotecas Barriales",
				"Otros Descanso, esparcimiento, juego",
				
				//Educación
				"Acceso a educación no formal/artística",
				"Ausentismo",
				"Becas escolares",
				"Deserción escolar",
				"Discontinuidad en la asistencia escolar",
				"Niños/niñas desescolarizados",
				"Problemas de conducta/conflictos",
				"Solicitud de vacante escolar",
				
				//Identidad
				"Cultura",
				"Identidad de género",
				"Información familiar",
				"Lengua de origen",
				"Nacionalidad",
				"Nombre",
				"Otros Identidad",
				"Preservación de relaciones familiares",

				//Identificación y documentación
				"Documentos varios",
				"Emancipación, permisos y autorizaciones",
				"Filiación - impugnación de reconocimiento",
				"Filiación - modificación y/o verificación de apellidos o nombres",
				"Filiación - reconocimiento paterno",
				"Solicitud de ADN",
				
				//Medio ambiente saludable
				"Contaminación",
				"Otros Medio ambiente saludable",
				"Saneamiento (agua potable, recolección de residuos, cloacas)",
				
				//No discriminación
				"Comunidad",
				"Escuela",
				"Otros No discriminación",
				"Salud",
				
				//Participación y asociación
				"Centros de Estudiantes",
				"Conformación de grupos comunitarios",
				"Otros Participación y asociación",
				"Participación igualitaria en las instituciones formales o informales",
				
				//Protección contra la explotación, trata, tráfico y secuestro
				"Explotación laboral",
				"Explotación sexual (ejercicio de la prostitución)",
				"Niños/niñas secuestrados",
				"Otros Protección contra la explotación, trata, tráfico y secuestro",
				"Reducción a la servidumbre",
				"Tráfico de estupefacientes",
				"Trata de niños",

				//Protección contra la privación ilegal o arbitraria de la libertad
				"Niños/niñas inimputables",
				"Niños/niñas y adolescentes en comisaría",
				"Otros Protección contra la privación ilegal de la libertad",
				
				//Protección contra la violencia, abuso y malos tratos
				"Acoso",
				"Negligencia",
				"Otros Protección contra la violencia, abuso y malos tratos",
				"Pornografía infantil",
				"Presunción de abuso sexual fuera del ámbito familiar",
				"Presunción de abuso sexual intrafamiliar",
				"Violencia",
				"Violencia entre pares",
				
				//Protección y asistencia humanitaria en condición de refugiados y/o migrantes
				"Niños/niñas con grupo familiar",
				"Niños/niñas migrantes con grupo familiar",
				"Niños/niñas migrantes solos",
				"Niños/niñas solos",
				
				//Requerir y recibir información, ser oído y opinar
				"Derecho a ser informado",
				"Derecho a ser oído",
				"Derechos a ser escuchado",
				"Otros Requerir y recibir información, ser oído y opinar",
				
				//Salud integral
				"Abuso de sustancias",
				"Consumo de drogas",
				"Desnutrición/bajo peso",
				"Dificultades para ser atendido",
				"Mala praxis sanitaria",
				"Otros Salud integral",
				"Problemas relacionados con el embarazo adolescente",
				"Solicitud de tratamiento",
				"Tratamiento psiquiátrico y/o psicológico",
				
				//Seguridad jurídica y debido proceso en instancias administrativas y judiciales
				"Contravenciones",
				"Derecho a la defensa - delitos contra la integridad sexual",
				"Derecho a la defensa - delitos contra la persona",
				"Derecho a la defensa - delitos contra la propiedad",
				"Derecho a la defensa - Ley 23737",
				"Derecho a la defensa - Ley 25086",
				"Otros Seguridad jurídica y debido proceso",
				"Patrocinio jurídico gratuito",
				
				//Violencia institucional
				"Fuerzas de seguridad",
				"Instituciones de salud",
				"Institutos - Hogares",
				"Instituciones educativas",
				"Otros Violencia institucional",
				
				//Vivienda
				"Necesidad de vivienda por salud",
				"Niños en situación de calle con grupo familiar",
				"Otros Vivienda",
				"Problemas de vivienda",
				
				//Niños con capacidades diferenciadas
				"Accesibilidad a la educación",
				"Accesibilidad arquitectónica (vía pública, plazas, edificios, espacios de recreación y artísticos)",
				"Accesibilidad a prestaciones sociales",
				"Acceso a la salud",
				"Comunicación"        
			);
	}
}
?>


