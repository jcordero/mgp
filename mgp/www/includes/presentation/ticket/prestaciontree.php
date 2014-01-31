<?php 
include_once 'presentation/ktree.php';
include_once 'presentation/ticket/cuestionario.php';

class CDH_PRESTACIONTREE extends CDH_KTREE 
{
    public $m_sql_root; //retorna 2 campos (key, description) 
    public $m_sql_branch; //retorna 2 campos (key, description)  acepta parametro parent_key

    function __construct($parent) 
    {
        parent::__construct($parent);
        $this->m_ajax_call="TICKET::PRESTACIONTREE";
        $this->m_helper_sql="SELECT tpr_detalle FROM tic_prestaciones WHERE tpr_code='<val>'";
        $this->m_fill_branch_sql = "SELECT tpr_code,tpr_detalle,tpr_tipo FROM tic_prestaciones WHERE tpr_estado='ACTIVO' and tpr_code like '<val>%' and length(tpr_code)=length('<val>')+2 order by tpr_detalle";
        $this->m_js_main_search="chg_prestacion";
        $this->m_js_helper_search="chg_prestacion_h";	
        $this->m_fill_sql = "SELECT tpr_code,tpr_detalle,tpr_tipo FROM tic_prestaciones WHERE tpr_estado='ACTIVO' order by cast(tpr_code as UNSIGNED INTEGER)";
        $this->m_show_key = true;
    }

    /**
     * Archivos de javascript necesarios
     * @return type
     */
    function getJsIncludes()
    {	
        $r[]= '<script type="text/javascript" src="'.WEB_PATH.'/includes/presentation/ticket/prestaciontree.js"></script>';
        $r[]= parent::getJsIncludes();
        return $r;
    }
	
    /**
     * Obtener detalles de una prestación y su cuestionario
     * @global type $primary_db
     * @param type $prestacion
     * @return type
     */    
    function getDetails($prestacion)
    {
        global $primary_db;

        //Datos de la prestacion
        $sql = "SELECT tpr_tipo,tpr_ubicacion FROM tic_prestaciones WHERE tpr_code='$prestacion'";
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] =  array('tpr_tipo'=>$row['tpr_tipo'], 'tpr_ubicacion'=>$row['tpr_ubicacion']);
        }

        //Armo el Cuestionario        
        $conjunto[] = CDH_CUESTIONARIO::crearCuestionario($prestacion);
        
        return json_encode($conjunto,JSON_UNESCAPED_UNICODE);
    }

    /**
     * Averiguar que rubros tiene asociados una prestacion
     * @global type $primary_db
     * @param type $tpr_code
     * @return type
     */
    function getRubroPrest($tpr_code)
    {
        global $primary_db;

        $sql = "SELECT r.tru_code,r.tru_detalle 
                    FROM tic_rubros r 
                    JOIN tic_prestaciones_rubros pr ON r.tru_code=pr.tru_code 
                    WHERE pr.tpr_code='{$tpr_code}' order by tru_detalle";
                    
        $re = $primary_db->do_execute($sql);
        $conjunto = array();
        while( $row=$primary_db->_fetch_row($re) )
        {
            $conjunto[] = array('tru_code' => $row['tru_code'],'tru_detalle' => $row['tru_detallle']) ;
        }
        return json_encode($conjunto,JSON_UNESCAPED_UNICODE);
    }
}
?>