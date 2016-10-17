-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `customer_config`
--

DROP TABLE IF EXISTS `customer_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type` text NOT NULL,
  `config_key` text NOT NULL,
  `config_value` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  KEY `customer_index_config_type` (`config_type`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_config`
--

LOCK TABLES `customer_config` WRITE;
/*!40000 ALTER TABLE `customer_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_customer`
--

DROP TABLE IF EXISTS `customer_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `customer_lastname` text,
  `customer_lastname_ruby` text,
  `customer_juniorhighschool` text,
  `customer_club` text,
  `customer_couple` text,
  `customer_gender` text,
  `customer_postcode` text,
  `customer_address` text,
  `customer_addressruby` text,
  `customer_phone` text,
  `customer_graduate` text,
  `customer_mobile` text,
  `customer_email` text,
  `customer_id` text,
  `customer_comment` text,
  `customer_position` int(11) DEFAULT NULL,
  `customer_annualfee` text,
  `customer_party` text,
  `customer_role` text,
  `customer_firstname` text,
  `customer_firstname_ruby` text,
  `customer_item05` text,
  `customer_item06` text,
  `customer_item07` text,
  `customer_item08` text,
  `customer_item09` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  KEY `customer_index_customer_folder_id` (`folder_id`),
  KEY `customer_index_customer_type` (`customer_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_customer`
--

LOCK TABLES `customer_customer` WRITE;
/*!40000 ALTER TABLE `customer_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_folder`
--

DROP TABLE IF EXISTS `customer_folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_type` text NOT NULL,
  `folder_id` int(11) NOT NULL,
  `folder_caption` text NOT NULL,
  `folder_name` text,
  `folder_date` text,
  `folder_order` int(11) DEFAULT NULL,
  `add_level` int(11) DEFAULT NULL,
  `add_group` text,
  `add_user` text,
  `public_level` int(11) DEFAULT NULL,
  `public_group` text,
  `public_user` text,
  `edit_level` int(11) DEFAULT NULL,
  `edit_group` text,
  `edit_user` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  KEY `customer_index_folder_type` (`folder_type`(255)),
  KEY `customer_index_folder_id` (`folder_id`),
  KEY `customer_index_folder_owner` (`owner`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_folder`
--

LOCK TABLES `customer_folder` WRITE;
/*!40000 ALTER TABLE `customer_folder` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_group`
--

DROP TABLE IF EXISTS `customer_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` text NOT NULL,
  `group_order` int(11) DEFAULT NULL,
  `add_level` int(11) NOT NULL,
  `add_group` text,
  `add_user` text,
  `edit_level` int(11) DEFAULT NULL,
  `edit_group` text,
  `edit_user` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_group`
--

LOCK TABLES `customer_group` WRITE;
/*!40000 ALTER TABLE `customer_group` DISABLE KEYS */;
INSERT INTO `customer_group` VALUES (1,'ogihara',NULL,0,NULL,NULL,NULL,NULL,NULL,'ogihara',NULL,'2016-10-05 06:19:44',NULL);
/*!40000 ALTER TABLE `customer_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_history`
--

DROP TABLE IF EXISTS `customer_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_type` int(11) DEFAULT NULL,
  `customer_lastname` text,
  `history_item00` text,
  `history_item01` text,
  `history_item02` text,
  `history_item03` text,
  `history_item04` text,
  `history_item05` text,
  `history_item06` text,
  `history_item07` text,
  `history_item08` text,
  `history_item09` text,
  `history_item10` text,
  `history_item11` text,
  `history_item12` text,
  `history_item13` text,
  `history_item14` text,
  `history_item15` text,
  `history_item16` text,
  `history_item17` text,
  `history_item18` text,
  `history_item19` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  KEY `customer_index_history_folder_id` (`folder_id`),
  KEY `customer_index_history_customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_history`
--

LOCK TABLES `customer_history` WRITE;
/*!40000 ALTER TABLE `customer_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_item`
--

DROP TABLE IF EXISTS `customer_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `item_type` text NOT NULL,
  `item_field` text NOT NULL,
  `item_caption` text,
  `item_input` text,
  `item_property` text,
  `item_null` text,
  `item_display` int(11) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  KEY `customer_index_item_folder_id` (`folder_id`),
  KEY `customer_index_item_type` (`item_type`(255)),
  KEY `customer_index_item_field` (`item_field`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_item`
--

LOCK TABLES `customer_item` WRITE;
/*!40000 ALTER TABLE `customer_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_user`
--

DROP TABLE IF EXISTS `customer_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` text NOT NULL,
  `password` text NOT NULL,
  `password_default` text NOT NULL,
  `realname` text NOT NULL,
  `authority` text NOT NULL,
  `user_group` int(11) DEFAULT NULL,
  `user_groupname` text,
  `user_email` text,
  `user_skype` text,
  `user_ruby` text,
  `user_postcode` text,
  `user_address` text,
  `user_addressruby` text,
  `user_phone` text,
  `user_mobile` text,
  `user_order` int(11) DEFAULT NULL,
  `edit_level` int(11) DEFAULT NULL,
  `edit_group` text,
  `edit_user` text,
  `owner` text NOT NULL,
  `editor` text,
  `created` text NOT NULL,
  `updated` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_index_userid` (`userid`(255)),
  KEY `customer_index_user_group` (`user_group`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_user`
--

LOCK TABLES `customer_user` WRITE;
/*!40000 ALTER TABLE `customer_user` DISABLE KEYS */;
INSERT INTO `customer_user` VALUES (1,'ogihara','5cf3e3f526c9519511cc65c273187af1','5cf3e3f526c9519511cc65c273187af1','ogihara','administrator',1,'ogihara',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ogihara',NULL,'2016-10-05 06:19:44',NULL);
/*!40000 ALTER TABLE `customer_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-17 11:28:39
