<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_organismos') ) {
class class_tic_organismos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_organismos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tor_code'] = new CField(Array("Name"=>"tor_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tor_padre'] = new CField(Array("Name"=>"tor_padre", "Type"=>"int", "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tor_sigla'] = new CField(Array("Name"=>"tor_sigla", "Size"=>20, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tor_nombre'] = new CField(Array("Name"=>"tor_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tor_estado'] = new CField(Array("Name"=>"tor_estado", "Size"=>50, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tor_tstamp'] = new CField(Array("Name"=>"tor_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tor_contacto'] = new CField(Array("Name"=>"tor_contacto", "Size"=>500, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tor_tipo'] = new CField(Array("Name"=>"tor_tipo", "Size"=>20, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tor_email'] = new CField(Array("Name"=>"tor_email", "Size"=>200, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tor_notificar'] = new CField(Array("Name"=>"tor_notificar", "Size"=>5, "IsForDB"=>true, "Order"=>111));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tor_code, tor_padre, tor_sigla, tor_nombre, tor_estado, tor_tstamp, use_code, tor_contacto, tor_tipo, tor_email, tor_notificar FROM tic_organismos  WHERE tor_code= :tor_code_key:";
        $this->m_objfactory_sql = "SELECT tor_code, tor_padre, tor_sigla, tor_nombre, tor_estado, tor_tstamp, use_code, tor_contacto, tor_tipo, tor_email, tor_notificar FROM tic_organismos";
        $this->m_objfactory_suffix_sql = "order by tor_sigla";
        $this->m_savedb_update_sql = "UPDATE tic_organismos SET tor_code= :tor_code:, tor_padre= :tor_padre:, tor_sigla= :tor_sigla:, tor_nombre= :tor_nombre:, tor_estado= :tor_estado:, tor_tstamp= :tor_tstamp:, use_code= :use_code:, tor_contacto= :tor_contacto:, tor_tipo= :tor_tipo:, tor_email= :tor_email:, tor_notificar= :tor_notificar: WHERE tor_code=:tor_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_organismos(tor_code, tor_padre, tor_sigla, tor_nombre, tor_estado, tor_tstamp, use_code, tor_contacto, tor_tipo, tor_email, tor_notificar) VALUES (:tor_code:, :tor_padre:, :tor_sigla:, :tor_nombre:, :tor_estado:, :tor_tstamp:, :use_code:, :tor_contacto:, :tor_tipo:, :tor_email:, :tor_notificar:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_organismos WHERE tor_code=:tor_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_organismos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_organismos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_organismos
}
?>
