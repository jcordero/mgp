<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "ciu_ciudadanos_n.php";

class ciu_ciudadanos_n_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Ciudadanos";
        $this->m_classname = "ciu_ciudadanos_n_sl";
        $this->m_obj = new ciu_ciudadanos_n();
        $this->m_page_name = "ciudadanos.php";
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

        $this->m_search_fields = array('ciu_code','ciu_nombres','ciu_apellido','ciu_doc_nro');

        $this->addAction(5,"ciudadanos_maint.php?OP=V",array(new caction_param('ciu_code')),"","ver","V","","");
        $this->addAction(5,"ciudadanos_maint.php?OP=M",array(new caction_param('ciu_code')),"","modificar","M","","");
        $this->addAction(5,"ciudadanos_maint.php?OP=P",array(new caction_param('ciu_code')),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("ciu_code")->SetDisplayValues(Array("Name"=>"ciu_code", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("ciu_nombres")->SetDisplayValues(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("ciu_apellido")->SetDisplayValues(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("ciu_doc_nro")->SetDisplayValues(Array("Name"=>"ciu_doc_nro", "Label"=>"Dni", "Size"=>20, "IsForDB"=>true, "Order"=>106, "Presentation"=>"DNI", "IsVisible"=>true));
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
        $this->m_sort_field = 'ciu_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_code", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
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
        $this->m_sort_field = 'ciu_nombres';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_nombres", "Label"=>"Nombre", "Size"=>50, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Apellido';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_apellido';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_apellido", "Label"=>"Apellido", "Size"=>50, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nro Documento';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_doc_nro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_doc_nro", "Label"=>"Nro Documento", "Size"=>20, "IsForDB"=>true, "Order"=>106, "Presentation"=>"DNI", "IsVisible"=>true));
    }
}

class col104 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Sexo';
        $this->m_order = '104';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_sexo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_sexo", "Label"=>"Sexo", "Size"=>15, "IsForDB"=>true, "Order"=>104, "Presentation"=>"SEXO", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tel.Fijo';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_tel_fijo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_tel_fijo", "Label"=>"Tel.Fijo", "Size"=>20, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PHONE", "IsVisible"=>true));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tel.Movil';
        $this->m_order = '109';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_tel_movil';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_tel_movil", "Label"=>"Tel.Movil", "Size"=>20, "IsForDB"=>true, "Order"=>109, "Presentation"=>"PHONE", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Email';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ciu_email';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ciu_email", "Label"=>"Email", "Size"=>50, "IsForDB"=>true, "Order"=>107, "Presentation"=>"EMAIL", "IsVisible"=>true));
    }
}

class ciu_ciudadanos_n_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ciudadanos'; //Titulo de la tabla
        $this->m_classname = 'ciu_ciudadanos_n'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[109] = new col109($this);
        $this->m_cols[107] = new col107($this);
    }

}

$pg = new ciu_ciudadanos_n_sl();
$pg->CreatePage();

?>
