<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_prestaciones') ) {
class class_tic_prestaciones extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_prestaciones";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tpr_tipo'] = new CField(Array("Name"=>"tpr_tipo", "Size"=>20, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tpr_detalle'] = new CField(Array("Name"=>"tpr_detalle", "Size"=>100, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tpr_estado'] = new CField(Array("Name"=>"tpr_estado", "Size"=>20, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tpr_tstamp'] = new CField(Array("Name"=>"tpr_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tpr_ubicacion'] = new CField(Array("Name"=>"tpr_ubicacion", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tpr_plazo'] = new CField(Array("Name"=>"tpr_plazo", "Size"=>20, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tpr_show'] = new CField(Array("Name"=>"tpr_show", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tpr_metadata'] = new CField(Array("Name"=>"tpr_metadata", "Size"=>3000, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tpr_keywords'] = new CField(Array("Name"=>"tpr_keywords", "Size"=>500, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tpr_admin'] = new CField(Array("Name"=>"tpr_admin", "Size"=>50, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tpr_al_inicio'] = new CField(Array("Name"=>"tpr_al_inicio", "Size"=>2000, "IsForDB"=>true, "Order"=>113));
        $this->m_fields['tpr_al_final'] = new CField(Array("Name"=>"tpr_al_final", "Size"=>2000, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['tpr_al_vencimiento'] = new CField(Array("Name"=>"tpr_al_vencimiento", "Size"=>2000, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['tor_code_inspeccion'] = new CField(Array("Name"=>"tor_code_inspeccion", "Type"=>"int", "IsForDB"=>true, "Order"=>116));
        $this->m_fields['tor_code_verificacion'] = new CField(Array("Name"=>"tor_code_verificacion", "Type"=>"int", "IsForDB"=>true, "Order"=>117));
        $this->m_fields['tpr_asociar_radio'] = new CField(Array("Name"=>"tpr_asociar_radio", "Type"=>"int", "IsForDB"=>true, "Order"=>118));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['class_tic_prestaciones_cuest']='class_tic_prestaciones_cuest';
        $this->m_childs['class_tic_prestaciones_cuest']=array();
        $this->m_childs_keys['class_tic_prestaciones_cuest']['tpr_code']='tpr_code';

        $this->m_childs_classname['class_tic_prestaciones_gis']='class_tic_prestaciones_gis';
        $this->m_childs['class_tic_prestaciones_gis']=array();
        $this->m_childs_keys['class_tic_prestaciones_gis']['tpr_code']='tpr_code';

        $this->m_childs_classname['class_tic_prestaciones_rubros']='class_tic_prestaciones_rubros';
        $this->m_childs['class_tic_prestaciones_rubros']=array();
        $this->m_childs_keys['class_tic_prestaciones_rubros']['tpr_code']='tpr_code';


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tpr_code, tpr_tipo, tpr_detalle, tpr_estado, tpr_tstamp, use_code, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio FROM tic_prestaciones  WHERE tpr_code= :tpr_code_key:";
        $this->m_objfactory_sql = "SELECT tpr_code, tpr_tipo, tpr_detalle, tpr_estado, tpr_tstamp, use_code, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio FROM tic_prestaciones";
        $this->m_objfactory_suffix_sql = "order by tpr_detalle";
        $this->m_savedb_update_sql = "UPDATE tic_prestaciones SET tpr_code= :tpr_code:, tpr_tipo= :tpr_tipo:, tpr_detalle= :tpr_detalle:, tpr_estado= :tpr_estado:, tpr_tstamp= :tpr_tstamp:, use_code= :use_code:, tpr_ubicacion= :tpr_ubicacion:, tpr_plazo= :tpr_plazo:, tpr_show= :tpr_show:, tpr_metadata= :tpr_metadata:, tpr_keywords= :tpr_keywords:, tpr_admin= :tpr_admin:, tpr_al_inicio= :tpr_al_inicio:, tpr_al_final= :tpr_al_final:, tpr_al_vencimiento= :tpr_al_vencimiento:, tor_code_inspeccion= :tor_code_inspeccion:, tor_code_verificacion= :tor_code_verificacion:, tpr_asociar_radio= :tpr_asociar_radio: WHERE tpr_code=:tpr_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_prestaciones(tpr_code, tpr_tipo, tpr_detalle, tpr_estado, tpr_tstamp, use_code, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio) VALUES (:tpr_code:, :tpr_tipo:, :tpr_detalle:, :tpr_estado:, :tpr_tstamp:, :use_code:, :tpr_ubicacion:, :tpr_plazo:, :tpr_show:, :tpr_metadata:, :tpr_keywords:, :tpr_admin:, :tpr_al_inicio:, :tpr_al_final:, :tpr_al_vencimiento:, :tor_code_inspeccion:, :tor_code_verificacion:, :tpr_asociar_radio:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_prestaciones WHERE tpr_code=:tpr_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_prestaciones";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_prestaciones ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_prestaciones
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_prestaciones_cuest') ) {
class class_tic_prestaciones_cuest extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_prestaciones_cuest";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tcu_code'] = new CField(Array("Name"=>"tcu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false, "Sequence"=>"tic_prestaciones_cuest"));
        $this->m_fields['tpr_orden'] = new CField(Array("Name"=>"tpr_orden", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tpr_preg'] = new CField(Array("Name"=>"tpr_preg", "Size"=>100, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tpr_tipo_preg'] = new CField(Array("Name"=>"tpr_tipo_preg", "Size"=>20, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tpr_opciones'] = new CField(Array("Name"=>"tpr_opciones", "Size"=>200, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tpr_miciudad'] = new CField(Array("Name"=>"tpr_miciudad", "Size"=>45, "IsForDB"=>true, "Order"=>107));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad FROM tic_prestaciones_cuest  WHERE tpr_code= :tpr_code_key: AND tcu_code= :tcu_code_key:";
        $this->m_objfactory_sql = "SELECT tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad FROM tic_prestaciones_cuest";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_prestaciones_cuest SET tpr_code= :tpr_code:, tcu_code= :tcu_code:, tpr_orden= :tpr_orden:, tpr_preg= :tpr_preg:, tpr_tipo_preg= :tpr_tipo_preg:, tpr_opciones= :tpr_opciones:, tpr_miciudad= :tpr_miciudad: WHERE tpr_code=:tpr_code_key: AND tcu_code=:tcu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_prestaciones_cuest(tpr_code, tcu_code, tpr_orden, tpr_preg, tpr_tipo_preg, tpr_opciones, tpr_miciudad) VALUES (:tpr_code:, :tcu_code:, :tpr_orden:, :tpr_preg:, :tpr_tipo_preg:, :tpr_opciones:, :tpr_miciudad:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_prestaciones_cuest WHERE tpr_code=:tpr_code_key: AND tcu_code=:tcu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_prestaciones_cuest WHERE tpr_code=:tpr_code_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_prestaciones_cuest ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_prestaciones_cuest
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_prestaciones_gis') ) {
class class_tic_prestaciones_gis extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_prestaciones_gis";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tpg_code'] = new CField(Array("Name"=>"tpg_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false, "Sequence"=>"tic_prestaciones_gis"));
        $this->m_fields['tpg_gis_valor'] = new CField(Array("Name"=>"tpg_gis_valor", "Size"=>100, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tpg_gis_campo'] = new CField(Array("Name"=>"tpg_gis_campo", "Size"=>100, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tpg_usa_gis'] = new CField(Array("Name"=>"tpg_usa_gis", "Size"=>5, "IsForDB"=>true, "Order"=>105, "IsNullable"=>false));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tpg_tstamp'] = new CField(Array("Name"=>"tpg_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tto_figura'] = new CField(Array("Name"=>"tto_figura", "Size"=>50, "IsForDB"=>true, "Order"=>109));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tpr_code, tpg_code, tpg_gis_valor, tpg_gis_campo, tpg_usa_gis, tor_code, tpg_tstamp, use_code, tto_figura FROM tic_prestaciones_gis  WHERE tpr_code= :tpr_code_key: AND tpg_code= :tpg_code_key:";
        $this->m_objfactory_sql = "SELECT tpr_code, tpg_code, tpg_gis_valor, tpg_gis_campo, tpg_usa_gis, tor_code, tpg_tstamp, use_code, tto_figura FROM tic_prestaciones_gis";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_prestaciones_gis SET tpr_code= :tpr_code:, tpg_code= :tpg_code:, tpg_gis_valor= :tpg_gis_valor:, tpg_gis_campo= :tpg_gis_campo:, tpg_usa_gis= :tpg_usa_gis:, tor_code= :tor_code:, tpg_tstamp= :tpg_tstamp:, use_code= :use_code:, tto_figura= :tto_figura: WHERE tpr_code=:tpr_code_key: AND tpg_code=:tpg_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_prestaciones_gis(tpr_code, tpg_code, tpg_gis_valor, tpg_gis_campo, tpg_usa_gis, tor_code, tpg_tstamp, use_code, tto_figura) VALUES (:tpr_code:, :tpg_code:, :tpg_gis_valor:, :tpg_gis_campo:, :tpg_usa_gis:, :tor_code:, :tpg_tstamp:, :use_code:, :tto_figura:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_prestaciones_gis WHERE tpr_code=:tpr_code_key: AND tpg_code=:tpg_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_prestaciones_gis WHERE tpr_code=:tpr_code_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_prestaciones_gis ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_prestaciones_gis
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_prestaciones_rubros') ) {
class class_tic_prestaciones_rubros extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_prestaciones_rubros";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tpr_prioridad'] = new CField(Array("Name"=>"tpr_prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tto_figura'] = new CField(Array("Name"=>"tto_figura", "Size"=>50, "IsForDB"=>true, "Order"=>105));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tpr_code, tru_code, tpr_prioridad, tor_code, tto_figura FROM tic_prestaciones_rubros  WHERE tpr_code= :tpr_code_key: AND tru_code= :tru_code_key:";
        $this->m_objfactory_sql = "SELECT tpr_code, tru_code, tpr_prioridad, tor_code, tto_figura FROM tic_prestaciones_rubros";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_prestaciones_rubros SET tpr_code= :tpr_code:, tru_code= :tru_code:, tpr_prioridad= :tpr_prioridad:, tor_code= :tor_code:, tto_figura= :tto_figura: WHERE tpr_code=:tpr_code_key: AND tru_code=:tru_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_prestaciones_rubros(tpr_code, tru_code, tpr_prioridad, tor_code, tto_figura) VALUES (:tpr_code:, :tru_code:, :tpr_prioridad:, :tor_code:, :tto_figura:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_prestaciones_rubros WHERE tpr_code=:tpr_code_key: AND tru_code=:tru_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_prestaciones_rubros WHERE tpr_code=:tpr_code_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_prestaciones_rubros ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_prestaciones_rubros
}
?>
