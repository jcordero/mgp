<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_tic_georef.php";

class class_tic_georef_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de GeoReferencias";
        $this->m_classname = "class_tic_georef_sl";
        $this->m_obj = new class_tic_georef();
        $this->m_page_name = "georefs.php";
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

        $this->m_search_fields = array('tge_tipo','tge_nombre');

        $this->addAction(3,"georef_maint.php?OP=V",array(new caction_param('tge_tipo'),new caction_param('tge_nombre')),"","ver","V","","");
        $this->addAction(3,"georef_maint.php?OP=M",array(new caction_param('tge_tipo'),new caction_param('tge_nombre')),"","Modificar","M","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tge_tipo")->SetDisplayValues(Array("Name"=>"tge_tipo", "Label"=>"Tipo", "Size"=>30, "IsForDB"=>true, "Order"=>101, "Presentation"=>"UBICACION", "IsVisible"=>true));
        $this->m_obj->GetField("tge_nombre")->SetDisplayValues(Array("Name"=>"tge_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_tipo", "Label"=>"Tipo", "Size"=>30, "IsForDB"=>true, "Order"=>101, "Presentation"=>"UBICACION", "IsVisible"=>true));
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
        $this->m_sort_field = 'tge_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Otra Den.';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_otra_denominacion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_otra_denominacion", "Label"=>"Otra Den.", "Size"=>500, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Calle';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_calle_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Altura';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_altura';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_altura", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "Presentation"=>"INT", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Comuna';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_cgpc';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_cgpc", "Label"=>"Comuna", "Size"=>50, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Barrio';
        $this->m_order = '109';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tge_barrio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tge_barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>109, "Presentation"=>"REPORTES::BARRIO", "IsVisible"=>true));
    }
}

class class_tic_georef_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de GeoReferencias'; //Titulo de la tabla
        $this->m_classname = 'class_tic_georef'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[109] = new col109($this);
    }

}

$pg = new class_tic_georef_sl();
$pg->CreatePage();

?>
