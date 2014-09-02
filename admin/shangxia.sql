-- MySQL dump 10.13  Distrib 5.6.16, for osx10.8 (x86_64)
--
-- Host: 114.215.173.191    Database: shangxia
-- ------------------------------------------------------
-- Server version	5.6.15-log

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
  `key_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=20089 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (20074,'视频','<p>\n	视频</p>\n',NULL,'cn','2014-08-27 21:49:34','2014-08-27 22:32:32',NULL,1,'video',0,NULL),(20075,'title','body','summary','cn','2014-08-27 22:34:48','2014-08-27 22:34:48','0',1,'content',0,'home_brand_story_summary'),(20076,'title','body','summary','cn','2014-08-27 22:34:48','2014-08-27 22:34:48','0',1,'content',0,'home_middle_slide_one'),(20077,'title','body','summary','cn','2014-08-27 22:34:48','2014-08-27 22:34:48','0',1,'content',0,'home_middle_slide_two'),(20078,'title','body','summary','cn','2014-08-27 22:34:48','2014-08-27 22:34:48','0',1,'content',0,'home_middle_slide_third'),(20079,'里·外','<p class=\"p1\">\n	<span class=\"s1\">里&middot;外</span></p>\n',NULL,'cn','2014-08-28 00:45:14','2014-09-02 17:16:03',NULL,1,'collection',0,NULL),(20080,'DA TIAN DI - ARMCHAIR (ZITAN)','<p class=\"p1\">\n	<span class=\"s1\">Tian Di encompasses the heavens and the earth. This collection of furniture is made up of clean lines and soft arcs, generous and open in spirit, ready to contain the heavens and the earth. The Da Tian Di armchair is a light evolution of the traditional Ming &quot;official&#39;s hat chair&quot;. It reverses the traditional Ming furniture concept of a rounded exterior and square centre and presents a square exterior and round interior. The result is a more modern line, revealing the deep craft that goes into its construction. SHANG XIA has ingeniously combined the simplicity and elegance of Ming furniture with the Western lounge concept, giving this new official&#39;s hat chair a soft seat and back, making it a more user-friendly experience. The Zitan is paired with high quality braided leather cushions. Tanners expertly slice whole cowhides into long strips, just 3.8mm wide. They are woven in a style similar to k&#39;o-ssu silk tapestry, strip over strip, each piece entirely handmade, for a textured, living, breathing finish. The construction of each chair takes six to nine months with each step in the process being performed with needlepoint precision. The result is a finely crafted modern heirloom with a timeless appeal.</span></p>\n',NULL,'cn','2014-08-29 06:27:18','2014-09-02 17:42:07',NULL,1,'product',0,NULL),(20081,'DA TIAN DI - ROCKING CHAIR (WALNUT)','<p class=\"p1\">\n	<span class=\"s1\">Tian Di encompasses heaven and earth. This collection of furniture is made of clean lines and soft arcs, generous and open in spirit, ready to contain both the heavens and the earth. The Da Tian Di rocking chair applies this clean design concept to traditional Ming furniture, bringing it up to date with modern living. Walnut has a smooth, bright grain, like a tracery of inlaid gold, gleaming in the rich, dark wood. The SHANG XIA craftsmen spent over a year discovering the best way to join braided leather to the walnut frame. Special craft techniques make the wood stronger and longer-lasting, providing gentle support to the whole body, and revealing the deep craft that goes into the making of the chair. The process of construction, from the handling of the walnut timber through to the joinery, polishing and the selection and braiding of the leather requires nearly five months for each chair.  Every step in the construction of a Da Tian Di rocking chair must be performed with the highest precision. The result is a perfectly balanced chair: the lightest of breezes will start a gentle rocking. Take a moment to gently rock your cares away leaving a person, you, living a moment of peace in your own free space between heaven and earth.</span></p>\n',NULL,'cn','2014-08-29 06:35:32','2014-09-02 17:24:56',NULL,1,'product',0,NULL),(20084,'Craft French','<p>\n	Craft French</p>\n',NULL,'fr','2014-09-02 05:56:06','2014-09-02 05:56:06',NULL,1,'craft',0,NULL),(20085,'Craft French','<p>\n	Craft French</p>\n',NULL,'fr','2014-09-02 05:56:20','2014-09-02 05:56:20',NULL,1,'craft',0,NULL),(20086,'Shangxia','<p>\n	Lan Yue</p>\n',NULL,'cn','2014-09-02 14:04:17','2014-09-02 17:01:09',NULL,1,'slideShow',0,NULL),(20087,'Test Craft','<p>\n	Test Craft</p>\n',NULL,'cn','2014-09-02 14:09:36','2014-09-02 14:09:36',NULL,1,'craft',0,NULL),(20088,'DRAGON CLOUD - GILDED BAMBOO WOVEN PORCELAIN TEA','<p class=\"p1\">\n	<span class=\"s1\">The dragon represents the traditional spirit of China. Its imperial splendor finds a modern expression in the SHANG XIA Dragon Cloud series: the pattern is inspired by the traditional dragon-scale motif, and its form and design animated by those soaring mythical beasts. Writhing over one another, their fierce majesty promises good fortune. The bamboo covered porcelain tea set consists of four cups with saucers and one teapot on a Zitan wood tray. It is a limited edition, with only 8 sets in existence. Evolving from the classic dragon-handled teacup, the two dragon handles on each cup have been stylized into a vivid modern arc form. Every piece in the Dragon Cloud set is created using the finest handcraft techniques. The bamboo fibers are less than half a millimeter in width, and are gilded in five layers of 18k gold dust with minute accuracy, then tightly woven over white porcelain that has been fired at an extremely high temperature. The gilt covers every inch of the bamboo in a gleaming finish, so smooth and even that it seems an organic part of the material. With its pure gold crescent handle, the design is timeless. The Dragon Cloud set represents over 1,000 hours of painstaking work by master craftsman. It is a collector&#39;s item, but its elegance and textures may also be appreciated in the daily ritual of tea drinking.&nbsp;</span></p>\n',NULL,'cn','2014-09-02 17:48:18','2014-09-02 17:48:18',NULL,1,'product',0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (50,'2014-08-23 12:13:11','2014-08-23 13:36:31','collection_name','hello world, 你好',1),(51,'2014-08-23 15:28:51','2014-08-23 15:38:41','body','Shang xia is a brand for art of living<br>\r\n			that promises a unique encounter with the heritage of Chinese design and craftsmanship.',1),(52,'2014-08-23 16:31:25','2014-08-23 16:39:02','link_to','',20037),(53,'2014-08-23 16:37:54','2014-08-23 16:39:02','title','测试的Slideshow',20037),(54,'2014-08-24 19:00:08','2014-08-24 19:31:39','summary','',0),(55,'2014-08-24 19:22:43','2014-08-24 19:22:57','summary','',20042),(56,'2014-08-26 23:40:55','2014-08-26 23:40:55','summary','sumary',20069),(57,'2014-08-28 00:45:14','2014-09-02 17:16:03','public_date','2012 - 2014',20079),(58,'2014-08-29 06:27:18','2014-09-02 17:42:07','video_title','DA TIAN DI - ARMCHAIR (ZITAN)',20080),(59,'2014-08-29 06:27:18','2014-09-02 17:42:07','video_description','',20080),(60,'2014-08-29 06:27:18','2014-09-02 17:42:07','product_type','3',20080),(61,'2014-08-29 06:27:18','2014-09-02 17:42:07','collection','20079',20080),(62,'2014-08-29 06:35:33','2014-09-02 17:24:56','video_title','DA TIAN DI - ROCKING CHAIR (WALNUT)',20081),(63,'2014-08-29 06:35:33','2014-09-02 17:24:56','video_description','',20081),(64,'2014-08-29 06:35:33','2014-09-02 17:24:56','product_type','3',20081),(65,'2014-08-29 06:35:33','2014-09-02 17:24:56','collection','20079',20081),(66,'2014-08-29 06:36:07','2014-09-02 04:34:34','product','[\"20080\",\"20081\"]',20082),(67,'2014-09-02 05:00:01','2014-09-02 05:00:01','product','[\"20081\",\"20080\"]',20083),(68,'2014-09-02 14:09:37','2014-09-02 14:09:37','product','[\"20081\",\"20080\"]',20087),(69,'2014-09-02 17:48:18','2014-09-02 17:48:18','video_title','DRAGON CLOUD - GILDED BAMBOO WOVEN PORCELAIN TEA',20088),(70,'2014-09-02 17:48:18','2014-09-02 17:48:18','video_description','<p>\n	DRAGON CLOUD - GILDED BAMBOO WOVEN PORCELAIN TEA</p>\n',20088),(71,'2014-09-02 17:48:18','2014-09-02 17:48:18','product_type','5',20088),(72,'2014-09-02 17:48:18','2014-09-02 17:48:18','collection','20079',20088);
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
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=646 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (601,'xxsdl3','/uploads/xxsdl1.png','2014-08-23 13:36:31','2014-08-23 13:36:31','content',1,'image',NULL),(602,'xxsdl3','/uploads/xxsdl2.png','2014-08-23 13:36:31','2014-08-23 13:36:31','content',1,'image',NULL),(603,'xxsdl3','/uploads/xxsdl2.png','2014-08-23 13:36:31','2014-08-23 13:36:31','content',1,'image',NULL),(604,'11130844407c075139d6fbe5e5c758fc','/upload/11130844407c075139d6fbe5e5c758fc.jpg','2014-08-26 21:53:15','2014-08-26 21:53:15','slideshow',20044,'image',NULL),(605,'db2ec4122d8a7dcd433d328b5f583976','/upload/db2ec4122d8a7dcd433d328b5f583976.jpg','2014-08-26 22:34:35','2014-08-26 22:46:53','slideshow',0,'image',NULL),(606,'aab426f4b19f58e68a682b3e69df9f55','/upload/aab426f4b19f58e68a682b3e69df9f55.jpg','2014-08-26 23:03:25','2014-08-26 23:18:24','slideshow',20065,'image',NULL),(607,'ae2d67f0cfcfbac2fe8c63d59df3c96c','/upload/ae2d67f0cfcfbac2fe8c63d59df3c96c.jpg','2014-08-26 23:40:39','2014-08-26 23:40:39','slideshow',20068,'image',NULL),(608,'a94d0383fcc7c05aca0fb7d6dd76032f','/upload/a94d0383fcc7c05aca0fb7d6dd76032f.png','2014-08-28 00:45:14','2014-08-28 00:45:14','collection',20079,'master_image',NULL),(609,'0b5976ae62da44e1f5f2627731d90b5b','/upload/0b5976ae62da44e1f5f2627731d90b5b.jpg','2014-08-28 00:45:14','2014-09-02 17:16:03','collection',20079,'thumbnail_image',NULL),(623,'c8307a1d9be605c70c5cefda3fdda866','/upload/c8307a1d9be605c70c5cefda3fdda866.jpg','2014-09-02 04:05:12','2014-09-02 04:34:35','craft',20082,'thumbnail_image',NULL),(624,'af76fdbc41f1a97c1bdfc7cd1ede3ff2','/upload/af76fdbc41f1a97c1bdfc7cd1ede3ff2.jpg','2014-09-02 04:14:45','2014-09-02 04:34:35','craft',20082,'video_poster',NULL),(626,'c25c593cbc213ef7f190c5351bb8ee4c','/upload/c25c593cbc213ef7f190c5351bb8ee4c.jpg','2014-09-02 04:47:49','2014-09-02 17:42:07','product',20080,'thumbnail',NULL),(628,'76dcd1fc2e66daa6e61c4dcb9c081e0f','/upload/76dcd1fc2e66daa6e61c4dcb9c081e0f.jpg','2014-09-02 04:48:57','2014-09-02 17:24:56','product',20081,'thumbnail',NULL),(629,'4ebaceb7e53ff9111f2fdcf3c857e9d1','/upload/4ebaceb7e53ff9111f2fdcf3c857e9d1.jpg','2014-09-02 05:00:01','2014-09-02 05:00:01','craft',20083,'thumbnail_image',NULL),(630,'38f362fa1c9d8121aefc9765d5b39a35','/upload/38f362fa1c9d8121aefc9765d5b39a35.jpg','2014-09-02 05:00:01','2014-09-02 05:00:01','craft',20083,'video_poster',NULL),(631,'4fa826a00dcf656e60d39816afa8a4ab','/upload/4fa826a00dcf656e60d39816afa8a4ab.jpg','2014-09-02 14:04:17','2014-09-02 17:01:09','slideShow',20086,'image',NULL),(632,'02bad58b633419b3e8ec4378eb8bc0d7','/upload/02bad58b633419b3e8ec4378eb8bc0d7.jpg','2014-09-02 14:09:38','2014-09-02 14:09:38','craft',20087,'thumbnail_image',NULL),(633,'abcf6774df5f3cf48e28d584bcd5edda','/upload/abcf6774df5f3cf48e28d584bcd5edda.jpg','2014-09-02 14:09:38','2014-09-02 14:09:38','craft',20087,'video_poster',NULL),(636,'07aea731804ef9a53940901902129a12','/upload/07aea731804ef9a53940901902129a12.jpg','2014-09-02 17:16:03','2014-09-02 17:16:03','collection',20079,'slide_image',NULL),(638,'859f072b868cfc8d36a6a8892b3af76d','/upload/50d57bb4de7fbf844b5dda90e35eb6f5.jpg','2014-09-02 17:24:56','2014-09-02 17:24:56','product',20081,'product_slide_image',NULL),(639,'859f072b868cfc8d36a6a8892b3af76d','/upload/859f072b868cfc8d36a6a8892b3af76d.jpg','2014-09-02 17:24:56','2014-09-02 17:24:56','product',20081,'product_slide_image',NULL),(642,'567229a5eb5c1dc2f9558d629d5a45cf','/upload/3fc65b1bcee80582ffd1093d508bc21f.jpg','2014-09-02 17:42:07','2014-09-02 17:42:07','product',20080,'product_slide_image',NULL),(643,'567229a5eb5c1dc2f9558d629d5a45cf','/upload/567229a5eb5c1dc2f9558d629d5a45cf.jpg','2014-09-02 17:42:07','2014-09-02 17:42:07','product',20080,'product_slide_image',NULL),(644,'c3f77ae79fcc32d33c2689b8ac08c0f7','/upload/c3f77ae79fcc32d33c2689b8ac08c0f7.jpg','2014-09-02 17:48:18','2014-09-02 17:48:18','product',20088,'product_slide_image',NULL),(645,'84d52e26eb7627a2928832a8ab400320','/upload/84d52e26eb7627a2928832a8ab400320.jpg','2014-09-02 17:48:18','2014-09-02 17:48:18','product',20088,'thumbnail',NULL);
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
INSERT INTO `session` VALUES ('0uo7r1u7nssmleqoluuomuvfg4',1409723536,''),('dva0kpif4u5dogktnsedplk925',1409737699,'login|b:1;'),('u92ssge0a6d68t5sdfhhbnms76',1409736740,'login|b:1;');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (14,'s:44:\"/upload/7b0bb402dbed25d841de323ad0e26e8c.mp4\";',20074,'video_mp4','video',NULL,'mp4','7b0bb402dbed25d841de323ad0e26e8c',NULL),(15,'s:44:\"/upload/663c07528537f7a461cae4c57dc65ad4.mp4\";',20074,'video_webm','video',NULL,'mp4','663c07528537f7a461cae4c57dc65ad4',NULL),(16,'s:44:\"/upload/3935a150bcfa86a0d0bb4039b7815618.mp4\";',20080,'product_video','product',NULL,'mp4','3935a150bcfa86a0d0bb4039b7815618',NULL),(17,'s:0:\"\";',20081,'product_video','product',NULL,'','admin',NULL),(18,'s:44:\"/upload/6e52b3b7b10af874bb100c90bfc05ed0.mp4\";',20082,'craft_video','craft',NULL,'mp4','6e52b3b7b10af874bb100c90bfc05ed0',NULL),(19,'s:0:\"\";',20083,'craft_video','craft',NULL,'','admin',NULL),(20,'s:0:\"\";',20087,'craft_video','craft',NULL,'','admin',NULL),(21,'s:0:\"\";',20088,'product_video','product',NULL,'','admin',NULL);
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

-- Dump completed on 2014-09-02 17:52:17
