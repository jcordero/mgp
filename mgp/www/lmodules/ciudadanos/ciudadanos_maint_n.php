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
        $this->m_title = 'Datos identificatorios'; //Titulo del grupo
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
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_doc_nro';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_nacionalidad';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_razon_social';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_email';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Cod.ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"SEQUENCE", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Cols"=>20, "ClassParams"=>"ciu_ciudadanos", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tipo_persona")->SetDisplayValues(Array("Name"=>"ciu_tipo_persona", "Label"=>"Tipo persona", "Size"=>20, "IsForDB"=>true, "Order"=>135, "Presentation"=>"TIPOPERSONA", "IsVisible"=>true, "ClassParams"=>"ciu_nombres|ciu_apellido|ciu_razon_social|ciu_sexo|ciu_nacimiento|ciu_doc_nro|ciu_nacionalidad", "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"FISICA"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nombres")->SetDisplayValues(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>102, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_apellido")->SetDisplayValues(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_sexo")->SetDisplayValues(Array("Name"=>"ciu_sexo", "Label"=>"Sexo", "Size"=>15, "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"SEXO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nacimiento")->SetDisplayValues(Array("Name"=>"ciu_nacimiento", "Label"=>"Fecha de Nacimiento", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"no"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_doc_nro")->SetDisplayValues(Array("Name"=>"ciu_doc_nro", "Label"=>"Doc.", "Size"=>20, "IsForDB"=>true, "Order"=>106, "IsMandatory"=>true, "Presentation"=>"DOCID", "IsVisible"=>true, "ClassParams"=>"ciu_nombres|ciu_apellido|ciu_razon_social|ciu_dir_calle|ciu_dir_nro|ciu_dir_piso|ciu_dir_dpto|ciu_localidad|ciu_cod_postal|ciu_tipo_persona|ciu_sexo|ciu_profesion|ciu_nacionalidad", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nacionalidad")->SetDisplayValues(Array("Name"=>"ciu_nacionalidad", "Label"=>"Nacionalidad", "Size"=>100, "IsForDB"=>true, "Order"=>137, "IsMandatory"=>true, "Presentation"=>"NACIONALIDAD", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_razon_social")->SetDisplayValues(Array("Name"=>"ciu_razon_social", "Label"=>"Razon Social", "Size"=>100, "IsForDB"=>true, "Order"=>136, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_email")->SetDisplayValues(Array("Name"=>"ciu_email", "Label"=>"E-Mail", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"EMAIL", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
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
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_piso';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_dir_dpto';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_cod_postal';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_localidad';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_provincia';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_pais';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_barrio';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_coord_x';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_coord_y';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("tmp_mapa")->SetDisplayValues(Array("Name"=>"tmp_mapa", "Size"=>50, "Order"=>38, "Presentation"=>"MAPA", "IsVisible"=>true, "ClassParams"=>"ciu_coord_x|ciu_coord_y", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_calle")->SetDisplayValues(Array("Name"=>"ciu_dir_calle", "Label"=>"Calle", "Size"=>50, "IsForDB"=>true, "Order"=>113, "Presentation"=>"CALLE", "IsVisible"=>true, "ClassParams"=>"ciu_dir_nro|ciu_coord_x|ciu_coord_y|ciu_barrio|ciu_cgpc|ilu|reco|tmp_mapa|ciu_dir_calle", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_nro")->SetDisplayValues(Array("Name"=>"ciu_dir_nro", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>114, "Presentation"=>"ALTURA", "IsVisible"=>true, "Cols"=>10, "ClassParams"=>"ciu_dir_calle", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_piso")->SetDisplayValues(Array("Name"=>"ciu_dir_piso", "Label"=>"Piso", "Size"=>5, "IsForDB"=>true, "Order"=>115, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>10, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_dir_dpto")->SetDisplayValues(Array("Name"=>"ciu_dir_dpto", "Label"=>"Departamento", "Size"=>5, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>10, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_cod_postal")->SetDisplayValues(Array("Name"=>"ciu_cod_postal", "Label"=>"Codigo Postal", "Size"=>6, "IsForDB"=>true, "Order"=>121, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_localidad")->SetDisplayValues(Array("Name"=>"ciu_localidad", "Label"=>"Localidad", "Size"=>50, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"Mar del Plata"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_provincia")->SetDisplayValues(Array("Name"=>"ciu_provincia", "Label"=>"Provincia", "Size"=>50, "IsForDB"=>true, "Order"=>119, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"BUENOS AIRES"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_pais")->SetDisplayValues(Array("Name"=>"ciu_pais", "Label"=>"Pais", "Size"=>50, "IsForDB"=>true, "Order"=>120, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"ARGENTINA"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_barrio")->SetDisplayValues(Array("Name"=>"ciu_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>117, "Presentation"=>"BARRIOS", "IsVisible"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_coord_x")->SetDisplayValues(Array("Name"=>"ciu_coord_x", "Label"=>"coordenada x", "Type"=>"float", "IsForDB"=>true, "Order"=>123, "Presentation"=>"TEXT", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_coord_y")->SetDisplayValues(Array("Name"=>"ciu_coord_y", "Label"=>"coordenada y", "Type"=>"float", "IsForDB"=>true, "Order"=>124, "Presentation"=>"TEXT", "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('contacto_gr') ) {
class contacto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Datos de contacto'; //Titulo del grupo
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
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tel_fijo';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_tel_movil';
        $this->m_fields[] = 'ciu_ciudadanos_n:ciu_horario_cont';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_no_email")->SetDisplayValues(Array("Name"=>"ciu_no_email", "Label"=>"Contacto por mail?", "Size"=>4, "IsForDB"=>true, "Order"=>112, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"NO"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_no_llamar")->SetDisplayValues(Array("Name"=>"ciu_no_llamar", "Label"=>"Contacto por teléfono?", "Size"=>4, "IsForDB"=>true, "Order"=>111, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"NO"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tel_fijo")->SetDisplayValues(Array("Name"=>"ciu_tel_fijo", "Label"=>"Telefono Fijo", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tel_movil")->SetDisplayValues(Array("Name"=>"ciu_tel_movil", "Label"=>"Telefono Movil", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_horario_cont")->SetDisplayValues(Array("Name"=>"ciu_horario_cont", "Label"=>"Horario de Contacto", "Size"=>50, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('laboral_gr') ) {
class laboral_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Información Laboral/Estudios'; //Titulo del grupo
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
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_trabaja")->SetDisplayValues(Array("Name"=>"ciu_trabaja", "Label"=>"Trabaja", "Size"=>4, "IsForDB"=>true, "Order"=>125, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_nivel_estudio")->SetDisplayValues(Array("Name"=>"ciu_nivel_estudio", "Label"=>"Nivel de Estudios", "Size"=>20, "IsForDB"=>true, "Order"=>126, "Presentation"=>"NIVEL_ESTUDIO", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_profesion")->SetDisplayValues(Array("Name"=>"ciu_profesion", "Label"=>"Profesion", "Size"=>50, "IsForDB"=>true, "Order"=>127, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"ciu_ciudadanos_n"));
    }
}
}


if( !class_exists('audit_gr') ) {
class audit_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Auditoría'; //Titulo del grupo
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
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_tstamp")->SetDisplayValues(Array("Name"=>"ciu_tstamp", "Label"=>"Fecha de ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>132, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Cols"=>20, "ClassParams"=>"force", "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_canal_ingreso")->SetDisplayValues(Array("Name"=>"ciu_canal_ingreso", "Label"=>"Canal de Ingreso", "Size"=>20, "IsForDB"=>true, "Order"=>129, "Presentation"=>"CANALDEINGRESO", "IsVisible"=>true, "IsReadOnly"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"CALL"));
        $this->getClass("ciu_ciudadanos_n")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>130, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "Cols"=>20, "Class"=>"ciu_ciudadanos_n"));
        $this->getClass("ciu_ciudadanos_n")->GetField("ciu_estado")->SetDisplayValues(Array("Name"=>"ciu_estado", "Label"=>"Estado", "Size"=>30, "IsForDB"=>true, "Order"=>131, "Presentation"=>"ESTADO_CIUDADANO", "Cols"=>20, "Class"=>"ciu_ciudadanos_n", "InitialValue"=>"ACTIVO"));
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
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'ciudadanos_maint_n.php';
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

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<link rel='stylesheet' type='text/css' href='ciudadanos.css' media='screen,print' />";

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
