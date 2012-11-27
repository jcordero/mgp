<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_rubros.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Rubro'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_rubros:tru_code';
        $this->m_fields[] = 'class_tic_rubros:tru_detalle';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_rubros")->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"SEQUENCE", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"tic_rubros", "Class"=>"class_tic_rubros"));
        $this->getClass("class_tic_rubros")->GetField("tru_detalle")->SetDisplayValues(Array("Name"=>"tru_detalle", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_rubros"));
    }
}
}


if( !class_exists('estado_gr') ) {
class estado_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Estado'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'estado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_rubros:tru_estado';
        $this->m_fields[] = 'class_tic_rubros:tru_tstamp';
        $this->m_fields[] = 'class_tic_rubros:use_code';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_rubros")->GetField("tru_estado")->SetDisplayValues(Array("Name"=>"tru_estado", "Label"=>"Estado", "Size"=>20, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"ACTIVO", "IsVisible"=>true, "Class"=>"class_tic_rubros", "InitialValue"=>"ACTIVO"));
        $this->getClass("class_tic_rubros")->GetField("tru_tstamp")->SetDisplayValues(Array("Name"=>"tru_tstamp", "Label"=>"Fecha Act.", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"class_tic_rubros"));
        $this->getClass("class_tic_rubros")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_rubros"));
    }
}
}

if( !class_exists('class_tic_rubros_m') ) {
class class_tic_rubros_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_rubros();
		$this->m_next_page = 'rubros.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'rubro_maint_n.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Nuevo rubro';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('L','Listado de rubros','','','rubros.php?last=1&OP=L','','Listado de rubros','');
		$this->m_action[] = new CAction('N','Nuevo rubro','','','rubro_maint_n.php?OP=N','','Nuevo rubro','');

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new estado_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_rubros_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
