-- Base de Datos: gustov
DROP DATABASE IF EXISTS `restaurante_gustov`;

CREATE DATABASE `restaurante_gustov`;
USE restaurante_gustov;

-- Tabla "personas"

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `Ci` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Sexo` enum('Hombre','Mujer') DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL,
  `fechaRegisto` datetime DEFAULT NULL,
  `estadoinicio` enum('Off','On') NOT NULL,
  `FechaInicio` date DEFAULT NULL,
  `diasvacacionales` int DEFAULT NULL,
  `estadovacaciones` enum('Vacaciones','Trabajo') DEFAULT NULL,
  PRIMARY KEY (`idpersona`)
);

-- datos tabla `personas`

LOCK TABLES `personas` WRITE;
INSERT INTO `personas` VALUES (1,'Juan','Pérez González','12345678A','123456789','juan@example.com','Hombre','Calle Principal 123','Activo','2016-07-05 10:00:00','On','2016-07-05','20','Vacaciones'),
(2,'María','Gómez Rodríguez','98765432B','987654321','maria@example.com','Mujer','Avenida Central 456','Activo','2015-04-05 11:00:00','On','2015-04-05','20','Trabajo'),
(3,'Pedro','López Martínez','56789012C','567890123','pedro@example.com','Hombre','Plaza Mayor 789','Activo','2010-04-05 12:00:00','On','2010-04-05','30','Trabajo'),
(4,'Ana','Martínez González','34567890D','345678901','ana@example.com','Mujer','Calle Secundaria 321','Activo','2018-04-05 13:00:00','On','2018-04-05','15','Vacaciones'),
(5,'Luis','Fernández López','67890123E','678901234','luis@example.com','Hombre','Avenida Principal 987','Activo','2018-04-05 14:00:00','On','2018-04-05','15','Vacaciones'),
(6,'Marcela','Hernández Rodríguez','23456789F','234567890','marcela@example.com','Mujer','Calle del Sol 456','Activo','2023-07-05 15:00:00','On','2023-04-05','15','Vacaciones'),
(7,'Carlos','Gómez López','89012345G','890123456','carlos@example.com','Hombre','Avenida Central 789','Activo','2023-07-05 16:00:00','On','2023-04-05','15','Trabajo');
UNLOCK TABLES;

-- Tabla `vacaciones`

DROP TABLE IF EXISTS `vacaciones`;
CREATE TABLE `vacaciones` (
  `idvacaciones` int NOT NULL AUTO_INCREMENT,
  `idempleado` int DEFAULT NULL,
  `fechinicio` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL,
  `diasvacaciones` int DEFAULT NULL,
  `descripcion` text,
  `datecreate` date DEFAULT NULL,
  PRIMARY KEY (`idvacaciones`)
) ;

-- datos tabla `vacaciones`

LOCK TABLES `vacaciones` WRITE;
INSERT INTO `vacaciones` VALUES (1,1,'2023-07-05','2023-07-12',6,'Vacaciones','2023-07-05');
UNLOCK TABLES;