<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_prestaciones.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Prestación'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_detalle';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_tipo';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_ubicacion';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_plazo';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_show';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_detalle")->SetDisplayValues(Array("Name"=>"tpr_detalle", "Label"=>"Detalle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_tipo")->SetDisplayValues(Array("Name"=>"tpr_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>102, "IsMandatory"=>true, "Presentation"=>"TICKET::PRESTACIONTIPO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_ubicacion")->SetDisplayValues(Array("Name"=>"tpr_ubicacion", "Label"=>"Ubicación", "Size"=>50, "IsForDB"=>true, "Order"=>107, "IsMandatory"=>true, "Presentation"=>"TICKET::UBICACION", "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_plazo")->SetDisplayValues(Array("Name"=>"tpr_plazo", "Label"=>"Plazo", "Size"=>20, "IsForDB"=>true, "Order"=>108, "IsMandatory"=>true, "Presentation"=>"TICKET::PLAZO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_show")->SetDisplayValues(Array("Name"=>"tpr_show", "Label"=>"Mostrar en", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TICKET::MOSTRAR_EN", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "InitialValue"=>"web,movil,telefono,en persona"));
    }
}
}


if( !class_exists('buscar_gr') ) {
class buscar_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ayuda y búsqueda'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'buscar'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_metadata';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_keywords';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_metadata")->SetDisplayValues(Array("Name"=>"tpr_metadata", "Label"=>"Descripción", "Size"=>3000, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5, "Cols"=>60, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_keywords")->SetDisplayValues(Array("Name"=>"tpr_keywords", "Label"=>"Palabras clave", "Size"=>500, "IsForDB"=>true, "Order"=>111, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5, "Cols"=>60, "Class"=>"class_tic_prestaciones", "Note"=>"separar con comas"));
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Clasificación'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_code';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Código", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
    }
}
}


if( !class_exists('estado_gr') ) {
class estado_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Estado'; //Titulo del grupo
        $this->m_order = 3; //Orden de presentacion de este grupo
        $this->m_id = 'estado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_estado';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_tstamp';
        $this->m_fields[] = 'class_tic_prestaciones:use_code';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_estado")->SetDisplayValues(Array("Name"=>"tpr_estado", "Label"=>"Estado", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"ACTIVO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_tstamp")->SetDisplayValues(Array("Name"=>"tpr_tstamp", "Label"=>"Fecha Act.", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_prestaciones"));
        $this->getClass("class_tic_prestaciones")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"USER", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_prestaciones"));
    }
}
}


if( !class_exists('admin_gr') ) {
class admin_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Administración delegada'; //Titulo del grupo
        $this->m_order = 4; //Orden de presentacion de este grupo
        $this->m_id = 'admin'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_admin';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_admin")->SetDisplayValues(Array("Name"=>"tpr_admin", "Label"=>"Administrable por", "Size"=>50, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"Organismo"));
    }
}
}


if( !class_exists('notifica_gr') ) {
class notifica_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Notificaciones'; //Titulo del grupo
        $this->m_order = 5; //Orden de presentacion de este grupo
        $this->m_id = 'notifica'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_al_inicio';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_al_final';
        $this->m_fields[] = 'class_tic_prestaciones:tpr_al_vencimiento';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_al_inicio")->SetDisplayValues(Array("Name"=>"tpr_al_inicio", "Label"=>"Al inicio", "Size"=>2000, "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"(correo electrónico)"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_al_final")->SetDisplayValues(Array("Name"=>"tpr_al_final", "Label"=>"Al final", "Size"=>2000, "IsForDB"=>true, "Order"=>114, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"(correo electrónico)"));
        $this->getClass("class_tic_prestaciones")->GetField("tpr_al_vencimiento")->SetDisplayValues(Array("Name"=>"tpr_al_vencimiento", "Label"=>"Al vencimiento", "Size"=>2000, "IsForDB"=>true, "Order"=>115, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"(correo electrónico)"));
    }
}
}


if( !class_exists('estados_opt_gr') ) {
class estados_opt_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Estados optativos'; //Titulo del grupo
        $this->m_order = 6; //Orden de presentacion de este grupo
        $this->m_id = 'estados_opt'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tor_code_inspeccion';
        $this->m_fields[] = 'class_tic_prestaciones:tor_code_verificacion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tor_code_inspeccion")->SetDisplayValues(Array("Name"=>"tor_code_inspeccion", "Label"=>"Al inicio inspección", "Type"=>"int", "IsForDB"=>true, "Order"=>116, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"código de organismo que hace la inspección"));
        $this->getClass("class_tic_prestaciones")->GetField("tor_code_verificacion")->SetDisplayValues(Array("Name"=>"tor_code_verificacion", "Label"=>"Al final certificación", "Type"=>"int", "IsForDB"=>true, "Order"=>117, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"código de organismo que hace la certificación"));
    }
}
}


if( !class_exists('asociar_gr') ) {
class asociar_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Asociación automática de tickets'; //Titulo del grupo
        $this->m_order = 7; //Orden de presentacion de este grupo
        $this->m_id = 'asociar'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_prestaciones:tpr_asociar_radio';
        $this->m_fields[] = 'class_tic_prestaciones:eev_task';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_prestaciones")->GetField("tpr_asociar_radio")->SetDisplayValues(Array("Name"=>"tpr_asociar_radio", "Label"=>"Radio en metros", "Type"=>"int", "IsForDB"=>true, "Order"=>118, "Presentation"=>"INT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"todos los tickets abiertos de esta prestación se asociarán si están próximos esta distacia"));
        $this->getClass("class_tic_prestaciones")->GetField("eev_task")->SetDisplayValues(Array("Name"=>"eev_task", "Label"=>"Ruteo externo", "Size"=>100, "IsForDB"=>true, "Order"=>119, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_prestaciones", "Note"=>"completar para las prestaciones que se traten en un sistema integrado"));
    }
}
}


if( !class_exists('class_tic_prestaciones_cuest_th8') ) {
class class_tic_prestaciones_cuest_th8 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Cuestionario'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_prestaciones_cuest'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'cuestionario'; //Identificador para Wizards
        $this->m_order = '8'; //Orden de aparicion

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

        $this->m_datafields['tpr_code']=1;
        $this->m_datafields['tcu_code']=2;
        $this->m_datafields['tpr_orden']=3;
        $this->m_datafields['tpr_preg']=4;
        $this->m_datafields['tpr_tipo_preg']=5;
        $this->m_datafields['tpr_opciones']=6;
        $this->m_datafields['tpr_miciudad']=7;

        $this->m_columns[1] = new ctable_column(1,'Orden',array('tpr_code','tcu_code','tpr_orden'));
        $this->m_columns[2] = new ctable_column(2,'Pregunta',array('tpr_preg'));
        $this->m_columns[3] = new ctable_column(3,'Tipo',array('tpr_tipo_preg'));
        $this->m_columns[4] = new ctable_column(4,'Opciones',array('tpr_opciones'));
        $this->m_columns[5] = new ctable_column(5,'MiCiudad',array('tpr_miciudad'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tcu_code")->getJsIncludes();
        $r[]=$obj->GetField("tpr_orden")->getJsIncludes();
        $r[]=$obj->GetField("tpr_preg")->getJsIncludes();
        $r[]=$obj->GetField("tpr_tipo_preg")->getJsIncludes();
        $r[]=$obj->GetField("tpr_opciones")->getJsIncludes();
        $r[]=$obj->GetField("tpr_miciudad")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tcu_code")->SetDisplayValues(Array("Name"=>"tcu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false, "Sequence"=>"tic_prestaciones_cuest"));
        $obj->GetField("tpr_orden")->SetDisplayValues(Array("Name"=>"tpr_orden", "Label"=>"Orden", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
        $obj->GetField("tpr_preg")->SetDisplayValues(Array("Name"=>"tpr_preg", "Label"=>"Pregunta", "Size"=>100, "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>100));
        $obj->GetField("tpr_tipo_preg")->SetDisplayValues(Array("Name"=>"tpr_tipo_preg", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>105, "IsMandatory"=>true, "Presentation"=>"CUESTOPCIONES", "IsVisible"=>true));
        $obj->GetField("tpr_opciones")->SetDisplayValues(Array("Name"=>"tpr_opciones", "Label"=>"Opciones", "Size"=>200, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4));
        $obj->GetField("tpr_miciudad")->SetDisplayValues(Array("Name"=>"tpr_miciudad", "Label"=>"Código MiCiudad", "Size"=>45, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>10));
    }

}
}

if( !class_exists('class_tic_prestaciones_gis_th9') ) {
class class_tic_prestaciones_gis_th9 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'GIS'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_prestaciones_gis'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'gis'; //Identificador para Wizards
        $this->m_order = '9'; //Orden de aparicion

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

        $this->m_datafields['tpr_code']=1;
        $this->m_datafields['tpg_code']=2;
        $this->m_datafields['tpg_gis_campo']=3;
        $this->m_datafields['tpg_gis_valor']=4;
        $this->m_datafields['tpg_usa_gis']=5;
        $this->m_datafields['tor_code']=6;
        $this->m_datafields['tto_figura']=7;
        $this->m_datafields['tpr_plazo']=8;
        $this->m_datafields['tpg_tstamp']=9;
        $this->m_datafields['use_code']=10;

        $this->m_columns[1] = new ctable_column(1,'Campo',array('tpr_code','tpg_code','tpg_gis_campo'));
        $this->m_columns[2] = new ctable_column(2,'Valor',array('tpg_gis_valor'));
        $this->m_columns[3] = new ctable_column(3,'Usar GIS?',array('tpg_usa_gis'));
        $this->m_columns[4] = new ctable_column(4,'Organismo',array('tor_code'));
        $this->m_columns[5] = new ctable_column(5,'Figura',array('tto_figura','tpr_plazo','tpg_tstamp','use_code'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tpg_code")->getJsIncludes();
        $r[]=$obj->GetField("tpg_gis_campo")->getJsIncludes();
        $r[]=$obj->GetField("tpg_gis_valor")->getJsIncludes();
        $r[]=$obj->GetField("tpg_usa_gis")->getJsIncludes();
        $r[]=$obj->GetField("tor_code")->getJsIncludes();
        $r[]=$obj->GetField("tto_figura")->getJsIncludes();
        $r[]=$obj->GetField("tpr_plazo")->getJsIncludes();
        $r[]=$obj->GetField("tpg_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("use_code")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tpg_code")->SetDisplayValues(Array("Name"=>"tpg_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false, "Sequence"=>"tic_prestaciones_gis"));
        $obj->GetField("tpg_gis_campo")->SetDisplayValues(Array("Name"=>"tpg_gis_campo", "Label"=>"Campo", "Size"=>100, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TICKET::GISGRILLA", "IsVisible"=>true));
        $obj->GetField("tpg_gis_valor")->SetDisplayValues(Array("Name"=>"tpg_gis_valor", "Label"=>"Valor", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tpg_usa_gis")->SetDisplayValues(Array("Name"=>"tpg_usa_gis", "Label"=>"Usar GIS?", "Size"=>5, "IsForDB"=>true, "Order"=>105, "IsMandatory"=>true, "Presentation"=>"SINO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>106, "IsMandatory"=>true, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true));
        $obj->GetField("tto_figura")->SetDisplayValues(Array("Name"=>"tto_figura", "Label"=>"Figura", "Size"=>50, "IsForDB"=>true, "Order"=>109, "IsMandatory"=>true, "Presentation"=>"TICKET::GISFIGURA", "IsVisible"=>true, "js_OnLoad"=>"literal('RESPONSABLE')"));
        $obj->GetField("tpr_plazo")->SetDisplayValues(Array("Name"=>"tpr_plazo", "Label"=>"Plazo", "Size"=>20, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TICKET::PLAZO", "IsVisible"=>true));
        $obj->GetField("tpg_tstamp")->SetDisplayValues(Array("Name"=>"tpg_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107, "Presentation"=>"DATETIME"));
        $obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"CURRENTUSER"));
    }

}
}

if( !class_exists('class_tic_prestaciones_rubros_th10') ) {
class class_tic_prestaciones_rubros_th10 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Rubros relacionados'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_prestaciones_rubros'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'rubros_relacionados'; //Identificador para Wizards
        $this->m_order = '10'; //Orden de aparicion

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

        $this->m_datafields['tpr_code']=1;
        $this->m_datafields['tru_code']=2;
        $this->m_datafields['tpr_prioridad']=3;
        $this->m_datafields['tor_code']=4;
        $this->m_datafields['tto_figura']=5;

        $this->m_columns[1] = new ctable_column(1,'Rubro',array('tpr_code','tru_code'));
        $this->m_columns[2] = new ctable_column(2,'Prioridad',array('tpr_prioridad'));
        $this->m_columns[3] = new ctable_column(3,'Organismo',array('tor_code'));
        $this->m_columns[4] = new ctable_column(4,'Figura',array('tto_figura'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tru_code")->getJsIncludes();
        $r[]=$obj->GetField("tpr_prioridad")->getJsIncludes();
        $r[]=$obj->GetField("tor_code")->getJsIncludes();
        $r[]=$obj->GetField("tto_figura")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"RUBRO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tpr_prioridad")->SetDisplayValues(Array("Name"=>"tpr_prioridad", "Label"=>"Prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"PRIORIDAD", "IsVisible"=>true));
        $obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "IsMandatory"=>true, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true));
        $obj->GetField("tto_figura")->SetDisplayValues(Array("Name"=>"tto_figura", "Label"=>"Figura", "Size"=>50, "IsForDB"=>true, "Order"=>105, "IsMandatory"=>true, "Presentation"=>"TICKET::GISFIGURA", "IsVisible"=>true, "js_OnLoad"=>"literal('RESPONSABLE')"));
    }

}
}
if( !class_exists('class_tic_prestaciones_m') ) {
class class_tic_prestaciones_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_prestaciones();
		$this->m_next_page = 'prestaciones.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'prest_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Mantenimiento de prestacion';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('L','Listado de prestaciones','','','prestaciones.php?last=1&OP=L','','Listado de prestaciones','');

        //Grupos
		$this->m_handler[0] = new asunto_gr($this);
		$this->m_handler[1] = new buscar_gr($this);
		$this->m_handler[2] = new ubicacion_gr($this);
		$this->m_handler[3] = new estado_gr($this);
		$this->m_handler[4] = new admin_gr($this);
		$this->m_handler[5] = new notifica_gr($this);
		$this->m_handler[6] = new estados_opt_gr($this);
		$this->m_handler[7] = new asociar_gr($this);

        //Tablas
		$this->m_handler[8] = new class_tic_prestaciones_cuest_th8($this);
		$this->m_handler[9] = new class_tic_prestaciones_gis_th9($this);
		$this->m_handler[10] = new class_tic_prestaciones_rubros_th10($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_prestaciones_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
