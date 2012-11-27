<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_v_tickets1') ) {
class class_v_tickets1 extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_v_tickets1";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tic_anio'] = new CField(Array("Name"=>"tic_anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tic_tipo'] = new CField(Array("Name"=>"tic_tipo", "Size"=>20, "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>20, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['ttp_tstamp'] = new CField(Array("Name"=>"ttp_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['ttp_estado'] = new CField(Array("Name"=>"ttp_estado", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['ttp_prioridad'] = new CField(Array("Name"=>"ttp_prioridad", "Size"=>20, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tto_figura'] = new CField(Array("Name"=>"tto_figura", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tto_alerta'] = new CField(Array("Name"=>"tto_alerta", "Type"=>"int", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tic_calle_nombre'] = new CField(Array("Name"=>"tic_calle_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tic_nro_puerta'] = new CField(Array("Name"=>"tic_nro_puerta", "Type"=>"int", "IsForDB"=>true, "Order"=>113));
        $this->m_fields['tic_barrio'] = new CField(Array("Name"=>"tic_barrio", "Size"=>100, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['tic_nota_in'] = new CField(Array("Name"=>"tic_nota_in", "Size"=>500, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['responsable'] = new CField(Array("Name"=>"responsable", "Size"=>5, "IsForDB"=>true, "Order"=>116));
        $this->m_fields['prestador'] = new CField(Array("Name"=>"prestador", "Size"=>5, "IsForDB"=>true, "Order"=>117));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_anio, tic_tipo, tpr_code, ttp_tstamp, ttp_estado, ttp_prioridad, tor_code, tto_figura, tto_alerta, tru_code, tic_calle_nombre, tic_nro_puerta, tic_barrio, tic_nota_in, responsable, prestador FROM v_tickets  WHERE tic_nro= :tic_nro_key: AND tic_anio= :tic_anio_key: AND tic_tipo= :tic_tipo_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_anio, tic_tipo, tpr_code, ttp_tstamp, ttp_estado, ttp_prioridad, tor_code, tto_figura, tto_alerta, tru_code, tic_calle_nombre, tic_nro_puerta, tic_barrio, tic_nota_in, responsable, prestador FROM v_tickets";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_tickets SET tic_nro= :tic_nro:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tpr_code= :tpr_code:, ttp_tstamp= :ttp_tstamp:, ttp_estado= :ttp_estado:, ttp_prioridad= :ttp_prioridad:, tor_code= :tor_code:, tto_figura= :tto_figura:, tto_alerta= :tto_alerta:, tru_code= :tru_code:, tic_calle_nombre= :tic_calle_nombre:, tic_nro_puerta= :tic_nro_puerta:, tic_barrio= :tic_barrio:, tic_nota_in= :tic_nota_in:, responsable= :responsable:, prestador= :prestador: WHERE tic_nro=:tic_nro_key: AND tic_anio=:tic_anio_key: AND tic_tipo=:tic_tipo_key:";
        $this->m_savedb_insert_sql = "INSERT INTO v_tickets(tic_nro, tic_anio, tic_tipo, tpr_code, ttp_tstamp, ttp_estado, ttp_prioridad, tor_code, tto_figura, tto_alerta, tru_code, tic_calle_nombre, tic_nro_puerta, tic_barrio, tic_nota_in, responsable, prestador) VALUES (:tic_nro:, :tic_anio:, :tic_tipo:, :tpr_code:, :ttp_tstamp:, :ttp_estado:, :ttp_prioridad:, :tor_code:, :tto_figura:, :tto_alerta:, :tru_code:, :tic_calle_nombre:, :tic_nro_puerta:, :tic_barrio:, :tic_nota_in:, :responsable:, :prestador:)";
        $this->m_savedb_delete_sql = "DELETE FROM v_tickets WHERE tic_nro=:tic_nro_key: AND tic_anio=:tic_anio_key: AND tic_tipo=:tic_tipo_key:";
        $this->m_savedb_purge_sql = "DELETE FROM v_tickets";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_tickets ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_v_tickets1
}
?>
