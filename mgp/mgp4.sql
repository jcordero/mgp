-- MySQL dump 10.13  Distrib 5.5.30, for osx10.8 (i386)
--
-- Host: localhost    Database: mgp
-- ------------------------------------------------------
-- Server version	5.5.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avi_entrantes`
--

DROP TABLE IF EXISTS `avi_entrantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avi_entrantes` (
  `ave_key` int(11) NOT NULL,
  `ave_tstamp` datetime DEFAULT NULL,
  `avs_code` int(11) DEFAULT NULL,
  `ave_headers` varchar(500) DEFAULT NULL,
  `ave_subject` varchar(200) DEFAULT NULL,
  `ave_body` varchar(8000) DEFAULT NULL,
  `ave_body_alt` varchar(8000) DEFAULT NULL,
  `ave_from` varchar(100) DEFAULT NULL,
  `ave_status` varchar(50) DEFAULT NULL,
  `ave_attachments` varchar(5) DEFAULT NULL,
  `avm_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`ave_key`),
  UNIQUE KEY `pk_avi_mensajes` (`ave_key`),
  KEY `fk_entrante_server_idx` (`avs_code`),
  CONSTRAINT `fk_entrante_server` FOREIGN KEY (`avs_code`) REFERENCES `avi_servers` (`avs_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avi_entrantes`
--

LOCK TABLES `avi_entrantes` WRITE;
/*!40000 ALTER TABLE `avi_entrantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `avi_entrantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avi_eventos`
--

DROP TABLE IF EXISTS `avi_eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avi_eventos` (
  `ave_code` varchar(50) NOT NULL COMMENT 'Codigo del evento',
  `cco_code` int(10) NOT NULL,
  `avr_type` varchar(50) DEFAULT NULL,
  `avr_status` varchar(20) DEFAULT NULL,
  `ave_template` varchar(100) DEFAULT NULL,
  `ave_filtro` varchar(50) DEFAULT NULL,
  `ave_filtro_valor` varchar(50) DEFAULT NULL,
  `ave_filtro2` varchar(50) DEFAULT NULL,
  `ave_filtro2_valor` varchar(50) DEFAULT NULL,
  `ave_key` int(10) NOT NULL,
  PRIMARY KEY (`ave_code`,`cco_code`),
  UNIQUE KEY `pk_avi_eventos_1` (`ave_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avi_eventos`
--

LOCK TABLES `avi_eventos` WRITE;
/*!40000 ALTER TABLE `avi_eventos` DISABLE KEYS */;
/*!40000 ALTER TABLE `avi_eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avi_mensajes`
--

DROP TABLE IF EXISTS `avi_mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avi_mensajes` (
  `avm_key` int(11) NOT NULL,
  `avm_tstamp` datetime DEFAULT NULL,
  `avm_tstamp_send` datetime DEFAULT NULL,
  `avm_descr` varchar(100) DEFAULT NULL,
  `avm_class` varchar(100) DEFAULT NULL,
  `avm_code` varchar(100) DEFAULT NULL,
  `avm_email` varchar(100) DEFAULT NULL,
  `avm_template` varchar(100) DEFAULT NULL,
  `avm_opt` varchar(100) DEFAULT NULL,
  `avm_status` varchar(100) DEFAULT NULL,
  `avm_intentos` int(11) DEFAULT NULL,
  `avm_error` varchar(500) DEFAULT NULL,
  `tev_key` int(11) DEFAULT NULL,
  `avm_attachments` varchar(200) DEFAULT NULL,
  `avs_code` int(11) DEFAULT NULL,
  `avm_headers` varchar(512) DEFAULT NULL,
  `avm_xid` varchar(40) DEFAULT NULL,
  `avm_follow_up` varchar(200) DEFAULT NULL,
  `avm_follow_key` varchar(200) DEFAULT NULL,
  `avm_body` text,
  PRIMARY KEY (`avm_key`),
  UNIQUE KEY `pk_avi_mensajes` (`avm_key`),
  KEY `fk_mensaje_server_idx` (`avs_code`),
  CONSTRAINT `fk_mensaje_server` FOREIGN KEY (`avs_code`) REFERENCES `avi_servers` (`avs_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avi_mensajes`
--

LOCK TABLES `avi_mensajes` WRITE;
/*!40000 ALTER TABLE `avi_mensajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `avi_mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avi_servers`
--

DROP TABLE IF EXISTS `avi_servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avi_servers` (
  `avs_code` int(11) NOT NULL,
  `avs_server_type` varchar(30) DEFAULT NULL,
  `avs_host` varchar(100) DEFAULT NULL,
  `avs_user` varchar(50) DEFAULT NULL,
  `avs_password` varchar(50) DEFAULT NULL,
  `avs_account` varchar(100) DEFAULT NULL,
  `avs_direction` varchar(30) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `avs_status` varchar(50) DEFAULT NULL,
  `avs_tstamp` datetime DEFAULT NULL,
  `avs_account_name` varchar(100) DEFAULT NULL,
  `avs_class` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`avs_code`),
  UNIQUE KEY `pk_avi_servers` (`avs_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avi_servers`
--

LOCK TABLES `avi_servers` WRITE;
/*!40000 ALTER TABLE `avi_servers` DISABLE KEYS */;
/*!40000 ALTER TABLE `avi_servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_value`
--

DROP TABLE IF EXISTS `cat_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_value` (
  `vli_code` varchar(50) NOT NULL,
  `val_value` varchar(200) NOT NULL,
  `val_order` int(10) DEFAULT NULL,
  `cas_code` varchar(50) DEFAULT NULL,
  `cas_value` varchar(200) NOT NULL,
  PRIMARY KEY (`vli_code`,`val_value`,`cas_value`),
  KEY `fk_value_list_idx` (`vli_code`),
  CONSTRAINT `fk_value_list` FOREIGN KEY (`vli_code`) REFERENCES `cat_value_list` (`vli_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_value`
--

LOCK TABLES `cat_value` WRITE;
/*!40000 ALTER TABLE `cat_value` DISABLE KEYS */;
INSERT INTO `cat_value` VALUES ('languages','Español',1,NULL,''),('NACIONALIDAD','Afganistán',0,NULL,''),('NACIONALIDAD','Albania',0,NULL,''),('NACIONALIDAD','Alemania',0,NULL,''),('NACIONALIDAD','American Samoa',0,NULL,''),('NACIONALIDAD','Andorra',0,NULL,''),('NACIONALIDAD','Angola',0,NULL,''),('NACIONALIDAD','Anguila',0,NULL,''),('NACIONALIDAD','Antártida',0,NULL,''),('NACIONALIDAD','Antigua and Barbuda',0,NULL,''),('NACIONALIDAD','Antillas Holandesas',0,NULL,''),('NACIONALIDAD','Arabia Saudita',0,NULL,''),('NACIONALIDAD','Argelia',0,NULL,''),('NACIONALIDAD','Argentina',0,NULL,''),('NACIONALIDAD','Armenia',0,NULL,''),('NACIONALIDAD','Aruba',0,NULL,''),('NACIONALIDAD','Australia',0,NULL,''),('NACIONALIDAD','Austria',0,NULL,''),('NACIONALIDAD','Azerbaijan',0,NULL,''),('NACIONALIDAD','Bahamas',0,NULL,''),('NACIONALIDAD','Bahrein',0,NULL,''),('NACIONALIDAD','Bangladesh',0,NULL,''),('NACIONALIDAD','Barbados',0,NULL,''),('NACIONALIDAD','Bélgica',0,NULL,''),('NACIONALIDAD','Belice',0,NULL,''),('NACIONALIDAD','Benin',0,NULL,''),('NACIONALIDAD','Bermuda',0,NULL,''),('NACIONALIDAD','Bielorrusia',0,NULL,''),('NACIONALIDAD','Bolivia',0,NULL,''),('NACIONALIDAD','Bosnia y Herzegovina',0,NULL,''),('NACIONALIDAD','Botsuana',0,NULL,''),('NACIONALIDAD','Bouvet Island',0,NULL,''),('NACIONALIDAD','Brasil',0,NULL,''),('NACIONALIDAD','British Indian Ocean Territory',0,NULL,''),('NACIONALIDAD','Brunei Darussalam',0,NULL,''),('NACIONALIDAD','Bulgaria',0,NULL,''),('NACIONALIDAD','Burkina Faso',0,NULL,''),('NACIONALIDAD','Burundi',0,NULL,''),('NACIONALIDAD','Bután',0,NULL,''),('NACIONALIDAD','Cabo Verda',0,NULL,''),('NACIONALIDAD','Camboya',0,NULL,''),('NACIONALIDAD','Camerún',0,NULL,''),('NACIONALIDAD','Canadá',0,NULL,''),('NACIONALIDAD','Chad',0,NULL,''),('NACIONALIDAD','Chile',0,NULL,''),('NACIONALIDAD','China',0,NULL,''),('NACIONALIDAD','Chipre',0,NULL,''),('NACIONALIDAD','Colombia',0,NULL,''),('NACIONALIDAD','Comores',0,NULL,''),('NACIONALIDAD','Congo',0,NULL,''),('NACIONALIDAD','Corea del Norte',0,NULL,''),('NACIONALIDAD','Corea del Sur',0,NULL,''),('NACIONALIDAD','Costa Rica',0,NULL,''),('NACIONALIDAD','Cote D Ivoire',0,NULL,''),('NACIONALIDAD','Croacia',0,NULL,''),('NACIONALIDAD','Cuba',0,NULL,''),('NACIONALIDAD','Dinamarca',0,NULL,''),('NACIONALIDAD','Djibouti',0,NULL,''),('NACIONALIDAD','Dominica',0,NULL,''),('NACIONALIDAD','East Timor',0,NULL,''),('NACIONALIDAD','Ecuador',0,NULL,''),('NACIONALIDAD','Egipto',0,NULL,''),('NACIONALIDAD','El Salvador',0,NULL,''),('NACIONALIDAD','El Vaticano',0,NULL,''),('NACIONALIDAD','Emiratos Arabes Unidos',0,NULL,''),('NACIONALIDAD','Eritrea',0,NULL,''),('NACIONALIDAD','Eslovaquia',0,NULL,''),('NACIONALIDAD','Eslovenia',0,NULL,''),('NACIONALIDAD','España',0,NULL,''),('NACIONALIDAD','Estados Unidos',0,NULL,''),('NACIONALIDAD','Estonia',0,NULL,''),('NACIONALIDAD','Etiopía',0,NULL,''),('NACIONALIDAD','Fiji',0,NULL,''),('NACIONALIDAD','Filipinas',0,NULL,''),('NACIONALIDAD','Finlandia',0,NULL,''),('NACIONALIDAD','Francia',0,NULL,''),('NACIONALIDAD','French Guiana',0,NULL,''),('NACIONALIDAD','French Polynesia',0,NULL,''),('NACIONALIDAD','French Southern Territories',0,NULL,''),('NACIONALIDAD','Gabón',0,NULL,''),('NACIONALIDAD','Gambia',0,NULL,''),('NACIONALIDAD','Georgia',0,NULL,''),('NACIONALIDAD','Ghana',0,NULL,''),('NACIONALIDAD','Gibraltar',0,NULL,''),('NACIONALIDAD','Granada',0,NULL,''),('NACIONALIDAD','Grecia',0,NULL,''),('NACIONALIDAD','Groenlandia',0,NULL,''),('NACIONALIDAD','Guadalupe',0,NULL,''),('NACIONALIDAD','Guam',0,NULL,''),('NACIONALIDAD','Guatemala',0,NULL,''),('NACIONALIDAD','Guinea',0,NULL,''),('NACIONALIDAD','Guinea Ecuatorial',0,NULL,''),('NACIONALIDAD','Guinea-Bissau',0,NULL,''),('NACIONALIDAD','Guyana',0,NULL,''),('NACIONALIDAD','Haití',0,NULL,''),('NACIONALIDAD','Heard Island and McDonald Isla',0,NULL,''),('NACIONALIDAD','Holanda',0,NULL,''),('NACIONALIDAD','Honduras',0,NULL,''),('NACIONALIDAD','Hong Kong',0,NULL,''),('NACIONALIDAD','Hungría',0,NULL,''),('NACIONALIDAD','India',0,NULL,''),('NACIONALIDAD','Indonesia',0,NULL,''),('NACIONALIDAD','Iraq',0,NULL,''),('NACIONALIDAD','Irlanda',0,NULL,''),('NACIONALIDAD','Isalas Cocos',0,NULL,''),('NACIONALIDAD','Isla Christmas',0,NULL,''),('NACIONALIDAD','Islandia',0,NULL,''),('NACIONALIDAD','Islas Caimán',0,NULL,''),('NACIONALIDAD','Islas Cook',0,NULL,''),('NACIONALIDAD','Islas Feroe',0,NULL,''),('NACIONALIDAD','Islas Malvinas',0,NULL,''),('NACIONALIDAD','Islas Marshall',0,NULL,''),('NACIONALIDAD','Islas Mauricio',0,NULL,''),('NACIONALIDAD','Islas Salomón',0,NULL,''),('NACIONALIDAD','Islas Sandwhich',0,NULL,''),('NACIONALIDAD','Islas Turks y Caicos',0,NULL,''),('NACIONALIDAD','Islas Wallis y Futuna',0,NULL,''),('NACIONALIDAD','Israel',0,NULL,''),('NACIONALIDAD','Italia',0,NULL,''),('NACIONALIDAD','Jamaica',0,NULL,''),('NACIONALIDAD','Japón',0,NULL,''),('NACIONALIDAD','Jordania',0,NULL,''),('NACIONALIDAD','Kazakhstán',0,NULL,''),('NACIONALIDAD','Kenia',0,NULL,''),('NACIONALIDAD','Kiribati',0,NULL,''),('NACIONALIDAD','Kuwait',0,NULL,''),('NACIONALIDAD','Kyrgyzstán',0,NULL,''),('NACIONALIDAD','Laos',0,NULL,''),('NACIONALIDAD','Latvia',0,NULL,''),('NACIONALIDAD','Lesoto',0,NULL,''),('NACIONALIDAD','Líbano',0,NULL,''),('NACIONALIDAD','Liberia',0,NULL,''),('NACIONALIDAD','Libia',0,NULL,''),('NACIONALIDAD','Liechtenstein',0,NULL,''),('NACIONALIDAD','Lituania',0,NULL,''),('NACIONALIDAD','Luxemburgo',0,NULL,''),('NACIONALIDAD','Macao',0,NULL,''),('NACIONALIDAD','Macedonia',0,NULL,''),('NACIONALIDAD','Madagascar',0,NULL,''),('NACIONALIDAD','Malasia',0,NULL,''),('NACIONALIDAD','Malaui',0,NULL,''),('NACIONALIDAD','Maldivas',0,NULL,''),('NACIONALIDAD','Malí',0,NULL,''),('NACIONALIDAD','Malta',0,NULL,''),('NACIONALIDAD','Marruecos',0,NULL,''),('NACIONALIDAD','Martinique',0,NULL,''),('NACIONALIDAD','Mauritania',0,NULL,''),('NACIONALIDAD','Mayotte',0,NULL,''),('NACIONALIDAD','México',0,NULL,''),('NACIONALIDAD','Micronesia',0,NULL,''),('NACIONALIDAD','Moldavia',0,NULL,''),('NACIONALIDAD','Mónaco',0,NULL,''),('NACIONALIDAD','Mongolia',0,NULL,''),('NACIONALIDAD','Montserrat',0,NULL,''),('NACIONALIDAD','Mozambique',0,NULL,''),('NACIONALIDAD','Myanmar',0,NULL,''),('NACIONALIDAD','Namibia',0,NULL,''),('NACIONALIDAD','Nauru',0,NULL,''),('NACIONALIDAD','Nepal',0,NULL,''),('NACIONALIDAD','Nicaragua',0,NULL,''),('NACIONALIDAD','Níger',0,NULL,''),('NACIONALIDAD','Nigeria',0,NULL,''),('NACIONALIDAD','Niue',0,NULL,''),('NACIONALIDAD','Norfolk Island',0,NULL,''),('NACIONALIDAD','Northern Mariana Islands',0,NULL,''),('NACIONALIDAD','Noruega',0,NULL,''),('NACIONALIDAD','Nueva Caledonia',0,NULL,''),('NACIONALIDAD','Nueva Zelanda',0,NULL,''),('NACIONALIDAD','Omán',0,NULL,''),('NACIONALIDAD','Pakistán',0,NULL,''),('NACIONALIDAD','Palau',0,NULL,''),('NACIONALIDAD','Palestinian Territory',0,NULL,''),('NACIONALIDAD','Panamá',0,NULL,''),('NACIONALIDAD','Papúa Nueva Guinea',0,NULL,''),('NACIONALIDAD','Paraguay',0,NULL,''),('NACIONALIDAD','Perú',0,NULL,''),('NACIONALIDAD','Pitcairn',0,NULL,''),('NACIONALIDAD','Polonia',0,NULL,''),('NACIONALIDAD','Portugal',0,NULL,''),('NACIONALIDAD','Puerto Rico',0,NULL,''),('NACIONALIDAD','Qatar',0,NULL,''),('NACIONALIDAD','Reino Unido',0,NULL,''),('NACIONALIDAD','República Centroafricana',0,NULL,''),('NACIONALIDAD','República Checa',0,NULL,''),('NACIONALIDAD','República Democrática del Cong',0,NULL,''),('NACIONALIDAD','República Dominicana',0,NULL,''),('NACIONALIDAD','República Islámica de Irán',0,NULL,''),('NACIONALIDAD','Ruanda',0,NULL,''),('NACIONALIDAD','Rumania',0,NULL,''),('NACIONALIDAD','Rusian',0,NULL,''),('NACIONALIDAD','Saint Kitts and Nevis',0,NULL,''),('NACIONALIDAD','Saint Pierre y Miquelon',0,NULL,''),('NACIONALIDAD','Samoa',0,NULL,''),('NACIONALIDAD','San Marino',0,NULL,''),('NACIONALIDAD','San Vicente y Las Granadinas',0,NULL,''),('NACIONALIDAD','Santa Elena',0,NULL,''),('NACIONALIDAD','Santa Lucía',0,NULL,''),('NACIONALIDAD','Sao Tome and Principe',0,NULL,''),('NACIONALIDAD','Senegal',0,NULL,''),('NACIONALIDAD','Serbia y Montenegro',0,NULL,''),('NACIONALIDAD','Seychelles',0,NULL,''),('NACIONALIDAD','Sierra Leona',0,NULL,''),('NACIONALIDAD','Singapur',0,NULL,''),('NACIONALIDAD','Siria',0,NULL,''),('NACIONALIDAD','Somalía',0,NULL,''),('NACIONALIDAD','Sri Lanka',0,NULL,''),('NACIONALIDAD','Suazilandia',0,NULL,''),('NACIONALIDAD','Sudáfrica',0,NULL,''),('NACIONALIDAD','Sudán',0,NULL,''),('NACIONALIDAD','Suecia',0,NULL,''),('NACIONALIDAD','Suiza',0,NULL,''),('NACIONALIDAD','Surinam',0,NULL,''),('NACIONALIDAD','Svalbard and Jan Mayen',0,NULL,''),('NACIONALIDAD','Tailandia',0,NULL,''),('NACIONALIDAD','Taiwan',0,NULL,''),('NACIONALIDAD','Tajikistán',0,NULL,''),('NACIONALIDAD','Tanzania',0,NULL,''),('NACIONALIDAD','Togo',0,NULL,''),('NACIONALIDAD','Tonga',0,NULL,''),('NACIONALIDAD','Toquelau',0,NULL,''),('NACIONALIDAD','Trinidad y Tobago',0,NULL,''),('NACIONALIDAD','Túnez',0,NULL,''),('NACIONALIDAD','Turkmenistán',0,NULL,''),('NACIONALIDAD','Turquía',0,NULL,''),('NACIONALIDAD','Tuvalu',0,NULL,''),('NACIONALIDAD','Ucrania',0,NULL,''),('NACIONALIDAD','Uganda',0,NULL,''),('NACIONALIDAD','United States Minor Outlying I',0,NULL,''),('NACIONALIDAD','Uruguay',0,NULL,''),('NACIONALIDAD','Uzbekistan',0,NULL,''),('NACIONALIDAD','Vanuatu',0,NULL,''),('NACIONALIDAD','Venezuela',0,NULL,''),('NACIONALIDAD','Vietnam',0,NULL,''),('NACIONALIDAD','Virgin Islands British',0,NULL,''),('NACIONALIDAD','Virgin Islands U.S.',0,NULL,''),('NACIONALIDAD','Western Sahara',0,NULL,''),('NACIONALIDAD','Yemen',0,NULL,''),('NACIONALIDAD','Zaire',0,NULL,''),('NACIONALIDAD','Zambia',0,NULL,''),('NACIONALIDAD','Zimbabue',0,NULL,''),('skins','default',1,NULL,''),('status_user','ACTIVO',1,NULL,''),('status_user','INACTIVO',2,NULL,''),('status_user','SUSPENDIDO',3,NULL,'');
/*!40000 ALTER TABLE `cat_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_value_list`
--

DROP TABLE IF EXISTS `cat_value_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_value_list` (
  `vli_code` varchar(50) NOT NULL,
  `vli_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vli_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_value_list`
--

LOCK TABLES `cat_value_list` WRITE;
/*!40000 ALTER TABLE `cat_value_list` DISABLE KEYS */;
INSERT INTO `cat_value_list` VALUES ('languages','Idiomas soportados'),('NACIONALIDAD','Lista de nacionalidades'),('skins','Estilos graficos'),('status_user','Estados posibles de un usuario');
/*!40000 ALTER TABLE `cat_value_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciu_ciudadanos`
--

DROP TABLE IF EXISTS `ciu_ciudadanos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciu_ciudadanos` (
  `ciu_code` int(10) NOT NULL,
  `ciu_nombres` varchar(50) DEFAULT NULL,
  `ciu_apellido` varchar(50) DEFAULT NULL,
  `ciu_sexo` varchar(15) DEFAULT NULL,
  `ciu_nacimiento` datetime DEFAULT NULL,
  `ciu_email` varchar(50) DEFAULT NULL,
  `ciu_tel_fijo` varchar(20) DEFAULT NULL,
  `ciu_tel_movil` varchar(20) DEFAULT NULL,
  `ciu_horario_cont` varchar(50) DEFAULT NULL,
  `ciu_no_llamar` varchar(4) DEFAULT NULL,
  `ciu_no_email` varchar(4) DEFAULT NULL,
  `ciu_dir_calle` varchar(50) DEFAULT NULL,
  `ciu_dir_nro` int(10) DEFAULT NULL,
  `ciu_dir_piso` varchar(5) DEFAULT NULL,
  `ciu_dir_dpto` varchar(5) DEFAULT NULL,
  `ciu_barrio` varchar(50) DEFAULT NULL,
  `ciu_localidad` varchar(50) DEFAULT NULL,
  `ciu_provincia` varchar(50) DEFAULT NULL,
  `ciu_pais` varchar(50) DEFAULT NULL,
  `ciu_cod_postal` varchar(6) DEFAULT NULL,
  `ciu_cgpc` varchar(10) DEFAULT NULL,
  `ciu_coord_x` double DEFAULT NULL,
  `ciu_coord_y` double DEFAULT NULL,
  `ciu_trabaja` varchar(4) DEFAULT NULL,
  `ciu_nivel_estudio` varchar(20) DEFAULT NULL,
  `ciu_profesion` varchar(50) DEFAULT NULL,
  `ciu_ultimo_acceso` datetime DEFAULT NULL,
  `ciu_canal_ingreso` varchar(20) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `ciu_estado` varchar(30) DEFAULT NULL,
  `ciu_tstamp` datetime DEFAULT NULL,
  `ciu_tipo_persona` varchar(20) DEFAULT NULL,
  `ciu_razon_social` varchar(100) DEFAULT NULL,
  `ciu_nacionalidad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ciu_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciu_ciudadanos`
--

LOCK TABLES `ciu_ciudadanos` WRITE;
/*!40000 ALTER TABLE `ciu_ciudadanos` DISABLE KEYS */;
INSERT INTO `ciu_ciudadanos` VALUES (36,'JORGE','CORDERO','MASCULINO','1968-09-22 00:00:00','jorge.cordero@commsys.com.ar','','','','NO','NO','00342',345,'2','D','DEL PUERTO','Mar del Plata','BUENOS AIRES','ARGENTINA','','',-38.0086896250302,-57.5345889139824,'SI','UNIVERSITARIOS','','2013-04-12 00:36:47','CALL','1','ACTIVO','2013-02-04 12:52:34','FISICA','','Argentina'),(38,'alert(&#39;caca&#39;)','CORDERO','MASCULINO','2013-03-22 00:00:00','','','','','NO','NO','',NULL,'','','','Mar del Plata','BUENOS AIRES','ARGENTINA','','',NULL,NULL,'','','',NULL,'CALL','1','ACTIVO','2013-03-22 12:20:15','FISICA','','Argentina'),(39,'GASTON','ZANITTI','MASCULINO','1989-07-22 00:00:00','','','','','NO','NO','',NULL,'','','','Mar del Plata','BUENOS AIRES','ARGENTINA','','',NULL,NULL,'','','',NULL,'CALL','1','ACTIVO','2013-04-08 11:52:36','FISICA','','ARG'),(59,'CARLOS','PETRUZA','MASCULINO','1970-07-10 00:00:00','','','','','NO','NO','00490',345,'1','','LOPEZ DE GOMARA','Mar del Plata','BUENOS AIRES','ARGENTINA','','',-37.9690082931901,-57.5768569103592,'','','',NULL,'CALL','1','ACTIVO','2013-04-09 23:31:56','FISICA','','ARG');
/*!40000 ALTER TABLE `ciu_ciudadanos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciu_historial_contactos`
--

DROP TABLE IF EXISTS `ciu_historial_contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciu_historial_contactos` (
  `chi_code` int(10) NOT NULL COMMENT 'código de historial',
  `ciu_code` int(10) NOT NULL COMMENT 'ciudadano',
  `cse_code` int(10) DEFAULT NULL COMMENT 'código de sesión',
  `chi_fecha` datetime DEFAULT NULL,
  `chi_motivo` varchar(100) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `chi_canal` varchar(50) DEFAULT NULL,
  `chi_nota` text,
  PRIMARY KEY (`chi_code`,`ciu_code`),
  KEY `fk_ciudadano_hist_idx` (`ciu_code`),
  CONSTRAINT `fk_ciudadano_hist` FOREIGN KEY (`ciu_code`) REFERENCES `ciu_ciudadanos` (`ciu_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciu_historial_contactos`
--

LOCK TABLES `ciu_historial_contactos` WRITE;
/*!40000 ALTER TABLE `ciu_historial_contactos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciu_historial_contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciu_identificacion`
--

DROP TABLE IF EXISTS `ciu_identificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciu_identificacion` (
  `ciu_code` int(11) NOT NULL COMMENT 'código de ciudadano',
  `ciu_nro_doc` varchar(25) NOT NULL COMMENT 'Nro de documento. Solo los digitos.',
  PRIMARY KEY (`ciu_code`,`ciu_nro_doc`),
  KEY `fk_ciudadanos_identificacion_idx` (`ciu_code`),
  CONSTRAINT `fk_ciudadanos_identificacion` FOREIGN KEY (`ciu_code`) REFERENCES `ciu_ciudadanos` (`ciu_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciu_identificacion`
--

LOCK TABLES `ciu_identificacion` WRITE;
/*!40000 ALTER TABLE `ciu_identificacion` DISABLE KEYS */;
INSERT INTO `ciu_identificacion` VALUES (36,'ARG DNI 20470276'),(59,'ARG DNI 20300300');
/*!40000 ALTER TABLE `ciu_identificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciu_paises`
--

DROP TABLE IF EXISTS `ciu_paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciu_paises` (
  `cpa_code` char(3) NOT NULL,
  `cpa_descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cpa_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciu_paises`
--

LOCK TABLES `ciu_paises` WRITE;
/*!40000 ALTER TABLE `ciu_paises` DISABLE KEYS */;
INSERT INTO `ciu_paises` VALUES ('ABW','Aruba'),('AFG','Afghanistan'),('AGO','Angola'),('AIA','Anguilla'),('ALA','Åland Islands'),('ALB','Albania'),('AND','Andorra'),('ANT','Netherlands Antilles'),('ARE','United Arab Emirates'),('ARG','Argentina'),('ARM','Armenia'),('ASM','American Samoa'),('ATA','Antarctica'),('ATF','French Southern Territories'),('ATG','Antigua and Barbuda'),('AUS','Australia'),('AUT','Austria'),('AZE','Azerbaijan'),('BDI','Burundi'),('BEL','Belgium'),('BEN','Benin'),('BFA','Burkina Faso'),('BGD','Bangladesh'),('BGR','Bulgaria'),('BHR','Bahrain'),('BHS','Bahamas'),('BIH','Bosnia and Herzegovina'),('BLM','Saint Barthélemy'),('BLR','Belarus'),('BLZ','Belize'),('BMU','Bermuda'),('BOL','Bolivia, Plurinational State of'),('BRA','Brazil'),('BRB','Barbados'),('BRN','Brunei Darussalam'),('BTN','Bhutan'),('BVT','Bouvet Island'),('BWA','Botswana'),('CAF','Central African Republic'),('CAN','Canada'),('CCK','Cocos (Keeling) Islands'),('CHE','Switzerland'),('CHL','Chile'),('CHN','China'),('CIV','Côte d\'Ivoire'),('CMR','Cameroon'),('COD','Congo, the Democratic Republic of the'),('COG','Congo'),('COK','Cook Islands'),('COL','Colombia'),('COM','Comoros'),('CPV','Cape Verde'),('CRI','Costa Rica'),('CUB','Cuba'),('CXR','Christmas Island'),('CYM','Cayman Islands'),('CYP','Cyprus'),('CZE','Czech Republic'),('DEU','Germany'),('DJI','Djibouti'),('DMA','Dominica'),('DNK','Denmark'),('DOM','Dominican Republic'),('DZA','Algeria'),('ECU','Ecuador'),('EGY','Egypt'),('ERI','Eritrea'),('ESH','Western Sahara'),('ESP','Spain'),('EST','Estonia'),('ETH','Ethiopia'),('FIN','Finland'),('FJI','Fiji'),('FLK','Falkland Islands (Malvinas)'),('FRA','France'),('FRO','Faroe Islands'),('FSM','Micronesia, Federated States of'),('GAB','Gabon'),('GBR','United Kingdom'),('GEO','Georgia'),('GGY','Guernsey'),('GHA','Ghana'),('GIB','Gibraltar'),('GIN','Guinea'),('GLP','Guadeloupe'),('GMB','Gambia'),('GNB','Guinea-Bissau'),('GNQ','Equatorial Guinea'),('GRC','Greece'),('GRD','Grenada'),('GRL','Greenland'),('GTM','Guatemala'),('GUF','French Guiana'),('GUM','Guam'),('GUY','Guyana'),('HKG','Hong Kong'),('HMD','Heard Island and McDonald Islands'),('HND','Honduras'),('HRV','Croatia'),('HTI','Haiti'),('HUN','Hungary'),('IDN','Indonesia'),('IMN','Isle of Man'),('IND','India'),('IOT','British Indian Ocean Territory'),('IRL','Ireland'),('IRN','Iran, Islamic Republic of'),('IRQ','Iraq'),('ISL','Iceland'),('ISR','Israel'),('ITA','Italy'),('JAM','Jamaica'),('JEY','Jersey'),('JOR','Jordan'),('JPN','Japan'),('KAZ','Kazakhstan'),('KEN','Kenya'),('KGZ','Kyrgyzstan'),('KHM','Cambodia'),('KIR','Kiribati'),('KNA','Saint Kitts and Nevis'),('KOR','Korea, Republic of'),('KWT','Kuwait'),('LAO','Lao People\'s Democratic Republic'),('LBN','Lebanon'),('LBR','Liberia'),('LBY','Libyan Arab Jamahiriya'),('LCA','Saint Lucia'),('LIE','Liechtenstein'),('LKA','Sri Lanka'),('LSO','Lesotho'),('LTU','Lithuania'),('LUX','Luxembourg'),('LVA','Latvia'),('MAC','Macao'),('MAF','Saint Martin (French part)'),('MAR','Morocco'),('MCO','Monaco'),('MDA','Moldova, Republic of'),('MDG','Madagascar'),('MDV','Maldives'),('MEX','Mexico'),('MHL','Marshall Islands'),('MKD','Macedonia, the former Yugoslav Republic'),('MLI','Mali'),('MLT','Malta'),('MMR','Myanmar'),('MNE','Montenegro'),('MNG','Mongolia'),('MNP','Northern Mariana Islands'),('MOZ','Mozambique'),('MRT','Mauritania'),('MSR','Montserrat'),('MTQ','Martinique'),('MUS','Mauritius'),('MWI','Malawi'),('MYS','Malaysia'),('MYT','Mayotte'),('NAM','Namibia'),('NCL','New Caledonia'),('NER','Niger'),('NFK','Norfolk Island'),('NGA','Nigeria'),('NIC','Nicaragua'),('NIU','Niue'),('NLD','Netherlands'),('NOR','Norway'),('NPL','Nepal'),('NRU','Nauru'),('NZL','New Zealand'),('OMN','Oman'),('PAK','Pakistan'),('PAN','Panama'),('PCN','Pitcairn'),('PER','Peru'),('PHL','Philippines'),('PLW','Palau'),('PNG','Papua New Guinea'),('POL','Poland'),('PRI','Puerto Rico'),('PRK','Korea, Democratic People\'s Republic of'),('PRT','Portugal'),('PRY','Paraguay'),('PSE','Palestinian Territory, Occupied'),('PYF','French Polynesia'),('QAT','Qatar'),('REU','Réunion'),('ROU','Romania'),('RUS','Russian Federation'),('RWA','Rwanda'),('SAU','Saudi Arabia'),('SDN','Sudan'),('SEN','Senegal'),('SGP','Singapore'),('SGS','South Georgia and the South Sandwich Is'),('SHN','Saint Helena, Ascension and Tristan da'),('SJM','Svalbard and Jan Mayen'),('SLB','Solomon Islands'),('SLE','Sierra Leone'),('SLV','El Salvador'),('SMR','San Marino'),('SOM','Somalia'),('SPM','Saint Pierre and Miquelon'),('SRB','Serbia'),('STP','Sao Tome and Principe'),('SUR','Suriname'),('SVK','Slovakia'),('SVN','Slovenia'),('SWE','Sweden'),('SWZ','Swaziland'),('SYC','Seychelles'),('SYR','Syrian Arab Republic'),('TCA','Turks and Caicos Islands'),('TCD','Chad'),('TGO','Togo'),('THA','Thailand'),('TJK','Tajikistan'),('TKL','Tokelau'),('TKM','Turkmenistan'),('TLS','Timor-Leste'),('TON','Tonga'),('TTO','Trinidad and Tobago'),('TUN','Tunisia'),('TUR','Turkey'),('TUV','Tuvalu'),('TWN','Taiwan, Province of China'),('TZA','Tanzania, United Republic of'),('UGA','Uganda'),('UKR','Ukraine'),('UMI','United States Minor Outlying Islands'),('URY','Uruguay'),('USA','United States'),('UZB','Uzbekistan'),('VAT','Holy See (Vatican City State)'),('VCT','Saint Vincent and the Grenadines'),('VEN','Venezuela, Bolivarian Republic of'),('VGB','Virgin Islands, British'),('VIR','Virgin Islands, U.S.'),('VNM','Viet Nam'),('VUT','Vanuatu'),('WLF','Wallis and Futuna'),('WSM','Samoa'),('YEM','Yemen'),('ZAF','South Africa'),('ZMB','Zambia'),('ZWE','Zimbabwe');
/*!40000 ALTER TABLE `ciu_paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciu_sesiones`
--

DROP TABLE IF EXISTS `ciu_sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciu_sesiones` (
  `cse_code` int(10) NOT NULL COMMENT 'código de sesión',
  `ciu_code` int(10) NOT NULL COMMENT 'codigo de ciudadano',
  `cse_ani` varchar(15) DEFAULT NULL COMMENT 'Nro de origen',
  `cse_tstamp` datetime DEFAULT NULL COMMENT 'Fecha y hora de la llamada',
  `cse_duracion` int(10) DEFAULT NULL COMMENT 'Duracion en segundos de la sesión',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'operador',
  `cse_nota` varchar(500) DEFAULT NULL COMMENT 'observacion',
  `cse_derivado` varchar(20) DEFAULT NULL COMMENT 'Comunicación derivada a otra area',
  `cse_call_id` varchar(20) DEFAULT NULL COMMENT 'Identificador único de llamada en la central',
  `cse_skill` varchar(50) DEFAULT NULL COMMENT 'habilidad del operador',
  `cse_estado` varchar(20) DEFAULT NULL COMMENT 'estado de la sesión ACTIVA / INACTIVA',
  PRIMARY KEY (`cse_code`,`ciu_code`),
  KEY `fk_ciudadanos_sesiones_idx` (`ciu_code`),
  CONSTRAINT `fk_ciudadanos_sesiones` FOREIGN KEY (`ciu_code`) REFERENCES `ciu_ciudadanos` (`ciu_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciu_sesiones`
--

LOCK TABLES `ciu_sesiones` WRITE;
/*!40000 ALTER TABLE `ciu_sesiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciu_sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_documents`
--

DROP TABLE IF EXISTS `doc_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_documents` (
  `doc_code` varchar(100) NOT NULL,
  `doc_storage` varchar(200) NOT NULL,
  `doc_name` varchar(200) DEFAULT NULL,
  `doc_tstamp` datetime DEFAULT NULL,
  `doc_mime` varchar(50) DEFAULT NULL,
  `doc_size` int(10) DEFAULT NULL,
  `acl_code` int(10) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `doc_extension` varchar(10) DEFAULT NULL,
  `doc_version` int(10) DEFAULT NULL,
  `doc_note` varchar(200) DEFAULT NULL,
  `doc_deleted` char(1) DEFAULT NULL,
  `doc_public` char(1) DEFAULT NULL,
  UNIQUE KEY `pk_doc_documents` (`doc_code`,`doc_storage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_documents`
--

LOCK TABLES `doc_documents` WRITE;
/*!40000 ALTER TABLE `doc_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `doc_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_calles`
--

DROP TABLE IF EXISTS `geo_calles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_calles` (
  `gca_codigo` varchar(30) DEFAULT NULL,
  `gca_descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_calles`
--

LOCK TABLES `geo_calles` WRITE;
/*!40000 ALTER TABLE `geo_calles` DISABLE KEYS */;
INSERT INTO `geo_calles` VALUES ('00284','1 DE MAYO'),('00289','10 DE FEBRERO'),('00290','11 DE SETIEMBRE'),('00292','12 DE OCTUBRE'),('00294','14 DE JULIO'),('00296','20 DE SEPTIEMBRE'),('00298','25 DE MAYO'),('00286','3 DE FEBRERO'),('04288','4288'),('00288','9 DE JULIO'),('03000','ABEL'),('00300','ACEVEDO, JOAQUIN'),('00301','ACEVEDO, MANUELANTONIO'),('00307','ACHA'),('00302','ACOSTA, FLORISBELO'),('00305','ACOSTA, MARIANO'),('03001','ADOLFO'),('03002','ADRIANA'),('00310','AGOTE, LUIS'),('02051','AGUA BLANCA'),('00312','AGUADO, ALEJANDRO'),('02218','AGUATERO'),('00315','AGUIRRE, JULIAN'),('00317','ALBARRACIN, PAULA'),('00320','ALBERDI, JUAN BAUTISTA'),('00322','ALBERTI'),('03003','ALDO'),('00325','ALEM, LEANDRO N.'),('00327','ALICE, ANTONIO'),('03004','ALICIA'),('00328','ALIGHIERI, DANTE'),('00330','ALIO, ARTURO'),('04069','ALIPPI, ELIAS'),('02250','ALLENDE, SALVADOR'),('00332','ALMAFUERTE'),('00420','ALMIRANTE BROWN'),('00333','ALMONACID, VICENTE A.'),('00334','ALONSO, JOSE'),('00335','ALSINA'),('00337','ALVARADO'),('00339','ALVAREZ CONDARCO, JOSE A.'),('00340','ALVAREZ, ANTONIO'),('00341','ALVAREZ, DONATO'),('02277','ALVAREZ, FRANCISCO'),('02219','ALVARO'),('00407','ALVEAR DE BOSCH, ELISA'),('00342','ALVEAR, CARLOS MARIA'),('00345','ALVEAR, MARCELO T. DE'),('00346','AMAYA, MARIO A. DIPUTADO'),('02106','AMBROSETTI, JUAN B.'),('00347','AMEGHINO'),('03005','ANALIA'),('00349','ANCORENA, TOMAS MANUEL'),('00350','ANDRADE, OLEGARIO VICTOR'),('03006','ANGEL'),('03007','ANGELA'),('00348','ANGELELLI, ENRIQUE MONS.'),('00351','ANTARTIDA ARGENTINA'),('02372','ANTUNEZ, ELIAS'),('00352','ARAGON'),('00355','ARANA Y GOIRI, SABINO DE'),('00356','ARAOZ, PEDRO MIGUEL'),('02217','ARDILES, JOSE L. TTE. I'),('00357','ARENAL, CONCEPCION'),('00360','ARENALES'),('03008','ARGENTINA'),('00358','ARLT, ROBERTO'),('03009','ARMANDO'),('00362','ARMENIA'),('04098','AROLA, EDUARDO'),('00365','ARRUE, LUCIANO'),('00367','ARTIGAS, JOSE GERVASIO'),('03010','ARTURO'),('02216','ARTUSO, FELIX O. SUBOF. I'),('00368','ASTURIAS'),('02290','ATAHUALPA YUPANQUI'),('02391','ATLANTICO SUR'),('02345','AV. DE LA HERRADURA'),('02351','AV. DEL HIPODROMO'),('00893','AV. PTE. A. ILLIA'),('00895','AV. PTE. PERON'),('02296','AVALO, JORGE'),('00370','AVELLANEDA'),('03142','AVENIDA EL VALLE'),('00371','AVENIDA F.'),('00375','AYACUCHO'),('04091','AYELEP'),('00377','AYOLAS'),('02150','AZARA, FELIX DE'),('00380','AZCUENAGA'),('00382','AZOPARDO, JUAN BAUTISTA'),('00383','AZURDUY, JUANA'),('00385','BAHIA BLANCA'),('04005','BAIGORRITA, MANUEL'),('02322','BALBIN, RICARDO'),('00387','BALCARCE'),('00384','BALDA, P. LORENZO'),('02342','BALERDI, BAUTISTA'),('00394','BALET, JORGE ROGER'),('00811','BANAT, GABITO'),('02314','BAÑUELOS, SANTOS'),('00386','BARRAGAN, RUDECINDO'),('02263','BATAN, DOMINGO'),('03011','BAUTISTA'),('02063','BAUTISTA, LAUREANO'),('00388','BAYLEY, GUILLERMO'),('03137','BEATRIZ'),('00391','BELGICA'),('00390','BELGRANO, MANUEL'),('02198','BELLIZONA, DIEGO M. SOLD.'),('00392','BELTRAMI, FEDERICO C.'),('00393','BELTRAN, LUIS FRAY'),('00395','BERMEJO'),('02356','BERRA, CARLOS'),('00397','BERUTI'),('00400','BESTOSO, AMBROSIO'),('00401','BIEDMA, BALDOMERO JOSE DE'),('02207','BLANCO, RENE P. SARG I'),('00806','BLAS PARERA'),('00402','BOLIVAR, SIMON'),('00403','BOLIVIA'),('02295','BONANNI, ESTEBAN ANGEL'),('00404','BONET, FERNANDO'),('02151','BONPLAND, AMADO'),('00405','BORDABEHERRE, ENZO'),('03188','BORDEU, JUAN MANUEL'),('02211','BORDON, HECTOR R. CABO'),('00406','BORGES, JORGE LUIS'),('02111','BORMIDA, MARCELO'),('04225','BORTHABURU A.'),('00408','BOSQUE GRANDE'),('02340','BOTANA, JOSE ADRIAN'),('00410','BOUCHARD, HIPOLITO'),('00412','BOUCHEZ, PEDRO'),('00414','BRADLEY, EDUARDO'),('00415','BRANDSEN'),('00416','BRASIL'),('03012','BRAULIO'),('00417','BRAVO, MARIO'),('03013','BRIGIDA'),('02320','BRONZINI, TEODORO J.'),('00422','BRUMANA, HERMINIA'),('03014','BRUNO'),('00425','BUENOS AIRES'),('02152','BURMEISTER, GERMAN'),('01415','C.DE TOSCANA'),('02349','CABEZAS, RAMON'),('00476','CABILDO'),('02102','CABRERA, ANGEL'),('00433','CABRERA, JOSE ANTONIO'),('04000','CACIQUE CHANAL'),('04010','CACIQUE CHUYANTUYA'),('04001','CACIQUE MARIQUE'),('04002','CACIQUE SACACHU'),('04003','CACIQUE TAYCHOCO'),('02255','CAFRUNE, JORGE'),('02059','CALABRESE, ENEAS'),('00432','CALABRIA'),('00426','CALABRIA BIS'),('00435','CALASANZ, SAN JOSE DE'),('00437','CALAZA, JOSE M.'),('04006','CALCHAQUI, JUAN'),('02415','CALLE 128 -BATAN'),('02413','CALLE 136 -BATAN'),('02414','CALLE 142 -BATAN'),('02412','CALLE 159 -BATAN'),('00230','CALLE 230'),('00252','CALLE 252'),('00254','CALLE 254'),('02410','CALLE 33 BIS-(BATAN)'),('02264','CALLE 35 -BATAN'),('01415','CALLE 415'),('02319','CALLE 50 -BATAN'),('04123','CALLE 663'),('00438','CALLE DEL LAGO'),('00440','CAMET, FELIX U.'),('02153','CAMET, FLORENCIO'),('02154','CAMET, JUAN PEDRO'),('03015','CAMILO'),('03180','CAMINO CACIQUE CANGAPOL'),('03179','CAMINO DEL CABILDO INDIGE'),('00454','CAMINO VIEJO A CAMET'),('00441','CAMINO VIEJO A MIRAMAR'),('02220','CAMPESINOS'),('00646','CAMUSO, JOSE INTENDENTE'),('00442','CANADA'),('04109','CANAI-QUEN'),('04099','CANARO, FRANCISCO'),('00429','CANATA, MANUEL G'),('00443','CANDELARIA, LUIS'),('02305','CANE, MIGUEL'),('00473','CANNESSA, JULIO VICENTE'),('00486','CANOSA, AMERICO RAUL'),('00445','CARASA, EDUARDO C.'),('00447','CARDIEL, JOSE PADRE'),('03016','CARLOS'),('03017','CARMEN'),('00448','CARRIEGO, EVARISTO'),('00488','CARRILLO, RAMON DR.'),('04070','CASACUBERTA, JUAN A.'),('00450','CASEROS'),('02166','CASTAGNINO, JUAN CARLOS'),('00427','CASTAGNINO, JUAN CARLOS P'),('00452','CASTELLI'),('00478','CASTEX, MARIANO R. DR.'),('00444','CASTILLA Y LEON'),('04096','CASTILLO, CATULO'),('00451','CASTRO BARROS, PEDRO I.'),('00455','CATALUÑA'),('00457','CATAMARCA'),('04007','CATRIEL, CIPRIANO'),('02353','CATUOGNO, FERNANDO'),('02341','CAYROL, CLEMENTE'),('03018','CECILIA'),('02085','CEDRO AZUL'),('00456','CERETTI, CESAR A.'),('00460','CERRITO'),('02375','CERRO ACONCAGUA'),('02386','CERRO ACONQUIJA'),('02389','CERRO ADELA'),('02388','CERRO CAMPANARIO'),('02385','CERRO FAMATINA'),('02387','CERRO FIAMBALA'),('02381','CERRO FITZ ROY'),('02379','CERRO HERMOSO'),('02374','CERRO LANIN'),('02378','CERRO MERCEDARIO'),('02511','CERRO MURALLON'),('02383','CERRO NEVADO'),('02377','CERRO PAINE'),('02376','CERRO TORRE'),('02373','CERRO TRONADOR'),('00462','CERVANTES SAAVEDRA M. DE'),('00485','CHACABUCO'),('04009','CHACAHUAC, FRANCISCO'),('00487','CHACO'),('00490','CHAMPAGNAT, SAN MARCELINO'),('00492','CHAPEAUROUGE, CARLOS'),('00495','CHARLONE'),('00497','CHILABERT, MARTINIANO'),('00500','CHILE'),('00502','CHUBUT'),('00493','CHULAK, ARMANDO'),('02062','CIANCHETTA, LORENZO'),('00466','CIOCCHINI, CLETO'),('03126','CIRCUITO GRAL. SAN MARTIN'),('00436','CIRCUNVALACION'),('02193','CISNEROS, MARIO A. SARG.'),('00413','CIUDAD DE BRAGADO'),('00531','CIUDAD DE DOLORES'),('00792','CIUDAD DE ONEGLIA'),('03215','CIUDAD DE ROMA'),('00890','CIUDAD DE ROSARIO'),('00945','CIUDAD DE SAN CAYETANO'),('01415','CIUDAD DE TOSCANA'),('03019','CLAUDIA'),('00464','COHELO DE MEYRELLES, JOSE'),('00471','COLECTORA'),('00469','COLOMBIA'),('00468','COLOMBRES, JOSE EUSEBIO'),('00465','COLON, CRISTOBAL'),('02155','COMODORO RIVADAVIA'),('00779','COMUN. FORAL DE NAVARRA'),('01397','COMUNA DE MAFALDA'),('04074','CON.DE LA DIVINA PROVIDEN'),('04017','CONIQUEYUEN YAHAN, JUAN'),('00467','CONSTITUCION'),('04076','CORBETA GRANVILLE'),('00484','CORBETA URUGUAY'),('00470','CORDOBA'),('00472','CORRIENTES'),('04100','CORSINI, ANDRES IGNACIO'),('02281','CORTAZAR, JULIO'),('02259','CORTES, HERNAN'),('02068','COSTA ATLANTICA'),('02060','COSTA AZUL'),('02066','COSTA PAMPEANA'),('00475','COSTA, JERONIMO CNEL.'),('00428','COUREL, AMADEO'),('02101','CRAMER, AMBROSIO'),('02195','CRO. A.R.A. GRAL. BELGRAN'),('00477','CROSE, BENEDETTO'),('04081','CRUCERO LA ARGENTINA'),('00479','CUBA'),('00483','CURA BROCHERO'),('00480','CURIE, MARIA'),('04008','CUTAY, JUAN'),('00482','CZETZ, JUAN CNEL'),('04095','D\'ARIENZO, JUAN'),('02197','DACHRY, ALEJANDRO TTE.'),('02054','DAGLIO, CAYETANO'),('00505','DAIREAUX, GODOFREDO'),('03154','DAMIAN'),('04071','DANERI, SANTIAGO'),('03020','DANIEL'),('03021','DANIELA'),('00507','DAPROTIS, CATALINA'),('03022','DARDO'),('00508','DARRAGUEYRA, JOSE'),('00521','DAVALOS, JUAN CARLOS'),('00510','DAVILA, ADOLFO E.'),('02273','DAZEO, NICOLAS'),('00761','DE ANDREA, MIGUEL MONS. D'),('02112','DE APARICIO, FRANCISCO'),('00513','DE ARANA, FELIPE'),('03184','DE AYESA, FELIX'),('02313','DE BALLINA, AMALIA V.'),('02265','DE CASTRO, ROSALIA'),('00557','DE ESCALADA, REMEDIOS'),('02298','DE IBARBOUROU, JUANA'),('00650','DE IRIGOYEN, BERNARDO'),('02206','DE LA COLINA, R. M. VICEC'),('00514','DE LA MAZA, JOSE AGUSTIN'),('00512','DE LA PLAZA, FORTUNATO'),('03206','DE LA REDUCCION'),('02354','DE LA ROSA, JOSE'),('00516','DE LA SALLE, JUAN B.'),('00515','DE LA TORRE, LISANDRO'),('00694','DE LAS FLORES, CARMEN'),('00517','DE LAS OLIMPIADAS'),('00506','DE LOS INMIGRANTES.'),('03207','DE LOS JESUITAS'),('04130','DE LOS LOBOS MARINOS'),('03178','DE LOS MISIONEROS'),('03191','DE LOS PEREGRINOS'),('04125','DE LOS PESCADORES'),('00866','DE LOS RESERVISTAS'),('00731','DE MARCHI, ANTONIO BARON'),('00934','DE ORO, SANTA MARIA'),('00527','DE RIEGO, RAFAEL GRAL.'),('02323','DE ROSAS, JUAN M. B. GRAL'),('02321','DEL CARRIL, HUGO'),('02202','DEL HIERRO, JOSE LUIS SOL'),('03202','DEL PUEBLO PAMPA'),('02350','DEL SOLAR, ALBERTO'),('00520','DEL VALLE, ARISTOBULO'),('04283','DEL VALLE, MARÍA REMEDIOS'),('00518','DELLA PAOLERA ING.'),('00522','DELLEPIANE, LUIS'),('02267','DEMATTEI, BALTAZAR'),('00530','DERQUI'),('04077','DESTRUCTOR HERCULES'),('02337','DEYACOBBI, JOSE'),('02328','DIAG. MAR DEL PLATA (BATA'),('00461','DIAGONAL CENTRAL'),('00549','DIAGONAL EE-UU'),('00519','DIAGONAL FAVALORO RENE'),('00519','DIAGONAL NORTE'),('02208','DIARTE, OSCAR DANIEL SOLD'),('02212','DIAZ, ANTONIO MARIO SOLD.'),('00529','DICEPOLO, SANTOS'),('02107','DIECKMANN, J.'),('03023','DIEGO'),('01431','DIETSCH, JOSE RODOLFO'),('04011','DOCNOYAHAL, JOSE'),('03024','DOMINGO'),('00532','DON BOSCO'),('00535','DON ORIONE'),('03025','DOROTEA'),('00537','DORREGO'),('04289','DR MAZZA S.'),('04288','DR.ESTEBAN MARADONA'),('04285','DR.GUILLERMO BOSCH MAYOL'),('04286','DR.JUAN TESONE'),('04288','DR.MARADONA ESTEBAN'),('02324','DUARTE DE PERON, EVA'),('02188','DUFRECHON, ANTONIO MAYOR'),('00538','DUTTO, JOSE PADRE'),('00540','ECHEVERRIA, ESTEBAN'),('00541','ECUADOR'),('00542','EDISON, TOMAS'),('03296','EGIDIO'),('00545','EINSTEIN, ALBERTO'),('02282','EL AMERICANO'),('04061','EL BENTEVEO'),('00550','EL CANO'),('04060','EL CARPINTERO'),('03146','EL CERRO'),('04054','EL CHAJA'),('04053','EL CHINGOLO'),('04062','EL CHURRINCHE'),('02284','EL COLMENAR'),('04057','EL CORBATITA'),('03205','EL ESTRIBO'),('00573','EL FARO'),('04048','EL GAVIOTON'),('04046','EL GORRION'),('02156','EL HORNERO'),('04059','EL JILGERO'),('03203','EL LAZO'),('04064','EL LEÑATERO'),('03148','EL MANANTIAL'),('03141','EL MIRADOR'),('04055','EL MIXTO'),('03150','EL MONTE'),('00551','EL PAMPERO'),('03143','EL PARAJE'),('04127','EL PEJERREY'),('04065','EL PIRINCHO'),('03204','EL RECADO'),('03138','EL REMANZO'),('02157','EL TEJADO'),('04058','EL TERO'),('04049','EL TORDO'),('03026','ELENA'),('03027','ELINA'),('03028','ELISA'),('03029','ELSA'),('03030','EMILIO'),('03031','EMMA'),('02338','ENGLENDER, HORACIO'),('03032','ENRIQUE'),('00552','ENTRE RIOS'),('00555','ERREA, FERMIN DR.'),('00560','ESPAÑA'),('00562','ESPINDOLA'),('02158','ESQUEL'),('00565','ESQUIU, MAMERTO FRAY'),('00566','ESQUIVEL, EMILIO J.'),('04040','EST. LAGUNA DE LOS PADRES'),('04044','EST. S.JULIAN DE VIVORATA'),('02306','EST. SAN CIPRIANO'),('00547','ESTADO DE ISRAEL'),('04034','ESTANCIA CABO CORRIENTES'),('04035','ESTANCIA CHAPADMALAL'),('04033','ESTANCIA COPELINA'),('04032','ESTANCIA EL BOQUERON'),('04036','ESTANCIA ITUZAINGO'),('04037','ESTANCIA LA ARMONIA'),('04038','ESTANCIA LA COLMENA'),('04039','ESTANCIA LA CORONA'),('04041','ESTANCIA LA PEREGRINA'),('04042','ESTANCIA LA REFORMA'),('04043','ESTANCIA OJO DE AGUA'),('02329','ESTANCIA SAN JUSTO'),('03033','ESTELA'),('03034','ESTER'),('00567','ESTRADA, JOSE MANUEL'),('04111','ESTRELLA DE MAR'),('00548','ETCHEGARAY, MARCELINO'),('03035','EUGENIA'),('00569','EUSEBIONE, LORENZO'),('03036','EVA'),('03037','EVARISTO'),('03038','FABIAN'),('00584','FAGNANI, VICTORIO'),('02204','FALCONIER, JUAN JOSE R.'),('00570','FALKNER, TOMAS'),('00572','FALUCHO'),('00897','FANGIO, JUAN M. RUTA JARD'),('02213','FAUR, JOSE DANTE SOBOFIC.'),('03039','FAUSTINO'),('03040','FELIPE'),('03041','FELIX'),('02254','FERNANDEZ MORENO, B.'),('00578','FERNANDEZ, JUAN N.'),('00583','FERNANDEZ, MACEDONIO'),('00581','FERRARI DE GAUDINO, M. T.'),('00574','FERRE, PEDRO'),('00589','FERRER, FRANCISCO'),('02189','FERREYRO, ALDO OMAR SOLD.'),('00575','FIGUEROA ALCORTA'),('00588','FILIBERTO, JUAN DE DIOS'),('00571','FINOCHIETTO, ENRIQUE DR.'),('00576','FIRPO, LUIS ANGEL'),('00579','FITTE, MARCELO DR.'),('00577','FLEMING, ALEJANDRO'),('03042','FLORENCIA'),('03043','FLORENCIO'),('04094','FLORES, CELEDONIO'),('00580','FORMOSA'),('04086','FRAGATA HALCON'),('04085','FRAGATA ITATI'),('04088','FRAGATA LIBERTAD'),('04087','FRAGATA MALDONADO'),('04029','FRAGATA SARMIENTO'),('02343','FRAGNAUD, LEON'),('03044','FRANCA'),('00582','FRANCIA'),('03136','FRANCISCA'),('03045','FRANCISCO'),('00585','FRENCH'),('02097','FRENGUELLI, JOAQUIN'),('04097','FRESEDO, OSVALDO'),('00586','FRIULI'),('00587','FRUGONI, IGNACIO'),('00590','FUNES'),('03183','FURLONG, GUILLERMO PADRE'),('00592','GABOTO'),('03046','GABRIEL'),('02307','GALDOS, CELESTINO'),('02056','GALEANA, ANTONIO'),('00595','GALICIA'),('02159','GALLARDO, ANGEL'),('02191','GALLO, LUIS ANTONIO SUBOF'),('02065','GANDHI, MAHATMA'),('00599','GARAGIOLA, AMBROSIO'),('02347','GARAU, SEBASTIAN'),('00600','GARAY'),('00601','GARCIA LORCA'),('02303','GARCIA, PLACIDO'),('00603','GARDEL, CARLOS'),('02335','GARDELLA, ANGEL'),('00602','GARIBALDI, JOSE'),('00605','GASCON'),('00606','GASCON, CESAR'),('00611','GAUDINI, HORACIO'),('02196','GAVAZZI, FAUSTO CAPIT.'),('02312','GEMOLI DE OLIVA, EMMA'),('03047','GENARO'),('00607','GENOVA'),('03048','GERTRUDIS'),('04073','GHERSI, CONCEPTA MADRE'),('02214','GIACHINO, P. E. CAP. FRAG'),('00610','GIACOBINI, GENARO'),('00612','GIANELLI, ANTONIO MARIA'),('02251','GMEINER, HEMMAN DR.'),('00614','GODOY CRUZ, TOMAS'),('04030','GOLETA SARANDI'),('00619','GOÑI, JUAN B.'),('00608','GONZALEZ CHAVES, ADOLFO'),('00626','GONZALEZ GUERRICO, MANUEL'),('02160','GONZALEZ SEGURA, CESAR'),('00615','GONZALEZ, ELPIDIO'),('00617','GONZALEZ, JOAQUIN V.'),('02268','GOROZO, GREGORIO'),('00620','GORRITI, JUANA MANUELA'),('02357','GOYENA, PEDRO'),('04137','GOYENECHE, ROBERTO'),('03049','GRACIELA'),('04045','GRANJA LA MARUCHA'),('00622','GRECIA'),('03050','GREGORIO'),('04287','GRIERSON C.'),('02098','GROEBER, PABLO'),('04023','GUADACOSTA ISLAS MALVINAS'),('00625','GUANAHANI'),('04022','GUARDACOSTA RIO IGUAZU'),('00623','GUAYANA'),('00627','GUEMES, JUAN MARTIN'),('02278','GUEMES, MACACHA'),('00609','GUERNICA'),('00633','GUERRA, JUAN NESTOR'),('02161','GUERRICO, ANATILDE'),('00628','GUEVARA, ERNESTO \"CHE\"'),('02276','GUEVARA, TRINIDAD'),('00624','GUGLIELMOTTI, MIGUEL'),('00630','GUIDO'),('03051','GUILLERMO'),('00629','GUIRALDES, RICARDO'),('02192','GURRIERI, RICARDO SOLD.'),('00631','GUTENBERG, JUAN'),('00634','GUTENBERG, JUAN BIS'),('00632','GUTIERREZ, RICARDO'),('02366','HARAS ABOLENGO'),('02369','HARAS COMALAL'),('02359','HARAS EL ALFAR'),('02361','HARAS EL CANDIL'),('02371','HARAS EL TURF'),('02360','HARAS EL VENCEDOR'),('02365','HARAS FIRMAMENTO'),('02362','HARAS HORIZONTE'),('02367','HARAS LA BIZNAGA'),('02368','HARAS LA MADRUGADA'),('02370','HARAS LAS ORTIGAS'),('02364','HARAS MALAL HUE'),('02363','HARAS VACACION'),('03052','HECTOR'),('02162','HEENCKE, TADEO'),('00636','HEGUILOR, DOMINGO'),('00635','HERNANDARIAS'),('00637','HERNANDEZ, JOSE'),('02304','HEROES DE MALVINAS'),('02221','HERRERIA'),('03053','HIGINIO'),('03054','HILARIO'),('03055','HILDA'),('03056','HIPOLITO'),('02163','HOLMBERG, EDUARDO L.'),('02109','HOUSSAY, BERNARDO A.'),('00640','HUDSON, GUILLERMO E.'),('03057','HUGO'),('00561','IDIOMA INTERNAC. ESPERANT'),('03058','IGNACIO'),('04107','INCA-HUEN'),('00641','INDA, RUFINO'),('00642','INDEPENDENCIA'),('03059','INES'),('00645','INGENIEROS, JOSE'),('00647','IRALA'),('03060','IRENE'),('03061','ISABEL'),('03062','ISIDORO'),('02394','ISLA BLANCO'),('02401','ISLA CALENDARIA'),('02400','ISLA CORONACION'),('02403','ISLA DE BORBON'),('00474','ISLA DE CERDEÑA'),('00643','ISLA DE ISCHIA'),('02399','ISLA DE LOS ESTADOS'),('02407','ISLA ELEFANTE'),('02408','ISLA JOINVILLE'),('02395','ISLA LAURIE'),('02405','ISLA PAJAROS'),('02404','ISLA REMOLINOS'),('02396','ISLA SEBALDES'),('02067','ISLA SOLEDAD'),('02619','ISLA SOLEDAD CENTRAL'),('02406','ISLA TRAVERSE'),('02398','ISLA TRINIDAD'),('02409','ISLA TULE (TULE DEL SUR)'),('02397','ISLA VIGIA'),('01417','ISLAS BALEARES'),('00652','ITALIA'),('03289','ITURRIOZ RAMON'),('00655','ITUZAINGO'),('03063','JACINTO'),('00657','JARA, JUAN HECTOR'),('02258','JAUREGUI, JUAN'),('00658','JAURETCHE, ARTURO'),('00661','JEWETT, DAVID'),('03064','JOAQUIN'),('03065','JORGE'),('03066','JOSE'),('03067','JOSEFINA'),('00659','JOVELLANOS, GASPAR M.'),('03068','JUAN'),('03069','JUANA'),('00660','JUAREZ, BENITO'),('00662','JUJUY'),('02201','JUKIC, DANIEL AANTONIO TT'),('03070','JULIA'),('03071','JULIAN'),('00665','JUNCAL'),('00667','JURAMENTO'),('03072','JUSTO'),('00670','JUSTO, JUAN B. DR.'),('00671','KENNEDY, JOHN FITZGERALD'),('00672','KORN, ALEJANDRO'),('02096','KRAGLIEVICH, LUCAS'),('02210','KRAUSE, CARLOS E. CAPIT.'),('02090','LA AURORA'),('02164','LA CALANDRIA'),('02330','LA CANTERA - CONS. CAM. 6'),('04056','LA CIGUEÑA'),('03144','LA COLINA'),('03139','LA CUESTA'),('04051','LA GOLONDRINA'),('03153','LA LAGUNA'),('02165','LA LAURA'),('03152','LA LOMADA'),('00689','LA PAMPA'),('02069','LA PRIMAVERA'),('03149','LA QUEBRADA'),('04063','LA RATONERA'),('00691','LA RIOJA'),('02302','LA SERRANA'),('03147','LA SERRANIA'),('04050','LA TORCACITA'),('03201','LA TROPILLA'),('03151','LA VAGUADA'),('00828','LA VIA'),('00693','LABARDEN'),('02336','LABORANTE, VICENTE'),('04012','LACAMTU, SANTIAGO'),('02108','LAHILLE, FERNANDO'),('00675','LAMADRID'),('00677','LANZILLOTA, JOSE'),('00680','LAPRIDA'),('02269','LARRAYA, EMILIO MARTIN'),('00682','LARREA'),('02261','LARRETA, ENRIQUE'),('02315','LAS ALAMEDAS'),('04115','LAS ALMEJAS'),('03195','LAS AZALEAS'),('02226','LAS AZUCENAS'),('04128','LAS BALLENAS'),('02052','LAS CABRILLAS'),('02233','LAS CAMELIAS'),('04103','LAS CARACOLAS'),('00453','LAS CASUARINAS'),('04112','LAS CENTOLLAS'),('02275','LAS CHARITAS'),('04116','LAS CORVINAS'),('02077','LAS DALIAS'),('04134','LAS FOCAS'),('02088','LAS FRECIAS'),('03193','LAS FRESAS'),('02231','LAS GARDENIAS'),('03189','LAS GROSELLAS'),('03209','LAS HAYAS'),('00685','LAS HERAS'),('02074','LAS HIGUERAS'),('02092','LAS LAMBRECIANAS'),('04118','LAS LISAS'),('02301','LAS LOMAS'),('04110','LAS MADREPERLAS'),('02237','LAS MAGNOLIAS'),('02080','LAS MARAVILLAS'),('04126','LAS NUTRIAS'),('04133','LAS ORCAS'),('04121','LAS OSTRAS'),('02082','LAS PALMERAS'),('04119','LAS PALOMETAS'),('04104','LAS RETAMAS'),('02232','LAS ROSAS'),('04132','LAS TONINAS'),('04124','LAS TORTUGAS'),('02084','LAS TOTORAS'),('02228','LAS VIOLETAS'),('02327','LATUF, RAFAEL'),('03073','LAURA'),('00687','LAVALLE'),('03074','LEANDRO'),('00690','LEBENSOHN, MOISES'),('00692','LEGUIZAMON, ONESIMO'),('02318','LELOIR, LUIS'),('04101','LEPERA, ALFREDO'),('03075','LETICIA'),('03076','LIA'),('00695','LIBERTAD'),('02316','LIBERTADOR GRAL. SAN MART'),('00697','LIBRES DEL SUR'),('03077','LIDIA'),('00700','LIJO LOPEZ, JOSE'),('03078','LILIANA'),('02167','LILLO, LUIS'),('00702','LINIERS'),('00699','LITUANIA'),('02205','LLAMAS, JORGE ALBERTO SOL'),('00704','LOBERIA'),('04226','LOMBARDIA'),('00705','LOPEZ DE GOMARA, JUSTO S.'),('00710','LOPEZ Y PLANES, VICENTE'),('00707','LOPEZ, VICENTE'),('00711','LORENZINI, CAROLA'),('02168','LOS ABETOS'),('00316','LOS ALAMOS'),('02225','LOS ALELIES'),('00326','LOS ALGARROBOS'),('03194','LOS ALMENDROS'),('00712','LOS ANDES'),('03208','LOS ARCES'),('04117','LOS ARENQUES'),('00363','LOS AROMOS'),('02089','LOS ARRAYANES'),('03190','LOS AVELLANOS'),('04120','LOS CALAMARES'),('00439','LOS CALDENES'),('02169','LOS CASTAÑOS'),('00458','LOS CEDROS'),('02091','LOS CEIBOS'),('02078','LOS CEREZOS'),('03196','LOS CHIMANGOS'),('03212','LOS CIRUELOS'),('02229','LOS CLAVELES'),('04108','LOS CORALES'),('02411','LOS CURROS'),('04129','LOS DELFINES'),('02072','LOS DURAZNEROS'),('00568','LOS EUCALIPTUS'),('02236','LOS GERANIOS'),('02230','LOS GLADIOLOS'),('02076','LOS GRANADOS'),('03199','LOS HALCONES'),('02081','LOS HELECHOS'),('04106','LOS HIPOCAMPOS'),('03214','LOS INCIENSOS'),('02234','LOS JAZMINES'),('02083','LOS JUNCOS'),('02071','LOS LIMONEROS'),('02227','LOS LIRIOS'),('02070','LOS MANZANOS'),('04122','LOS MEJILLONES'),('03210','LOS MIMBRES'),('03198','LOS MIRLOS'),('02073','LOS NARANJOS'),('02235','LOS NARDOS'),('04131','LOS NARVALES'),('04114','LOS NAUTILOS'),('00783','LOS NOGALES'),('03213','LOS OLIVARES'),('00791','LOS OLMOS'),('00715','LOS OMBUES'),('02260','LOS ORTIZ'),('03145','LOS PEÑASCOS'),('03211','LOS PERALES'),('00835','LOS PINOS'),('00836','LOS PLATANOS'),('02079','LOS QUEBRACHOS'),('00875','LOS ROBLES'),('04113','LOS SALMONES'),('00929','LOS SAUCES'),('02075','LOS TALAS'),('02170','LOS TILOS'),('02238','LOS TULIPANES'),('03197','LOS ZORZALES'),('00706','LUCANIA'),('03079','LUCIANO'),('03080','LUCIO'),('00718','LUGONES, LEOPOLDO'),('03081','LUIS'),('03082','LUISA'),('00716','LUISONI, ARTURO PEDRO'),('02203','LUNA, MARIO RAMON CABO'),('00717','LURO, PEDRO'),('00714','LUZURIAGA, TORIBIO DE'),('00719','LYNCH, BENITO'),('03083','MABEL'),('00721','MAC GAUL, ANDRES'),('02288','MACHADO, ANTONIO'),('00724','MADARIAGA, JUAN Gral.'),('00729','MAGALDI, AGUSTIN'),('00720','MAGALLANES'),('00763','MAGNASCO, OSVALDO DR.'),('00722','MAIPU'),('04093','MAIZANI, AZUCENA'),('00723','MALABIA, JOSE SEVERO F.'),('02297','MALLEA, EDUARDO'),('00725','MALVINAS'),('00727','MANSILLA, LUCIO GRAL.'),('00730','MANSO, JUANA'),('00975','MANUWAL, ARIEL V.'),('00738','MANZI, HOMERO DIG.'),('02392','MAR AUSTRAL'),('00813','MAR DEL PLATA'),('00732','MARCONI, GUILLERMO ING.'),('03084','MARCOS'),('00726','MARECHAL, LEOPOLDO'),('03085','MARGARITA'),('03086','MARIA'),('03087','MARIANA'),('00735','MARIANI, JUAN'),('03088','MARIANO'),('03089','MARIO'),('00737','MARMOL, JOSE'),('02209','MARQUEZ, MARCELO G. T.FRA'),('02171','MARQUEZ, RAMON T. CNEL.'),('03090','MARTA'),('00740','MARTI, JOSE'),('03091','MARTIN'),('02222','MARTIN FIERROS'),('00733','MARTIN, BENITO QUINQUELA'),('02344','MARTINEZ BAYA, ALFREDO'),('00741','MARTINEZ DE HOZ, FLORENCI'),('00742','MARTINEZ DE HOZ, MIGUEL A'),('00999','MARTINEZ ZUVIRIA, GUSTAVO'),('02064','MARTINEZ, ANTONIO'),('00743','MASCIAS, ALBERTO ROQUE'),('00745','MATHEU'),('00746','MATIENZO, BENJAMIN'),('03092','MATILDE'),('00747','MATTEOTI, GIACOMO'),('03093','MAURO'),('00749','MEDRANO, PEDRO'),('00750','MEJICO'),('02252','MELGA, CARLOS'),('02283','MEMBRIVES, DOLORES \"LOLA\"'),('00753','MENDEZ F.DE MILLÁN, MARÍA'),('00754','MENDEZ, LEOPOLDO'),('00751','MENDIOROZ, BAUTISTA'),('00752','MENDOZA'),('02110','MENGHIN, EDUARDO'),('03094','MERCEDES'),('02094','MICHEL, TERESA V.M.'),('03095','MIGUEL'),('00757','MISIONES'),('02289','MISTRAL, GABRIELA'),('00760','MITRE'),('00768','MOLTENI, ABELARDO VECINAL'),('02050','MONSALVO'),('02294','MONTE MALABRIGO'),('02382','MONTE OLIVIA'),('00765','MONTES CARBALLO, V. PRESB'),('00762','MONTES, VICTORIANO E. DR.'),('02287','MORA, DOLORES \"LOLA\"'),('02271','MOREAU DE JUSTO, ALICIA'),('00767','MORENO'),('00770','MORRIS'),('00772','MOSCONI, ENRIQUE C.A.GRAL'),('02172','MOYANO, JUAN CARLOS'),('00775','MUGABURU, PASCUALA'),('02266','MUJICA, CARLOS PADRE'),('03182','N. S. DE LOS DESAMPARADOS'),('02173','NAHUEL HUAPI'),('02308','NALE ROXLO C (BATAN)'),('00778','NAMUNCURA, CEFERINO'),('00777','NAPOLES'),('03096','NARCISO'),('00862','NASSER,GAMAL ABDEL'),('03097','NATALIA'),('03098','NATIVIDAD'),('00780','NECOCHEA'),('00781','NERUDA, PABLO'),('03099','NESTOR'),('00782','NEUQUEN'),('00784','NEWBERY, EDUARDO'),('04102','NEWBERY, JORGE'),('00776','NICARAGUA'),('03100','NOEMI'),('03101','NORA'),('03102','NORBERTO'),('03181','NTRA. SRA. DE LA CONCEPCI'),('03186','NUSDORFFER, BERNARDO PDRE'),('00785','O HIGGINS, BERNARDO'),('02256','OBLIGADO, RAFAEL'),('03103','OFELIA'),('04013','OLAN, IGNACIO'),('00787','OLAVARRIA'),('00790','OLAZABAL'),('00789','OLAZAR, OLEGARIO'),('03104','OLGA'),('00793','OMBU'),('00794','ORIGONE, MANUEL FELIX'),('02326','ORO NEGRO'),('00797','ORTEGA Y GASSET, JOSE'),('00795','ORTEGA, DAVID PRESBITERO'),('00800','ORTIZ DE ZARATE'),('03105','OSCAR'),('03106','OSVALDO'),('02087','OUTES, FELIX F.'),('03107','OVIDIO'),('03108','PABLO'),('02086','PABON, PEDRO P.'),('00803','PACHECO DE MELO, JOSE A.'),('00801','PACHECO, ANGEL GRAL.'),('02215','PACHOLCZUK, ROLANDO M. SO'),('02291','PACINI DE ALVEAR, REGINA'),('04068','PAGANO, ANGELINA'),('02272','PALACIOS, ALFREDO L.'),('04089','PALESTINA'),('00802','PALMA, RICARDO'),('00805','PARAGUAY'),('02105','PARODI, LORENZO'),('02274','PARRA, VIOLETA'),('04067','PARRAVICINI, FLORENCIO'),('00459','PASAJE CATEDRAL'),('00511','PASAJE DE ANGELIS'),('03109','PASCUAL'),('00597','PASEO JESUS DE GALINDEZ'),('00810','PASO, JUAN JOSE'),('00812','PASTEUR'),('00814','PATAGONES'),('02174','PATAGONIA AV.'),('03110','PATRICIA'),('03111','PAULA'),('00816','PAUNERO GRAL.'),('00817','PAYRO, ROBERTO J.'),('00808','PAZ GRAL.'),('00818','PEDRAZA, MANUELA'),('03112','PEDRO'),('00809','PEDRONI, JOSE'),('00821','PEHUAJO'),('00819','PELAYO'),('00820','PELLEGRINI, CARLOS'),('00822','PEÑA, JUAN A.'),('02279','PEÑALOZA, ANGEL VICENTE'),('00827','PERALTA RAMOS, ARTURO'),('00829','PERALTA RAMOS, EDUARDO'),('00824','PERALTA RAMOS, JACINTO'),('00826','PERALTA RAMOS, PATRICIO'),('02262','PEREDA, JUAN JOSE INT.'),('00423','PEREZ BULNES, EDUARDO'),('02175','PERITO MORENO'),('00830','PERU'),('00832','PESCADORES'),('04024','PESQUERA PALMA MADRE'),('04026','PESQUERO HALCON'),('04027','PESQUERO HAPPY DAYS'),('04078','PESQUERO KONTIKI'),('04019','PESQUERO NARWAL'),('04028','PESQUERO NOMADE'),('04025','PESQUERO PUMARA'),('04031','PESQUERO QUO VADIS'),('04105','PEUMAYEN'),('04230','PIAZZOLA A:'),('00834','PIEDRABUENA, LUIS CTTE.'),('03113','PIERINA'),('00833','PIGUE'),('04090','PIÑACAL'),('02257','PINZON MARTIN A (BATAN)'),('00831','PIRAN, JOSE MARIA GRAL.'),('02310','PIZARRO, FRANCISCO'),('02194','PLANES, MARCELO G. SOLD.'),('00823','PLUS ULTRA'),('02190','POLITIS, JORGE N. PILOTO'),('00838','POLONIA'),('04080','PORTAVIONES INDEPENDENCIA'),('00841','PORTUGAL'),('00840','POSADAS'),('03114','PRAXEDES'),('00842','PRIMERA JUNTA'),('00844','PRINGLES'),('00846','PUAN'),('02176','PUERTO MADRYN'),('00848','PUEYRREDON'),('02057','PUJIA, JOSE'),('02311','PURA SAGASTA'),('03185','QUERINI, MANUEL PADRE'),('02177','QUESADA JOSUE'),('00850','QUINTANA, MANUEL'),('02358','QUINTERO, FRANCISCO AV.'),('00852','QUIROGA, HORACIO'),('02280','QUIROGA, JUAN FACUNDO'),('00863','RACEDO, EDUARDO TTE. GRAL'),('01469','RAMIREZ, FRANCISCO GRAL.'),('03115','RAQUEL'),('00857','RATERIY, JULIO ING.'),('00764','RAU, ENRIQUE MONS.'),('00855','RAUCH, FEDERICO CNEL.'),('00856','RAWSON'),('04092','RAZZANO, JOSE'),('00901','RCCION. NTRA.SRA.DEL PILA'),('00858','REFORMA UNIVERSITARIA'),('00859','REJON, GERONIMO'),('00860','REMOLCADOR GUARANI'),('00861','REPUBLICA ARABE SIRIA'),('00939','REPUBLICA DE SUDAFRICA'),('00864','REPUBLICA DEL LIBANO'),('03116','RICARDO'),('02103','RINGUELET, RAUL'),('03166','RIO AGUAPEY'),('03177','RIO ATUEL'),('03165','RIO BELEN'),('03159','RIO BLANCO'),('03167','RIO CALCHAQUI'),('03160','RIO CANDELARIA'),('03157','RIO COLORADO'),('03162','RIO CORCOVADO'),('03174','RIO CURACO'),('03169','RIO DE LA PLATA'),('03171','RIO DULCE'),('03161','RIO FELICIANO'),('02178','RIO GALLEGOS'),('03163','RIO GUALEGUAY'),('03176','RIO JACHAL'),('03164','RIO LIMAY'),('03168','RIO LULES'),('02223','RIO MATANZA'),('03173','RIO MIRAFLORES'),('00870','RIO NEGRO'),('03155','RIO PARANA'),('03158','RIO SAMBOROMBON'),('03172','RIO SUQUIA'),('03175','RIO TERCERO'),('03170','RIO TUPUNGATO'),('02270','RIOS, JULIAN'),('03117','RITA'),('00872','RIVADAVIA, BERNARDINO'),('00874','RIVAS GRAL.'),('00877','RIZZUTO, FRANCISCO ANTONI'),('03118','ROBERTO'),('00876','ROCA, JULIO A. GRAL.'),('02393','ROCAS CORMORAN'),('00878','ROCHA, DARDO'),('03119','RODOLFO'),('00881','RODRIGUEZ PEÑA'),('00882','RODRIGUEZ, AGUSTIN'),('00879','RODRIGUEZ, CAYETANO'),('02199','RODRIGUEZ, JOSE LUIS SOLD'),('00880','RODRIGUEZ, MARTIN'),('00883','ROFFO, ANGEL DR.'),('00885','ROJAS, RICARDO'),('00887','ROLDAN, BELISARIO'),('02055','ROMANO, NESTOR'),('00888','ROMERO, EDUARDO'),('04084','ROMPEH. GRAL. SAN MARTIN'),('04079','ROMPEHIELO IRIZAR'),('00889','RONDEAU'),('03120','ROSA'),('00891','ROSALES, LEONARDO'),('03121','ROSANA'),('04014','ROSAS, MARIANO'),('02309','RUBEN DARIO'),('00892','RUTA 2 -BUENOS AIRES-'),('00898','SAAVEDRA'),('02317','SAAVEDRA LAMAS, CARLOS'),('00900','SAENZ PEÑA, ROQUE'),('00899','SAENZ, ANTONIO'),('00902','SAGASTIZABAL, MIGUEL'),('02286','SALGARI,EMILIO (BATAN)'),('00904','SALTA'),('00931','SAN ANTONIO'),('00905','SAN BERNARDO'),('02093','SAN FRANCISCO DE ASIS'),('00908','SAN JUAN'),('00910','SAN LORENZO'),('00912','SAN LUIS'),('00914','SAN MARTIN, JOSE DE GRAL.'),('02179','SAN PEDRO'),('00916','SAN SALVADOR'),('02390','SAN VALENTIN'),('00927','SANCHEZ DE BUSTAMANTE, T.'),('02104','SANCHEZ LABRADOR, P. R.'),('00906','SANCHEZ, FLORENCIO'),('00937','SANDINO  A. C. GENERAL'),('04066','SANDRINI, LUIS'),('00917','SANT ANGELO IN VADO'),('00918','SANTA CECILIA'),('00920','SANTA CRUZ'),('02180','SANTA ELENA'),('00922','SANTA FE'),('02181','SANTA INES'),('02182','SANTA MARTA'),('00941','SANTA MONICA'),('02183','SANTA ROSA'),('00924','SANTIAGO DEL ESTERO'),('03122','SARA'),('00430','SARGENTO CABRAL'),('00926','SARMIENTO, DOMINGO F.'),('02346','SARTORA, FRANCISCO'),('00928','SASTRE, MARCOS'),('00930','SAVIO, MANUEL N. GRAL.'),('04015','SAYHUEQUE, VALENTIN'),('02099','SCAGLIA, LORENZO'),('00943','SCARPATTI, FRANCISCO S.'),('02061','SCIOCCO, DOMINGO'),('00769','SEGURA, ERNESTO MONS.'),('02224','SEMBRADOR'),('00935','SERRANO, JOSE MARIA'),('02200','SEVILLA, LUIS GUILLERMO C'),('00932','SICILIA'),('03123','SILVIA'),('03124','SOFIA'),('00936','SOLER, MIGUEL ESTANISLAO'),('00938','SOLIS'),('00911','SOUESSIA, ISSAC'),('00933','STEGAGNINI, TOMAS'),('02184','STELLA MARIS'),('00940','STORNI, ALFONSINA'),('00942','STROBEL, MATIAS'),('00944','SUAREZ CORONEL'),('04020','SUBMARINO A.R.A SANTA FE'),('03125','SUSANA'),('00946','TALCAHUANO'),('00947','TANDIL'),('02100','TAPIA, AUGUSTO'),('02333','TARANTINO, HECTOR DR.'),('02095','TAVELLI, PABLO'),('00948','TEJEDOR, CARLOS'),('03127','TERESA'),('00949','TERMAS DE RIO HONDO'),('00950','TETAMANTI, VICTORIO'),('00951','THAMES, JOSE IGNACIO'),('00952','TIERRA DEL FUEGO'),('04016','TOHEL, SILVESTRE'),('00953','TORRES DE VERA Y ARAGON,'),('01413','TOSCANA'),('04021','TRANS. ISLA DE LOS ESTADO'),('04083','TRANSPORTE BAHIA SAN BLAS'),('04082','TRANSPORTE BAHIA THETIS'),('04075','TRANSPORTE CABO DE HORNOS'),('02285','TREJON DE LOPEZ, GLORIA'),('00954','TRES ARROYOS'),('00959','TRINIDAD TOBAGO'),('00956','TRIPULANTES DEL FOURNIER'),('00958','TRIUNVIRATO'),('02292','TROILO, ANIBAL \"PICHUCO\"'),('00960','TUCUMAN'),('03128','TULIO'),('00962','UDAONDO'),('00963','UDINE'),('00964','UNAMUNO, MIGUEL DE'),('02058','URQUIA, SERAPIO'),('00966','URQUIZA, JUSTO JOSE GENER'),('02352','URRUTIA, MIGUEL'),('00968','URUGUAY'),('02187','USHUAIA'),('00970','VALENCIA'),('03129','VALENTINA'),('00972','VALENTINI, ANTONIO'),('03200','VALLE VERDE'),('01407','VALLE, JUAN JOSE'),('02299','VAN HEDEN, GUILLERMO'),('02293','VARELA, LUCIO'),('02339','VARESE, LUIS'),('03187','VARETTO, LUIS PADRE'),('03140','VECINOS UNIDOS'),('00977','VELEZ SARSFIELD, DALMACIO'),('00973','VELEZ, GREGORIO'),('00979','VENEZUELA'),('02355','VENTURA, GENARO'),('00974','VERGARA, VALENTIN'),('00989','VERNE, JULIO'),('00976','VERNET, LUIS'),('03130','VERONICA'),('00978','VERTIZ'),('00980','VIAMONTE'),('03131','VICTOR'),('03132','VICTORIA'),('00991','VIDAL, CELESTINO CNEL.'),('02185','VIEDMA'),('00982','VIEYTES'),('00983','VIGNOLO, ANTONIO A.'),('02348','VILERT, AGUSTIN'),('02325','VILLA GUSTAVA'),('00984','VILLAR, CASILDO'),('02186','VILLARINO, BASILIO'),('00986','VIÑA DEL MAR'),('00709','VIRGEN DEL ROSARIO'),('03133','VIRGINIA'),('02334','VIVA, SALVADOR'),('02384','VOLCAN COPAHUE'),('02300','VOLTA, ALEJANDRO'),('00988','VUCETICH, JUAN'),('00990','VUELTA DE OBLIGADO'),('02053','VULCAN'),('01405','WALSH, RODOLFO'),('03134','WALTER'),('04072','WAST, HUGO'),('00992','WILDE, EDUARDO'),('04004','YAHATY, JOSE'),('00993','YAPEYU'),('04018','YEMEHUECH, TOMAS'),('03135','YOLANDA'),('00994','YRIGOYEN, HIPOLITO'),('00766','ZABALA, JUAN MARTIN MONS.'),('00996','ZACAGNINI, JOSE'),('00995','ZANNI, PEDRO'),('00997','ZEBALLOS, ESTANISLAO S.'),('00998','ZUBIAURRE, OVIDIO'),('02253','DEL CAMPO ESTANISLAO');
/*!40000 ALTER TABLE `geo_calles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_accesos`
--

DROP TABLE IF EXISTS `log_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_accesos` (
  `lac_code` int(11) NOT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `lac_tstamp` datetime DEFAULT NULL,
  `lac_operation` varchar(20) DEFAULT NULL,
  `lac_name` varchar(100) DEFAULT NULL,
  `lac_result` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lac_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_accesos`
--

LOCK TABLES `log_accesos` WRITE;
/*!40000 ALTER TABLE `log_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_operaciones`
--

DROP TABLE IF EXISTS `log_operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_operaciones` (
  `lop_code` int(11) NOT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `lop_tstamp` datetime DEFAULT NULL,
  `lop_operation` varchar(20) DEFAULT NULL,
  `lop_object` varchar(100) DEFAULT NULL,
  `lop_key` varchar(100) DEFAULT NULL,
  `lop_change` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`lop_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_operaciones`
--

LOCK TABLES `log_operaciones` WRITE;
/*!40000 ALTER TABLE `log_operaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rss_content`
--

DROP TABLE IF EXISTS `rss_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rss_content` (
  `rss_code` varchar(50) NOT NULL,
  `rsc_code` int(10) DEFAULT NULL,
  `rsc_publish_tstamp` datetime DEFAULT NULL,
  `rsc_remove_tstamp` datetime DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `rsc_content` varchar(5000) DEFAULT NULL,
  `rsc_title` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rss_content`
--

LOCK TABLES `rss_content` WRITE;
/*!40000 ALTER TABLE `rss_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `rss_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rss_links`
--

DROP TABLE IF EXISTS `rss_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rss_links` (
  `rss_code` varchar(50) NOT NULL,
  `rss_url` varchar(200) DEFAULT NULL,
  `rss_note` varchar(500) DEFAULT NULL,
  `rss_type` varchar(50) DEFAULT NULL,
  `rss_logo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rss_links`
--

LOCK TABLES `rss_links` WRITE;
/*!40000 ALTER TABLE `rss_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `rss_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_acl`
--

DROP TABLE IF EXISTS `sec_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_acl` (
  `acl_code` int(10) NOT NULL,
  `ugr_code` varchar(50) NOT NULL,
  `use_code` varchar(50) NOT NULL,
  `can_read` char(1) DEFAULT NULL,
  `can_write` char(1) DEFAULT NULL,
  `can_delete` char(1) DEFAULT NULL,
  PRIMARY KEY (`acl_code`,`ugr_code`,`use_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_acl`
--

LOCK TABLES `sec_acl` WRITE;
/*!40000 ALTER TABLE `sec_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_groups`
--

DROP TABLE IF EXISTS `sec_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_groups` (
  `gro_code` varchar(50) NOT NULL,
  `gro_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`gro_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_groups`
--

LOCK TABLES `sec_groups` WRITE;
/*!40000 ALTER TABLE `sec_groups` DISABLE KEYS */;
INSERT INTO `sec_groups` VALUES ('ControlTotal','Control total');
/*!40000 ALTER TABLE `sec_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_groups_rights`
--

DROP TABLE IF EXISTS `sec_groups_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_groups_rights` (
  `gro_code` varchar(50) NOT NULL,
  `rig_name` varchar(200) NOT NULL,
  PRIMARY KEY (`gro_code`,`rig_name`),
  KEY `fk_groups_gr_idx` (`gro_code`),
  KEY `fk_gr_rights_idx` (`rig_name`),
  CONSTRAINT `fk_groups_gr` FOREIGN KEY (`gro_code`) REFERENCES `sec_groups` (`gro_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gr_rights` FOREIGN KEY (`rig_name`) REFERENCES `sec_rights` (`rig_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_groups_rights`
--

LOCK TABLES `sec_groups_rights` WRITE;
/*!40000 ALTER TABLE `sec_groups_rights` DISABLE KEYS */;
INSERT INTO `sec_groups_rights` VALUES ('ControlTotal','menu.archivo.administracion'),('ControlTotal','menu.archivo.administracion.eventos'),('ControlTotal','menu.archivo.administracion.home'),('ControlTotal','menu.archivo.ciudadanos'),('ControlTotal','menu.archivo.configuracion'),('ControlTotal','menu.archivo.configuracion.georef'),('ControlTotal','menu.archivo.denuncias'),('ControlTotal','menu.archivo.denuncias.adm'),('ControlTotal','menu.archivo.denuncias.lote'),('ControlTotal','menu.archivo.inicio'),('ControlTotal','menu.archivo.messaging'),('ControlTotal','menu.archivo.parametros'),('ControlTotal','menu.archivo.quejas'),('ControlTotal','menu.archivo.reclamos'),('ControlTotal','menu.archivo.reclamos.adm'),('ControlTotal','menu.archivo.rss'),('ControlTotal','menu.archivo.solicitudes'),('ControlTotal','menu.archivo.tickets'),('ControlTotal','menu.archivo.tickets.admin'),('ControlTotal','menu.archivo.tickets.nuevo'),('ControlTotal','menu.archivo.tickets.proceso'),('ControlTotal','menu.ayuda'),('ControlTotal','menu.ayuda.faq'),('ControlTotal','menu.docs'),('ControlTotal','menu.docs.admin'),('ControlTotal','menu.docs.reclamos'),('ControlTotal','menu.trans'),('ControlTotal','menu.trans.bugtrack'),('ControlTotal','menu.trans.bugtrack.new'),('ControlTotal','menu.trans.consulta'),('ControlTotal','menu.trans.eventos'),('ControlTotal','menu.trans.faq'),('ControlTotal','menu.trans.faq.modificar'),('ControlTotal','menu.trans.faq.new'),('ControlTotal','menu.trans.faq_topic'),('ControlTotal','menu.trans.faq_topic.new'),('ControlTotal','menu.trans.procesos'),('ControlTotal','menu.trans.projects'),('ControlTotal','menu.trans.projects.new'),('ControlTotal','menu.trans.reportes'),('ControlTotal','menu.trans.reportes.del'),('ControlTotal','menu.trans.transacciones'),('ControlTotal','menu.usuarios'),('ControlTotal','menu.usuarios.derechos'),('ControlTotal','menu.usuarios.grupoderechos'),('ControlTotal','menu.usuarios.grupousuarios'),('ControlTotal','menu.usuarios.usuarios');
/*!40000 ALTER TABLE `sec_groups_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_modules`
--

DROP TABLE IF EXISTS `sec_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_modules` (
  `smo_code` int(11) NOT NULL,
  `smo_name` varchar(100) DEFAULT NULL,
  `smo_version` varchar(50) DEFAULT NULL,
  `smo_db_version` varchar(50) DEFAULT NULL,
  `smo_status` varchar(50) DEFAULT NULL,
  `smo_path` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`smo_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_modules`
--

LOCK TABLES `sec_modules` WRITE;
/*!40000 ALTER TABLE `sec_modules` DISABLE KEYS */;
INSERT INTO `sec_modules` VALUES (1,'DOCMANAGER2','1.0','1.0','ACTIVO','FWK.docmgr2'),(2,'EVENTS','1.0','1.0','ACTIVO','FWK.events'),(3,'GEOREF','1.0','1.0','ACTIVO','FWK.georef'),(4,'HOME','1.0','1.0','ACTIVO','FWK.home'),(5,'MESSAGING','1.0','1.0','ACTIVO','FWK.messaging'),(6,'RSS','1.0','1.0','ACTIVO','FWK.rss'),(7,'SECURITY','1.0','1.0','ACTIVO','FWK.security'),(8,'SETUP','1.0','1.0','ACTIVO','FWK.setup'),(9,'TRANSACCIONES','1.0','1.0','ACTIVO','FWK.transactions'),(10,'CIUDADANOS','1.0','1.0','ACTIVO','APP.ciudadanos'),(11,'TICKETS','1.0','1.0','ACTIVO','APP.tickets');
/*!40000 ALTER TABLE `sec_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_parameters`
--

DROP TABLE IF EXISTS `sec_parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_parameters` (
  `par_code` varchar(200) NOT NULL,
  `par_value` varchar(200) DEFAULT NULL,
  `par_description` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`par_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_parameters`
--

LOCK TABLES `sec_parameters` WRITE;
/*!40000 ALTER TABLE `sec_parameters` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_rights`
--

DROP TABLE IF EXISTS `sec_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_rights` (
  `rig_name` varchar(200) NOT NULL,
  `rig_description` varchar(200) DEFAULT NULL,
  `rig_check` char(1) DEFAULT NULL,
  PRIMARY KEY (`rig_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_rights`
--

LOCK TABLES `sec_rights` WRITE;
/*!40000 ALTER TABLE `sec_rights` DISABLE KEYS */;
INSERT INTO `sec_rights` VALUES ('menu.archivo.administracion','Permiso para usar funciones de administracion','Y'),('menu.archivo.administracion.eventos','Permiso para ver log de eventos','Y'),('menu.archivo.administracion.home','Permiso para administrar las homepages','Y'),('menu.archivo.ciudadanos','Permiso para usar modulo de Ciudadanos','Y'),('menu.archivo.configuracion','Permiso para la gestion de modulos','Y'),('menu.archivo.configuracion.georef','Permiso para la gestion de georeferencias','Y'),('menu.archivo.denuncias','Permiso para procesar denuncias','Y'),('menu.archivo.denuncias.adm','Permiso para administrar denuncias','Y'),('menu.archivo.denuncias.lote','Permiso para procesar denuncias en lote','Y'),('menu.archivo.inicio','Permiso para el menu de inicio','Y'),('menu.archivo.messaging','Permiso para la gestion de mensajeria','Y'),('menu.archivo.parametros','Permiso para modificar la parametrizacion','Y'),('menu.archivo.quejas','Permiso para procesar quejas','Y'),('menu.archivo.reclamos','Permiso para procesar reclamos','Y'),('menu.archivo.reclamos.adm','Permiso para administrar reclamos','Y'),('menu.archivo.rss','Permiso para la gestion de contenido rss','Y'),('menu.archivo.solicitudes','Permiso para procesar solicitudes','Y'),('menu.archivo.tickets','Permiso para usar funciones de tickets','Y'),('menu.archivo.tickets.admin','Permiso para modificar configuracion','Y'),('menu.archivo.tickets.nuevo','Permiso para ingresar nuevos tickets','Y'),('menu.archivo.tickets.proceso','Permiso para modificar estados','Y'),('menu.ayuda','Permiso para consultar el menu ayuda','Y'),('menu.ayuda.faq','Permiso para consultar el FAQ','Y'),('menu.docs','Permiso para la gestion de documentos','Y'),('menu.docs.admin','Permiso para la administracion de documentos','Y'),('menu.docs.reclamos','Permiso para la administracion de reclamos','Y'),('menu.trans','Permiso para la gestion de transacciones','Y'),('menu.trans.bugtrack','Permiso para la gestion de bugs','Y'),('menu.trans.bugtrack.new','Permiso para el ingreso de un nuevo reporte de bug','Y'),('menu.trans.consulta','Permiso para la consulta de transacciones','Y'),('menu.trans.eventos','Permiso para la gestion de eventos','Y'),('menu.trans.faq','Permiso para la gestion de FAQ','Y'),('menu.trans.faq.modificar','Permiso para el modificar una pregunta del FAQ','Y'),('menu.trans.faq.new','Permiso para el ingreso de una nueva pregunta del FAQ','Y'),('menu.trans.faq_topic','Permiso para la gestion de temas del FAQ','Y'),('menu.trans.faq_topic.new','Permiso para el ingreso de un nuevo tema FAQ','Y'),('menu.trans.procesos','Permiso para la consulta de procesos','Y'),('menu.trans.projects','Permiso para la gestion de proyectos','Y'),('menu.trans.projects.new','Permiso para el ingreso de un nuevo proyecto','Y'),('menu.trans.reportes','Permiso para ver los reportes de usuarios (control calidad)','Y'),('menu.trans.reportes.del','Permiso para borrar los reportes de usuarios (control calidad)','Y'),('menu.trans.transacciones','Permiso para la gestion de transacciones','Y'),('menu.usuarios','Permiso para la gestion de usuarios','Y'),('menu.usuarios.derechos','Permiso para la gestion de derechos','Y'),('menu.usuarios.grupoderechos','Permiso para la gestion de grupos de derechos','Y'),('menu.usuarios.grupousuarios','Permiso para la gestion de grupos de usuarios','Y'),('menu.usuarios.usuarios','Permiso para la gestion de usuarios','Y');
/*!40000 ALTER TABLE `sec_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_sequence`
--

DROP TABLE IF EXISTS `sec_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_sequence` (
  `seq_object` varchar(100) NOT NULL,
  `seq_code` int(10) DEFAULT NULL,
  PRIMARY KEY (`seq_object`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_sequence`
--

LOCK TABLES `sec_sequence` WRITE;
/*!40000 ALTER TABLE `sec_sequence` DISABLE KEYS */;
INSERT INTO `sec_sequence` VALUES ('ciu_ciudadanos',64),('forms',73),('RECLAMO-2013',7),('sec_modules',11),('tic_avances',7),('tic_organismos',1),('tic_prestaciones_gis',2),('tic_tickets',7);
/*!40000 ALTER TABLE `sec_sequence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_sessions`
--

DROP TABLE IF EXISTS `sec_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_sessions` (
  `ses_tstamp` datetime DEFAULT NULL,
  `ses_last_access` datetime DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `ses_token` varchar(50) NOT NULL,
  `ses_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ses_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_sessions`
--

LOCK TABLES `sec_sessions` WRITE;
/*!40000 ALTER TABLE `sec_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_ultimas_claves`
--

DROP TABLE IF EXISTS `sec_ultimas_claves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_ultimas_claves` (
  `use_password` varchar(40) NOT NULL,
  `suc_tstamp` datetime NOT NULL,
  `use_code` varchar(50) NOT NULL,
  PRIMARY KEY (`use_code`,`suc_tstamp`,`use_password`),
  KEY `fk_users_pass_idx` (`use_code`),
  CONSTRAINT `fk_users_pass` FOREIGN KEY (`use_code`) REFERENCES `sec_users` (`use_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_ultimas_claves`
--

LOCK TABLES `sec_ultimas_claves` WRITE;
/*!40000 ALTER TABLE `sec_ultimas_claves` DISABLE KEYS */;
INSERT INTO `sec_ultimas_claves` VALUES ('7474d341ae33b91f9c50e344d38fe15b','2013-04-12 01:12:34','2');
/*!40000 ALTER TABLE `sec_ultimas_claves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_user_groups`
--

DROP TABLE IF EXISTS `sec_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_user_groups` (
  `use_code` varchar(50) NOT NULL,
  `gro_code` varchar(50) NOT NULL,
  PRIMARY KEY (`use_code`,`gro_code`),
  KEY `fk_users_groups_idx` (`use_code`),
  KEY `fk_groups_users_idx` (`gro_code`),
  CONSTRAINT `fk_groups_users` FOREIGN KEY (`gro_code`) REFERENCES `sec_groups` (`gro_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups` FOREIGN KEY (`use_code`) REFERENCES `sec_users` (`use_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_user_groups`
--

LOCK TABLES `sec_user_groups` WRITE;
/*!40000 ALTER TABLE `sec_user_groups` DISABLE KEYS */;
INSERT INTO `sec_user_groups` VALUES ('1','ControlTotal'),('2','ControlTotal');
/*!40000 ALTER TABLE `sec_user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_users`
--

DROP TABLE IF EXISTS `sec_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_users` (
  `use_code` varchar(50) NOT NULL,
  `use_name` varchar(200) DEFAULT NULL,
  `use_phone` varchar(30) DEFAULT NULL,
  `use_email` varchar(200) DEFAULT NULL,
  `use_mobile` varchar(50) DEFAULT NULL,
  `use_extension` varchar(50) DEFAULT NULL,
  `use_login` varchar(50) DEFAULT NULL,
  `use_password` varchar(50) DEFAULT NULL,
  `use_status` varchar(20) DEFAULT NULL,
  `use_tstamp` datetime DEFAULT NULL,
  `use_language` varchar(50) DEFAULT NULL,
  `use_skin` varchar(50) DEFAULT NULL,
  `use_avatar` varchar(200) DEFAULT NULL,
  `use_phone2` varchar(30) DEFAULT NULL,
  `use_phone3` varchar(30) DEFAULT NULL,
  `use_location` varchar(100) DEFAULT NULL,
  `use_rss` varchar(100) DEFAULT NULL,
  `codcli_bej` varchar(50) DEFAULT NULL,
  `use_layout` varchar(500) DEFAULT NULL,
  `use_passact` datetime DEFAULT NULL,
  PRIMARY KEY (`use_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_users`
--

LOCK TABLES `sec_users` WRITE;
/*!40000 ALTER TABLE `sec_users` DISABLE KEYS */;
INSERT INTO `sec_users` VALUES ('1','Administrador','','jorge.cordero@commsys.com.ar','15-4143-5224','','admin','6bfc500738d8e9d168cd0a2024c94f5a','Activo','2013-01-09 10:48:11','Español','default','','','','','','',NULL,NULL),('2','Organismo DGILUM','','dgilum@gmail.com','','','organismo','7474d341ae33b91f9c50e344d38fe15b','ACTIVO','2013-04-12 01:12:14','Español','default','','','','','','',NULL,'2013-04-12 01:12:34');
/*!40000 ALTER TABLE `sec_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_usrgroup`
--

DROP TABLE IF EXISTS `sec_usrgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_usrgroup` (
  `ugr_code` varchar(50) NOT NULL,
  `ugr_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ugr_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_usrgroup`
--

LOCK TABLES `sec_usrgroup` WRITE;
/*!40000 ALTER TABLE `sec_usrgroup` DISABLE KEYS */;
INSERT INTO `sec_usrgroup` VALUES ('Administradores','Administrador del sistema'),('home_operator','home operador 147'),('home_tickets','Home Tickets'),('ORGANISMO_DGILUM','DGILUM');
/*!40000 ALTER TABLE `sec_usrgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_usrgroup_users`
--

DROP TABLE IF EXISTS `sec_usrgroup_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_usrgroup_users` (
  `ugr_code` varchar(50) NOT NULL,
  `use_code` varchar(50) NOT NULL,
  PRIMARY KEY (`ugr_code`,`use_code`),
  KEY `fk_users_gu_idx` (`use_code`),
  KEY `fk_gu_users_idx` (`ugr_code`),
  CONSTRAINT `fk_users_gu` FOREIGN KEY (`use_code`) REFERENCES `sec_users` (`use_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_usrgroup_users`
--

LOCK TABLES `sec_usrgroup_users` WRITE;
/*!40000 ALTER TABLE `sec_usrgroup_users` DISABLE KEYS */;
INSERT INTO `sec_usrgroup_users` VALUES ('Administradores','1'),('home_operator','1'),('home_tickets','2'),('ORGANISMO_DGILUM','2');
/*!40000 ALTER TABLE `sec_usrgroup_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sho_atajos`
--

DROP TABLE IF EXISTS `sho_atajos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sho_atajos` (
  `sat_code` int(10) NOT NULL,
  `sin_code` int(10) NOT NULL,
  `sat_descripcion` varchar(50) DEFAULT NULL,
  `sat_url` varchar(150) DEFAULT NULL,
  `sat_nota` varchar(500) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `sat_tstamp` datetime DEFAULT NULL,
  PRIMARY KEY (`sat_code`,`sin_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sho_atajos`
--

LOCK TABLES `sho_atajos` WRITE;
/*!40000 ALTER TABLE `sho_atajos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sho_atajos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sho_ingresos`
--

DROP TABLE IF EXISTS `sho_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sho_ingresos` (
  `sin_code` int(10) NOT NULL,
  `sin_descripcion` varchar(50) DEFAULT NULL,
  `sin_estado` varchar(50) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `sin_tstamp` datetime DEFAULT NULL,
  PRIMARY KEY (`sin_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sho_ingresos`
--

LOCK TABLES `sho_ingresos` WRITE;
/*!40000 ALTER TABLE `sho_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sho_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_avance`
--

DROP TABLE IF EXISTS `tic_avance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_avance` (
  `tic_nro` int(10) NOT NULL COMMENT 'Número del ticket',
  `tpr_code` varchar(20) NOT NULL COMMENT 'Prestacion',
  `tav_code` int(11) NOT NULL COMMENT 'nro de operación de avance ',
  `tav_tstamp_in` datetime DEFAULT NULL COMMENT 'fecha del inicio del estado',
  `use_code_in` varchar(50) DEFAULT NULL COMMENT 'operador de inicio del estado',
  `tic_estado_in` varchar(50) DEFAULT NULL COMMENT 'Estado inicial',
  `tav_nota` varchar(1000) DEFAULT NULL COMMENT 'Nota u observacion',
  `tic_motivo` varchar(50) DEFAULT NULL COMMENT 'Motivo del evento',
  `tic_estado_out` varchar(50) DEFAULT NULL COMMENT 'Estado siguiente (si aplica)',
  `tav_tstamp_out` datetime DEFAULT NULL COMMENT 'Fecha de fin de este evento',
  `use_code_out` varchar(50) DEFAULT NULL COMMENT 'Operador de cierre',
  PRIMARY KEY (`tic_nro`,`tpr_code`,`tav_code`),
  KEY `fk_ticket_avance_idx` (`tic_nro`,`tpr_code`),
  CONSTRAINT `fk_ticket_avance` FOREIGN KEY (`tic_nro`, `tpr_code`) REFERENCES `tic_ticket_prestaciones` (`tic_nro`, `tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_avance`
--

LOCK TABLES `tic_avance` WRITE;
/*!40000 ALTER TABLE `tic_avance` DISABLE KEYS */;
INSERT INTO `tic_avance` VALUES (4,'0101',4,'2013-04-08 01:25:25','1','INICIADO','Una nota','INICIADO',NULL,NULL,NULL),(5,'0101',5,'2013-04-08 11:58:42','1','INICIADO','','INICIADO',NULL,NULL,NULL),(6,'0101',6,'2013-04-09 23:44:40','1','INICIADO','Una nota sobre la lampara quemada','INICIADO',NULL,NULL,NULL),(7,'0202',7,'2013-04-11 10:32:48','1','INICIADO','Un lio barbaro','INICIADO',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tic_avance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_georef`
--

DROP TABLE IF EXISTS `tic_georef`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_georef` (
  `tge_tipo` varchar(30) DEFAULT 'VILLA',
  `tge_nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre De la Villa',
  `tge_calle_nombre` varchar(100) DEFAULT NULL COMMENT 'Un nombre de calle oficial, del punto interno o externo mas cercano',
  `tge_altura` int(10) unsigned DEFAULT NULL COMMENT 'Altura',
  `tge_otra_denominacion` varchar(500) DEFAULT NULL COMMENT 'Es otro nombre por el cual se conoce a la villa.',
  `tge_coordx` float DEFAULT NULL COMMENT 'Coordenadas de la USIG',
  `tge_coordy` float DEFAULT NULL COMMENT 'Coordenadas de la USIG',
  `tge_cgpc` varchar(50) DEFAULT NULL COMMENT 'CPGC correpondiente',
  `tge_barrio` varchar(100) DEFAULT NULL COMMENT 'Nombre del barrio',
  `tge_calle` int(11) DEFAULT NULL COMMENT 'Codigo de la calle, corresponde a tge_calle_nombre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_georef`
--

LOCK TABLES `tic_georef` WRITE;
/*!40000 ALTER TABLE `tic_georef` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_georef` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ind_medidas`
--

DROP TABLE IF EXISTS `tic_ind_medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ind_medidas` (
  `tin_code` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Indicador',
  `tor_code` int(11) NOT NULL COMMENT 'Organismo',
  `tim_tstamp` datetime NOT NULL COMMENT 'Fecha de la muestra',
  `tim_valor` int(11) DEFAULT NULL COMMENT 'Valor que toma el indicador',
  PRIMARY KEY (`tin_code`,`tor_code`,`tim_tstamp`),
  KEY `fk_indicadores_medidas_idx` (`tin_code`),
  KEY `fk_medidas_organismo_idx` (`tor_code`),
  CONSTRAINT `fk_indicadores_medidas` FOREIGN KEY (`tin_code`) REFERENCES `tic_indicadores` (`tin_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medidas_organismo` FOREIGN KEY (`tor_code`) REFERENCES `tic_organismos` (`tor_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ind_medidas`
--

LOCK TABLES `tic_ind_medidas` WRITE;
/*!40000 ALTER TABLE `tic_ind_medidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_ind_medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_indicadores`
--

DROP TABLE IF EXISTS `tic_indicadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_indicadores` (
  `tin_code` int(11) NOT NULL COMMENT 'Codigo del indicador',
  `tin_nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del indicador',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'Operador',
  `tin_tstamp` datetime DEFAULT NULL COMMENT 'Fecha de creacion',
  `tin_estado` varchar(45) DEFAULT NULL COMMENT 'ACTIVO / INACTIVO',
  PRIMARY KEY (`tin_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_indicadores`
--

LOCK TABLES `tic_indicadores` WRITE;
/*!40000 ALTER TABLE `tic_indicadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_indicadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_organismos`
--

DROP TABLE IF EXISTS `tic_organismos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_organismos` (
  `tor_code` int(10) NOT NULL,
  `tor_padre` int(10) DEFAULT NULL,
  `tor_sigla` varchar(20) DEFAULT NULL,
  `tor_nombre` varchar(100) DEFAULT NULL,
  `tor_estado` varchar(50) DEFAULT NULL,
  `tor_tstamp` datetime DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `tor_contacto` varchar(500) DEFAULT NULL,
  `tor_tipo` varchar(20) DEFAULT NULL,
  `tor_email` varchar(200) DEFAULT NULL,
  `tor_notificar` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`tor_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_organismos`
--

LOCK TABLES `tic_organismos` WRITE;
/*!40000 ALTER TABLE `tic_organismos` DISABLE KEYS */;
INSERT INTO `tic_organismos` VALUES (1,NULL,'DGILUM','DG Iluminación','ACTIVO','2013-02-17 10:29:33','1','','GOBIERNO','','');
/*!40000 ALTER TABLE `tic_organismos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_prestaciones`
--

DROP TABLE IF EXISTS `tic_prestaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_prestaciones` (
  `tpr_code` varchar(20) NOT NULL COMMENT 'Código de prestación',
  `tpr_tipo` varchar(20) DEFAULT NULL COMMENT 'Tipo de prestacion: RECLAMO, SOLICITUD, DENUNCIA, QUEJA',
  `tpr_detalle` varchar(100) DEFAULT NULL COMMENT 'Nombre de la prestación',
  `tpr_estado` varchar(20) DEFAULT NULL COMMENT 'Estado: ACTIVO / INACTIVO',
  `tpr_tstamp` datetime DEFAULT NULL COMMENT 'Fecha de creacion',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'Operador que creo la prestacion',
  `tpr_ubicacion` varchar(50) DEFAULT NULL COMMENT 'Tipo de georeferencia usada: CALLE, NOMINADA, etc.',
  `tpr_plazo` varchar(20) DEFAULT NULL COMMENT 'Plazo de resolución y unidad (HORAS, DIAS, MESES) ej. 15 DIAS',
  `tpr_show` varchar(50) DEFAULT NULL COMMENT 'Lista de lugares donde se debe ver esta prestación WEB, CALL, MOVIL',
  `tpr_metadata` varchar(3000) DEFAULT NULL COMMENT 'Explicación para la web sobre la aplicación de esta prestación',
  `tpr_keywords` varchar(500) DEFAULT NULL COMMENT 'Palabras clave relacionadas con esta prestación, para el buscador.',
  `tpr_admin` varchar(50) DEFAULT NULL COMMENT 'Si se delega la administración a un organismo. El código del organismo va aquí.',
  `tpr_al_inicio` varchar(2000) DEFAULT NULL COMMENT 'Enviar un email de alerta al inicio de la prestación a estos correos',
  `tpr_al_final` varchar(2000) DEFAULT NULL COMMENT 'Enviar un email de alerta al fin de la prestación a estos correos',
  `tpr_al_vencimiento` varchar(2000) DEFAULT NULL COMMENT 'Enviar un email de alerta al vencimiento de la prestación a estos correos',
  `tor_code_inspeccion` int(11) DEFAULT NULL COMMENT 'Organismo que hace la inspección (si se requiere inspección)',
  `tor_code_verificacion` int(11) DEFAULT NULL COMMENT 'Organismo que hace la verificación posterior',
  `tpr_asociar_radio` int(11) DEFAULT NULL COMMENT 'radio en metros para auto asociar un ticket de igual prestación a otro parecido',
  PRIMARY KEY (`tpr_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_prestaciones`
--

LOCK TABLES `tic_prestaciones` WRITE;
/*!40000 ALTER TABLE `tic_prestaciones` DISABLE KEYS */;
INSERT INTO `tic_prestaciones` VALUES ('01','RECLAMO','Alumbrado Público','ACTIVO','2013-02-15 09:41:20','1','DOMICILIO','2 Días','','','','','','','',NULL,NULL,NULL),('0101','RECLAMO','Problemas de Encendido','ACTIVO','2013-04-09 10:05:15','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010101','RECLAMO','Luminaria encendida las 24 hrs','ACTIVO','2013-04-09 10:05:36','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010102','RECLAMO','No enciende luminaria','ACTIVO','2013-04-09 10:06:04','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010103','RECLAMO','Luminaria intermitente','ACTIVO','2013-04-09 10:06:29','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010104','RECLAMO','Poca Iluminación','ACTIVO','2013-04-09 10:06:49','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010105','RECLAMO','Zona apagada','ACTIVO','2013-04-09 10:07:04','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010106','RECLAMO','Zona encendida','ACTIVO','2013-04-09 10:07:29','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('0102','RECLAMO','Mantenimiento de Tulipas','ACTIVO','2013-04-09 10:07:48','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010201','RECLAMO','Falta limpieza de tulipa','ACTIVO','2013-04-09 10:08:01','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010202','RECLAMO','Falta la tulipa','ACTIVO','2013-04-09 10:08:24','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010203','RECLAMO','Tulipa rota','ACTIVO','2013-04-09 10:08:41','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('0103','RECLAMO','Columnas metálicas o Postes de madera','ACTIVO','2013-04-09 10:08:56','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010301','RECLAMO','Brazo de Columna desprendido / girado','ACTIVO','2013-04-09 10:09:19','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010302','RECLAMO','Electrificada','ACTIVO','2013-04-09 10:09:52','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010303','RECLAMO','En riesgo de caerse','ACTIVO','2013-04-09 10:10:04','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010304','RECLAMO','Falta tapa protectora de electricidad','ACTIVO','2013-04-09 10:10:29','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010305','RECLAMO','Inclinada','ACTIVO','2013-04-09 10:10:43','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010306','RECLAMO','No reposición de columna que sacaron','ACTIVO','2013-04-09 10:10:59','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010307','RECLAMO','Oxidada','ACTIVO','2013-04-09 10:11:15','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('0104','RECLAMO','Cables de Luz','ACTIVO','2013-04-09 10:11:32','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010401','RECLAMO','Cable de alumbrado caído','ACTIVO','2013-04-09 10:11:55','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010402','RECLAMO','Cables cortados','ACTIVO','2013-04-09 10:12:11','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010403','RECLAMO','Robo de Cable','ACTIVO','2013-04-09 10:12:30','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('0105','RECLAMO','Otros','ACTIVO','2013-04-09 10:12:42','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010501','RECLAMO','Parte de la luminaria colgando','ACTIVO','2013-04-09 10:13:08','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('010502','RECLAMO','Pasacalles atados a la luminaria','ACTIVO','2013-04-09 10:13:20','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('02','RECLAMO','Ruidos Molestos','ACTIVO','2013-03-19 11:18:49','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('0201','RECLAMO','En comercios no industriales','ACTIVO','2013-03-19 11:19:11','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('0202','RECLAMO','En casas de familia','ACTIVO','2013-03-19 15:39:40','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('03','RECLAMO','Limpieza Urbana','ACTIVO','2013-03-19 15:44:43','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('0301','RECLAMO','Barrido y Limpieza Urbana','ACTIVO','2013-03-19 15:48:41','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('030101','RECLAMO','El barrendero','ACTIVO','2013-03-19 15:49:09','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('03010101','RECLAMO','No pasa','ACTIVO','2013-03-19 15:53:34','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('03010102','RECLAMO','Pasa poco','ACTIVO','2013-03-19 15:59:29','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('03010103','RECLAMO','Pasa sólo de un lado de la calle','ACTIVO','2013-03-19 15:54:50','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL),('030102','RECLAMO','La barredora','ACTIVO','2013-03-19 16:01:12','1','DOMICILIO','','TODOS','','','','','','',NULL,NULL,NULL),('1','RECLAMO','Ruidos Molestos','ACTIVO','2013-03-19 11:11:52','1','DOMICILIO','','','','','','','','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tic_prestaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_prestaciones_cuest`
--

DROP TABLE IF EXISTS `tic_prestaciones_cuest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_prestaciones_cuest` (
  `tpr_code` varchar(20) NOT NULL COMMENT 'Codigo de prestacion',
  `tpr_orden` int(10) NOT NULL COMMENT 'orden de aparición de las preguntas 1,2,3...',
  `tpr_preg` varchar(100) DEFAULT NULL COMMENT 'Pregunta',
  `tpr_tipo_preg` varchar(20) DEFAULT NULL COMMENT 'Tipo de pregunta: TEXTO, LISTA, MULTIPLE',
  `tpr_opciones` varchar(200) DEFAULT NULL COMMENT 'Lista de respuestas posibles, para el caso de LISTA y MULTIPLE, separada por punto y coma.',
  PRIMARY KEY (`tpr_code`,`tpr_orden`),
  KEY `fk_prestaciones_cuestionario_idx` (`tpr_code`),
  CONSTRAINT `fk_prestaciones_cuestionario` FOREIGN KEY (`tpr_code`) REFERENCES `tic_prestaciones` (`tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_prestaciones_cuest`
--

LOCK TABLES `tic_prestaciones_cuest` WRITE;
/*!40000 ALTER TABLE `tic_prestaciones_cuest` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_prestaciones_cuest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_prestaciones_gis`
--

DROP TABLE IF EXISTS `tic_prestaciones_gis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_prestaciones_gis` (
  `tpr_code` varchar(20) NOT NULL COMMENT 'Codigo de prestacion',
  `tpg_code` int(10) NOT NULL COMMENT 'codigo gis',
  `tpg_gis_valor` varchar(100) NOT NULL COMMENT 'Valor que devuelve el GIS. (Ej. ZONA B)',
  `tpg_gis_campo` varchar(100) DEFAULT NULL COMMENT 'Layer a consultar en el GIS (Ej. HIGIENE)',
  `tpg_usa_gis` varchar(5) NOT NULL COMMENT 'Flag SI/NO sobre si utiliza la consulta al GIS. Si no usa el GIS se aplica este valor para cualquier ubicación',
  `tor_code` int(10) DEFAULT NULL COMMENT 'codigo de organismo',
  `tpg_tstamp` datetime DEFAULT NULL COMMENT 'Fecha de creación del registro',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'Operador que cargo el registro',
  `tto_figura` varchar(50) DEFAULT NULL COMMENT 'Rol del organismo: RESPONSABLE, PRESTADOR, OBSERVADOR',
  PRIMARY KEY (`tpr_code`,`tpg_code`),
  KEY `fk_prestacion_gis_idx` (`tpr_code`),
  CONSTRAINT `fk_prestacion_gis` FOREIGN KEY (`tpr_code`) REFERENCES `tic_prestaciones` (`tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_prestaciones_gis`
--

LOCK TABLES `tic_prestaciones_gis` WRITE;
/*!40000 ALTER TABLE `tic_prestaciones_gis` DISABLE KEYS */;
INSERT INTO `tic_prestaciones_gis` VALUES ('0101',1,'','','NO',1,'2013-02-17 11:13:01','1','RESPONSABLE'),('0101',2,'','','NO',1,'2013-02-17 11:13:19','1','PRESTADOR');
/*!40000 ALTER TABLE `tic_prestaciones_gis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_prestaciones_rubros`
--

DROP TABLE IF EXISTS `tic_prestaciones_rubros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_prestaciones_rubros` (
  `tpr_code` varchar(20) NOT NULL COMMENT 'codigo de prestacion',
  `tru_code` int(10) NOT NULL COMMENT 'Codigo de rubro',
  `tpr_prioridad` varchar(20) DEFAULT NULL COMMENT 'Prioridad',
  `tor_code` int(10) DEFAULT NULL COMMENT 'Organismo que debe atender esta prestacion para esta rubro',
  `tto_figura` varchar(50) DEFAULT NULL COMMENT 'rol del organismo RESPONSABLE,PRESTADOR,OBSERVADOR',
  PRIMARY KEY (`tpr_code`,`tru_code`),
  KEY `fk_prestacion_rubro_idx` (`tpr_code`),
  KEY `fk_rubro_prestacion_idx` (`tru_code`),
  CONSTRAINT `fk_prestacion_rubro` FOREIGN KEY (`tpr_code`) REFERENCES `tic_prestaciones` (`tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rubro_prestacion` FOREIGN KEY (`tru_code`) REFERENCES `tic_rubros` (`tru_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_prestaciones_rubros`
--

LOCK TABLES `tic_prestaciones_rubros` WRITE;
/*!40000 ALTER TABLE `tic_prestaciones_rubros` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_prestaciones_rubros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_rubros`
--

DROP TABLE IF EXISTS `tic_rubros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_rubros` (
  `tru_code` int(10) NOT NULL,
  `tru_detalle` varchar(100) DEFAULT NULL,
  `tru_estado` varchar(20) DEFAULT NULL,
  `tru_tstamp` datetime DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tru_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_rubros`
--

LOCK TABLES `tic_rubros` WRITE;
/*!40000 ALTER TABLE `tic_rubros` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_rubros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket`
--

DROP TABLE IF EXISTS `tic_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket` (
  `tic_nro` int(10) NOT NULL COMMENT 'Número interno del ticket, es correlativo y no se reseta cada año.',
  `tic_numero` int(11) DEFAULT NULL,
  `tic_anio` int(10) DEFAULT NULL COMMENT 'Año del ticket',
  `tic_tipo` varchar(20) DEFAULT NULL COMMENT 'Tipo del ticket: RECLAMO, DENUNCIA, SOLICITUD, QUEJA',
  `tic_tstamp_in` datetime DEFAULT NULL COMMENT 'Fecha de ingreso del ticket',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'operador que ingreso el ticket',
  `tic_nota_in` varchar(500) DEFAULT NULL COMMENT 'Nota u observación ingresada con el ticket',
  `tic_estado` varchar(50) DEFAULT NULL COMMENT 'Estado del ticket',
  `tic_lugar` varchar(1000) DEFAULT NULL COMMENT 'Lugar nominado. Ej. Hospital San Martin',
  `tic_barrio` varchar(50) DEFAULT NULL COMMENT 'Barrio',
  `tic_cgpc` varchar(20) DEFAULT NULL COMMENT 'CGPC o comuna',
  `tic_coordx` double DEFAULT NULL COMMENT 'Coordenada X o Latitud',
  `tic_coordy` double DEFAULT NULL COMMENT 'Coordenada Y o Longitud',
  `tic_id_cuadra` int(10) DEFAULT NULL COMMENT 'Identificador de manzana del catastro',
  `tic_forms` int(10) DEFAULT NULL,
  `tic_canal` varchar(20) DEFAULT NULL COMMENT 'Canal de ingreso: WEB, CALL, MOVIL',
  `tic_tstamp_plazo` datetime DEFAULT NULL COMMENT 'Fecha de vencimiento estipulada',
  `tic_tstamp_cierre` datetime DEFAULT NULL COMMENT 'Fecha de cierre del ticket',
  `tic_calle_nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre de la calle',
  `tic_nro_puerta` int(10) DEFAULT NULL COMMENT 'Nro de puerta',
  `tic_nro_asociado` int(10) unsigned DEFAULT NULL COMMENT 'Ticket al cual esta asociado este ticket',
  `tic_identificador` varchar(45) DEFAULT NULL COMMENT 'Identificador administrativo ej. RECLAMO 12345/2013',
  PRIMARY KEY (`tic_nro`),
  KEY `ix_tic_ticket1` (`tic_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket`
--

LOCK TABLES `tic_ticket` WRITE;
/*!40000 ALTER TABLE `tic_ticket` DISABLE KEYS */;
INSERT INTO `tic_ticket` VALUES (4,4,2013,'RECLAMO','2013-04-08 01:25:25','','Una nota','ABIERTO','','LOMAS DE STELLA MARIS','',-38.0086358938483,-57.5388003290637,NULL,NULL,'','2013-04-10 01:25:25',NULL,'',NULL,NULL,'RECLAMO 4/2013'),(5,5,2013,'RECLAMO','2013-04-08 11:58:42','1','','ABIERTO','{\"tipo\":\"DOMICILIO\",\"calle_nombre\":\"CACIQUE TAYCHOCO\",\"calle\":\"04003\",\"callenro\":\"454\",\"piso\":\"\",\"dpto\":\"\",\"nombre_fantasia\":\"\",\"barrio\":\"COLONIA BARRAGAN\",\"comuna\":\"\",\"lat\":\"-38.0435833328913\",\"lng\":\"-57.6254899392465\"}','COLONIA BARRAGAN','',-38.0435833328913,-57.6254899392465,0,64,'CALL','2013-04-10 11:58:42',NULL,'CACIQUE TAYCHOCO',454,NULL,'RECLAMO 5/2013'),(6,6,2013,'RECLAMO','2013-04-09 23:44:40','1','Una nota sobre la lampara quemada','ABIERTO','{\"tipo\":\"DOMICILIO\",\"calle_nombre\":\"CHAMPAGNAT, SAN MARCELINO\",\"calle\":\"00490\",\"callenro\":\"1200\",\"piso\":\"\",\"dpto\":\"\",\"nombre_fantasia\":\"\",\"barrio\":\"NUEVE DE JULIO\",\"comuna\":\"\",\"lat\":\"-37.9771348173761\",\"lng\":\"-57.5799002633264\"}','NUEVE DE JULIO','',-37.9771348173761,-57.5799002633264,0,68,'CALL','2013-04-11 23:44:40',NULL,'CHAMPAGNAT, SAN MARCELINO',1200,NULL,'RECLAMO 6/2013'),(7,7,2013,'RECLAMO','2013-04-11 10:32:48','1','Un lio barbaro','ABIERTO','{\"tipo\":\"DOMICILIO\",\"calle_nombre\":\"ALVEAR, CARLOS MARIA\",\"calle\":\"00342\",\"callenro\":\"456\",\"piso\":\"2\",\"dpto\":\"\",\"nombre_fantasia\":\"\",\"barrio\":\"DEL PUERTO\",\"comuna\":\"\",\"lat\":\"-38.0086896250302\",\"lng\":\"-57.5345889139824\"}','DEL PUERTO','',-38.0086896250302,-57.5345889139824,0,73,'CALL','2013-04-11 10:32:48',NULL,'ALVEAR, CARLOS MARIA',456,NULL,'RECLAMO 7/2013');
/*!40000 ALTER TABLE `tic_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket_asociado`
--

DROP TABLE IF EXISTS `tic_ticket_asociado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket_asociado` (
  `tic_nro` int(10) NOT NULL COMMENT 'codigo del ticket',
  `tic_nro_asoc` int(10) NOT NULL COMMENT 'codigo del ticket asociado a este',
  `tta_tstamp` datetime DEFAULT NULL COMMENT 'fecha de la asociación\n',
  `use_code` varchar(50) DEFAULT NULL COMMENT 'operador que hizo la asociación',
  `tta_motivo` varchar(500) DEFAULT NULL COMMENT 'motivo de la asociación',
  PRIMARY KEY (`tic_nro`,`tic_nro_asoc`),
  KEY `fk_ticket_asociados_idx` (`tic_nro`),
  CONSTRAINT `fk_ticket_asociados` FOREIGN KEY (`tic_nro`) REFERENCES `tic_ticket` (`tic_nro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket_asociado`
--

LOCK TABLES `tic_ticket_asociado` WRITE;
/*!40000 ALTER TABLE `tic_ticket_asociado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_ticket_asociado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket_ciudadano`
--

DROP TABLE IF EXISTS `tic_ticket_ciudadano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket_ciudadano` (
  `tic_nro` int(10) NOT NULL COMMENT 'codigo del ticket',
  `ciu_code` int(10) NOT NULL COMMENT 'código del ciudadano',
  `ttc_tstamp` datetime DEFAULT NULL COMMENT 'fecha de inicio del ticket',
  `ttc_nota` varchar(1000) DEFAULT NULL COMMENT 'observación al crear el ticket',
  PRIMARY KEY (`tic_nro`,`ciu_code`),
  KEY `fk_ticket_ciudadano_idx` (`tic_nro`),
  KEY `fk_ciudadano_ticket_idx` (`ciu_code`),
  CONSTRAINT `fk_ciudadano_ticket` FOREIGN KEY (`ciu_code`) REFERENCES `ciu_ciudadanos` (`ciu_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_ciudadano` FOREIGN KEY (`tic_nro`) REFERENCES `tic_ticket` (`tic_nro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket_ciudadano`
--

LOCK TABLES `tic_ticket_ciudadano` WRITE;
/*!40000 ALTER TABLE `tic_ticket_ciudadano` DISABLE KEYS */;
INSERT INTO `tic_ticket_ciudadano` VALUES (4,36,'2013-04-08 01:25:25','Una nota'),(5,36,'2013-04-08 11:58:42',''),(6,59,'2013-04-09 23:44:41','Una nota sobre la lampara quemada'),(7,36,'2013-04-11 10:32:48','Un lio barbaro');
/*!40000 ALTER TABLE `tic_ticket_ciudadano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket_ciudadano_reit`
--

DROP TABLE IF EXISTS `tic_ticket_ciudadano_reit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket_ciudadano_reit` (
  `tic_nro` int(10) NOT NULL COMMENT 'codigo de ticket',
  `ciu_code` int(10) NOT NULL COMMENT 'código de ciudadano',
  `ttc_tstamp` datetime NOT NULL COMMENT 'fecha de la reiteración',
  `ttc_nota` varchar(1000) DEFAULT NULL COMMENT 'Observacion al momento de reiterar',
  PRIMARY KEY (`tic_nro`,`ciu_code`,`ttc_tstamp`),
  KEY `fk_ticket_reitera_idx` (`tic_nro`),
  KEY `fk_reitera_ciudadano_idx` (`ciu_code`),
  CONSTRAINT `fk_reitera_ciudadano` FOREIGN KEY (`ciu_code`) REFERENCES `ciu_ciudadanos` (`ciu_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_reitera` FOREIGN KEY (`tic_nro`) REFERENCES `tic_ticket` (`tic_nro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket_ciudadano_reit`
--

LOCK TABLES `tic_ticket_ciudadano_reit` WRITE;
/*!40000 ALTER TABLE `tic_ticket_ciudadano_reit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tic_ticket_ciudadano_reit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket_organismos`
--

DROP TABLE IF EXISTS `tic_ticket_organismos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket_organismos` (
  `tic_nro` int(10) NOT NULL COMMENT 'codigo del ticket',
  `tpr_code` varchar(20) NOT NULL,
  `tor_code` int(10) NOT NULL COMMENT 'codino del organismo',
  `tto_figura` varchar(50) NOT NULL DEFAULT '' COMMENT 'rol del organismo RESPONSABLE, PRESTADOR, OBSERVADOR',
  PRIMARY KEY (`tic_nro`,`tpr_code`,`tor_code`,`tto_figura`) USING BTREE,
  KEY `fk_organismo_ticket_idx` (`tor_code`),
  KEY `fk_ticket_prestacion_organismo_idx` (`tic_nro`,`tpr_code`),
  CONSTRAINT `fk_organismo_ticket` FOREIGN KEY (`tor_code`) REFERENCES `tic_organismos` (`tor_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_prestacion_organismo` FOREIGN KEY (`tic_nro`, `tpr_code`) REFERENCES `tic_ticket_prestaciones` (`tic_nro`, `tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket_organismos`
--

LOCK TABLES `tic_ticket_organismos` WRITE;
/*!40000 ALTER TABLE `tic_ticket_organismos` DISABLE KEYS */;
INSERT INTO `tic_ticket_organismos` VALUES (4,'0101',1,'PRESTADOR'),(4,'0101',1,'RESPONSABLE'),(5,'0101',1,'PRESTADOR'),(5,'0101',1,'RESPONSABLE'),(6,'0101',1,'PRESTADOR'),(6,'0101',1,'RESPONSABLE');
/*!40000 ALTER TABLE `tic_ticket_organismos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tic_ticket_prestaciones`
--

DROP TABLE IF EXISTS `tic_ticket_prestaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tic_ticket_prestaciones` (
  `tic_nro` int(10) NOT NULL COMMENT 'Codigo de ticket',
  `tpr_code` varchar(20) NOT NULL COMMENT 'Codigo de prestacion',
  `tru_code` int(10) DEFAULT NULL COMMENT 'Codigo de rubro',
  `ttp_cuestionario` varchar(3000) DEFAULT NULL COMMENT 'JSON con el cuestionario',
  `ttp_estado` varchar(50) DEFAULT NULL COMMENT 'estado',
  `ttp_prioridad` varchar(20) DEFAULT NULL COMMENT 'prioridad',
  `ttp_tstamp_plazo` datetime DEFAULT NULL COMMENT 'Fecha de terminación estipulada',
  `ttp_alerta` int(10) DEFAULT NULL COMMENT 'Flag si esta en estado de alerta',
  PRIMARY KEY (`tic_nro`,`tpr_code`),
  KEY `fk_ticket_prestacion_idx` (`tic_nro`),
  KEY `fk_prestacion_ticket_idx` (`tpr_code`),
  CONSTRAINT `fk_prestacion_ticket` FOREIGN KEY (`tpr_code`) REFERENCES `tic_prestaciones` (`tpr_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_prestacion` FOREIGN KEY (`tic_nro`) REFERENCES `tic_ticket` (`tic_nro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tic_ticket_prestaciones`
--

LOCK TABLES `tic_ticket_prestaciones` WRITE;
/*!40000 ALTER TABLE `tic_ticket_prestaciones` DISABLE KEYS */;
INSERT INTO `tic_ticket_prestaciones` VALUES (4,'0101',0,'&lt;?xml version=\"1.0\" encoding=\"UTF-8\"?&gt;&lt;cuestionarioresultado&gt;&lt;/cuestionarioresultado&gt;','INICIADO','1.1',NULL,NULL),(5,'0101',0,'&lt;?xml version=\"1.0\" encoding=\"UTF-8\"?&gt;&lt;cuestionarioresultado&gt;&lt;/cuestionarioresultado&gt;','INICIADO','1.1',NULL,NULL),(6,'0101',0,'&lt;?xml version=\"1.0\" encoding=\"UTF-8\"?&gt;&lt;cuestionarioresultado&gt;&lt;/cuestionarioresultado&gt;','INICIADO','1.1',NULL,NULL),(7,'0202',0,'&lt;?xml version=\"1.0\" encoding=\"UTF-8\"?&gt;&lt;cuestionarioresultado&gt;&lt;/cuestionarioresultado&gt;','INICIADO','1.1',NULL,NULL);
/*!40000 ALTER TABLE `tic_ticket_prestaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tra_audit`
--

DROP TABLE IF EXISTS `tra_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tra_audit` (
  `aud_seq` int(10) NOT NULL,
  `tra_code` varchar(50) NOT NULL,
  `aud_step` varchar(50) DEFAULT NULL,
  `use_code` varchar(50) DEFAULT NULL,
  `use_name` varchar(100) DEFAULT NULL,
  `aud_tstamp` datetime DEFAULT NULL,
  `aud_object` varchar(50) DEFAULT NULL,
  `aud_step_label` varchar(100) DEFAULT NULL,
  `aud_msg` varchar(4000) DEFAULT NULL,
  `aud_result` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aud_seq`,`tra_code`),
  KEY `fk_tra_list_audit_idx` (`tra_code`),
  CONSTRAINT `fk_tra_list_audit` FOREIGN KEY (`tra_code`) REFERENCES `tra_list` (`tra_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tra_audit`
--

LOCK TABLES `tra_audit` WRITE;
/*!40000 ALTER TABLE `tra_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tra_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tra_events`
--

DROP TABLE IF EXISTS `tra_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tra_events` (
  `tev_object` varchar(50) NOT NULL,
  `tev_op` char(1) NOT NULL,
  `tev_code` varchar(50) NOT NULL,
  `tev_tstamp` datetime NOT NULL,
  `tev_proc_tstamp` datetime DEFAULT NULL,
  `ave_code` varchar(50) DEFAULT NULL,
  `tev_class` varchar(200) DEFAULT NULL,
  `tev_key` int(10) NOT NULL,
  `tev_proc_result` varchar(400) DEFAULT NULL,
  `tev_template` varchar(200) DEFAULT NULL,
  `tev_mail_to` varchar(200) DEFAULT NULL,
  `tev_presentation` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`tev_object`,`tev_op`,`tev_code`,`tev_tstamp`,`tev_key`),
  UNIQUE KEY `pk_tra_events_1` (`tev_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tra_events`
--

LOCK TABLES `tra_events` WRITE;
/*!40000 ALTER TABLE `tra_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `tra_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tra_list`
--

DROP TABLE IF EXISTS `tra_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tra_list` (
  `tra_code` varchar(50) NOT NULL,
  `tra_sys` varchar(50) DEFAULT NULL,
  `cir_code` varchar(50) DEFAULT NULL,
  `tra_act_level` decimal(18,0) DEFAULT NULL,
  `tra_rol` varchar(50) DEFAULT NULL,
  `tra_status` varchar(50) DEFAULT NULL,
  `tra_doc_xml` varchar(50) DEFAULT NULL,
  `tra_route_xml` varchar(50) DEFAULT NULL,
  `tra_prop_xml` varchar(50) DEFAULT NULL,
  `tra_tstamp_in` datetime DEFAULT NULL,
  `tra_tstamp_alarm` datetime DEFAULT NULL,
  `tra_key` varchar(100) DEFAULT NULL,
  `tra_key_desc` varchar(200) DEFAULT NULL,
  `tra_viewer` varchar(100) DEFAULT NULL,
  `tra_result` varchar(50) DEFAULT NULL,
  `tra_result_msg` varchar(500) DEFAULT NULL,
  `use_code_owner` varchar(50) DEFAULT NULL,
  `uri` varchar(50) DEFAULT NULL,
  `tra_handler` varchar(100) DEFAULT NULL,
  `use_code_aut` varchar(50) DEFAULT NULL,
  `tra_engine` varchar(50) DEFAULT NULL,
  `tra_job_status` varchar(50) DEFAULT NULL,
  `tra_job_error` varchar(500) DEFAULT NULL,
  `tra_change` char(1) DEFAULT NULL,
  `tra_can_print` char(1) DEFAULT NULL,
  `tra_hide_tstamp` datetime DEFAULT NULL,
  PRIMARY KEY (`tra_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tra_list`
--

LOCK TABLES `tra_list` WRITE;
/*!40000 ALTER TABLE `tra_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `tra_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tra_log`
--

DROP TABLE IF EXISTS `tra_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tra_log` (
  `swo_code` varchar(50) NOT NULL,
  `san_code` int(10) DEFAULT NULL,
  `trl_code` int(10) NOT NULL,
  `trl_msg` varchar(1024) DEFAULT NULL,
  `trl_read` char(1) DEFAULT NULL,
  PRIMARY KEY (`swo_code`,`trl_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tra_log`
--

LOCK TABLES `tra_log` WRITE;
/*!40000 ALTER TABLE `tra_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tra_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_ticket_ciu`
--

DROP TABLE IF EXISTS `v_ticket_ciu`;
/*!50001 DROP VIEW IF EXISTS `v_ticket_ciu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_ticket_ciu` (
  `tic_nro` tinyint NOT NULL,
  `tic_numero` tinyint NOT NULL,
  `tic_anio` tinyint NOT NULL,
  `tic_tipo` tinyint NOT NULL,
  `tic_tstamp_in` tinyint NOT NULL,
  `use_code` tinyint NOT NULL,
  `tic_nota_in` tinyint NOT NULL,
  `tic_estado` tinyint NOT NULL,
  `tic_lugar` tinyint NOT NULL,
  `tic_barrio` tinyint NOT NULL,
  `tic_cgpc` tinyint NOT NULL,
  `tic_coordx` tinyint NOT NULL,
  `tic_coordy` tinyint NOT NULL,
  `tic_id_cuadra` tinyint NOT NULL,
  `tic_forms` tinyint NOT NULL,
  `tic_canal` tinyint NOT NULL,
  `tic_tstamp_plazo` tinyint NOT NULL,
  `tic_tstamp_cierre` tinyint NOT NULL,
  `tic_calle_nombre` tinyint NOT NULL,
  `tic_nro_puerta` tinyint NOT NULL,
  `tic_nro_asociado` tinyint NOT NULL,
  `tic_identificador` tinyint NOT NULL,
  `ciu_code` tinyint NOT NULL,
  `ttc_tstamp` tinyint NOT NULL,
  `ciu_nombres` tinyint NOT NULL,
  `ciu_apellido` tinyint NOT NULL,
  `ciu_sexo` tinyint NOT NULL,
  `ciu_nacimiento` tinyint NOT NULL,
  `ciu_email` tinyint NOT NULL,
  `ciu_tel_fijo` tinyint NOT NULL,
  `ciu_tel_movil` tinyint NOT NULL,
  `ciu_horario_cont` tinyint NOT NULL,
  `ciu_no_llamar` tinyint NOT NULL,
  `ciu_no_email` tinyint NOT NULL,
  `ciu_dir_calle` tinyint NOT NULL,
  `ciu_dir_nro` tinyint NOT NULL,
  `ciu_dir_piso` tinyint NOT NULL,
  `ciu_dir_dpto` tinyint NOT NULL,
  `ciu_barrio` tinyint NOT NULL,
  `ciu_localidad` tinyint NOT NULL,
  `ciu_provincia` tinyint NOT NULL,
  `ciu_pais` tinyint NOT NULL,
  `ciu_cod_postal` tinyint NOT NULL,
  `ciu_cgpc` tinyint NOT NULL,
  `ciu_coord_x` tinyint NOT NULL,
  `ciu_coord_y` tinyint NOT NULL,
  `ciu_trabaja` tinyint NOT NULL,
  `ciu_nivel_estudio` tinyint NOT NULL,
  `ciu_profesion` tinyint NOT NULL,
  `ciu_ultimo_acceso` tinyint NOT NULL,
  `ciu_canal_ingreso` tinyint NOT NULL,
  `ciu_estado` tinyint NOT NULL,
  `ciu_tipo_persona` tinyint NOT NULL,
  `ciu_razon_social` tinyint NOT NULL,
  `ciu_nacionalidad` tinyint NOT NULL,
  `tpr_code` tinyint NOT NULL,
  `tru_code` tinyint NOT NULL,
  `ttp_cuestionario` tinyint NOT NULL,
  `ttp_estado` tinyint NOT NULL,
  `ttp_prioridad` tinyint NOT NULL,
  `ttp_tstamp_plazo` tinyint NOT NULL,
  `ttp_alerta` tinyint NOT NULL,
  `tpr_tipo` tinyint NOT NULL,
  `tpr_detalle` tinyint NOT NULL,
  `tpr_estado` tinyint NOT NULL,
  `tpr_ubicacion` tinyint NOT NULL,
  `tpr_plazo` tinyint NOT NULL,
  `tpr_show` tinyint NOT NULL,
  `tpr_metadata` tinyint NOT NULL,
  `tpr_keywords` tinyint NOT NULL,
  `tpr_admin` tinyint NOT NULL,
  `tpr_al_inicio` tinyint NOT NULL,
  `tpr_al_final` tinyint NOT NULL,
  `tpr_al_vencimiento` tinyint NOT NULL,
  `tor_code_inspeccion` tinyint NOT NULL,
  `tor_code_verificacion` tinyint NOT NULL,
  `tpr_asociar_radio` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_ticket_ciu_reit`
--

DROP TABLE IF EXISTS `v_ticket_ciu_reit`;
/*!50001 DROP VIEW IF EXISTS `v_ticket_ciu_reit`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_ticket_ciu_reit` (
  `tic_nro` tinyint NOT NULL,
  `tic_numero` tinyint NOT NULL,
  `tic_anio` tinyint NOT NULL,
  `tic_tipo` tinyint NOT NULL,
  `tic_tstamp_in` tinyint NOT NULL,
  `use_code` tinyint NOT NULL,
  `tic_nota_in` tinyint NOT NULL,
  `tic_estado` tinyint NOT NULL,
  `tic_lugar` tinyint NOT NULL,
  `tic_barrio` tinyint NOT NULL,
  `tic_cgpc` tinyint NOT NULL,
  `tic_coordx` tinyint NOT NULL,
  `tic_coordy` tinyint NOT NULL,
  `tic_id_cuadra` tinyint NOT NULL,
  `tic_forms` tinyint NOT NULL,
  `tic_canal` tinyint NOT NULL,
  `tic_tstamp_plazo` tinyint NOT NULL,
  `tic_tstamp_cierre` tinyint NOT NULL,
  `tic_calle_nombre` tinyint NOT NULL,
  `tic_nro_puerta` tinyint NOT NULL,
  `tic_nro_asociado` tinyint NOT NULL,
  `tic_identificador` tinyint NOT NULL,
  `ciu_code` tinyint NOT NULL,
  `ttc_tstamp` tinyint NOT NULL,
  `ciu_nombres` tinyint NOT NULL,
  `ciu_apellido` tinyint NOT NULL,
  `ciu_sexo` tinyint NOT NULL,
  `ciu_nacimiento` tinyint NOT NULL,
  `ciu_email` tinyint NOT NULL,
  `ciu_tel_fijo` tinyint NOT NULL,
  `ciu_tel_movil` tinyint NOT NULL,
  `ciu_horario_cont` tinyint NOT NULL,
  `ciu_no_llamar` tinyint NOT NULL,
  `ciu_no_email` tinyint NOT NULL,
  `ciu_dir_calle` tinyint NOT NULL,
  `ciu_dir_nro` tinyint NOT NULL,
  `ciu_dir_piso` tinyint NOT NULL,
  `ciu_dir_dpto` tinyint NOT NULL,
  `ciu_barrio` tinyint NOT NULL,
  `ciu_localidad` tinyint NOT NULL,
  `ciu_provincia` tinyint NOT NULL,
  `ciu_pais` tinyint NOT NULL,
  `ciu_cod_postal` tinyint NOT NULL,
  `ciu_cgpc` tinyint NOT NULL,
  `ciu_coord_x` tinyint NOT NULL,
  `ciu_coord_y` tinyint NOT NULL,
  `ciu_trabaja` tinyint NOT NULL,
  `ciu_nivel_estudio` tinyint NOT NULL,
  `ciu_profesion` tinyint NOT NULL,
  `ciu_ultimo_acceso` tinyint NOT NULL,
  `ciu_canal_ingreso` tinyint NOT NULL,
  `ciu_estado` tinyint NOT NULL,
  `ciu_tipo_persona` tinyint NOT NULL,
  `ciu_razon_social` tinyint NOT NULL,
  `ciu_nacionalidad` tinyint NOT NULL,
  `tpr_code` tinyint NOT NULL,
  `tru_code` tinyint NOT NULL,
  `ttp_cuestionario` tinyint NOT NULL,
  `ttp_estado` tinyint NOT NULL,
  `ttp_prioridad` tinyint NOT NULL,
  `ttp_tstamp_plazo` tinyint NOT NULL,
  `ttp_alerta` tinyint NOT NULL,
  `tpr_tipo` tinyint NOT NULL,
  `tpr_detalle` tinyint NOT NULL,
  `tpr_estado` tinyint NOT NULL,
  `tpr_ubicacion` tinyint NOT NULL,
  `tpr_plazo` tinyint NOT NULL,
  `tpr_show` tinyint NOT NULL,
  `tpr_metadata` tinyint NOT NULL,
  `tpr_keywords` tinyint NOT NULL,
  `tpr_admin` tinyint NOT NULL,
  `tpr_al_inicio` tinyint NOT NULL,
  `tpr_al_final` tinyint NOT NULL,
  `tpr_al_vencimiento` tinyint NOT NULL,
  `tor_code_inspeccion` tinyint NOT NULL,
  `tor_code_verificacion` tinyint NOT NULL,
  `tpr_asociar_radio` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tickets`
--

DROP TABLE IF EXISTS `v_tickets`;
/*!50001 DROP VIEW IF EXISTS `v_tickets`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tickets` (
  `tic_nro` tinyint NOT NULL,
  `tic_numero` tinyint NOT NULL,
  `tic_anio` tinyint NOT NULL,
  `tic_tipo` tinyint NOT NULL,
  `tic_tstamp_in` tinyint NOT NULL,
  `use_code` tinyint NOT NULL,
  `tic_nota_in` tinyint NOT NULL,
  `tic_estado` tinyint NOT NULL,
  `tic_lugar` tinyint NOT NULL,
  `tic_barrio` tinyint NOT NULL,
  `tic_cgpc` tinyint NOT NULL,
  `tic_coordx` tinyint NOT NULL,
  `tic_coordy` tinyint NOT NULL,
  `tic_id_cuadra` tinyint NOT NULL,
  `tic_forms` tinyint NOT NULL,
  `tic_canal` tinyint NOT NULL,
  `tic_tstamp_plazo` tinyint NOT NULL,
  `tic_tstamp_cierre` tinyint NOT NULL,
  `tic_calle_nombre` tinyint NOT NULL,
  `tic_nro_puerta` tinyint NOT NULL,
  `tic_nro_asociado` tinyint NOT NULL,
  `tic_identificador` tinyint NOT NULL,
  `tpr_code` tinyint NOT NULL,
  `tru_code` tinyint NOT NULL,
  `ttp_cuestionario` tinyint NOT NULL,
  `ttp_estado` tinyint NOT NULL,
  `ttp_prioridad` tinyint NOT NULL,
  `ttp_tstamp_plazo` tinyint NOT NULL,
  `ttp_alerta` tinyint NOT NULL,
  `tor_code` tinyint NOT NULL,
  `tto_figura` tinyint NOT NULL,
  `tpr_tipo` tinyint NOT NULL,
  `tpr_detalle` tinyint NOT NULL,
  `tpr_estado` tinyint NOT NULL,
  `tpr_ubicacion` tinyint NOT NULL,
  `tpr_plazo` tinyint NOT NULL,
  `tpr_show` tinyint NOT NULL,
  `tpr_metadata` tinyint NOT NULL,
  `tpr_keywords` tinyint NOT NULL,
  `tpr_admin` tinyint NOT NULL,
  `tpr_al_inicio` tinyint NOT NULL,
  `tpr_al_final` tinyint NOT NULL,
  `tpr_al_vencimiento` tinyint NOT NULL,
  `tor_code_inspeccion` tinyint NOT NULL,
  `tor_code_verificacion` tinyint NOT NULL,
  `tpr_asociar_radio` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'mgp'
--
/*!50003 DROP FUNCTION IF EXISTS `getCiudadano` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getCiudadano`(pciu_code int) RETURNS varchar(200) CHARSET latin1
    READS SQL DATA
    DETERMINISTIC
begin
  declare ret varchar(200);
  DECLARE EXIT HANDLER FOR NOT FOUND return 'ANONIMO';
  select concat(ciu_apellido,', ',ciu_nombres) into ret from ciu_ciudadanos
  where ciu_code=pciu_code;
  return ret;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getPrestaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getPrestaciones`(tic_numero int,tic_anio int, tic_tipo varchar(20)) RETURNS varchar(200) CHARSET latin1
    READS SQL DATA
    DETERMINISTIC
begin
  declare ret varchar(200);
  DECLARE EXIT HANDLER FOR NOT FOUND return 'SIN PRESTACIONES';
  select concat(p.tpr_code,'-',p.tpr_detalle) into ret from tic_ticket_prestaciones tp join tic_prestaciones p on tp.tpr_code=p.tpr_code
  where tp.tic_nro=tic_numero and tp.tic_anio=tic_anio and tp.tic_tipo=tic_tipo;
  return ret;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `v_ticket_ciu`
--

/*!50001 DROP TABLE IF EXISTS `v_ticket_ciu`*/;
/*!50001 DROP VIEW IF EXISTS `v_ticket_ciu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_ticket_ciu` AS select `tic`.`tic_nro` AS `tic_nro`,`tic`.`tic_numero` AS `tic_numero`,`tic`.`tic_anio` AS `tic_anio`,`tic`.`tic_tipo` AS `tic_tipo`,`tic`.`tic_tstamp_in` AS `tic_tstamp_in`,`tic`.`use_code` AS `use_code`,`tic`.`tic_nota_in` AS `tic_nota_in`,`tic`.`tic_estado` AS `tic_estado`,`tic`.`tic_lugar` AS `tic_lugar`,`tic`.`tic_barrio` AS `tic_barrio`,`tic`.`tic_cgpc` AS `tic_cgpc`,`tic`.`tic_coordx` AS `tic_coordx`,`tic`.`tic_coordy` AS `tic_coordy`,`tic`.`tic_id_cuadra` AS `tic_id_cuadra`,`tic`.`tic_forms` AS `tic_forms`,`tic`.`tic_canal` AS `tic_canal`,`tic`.`tic_tstamp_plazo` AS `tic_tstamp_plazo`,`tic`.`tic_tstamp_cierre` AS `tic_tstamp_cierre`,`tic`.`tic_calle_nombre` AS `tic_calle_nombre`,`tic`.`tic_nro_puerta` AS `tic_nro_puerta`,`tic`.`tic_nro_asociado` AS `tic_nro_asociado`,`tic`.`tic_identificador` AS `tic_identificador`,`tc`.`ciu_code` AS `ciu_code`,`tc`.`ttc_tstamp` AS `ttc_tstamp`,`tc`.`ttc_nota` AS `ciu_nombres`,`ciu`.`ciu_apellido` AS `ciu_apellido`,`ciu`.`ciu_sexo` AS `ciu_sexo`,`ciu`.`ciu_nacimiento` AS `ciu_nacimiento`,`ciu`.`ciu_email` AS `ciu_email`,`ciu`.`ciu_tel_fijo` AS `ciu_tel_fijo`,`ciu`.`ciu_tel_movil` AS `ciu_tel_movil`,`ciu`.`ciu_horario_cont` AS `ciu_horario_cont`,`ciu`.`ciu_no_llamar` AS `ciu_no_llamar`,`ciu`.`ciu_no_email` AS `ciu_no_email`,`ciu`.`ciu_dir_calle` AS `ciu_dir_calle`,`ciu`.`ciu_dir_nro` AS `ciu_dir_nro`,`ciu`.`ciu_dir_piso` AS `ciu_dir_piso`,`ciu`.`ciu_dir_dpto` AS `ciu_dir_dpto`,`ciu`.`ciu_barrio` AS `ciu_barrio`,`ciu`.`ciu_localidad` AS `ciu_localidad`,`ciu`.`ciu_provincia` AS `ciu_provincia`,`ciu`.`ciu_pais` AS `ciu_pais`,`ciu`.`ciu_cod_postal` AS `ciu_cod_postal`,`ciu`.`ciu_cgpc` AS `ciu_cgpc`,`ciu`.`ciu_coord_x` AS `ciu_coord_x`,`ciu`.`ciu_coord_y` AS `ciu_coord_y`,`ciu`.`ciu_trabaja` AS `ciu_trabaja`,`ciu`.`ciu_nivel_estudio` AS `ciu_nivel_estudio`,`ciu`.`ciu_profesion` AS `ciu_profesion`,`ciu`.`ciu_ultimo_acceso` AS `ciu_ultimo_acceso`,`ciu`.`ciu_canal_ingreso` AS `ciu_canal_ingreso`,`ciu`.`ciu_estado` AS `ciu_estado`,`ciu`.`ciu_tipo_persona` AS `ciu_tipo_persona`,`ciu`.`ciu_razon_social` AS `ciu_razon_social`,`ciu`.`ciu_nacionalidad` AS `ciu_nacionalidad`,`tpr`.`tpr_code` AS `tpr_code`,`tpr`.`tru_code` AS `tru_code`,`tpr`.`ttp_cuestionario` AS `ttp_cuestionario`,`tpr`.`ttp_estado` AS `ttp_estado`,`tpr`.`ttp_prioridad` AS `ttp_prioridad`,`tpr`.`ttp_tstamp_plazo` AS `ttp_tstamp_plazo`,`tpr`.`ttp_alerta` AS `ttp_alerta`,`pre`.`tpr_tipo` AS `tpr_tipo`,`pre`.`tpr_detalle` AS `tpr_detalle`,`pre`.`tpr_estado` AS `tpr_estado`,`pre`.`tpr_ubicacion` AS `tpr_ubicacion`,`pre`.`tpr_plazo` AS `tpr_plazo`,`pre`.`tpr_show` AS `tpr_show`,`pre`.`tpr_metadata` AS `tpr_metadata`,`pre`.`tpr_keywords` AS `tpr_keywords`,`pre`.`tpr_admin` AS `tpr_admin`,`pre`.`tpr_al_inicio` AS `tpr_al_inicio`,`pre`.`tpr_al_final` AS `tpr_al_final`,`pre`.`tpr_al_vencimiento` AS `tpr_al_vencimiento`,`pre`.`tor_code_inspeccion` AS `tor_code_inspeccion`,`pre`.`tor_code_verificacion` AS `tor_code_verificacion`,`pre`.`tpr_asociar_radio` AS `tpr_asociar_radio` from ((((`tic_ticket` `tic` left join `tic_ticket_ciudadano` `tc` on((`tic`.`tic_nro` = `tc`.`tic_nro`))) left join `ciu_ciudadanos` `ciu` on((`tc`.`ciu_code` = `ciu`.`ciu_code`))) left join `tic_ticket_prestaciones` `tpr` on((`tic`.`tic_nro` = `tpr`.`tic_nro`))) left join `tic_prestaciones` `pre` on((`tpr`.`tpr_code` = `pre`.`tpr_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_ticket_ciu_reit`
--

/*!50001 DROP TABLE IF EXISTS `v_ticket_ciu_reit`*/;
/*!50001 DROP VIEW IF EXISTS `v_ticket_ciu_reit`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_ticket_ciu_reit` AS select `tic`.`tic_nro` AS `tic_nro`,`tic`.`tic_numero` AS `tic_numero`,`tic`.`tic_anio` AS `tic_anio`,`tic`.`tic_tipo` AS `tic_tipo`,`tic`.`tic_tstamp_in` AS `tic_tstamp_in`,`tic`.`use_code` AS `use_code`,`tic`.`tic_nota_in` AS `tic_nota_in`,`tic`.`tic_estado` AS `tic_estado`,`tic`.`tic_lugar` AS `tic_lugar`,`tic`.`tic_barrio` AS `tic_barrio`,`tic`.`tic_cgpc` AS `tic_cgpc`,`tic`.`tic_coordx` AS `tic_coordx`,`tic`.`tic_coordy` AS `tic_coordy`,`tic`.`tic_id_cuadra` AS `tic_id_cuadra`,`tic`.`tic_forms` AS `tic_forms`,`tic`.`tic_canal` AS `tic_canal`,`tic`.`tic_tstamp_plazo` AS `tic_tstamp_plazo`,`tic`.`tic_tstamp_cierre` AS `tic_tstamp_cierre`,`tic`.`tic_calle_nombre` AS `tic_calle_nombre`,`tic`.`tic_nro_puerta` AS `tic_nro_puerta`,`tic`.`tic_nro_asociado` AS `tic_nro_asociado`,`tic`.`tic_identificador` AS `tic_identificador`,`tc`.`ciu_code` AS `ciu_code`,`tc`.`ttc_tstamp` AS `ttc_tstamp`,`tc`.`ttc_nota` AS `ciu_nombres`,`ciu`.`ciu_apellido` AS `ciu_apellido`,`ciu`.`ciu_sexo` AS `ciu_sexo`,`ciu`.`ciu_nacimiento` AS `ciu_nacimiento`,`ciu`.`ciu_email` AS `ciu_email`,`ciu`.`ciu_tel_fijo` AS `ciu_tel_fijo`,`ciu`.`ciu_tel_movil` AS `ciu_tel_movil`,`ciu`.`ciu_horario_cont` AS `ciu_horario_cont`,`ciu`.`ciu_no_llamar` AS `ciu_no_llamar`,`ciu`.`ciu_no_email` AS `ciu_no_email`,`ciu`.`ciu_dir_calle` AS `ciu_dir_calle`,`ciu`.`ciu_dir_nro` AS `ciu_dir_nro`,`ciu`.`ciu_dir_piso` AS `ciu_dir_piso`,`ciu`.`ciu_dir_dpto` AS `ciu_dir_dpto`,`ciu`.`ciu_barrio` AS `ciu_barrio`,`ciu`.`ciu_localidad` AS `ciu_localidad`,`ciu`.`ciu_provincia` AS `ciu_provincia`,`ciu`.`ciu_pais` AS `ciu_pais`,`ciu`.`ciu_cod_postal` AS `ciu_cod_postal`,`ciu`.`ciu_cgpc` AS `ciu_cgpc`,`ciu`.`ciu_coord_x` AS `ciu_coord_x`,`ciu`.`ciu_coord_y` AS `ciu_coord_y`,`ciu`.`ciu_trabaja` AS `ciu_trabaja`,`ciu`.`ciu_nivel_estudio` AS `ciu_nivel_estudio`,`ciu`.`ciu_profesion` AS `ciu_profesion`,`ciu`.`ciu_ultimo_acceso` AS `ciu_ultimo_acceso`,`ciu`.`ciu_canal_ingreso` AS `ciu_canal_ingreso`,`ciu`.`ciu_estado` AS `ciu_estado`,`ciu`.`ciu_tipo_persona` AS `ciu_tipo_persona`,`ciu`.`ciu_razon_social` AS `ciu_razon_social`,`ciu`.`ciu_nacionalidad` AS `ciu_nacionalidad`,`tpr`.`tpr_code` AS `tpr_code`,`tpr`.`tru_code` AS `tru_code`,`tpr`.`ttp_cuestionario` AS `ttp_cuestionario`,`tpr`.`ttp_estado` AS `ttp_estado`,`tpr`.`ttp_prioridad` AS `ttp_prioridad`,`tpr`.`ttp_tstamp_plazo` AS `ttp_tstamp_plazo`,`tpr`.`ttp_alerta` AS `ttp_alerta`,`pre`.`tpr_tipo` AS `tpr_tipo`,`pre`.`tpr_detalle` AS `tpr_detalle`,`pre`.`tpr_estado` AS `tpr_estado`,`pre`.`tpr_ubicacion` AS `tpr_ubicacion`,`pre`.`tpr_plazo` AS `tpr_plazo`,`pre`.`tpr_show` AS `tpr_show`,`pre`.`tpr_metadata` AS `tpr_metadata`,`pre`.`tpr_keywords` AS `tpr_keywords`,`pre`.`tpr_admin` AS `tpr_admin`,`pre`.`tpr_al_inicio` AS `tpr_al_inicio`,`pre`.`tpr_al_final` AS `tpr_al_final`,`pre`.`tpr_al_vencimiento` AS `tpr_al_vencimiento`,`pre`.`tor_code_inspeccion` AS `tor_code_inspeccion`,`pre`.`tor_code_verificacion` AS `tor_code_verificacion`,`pre`.`tpr_asociar_radio` AS `tpr_asociar_radio` from ((((`tic_ticket` `tic` join `tic_ticket_ciudadano_reit` `tc` on((`tic`.`tic_nro` = `tc`.`tic_nro`))) left join `ciu_ciudadanos` `ciu` on((`tc`.`ciu_code` = `ciu`.`ciu_code`))) left join `tic_ticket_prestaciones` `tpr` on((`tic`.`tic_nro` = `tpr`.`tic_nro`))) left join `tic_prestaciones` `pre` on((`tpr`.`tpr_code` = `pre`.`tpr_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tickets`
--

/*!50001 DROP TABLE IF EXISTS `v_tickets`*/;
/*!50001 DROP VIEW IF EXISTS `v_tickets`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tickets` AS select `tic`.`tic_nro` AS `tic_nro`,`tic`.`tic_numero` AS `tic_numero`,`tic`.`tic_anio` AS `tic_anio`,`tic`.`tic_tipo` AS `tic_tipo`,`tic`.`tic_tstamp_in` AS `tic_tstamp_in`,`tic`.`use_code` AS `use_code`,`tic`.`tic_nota_in` AS `tic_nota_in`,`tic`.`tic_estado` AS `tic_estado`,`tic`.`tic_lugar` AS `tic_lugar`,`tic`.`tic_barrio` AS `tic_barrio`,`tic`.`tic_cgpc` AS `tic_cgpc`,`tic`.`tic_coordx` AS `tic_coordx`,`tic`.`tic_coordy` AS `tic_coordy`,`tic`.`tic_id_cuadra` AS `tic_id_cuadra`,`tic`.`tic_forms` AS `tic_forms`,`tic`.`tic_canal` AS `tic_canal`,`tic`.`tic_tstamp_plazo` AS `tic_tstamp_plazo`,`tic`.`tic_tstamp_cierre` AS `tic_tstamp_cierre`,`tic`.`tic_calle_nombre` AS `tic_calle_nombre`,`tic`.`tic_nro_puerta` AS `tic_nro_puerta`,`tic`.`tic_nro_asociado` AS `tic_nro_asociado`,`tic`.`tic_identificador` AS `tic_identificador`,`tpr`.`tpr_code` AS `tpr_code`,`tpr`.`tru_code` AS `tru_code`,`tpr`.`ttp_cuestionario` AS `ttp_cuestionario`,`tpr`.`ttp_estado` AS `ttp_estado`,`tpr`.`ttp_prioridad` AS `ttp_prioridad`,`tpr`.`ttp_tstamp_plazo` AS `ttp_tstamp_plazo`,`tpr`.`ttp_alerta` AS `ttp_alerta`,`tor`.`tor_code` AS `tor_code`,`tor`.`tto_figura` AS `tto_figura`,`pre`.`tpr_tipo` AS `tpr_tipo`,`pre`.`tpr_detalle` AS `tpr_detalle`,`pre`.`tpr_estado` AS `tpr_estado`,`pre`.`tpr_ubicacion` AS `tpr_ubicacion`,`pre`.`tpr_plazo` AS `tpr_plazo`,`pre`.`tpr_show` AS `tpr_show`,`pre`.`tpr_metadata` AS `tpr_metadata`,`pre`.`tpr_keywords` AS `tpr_keywords`,`pre`.`tpr_admin` AS `tpr_admin`,`pre`.`tpr_al_inicio` AS `tpr_al_inicio`,`pre`.`tpr_al_final` AS `tpr_al_final`,`pre`.`tpr_al_vencimiento` AS `tpr_al_vencimiento`,`pre`.`tor_code_inspeccion` AS `tor_code_inspeccion`,`pre`.`tor_code_verificacion` AS `tor_code_verificacion`,`pre`.`tpr_asociar_radio` AS `tpr_asociar_radio` from (((`tic_ticket` `tic` left join `tic_ticket_prestaciones` `tpr` on((`tic`.`tic_nro` = `tpr`.`tic_nro`))) left join `tic_ticket_organismos` `tor` on((`tic`.`tic_nro` = `tor`.`tic_nro`))) left join `tic_prestaciones` `pre` on((`tpr`.`tpr_code` = `pre`.`tpr_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-12 10:09:04
