<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('rep5') ) {
class rep5 extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "rep5";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>50, "Type"=>"text", "Order"=>1));
        $this->m_fields['tpr_plazo'] = new CField(Array("Name"=>"tpr_plazo", "Size"=>50, "Type"=>"text", "Order"=>2));
        $this->m_fields['tmp_rechazados'] = new CField(Array("Name"=>"tmp_rechazados", "Size"=>50, "Type"=>"text", "Order"=>3));
        $this->m_fields['tmp_fecha'] = new CField(Array("Name"=>"tmp_fecha", "Type"=>"datetime", "Order"=>4));
        $this->m_fields['tmp_media'] = new CField(Array("Name"=>"tmp_media", "Size"=>50, "Type"=>"text", "Order"=>5));
        $this->m_fields['tmp_plazo'] = new CField(Array("Name"=>"tmp_plazo", "Size"=>50, "Type"=>"text", "Order"=>6));
        $this->m_fields['tmp_min'] = new CField(Array("Name"=>"tmp_min", "Size"=>50, "Type"=>"text", "Order"=>7));
        $this->m_fields['tmp_max'] = new CField(Array("Name"=>"tmp_max", "Size"=>50, "Type"=>"text", "Order"=>8));
        $this->m_fields['tmp_stddev'] = new CField(Array("Name"=>"tmp_stddev", "Size"=>50, "Type"=>"text", "Order"=>9));
        $this->m_fields['tmp_cant'] = new CField(Array("Name"=>"tmp_cant", "Size"=>50, "Type"=>"text", "Order"=>10));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM tic_avance ";
        $this->m_objfactory_sql = "select tpr_code,count(*) as cant from tic_avance where tic_estado_in='pendiente' and tpr_code like '%tpr_code%%' and tav_tstamp_in>'%tmp_fecha%' group by tpr_code order by tpr_code";
        $this->m_objfactory_suffix_sql = "order by tpr_code desc";
        $this->m_savedb_update_sql = "UPDATE tic_avance SET ";
        $this->m_savedb_insert_sql = "INSERT INTO tic_avance() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM tic_avance";
        $this->m_savedb_purge_sql = "DELETE FROM tic_avance";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_avance ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase rep5
}
?>
