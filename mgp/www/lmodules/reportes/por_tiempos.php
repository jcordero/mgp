<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_reportes.php";

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
        $this->m_fields[] = 'reportes:tmp_barrio';
        $this->m_fields[] = 'reportes:tmp_fecha';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("reportes")->GetField("tmp_barrio")->SetDisplayValues(Array("Name"=>"tmp_barrio", "Label"=>"Barrio", "Size"=>50, "Order"=>1, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"reportes"));
        $this->getClass("reportes")->GetField("tmp_fecha")->SetDisplayValues(Array("Name"=>"tmp_fecha", "Label"=>"Fecha", "Size"=>50, "Order"=>2, "Presentation"=>"DATERANGE", "IsVisible"=>true, "Class"=>"reportes"));
    }
}
}

if( !class_exists('reportes_m') ) {
class reportes_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new reportes();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'por_tiempos.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Reporte por tiempos de ejecucción';// Titulo del formulario
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
        $html.="<link rel='stylesheet' type='text/css' href='por_tiempos.css' media='screen,print' />";
        $html.="<script type='text/javascript' src='por_tiempos.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new reportes_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
