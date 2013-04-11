-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: mgp
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.2

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-11  9:35:20
