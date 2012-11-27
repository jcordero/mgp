<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_ticket_upd_rec.php";

//Genero las clases de los handlers

if( !class_exists('accion_gr') ) {
class accion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Acción a registrar'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'accion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_estado';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_tpr_code';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_tor_code';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_nota';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_use_code';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_tstamp';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_tic_nro';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:acc_tic_anio';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_estado")->SetDisplayValues(Array("Name"=>"acc_estado", "Label"=>"Nuevo Estado", "Size"=>50, "Order"=>24, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_tpr_code")->SetDisplayValues(Array("Name"=>"acc_tpr_code", "Label"=>"Prestación", "Size"=>50, "Order"=>23, "Presentation"=>"PRESTACION_TICKET", "IsVisible"=>true, "ClassParams"=>"tic_nro|tic_anio|tic_tipo", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_tor_code")->SetDisplayValues(Array("Name"=>"acc_tor_code", "Label"=>"Nuevo responsable", "Type"=>"int", "Order"=>30, "Presentation"=>"ORGANISMO", "IsVisible"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_nota")->SetDisplayValues(Array("Name"=>"acc_nota", "Label"=>"Nota", "Size"=>500, "Order"=>25, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Cols"=>60, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_use_code")->SetDisplayValues(Array("Name"=>"acc_use_code", "Label"=>"Operador", "Size"=>50, "Order"=>26, "Presentation"=>"CURRENTUSER", "IsVisible"=>true, "ClassParams"=>"force", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_tstamp")->SetDisplayValues(Array("Name"=>"acc_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "Order"=>27, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "ClassParams"=>"force", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_tic_nro")->SetDisplayValues(Array("Name"=>"acc_tic_nro", "Label"=>"Asociado a Nro", "Type"=>"int", "Order"=>28, "Presentation"=>"INT", "IsVisible"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("acc_tic_anio")->SetDisplayValues(Array("Name"=>"acc_tic_anio", "Label"=>"Asociado a Año", "Type"=>"int", "Order"=>29, "Presentation"=>"INT", "IsVisible"=>true, "Class"=>"class_tic_ticket_upd_rec"));
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación DOMICILIO'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_lugar';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:mapa';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_id_cuadra';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_coordx';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_coordy';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_barrio';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_cgpc';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_calle_nombre';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_nro_puerta';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_lugar")->SetDisplayValues(Array("Name"=>"tic_lugar", "Label"=>"Dirección", "Size"=>1000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"DIRECCION", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("mapa")->SetDisplayValues(Array("Name"=>"mapa", "Label"=>"Ubicación", "Size"=>50, "Order"=>22, "Presentation"=>"MAPA", "IsVisible"=>true, "IsReadOnly"=>true, "Rows"=>150, "Cols"=>150, "ClassParams"=>"tic_coordx|tic_coordy", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_id_cuadra")->SetDisplayValues(Array("Name"=>"tic_id_cuadra", "Label"=>"IdCuadra", "Type"=>"int", "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_coordx")->SetDisplayValues(Array("Name"=>"tic_coordx", "Label"=>"x", "Type"=>"float", "IsForDB"=>true, "Order"=>111, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_coordy")->SetDisplayValues(Array("Name"=>"tic_coordy", "Label"=>"y", "Type"=>"float", "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_cgpc")->SetDisplayValues(Array("Name"=>"tic_cgpc", "Label"=>"CGPC", "Size"=>20, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_calle_nombre")->SetDisplayValues(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_nro_puerta")->SetDisplayValues(Array("Name"=>"tic_nro_puerta", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>119, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
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
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_nro';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_anio';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_tipo';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_tstamp_in';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_tstamp_plazo';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_tstamp_cierre';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_estado';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_canal';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_nota_in';
        $this->m_fields[] = 'class_tic_ticket_upd_rec:tic_forms';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso Denuncia", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_tstamp_plazo")->SetDisplayValues(Array("Name"=>"tic_tstamp_plazo", "Label"=>"Fec.Cierre estimado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>116, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_tstamp_cierre")->SetDisplayValues(Array("Name"=>"tic_tstamp_cierre", "Label"=>"Fec.Cierre Denuncia", "Type"=>"datetime", "IsForDB"=>true, "Order"=>117, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_estado")->SetDisplayValues(Array("Name"=>"tic_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"ESTADO_TICKET", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_canal")->SetDisplayValues(Array("Name"=>"tic_canal", "Label"=>"Ingresada por", "Size"=>20, "IsForDB"=>true, "Order"=>115, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_nota_in")->SetDisplayValues(Array("Name"=>"tic_nota_in", "Label"=>"Nota al ingreso", "Size"=>500, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket_upd_rec"));
        $this->getClass("class_tic_ticket_upd_rec")->GetField("tic_forms")->SetDisplayValues(Array("Name"=>"tic_forms", "Label"=>"Id", "Type"=>"int", "IsForDB"=>true, "Order"=>114, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket_upd_rec"));
    }
}
}


if( !class_exists('class_tic_avance_th3') ) {
class class_tic_avance_th3 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Avance'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_avance'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'avance'; //Identificador para Wizards
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
        $this->m_datafields['tic_anio']=2;
        $this->m_datafields['tic_tipo']=3;
        $this->m_datafields['tav_tstamp']=4;
        $this->m_datafields['tpr_code']=5;
        $this->m_datafields['tic_estado_in']=6;
        $this->m_datafields['tic_estado_out']=7;
        $this->m_datafields['tic_motivo']=8;
        $this->m_datafields['use_code']=9;
        $this->m_datafields['tav_nota']=10;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('tic_nro','tic_anio','tic_tipo','tav_tstamp'));
        $this->m_columns[2] = new ctable_column(2,'Prest.',array('tpr_code'));
        $this->m_columns[3] = new ctable_column(3,'Est.Inicial',array('tic_estado_in'));
        $this->m_columns[4] = new ctable_column(4,'Est.Final',array('tic_estado_out'));
        $this->m_columns[5] = new ctable_column(5,'Motivo',array('tic_motivo'));
        $this->m_columns[6] = new ctable_column(6,'Operador',array('use_code'));
        $this->m_columns[7] = new ctable_column(7,'Nota',array('tav_nota'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio")->getJsIncludes();
        $r[]=$obj->GetField("tic_tipo")->getJsIncludes();
        $r[]=$obj->GetField("tav_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        $r[]=$obj->GetField("tic_estado_in")->getJsIncludes();
        $r[]=$obj->GetField("tic_estado_out")->getJsIncludes();
        $r[]=$obj->GetField("tic_motivo")->getJsIncludes();
        $r[]=$obj->GetField("use_code")->getJsIncludes();
        $r[]=$obj->GetField("tav_nota")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("tav_tstamp")->SetDisplayValues(Array("Name"=>"tav_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"PRESTACION", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tic_estado_in")->SetDisplayValues(Array("Name"=>"tic_estado_in", "Label"=>"Estado inicial", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true));
        $obj->GetField("tic_estado_out")->SetDisplayValues(Array("Name"=>"tic_estado_out", "Label"=>"Estado final", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true));
        $obj->GetField("tic_motivo")->SetDisplayValues(Array("Name"=>"tic_motivo", "Label"=>"Motivo", "Size"=>50, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true));
        $obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"USER", "IsVisible"=>true));
        $obj->GetField("tav_nota")->SetDisplayValues(Array("Name"=>"tav_nota", "Label"=>"Nota", "Size"=>1000, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Cols"=>60));
    }

}
}

if( !class_exists('class_tic_ticket_prestaciones_th4') ) {
class class_tic_ticket_prestaciones_th4 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Prestaciones'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_prestaciones'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'prestaciones'; //Identificador para Wizards
        $this->m_order = '4'; //Orden de aparicion

    	//Botones del editor de la tabla
    	$this->m_button_next = true;// Boton continuar
    	$this->m_button_close = true;// Boton cerrar
    	$this->m_button_repeat = false;// Boton repetir carga
    	$this->m_button_label = '';// Etiqueta del Boton Agregar
        $this->m_can_add = true; //Mostrar boton Agregar
        $this->m_can_delete = false; //Mostrar boton Borrar
        $this->m_can_update = false; //Mostrar boton Modificar
        $this->m_can_check = false; //Mostrar checkbox
        $this->m_minimum_rows = 0; //Validacion: cantidad minima de filas
        $this->m_render_html = 'PARENT'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_note = ""; //Nota

        $this->m_datafields['tic_nro']=1;
        $this->m_datafields['tic_anio']=2;
        $this->m_datafields['tic_tipo']=3;
        $this->m_datafields['tpr_code']=4;
        $this->m_datafields['tru_code']=5;
        $this->m_datafields['ttp_cuestionario']=6;
        $this->m_datafields['ttp_prioridad']=7;
        $this->m_datafields['ttp_estado']=8;

        $this->m_columns[1] = new ctable_column(1,'Prestación',array('tic_nro','tic_anio','tic_tipo','tpr_code'));
        $this->m_columns[2] = new ctable_column(2,'Rubro',array('tru_code'));
        $this->m_columns[3] = new ctable_column(3,'Cuestionario',array('ttp_cuestionario'));
        $this->m_columns[4] = new ctable_column(4,'Prioridad',array('ttp_prioridad'));
        $this->m_columns[5] = new ctable_column(5,'Estado',array('ttp_estado'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio")->getJsIncludes();
        $r[]=$obj->GetField("tic_tipo")->getJsIncludes();
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
        $obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"PRESTACION", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>106, "Presentation"=>"RUBRO", "IsVisible"=>true));
        $obj->GetField("ttp_cuestionario")->SetDisplayValues(Array("Name"=>"ttp_cuestionario", "Label"=>"Cuestionario", "Size"=>3000, "IsForDB"=>true, "Order"=>107, "Presentation"=>"CUESTIONARIO", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("ttp_prioridad")->SetDisplayValues(Array("Name"=>"ttp_prioridad", "Label"=>"Prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"PRIORIDAD", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>10, "IsForDB"=>true, "Order"=>108, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true, "IsReadOnly"=>true, "InitialValue"=>"INICIADA"));
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
        $this->m_datafields['tic_anio']=2;
        $this->m_datafields['tic_tipo']=3;
        $this->m_datafields['tor_code']=4;
        $this->m_datafields['tto_figura']=5;
        $this->m_datafields['tpr_code']=6;

        $this->m_columns[1] = new ctable_column(1,'Organismo',array('tic_nro','tic_anio','tic_tipo','tor_code'));
        $this->m_columns[2] = new ctable_column(2,'Figura',array('tto_figura'));
        $this->m_columns[3] = new ctable_column(3,'Prestacion',array('tpr_code'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio")->getJsIncludes();
        $r[]=$obj->GetField("tic_tipo")->getJsIncludes();
        $r[]=$obj->GetField("tor_code")->getJsIncludes();
        $r[]=$obj->GetField("tto_figura")->getJsIncludes();
        $r[]=$obj->GetField("tpr_code")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"ORGANISMO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tto_figura")->SetDisplayValues(Array("Name"=>"tto_figura", "Label"=>"Figura", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"GISFIGURA", "IsVisible"=>true));
        $obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsForDB"=>true, "Order"=>106, "Presentation"=>"PRESTACION", "IsVisible"=>true));
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
        $this->m_datafields['tic_anio']=2;
        $this->m_datafields['tic_tipo']=3;
        $this->m_datafields['ttc_tstamp']=4;
        $this->m_datafields['ciu_code']=5;
        $this->m_datafields['ttc_nota']=6;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('tic_nro','tic_anio','tic_tipo','ttc_tstamp'));
        $this->m_columns[2] = new ctable_column(2,'Ciudadano',array('ciu_code'));
        $this->m_columns[3] = new ctable_column(3,'Nota',array('ttc_nota'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio")->getJsIncludes();
        $r[]=$obj->GetField("tic_tipo")->getJsIncludes();
        $r[]=$obj->GetField("ttc_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("ciu_code")->getJsIncludes();
        $r[]=$obj->GetField("ttc_nota")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("ttc_tstamp")->SetDisplayValues(Array("Name"=>"ttc_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATETIME", "IsVisible"=>true));
        $obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"CIUDADANO", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("ttc_nota")->SetDisplayValues(Array("Name"=>"ttc_nota", "Label"=>"Nota", "Size"=>1000, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}
}

if( !class_exists('class_tic_ticket_asociado_th7') ) {
class class_tic_ticket_asociado_th7 extends ctable_handler {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Otras denuncias asociadas a esta'; //Titulo de la tabla
        $this->m_isFile = false; //Es una tabla que contiene archivos, mostrar browser
        $this->m_classname = 'class_tic_ticket_asociado'; //Clase x defecto
        $this->m_total = false; //Incluir ultima fila de totales
        $this->m_id = 'otras_denuncias_asociadas_a_esta'; //Identificador para Wizards
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
        $this->m_datafields['tic_anio']=2;
        $this->m_datafields['tic_tipo']=3;
        $this->m_datafields['tta_tstamp']=4;
        $this->m_datafields['tic_nro_asoc']=5;
        $this->m_datafields['tic_anio_asoc']=6;
        $this->m_datafields['use_code']=7;

        $this->m_columns[1] = new ctable_column(1,'Fecha',array('tic_nro','tic_anio','tic_tipo','tta_tstamp'));
        $this->m_columns[2] = new ctable_column(2,'Nro',array('tic_nro_asoc'));
        $this->m_columns[3] = new ctable_column(3,'Año',array('tic_anio_asoc'));
        $this->m_columns[4] = new ctable_column(4,'Operador',array('use_code'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("tic_nro")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio")->getJsIncludes();
        $r[]=$obj->GetField("tic_tipo")->getJsIncludes();
        $r[]=$obj->GetField("tta_tstamp")->getJsIncludes();
        $r[]=$obj->GetField("tic_nro_asoc")->getJsIncludes();
        $r[]=$obj->GetField("tic_anio_asoc")->getJsIncludes();
        $r[]=$obj->GetField("use_code")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $obj->GetField("tta_tstamp")->SetDisplayValues(Array("Name"=>"tta_tstamp", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATETIME", "IsVisible"=>true));
        $obj->GetField("tic_nro_asoc")->SetDisplayValues(Array("Name"=>"tic_nro_asoc", "Label"=>"Nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("tic_anio_asoc")->SetDisplayValues(Array("Name"=>"tic_anio_asoc", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>105, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"USER", "IsVisible"=>true));
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
if( !class_exists('class_tic_ticket_upd_rec_m') ) {
class class_tic_ticket_upd_rec_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_ticket_upd_rec();
		$this->m_next_page = 'reclamos.php?last=1&OP=L'; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'reclamo_maint.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Actualización de un reclamo';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('P','Imprimir comprobante','','','reclamo_maint.php?OP=P','tic_nro|tic_anio|tic_tipo|','Imprimir comprobante','');
		$this->m_action[] = new CAction('L','Consulta de denuncias','','','recabiertos.php?last=1&OP=L','','Consulta de reclamos','');

        //Grupos
		$this->m_handler[0] = new accion_gr($this);
		$this->m_handler[1] = new ubicacion_gr($this);
		$this->m_handler[2] = new estado_gr($this);

        //Tablas
		$this->m_handler[3] = new class_tic_avance_th3($this);
		$this->m_handler[4] = new class_tic_ticket_prestaciones_th4($this);
		$this->m_handler[5] = new class_tic_ticket_organismos_th5($this);
		$this->m_handler[6] = new class_tic_ticket_ciudadano_th6($this);
		$this->m_handler[7] = new class_tic_ticket_asociado_th7($this);
		$this->m_handler[8] = new cfile_th8($this);

    }

    function RenderJSIncludes() {
        $html = '';

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_ticket_upd_rec_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
