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
        $this->m_fields[] = 'creclamos:prestacion';
        $this->m_fields[] = 'creclamos:obs';
        $this->m_fields[] = 'creclamos:nota';
        $this->m_fields[] = 'creclamos:emergencia';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos")->GetField("prestacion")->SetDisplayValues(Array("Name"=>"prestacion", "Label"=>"Prestacion", "Size"=>10, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PRESTACION", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("obs")->SetDisplayValues(Array("Name"=>"obs", "Label"=>"Nota Inicial", "Size"=>300, "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("nota")->SetDisplayValues(Array("Name"=>"nota", "Label"=>"Nota Reiteración", "Size"=>300, "Order"=>47, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("emergencia")->SetDisplayValues(Array("Name"=>"emergencia", "Label"=>"Emergencia", "Type"=>"int", "IsForDB"=>true, "Order"=>111, "Presentation"=>"FLAG", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
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
        $this->m_fields[] = 'creclamos:ext_calle_nombre';
        $this->m_fields[] = 'creclamos:callenro';
        $this->m_fields[] = 'creclamos:barrio';
        $this->m_fields[] = 'creclamos:zona';
        $this->m_fields[] = 'creclamos:ext_id_cuadra';
        $this->m_fields[] = 'creclamos:ext_coordx';
        $this->m_fields[] = 'creclamos:ext_coordy';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos")->GetField("ext_calle_nombre")->SetDisplayValues(Array("Name"=>"ext_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>140, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("callenro")->SetDisplayValues(Array("Name"=>"callenro", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>106, "Presentation"=>"INT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("barrio")->SetDisplayValues(Array("Name"=>"barrio", "Label"=>"Barrio", "Size"=>20, "IsForDB"=>true, "Order"=>134, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("zona")->SetDisplayValues(Array("Name"=>"zona", "Label"=>"CGPC", "Type"=>"int", "IsForDB"=>true, "Order"=>107, "Presentation"=>"ORGANISMO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("ext_id_cuadra")->SetDisplayValues(Array("Name"=>"ext_id_cuadra", "Label"=>"Ubicación", "Type"=>"int", "IsForDB"=>true, "Order"=>139, "Presentation"=>"MAPA", "IsVisible"=>true, "Rows"=>150, "Cols"=>150, "ClassParams"=>"ext_coordx|ext_coordy", "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("ext_coordx")->SetDisplayValues(Array("Name"=>"ext_coordx", "Type"=>"float", "IsForDB"=>true, "Order"=>137, "Presentation"=>"TEXT", "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("ext_coordy")->SetDisplayValues(Array("Name"=>"ext_coordy", "Type"=>"float", "IsForDB"=>true, "Order"=>138, "Presentation"=>"TEXT", "Class"=>"creclamos"));
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
        $this->m_fields[] = 'creclamos:anio';
        $this->m_fields[] = 'creclamos:numero';
        $this->m_fields[] = 'creclamos:estado';
        $this->m_fields[] = 'creclamos:motivo';
        $this->m_fields[] = 'creclamos:fechaingreso';
        $this->m_fields[] = 'creclamos:orgreceptor';
        $this->m_fields[] = 'creclamos:formaingreso';
        $this->m_fields[] = 'creclamos:fechaultestado';
        $this->m_fields[] = 'creclamos:fechacumplido';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos")->GetField("anio")->SetDisplayValues(Array("Name"=>"anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("numero")->SetDisplayValues(Array("Name"=>"numero", "Label"=>"Numero", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("estado")->SetDisplayValues(Array("Name"=>"estado", "Label"=>"Estado", "Type"=>"int", "IsForDB"=>true, "Order"=>123, "Presentation"=>"ESTADO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("motivo")->SetDisplayValues(Array("Name"=>"motivo", "Label"=>"Motivo", "Type"=>"int", "IsForDB"=>true, "Order"=>124, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("fechaingreso")->SetDisplayValues(Array("Name"=>"fechaingreso", "Label"=>"Fecha de ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("orgreceptor")->SetDisplayValues(Array("Name"=>"orgreceptor", "Label"=>"Ingresado en", "Type"=>"int", "IsForDB"=>true, "Order"=>120, "Presentation"=>"ORGANISMO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("formaingreso")->SetDisplayValues(Array("Name"=>"formaingreso", "Label"=>"Forma de ingreso", "Type"=>"int", "IsForDB"=>true, "Order"=>122, "Presentation"=>"FORMAINGRESO", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("fechaultestado")->SetDisplayValues(Array("Name"=>"fechaultestado", "Label"=>"Ultima actuacion", "Type"=>"datetime", "IsForDB"=>true, "Order"=>125, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
        $this->getClass("creclamos")->GetField("fechacumplido")->SetDisplayValues(Array("Name"=>"fechacumplido", "Label"=>"Fe. Cumplimiento", "Type"=>"datetime", "IsForDB"=>true, "Order"=>126, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"creclamos"));
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

        $this->m_datafields['anio']=1;
        $this->m_datafields['numero']=2;
        $this->m_datafields['quiendomcod']=3;
        $this->m_datafields['quiendomnro']=4;
        $this->m_datafields['quiendompiso']=5;
        $this->m_datafields['quiendomdpto']=6;
        $this->m_datafields['quiencodpostal']=7;
        $this->m_datafields['quienidpunto']=8;
        $this->m_datafields['quien']=9;
        $this->m_datafields['fechareit']=10;
        $this->m_datafields['quientelfax']=11;
        $this->m_datafields['quientipodoc']=12;
        $this->m_datafields['quiennrodoc']=13;
        $this->m_datafields['quienemail']=14;

        $this->m_columns[1] = new ctable_column(1,'Nombre/tel',array('anio','numero','quiendomcod','quiendomnro','quiendompiso','quiendomdpto','quiencodpostal','quienidpunto','quien'));
        $this->m_columns[2] = new ctable_column(2,'Fecha',array('fechareit'));
        $this->m_columns[3] = new ctable_column(3,'Tel.',array('quientelfax'));
        $this->m_columns[4] = new ctable_column(4,'Doc.',array('quientipodoc','quiennrodoc'));
        $this->m_columns[5] = new ctable_column(5,'EMail',array('quienemail'));
    }

    public function getJsIncludes($obj) {
        $r=array();
        $r[]=$obj->GetField("anio")->getJsIncludes();
        $r[]=$obj->GetField("numero")->getJsIncludes();
        $r[]=$obj->GetField("quiendomcod")->getJsIncludes();
        $r[]=$obj->GetField("quiendomnro")->getJsIncludes();
        $r[]=$obj->GetField("quiendompiso")->getJsIncludes();
        $r[]=$obj->GetField("quiendomdpto")->getJsIncludes();
        $r[]=$obj->GetField("quiencodpostal")->getJsIncludes();
        $r[]=$obj->GetField("quienidpunto")->getJsIncludes();
        $r[]=$obj->GetField("quien")->getJsIncludes();
        $r[]=$obj->GetField("fechareit")->getJsIncludes();
        $r[]=$obj->GetField("quientelfax")->getJsIncludes();
        $r[]=$obj->GetField("quientipodoc")->getJsIncludes();
        $r[]=$obj->GetField("quiennrodoc")->getJsIncludes();
        $r[]=$obj->GetField("quienemail")->getJsIncludes();
        return $r;
    }

    public function InitializeInstance($obj) {
        //SetDisplayValues($attributes) 
        $obj->GetField("anio")->SetDisplayValues(Array("Name"=>"anio", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $obj->GetField("numero")->SetDisplayValues(Array("Name"=>"numero", "Type"=>"int", "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $obj->GetField("quiendomcod")->SetDisplayValues(Array("Name"=>"quiendomcod", "Type"=>"int", "IsForDB"=>true, "Order"=>109));
        $obj->GetField("quiendomnro")->SetDisplayValues(Array("Name"=>"quiendomnro", "Type"=>"int", "IsForDB"=>true, "Order"=>110));
        $obj->GetField("quiendompiso")->SetDisplayValues(Array("Name"=>"quiendompiso", "Size"=>4, "IsForDB"=>true, "Order"=>111));
        $obj->GetField("quiendomdpto")->SetDisplayValues(Array("Name"=>"quiendomdpto", "Size"=>4, "IsForDB"=>true, "Order"=>112));
        $obj->GetField("quiencodpostal")->SetDisplayValues(Array("Name"=>"quiencodpostal", "Size"=>8, "IsForDB"=>true, "Order"=>113));
        $obj->GetField("quienidpunto")->SetDisplayValues(Array("Name"=>"quienidpunto", "Type"=>"int", "IsForDB"=>true, "Order"=>116));
        $obj->GetField("quien")->SetDisplayValues(Array("Name"=>"quien", "Label"=>"Nombre", "Size"=>30, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("fechareit")->SetDisplayValues(Array("Name"=>"fechareit", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATETIME", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("quientelfax")->SetDisplayValues(Array("Name"=>"quientelfax", "Label"=>"Teléfono", "Size"=>100, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PHONE", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("quientipodoc")->SetDisplayValues(Array("Name"=>"quientipodoc", "Label"=>"Tipo Doc.", "Size"=>3, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TIPODOC", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("quiennrodoc")->SetDisplayValues(Array("Name"=>"quiennrodoc", "Label"=>"Doc.Nro.", "Size"=>13, "IsForDB"=>true, "Order"=>107, "Presentation"=>"DNI", "IsVisible"=>true, "IsReadOnly"=>true));
        $obj->GetField("quienemail")->SetDisplayValues(Array("Name"=>"quienemail", "Label"=>"Correo elect.", "Size"=>45, "IsForDB"=>true, "Order"=>114, "Presentation"=>"EMAIL", "IsVisible"=>true, "IsReadOnly"=>true));
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
