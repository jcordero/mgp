
create table avi_servers (
  avs_code int not null,
  avs_server_type varchar(30) null,
  avs_host varchar(100) null,
  avs_user varchar(50) null,
  avs_password varchar(50) null,
  avs_account varchar(100) null,
  avs_direction varchar(30) null,
  use_code varchar(50) null,
  avs_status varchar(50) null,
  avs_tstamp datetime null,
  avs_account_name varchar(100) null,
  avs_class varchar(100) null,
  constraint pk_avi_servers primary key clustered (avs_code)
 )


create table avi_entrantes (
  ave_key int not null,
  ave_tstamp datetime null,
  avs_code int null,
  ave_headers varchar(500) null,
  ave_subject varchar(200) null,
  ave_body varchar(8000) null,
  ave_body_alt varchar(8000) null,
  ave_from varchar(100) null,
  ave_status varchar(50) null,
  ave_attachments varchar(5) null,
  avm_key int null,
  constraint pk_avi_entrantes primary key clustered (ave_key)
)


create table avi_eventos (
  ave_code varchar(50) not null,
  cco_code int not null,
  avr_type varchar(50) null,
  avr_status varchar(20) null,
  ave_template varchar(100) null,
  ave_filtro varchar(50) null,
  ave_filtro_valor varchar(50) null,
  ave_filtro2 varchar(50) null,
  ave_filtro2_valor varchar(50) null,
  ave_key int not null,
  constraint pk_avi_eventos primary key clustered (ave_code, cco_code) 
 )


create table avi_mensajes (
  avm_key int not null,
  avm_tstamp datetime null,
  avm_tstamp_send datetime null,
  avm_descr varchar(100) null,
  avm_class varchar(100) null,
  avm_code varchar(100) null,
  avm_email varchar(100) null,
  avm_template varchar(100) null,
  avm_opt varchar(100) null,
  avm_status varchar(100) null,
  avm_intentos int null,
  avm_error varchar(500) null,
  tev_key int null,
  avm_attachments varchar(200) null,
  avs_code int null,
  avm_headers varchar(512) null,
  avm_xid varchar(40) null,
  avm_follow_up varchar(200) null,
  avm_follow_key varchar(200) null,
  avm_body TEXT null,
  constraint pk_avi_mensajes primary key clustered (avm_key)
)


create table cat_value_list (
  vli_code varchar(50) not null,
  vli_name varchar(50) null,
  constraint pk_cat_value_list primary key clustered (vli_code) 
 )


create table cat_value (
  vli_code varchar(50) not null,
  val_value varchar(200) not null,
  val_order int null,
  cas_code varchar(50) null,
  cas_value varchar(200) not null,
  constraint pk_cat_value primary key clustered (vli_code, val_value, cas_value)
)

create table ciu_ciudadanos (
  ciu_code int not null,
  ciu_nombres varchar(50) null,
  ciu_apellido varchar(50) null,
  ciu_sexo varchar(15) null,
  ciu_nacimiento datetime null,
  ciu_email varchar(50) null,
  ciu_tel_fijo varchar(20) null,
  ciu_tel_movil varchar(20) null,
  ciu_horario_cont varchar(50) null,
  ciu_no_llamar varchar(4) null,
  ciu_no_email varchar(4) null,
  ciu_dir_calle varchar(50) null,
  ciu_dir_nro int null,
  ciu_dir_piso varchar(5) null,
  ciu_dir_dpto varchar(5) null,
  ciu_barrio varchar(50) null,
  ciu_localidad varchar(50) null,
  ciu_provincia varchar(50) null,
  ciu_pais varchar(50) null,
  ciu_cod_postal varchar(6) null,
  ciu_cgpc varchar(10) null,
  ciu_coord_x DOUBLE(11) null,
  ciu_coord_y DOUBLE(11) null,
  ciu_trabaja varchar(4) null,
  ciu_nivel_estudio varchar(20) null,
  ciu_profesion varchar(50) null,
  ciu_ultimo_acceso datetime null,
  ciu_canal_ingreso varchar(20) null,
  use_code varchar(50) null,
  ciu_estado varchar(30) null,
  ciu_tstamp datetime null,
  ciu_tipo_persona varchar(20) null,
  ciu_razon_social varchar(100) null,
  ciu_nacionalidad varchar(100) null,
  constraint pk_ciu_ciudadanos primary key clustered (ciu_code) 
)


create table ciu_historial_contactos (
  chi_code int not null,
  ciu_code int not null,
  cse_code int null,
  chi_fecha datetime null,
  chi_motivo varchar(100) null,
  use_code varchar(50) null,
  chi_canal varchar(50) null,
  chi_nota text null,
  constraint pk_ciu_historial_contactos primary key clustered (chi_code, ciu_code) 
)


create table ciu_sesiones (
  cse_code int not null,
  ciu_code int not null,
  cse_ani varchar(15) null,
  cse_tstamp datetime null,
  cse_duracion int null,
  use_code varchar(50) null,
  cse_nota varchar(500) null,
  cse_derivado varchar(20) null,
  cse_call_id varchar(20) null,
  cse_skill varchar(50) null,
  cse_estado varchar(20) null,
  constraint pk_ciu_sesiones primary key clustered (cse_code, ciu_code) 
)


create table doc_documents (
  doc_code varchar(100) not null,
  doc_storage varchar(200) not null,
  doc_name varchar(200) null,
  doc_tstamp datetime null,
  doc_mime varchar(50) null,
  doc_size int null,
  acl_code int null,
  use_code varchar(50) null,
  doc_extension varchar(10) null,
  doc_version int null,
  doc_note varchar(200) null,
  doc_deleted char(1) null,
  doc_public char(1) null,
  constraint pk_doc_documents primary key clustered (doc_code, doc_storage) 
)


create table log_accesos (
  lac_code int not null,
  use_code varchar(50) null,
  lac_tstamp datetime null,
  lac_operation varchar(20) null,
  lac_name varchar(100) null,
  lac_result varchar(100) null,
  constraint pk_log_accesos primary key clustered (lac_code) 
)


create table log_operaciones (
  lop_code int not null,
  use_code varchar(50) null,
  lop_tstamp datetime null,
  lop_operation varchar(20) null,
  lop_object varchar(100) null,
  lop_key varchar(100) null,
  lop_change varchar(4000) null,
  constraint pk_log_operaciones primary key clustered (lop_code) 
)


create table rss_content (
  rss_code varchar(50) not null,
  rsc_code int null,
  rsc_publish_tstamp datetime null,
  rsc_remove_tstamp datetime null,
  use_code varchar(50) null,
  rsc_content varchar(5000) null,
  rsc_title varchar(200) null  
)


create table rss_links (
  rss_code varchar(50) not null,
  rss_url varchar(200) null,
  rss_note varchar(500) null,
  rss_type varchar(50) null,
  rss_logo varchar(200) null  
)


create table sec_acl (
  acl_code int not null,
  ugr_code varchar(50) not null,
  use_code varchar(50) not null,
  can_read char(1) null,
  can_write char(1) null,
  can_delete char(1) null,
  constraint pk_sec_acl primary key clustered (acl_code, ugr_code, use_code) 
)


create table sec_groups (
  gro_code varchar(50) not null,
  gro_name varchar(50) null,
  constraint pk_sec_groups primary key clustered (gro_code) 
)


create table sec_rights (
  rig_name varchar(200) not null,
  rig_description varchar(200) null,
  rig_check char(1) null,
  constraint pk_sec_rights primary key clustered (rig_name) 
)


create table sec_groups_rights (
  gro_code varchar(50) not null,
  rig_name varchar(200) not null,
  constraint pk_sec_groups_rights primary key clustered (gro_code, rig_name) 
)


create table sec_modules (
  smo_code int not null,
  smo_name varchar(100) null,
  smo_version varchar(50) null,
  smo_db_version varchar(50) null,
  smo_status varchar(50) null,
  smo_path varchar(300) null,
  constraint pk_sec_modules primary key clustered (smo_code) 
)


create table sec_parameters (
  par_code varchar(200) not null,
  par_value varchar(200) null,
  par_description varchar(400) null,
  constraint pk_sec_parameters primary key clustered (par_code) 
)


create table sec_sequence (
  seq_object varchar(100) not null,
  seq_code int null,
  constraint pk_sec_sequence primary key clustered (seq_object) 
)


create table sec_sessions (
  ses_tstamp datetime null,
  ses_last_access datetime null,
  use_code varchar(50) null,
  ses_token varchar(50) not null,
  ses_status varchar(20) null,
  constraint pk_sec_sessions primary key clustered (ses_token) 
)


create table sec_users (
  use_code varchar(50) not null,
  use_name varchar(200) null,
  use_phone varchar(30) null,
  use_email varchar(200) null,
  use_mobile varchar(50) null,
  use_extension varchar(50) null,
  use_login varchar(50) null,
  use_password varchar(50) null,
  use_status varchar(20) null,
  use_tstamp datetime null,
  use_language varchar(50) null,
  use_skin varchar(50) null,
  use_avatar varchar(200) null,
  use_phone2 varchar(30) null,
  use_phone3 varchar(30) null,
  use_location varchar(100) null,
  use_rss varchar(100) null,
  use_layout varchar(500) null,
  use_passact datetime null,
  constraint pk_sec_users primary key clustered (use_code) 
)


create table sec_ultimas_claves (
  use_password varchar(40) not null,
  suc_tstamp datetime not null,
  use_code varchar(50) not null,
  constraint pk_sec_ultimas_claves primary key clustered (use_code, suc_tstamp, use_password) 
)


create table sec_user_groups (
  use_code varchar(50) not null,
  gro_code varchar(50) not null,
  constraint pk_sec_user_groups primary key clustered (use_code, gro_code)
)


create table sec_usrgroup (
  ugr_code varchar(50) not null,
  ugr_name varchar(200) null,
  constraint pk_sec_usrgroup primary key clustered (ugr_code) 
)


create table sec_usrgroup_users (
  ugr_code varchar(50) not null,
  use_code varchar(50) not null,
  constraint pk_sec_usrgroup_users primary key clustered (ugr_code, use_code)
)


create table sho_atajos (
  sat_code int not null,
  sin_code int not null,
  sat_descripcion varchar(50) null,
  sat_url varchar(150) null,
  sat_nota varchar(500) null,
  use_code varchar(50) null,
  sat_tstamp datetime null,
  constraint pk_sho_atajos primary key clustered (sat_code, sin_code) 
)


create table sho_ingresos (
  sin_code int not null,
  sin_descripcion varchar(50) null,
  sin_estado varchar(50) null,
  use_code varchar(50) null,
  sin_tstamp datetime null,
  constraint pk_sho_ingresos primary key clustered (sin_code) 
)


create table tic_ticket (
  tic_nro int NOT NULL,
  tic_numero int NULL ,
  tic_anio int NULL ,
  tic_tipo varchar(20) NULL,
  tic_tstamp_in datetime NULL,
  use_code varchar(50) NULL,
  tic_nota_in varchar(500) NULL,
  tic_estado varchar(50) NULL,
  tic_lugar varchar(1000) NULL,
  tic_barrio varchar(50) NULL,
  tic_cgpc varchar(20) NULL,
  tic_coordx DOUBLE NULL,
  tic_coordy DOUBLE NULL,
  tic_id_cuadra int NULL,
  tic_forms int NULL,
  tic_canal varchar(20) NULL,
  tic_tstamp_plazo datetime NULL,
  tic_tstamp_cierre datetime NULL,
  tic_calle_nombre varchar(100) NULL,
  tic_cruza_calle varchar(100) NULL,
  tic_nro_puerta int NULL,
  tic_nro_asociado int NULL,
  tic_identificador varchar(45) NULL,
  constraint pk_tic_ticket primary key clustered (tic_nro) 
)



create table tic_prestaciones (
  tpr_code varchar(20) not null,
  tpr_tipo varchar(20) null,
  tpr_detalle varchar(100) null,
  tpr_estado varchar(20) null,
  tpr_tstamp datetime null,
  use_code varchar(50) null,
  tpr_ubicacion varchar(50) null,
  tpr_plazo varchar(20) null,
  tpr_show varchar(50) null,
  tpr_metadata varchar(3000) null,
  tpr_keywords varchar(500) null,
  tpr_admin varchar(50) null,
  tpr_al_inicio varchar(2000) null,
  tpr_al_final varchar(2000) null,
  tpr_al_vencimiento varchar(2000) null,
  tor_code_inspeccion int null,
  tor_code_verificacion int null,
  tpr_asociar_radio int null,
  eev_task varchar(100) null,
  constraint pk_tic_prestaciones primary key clustered (tpr_code) 
)


create table tic_ticket_prestaciones (
  tic_nro int not null,
  tpr_code varchar(20) not null,
  tru_code int null,
  ttp_cuestionario varchar(3000) null,
  ttp_estado varchar(50) null,
  ttp_prioridad varchar(20) null,
  ttp_tstamp_plazo datetime null,
  ttp_alerta int null,
  constraint pk_tic_ticket_prestaciones primary key clustered (tic_nro, tpr_code)
)


create table tic_avance (
  tic_nro int not null,
  tpr_code varchar(20) not null,
  tav_code int not null,
  tav_tstamp_in datetime null,
  use_code_in varchar(50) null,
  tic_estado_in varchar(50) null,
  tav_nota varchar(1000) null,
  tic_motivo varchar(50) null,
  tic_estado_out varchar(50) null,
  tav_tstamp_out datetime null,
  use_code_out varchar(50) null,
  constraint pk_tic_avance primary key clustered (tic_nro, tpr_code, tav_code)
)


create table tic_georef (
  tge_tipo varchar(30) null,
  tge_nombre varchar(100) null,
  tge_calle_nombre varchar(100) null,
  tge_altura int UNSIGNED null,
  tge_otra_denominacion varchar(500) null,
  tge_coordx FLOAT(11) null,
  tge_coordy FLOAT(11) null,
  tge_cgpc varchar(50) null,
  tge_barrio varchar(100) null,
  tge_calle int null
)


create table tic_organismos (
  tor_code int not null,
  tor_padre int null,
  tor_sigla varchar(20) null,
  tor_nombre varchar(100) null,
  tor_estado varchar(50) null,
  tor_tstamp datetime null,
  use_code varchar(50) null,
  tor_contacto varchar(500) null,
  tor_tipo varchar(20) null,
  tor_email varchar(200) null,
  tor_notificar varchar(5) null,
  constraint pk_tic_organismos primary key clustered (tor_code) 
)


create table tic_prestaciones_cuest (
  tpr_code varchar(20) not null,
  tcu_code int not null,
  tpr_orden int not null,
  tpr_preg varchar(100) null,
  tpr_tipo_preg varchar(20) null,
  tpr_opciones varchar(200) null,
  tpr_miciudad varchar(45) null,
  constraint pk_tic_prestaciones_cuest primary key clustered (tpr_code, tcu_code)
)


create table tic_prestaciones_gis (
  tpr_code varchar(20) not null,
  tpg_code int not null,
  tpg_gis_valor varchar(100) not null,
  tpg_gis_campo varchar(100) null,
  tpg_usa_gis varchar(5) not null,
  tor_code int null,
  tpg_tstamp datetime null,
  use_code varchar(50) null,
  tto_figura varchar(50) null,
  tpr_plazo varchar(20) null,
  constraint pk_tic_prestaciones_gis primary key clustered (tpr_code, tpg_code)
)


create table tic_rubros (
  tru_code int not null,
  tru_detalle varchar(100) null,
  tru_estado varchar(20) null,
  tru_tstamp datetime null,
  use_code varchar(50) null,
  constraint pk_tic_rubros primary key clustered (tru_code) 
)


create table tic_prestaciones_rubros (
  tpr_code varchar(20) not null,
  tru_code int not null,
  tpr_prioridad varchar(20) null,
  tor_code int null,
  tto_figura varchar(50) null,
  constraint pk_tic_prestaciones_rubros primary key clustered (tpr_code, tru_code)
)


create table tic_ticket_asociado (
  tic_nro int not null,
  tic_nro_asoc int not null,
  tta_tstamp datetime null,
  use_code varchar(50) null,
  tta_motivo varchar(500) null,
  constraint pk_tic_ticket_asociado primary key clustered (tic_nro, tic_nro_asoc)
)


create table tic_ticket_ciudadano (
  tic_nro int not null,
  ciu_code int not null,
  ttc_tstamp datetime null,
  ttc_nota varchar(1000) null,
  constraint pk_tic_ticket_ciudadano primary key clustered (tic_nro, ciu_code)
)


create table tic_ticket_ciudadano_reit (
  tic_nro int not null,
  ciu_code int not null,
  ttc_tstamp datetime not null,
  ttc_nota varchar(1000) null,
  constraint pk_tic_ticket_ciudadano_reit primary key clustered (tic_nro, ciu_code, ttc_tstamp)
)


create table tic_ticket_organismos (
  tic_nro int not null,
  tpr_code varchar(20) not null,
  tor_code int not null,
  tto_figura varchar(50) not null,
  constraint pk_tic_ticket_organismos primary key clustered (tic_nro, tpr_code, tor_code, tto_figura)
)


create table tra_list (
  tra_code varchar(50) not null,
  tra_sys varchar(50) null,
  cir_code varchar(50) null,
  tra_act_level DECIMAL(18,0) null,
  tra_rol varchar(50) null,
  tra_status varchar(50) null,
  tra_doc_xml varchar(50) null,
  tra_route_xml varchar(50) null,
  tra_prop_xml varchar(50) null,
  tra_tstamp_in datetime null,
  tra_tstamp_alarm datetime null,
  tra_key varchar(100) null,
  tra_key_desc varchar(200) null,
  tra_viewer varchar(100) null,
  tra_result varchar(50) null,
  tra_result_msg varchar(500) null,
  use_code_owner varchar(50) null,
  uri varchar(50) null,
  tra_handler varchar(100) null,
  use_code_aut varchar(50) null,
  tra_engine varchar(50) null,
  tra_job_status varchar(50) null,
  tra_job_error varchar(500) null,
  tra_change char(1) null,
  tra_can_print char(1) null,
  tra_hide_tstamp datetime null,
  constraint pk_tra_list primary key clustered (tra_code) 
)


create table tra_audit (
  aud_seq int not null,
  tra_code varchar(50) not null,
  aud_step varchar(50) null,
  use_code varchar(50) null,
  use_name varchar(100) null,
  aud_tstamp datetime null,
  aud_object varchar(50) null,
  aud_step_label varchar(100) null,
  aud_msg varchar(4000) null,
  aud_result varchar(50) null,
  constraint pk_tra_audit primary key clustered (aud_seq, tra_code) 
)


create table tra_events (
  tev_object varchar(50) not null,
  tev_op char(1) not null,
  tev_code varchar(50) not null,
  tev_tstamp datetime not null,
  tev_proc_tstamp datetime null,
  ave_code varchar(50) null,
  tev_class varchar(200) null,
  tev_key int not null,
  tev_proc_result varchar(400) null,
  tev_template varchar(200) null,
  tev_mail_to varchar(200) null,
  tev_presentation varchar(200) null,
  constraint pk_tra_events primary key clustered (tev_object, tev_op, tev_code, tev_tstamp, tev_key)
)


create table tra_log (
  swo_code varchar(50) not null,
  san_code int null,
  trl_code int not null,
  trl_msg varchar(1024) null,
  trl_read char(1) null,
  constraint pk_tra_log primary key clustered (swo_code, trl_code) 
)


create table ciu_identificacion (
  ciu_code int not null,
  ciu_nro_doc varchar(25) not null,
  constraint pk_ciu_identificacion primary key clustered (ciu_code, ciu_nro_doc) 
)


create table tic_indicadores (
  tin_code int not null,
  tin_nombre varchar(100) null,
  tin_traza varchar(200) null,
  constraint pk_tic_indicadores primary key clustered (tin_code) 
)


create table tic_ind_medidas (
  tin_code int not null,
  tor_code int not null,
  tim_tstamp datetime not null,
  tpr_code VARCHAR(20) NULL,
  tic_canal VARCHAR(20) NULL,
  tic_estado VARCHAR(50) NULL,
  tic_barrio VARCHAR(50) NULL,
  ttp_estado VARCHAR(50) NULL,  
  tim_valor double null,
  constraint pk_tic_ind_medidas primary key clustered (tin_code, tor_code, tim_tstamp) 
)


create table v_tickets (
  tic_nro int not null,
  tic_anio int not null,
  tic_tipo varchar(20) not null,
  tic_tstamp_in datetime null,
  use_code varchar(50) null,
  tic_nota_in varchar(500) null,
  tic_estado varchar(50) null,
  tic_lugar varchar(1000) null,
  tic_barrio varchar(50) null,
  tic_cgpc varchar(20) null,
  tic_coordx DOUBLE(11) null,
  tic_coordy DOUBLE(11) null,
  tic_id_cuadra int null,
  tic_forms int null,
  tic_canal varchar(20) null,
  tic_tstamp_plazo datetime null,
  tic_tstamp_cierre datetime null,
  tic_calle_nombre varchar(100) null,
  tic_nro_puerta int null,
  tic_nro_asociado int null,
  tic_identificador varchar(45) null,
  
  tpr_code varchar(20) not null,
  tru_code int null,
  ttp_cuestionario varchar(3000) null,
  ttp_estado varchar(50) null,
  ttp_prioridad varchar(20) null,
  ttp_tstamp_plazo datetime null,
  ttp_alerta int null,
  
  tor_code int null,
  tto_figura varchar(50) null,
  constraint pk_tic_ticket primary key clustered (tic_nro)
)


create  table ciu_paises (
  cpa_code char(3) not null ,
  cpa_descripcion varchar(150) null,
  constraint pk_ciu_paises primary key clustered (cpa_code) 
)

create table tic_ticket_cuestionario (
  tic_nro INT NOT NULL,
  tpr_code VARCHAR(20) NOT NULL,
  tcu_code INT NOT NULL,
  tpr_preg VARCHAR(100) NULL,
  tpr_tipo_preg VARCHAR(20) NULL,
  tpr_respuesta TEXT NULL,
  tpr_miciudad VARCHAR(45) NULL,
  constraint pk_tic_ticket_cuestionario primary key clustered (tic_nro, tpr_code, tcu_code) 
)

CREATE TABLE eve_events (
  eev_code int NOT NULL ,
  eev_tstamp_in DATETIME NULL,
  eev_tstamp_out DATETIME NULL,
  eev_task VARCHAR(100) NULL,
  eev_data TEXT NULL,
  eev_status VARCHAR(45) NULL,
  eev_error_msg TEXT NULL,
  constraint pk_eve_events primary key clustered (eev_code) 
)

