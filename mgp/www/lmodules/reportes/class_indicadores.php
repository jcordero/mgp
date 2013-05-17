<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('indicadores') ) {
class indicadores extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "indicadores";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tin_code'] = new CField(Array("Name"=>"tin_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tin_nombre'] = new CField(Array("Name"=>"tin_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tin_tstamp'] = new CField(Array("Name"=>"tin_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tin_estado'] = new CField(Array("Name"=>"tin_estado", "Size"=>45, "IsForDB"=>true, "Order"=>105));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tin_code, tin_nombre, use_code, tin_tstamp, tin_estado FROM tic_indicadores  WHERE tin_code= :tin_code_key:";
        $this->m_objfactory_sql = "SELECT tin_code, tin_nombre, use_code, tin_tstamp, tin_estado FROM tic_indicadores";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_indicadores SET tin_code= :tin_code:, tin_nombre= :tin_nombre:, use_code= :use_code:, tin_tstamp= :tin_tstamp:, tin_estado= :tin_estado: WHERE tin_code=:tin_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_indicadores(tin_code, tin_nombre, use_code, tin_tstamp, tin_estado) VALUES (:tin_code:, :tin_nombre:, :use_code:, :tin_tstamp:, :tin_estado:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_indicadores WHERE tin_code=:tin_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_indicadores";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_indicadores ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase indicadores
}
?>
