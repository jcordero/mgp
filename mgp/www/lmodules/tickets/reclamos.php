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

        $this->m_search_fields = array();

        $this->addAction(1,"reclamos_maint.php?OP=V",array(),"","ver","V","","");
        $this->addAction(1,"reclamos_reit.php?OP=M",array(),"","reiterar","M","","");
        $this->addAction(1,"reclamos_maint.php?OP=P",array(),"","imprimir","P","","");
    }

    //Inicializo la parte de busqueda
    public function InitializeSearch($cn) {
        //SetDisplayValues($attributes) 

    /* Campos de busqueda */
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

}

$pg = new creclamos_small_sl();
$pg->CreatePage();

?>
