<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_sho_ingresos') ) {
class class_sho_ingresos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_sho_ingresos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['sin_code'] = new CField(Array("Name"=>"sin_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['sin_descripcion'] = new CField(Array("Name"=>"sin_descripcion", "Size"=>50, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['sin_estado'] = new CField(Array("Name"=>"sin_estado", "Size"=>50, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['sin_tstamp'] = new CField(Array("Name"=>"sin_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['class_sho_atajos']='class_sho_atajos';
        $this->m_childs['class_sho_atajos']=array();
        $this->m_childs_keys['class_sho_atajos']['sin_code']='sin_code';


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT sin_code, sin_descripcion, sin_estado, use_code, sin_tstamp FROM sho_ingresos  WHERE sin_code= :sin_code_key:";
        $this->m_objfactory_sql = "SELECT sin_code, sin_descripcion, sin_estado, use_code, sin_tstamp FROM sho_ingresos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE sho_ingresos SET sin_code= :sin_code:, sin_descripcion= :sin_descripcion:, sin_estado= :sin_estado:, use_code= :use_code:, sin_tstamp= :sin_tstamp: WHERE sin_code=:sin_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO sho_ingresos(sin_code, sin_descripcion, sin_estado, use_code, sin_tstamp) VALUES (:sin_code:, :sin_descripcion:, :sin_estado:, :use_code:, :sin_tstamp:)";
        $this->m_savedb_delete_sql = "DELETE FROM sho_ingresos WHERE sin_code=:sin_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM sho_ingresos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM sho_ingresos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_sho_ingresos
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_sho_atajos') ) {
class class_sho_atajos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_sho_atajos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['sat_code'] = new CField(Array("Name"=>"sat_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false, "Sequence"=>"sho_atajos"));
        $this->m_fields['sin_code'] = new CField(Array("Name"=>"sin_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['sat_descripcion'] = new CField(Array("Name"=>"sat_descripcion", "Size"=>50, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['sat_url'] = new CField(Array("Name"=>"sat_url", "Size"=>150, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['sat_nota'] = new CField(Array("Name"=>"sat_nota", "Size"=>500, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['sat_tstamp'] = new CField(Array("Name"=>"sat_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT sat_code, sin_code, sat_descripcion, sat_url, sat_nota, use_code, sat_tstamp FROM sho_atajos  WHERE sat_code= :sat_code_key: AND sin_code= :sin_code_key:";
        $this->m_objfactory_sql = "SELECT sat_code, sin_code, sat_descripcion, sat_url, sat_nota, use_code, sat_tstamp FROM sho_atajos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE sho_atajos SET sat_code= :sat_code:, sin_code= :sin_code:, sat_descripcion= :sat_descripcion:, sat_url= :sat_url:, sat_nota= :sat_nota:, use_code= :use_code:, sat_tstamp= :sat_tstamp: WHERE sat_code=:sat_code_key: AND sin_code=:sin_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO sho_atajos(sat_code, sin_code, sat_descripcion, sat_url, sat_nota, use_code, sat_tstamp) VALUES (:sat_code:, :sin_code:, :sat_descripcion:, :sat_url:, :sat_nota:, :use_code:, :sat_tstamp:)";
        $this->m_savedb_delete_sql = "DELETE FROM sho_atajos WHERE sat_code=:sat_code_key: AND sin_code=:sin_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM sho_atajos WHERE sin_code=:sin_code_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM sho_atajos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_sho_atajos
}
?>
