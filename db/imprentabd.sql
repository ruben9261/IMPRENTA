-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: imprentabd
-- ------------------------------------------------------
-- Server version	5.7.19-log

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(100) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `tipo_negocio` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipo_cliente` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizacion` (
  `IdCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrden` int(11) NOT NULL,
  PRIMARY KEY (`IdCotizacion`),
  KEY `fk_Cotizacion_Orden1_idx` (`IdOrden`),
  CONSTRAINT `fk_Cotizacion_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`IdOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacion`
--

LOCK TABLES `cotizacion` WRITE;
/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecotizacion`
--

DROP TABLE IF EXISTS `detallecotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallecotizacion` (
  `IdDetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `IdCotizacion` int(11) NOT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `DescProducto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleCotizacion`),
  KEY `fk_DetalleCotizacion_Cotizacion1_idx` (`IdCotizacion`),
  KEY `fk_DetalleCotizacion_Producto1_idx` (`IdProducto`),
  CONSTRAINT `fk_DetalleCotizacion_Cotizacion1` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`IdCotizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleCotizacion_Producto1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecotizacion`
--

LOCK TABLES `detallecotizacion` WRITE;
/*!40000 ALTER TABLE `detallecotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `Idempresa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadoreunion`
--

DROP TABLE IF EXISTS `estadoreunion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadoreunion` (
  `IdEstadoReunion` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdEstadoReunion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadoreunion`
--

LOCK TABLES `estadoreunion` WRITE;
/*!40000 ALTER TABLE `estadoreunion` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadoreunion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden`
--

DROP TABLE IF EXISTS `orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden` (
  `IdOrden` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `Idempresa` int(11) NOT NULL,
  PRIMARY KEY (`IdOrden`),
  KEY `fk_Orden_Empresa_idx` (`IdCliente`),
  KEY `fk_Orden_Empleado1_idx` (`IdEmpleado`),
  KEY `fk_Orden_Empresa1_idx` (`Idempresa`),
  CONSTRAINT `fk_Orden_Empleado1` FOREIGN KEY (`IdEmpleado`) REFERENCES `personas` (`IdPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orden_Empresa` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orden_Empresa1` FOREIGN KEY (`Idempresa`) REFERENCES `empresa` (`Idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden`
--

LOCK TABLES `orden` WRITE;
/*!40000 ALTER TABLE `orden` DISABLE KEYS */;
/*!40000 ALTER TABLE `orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `IdPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IdPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (3,'Will','48098909','empleado','987789837','av. arequipa','activo');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `IdProductos` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IdProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requerimiento`
--

DROP TABLE IF EXISTS `requerimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requerimiento` (
  `IdRequerimiento` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrden` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdRequerimiento`),
  KEY `fk_Requerimiento_Orden1_idx` (`IdOrden`),
  CONSTRAINT `fk_Requerimiento_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`IdOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requerimiento`
--

LOCK TABLES `requerimiento` WRITE;
/*!40000 ALTER TABLE `requerimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `requerimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reunion` (
  `IdReunion` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrden` int(11) NOT NULL,
  `IdReunionPadre` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `IdEstadoReunion` int(11) NOT NULL,
  PRIMARY KEY (`IdReunion`),
  KEY `fk_Reunion_Orden1_idx` (`IdOrden`),
  KEY `fk_Reunion_Reunion1_idx` (`IdReunionPadre`),
  KEY `fk_Reunion_EstadoReunion1_idx` (`IdEstadoReunion`),
  CONSTRAINT `fk_Reunion_EstadoReunion1` FOREIGN KEY (`IdEstadoReunion`) REFERENCES `estadoreunion` (`IdEstadoReunion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reunion_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`IdOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reunion_Reunion1` FOREIGN KEY (`IdReunionPadre`) REFERENCES `reunion` (`IdReunion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reunion`
--

LOCK TABLES `reunion` WRITE;
/*!40000 ALTER TABLE `reunion` DISABLE KEYS */;
/*!40000 ALTER TABLE `reunion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `NombreRol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (5,'Admin'),(6,'Empleado');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `IdPersona` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `NombreUsuario` varchar(45) DEFAULT NULL,
  `PasswordUsuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`),
  KEY `fk_Usuario_Empleado1_idx` (`IdPersona`),
  KEY `fk_Usuario_Rol1_idx` (`IdRol`),
  CONSTRAINT `fk_Usuario_Empleado1` FOREIGN KEY (`IdPersona`) REFERENCES `personas` (`IdPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,3,6,'admin','1234');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'imprentabd'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-31  0:31:07
