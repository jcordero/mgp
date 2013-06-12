<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_feriados') ) {
class class_tic_feriados extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_feriados";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tfe_tstamp_in'] = new CField(Array("Name"=>"tfe_tstamp_in", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tfe_desc'] = new CField(Array("Name"=>"tfe_desc", "Size"=>100, "IsForDB"=>true, "Order"=>102));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tfe_tstamp_in, tfe_desc FROM tic_feriados  WHERE tfe_tstamp_in= :tfe_tstamp_in_key:";
        $this->m_objfactory_sql = "SELECT tfe_tstamp_in, tfe_desc FROM tic_feriados";
        $this->m_objfactory_suffix_sql = "order by tfe_tstamp_in";
        $this->m_savedb_update_sql = "UPDATE tic_feriados SET tfe_tstamp_in= :tfe_tstamp_in:, tfe_desc= :tfe_desc: WHERE tfe_tstamp_in=:tfe_tstamp_in_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_feriados(tfe_tstamp_in, tfe_desc) VALUES (:tfe_tstamp_in:, :tfe_desc:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_feriados WHERE tfe_tstamp_in=:tfe_tstamp_in_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_feriados";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_feriados ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_feriados
}
?>
