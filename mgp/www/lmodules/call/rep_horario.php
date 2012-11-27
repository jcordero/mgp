<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "crep_horario.php";

//Genero las clases de los handlers

if( !class_exists('filter_gr') ) {
class filter_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Filtro'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'filter'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'crep_horario:fecha_inicio';
        $this->m_fields[] = 'crep_horario:fecha_fin';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("crep_horario")->GetField("fecha_inicio")->SetDisplayValues(Array("Name"=>"fecha_inicio", "Label"=>"Fecha inicio", "Type"=>"datetime", "Order"=>1, "Presentation"=>"DATE", "IsVisible"=>true, "Class"=>"crep_horario", "InitialValue"=>" "));
        $this->getClass("crep_horario")->GetField("fecha_fin")->SetDisplayValues(Array("Name"=>"fecha_fin", "Label"=>"Fecha fin", "Type"=>"datetime", "Order"=>2, "Presentation"=>"DATE", "IsVisible"=>true, "Class"=>"crep_horario"));
    }
}
}


if( !class_exists('report_gr') ) {
class report_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Tarea'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'report'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'crep_horario:tmp_graph';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("crep_horario")->GetField("tmp_graph")->SetDisplayValues(Array("Name"=>"tmp_graph", "Label"=>"Resultado", "Type"=>"int", "Order"=>11, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"crep_horario"));
    }
}
}

if( !class_exists('crep_horario_m') ) {
class crep_horario_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new crep_horario();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'rep_horario.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'M'; //Operacion por defecto
    	$this->m_title = 'Reporte por horas';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new filter_gr($this);
		$this->m_handler[1] = new report_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<script type='text/javascript' src='rep_horario.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new crep_horario_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
