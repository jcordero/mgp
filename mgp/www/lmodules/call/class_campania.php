<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_campania') ) {
class class_campania extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_campania";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tmp_cgpc'] = new CField(Array("Name"=>"tmp_cgpc", "Size"=>50, "Order"=>1));
        $this->m_fields['tmp_barrio'] = new CField(Array("Name"=>"tmp_barrio", "Size"=>50, "Order"=>2));
        $this->m_fields['tmp_tipo'] = new CField(Array("Name"=>"tmp_tipo", "Size"=>50, "Order"=>3));
        $this->m_fields['tmp_estado'] = new CField(Array("Name"=>"tmp_estado", "Size"=>50, "Order"=>4));
        $this->m_fields['tmp_fecha'] = new CField(Array("Name"=>"tmp_fecha", "Type"=>"datetime", "Order"=>5, "Presentation"=>"DATERANGE"));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = " ";
        $this->m_objfactory_sql = "SELECT  FROM sec_parameters";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE sec_parameters SET ";
        $this->m_savedb_insert_sql = "INSERT INTO sec_parameters() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM sec_parameters";
        $this->m_savedb_purge_sql = "DELETE FROM sec_parameters";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM sec_parameters ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_campania
}
?>
