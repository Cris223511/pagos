-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: pagos2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancos` (
  `idbanco` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (13,1,'asdasdsda','sdaasdasd','2023-10-25 11:18:44','activado',0),(14,17,'banco pedro','asdasdasd','2023-10-25 11:35:53','activado',0);
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locales`
--

DROP TABLE IF EXISTS `locales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locales` (
  `idlocal` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `local_ruc` varchar(15) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idlocal`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locales`
--

LOCK TABLES `locales` WRITE;
/*!40000 ALTER TABLE `locales` DISABLE KEYS */;
INSERT INTO `locales` VALUES (1,1,'Local de Chorrillos, Lima','48596631120','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado',0),(2,2,'Local de Los Olivos, Lima','44569002934','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado',0),(31,16,'local nuevo','12122123123','asdasdsda','2023-10-25 11:03:13','activado',0),(32,17,'local impresion total','12312311231','scassasdasdasd','2023-10-25 11:32:35','activado',0),(33,17,'pedro2','12321331223','dssdadsasddasd','2023-10-25 11:33:47','activado',0);
/*!40000 ALTER TABLE `locales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operaciones` (
  `idoperacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idoperacion`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
INSERT INTO `operaciones` VALUES (10,17,'operacion pedro','asdsdsddsa','2023-10-25 11:36:00','activado',0);
/*!40000 ALTER TABLE `operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,'Escritorio'),(2,'Acceso'),(3,'Perfil usuario'),(4,'Ticket'),(5,'Reporte Pagos'),(6,'Reporte Comisiones');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `idticket` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idbanco` int(11) NOT NULL,
  `idoperacion` int(11) NOT NULL,
  `idlocal` int(11) NOT NULL,
  `num_ticket` varchar(15) NOT NULL,
  `num_ope` varchar(10) NOT NULL,
  `tipo_letra` varchar(30) NOT NULL,
  `importe` decimal(11,2) NOT NULL,
  `comision` decimal(11,2) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`idticket`),
  KEY `idusuario` (`idusuario`),
  KEY `idbanco` (`idbanco`),
  KEY `idoperacion` (`idoperacion`),
  KEY `idlocal` (`idlocal`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idlocal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idlocal` (`idlocal`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Christopher PS','DNI','32434234','Lima, la molina','944853484','admin@admin.com','superadmin','admin','admin','1694997199.jpg',1,0),(2,2,'Luis Gomez','DNI','12345678','Lima la molina','944853484','admin2@admin.com','admin','admin2','admin2','1694993074.jpg',1,0),(15,31,'asasdasd','RUC','123123123','asd','12312313','cris_antonio2001@hotmail.com','vendedor_total','julio','julio','',1,1),(16,31,'julio','DNI','12312312','Lima','973182294','cris_antonio2001@hotmail.com','admin','julio','julio','',1,0),(17,33,'pedro','DNI','12323112','asdsadd','321233123','asdasd@asdasd.com','vendedor_total','pedro','pedro','',1,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_permiso`
--

DROP TABLE IF EXISTS `usuario_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  KEY `idusuario` (`idusuario`),
  KEY `idpermiso` (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_permiso`
--

LOCK TABLES `usuario_permiso` WRITE;
/*!40000 ALTER TABLE `usuario_permiso` DISABLE KEYS */;
INSERT INTO `usuario_permiso` VALUES (60,3,1),(61,3,2),(62,3,3),(63,3,4),(64,3,5),(65,3,6),(105,5,1),(106,5,3),(107,5,4),(108,5,5),(109,5,6),(110,4,1),(111,4,3),(112,4,4),(113,4,5),(114,4,6),(115,2,1),(116,2,2),(117,2,3),(118,2,4),(119,2,5),(120,2,6),(121,6,1),(122,6,3),(123,6,4),(124,6,5),(125,6,6),(126,7,1),(127,7,3),(128,7,4),(129,7,5),(130,7,6),(131,8,1),(132,8,3),(133,8,4),(134,8,5),(135,8,6),(136,9,1),(137,9,3),(138,9,4),(139,9,5),(140,9,6),(141,10,1),(142,10,2),(143,10,3),(144,10,4),(145,10,5),(146,10,6),(147,11,1),(148,11,2),(149,11,3),(150,11,4),(151,11,5),(152,11,6),(153,12,1),(154,12,2),(155,12,3),(156,12,4),(157,12,5),(158,12,6),(159,13,1),(160,13,2),(161,13,3),(162,13,4),(163,13,5),(164,13,6),(165,14,1),(166,14,2),(167,1,1),(168,1,2),(169,1,3),(170,1,4),(171,1,5),(172,1,6),(179,15,1),(180,15,2),(181,15,3),(182,15,4),(183,15,5),(184,15,6),(185,16,1),(186,16,2),(187,16,3),(188,16,4),(189,16,5),(190,16,6),(191,17,1),(192,17,2),(193,17,3),(194,17,4),(195,17,5),(196,17,6);
/*!40000 ALTER TABLE `usuario_permiso` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-26 15:43:40
