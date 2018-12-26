-- MySQL dump 10.13  Distrib 5.7.21, for Win64 (x86_64)
--
-- Host: localhost    Database: db_facturation
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `t_activity`
--

DROP TABLE IF EXISTS `t_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_activity` (
  `str_ACTIVITY_ID` varchar(20) NOT NULL,
  `str_LOGIN` text NOT NULL,
  `str_NOM` varchar(45) NOT NULL,
  `str_PRIV` varchar(10) NOT NULL,
  `dt_CREATED` datetime NOT NULL,
  `str_STATUT` varchar(20) NOT NULL,
  `str_SECURITY_ID` varchar(20) NOT NULL,
  `str_ADRESSE_IP` varchar(255) NOT NULL,
  `str_NAVIGATEUR` varchar(255) NOT NULL,
  `str_PAYS` varchar(100) NOT NULL,
  PRIMARY KEY (`str_ACTIVITY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_activity`
--

LOCK TABLES `t_activity` WRITE;
/*!40000 ALTER TABLE `t_activity` DISABLE KEYS */;
INSERT INTO `t_activity` VALUES ('s3i3z5c235ad9a5d24','root','Moroko Jean','admin','2018-12-26 10:41:29','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('wnle85c2357e357071','root','Moroko Jean','admin','2018-12-26 10:28:51','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('zhw5p5c2354faaed91','root','Moroko Jean','admin','2018-12-26 10:16:26','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('zzh085c235a76dad6c','root','Moroko Jean','admin','2018-12-26 10:39:50','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1');
/*!40000 ALTER TABLE `t_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_branche`
--

DROP TABLE IF EXISTS `t_branche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_branche` (
  `lg_BRANCHE_ID` varchar(20) NOT NULL,
  `str_LIBELLE` varchar(45) DEFAULT NULL,
  `str_STATUT` varchar(45) DEFAULT NULL,
  `str_CREATED_BY` varchar(45) DEFAULT NULL,
  `dt_CREATED` datetime DEFAULT NULL,
  `str_UPDATED_BY` varchar(45) DEFAULT NULL,
  `dt_UPDATED` datetime DEFAULT NULL,
  PRIMARY KEY (`lg_BRANCHE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_branche`
--

LOCK TABLES `t_branche` WRITE;
/*!40000 ALTER TABLE `t_branche` DISABLE KEYS */;
INSERT INTO `t_branche` VALUES ('gatzs5c2352579b952','Auto','enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL),('qd34x5c235257afce3','Transport aérien','enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL);
/*!40000 ALTER TABLE `t_branche` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_client`
--

DROP TABLE IF EXISTS `t_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_client` (
  `lg_CLIENT_ID` varchar(20) NOT NULL,
  `str_NAME` varchar(45) DEFAULT NULL,
  `str_BP` varchar(100) DEFAULT NULL,
  `str_TEL` varchar(15) DEFAULT NULL,
  `str_STATUT` varchar(45) DEFAULT NULL,
  `str_CREATED_BY` varchar(45) DEFAULT NULL,
  `dt_CREATED` datetime DEFAULT NULL,
  `str_UPDATED_BY` varchar(45) DEFAULT NULL,
  `dt_UPDATED` datetime DEFAULT NULL,
  PRIMARY KEY (`lg_CLIENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_client`
--

LOCK TABLES `t_client` WRITE;
/*!40000 ALTER TABLE `t_client` DISABLE KEYS */;
INSERT INTO `t_client` VALUES ('87do65c235257af31c','DETOH KOUASSI P/C MBAHIA','05 BP 153 ABIDJAN 05','48244412','enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL),('moox15c2352579af12','DETOH KOUASSI ALEXIS','05 BP 1573 ABIDJAN 05','48708129','enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL);
/*!40000 ALTER TABLE `t_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_extraction`
--

DROP TABLE IF EXISTS `t_extraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_extraction` (
  `str_EXTRACTION_ID` varchar(20) NOT NULL,
  `str_FILE` varchar(250) NOT NULL,
  `str_PARAM` varchar(250) NOT NULL,
  `int_NUMBER_EXTRACT` int(11) NOT NULL,
  `str_RAR` varchar(250) NOT NULL,
  `str_STATUT` varchar(10) NOT NULL,
  `str_CREATED_BY` varchar(20) NOT NULL,
  `dt_CREATED` datetime NOT NULL,
  `lg_BRANCHE_ID` varchar(20) NOT NULL,
  `pk_COURRIER_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`str_EXTRACTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_extraction`
--

LOCK TABLES `t_extraction` WRITE;
/*!40000 ALTER TABLE `t_extraction` DISABLE KEYS */;
INSERT INTO `t_extraction` VALUES ('1lw9c5c2369f616bfc','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',3,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:58','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('35mc85c236a91318dd','courriers_avec2018/moroko_jean/26-12-2018/0_Transport_aérien/DETOH_KOUASSI_P-C_MBAHIA-250441.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:33','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('4d7g55c236a983c774','courriers_avec2018/moroko_jean/26-12-2018/0_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',1,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:40','gatzs5c2352579b952','9m3ad5c2352579abe8'),('53nfk5c23689b5cdd9','courriers_avec2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',1,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:40:11','qd34x5c235257afce3','w9pwt5c235257aee54'),('at3fh5c236bfe74f9a','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',2,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:38','gatzs5c2352579b952','oip6j5c2352812d3bc'),('ax2985c2369c9169f6','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',2,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:13','qd34x5c235257afce3','w9pwt5c235257aee54'),('bfspd5c236be1b0a53','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',3,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:09','gatzs5c2352579b952','9m3ad5c2352579abe8'),('dh6so5c236a8d61b09','courriers_avec2018/moroko_jean/26-12-2018/0_Transport_aérien/DETOH_KOUASSI_P-C_MBAHIA-250441.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:29','qd34x5c235257afce3','w9pwt5c235257aee54'),('hotqx5c236c01ee638','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',4,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:41','gatzs5c2352579b952','9m3ad5c2352579abe8'),('ibn055c236c3a7a7a7','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:55:38','gatzs5c2352579b952','9m3ad5c2352579abe8'),('r5mc5c2369c8bd562','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',2,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:12','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('rdjsi5c236bd587b7d','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',1,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:53:57','gatzs5c2352579b952','oip6j5c2352812d3bc'),('sjnel5c236a1e70bdb','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',4,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:46:38','qd34x5c235257afce3','w9pwt5c235257aee54'),('w7wc85c2369f658624','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',3,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:58','qd34x5c235257afce3','w9pwt5c235257aee54'),('xfxif5c236a1e37ee4','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',4,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:46:38','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('xhzpj5c23689ac4b6b','courriers_avec2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',1,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:40:10','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('z4bfm5c236b2d9ebc6','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',2,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:51:09','gatzs5c2352579b952','9m3ad5c2352579abe8');
/*!40000 ALTER TABLE `t_extraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_facture`
--

DROP TABLE IF EXISTS `t_facture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_facture` (
  `lg_FACTURE_ID` varchar(20) NOT NULL,
  `int_NUMFACT` int(11) DEFAULT NULL,
  `str_POLICE` varchar(15) DEFAULT NULL,
  `dt_DATE` year(4) DEFAULT NULL,
  `dt_EFFET` date DEFAULT NULL,
  `dt_ECHEANCE` date DEFAULT NULL,
  `int_ACCESSOIRE` int(11) DEFAULT NULL,
  `int_TAXE` float DEFAULT NULL,
  `int_PRIME_NETTE` int(11) DEFAULT NULL,
  `str_STATUT` varchar(45) DEFAULT NULL,
  `str_CREATED_BY` varchar(45) DEFAULT NULL,
  `dt_CREATED` datetime DEFAULT NULL,
  `str_UPDATED_BY` varchar(45) DEFAULT NULL,
  `dt_UPDATED` datetime DEFAULT NULL,
  `lg_CLIENT_ID` varchar(20) DEFAULT NULL,
  `lg_BRANCHE_ID` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`lg_FACTURE_ID`),
  KEY `fk_t_facture_t_client1_idx` (`lg_CLIENT_ID`),
  KEY `fk_t_facture_t_branche1_idx` (`lg_BRANCHE_ID`),
  CONSTRAINT `fk_t_facture_t_branche1` FOREIGN KEY (`lg_BRANCHE_ID`) REFERENCES `t_branche` (`lg_BRANCHE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_facture_t_client1` FOREIGN KEY (`lg_CLIENT_ID`) REFERENCES `t_client` (`lg_CLIENT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_facture`
--

LOCK TABLES `t_facture` WRITE;
/*!40000 ALTER TABLE `t_facture` DISABLE KEYS */;
INSERT INTO `t_facture` VALUES ('9m3ad5c2352579abe8',1,'285973',2018,'2018-01-01','2018-12-31',38928,7,3315000,'enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL,'moox15c2352579af12','gatzs5c2352579b952'),('l1rlo5c2352812e2cd',4,'250441',2018,'2018-01-01','2018-12-31',2561339,14.5,1310625,'enable','rytjykhjuyj','2018-12-26 10:05:53',NULL,NULL,'87do65c235257af31c','qd34x5c235257afce3'),('oip6j5c2352812d3bc',3,'285973',2018,'2018-01-01','2018-12-31',38928,7,3315000,'enable','rytjykhjuyj','2018-12-26 10:05:53',NULL,NULL,'moox15c2352579af12','gatzs5c2352579b952'),('w9pwt5c235257aee54',2,'250441',2018,'2018-01-01','2018-12-31',2561339,14,1310625,'enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL,'87do65c235257af31c','qd34x5c235257afce3');
/*!40000 ALTER TABLE `t_facture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_security`
--

DROP TABLE IF EXISTS `t_security`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_security` (
  `str_SECURITY_ID` varchar(20) NOT NULL,
  `str_LOGIN` varchar(45) DEFAULT NULL,
  `str_PASSWORD` varchar(100) DEFAULT NULL,
  `str_NOM` varchar(45) DEFAULT NULL,
  `str_PRENOM` varchar(45) DEFAULT NULL,
  `str_EMAIL` varchar(100) DEFAULT NULL,
  `str_PRIVILEGE` varchar(10) NOT NULL,
  `str_STATUT` varchar(20) DEFAULT NULL,
  `str_CREATED_BY` varchar(45) DEFAULT NULL,
  `dt_CREATED` datetime DEFAULT NULL,
  `str_UPDATED_BY` varchar(45) DEFAULT NULL,
  `dt_UPDATED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_security`
--

LOCK TABLES `t_security` WRITE;
/*!40000 ALTER TABLE `t_security` DISABLE KEYS */;
INSERT INTO `t_security` VALUES ('e488s5ba6528a0d2c0','test','0AF2C0887CF2E3B35BB08D36F332887DFE95BED9ADC913611D87CE50A39B3F6A','Signe Potter','Moses','zikubemiz@mailinator.com','dec','delete','rytjykhjuyj','2018-09-22 14:32:42','rytjykhjuyj','2018-10-11 15:04:38'),('rytjykhjuyj','root','8428F14AF59502776F008A1AC0F6377867DDF6DA0B099B416687F75C20786966','Moroko','Jean','morokojeanr@gmail.com','admin','enable','root','2018-08-08 00:00:00','rytjykhjuyj','2018-10-11 15:04:59'),('zw6k5b71676038ed8','hendrick','8428F14AF59502776F008A1AC0F6377867DDF6DA0B099B416687F75C20786966','TENIN','HENDRICK','hendrick.tenin@sunu-group.com','dec','enable','rytjykhjuyj','2018-08-13 11:11:28','rytjykhjuyj','2018-12-24 10:57:33');
/*!40000 ALTER TABLE `t_security` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_facturation'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-26 12:06:28
