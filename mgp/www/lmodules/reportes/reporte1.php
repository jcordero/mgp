<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_rep1.php";

class rep1_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Reporte de tickets";
        $this->m_classname = "rep1_sl";
        $this->m_obj = new rep1();
        $this->m_page_name = "reporte1.php";
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

        $this->m_search_fields = array('tic_tstamp_in','tpr_code','ciu_nombres','ciu_apellido');

        $this->addAction(5,"../tickets/ticket_maint.php?OP=V&next=../reportes/reporte2.php&last=1",array(new caction_param('tic_nro')),"","ver","V","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>50, "IsForDB"=>true, "Order"=>156, "Presentation"=>"REPORTES::PRESTACIONES", "IsVisible"=>true));
        $this->m_obj->GetField("ciu_nombres")->SetDisplayValues(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("ciu_apellido")->SetDisplayValues(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"TEXT", "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col116 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Canal';
        $this->m_order = '116';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_canal';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_canal", "Label"=>"Canal", "Size"=>50, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col122 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ticket';
        $this->m_order = '122';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_identificador';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_identificador", "Label"=>"Ticket", "Size"=>50, "IsForDB"=>true, "Order"=>122, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col156 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestación';
        $this->m_order = '156';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestación", "Size"=>50, "IsForDB"=>true, "Order"=>156, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col164 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestación';
        $this->m_order = '164';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_detalle';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_detalle", "Label"=>"Prestación", "Size"=>50, "IsForDB"=>true, "Order"=>164, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nota';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nota_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nota_in", "Label"=>"Nota", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col125 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nombre';
        $this->m_order = '125';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_nombres';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col126 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Apellido';
        $this->m_order = '126';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_apellido';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col129 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'EMail';
        $this->m_order = '129';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_email';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_email", "Label"=>"EMail", "Size"=>50, "IsForDB"=>true, "Order"=>129, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col130 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Teléfono';
        $this->m_order = '130';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_tel_fijo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_tel_fijo", "Label"=>"Teléfono", "Size"=>50, "IsForDB"=>true, "Order"=>130, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col131 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Móvil';
        $this->m_order = '131';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_tel_movil';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_tel_movil", "Label"=>"Móvil", "Size"=>50, "IsForDB"=>true, "Order"=>131, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class rep1_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Reporte de tickets'; //Titulo de la tabla
        $this->m_classname = 'rep1'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[116] = new col116($this);
        $this->m_cols[122] = new col122($this);
        $this->m_cols[156] = new col156($this);
        $this->m_cols[164] = new col164($this);
        $this->m_cols[107] = new col107($this);
        $this->m_cols[125] = new col125($this);
        $this->m_cols[126] = new col126($this);
        $this->m_cols[129] = new col129($this);
        $this->m_cols[130] = new col130($this);
        $this->m_cols[131] = new col131($this);
    }

}

$pg = new rep1_sl();
$pg->CreatePage();

?>
