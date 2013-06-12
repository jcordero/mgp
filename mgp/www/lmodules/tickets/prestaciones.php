<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_tic_prestaciones.php";

class class_tic_prestaciones_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de prestaciones";
        $this->m_classname = "class_tic_prestaciones_sl";
        $this->m_obj = new class_tic_prestaciones();
        $this->m_page_name = "prestaciones.php";
        $this->m_result = new ctable($this->m_title);
        $this->m_print_orientation = 'P';
        $this->m_print_size = 'A4';
        $this->m_iso_codigo = '';
        $this->m_iso_revision = '';
        $this->m_views = '';
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';

        $this->m_search_fields = array('tpr_code','tpr_tipo','tpr_detalle','tpr_estado','tpr_ubicacion');

        $this->addAction(6,"prest_maint.php?OP=V",array(new caction_param('tpr_code')),"","ver","V","","");
        $this->addAction(6,"prest_maint.php?OP=M",array(new caction_param('tpr_code')),"","modifica","M","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Código", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
        $this->m_obj->GetField("tpr_tipo")->SetDisplayValues(Array("Name"=>"tpr_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>102, "Presentation"=>"PRESTACIONTIPO", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_detalle")->SetDisplayValues(Array("Name"=>"tpr_detalle", "Label"=>"Detalle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_estado")->SetDisplayValues(Array("Name"=>"tpr_estado", "Label"=>"Estado", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"ACTIVO", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_ubicacion")->SetDisplayValues(Array("Name"=>"tpr_ubicacion", "Label"=>"Ubicación", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TICKET::UBICACION", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Código';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Código", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '102';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>102, "Presentation"=>"PRESTACIONTIPO", "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Detalle';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_detalle';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_detalle", "Label"=>"Detalle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_estado", "Label"=>"Estado", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"ACTIVO", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ubicación';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_ubicacion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_ubicacion", "Label"=>"Ubicación", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TICKET::UBICACION", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Plazo';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_plazo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_plazo", "Label"=>"Plazo", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class class_tic_prestaciones_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de prestaciones'; //Titulo de la tabla
        $this->m_classname = 'class_tic_prestaciones'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[107] = new col107($this);
        $this->m_cols[108] = new col108($this);
    }

}

$pg = new class_tic_prestaciones_sl();
$pg->CreatePage();

?>
