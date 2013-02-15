<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('creclamos_small') ) {
class creclamos_small extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "creclamos_small";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "reclamos_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tran_id'] = new CField(Array("Name"=>"tran_id", "Size"=>50, "Order"=>1));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM reclamos ";
        $this->m_objfactory_sql = "SELECT  FROM reclamos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclamos SET ";
        $this->m_savedb_insert_sql = "INSERT INTO reclamos() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM reclamos";
        $this->m_savedb_purge_sql = "DELETE FROM reclamos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM reclamos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclamos_small
}
?>
