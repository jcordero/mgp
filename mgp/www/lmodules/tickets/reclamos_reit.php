<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "creclamos.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Asunto'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'creclamos:nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos")->GetField("nota")->SetDisplayValues(Array("Name"=>"nota", "Label"=>"Nota Reiteración", "Size"=>300, "Order"=>2, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Class"=>"creclamos"));
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

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
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

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
    }
}
}


if( !class_exists('creclamantes_th3') ) {
class creclamantes_th3 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Reclamantes'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'creclamantes'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'reclamantes'; //Identificador para Wizards
        $this->m_order = '3'; //Orden de aparicion

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


        $this->m_columns[1] = new ctable_column(1,'Nombre/tel',array());
        $this->m_columns[2] = new ctable_column(2,'Fecha',array());
        $this->m_columns[3] = new ctable_column(3,'Tel.',array());
        $this->m_columns[4] = new ctable_column(4,'Doc.',array());
        $this->m_columns[5] = new ctable_column(5,'EMail',array());
    }

    public function getJsIncludes($obj) {
        $r=array();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
    }

}
}
if( !class_exists('creclamos_m') ) {
class creclamos_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'reitera.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new creclamos();
		$this->m_next_page = '/index.php'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'reclamos_reit.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Reiterar un reclamo';// Titulo del formulario
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
		$this->m_handler[2] = new estado_gr($this);

        //Tablas
		$this->m_handler[3] = new creclamantes_th3($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new creclamos_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
