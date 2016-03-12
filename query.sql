create database prueba;
use prueba


-- table datos
CREATE TABLE `datos` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB
