-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: morningHelper
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

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

--
-- Table structure for table `testuser`
--
use morningHelper;
DROP TABLE IF EXISTS `testuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testuser`
--

LOCK TABLES `testuser` WRITE;
/*!40000 ALTER TABLE `testuser` DISABLE KEYS */;
INSERT INTO `testuser` VALUES (1,'d0kun3t@gmail.com','P@ssw0rd');
/*!40000 ALTER TABLE `testuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usermodel`
--

DROP TABLE IF EXISTS `usermodel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usermodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(9) NOT NULL,
  `time` time NOT NULL,
  `start` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usermodel`
--

LOCK TABLES `usermodel` WRITE;
/*!40000 ALTER TABLE `usermodel` DISABLE KEYS */;
INSERT INTO `usermodel` VALUES (1,'Monday','00:00:00','test','Dorenbach',1),(2,'Tuesday','10:00:00','Therwil, Zentrum','Muttenz, Kriegacker',1),(3,'Wednesday','07:15:00','Therwil, Zentrum','Muttenz, Kriegacker',1),(4,'Thursday','09:00:00','Therwil, Zentrum','Basel, Münchensteinerstrasse',1),(5,'Friday','09:00:00','Therwil, Zentrum','Basel, Münchensteinerstrasse',1),(85,'Monday','00:00:00','Ettingen, Dorf','Dorenbach',3),(86,'Tuesday','00:00:00','Oberwil, Zentrum','Muttenz, Dorf',3),(87,'Wednesday','00:00:00','Therwil, Zentrum','Heuwaage',3),(88,'Thursday','00:00:00','Rodersdorf','Dornach',3),(89,'Friday','00:00:00','Oberwil, Zentrum','Dornach',3),(90,'Saturday','00:00:00','Therwil, Zentrum','Basel SBB',3),(91,'Sunday','00:00:00','Muttenz, Dorf','Pratteln, Lachmatt',3),(92,'Monday','00:00:00','Ettingen, Dorf','Dorenbach',4),(93,'Tuesday','00:00:00','Oberwil, Zentrum','Muttenz, Dorf',4),(94,'Wednesday','00:00:00','Therwil, Zentrum','Heuwaage',4),(95,'Thursday','00:00:00','Rodersdorf','Dornach',4),(96,'Friday','00:00:00','Oberwil, Zentrum','Dornach',4),(97,'Saturday','00:00:00','','',4),(98,'Sunday','00:00:00','','',4);
/*!40000 ALTER TABLE `usermodel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Dominik','Luder','d0kun3t@gmail.com','Dokunet','$2y$10$2i69p5i3djznmt6Qdj9a/.wIr2qH58tLb262tzuDWbDhZAkGW.ijW'),(3,'Max','Mustermann','Max@Mustermann.ch','MaxMustermann','$2y$10$3ByC.XZbjFVkwP40F6Vh0eG54VWJXgTWnRSejE3/NUXkD0Whxiq26'),(4,'Dominik','Luder','tes@mail.com','TestUser','$2y$10$TMkPaeDyC8.8EmbOo9LwheAqCairUWIAbEp0IYnwcYyghgYh6rixu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-30 16:40:12
