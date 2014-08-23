-- MySQL dump 10.13  Distrib 5.6.16, for osx10.8 (x86_64)
--
-- Host: localhost    Database: dz_db
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `title` text,
  `body` text,
  `summary` text,
  `language` varchar(45) DEFAULT 'zh',
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `weight` int(11) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=20036 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (35,'gallery item',NULL,NULL,'zh','2014-07-02 01:12:09','2014-07-02 01:12:09',NULL,1,'lookbook',0),(10000,'corporate EN','corporate EN',NULL,'en','2014-07-12 09:04:25','2014-07-12 09:04:25',NULL,1,'none',0),(10001,'Corporate CN','Corporate CN',NULL,'cn','2014-07-12 09:03:50','2014-07-12 09:04:05',NULL,1,'none',0),(10002,'QRcode information','',NULL,'en','2014-07-13 15:43:43','2014-07-13 15:43:44',NULL,1,'qrcode',0),(10003,'QRcode information','',NULL,'cn','2014-07-18 01:24:02','2014-07-18 01:24:02',NULL,1,'qrcode',0),(10004,'HELDO','dz_db.sql','dz_db.sql','en','2014-07-13 20:33:38','2014-07-20 08:27:49','',1,'contact',0),(10005,'dz_db.sql','dz_db.sql','Hello World','cn','2014-07-13 20:33:46','2014-07-19 11:05:17','',1,'contact',0),(10007,'brand service','brand service',NULL,'cn','2014-07-17 05:44:59','2014-07-17 05:44:59',NULL,1,'brand',0),(10011,'Dzzit','Dzzit',NULL,'cn','2014-07-17 06:00:55','2014-07-17 06:00:55',NULL,1,'brand',0),(10012,'Brand Information',NULL,NULL,'en','2014-07-20 09:51:23','2014-07-20 09:51:23',NULL,1,'brand_information',0),(10013,'Title Title','Body Body Title Title',NULL,'cn','2014-07-17 07:27:50','2014-07-17 07:39:36',NULL,1,'brand_information',0),(10016,'video sample 2','','','en','2014-07-13 11:43:09','2014-07-20 08:01:10','',1,'videocontent',0),(19996,'Contact Tel','Contact','','en','2014-07-13 17:35:18','2014-07-13 17:40:45','',1,'contact',0),(19998,'Contact','',NULL,'en','2014-07-13 17:31:12','2014-07-13 17:31:12',NULL,1,'contact',0),(19999,'News','News','','en','2014-07-13 18:56:36','2014-07-13 20:31:19','',1,'news',0),(20000,'News with category','News with category',NULL,'en','2014-07-13 19:22:46','2014-07-13 19:22:46',NULL,1,'news',0),(20001,'Job','Job Career','','cn','2014-07-16 02:11:52','2014-07-16 02:33:31','',1,'job',0),(20027,'Helo New Job',NULL,NULL,'cn','2014-07-19 12:43:02','2014-07-19 12:43:02',NULL,1,'job',0),(20028,'gallery item',NULL,NULL,'en','2014-07-19 14:00:53','2014-07-19 14:00:53',NULL,1,'arrival',0),(20033,'News','','','en','2014-07-20 07:26:21','2014-07-20 07:44:54','',1,'news',0),(20034,'视频',NULL,NULL,'en','2014-07-20 09:46:28','2014-07-20 09:46:28',NULL,1,'videocontent',0),(20035,'Career',NULL,NULL,'en','2014-07-20 09:51:55','2014-07-20 09:51:55',NULL,1,'job',0);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field` (
  `fid` int(10) NOT NULL AUTO_INCREMENT,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `field_name` varchar(45) DEFAULT NULL,
  `field_content` text,
  `cid` int(10) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (8,'2014-07-02 00:17:22','2014-07-02 00:17:22','brand','diamond',23),(9,'2014-07-02 00:31:49','2014-07-02 00:31:49','brand','diamond',24),(10,'2014-07-02 00:32:32','2014-07-02 00:32:32','brand','diamond',25),(11,'2014-07-02 00:50:35','2014-07-02 00:50:35','brand','diamond',26),(12,'2014-07-02 00:50:43','2014-07-02 00:50:43','brand','diamond',27),(13,'2014-07-02 00:57:43','2014-07-02 00:57:43','brand','diamond',28),(14,'2014-07-02 00:58:38','2014-07-02 00:58:38','brand','diamond',29),(15,'2014-07-02 00:58:59','2014-07-02 00:58:59','brand','diamond',30),(16,'2014-07-02 00:59:33','2014-07-02 00:59:33','brand','diamond',31),(17,'2014-07-02 00:59:43','2014-07-02 00:59:43','brand','diamond',32),(18,'2014-07-02 00:59:56','2014-07-02 00:59:56','brand','diamond',33),(19,'2014-07-02 01:11:54','2014-07-02 01:11:54','brand','dazze',34),(20,'2014-07-02 01:12:09','2014-07-02 01:12:09','brand','dzzit',35),(21,'2014-07-13 19:22:46','2014-07-13 19:22:46','category','diamond',20000),(22,'2014-07-13 20:31:19','2014-07-13 20:31:19','category','dzzit',19999),(23,'2014-07-17 04:16:14','2014-07-17 04:16:14','brand','Dazze',20002),(24,'2014-07-17 04:16:20','2014-07-17 04:16:20','brand','Dazze',20003),(25,'2014-07-17 04:16:38','2014-07-17 04:16:38','brand','Dazze',20004),(26,'2014-07-17 04:16:47','2014-07-17 04:16:47','brand','Dazze',20005),(27,'2014-07-17 04:16:48','2014-07-17 04:16:48','brand','Dazze',20006),(28,'2014-07-17 04:16:48','2014-07-17 04:16:48','brand','Dazze',20007),(29,'2014-07-17 04:16:49','2014-07-17 04:16:49','brand','Dazze',20008),(30,'2014-07-17 04:16:49','2014-07-17 04:16:49','brand','Dazze',20009),(31,'2014-07-17 04:16:49','2014-07-17 04:16:49','brand','Dazze',20010),(32,'2014-07-17 04:16:49','2014-07-17 04:16:49','brand','Dazze',20011),(33,'2014-07-17 04:16:49','2014-07-17 04:16:49','brand','Dazze',20012),(34,'2014-07-17 21:28:04','2014-07-17 21:28:04','brand','dazze',20019),(35,'2014-07-17 21:28:30','2014-07-17 21:28:30','brand','dazze',20020),(36,'2014-07-17 21:28:58','2014-07-17 21:28:58','brand','dazze',20021),(37,'2014-07-17 21:29:38','2014-07-17 21:29:38','brand','dazze',20022),(38,'2014-07-17 21:29:52','2014-07-17 21:29:52','brand','dazze',20023),(39,'2014-07-17 21:33:36','2014-07-17 21:33:36','brand','dazze',20024),(40,'2014-07-17 21:33:59','2014-07-17 21:33:59','brand','dazze',20025),(41,'2014-07-17 21:35:50','2014-07-17 21:35:50','brand','dazze',20026),(42,'2014-07-19 14:00:53','2014-07-19 14:00:53','brand','dazze',20028),(43,'2014-07-19 15:41:27','2014-07-19 15:41:27','brand','diamond',20029),(44,'2014-07-19 15:54:19','2014-07-19 15:54:19','brand','dazze',20030),(45,'2014-07-19 16:12:57','2014-07-19 16:12:57','brand','diamond',20031),(46,'2014-07-20 07:08:38','2014-07-20 07:08:38','brand','dazze',20032),(47,'2014-07-20 07:26:21','2014-07-20 07:44:54','category','diamond dazzle',20033),(48,'2014-07-20 07:59:25','2014-07-20 08:01:10','category','diamond dazzle',10016),(49,'2014-07-20 09:46:28','2014-07-20 09:46:28','category','dazzle',20034);
/*!40000 ALTER TABLE `field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  `type` varchar(45) DEFAULT '',
  `cid` int(11) DEFAULT NULL,
  `field_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=585 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (510,'cec6ccf0c383d5a84ddaa3b852e84dcc','s:44:\"/upload/cec6ccf0c383d5a84ddaa3b852e84dcc.png\";','2014-07-02 00:17:22','2014-07-02 00:17:22','lookbook',23,'image'),(511,'d26e9fbace95e41686d12de09d5f178e','s:44:\"/upload/d26e9fbace95e41686d12de09d5f178e.png\";','2014-07-02 00:31:49','2014-07-02 00:31:49','lookbook',24,'image'),(512,'da26f8ae0c4f99f54ac57861ece6653c','s:44:\"/upload/da26f8ae0c4f99f54ac57861ece6653c.png\";','2014-07-02 00:32:32','2014-07-02 00:32:32','lookbook',25,'image'),(513,'22abe094dcd61fac3f22fa4405dcd358','s:44:\"/upload/22abe094dcd61fac3f22fa4405dcd358.png\";','2014-07-02 00:50:35','2014-07-02 00:50:35','lookbook',26,'image'),(514,'164c62334fb6b7e20b775da72884b646','s:44:\"/upload/164c62334fb6b7e20b775da72884b646.png\";','2014-07-02 00:50:43','2014-07-02 00:50:43','lookbook',27,'image'),(515,'ba963b72fc07145e81f2775d21a86822','s:44:\"/upload/ba963b72fc07145e81f2775d21a86822.png\";','2014-07-02 00:57:43','2014-07-02 00:57:43','lookbook',28,'image'),(516,'3ebeaea16f303e7dd83a4acd9a6868da','s:44:\"/upload/3ebeaea16f303e7dd83a4acd9a6868da.png\";','2014-07-02 00:58:38','2014-07-02 00:58:38','lookbook',29,'image'),(517,'d6f92a433114b7d6b4d26f4515779712','s:44:\"/upload/d6f92a433114b7d6b4d26f4515779712.png\";','2014-07-02 00:58:59','2014-07-02 00:58:59','lookbook',30,'image'),(518,'a8c46a966576f7c877e291444bf2a013','s:44:\"/upload/a8c46a966576f7c877e291444bf2a013.png\";','2014-07-02 00:59:33','2014-07-02 00:59:33','lookbook',31,'image'),(519,'78cc3fcd9f3935ef97a66b1c9b2ebe8f','s:44:\"/upload/78cc3fcd9f3935ef97a66b1c9b2ebe8f.png\";','2014-07-02 00:59:43','2014-07-02 00:59:43','lookbook',32,'image'),(520,'93c6577f76f72e644a056aebac5f26b7','s:44:\"/upload/93c6577f76f72e644a056aebac5f26b7.png\";','2014-07-02 00:59:56','2014-07-02 00:59:56','lookbook',33,'image'),(521,'1d41c664e7c398d04a9e3d86bfc122a2','s:44:\"/upload/1d41c664e7c398d04a9e3d86bfc122a2.png\";','2014-07-02 01:11:54','2014-07-02 01:11:54','lookbook',34,'image'),(522,'5f457228a8a8d89d82c23bb860e0c4b3','s:44:\"/upload/5f457228a8a8d89d82c23bb860e0c4b3.png\";','2014-07-02 01:12:09','2014-07-02 01:12:09','lookbook',35,'image'),(523,'4e3015c7dd7baa3186dcfab20efecb1c','s:44:\"/upload/4e3015c7dd7baa3186dcfab20efecb1c.JPG\";','2014-07-12 00:25:11','2014-07-12 09:04:25','none',10000,'thumbnail'),(524,'218e3c4aa388fee3f2f420d3e8908004','s:44:\"/upload/218e3c4aa388fee3f2f420d3e8908004.JPG\";','2014-07-12 09:04:05','2014-07-12 09:04:05','none',10001,'thumbnail'),(527,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:29:11','2014-07-13 11:29:11','videocontent',10006,'thumbnail'),(528,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:29:57','2014-07-13 11:29:57','videocontent',10007,'thumbnail'),(529,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:30:54','2014-07-13 11:30:54','videocontent',10008,'thumbnail'),(530,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:31:36','2014-07-13 11:31:36','videocontent',10009,'thumbnail'),(531,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:32:32','2014-07-13 11:32:32','videocontent',10010,'thumbnail'),(532,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:32:58','2014-07-13 11:32:58','videocontent',10011,'thumbnail'),(533,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:34:03','2014-07-13 11:34:03','videocontent',10012,'thumbnail'),(534,'d188fb8129496ecaef84c7ca70f16f57','s:44:\"/upload/d188fb8129496ecaef84c7ca70f16f57.png\";','2014-07-13 11:40:40','2014-07-13 11:40:40','videocontent',10013,'thumbnail'),(535,'c3c2679e3bdabd697d5cb8c4b24faf30','s:44:\"/upload/c3c2679e3bdabd697d5cb8c4b24faf30.png\";','2014-07-13 11:41:03','2014-07-13 11:41:03','videocontent',10014,'thumbnail'),(536,'c3c2679e3bdabd697d5cb8c4b24faf30','s:44:\"/upload/c3c2679e3bdabd697d5cb8c4b24faf30.png\";','2014-07-13 11:41:56','2014-07-13 11:41:56','videocontent',10015,'thumbnail'),(537,'790eecc43a57bb8ae6b65ef57938ffb7','s:44:\"/upload/790eecc43a57bb8ae6b65ef57938ffb7.jpg\";','2014-07-13 11:43:09','2014-07-20 08:01:10','videocontent',10016,'thumbnail'),(538,'af707c5b453dbbff2e462a5f96cc6644','s:44:\"/upload/af707c5b453dbbff2e462a5f96cc6644.png\";','2014-07-13 16:27:48','2014-07-13 16:28:31','qrcode',10002,'qrcode_dazze'),(539,'30902d1f2b02492944b088b9770b4dd3','s:44:\"/upload/30902d1f2b02492944b088b9770b4dd3.png\";','2014-07-13 16:27:48','2014-07-13 16:28:31','qrcode',10002,'qrcode_diamond'),(540,'0000f5b936447e478af976bf41a288b6','s:44:\"/upload/0000f5b936447e478af976bf41a288b6.png\";','2014-07-13 16:27:48','2014-07-13 16:28:31','qrcode',10002,'qrcode_dzzit'),(541,'6f6160139d706554bb37b954a19bad7e_345_258_png','s:52:\"/upload/6f6160139d706554bb37b954a19bad7e_345_258_png\";','2014-07-13 18:56:36','2014-07-13 20:31:19','news',19999,'thumbnail'),(542,'19dbd2d8e2331cf8aca8ce2807eb91fb','s:44:\"/upload/19dbd2d8e2331cf8aca8ce2807eb91fb.png\";','2014-07-13 19:22:46','2014-07-13 19:22:46','news',20000,'thumbnail'),(543,'0f74f2ae8695d862398796c6695a83e8','s:44:\"/upload/0f74f2ae8695d862398796c6695a83e8.png\";','2014-07-17 04:16:14','2014-07-17 04:16:14','lookbook',20002,'image'),(544,'080f8dddb579363f27e31c24e27ef27a','s:44:\"/upload/080f8dddb579363f27e31c24e27ef27a.png\";','2014-07-17 04:16:20','2014-07-17 04:16:20','lookbook',20003,'image'),(545,'9da828c48de9f073f29af7a0bbff3d57','s:44:\"/upload/9da828c48de9f073f29af7a0bbff3d57.png\";','2014-07-17 04:16:38','2014-07-17 04:16:38','lookbook',20004,'image'),(546,'5eb20993c11c24c822790eddd6b32fb3','s:44:\"/upload/5eb20993c11c24c822790eddd6b32fb3.png\";','2014-07-17 04:16:47','2014-07-17 04:16:47','lookbook',20005,'image'),(547,'0b56fbc54e9e4732e975f0095bf345d1','s:44:\"/upload/0b56fbc54e9e4732e975f0095bf345d1.png\";','2014-07-17 04:16:48','2014-07-17 04:16:48','lookbook',20006,'image'),(548,'7c7910278cfac1d8d2fd41836c09dbc3','s:44:\"/upload/7c7910278cfac1d8d2fd41836c09dbc3.png\";','2014-07-17 04:16:48','2014-07-17 04:16:48','lookbook',20007,'image'),(549,'79b937b8bcfa76661c315e26904d70d1','s:44:\"/upload/79b937b8bcfa76661c315e26904d70d1.png\";','2014-07-17 04:16:49','2014-07-17 04:16:49','lookbook',20008,'image'),(550,'d83b9282d6c7b73bb4c38ae1bd21544e','s:44:\"/upload/d83b9282d6c7b73bb4c38ae1bd21544e.png\";','2014-07-17 04:16:49','2014-07-17 04:16:49','lookbook',20009,'image'),(551,'065013db70d934727dbdf1ca906248b9','s:44:\"/upload/065013db70d934727dbdf1ca906248b9.png\";','2014-07-17 04:16:49','2014-07-17 04:16:49','lookbook',20010,'image'),(552,'eb5e729c91ba0195a13097177f4a07af','s:44:\"/upload/eb5e729c91ba0195a13097177f4a07af.png\";','2014-07-17 04:16:49','2014-07-17 04:16:49','lookbook',20011,'image'),(553,'beb85eb7d6c1ebe38729e5c699f0bd24','s:44:\"/upload/beb85eb7d6c1ebe38729e5c699f0bd24.png\";','2014-07-17 04:16:49','2014-07-17 04:16:49','lookbook',20012,'image'),(561,'fd8431d1c85ebdc0f30e687caa67e3b0','s:44:\"/upload/fd8431d1c85ebdc0f30e687caa67e3b0.png\";','2014-07-17 05:51:18','2014-07-17 05:57:34','brand',10007,'brand_navigation_image'),(562,'47916fc3ba0f15134ac2ebfa7560a6c3','s:44:\"/upload/47916fc3ba0f15134ac2ebfa7560a6c3.png\";','2014-07-17 05:55:23','2014-07-17 05:57:34','brand',10007,'brand_thumbnail_image'),(563,'fd975c59f7eefc37988c4ae3a2c935c2','s:44:\"/upload/fd975c59f7eefc37988c4ae3a2c935c2.png\";','2014-07-17 05:56:01','2014-07-17 05:57:34','brand',10007,'brand_master_image'),(564,'a15125da854e04b26425629ed9f943e9','s:44:\"/upload/a15125da854e04b26425629ed9f943e9.png\";','2014-07-17 06:01:08','2014-07-17 23:01:05','brand',10011,'brand_thumbnail_image'),(565,'0e45644600d424c23884c1dd2393e3a5','s:44:\"/upload/0e45644600d424c23884c1dd2393e3a5.png\";','2014-07-17 06:01:22','2014-07-17 23:01:05','brand',10011,'brand_master_image'),(566,'9dc70ab641083d34f94667af4b0859ca','s:44:\"/upload/9dc70ab641083d34f94667af4b0859ca.png\";','2014-07-17 07:36:06','2014-07-17 07:39:36','brand_information',10013,'dazzle_thumbnail'),(567,'d09daa9367c08be58b3a3c341fd16624','s:44:\"/upload/d09daa9367c08be58b3a3c341fd16624.png\";','2014-07-17 07:38:27','2014-07-17 07:39:36','brand_information',10013,'diamond_thumbnail'),(568,'a702df43a5988a75c3e43e9e8993a345','s:44:\"/upload/a702df43a5988a75c3e43e9e8993a345.png\";','2014-07-17 21:28:04','2014-07-17 21:28:04','lookbook',20019,'image'),(569,'504edd29d75fff4cc0848a6e0fc52fe6','s:44:\"/upload/504edd29d75fff4cc0848a6e0fc52fe6.png\";','2014-07-17 21:28:30','2014-07-17 21:28:30','lookbook',20020,'image'),(570,'5cba2a305df09905b3497cea921e8c15','s:44:\"/upload/5cba2a305df09905b3497cea921e8c15.png\";','2014-07-17 21:28:58','2014-07-17 21:28:58','arrival',20021,'image'),(571,'3af5206fec1ea6d2d2236ef93d76b67b','s:44:\"/upload/3af5206fec1ea6d2d2236ef93d76b67b.png\";','2014-07-17 21:29:38','2014-07-17 21:29:38','arrival',20022,'image'),(572,'e838eaf821defc36ea6f601826c96a9b','s:44:\"/upload/e838eaf821defc36ea6f601826c96a9b.png\";','2014-07-17 21:29:53','2014-07-17 21:29:53','arrival',20023,'image'),(573,'837b78ddc0459ae97101f900b16c4916','s:44:\"/upload/837b78ddc0459ae97101f900b16c4916.png\";','2014-07-17 21:33:36','2014-07-17 21:33:36','arrival',20024,'image'),(574,'e4ba54e5a53ee2bc658dff30b0908a99','s:44:\"/upload/e4ba54e5a53ee2bc658dff30b0908a99.png\";','2014-07-17 21:33:59','2014-07-17 21:33:59','lookbook',20025,'image'),(575,'188867ebc42cd6138b750480cdd6c3bf','s:44:\"/upload/188867ebc42cd6138b750480cdd6c3bf.png\";','2014-07-17 21:35:50','2014-07-17 21:35:50','arrival',20026,'image'),(576,'ca7d01aae0c28c897a7f42336e284da3','s:44:\"/upload/ca7d01aae0c28c897a7f42336e284da3.png\";','2014-07-17 23:01:05','2014-07-17 23:01:05','brand',10011,'brand_navigation_image'),(577,'df5a299537ef751af38c3a23ae9bf43e','s:44:\"/upload/df5a299537ef751af38c3a23ae9bf43e.jpg\";','2014-07-19 14:00:53','2014-07-19 14:00:53','arrival',20028,'image'),(578,'0c629623376948bc8ee8894b8bfa1ca8','s:44:\"/upload/0c629623376948bc8ee8894b8bfa1ca8.png\";','2014-07-19 15:41:27','2014-07-19 15:41:27','arrival',20029,'image'),(579,'116a1bd3c1acf2bf9232e34257984a43','s:44:\"/upload/116a1bd3c1acf2bf9232e34257984a43.png\";','2014-07-19 15:54:19','2014-07-19 15:54:19','arrival',20030,'image'),(580,'16bf89b788add6242b12d72b204d28f8','s:44:\"/upload/16bf89b788add6242b12d72b204d28f8.jpg\";','2014-07-19 16:12:57','2014-07-19 16:12:57','lookbook',20031,'image'),(581,'6aedb908646de8b5b8a4dca2dac6a545','s:44:\"/upload/6aedb908646de8b5b8a4dca2dac6a545.png\";','2014-07-20 07:08:38','2014-07-20 07:08:38','lookbook',20032,'image'),(582,'b57dc3bb318e4b62fe893133a82a4516','a:2:{i:0;s:44:\"/upload/9c50ce2ff326e878022420a3b504f922.png\";i:1;s:44:\"/upload/b57dc3bb318e4b62fe893133a82a4516.png\";}','2014-07-20 07:26:21','2014-07-20 07:44:54','news',20033,'thumbnail'),(583,'bddc49992ff8d56ca8bd642e2cfd3efb','s:44:\"/upload/bddc49992ff8d56ca8bd642e2cfd3efb.png\";','2014-07-20 09:46:28','2014-07-20 09:46:28','videocontent',20034,'thumbnail'),(584,'5a06ea7302be665bcc5364a5a709d04a','s:44:\"/upload/5a06ea7302be665bcc5364a5a709d04a.png\";','2014-07-20 09:51:23','2014-07-20 09:51:23','brand_information',10012,'dazzle_thumbnail');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navigation_menu`
--

DROP TABLE IF EXISTS `navigation_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navigation_menu` (
  `nm_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `media_uri` varchar(255) DEFAULT NULL,
  `url` varchar(45) DEFAULT '',
  `cdate` datetime DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  PRIMARY KEY (`nm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navigation_menu`
--

LOCK TABLES `navigation_menu` WRITE;
/*!40000 ALTER TABLE `navigation_menu` DISABLE KEYS */;
INSERT INTO `navigation_menu` VALUES (15,'title_media','测试  Media Media','/upload/9aa41b77b695834608483b80c15ebe7e.JPG','','2014-07-11 22:50:23','2014-07-20 08:50:15'),(16,'title_coporation','Coporation','/upload/7c0231dd2b9ec93336e44dcda0ba9ea3.png','','2014-07-11 22:57:43','2014-07-20 08:50:15'),(17,'title_brand','Brand','/upload/ae9462663ca978b29c0c3d23b422cd73.JPG','','2014-07-11 22:57:43','2014-07-20 08:50:15'),(18,'title_career','Career','/upload/790c3b0f87e526f7aad80187bcfc864a.jpg','','2014-07-11 22:57:43','2014-07-20 08:50:15'),(19,'title_home','Home','/upload/e9ab8b7cd9608a7ab06cca2339ed1638.png','','2014-07-11 22:57:43','2014-07-20 08:50:15');
/*!40000 ALTER TABLE `navigation_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES ('b0d9chpv235inqq4in5h8firj0',1405845333,'login|b:1;'),('q7ta6cs7muiarspmbd5tf043d2',1405907932,'login|b:1;');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `distinct` varchar(50) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `address` text,
  `phone` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `lng` varchar(45) DEFAULT NULL,
  `cdate` varchar(45) DEFAULT NULL,
  `mdate` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `type` tinyint(4) DEFAULT '0',
  `star` tinyint(4) DEFAULT '0',
  `language` varchar(10) DEFAULT 'cn',
  `category` varchar(100) DEFAULT '',
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop`
--

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` VALUES (1,NULL,'北京市','北京','全聚德','前门大街32号前门步行街北口内100米',NULL,'39.907856','116.404735','2014-07-16 22:47:59','2014-07-16 22:47:59',1,0,0,'cn',''),(2,'','湖北省','宜昌','全聚德','前门大街32号前门步行街北口内100米','','39.907856','116.404735','2014-07-16 22:56:15','2014-07-17 04:11:01',1,0,0,'cn',''),(3,NULL,'上海市','上海','人民广场','地铁1号线; 地铁2号线; 地铁8号线',NULL,'31.264967','121.493648','2014-07-20 08:23:18','2014-07-20 08:23:18',1,0,0,'en','dazzle');
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system`
--

DROP TABLE IF EXISTS `system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system` (
  `sid` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `value` text,
  `mdate` datetime DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system`
--

LOCK TABLES `system` WRITE;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
/*!40000 ALTER TABLE `system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `uri` text,
  `cid` int(11) DEFAULT NULL,
  `field_name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'mp4/avi/mpeg/',
  `cdate` datetime DEFAULT NULL,
  `format` varchar(45) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mdate` datetime DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (9,'s:44:\"/upload/11a1a825a9cfaf2def6a4b01ee4402b5.mp4\";',10016,'video_mp4','videocontent',NULL,'mp4','11a1a825a9cfaf2def6a4b01ee4402b5',NULL),(10,'s:45:\"/upload/f52f6cfcf2686a647d094d6b948a3b79.webm\";',10016,'video_webm','videocontent',NULL,'webm','f52f6cfcf2686a647d094d6b948a3b79',NULL),(11,'s:44:\"/upload/18693886555c14387fdf1dba46470291.mp4\";',20034,'video_mp4','videocontent',NULL,'mp4','18693886555c14387fdf1dba46470291',NULL);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-20 10:00:24
