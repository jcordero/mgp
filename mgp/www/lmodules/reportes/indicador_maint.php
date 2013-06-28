<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_indicadores.php";

//Genero las clases de los handlers

if( !class_exists('indicador_gr') ) {
class indicador_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Indicador'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'indicador'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'indicadores:tin_code';
        $this->m_fields[] = 'indicadores:tin_nombre';
        $this->m_fields[] = 'indicadores:tin_traza';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("indicadores")->GetField("tin_code")->SetDisplayValues(Array("Name"=>"tin_code", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"indicadores"));
        $this->getClass("indicadores")->GetField("tin_nombre")->SetDisplayValues(Array("Name"=>"tin_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"indicadores"));
        $this->getClass("indicadores")->GetField("tin_traza")->SetDisplayValues(Array("Name"=>"tin_traza", "Label"=>"Traza", "Size"=>200, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"indicadores"));
    }
}
}

if( !class_exists('indicadores_m') ) {
class indicadores_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new indicadores();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'indicador_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Gestión de indicadores';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new indicador_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new indicadores_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
