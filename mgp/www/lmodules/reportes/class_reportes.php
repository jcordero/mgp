<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('reportes') ) {
class reportes extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "reportes";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tmp_prestacion'] = new CField(Array("Name"=>"tmp_prestacion", "Size"=>50, "Order"=>1));
        $this->m_fields['tmp_estado_ticket'] = new CField(Array("Name"=>"tmp_estado_ticket", "Size"=>50, "Order"=>2));
        $this->m_fields['tmp_estado_prestacion'] = new CField(Array("Name"=>"tmp_estado_prestacion", "Size"=>50, "Order"=>3));
        $this->m_fields['tmp_barrio'] = new CField(Array("Name"=>"tmp_barrio", "Size"=>50, "Order"=>4));
        $this->m_fields['tmp_fecha'] = new CField(Array("Name"=>"tmp_fecha", "Size"=>50, "Order"=>5));
        $this->m_fields['tmp_canal'] = new CField(Array("Name"=>"tmp_canal", "Size"=>50, "Order"=>6));
        $this->m_fields['tmp_organismo'] = new CField(Array("Name"=>"tmp_organismo", "Size"=>50, "Order"=>7));
        $this->m_fields['tmp_vencido'] = new CField(Array("Name"=>"tmp_vencido", "Size"=>50, "Order"=>8));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM reportes ";
        $this->m_objfactory_sql = "SELECT  FROM reportes";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reportes SET ";
        $this->m_savedb_insert_sql = "INSERT INTO reportes() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM reportes";
        $this->m_savedb_purge_sql = "DELETE FROM reportes";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM reportes ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase reportes
}
?>
