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
        $this->m_fields['numero'] = new CField(Array("Name"=>"numero", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['anio'] = new CField(Array("Name"=>"anio", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['derivacion'] = new CField(Array("Name"=>"derivacion", "Size"=>1, "Type"=>"char", "IsPK"=>true, "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['fechaingreso'] = new CField(Array("Name"=>"fechaingreso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['calle'] = new CField(Array("Name"=>"calle", "Type"=>"int", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['callenro'] = new CField(Array("Name"=>"callenro", "Type"=>"int", "IsForDB"=>true, "Order"=>106));
        $this->m_fields['zona'] = new CField(Array("Name"=>"zona", "Type"=>"int", "IsForDB"=>true, "Order"=>107));
        $this->m_fields['prestacion'] = new CField(Array("Name"=>"prestacion", "Size"=>10, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['prestador'] = new CField(Array("Name"=>"prestador", "Type"=>"int", "IsForDB"=>true, "Order"=>109));
        $this->m_fields['orgresponsable'] = new CField(Array("Name"=>"orgresponsable", "Type"=>"int", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['emergencia'] = new CField(Array("Name"=>"emergencia", "Type"=>"int", "IsForDB"=>true, "Order"=>111));
        $this->m_fields['plazo'] = new CField(Array("Name"=>"plazo", "Type"=>"int", "IsForDB"=>true, "Order"=>112));
        $this->m_fields['obs'] = new CField(Array("Name"=>"obs", "Size"=>300, "IsForDB"=>true, "Order"=>113));
        $this->m_fields['i_tipo'] = new CField(Array("Name"=>"i_tipo", "Size"=>4, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['i_zona'] = new CField(Array("Name"=>"i_zona", "Type"=>"int", "IsForDB"=>true, "Order"=>115));
        $this->m_fields['i_nro'] = new CField(Array("Name"=>"i_nro", "Type"=>"int", "IsForDB"=>true, "Order"=>116));
        $this->m_fields['i_anio'] = new CField(Array("Name"=>"i_anio", "Type"=>"int", "IsForDB"=>true, "Order"=>117));
        $this->m_fields['i_idaux'] = new CField(Array("Name"=>"i_idaux", "Type"=>"int", "IsForDB"=>true, "Order"=>118));
        $this->m_fields['i_fecha'] = new CField(Array("Name"=>"i_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>119));
        $this->m_fields['orgreceptor'] = new CField(Array("Name"=>"orgreceptor", "Type"=>"int", "IsForDB"=>true, "Order"=>120));
        $this->m_fields['userid'] = new CField(Array("Name"=>"userid", "Size"=>10, "IsForDB"=>true, "Order"=>121));
        $this->m_fields['formaingreso'] = new CField(Array("Name"=>"formaingreso", "Type"=>"int", "IsForDB"=>true, "Order"=>122));
        $this->m_fields['estado'] = new CField(Array("Name"=>"estado", "Type"=>"int", "IsForDB"=>true, "Order"=>123));
        $this->m_fields['motivo'] = new CField(Array("Name"=>"motivo", "Type"=>"int", "IsForDB"=>true, "Order"=>124));
        $this->m_fields['fechaultestado'] = new CField(Array("Name"=>"fechaultestado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>125));
        $this->m_fields['fechacumplido'] = new CField(Array("Name"=>"fechacumplido", "Type"=>"datetime", "IsForDB"=>true, "Order"=>126));
        $this->m_fields['cantreit'] = new CField(Array("Name"=>"cantreit", "Type"=>"int", "IsForDB"=>true, "Order"=>127));
        $this->m_fields['feultreit'] = new CField(Array("Name"=>"feultreit", "Type"=>"datetime", "IsForDB"=>true, "Order"=>128));
        $this->m_fields['faxeado'] = new CField(Array("Name"=>"faxeado", "Type"=>"int", "IsForDB"=>true, "Order"=>129));
        $this->m_fields['nroremito'] = new CField(Array("Name"=>"nroremito", "Type"=>"int", "IsForDB"=>true, "Order"=>130));
        $this->m_fields['fecnotixlote'] = new CField(Array("Name"=>"fecnotixlote", "Type"=>"datetime", "IsForDB"=>true, "Order"=>131));
        $this->m_fields['emailenviado'] = new CField(Array("Name"=>"emailenviado", "Type"=>"int", "IsForDB"=>true, "Order"=>132));
        $this->m_fields['idpunto'] = new CField(Array("Name"=>"idpunto", "Type"=>"int", "IsForDB"=>true, "Order"=>133));
        $this->m_fields['barrio'] = new CField(Array("Name"=>"barrio", "Size"=>20, "IsForDB"=>true, "Order"=>134));
        $this->m_fields['calificado'] = new CField(Array("Name"=>"calificado", "Type"=>"int", "IsForDB"=>true, "Order"=>135));
        $this->m_fields['feverificado'] = new CField(Array("Name"=>"feverificado", "Type"=>"datetime", "IsForDB"=>true, "Order"=>136));
        $this->m_fields['ext_coordx'] = new CField(Array("Name"=>"ext_coordx", "Type"=>"float", "IsForDB"=>true, "Order"=>137));
        $this->m_fields['ext_coordy'] = new CField(Array("Name"=>"ext_coordy", "Type"=>"float", "IsForDB"=>true, "Order"=>138));
        $this->m_fields['ext_id_cuadra'] = new CField(Array("Name"=>"ext_id_cuadra", "Type"=>"int", "IsForDB"=>true, "Order"=>139));
        $this->m_fields['ext_calle_nombre'] = new CField(Array("Name"=>"ext_calle_nombre", "Size"=>100, "IsForDB"=>true, "Order"=>140));
        $this->m_fields['ext_calle2'] = new CField(Array("Name"=>"ext_calle2", "Type"=>"int", "IsForDB"=>true, "Order"=>141));
        $this->m_fields['ext_calle_nombre2'] = new CField(Array("Name"=>"ext_calle_nombre2", "Size"=>100, "IsForDB"=>true, "Order"=>142));
        $this->m_fields['obsinspeccion'] = new CField(Array("Name"=>"obsinspeccion", "Size"=>1000, "IsForDB"=>true, "Order"=>143));
        $this->m_fields['feinspeccion'] = new CField(Array("Name"=>"feinspeccion", "Type"=>"datetime", "IsForDB"=>true, "Order"=>144));
        $this->m_fields['inspeccionado'] = new CField(Array("Name"=>"inspeccionado", "Type"=>"bit", "IsForDB"=>true, "Order"=>145));
        $this->m_fields['tran_id'] = new CField(Array("Name"=>"tran_id", "Size"=>50, "Order"=>46));
        $this->m_fields['nota'] = new CField(Array("Name"=>"nota", "Size"=>300, "Order"=>47));

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
        $this->m_loaddb_sql = "SELECT numero, anio, derivacion, fechaingreso, calle, callenro, zona, prestacion, prestador, orgresponsable, emergencia, plazo, obs, i_tipo, i_zona, i_nro, i_anio, i_idaux, i_fecha, orgreceptor, userid, formaingreso, estado, motivo, fechaultestado, fechacumplido, cantreit, feultreit, faxeado, nroremito, fecnotixlote, emailenviado, idpunto, barrio, calificado, feverificado, ext_coordx, ext_coordy, ext_id_cuadra, ext_calle_nombre, ext_calle2, ext_calle_nombre2, obsinspeccion, feinspeccion, inspeccionado FROM reclamos  WHERE numero= :numero_key: AND anio= :anio_key: AND derivacion= :derivacion_key:";
        $this->m_objfactory_sql = "SELECT numero, anio, derivacion, fechaingreso, calle, callenro, zona, prestacion, prestador, orgresponsable, emergencia, plazo, obs, i_tipo, i_zona, i_nro, i_anio, i_idaux, i_fecha, orgreceptor, userid, formaingreso, estado, motivo, fechaultestado, fechacumplido, cantreit, feultreit, faxeado, nroremito, fecnotixlote, emailenviado, idpunto, barrio, calificado, feverificado, ext_coordx, ext_coordy, ext_id_cuadra, ext_calle_nombre, ext_calle2, ext_calle_nombre2, obsinspeccion, feinspeccion, inspeccionado FROM reclamos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclamos SET numero= :numero:, anio= :anio:, derivacion= :derivacion:, fechaingreso= :fechaingreso:, calle= :calle:, callenro= :callenro:, zona= :zona:, prestacion= :prestacion:, prestador= :prestador:, orgresponsable= :orgresponsable:, emergencia= :emergencia:, plazo= :plazo:, obs= :obs:, i_tipo= :i_tipo:, i_zona= :i_zona:, i_nro= :i_nro:, i_anio= :i_anio:, i_idaux= :i_idaux:, i_fecha= :i_fecha:, orgreceptor= :orgreceptor:, userid= :userid:, formaingreso= :formaingreso:, estado= :estado:, motivo= :motivo:, fechaultestado= :fechaultestado:, fechacumplido= :fechacumplido:, cantreit= :cantreit:, feultreit= :feultreit:, faxeado= :faxeado:, nroremito= :nroremito:, fecnotixlote= :fecnotixlote:, emailenviado= :emailenviado:, idpunto= :idpunto:, barrio= :barrio:, calificado= :calificado:, feverificado= :feverificado:, ext_coordx= :ext_coordx:, ext_coordy= :ext_coordy:, ext_id_cuadra= :ext_id_cuadra:, ext_calle_nombre= :ext_calle_nombre:, ext_calle2= :ext_calle2:, ext_calle_nombre2= :ext_calle_nombre2:, obsinspeccion= :obsinspeccion:, feinspeccion= :feinspeccion:, inspeccionado= :inspeccionado: WHERE numero=:numero_key: AND anio=:anio_key: AND derivacion=:derivacion_key:";
        $this->m_savedb_insert_sql = "INSERT INTO reclamos(numero, anio, derivacion, fechaingreso, calle, callenro, zona, prestacion, prestador, orgresponsable, emergencia, plazo, obs, i_tipo, i_zona, i_nro, i_anio, i_idaux, i_fecha, orgreceptor, userid, formaingreso, estado, motivo, fechaultestado, fechacumplido, cantreit, feultreit, faxeado, nroremito, fecnotixlote, emailenviado, idpunto, barrio, calificado, feverificado, ext_coordx, ext_coordy, ext_id_cuadra, ext_calle_nombre, ext_calle2, ext_calle_nombre2, obsinspeccion, feinspeccion, inspeccionado) VALUES (:numero:, :anio:, :derivacion:, :fechaingreso:, :calle:, :callenro:, :zona:, :prestacion:, :prestador:, :orgresponsable:, :emergencia:, :plazo:, :obs:, :i_tipo:, :i_zona:, :i_nro:, :i_anio:, :i_idaux:, :i_fecha:, :orgreceptor:, :userid:, :formaingreso:, :estado:, :motivo:, :fechaultestado:, :fechacumplido:, :cantreit:, :feultreit:, :faxeado:, :nroremito:, :fecnotixlote:, :emailenviado:, :idpunto:, :barrio:, :calificado:, :feverificado:, :ext_coordx:, :ext_coordy:, :ext_id_cuadra:, :ext_calle_nombre:, :ext_calle2:, :ext_calle_nombre2:, :obsinspeccion:, :feinspeccion:, :inspeccionado:)";
        $this->m_savedb_delete_sql = "DELETE FROM reclamos WHERE numero=:numero_key: AND anio=:anio_key: AND derivacion=:derivacion_key:";
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
        $this->m_fields['numero'] = new CField(Array("Name"=>"numero", "Type"=>"int", "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['anio'] = new CField(Array("Name"=>"anio", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['nroreit'] = new CField(Array("Name"=>"nroreit", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['fechareit'] = new CField(Array("Name"=>"fechareit", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['quien'] = new CField(Array("Name"=>"quien", "Size"=>30, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['quientipodoc'] = new CField(Array("Name"=>"quientipodoc", "Size"=>3, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['quiennrodoc'] = new CField(Array("Name"=>"quiennrodoc", "Size"=>13, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['quientelfax'] = new CField(Array("Name"=>"quientelfax", "Size"=>100, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['quiendomcod'] = new CField(Array("Name"=>"quiendomcod", "Type"=>"int", "IsForDB"=>true, "Order"=>109));
        $this->m_fields['quiendomnro'] = new CField(Array("Name"=>"quiendomnro", "Type"=>"int", "IsForDB"=>true, "Order"=>110));
        $this->m_fields['quiendompiso'] = new CField(Array("Name"=>"quiendompiso", "Size"=>4, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['quiendomdpto'] = new CField(Array("Name"=>"quiendomdpto", "Size"=>4, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['quiencodpostal'] = new CField(Array("Name"=>"quiencodpostal", "Size"=>8, "IsForDB"=>true, "Order"=>113));
        $this->m_fields['quienemail'] = new CField(Array("Name"=>"quienemail", "Size"=>45, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['emailenviado'] = new CField(Array("Name"=>"emailenviado", "Type"=>"int", "IsForDB"=>true, "Order"=>115));
        $this->m_fields['quienidpunto'] = new CField(Array("Name"=>"quienidpunto", "Type"=>"int", "IsForDB"=>true, "Order"=>116));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT numero, anio, nroreit, fechareit, quien, quientipodoc, quiennrodoc, quientelfax, quiendomcod, quiendomnro, quiendompiso, quiendomdpto, quiencodpostal, quienemail, emailenviado, quienidpunto FROM reclamantes ";
        $this->m_objfactory_sql = "SELECT numero, anio, nroreit, fechareit, quien, quientipodoc, quiennrodoc, quientelfax, quiendomcod, quiendomnro, quiendompiso, quiendomdpto, quiencodpostal, quienemail, emailenviado, quienidpunto FROM reclamantes";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclamantes SET numero= :numero:, anio= :anio:, nroreit= :nroreit:, fechareit= :fechareit:, quien= :quien:, quientipodoc= :quientipodoc:, quiennrodoc= :quiennrodoc:, quientelfax= :quientelfax:, quiendomcod= :quiendomcod:, quiendomnro= :quiendomnro:, quiendompiso= :quiendompiso:, quiendomdpto= :quiendomdpto:, quiencodpostal= :quiencodpostal:, quienemail= :quienemail:, emailenviado= :emailenviado:, quienidpunto= :quienidpunto:";
        $this->m_savedb_insert_sql = "INSERT INTO reclamantes(numero, anio, nroreit, fechareit, quien, quientipodoc, quiennrodoc, quientelfax, quiendomcod, quiendomnro, quiendompiso, quiendomdpto, quiencodpostal, quienemail, emailenviado, quienidpunto) VALUES (:numero:, :anio:, :nroreit:, :fechareit:, :quien:, :quientipodoc:, :quiennrodoc:, :quientelfax:, :quiendomcod:, :quiendomnro:, :quiendompiso:, :quiendomdpto:, :quiencodpostal:, :quienemail:, :emailenviado:, :quienidpunto:)";
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
        $this->m_fields['numero'] = new CField(Array("Name"=>"numero", "Type"=>"int", "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['anio'] = new CField(Array("Name"=>"anio", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['derivacion'] = new CField(Array("Name"=>"derivacion", "Size"=>1, "Type"=>"char", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['estadoorigen'] = new CField(Array("Name"=>"estadoorigen", "Type"=>"int", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['estadodestino'] = new CField(Array("Name"=>"estadodestino", "Type"=>"int", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['userid'] = new CField(Array("Name"=>"userid", "Size"=>10, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['fecha'] = new CField(Array("Name"=>"fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>107, "IsNullable"=>false));
        $this->m_fields['obs'] = new CField(Array("Name"=>"obs", "Size"=>300, "IsForDB"=>true, "Order"=>108));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT numero, anio, derivacion, estadoorigen, estadodestino, userid, fecha, obs FROM reclaestados ";
        $this->m_objfactory_sql = "SELECT numero, anio, derivacion, estadoorigen, estadodestino, userid, fecha, obs FROM reclaestados";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE reclaestados SET numero= :numero:, anio= :anio:, derivacion= :derivacion:, estadoorigen= :estadoorigen:, estadodestino= :estadodestino:, userid= :userid:, fecha= :fecha:, obs= :obs:";
        $this->m_savedb_insert_sql = "INSERT INTO reclaestados(numero, anio, derivacion, estadoorigen, estadodestino, userid, fecha, obs) VALUES (:numero:, :anio:, :derivacion:, :estadoorigen:, :estadodestino:, :userid:, :fecha:, :obs:)";
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
