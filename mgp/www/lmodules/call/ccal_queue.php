<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('ccal_queue') ) {
class ccal_queue extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ccal_queue";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cqu_codigo'] = new CField(Array("Name"=>"cqu_codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['cqu_contacto'] = new CField(Array("Name"=>"cqu_contacto", "Size"=>50, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['cqu_calle'] = new CField(Array("Name"=>"cqu_calle", "Size"=>100, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['cqu_altura'] = new CField(Array("Name"=>"cqu_altura", "Type"=>"int", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['cqu_prestacion'] = new CField(Array("Name"=>"cqu_prestacion", "Size"=>200, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['cqu_rubro'] = new CField(Array("Name"=>"cqu_rubro", "Size"=>200, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['cqu_responsable'] = new CField(Array("Name"=>"cqu_responsable", "Size"=>200, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['cqu_x'] = new CField(Array("Name"=>"cqu_x", "Type"=>"float", "IsForDB"=>true, "Order"=>108));
        $this->m_fields['cqu_y'] = new CField(Array("Name"=>"cqu_y", "Type"=>"float", "IsForDB"=>true, "Order"=>109));
        $this->m_fields['cqu_con_ingreso_fecha'] = new CField(Array("Name"=>"cqu_con_ingreso_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['cqu_con_cumplido_fecha'] = new CField(Array("Name"=>"cqu_con_cumplido_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>111));
        $this->m_fields['cqu_con_cumplido_nota'] = new CField(Array("Name"=>"cqu_con_cumplido_nota", "Size"=>2000, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['cqu_barrio'] = new CField(Array("Name"=>"cqu_barrio", "Size"=>100, "IsForDB"=>true, "Order"=>113));
        $this->m_fields['cqu_cgpc'] = new CField(Array("Name"=>"cqu_cgpc", "Size"=>50, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['cqu_historia'] = new CField(Array("Name"=>"cqu_historia", "Size"=>4000, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['cqu_nombre'] = new CField(Array("Name"=>"cqu_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>116));
        $this->m_fields['cqu_tel_fijo'] = new CField(Array("Name"=>"cqu_tel_fijo", "Size"=>30, "IsForDB"=>true, "Order"=>117));
        $this->m_fields['cqu_tel_movil'] = new CField(Array("Name"=>"cqu_tel_movil", "Size"=>30, "IsForDB"=>true, "Order"=>118));
        $this->m_fields['cqu_email'] = new CField(Array("Name"=>"cqu_email", "Size"=>100, "IsForDB"=>true, "Order"=>119));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>120));
        $this->m_fields['cqu_ingreso_fecha'] = new CField(Array("Name"=>"cqu_ingreso_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>121));
        $this->m_fields['cqu_egreso_fecha'] = new CField(Array("Name"=>"cqu_egreso_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>122));
        $this->m_fields['cqu_estado'] = new CField(Array("Name"=>"cqu_estado", "Size"=>50, "IsForDB"=>true, "Order"=>123));
        $this->m_fields['cqu_resuelto'] = new CField(Array("Name"=>"cqu_resuelto", "Size"=>50, "IsForDB"=>true, "Order"=>124));
        $this->m_fields['cqu_resultado'] = new CField(Array("Name"=>"cqu_resultado", "Size"=>50, "IsForDB"=>true, "Order"=>125));
        $this->m_fields['cqu_nota'] = new CField(Array("Name"=>"cqu_nota", "Size"=>2000, "IsForDB"=>true, "Order"=>126));
        $this->m_fields['cqu_actitud'] = new CField(Array("Name"=>"cqu_actitud", "Size"=>50, "IsForDB"=>true, "Order"=>127));
        $this->m_fields['cqu_conforme'] = new CField(Array("Name"=>"cqu_conforme", "Size"=>50, "IsForDB"=>true, "Order"=>128));
        $this->m_fields['cqu_motivo_no_conforme'] = new CField(Array("Name"=>"cqu_motivo_no_conforme", "Size"=>100, "IsForDB"=>true, "Order"=>129));
        $this->m_fields['cqu_reabrir_contacto'] = new CField(Array("Name"=>"cqu_reabrir_contacto", "Size"=>5, "IsForDB"=>true, "Order"=>130));
        $this->m_fields['cqu_seguir'] = new CField(Array("Name"=>"cqu_seguir", "Size"=>5, "IsForDB"=>true, "Order"=>131));
        $this->m_fields['cqu_tipo'] = new CField(Array("Name"=>"cqu_tipo", "Size"=>50, "IsForDB"=>true, "Order"=>132));
        $this->m_fields['cqu_bloqueado'] = new CField(Array("Name"=>"cqu_bloqueado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>133));
        $this->m_fields['cqu_estado_contacto'] = new CField(Array("Name"=>"cqu_estado_contacto", "Size"=>50, "IsForDB"=>true, "Order"=>134));
        $this->m_fields['tmp_mapa'] = new CField(Array("Name"=>"tmp_mapa", "Type"=>"int", "Order"=>35));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['ccal_to_do']='ccal_to_do';
        $this->m_childs['ccal_to_do']=array();
        $this->m_childs_keys['ccal_to_do']['cqu_codigo']='cqu_codigo';

        $this->m_childs_classname['cfile']='cfile';
        $this->m_childs['cfile']=array();


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT cqu_codigo, cqu_contacto, cqu_calle, cqu_altura, cqu_prestacion, cqu_rubro, cqu_responsable, cqu_x, cqu_y, cqu_con_ingreso_fecha, cqu_con_cumplido_fecha, cqu_con_cumplido_nota, cqu_barrio, cqu_cgpc, cqu_historia, cqu_nombre, cqu_tel_fijo, cqu_tel_movil, cqu_email, use_code, cqu_ingreso_fecha, cqu_egreso_fecha, cqu_estado, cqu_resuelto, cqu_resultado, cqu_nota, cqu_actitud, cqu_conforme, cqu_motivo_no_conforme, cqu_reabrir_contacto, cqu_seguir, cqu_tipo, cqu_bloqueado, cqu_estado_contacto FROM cal_queue  WHERE cqu_codigo= :cqu_codigo_key:";
        $this->m_objfactory_sql = "SELECT cqu_codigo, cqu_contacto, cqu_calle, cqu_altura, cqu_prestacion, cqu_rubro, cqu_responsable, cqu_x, cqu_y, cqu_con_ingreso_fecha, cqu_con_cumplido_fecha, cqu_con_cumplido_nota, cqu_barrio, cqu_cgpc, cqu_historia, cqu_nombre, cqu_tel_fijo, cqu_tel_movil, cqu_email, use_code, cqu_ingreso_fecha, cqu_egreso_fecha, cqu_estado, cqu_resuelto, cqu_resultado, cqu_nota, cqu_actitud, cqu_conforme, cqu_motivo_no_conforme, cqu_reabrir_contacto, cqu_seguir, cqu_tipo, cqu_bloqueado, cqu_estado_contacto FROM cal_queue";
        $this->m_objfactory_suffix_sql = "order by cqu_tel_movil,cqu_tel_fijo";
        $this->m_savedb_update_sql = "UPDATE cal_queue SET cqu_codigo= :cqu_codigo:, cqu_contacto= :cqu_contacto:, cqu_calle= :cqu_calle:, cqu_altura= :cqu_altura:, cqu_prestacion= :cqu_prestacion:, cqu_rubro= :cqu_rubro:, cqu_responsable= :cqu_responsable:, cqu_x= :cqu_x:, cqu_y= :cqu_y:, cqu_con_ingreso_fecha= :cqu_con_ingreso_fecha:, cqu_con_cumplido_fecha= :cqu_con_cumplido_fecha:, cqu_con_cumplido_nota= :cqu_con_cumplido_nota:, cqu_barrio= :cqu_barrio:, cqu_cgpc= :cqu_cgpc:, cqu_historia= :cqu_historia:, cqu_nombre= :cqu_nombre:, cqu_tel_fijo= :cqu_tel_fijo:, cqu_tel_movil= :cqu_tel_movil:, cqu_email= :cqu_email:, use_code= :use_code:, cqu_ingreso_fecha= :cqu_ingreso_fecha:, cqu_egreso_fecha= :cqu_egreso_fecha:, cqu_estado= :cqu_estado:, cqu_resuelto= :cqu_resuelto:, cqu_resultado= :cqu_resultado:, cqu_nota= :cqu_nota:, cqu_actitud= :cqu_actitud:, cqu_conforme= :cqu_conforme:, cqu_motivo_no_conforme= :cqu_motivo_no_conforme:, cqu_reabrir_contacto= :cqu_reabrir_contacto:, cqu_seguir= :cqu_seguir:, cqu_tipo= :cqu_tipo:, cqu_bloqueado= :cqu_bloqueado:, cqu_estado_contacto= :cqu_estado_contacto: WHERE cqu_codigo=:cqu_codigo_key:";
        $this->m_savedb_insert_sql = "INSERT INTO cal_queue(cqu_codigo, cqu_contacto, cqu_calle, cqu_altura, cqu_prestacion, cqu_rubro, cqu_responsable, cqu_x, cqu_y, cqu_con_ingreso_fecha, cqu_con_cumplido_fecha, cqu_con_cumplido_nota, cqu_barrio, cqu_cgpc, cqu_historia, cqu_nombre, cqu_tel_fijo, cqu_tel_movil, cqu_email, use_code, cqu_ingreso_fecha, cqu_egreso_fecha, cqu_estado, cqu_resuelto, cqu_resultado, cqu_nota, cqu_actitud, cqu_conforme, cqu_motivo_no_conforme, cqu_reabrir_contacto, cqu_seguir, cqu_tipo, cqu_bloqueado, cqu_estado_contacto) VALUES (:cqu_codigo:, :cqu_contacto:, :cqu_calle:, :cqu_altura:, :cqu_prestacion:, :cqu_rubro:, :cqu_responsable:, :cqu_x:, :cqu_y:, :cqu_con_ingreso_fecha:, :cqu_con_cumplido_fecha:, :cqu_con_cumplido_nota:, :cqu_barrio:, :cqu_cgpc:, :cqu_historia:, :cqu_nombre:, :cqu_tel_fijo:, :cqu_tel_movil:, :cqu_email:, :use_code:, :cqu_ingreso_fecha:, :cqu_egreso_fecha:, :cqu_estado:, :cqu_resuelto:, :cqu_resultado:, :cqu_nota:, :cqu_actitud:, :cqu_conforme:, :cqu_motivo_no_conforme:, :cqu_reabrir_contacto:, :cqu_seguir:, :cqu_tipo:, :cqu_bloqueado:, :cqu_estado_contacto:)";
        $this->m_savedb_delete_sql = "DELETE FROM cal_queue WHERE cqu_codigo=:cqu_codigo_key:";
        $this->m_savedb_purge_sql = "DELETE FROM cal_queue";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM cal_queue ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ccal_queue
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('ccal_to_do') ) {
class ccal_to_do extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ccal_to_do";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cto_codigo'] = new CField(Array("Name"=>"cto_codigo", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false, "Sequence"=>"cal_to_do"));
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

} //-- Fin clase ccal_to_do
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('cfile') ) {
class cfile extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "cfile";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "file";
        $this->m_fileid = "call_queue";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['std_code'] = new CField(Array("Name"=>"std_code", "Label"=>"Codigo remito", "Size"=>50, "Order"=>1));
        $this->m_fields['doc_code'] = new CField(Array("Name"=>"doc_code", "Label"=>"Codigo", "Size"=>50, "Order"=>2));
        $this->m_fields['doc_name'] = new CField(Array("Name"=>"doc_name", "Label"=>"Archivo", "Size"=>200, "Order"=>3));
        $this->m_fields['doc_tstamp'] = new CField(Array("Name"=>"doc_tstamp", "Label"=>"Fecha", "Type"=>"DATETIME", "Order"=>4));
        $this->m_fields['doc_mime'] = new CField(Array("Name"=>"doc_mime", "Label"=>"Clase", "Size"=>50, "Order"=>5));
        $this->m_fields['doc_size'] = new CField(Array("Name"=>"doc_size", "Label"=>"Tamaño", "Type"=>"int", "Order"=>6));
        $this->m_fields['doc_storage'] = new CField(Array("Name"=>"doc_storage", "Label"=>"URI", "Size"=>200, "Order"=>7));
        $this->m_fields['doc_note'] = new CField(Array("Name"=>"doc_note", "Label"=>"Nota", "Size"=>200, "Order"=>8));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        $this->m_objfactory_sql = "SELECT  FROM ";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE  SET ";
        $this->m_savedb_insert_sql = "INSERT INTO () VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase cfile
}
?>
