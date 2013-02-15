<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/ctable_maint.php";
include_once "class_tic_ticket.php";

//Genero las clases de los handlers

if( !class_exists('reclamo_gr') ) {
class reclamo_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Asunto'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'reclamo'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:forms';
        $this->m_fields[] = 'class_tic_ticket:prestacion';
        $this->m_fields[] = 'class_tic_ticket:rubro';
        $this->m_fields[] = 'class_tic_ticket:tic_nota_in';
        $this->m_fields[] = 'class_tic_ticket:use_code';
        $this->m_fields[] = 'class_tic_ticket:tipo_georef';
        $this->m_fields[] = 'class_tic_ticket:cuestionario';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("forms")->SetDisplayValues(Array("Name"=>"forms", "Type"=>"int", "Order"=>22, "Presentation"=>"SEQUENCE", "ClassParams"=>"forms", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("prestacion")->SetDisplayValues(Array("Name"=>"prestacion", "Label"=>"Prestación", "Size"=>20, "Order"=>23, "IsMandatory"=>true, "Presentation"=>"PRESTACIONTREE", "IsVisible"=>true, "Cols"=>27, "ClassParams"=>"cuestionario", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("rubro")->SetDisplayValues(Array("Name"=>"rubro", "Label"=>"Rubro", "Size"=>100, "Order"=>24, "IsMandatory"=>true, "Presentation"=>"RUBRO", "IsVisible"=>true, "ClassParams"=>"no_fill", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_nota_in")->SetDisplayValues(Array("Name"=>"tic_nota_in", "Label"=>"Observación", "Size"=>500, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXTAREA", "IsVisible"=>true, "Rows"=>4, "Cols"=>60, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"CURRENTUSER", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tipo_georef")->SetDisplayValues(Array("Name"=>"tipo_georef", "Label"=>"Tipo georeferencia", "Size"=>50, "Order"=>26, "Presentation"=>"TEXT", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("cuestionario")->SetDisplayValues(Array("Name"=>"cuestionario", "Label"=>"Cuestionario", "Size"=>3000, "Order"=>25, "Presentation"=>"CUESTIONARIO", "ClassParams"=>"prestacion", "Class"=>"class_tic_ticket"));
    }
}
}


if( !class_exists('domicilio_gr') ) {
class domicilio_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación DOMICILIO'; //Titulo del grupo
        $this->m_order = 1; //Orden de presentacion de este grupo
        $this->m_id = 'domicilio'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:calle';
        $this->m_fields[] = 'class_tic_ticket:callenro';
        $this->m_fields[] = 'class_tic_ticket:calle_nombre';
        $this->m_fields[] = 'class_tic_ticket:piso';
        $this->m_fields[] = 'class_tic_ticket:dpto';
        $this->m_fields[] = 'class_tic_ticket:nombre_fantasia';
        $this->m_fields[] = 'class_tic_ticket:mapa';
        $this->m_fields[] = 'class_tic_ticket:tic_id_cuadra';
        $this->m_fields[] = 'class_tic_ticket:tic_coordx';
        $this->m_fields[] = 'class_tic_ticket:tic_coordy';
        $this->m_fields[] = 'class_tic_ticket:tic_barrio';
        $this->m_fields[] = 'class_tic_ticket:tic_cgpc';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("calle")->SetDisplayValues(Array("Name"=>"calle", "Label"=>"Calle", "Type"=>"int", "Order"=>29, "IsMandatory"=>true, "Presentation"=>"CALLE", "IsVisible"=>true, "Cols"=>60, "ClassParams"=>"callenro|tic_coordx|tic_coordy|tic_barrio|tic_cgpc|||mapa|calle_nombre", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("callenro")->SetDisplayValues(Array("Name"=>"callenro", "Label"=>"Altura", "Type"=>"int", "Order"=>30, "IsMandatory"=>true, "Presentation"=>"ALTURA", "IsVisible"=>true, "Cols"=>5, "ClassParams"=>"calle", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("calle_nombre")->SetDisplayValues(Array("Name"=>"calle_nombre", "Label"=>"Calle Nombre", "Size"=>100, "Order"=>28, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("piso")->SetDisplayValues(Array("Name"=>"piso", "Label"=>"Piso", "Type"=>"int", "Order"=>31, "Presentation"=>"INT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("dpto")->SetDisplayValues(Array("Name"=>"dpto", "Label"=>"Departamento", "Size"=>20, "Order"=>32, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("nombre_fantasia")->SetDisplayValues(Array("Name"=>"nombre_fantasia", "Label"=>"Nom.fantasía", "Size"=>100, "Order"=>33, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("mapa")->SetDisplayValues(Array("Name"=>"mapa", "Label"=>"Ubicación", "Type"=>"int", "Order"=>27, "Presentation"=>"MAPA", "IsVisible"=>true, "IsReadOnly"=>true, "Rows"=>150, "Cols"=>150, "ClassParams"=>"tic_coordx|tic_coordy", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_id_cuadra")->SetDisplayValues(Array("Name"=>"tic_id_cuadra", "Label"=>"id cuadra", "Type"=>"int", "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_coordx")->SetDisplayValues(Array("Name"=>"tic_coordx", "Label"=>"x", "Type"=>"double", "IsForDB"=>true, "Order"=>111, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_coordy")->SetDisplayValues(Array("Name"=>"tic_coordy", "Label"=>"y", "Type"=>"double", "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("tic_cgpc")->SetDisplayValues(Array("Name"=>"tic_cgpc", "Label"=>"CGPC", "Size"=>20, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TEXT", "IsVisible"=>true, "IsReadOnly"=>true, "Class"=>"class_tic_ticket"));
    }
}
}


if( !class_exists('villa_gr') ) {
class villa_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación VILLA'; //Titulo del grupo
        $this->m_order = 2; //Orden de presentacion de este grupo
        $this->m_id = 'villa'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:villa';
        $this->m_fields[] = 'class_tic_ticket:vilmanzana';
        $this->m_fields[] = 'class_tic_ticket:vilcasa';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("villa")->SetDisplayValues(Array("Name"=>"villa", "Label"=>"Villa", "Size"=>100, "Order"=>34, "IsMandatory"=>true, "Presentation"=>"VILLA", "IsVisible"=>true, "ClassParams"=>"calle|callenro|calle_nombre|tic_coordx|tic_coordy|tic_barrio|tic_cgpc", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("vilmanzana")->SetDisplayValues(Array("Name"=>"vilmanzana", "Label"=>"Manzana", "Size"=>20, "Order"=>35, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("vilcasa")->SetDisplayValues(Array("Name"=>"vilcasa", "Label"=>"Casa", "Size"=>20, "Order"=>36, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
    }
}
}


if( !class_exists('orgpublico_gr') ) {
class orgpublico_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación ORGANISMO PUBLICO'; //Titulo del grupo
        $this->m_order = 3; //Orden de presentacion de este grupo
        $this->m_id = 'orgpublico'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:orgpublico';
        $this->m_fields[] = 'class_tic_ticket:orgsector';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("orgpublico")->SetDisplayValues(Array("Name"=>"orgpublico", "Label"=>"Organismo público", "Size"=>100, "Order"=>38, "IsMandatory"=>true, "Presentation"=>"ORGPUBLICO", "IsVisible"=>true, "ClassParams"=>"calle|callenro|calle_nombre|tic_coordx|tic_coordy|tic_barrio|tic_cgpc", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("orgsector")->SetDisplayValues(Array("Name"=>"orgsector", "Label"=>"Area o sector", "Size"=>100, "Order"=>39, "Presentation"=>"TEXT", "IsVisible"=>true, "Class"=>"class_tic_ticket"));
    }
}
}


if( !class_exists('plaza_gr') ) {
class plaza_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación PLAZA'; //Titulo del grupo
        $this->m_order = 4; //Orden de presentacion de este grupo
        $this->m_id = 'plaza'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:plaza';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("plaza")->SetDisplayValues(Array("Name"=>"plaza", "Label"=>"Plaza o parque", "Size"=>100, "Order"=>37, "IsMandatory"=>true, "Presentation"=>"PLAZA", "IsVisible"=>true, "ClassParams"=>"calle|callenro|calle_nombre|tic_coordx|tic_coordy|tic_barrio|tic_cgpc", "Class"=>"class_tic_ticket"));
    }
}
}


if( !class_exists('cementerio_gr') ) {
class cementerio_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación CEMENTERIO'; //Titulo del grupo
        $this->m_order = 5; //Orden de presentacion de este grupo
        $this->m_id = 'cementerio'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF
        $this->m_comment = '';// Comentario del formulario
        $this->m_css_prefix = '';// Prefijo CSS

        //Campos del grupo
        $this->m_fields[] = 'class_tic_ticket:cementerio';
        $this->m_fields[] = 'class_tic_ticket:sepultura';
        $this->m_fields[] = 'class_tic_ticket:sepsector';
        $this->m_fields[] = 'class_tic_ticket:sepcalle';
        $this->m_fields[] = 'class_tic_ticket:sepnumero';
        $this->m_fields[] = 'class_tic_ticket:sepfila';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("class_tic_ticket")->GetField("cementerio")->SetDisplayValues(Array("Name"=>"cementerio", "Label"=>"Cementerio", "Size"=>100, "Order"=>40, "IsMandatory"=>true, "Presentation"=>"CEMENTERIO", "IsVisible"=>true, "ClassParams"=>"calle|callenro|calle_nombre|tic_coordx|tic_coordy|tic_barrio|tic_cgpc", "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("sepultura")->SetDisplayValues(Array("Name"=>"sepultura", "Label"=>"Tipo de sepultura", "Size"=>100, "Order"=>41, "Presentation"=>"SEPULTURA", "IsVisible"=>true, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("sepsector")->SetDisplayValues(Array("Name"=>"sepsector", "Label"=>"Nombre panteon o boveda", "Size"=>100, "Order"=>42, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("sepcalle")->SetDisplayValues(Array("Name"=>"sepcalle", "Label"=>"Calle", "Size"=>100, "Order"=>43, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("sepnumero")->SetDisplayValues(Array("Name"=>"sepnumero", "Label"=>"Numero", "Size"=>100, "Order"=>44, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
        $this->getClass("class_tic_ticket")->GetField("sepfila")->SetDisplayValues(Array("Name"=>"sepfila", "Label"=>"Fila", "Size"=>100, "Order"=>45, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>5, "Class"=>"class_tic_ticket"));
    }
}
}

if( !class_exists('class_tic_ticket_m') ) {
class class_tic_ticket_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'ticket.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new class_tic_ticket();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'tickets_maint_n.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSDB'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'N'; //Operacion por defecto
    	$this->m_title = 'Alta de un ticket';// Titulo del formulario
    	$this->m_comment = '';// Comentario del formulario
    	$this->m_event_n = '';// Evento al ingresar nuevo
    	$this->m_event_m = '';// Evento al modificar
    	$this->m_event_b = '';// Evento al eliminar
    	$this->m_event_v = '';// Evento al visualizar
    	$this->m_event_p = '';// Evento al imprimir
    	$this->m_css_prefix = '';// Prefijo CSS

        //Acciones
		$this->m_action[] = new CAction('N','Nuevo ticket','','','tickets_maint_n.php?OP=N','','Cargar nuevo ticket','');
		$this->m_action[] = new CAction('P','Imprimir comprobante','','','ticket_maint.php?OP=P','forms|tic_nro|','Imprimir comprobante','');
		$this->m_action[] = new CAction('L','Consulta de tickets','','','tickets.php?last=1&OP=L','','Consulta de tickets','');

        //Grupos
		$this->m_handler[0] = new reclamo_gr($this);
		$this->m_handler[1] = new domicilio_gr($this);
		$this->m_handler[2] = new villa_gr($this);
		$this->m_handler[3] = new orgpublico_gr($this);
		$this->m_handler[4] = new plaza_gr($this);
		$this->m_handler[5] = new cementerio_gr($this);

    }

    function RenderJSIncludes() {
        $html = '';
        $html.="<script type='text/javascript' src='tickets_maint_n.js'></script>";

        return $html;
    }
}
}

//Genero el form en HTML
$f = new class_tic_ticket_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
