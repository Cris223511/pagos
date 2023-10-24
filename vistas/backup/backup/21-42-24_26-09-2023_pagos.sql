-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: pagos
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
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,1,'banco Interbank','Banco de confianza','2023-09-18 15:53:58','activado'),(2,1,'banco de crédito BCP','Banco de confianza','2023-09-18 15:54:43','activado');
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
  PRIMARY KEY (`idlocal`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locales`
--

LOCK TABLES `locales` WRITE;
/*!40000 ALTER TABLE `locales` DISABLE KEYS */;
INSERT INTO `locales` VALUES (1,1,'Local de Chorrillos, Lima','48596631120','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado'),(2,2,'Local de Los Olivos, Lima','44569002934','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado'),(3,3,'Local de Ate Vitarte, Lima','04122934501','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado'),(4,4,'Local de Comas, Lima','49577549913','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado'),(6,5,'Local de Ventanilla, Lima','44448564548','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-18 15:56:56','activado'),(8,2,'Local de Ate Vitarte, Lima','34234234234','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-25 10:48:54','activado'),(9,0,'Local de Cieneguilla, Lima','23432432424','un local donde se almacenará productos, listo para ser comercializados en el mercado.','2023-09-25 23:56:09','activado');
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
  PRIMARY KEY (`idoperacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
INSERT INTO `operaciones` VALUES (1,1,'Transferencia','Se hace la transferencia que hará llegada al cliente.','2023-09-18 17:11:49','activado'),(2,1,'Préstamo','Se hace el préstamo que es de parte del cliente.','2023-09-18 17:11:49','activado'),(3,1,'Pago','Se hace el pago que es de parte del cliente.','2023-09-18 17:11:49','activado'),(5,1,'AAAAAA','AAAAAAAA','2023-09-25 11:03:07','activado');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,1,1,1,1,'1800583952','0008454903','courier',78.60,45.60,'Titular: PEREZ CHAPULIN LUIS ALEXANDER\r\nFecha y hora: 16/06/2023 12:05\r\nNúmero de operación: 00052462\r\nCuenta de origen: Ahorro Soles 220-99851954-0-59\r\nNombre del beneficiario: MEDINA MARIA YANETH\r\nDocumento del beneficiario: DNI, 47012219\r\nMonto a pagar al beneficiario: S/ 100.00\r\nComisión orden de pago: S/ 5.00\r\nMonto total: S/ 105.00','2023-09-25 12:18:39','activado');
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
  `ruc_local` varchar(11) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idlocal` (`idlocal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Christopher PS','DNI','32434234','Lima, la molina','944853484','admin@admin.com','10028457238','superadmin','admin','admin','1694997199.jpg',1),(2,2,'Luis Gomez','DNI','12345678','Lima la molina','944853484','admin2@admin.com','44485502846','admin','admin2','admin2','1694993074.jpg',1),(3,3,'Rodrigo Campos','RUC','55603297664','Lima la molina','944853484','email1@email.com','42349357921','admin_view','admin3','admin3','1694993155.jpg',1),(4,4,'Javier Poma','RUC','68439948231','Lima la molina','944853484','email2@email.com','10455343453','vendedor_impresion','javier','javier','1694993101.jpg',1),(5,6,'Miguel Lopez','DNI','23423423','Lima la molina','123123123','asdasd@asdasd.com','12312312312','vendedor_total','miguel','miguel','1694993101.jpg',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_permiso`
--

LOCK TABLES `usuario_permiso` WRITE;
/*!40000 ALTER TABLE `usuario_permiso` DISABLE KEYS */;
INSERT INTO `usuario_permiso` VALUES (48,1,1),(49,1,2),(50,1,3),(51,1,4),(52,1,5),(53,1,6),(60,3,1),(61,3,2),(62,3,3),(63,3,4),(64,3,5),(65,3,6),(105,5,1),(106,5,3),(107,5,4),(108,5,5),(109,5,6),(110,4,1),(111,4,3),(112,4,4),(113,4,5),(114,4,6),(115,2,1),(116,2,2),(117,2,3),(118,2,4),(119,2,5),(120,2,6);
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

-- Dump completed on 2023-09-26 21:42:24
