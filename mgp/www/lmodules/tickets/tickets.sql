
create table tic_avance(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tpr_code varchar(20) not null,
	tav_tstamp datetime not null,
	use_code varchar(50) null,
	tic_estado_in varchar(50) null,
	tic_estado_out varchar(50) null,
	tav_nota varchar(1000) null,
	tic_motivo varchar(50) null,
 constraint pk_tic_avance primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc,
	tpr_code asc,
	tav_tstamp asc
)
)

create table tic_organismos(
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
 constraint pk_tic_organismos primary key clustered
(
	tor_code asc
)
)


create table tic_prestaciones(
	tpr_code varchar(20) not null,
	tpr_tipo varchar(20) not null,
	tpr_detalle varchar(100) null,
	tpr_padre varchar(20) null,
	tpr_estado varchar(20) null,
	tpr_tstamp datetime null,
	use_code varchar(50) null,
	tpr_ubicacion varchar(50) null,
    tpr_plazo varchar(20) null,
    tpr_show varchar(50) null,
    tpr_metadata varchar(3000) null,
    tpr_keywords varchar(500) null,
	tpr_admin varchar(50) null,
	tpr_al_inicio varchar(200) null,
	tpr_al_final varchar(200) null,
	tpr_al_vencimiento varchar(200) null,
 constraint pk_tic_prestaciones primary key clustered
(
	tpr_code asc,
	tpr_tipo asc
)
)


create table tic_prestaciones_cuest(
	tpr_code varchar(20) not null,
	tpr_tipo varchar(20) not null,
	tpr_orden int not null,
	tpr_preg varchar(100) null,
	tpr_tipo_preg varchar(20) null,
	tpr_opciones varchar(200) null,
 constraint pk_tic_prestaciones_cuest primary key clustered
(
	tpr_code asc,
	tpr_tipo asc,
	tpr_orden asc
)
)


create table tic_prestaciones_gis(
	tpr_code varchar(20) not null,
	tpr_tipo varchar(20) not null,
	tpg_code int not null,
	tpg_gis_valor varchar(100) not null,
	tpg_gis_campo varchar(100) null,
	tpg_usa_gis varchar(5) null,
	tor_code int null,
	tpg_tstamp datetime null,
	use_code varchar(50) null,
	tto_figura varchar(50) null,
 constraint pk_tic_prestaciones_gis primary key clustered
(
	tpr_code asc,
	tpr_tipo asc,
	tpg_code asc
)
)



create table tic_rubros(
	tru_code int not null,
	tru_detalle varchar(100) null,
	tru_estado varchar(20) null,
	tru_tstamp datetime null,
	use_code varchar(50) null,
 constraint pk_tic_rubros primary key clustered
(
	tru_code asc
)
)

create table tic_ticket(
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
	tic_coordx float null,
	tic_coordy float null,
	tic_id_cuadra int null,
	tic_forms int null,
	tic_canal varchar(20) null,
	tic_tstamp_plazo datetime null,
	tic_tstamp_cierre datetime null,
	tic_calle_nombre varchar(100) null,
	tic_nro_puerta int null,
	tic_nro_asociado int null,
	tic_anio_asociado int null,
 constraint pk_tic_ticket primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc
)
)


create table tic_ticket_ciudadano(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	ciu_code int not null,
	ttc_tstamp datetime null,
	ttc_nota varchar(1000) null,
 constraint pk_tic_ticket_ciudadano primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc,
	ciu_code asc
)
)


create table tic_ticket_ciudadano_reit(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	ciu_code int not null,
	ttc_tstamp datetime not null,
	ttc_nota varchar(1000) null,
 constraint pk_tic_ticket_ciudadano_reit primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc,
	ciu_code asc,
	ttc_tstamp asc
)
)


create table tic_ticket_organismos(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tor_code int not null,
	tto_figura varchar(50) null,
	tpr_code varchar(20) null,
	tto_alerta int null,
 constraint pk_tic_ticket_organismos primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc,
	tor_code asc
)
)

create table tic_ticket_prestaciones(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tpr_code varchar(20) not null,
	ttp_tstamp datetime null,
	tru_code int null,
	ttp_cuestionario varchar(3000) null,
	ttp_estado varchar(10) null,
    ttp_prioridad varchar(20) null,
    ttp_tstamp_cierra datetime null,
    ttp_tstamp_plazo datetime null,
 constraint pk_tic_ticket_prestaciones primary key clustered
(
	tic_nro asc,
	tic_anio asc,
	tic_tipo asc,
	tpr_code asc
)
)

create table tic_prestaciones_rubros(
	tpr_code varchar(20) not null,
	tpr_tipo varchar(20) not null,
	tru_code int not null,
	tpr_prioridad varchar(20) null,
	tor_code int null,
	tto_figura varchar(50) null,
 constraint pk_tic_prestaciones_rubros primary key clustered
(
	tpr_code asc,
	tpr_tipo asc,
	tru_code asc
)
)

create table reclamos(
	numero int not null,
	anio int not null,
	derivacion char(1)  not null,
	fechaingreso datetime null,
	calle int null,
	callenro int null,
	zona int null,
	prestacion varchar(10)  null,
	prestador int null,
	orgresponsable int null,
	emergencia int null,
	plazo int null,
	obs varchar(300)  null,
	i_tipo varchar(4)  null,
	i_zona int null,
	i_nro int null,
	i_anio int null,
	i_idaux int null,
	i_fecha datetime null,
	orgreceptor int null,
	userid varchar(10)  null,
	formaingreso int null,
	estado int null,
	motivo int null,
	fechaultestado datetime null,
	fechacumplido datetime null,
	cantreit int null,
	feultreit datetime null,
	faxeado int null,
	nroremito int null,
	fecnotixlote datetime null,
	emailenviado int null,
	idpunto int null,
	barrio varchar(20)  null,
	calificado int null,
	feverificado datetime null,
	ext_coordx float null,
	ext_coordy float null,
	ext_id_cuadra int null,
	ext_calle_nombre varchar(100) null,
	ext_calle2 int null,
	ext_calle_nombre2 varchar(100) null,
	obsinspeccion varchar(1000) null,
	feinspeccion datetime null,
	inspeccionado bit null,
	constraint pk_reclamos primary key nonclustered 
	(
		numero asc,
		anio asc,
		derivacion asc
	)
) 

create table reclamantes(
	numero int not null,
	anio int not null,
	nroreit int not null,
	fechareit datetime null,
	quien varchar(30)  null,
	quientipodoc varchar(3)  null,
	quiennrodoc varchar(13)  null,
	quientelfax varchar(100)  null,
	quiendomcod int null,
	quiendomnro int null,
	quiendompiso varchar(4)  null,
	quiendomdpto varchar(4)  null,
	quiencodpostal varchar(8)  null,
	quienemail varchar(45)  null,
	emailenviado int null,
	quienidpunto int null
) 

create table reclaestados(
	numero int not null,
	anio int not null,
	derivacion char(1)  null,
	estadoorigen int null,
	estadodestino int null,
	userid varchar(10)  null,
	fecha datetime not null,
	obs varchar(300)  null
) 

create table tic_lotes(
	tlo_code int not null,
	use_code varchar(50)  null,
	tlo_tstamp datetime not null,
	tlo_nota varchar(300)  null,
	constraint pk_tic_lotes primary key nonclustered 
	(
		tlo_code asc
	)
)

create table tic_lotes_detalle(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tlo_code int not null,
	constraint pk_tic_lotes_detalle primary key nonclustered 
	(
		tic_nro asc,
		tic_anio asc,
		tic_tipo asc,
		tlo_code asc
	)
) 


create table tic_ticket_asociado(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tic_nro_asoc int not null,
	tic_anio_asoc int not null,
	tta_tstamp datetime null,
	use_code varchar(50) null,
	constraint pk_tic_lotes_detalle primary key nonclustered 
	(
		tic_nro asc,
		tic_anio asc,
		tic_tipo asc,
		tic_nro_asoc asc,
		tic_anio_asoc asc
	)
) 

create table v_tickets(
	tic_nro int not null,
	tic_anio int not null,
	tic_tipo varchar(20) not null,
	tpr_code varchar(20) null,
	ttp_tstamp datetime null,
	ttp_estado varchar(50) null,
	ttp_prioridad varchar(20) null,
	tor_code int null,
	tto_figura varchar(50) null,
	tto_alerta int null,
	tru_code int null,
	tic_calle_nombre varchar(100) null,
	tic_nro_puerta int null,
	tic_barrio varchar(100) null,
	tic_nota_in varchar(500) null,
	responsable varchar(5) null,
	prestador varchar(5) null,
	constraint pk_tic_tickets primary key nonclustered 
	(
		tic_nro asc,
		tic_anio asc,
		tic_tipo asc
	)
)


create table  tic_georef(
  tge_tipo varchar(30) not null,
  tge_nombre varchar(100) not null,
  tge_calle_nombre varchar(100) null,
  tge_altura int null,
  tge_otra_denominacion varchar(500) null,
  tge_coordx float null,
  tge_coordy float null,
  tge_cgpc varchar(50) null,
  tge_barrio varchar(100) null,
  tge_calle int null,
  constraint pk_tic_georef primary key nonclustered 
  (
  	tge_tipo,
  	tge_nombre
  )
) 
