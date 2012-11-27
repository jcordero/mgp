<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:19:13
 */
include_once "common/ctable_maint.php";
include_once "creclamos.php";

//Genero las clases de los handlers

if( !class_exists('creclamantes_th0') ) {
class creclamantes_th0 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Reclamantes'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'creclamantes'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'reclamantes'; //Identificador para Wizards
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = true; //Mostrar boton Borrar
        $this->m_can_update = true; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimun_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF


        $this->m_columns[1] = new ctable_column(1,'Nombre/tel',array());
        $this->m_columns[2] = new ctable_column(2,'Doc.',array());
        $this->m_columns[3] = new ctable_column(3,'Direccion',array());
        $this->m_columns[4] = new ctable_column(4,'EMail',array());
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

if( !class_exists('creclaestados_th1') ) {
class creclaestados_th1 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Tareas realizadas'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'creclaestados'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'tareas_realizadas'; //Identificador para Wizards
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = true; //Mostrar boton Borrar
        $this->m_can_update = true; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimun_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF


        $this->m_columns[1] = new ctable_column(1,'Inicial',array());
        $this->m_columns[2] = new ctable_column(2,'Final',array());
        $this->m_columns[3] = new ctable_column(3,'Operador',array());
        $this->m_columns[4] = new ctable_column(4,'Nota',array());
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

if( !class_exists('cfile_th2') ) {
class cfile_th2 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Archivos adjuntos'; //Titulo de la tabla
        $this->m_isFile = true; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'cfile'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'archivos_adjuntos'; //Identificador para Wizards
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = true; //Mostrar boton Borrar
        $this->m_can_update = false; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimun_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF

        $this->m_datafields['doc_code']=1;
        $this->m_datafields['doc_name']=2;
        $this->m_datafields['doc_storage']=3;
        $this->m_datafields['doc_tstamp']=4;
        $this->m_datafields['doc_mime']=5;
        $this->m_datafields['doc_size']=6;
        $this->m_datafields['doc_note']=7;

        $this->m_columns[1] = new ctable_column(1,'Archivo',array('doc_code','doc_name','doc_storage'));
        $this->m_columns[2] = new ctable_column(2,'Tipo',array('doc_tstamp','doc_mime'));
        $this->m_columns[3] = new ctable_column(3,'Medida',array('doc_size'));
        $this->m_columns[4] = new ctable_column(4,'Nota',array('doc_note'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("doc_code")->getJsIncludes();
        $r[]=$obj->GetField("doc_name")->getJsIncludes();
        $r[]=$obj->GetField("doc_storage")->getJsIncludes();
        $r[]=$obj->GetField("doc_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("doc_mime")->getJsIncludes();
        $r[]=$obj->GetField("doc_size")->getJsIncludes();
        $r[]=$obj->GetField("doc_note")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("doc_code")->SetDisplayValues(Array('Name'=>'doc_code', 'Label'=>'Codigo', 'Size'=>50, 'Order'=>2));
        $obj->GetField("doc_name")->SetDisplayValues(Array('Name'=>'doc_name', 'Label'=>'Archivo', 'Size'=>200, 'Order'=>3, 'Presentation'=>'TEXT', 'IsVisible'=>true));
        $obj->GetField("doc_storage")->SetDisplayValues(Array('Name'=>'doc_storage', 'Label'=>'Archivo', 'Size'=>200, 'Order'=>7, 'Presentation'=>'FILE'));
        $obj->GetField("doc_tstamp")->SetDisplayValues(Array('Name'=>'doc_tstamp', 'Label'=>'Fecha', 'Type'=>'DATETIME', 'Order'=>4, 'Presentation'=>'DATETIME'));
        $obj->GetField("doc_mime")->SetDisplayValues(Array('Name'=>'doc_mime', 'Label'=>'Clase', 'Size'=>50, 'Order'=>5, 'Presentation'=>'TEXT', 'IsVisible'=>true));
        $obj->GetField("doc_size")->SetDisplayValues(Array('Name'=>'doc_size', 'Label'=>'Medida', 'Type'=>'int', 'Order'=>6, 'Presentation'=>'TEXT', 'IsVisible'=>true));
        $obj->GetField("doc_note")->SetDisplayValues(Array('Name'=>'doc_note', 'Label'=>'Nota', 'Size'=>200, 'Order'=>8, 'Presentation'=>'TEXTAREA', 'IsVisible'=>true, 'Rows'=>5));
    }

}
}

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

        //Campos del grupo

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicacion'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF

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
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'estado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF

        //Campos del grupo

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
    }
}
}


if( !class_exists('organismos_gr') ) {
class organismos_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Organismos encargados'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'organismos'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF

        //Campos del grupo

    }

    public function InitializeInstance() {
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
		$this->m_template_html = 'call.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new creclamos();
		$this->m_next_page = 'reclamos.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'reclamos_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSD'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Consulta de un reclamo';// Titulo del formulario

        //Acciones
		$this->m_action[] = new CAction('L','Listado de llamadas','bt_ver.gif','','colallamadas.php?last=1&OP=L','','Listado de llamadas');

        //Grupos
		$this->m_handler[] = new asunto_gr($this);
		$this->m_handler[] = new ubicacion_gr($this);
		$this->m_handler[] = new estado_gr($this);
		$this->m_handler[] = new organismos_gr($this);

        //Tablas
		$this->m_handler[] = new creclamantes_th0($this);
		$this->m_handler[] = new creclaestados_th1($this);
		$this->m_handler[] = new cfile_th2($this);

    }

    function RenderJSIncludes() {
        $html = '';

        /* Para ubicar el origen de los reclamos... */
        $html.="<script language='JavaScript'>var sess_page='".str_replace("\\","/",__FILE__)."';var build_number=0;</script>";
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
