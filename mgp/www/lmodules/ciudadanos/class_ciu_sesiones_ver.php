<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_ciu_sesiones_ver') ) {
class class_ciu_sesiones_ver extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_ciu_sesiones_ver";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cse_code'] = new CField(Array("Name"=>"cse_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['cse_ani'] = new CField(Array("Name"=>"cse_ani", "Size"=>15, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['cse_tstamp'] = new CField(Array("Name"=>"cse_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['cse_duracion'] = new CField(Array("Name"=>"cse_duracion", "Type"=>"int", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['cse_nota'] = new CField(Array("Name"=>"cse_nota", "Size"=>500, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['cse_derivado'] = new CField(Array("Name"=>"cse_derivado", "Size"=>20, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['cse_call_id'] = new CField(Array("Name"=>"cse_call_id", "Size"=>20, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['cse_skill'] = new CField(Array("Name"=>"cse_skill", "Size"=>50, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['cse_estado'] = new CField(Array("Name"=>"cse_estado", "Size"=>20, "IsForDB"=>true, "Order"=>111));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['class_ciu_historial_contactos']='class_ciu_historial_contactos';
        $this->m_childs['class_ciu_historial_contactos']=array();
        $this->m_childs_keys['class_ciu_historial_contactos']['cse_code']='cse_code';


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT cse_code, ciu_code, cse_ani, cse_tstamp, cse_duracion, use_code, cse_nota, cse_derivado, cse_call_id, cse_skill, cse_estado FROM ciu_sesiones  WHERE cse_code= :cse_code_key: AND ciu_code= :ciu_code_key:";
        $this->m_objfactory_sql = "SELECT cse_code, ciu_code, cse_ani, cse_tstamp, cse_duracion, use_code, cse_nota, cse_derivado, cse_call_id, cse_skill, cse_estado FROM ciu_sesiones";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE ciu_sesiones SET cse_code= :cse_code:, ciu_code= :ciu_code:, cse_ani= :cse_ani:, cse_tstamp= :cse_tstamp:, cse_duracion= :cse_duracion:, use_code= :use_code:, cse_nota= :cse_nota:, cse_derivado= :cse_derivado:, cse_call_id= :cse_call_id:, cse_skill= :cse_skill:, cse_estado= :cse_estado: WHERE cse_code=:cse_code_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO ciu_sesiones(cse_code, ciu_code, cse_ani, cse_tstamp, cse_duracion, use_code, cse_nota, cse_derivado, cse_call_id, cse_skill, cse_estado) VALUES (:cse_code:, :ciu_code:, :cse_ani:, :cse_tstamp:, :cse_duracion:, :use_code:, :cse_nota:, :cse_derivado:, :cse_call_id:, :cse_skill:, :cse_estado:)";
        $this->m_savedb_delete_sql = "DELETE FROM ciu_sesiones WHERE cse_code=:cse_code_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM ciu_sesiones";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM ciu_sesiones ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_ciu_sesiones_ver
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_ciu_historial_contactos') ) {
class class_ciu_historial_contactos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_ciu_historial_contactos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['chi_code'] = new CField(Array("Name"=>"chi_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['cse_code'] = new CField(Array("Name"=>"cse_code", "Type"=>"int", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['chi_fecha'] = new CField(Array("Name"=>"chi_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['chi_motivo'] = new CField(Array("Name"=>"chi_motivo", "Size"=>100, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['chi_canal'] = new CField(Array("Name"=>"chi_canal", "Size"=>50, "IsForDB"=>true, "Order"=>107));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal FROM ciu_historial_contactos  WHERE chi_code= :chi_code_key: AND ciu_code= :ciu_code_key:";
        $this->m_objfactory_sql = "SELECT chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal FROM ciu_historial_contactos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE ciu_historial_contactos SET chi_code= :chi_code:, ciu_code= :ciu_code:, cse_code= :cse_code:, chi_fecha= :chi_fecha:, chi_motivo= :chi_motivo:, use_code= :use_code:, chi_canal= :chi_canal: WHERE chi_code=:chi_code_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO ciu_historial_contactos(chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal) VALUES (:chi_code:, :ciu_code:, :cse_code:, :chi_fecha:, :chi_motivo:, :use_code:, :chi_canal:)";
        $this->m_savedb_delete_sql = "DELETE FROM ciu_historial_contactos WHERE chi_code=:chi_code_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM ciu_historial_contactos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM ciu_historial_contactos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_ciu_historial_contactos
}
?>
