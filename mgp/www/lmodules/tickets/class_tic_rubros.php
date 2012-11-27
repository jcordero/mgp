<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_rubros') ) {
class class_tic_rubros extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_rubros";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tru_detalle'] = new CField(Array("Name"=>"tru_detalle", "Size"=>100, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tru_estado'] = new CField(Array("Name"=>"tru_estado", "Size"=>20, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tru_tstamp'] = new CField(Array("Name"=>"tru_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>105));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tru_code, tru_detalle, tru_estado, tru_tstamp, use_code FROM tic_rubros  WHERE tru_code= :tru_code_key:";
        $this->m_objfactory_sql = "SELECT tru_code, tru_detalle, tru_estado, tru_tstamp, use_code FROM tic_rubros";
        $this->m_objfactory_suffix_sql = "order by tru_detalle";
        $this->m_savedb_update_sql = "UPDATE tic_rubros SET tru_code= :tru_code:, tru_detalle= :tru_detalle:, tru_estado= :tru_estado:, tru_tstamp= :tru_tstamp:, use_code= :use_code: WHERE tru_code=:tru_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_rubros(tru_code, tru_detalle, tru_estado, tru_tstamp, use_code) VALUES (:tru_code:, :tru_detalle:, :tru_estado:, :tru_tstamp:, :use_code:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_rubros WHERE tru_code=:tru_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_rubros";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_rubros ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_rubros
}
?>
