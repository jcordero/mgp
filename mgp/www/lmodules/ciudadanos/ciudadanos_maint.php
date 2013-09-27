<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "ciu_ciudadanos_n.php";

//Genero las clases de los handlers

if( !class_exists('datos_personales_gr') ) {
class datos_personales_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Datos personales'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'datos_personales'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_code';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tipo_persona';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_nombres';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_apellido';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_sexo';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_nacimiento';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_nacionalidad';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_razon_social';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Cod.ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tipo_persona")->SetDisplayValues(Array("Name"=>"ciu_tipo_persona", "Label"=>"Tipo persona", "Size"=>20, "IsForDB"=>true, "Order"=>132, "Presentation"=>"CIUDADANO::TIPOPERSONA", "IsVisible"=>true, "ClassParams"=>"ciu_nombres|ciu_apellido|ciu_razon_social|ciu_sexo|ciu_nacimiento|ciu_doc_nro|ciu_nacionalidad", "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"FISICA"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nombres")->SetDisplayValues(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>102, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_apellido")->SetDisplayValues(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_sexo")->SetDisplayValues(Array("Name"=>"ciu_sexo", "Label"=>"Género", "Size"=>15, "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"CIUDADANO::SEXO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nacimiento")->SetDisplayValues(Array("Name"=>"ciu_nacimiento", "Label"=>"Fecha de Nacimiento", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"no"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nacionalidad")->SetDisplayValues(Array("Name"=>"ciu_nacionalidad", "Label"=>"Nacionalidad", "Size"=>100, "IsForDB"=>true, "Order"=>134, "IsMandatory"=>true, "Presentation"=>"CIUDADANO::NACIONALIDAD", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"Argentina"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_razon_social")->SetDisplayValues(Array("Name"=>"ciu_razon_social", "Label"=>"Razon Social", "Size"=>100, "IsForDB"=>true, "Order"=>133, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('direccion_gr') ) {
class direccion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Dirección'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'direccion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ciu_ciudadanos_n:tmp_mapa';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_calle';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_nro';
        $this->m_fields[] = 'ciu_ciudadanos_n:tmp_calle_nombre';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_piso';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_dpto';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_cod_postal';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_barrio';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_localidad';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_provincia';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_pais';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_coord_x';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_coord_y';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("tmp_mapa")->SetDisplayValues(Array("Name"=>"tmp_mapa", "Label"=>"Ubicación", "Size"=>50, "Order"=>35, "Presentation"=>"TICKET::MAPA", "IsVisible"=>true, "IsReadOnly"=>true, "Rows"=>150, "Cols"=>150, "ClassParams"=>"tic_coordx|tic_coordy", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_calle")->SetDisplayValues(Array("Name"=>"ciu_dir_calle", "Label"=>"Calle", "Size"=>50, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TICKET::CALLE", "IsVisible"=>true, "Cols"=>60, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_nro")->SetDisplayValues(Array("Name"=>"ciu_dir_nro", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>113, "Presentation"=>"TICKET::ALTURA", "IsVisible"=>true, "Cols"=>5, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("tmp_calle_nombre")->SetDisplayValues(Array("Name"=>"tmp_calle_nombre", "Label"=>"Nombre de la calle", "Size"=>50, "Order"=>38, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_piso")->SetDisplayValues(Array("Name"=>"ciu_dir_piso", "Label"=>"Piso", "Size"=>5, "IsForDB"=>true, "Order"=>114, "Presentation"=>"INT", "IsVisible"=>true, "Cols"=>5, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_dpto")->SetDisplayValues(Array("Name"=>"ciu_dir_dpto", "Label"=>"Departamento", "Size"=>5, "IsForDB"=>true, "Order"=>115, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_cod_postal")->SetDisplayValues(Array("Name"=>"ciu_cod_postal", "Label"=>"Codigo Postal", "Size"=>6, "IsForDB"=>true, "Order"=>120, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_barrio")->SetDisplayValues(Array("Name"=>"ciu_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_localidad")->SetDisplayValues(Array("Name"=>"ciu_localidad", "Label"=>"Localidad", "Size"=>50, "IsForDB"=>true, "Order"=>117, "Presentation"=>"TEXT", "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"Mar del Plata"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_provincia")->SetDisplayValues(Array("Name"=>"ciu_provincia", "Label"=>"Provincia", "Size"=>50, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT", "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"BUENOS AIRES"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_pais")->SetDisplayValues(Array("Name"=>"ciu_pais", "Label"=>"Pais", "Size"=>50, "IsForDB"=>true, "Order"=>119, "Presentation"=>"TEXT", "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"ARGENTINA"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_coord_x")->SetDisplayValues(Array("Name"=>"ciu_coord_x", "Label"=>"x", "Type"=>"double", "IsForDB"=>true, "Order"=>122, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_coord_y")->SetDisplayValues(Array("Name"=>"ciu_coord_y", "Label"=>"y", "Type"=>"double", "IsForDB"=>true, "Order"=>123, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('contacto_gr') ) {
class contacto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Contacto'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'contacto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_no_email';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_no_llamar';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_horario_cont';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tel_fijo';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tel_movil';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_email';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_no_email")->SetDisplayValues(Array("Name"=>"ciu_no_email", "Label"=>"Contactar por mail?", "Size"=>4, "IsForDB"=>true, "Order"=>111, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"NO"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_no_llamar")->SetDisplayValues(Array("Name"=>"ciu_no_llamar", "Label"=>"Contactar por teléfono?", "Size"=>4, "IsForDB"=>true, "Order"=>110, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"NO"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_horario_cont")->SetDisplayValues(Array("Name"=>"ciu_horario_cont", "Label"=>"Horario de contacto", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tel_fijo")->SetDisplayValues(Array("Name"=>"ciu_tel_fijo", "Label"=>"Telefono fijo", "Size"=>20, "IsForDB"=>true, "Order"=>107, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tel_movil")->SetDisplayValues(Array("Name"=>"ciu_tel_movil", "Label"=>"Telefono móvil", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_email")->SetDisplayValues(Array("Name"=>"ciu_email", "Label"=>"E-Mail", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"EMAIL", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('laboral_gr') ) {
class laboral_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Informacion Laboral/Estudios'; //Titulo del grupo
        $this->m_order = 3; //Orden de presentacion de este grupo
        $this->m_id = 'laboral'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_trabaja';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_nivel_estudio';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_profesion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_trabaja")->SetDisplayValues(Array("Name"=>"ciu_trabaja", "Label"=>"Trabaja", "Size"=>4, "IsForDB"=>true, "Order"=>124, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nivel_estudio")->SetDisplayValues(Array("Name"=>"ciu_nivel_estudio", "Label"=>"Nivel de Estudios", "Size"=>20, "IsForDB"=>true, "Order"=>125, "Presentation"=>"CIUDADANO::NIVEL_ESTUDIO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_profesion")->SetDisplayValues(Array("Name"=>"ciu_profesion", "Label"=>"Profesion", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('audit_gr') ) {
class audit_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Auditoria'; //Titulo del grupo
        $this->m_order = 4; //Orden de presentacion de este grupo
        $this->m_id = 'audit'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tstamp';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_canal_ingreso';
        $this->m_fields[] = 'ciu_ciudadanos_n:use_code';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_estado';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tstamp")->SetDisplayValues(Array("Name"=>"ciu_tstamp", "Label"=>"Fecha de ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>131, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_canal_ingreso")->SetDisplayValues(Array("Name"=>"ciu_canal_ingreso", "Label"=>"Canal de Ingreso", "Size"=>20, "IsForDB"=>true, "Order"=>128, "Presentation"=>"CANALDEINGRESO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>129, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_estado")->SetDisplayValues(Array("Name"=>"ciu_estado", "Label"=>"Estado", "Size"=>30, "IsForDB"=>true, "Order"=>130, "Presentation"=>"CIUDADANO::ESTADO_CIUDADANO", "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('ciu_identificacion_th5') ) {
class ciu_identificacion_th5 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Documentos'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'ciu_identificacion'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'documentos'; //Identificador para Wizards
        $this->m_order = '5'; //Orden de aparicion

    	//Botones del editor de la tabla
    	$this->m_button_next = true;// Boton continuar
    	$this->m_button_close = true;// Boton cerrar
    	$this->m_button_repeat = false;// Boton repetir carga
    	$this->m_button_label = '';// Etiqueta del Boton Agregar
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = true; //Mostrar boton Borrar
        $this->m_can_update = true; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimum_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_note = ""; //Nota

        $this->m_datafields['ciu_code']=1;
        $this->m_datafields['ciu_nro_doc']=2;

        $this->m_columns[1] = new ctable_column(1,'Documento',array('ciu_code','ciu_nro_doc'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("ciu_code")->getJsIncludes();
        $r[]=$obj->GetField("ciu_nro_doc")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("ciu_nro_doc")->SetDisplayValues(Array("Name"=>"ciu_nro_doc", "Label"=>"Documento", "Size"=>25, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"CIUDADANO::DNI", "IsNullable"=>false, "IsVisible"=>true));
    }

}
}
if( !class_exists('ciu_ciudadanos_n_m') ) {
class ciu_ciudadanos_n_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new ciu_ciudadanos_n();
		$this->m_next_page = 'ciudadanos.php?OP=L&last=1'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'ciudadanos_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Ciudadano';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new datos_personales_gr($this);
		$this->m_handler[1] = new direccion_gr($this);
		$this->m_handler[2] = new contacto_gr($this);
		$this->m_handler[3] = new laboral_gr($this);
		$this->m_handler[4] = new audit_gr($this);

        //Tablas
		$this->m_handler[5] = new ciu_identificacion_th5($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<link rel='stylesheet' type='text/css' href='ciudadanos.css' media='screen,print' />";
        $html.="<script type='text/javascript' src='ciudadanos.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new ciu_ciudadanos_n_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
