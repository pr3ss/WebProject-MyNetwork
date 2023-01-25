CREATE DATABASE  IF NOT EXISTS `web-socialnetwork`;
USE `web-socialnetwork`;
-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: web-socialnetwork
-- ------------------------------------------------------
-- Server version	8.0.32-0buntu0.20.04.1

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Generale'),(2,'Tecnologia'),(3,'Auto e moto'),(4,'Palestra'),(5,'Viaggi'),(6,'Design'),(7,'Fotografia'),(8,'Scienza'),(9,'Cibo');
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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commento`
--

LOCK TABLES `commento` WRITE;
/*!40000 ALTER TABLE `commento` DISABLE KEYS */;
INSERT INTO `commento` VALUES (71,12141,120,'1674688471','Sembra buono'),(72,12140,120,'1674689285','ummm'),(73,12140,134,'1674689698','da me no'),(74,12140,122,'1674689800','quanta gente'),(75,12145,122,'1674689814','bello il mare'),(76,12145,122,'1674689827','con chi sei');
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
INSERT INTO `follow` VALUES (12141,12140),(12142,12140),(12140,12141),(12142,12141),(12140,12142),(12141,12142),(12145,12142),(12140,12143),(12142,12143),(12140,12144),(12141,12144),(12142,12144),(12140,12145),(12142,12145);
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
INSERT INTO `login_attempt` VALUES (12140,'1674687583');
/*!40000 ALTER TABLE `login_attempt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mi_piace`
--

DROP TABLE IF EXISTS `mi_piace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mi_piace` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_id_like` (`post_id`),
  CONSTRAINT `post_id_like` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `user_id_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mi_piace`
--

LOCK TABLES `mi_piace` WRITE;
/*!40000 ALTER TABLE `mi_piace` DISABLE KEYS */;
INSERT INTO `mi_piace` VALUES (12140,120),(12141,120),(12145,120),(12141,122),(12145,122),(12141,124),(12141,127),(12140,132),(12140,133);
/*!40000 ALTER TABLE `mi_piace` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (88,12141,NULL,0,12142,4,'1674687520'),(89,12140,NULL,1,12142,4,'1674687529'),(90,12144,NULL,0,12142,4,'1674687533'),(91,12143,NULL,0,12142,4,'1674687538'),(92,12145,NULL,0,12142,4,'1674687543'),(93,12142,NULL,0,12140,4,'1674687610'),(94,12144,NULL,0,12140,4,'1674687624'),(95,12143,NULL,0,12140,4,'1674687629'),(96,12141,NULL,1,12140,4,'1674687635'),(97,12145,NULL,0,12140,4,'1674687645'),(101,12140,119,0,12142,3,'1674688090'),(102,12140,120,0,12142,3,'1674688143'),(104,12140,122,0,12142,3,'1674688362'),(105,12142,NULL,0,12141,4,'1674688454'),(106,12142,122,0,12141,2,'1674688460'),(107,12142,120,0,12141,2,'1674688463'),(108,12142,120,0,12141,1,'1674688471'),(109,12140,123,0,12141,3,'1674688560'),(110,12142,123,0,12141,3,'1674688560'),(111,12140,124,0,12141,3,'1674688576'),(112,12142,124,0,12141,3,'1674688576'),(113,12140,125,0,12141,3,'1674688609'),(114,12142,125,0,12141,3,'1674688609'),(115,12140,126,0,12141,3,'1674688656'),(116,12142,126,0,12141,3,'1674688656'),(117,12140,127,0,12141,3,'1674688696'),(118,12142,127,0,12141,3,'1674688696'),(119,12140,NULL,0,12141,4,'1674688721'),(120,12144,NULL,0,12141,4,'1674688743'),(127,12140,130,0,12144,3,'1674688889'),(128,12141,130,0,12144,3,'1674688889'),(129,12142,130,0,12144,3,'1674688889'),(130,12140,131,0,12144,3,'1674688903'),(131,12141,131,0,12144,3,'1674688903'),(132,12142,131,0,12144,3,'1674688903'),(133,12140,132,0,12144,3,'1674689163'),(134,12141,132,0,12144,3,'1674689163'),(135,12142,132,0,12144,3,'1674689163'),(136,12144,132,0,12140,2,'1674689272'),(137,12142,120,0,12140,1,'1674689285'),(138,12140,133,0,12145,3,'1674689345'),(139,12142,133,0,12145,3,'1674689345'),(140,12140,134,0,12145,3,'1674689573'),(141,12142,134,0,12145,3,'1674689573'),(142,12141,135,0,12140,3,'1674689619'),(143,12142,135,0,12140,3,'1674689619'),(144,12145,133,0,12140,2,'1674689690'),(145,12145,134,0,12140,1,'1674689698'),(146,12142,NULL,0,12145,4,'1674689761'),(147,12142,120,0,12145,2,'1674689772'),(148,12142,122,0,12145,2,'1674689773'),(149,12142,120,0,12140,2,'1674689790'),(150,12142,122,0,12140,1,'1674689800'),(151,12142,122,0,12145,1,'1674689814'),(152,12142,122,0,12145,1,'1674689827'),(153,12140,136,0,12142,3,'1674689940'),(154,12141,136,0,12142,3,'1674689940'),(155,12145,136,0,12142,3,'1674689940'),(156,12140,137,0,12141,3,'1674690023'),(157,12142,137,0,12141,3,'1674690023');
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
  `testo` varchar(100) DEFAULT '""',
  `img` varchar(45) DEFAULT NULL,
  `luogo` varchar(45) DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`id_user_create`),
  KEY `categoria` (`id_categoria`),
  CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `user` FOREIGN KEY (`id_user_create`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (119,12142,'1674688090','Primo post su questo social !!.',NULL,NULL,1),(120,12142,'1674688143','La mia cena.','12142_120.jpeg','Il colle',9),(122,12142,'1674688362','Esperienza meravigliosa','12142_122.jpg','elba',5),(123,12141,'1674688560','Rilassante','12141_123.png','Lago giulio',5),(124,12141,'1674688576','Oggi sono felice',NULL,NULL,1),(125,12141,'1674688609','','12141_125.png',NULL,3),(126,12141,'1674688656','Bestiaa','12141_126.png',NULL,3),(127,12141,'1674688696','','12141_127.png',NULL,6),(130,12144,'1674688889','','12144_130.png',NULL,5),(131,12144,'1674688903','Mi piace mangiare',NULL,NULL,1),(132,12144,'1674689163','','12144_132.png','Il castello',9),(133,12145,'1674689345','Bello il mare','12145_133.png',NULL,5),(134,12145,'1674689573','Tempo brutto oggi',NULL,'Cesena',1),(135,12140,'1674689619','','12140_135.png','Universo',8),(136,12142,'1674689940','','12142_136.jpg',NULL,6),(137,12141,'1674690023','','12141_137.jpg','NewYork',7);
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
  `foto_profilo` varchar(80) DEFAULT 'default_user_image.png',
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12146 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12140,'tester','default@test.com','f962d0be7edb9d0aed2894aa840ed1236e65c748df516732cae3bc7d8c069fd76a6694b721bc904b5d8f544c14e2e1fd8f1e8343904bbdd67390d752c77af1c8','5e013930c8b00dcd8231cc485219ce0319388dde1ade33fe2196b2a11054829203d07786864e4242f01ad0e1670cb04ea0a9ec5eeef198cc5a17de7aba678b23','2023-01-02','default','test','12140_1674687737foto_profilo.png','Sono il profilo di test.'),(12141,'SimoLuga','simone@gmail.com','c5d7a682cd0db179d6a0cbd0df4b56506681cff6b02dffc892d85d3c6f243e2c2df13169463d628b497a51df03669bf4e36f9533d0dc02551bc115a81a1148ae','c619de76ff39addbde52dcf02d26d1358acb92357c69f6bd070c812b03a53074b4bc26a32b4820f00ec23cbddfec449f4a8a5a945725736658c707c162c70812','2023-01-05','simone','lugaresi','12141_1674688442foto_profilo.png','Sono uno studente'),(12142,'ale','alex@gmail.com','4cba09a0a80ea10d72adf2f0e41e2380f1085393da5b27c5aa591508b4971f8d4fb9c215241c61dca696895a17afed8d8c5167e3e60fa0fcc973d61d327ad594','7036708fccbc35dd487e5cb98197e16941ed136f272e5ac7b5cea4a470df642a874b2a330a5bf3bb93b565725b89a8368fc41af91d97ba02c8082cd9fa135bd6','2023-01-13','alex','presepi','12142_1674689970foto_profilo.png',NULL),(12143,'prof','prof@gmail.com','6175a6d27af71034f473f26bbce95c5b0e2eea49afe9637bc451db84aeb7223f811f928c6e16e68282e873e47d1d417ac68c324d1db84afefcdccf3eb771f2e2','7a0ffe432299d3c25d9865efbd9e07295dff29c0627635b1dead4604afc179db23a7d9e6056717854b3be1c313e4560177d220c104cc0731140113249ab9cb43','2023-01-12','professore','prof','default_user_image.png',NULL),(12144,'ciccio','gianni@gmail.com','13581b8ae9b8f8c3ded5d3c2c7855b886f1a963322995a5d5cd13fe55aecb2295baa1beb74e1dd2a3ed5e962c29fba76636747fe6acc713a243e511740f26cf6','7e97a7be1a0a58a1ce94e39fedf4063ace13dce258ba0a3c715e845bf2ae882c05cd3f87faf8f111e58f9ce8b1ea4dfe317ad35aac3afc083b4c9a49247abcab','2023-01-11','gianni','rossi','default_user_image.png',NULL),(12145,'luk','luca@libero.it','012374b7ae88de4722750bca89a922a9be9d40b74dd5024b063ab0e700e1b484ad107dd1222b5529ff3654d564b5b800099054f06a0bcaeef28ae5eac16fe525','e4252a3b4372a7000fd9496afbc4ed06cc2f4b623cea783807754f977062713f2840a15974b8a11fcb90f581f7d67c238ff10ad31592ab83e147639b5ff5ed44','2023-01-17','luca','verdi','default_user_image.png',NULL);
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

-- Dump completed on 2023-01-26  0:41:52
