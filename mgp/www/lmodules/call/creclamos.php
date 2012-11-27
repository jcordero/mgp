<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.1 (15/JUN/2009) UTF-8 / www.CommSys.com.ar
 * build: 2009-06-17 08:19:13
 */
include_once "common/cobjbase.php";
if( !class_exists('creclamos') ) {
class creclamos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "creclamos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tran_id'] = new CField(Array('Name'=>'tran_id', 'Size'=>50, 'Order'=>1));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['creclamantes']='creclamantes';
        $this->m_childs['creclamantes']=array();
        $this->m_childs_keys['creclamantes']['anio']='anio';
        $this->m_childs_keys['creclamantes']['numero']='numero';

        $this->m_childs_classname['creclaestados']='creclaestados';
        $this->m_childs['creclaestados']=array();
        $this->m_childs_keys['creclaestados']['anio']='anio';
        $this->m_childs_keys['creclaestados']['numero']='numero';
        $this->m_childs_keys['creclaestados']['derivacion']='derivacion';

        $this->m_childs_classname['cfile']='cfile';
        $this->m_childs['cfile']=array();


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM v_reclamos ";
        $this->m_objfactory_sql = "SELECT  FROM v_reclamos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_reclamos SET ";
        $this->m_savedb_insert_sql = "INSERT INTO v_reclamos() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM v_reclamos";
        $this->m_savedb_purge_sql = "DELETE FROM v_reclamos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_reclamos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclamos
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('creclamantes') ) {
class creclamantes extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "creclamantes";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM v_reclamantes ";
        $this->m_objfactory_sql = "SELECT  FROM v_reclamantes";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_reclamantes SET ";
        $this->m_savedb_insert_sql = "INSERT INTO v_reclamantes() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM v_reclamantes";
        $this->m_savedb_purge_sql = "DELETE FROM v_reclamantes";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_reclamantes ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclamantes
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('creclaestados') ) {
class creclaestados extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "creclaestados";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM v_reclaestados ";
        $this->m_objfactory_sql = "SELECT  FROM v_reclaestados";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_reclaestados SET ";
        $this->m_savedb_insert_sql = "INSERT INTO v_reclaestados() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM v_reclaestados";
        $this->m_savedb_purge_sql = "DELETE FROM v_reclaestados";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_reclaestados ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclaestados
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
