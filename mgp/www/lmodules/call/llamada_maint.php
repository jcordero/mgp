<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "ccal_queue.php";

//Genero las clases de los handlers

if( !class_exists('asunto_gr') ) {
class asunto_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Contacto'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'asunto'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:cqu_contacto';
        $this->m_fields[] = 'ccal_queue:cqu_tipo';
        $this->m_fields[] = 'ccal_queue:cqu_rubro';
        $this->m_fields[] = 'ccal_queue:cqu_prestacion';
        $this->m_fields[] = 'ccal_queue:cqu_estado_contacto';
        $this->m_fields[] = 'ccal_queue:cqu_con_ingreso_fecha';
        $this->m_fields[] = 'ccal_queue:cqu_con_cumplido_fecha';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("cqu_contacto")->SetDisplayValues(Array("Name"=>"cqu_contacto", "Label"=>"Contacto", "Size"=>50, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_tipo")->SetDisplayValues(Array("Name"=>"cqu_tipo", "Label"=>"Contacto", "Size"=>50, "IsForDB"=>true, "Order"=>132, "Presentation"=>"TIPOCONTACTO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_rubro")->SetDisplayValues(Array("Name"=>"cqu_rubro", "Label"=>"Rubro", "Size"=>200, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_prestacion")->SetDisplayValues(Array("Name"=>"cqu_prestacion", "Label"=>"Prestacion", "Size"=>200, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_estado_contacto")->SetDisplayValues(Array("Name"=>"cqu_estado_contacto", "Label"=>"Estado contacto", "Size"=>50, "IsForDB"=>true, "Order"=>134, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_con_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cqu_con_ingreso_fecha", "Label"=>"Iniciado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>110, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_con_cumplido_fecha")->SetDisplayValues(Array("Name"=>"cqu_con_cumplido_fecha", "Label"=>"Cumplido", "Type"=>"datetime", "IsForDB"=>true, "Order"=>111, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:tmp_mapa';
        $this->m_fields[] = 'ccal_queue:cqu_calle';
        $this->m_fields[] = 'ccal_queue:cqu_altura';
        $this->m_fields[] = 'ccal_queue:cqu_barrio';
        $this->m_fields[] = 'ccal_queue:cqu_cgpc';
        $this->m_fields[] = 'ccal_queue:cqu_x';
        $this->m_fields[] = 'ccal_queue:cqu_y';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("tmp_mapa")->SetDisplayValues(Array("Name"=>"tmp_mapa", "Label"=>"Ubicación", "Type"=>"int", "Order"=>35, "Presentation"=>"MAPA", "IsVisible"=>true, "ClassParams"=>"cqu_x|cqu_y", "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_calle")->SetDisplayValues(Array("Name"=>"cqu_calle", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_altura")->SetDisplayValues(Array("Name"=>"cqu_altura", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "Presentation"=>"INT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_barrio")->SetDisplayValues(Array("Name"=>"cqu_barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_cgpc")->SetDisplayValues(Array("Name"=>"cqu_cgpc", "Label"=>"Comuna", "Size"=>50, "IsForDB"=>true, "Order"=>114, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_x")->SetDisplayValues(Array("Name"=>"cqu_x", "Label"=>"Mapa X", "Type"=>"float", "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_y")->SetDisplayValues(Array("Name"=>"cqu_y", "Label"=>"Mapa Y", "Type"=>"float", "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('tareas_gr') ) {
class tareas_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Trabajo realizado'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'tareas'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:cqu_responsable';
        $this->m_fields[] = 'ccal_queue:cqu_historia';
        $this->m_fields[] = 'ccal_queue:cqu_con_cumplido_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("cqu_responsable")->SetDisplayValues(Array("Name"=>"cqu_responsable", "Label"=>"Responsable", "Size"=>200, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_historia")->SetDisplayValues(Array("Name"=>"cqu_historia", "Label"=>"Responsable", "Size"=>4000, "IsForDB"=>true, "Order"=>115, "Presentation"=>"HISTORIA", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"decode", "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_con_cumplido_nota")->SetDisplayValues(Array("Name"=>"cqu_con_cumplido_nota", "Label"=>"Nota de cierre", "Size"=>2000, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('reclamante_gr') ) {
class reclamante_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Reclamante'; //Titulo del grupo
        $this->m_order = 3; //Orden de presentacion de este grupo
        $this->m_id = 'reclamante'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:cqu_nombre';
        $this->m_fields[] = 'ccal_queue:cqu_tel_fijo';
        $this->m_fields[] = 'ccal_queue:cqu_tel_movil';
        $this->m_fields[] = 'ccal_queue:cqu_email';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("cqu_nombre")->SetDisplayValues(Array("Name"=>"cqu_nombre", "Label"=>"Reclamante", "Size"=>100, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_tel_fijo")->SetDisplayValues(Array("Name"=>"cqu_tel_fijo", "Label"=>"Telefono", "Size"=>30, "IsForDB"=>true, "Order"=>117, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_tel_movil")->SetDisplayValues(Array("Name"=>"cqu_tel_movil", "Label"=>"Celular", "Size"=>30, "IsForDB"=>true, "Order"=>118, "Presentation"=>"PHONE", "IsVisible"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_email")->SetDisplayValues(Array("Name"=>"cqu_email", "Label"=>"EMail", "Size"=>100, "IsForDB"=>true, "Order"=>119, "Presentation"=>"EMAIL", "IsVisible"=>true, "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('resultado_gr') ) {
class resultado_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Resultado'; //Titulo del grupo
        $this->m_order = 4; //Orden de presentacion de este grupo
        $this->m_id = 'resultado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:cqu_estado';
        $this->m_fields[] = 'ccal_queue:cqu_resuelto';
        $this->m_fields[] = 'ccal_queue:cqu_resultado';
        $this->m_fields[] = 'ccal_queue:cqu_motivo_no_conforme';
        $this->m_fields[] = 'ccal_queue:cqu_actitud';
        $this->m_fields[] = 'ccal_queue:cqu_reabrir_contacto';
        $this->m_fields[] = 'ccal_queue:cqu_seguir';
        $this->m_fields[] = 'ccal_queue:cqu_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("cqu_estado")->SetDisplayValues(Array("Name"=>"cqu_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>123, "IsMandatory"=>true, "Presentation"=>"CALL_ESTADO2", "IsVisible"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_resuelto")->SetDisplayValues(Array("Name"=>"cqu_resuelto", "Label"=>"Problema resuelto?", "Size"=>50, "IsForDB"=>true, "Order"=>124, "IsMandatory"=>true, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ccal_queue", "js_OnClick"=>"call_resuelto_change(this)"));
        $this->getClass("ccal_queue")->GetField("cqu_resultado")->SetDisplayValues(Array("Name"=>"cqu_resultado", "Label"=>"Resultado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "IsMandatory"=>true, "Presentation"=>"CALL_RESULTADO", "IsVisible"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_motivo_no_conforme")->SetDisplayValues(Array("Name"=>"cqu_motivo_no_conforme", "Label"=>"Motivo no conforme", "Size"=>100, "IsForDB"=>true, "Order"=>129, "IsMandatory"=>true, "Presentation"=>"CALL_NOCONFORME", "IsVisible"=>true, "Class"=>"ccal_queue", "InitialValue"=>"NO APLICA"));
        $this->getClass("ccal_queue")->GetField("cqu_actitud")->SetDisplayValues(Array("Name"=>"cqu_actitud", "Label"=>"Actitud", "Size"=>50, "IsForDB"=>true, "Order"=>127, "Presentation"=>"CALL_ACTITUD", "IsVisible"=>true, "Class"=>"ccal_queue", "InitialValue"=>"NEUTRAL"));
        $this->getClass("ccal_queue")->GetField("cqu_reabrir_contacto")->SetDisplayValues(Array("Name"=>"cqu_reabrir_contacto", "Label"=>"Reabrir contacto?", "Size"=>5, "IsForDB"=>true, "Order"=>130, "Presentation"=>"SINO", "Class"=>"ccal_queue", "InitialValue"=>"NO"));
        $this->getClass("ccal_queue")->GetField("cqu_seguir")->SetDisplayValues(Array("Name"=>"cqu_seguir", "Label"=>"Hacer seguimiento?", "Size"=>5, "IsForDB"=>true, "Order"=>131, "IsMandatory"=>true, "Presentation"=>"SINO", "IsVisible"=>true, "Class"=>"ccal_queue", "InitialValue"=>"NO"));
        $this->getClass("ccal_queue")->GetField("cqu_nota")->SetDisplayValues(Array("Name"=>"cqu_nota", "Label"=>"Observación", "Size"=>2000, "IsForDB"=>true, "Order"=>126, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('estado_gr') ) {
class estado_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Estado'; //Titulo del grupo
        $this->m_order = 5; //Orden de presentacion de este grupo
        $this->m_id = 'estado'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'ccal_queue:cqu_codigo';
        $this->m_fields[] = 'ccal_queue:use_code';
        $this->m_fields[] = 'ccal_queue:cqu_ingreso_fecha';
        $this->m_fields[] = 'ccal_queue:cqu_egreso_fecha';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("ccal_queue")->GetField("cqu_codigo")->SetDisplayValues(Array("Name"=>"cqu_codigo", "Label"=>"Cod.Llamada", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>120, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cqu_ingreso_fecha", "Label"=>"Ingresada", "Type"=>"datetime", "IsForDB"=>true, "Order"=>121, "Presentation"=>"DATETIME", "Class"=>"ccal_queue"));
        $this->getClass("ccal_queue")->GetField("cqu_egreso_fecha")->SetDisplayValues(Array("Name"=>"cqu_egreso_fecha", "Label"=>"Cursada", "Type"=>"datetime", "IsForDB"=>true, "Order"=>122, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"ccal_queue"));
    }
}
}


if( !class_exists('ccal_to_do_th6') ) {
class ccal_to_do_th6 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Tareas pendientes'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'ccal_to_do'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'tareas_pendientes'; //Identificador para Wizards
        $this->m_order = '6'; //Orden de aparicion

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

        $this->m_datafields['cto_codigo']=1;
        $this->m_datafields['cqu_codigo']=2;
        $this->m_datafields['cto_estado']=3;
        $this->m_datafields['cto_descripcion']=4;
        $this->m_datafields['use_code']=5;
        $this->m_datafields['cto_ingreso_fecha']=6;
        $this->m_datafields['cto_salida_fecha']=7;

        $this->m_columns[1] = new ctable_column(1,'Estado',array('cto_codigo','cqu_codigo','cto_estado'));
        $this->m_columns[2] = new ctable_column(2,'Tarea',array('cto_descripcion'));
        $this->m_columns[3] = new ctable_column(3,'Operador',array('use_code','cto_ingreso_fecha','cto_salida_fecha'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("cto_codigo")->getJsIncludes();
        $r[]=$obj->GetField("cqu_codigo")->getJsIncludes();
        $r[]=$obj->GetField("cto_estado")->getJsIncludes();
        $r[]=$obj->GetField("cto_descripcion")->getJsIncludes();
        $r[]=$obj->GetField("use_code")->getJsIncludes();
        $r[]=$obj->GetField("cto_ingreso_fecha")->getJsIncludes();
        $r[]=$obj->GetField("cto_salida_fecha")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("cto_codigo")->SetDisplayValues(Array("Name"=>"cto_codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false, "Sequence"=>"cal_to_do"));
        $obj->GetField("cqu_codigo")->SetDisplayValues(Array("Name"=>"cqu_codigo", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("cto_estado")->SetDisplayValues(Array("Name"=>"cto_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>103, "IsMandatory"=>true, "Presentation"=>"CALL_TODO_ESTADO", "IsVisible"=>true, "js_OnLoad"=>"literal('PENDIENTE')"));
        $obj->GetField("cto_descripcion")->SetDisplayValues(Array("Name"=>"cto_descripcion", "Label"=>"Tarea", "Size"=>3000, "IsForDB"=>true, "Order"=>107, "IsMandatory"=>true, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4));
        $obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>104, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force"));
        $obj->GetField("cto_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cto_ingreso_fecha", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force"));
        $obj->GetField("cto_salida_fecha")->SetDisplayValues(Array("Name"=>"cto_salida_fecha", "Label"=>"Cerrado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATETIME", "IsReadOnly"=>true));
    }

}
}

if( !class_exists('cfile_th7') ) {
class cfile_th7 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Archivos adjuntos'; //Titulo de la tabla
        $this->m_isFile = true; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'cfile'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'archivos_adjuntos'; //Identificador para Wizards
        $this->m_order = '7'; //Orden de aparicion

    	//Botones del editor de la tabla
    	$this->m_button_next = true;// Boton continuar
    	$this->m_button_close = true;// Boton cerrar
    	$this->m_button_repeat = false;// Boton repetir carga
    	$this->m_button_label = '';// Etiqueta del Boton Agregar
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = true; //Mostrar boton Borrar
        $this->m_can_update = false; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimum_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_note = ""; //Nota

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
        $obj->GetField("doc_code")->SetDisplayValues(Array("Name"=>"doc_code", "Label"=>"Codigo", "Size"=>50, "Order"=>2));
        $obj->GetField("doc_name")->SetDisplayValues(Array("Name"=>"doc_name", "Label"=>"Archivo", "Size"=>200, "Order"=>3, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_storage")->SetDisplayValues(Array("Name"=>"doc_storage", "Label"=>"Archivo", "Size"=>200, "Order"=>7, "Presentation"=>"FILE"));
        $obj->GetField("doc_tstamp")->SetDisplayValues(Array("Name"=>"doc_tstamp", "Label"=>"Fecha", "Type"=>"DATETIME", "Order"=>4, "Presentation"=>"DATETIME"));
        $obj->GetField("doc_mime")->SetDisplayValues(Array("Name"=>"doc_mime", "Label"=>"Clase", "Size"=>50, "Order"=>5, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_size")->SetDisplayValues(Array("Name"=>"doc_size", "Label"=>"Medida", "Type"=>"int", "Order"=>6, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_note")->SetDisplayValues(Array("Name"=>"doc_note", "Label"=>"Nota", "Size"=>200, "Order"=>8, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5));
    }

}
}
if( !class_exists('ccal_queue_m') ) {
class ccal_queue_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new ccal_queue();
		$this->m_next_page = '/index.php'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'llamada_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Registro de una llamada';// Titulo del formulario
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
		$this->m_handler[2] = new tareas_gr($this);
		$this->m_handler[3] = new reclamante_gr($this);
		$this->m_handler[4] = new resultado_gr($this);
		$this->m_handler[5] = new estado_gr($this);

        //Tablas
		$this->m_handler[6] = new ccal_to_do_th6($this);
		$this->m_handler[7] = new cfile_th7($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<script type='text/javascript' src='llamada_maint.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new ccal_queue_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
