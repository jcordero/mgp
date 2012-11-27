<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-07-01 11:50:16
 */
include_once "common/cobjbase.php";
if( !class_exists('class_tic_ticket_den') ) {
class class_tic_ticket_den extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "class_tic_ticket_den";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array('Name'=>'tic_nro', 'Type'=>'int', 'IsPK'=>true, 'IsForDB'=>true, 'Order'=>101, 'IsNullable'=>false));
        $this->m_fields['tic_anio'] = new CField(Array('Name'=>'tic_anio', 'Type'=>'int', 'IsPK'=>true, 'IsForDB'=>true, 'Order'=>102, 'IsNullable'=>false));
        $this->m_fields['tic_tipo'] = new CField(Array('Name'=>'tic_tipo', 'Size'=>20, 'IsPK'=>true, 'IsForDB'=>true, 'Order'=>103, 'IsNullable'=>false));
        $this->m_fields['tic_tstamp_in'] = new CField(Array('Name'=>'tic_tstamp_in', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>104));
        $this->m_fields['use_code'] = new CField(Array('Name'=>'use_code', 'Size'=>50, 'IsForDB'=>true, 'Order'=>105));
        $this->m_fields['tic_nota_in'] = new CField(Array('Name'=>'tic_nota_in', 'Size'=>500, 'IsForDB'=>true, 'Order'=>106));
        $this->m_fields['tic_estado'] = new CField(Array('Name'=>'tic_estado', 'Size'=>50, 'IsForDB'=>true, 'Order'=>107));
        $this->m_fields['tic_lugar'] = new CField(Array('Name'=>'tic_lugar', 'Size'=>1000, 'IsForDB'=>true, 'Order'=>108));
        $this->m_fields['tic_barrio'] = new CField(Array('Name'=>'tic_barrio', 'Size'=>50, 'IsForDB'=>true, 'Order'=>109));
        $this->m_fields['tic_cgpc'] = new CField(Array('Name'=>'tic_cgpc', 'Size'=>20, 'IsForDB'=>true, 'Order'=>110));
        $this->m_fields['tic_coordx'] = new CField(Array('Name'=>'tic_coordx', 'Type'=>'float', 'IsForDB'=>true, 'Order'=>111));
        $this->m_fields['tic_coordy'] = new CField(Array('Name'=>'tic_coordy', 'Type'=>'float', 'IsForDB'=>true, 'Order'=>112));
        $this->m_fields['tic_id_cuadra'] = new CField(Array('Name'=>'tic_id_cuadra', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>113));
        $this->m_fields['tic_forms'] = new CField(Array('Name'=>'tic_forms', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>114));
        $this->m_fields['tic_canal'] = new CField(Array('Name'=>'tic_canal', 'Size'=>20, 'IsForDB'=>true, 'Order'=>115));
        $this->m_fields['tic_tstamp_plazo'] = new CField(Array('Name'=>'tic_tstamp_plazo', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>116));
        $this->m_fields['tic_tstamp_cierre'] = new CField(Array('Name'=>'tic_tstamp_cierre', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>117));
        $this->m_fields['tic_calle_nombre'] = new CField(Array('Name'=>'tic_calle_nombre', 'Size'=>100, 'IsForDB'=>true, 'Order'=>118));
        $this->m_fields['tic_nro_puerta'] = new CField(Array('Name'=>'tic_nro_puerta', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>119));
        $this->m_fields['tic_nro_asociado'] = new CField(Array('Name'=>'tic_nro_asociado', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>120));
        $this->m_fields['tic_anio_asociado'] = new CField(Array('Name'=>'tic_anio_asociado', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>121));
        $this->m_fields['forms'] = new CField(Array('Name'=>'forms', 'Type'=>'int', 'Order'=>22));
        $this->m_fields['prestacion'] = new CField(Array('Name'=>'prestacion', 'Size'=>20, 'Order'=>23));
        $this->m_fields['rubro'] = new CField(Array('Name'=>'rubro', 'Size'=>100, 'Order'=>24));
        $this->m_fields['cuestionario'] = new CField(Array('Name'=>'cuestionario', 'Size'=>3000, 'Order'=>25));
        $this->m_fields['mapa'] = new CField(Array('Name'=>'mapa', 'Type'=>'int', 'Order'=>26));
        $this->m_fields['calle_nombre'] = new CField(Array('Name'=>'calle_nombre', 'Size'=>100, 'Order'=>27));
        $this->m_fields['calle'] = new CField(Array('Name'=>'calle', 'Type'=>'int', 'Order'=>28));
        $this->m_fields['callenro'] = new CField(Array('Name'=>'callenro', 'Type'=>'int', 'Order'=>29));
        $this->m_fields['piso'] = new CField(Array('Name'=>'piso', 'Type'=>'int', 'Order'=>30));
        $this->m_fields['dpto'] = new CField(Array('Name'=>'dpto', 'Size'=>20, 'Order'=>31));
        $this->m_fields['nombre_fantasia'] = new CField(Array('Name'=>'nombre_fantasia', 'Size'=>100, 'Order'=>32));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_anio_asociado FROM tic_ticket  WHERE tic_nro= :tic_nro_key: AND tic_anio= :tic_anio_key: AND tic_tipo= :tic_tipo_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_anio_asociado FROM tic_ticket";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE tic_ticket SET tic_nro= :tic_nro:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tic_tstamp_in= :tic_tstamp_in:, use_code= :use_code:, tic_nota_in= :tic_nota_in:, tic_estado= :tic_estado:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_cgpc= :tic_cgpc:, tic_coordx= :tic_coordx:, tic_coordy= :tic_coordy:, tic_id_cuadra= :tic_id_cuadra:, tic_forms= :tic_forms:, tic_canal= :tic_canal:, tic_tstamp_plazo= :tic_tstamp_plazo:, tic_tstamp_cierre= :tic_tstamp_cierre:, tic_calle_nombre= :tic_calle_nombre:, tic_nro_puerta= :tic_nro_puerta:, tic_nro_asociado= :tic_nro_asociado:, tic_anio_asociado= :tic_anio_asociado: WHERE tic_nro=:tic_nro_key: AND tic_anio=:tic_anio_key: AND tic_tipo=:tic_tipo_key:";
        $this->m_savedb_insert_sql = "INSERT INTO tic_ticket(tic_nro, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_anio_asociado) VALUES (:tic_nro:, :tic_anio:, :tic_tipo:, :tic_tstamp_in:, :use_code:, :tic_nota_in:, :tic_estado:, :tic_lugar:, :tic_barrio:, :tic_cgpc:, :tic_coordx:, :tic_coordy:, :tic_id_cuadra:, :tic_forms:, :tic_canal:, :tic_tstamp_plazo:, :tic_tstamp_cierre:, :tic_calle_nombre:, :tic_nro_puerta:, :tic_nro_asociado:, :tic_anio_asociado:)";
        $this->m_savedb_delete_sql = "DELETE FROM tic_ticket WHERE tic_nro=:tic_nro_key: AND tic_anio=:tic_anio_key: AND tic_tipo=:tic_tipo_key:";
        $this->m_savedb_purge_sql = "DELETE FROM tic_ticket";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM tic_ticket ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase class_tic_ticket_den
}
?>
