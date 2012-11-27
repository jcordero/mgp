<?php
/* Pagina de formulario generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:19:13
 */
include_once "common/ctable_maint.php";
include_once "creclamos_in.php";

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

        //Campos del grupo
        $this->m_fields[] = 'creclamos_in:prestacion';
        $this->m_fields[] = 'creclamos_in:observacion';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos_in")->GetField("prestacion")->SetDisplayValues(Array('Name'=>'prestacion', 'Label'=>'Prestación', 'Size'=>20, 'Order'=>1, 'IsMandatory'=>true, 'Presentation'=>'PRESTACIONTREE', 'IsVisible'=>true, 'Cols'=>27, 'Class'=>'creclamos_in'));
        $this->getClass("creclamos_in")->GetField("observacion")->SetDisplayValues(Array('Name'=>'observacion', 'Label'=>'Observación', 'Size'=>2000, 'Order'=>2, 'Presentation'=>'TEXTAREA', 'IsVisible'=>true, 'Rows'=>4, 'Cols'=>60, 'Class'=>'creclamos_in'));
    }
}
}


if( !class_exists('ubicacion_gr') ) {
class ubicacion_gr extends cform_group {
    function __construct($parent) {
        parent::__construct($parent);
        $this->m_title = 'Ubicación'; //Titulo del grupo
        $this->m_order = 0; //Orden de presentacion de este grupo
        $this->m_id = 'ubicacion'; //Id para los wizards
        $this->m_note = ''; //Nota
        $this->m_image = ''; //Imagen
        $this->m_render_html = 'BLOCK'; //Forma de generar el contenido HTML
        $this->m_render_pdml = 'PARENT'; //Forma de generar el contenido PDF

        //Campos del grupo
        $this->m_fields[] = 'creclamos_in:barrio';
        $this->m_fields[] = 'creclamos_in:cgpc';
        $this->m_fields[] = 'creclamos_in:zona_ilum';
        $this->m_fields[] = 'creclamos_in:zona_reco';

    }

    public function InitializeInstance() {
        //SetDisplayValues($attributes) 
        $this->getClass("creclamos_in")->GetField("barrio")->SetDisplayValues(Array('Name'=>'barrio', 'Label'=>'Barrio', 'Size'=>50, 'Order'=>3, 'Presentation'=>'TEXT', 'IsVisible'=>true, 'IsReadOnly'=>true, 'Class'=>'creclamos_in'));
        $this->getClass("creclamos_in")->GetField("cgpc")->SetDisplayValues(Array('Name'=>'cgpc', 'Label'=>'CGPC', 'Size'=>50, 'Order'=>4, 'Presentation'=>'TEXT', 'IsVisible'=>true, 'IsReadOnly'=>true, 'Class'=>'creclamos_in'));
        $this->getClass("creclamos_in")->GetField("zona_ilum")->SetDisplayValues(Array('Name'=>'zona_ilum', 'Label'=>'Zona Ilum', 'Size'=>50, 'Order'=>5, 'Cols'=>15, 'Class'=>'creclamos_in'));
        $this->getClass("creclamos_in")->GetField("zona_reco")->SetDisplayValues(Array('Name'=>'zona_reco', 'Label'=>'Zona Reco', 'Size'=>50, 'Order'=>6, 'Cols'=>15, 'Class'=>'creclamos_in'));
    }
}
}

if( !class_exists('creclamos_in_m') ) {
class creclamos_in_m extends cclass_maint {
    function __construct() {
		global $primary_db;

		parent::__construct();
		$this->m_db = $primary_db;
		$this->m_template_html = 'call.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'PARTS';
		$this->m_render_pdml = 'BLOCK';
		$this->m_obj = new creclamos_in();
		$this->m_next_page = ''; //Pagina a mostrar luego de enviar/cancelar el formulario
		$this->m_this_page = 'reclamos_maint_n.php';
    	$this->m_save_to_type = 'DB'; //Si el formulario accede directo a las tablas o hace una transaccion
    	$this->m_view = ''; //Si se presenta como sabana o como wizard
    	$this->m_operation_allow = 'VNMPSD'; //Lista de operaciones permitidas
    	$this->m_operation_default = 'V'; //Operacion por defecto
    	$this->m_title = 'Alta de un reclamo';// Titulo del formulario

        //Acciones
		$this->m_action[] = new CAction('N','Nuevo reclamo','bt_nuevo.gif','','reclamos_maint_n.php?OP=N','','Cargar nuevo reclamo');
		$this->m_action[] = new CAction('P','Imprimir comprobante','bt_imprimir.gif','','reclamos_maint.php?OP=P','','Imprimir comprobante');
		$this->m_action[] = new CAction('L','Consulta de reclamos','bt_ver.gif','','reclamos.php?last=1&OP=L','','Consulta de reclamos');

        //Grupos
		$this->m_handler[] = new reclamo_gr($this);
		$this->m_handler[] = new ubicacion_gr($this);

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
$f = new creclamos_in_m();
if(!defined('NO_RENDER'))
{
    $f->CreatePage();
}
?>
