<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_ticket') ) {
class class_tic_ticket extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['tic_numero'] = new CField(Array("Name"=>"tic_numero", "Type"=>"int", "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tic_anio'] = new CField(Array("Name"=>"tic_anio", "Type"=>"int", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tic_tipo'] = new CField(Array("Name"=>"tic_tipo", "Size"=>20, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tic_tstamp_in'] = new CField(Array("Name"=>"tic_tstamp_in", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tic_nota_in'] = new CField(Array("Name"=>"tic_nota_in", "Size"=>500, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tic_estado'] = new CField(Array("Name"=>"tic_estado", "Size"=>50, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tic_lugar'] = new CField(Array("Name"=>"tic_lugar", "Size"=>1000, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tic_barrio'] = new CField(Array("Name"=>"tic_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tic_cgpc'] = new CField(Array("Name"=>"tic_cgpc", "Size"=>20, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tic_coordx'] = new CField(Array("Name"=>"tic_coordx", "Type"=>"double", "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tic_coordy'] = new CField(Array("Name"=>"tic_coordy", "Type"=>"double", "IsForDB"=>true, "Order"=>113));
        $this->m_fields['tic_id_cuadra'] = new CField(Array("Name"=>"tic_id_cuadra", "Type"=>"int", "IsForDB"=>true, "Order"=>114));
        $this->m_fields['tic_forms'] = new CField(Array("Name"=>"tic_forms", "Type"=>"int", "IsForDB"=>true, "Order"=>115));
        $this->m_fields['tic_canal'] = new CField(Array("Name"=>"tic_canal", "Size"=>20, "IsForDB"=>true, "Order"=>116));
        $this->m_fields['tic_tstamp_plazo'] = new CField(Array("Name"=>"tic_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>117));
        $this->m_fields['tic_tstamp_cierre'] = new CField(Array("Name"=>"tic_tstamp_cierre", "Type"=>"datetime", "IsForDB"=>true, "Order"=>118));
        $this->m_fields['tic_calle_nombre'] = new CField(Array("Name"=>"tic_calle_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>119));
        $this->m_fields['tic_cruza_calle'] = new CField(Array("Name"=>"tic_cruza_calle", "Size"=>100, "IsForDB"=>true, "Order"=>120));
        $this->m_fields['tic_nro_puerta'] = new CField(Array("Name"=>"tic_nro_puerta", "Type"=>"int", "IsForDB"=>true, "Order"=>121));
        $this->m_fields['tic_nro_asociado'] = new CField(Array("Name"=>"tic_nro_asociado", "Type"=>"int", "IsForDB"=>true, "Order"=>122));
        $this->m_fields['tic_identificador'] = new CField(Array("Name"=>"tic_identificador", "Size"=>45, "IsForDB"=>true, "Order"=>123));
        $this->m_fields['forms'] = new CField(Array("Name"=>"forms", "Type"=>"int", "Order"=>24));
        $this->m_fields['prestacion'] = new CField(Array("Name"=>"prestacion", "Size"=>20, "Order"=>25));
        $this->m_fields['rubro'] = new CField(Array("Name"=>"rubro", "Size"=>100, "Order"=>26));
        $this->m_fields['cuestionario'] = new CField(Array("Name"=>"cuestionario", "Size"=>3000, "Order"=>27));
        $this->m_fields['tipo_georef'] = new CField(Array("Name"=>"tipo_georef", "Size"=>50, "Order"=>28));
        $this->m_fields['mapa'] = new CField(Array("Name"=>"mapa", "Type"=>"int", "Order"=>29));
        $this->m_fields['calle_nombre'] = new CField(Array("Name"=>"calle_nombre", "Size"=>100, "Order"=>30));
        $this->m_fields['calle'] = new CField(Array("Name"=>"calle", "Type"=>"int", "Order"=>31));
        $this->m_fields['calle_nombre2'] = new CField(Array("Name"=>"calle_nombre2", "Size"=>100, "Order"=>32));
        $this->m_fields['calle2'] = new CField(Array("Name"=>"calle2", "Type"=>"int", "Order"=>33));
        $this->m_fields['callenro'] = new CField(Array("Name"=>"callenro", "Type"=>"int", "Order"=>34));
        $this->m_fields['piso'] = new CField(Array("Name"=>"piso", "Type"=>"int", "Order"=>35));
        $this->m_fields['dpto'] = new CField(Array("Name"=>"dpto", "Size"=>20, "Order"=>36));
        $this->m_fields['nombre_fantasia'] = new CField(Array("Name"=>"nombre_fantasia", "Size"=>100, "Order"=>37));
        $this->m_fields['alternativa'] = new CField(Array("Name"=>"alternativa", "Size"=>20, "Order"=>38));
        $this->m_fields['villa'] = new CField(Array("Name"=>"villa", "Size"=>100, "Order"=>39));
        $this->m_fields['vilmanzana'] = new CField(Array("Name"=>"vilmanzana", "Size"=>20, "Order"=>40));
        $this->m_fields['vilcasa'] = new CField(Array("Name"=>"vilcasa", "Size"=>20, "Order"=>41));
        $this->m_fields['plaza'] = new CField(Array("Name"=>"plaza", "Size"=>100, "Order"=>42));
        $this->m_fields['orgpublico'] = new CField(Array("Name"=>"orgpublico", "Size"=>100, "Order"=>43));
        $this->m_fields['orgsector'] = new CField(Array("Name"=>"orgsector", "Size"=>100, "Order"=>44));
        $this->m_fields['cementerio'] = new CField(Array("Name"=>"cementerio", "Size"=>100, "Order"=>45));
        $this->m_fields['sepultura'] = new CField(Array("Name"=>"sepultura", "Size"=>100, "Order"=>46));
        $this->m_fields['sepsector'] = new CField(Array("Name"=>"sepsector", "Size"=>100, "Order"=>47));
        $this->m_fields['sepcalle'] = new CField(Array("Name"=>"sepcalle", "Size"=>100, "Order"=>48));
        $this->m_fields['sepnumero'] = new CField(Array("Name"=>"sepnumero", "Size"=>100, "Order"=>49));
        $this->m_fields['sepfila'] = new CField(Array("Name"=>"sepfila", "Size"=>100, "Order"=>50));
        $this->m_fields['mapa_lum'] = new CField(Array("Name"=>"mapa_lum", "Type"=>"int", "Order"=>51));
        $this->m_fields['calle_nombre_lum'] = new CField(Array("Name"=>"calle_nombre_lum", "Size"=>100, "Order"=>52));
        $this->m_fields['calle_lum'] = new CField(Array("Name"=>"calle_lum", "Type"=>"int", "Order"=>53));
        $this->m_fields['calle_nombre2_lum'] = new CField(Array("Name"=>"calle_nombre2_lum", "Size"=>100, "Order"=>54));
        $this->m_fields['calle2_lum'] = new CField(Array("Name"=>"calle2_lum", "Type"=>"int", "Order"=>55));
        $this->m_fields['callenro_lum'] = new CField(Array("Name"=>"callenro_lum", "Type"=>"int", "Order"=>56));
        $this->m_fields['tic_barrio_lum'] = new CField(Array("Name"=>"tic_barrio_lum", "Size"=>100, "Order"=>57));
        $this->m_fields['tic_cgpc_lum'] = new CField(Array("Name"=>"tic_cgpc_lum", "Size"=>100, "Order"=>58));
        $this->m_fields['id_elemento'] = new CField(Array("Name"=>"id_elemento", "Size"=>100, "Order"=>59));
        $this->m_fields['alternativa_lum'] = new CField(Array("Name"=>"alternativa_lum", "Size"=>20, "Order"=>60));
        $this->m_fields['col_linea'] = new CField(Array("Name"=>"col_linea", "Size"=>100, "Order"=>61));
        $this->m_fields['col_interno'] = new CField(Array("Name"=>"col_interno", "Size"=>100, "Order"=>62));
        $this->m_fields['col_fecha_hora'] = new CField(Array("Name"=>"col_fecha_hora", "Type"=>"datetime", "Order"=>63));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_cruza_calle, tic_nro_puerta, tic_nro_asociado, tic_identificador FROM tic_ticket  WHERE tic_nro= :tic_nro_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_cruza_calle, tic_nro_puerta, tic_nro_asociado, tic_identificador FROM tic_ticket";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket SET tic_nro= :tic_nro:, tic_numero= :tic_numero:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tic_tstamp_in= :tic_tstamp_in:, use_code= :use_code:, tic_nota_in= :tic_nota_in:, tic_estado= :tic_estado:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_cgpc= :tic_cgpc:, tic_coordx= :tic_coordx:, tic_coordy= :tic_coordy:, tic_id_cuadra= :tic_id_cuadra:, tic_forms= :tic_forms:, tic_canal= :tic_canal:, tic_tstamp_plazo= :tic_tstamp_plazo:, tic_tstamp_cierre= :tic_tstamp_cierre:, tic_calle_nombre= :tic_calle_nombre:, tic_cruza_calle= :tic_cruza_calle:, tic_nro_puerta= :tic_nro_puerta:, tic_nro_asociado= :tic_nro_asociado:, tic_identificador= :tic_identificador: WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket(tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_cruza_calle, tic_nro_puerta, tic_nro_asociado, tic_identificador) VALUES (:tic_nro:, :tic_numero:, :tic_anio:, :tic_tipo:, :tic_tstamp_in:, :use_code:, :tic_nota_in:, :tic_estado:, :tic_lugar:, :tic_barrio:, :tic_cgpc:, :tic_coordx:, :tic_coordy:, :tic_id_cuadra:, :tic_forms:, :tic_canal:, :tic_tstamp_plazo:, :tic_tstamp_cierre:, :tic_calle_nombre:, :tic_cruza_calle:, :tic_nro_puerta:, :tic_nro_asociado:, :tic_identificador:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket WHERE tic_nro=:tic_nro_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket
}
?>
