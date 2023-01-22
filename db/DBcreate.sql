CREATE DATABASE  IF NOT EXISTS `web-socialnetwork`;
USE `web-socialnetwork`;
-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: web-socialnetwork
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(45) NOT NULL,
  `testo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'generale','predefinito'),(2,'tecnologia','post relativi alla tecnologia'),(3,'auto & moto','post relativi al mondo automobilistico e sulle moto'),(4,'palestra','mondo del fitness');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commento`
--

DROP TABLE IF EXISTS `commento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `data_ora` varchar(30) NOT NULL,
  `testo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_commento` (`user_id`),
  KEY `post_id_commento` (`post_id`),
  CONSTRAINT `post_id_commento` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `user_id_commento` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commento`
--

LOCK TABLES `commento` WRITE;
/*!40000 ALTER TABLE `commento` DISABLE KEYS */;
/*!40000 ALTER TABLE `commento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follow` (
  `user_id` int NOT NULL,
  `user_follow` int NOT NULL,
  PRIMARY KEY (`user_id`,`user_follow`),
  KEY `user_id_seguito` (`user_follow`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_id_seguito` FOREIGN KEY (`user_follow`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow`
--

LOCK TABLES `follow` WRITE;
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
INSERT INTO `follow` VALUES (11,10),(10,11);
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempt`
--

DROP TABLE IF EXISTS `login_attempt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_attempt` (
  `user_id` int NOT NULL,
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`,`time`),
  CONSTRAINT `user_id_login` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempt`
--

LOCK TABLES `login_attempt` WRITE;
/*!40000 ALTER TABLE `login_attempt` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miPiace`
--

DROP TABLE IF EXISTS `miPiace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `miPiace` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_id_like` (`post_id`),
  CONSTRAINT `post_id_like` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `user_id_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miPiace`
--

LOCK TABLES `miPiace` WRITE;
/*!40000 ALTER TABLE `miPiace` DISABLE KEYS */;
/*!40000 ALTER TABLE `miPiace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_destinazione` int NOT NULL,
  `post` int DEFAULT NULL,
  `vista` int DEFAULT '0',
  `user_mittente` int DEFAULT NULL,
  `id_tipo_notifica` int NOT NULL,
  `data_ora` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_destinatario` (`user_destinazione`),
  KEY `user_mittente` (`user_mittente`),
  KEY `id_tipo_notifica_idx` (`id_tipo_notifica`),
  KEY `id_post_idx` (`post`),
  CONSTRAINT `id_post` FOREIGN KEY (`post`) REFERENCES `post` (`id`),
  CONSTRAINT `id_tipo_notifica` FOREIGN KEY (`id_tipo_notifica`) REFERENCES `tipo_notifica` (`id`),
  CONSTRAINT `user_destinatario` FOREIGN KEY (`user_destinazione`) REFERENCES `user` (`id`),
  CONSTRAINT `user_mittente` FOREIGN KEY (`user_mittente`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (36,11,NULL,0,10,4,'1674377246');
/*!40000 ALTER TABLE `notifica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_create` int NOT NULL,
  `data_ora` varchar(30) DEFAULT NULL,
  `testo` varchar(100) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `luogo` varchar(45) DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`id_user_create`),
  KEY `categoria` (`id_categoria`),
  CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `user` FOREIGN KEY (`id_user_create`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_notifica`
--

DROP TABLE IF EXISTS `tipo_notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_notifica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(45) NOT NULL,
  `descrizione` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_notifica`
--

LOCK TABLES `tipo_notifica` WRITE;
/*!40000 ALTER TABLE `tipo_notifica` DISABLE KEYS */;
INSERT INTO `tipo_notifica` VALUES (1,'commento','ha commentato il tuo post.'),(2,'like','ha messo mi piace al tuo post.'),(3,'post','ha caricato un nuovo post.'),(4,'follow','ha iniziato a seguirti.');
/*!40000 ALTER TABLE `tipo_notifica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `data_di_nascita` varchar(30) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `sesso` varchar(45) DEFAULT NULL,
  `foto_profilo` varchar(80) DEFAULT 'default_user_image.png',
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (10,'press','alex@test.com','f79c924eac6d8809b35792722ddb878e7f721e12d6ef3f6883370dd745ec84d9b1152678f3a35484acbf9ad40faf644e8aaf535db461c0615cd83bc73cc3d7c7','877d227f858d1e8faf49168b118270a6ac432d97cc3d5893ac019b0a5d9ca25ebc88139001b436bad862d1ecbbc0012a6730c6136567302ff8e637ff1a024061','2023-01-17','alex','presepi','undefined','default_user_image.png',NULL),(11,'luga','simo@test.com','087d90d9826a3763be7108cd075aa0bd2e1f90dd4b9798c00039236d3601f13e6a4d456d76221a34d8b51bf8c140b655397b7578d04f939d574ccede5323c6f5','f3b06a947ab2e92fdaffd0dd1eba45d34d575fff2d57dcb3af976f548f1887824caccccd681812f823380460500153805387b411fae2ca45c4c011b621ba4a4f','2023-01-18','simone','lugaresi','undefined','default_user_image.png',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-22  9:47:49
