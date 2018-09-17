-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: imprentadb2
-- ------------------------------------------------------
-- Server version	8.0.11

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
INSERT INTO `cliente` VALUES (1,'cliente1','2132143','servicios','av. arequipa','987789878','tipico');
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
  `Codcotizacion` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(50) DEFAULT NULL,
  `FechaCotizacion` datetime DEFAULT NULL,
  `ImporteTotal` decimal(10,4) DEFAULT NULL,
  `Igv` decimal(10,4) DEFAULT NULL,
  `IdEstado` int(11) DEFAULT NULL,
  `Importe` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`IdCotizacion`),
  KEY `fk_Cotizacion_Orden1_idx` (`IdOrden`),
  KEY `fk_Cotizacion_Estado_idx` (`IdEstado`),
  CONSTRAINT `fk_Cotizacion_Estado` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`idestado`),
  CONSTRAINT `fk_Cotizacion_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`idorden`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacion`
--

LOCK TABLES `cotizacion` WRITE;
/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
INSERT INTO `cotizacion` VALUES (12,4,'prueba codcotizacion','12321','0000-00-00 00:00:00',21.2400,3.2400,3,18.0000),(13,5,'213213','21312321','0000-00-00 00:00:00',16.5200,2.5200,2,14.0000),(14,3,'12321321','123213','0000-00-00 00:00:00',40.1200,6.1200,2,34.0000),(15,16,'sadadsa','sadsadasd','0000-00-00 00:00:00',16.5200,2.5200,3,14.0000);
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
  `cantidad` decimal(10,4) DEFAULT NULL,
  `preciounitario` decimal(10,4) DEFAULT NULL,
  `total` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleCotizacion`),
  KEY `fk_DetalleCotizacion_Cotizacion1_idx` (`IdCotizacion`),
  KEY `fk_DetalleCotizacion_Producto1_idx` (`IdProducto`),
  CONSTRAINT `fk_DetalleCotizacion_Cotizacion1` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  CONSTRAINT `fk_DetalleCotizacion_Producto1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`idproductos`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecotizacion`
--

LOCK TABLES `detallecotizacion` WRITE;
/*!40000 ALTER TABLE `detallecotizacion` DISABLE KEYS */;
INSERT INTO `detallecotizacion` VALUES (22,13,NULL,'21321',2.0000,3.0000,6.0000),(23,13,NULL,'12321',4.0000,2.0000,8.0000),(24,12,NULL,'213',2.0000,3.0000,6.0000),(25,12,NULL,'23213',3.0000,4.0000,12.0000),(31,15,NULL,'21321',3.0000,2.0000,6.0000),(32,15,NULL,'sadsadsa',4.0000,2.0000,8.0000),(37,14,NULL,'212321',2.0000,3.0000,6.0000),(38,14,NULL,'123213',4.0000,2.0000,8.0000),(39,14,NULL,'dsfdsfsf',4.0000,5.0000,20.0000);
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
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `IdEstado` int(11) NOT NULL AUTO_INCREMENT,
  `EstadoDescripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Pendiente'),(2,'Concretado'),(3,'Cancelado');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
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
  `FechaRegistro` datetime DEFAULT NULL,
  `DescripcionOrden` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdOrden`),
  KEY `fk_Orden_Empresa_idx` (`IdCliente`),
  KEY `fk_Orden_Empleado1_idx` (`IdEmpleado`),
  CONSTRAINT `fk_Orden_Empleado1` FOREIGN KEY (`IdEmpleado`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `fk_Orden_Empresa` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden`
--

LOCK TABLES `orden` WRITE;
/*!40000 ALTER TABLE `orden` DISABLE KEYS */;
INSERT INTO `orden` VALUES (3,1,15,0,'1970-01-01 00:00:00','Primera Orden Modificada'),(4,1,15,0,'1970-01-01 00:00:00','Segunda Orden'),(5,1,15,0,'1970-01-01 00:00:00','Tercera Orden'),(12,1,12,0,'1970-01-01 00:00:00','Quinta Orden'),(13,1,12,0,'1970-01-01 00:00:00','Quinta Orden'),(14,1,12,0,'1970-01-01 00:00:00','Orden de Prueba 2'),(15,1,12,0,'2018-05-09 00:00:00','Orden Javichin'),(16,1,12,0,'2018-12-09 00:00:00','Orden Javichin Dos');
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
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IdPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (3,'Will','48098909','empleado','987789837','av. arequipa','activo'),(4,'Pedro','33333333','Empleado','333333333333','3333333333333','activo'),(5,'Pedro','33333333','Empleado','333333333333','3333333333333','activo'),(6,'33333','333333','333333','333333333','333333333333','activo'),(7,'33333333','333333333','333333333','33333333','3333333','activo'),(8,'33333333','333333333','333333333','33333333','3333333','activo'),(9,'33333333','333333333','333333333','33333333','3333333','activo'),(16,'33333333','33333333','33333333','33333333','33333333','activo'),(19,'555555','555555','555555','555555','555555','activo'),(20,'555555','555555','555555','555555','555555','activo');
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
  CONSTRAINT `fk_Requerimiento_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`idorden`)
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
  `IdReunionPadre` int(11) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `IdEstado` int(11) NOT NULL,
  `NroReunion` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdReunion`),
  KEY `fk_Reunion_Orden1_idx` (`IdOrden`),
  KEY `fk_Reunion_Reunion1_idx` (`IdReunionPadre`),
  KEY `fk_Reunion_Estado1_idx` (`IdEstado`),
  CONSTRAINT `fk_Reunion_Estado1` FOREIGN KEY (`IdEstado`) REFERENCES `estado` (`idestado`),
  CONSTRAINT `fk_Reunion_Orden1` FOREIGN KEY (`IdOrden`) REFERENCES `orden` (`idorden`),
  CONSTRAINT `fk_Reunion_Reunion1` FOREIGN KEY (`IdReunionPadre`) REFERENCES `reunion` (`idreunion`)
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
  CONSTRAINT `fk_Usuario_Empleado1` FOREIGN KEY (`IdPersona`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,3,6,'admin','1234'),(12,16,5,'33333333','33333333'),(15,19,5,'555555','555555'),(16,20,5,'555555','555555');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-16 22:14:33
