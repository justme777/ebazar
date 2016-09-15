-- MySQL dump 10.10
--
-- Host: localhost    Database: db_ebazar
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--


/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
LOCK TABLES `addresses` WRITE;
INSERT INTO `addresses` VALUES (2,'test',1),(3,'test',1),(4,'test',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;

--
-- Table structure for table `market_types`
--

DROP TABLE IF EXISTS `market_types`;
CREATE TABLE `market_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market_types`
--


/*!40000 ALTER TABLE `market_types` DISABLE KEYS */;
LOCK TABLES `market_types` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `market_types` ENABLE KEYS */;

--
-- Table structure for table `markets`
--

DROP TABLE IF EXISTS `markets`;
CREATE TABLE `markets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markets`
--


/*!40000 ALTER TABLE `markets` DISABLE KEYS */;
LOCK TABLES `markets` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `markets` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

