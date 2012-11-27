CREATE TABLE  cal_queue (
  cqu_codigo int NOT NULL,
  cqu_contacto varchar(50) NOT NULL,
  cqu_calle varchar(100) NULL,
  cqu_altura int NULL,
  cqu_prestacion varchar(200) NULL,
  cqu_rubro varchar(200)  NULL,
  cqu_responsable varchar(200)  NULL,
  cqu_x float NULL,
  cqu_y float NULL,
  cqu_con_ingreso_fecha datetime  NULL,
  cqu_con_cumplido_fecha datetime  NULL,
  cqu_con_cumplido_nota varchar(2000)  NULL,  
  cqu_barrio varchar(100)  NULL,
  cqu_cgpc varchar(50)  NULL,
  cqu_historia varchar(4000)  NULL,
  
  cqu_nombre varchar(100) null,
  cqu_tel_fijo varchar(30) null,
  cqu_tel_movil varchar(30) null,
  cqu_email varchar(100) null,
  
  use_code varchar(50)  NULL,
  cqu_ingreso_fecha datetime  NULL,
  cqu_egreso_fecha datetime  NULL,
  cqu_estado varchar(50)  NULL,
  
  cqu_resuelto varchar(50)  NULL,
  cqu_resultado varchar(50)  NULL,
  cqu_nota varchar(2000)  NULL,
  cqu_actitud varchar(50)  NULL,
  cqu_conforme varchar(50)  NULL,
  cqu_motivo_no_conforme varchar(100)  NULL,
  cqu_reabrir_contacto varchar(5)  NULL,
  cqu_seguir varchar(5)  NULL,
  cqu_tipo varchar(50) NULL,
  cqu_bloqueado datetime NULL, 
  cqu_estado_contacto varchar(50) NULL,
  CONSTRAINT PK_cal_queue PRIMARY KEY CLUSTERED (cqu_codigo)
) 

CREATE TABLE  cal_to_do (
  cto_codigo int NOT NULL,
  cqu_codigo int NOT NULL,
  cto_estado varchar(50)  NULL,
  use_code varchar(50)  NULL,
  cto_ingreso_fecha datetime  NULL,
  cto_salida_fecha datetime  NULL,
  cto_descripcion varchar(3000)  NULL,
  cto_nota varchar(3000)  NULL,
  CONSTRAINT PK_cal_to_do PRIMARY KEY CLUSTERED (cto_codigo)
)

CREATE TABLE  cal_to_do_steps (
  cto_codigo int NOT NULL,
  cts_codigo int NOT NULL,
  use_code varchar(50)  NULL,
  cts_ingreso_fecha datetime  NULL,
  cts_alarma_fecha datetime  NULL,
  cts_note varchar(3000)  NULL,
  CONSTRAINT PK_cal_to_do_steps PRIMARY KEY CLUSTERED (cto_codigo,cts_codigo)
)

CREATE TABLE sho_ingresos (
  sin_code int NOT NULL,
  sin_descripcion varchar(50) NULL,
  sin_estado varchar(50) NULL,
  use_code varchar(50) NULL,
  sin_tstamp datetime NULL,
  CONSTRAINT PK_sho_ingresos PRIMARY KEY CLUSTERED (sin_code)
)

CREATE TABLE sho_atajos (
  sat_code int NOT NULL,
  sin_code int NOT NULL,
  sat_descripcion varchar(50) NULL,
  sat_url varchar(150) NULL,
  sat_nota varchar(500) NULL,
  use_code varchar(50) NULL,
  sat_tstamp datetime NULL,
  CONSTRAINT PK_sho_atajos PRIMARY KEY CLUSTERED (sat_code,sin_code)
)

CREATE TABLE  cal_llamados (
  cll_codigo int NOT NULL,
  cqu_tel_fijo varchar(30) null,
  cqu_tel_movil varchar(30) null,
  cll_fecha datetime NULL,
  use_code varchar(50) NULL,
  cqu_nombre varchar(100) null, 
  CONSTRAINT PK_cal_llamados PRIMARY KEY CLUSTERED (cll_codigo)
)
