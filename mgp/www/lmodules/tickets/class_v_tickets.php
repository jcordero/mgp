<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_v_tickets') ) {
class class_v_tickets extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_v_tickets";
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
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsForDB"=>true, "Order"=>122, "IsNullable"=>false));
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsForDB"=>true, "Order"=>123));
        $this->m_fields['ttp_cuestionario'] = new CField(Array("Name"=>"ttp_cuestionario", "Size"=>3000, "IsForDB"=>true, "Order"=>124));
        $this->m_fields['ttp_estado'] = new CField(Array("Name"=>"ttp_estado", "Size"=>50, "IsForDB"=>true, "Order"=>125));
        $this->m_fields['ttp_prioridad'] = new CField(Array("Name"=>"ttp_prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>126));
        $this->m_fields['ttp_tstamp_plazo'] = new CField(Array("Name"=>"ttp_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>127));
        $this->m_fields['ttp_alerta'] = new CField(Array("Name"=>"ttp_alerta", "Type"=>"int", "IsForDB"=>true, "Order"=>128));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsForDB"=>true, "Order"=>129));
        $this->m_fields['tto_figura'] = new CField(Array("Name"=>"tto_figura", "Size"=>50, "IsForDB"=>true, "Order"=>130));
        $this->m_fields['responsable'] = new CField(Array("Name"=>"responsable", "Size"=>5, "Order"=>31));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tor_code, tto_figura FROM v_tickets  WHERE tic_nro= :tic_nro_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tor_code, tto_figura FROM v_tickets";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_tickets SET tic_nro= :tic_nro:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tic_tstamp_in= :tic_tstamp_in:, use_code= :use_code:, tic_nota_in= :tic_nota_in:, tic_estado= :tic_estado:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_cgpc= :tic_cgpc:, tic_coordx= :tic_coordx:, tic_coordy= :tic_coordy:, tic_id_cuadra= :tic_id_cuadra:, tic_forms= :tic_forms:, tic_canal= :tic_canal:, tic_tstamp_plazo= :tic_tstamp_plazo:, tic_tstamp_cierre= :tic_tstamp_cierre:, tic_calle_nombre= :tic_calle_nombre:, tic_nro_puerta= :tic_nro_puerta:, tic_nro_asociado= :tic_nro_asociado:, tic_identificador= :tic_identificador:, tpr_code= :tpr_code:, tru_code= :tru_code:, ttp_cuestionario= :ttp_cuestionario:, ttp_estado= :ttp_estado:, ttp_prioridad= :ttp_prioridad:, ttp_tstamp_plazo= :ttp_tstamp_plazo:, ttp_alerta= :ttp_alerta:, tor_code= :tor_code:, tto_figura= :tto_figura: WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_insert_sql = "INSERT INTO v_tickets(tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tor_code, tto_figura) VALUES (:tic_nro:, :tic_anio:, :tic_tipo:, :tic_tstamp_in:, :use_code:, :tic_nota_in:, :tic_estado:, :tic_lugar:, :tic_barrio:, :tic_cgpc:, :tic_coordx:, :tic_coordy:, :tic_id_cuadra:, :tic_forms:, :tic_canal:, :tic_tstamp_plazo:, :tic_tstamp_cierre:, :tic_calle_nombre:, :tic_nro_puerta:, :tic_nro_asociado:, :tic_identificador:, :tpr_code:, :tru_code:, :ttp_cuestionario:, :ttp_estado:, :ttp_prioridad:, :ttp_tstamp_plazo:, :ttp_alerta:, :tor_code:, :tto_figura:)";
        $this->m_savedb_delete_sql = "DELETE FROM v_tickets WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_purge_sql = "DELETE FROM v_tickets";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_tickets ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_v_tickets
}
?>
