-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: book_dinner
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `book_dinner_info`
--

DROP TABLE IF EXISTS `book_dinner_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_dinner_info` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `dish_name` varchar(50) DEFAULT NULL,
  `createtime` date NOT NULL,
  `book_state` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_dinner_info`
--

LOCK TABLES `book_dinner_info` WRITE;
/*!40000 ALTER TABLE `book_dinner_info` DISABLE KEYS */;
INSERT INTO `book_dinner_info` VALUES (1,'钟贵勇','麻辣烫','2016-08-01',1),(2,'刘侠','阿嘎','2016-08-01',1),(67,'郭丹秋',NULL,'2016-07-29',0),(68,'裘奕妃',NULL,'2016-07-29',0),(69,'万春蕾',NULL,'2016-07-29',0),(70,'尹雪',NULL,'2016-07-29',0),(71,'曹雪莹',NULL,'2016-07-29',0),(72,'何红玉',NULL,'2016-07-29',0),(73,'卢明',NULL,'2016-07-29',0),(74,'朱月辉',NULL,'2016-07-29',0),(75,'陈光荣',NULL,'2016-07-29',0),(76,'陈露',NULL,'2016-07-29',0),(77,'杜静怡',NULL,'2016-07-29',0),(78,'高铁梅',NULL,'2016-07-29',0),(79,'郭盼',NULL,'2016-07-29',0),(80,'韩元旭',NULL,'2016-07-29',0),(81,'何新',NULL,'2016-07-29',0),(82,'侯东阳',NULL,'2016-07-29',0),(83,'纪宗鹏',NULL,'2016-07-29',0),(84,'贾培宽',NULL,'2016-07-29',0),(85,'金宝华',NULL,'2016-07-29',0),(86,'李仁飞',NULL,'2016-07-29',0),(87,'李小龙',NULL,'2016-07-29',0),(88,'李旭',NULL,'2016-07-29',0),(89,'李亚杰',NULL,'2016-07-29',0),(90,'刘生超',NULL,'2016-07-29',0),(92,'倪思远',NULL,'2016-07-29',0),(93,'牛晨','麻辣香锅','2016-08-01',1),(94,'史铁建',NULL,'2016-07-29',0),(95,'宋斌',NULL,'2016-07-29',0),(96,'宋媛媛',NULL,'2016-07-29',0),(97,'王攀登',NULL,'2016-07-29',0),(98,'王朋飞',NULL,'2016-07-29',0),(99,'王瑞宝',NULL,'2016-07-29',0),(100,'王雨',NULL,'2016-07-29',0),(101,'吴启铸',NULL,'2016-07-29',0),(102,'喜军',NULL,'2016-07-29',0),(103,'杨培军',NULL,'2016-07-29',0),(104,'姚宇',NULL,'2016-07-29',0),(105,'赵霞平','','2016-07-29',0),(106,'周玉龙',NULL,'2016-07-29',0),(107,'陈亚云',NULL,'2016-07-29',0),(108,'崔灿',NULL,'2016-07-29',0),(109,'丁光艳',NULL,'2016-07-29',0),(110,'孟金玲',NULL,'2016-07-29',0),(111,'孙妍芬',NULL,'2016-07-29',0),(112,'田丹丹',NULL,'2016-07-29',0),(113,'吴会子',NULL,'2016-07-29',0),(114,'张梦娟',NULL,'2016-07-29',0),(115,'张新萍',NULL,'2016-07-22',0),(116,'张玉超',NULL,'2016-07-29',0),(117,'张志旺',NULL,'2016-07-29',0);
/*!40000 ALTER TABLE `book_dinner_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-01 19:29:41
