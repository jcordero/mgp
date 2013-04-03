<?php 
include_once "presentation/ktree.php";

class CDH_PRESTACIONTREE extends CDH_KTREE 
{
	public $m_sql_root; //retorna 2 campos (key, description) 
	public $m_sql_branch; //retorna 2 campos (key, description)  acepta parametro parent_key
	
	function __construct($parent) 
	{
		parent::__construct($parent);
		$this->m_ajax_call="PRESTACIONTREE";
		$this->m_helper_sql="SELECT tpr_detalle FROM tic_prestaciones WHERE tpr_code='<val>'";
		//$this->m_fill_root_sql = "SELECT tpr_detalle,tpr_code,tpr_tipo FROM tic_prestaciones WHERE tpr_estado='ACTIVO' and (tpr_padre='' OR tpr_padre is null) order by tpr_detalle";
		$this->m_fill_branch_sql = "SELECT tpr_code,tpr_detalle,tpr_tipo FROM tic_prestaciones WHERE tpr_estado='ACTIVO' and tpr_code like '<val>%' and length(tpr_code)=length('<val>')+2 order by tpr_detalle";
		
		//$this->m_get_tipo_sql="SELECT sin_tipo FROM sop_incidentes WHERE sin_codigo='<val>'";	
		
		$this->m_js_main_search="chg_prestacion";
		$this->m_js_helper_search="chg_prestacion_h";		
	}
		
	function getJsIncludes()
	{	
		$r[]= '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/prestaciontree.js"></script>';
		$r[]= parent::getJsIncludes();
		return $r;
	}
	
	
    function getDetails($prestacion)
    {
        global $primary_db;

        //Datos de la prestacion
        $sql = "SELECT tpr_tipo,tpr_ubicacion FROM tic_prestaciones WHERE tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  $row;
        }

        //Armo el Cuestionario
        $html = '<div id="sub_prestaciones_cuest" class="tabla">';
        $html.= '<div class="bloque">';
        $html.= '<div id="subtit_prestaciones_cuest" class="titulo"><div class="titulo_texto">Cuestionario</div></div>';
        $html.= '<table class="caja2">';
        $html.= '<thead>';
        $html.= '<tr><th>Pregunta</th><th>Opciones</th></tr>';
        $html.= '</thead>';
        $html.= '<tbody id="tbody_prestaciones_cuest">';

        $sql = "SELECT tpr_preg,tpr_tipo_preg,tpr_opciones FROM tic_prestaciones_cuest WHERE tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        $q = 1;
        while( $myrow=$primary_db->_fetch_row($re) )
        {
            $opciones = "";
            if($myrow['tpr_tipo_preg']=="TEXTO")
            {
                $opciones.= '<input type="text" id="cuest_'.$q.'" name="cuest_'.$q.'">';
            }

            if($myrow['tpr_tipo_preg']=="LISTA" || $myrow['tpr_tipo_preg']=="MULTIPLE")
            {
                $opciones.= '<select id="cuest_'.$q.'" name="cuest_'.$q.'">';
                $partes = explode(';',$myrow['tpr_opciones']);
                foreach($partes as $parte)
                {
                    $opciones.= '<option value="'.$parte.'">'.$parte;
                }
                $opciones.= '</select>';
            }

            $html.= '<tr><td>'.$myrow['tpr_preg'].'</td><td>'.$opciones.'</td></tr>';
            $q++;
        }
        $html.= '</tbody>';
        $html.= '</table></div>'; //Cierro bloque
        $html.= '</div>';//Seccion

        if($q>1)
        {
            $conjunto[] = $html;
        }

        return json_encode($conjunto);
    }

	function getRubroPrest($tpr_code)
    {
        global $primary_db;

        $sql = "SELECT r.tru_code,r.tru_detalle FROM tic_rubros r JOIN tic_prestaciones_rubros pr ON r.tru_code=pr.tru_code ";
        $sql.= "WHERE pr.tpr_code='$tpr_code' order by tru_detalle";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  $row;
        }
        return json_encode($conjunto);
    }
}
?>