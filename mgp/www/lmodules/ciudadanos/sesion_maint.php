<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_ciu_sesiones_ver.php";

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
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_code';
        $this->m_fields[] = 'class_ciu_sesiones_ver:ciu_code';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_tstamp';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_duracion';
        $this->m_fields[] = 'class_ciu_sesiones_ver:use_code';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_ani';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_call_id';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_skill';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_code")->SetDisplayValues(Array("Name"=>"cse_code", "Label"=>"Cod.Sesion", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Cod.ciudadano", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"CIUDADANO", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_tstamp")->SetDisplayValues(Array("Name"=>"cse_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_duracion")->SetDisplayValues(Array("Name"=>"cse_duracion", "Label"=>"Duracion (seg)", "Type"=>"int", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DURACION", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"USER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_ani")->SetDisplayValues(Array("Name"=>"cse_ani", "Label"=>"Teléfono", "Size"=>15, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_call_id")->SetDisplayValues(Array("Name"=>"cse_call_id", "Label"=>"Nro. Ref. Llamada", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_skill")->SetDisplayValues(Array("Name"=>"cse_skill", "Label"=>"Opción ingreso", "Size"=>50, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_ciu_sesiones_ver"));
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
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_derivado';
        $this->m_fields[] = 'class_ciu_sesiones_ver:cse_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_derivado")->SetDisplayValues(Array("Name"=>"cse_derivado", "Label"=>"Derivado a", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"EMERGENCIAS", "IsVisible"=>true, "Class"=>"class_ciu_sesiones_ver"));
        $this->getClass("class_ciu_sesiones_ver")->GetField("cse_nota")->SetDisplayValues(Array("Name"=>"cse_nota", "Label"=>"Nota", "Size"=>500, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5, "Class"=>"class_ciu_sesiones_ver"));
    }
}
}


if( !class_exists('class_ciu_historial_contactos_th2') ) {
class class_ciu_historial_contactos_th2 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Actividad'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_ciu_historial_contactos'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'actividad'; //Identificador para Wizards
        $this->m_order = '2'; //Orden de aparicion

    	//Botones del editor de la tabla
    	$this->m_button_next = true;// Boton continuar
    	$this->m_button_close = true;// Boton cerrar
    	$this->m_button_repeat = false;// Boton repetir carga
    	$this->m_button_label = '';// Etiqueta del Boton Agregar
        $this->m_can_add = false; //Mostrar boton Agregar
        $this->m_can_delete = false; //Mostrar boton Borrar
        $this->m_can_update = false; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimum_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_note = ""; //Nota

        $this->m_datafields['chi_code']=1;
        $this->m_datafields['ciu_code']=2;
        $this->m_datafields['cse_code']=3;
        $this->m_datafields['chi_fecha']=4;
        $this->m_datafields['chi_motivo']=5;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('chi_code','ciu_code','cse_code','chi_fecha'));
        $this->m_columns[2] = new ctable_column(2,'Actividad',array('chi_motivo'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("chi_code")->getJsIncludes();
        $r[]=$obj->GetField("ciu_code")->getJsIncludes();
        $r[]=$obj->GetField("cse_code")->getJsIncludes();
        $r[]=$obj->GetField("chi_fecha")->getJsIncludes();
        $r[]=$obj->GetField("chi_motivo")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("chi_code")->SetDisplayValues(Array("Name"=>"chi_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("cse_code")->SetDisplayValues(Array("Name"=>"cse_code", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("chi_fecha")->SetDisplayValues(Array("Name"=>"chi_fecha", "Label"=>"Fecha y hora", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true));
        $obj->GetField("chi_motivo")->SetDisplayValues(Array("Name"=>"chi_motivo", "Label"=>"Actividad", "Size"=>100, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}
}
if( !class_exists('class_ciu_sesiones_ver_m') ) {
class class_ciu_sesiones_ver_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_ciu_sesiones_ver();
		$this->m_next_page = '/index.php'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'sesion_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Historia de la sesión';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new datos_personales_gr($this);
		$this->m_handler[1] = new cierre_gr($this);

        //Tablas
		$this->m_handler[2] = new class_ciu_historial_contactos_th2($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_ciu_sesiones_ver_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
