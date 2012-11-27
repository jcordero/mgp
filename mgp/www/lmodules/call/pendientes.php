<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "ccal_to_do_small.php";

class ccal_to_do_small_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de tareas pendientes";
        $this->m_classname = "ccal_to_do_small_sl";
        $this->m_obj = new ccal_to_do_small();
        $this->m_page_name = "pendientes.php";
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

        $this->m_search_fields = array('cto_codigo','cto_estado','cto_ingreso_fecha');

        $this->addAction(4,"tarea_maint.php?OP=V",array(new caction_param('cto_codigo')),"","ver","","","");
        $this->addAction(4,"tarea_maint.php?OP=M",array(new caction_param('cto_codigo')),"","modificar","","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("cto_codigo")->SetDisplayValues(Array("Name"=>"cto_codigo", "Label"=>"Ticket", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("cto_estado")->SetDisplayValues(Array("Name"=>"cto_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"CALL_TODO_ESTADO", "IsVisible"=>true, "InitialValue"=>"PENDIENTE"));
        $this->m_obj->GetField("cto_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cto_ingreso_fecha", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Codigo';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cto_codigo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cto_codigo", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cto_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cto_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tarea';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cto_descripcion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cto_descripcion", "Label"=>"Tarea", "Size"=>3000, "IsForDB"=>true, "Order"=>107, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nota';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cto_nota';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cto_nota", "Label"=>"Nota", "Size"=>3000, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
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
        $this->m_sort_field = 'cto_ingreso_fecha';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cto_ingreso_fecha", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class ccal_to_do_small_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de tareas pendientes'; //Titulo de la tabla
        $this->m_classname = 'ccal_to_do_small'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[107] = new col107($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[105] = new col105($this);
    }

}

$pg = new ccal_to_do_small_sl();
$pg->CreatePage();

?>
