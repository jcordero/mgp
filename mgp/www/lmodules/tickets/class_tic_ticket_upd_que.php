<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_ticket_upd_que') ) {
class class_tic_ticket_upd_que extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_upd_que";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tic_anio'] = new CField(Array("Name"=>"tic_anio", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tic_tipo'] = new CField(Array("Name"=>"tic_tipo", "Size"=>20, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tic_tstamp_in'] = new CField(Array("Name"=>"tic_tstamp_in", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tic_nota_in'] = new CField(Array("Name"=>"tic_nota_in", "Size"=>500, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tic_estado'] = new CField(Array("Name"=>"tic_estado", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tic_lugar'] = new CField(Array("Name"=>"tic_lugar", "Size"=>1000, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tic_barrio'] = new CField(Array("Name"=>"tic_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tic_cgpc'] = new CField(Array("Name"=>"tic_cgpc", "Size"=>20, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tic_coordx'] = new CField(Array("Name"=>"tic_coordx", "Type"=>"double", "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tic_coordy'] = new CField(Array("Name"=>"tic_coordy", "Type"=>"double", "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tic_id_cuadra'] = new CField(Array("Name"=>"tic_id_cuadra", "Type"=>"int", "IsForDB"=>true, "Order"=>113));
        $this->m_fields['tic_forms'] = new CField(Array("Name"=>"tic_forms", "Type"=>"int", "IsForDB"=>true, "Order"=>114));
        $this->m_fields['tic_canal'] = new CField(Array("Name"=>"tic_canal", "Size"=>20, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['tic_tstamp_plazo'] = new CField(Array("Name"=>"tic_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>116));
        $this->m_fields['tic_tstamp_cierre'] = new CField(Array("Name"=>"tic_tstamp_cierre", "Type"=>"datetime", "IsForDB"=>true, "Order"=>117));
        $this->m_fields['tic_calle_nombre'] = new CField(Array("Name"=>"tic_calle_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>118));
        $this->m_fields['tic_nro_puerta'] = new CField(Array("Name"=>"tic_nro_puerta", "Type"=>"int", "IsForDB"=>true, "Order"=>119));
        $this->m_fields['tic_nro_asociado'] = new CField(Array("Name"=>"tic_nro_asociado", "Type"=>"int", "IsForDB"=>true, "Order"=>120));
        $this->m_fields['tic_identificador'] = new CField(Array("Name"=>"tic_identificador", "Size"=>45, "IsForDB"=>true, "Order"=>121));
        $this->m_fields['mapa'] = new CField(Array("Name"=>"mapa", "Size"=>50, "Order"=>22));
        $this->m_fields['acc_tpr_code'] = new CField(Array("Name"=>"acc_tpr_code", "Size"=>50, "Order"=>23));
        $this->m_fields['acc_estado'] = new CField(Array("Name"=>"acc_estado", "Size"=>50, "Order"=>24));
        $this->m_fields['acc_nota'] = new CField(Array("Name"=>"acc_nota", "Size"=>500, "Order"=>25));
        $this->m_fields['acc_use_code'] = new CField(Array("Name"=>"acc_use_code", "Size"=>50, "Order"=>26));
        $this->m_fields['acc_tstamp'] = new CField(Array("Name"=>"acc_tstamp", "Type"=>"datetime", "Order"=>27));
        $this->m_fields['acc_tic_nro'] = new CField(Array("Name"=>"acc_tic_nro", "Type"=>"int", "Order"=>28));
        $this->m_fields['acc_tic_anio'] = new CField(Array("Name"=>"acc_tic_anio", "Type"=>"int", "Order"=>29));
        $this->m_fields['acc_tor_code'] = new CField(Array("Name"=>"acc_tor_code", "Type"=>"int", "Order"=>30));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['class_tic_ticket_prestaciones']='class_tic_ticket_prestaciones';
        $this->m_childs['class_tic_ticket_prestaciones']=array();
        $this->m_childs_keys['class_tic_ticket_prestaciones']['tic_nro']='tic_nro';

        $this->m_childs_classname['class_tic_ticket_organismos']='class_tic_ticket_organismos';
        $this->m_childs['class_tic_ticket_organismos']=array();
        $this->m_childs_keys['class_tic_ticket_organismos']['tic_nro']='tic_nro';

        $this->m_childs_classname['class_tic_avance']='class_tic_avance';
        $this->m_childs['class_tic_avance']=array();
        $this->m_childs_keys['class_tic_avance']['tic_nro']='tic_nro';

        $this->m_childs_classname['class_tic_ticket_ciudadano']='class_tic_ticket_ciudadano';
        $this->m_childs['class_tic_ticket_ciudadano']=array();
        $this->m_childs_keys['class_tic_ticket_ciudadano']['tic_nro']='tic_nro';

        $this->m_childs_classname['class_tic_ticket_ciudadano_reit']='class_tic_ticket_ciudadano_reit';
        $this->m_childs['class_tic_ticket_ciudadano_reit']=array();
        $this->m_childs_keys['class_tic_ticket_ciudadano_reit']['tic_nro']='tic_nro';

        $this->m_childs_classname['class_tic_ticket_asociado']='class_tic_ticket_asociado';
        $this->m_childs['class_tic_ticket_asociado']=array();
        $this->m_childs_keys['class_tic_ticket_asociado']['tic_nro']='tic_nro';

        $this->m_childs_classname['cfile']='cfile';
        $this->m_childs['cfile']=array();


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador FROM tic_ticket  WHERE tic_nro= :tic_nro_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador FROM tic_ticket";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket SET tic_nro= :tic_nro:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tic_tstamp_in= :tic_tstamp_in:, use_code= :use_code:, tic_nota_in= :tic_nota_in:, tic_estado= :tic_estado:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_cgpc= :tic_cgpc:, tic_coordx= :tic_coordx:, tic_coordy= :tic_coordy:, tic_id_cuadra= :tic_id_cuadra:, tic_forms= :tic_forms:, tic_canal= :tic_canal:, tic_tstamp_plazo= :tic_tstamp_plazo:, tic_tstamp_cierre= :tic_tstamp_cierre:, tic_calle_nombre= :tic_calle_nombre:, tic_nro_puerta= :tic_nro_puerta:, tic_nro_asociado= :tic_nro_asociado:, tic_identificador= :tic_identificador: WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket(tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador) VALUES (:tic_nro:, :tic_anio:, :tic_tipo:, :tic_tstamp_in:, :use_code:, :tic_nota_in:, :tic_estado:, :tic_lugar:, :tic_barrio:, :tic_cgpc:, :tic_coordx:, :tic_coordy:, :tic_id_cuadra:, :tic_forms:, :tic_canal:, :tic_tstamp_plazo:, :tic_tstamp_cierre:, :tic_calle_nombre:, :tic_nro_puerta:, :tic_nro_asociado:, :tic_identificador:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_upd_que
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_ticket_prestaciones') ) {
class class_tic_ticket_prestaciones extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_prestaciones";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['ttp_cuestionario'] = new CField(Array("Name"=>"ttp_cuestionario", "Size"=>3000, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['ttp_estado'] = new CField(Array("Name"=>"ttp_estado", "Size"=>50, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['ttp_prioridad'] = new CField(Array("Name"=>"ttp_prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['ttp_tstamp_plazo'] = new CField(Array("Name"=>"ttp_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107));
        $this->m_fields['ttp_alerta'] = new CField(Array("Name"=>"ttp_alerta", "Type"=>"int", "IsForDB"=>true, "Order"=>108));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta FROM tic_ticket_prestaciones  WHERE tic_nro= :tic_nro_key: AND tpr_code= :tpr_code_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta FROM tic_ticket_prestaciones";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket_prestaciones SET tic_nro= :tic_nro:, tpr_code= :tpr_code:, tru_code= :tru_code:, ttp_cuestionario= :ttp_cuestionario:, ttp_estado= :ttp_estado:, ttp_prioridad= :ttp_prioridad:, ttp_tstamp_plazo= :ttp_tstamp_plazo:, ttp_alerta= :ttp_alerta: WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket_prestaciones(tic_nro, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta) VALUES (:tic_nro:, :tpr_code:, :tru_code:, :ttp_cuestionario:, :ttp_estado:, :ttp_prioridad:, :ttp_tstamp_plazo:, :ttp_alerta:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket_prestaciones WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket_prestaciones WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket_prestaciones ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_prestaciones
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_ticket_organismos') ) {
class class_tic_ticket_organismos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_organismos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tto_figura'] = new CField(Array("Name"=>"tto_figura", "Size"=>50, "IsPK"=>true, "IsForDB"=>true, "Order"=>104, "IsNullable"=>false));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tpr_code, tor_code, tto_figura FROM tic_ticket_organismos  WHERE tic_nro= :tic_nro_key: AND tpr_code= :tpr_code_key: AND tor_code= :tor_code_key: AND tto_figura= :tto_figura_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tpr_code, tor_code, tto_figura FROM tic_ticket_organismos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket_organismos SET tic_nro= :tic_nro:, tpr_code= :tpr_code:, tor_code= :tor_code:, tto_figura= :tto_figura: WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key: AND tor_code=:tor_code_key: AND tto_figura=:tto_figura_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket_organismos(tic_nro, tpr_code, tor_code, tto_figura) VALUES (:tic_nro:, :tpr_code:, :tor_code:, :tto_figura:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket_organismos WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key: AND tor_code=:tor_code_key: AND tto_figura=:tto_figura_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket_organismos WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket_organismos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_organismos
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_avance') ) {
class class_tic_avance extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_avance";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tav_code'] = new CField(Array("Name"=>"tav_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tav_tstamp_in'] = new CField(Array("Name"=>"tav_tstamp_in", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['use_code_in'] = new CField(Array("Name"=>"use_code_in", "Size"=>50, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tic_estado_in'] = new CField(Array("Name"=>"tic_estado_in", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tav_nota'] = new CField(Array("Name"=>"tav_nota", "Size"=>1000, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tic_motivo'] = new CField(Array("Name"=>"tic_motivo", "Size"=>50, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tic_estado_out'] = new CField(Array("Name"=>"tic_estado_out", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tav_tstamp_out'] = new CField(Array("Name"=>"tav_tstamp_out", "Type"=>"datetime", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['use_code_out'] = new CField(Array("Name"=>"use_code_out", "Size"=>50, "IsForDB"=>true, "Order"=>111));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tpr_code, tav_code, tav_tstamp_in, use_code_in, tic_estado_in, tav_nota, tic_motivo, tic_estado_out, tav_tstamp_out, use_code_out FROM tic_avance  WHERE tic_nro= :tic_nro_key: AND tpr_code= :tpr_code_key: AND tav_code= :tav_code_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tpr_code, tav_code, tav_tstamp_in, use_code_in, tic_estado_in, tav_nota, tic_motivo, tic_estado_out, tav_tstamp_out, use_code_out FROM tic_avance";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_avance SET tic_nro= :tic_nro:, tpr_code= :tpr_code:, tav_code= :tav_code:, tav_tstamp_in= :tav_tstamp_in:, use_code_in= :use_code_in:, tic_estado_in= :tic_estado_in:, tav_nota= :tav_nota:, tic_motivo= :tic_motivo:, tic_estado_out= :tic_estado_out:, tav_tstamp_out= :tav_tstamp_out:, use_code_out= :use_code_out: WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key: AND tav_code=:tav_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_avance(tic_nro, tpr_code, tav_code, tav_tstamp_in, use_code_in, tic_estado_in, tav_nota, tic_motivo, tic_estado_out, tav_tstamp_out, use_code_out) VALUES (:tic_nro:, :tpr_code:, :tav_code:, :tav_tstamp_in:, :use_code_in:, :tic_estado_in:, :tav_nota:, :tic_motivo:, :tic_estado_out:, :tav_tstamp_out:, :use_code_out:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_avance WHERE tic_nro=:tic_nro_key: AND tpr_code=:tpr_code_key: AND tav_code=:tav_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_avance WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_avance ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_avance
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_ticket_ciudadano') ) {
class class_tic_ticket_ciudadano extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_ciudadano";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['ttc_tstamp'] = new CField(Array("Name"=>"ttc_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['ttc_nota'] = new CField(Array("Name"=>"ttc_nota", "Size"=>1000, "IsForDB"=>true, "Order"=>104));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, ciu_code, ttc_tstamp, ttc_nota FROM tic_ticket_ciudadano  WHERE tic_nro= :tic_nro_key: AND ciu_code= :ciu_code_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, ciu_code, ttc_tstamp, ttc_nota FROM tic_ticket_ciudadano";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket_ciudadano SET tic_nro= :tic_nro:, ciu_code= :ciu_code:, ttc_tstamp= :ttc_tstamp:, ttc_nota= :ttc_nota: WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket_ciudadano(tic_nro, ciu_code, ttc_tstamp, ttc_nota) VALUES (:tic_nro:, :ciu_code:, :ttc_tstamp:, :ttc_nota:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket_ciudadano WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket_ciudadano WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket_ciudadano ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_ciudadano
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_ticket_ciudadano_reit') ) {
class class_tic_ticket_ciudadano_reit extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_ciudadano_reit";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['ttc_tstamp'] = new CField(Array("Name"=>"ttc_tstamp", "Type"=>"datetime", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['ttc_nota'] = new CField(Array("Name"=>"ttc_nota", "Size"=>1000, "IsForDB"=>true, "Order"=>104));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, ciu_code, ttc_tstamp, ttc_nota FROM tic_ticket_ciudadano_reit  WHERE tic_nro= :tic_nro_key: AND ciu_code= :ciu_code_key: AND ttc_tstamp= :ttc_tstamp_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, ciu_code, ttc_tstamp, ttc_nota FROM tic_ticket_ciudadano_reit";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket_ciudadano_reit SET tic_nro= :tic_nro:, ciu_code= :ciu_code:, ttc_tstamp= :ttc_tstamp:, ttc_nota= :ttc_nota: WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key: AND ttc_tstamp=:ttc_tstamp_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket_ciudadano_reit(tic_nro, ciu_code, ttc_tstamp, ttc_nota) VALUES (:tic_nro:, :ciu_code:, :ttc_tstamp:, :ttc_nota:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket_ciudadano_reit WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key: AND ttc_tstamp=:ttc_tstamp_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket_ciudadano_reit WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket_ciudadano_reit ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_ciudadano_reit
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('class_tic_ticket_asociado') ) {
class class_tic_ticket_asociado extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_asociado";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tic_nro_asoc'] = new CField(Array("Name"=>"tic_nro_asoc", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tta_tstamp'] = new CField(Array("Name"=>"tta_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tta_motivo'] = new CField(Array("Name"=>"tta_motivo", "Size"=>500, "IsForDB"=>true, "Order"=>105));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_nro_asoc, tta_tstamp, use_code, tta_motivo FROM tic_ticket_asociado  WHERE tic_nro= :tic_nro_key: AND tic_nro_asoc= :tic_nro_asoc_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_nro_asoc, tta_tstamp, use_code, tta_motivo FROM tic_ticket_asociado";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket_asociado SET tic_nro= :tic_nro:, tic_nro_asoc= :tic_nro_asoc:, tta_tstamp= :tta_tstamp:, use_code= :use_code:, tta_motivo= :tta_motivo: WHERE tic_nro=:tic_nro_key: AND tic_nro_asoc=:tic_nro_asoc_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket_asociado(tic_nro, tic_nro_asoc, tta_tstamp, use_code, tta_motivo) VALUES (:tic_nro:, :tic_nro_asoc:, :tta_tstamp:, :use_code:, :tta_motivo:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket_asociado WHERE tic_nro=:tic_nro_key: AND tic_nro_asoc=:tic_nro_asoc_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket_asociado WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket_asociado ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_asociado
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
        $this->m_fileid = "ticket";
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
