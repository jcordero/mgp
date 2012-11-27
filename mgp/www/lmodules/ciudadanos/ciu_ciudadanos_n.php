<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('ciu_ciudadanos_n') ) {
class ciu_ciudadanos_n extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ciu_ciudadanos_n";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false));
        $this->m_fields['ciu_nombres'] = new CField(Array("Name"=>"ciu_nombres", "Size"=>50, "IsForDB"=>true, "Order"=>102));
        $this->m_fields['ciu_apellido'] = new CField(Array("Name"=>"ciu_apellido", "Size"=>50, "IsForDB"=>true, "Order"=>103));
        $this->m_fields['ciu_sexo'] = new CField(Array("Name"=>"ciu_sexo", "Size"=>15, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['ciu_nacimiento'] = new CField(Array("Name"=>"ciu_nacimiento", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['ciu_doc_nro'] = new CField(Array("Name"=>"ciu_doc_nro", "Size"=>20, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['ciu_email'] = new CField(Array("Name"=>"ciu_email", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['ciu_tel_fijo'] = new CField(Array("Name"=>"ciu_tel_fijo", "Size"=>20, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['ciu_tel_movil'] = new CField(Array("Name"=>"ciu_tel_movil", "Size"=>20, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['ciu_horario_cont'] = new CField(Array("Name"=>"ciu_horario_cont", "Size"=>50, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['ciu_no_llamar'] = new CField(Array("Name"=>"ciu_no_llamar", "Size"=>4, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['ciu_no_email'] = new CField(Array("Name"=>"ciu_no_email", "Size"=>4, "IsForDB"=>true, "Order"=>112));
        $this->m_fields['ciu_dir_calle'] = new CField(Array("Name"=>"ciu_dir_calle", "Size"=>50, "IsForDB"=>true, "Order"=>113));
        $this->m_fields['ciu_dir_nro'] = new CField(Array("Name"=>"ciu_dir_nro", "Type"=>"int", "IsForDB"=>true, "Order"=>114));
        $this->m_fields['ciu_dir_piso'] = new CField(Array("Name"=>"ciu_dir_piso", "Size"=>5, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['ciu_dir_dpto'] = new CField(Array("Name"=>"ciu_dir_dpto", "Size"=>5, "IsForDB"=>true, "Order"=>116));
        $this->m_fields['ciu_barrio'] = new CField(Array("Name"=>"ciu_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>117));
        $this->m_fields['ciu_localidad'] = new CField(Array("Name"=>"ciu_localidad", "Size"=>50, "IsForDB"=>true, "Order"=>118));
        $this->m_fields['ciu_provincia'] = new CField(Array("Name"=>"ciu_provincia", "Size"=>50, "IsForDB"=>true, "Order"=>119));
        $this->m_fields['ciu_pais'] = new CField(Array("Name"=>"ciu_pais", "Size"=>50, "IsForDB"=>true, "Order"=>120));
        $this->m_fields['ciu_cod_postal'] = new CField(Array("Name"=>"ciu_cod_postal", "Size"=>6, "IsForDB"=>true, "Order"=>121));
        $this->m_fields['ciu_cgpc'] = new CField(Array("Name"=>"ciu_cgpc", "Size"=>10, "IsForDB"=>true, "Order"=>122));
        $this->m_fields['ciu_coord_x'] = new CField(Array("Name"=>"ciu_coord_x", "Type"=>"float", "IsForDB"=>true, "Order"=>123));
        $this->m_fields['ciu_coord_y'] = new CField(Array("Name"=>"ciu_coord_y", "Type"=>"float", "IsForDB"=>true, "Order"=>124));
        $this->m_fields['ciu_trabaja'] = new CField(Array("Name"=>"ciu_trabaja", "Size"=>4, "IsForDB"=>true, "Order"=>125));
        $this->m_fields['ciu_nivel_estudio'] = new CField(Array("Name"=>"ciu_nivel_estudio", "Size"=>20, "IsForDB"=>true, "Order"=>126));
        $this->m_fields['ciu_profesion'] = new CField(Array("Name"=>"ciu_profesion", "Size"=>50, "IsForDB"=>true, "Order"=>127));
        $this->m_fields['ciu_ultimo_acceso'] = new CField(Array("Name"=>"ciu_ultimo_acceso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>128));
        $this->m_fields['ciu_canal_ingreso'] = new CField(Array("Name"=>"ciu_canal_ingreso", "Size"=>20, "IsForDB"=>true, "Order"=>129));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>130));
        $this->m_fields['ciu_estado'] = new CField(Array("Name"=>"ciu_estado", "Size"=>30, "IsForDB"=>true, "Order"=>131));
        $this->m_fields['ciu_tstamp'] = new CField(Array("Name"=>"ciu_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>132));
        $this->m_fields['ciu_usuario'] = new CField(Array("Name"=>"ciu_usuario", "Size"=>50, "IsForDB"=>true, "Order"=>133));
        $this->m_fields['ciu_clave'] = new CField(Array("Name"=>"ciu_clave", "Size"=>50, "IsForDB"=>true, "Order"=>134));
        $this->m_fields['ciu_tipo_persona'] = new CField(Array("Name"=>"ciu_tipo_persona", "Size"=>20, "IsForDB"=>true, "Order"=>135));
        $this->m_fields['ciu_razon_social'] = new CField(Array("Name"=>"ciu_razon_social", "Size"=>100, "IsForDB"=>true, "Order"=>136));
        $this->m_fields['ciu_nacionalidad'] = new CField(Array("Name"=>"ciu_nacionalidad", "Size"=>100, "IsForDB"=>true, "Order"=>137));
        $this->m_fields['tmp_mapa'] = new CField(Array("Name"=>"tmp_mapa", "Size"=>50, "Order"=>38));
        $this->m_fields['tmp_cod_calle'] = new CField(Array("Name"=>"tmp_cod_calle", "Type"=>"int", "Order"=>39));

        //--Contenedores de Clases dependientes
        $this->m_childs_classname['ciu_historial_contactos']='ciu_historial_contactos';
        $this->m_childs['ciu_historial_contactos']=array();
        $this->m_childs_keys['ciu_historial_contactos']['ciu_code']='ciu_code';


        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT ciu_code, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_doc_nro, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, use_code, ciu_estado, ciu_tstamp, ciu_usuario, ciu_clave, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad FROM ciu_ciudadanos  WHERE ciu_code= :ciu_code_key:";
        $this->m_objfactory_sql = "SELECT ciu_code, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_doc_nro, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, use_code, ciu_estado, ciu_tstamp, ciu_usuario, ciu_clave, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad FROM ciu_ciudadanos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE ciu_ciudadanos SET ciu_code= :ciu_code:, ciu_nombres= :ciu_nombres:, ciu_apellido= :ciu_apellido:, ciu_sexo= :ciu_sexo:, ciu_nacimiento= :ciu_nacimiento:, ciu_doc_nro= :ciu_doc_nro:, ciu_email= :ciu_email:, ciu_tel_fijo= :ciu_tel_fijo:, ciu_tel_movil= :ciu_tel_movil:, ciu_horario_cont= :ciu_horario_cont:, ciu_no_llamar= :ciu_no_llamar:, ciu_no_email= :ciu_no_email:, ciu_dir_calle= :ciu_dir_calle:, ciu_dir_nro= :ciu_dir_nro:, ciu_dir_piso= :ciu_dir_piso:, ciu_dir_dpto= :ciu_dir_dpto:, ciu_barrio= :ciu_barrio:, ciu_localidad= :ciu_localidad:, ciu_provincia= :ciu_provincia:, ciu_pais= :ciu_pais:, ciu_cod_postal= :ciu_cod_postal:, ciu_cgpc= :ciu_cgpc:, ciu_coord_x= :ciu_coord_x:, ciu_coord_y= :ciu_coord_y:, ciu_trabaja= :ciu_trabaja:, ciu_nivel_estudio= :ciu_nivel_estudio:, ciu_profesion= :ciu_profesion:, ciu_ultimo_acceso= :ciu_ultimo_acceso:, ciu_canal_ingreso= :ciu_canal_ingreso:, use_code= :use_code:, ciu_estado= :ciu_estado:, ciu_tstamp= :ciu_tstamp:, ciu_usuario= :ciu_usuario:, ciu_clave= :ciu_clave:, ciu_tipo_persona= :ciu_tipo_persona:, ciu_razon_social= :ciu_razon_social:, ciu_nacionalidad= :ciu_nacionalidad: WHERE ciu_code=:ciu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO ciu_ciudadanos(ciu_code, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_doc_nro, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, use_code, ciu_estado, ciu_tstamp, ciu_usuario, ciu_clave, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad) VALUES (:ciu_code:, :ciu_nombres:, :ciu_apellido:, :ciu_sexo:, :ciu_nacimiento:, :ciu_doc_nro:, :ciu_email:, :ciu_tel_fijo:, :ciu_tel_movil:, :ciu_horario_cont:, :ciu_no_llamar:, :ciu_no_email:, :ciu_dir_calle:, :ciu_dir_nro:, :ciu_dir_piso:, :ciu_dir_dpto:, :ciu_barrio:, :ciu_localidad:, :ciu_provincia:, :ciu_pais:, :ciu_cod_postal:, :ciu_cgpc:, :ciu_coord_x:, :ciu_coord_y:, :ciu_trabaja:, :ciu_nivel_estudio:, :ciu_profesion:, :ciu_ultimo_acceso:, :ciu_canal_ingreso:, :use_code:, :ciu_estado:, :ciu_tstamp:, :ciu_usuario:, :ciu_clave:, :ciu_tipo_persona:, :ciu_razon_social:, :ciu_nacionalidad:)";
        $this->m_savedb_delete_sql = "DELETE FROM ciu_ciudadanos WHERE ciu_code=:ciu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM ciu_ciudadanos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM ciu_ciudadanos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ciu_ciudadanos_n
}
?>
 
<?php /* Modelo de datos ---------------------------------------- */
if( !class_exists('ciu_historial_contactos') ) {
class ciu_historial_contactos extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "ciu_historial_contactos";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['chi_code'] = new CField(Array("Name"=>"chi_code", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101, "IsNullable"=>false, "Sequence"=>"ciu_historial_contactos"));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Type"=>"int", "IsForDB"=>true, "Order"=>102, "IsNullable"=>false));
        $this->m_fields['cse_code'] = new CField(Array("Name"=>"cse_code", "Type"=>"int", "IsForDB"=>true, "Order"=>103, "IsNullable"=>false));
        $this->m_fields['chi_fecha'] = new CField(Array("Name"=>"chi_fecha", "Type"=>"datetime", "IsForDB"=>true, "Order"=>104));
        $this->m_fields['chi_motivo'] = new CField(Array("Name"=>"chi_motivo", "Size"=>100, "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['chi_canal'] = new CField(Array("Name"=>"chi_canal", "Size"=>50, "IsForDB"=>true, "Order"=>107));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal FROM ciu_historial_contactos  WHERE chi_code= :chi_code_key:";
        $this->m_objfactory_sql = "SELECT chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal FROM ciu_historial_contactos";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE ciu_historial_contactos SET chi_code= :chi_code:, ciu_code= :ciu_code:, cse_code= :cse_code:, chi_fecha= :chi_fecha:, chi_motivo= :chi_motivo:, use_code= :use_code:, chi_canal= :chi_canal: WHERE chi_code=:chi_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO ciu_historial_contactos(chi_code, ciu_code, cse_code, chi_fecha, chi_motivo, use_code, chi_canal) VALUES (:chi_code:, :ciu_code:, :cse_code:, :chi_fecha:, :chi_motivo:, :use_code:, :chi_canal:)";
        $this->m_savedb_delete_sql = "DELETE FROM ciu_historial_contactos WHERE chi_code=:chi_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM ciu_historial_contactos";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM ciu_historial_contactos ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase ciu_historial_contactos
}
?>
