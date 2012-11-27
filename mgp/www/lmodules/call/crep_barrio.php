<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('crep_barrio') ) {
class crep_barrio extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "crep_barrio";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['fecha_inicio'] = new CField(Array("Name"=>"fecha_inicio", "Label"=>"Fecha inicio", "Type"=>"datetime", "Order"=>1, "Presentation"=>"DATE"));
        $this->m_fields['fecha_fin'] = new CField(Array("Name"=>"fecha_fin", "Label"=>"Fecha fin", "Type"=>"datetime", "Order"=>2, "Presentation"=>"DATE"));
        $this->m_fields['barrio'] = new CField(Array("Name"=>"barrio", "Label"=>"Barrio", "Size"=>100, "IsForDB"=>true, "Order"=>3));
        $this->m_fields['totales'] = new CField(Array("Name"=>"totales", "Label"=>"Totales", "Type"=>"int", "IsForDB"=>true, "Order"=>4, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['conforme'] = new CField(Array("Name"=>"conforme", "Label"=>"Conforme", "Type"=>"int", "IsForDB"=>true, "Order"=>5, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['noconforme'] = new CField(Array("Name"=>"noconforme", "Label"=>"No Conforme", "Type"=>"int", "IsForDB"=>true, "Order"=>6, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['nosabe'] = new CField(Array("Name"=>"nosabe", "Label"=>"No Sabe", "Type"=>"int", "IsForDB"=>true, "Order"=>7, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['positiva'] = new CField(Array("Name"=>"positiva", "Label"=>"Positiva", "Type"=>"int", "IsForDB"=>true, "Order"=>8, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['negativa'] = new CField(Array("Name"=>"negativa", "Label"=>"Negativa", "Type"=>"int", "IsForDB"=>true, "Order"=>9, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['neutral'] = new CField(Array("Name"=>"neutral", "Label"=>"Neutral", "Type"=>"int", "IsForDB"=>true, "Order"=>10, "Presentation"=>"INT", "total"=>true));
        $this->m_fields['tmp_graph'] = new CField(Array("Name"=>"tmp_graph", "Type"=>"int", "Order"=>11));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT barrio, totales, conforme, noconforme, nosabe, positiva, negativa, neutral FROM rep_barrio ";
        $this->m_objfactory_sql = "SELECT   qu.cqu_barrio as barrio,  count(*) as totales,   sum(if(qu.cqu_resultado in ('CONFORME',''),1,0)) as conforme,  sum(if(qu.cqu_resultado='NO CONFORME',1,0)) as noconforme,    sum(if(qu.cqu_resultado='NO SABE',1,0)) as nosabe,  sum(if(qu.cqu_actitud='POSITIVA',1,0)) as positiva,  sum(if(qu.cqu_actitud='NEGATIVA',1,0)) as negativa,  sum(if(qu.cqu_actitud in ('NEUTRAL',''),1,0)) as neutral  FROM cal_queue qu  WHERE qu.cqu_estado='COMPLETADA'   and (cqu_egreso_fecha between STR_TO_DATE('#fecha_inicio#','%d/%m/%Y %k:%i:%s') and STR_TO_DATE('#fecha_fin#','%d/%m/%Y %k:%i:%s') or ('#fecha_inicio#'='' and '#fecha_fin#'='')) group by qu.cqu_barrio";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE rep_barrio SET barrio= :barrio:, totales= :totales:, conforme= :conforme:, noconforme= :noconforme:, nosabe= :nosabe:, positiva= :positiva:, negativa= :negativa:, neutral= :neutral:";
        $this->m_savedb_insert_sql = "INSERT INTO rep_barrio(barrio, totales, conforme, noconforme, nosabe, positiva, negativa, neutral) VALUES (:barrio:, :totales:, :conforme:, :noconforme:, :nosabe:, :positiva:, :negativa:, :neutral:)";
        $this->m_savedb_delete_sql = "DELETE FROM rep_barrio";
        $this->m_savedb_purge_sql = "DELETE FROM rep_barrio";
        $this->m_savedb_total_sql = " ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase crep_barrio
}
?>
