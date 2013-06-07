<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_organismos.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Organismo'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_organismos:tor_code';
        $this->m_fields[] = 'class_tic_organismos:tor_sigla';
        $this->m_fields[] = 'class_tic_organismos:tor_nombre';
        $this->m_fields[] = 'class_tic_organismos:tor_tipo';
        $this->m_fields[] = 'class_tic_organismos:tor_contacto';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_organismos")->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Sequence"=>"tic_organismos", "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_sigla")->SetDisplayValues(Array("Name"=>"tor_sigla", "Label"=>"Sigla", "Size"=>20, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>10, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_nombre")->SetDisplayValues(Array("Name"=>"tor_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_tipo")->SetDisplayValues(Array("Name"=>"tor_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>109, "IsMandatory"=>true, "Presentation"=>"ORGANISMOTIPO", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_contacto")->SetDisplayValues(Array("Name"=>"tor_contacto", "Label"=>"Contacto", "Size"=>500, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Cols"=>60, "Class"=>"class_tic_organismos"));
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicacion'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_organismos:tor_padre';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_organismos")->GetField("tor_padre")->SetDisplayValues(Array("Name"=>"tor_padre", "Label"=>"Organismo padre", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
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
        $this->m_fields[] = 'class_tic_organismos:tor_estado';
        $this->m_fields[] = 'class_tic_organismos:tor_tstamp';
        $this->m_fields[] = 'class_tic_organismos:use_code';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_organismos")->GetField("tor_estado")->SetDisplayValues(Array("Name"=>"tor_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"ACTIVO", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_tstamp")->SetDisplayValues(Array("Name"=>"tor_tstamp", "Label"=>"Fecha Act.", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"USER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_organismos"));
    }
}
}


if( !class_exists('alertas_gr') ) {
class alertas_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Alertas'; //Titulo del grupo
        $this->m_order = 3; //Orden de presentacion de este grupo
        $this->m_id = 'alertas'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_organismos:tor_email';
        $this->m_fields[] = 'class_tic_organismos:tor_notificar';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_organismos")->GetField("tor_email")->SetDisplayValues(Array("Name"=>"tor_email", "Label"=>"EMail", "Size"=>200, "IsForDB"=>true, "Order"=>110, "Presentation"=>"EMAIL", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
        $this->getClass("class_tic_organismos")->GetField("tor_notificar")->SetDisplayValues(Array("Name"=>"tor_notificar", "Label"=>"Notificar?", "Size"=>5, "IsForDB"=>true, "Order"=>111, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"class_tic_organismos"));
    }
}
}

if( !class_exists('class_tic_organismos_m') ) {
class class_tic_organismos_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_organismos();
		$this->m_next_page = 'organismos.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'organ_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Mantenimiento de organismo';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('L','Listado de organismos','','','organismos.php?last=1&OP=L','','Listado de organismos','');

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new ubicacion_gr($this);
		$this->m_handler[2] = new estado_gr($this);
		$this->m_handler[3] = new alertas_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_organismos_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
