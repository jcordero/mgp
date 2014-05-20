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
        $this->m_obj->GetField("tic_anio")->SetDisplayValues(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>10, "InitialValue"=>"2014"));
        $this->m_obj->GetField("tic_tipo")->SetDisplayValues(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TICKET::PRESTACIONTIPO", "IsNullable"=>false, "IsVisible"=>true, "InitialValue"=>"RECLAMO", "Search"=>"fix"));
        $this->m_obj->GetField("ttp_estado")->SetDisplayValues(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
        $this->m_obj->GetField("tic_tstamp_in")->SetDisplayValues(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>130, "Presentation"=>"REPORTES::ORGANISMO", "IsVisible"=>true));
        $this->m_obj->GetField("tpr_code")->SetDisplayValues(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>123, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tru_code")->SetDisplayValues(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>124, "Presentation"=>"RUBRO", "IsVisible"=>true));
        $this->m_obj->GetField("tic_calle_nombre")->SetDisplayValues(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tic_nro_puerta")->SetDisplayValues(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>119, "Presentation"=>"INTRANGE", "IsVisible"=>true));
        $this->m_obj->GetField("tic_barrio")->SetDisplayValues(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::BARRIO", "IsVisible"=>true));
    }

}


class col1 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ticket';
        $this->m_order = '1';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false));
         $this->m_fields[] = new CField(Array("Name"=>"tic_identificador", "Label"=>"Identificador", "Size"=>45, "IsForDB"=>true, "Order"=>121, "Presentation"=>"TEXT", "IsVisible"=>true));
         $this->m_fields[] = new CField(Array("Name"=>"tic_anio", "Label"=>"Año", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "Cols"=>10));
         $this->m_fields[] = new CField(Array("Name"=>"tic_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false));
         $this->m_fields[] = new CField(Array("Name"=>"tic_tstamp_in", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col2 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '2';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ttp_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>126, "Presentation"=>"REPORTES::ESTADO_PRESTACION", "IsVisible"=>true));
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Organismo", "Type"=>"int", "IsForDB"=>true, "Order"=>130, "Presentation"=>"REPORTES::ORGANISMO", "IsVisible"=>true));
         $this->m_fields[] = new CField(Array("Name"=>"tto_figura", "Label"=>"Rol", "Size"=>50, "IsForDB"=>true, "Order"=>131, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col3 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestacion';
        $this->m_order = '3';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tpr_code", "Label"=>"Prestacion", "Size"=>20, "IsForDB"=>true, "Order"=>123, "Presentation"=>"REPORTES::PRESTACIONES", "IsNullable"=>false, "IsVisible"=>true));
         $this->m_fields[] = new CField(Array("Name"=>"tru_code", "Label"=>"Rubro", "Type"=>"int", "IsForDB"=>true, "Order"=>124, "Presentation"=>"RUBRO", "IsVisible"=>true));
    }
}

class col4 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Dirección';
        $this->m_order = '4';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>118, "Presentation"=>"TEXT"));
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro_puerta", "Label"=>"Nro", "Type"=>"int", "IsForDB"=>true, "Order"=>119, "Presentation"=>"INTRANGE"));
         $this->m_fields[] = new CField(Array("Name"=>"tic_barrio", "Label"=>"Barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::BARRIO"));
         $this->m_fields[] = new CField(Array("Name"=>"tic_lugar", "Label"=>"Dirección", "Size"=>1000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TICKET::DIRECCION", "IsVisible"=>true));
    }
}

class col5 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Reclamante';
        $this->m_order = '5';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tic_nro", "Label"=>"Ciudadano", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TICKET::RECLAMANTE", "IsNullable"=>false, "IsVisible"=>true));
         $this->m_fields[] = new CField(Array("Name"=>"tic_nota_in", "Label"=>"Nota", "Size"=>500, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
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
        $this->m_cols[1] = new col1($this);
        $this->m_cols[2] = new col2($this);
        $this->m_cols[3] = new col3($this);
        $this->m_cols[4] = new col4($this);
        $this->m_cols[5] = new col5($this);
    }

}

$pg = new class_v_tickets1_sl();
$pg->CreatePage();

?>
