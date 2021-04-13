-- Host: localhost    Database: franco_parqueadero
-- ------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE `vehiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clase_vehiculo` int NOT NULL,
  `pago` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehiculo`
--
LOCK TABLES `vehiculo` WRITE;
INSERT INTO `vehiculo` VALUES (1,1,'3'),(2,1,'3'),(3,0,'2');
UNLOCK TABLES;


--
-- Table structure for table `cliente`
--
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Dumping data for table `cliente`
--
LOCK TABLES `cliente` WRITE;
INSERT INTO `cliente` VALUES (1,'Kate','Pereira',8889900),(2,'Maria','manzana1',32132144),(3,'Jose','Cali',32323456),(4,'Carlos','guamal',4324567);
UNLOCK TABLES;


--
-- Table structure for table `ingresos`
--
DROP TABLE IF EXISTS `ingresos`;
CREATE TABLE `ingresos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_cliente` int NOT NULL,
  `fk_vehiculo` int NOT NULL,
  `entrada` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente` (`fk_cliente`),
  KEY `fk_vehiculo` (`fk_vehiculo`),
  CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingresos_ibfk_2` FOREIGN KEY (`fk_vehiculo`) REFERENCES `vehiculo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;