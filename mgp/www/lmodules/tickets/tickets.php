<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_v_tickets1.php";

class class_v_tickets1_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de tickets";
        $this->m_classname = "class_v_tickets1_sl";
        $this->m_obj = new class_v_tickets1();
        $this->m_page_name = "tickets.php";
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

        $this->m_search_fields = array('tic_identificador','tic_anio','tic_tipo','ttp_estado','tic_tstamp_in','tor_code','tpr_code','tru_code','tic_calle_nombre','tic_nro_puerta','tic_barrio');

        $this->addAction(12,"ticket_maint.php?OP=V",array(new caction_param('tic_nro')),"","ver","V","","");
        $this->addAction(12,"ticket_maint.php?OP=P",array(new caction_param('tic_nro')),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_identificador")->SetDisplayValues(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>45, "IsForDB"=>true, "Order"=>121, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>45));
        $this->m_obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10, "InitialValue"=>"2013"));
        $this->m_obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TICKET::PRESTACIONTIPO", "IsNullable"=>false, "IsVisible"=>true, "InitialValue"=>"RECLAMO", "Search"=>"fix"));
        $this->m_obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>129, "Presentation"=>"REPORTES::ORGANISMO", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>122, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>123, "Presentation"=>"RUBRO", "IsVisible"=>true));
        $this->m_obj->GetField("tic_calle_nombre")->SetDisplayValues(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tic_nro_puerta")->SetDisplayValues(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>119, "Presentation"=>"INTRANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::BARRIO", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = '';
        $this->m_order = '101';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false));
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

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Año';
        $this->m_order = '102';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_anio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "Cols"=>10));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '103';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false));
    }
}

class col125 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '125';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ttp_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ingresado';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tstamp_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col122 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestacion';
        $this->m_order = '122';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>122, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col123 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Rubro';
        $this->m_order = '123';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tru_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>123, "Presentation"=>"RUBRO", "IsVisible"=>true));
    }
}

class col118 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Calle';
        $this->m_order = '118';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_calle_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT"));
    }
}

class col119 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nro';
        $this->m_order = '119';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro_puerta';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>119, "Presentation"=>"INTRANGE"));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Barrio';
        $this->m_order = '109';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_barrio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::BARRIO"));
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

class col129 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Organismo';
        $this->m_order = '129';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>129, "Presentation"=>"REPORTES::ORGANISMO", "IsVisible"=>true));
    }
}

class col130 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Rol';
        $this->m_order = '130';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tto_figura';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tto_figura", "Label"=>"Rol", "Size"=>50, "IsForDB"=>true, "Order"=>130, "Presentation"=>"TEXT", "IsVisible"=>true));
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

class col131 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ciudadano';
        $this->m_order = '131';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TICKET::RECLAMANTE", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class class_v_tickets1_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de tickets'; //Titulo de la tabla
        $this->m_classname = 'class_v_tickets1'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[121] = new col121($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[125] = new col125($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[122] = new col122($this);
        $this->m_cols[123] = new col123($this);
        $this->m_cols[118] = new col118($this);
        $this->m_cols[119] = new col119($this);
        $this->m_cols[109] = new col109($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[129] = new col129($this);
        $this->m_cols[130] = new col130($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[131] = new col131($this);
    }

}

$pg = new class_v_tickets1_sl();
$pg->CreatePage();

?>
