<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:56:42
 */
include_once "common/cobjbase.php";
if( !class_exists('ccal_queue_small') ) {
class ccal_queue_small extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ccal_queue_small";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['cqu_code'] = new CField(Array('Name'=>'cqu_code', 'Type'=>'int', 'IsPK'=>true, 'IsForDB'=>true, 'Order'=>101, 'IsNullable'=>false));
        $this->m_fields['cqu_numero'] = new CField(Array('Name'=>'cqu_numero', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>102, 'IsNullable'=>false));
        $this->m_fields['cqu_anio'] = new CField(Array('Name'=>'cqu_anio', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>103, 'IsNullable'=>false));
        $this->m_fields['cqu_derivacion'] = new CField(Array('Name'=>'cqu_derivacion', 'Size'=>1, 'Type'=>'char', 'IsForDB'=>true, 'Order'=>104, 'IsNullable'=>false));
        $this->m_fields['cqu_nroreit'] = new CField(Array('Name'=>'cqu_nroreit', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>105, 'IsNullable'=>false));
        $this->m_fields['cqu_estado'] = new CField(Array('Name'=>'cqu_estado', 'Size'=>50, 'IsForDB'=>true, 'Order'=>106));
        $this->m_fields['use_code'] = new CField(Array('Name'=>'use_code', 'Size'=>50, 'IsForDB'=>true, 'Order'=>107));
        $this->m_fields['cqu_in_tstamp'] = new CField(Array('Name'=>'cqu_in_tstamp', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>108));
        $this->m_fields['cqu_out_tstamp'] = new CField(Array('Name'=>'cqu_out_tstamp', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>109));
        $this->m_fields['cqu_result'] = new CField(Array('Name'=>'cqu_result', 'Size'=>50, 'IsForDB'=>true, 'Order'=>110));
        $this->m_fields['cqu_note'] = new CField(Array('Name'=>'cqu_note', 'Size'=>3000, 'IsForDB'=>true, 'Order'=>111));
        $this->m_fields['cqu_quien'] = new CField(Array('Name'=>'cqu_quien', 'Size'=>100, 'IsForDB'=>true, 'Order'=>112));
        $this->m_fields['cqu_quientelfax'] = new CField(Array('Name'=>'cqu_quientelfax', 'Size'=>50, 'IsForDB'=>true, 'Order'=>113));
        $this->m_fields['cqu_prestacion'] = new CField(Array('Name'=>'cqu_prestacion', 'Size'=>20, 'IsForDB'=>true, 'Order'=>114));
        $this->m_fields['cqu_detalle'] = new CField(Array('Name'=>'cqu_detalle', 'Size'=>100, 'IsForDB'=>true, 'Order'=>115));
        $this->m_fields['cqu_calle'] = new CField(Array('Name'=>'cqu_calle', 'Size'=>100, 'IsForDB'=>true, 'Order'=>116));
        $this->m_fields['cqu_altura'] = new CField(Array('Name'=>'cqu_altura', 'Type'=>'int', 'IsForDB'=>true, 'Order'=>117));
        $this->m_fields['cqu_fechaingreso'] = new CField(Array('Name'=>'cqu_fechaingreso', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>118));
        $this->m_fields['cqu_barrio'] = new CField(Array('Name'=>'cqu_barrio', 'Size'=>50, 'IsForDB'=>true, 'Order'=>119));
        $this->m_fields['cqu_fechacumplido'] = new CField(Array('Name'=>'cqu_fechacumplido', 'Type'=>'datetime', 'IsForDB'=>true, 'Order'=>120));
        $this->m_fields['cqu_quienemail'] = new CField(Array('Name'=>'cqu_quienemail', 'Size'=>100, 'IsForDB'=>true, 'Order'=>121));
        $this->m_fields['cqu_quiencelular'] = new CField(Array('Name'=>'cqu_quiencelular', 'Size'=>30, 'IsForDB'=>true, 'Order'=>122));
        $this->m_fields['cqu_actitud'] = new CField(Array('Name'=>'cqu_actitud', 'Size'=>50, 'IsForDB'=>true, 'Order'=>123));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT cqu_code, cqu_numero, cqu_anio, cqu_derivacion, cqu_nroreit, cqu_estado, use_code, cqu_in_tstamp, cqu_out_tstamp, cqu_result, cqu_note, cqu_quien, cqu_quientelfax, cqu_prestacion, cqu_detalle, cqu_calle, cqu_altura, cqu_fechaingreso, cqu_barrio, cqu_fechacumplido, cqu_quienemail, cqu_quiencelular, cqu_actitud FROM cal_queue  WHERE cqu_code= :cqu_code_key:";
        $this->m_objfactory_sql = "SELECT cqu_code, cqu_numero, cqu_anio, cqu_derivacion, cqu_nroreit, cqu_estado, use_code, cqu_in_tstamp, cqu_out_tstamp, cqu_result, cqu_note, cqu_quien, cqu_quientelfax, cqu_prestacion, cqu_detalle, cqu_calle, cqu_altura, cqu_fechaingreso, cqu_barrio, cqu_fechacumplido, cqu_quienemail, cqu_quiencelular, cqu_actitud FROM cal_queue";
        $this->m_objfactory_suffix_sql = "order by cqu_quientelfax";
        $this->m_savedb_update_sql = "UPDATE cal_queue SET cqu_code= :cqu_code:, cqu_numero= :cqu_numero:, cqu_anio= :cqu_anio:, cqu_derivacion= :cqu_derivacion:, cqu_nroreit= :cqu_nroreit:, cqu_estado= :cqu_estado:, use_code= :use_code:, cqu_in_tstamp= :cqu_in_tstamp:, cqu_out_tstamp= :cqu_out_tstamp:, cqu_result= :cqu_result:, cqu_note= :cqu_note:, cqu_quien= :cqu_quien:, cqu_quientelfax= :cqu_quientelfax:, cqu_prestacion= :cqu_prestacion:, cqu_detalle= :cqu_detalle:, cqu_calle= :cqu_calle:, cqu_altura= :cqu_altura:, cqu_fechaingreso= :cqu_fechaingreso:, cqu_barrio= :cqu_barrio:, cqu_fechacumplido= :cqu_fechacumplido:, cqu_quienemail= :cqu_quienemail:, cqu_quiencelular= :cqu_quiencelular:, cqu_actitud= :cqu_actitud: WHERE cqu_code=:cqu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO cal_queue(cqu_code, cqu_numero, cqu_anio, cqu_derivacion, cqu_nroreit, cqu_estado, use_code, cqu_in_tstamp, cqu_out_tstamp, cqu_result, cqu_note, cqu_quien, cqu_quientelfax, cqu_prestacion, cqu_detalle, cqu_calle, cqu_altura, cqu_fechaingreso, cqu_barrio, cqu_fechacumplido, cqu_quienemail, cqu_quiencelular, cqu_actitud) VALUES (:cqu_code:, :cqu_numero:, :cqu_anio:, :cqu_derivacion:, :cqu_nroreit:, :cqu_estado:, :use_code:, :cqu_in_tstamp:, :cqu_out_tstamp:, :cqu_result:, :cqu_note:, :cqu_quien:, :cqu_quientelfax:, :cqu_prestacion:, :cqu_detalle:, :cqu_calle:, :cqu_altura:, :cqu_fechaingreso:, :cqu_barrio:, :cqu_fechacumplido:, :cqu_quienemail:, :cqu_quiencelular:, :cqu_actitud:)";
        $this->m_savedb_delete_sql = "DELETE FROM cal_queue WHERE cqu_code=:cqu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM cal_queue";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM cal_queue ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ccal_queue_small
}
?>
