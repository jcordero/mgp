<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / www.CommSys.com.ar
 */
include_once "common/csearchandlist.php";

//Clases involucradas en esta pagina
include_once "ccal_queue.php";

class ccal_queue_sl extends csearchandlist {
    function __construct() {
        parent::__construct();
        $this->m_title = "Contactos realizados";
        $this->m_classname = "ccal_queue_sl";
        $this->m_obj = new ccal_queue();
        $this->m_page_name = "colallamadasadm.php";
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

        $this->m_search_fields = array('cqu_codigo','cqu_contacto','cqu_tipo','cqu_estado','cqu_estado_contacto','cqu_prestacion','cqu_ingreso_fecha','cqu_tel_fijo','cqu_tel_movil','cqu_nombre','use_code','cqu_resultado','cqu_actitud','cqu_egreso_fecha');

        $this->addAction(15,"llamada_maint_v.php?OP=V",array(new caction_param('cqu_codigo')),"","Ver llamada","V","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
        $this->m_obj->GetField("cqu_codigo")->SetDisplayValues(Array("Name"=>"cqu_codigo", "Label"=>"Codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("cqu_contacto")->SetDisplayValues(Array("Name"=>"cqu_contacto", "Label"=>"Contacto", "Size"=>50, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
        $this->m_obj->GetField("cqu_tipo")->SetDisplayValues(Array("Name"=>"cqu_tipo", "Label"=>"Tipo", "Size"=>50, "IsForDB"=>true, "Order"=>132, "Presentation"=>"TIPOCONTACTO", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_estado")->SetDisplayValues(Array("Name"=>"cqu_estado", "Label"=>"Estado llamada", "Size"=>50, "IsForDB"=>true, "Order"=>123, "Presentation"=>"CALL_ESTADO", "IsVisible"=>true, "InitialValue"=>"COMPLETADA"));
        $this->m_obj->GetField("cqu_estado_contacto")->SetDisplayValues(Array("Name"=>"cqu_estado_contacto", "Label"=>"Estado contacto", "Size"=>50, "IsForDB"=>true, "Order"=>134, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_prestacion")->SetDisplayValues(Array("Name"=>"cqu_prestacion", "Label"=>"Prestacion", "Size"=>200, "IsForDB"=>true, "Order"=>105, "Presentation"=>"PRESTACION", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_ingreso_fecha")->SetDisplayValues(Array("Name"=>"cqu_ingreso_fecha", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>121, "Presentation"=>"DATERANGE", "IsVisible"=>true, "InitialValue"=>" "));
        $this->m_obj->GetField("cqu_tel_fijo")->SetDisplayValues(Array("Name"=>"cqu_tel_fijo", "Label"=>"Telefono", "Size"=>30, "IsForDB"=>true, "Order"=>117, "Presentation"=>"PHONE", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_tel_movil")->SetDisplayValues(Array("Name"=>"cqu_tel_movil", "Label"=>"Celular", "Size"=>30, "IsForDB"=>true, "Order"=>118, "Presentation"=>"PHONE", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_nombre")->SetDisplayValues(Array("Name"=>"cqu_nombre", "Label"=>"Reclamante", "Size"=>100, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true));
        $this->m_obj->GetField("use_code")->SetDisplayValues(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>120, "Presentation"=>"USER", "IsVisible"=>true, "InitialValue"=>" "));
        $this->m_obj->GetField("cqu_resultado")->SetDisplayValues(Array("Name"=>"cqu_resultado", "Label"=>"Resultado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"CALL_RESULTADO", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_actitud")->SetDisplayValues(Array("Name"=>"cqu_actitud", "Label"=>"Actitud", "Size"=>50, "IsForDB"=>true, "Order"=>127, "Presentation"=>"CALL_ACTITUD", "IsVisible"=>true));
        $this->m_obj->GetField("cqu_egreso_fecha")->SetDisplayValues(Array("Name"=>"cqu_egreso_fecha", "Label"=>"Cursada", "Type"=>"datetime", "IsForDB"=>true, "Order"=>122, "Presentation"=>"DATERANGE", "IsVisible"=>true, "InitialValue"=>" "));
    }

}


class col101 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Cod.';
        $this->m_order = '101';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_codigo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_codigo", "Label"=>"Cod.", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "Presentation"=>"INT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col102 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Contacto';
        $this->m_order = '102';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_contacto';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_contacto", "Label"=>"Contacto", "Size"=>50, "IsForDB"=>true, "Order"=>102, "Presentation"=>"TEXT", "IsNullable"=>false, "IsVisible"=>true));
    }
}

class col132 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Tipo';
        $this->m_order = '132';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_tipo';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_tipo", "Label"=>"Tipo", "Size"=>50, "IsForDB"=>true, "Order"=>132, "Presentation"=>"TIPOCONTACTO", "IsVisible"=>true));
    }
}

class col134 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado contacto';
        $this->m_order = '134';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_estado_contacto';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_estado_contacto", "Label"=>"Estado contacto", "Size"=>50, "IsForDB"=>true, "Order"=>134, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col123 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Estado llamada';
        $this->m_order = '123';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_estado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_estado", "Label"=>"Estado llamada", "Size"=>50, "IsForDB"=>true, "Order"=>123, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col105 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Prestacion';
        $this->m_order = '105';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_prestacion';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_prestacion", "Label"=>"Prestacion", "Size"=>200, "IsForDB"=>true, "Order"=>105, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col106 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Rubro';
        $this->m_order = '106';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_rubro';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_rubro", "Label"=>"Rubro", "Size"=>200, "IsForDB"=>true, "Order"=>106, "Presentation"=>"TEXT", "IsVisible"=>true));
    }
}

class col116 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Reclamante';
        $this->m_order = '116';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_nombre';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_nombre", "Label"=>"Reclamante", "Size"=>100, "IsForDB"=>true, "Order"=>116, "Presentation"=>"TEXT", "IsVisible"=>true));
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
        $this->m_sort_field = 'cqu_calle';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_calle", "Label"=>"Calle", "Size"=>100, "IsForDB"=>true, "Order"=>103, "Presentation"=>"TEXT", "IsVisible"=>true));
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
        $this->m_sort_field = 'cqu_altura';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_altura", "Label"=>"Altura", "Type"=>"int", "IsForDB"=>true, "Order"=>104, "Presentation"=>"INT", "IsVisible"=>true));
    }
}

class col121 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Ingresado';
        $this->m_order = '121';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_ingreso_fecha';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_ingreso_fecha", "Label"=>"Ingresado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>121, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class col120 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Operador';
        $this->m_order = '120';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'use_code';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"use_code", "Label"=>"Operador", "Size"=>50, "IsForDB"=>true, "Order"=>120, "Presentation"=>"USER", "IsVisible"=>true));
    }
}

class col125 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Resultado';
        $this->m_order = '125';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_resultado';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_resultado", "Label"=>"Resultado", "Size"=>50, "IsForDB"=>true, "Order"=>125, "Presentation"=>"CALL_RESULTADO", "IsVisible"=>true));
    }
}

class col127 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Actitud';
        $this->m_order = '127';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_actitud';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_actitud", "Label"=>"Actitud", "Size"=>50, "IsForDB"=>true, "Order"=>127, "Presentation"=>"CALL_ACTITUD", "IsVisible"=>true));
    }
}

class col122 extends ccolumn
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Cursada';
        $this->m_order = '122';
        $this->m_isvisible = true;
        $this->m_align = 'left';
        $this->m_sort_field = 'cqu_egreso_fecha';
        $this->m_width = '';

        //Campos de la columna
         $this->m_fields[] = new CField(Array("Name"=>"cqu_egreso_fecha", "Label"=>"Cursada", "Type"=>"datetime", "IsForDB"=>true, "Order"=>122, "Presentation"=>"DATERANGE", "IsVisible"=>true));
    }
}

class ccal_queue_table extends ctable
{
    function __construct($parent)
    {
        parent::__construct($parent);
        $this->m_title = 'Contactos realizados'; //Titulo de la tabla
        $this->m_classname = 'ccal_queue'; //Clase contenedora de datos
        $this->m_total = false; //Incluir ultima fila de totales

        //Agrego las columnas a la tabla
        $this->m_cols[101] = new col101($this);
        $this->m_cols[102] = new col102($this);
        $this->m_cols[132] = new col132($this);
        $this->m_cols[134] = new col134($this);
        $this->m_cols[123] = new col123($this);
        $this->m_cols[105] = new col105($this);
        $this->m_cols[106] = new col106($this);
        $this->m_cols[116] = new col116($this);
        $this->m_cols[103] = new col103($this);
        $this->m_cols[104] = new col104($this);
        $this->m_cols[121] = new col121($this);
        $this->m_cols[120] = new col120($this);
        $this->m_cols[125] = new col125($this);
        $this->m_cols[127] = new col127($this);
        $this->m_cols[122] = new col122($this);
    }

}

$pg = new ccal_queue_sl();
$pg->CreatePage();

?>
