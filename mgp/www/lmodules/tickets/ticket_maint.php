<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_ticket_upd.php";

//Genero las clases de los handlers

if( !class_exists('ticket_gr') ) {
class ticket_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ticket'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'ticket'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket_upd:tic_nro';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_anio';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_tipo';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_identificador';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd")->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_identificador")->SetDisplayValues(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>45, "IsForDB"=>true, "Order"=>123, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
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
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket_upd:mapa';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_lugar';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_id_cuadra';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_coordx';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_coordy';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_barrio';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_cgpc';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd")->GetField("mapa")->SetDisplayValues(Array("Name"=>"mapa", "Size"=>50, "Order"=>24, "Presentation"=>"TICKET::MAPA", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"tic_coordx|tic_coordy", "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_lugar")->SetDisplayValues(Array("Name"=>"tic_lugar", "Label"=>"Dirección", "Size"=>1000, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TICKET::DIRECCION", "IsVisible"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_id_cuadra")->SetDisplayValues(Array("Name"=>"tic_id_cuadra", "Label"=>"x", "Type"=>"int", "IsForDB"=>true, "Order"=>114, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_coordx")->SetDisplayValues(Array("Name"=>"tic_coordx", "Label"=>"x", "Type"=>"double", "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_coordy")->SetDisplayValues(Array("Name"=>"tic_coordy", "Label"=>"y", "Type"=>"double", "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_cgpc")->SetDisplayValues(Array("Name"=>"tic_cgpc", "Label"=>"CGPC", "Size"=>20, "IsForDB"=>true, "Order"=>111, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
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
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket_upd:tic_tstamp_in';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_tstamp_plazo';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_tstamp_cierre';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_estado';
        $this->m_fields[] = 'class_tic_ticket_upd:tic_nota_in';
        $this->m_fields[] = 'class_tic_ticket_upd:tmp_accion';
        $this->m_fields[] = 'class_tic_ticket_upd:tmp_nuevo_estado';
        $this->m_fields[] = 'class_tic_ticket_upd:tmp_prestacion';
        $this->m_fields[] = 'class_tic_ticket_upd:tmp_nota';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd")->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso ticket", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_tstamp_plazo")->SetDisplayValues(Array("Name"=>"tic_tstamp_plazo", "Label"=>"Plazo estimado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>117, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_tstamp_cierre")->SetDisplayValues(Array("Name"=>"tic_tstamp_cierre", "Label"=>"Cierre ticket", "Type"=>"datetime", "IsForDB"=>true, "Order"=>118, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_estado")->SetDisplayValues(Array("Name"=>"tic_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"REPORTES::ESTADO_TICKET", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tic_nota_in")->SetDisplayValues(Array("Name"=>"tic_nota_in", "Label"=>"Nota al ingreso", "Size"=>500, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tmp_accion")->SetDisplayValues(Array("Name"=>"tmp_accion", "Size"=>50, "Order"=>25, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tmp_nuevo_estado")->SetDisplayValues(Array("Name"=>"tmp_nuevo_estado", "Size"=>50, "Order"=>26, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tmp_prestacion")->SetDisplayValues(Array("Name"=>"tmp_prestacion", "Size"=>50, "Order"=>27, "Class"=>"class_tic_ticket_upd"));
        $this->getClass("class_tic_ticket_upd")->GetField("tmp_nota")->SetDisplayValues(Array("Name"=>"tmp_nota", "Size"=>50, "Order"=>28, "Class"=>"class_tic_ticket_upd"));
    }
}
}


if( !class_exists('class_tic_ticket_prestaciones_th3') ) {
class class_tic_ticket_prestaciones_th3 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Prestaciones'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_prestaciones'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'prestaciones'; //Identificador para Wizards
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

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['tpr_code']=2;
        $this->m_datafields['tru_code']=3;
        $this->m_datafields['ttp_cuestionario']=4;
        $this->m_datafields['ttp_prioridad']=5;
        $this->m_datafields['ttp_estado']=6;

        $this->m_columns[1] = new ctable_column(1,'Prestación',array('tic_nro','tpr_code'));
        $this->m_columns[2] = new ctable_column(2,'Rubro',array('tru_code'));
        $this->m_columns[3] = new ctable_column(3,'Cuestionario',array('ttp_cuestionario'));
        $this->m_columns[4] = new ctable_column(4,'Prioridad',array('ttp_prioridad'));
        $this->m_columns[5] = new ctable_column(5,'Estado',array('ttp_estado'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tru_code")->getJsIncludes();
        $r[]=$obj->GetField("ttp_cuestionario")->getJsIncludes();
        $r[]=$obj->GetField("ttp_prioridad")->getJsIncludes();
        $r[]=$obj->GetField("ttp_estado")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "Presentation"=>"RUBRO", "IsVisible"=>true));
        $obj->GetField("ttp_cuestionario")->SetDisplayValues(Array("Name"=>"ttp_cuestionario", "Label"=>"Cuestionario", "Size"=>3000, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TICKET::CUESTIONARIO", "IsVisible"=>true));
        $obj->GetField("ttp_prioridad")->SetDisplayValues(Array("Name"=>"ttp_prioridad", "Label"=>"Prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>106, "Presentation"=>"PRIORIDAD", "IsVisible"=>true));
        $obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
    }

}
}

if( !class_exists('class_tic_avance_th4') ) {
class class_tic_avance_th4 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Avance'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_avance'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'avance'; //Identificador para Wizards
        $this->m_order = '4'; //Orden de aparicion

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

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['tpr_code']=2;
        $this->m_datafields['tic_estado_in']=3;
        $this->m_datafields['tav_tstamp_in']=4;
        $this->m_datafields['use_code_in']=5;
        $this->m_datafields['tic_estado_out']=6;
        $this->m_datafields['tav_tstamp_out']=7;
        $this->m_datafields['use_code_out']=8;
        $this->m_datafields['tav_nota']=9;
        $this->m_datafields['tic_motivo']=10;

        $this->m_columns[1] = new ctable_column(1,'Estado',array('tic_nro','tpr_code','tic_estado_in','tav_tstamp_in','use_code_in','tic_estado_out','tav_tstamp_out','use_code_out'));
        $this->m_columns[2] = new ctable_column(2,'Nota',array('tav_nota'));
        $this->m_columns[3] = new ctable_column(3,'Motivo',array('tic_motivo'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tic_estado_in")->getJsIncludes();
        $r[]=$obj->GetField("tav_tstamp_in")->getJsIncludes();
        $r[]=$obj->GetField("use_code_in")->getJsIncludes();
        $r[]=$obj->GetField("tic_estado_out")->getJsIncludes();
        $r[]=$obj->GetField("tav_tstamp_out")->getJsIncludes();
        $r[]=$obj->GetField("use_code_out")->getJsIncludes();
        $r[]=$obj->GetField("tav_nota")->getJsIncludes();
        $r[]=$obj->GetField("tic_motivo")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_estado_in")->SetDisplayValues(Array("Name"=>"tic_estado_in", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
        $obj->GetField("tav_tstamp_in")->SetDisplayValues(Array("Name"=>"tav_tstamp_in", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true));
        $obj->GetField("use_code_in")->SetDisplayValues(Array("Name"=>"use_code_in", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"USER", "IsVisible"=>true));
        $obj->GetField("tic_estado_out")->SetDisplayValues(Array("Name"=>"tic_estado_out", "Label"=>"Estado final", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::ESTADO_PRESTACION"));
        $obj->GetField("tav_tstamp_out")->SetDisplayValues(Array("Name"=>"tav_tstamp_out", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>110, "Presentation"=>"DATETIME"));
        $obj->GetField("use_code_out")->SetDisplayValues(Array("Name"=>"use_code_out", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>111, "Presentation"=>"USER"));
        $obj->GetField("tav_nota")->SetDisplayValues(Array("Name"=>"tav_nota", "Label"=>"Nota", "Size"=>1000, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Cols"=>60));
        $obj->GetField("tic_motivo")->SetDisplayValues(Array("Name"=>"tic_motivo", "Label"=>"Motivo", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}
}

if( !class_exists('class_tic_ticket_organismos_th5') ) {
class class_tic_ticket_organismos_th5 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Organismos'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_organismos'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'organismos'; //Identificador para Wizards
        $this->m_order = '5'; //Orden de aparicion

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

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['tor_code']=2;
        $this->m_datafields['tto_figura']=3;

        $this->m_columns[1] = new ctable_column(1,'Organismo',array('tic_nro','tor_code'));
        $this->m_columns[2] = new ctable_column(2,'Figura',array('tto_figura'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tor_code")->getJsIncludes();
        $r[]=$obj->GetField("tto_figura")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TICKET::ORGANISMO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tto_figura")->SetDisplayValues(Array("Name"=>"tto_figura", "Label"=>"Figura", "Size"=>50, "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TICKET::GISFIGURA", "IsNullable"=>false, "IsVisible"=>true));
    }

}
}

if( !class_exists('class_tic_ticket_ciudadano_th6') ) {
class class_tic_ticket_ciudadano_th6 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Solicitantes'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_ciudadano'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'solicitantes'; //Identificador para Wizards
        $this->m_order = '6'; //Orden de aparicion

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

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['ttc_tstamp']=2;
        $this->m_datafields['ciu_code']=3;
        $this->m_datafields['ttc_nota']=4;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('tic_nro','ttc_tstamp'));
        $this->m_columns[2] = new ctable_column(2,'Ciudadano',array('ciu_code'));
        $this->m_columns[3] = new ctable_column(3,'Nota',array('ttc_nota'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("ttc_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("ciu_code")->getJsIncludes();
        $r[]=$obj->GetField("ttc_nota")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("ttc_tstamp")->SetDisplayValues(Array("Name"=>"ttc_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>103, "Presentation"=>"DATETIME", "IsVisible"=>true));
        $obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TICKET::CIUDADANO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("ttc_nota")->SetDisplayValues(Array("Name"=>"ttc_nota", "Label"=>"Nota", "Size"=>1000, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}
}

if( !class_exists('class_tic_ticket_ciudadano_reit_th7') ) {
class class_tic_ticket_ciudadano_reit_th7 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Reiteraciones'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_ciudadano_reit'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'reiteraciones'; //Identificador para Wizards
        $this->m_order = '7'; //Orden de aparicion

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

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['ttc_tstamp']=2;
        $this->m_datafields['ciu_code']=3;
        $this->m_datafields['ttc_nota']=4;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('tic_nro','ttc_tstamp'));
        $this->m_columns[2] = new ctable_column(2,'Ciudadano',array('ciu_code'));
        $this->m_columns[3] = new ctable_column(3,'Nota',array('ttc_nota'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("ttc_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("ciu_code")->getJsIncludes();
        $r[]=$obj->GetField("ttc_nota")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("ttc_tstamp")->SetDisplayValues(Array("Name"=>"ttc_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"DATETIME", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"CIUDADANO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("ttc_nota")->SetDisplayValues(Array("Name"=>"ttc_nota", "Label"=>"Nota", "Size"=>1000, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}
}

if( !class_exists('cfile_th8') ) {
class cfile_th8 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Archivos adjuntos'; //Titulo de la tabla
        $this->m_isFile = true; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'cfile'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'archivos_adjuntos'; //Identificador para Wizards
        $this->m_order = '8'; //Orden de aparicion

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
        $obj->GetField("doc_code")->SetDisplayValues(Array("Name"=>"doc_code", "Label"=>"Codigo", "Size"=>50, "Order"=>3));
        $obj->GetField("doc_name")->SetDisplayValues(Array("Name"=>"doc_name", "Label"=>"Archivo", "Size"=>200, "Order"=>4, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_storage")->SetDisplayValues(Array("Name"=>"doc_storage", "Label"=>"Archivo", "Size"=>200, "Order"=>8, "Presentation"=>"FILE"));
        $obj->GetField("doc_tstamp")->SetDisplayValues(Array("Name"=>"doc_tstamp", "Label"=>"Fecha", "Type"=>"DATETIME", "Order"=>5, "Presentation"=>"DATETIME"));
        $obj->GetField("doc_mime")->SetDisplayValues(Array("Name"=>"doc_mime", "Label"=>"Clase", "Size"=>50, "Order"=>6, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_size")->SetDisplayValues(Array("Name"=>"doc_size", "Label"=>"Medida", "Type"=>"int", "Order"=>7, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("doc_note")->SetDisplayValues(Array("Name"=>"doc_note", "Label"=>"Nota", "Size"=>200, "Order"=>9, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>5));
    }

}
}
if( !class_exists('class_tic_ticket_upd_m') ) {
class class_tic_ticket_upd_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_ticket_upd();
		$this->m_next_page = 'tickets.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'ticket_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Mantenimiento de un ticket';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('P','Imprimir comprobante','','','ticket_maint.php?OP=P','tic_nro|','Imprimir comprobante','');
		$this->m_action[] = new CAction('L','Consulta de tickets','','','tickets.php?last=1&OP=L','','Consulta de tickets','');

        //Grupos
		$this->m_handler[0] = new ticket_gr($this);
		$this->m_handler[1] = new ubicacion_gr($this);
		$this->m_handler[2] = new estado_gr($this);

        //Tablas
		$this->m_handler[3] = new class_tic_ticket_prestaciones_th3($this);
		$this->m_handler[4] = new class_tic_avance_th4($this);
		$this->m_handler[5] = new class_tic_ticket_organismos_th5($this);
		$this->m_handler[6] = new class_tic_ticket_ciudadano_th6($this);
		$this->m_handler[7] = new class_tic_ticket_ciudadano_reit_th7($this);
		$this->m_handler[8] = new cfile_th8($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<link rel='stylesheet' type='text/css' href='ticket_maint.css' media='screen,print' />";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_ticket_upd_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
