-- MySQL dump 10.13  Distrib 5.7.23-23, for Linux (x86_64)
--
-- Host: localhost    Database: sistem85_OIS
-- ------------------------------------------------------
-- Server version	5.7.23-23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAula` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EstadoAula` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aula`
--

LOCK TABLES `aula` WRITE;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` (`id`, `NombreAula`, `EstadoAula`) VALUES (1,'Rectoria',1),(2,'Secretaria / Rectoria',1),(3,'Secretaria /academica',1),(4,'Secretaria Academica 2',1),(5,'Pagaduria',1),(6,'Orientacion escolar',1),(7,'Coordinacion 1',1),(8,'Coordinacion 2',1),(9,'Coordinacion 3',1),(10,'Coordinacion 4',1),(11,'Sala de Profesores',1),(12,'Biblioteca',1),(13,'Tables',1),(14,'Sala/Tecnologia/Ciencia',1),(15,'Ludoteca',1),(16,'Porteria',1),(17,'Banda',1),(18,'Corredor',1),(19,'Salon 1',1),(20,'Salon  2',1),(21,'Salon 3 ',1),(22,'Salon 4',1),(23,'Salon 5',1),(24,'Salon 6 ',1),(25,'Salon 7',1),(26,'Salon 8',1),(27,'Salon 9 ',1),(28,'Salon 10  ',1),(29,'Salon 11/Sistemas III',1),(30,'Salon 12/Sistemas V',1),(31,'Salon 13/Sistemas II',1),(32,'Salon 14/Sistemas IV ',1),(33,'Salon 15/Sistemas I ',1),(34,'Salon 16',1),(35,'Salon 17',1),(36,'Salon 18.2P',1),(37,'Salon 19',1),(38,'Salon 20',1),(39,'Salon 21',1),(40,'Salon 22 3P',1),(41,'Salon 23 3P',1),(42,'Salon 24 ',1),(43,'Salon 25 Danzas / Emprendimiento',1),(44,'Salon ',0),(48,'Sena',1);
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargousuario`
--

DROP TABLE IF EXISTS `cargousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCargo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `NivelVisibilidad` int(1) NOT NULL,
  `Estado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargousuario`
--

LOCK TABLES `cargousuario` WRITE;
/*!40000 ALTER TABLE `cargousuario` DISABLE KEYS */;
INSERT INTO `cargousuario` (`id`, `NombreCargo`, `NivelVisibilidad`, `Estado`) VALUES (1,'Rector',1,1),(2,'Jefe de Inventario',2,1),(3,'Docente',3,1),(4,'Coordinador',4,1),(5,'Otro',5,1);
/*!40000 ALTER TABLE `cargousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_prestamo`
--

DROP TABLE IF EXISTS `detalle_prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_prestamo` (
  `id` int(11) NOT NULL,
  `PrestamoMobiliario_id` int(11) NOT NULL,
  `MobiliarioAula_id` int(11) NOT NULL,
  `estadoPrestamo_id` int(11) NOT NULL,
  `Fec_Retorno` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PrestamoMobiliario_id` (`PrestamoMobiliario_id`),
  KEY `MobiliarioAula_id` (`MobiliarioAula_id`),
  KEY `estadoPrestamo_id` (`estadoPrestamo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_prestamo`
--

LOCK TABLES `detalle_prestamo` WRITE;
/*!40000 ALTER TABLE `detalle_prestamo` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoPrestamo`
--

DROP TABLE IF EXISTS `estadoPrestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadoPrestamo` (
  `idEstadoMobiliario` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idEstadoMobiliario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoPrestamo`
--

LOCK TABLES `estadoPrestamo` WRITE;
/*!40000 ALTER TABLE `estadoPrestamo` DISABLE KEYS */;
INSERT INTO `estadoPrestamo` (`idEstadoMobiliario`, `Descripcion`) VALUES (1,'Pendiente'),(2,'Devuelto'),(3,'Registrado');
/*!40000 ALTER TABLE `estadoPrestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadomobiliario`
--

DROP TABLE IF EXISTS `estadomobiliario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadomobiliario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreEstadoMobiliario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadomobiliario`
--

LOCK TABLES `estadomobiliario` WRITE;
/*!40000 ALTER TABLE `estadomobiliario` DISABLE KEYS */;
INSERT INTO `estadomobiliario` (`id`, `NombreEstadoMobiliario`) VALUES (1,'Dañado'),(2,'Dado de Baja'),(3,'Dado de Alta'),(4,'Reparación'),(5,'Robado'),(6,'Bueno'),(7,'Malo'),(8,'Regular');
/*!40000 ALTER TABLE `estadomobiliario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMedia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TipoMedia` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `NombreMedia`, `TipoMedia`) VALUES (1,'mesa.jpg','image/jpg');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobiliarioaula`
--

DROP TABLE IF EXISTS `mobiliarioaula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobiliarioaula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMobiliario` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `CodigoMobiliario` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idAula` int(11) NOT NULL,
  `VidaUtilMobiliario` date NOT NULL,
  `VidaUtilMobiliarioFinal` date NOT NULL,
  `idNombreEstadoMobiliario` int(11) NOT NULL,
  `imagenMobiliario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAula` (`idAula`),
  KEY `imagenMobiliario` (`imagenMobiliario`),
  KEY `idNombreEstadoMobiliario` (`idNombreEstadoMobiliario`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobiliarioaula`
--

LOCK TABLES `mobiliarioaula` WRITE;
/*!40000 ALTER TABLE `mobiliarioaula` DISABLE KEYS */;
INSERT INTO `mobiliarioaula` (`id`, `NombreMobiliario`, `CodigoMobiliario`, `idAula`, `VidaUtilMobiliario`, `VidaUtilMobiliarioFinal`, `idNombreEstadoMobiliario`, `imagenMobiliario`) VALUES (1,'TELEFONO CONMUTADOR PANASONIC  MOD KXTS 500 S/N 24UML3BGCOA9ED39','6030',1,'2001-05-06','2003-06-10',6,NULL),(2,'TELEFONO AT&T INALAMBRICO ','1733',1,'2001-05-07','2003-06-11',6,NULL),(3,'CENTRAL TELEFONICA HIBRIDA PANASONIC','',1,'2001-05-08','2003-06-12',6,NULL),(4,'ALARMA','123',1,'2001-05-09','2003-06-13',6,NULL),(5,'ARCHIVADOR EN MADERA 3 CAJONES C.CARAMELO ','1742',1,'2001-05-10','2003-06-14',1,NULL),(6,'CAJA METALICA .60X.35X.30','1739',1,'2001-05-11','2003-06-15',6,NULL),(7,'CAJA METALICA LLAVES JULIO C. .80X.50X.10','1759',1,'2001-05-12','2003-06-16',6,NULL),(8,'ESCRITORIO EN L ESTRUC METALICO Y MADERA COLOR CARAMELO 1.90X.1.85X.60X.75','1734',1,'2001-05-13','2003-06-17',6,NULL),(9,'EXTINTOR MULTIPROPOSITO 20L AMARILLO','1737',1,'2001-05-14','2003-06-18',3,NULL),(10,'MESA DE CENTRO ESTRUC METALICA MADERA C. CARAMELO .60X.50X37.','1736',1,'2001-05-15','2003-06-19',6,NULL),(11,'MESA DE CENTRO ESTRUC METALICA MADERA C. CARAMELO .60X.50X37.','1743',1,'2001-05-16','2003-06-20',6,NULL),(12,'MESA DE CENTRO ESTRUC METALICA MADERA C. CARAMELO .75X.60X.37','1744',1,'2001-05-17','2003-06-21',6,NULL),(13,'MESA DE JUNTAS RECTANGULAR ESTRC METALICA Y MADERA  C. CARAMELO Y NEGRO  2.60X1.22X.75.','1758',1,'2001-05-18','2003-06-22',8,NULL),(14,'MESA UNIPERSONAL POLIPROPILENO AZUL','6026',1,'2001-05-19','2003-06-23',6,NULL),(15,'MUEBLE EN MADERA 1 PUERTA C. CAOBA .76X.55X33.','1732',1,'2001-05-20','2003-06-24',6,NULL),(16,'ROPERO EN MADERA','1738',1,'2001-05-21','2003-06-25',6,NULL),(17,'SILLA CON DESCASABRAZOS PANO Y MALLA NEGRA','1740',1,'2001-05-22','2003-06-26',6,NULL),(18,'SILLA CON DESCASABRAZOS PANO Y MALLA NEGRA','1741',1,'2001-05-23','2003-06-27',6,NULL),(19,'SILLA EN CORDOBAN NEGRO CON DESCASABRAZOS','1745',1,'2001-05-24','2003-06-28',6,NULL),(20,'SILLA EN CORDOBAN NEGRO CON DESCASABRAZOS','1746',1,'2001-05-25','2003-06-29',6,NULL),(21,'SILLA EN PA','1753',1,'2001-05-26','2003-06-30',6,NULL),(22,'SILLA EN PA','1754',1,'2001-05-27','2003-07-01',6,NULL),(23,'SILLA EN PA','1755',1,'2001-05-28','2003-07-02',6,NULL),(24,'SILLA EN PA','1756',1,'2001-05-29','2003-07-03',6,NULL),(25,'SILLA EN PA','1757',1,'2001-05-30','2003-07-04',6,NULL),(26,'SILLA EN PA','1748',1,'2001-05-31','2003-07-05',6,NULL),(27,'SILLA EN PA','1749',1,'2001-06-01','2003-07-06',6,NULL),(28,'SILLA EN PA','1750',1,'2001-06-02','2003-07-07',6,NULL),(29,'SILLA EN PA','1751',1,'2001-06-03','2003-07-08',6,NULL),(30,'SILLA EN PA','1752',1,'2001-06-04','2003-07-09',6,NULL),(31,'SILLA GIRATORIA CON DESCASABRAZOS PA','1735',1,'2001-06-05','2003-07-10',6,NULL),(32,'SILLA POLIPOPILENO AZUL','6027',1,'2001-06-06','2003-07-11',6,NULL),(33,'SOFA EN CORDOBAN NEGRO CON DESCASABRAZOS 3P.','1747',1,'2001-06-07','2003-07-12',6,NULL),(34,'PICA','6028',1,'2001-06-08','2003-07-13',6,NULL),(35,'T.V LG MOD 42PJ350R S/N 6124UBFR467WS946','858',15,'2016-09-08','2020-09-05',6,NULL),(36,'ESTANTE METALICO GRIS 5 ENTREPANNOS 1.90X.39X.91','867',15,'2016-09-08','2020-09-05',2,NULL),(37,'ESTANTE METALICO NEGRO 5 ENTREPANNOS 1.90X.39X.90','859-8',15,'2016-09-08','2020-09-05',6,NULL),(38,'EXTINTOR  AMARILLO ABC 10L','',15,'2016-09-08','2020-09-05',6,NULL),(39,'MESA CUADRADA  RIMAX AMARILLA PEQ','',15,'2016-09-08','2020-09-05',6,NULL),(40,'MESA DE PING PONG','',15,'2016-09-08','2020-09-05',7,NULL),(41,'MESA ESTRUCTURA ANGULO TAPIZADA FORMICA BLANCA PARTE DERECHA MEDIA LUNA','',15,'2016-09-08','2020-09-05',7,NULL),(42,'MESA TRAPEZOIDAL POLIPROPILENO GRIS','868/8',15,'2016-09-08','2020-09-05',6,NULL),(43,'SILLA PANO AZUL','',15,'2016-09-08','2020-09-05',7,NULL),(44,'SILLA POLIPROPILENO AZUL','',15,'2016-09-08','2020-09-05',6,NULL),(45,'SILLA POLIPROPILENO AZUL PEQ','5549-',15,'2016-09-08','2020-09-05',6,NULL),(46,'SILLA VANYPLAST DESCASABRAZOS PEQ AZUL','',15,'2016-09-08','2020-09-05',6,NULL),(47,'SILLA VANYPLAST DESCASABRAZOS PEQ ROJA','',15,'2016-09-08','2020-09-05',6,NULL),(48,'SILLA VANYPLAST DESCASABRAZOS PEQ VERDE','',15,'2016-09-08','2020-09-05',6,NULL),(49,'TRICICLO','',15,'2016-09-08','2020-09-05',6,NULL),(50,'TELOM','896',15,'2016-09-08','2020-09-05',6,NULL),(51,'PUPITRE UNIVER TRIPLEX','',15,'2016-09-08','2020-09-05',7,NULL),(52,'PUPITRE POLIPROPILENO AZUL','',15,'2016-09-08','2020-09-05',6,NULL),(53,'SILLA POLIPROPILENO AZUL PEQ','',15,'2016-09-08','2020-09-05',6,NULL);
/*!40000 ALTER TABLE `mobiliarioaula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novedad`
--

DROP TABLE IF EXISTS `novedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAula` int(11) NOT NULL,
  `idMobiliarioaula` int(11) NOT NULL,
  `idEstadoMobiliario` int(11) NOT NULL,
  `DescripcionNovedad` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idAula` (`idAula`),
  KEY `idMobiliarioaula` (`idMobiliarioaula`),
  KEY `idEstadoMobiliario` (`idEstadoMobiliario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedad`
--

LOCK TABLES `novedad` WRITE;
/*!40000 ALTER TABLE `novedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `novedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamomobiliario`
--

DROP TABLE IF EXISTS `prestamomobiliario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamomobiliario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAula` int(11) NOT NULL,
  `DescripcionPrestamo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InicioFechaPrestamo` datetime NOT NULL,
  `finFechaPrestamo` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idAula` (`idAula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamomobiliario`
--

LOCK TABLES `prestamomobiliario` WRITE;
/*!40000 ALTER TABLE `prestamomobiliario` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestamomobiliario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NombreTipoDocumento` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumento`
--

LOCK TABLES `tipodocumento` WRITE;
/*!40000 ALTER TABLE `tipodocumento` DISABLE KEYS */;
INSERT INTO `tipodocumento` (`id`, `NombreTipoDocumento`) VALUES (1,'Cedula de Ciudadania'),(2,'Cedula de Extranjeria'),(3,'Pasaporte');
/*!40000 ALTER TABLE `tipodocumento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idCargoUsuario` int(11) DEFAULT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `NoDocumento` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `CorreoElectronico` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ClaveUsuario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Estado` int(1) DEFAULT '0',
  `UltimoLogin` datetime DEFAULT NULL,
  `ImagenUsuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no_image.jpg',
  `token` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NoDocumento` (`NoDocumento`),
  UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`),
  KEY `fk_usuar` (`idCargoUsuario`),
  KEY `idTipoDocumento` (`idTipoDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `Nombre`, `Apellido`, `idCargoUsuario`, `idTipoDocumento`, `NoDocumento`, `CorreoElectronico`, `ClaveUsuario`, `Estado`, `UltimoLogin`, `ImagenUsuario`, `token`) VALUES (1,'Admin','Admin',1,1,'0000','admin_admin@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,'2020-03-07 19:42:41','pzg9wa7o1.jpg',NULL),(2,'Diego Alejandro','Serrano Amaya',5,1,'1000182292','diego2002alejo@gmail.com','4ba29b9f9e5732ed33761840f4ba6c53',1,'2020-03-01 20:02:49','c1FwfPOw2.png',''),(3,'Diana','Gil',3,1,'123456','luchitorussi@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef',0,NULL,'no_image.jpg',NULL),(4,'Hector Alves','Silva',4,1,'696969','luchitoru@gmail.com','6b6277afcb65d33525545904e95c2fa240632660',0,NULL,'no_image.jpg',NULL),(5,'Arley','Gutierrez',1,1,'1000123622','sebasverdolagaldspintor@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef',1,'2020-02-28 12:27:12','no_image.jpg','5e594eb824f90');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sistem85_OIS'
--

--
-- Dumping routines for database 'sistem85_OIS'
--
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-07 22:12:27
