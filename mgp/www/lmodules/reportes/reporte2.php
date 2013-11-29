<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_rep2.php";

class rep2_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Reporte de tickets vencidos";
        $this->m_classname = "rep2_sl";
        $this->m_obj = new rep2();
        $this->m_page_name = "reporte2.php";
        $this->m_result = new ctable($this->m_title);
        $this->m_print_orientation = 'L';
        $this->m_print_size = 'A4';
        $this->m_iso_codigo = '';
        $this->m_iso_revision = '';
        $this->m_views = '';
		$this->m_template_html = 'default.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';

        $this->m_search_fields = array('tic_tstamp_in','tic_tstamp_plazo','tpr_code','tor_code','tic_barrio');

        $this->addAction(6,"../tickets/ticket_maint.php?OP=V&next=../reportes/reporte2.php&last=1",array(new caction_param('tic_nro')),"","ver","V","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tic_tstamp_plazo")->SetDisplayValues(Array("Name"=>"tic_tstamp_plazo", "Label"=>"Plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "Presentation"=>"REPORTES::PRESTACIONES", "IsVisible"=>true));
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true));
        $this->m_obj->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>111, "Presentation"=>"REPORTES::BARRIO", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Codigo';
        $this->m_order = '101';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT"));
    }
}

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Organismo';
        $this->m_order = '102';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestación';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestación';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_detalle';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_detalle", "Label"=>"Prestación", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ingreso';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tstamp_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true, "ClassParams"=>"datetime"));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Plazo';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tstamp_plazo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_plazo", "Label"=>"Plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106, "Presentation"=>"DATERANGE", "IsVisible"=>true, "ClassParams"=>"datetime"));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Excedido';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'vencido';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"vencido", "Label"=>"Excedido", "Type"=>"int", "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ttp_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Identificador';
        $this->m_order = '109';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_identificador';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col110 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Dirección';
        $this->m_order = '110';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_lugar';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_lugar", "Label"=>"Dirección", "Size"=>500, "IsForDB"=>true, "Order"=>110, "Presentation"=>"TICKET::DIRECCION", "IsVisible"=>true));
    }
}

class col111 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Barrio';
        $this->m_order = '111';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_barrio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>111, "Presentation"=>"REPORTES::BARRIO"));
    }
}

class col112 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nota';
        $this->m_order = '112';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nota_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nota_in", "Label"=>"Nota", "Size"=>50, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col113 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ciudadano';
        $this->m_order = '113';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TICKET::RECLAMANTE", "IsVisible"=>true));
    }
}

class rep2_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Reporte de tickets vencidos'; //Titulo de la tabla
        $this->m_classname = 'rep2'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[107] = new col107($this);
        $this->m_cols[109] = new col109($this);
        $this->m_cols[110] = new col110($this);
        $this->m_cols[111] = new col111($this);
        $this->m_cols[112] = new col112($this);
        $this->m_cols[113] = new col113($this);
    }

}

$pg = new rep2_sl();
$pg->CreatePage();

?>
