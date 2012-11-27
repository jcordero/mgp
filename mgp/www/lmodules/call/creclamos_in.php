<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:19:13
 */
include_once "common/cobjbase.php";
if( !class_exists('creclamos_in') ) {
class creclamos_in extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "creclamos_in";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['prestacion'] = new CField(Array('Name'=>'prestacion', 'Size'=>20, 'Order'=>1));
        $this->m_fields['observacion'] = new CField(Array('Name'=>'observacion', 'Size'=>2000, 'Order'=>2));
        $this->m_fields['barrio'] = new CField(Array('Name'=>'barrio', 'Size'=>50, 'Order'=>3));
        $this->m_fields['cgpc'] = new CField(Array('Name'=>'cgpc', 'Size'=>50, 'Order'=>4));
        $this->m_fields['zona_ilum'] = new CField(Array('Name'=>'zona_ilum', 'Size'=>50, 'Order'=>5));
        $this->m_fields['zona_reco'] = new CField(Array('Name'=>'zona_reco', 'Size'=>50, 'Order'=>6));
        $this->m_fields['nombre'] = new CField(Array('Name'=>'nombre', 'Size'=>100, 'Order'=>7));
        $this->m_fields['tipodoc'] = new CField(Array('Name'=>'tipodoc', 'Size'=>3, 'Order'=>8));
        $this->m_fields['nrodoc'] = new CField(Array('Name'=>'nrodoc', 'Size'=>20, 'Order'=>9));
        $this->m_fields['telfax'] = new CField(Array('Name'=>'telfax', 'Size'=>100, 'Order'=>10));
        $this->m_fields['domcod'] = new CField(Array('Name'=>'domcod', 'Type'=>'int', 'Order'=>11));
        $this->m_fields['domnro'] = new CField(Array('Name'=>'domnro', 'Type'=>'int', 'Order'=>12));
        $this->m_fields['dompiso'] = new CField(Array('Name'=>'dompiso', 'Size'=>5, 'Order'=>13));
        $this->m_fields['domdpto'] = new CField(Array('Name'=>'domdpto', 'Size'=>5, 'Order'=>14));
        $this->m_fields['codpostal'] = new CField(Array('Name'=>'codpostal', 'Size'=>10, 'Order'=>15));
        $this->m_fields['email'] = new CField(Array('Name'=>'email', 'Size'=>100, 'Order'=>16));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['cfile']='cfile';
        $this->m_childs['cfile']=array();


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM rec_transaction ";
        $this->m_objfactory_sql = "SELECT  FROM rec_transaction";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE rec_transaction SET ";
        $this->m_savedb_insert_sql = "INSERT INTO rec_transaction() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM rec_transaction";
        $this->m_savedb_purge_sql = "DELETE FROM rec_transaction";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM rec_transaction ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclamos_in
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
        $this->m_fileid = "reclamos";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['std_code'] = new CField(Array('Name'=>'std_code', 'Label'=>'Codigo remito', 'Size'=>50, 'Order'=>1));
        $this->m_fields['doc_code'] = new CField(Array('Name'=>'doc_code', 'Label'=>'Codigo', 'Size'=>50, 'Order'=>2));
        $this->m_fields['doc_name'] = new CField(Array('Name'=>'doc_name', 'Label'=>'Archivo', 'Size'=>200, 'Order'=>3));
        $this->m_fields['doc_tstamp'] = new CField(Array('Name'=>'doc_tstamp', 'Label'=>'Fecha', 'Type'=>'DATETIME', 'Order'=>4));
        $this->m_fields['doc_mime'] = new CField(Array('Name'=>'doc_mime', 'Label'=>'Clase', 'Size'=>50, 'Order'=>5));
        $this->m_fields['doc_size'] = new CField(Array('Name'=>'doc_size', 'Label'=>'Tamaño', 'Type'=>'int', 'Order'=>6));
        $this->m_fields['doc_storage'] = new CField(Array('Name'=>'doc_storage', 'Label'=>'URI', 'Size'=>200, 'Order'=>7));
        $this->m_fields['doc_note'] = new CField(Array('Name'=>'doc_note', 'Label'=>'Nota', 'Size'=>200, 'Order'=>8));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase cfile
}
?>
