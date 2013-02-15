<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_v_tickets_que.php";

class class_v_tickets_que_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de quejas";
        $this->m_classname = "class_v_tickets_que_sl";
        $this->m_obj = new class_v_tickets_que();
        $this->m_page_name = "queabiertas.php";
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

        $this->m_search_fields = array('tic_nro','tic_identificador','tic_anio','tic_tipo','ttp_estado','tic_tstamp_in','tor_code','tpr_code','tto_figura');

        $this->addAction(10,"queja_maint.php?OP=V",array(new caction_param('tic_nro'),new caction_param('tpr_code','acc_tpr_code')),"","ver","V","","");
        $this->addAction(10,"queja_maint.php?OP=M",array(new caction_param('tic_nro'),new caction_param('responsable'),new caction_param('tpr_code','acc_tpr_code')),"","Modificar","M","","");
        $this->addAction(10,"queja_maint.php?OP=P",array(new caction_param('tic_nro'),new caction_param('tpr_code','acc_tpr_code')),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "Cols"=>10));
        $this->m_obj->GetField("tic_identificador")->SetDisplayValues(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>45, "IsForDB"=>true, "Order"=>121, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
        $this->m_obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "InitialValue"=>"QUEJA", "Search"=>"fix"));
        $this->m_obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"ESTADO_QUEJA", "IsVisible"=>true));
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>129, "Presentation"=>"ORGANISMO_TICKET", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>122, "Presentation"=>"PRESTACION", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tto_figura")->SetDisplayValues(Array("Name"=>"tto_figura", "Label"=>"Rol", "Size"=>50, "IsForDB"=>true, "Order"=>130, "Presentation"=>"ROL", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Número';
        $this->m_order = '101';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "Cols"=>10));
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
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_anio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"ESTADO_QUEJA", "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>129, "Presentation"=>"ORGANISMO_TICKET", "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>122, "Presentation"=>"PRESTACION", "IsNullable"=>false, "IsVisible"=>true));
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
         $this->m_fields[] = new CField(Array("Name"=>"tto_figura", "Label"=>"Rol", "Size"=>50, "IsForDB"=>true, "Order"=>130, "Presentation"=>"ROL", "IsVisible"=>true));
    }
}

class col31 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'X';
        $this->m_order = '31';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'responsable';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"responsable", "Label"=>"X", "Size"=>5, "Order"=>31, "Presentation"=>"TEXT"));
    }
}

class class_v_tickets_que_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de quejas'; //Titulo de la tabla
        $this->m_classname = 'class_v_tickets_que'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[121] = new col121($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[125] = new col125($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[129] = new col129($this);
        $this->m_cols[122] = new col122($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[130] = new col130($this);
        $this->m_cols[31] = new col31($this);
    }

}

$pg = new class_v_tickets_que_sl();
$pg->CreatePage();

?>
