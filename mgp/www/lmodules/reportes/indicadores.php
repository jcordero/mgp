<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "class_indicadores.php";

class indicadores_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Indicadores";
        $this->m_classname = "indicadores_sl";
        $this->m_obj = new indicadores();
        $this->m_page_name = "indicadores.php";
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

        $this->m_search_fields = array('tin_code','tin_nombre','tin_estado','tin_tstamp','use_code');

        $this->addAction(6,"indicador_maint.php?OP=V",array(new caction_param('tin_code')),"","ver","V","","");
        $this->addAction(6,"indicador_maint.php?OP=M",array(new caction_param('tin_code')),"","modificar","M","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("tin_code")->SetDisplayValues(Array("Name"=>"tin_code", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("tin_nombre")->SetDisplayValues(Array("Name"=>"tin_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("tin_estado")->SetDisplayValues(Array("Name"=>"tin_estado", "Label"=>"Estado", "Size"=>45, "IsForDB"=>true, "Order"=>105, "Presentation"=>"ACTIVO", "IsVisible"=>true));
        $this->m_obj->GetField("tin_tstamp")->SetDisplayValues(Array("Name"=>"tin_tstamp", "Label"=>"Creado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
        $this->m_obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"USER", "IsVisible"=>true, "InitialValue"=>" "));
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
        $this->m_sort_field = 'tin_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tin_code", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true, "IsReadOnly"=>true));
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
        $this->m_sort_field = 'tin_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tin_nombre", "Label"=>"Nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
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
        $this->m_sort_field = 'tin_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tin_estado", "Label"=>"Estado", "Size"=>45, "IsForDB"=>true, "Order"=>105, "Presentation"=>"ACTIVO", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Creado';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'tin_tstamp';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"tin_tstamp", "Label"=>"Creado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true, "IsReadOnly"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Operador';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'use_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"USER", "IsVisible"=>true, "IsReadOnly"=>true));
    }
}

class indicadores_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Indicadores'; //Titulo de la tabla
        $this->m_classname = 'indicadores'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[103] = new col103($this);
    }

}

$pg = new indicadores_sl();
$pg->CreatePage();

?>
