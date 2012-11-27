<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_georef.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Referencia'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_georef:tge_tipo';
        $this->m_fields[] = 'class_tic_georef:tge_nombre';
        $this->m_fields[] = 'class_tic_georef:tge_otra_denominacion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_georef")->GetField("tge_tipo")->SetDisplayValues(Array("Name"=>"tge_tipo", "Label"=>"Tipo", "Size"=>30, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"UBICACION", "IsNullable"=>false, "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_nombre")->SetDisplayValues(Array("Name"=>"tge_nombre", "Label"=>"Nombre", "Size"=>100, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_otra_denominacion")->SetDisplayValues(Array("Name"=>"tge_otra_denominacion", "Label"=>"Otras denominaciones", "Size"=>500, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Class"=>"class_tic_georef"));
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
        $this->m_fields[] = 'class_tic_georef:tge_calle';
        $this->m_fields[] = 'class_tic_georef:tge_calle_nombre';
        $this->m_fields[] = 'class_tic_georef:tge_altura';
        $this->m_fields[] = 'class_tic_georef:tge_cgpc';
        $this->m_fields[] = 'class_tic_georef:tge_barrio';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_georef")->GetField("tge_calle")->SetDisplayValues(Array("Name"=>"tge_calle", "Label"=>"Codigo calle", "Type"=>"int", "IsForDB"=>true, "Order"=>110, "Presentation"=>"INT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_calle_nombre")->SetDisplayValues(Array("Name"=>"tge_calle_nombre", "Label"=>"Nombre Calle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_altura")->SetDisplayValues(Array("Name"=>"tge_altura", "Label"=>"Altura Calle", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "Presentation"=>"INT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_cgpc")->SetDisplayValues(Array("Name"=>"tge_cgpc", "Label"=>"CGPC", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_barrio")->SetDisplayValues(Array("Name"=>"tge_barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>109, "Presentation"=>"BARRIOS", "IsVisible"=>true, "Class"=>"class_tic_georef"));
    }
}
}


if( !class_exists('mapa_gr') ) {
class mapa_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Mapa'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'mapa'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_georef:tge_coordx';
        $this->m_fields[] = 'class_tic_georef:tge_coordy';
        $this->m_fields[] = 'class_tic_georef:tmp_prestacion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_georef")->GetField("tge_coordx")->SetDisplayValues(Array("Name"=>"tge_coordx", "Label"=>"Coord X", "Type"=>"float", "IsForDB"=>true, "Order"=>106, "Presentation"=>"FLOAT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tge_coordy")->SetDisplayValues(Array("Name"=>"tge_coordy", "Label"=>"Coord Y", "Type"=>"float", "IsForDB"=>true, "Order"=>107, "Presentation"=>"FLOAT", "IsVisible"=>true, "Class"=>"class_tic_georef"));
        $this->getClass("class_tic_georef")->GetField("tmp_prestacion")->SetDisplayValues(Array("Name"=>"tmp_prestacion", "Label"=>"Prestacion", "Size"=>100, "Order"=>11, "Presentation"=>"ARBOL", "IsVisible"=>true, "Class"=>"class_tic_georef"));
    }
}
}

if( !class_exists('class_tic_georef_m') ) {
class class_tic_georef_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_georef();
		$this->m_next_page = 'georefs.php?OP=L&last=1'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'georef_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Editar/Ingresar una GeoReferencia';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new ubicacion_gr($this);
		$this->m_handler[2] = new mapa_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_georef_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
