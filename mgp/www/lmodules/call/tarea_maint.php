<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "ccal_to_do_small.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Tarea'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_to_do_small:cto_descripcion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_to_do_small")->GetField("cto_descripcion")->SetDisplayValues(Array("Name"=>"cto_descripcion", "Label"=>"Tarea", "Size"=>3000, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_to_do_small"));
    }
}
}


if( !class_exists('obs_gr') ) {
class obs_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Observaciones'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'obs'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_to_do_small:cto_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_to_do_small")->GetField("cto_nota")->SetDisplayValues(Array("Name"=>"cto_nota", "Label"=>"Observaciones", "Size"=>3000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Class"=>"ccal_to_do_small"));
    }
}
}


if( !class_exists('estado_gr') ) {
class estado_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Estado'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'estado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_to_do_small:cto_codigo';
        $this->m_fields[] = 'ccal_to_do_small:cqu_codigo';
        $this->m_fields[] = 'ccal_to_do_small:cto_estado';
        $this->m_fields[] = 'ccal_to_do_small:use_code';
        $this->m_fields[] = 'ccal_to_do_small:cto_ingreso_fecha';
        $this->m_fields[] = 'ccal_to_do_small:cto_salida_fecha';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_to_do_small")->GetField("cto_codigo")->SetDisplayValues(Array("Name"=>"cto_codigo", "Label"=>"Ticket", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_to_do_small"));
        $this->getClass("ccal_to_do_small")->GetField("cqu_codigo")->SetDisplayValues(Array("Name"=>"cqu_codigo", "Label"=>"Ticket", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"INT", "IsNullable"=>false, "Class"=>"ccal_to_do_small"));
        $this->getClass("ccal_to_do_small")->GetField("cto_estado")->SetDisplayValues(Array("Name"=>"cto_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"CALL_TODO_ESTADO", "IsVisible"=>true, "Class"=>"ccal_to_do_small"));
        $this->getClass("ccal_to_do_small")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>104, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_to_do_small"));
        $this->getClass("ccal_to_do_small")->GetField("cto_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cto_ingreso_fecha", "Label"=>"Fecha de ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_to_do_small"));
        $this->getClass("ccal_to_do_small")->GetField("cto_salida_fecha")->SetDisplayValues(Array("Name"=>"cto_salida_fecha", "Label"=>"Fecha de act.", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"ccal_to_do_small"));
    }
}
}

if( !class_exists('ccal_to_do_small_m') ) {
class ccal_to_do_small_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new ccal_to_do_small();
		$this->m_next_page = 'pendientes.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'tarea_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Tarea pendiente';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('L','Listado de tareas','','','pendientes.php?last=1&OP=L','','Listado de tareas','');

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new obs_gr($this);
		$this->m_handler[2] = new estado_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new ccal_to_do_small_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
