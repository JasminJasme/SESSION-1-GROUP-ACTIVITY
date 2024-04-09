-- MySQL dump 10.13  Distrib 8.0.14, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: session1
-- ------------------------------------------------------
-- Server version	8.0.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assetgroups`
--

DROP TABLE IF EXISTS `assetgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `assetgroups` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assetgroups`
--

LOCK TABLES `assetgroups` WRITE;
/*!40000 ALTER TABLE `assetgroups` DISABLE KEYS */;
INSERT INTO `assetgroups` VALUES (1,'Hydraulic'),(3,'Electrical'),(4,'Mechanical ');
/*!40000 ALTER TABLE `assetgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assetphotos`
--

DROP TABLE IF EXISTS `assetphotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `assetphotos` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AssetID` bigint(20) NOT NULL,
  `AssetPhoto` blob NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_AssetPhotos_Assets` (`AssetID`),
  CONSTRAINT `FK_AssetPhotos_Assets` FOREIGN KEY (`AssetID`) REFERENCES `assets` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assetphotos`
--

LOCK TABLES `assetphotos` WRITE;
/*!40000 ALTER TABLE `assetphotos` DISABLE KEYS */;
/*!40000 ALTER TABLE `assetphotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `assets` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AssetSN` varchar(20) COLLATE utf8_bin NOT NULL,
  `AssetName` varchar(150) COLLATE utf8_bin NOT NULL,
  `DepartmentLocationID` bigint(20) NOT NULL,
  `EmployeeID` bigint(20) NOT NULL,
  `AssetGroupID` bigint(20) NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `WarrantyDate` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Assets_Employees` (`EmployeeID`),
  KEY `FK_Assets_AssetGroups` (`AssetGroupID`),
  KEY `FK_Assets_DepartmentLocations` (`DepartmentLocationID`),
  CONSTRAINT `FK_Assets_AssetGroups` FOREIGN KEY (`AssetGroupID`) REFERENCES `assetgroups` (`ID`),
  CONSTRAINT `FK_Assets_DepartmentLocations` FOREIGN KEY (`DepartmentLocationID`) REFERENCES `departmentlocations` (`ID`),
  CONSTRAINT `FK_Assets_Employees` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,'05/04/0001','Toyota Hilux FAF321',3,5,4,'',NULL),(2,'04/03/0001','Suction Line 852',7,8,3,'','2020-03-02'),(3,'01/01/0001','ZENY 3,5CFM Single-Stage 5 Pa Rotary Vane',11,22,1,'','2018-01-17'),(4,'05/04/0002','Volvo FH16',4,26,4,'',NULL);
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assettransferlogs`
--

DROP TABLE IF EXISTS `assettransferlogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `assettransferlogs` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AssetID` bigint(20) NOT NULL,
  `TransferDate` date NOT NULL,
  `FromAssetSN` varchar(20) COLLATE utf8_bin NOT NULL,
  `ToAssetSN` varchar(20) COLLATE utf8_bin NOT NULL,
  `FromDepartmentLocationID` bigint(20) NOT NULL,
  `ToDepartmentLocationID` bigint(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_AssetTransferLogs_DepartmentLocations` (`FromDepartmentLocationID`),
  KEY `FK_AssetTransferLogs_DepartmentLocations1` (`ToDepartmentLocationID`),
  KEY `FK_AssetTransfers_Assets` (`AssetID`),
  CONSTRAINT `FK_AssetTransferLogs_DepartmentLocations` FOREIGN KEY (`FromDepartmentLocationID`) REFERENCES `departmentlocations` (`ID`),
  CONSTRAINT `FK_AssetTransferLogs_DepartmentLocations1` FOREIGN KEY (`ToDepartmentLocationID`) REFERENCES `departmentlocations` (`ID`),
  CONSTRAINT `FK_AssetTransfers_Assets` FOREIGN KEY (`AssetID`) REFERENCES `assets` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assettransferlogs`
--

LOCK TABLES `assettransferlogs` WRITE;
/*!40000 ALTER TABLE `assettransferlogs` DISABLE KEYS */;
INSERT INTO `assettransferlogs` VALUES (1,1,'2012-01-09','04/04/0002','05/04/0001',7,4),(2,3,'2014-02-02','03/01/0001','01/01/0001',8,11);
/*!40000 ALTER TABLE `assettransferlogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departmentlocations`
--

DROP TABLE IF EXISTS `departmentlocations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `departmentlocations` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `DepartmentID` bigint(20) NOT NULL,
  `LocationID` bigint(20) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_DepartmentLocations_Departments` (`DepartmentID`),
  KEY `FK_DepartmentLocations_Locations` (`LocationID`),
  CONSTRAINT `FK_DepartmentLocations_Departments` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`ID`),
  CONSTRAINT `FK_DepartmentLocations_Locations` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departmentlocations`
--

LOCK TABLES `departmentlocations` WRITE;
/*!40000 ALTER TABLE `departmentlocations` DISABLE KEYS */;
INSERT INTO `departmentlocations` VALUES (1,6,3,'2010-12-28','2011-01-20'),(2,6,2,'2015-12-27','2019-08-20'),(3,5,2,'1996-04-29',NULL),(4,5,1,'2002-03-04',NULL),(5,5,1,'1991-03-25','2001-10-30'),(6,4,3,'2012-05-28',NULL),(7,4,2,'2005-05-04',NULL),(8,3,2,'1992-10-17',NULL),(9,3,3,'2000-01-08',NULL),(10,2,1,'1993-12-25',NULL),(11,1,2,'2005-11-11',NULL),(12,1,2,'1991-01-17','2000-02-02');
/*!40000 ALTER TABLE `departmentlocations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `departments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Exploration'),(2,'Production'),(3,'Transportation'),(4,'R&D'),(5,'Distribution'),(6,'QHSE');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `employees` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) COLLATE utf8_bin NOT NULL,
  `LastName` varchar(50) COLLATE utf8_bin NOT NULL,
  `Phone` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Martina','Winegarden','69232044381'),(2,'Rashida','Brammer','70687629632'),(3,'Mohamed','Krall','52688435003'),(4,'Shante','Karr','73706803851'),(5,'Rosaura','Rames','70477806324'),(6,'Toi','Courchesne','37756763508'),(7,'Precious','Wismer','15287468908'),(8,'Josefa','Otte','68886927765'),(9,'Afton','Harrington','41731972558'),(10,'Daphne','Morrow','49099375842'),(11,'Dottie','Polson','91205317719'),(12,'Alleen','Nally','26312971918'),(13,'Hilton','Odom','66197770749'),(14,'Shawn','Hillebrand','64091780262'),(15,'Lorelei','Kettler','73606665126'),(16,'Jalisa','Gossage','10484197749'),(17,'Germaine','Sim','62454794026'),(18,'Suzanna','Wollman','97932678482'),(19,'Jennette','Besse','26229712670'),(20,'Margherita','Anstine','87423893204'),(21,'Earleen','Lambright','64658700776'),(22,'Lyn','Valdivia','32010885662'),(23,'Alycia','Couey','41716866650'),(24,'Lewis','Rousey','16716397946'),(25,'Tanja','Profitt','77230010211'),(26,'Cherie','Whyte','33510813739'),(27,'Efren','Leaf','72090665294'),(28,'Delta','Darcangelo','73136120450'),(29,'Jess','Bodnar','12207277240'),(30,'Sudie','Parkhurst','26842289705');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locations` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Kazan'),(2,'Volka'),(3,'Moscow');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-21 17:29:23
