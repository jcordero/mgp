<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_tic_organismos.php";

class class_tic_organismos_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de organismos";
        $this->m_classname = "class_tic_organismos_sl";
        $this->m_obj = new class_tic_organismos();
        $this->m_page_name = "organismos.php";
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

        $this->m_search_fields = array('tor_code','tor_sigla','tor_nombre','tor_estado','tor_tipo');

        $this->addAction(6,"organ_maint.php?OP=V",array(new caction_param('tor_code')),"","ver","V","","");
        $this->addAction(6,"organ_maint.php?OP=M",array(new caction_param('tor_code')),"","modifica","M","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tor_code")->SetDisplayValues(Array("Name"=>"tor_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tor_sigla")->SetDisplayValues(Array("Name"=>"tor_sigla", "Label"=>"Sigla", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true, "Cols"=>10));
        $this->m_obj->GetField("tor_nombre")->SetDisplayValues(Array("Name"=>"tor_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tor_estado")->SetDisplayValues(Array("Name"=>"tor_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"ACTIVO", "IsVisible"=>true));
        $this->m_obj->GetField("tor_tipo")->SetDisplayValues(Array("Name"=>"tor_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"ORGANISMOTIPO", "IsVisible"=>true));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Código';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_code", "Label"=>"Código", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Sigla';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_sigla';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_sigla", "Label"=>"Sigla", "Size"=>20, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nombre';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>104, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_estado", "Label"=>"Estado", "Size"=>50, "IsForDB"=>true, "Order"=>105, "Presentation"=>"ACTIVO", "IsVisible"=>true));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '109';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_tipo", "Label"=>"Tipo", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"ORGANISMOTIPO", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Contacto';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tor_contacto';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tor_contacto", "Label"=>"Contacto", "Size"=>500, "IsForDB"=>true, "Order"=>108, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class class_tic_organismos_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de organismos'; //Titulo de la tabla
        $this->m_classname = 'class_tic_organismos'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[109] = new col109($this);
        $this->m_cols[108] = new col108($this);
    }

}

$pg = new class_tic_organismos_sl();
$pg->CreatePage();

?>
