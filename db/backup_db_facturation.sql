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
INSERT INTO `t_activity` VALUES ('0a09q5c24b0a9d7910','root','Moroko Jean','admin','2018-12-27 10:59:53','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('25dn15c24ab8eb37a5','root','Moroko Jean','admin','2018-12-27 10:38:06','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('4i8345c24b19399358','root','Moroko Jean','admin','2018-12-27 11:03:47','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('6b9w5c23f9b060c58','root','Moroko Jean','admin','2018-12-26 21:59:12','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('6tgw95c24b45f26b79','hendrick','TENIN HENDRICK','dec','2018-12-27 11:15:43','connexion','zw6k5b71676038ed8','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('7t9q55c24b0c1aa472','root','Moroko Jean','admin','2018-12-27 11:00:17','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('8w9s05c249fa80437c','root','Moroko Jean','admin','2018-12-27 09:47:20','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('c4qwe5c24a90d33a33','root','Moroko Jean','admin','2018-12-27 10:27:25','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('dw71e5c24b1b34d6fc','hendrick','TENIN HENDRICK','dec','2018-12-27 11:04:19','connexion','zw6k5b71676038ed8','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('ecp2g5c24b44280503','root','Moroko Jean','admin','2018-12-27 11:15:14','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('fozrj5c24b1a8cc808','root','Moroko Jean','admin','2018-12-27 11:04:08','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('gf1h5c24b03d0fb98','firmin','Firmin Koffi','opt','2018-12-27 10:58:05','connexion','cfghj5c24ac0a21fc4','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('i6mr45c24b0338f890','root','Moroko Jean','admin','2018-12-27 10:57:55','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('j0icq5c24b447aa14c','root','Moroko Jean','admin','2018-12-27 11:15:19','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('n93o55c2381284b543','root','Moroko Jean','admin','2018-12-26 13:24:56','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('njrgk5c24b0ce52e1a','hendrick','TENIN HENDRICK','dec','2018-12-27 11:00:30','connexion','zw6k5b71676038ed8','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('orkca5c24b43da57fa','root','Moroko Jean','admin','2018-12-27 11:15:09','deconnexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('qgr15c24ab7d76c75','root','Moroko Jean','admin','2018-12-27 10:37:49','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('r8eq85c24b0a4a54ca','firmin','Firmin Koffi','opt','2018-12-27 10:59:48','deconnexion','cfghj5c24ac0a21fc4','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('s3i3z5c235ad9a5d24','root','Moroko Jean','admin','2018-12-26 10:41:29','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('snc3d5c24af6435e5a','root','Moroko Jean','admin','2018-12-27 10:54:28','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('wnle85c2357e357071','root','Moroko Jean','admin','2018-12-26 10:28:51','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('x8pm5c238125c131c','root','Moroko Jean','admin','2018-12-26 13:24:53','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('xgxl5c238113675e6','root','Moroko Jean','admin','2018-12-26 13:24:35','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('xstez5c24b32e86838','root','Moroko Jean','admin','2018-12-27 11:10:38','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('z5r105c24b04628981','firmin','Firmin Koffi','opt','2018-12-27 10:58:14','connexion','cfghj5c24ac0a21fc4','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('zhw5p5c2354faaed91','root','Moroko Jean','admin','2018-12-26 10:16:26','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1'),('zzh085c235a76dad6c','root','Moroko Jean','admin','2018-12-26 10:39:50','connexion','rytjykhjuyj','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:65.0) Gecko/20100101 Firefox/65.0','http://www.geoplugin.net/json.gp?ip=::1');
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
INSERT INTO `t_extraction` VALUES ('1lw9c5c2369f616bfc','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',3,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:58','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('35mc85c236a91318dd','courriers_avec2018/moroko_jean/26-12-2018/0_Transport_aérien/DETOH_KOUASSI_P-C_MBAHIA-250441.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:33','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('4d7g55c236a983c774','courriers_avec2018/moroko_jean/26-12-2018/0_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',1,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:40','gatzs5c2352579b952','9m3ad5c2352579abe8'),('53nfk5c23689b5cdd9','courriers_avec2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',1,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:40:11','qd34x5c235257afce3','w9pwt5c235257aee54'),('at3fh5c236bfe74f9a','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',2,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:38','gatzs5c2352579b952','oip6j5c2352812d3bc'),('ax2985c2369c9169f6','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',2,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:13','qd34x5c235257afce3','w9pwt5c235257aee54'),('bfspd5c236be1b0a53','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',3,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:09','gatzs5c2352579b952','9m3ad5c2352579abe8'),('dh6so5c236a8d61b09','courriers_avec2018/moroko_jean/26-12-2018/0_Transport_aérien/DETOH_KOUASSI_P-C_MBAHIA-250441.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:48:29','qd34x5c235257afce3','w9pwt5c235257aee54'),('hotqx5c236c01ee638','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',4,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:54:41','gatzs5c2352579b952','9m3ad5c2352579abe8'),('ibn055c236c3a7a7a7','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',5,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:55:38','gatzs5c2352579b952','9m3ad5c2352579abe8'),('n200x5c23b10fe490c','courriers_avec2018/moroko_jean/26-12-2018/0_Transport_aérien/DETOH_KOUASSI_P-C_MBAHIA-250441.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',6,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 16:49:19','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('r5mc5c2369c8bd562','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',2,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:12','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('rdjsi5c236bd587b7d','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',1,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:53:57','gatzs5c2352579b952','oip6j5c2352812d3bc'),('sjnel5c236a1e70bdb','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',4,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:46:38','qd34x5c235257afce3','w9pwt5c235257aee54'),('w7wc85c2369f658624','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-2_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',3,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:45:58','qd34x5c235257afce3','w9pwt5c235257aee54'),('xfxif5c236a1e37ee4','courriers_sans2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',4,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:46:38','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('xhzpj5c23689ac4b6b','courriers_avec2018/moroko_jean/26-12-2018/DETOH_KOUASSI_P-C_MBAHIA/DETOH_KOUASSI_P-C_MBAHIA-250441-4_2018.pdf','Libelle branche : Transport aérien | client : DETOH KOUASSI P/C MBAHIA | numero de police : 250441 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 2561339',1,'Moroko Jean-courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:40:10','qd34x5c235257afce3','l1rlo5c2352812e2cd'),('z4bfm5c236b2d9ebc6','courriers_sans2018/moroko_jean/26-12-2018/1_Auto/DETOH_KOUASSI_ALEXIS-285973.pdf','Libelle branche : Auto | client : DETOH KOUASSI ALEXIS | numero de police : 285973 | Periode : 2018-01-01 - 2018-12-31 | Prime TTC : 38928',2,'courriers-du-26-12-2018.zip','enable','rytjykhjuyj','2018-12-26 11:51:09','gatzs5c2352579b952','9m3ad5c2352579abe8');
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
INSERT INTO `t_facture` VALUES ('9m3ad5c2352579abe8',1,'285973',2018,'2018-01-01','2018-12-31',38928,7,3315000,'enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL,'moox15c2352579af12','gatzs5c2352579b952'),('d47235c24b08f53d76',2,'test',2018,'2019-07-05','2019-02-27',7000,7,15556565,'enable','cfghj5c24ac0a21fc4','2018-12-27 10:59:27',NULL,NULL,'87do65c235257af31c','gatzs5c2352579b952'),('i9bp15c24b21785072',1,'154522',2018,'2018-12-04','2018-12-31',1556556,7,86524565,'enable','zw6k5b71676038ed8','2018-12-27 11:05:59',NULL,NULL,'moox15c2352579af12','gatzs5c2352579b952'),('k4lq25c24b067bab03',1,'test',2018,'2018-12-05','2018-12-27',7000,7,15556565,'enable','cfghj5c24ac0a21fc4','2018-12-27 10:58:47',NULL,NULL,'87do65c235257af31c','gatzs5c2352579b952'),('l1rlo5c2352812e2cd',4,'250441',2018,'2018-01-01','2018-12-31',2561339,14.5,1310625,'enable','rytjykhjuyj','2018-12-26 10:05:53',NULL,NULL,'87do65c235257af31c','qd34x5c235257afce3'),('m9z05c24b4a9ba997',6,'254',2018,'2018-12-18','2018-12-27',365652,7,56565,'enable','zw6k5b71676038ed8','2018-12-27 11:16:57',NULL,NULL,'87do65c235257af31c','gatzs5c2352579b952'),('mw0d35c24b50cf11c2',7,'254',2018,'2018-12-18','2016-09-27',365652,7,56565,'enable','zw6k5b71676038ed8','2018-12-27 11:18:36',NULL,NULL,'87do65c235257af31c','gatzs5c2352579b952'),('oip6j5c2352812d3bc',3,'285973',2018,'2018-01-01','2018-12-31',38928,7,3315000,'enable','rytjykhjuyj','2018-12-26 10:05:53',NULL,NULL,'moox15c2352579af12','gatzs5c2352579b952'),('p15zj5c24b00b56d94',5,'15000',2018,'2019-05-27','2019-02-27',70555,7,25855,'enable','rytjykhjuyj','2018-12-27 10:57:15',NULL,NULL,'87do65c235257af31c','gatzs5c2352579b952'),('w9pwt5c235257aee54',2,'250441',2018,'2018-01-01','2018-12-31',2561339,14,1310625,'enable','rytjykhjuyj','2018-12-26 10:05:11',NULL,NULL,'87do65c235257af31c','qd34x5c235257afce3');
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
  `dt_UPDATED` datetime DEFAULT NULL,
  `lg_SERVICE_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`str_SECURITY_ID`),
  KEY `lg_SERVICE_ID` (`lg_SERVICE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_security`
--

LOCK TABLES `t_security` WRITE;
/*!40000 ALTER TABLE `t_security` DISABLE KEYS */;
INSERT INTO `t_security` VALUES ('cfghj5c24ac0a21fc4','firmin','4DA337E065B055CE886297B17891210397C680F30195F1601FB3CA6A36A9F9E2','Firmin','Koffi','firmin.koffi@sunu-group.com','opt','enable','rytjykhjuyj','2018-12-27 10:40:10','rytjykhjuyj','2018-12-27 10:45:08','pbe835c24a65e18091'),('rytjykhjuyj','root','8428F14AF59502776F008A1AC0F6377867DDF6DA0B099B416687F75C20786966','Moroko','Jean','morokojeanr@gmail.com','admin','enable','root','2018-08-08 00:00:00','rytjykhjuyj','2018-10-11 15:04:59','r6md45c24ab9dde863'),('zw6k5b71676038ed8','hendrick','FBD02A2AAC23A697323D16CFD127FEF89CF369B6037DB672BBE8AD2327C91787','TENIN','HENDRICK','hendrick.tenin@sunu-group.com','dec','enable','rytjykhjuyj','2018-08-13 11:11:28','rytjykhjuyj','2018-12-27 11:00:12','r6md45c24ab9dde863');
/*!40000 ALTER TABLE `t_security` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_service`
--

DROP TABLE IF EXISTS `t_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_service` (
  `lg_SERVICE_ID` varchar(20) NOT NULL,
  `str_LIBELLE` varchar(45) DEFAULT NULL,
  `str_STATUT` varchar(45) DEFAULT NULL,
  `str_CREATED_BY` varchar(45) DEFAULT NULL,
  `dt_CREATED` datetime DEFAULT NULL,
  `str_UPDATED_BY` varchar(45) DEFAULT NULL,
  `dt_UPDATED` datetime DEFAULT NULL,
  PRIMARY KEY (`lg_SERVICE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_service`
--

LOCK TABLES `t_service` WRITE;
/*!40000 ALTER TABLE `t_service` DISABLE KEYS */;
INSERT INTO `t_service` VALUES ('e6p7s5c24a683c23cb','Transport','enable','rytjykhjuyj','2018-12-27 10:16:35','rytjykhjuyj','2018-12-27 10:17:09'),('pbe835c24a65e18091','Gros risque','enable','rytjykhjuyj','2018-12-27 10:15:58','rytjykhjuyj','2018-12-27 10:17:04'),('r6md45c24ab9dde863','Etude et projet','enable','rytjykhjuyj','2018-12-27 10:38:21',NULL,NULL);
/*!40000 ALTER TABLE `t_service` ENABLE KEYS */;
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

-- Dump completed on 2018-12-27 11:24:50
