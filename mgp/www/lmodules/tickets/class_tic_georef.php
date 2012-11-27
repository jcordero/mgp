<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_georef') ) {
class class_tic_georef extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_georef";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tge_tipo'] = new CField(Array("Name"=>"tge_tipo", "Size"=>30, "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tge_nombre'] = new CField(Array("Name"=>"tge_nombre", "Size"=>100, "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['tge_calle_nombre'] = new CField(Array("Name"=>"tge_calle_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tge_altura'] = new CField(Array("Name"=>"tge_altura", "Type"=>"int", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tge_otra_denominacion'] = new CField(Array("Name"=>"tge_otra_denominacion", "Size"=>500, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['tge_coordx'] = new CField(Array("Name"=>"tge_coordx", "Type"=>"float", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tge_coordy'] = new CField(Array("Name"=>"tge_coordy", "Type"=>"float", "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tge_cgpc'] = new CField(Array("Name"=>"tge_cgpc", "Size"=>50, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tge_barrio'] = new CField(Array("Name"=>"tge_barrio", "Size"=>100, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tge_calle'] = new CField(Array("Name"=>"tge_calle", "Type"=>"int", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tmp_prestacion'] = new CField(Array("Name"=>"tmp_prestacion", "Size"=>100, "Order"=>11));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tge_tipo, tge_nombre, tge_calle_nombre, tge_altura, tge_otra_denominacion, tge_coordx, tge_coordy, tge_cgpc, tge_barrio, tge_calle FROM tic_georef  WHERE tge_tipo= :tge_tipo_key: AND tge_nombre= :tge_nombre_key:";
        $this->m_objfactory_sql = "SELECT tge_tipo, tge_nombre, tge_calle_nombre, tge_altura, tge_otra_denominacion, tge_coordx, tge_coordy, tge_cgpc, tge_barrio, tge_calle FROM tic_georef";
        $this->m_objfactory_suffix_sql = "order by tge_nombre";
        $this->m_savedb_update_sql = "UPDATE tic_georef SET tge_tipo= :tge_tipo:, tge_nombre= :tge_nombre:, tge_calle_nombre= :tge_calle_nombre:, tge_altura= :tge_altura:, tge_otra_denominacion= :tge_otra_denominacion:, tge_coordx= :tge_coordx:, tge_coordy= :tge_coordy:, tge_cgpc= :tge_cgpc:, tge_barrio= :tge_barrio:, tge_calle= :tge_calle: WHERE tge_tipo=:tge_tipo_key: AND tge_nombre=:tge_nombre_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_georef(tge_tipo, tge_nombre, tge_calle_nombre, tge_altura, tge_otra_denominacion, tge_coordx, tge_coordy, tge_cgpc, tge_barrio, tge_calle) VALUES (:tge_tipo:, :tge_nombre:, :tge_calle_nombre:, :tge_altura:, :tge_otra_denominacion:, :tge_coordx:, :tge_coordy:, :tge_cgpc:, :tge_barrio:, :tge_calle:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_georef WHERE tge_tipo=:tge_tipo_key: AND tge_nombre=:tge_nombre_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_georef";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_georef ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_georef
}
?>
