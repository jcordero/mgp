<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_tic_feriados.php";

class class_tic_feriados_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de Feriados";
        $this->m_classname = "class_tic_feriados_sl";
        $this->m_obj = new class_tic_feriados();
        $this->m_page_name = "feriados.php";
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

        $this->m_search_fields = array('tfe_tstamp_in','tfe_desc');

        $this->addAction(3,"feriados_maint.php?OP=B",array(new caction_param('tfe_tstamp_in')),"","Eliminar","B","","");
        $this->addAction(3,"feriados_maint.php?OP=M",array(new caction_param('tfe_tstamp_in')),"","Modificar","M","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tfe_tstamp_in")->SetDisplayValues(Array("Name"=>"tfe_tstamp_in", "Label"=>"Fecha", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"DATERANGE", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tfe_desc")->SetDisplayValues(Array("Name"=>"tfe_desc", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Fecha';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tfe_tstamp_in';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tfe_tstamp_in", "Label"=>"Fecha", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"DATERANGE", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nombre';
        $this->m_order = '102';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tfe_desc';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tfe_desc", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class class_tic_feriados_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de Feriados'; //Titulo de la tabla
        $this->m_classname = 'class_tic_feriados'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
    }

}

$pg = new class_tic_feriados_sl();
$pg->CreatePage();

?>
