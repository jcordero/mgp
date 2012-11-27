<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('ccal_llamados') ) {
class ccal_llamados extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ccal_llamados";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cll_codigo'] = new CField(Array("Name"=>"cll_codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['cqu_tel_fijo'] = new CField(Array("Name"=>"cqu_tel_fijo", "Size"=>30, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['cqu_tel_movil'] = new CField(Array("Name"=>"cqu_tel_movil", "Size"=>30, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['cll_fecha'] = new CField(Array("Name"=>"cll_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['cqu_nombre'] = new CField(Array("Name"=>"cqu_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>106));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT cll_codigo, cqu_tel_fijo, cqu_tel_movil, cll_fecha, use_code, cqu_nombre FROM cal_llamados  WHERE cll_codigo= :cll_codigo_key:";
        $this->m_objfactory_sql = "SELECT cll_codigo, cqu_tel_fijo, cqu_tel_movil, cll_fecha, use_code, cqu_nombre FROM cal_llamados";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE cal_llamados SET cll_codigo= :cll_codigo:, cqu_tel_fijo= :cqu_tel_fijo:, cqu_tel_movil= :cqu_tel_movil:, cll_fecha= :cll_fecha:, use_code= :use_code:, cqu_nombre= :cqu_nombre: WHERE cll_codigo=:cll_codigo_key:";
        $this->m_savedb_insert_sql = "INSERT INTO cal_llamados(cll_codigo, cqu_tel_fijo, cqu_tel_movil, cll_fecha, use_code, cqu_nombre) VALUES (:cll_codigo:, :cqu_tel_fijo:, :cqu_tel_movil:, :cll_fecha:, :use_code:, :cqu_nombre:)";
        $this->m_savedb_delete_sql = "DELETE FROM cal_llamados WHERE cll_codigo=:cll_codigo_key:";
        $this->m_savedb_purge_sql = "DELETE FROM cal_llamados";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM cal_llamados ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ccal_llamados
}
?>
