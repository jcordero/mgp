<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_rep3.php";

class rep3_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Reporte de luminarias";
        $this->m_classname = "rep3_sl";
        $this->m_obj = new rep3();
        $this->m_page_name = "reporte3.php";
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

        $this->m_search_fields = array('tic_tstamp_in','tpr_code','tic_lugar','tic_id_elemento');

        $this->addAction(5,"../tickets/ticket_maint.php?OP=V&next=../reportes/reporte3.php&last=1",array(new caction_param('tic_nro')),"","ver","V","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsForDB"=>true, "Order"=>123, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tic_lugar")->SetDisplayValues(Array("Name"=>"tic_lugar", "Label"=>"Luminaria", "Size"=>1000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"REPORTES::LUMINARIA", "IsVisible"=>true));
        $this->m_obj->GetField("tic_id_elemento")->SetDisplayValues(Array("Name"=>"tic_id_elemento", "Label"=>"ID Elemento", "Type"=>"int", "IsForDB"=>true, "Order"=>122, "Presentation"=>"TEXT", "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false));
    }
}

class col130 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Organismo';
        $this->m_order = '130';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>130, "Presentation"=>"TICKET::ORGANISMO", "IsVisible"=>true));
    }
}

class col123 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestación';
        $this->m_order = '123';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>20, "IsForDB"=>true, "Order"=>123, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ingreso';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tstamp_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true, "ClassParams"=>"datetime"));
    }
}

class col116 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Plazo';
        $this->m_order = '116';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tstamp_plazo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_plazo", "Label"=>"Plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>116, "Presentation"=>"DATERANGE", "IsVisible"=>true, "ClassParams"=>"datetime"));
    }
}

class col126 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '126';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ttp_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
    }
}

class col121 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Identificador';
        $this->m_order = '121';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_identificador';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>45, "IsForDB"=>true, "Order"=>121, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col122 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'ID Elemento';
        $this->m_order = '122';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_id_elemento';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_id_elemento", "Label"=>"ID Elemento", "Type"=>"int", "IsForDB"=>true, "Order"=>122, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Dirección';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_lugar';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_lugar", "Label"=>"Dirección", "Size"=>1000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TICKET::DIRECCION", "IsVisible"=>true));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nota';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nota_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nota_in", "Label"=>"Nota", "Size"=>500, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class rep3_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Reporte de luminarias'; //Titulo de la tabla
        $this->m_classname = 'rep3'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[130] = new col130($this);
        $this->m_cols[123] = new col123($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[116] = new col116($this);
        $this->m_cols[126] = new col126($this);
        $this->m_cols[121] = new col121($this);
        $this->m_cols[122] = new col122($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[106] = new col106($this);
    }

}

$pg = new rep3_sl();
$pg->CreatePage();

?>
