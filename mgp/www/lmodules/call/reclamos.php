<?php
/* Pagina de listado generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:19:13
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
		$this->m_template_html = 'call.htm';
		$this->m_template_pdml = 'default.pdml';
		$this->m_render_html = 'BLOCK';
		$this->m_render_pdml = 'BLOCK';

        $this->m_search_fields = array();

        $this->addAction(1,"reclamos_maint.php?OP=V",array(),"bt_ver.gif","ver","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
    }

    /* Campos de resultado */
    public function InitializeResult($cn) {
        //SetDisplayValues($attributes) 

    }

    function RenderJSIncludes() {
        $html = '';
        /* Para ubicar el origen de los reclamos... */
        $html.= "<script language='JavaScript'>var sess_page='".str_replace("\\","/",__FILE__)."';var build_number=0;</script>";
        return $html;
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
    }

    //Inicializo funcion para formatear cada fila de resultado
    public function InitializeRow($row)
    {
        //SetDisplayValues($attributes) 
    }
}

$pg = new creclamos_small_sl();
$pg->CreatePage();

?>
