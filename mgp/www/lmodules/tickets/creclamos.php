<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
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
        $this->m_connect = "reclamos_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tran_id'] = new CField(Array("Name"=>"tran_id", "Size"=>50, "Order"=>1));
        $this->m_fields['nota'] = new CField(Array("Name"=>"nota", "Size"=>300, "Order"=>2));

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


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM reclamos ";
        $this->m_objfactory_sql = "SELECT  FROM reclamos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclamos SET ";
        $this->m_savedb_insert_sql = "INSERT INTO reclamos() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM reclamos";
        $this->m_savedb_purge_sql = "DELETE FROM reclamos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM reclamos ";
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
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM reclamantes ";
        $this->m_objfactory_sql = "SELECT  FROM reclamantes";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclamantes SET ";
        $this->m_savedb_insert_sql = "INSERT INTO reclamantes() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM reclamantes";
        $this->m_savedb_purge_sql = "DELETE FROM reclamantes";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM reclamantes ";
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
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT  FROM reclaestados ";
        $this->m_objfactory_sql = "SELECT  FROM reclaestados";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclaestados SET ";
        $this->m_savedb_insert_sql = "INSERT INTO reclaestados() VALUES ()";
        $this->m_savedb_delete_sql = "DELETE FROM reclaestados";
        $this->m_savedb_purge_sql = "DELETE FROM reclaestados";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM reclaestados ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase creclaestados
}
?>
