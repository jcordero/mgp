<?php
/* Clase generada automaticamente
 * Compilador PHPClass Version 2.6.18 (01/MAR/2012) UTF-8 / http://www.commsys.com.ar
 */
include_once "common/cobjbase.php";
if( !class_exists('rep1') ) {
class rep1 extends cobjbase {

    function __construct() {
        parent::__construct();
        $this->m_classname = "rep1";
        $this->m_savechildsfirst = false;
        $this->m_classtype = "";
        $this->m_fileid = "";
        $this->m_connect = "primary_db";
        $this->m_deleted_mark = "";

        //Extensiones a esta clase

        //-- CField( Array(Parametros) )
        $this->m_fields['tic_nro'] = new CField(Array("Name"=>"tic_nro", "Type"=>"int", "IsPK"=>true, "IsForDB"=>true, "Order"=>101));
        $this->m_fields['tic_numero'] = new CField(Array("Name"=>"tic_numero", "Type"=>"int", "IsForDB"=>true, "Order"=>102));
        $this->m_fields['tic_anio'] = new CField(Array("Name"=>"tic_anio", "Type"=>"int", "IsForDB"=>true, "Order"=>103));
        $this->m_fields['tic_tipo'] = new CField(Array("Name"=>"tic_tipo", "Size"=>50, "IsForDB"=>true, "Order"=>104));
        $this->m_fields['tic_tstamp_in'] = new CField(Array("Name"=>"tic_tstamp_in", "Type"=>"datetime", "IsForDB"=>true, "Order"=>105));
        $this->m_fields['use_code'] = new CField(Array("Name"=>"use_code", "Size"=>50, "IsForDB"=>true, "Order"=>106));
        $this->m_fields['tic_nota_in'] = new CField(Array("Name"=>"tic_nota_in", "Size"=>50, "IsForDB"=>true, "Order"=>107));
        $this->m_fields['tic_estado'] = new CField(Array("Name"=>"tic_estado", "Size"=>50, "IsForDB"=>true, "Order"=>108));
        $this->m_fields['tic_lugar'] = new CField(Array("Name"=>"tic_lugar", "Size"=>50, "IsForDB"=>true, "Order"=>109));
        $this->m_fields['tic_barrio'] = new CField(Array("Name"=>"tic_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>110));
        $this->m_fields['tic_cgpc'] = new CField(Array("Name"=>"tic_cgpc", "Size"=>50, "IsForDB"=>true, "Order"=>111));
        $this->m_fields['tic_coordx'] = new CField(Array("Name"=>"tic_coordx", "Type"=>"double", "IsForDB"=>true, "Order"=>112));
        $this->m_fields['tic_coordy'] = new CField(Array("Name"=>"tic_coordy", "Type"=>"double", "IsForDB"=>true, "Order"=>113));
        $this->m_fields['tic_id_cuadra'] = new CField(Array("Name"=>"tic_id_cuadra", "Size"=>50, "IsForDB"=>true, "Order"=>114));
        $this->m_fields['tic_forms'] = new CField(Array("Name"=>"tic_forms", "Size"=>50, "IsForDB"=>true, "Order"=>115));
        $this->m_fields['tic_canal'] = new CField(Array("Name"=>"tic_canal", "Size"=>50, "IsForDB"=>true, "Order"=>116));
        $this->m_fields['tic_tstamp_plazo'] = new CField(Array("Name"=>"tic_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>117));
        $this->m_fields['tic_tstamp_cierre'] = new CField(Array("Name"=>"tic_tstamp_cierre", "Type"=>"datetime", "IsForDB"=>true, "Order"=>118));
        $this->m_fields['tic_calle_nombre'] = new CField(Array("Name"=>"tic_calle_nombre", "Size"=>50, "IsForDB"=>true, "Order"=>119));
        $this->m_fields['tic_nro_puerta'] = new CField(Array("Name"=>"tic_nro_puerta", "Size"=>50, "IsForDB"=>true, "Order"=>120));
        $this->m_fields['tic_nro_asociado'] = new CField(Array("Name"=>"tic_nro_asociado", "Size"=>50, "IsForDB"=>true, "Order"=>121));
        $this->m_fields['tic_identificador'] = new CField(Array("Name"=>"tic_identificador", "Size"=>50, "IsForDB"=>true, "Order"=>122));
        $this->m_fields['ciu_code'] = new CField(Array("Name"=>"ciu_code", "Size"=>50, "IsPK"=>true, "IsForDB"=>true, "Order"=>123));
        $this->m_fields['ttc_tstamp'] = new CField(Array("Name"=>"ttc_tstamp", "Type"=>"datetime", "IsForDB"=>true, "Order"=>124));
        $this->m_fields['ciu_nombres'] = new CField(Array("Name"=>"ciu_nombres", "Size"=>50, "IsForDB"=>true, "Order"=>125));
        $this->m_fields['ciu_apellido'] = new CField(Array("Name"=>"ciu_apellido", "Size"=>50, "IsForDB"=>true, "Order"=>126));
        $this->m_fields['ciu_sexo'] = new CField(Array("Name"=>"ciu_sexo", "Size"=>50, "IsForDB"=>true, "Order"=>127));
        $this->m_fields['ciu_nacimiento'] = new CField(Array("Name"=>"ciu_nacimiento", "Size"=>50, "IsForDB"=>true, "Order"=>128));
        $this->m_fields['ciu_email'] = new CField(Array("Name"=>"ciu_email", "Size"=>50, "IsForDB"=>true, "Order"=>129));
        $this->m_fields['ciu_tel_fijo'] = new CField(Array("Name"=>"ciu_tel_fijo", "Size"=>50, "IsForDB"=>true, "Order"=>130));
        $this->m_fields['ciu_tel_movil'] = new CField(Array("Name"=>"ciu_tel_movil", "Size"=>50, "IsForDB"=>true, "Order"=>131));
        $this->m_fields['ciu_horario_cont'] = new CField(Array("Name"=>"ciu_horario_cont", "Size"=>50, "IsForDB"=>true, "Order"=>132));
        $this->m_fields['ciu_no_llamar'] = new CField(Array("Name"=>"ciu_no_llamar", "Size"=>50, "IsForDB"=>true, "Order"=>133));
        $this->m_fields['ciu_no_email'] = new CField(Array("Name"=>"ciu_no_email", "Size"=>50, "IsForDB"=>true, "Order"=>134));
        $this->m_fields['ciu_dir_calle'] = new CField(Array("Name"=>"ciu_dir_calle", "Size"=>50, "IsForDB"=>true, "Order"=>135));
        $this->m_fields['ciu_dir_nro'] = new CField(Array("Name"=>"ciu_dir_nro", "Size"=>50, "IsForDB"=>true, "Order"=>136));
        $this->m_fields['ciu_dir_piso'] = new CField(Array("Name"=>"ciu_dir_piso", "Size"=>50, "IsForDB"=>true, "Order"=>137));
        $this->m_fields['ciu_dir_dpto'] = new CField(Array("Name"=>"ciu_dir_dpto", "Size"=>50, "IsForDB"=>true, "Order"=>138));
        $this->m_fields['ciu_barrio'] = new CField(Array("Name"=>"ciu_barrio", "Size"=>50, "IsForDB"=>true, "Order"=>139));
        $this->m_fields['ciu_localidad'] = new CField(Array("Name"=>"ciu_localidad", "Size"=>50, "IsForDB"=>true, "Order"=>140));
        $this->m_fields['ciu_provincia'] = new CField(Array("Name"=>"ciu_provincia", "Size"=>50, "IsForDB"=>true, "Order"=>141));
        $this->m_fields['ciu_pais'] = new CField(Array("Name"=>"ciu_pais", "Size"=>50, "IsForDB"=>true, "Order"=>142));
        $this->m_fields['ciu_cod_postal'] = new CField(Array("Name"=>"ciu_cod_postal", "Size"=>50, "IsForDB"=>true, "Order"=>143));
        $this->m_fields['ciu_cgpc'] = new CField(Array("Name"=>"ciu_cgpc", "Size"=>50, "IsForDB"=>true, "Order"=>144));
        $this->m_fields['ciu_coord_x'] = new CField(Array("Name"=>"ciu_coord_x", "Type"=>"double", "IsForDB"=>true, "Order"=>145));
        $this->m_fields['ciu_coord_y'] = new CField(Array("Name"=>"ciu_coord_y", "Type"=>"double", "IsForDB"=>true, "Order"=>146));
        $this->m_fields['ciu_trabaja'] = new CField(Array("Name"=>"ciu_trabaja", "Size"=>50, "IsForDB"=>true, "Order"=>147));
        $this->m_fields['ciu_nivel_estudio'] = new CField(Array("Name"=>"ciu_nivel_estudio", "Size"=>50, "IsForDB"=>true, "Order"=>148));
        $this->m_fields['ciu_profesion'] = new CField(Array("Name"=>"ciu_profesion", "Size"=>50, "IsForDB"=>true, "Order"=>149));
        $this->m_fields['ciu_ultimo_acceso'] = new CField(Array("Name"=>"ciu_ultimo_acceso", "Type"=>"datetime", "IsForDB"=>true, "Order"=>150));
        $this->m_fields['ciu_canal_ingreso'] = new CField(Array("Name"=>"ciu_canal_ingreso", "Size"=>50, "IsForDB"=>true, "Order"=>151));
        $this->m_fields['ciu_estado'] = new CField(Array("Name"=>"ciu_estado", "Size"=>50, "IsForDB"=>true, "Order"=>152));
        $this->m_fields['ciu_tipo_persona'] = new CField(Array("Name"=>"ciu_tipo_persona", "Size"=>50, "IsForDB"=>true, "Order"=>153));
        $this->m_fields['ciu_razon_social'] = new CField(Array("Name"=>"ciu_razon_social", "Size"=>50, "IsForDB"=>true, "Order"=>154));
        $this->m_fields['ciu_nacionalidad'] = new CField(Array("Name"=>"ciu_nacionalidad", "Size"=>50, "IsForDB"=>true, "Order"=>155));
        $this->m_fields['tpr_code'] = new CField(Array("Name"=>"tpr_code", "Size"=>50, "IsForDB"=>true, "Order"=>156));
        $this->m_fields['tru_code'] = new CField(Array("Name"=>"tru_code", "Type"=>"int", "IsForDB"=>true, "Order"=>157));
        $this->m_fields['ttp_cuestionario'] = new CField(Array("Name"=>"ttp_cuestionario", "Size"=>50, "IsForDB"=>true, "Order"=>158));
        $this->m_fields['ttp_estado'] = new CField(Array("Name"=>"ttp_estado", "Size"=>50, "IsForDB"=>true, "Order"=>159));
        $this->m_fields['ttp_prioridad'] = new CField(Array("Name"=>"ttp_prioridad", "Size"=>50, "IsForDB"=>true, "Order"=>160));
        $this->m_fields['ttp_tstamp_plazo'] = new CField(Array("Name"=>"ttp_tstamp_plazo", "Type"=>"datetime", "IsForDB"=>true, "Order"=>161));
        $this->m_fields['ttp_alerta'] = new CField(Array("Name"=>"ttp_alerta", "Size"=>50, "IsForDB"=>true, "Order"=>162));
        $this->m_fields['tpr_tipo'] = new CField(Array("Name"=>"tpr_tipo", "Size"=>50, "IsForDB"=>true, "Order"=>163));
        $this->m_fields['tpr_detalle'] = new CField(Array("Name"=>"tpr_detalle", "Size"=>50, "IsForDB"=>true, "Order"=>164));
        $this->m_fields['tpr_estado'] = new CField(Array("Name"=>"tpr_estado", "Size"=>50, "IsForDB"=>true, "Order"=>165));
        $this->m_fields['tpr_ubicacion'] = new CField(Array("Name"=>"tpr_ubicacion", "Size"=>50, "IsForDB"=>true, "Order"=>166));
        $this->m_fields['tpr_plazo'] = new CField(Array("Name"=>"tpr_plazo", "Size"=>50, "IsForDB"=>true, "Order"=>167));
        $this->m_fields['tpr_show'] = new CField(Array("Name"=>"tpr_show", "Size"=>50, "IsForDB"=>true, "Order"=>168));
        $this->m_fields['tpr_metadata'] = new CField(Array("Name"=>"tpr_metadata", "Size"=>50, "IsForDB"=>true, "Order"=>169));
        $this->m_fields['tpr_keywords'] = new CField(Array("Name"=>"tpr_keywords", "Size"=>50, "IsForDB"=>true, "Order"=>170));
        $this->m_fields['tpr_admin'] = new CField(Array("Name"=>"tpr_admin", "Size"=>50, "IsForDB"=>true, "Order"=>171));
        $this->m_fields['tpr_al_inicio'] = new CField(Array("Name"=>"tpr_al_inicio", "Size"=>50, "IsForDB"=>true, "Order"=>172));
        $this->m_fields['tpr_al_final'] = new CField(Array("Name"=>"tpr_al_final", "Size"=>50, "IsForDB"=>true, "Order"=>173));
        $this->m_fields['tpr_al_vencimiento'] = new CField(Array("Name"=>"tpr_al_vencimiento", "Size"=>50, "IsForDB"=>true, "Order"=>174));
        $this->m_fields['tor_code_inspeccion'] = new CField(Array("Name"=>"tor_code_inspeccion", "Size"=>50, "IsForDB"=>true, "Order"=>175));
        $this->m_fields['tor_code_verificacion'] = new CField(Array("Name"=>"tor_code_verificacion", "Size"=>50, "IsForDB"=>true, "Order"=>176));
        $this->m_fields['tpr_asociar_radio'] = new CField(Array("Name"=>"tpr_asociar_radio", "Size"=>50, "IsForDB"=>true, "Order"=>177));

        //--Contenedores de Clases dependientes
        // No hay clases dependientes

        //Consultas particulares a la base de datos
        $this->m_loaddb_sql = "SELECT tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, ciu_code, ttc_tstamp, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, ciu_estado, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tpr_tipo, tpr_detalle, tpr_estado, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio FROM v_ticket_ciu  WHERE tic_nro= :tic_nro_key: AND ciu_code= :ciu_code_key:";
        $this->m_objfactory_sql = "SELECT tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, ciu_code, ttc_tstamp, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, ciu_estado, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tpr_tipo, tpr_detalle, tpr_estado, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio FROM v_ticket_ciu";
        $this->m_objfactory_suffix_sql = "";
        $this->m_savedb_update_sql = "UPDATE v_ticket_ciu SET tic_nro= :tic_nro:, tic_numero= :tic_numero:, tic_anio= :tic_anio:, tic_tipo= :tic_tipo:, tic_tstamp_in= :tic_tstamp_in:, use_code= :use_code:, tic_nota_in= :tic_nota_in:, tic_estado= :tic_estado:, tic_lugar= :tic_lugar:, tic_barrio= :tic_barrio:, tic_cgpc= :tic_cgpc:, tic_coordx= :tic_coordx:, tic_coordy= :tic_coordy:, tic_id_cuadra= :tic_id_cuadra:, tic_forms= :tic_forms:, tic_canal= :tic_canal:, tic_tstamp_plazo= :tic_tstamp_plazo:, tic_tstamp_cierre= :tic_tstamp_cierre:, tic_calle_nombre= :tic_calle_nombre:, tic_nro_puerta= :tic_nro_puerta:, tic_nro_asociado= :tic_nro_asociado:, tic_identificador= :tic_identificador:, ciu_code= :ciu_code:, ttc_tstamp= :ttc_tstamp:, ciu_nombres= :ciu_nombres:, ciu_apellido= :ciu_apellido:, ciu_sexo= :ciu_sexo:, ciu_nacimiento= :ciu_nacimiento:, ciu_email= :ciu_email:, ciu_tel_fijo= :ciu_tel_fijo:, ciu_tel_movil= :ciu_tel_movil:, ciu_horario_cont= :ciu_horario_cont:, ciu_no_llamar= :ciu_no_llamar:, ciu_no_email= :ciu_no_email:, ciu_dir_calle= :ciu_dir_calle:, ciu_dir_nro= :ciu_dir_nro:, ciu_dir_piso= :ciu_dir_piso:, ciu_dir_dpto= :ciu_dir_dpto:, ciu_barrio= :ciu_barrio:, ciu_localidad= :ciu_localidad:, ciu_provincia= :ciu_provincia:, ciu_pais= :ciu_pais:, ciu_cod_postal= :ciu_cod_postal:, ciu_cgpc= :ciu_cgpc:, ciu_coord_x= :ciu_coord_x:, ciu_coord_y= :ciu_coord_y:, ciu_trabaja= :ciu_trabaja:, ciu_nivel_estudio= :ciu_nivel_estudio:, ciu_profesion= :ciu_profesion:, ciu_ultimo_acceso= :ciu_ultimo_acceso:, ciu_canal_ingreso= :ciu_canal_ingreso:, ciu_estado= :ciu_estado:, ciu_tipo_persona= :ciu_tipo_persona:, ciu_razon_social= :ciu_razon_social:, ciu_nacionalidad= :ciu_nacionalidad:, tpr_code= :tpr_code:, tru_code= :tru_code:, ttp_cuestionario= :ttp_cuestionario:, ttp_estado= :ttp_estado:, ttp_prioridad= :ttp_prioridad:, ttp_tstamp_plazo= :ttp_tstamp_plazo:, ttp_alerta= :ttp_alerta:, tpr_tipo= :tpr_tipo:, tpr_detalle= :tpr_detalle:, tpr_estado= :tpr_estado:, tpr_ubicacion= :tpr_ubicacion:, tpr_plazo= :tpr_plazo:, tpr_show= :tpr_show:, tpr_metadata= :tpr_metadata:, tpr_keywords= :tpr_keywords:, tpr_admin= :tpr_admin:, tpr_al_inicio= :tpr_al_inicio:, tpr_al_final= :tpr_al_final:, tpr_al_vencimiento= :tpr_al_vencimiento:, tor_code_inspeccion= :tor_code_inspeccion:, tor_code_verificacion= :tor_code_verificacion:, tpr_asociar_radio= :tpr_asociar_radio: WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_insert_sql = "INSERT INTO v_ticket_ciu(tic_nro, tic_numero, tic_anio, tic_tipo, tic_tstamp_in, use_code, tic_nota_in, tic_estado, tic_lugar, tic_barrio, tic_cgpc, tic_coordx, tic_coordy, tic_id_cuadra, tic_forms, tic_canal, tic_tstamp_plazo, tic_tstamp_cierre, tic_calle_nombre, tic_nro_puerta, tic_nro_asociado, tic_identificador, ciu_code, ttc_tstamp, ciu_nombres, ciu_apellido, ciu_sexo, ciu_nacimiento, ciu_email, ciu_tel_fijo, ciu_tel_movil, ciu_horario_cont, ciu_no_llamar, ciu_no_email, ciu_dir_calle, ciu_dir_nro, ciu_dir_piso, ciu_dir_dpto, ciu_barrio, ciu_localidad, ciu_provincia, ciu_pais, ciu_cod_postal, ciu_cgpc, ciu_coord_x, ciu_coord_y, ciu_trabaja, ciu_nivel_estudio, ciu_profesion, ciu_ultimo_acceso, ciu_canal_ingreso, ciu_estado, ciu_tipo_persona, ciu_razon_social, ciu_nacionalidad, tpr_code, tru_code, ttp_cuestionario, ttp_estado, ttp_prioridad, ttp_tstamp_plazo, ttp_alerta, tpr_tipo, tpr_detalle, tpr_estado, tpr_ubicacion, tpr_plazo, tpr_show, tpr_metadata, tpr_keywords, tpr_admin, tpr_al_inicio, tpr_al_final, tpr_al_vencimiento, tor_code_inspeccion, tor_code_verificacion, tpr_asociar_radio) VALUES (:tic_nro:, :tic_numero:, :tic_anio:, :tic_tipo:, :tic_tstamp_in:, :use_code:, :tic_nota_in:, :tic_estado:, :tic_lugar:, :tic_barrio:, :tic_cgpc:, :tic_coordx:, :tic_coordy:, :tic_id_cuadra:, :tic_forms:, :tic_canal:, :tic_tstamp_plazo:, :tic_tstamp_cierre:, :tic_calle_nombre:, :tic_nro_puerta:, :tic_nro_asociado:, :tic_identificador:, :ciu_code:, :ttc_tstamp:, :ciu_nombres:, :ciu_apellido:, :ciu_sexo:, :ciu_nacimiento:, :ciu_email:, :ciu_tel_fijo:, :ciu_tel_movil:, :ciu_horario_cont:, :ciu_no_llamar:, :ciu_no_email:, :ciu_dir_calle:, :ciu_dir_nro:, :ciu_dir_piso:, :ciu_dir_dpto:, :ciu_barrio:, :ciu_localidad:, :ciu_provincia:, :ciu_pais:, :ciu_cod_postal:, :ciu_cgpc:, :ciu_coord_x:, :ciu_coord_y:, :ciu_trabaja:, :ciu_nivel_estudio:, :ciu_profesion:, :ciu_ultimo_acceso:, :ciu_canal_ingreso:, :ciu_estado:, :ciu_tipo_persona:, :ciu_razon_social:, :ciu_nacionalidad:, :tpr_code:, :tru_code:, :ttp_cuestionario:, :ttp_estado:, :ttp_prioridad:, :ttp_tstamp_plazo:, :ttp_alerta:, :tpr_tipo:, :tpr_detalle:, :tpr_estado:, :tpr_ubicacion:, :tpr_plazo:, :tpr_show:, :tpr_metadata:, :tpr_keywords:, :tpr_admin:, :tpr_al_inicio:, :tpr_al_final:, :tpr_al_vencimiento:, :tor_code_inspeccion:, :tor_code_verificacion:, :tpr_asociar_radio:)";
        $this->m_savedb_delete_sql = "DELETE FROM v_ticket_ciu WHERE tic_nro=:tic_nro_key: AND ciu_code=:ciu_code_key:";
        $this->m_savedb_purge_sql = "DELETE FROM v_ticket_ciu";
        $this->m_savedb_total_sql = "SELECT COUNT(*) as cant FROM v_ticket_ciu ";
    }

    function __destruct() {
        parent::__destruct();
    }

} //-- Fin clase rep1
}
?>
