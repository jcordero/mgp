<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "cal_llamados.class.php";

class ccal_llamados_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Llamados realizados";
        $this->m_classname = "ccal_llamados_sl";
        $this->m_obj = new ccal_llamados();
        $this->m_page_name = "llamados.php";
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

        $this->m_search_fields = array('cqu_tel_fijo','cqu_tel_movil','use_code','cll_fecha','cqu_nombre');

    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("cqu_tel_fijo")->SetDisplayValues(Array("Name"=>"cqu_tel_fijo", "Label"=>"Tel. Fijo", "Size"=>30, "IsForDB"=>true, "Order"=>102, "Presentation"=>"PHONE", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_tel_movil")->SetDisplayValues(Array("Name"=>"cqu_tel_movil", "Label"=>"Tel. Móvil", "Size"=>30, "IsForDB"=>true, "Order"=>103, "Presentation"=>"PHONE", "IsVisible"=>true));
        $this->m_obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"USER", "IsVisible"=>true));
        $this->m_obj->GetField("cll_fecha")->SetDisplayValues(Array("Name"=>"cll_fecha", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_nombre")->SetDisplayValues(Array("Name"=>"cqu_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}


class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nombre';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tel. Fijo';
        $this->m_order = '102';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_tel_fijo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_tel_fijo", "Label"=>"Tel. Fijo", "Size"=>30, "IsForDB"=>true, "Order"=>102, "Presentation"=>"PHONE", "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tel. Móvil';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_tel_movil';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_tel_movil", "Label"=>"Tel. Móvil", "Size"=>30, "IsForDB"=>true, "Order"=>103, "Presentation"=>"PHONE", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Operador';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'use_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"USER", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Fecha';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cll_fecha';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cll_fecha", "Label"=>"Fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class ccal_llamados_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Llamados realizados'; //Titulo de la tabla
        $this->m_classname = 'ccal_llamados'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[106] = new col106($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[104] = new col104($this);
    }

}

$pg = new ccal_llamados_sl();
$pg->CreatePage();

?>
