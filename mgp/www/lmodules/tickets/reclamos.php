<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "creclamos_small.php";

class creclamos_small_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Consulta de reclamos";
        $this->m_classname = "creclamos_small_sl";
        $this->m_obj = new creclamos_small();
        $this->m_page_name = "reclamos.php";
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

        $this->m_search_fields = array('numero','anio','derivacion','estado','prestacion','fechaingreso','fechacumplido','ext_calle_nombre','callenro','barrio','zona','prestador','orgresponsable');

        $this->addAction(14,"reclamos_maint.php?OP=V",array(new caction_param('anio'),new caction_param('numero'),new caction_param('derivacion')),"","ver","V","","");
        $this->addAction(14,"reclamos_reit.php?OP=M",array(new caction_param('anio'),new caction_param('numero'),new caction_param('derivacion')),"","reiterar","M","","");
        $this->addAction(14,"reclamos_maint.php?OP=P",array(new caction_param('anio'),new caction_param('numero'),new caction_param('derivacion')),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("numero")->SetDisplayValues(Array("Name"=>"numero", "Label"=>"Número", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("anio")->SetDisplayValues(Array("Name"=>"anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("derivacion")->SetDisplayValues(Array("Name"=>"derivacion", "Label"=>"Derivacion", "Size"=>1, "Type"=>"char", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true, "Cols"=>2));
        $this->m_obj->GetField("estado")->SetDisplayValues(Array("Name"=>"estado", "Label"=>"Estado", "Type"=>"int", "IsForDB"=>true, "Order"=>123, "Presentation"=>"ESTADO", "IsVisible"=>true));
        $this->m_obj->GetField("prestacion")->SetDisplayValues(Array("Name"=>"prestacion", "Label"=>"Prestación", "Size"=>10, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PRESTACION", "IsVisible"=>true));
        $this->m_obj->GetField("fechaingreso")->SetDisplayValues(Array("Name"=>"fechaingreso", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true, "InitialValue"=>" "));
        $this->m_obj->GetField("fechacumplido")->SetDisplayValues(Array("Name"=>"fechacumplido", "Label"=>"Cumplido", "Type"=>"datetime", "IsForDB"=>true, "Order"=>126, "Presentation"=>"DATERANGE", "IsVisible"=>true, "InitialValue"=>" "));
        $this->m_obj->GetField("ext_calle_nombre")->SetDisplayValues(Array("Name"=>"ext_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>140, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("callenro")->SetDisplayValues(Array("Name"=>"callenro", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>106, "Presentation"=>"INTRANGE", "IsVisible"=>true));
        $this->m_obj->GetField("barrio")->SetDisplayValues(Array("Name"=>"barrio", "Label"=>"Barrio", "Size"=>20, "IsForDB"=>true, "Order"=>134, "Presentation"=>"BARRIOS", "IsVisible"=>true));
        $this->m_obj->GetField("zona")->SetDisplayValues(Array("Name"=>"zona", "Label"=>"CGPC", "Type"=>"int", "IsForDB"=>true, "Order"=>107, "Presentation"=>"CGPC_ORG", "IsVisible"=>true));
        $this->m_obj->GetField("prestador")->SetDisplayValues(Array("Name"=>"prestador", "Label"=>"Org.Prestador", "Type"=>"int", "IsForDB"=>true, "Order"=>109, "Presentation"=>"ORGANISMO", "IsVisible"=>true));
        $this->m_obj->GetField("orgresponsable")->SetDisplayValues(Array("Name"=>"orgresponsable", "Label"=>"Org.Responsable", "Type"=>"int", "IsForDB"=>true, "Order"=>110, "Presentation"=>"ORGANISMO", "IsVisible"=>true));
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
        $this->m_sort_field = 'anio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"anio", "Label"=>"Año", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nro.';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'numero';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"numero", "Label"=>"Nro.", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col103 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Der.';
        $this->m_order = '103';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'derivacion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"derivacion", "Label"=>"Der.", "Size"=>1, "Type"=>"char", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col123 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado';
        $this->m_order = '123';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"estado", "Label"=>"Estado", "Type"=>"int", "IsForDB"=>true, "Order"=>123, "Presentation"=>"ESTADO", "IsVisible"=>true));
    }
}

class col108 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestacion';
        $this->m_order = '108';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'prestacion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"prestacion", "Label"=>"Prestacion", "Size"=>10, "IsForDB"=>true, "Order"=>108, "Presentation"=>"PRESTACION", "IsVisible"=>true));
    }
}

class col140 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Calle';
        $this->m_order = '140';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'ext_calle_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"ext_calle_nombre", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>140, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Altura';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'callenro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"callenro", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>106, "Presentation"=>"INTRANGE", "IsVisible"=>true));
    }
}

class col134 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Barrio';
        $this->m_order = '134';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'barrio';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"barrio", "Label"=>"Barrio", "Size"=>20, "IsForDB"=>true, "Order"=>134, "Presentation"=>"BARRIOS", "IsVisible"=>true));
    }
}

class col126 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Cumplido';
        $this->m_order = '126';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'fechacumplido';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"fechacumplido", "Label"=>"Cumplido", "Type"=>"datetime", "IsForDB"=>true, "Order"=>126, "Presentation"=>"DATERANGE", "IsVisible"=>true));
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
        $this->m_sort_field = 'fechaingreso';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"fechaingreso", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col107 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'CGPC';
        $this->m_order = '107';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'zona';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"zona", "Label"=>"CGPC", "Type"=>"int", "IsForDB"=>true, "Order"=>107, "Presentation"=>"CGPC_ORG", "IsVisible"=>true));
    }
}

class col109 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Org.Prestador';
        $this->m_order = '109';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'prestador';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"prestador", "Label"=>"Org.Prestador", "Type"=>"int", "IsForDB"=>true, "Order"=>109, "Presentation"=>"ORGANISMO", "IsVisible"=>true));
    }
}

class col110 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Org.Responsable';
        $this->m_order = '110';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'orgresponsable';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"orgresponsable", "Label"=>"Org.Responsable", "Type"=>"int", "IsForDB"=>true, "Order"=>110, "Presentation"=>"ORGANISMO", "IsVisible"=>true));
    }
}

class col113 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Nota';
        $this->m_order = '113';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'obs';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"obs", "Label"=>"Nota", "Size"=>300, "IsForDB"=>true, "Order"=>113, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class creclamos_small_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Consulta de reclamos'; //Titulo de la tabla
        $this->m_classname = 'creclamos_small'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[102] = new col102($this);
        $this->m_cols[101] = new col101($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[123] = new col123($this);
        $this->m_cols[108] = new col108($this);
        $this->m_cols[140] = new col140($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[134] = new col134($this);
        $this->m_cols[126] = new col126($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[107] = new col107($this);
        $this->m_cols[109] = new col109($this);
        $this->m_cols[110] = new col110($this);
        $this->m_cols[113] = new col113($this);
    }

}

$pg = new creclamos_small_sl();
$pg->CreatePage();

?>
