<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_v_tickets.php";

class class_v_tickets_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de reclamos";
        $this->m_classname = "class_v_tickets_sl";
        $this->m_obj = new class_v_tickets();
        $this->m_page_name = "recabiertos.php";
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

        $this->m_search_fields = array('tic_nro','tic_anio','tic_tipo','ttp_estado','ttp_tstamp','tor_code','tpr_code','tru_code','tic_calle_nombre','tic_nro_puerta','tic_barrio');

        $this->addAction(12,"reclamo_maint.php?OP=V",array(new caction_param('tic_nro'),new caction_param('tic_anio'),new caction_param('tic_tipo'),new caction_param('tpr_code','acc_tpr_code')),"","ver","V","","");
        $this->addAction(12,"reclamo_maint.php?OP=M",array(new caction_param('tic_nro'),new caction_param('tic_anio'),new caction_param('tic_tipo'),new caction_param('responsable'),new caction_param('tpr_code','acc_tpr_code')),"","Modificar","M","","");
        $this->addAction(12,"reclamo_maint.php?OP=P",array(new caction_param('tic_nro'),new caction_param('tic_anio'),new caction_param('tic_tipo'),new caction_param('tpr_code','acc_tpr_code')),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tic_nro")->SetDisplayValues(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
        $this->m_obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
        $this->m_obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "InitialValue"=>"RECLAMO"));
        $this->m_obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true));
        $this->m_obj->GetField("ttp_tstamp")->SetDisplayValues(Array("Name"=>"ttp_tstamp", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>108, "Presentation"=>"ORGANISMO_TICKET", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"PRESTACION", "IsVisible"=>true));
        $this->m_obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>111, "Presentation"=>"RUBRO", "IsVisible"=>true));
        $this->m_obj->GetField("tic_calle_nombre")->SetDisplayValues(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tic_nro_puerta")->SetDisplayValues(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>113, "Presentation"=>"INTRANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>114, "Presentation"=>"BARRIOS", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Número';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
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
         $this->m_fields[] = new CField(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10));
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
         $this->m_fields[] = new CField(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ttp_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>106, "Presentation"=>"ESTADO_DENUNCIA", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ingresado';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ttp_tstamp';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_tstamp", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Organismo';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>108, "Presentation"=>"ORGANISMO_TICKET", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestacion';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tpr_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>104, "Presentation"=>"PRESTACION", "IsVisible"=>true));
    }
}

class col111 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Rubro';
        $this->m_order = '111';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tru_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>111, "Presentation"=>"RUBRO", "IsVisible"=>true));
    }
}

class col112 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Calle';
        $this->m_order = '112';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_calle_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>112, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col113 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nro';
        $this->m_order = '113';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_nro_puerta';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>113, "Presentation"=>"INT", "IsVisible"=>true));
    }
}

class col114 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Barrio';
        $this->m_order = '114';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tic_barrio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>114, "Presentation"=>"BARRIOS", "IsVisible"=>true));
    }
}

class col116 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'X';
        $this->m_order = '116';
        $this->m_isvisible = false;
        $this->m_align = 'left';
        $this->m_sort_field = 'responsable';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"responsable", "Label"=>"X", "Size"=>5, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT"));
    }
}

class class_v_tickets_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de reclamos'; //Titulo de la tabla
        $this->m_classname = 'class_v_tickets'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[111] = new col111($this);
        $this->m_cols[112] = new col112($this);
        $this->m_cols[113] = new col113($this);
        $this->m_cols[114] = new col114($this);
        $this->m_cols[116] = new col116($this);
    }

}

$pg = new class_v_tickets_sl();
$pg->CreatePage();

?>
