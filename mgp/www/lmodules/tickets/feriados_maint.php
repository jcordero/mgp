<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_feriados.php";

//Genero las clases de los handlers

if( !class_exists('dia_gr') ) {
class dia_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Día'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'dia'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_feriados:tfe_tstamp_in';
        $this->m_fields[] = 'class_tic_feriados:tfe_desc';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_feriados")->GetField("tfe_tstamp_in")->SetDisplayValues(Array("Name"=>"tfe_tstamp_in", "Label"=>"Fecha", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"DATE", "IsNullable"=>false, "IsVisible"=>true, "Class"=>"class_tic_feriados"));
        $this->getClass("class_tic_feriados")->GetField("tfe_desc")->SetDisplayValues(Array("Name"=>"tfe_desc", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_feriados"));
    }
}
}

if( !class_exists('class_tic_feriados_m') ) {
class class_tic_feriados_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_feriados();
		$this->m_next_page = 'feriados.php?OP=L&last=1'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'feriados_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Día feriado';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('N','Nuevo feriado','','','feriados_maint.php?OP=N','','','');

        //Grupos
		$this->m_handler[0] = new dia_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_feriados_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
