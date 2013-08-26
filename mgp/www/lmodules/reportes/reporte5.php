<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_rep5.php";

//Genero las clases de los handlers

if( !class_exists('filtro_gr') ) {
class filtro_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Filtro'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'filtro'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'rep5:tmp_fecha';
        $this->m_fields[] = 'rep5:tpr_code';
        $this->m_fields[] = 'rep5:tmp_rechazados';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("rep5")->GetField("tmp_fecha")->SetDisplayValues(Array("Name"=>"tmp_fecha", "Label"=>"Fecha", "Type"=>"datetime", "Order"=>4, "Presentation"=>"DATERANGE", "IsVisible"=>true, "Class"=>"rep5"));
        $this->getClass("rep5")->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>50, "Type"=>"text", "Order"=>1, "Presentation"=>"REPORTES::PRESTACIONES", "IsVisible"=>true, "Class"=>"rep5"));
        $this->getClass("rep5")->GetField("tmp_rechazados")->SetDisplayValues(Array("Name"=>"tmp_rechazados", "Label"=>"Incluir rechazados?", "Size"=>50, "Type"=>"text", "Order"=>3, "Presentation"=>"CHECKBOX", "IsVisible"=>true, "Class"=>"rep5"));
    }
}
}

if( !class_exists('rep5_m') ) {
class rep5_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new rep5();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'reporte5.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Reporte de tiempo medio de resolución';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new filtro_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<script type='text/javascript' src='reporte5.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new rep5_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
