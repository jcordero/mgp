<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_sho_ingresos.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Skill'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_sho_ingresos:sin_code';
        $this->m_fields[] = 'class_sho_ingresos:sin_descripcion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_sho_ingresos")->GetField("sin_code")->SetDisplayValues(Array("Name"=>"sin_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsMandatory"=>true, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "Class"=>"class_sho_ingresos"));
        $this->getClass("class_sho_ingresos")->GetField("sin_descripcion")->SetDisplayValues(Array("Name"=>"sin_descripcion", "Label"=>"Descripción", "Size"=>50, "IsForDB"=>true, "Order"=>102, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_sho_ingresos"));
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
        $this->m_fields[] = 'class_sho_ingresos:sin_estado';
        $this->m_fields[] = 'class_sho_ingresos:use_code';
        $this->m_fields[] = 'class_sho_ingresos:sin_tstamp';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_sho_ingresos")->GetField("sin_estado")->SetDisplayValues(Array("Name"=>"sin_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"ACTIVO", "IsVisible"=>true, "Class"=>"class_sho_ingresos", "InitialValue"=>"ACTIVO"));
        $this->getClass("class_sho_ingresos")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>104, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_sho_ingresos"));
        $this->getClass("class_sho_ingresos")->GetField("sin_tstamp")->SetDisplayValues(Array("Name"=>"sin_tstamp", "Label"=>"Fecha de act.", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"class_sho_ingresos"));
    }
}
}


if( !class_exists('class_sho_atajos_th2') ) {
class class_sho_atajos_th2 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Atajos'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_sho_atajos'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'atajos'; //Identificador para Wizards
        $this->m_order = '2'; //Orden de aparicion

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

        $this->m_datafields['sat_code']=1;
        $this->m_datafields['sin_code']=2;
        $this->m_datafields['sat_url']=3;
        $this->m_datafields['sat_descripcion']=4;
        $this->m_datafields['sat_nota']=5;
        $this->m_datafields['use_code']=6;
        $this->m_datafields['sat_tstamp']=7;

        $this->m_columns[1] = new ctable_column(1,'URL',array('sat_code','sin_code','sat_url'));
        $this->m_columns[2] = new ctable_column(2,'Descripción',array('sat_descripcion'));
        $this->m_columns[3] = new ctable_column(3,'Nota',array('sat_nota'));
        $this->m_columns[4] = new ctable_column(4,'Actualizado',array('use_code','sat_tstamp'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("sat_code")->getJsIncludes();
        $r[]=$obj->GetField("sin_code")->getJsIncludes();
        $r[]=$obj->GetField("sat_url")->getJsIncludes();
        $r[]=$obj->GetField("sat_descripcion")->getJsIncludes();
        $r[]=$obj->GetField("sat_nota")->getJsIncludes();
        $r[]=$obj->GetField("use_code")->getJsIncludes();
        $r[]=$obj->GetField("sat_tstamp")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("sat_code")->SetDisplayValues(Array("Name"=>"sat_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false, "Sequence"=>"sho_atajos"));
        $obj->GetField("sin_code")->SetDisplayValues(Array("Name"=>"sin_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("sat_url")->SetDisplayValues(Array("Name"=>"sat_url", "Label"=>"URL", "Size"=>150, "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("sat_descripcion")->SetDisplayValues(Array("Name"=>"sat_descripcion", "Label"=>"Descripción", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("sat_nota")->SetDisplayValues(Array("Name"=>"sat_nota", "Label"=>"Nota", "Size"=>500, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5, "Cols"=>60));
        $obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force"));
        $obj->GetField("sat_tstamp")->SetDisplayValues(Array("Name"=>"sat_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force"));
    }

}
}
if( !class_exists('class_sho_ingresos_m') ) {
class class_sho_ingresos_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_sho_ingresos();
		$this->m_next_page = 'skills.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'skill_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Skill';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('L','Listado de skills','','','skills.php?last=1&OP=L','','Listado de skills','');

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new estado_gr($this);

        //Tablas
		$this->m_handler[2] = new class_sho_atajos_th2($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_sho_ingresos_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
