<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_ciu_sesiones.php";

//Genero las clases de los handlers

if( !class_exists('sesion_gr') ) {
class sesion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Sesión'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'sesion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_ciu_sesiones:cse_code';
        $this->m_fields[] = 'class_ciu_sesiones:ciu_code';
        $this->m_fields[] = 'class_ciu_sesiones:cse_tstamp';
        $this->m_fields[] = 'class_ciu_sesiones:cse_duracion';
        $this->m_fields[] = 'class_ciu_sesiones:use_code';
        $this->m_fields[] = 'class_ciu_sesiones:cse_ani';
        $this->m_fields[] = 'class_ciu_sesiones:cse_call_id';
        $this->m_fields[] = 'class_ciu_sesiones:cse_skill';
        $this->m_fields[] = 'class_ciu_sesiones:cse_estado';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_ciu_sesiones")->GetField("cse_code")->SetDisplayValues(Array("Name"=>"cse_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"CIUDADANO", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_tstamp")->SetDisplayValues(Array("Name"=>"cse_tstamp", "Label"=>"Inicio", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_duracion")->SetDisplayValues(Array("Name"=>"cse_duracion", "Label"=>"Duración", "Type"=>"int", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DURACION", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"USER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_ani")->SetDisplayValues(Array("Name"=>"cse_ani", "Label"=>"Teléfono", "Size"=>15, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_call_id")->SetDisplayValues(Array("Name"=>"cse_call_id", "Label"=>"Nro. Ref. Llamada", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_skill")->SetDisplayValues(Array("Name"=>"cse_skill", "Label"=>"Opción ingreso", "Size"=>50, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_estado")->SetDisplayValues(Array("Name"=>"cse_estado", "Label"=>"Estado", "Size"=>20, "IsForDB"=>true, "Order"=>111, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones"));
    }
}
}


if( !class_exists('cierre_gr') ) {
class cierre_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Nota de cierre'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'cierre'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_ciu_sesiones:cse_derivado';
        $this->m_fields[] = 'class_ciu_sesiones:cse_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_ciu_sesiones")->GetField("cse_derivado")->SetDisplayValues(Array("Name"=>"cse_derivado", "Label"=>"Derivado a", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"EMERGENCIAS", "IsVisible"=>true, "Class"=>"class_ciu_sesiones"));
        $this->getClass("class_ciu_sesiones")->GetField("cse_nota")->SetDisplayValues(Array("Name"=>"cse_nota", "Label"=>"Nota", "Size"=>500, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5, "Class"=>"class_ciu_sesiones"));
    }
}
}

if( !class_exists('class_ciu_sesiones_m') ) {
class class_ciu_sesiones_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_ciu_sesiones();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'sesion_cierre.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'M'; //Operacion por defecto
    	$this->m_title = 'Cierre de una sesión';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new sesion_gr($this);
		$this->m_handler[1] = new cierre_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_ciu_sesiones_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
