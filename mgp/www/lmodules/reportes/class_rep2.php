<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('rep2') ) {
class rep2 extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "rep2";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101));
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Type"=>"int", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tpr_detalle'] = new CField(Array("Name"=>"tpr_detalle", "Type"=>"int", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tic_tstamp_in'] = new CField(Array("Name"=>"tic_tstamp_in", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tic_tstamp_plazo'] = new CField(Array("Name"=>"tic_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['ttp_estado'] = new CField(Array("Name"=>"ttp_estado", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['vencido'] = new CField(Array("Name"=>"vencido", "Type"=>"int", "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tic_identificador'] = new CField(Array("Name"=>"tic_identificador", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tic_lugar'] = new CField(Array("Name"=>"tic_lugar", "Size"=>500, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tic_barrio'] = new CField(Array("Name"=>"tic_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tic_nota_in'] = new CField(Array("Name"=>"tic_nota_in", "Size"=>50, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tic_id_elemento'] = new CField(Array("Name"=>"tic_id_elemento", "Type"=>"int", "IsForDB"=>true, "Order"=>113));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tor_code, tpr_code, tpr_detalle, tic_tstamp_in, tic_tstamp_plazo, ttp_estado, vencido, tic_identificador, tic_lugar, tic_barrio, tic_nota_in, tic_id_elemento FROM v_ticket_vencido  WHERE tic_nro= :tic_nro_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tor_code, tpr_code, tpr_detalle, tic_tstamp_in, tic_tstamp_plazo, ttp_estado, vencido, tic_identificador, tic_lugar, tic_barrio, tic_nota_in, tic_id_elemento FROM v_ticket_vencido";
        $this->m_objfactory_suffix_sql = "order by tor_code,tpr_code,tic_tstamp_in";
        $this->m_savedb_update_sql = "UPDATE v_ticket_vencido SET tic_nro= :tic_nro:, tor_code= :tor_code:, tpr_code= :tpr_code:, tpr_detalle= :tpr_detalle:, tic_tstamp_in= :tic_tstamp_in:, tic_tstamp_plazo= :tic_tstamp_plazo:, ttp_estado= :ttp_estado:, vencido= :vencido:, tic_identificador= :tic_identificador:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_nota_in= :tic_nota_in:, tic_id_elemento= :tic_id_elemento: WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_insert_sql = "INSERT INTO v_ticket_vencido(tic_nro, tor_code, tpr_code, tpr_detalle, tic_tstamp_in, tic_tstamp_plazo, ttp_estado, vencido, tic_identificador, tic_lugar, tic_barrio, tic_nota_in, tic_id_elemento) VALUES (:tic_nro:, :tor_code:, :tpr_code:, :tpr_detalle:, :tic_tstamp_in:, :tic_tstamp_plazo:, :ttp_estado:, :vencido:, :tic_identificador:, :tic_lugar:, :tic_barrio:, :tic_nota_in:, :tic_id_elemento:)";
        $this->m_savedb_delete_sql = "DELETE FROM v_ticket_vencido WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_purge_sql = "DELETE FROM v_ticket_vencido";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_ticket_vencido ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase rep2
}
?>
