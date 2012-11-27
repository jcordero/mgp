<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('ccal_to_do_small') ) {
class ccal_to_do_small extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ccal_to_do_small";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cto_codigo'] = new CField(Array("Name"=>"cto_codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['cqu_codigo'] = new CField(Array("Name"=>"cqu_codigo", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['cto_estado'] = new CField(Array("Name"=>"cto_estado", "Size"=>50, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['cto_ingreso_fecha'] = new CField(Array("Name"=>"cto_ingreso_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['cto_salida_fecha'] = new CField(Array("Name"=>"cto_salida_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['cto_descripcion'] = new CField(Array("Name"=>"cto_descripcion", "Size"=>3000, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['cto_nota'] = new CField(Array("Name"=>"cto_nota", "Size"=>3000, "IsForDB"=>true, "Order"=>108));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT cto_codigo, cqu_codigo, cto_estado, use_code, cto_ingreso_fecha, cto_salida_fecha, cto_descripcion, cto_nota FROM cal_to_do  WHERE cto_codigo= :cto_codigo_key:";
        $this->m_objfactory_sql = "SELECT cto_codigo, cqu_codigo, cto_estado, use_code, cto_ingreso_fecha, cto_salida_fecha, cto_descripcion, cto_nota FROM cal_to_do";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE cal_to_do SET cto_codigo= :cto_codigo:, cqu_codigo= :cqu_codigo:, cto_estado= :cto_estado:, use_code= :use_code:, cto_ingreso_fecha= :cto_ingreso_fecha:, cto_salida_fecha= :cto_salida_fecha:, cto_descripcion= :cto_descripcion:, cto_nota= :cto_nota: WHERE cto_codigo=:cto_codigo_key:";
        $this->m_savedb_insert_sql = "INSERT INTO cal_to_do(cto_codigo, cqu_codigo, cto_estado, use_code, cto_ingreso_fecha, cto_salida_fecha, cto_descripcion, cto_nota) VALUES (:cto_codigo:, :cqu_codigo:, :cto_estado:, :use_code:, :cto_ingreso_fecha:, :cto_salida_fecha:, :cto_descripcion:, :cto_nota:)";
        $this->m_savedb_delete_sql = "DELETE FROM cal_to_do WHERE cto_codigo=:cto_codigo_key:";
        $this->m_savedb_purge_sql = "DELETE FROM cal_to_do";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM cal_to_do ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ccal_to_do_small
}
?>
