-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: HCDX
-- ------------------------------------------------------
-- Server version	5.1.73-log

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
-- Table structure for table `Articles`
--

DROP TABLE IF EXISTS `Articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Articles` (
  `k` int(11) NOT NULL AUTO_INCREMENT,
  `Author` varchar(100) NOT NULL DEFAULT '',
  `Body` text NOT NULL,
  `Headers` int(11) NOT NULL DEFAULT '0',
  `Category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`k`),
  KEY `Headers` (`Headers`),
  KEY `Category` (`Category`),
  KEY `Author` (`Author`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Bands`
--

DROP TABLE IF EXISTS `Bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bands` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Start` float DEFAULT NULL,
  `End` float DEFAULT NULL,
  `oid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categories` (
  `k` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Category` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`k`),
  UNIQUE KEY `k` (`k`),
  KEY `k_2` (`k`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Countries`
--

DROP TABLE IF EXISTS `Countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Countries` (
  `k` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ThreeLetterISO` char(3) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Capital` varchar(100) DEFAULT NULL,
  `Category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30') DEFAULT NULL,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DatesMenu`
--

DROP TABLE IF EXISTS `DatesMenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DatesMenu` (
  `Dates` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`Dates`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ITU`
--

DROP TABLE IF EXISTS `ITU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ITU` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(5) NOT NULL DEFAULT '',
  `english` varchar(64) NOT NULL DEFAULT '',
  `finnish` varchar(64) DEFAULT NULL,
  `swedish` varchar(64) DEFAULT NULL,
  `category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','20') NOT NULL DEFAULT '20',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `Code` (`Code`),
  UNIQUE KEY `Name` (`english`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MailOut`
--

DROP TABLE IF EXISTS `MailOut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MailOut` (
  `mail_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_zone` varchar(20) DEFAULT NULL,
  `mail_from` varchar(120) NOT NULL DEFAULT '',
  `reply` varchar(120) DEFAULT NULL,
  `mail_to` text,
  `cc` text,
  `sbj` varchar(200) DEFAULT NULL,
  `txt` mediumtext NOT NULL,
  `file` varchar(64) NOT NULL DEFAULT '',
  `hash` int(11) NOT NULL DEFAULT '0',
  `Category` varchar(50) NOT NULL DEFAULT 'Misc',
  `sid` varchar(20) DEFAULT NULL,
  `submitted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mail_from`,`date`,`hash`),
  KEY `mail_id` (`mail_id`),
  KEY `mail_from` (`mail_from`),
  KEY `date` (`date`),
  KEY `time_zone` (`time_zone`),
  KEY `mail_from_2` (`mail_from`),
  KEY `reply` (`reply`),
  KEY `sbj` (`sbj`),
  KEY `file` (`file`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mails`
--

DROP TABLE IF EXISTS `Mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mails` (
  `mail_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_zone` varchar(20) DEFAULT NULL,
  `mail_from` varchar(120) NOT NULL DEFAULT '',
  `reply` varchar(120) DEFAULT NULL,
  `mail_to` text,
  `cc` text,
  `sbj` varchar(200) DEFAULT NULL,
  `txt` mediumtext NOT NULL,
  `file` varchar(64) NOT NULL DEFAULT '',
  `hash` varchar(100) NOT NULL DEFAULT '0',
  `Category` varchar(50) NOT NULL DEFAULT 'Misc',
  `sid` varchar(20) DEFAULT NULL,
  `submitted` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(200) DEFAULT NULL,
  UNIQUE KEY `hash` (`hash`),
  UNIQUE KEY `sid` (`sid`),
  KEY `mail_id` (`mail_id`),
  KEY `mail_from` (`mail_from`),
  KEY `date` (`date`),
  KEY `time_zone` (`time_zone`),
  KEY `mail_from_2` (`mail_from`),
  KEY `reply` (`reply`),
  KEY `sbj` (`sbj`),
  KEY `file` (`file`)
) ENGINE=MyISAM AUTO_INCREMENT=195049 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MailsIn`
--

DROP TABLE IF EXISTS `MailsIn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MailsIn` (
  `mail_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_zone` varchar(20) DEFAULT NULL,
  `mail_from` varchar(120) NOT NULL DEFAULT '',
  `reply` varchar(120) DEFAULT NULL,
  `mail_to` text,
  `cc` text,
  `sbj` varchar(200) DEFAULT NULL,
  `txt` mediumtext NOT NULL,
  `file` varchar(64) NOT NULL DEFAULT '',
  `hash` varchar(100) NOT NULL DEFAULT '0',
  `Category` varchar(50) NOT NULL DEFAULT 'Misc',
  `sid` varchar(20) DEFAULT NULL,
  `submitted` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`mail_id`),
  UNIQUE KEY `hash` (`hash`),
  KEY `mail_from` (`mail_from`),
  KEY `time_zone` (`time_zone`),
  KEY `file` (`file`),
  KEY `submitted` (`submitted`)
) ENGINE=MyISAM AUTO_INCREMENT=195049 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MailsInNew`
--

DROP TABLE IF EXISTS `MailsInNew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MailsInNew` (
  `mail_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_zone` varchar(20) DEFAULT NULL,
  `mail_from` varchar(120) NOT NULL DEFAULT '',
  `reply` varchar(120) DEFAULT NULL,
  `mail_to` text,
  `cc` text,
  `sbj` varchar(200) DEFAULT NULL,
  `txt` mediumtext NOT NULL,
  `file` varchar(64) NOT NULL DEFAULT '',
  `hash` varchar(100) NOT NULL DEFAULT '0',
  `Category` varchar(50) NOT NULL DEFAULT 'Misc',
  `sid` varchar(20) DEFAULT NULL,
  `submitted` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(200) DEFAULT NULL,
  KEY `mail_id` (`mail_id`),
  KEY `mail_from` (`mail_from`),
  KEY `date` (`date`),
  KEY `time_zone` (`time_zone`),
  KEY `mail_from_2` (`mail_from`),
  KEY `reply` (`reply`),
  KEY `sbj` (`sbj`),
  KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contests`
--

DROP TABLE IF EXISTS `contests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests` (
  `name` varchar(25) NOT NULL,
  `countries` int(11) NOT NULL,
  `stations` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `moderated` enum('Y','N') NOT NULL DEFAULT 'N',
  `owner` varchar(50) NOT NULL,
  `Status` varchar(16) NOT NULL DEFAULT 'Active',
  `Description` varchar(50) NOT NULL,
  `dateformat` varchar(30) NOT NULL DEFAULT 'Universal',
  `language` varchar(30) NOT NULL DEFAULT 'english',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `handles`
--

DROP TABLE IF EXISTS `handles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `handles` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `login` int(11) NOT NULL DEFAULT '0',
  `handle` varchar(32) NOT NULL DEFAULT '',
  `dates` varchar(32) NOT NULL DEFAULT '',
  `QTH` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(32) NOT NULL DEFAULT '',
  `maturity` enum('alpha','beta','prod') NOT NULL DEFAULT 'alpha',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `FQ` double NOT NULL DEFAULT '0',
  `polarisation` enum('V','H','R','L','X') DEFAULT NULL,
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `StartUTC` varchar(8) DEFAULT NULL,
  `EndUTC` varchar(8) DEFAULT NULL,
  `SortUTC` varchar(8) NOT NULL,
  `StartUTCStar` tinyint(4) DEFAULT NULL,
  `EndUTCStar` tinyint(4) DEFAULT NULL,
  `Category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30') DEFAULT NULL,
  `Country` varchar(64) NOT NULL DEFAULT '',
  `Country_id` smallint(11) NOT NULL DEFAULT '0',
  `StationQTH` varchar(128) DEFAULT NULL,
  `Comments` text,
  `Listener` varchar(64) NOT NULL DEFAULT '',
  `ListenerOld` varchar(64) DEFAULT NULL,
  `ListenerHandle` varchar(128) NOT NULL DEFAULT '',
  `ListenerCountry` int(11) NOT NULL DEFAULT '0',
  `RootURL` varchar(128) NOT NULL DEFAULT '',
  `Added` int(11) DEFAULT NULL,
  `k` int(11) NOT NULL AUTO_INCREMENT,
  `QSL` text,
  `UNIQUE_ID` varchar(64) NOT NULL DEFAULT '00000000',
  `Modified` varchar(20) DEFAULT NULL,
  `Status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `Plus` varchar(10) DEFAULT NULL,
  `Underline` varchar(3) NOT NULL,
  `Tentative` varchar(10) DEFAULT NULL,
  `PvmFinnish` varchar(32) DEFAULT NULL,
  `published_in` set('clusive','radiomaailma','hcdxweb') DEFAULT NULL,
  `pubcodes` varchar(128) NOT NULL DEFAULT 'none',
  `usergroup` varchar(32) NOT NULL DEFAULT 'Finland',
  `usergroupset` set('hcdx','Finland','Unknown') NOT NULL DEFAULT 'Unknown',
  `vihje` enum('y','n') NOT NULL DEFAULT 'n',
  `GridListener` varchar(6) NOT NULL DEFAULT '',
  `GridStation` varchar(6) NOT NULL DEFAULT '',
  `PropagationMode` varchar(12) DEFAULT NULL,
  `QSLDate` date DEFAULT NULL,
  `QSLInfo` tinyblob,
  PRIMARY KEY (`k`),
  UNIQUE KEY `k` (`k`),
  KEY `FQ` (`FQ`),
  KEY `Date` (`Date`),
  KEY `Category` (`Category`),
  KEY `Modified` (`Modified`),
  KEY `Status` (`Status`),
  KEY `StartUTC` (`StartUTC`),
  KEY `EndUTC` (`EndUTC`),
  KEY `Plus` (`Plus`),
  KEY `country_id` (`Country_id`),
  KEY `Country` (`Country`),
  KEY `Listener` (`Listener`),
  KEY `UNIQUE_ID` (`UNIQUE_ID`),
  KEY `pubcodes` (`pubcodes`),
  KEY `ListenerHandle` (`ListenerHandle`),
  KEY `RootURL` (`RootURL`),
  KEY `ListenerCountry` (`ListenerCountry`),
  KEY `Tentative` (`Tentative`),
  KEY `Added` (`Added`),
  KEY `ListenerOld` (`ListenerOld`),
  KEY `usergroupset` (`usergroupset`),
  KEY `usergroup` (`usergroup`),
  KEY `GridListener` (`GridListener`),
  KEY `GridStation` (`GridStation`),
  KEY `polarisation` (`polarisation`),
  KEY `Underline` (`Underline`),
  KEY `Underline_2` (`Underline`),
  KEY `PropagationMode` (`PropagationMode`),
  KEY `Listener_2` (`Listener`)
) ENGINE=InnoDB AUTO_INCREMENT=168370 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log2`
--

DROP TABLE IF EXISTS `log2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log2` (
  `FQ` double NOT NULL DEFAULT '0',
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `StartUTC` varchar(8) DEFAULT NULL,
  `EndUTC` varchar(8) DEFAULT NULL,
  `StartUTCStar` tinyint(4) DEFAULT NULL,
  `EndUTCStar` tinyint(4) DEFAULT NULL,
  `Category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30') DEFAULT NULL,
  `Country` varchar(64) NOT NULL DEFAULT '',
  `Country_id` smallint(11) NOT NULL DEFAULT '0',
  `StationQTH` varchar(128) DEFAULT NULL,
  `Comments` text,
  `Listener` varchar(64) NOT NULL DEFAULT '',
  `ListenerOld` varchar(64) DEFAULT NULL,
  `ListenerHandle` varchar(128) NOT NULL DEFAULT '',
  `ListenerCountry` int(11) NOT NULL DEFAULT '0',
  `RootURL` varchar(128) NOT NULL DEFAULT '',
  `Added` int(11) DEFAULT NULL,
  `k` int(11) NOT NULL AUTO_INCREMENT,
  `QSL` text,
  `UNIQUE_ID` varchar(64) NOT NULL DEFAULT '00000000',
  `Modified` varchar(20) DEFAULT NULL,
  `Status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `Plus` varchar(10) DEFAULT NULL,
  `Tentative` varchar(10) DEFAULT NULL,
  `PvmFinnish` varchar(32) DEFAULT NULL,
  `published_in` set('clusive','radiomaailma','hcdxweb') DEFAULT NULL,
  `pubcodes` varchar(128) NOT NULL DEFAULT 'none',
  `usergroup` varchar(32) NOT NULL DEFAULT 'Finland',
  `usergroupset` set('hcdx','Finland','Unknown') NOT NULL DEFAULT 'Unknown',
  `vihje` enum('y','n') NOT NULL DEFAULT 'n',
  `GridListener` varchar(6) NOT NULL DEFAULT '',
  `GridStation` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`k`),
  UNIQUE KEY `k` (`k`),
  KEY `FQ` (`FQ`),
  KEY `Date` (`Date`),
  KEY `Category` (`Category`),
  KEY `Modified` (`Modified`),
  KEY `Status` (`Status`),
  KEY `StartUTC` (`StartUTC`),
  KEY `EndUTC` (`EndUTC`),
  KEY `Plus` (`Plus`),
  KEY `country_id` (`Country_id`),
  KEY `Country` (`Country`),
  KEY `Listener` (`Listener`),
  KEY `UNIQUE_ID` (`UNIQUE_ID`),
  KEY `pubcodes` (`pubcodes`),
  KEY `ListenerHandle` (`ListenerHandle`),
  KEY `RootURL` (`RootURL`),
  KEY `ListenerCountry` (`ListenerCountry`),
  KEY `Tentative` (`Tentative`),
  KEY `Added` (`Added`),
  KEY `ListenerOld` (`ListenerOld`),
  KEY `usergroupset` (`usergroupset`),
  KEY `usergroup` (`usergroup`),
  KEY `GridListener` (`GridListener`),
  KEY `GridStation` (`GridStation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logtest`
--

DROP TABLE IF EXISTS `logtest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logtest` (
  `FQ` double NOT NULL DEFAULT '0',
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `StartUTC` time DEFAULT NULL,
  `EndUTC` time DEFAULT NULL,
  `StartUTCStar` tinyint(4) DEFAULT NULL,
  `EndUTCStar` tinyint(4) DEFAULT NULL,
  `Category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30') DEFAULT NULL,
  `Country` varchar(64) NOT NULL DEFAULT '',
  `Country_id` smallint(11) NOT NULL DEFAULT '0',
  `StationQTH` varchar(128) DEFAULT NULL,
  `Comments` text,
  `Listener` varchar(64) NOT NULL DEFAULT '',
  `ListenerOld` varchar(64) DEFAULT NULL,
  `ListenerHandle` varchar(128) NOT NULL DEFAULT '',
  `ListenerCountry` int(11) NOT NULL DEFAULT '0',
  `RootURL` varchar(128) NOT NULL DEFAULT '',
  `Added` int(11) DEFAULT NULL,
  `k` int(11) NOT NULL AUTO_INCREMENT,
  `QSL` text,
  `UNIQUE_ID` varchar(64) NOT NULL DEFAULT '00000000',
  `Modified` varchar(20) DEFAULT NULL,
  `Status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `Plus` varchar(10) DEFAULT NULL,
  `Tentative` varchar(10) DEFAULT NULL,
  `PvmFinnish` varchar(32) DEFAULT NULL,
  `published_in` set('clusive','radiomaailma','hcdxweb') DEFAULT NULL,
  `pubcodes` varchar(128) NOT NULL DEFAULT 'none',
  `usergroup` varchar(32) NOT NULL DEFAULT 'Finland',
  `usergroupset` set('hcdx','Finland','Unknown') NOT NULL DEFAULT 'Unknown',
  `logtype` enum('vihje','logging','undefined') NOT NULL DEFAULT 'logging',
  `vihje` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`k`),
  UNIQUE KEY `k` (`k`),
  KEY `FQ` (`FQ`),
  KEY `Date` (`Date`),
  KEY `Category` (`Category`),
  KEY `Modified` (`Modified`),
  KEY `Status` (`Status`),
  KEY `StartUTC` (`StartUTC`),
  KEY `EndUTC` (`EndUTC`),
  KEY `Plus` (`Plus`),
  KEY `country_id` (`Country_id`),
  KEY `Country` (`Country`),
  KEY `Listener` (`Listener`),
  KEY `UNIQUE_ID` (`UNIQUE_ID`),
  KEY `StationQTH` (`StationQTH`),
  KEY `pubcodes` (`pubcodes`),
  KEY `ListenerHandle` (`ListenerHandle`),
  KEY `RootURL` (`RootURL`),
  KEY `ListenerCountry` (`ListenerCountry`),
  KEY `Tentative` (`Tentative`),
  KEY `Added` (`Added`),
  KEY `ListenerOld` (`ListenerOld`),
  KEY `usergroupset` (`usergroupset`),
  KEY `usergroup` (`usergroup`),
  KEY `logtype` (`logtype`),
  KEY `vihje` (`vihje`)
) ENGINE=MyISAM AUTO_INCREMENT=9175 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nimimerkit`
--

DROP TABLE IF EXISTS `nimimerkit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nimimerkit` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `nimimerkki` varchar(16) NOT NULL DEFAULT '',
  `owner` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `nimimerkki` (`nimimerkki`),
  KEY `nid` (`nid`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rxmodels`
--

DROP TABLE IF EXISTS `rxmodels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rxmodels` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(128) NOT NULL DEFAULT '',
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rxs`
--

DROP TABLE IF EXISTS `rxs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rxs` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stations`
--

DROP TABLE IF EXISTS `stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stations` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `FQ` double NOT NULL DEFAULT '0',
  `Polarisation` enum('X','V','H','R','L') NOT NULL DEFAULT 'V',
  `Category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30') NOT NULL DEFAULT '',
  `Country` varchar(64) NOT NULL DEFAULT '',
  `Country_id` smallint(6) NOT NULL DEFAULT '0',
  `StationQTH` varchar(128) NOT NULL DEFAULT '',
  `GridStation` varchar(6) NOT NULL DEFAULT '',
  `Notes` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`),
  KEY `Category` (`Category`),
  KEY `Country` (`Country`),
  KEY `GridStation` (`GridStation`),
  KEY `FQ` (`FQ`),
  KEY `Polarisation` (`Polarisation`)
) ENGINE=MyISAM AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stats` (
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `k` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `Name` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  `Equipment` text,
  PRIMARY KEY (`k`),
  KEY `login` (`login`),
  KEY `email` (`email`),
  KEY `Name` (`Name`),
  KEY `password` (`password`)
) ENGINE=MyISAM AUTO_INCREMENT=815814 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `texts`
--

DROP TABLE IF EXISTS `texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `texts` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(32) NOT NULL DEFAULT '',
  `english` varchar(128) NOT NULL DEFAULT '',
  `finnish` varchar(128) NOT NULL DEFAULT '',
  `swedish` varchar(128) NOT NULL DEFAULT '',
  `german` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `text` (`text`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) DEFAULT NULL,
  `Added` int(11) DEFAULT '0',
  `lastvisit` int(11) DEFAULT NULL,
  `lastvisitstart` int(11) DEFAULT NULL,
  `lastlastvisit` int(11) DEFAULT NULL,
  `visits` int(11) DEFAULT '0',
  `name` varchar(64) DEFAULT NULL,
  `City` varchar(64) DEFAULT NULL,
  `Country` varchar(32) DEFAULT NULL,
  `logformat` varchar(64) DEFAULT 'clusive',
  `countries_list` enum('own','all') DEFAULT 'all',
  `categories_list` enum('all','1','2','3','4','5','6','7','8','9','10','11','12','13','20') DEFAULT 'all',
  `admincategories` set('none','all','1','2','3','4','5','6','7','8','9','10','11','12','13','20') DEFAULT 'none',
  `language` varchar(32) DEFAULT 'english',
  `shortyear` enum('yes','no') DEFAULT 'no',
  `maturitylevel` varchar(16) DEFAULT 'prod',
  `dateformat` enum('European','American','Universal') DEFAULT 'Universal',
  `printyear` enum('Y','N') DEFAULT 'N',
  `bgcolor` varchar(12) NOT NULL DEFAULT '#ffff88',
  `countrypulldown` smallint(6) DEFAULT '0',
  `password` varchar(32) DEFAULT NULL,
  `lastcategoryadded` smallint(6) DEFAULT NULL,
  `lasthandleadded` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `usergroup` varchar(32) DEFAULT 'hcdx',
  `emailconfirmed` smallint(6) DEFAULT NULL,
  `joinapproved` int(10) unsigned NOT NULL DEFAULT '0',
  `random` varchar(50) DEFAULT NULL,
  `random2` varchar(50) DEFAULT NULL,
  `usergroupset` set('hcdx','Finland','Unknown') NOT NULL DEFAULT 'Unknown',
  `Active` smallint(6) NOT NULL DEFAULT '1',
  `warnings` tinyint(4) NOT NULL DEFAULT '0',
  `SDXLnimimerkki` varchar(8) NOT NULL DEFAULT '',
  `SDXLQTH` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `login` (`login`),
  KEY `city` (`City`),
  KEY `uid` (`uid`),
  KEY `usergroupset` (`usergroupset`),
  KEY `Active` (`Active`),
  KEY `joinapproved` (`joinapproved`),
  KEY `random` (`random`),
  KEY `random2` (`random2`),
  KEY `usergroup` (`usergroup`),
  KEY `emailconfirmed` (`emailconfirmed`),
  KEY `dateformat` (`dateformat`)
) ENGINE=MyISAM AUTO_INCREMENT=3286 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-26  2:16:09
-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: HCDX
-- ------------------------------------------------------
-- Server version	5.1.73-log

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
-- Table structure for table `texts`
--

DROP TABLE IF EXISTS `texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `texts` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(32) NOT NULL DEFAULT '',
  `english` varchar(128) NOT NULL DEFAULT '',
  `finnish` varchar(128) NOT NULL DEFAULT '',
  `swedish` varchar(128) NOT NULL DEFAULT '',
  `german` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `text` (`text`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `texts`
--

LOCK TABLES `texts` WRITE;
/*!40000 ALTER TABLE `texts` DISABLE KEYS */;
INSERT INTO `texts` VALUES (1,'bands','Bands','Aaltoalueet','bands',NULL),(2,'select_category','Please select the logging category','Ole hyvä ja valitse lokauskategoria','Välj område för hörda stationer',NULL),(3,'submit','Submit logging','Syötä lokaus','Skicka',NULL),(4,'delete','Delete logging','Hävitä lokaus','Radera hörd station',NULL),(5,'utc','UTC','UTC','UTC',NULL),(6,'month','Month','kuukausi','Månad',NULL),(7,'year','Year','vuosi','År',NULL),(8,'date','Date','päivä','Datum',NULL),(9,'start_utc','Start (UTC)','Alku (UTC)','Start (UTC)',NULL),(10,'end_utc','End (UTC)','Loppu (UTC)','Slut (UTC)',NULL),(11,'country','Country','maa','Land',NULL),(12,'station','Station','asema','Station',NULL),(13,'comments','Comments','kommentit','Kommentar',NULL),(14,'listener','Listener','kuuntelija','Lyssnare',NULL),(15,'edit','Edit','Editoi','Redigera',NULL),(16,'modified','Thank you! You modified following logging:','Kiitos! Seuraava lokaus on muokattu:','Tack, du har ändrat följande hörd station:',NULL),(17,'added','Thank you! You added following logging:','Kiitos! Lisäsit seuraavan lokauksen:','Tack, du har lagt till följande hörd station:',NULL),(18,'since','Days since added or modified','Päivää lisäyksestä tai modifioinnista','Välj period:',NULL),(19,'deleted','Successfully deleted this logging','Hävitit tämän lokauksen onnistuneesti','Hörd station raderad',NULL),(20,'wrong','Something is wrong. Bug?','Jotain on pielessä. Bug?','Nåt gick snett. Bugg?',NULL),(21,'couldnotconnect','Could not connect','En saanut yhteyttä','Ingen kontakt',NULL),(22,'chooselistener','Choose listener','Valitse kuuntelija','Välj lyssnare',NULL),(23,'choosecountry','Choose country','Valitse maa','Välj land',NULL),(24,'connectedsuccessfully','Connected successfully','Yhteys muodostettu','Kontakt OK',NULL),(25,'couldnotselectdatabase','Could not select database','En pysty valitsemaan tietokantaa','Kunde inte hitta databas',NULL),(26,'queryfailed','Query failed','Haku epäonnistui','Förfrågan misslyckades',NULL),(27,'frequency','Frequency','taajuus','Frekvens',NULL),(28,'category1','Europe','Eurooppa','Europa',NULL),(29,'category2','British Isles','Brittein saaret','Storbritannien',NULL),(30,'category3','Iberia','Iberia','Spanien',NULL),(31,'category4','Africa','Afrikka','Afrika',NULL),(32,'category5','Asia','Aasia','Asien',NULL),(33,'category6','Oceania','Oseania','Oceanien',NULL),(34,'category7','North America','Pohjois-Amerikka','Nordamerika',NULL),(35,'category8','Central America','Keski-Amerikka','Centralamerika',NULL),(36,'category9','South America','Etelä-Amerikka','Sydamerika',NULL),(37,'category10','FM','FM','FM',NULL),(38,'category11','TV','TV','TV',NULL),(39,'category12','Pirate','Piraatit','Pirater',NULL),(40,'category13','Utility','Hyötyliikenne','Utility',NULL),(41,'register','Register as user','Rekisteroi käyttäjäksi','Registrera som användare',NULL),(42,'change_prefs','Change your preferences','Vaihda henkilökohtaisia asetuksiasi','Ändra inställningar',NULL),(43,'logout','Logout','Poistu järjestelmästä','Logga ut',NULL),(44,'view_todo','View project TODO','Lue projektin suunnitelmia (TODO)','Se projekt TODO',NULL),(45,'add_log','Add log entry','Lisää lokaus','Lägg till post',NULL),(46,'view_log','View log','Hae loki','Kolla logg poster',NULL),(47,'last','Last','Viimeiset','Sista',NULL),(48,'days','Days','päivää','Dagar',NULL),(49,'current','Current','Nykyinen','Aktuell',NULL),(50,'day','Day','päivä','Dag',NULL),(51,'choose_fq','Choose frequency','Valitse taajuus','Välj frekvens',NULL),(52,'choose_date','Choose date','Valitse päivä','Välj datum',NULL),(53,'choose_listener','Choose listener','Valitse kuuntelija','Välj lyssnare',NULL),(54,'all','All','Kaikki','Alla',NULL),(55,'Month1','January','tammikuu','januari',NULL),(56,'Month2','February','helmikuu','februari',NULL),(57,'Month3','March','maaliskuu','mars',NULL),(58,'Month4','April','huhtikuu','april',NULL),(59,'Month5','May','toukokuu','maj',NULL),(60,'Month6','June','kesäkuu','juni',NULL),(61,'Month7','July','heinäkuu','juli',NULL),(62,'Month8','August','elokuu','augusti',NULL),(63,'Month9','September','syyskuu','september',NULL),(64,'Month10','October','lokakuu','oktober',NULL),(65,'Month11','November','marraskuu','november',NULL),(66,'Month12','December','joulukuu','december',NULL),(67,'choose_language','Choose language','Valitse kieli','Välj språk',NULL),(68,'english','English','Englanti','engelska',NULL),(69,'finnish','Finnish','Suomi','finska',NULL),(70,'swedish','Swedish','Ruotsi','svenska',NULL),(71,'welcome','Welcome to log.hard-core-dx.com','Tervetuloa log.hard-core-dx.com:iin','Välkommen till log.hard-core-dx.com',NULL),(72,'german','German','Saksa','Tysk',NULL),(73,'editpreferences','Edit your preferences','Muokkaa asetuksiasi','',NULL),(74,'1','yes','Kyllä','Ja',NULL),(75,'0','No','Ei','Nej',NULL),(76,'logformat','Log format','Lokiformaatti','',NULL),(77,'shortyear','Date format short','Päivämäärät lyhyessä muodossa','',NULL),(78,'language','Language','Kieli','Språk',NULL),(79,'login','Account','Tunnus','',NULL),(80,'notyourlogging','This is not your logging','Tämä ei ole sinun lokaus','',NULL),(81,'previous','Previous','Edellinen','',NULL),(82,'listenedin','Listened in','Kuunteluaika','',NULL),(83,'search','Search','Hae','Sök',NULL),(84,'plus','+','+','+','+'),(85,'tentative','Tent.','Tent.','Tent.',NULL),(96,'endutcrange','UTC end range','UTC loppu aikaväli','Sluttid i UTC',NULL),(87,'startutcrange','UTC start range','UTC alku aikaväli','Starttid i UTC',NULL),(88,'sinceheard','Days since heard','Päivää kuulumisesta','Dagar sedan senast hörd',NULL),(89,'sincelastvisit','Loggings since your last visit','Viimeisen vierailusi jälkeiset lokaukset','Nytt sedan ditt senaste besök',NULL),(90,'exclude_listener','Exclude listener','Poista kuuntelija','Utlämna lyssnare',NULL),(91,'newer','Newer','Uudempi kuin','',NULL),(92,'older','Older','Vanhempi kuin','äldre',NULL),(93,'neweradd','Added after','Lisätty jälkeen','Nytt sedan',NULL),(94,'olderadd','Added before','Lisätty ennen','Nytt före',NULL),(95,'addloghelp','How to use this form','Kuinka tämä sivu tulisi täyttää (ohje englanniksi)','Hur du använder denna sida (engelsk text)',NULL),(97,'easy','easy','vihje','lätt',NULL),(98,'hours','hours','tuntia','timmar',''),(99,'format','Log Format','Lokiformaatti','',NULL),(100,'select_logformat','Choose the log format','Valitse lokiformaatti','Välj logformat',NULL),(101,'underline','Highlight','Alleviivaus','underline',NULL),(102,'','Functions','Toiminnot','Fuktioner',NULL),(103,'functions','Functions','Toiminnot','Funktioner',NULL),(104,'futurelog','The date is in future. Please correct.','Päivämäärä on tulevaisuudessa. Korjaus tarvitaan.','',NULL);
/*!40000 ALTER TABLE `texts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ITU`
--

DROP TABLE IF EXISTS `ITU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ITU` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(5) NOT NULL DEFAULT '',
  `english` varchar(64) NOT NULL DEFAULT '',
  `finnish` varchar(64) DEFAULT NULL,
  `swedish` varchar(64) DEFAULT NULL,
  `category` set('1','2','3','4','5','6','7','8','9','10','11','12','13','20') NOT NULL DEFAULT '20',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `Code` (`Code`),
  UNIQUE KEY `Name` (`english`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ITU`
--

LOCK TABLES `ITU` WRITE;
/*!40000 ALTER TABLE `ITU` DISABLE KEYS */;
INSERT INTO `ITU` VALUES (2,'X','NOT LISTED/MISSING',NULL,NULL,'1,2,3,4,5,6,7,8,9,10,11,12,13,20'),(3,'H2O','International Waters',NULL,NULL,'1,2,3,4,5,6,7,8,9,10,11,12,13,20'),(4,'AFG','Afghanistan',NULL,NULL,'5'),(5,'AFS','South Africa',NULL,NULL,'4'),(6,'AGL','Angola',NULL,NULL,'4'),(7,'ALB','Albania',NULL,NULL,'1'),(8,'ALG','Algeria',NULL,NULL,'4'),(9,'AND','Andorra',NULL,NULL,'3'),(10,'ARG','Argentina',NULL,NULL,'9'),(11,'ARM','Armenia',NULL,NULL,'5'),(12,'ARS','Saudi Arabia',NULL,NULL,'5'),(13,'ATG','Antigua and Barbuda',NULL,NULL,'8'),(14,'AUS','Australia',NULL,NULL,'1'),(15,'AUT','Austria',NULL,NULL,'1'),(16,'AZE','Azerbaijan',NULL,NULL,'5'),(17,'B','Brazil',NULL,NULL,'9'),(18,'BAH','Bahamas',NULL,NULL,'7'),(19,'BDI','Burundi',NULL,NULL,'4'),(20,'BEL','Belgium',NULL,NULL,'1'),(21,'BEN','Benin',NULL,NULL,'4'),(22,'BFA','Burkina Faso',NULL,NULL,'4'),(23,'BGD','Bangladesh',NULL,NULL,'5'),(24,'BHR','Bahrain',NULL,NULL,'5'),(25,'BIH','Bosnia and Herzegovina',NULL,NULL,'1'),(26,'BLR','Belarus',NULL,NULL,'1'),(27,'BLZ','Belize',NULL,NULL,'8'),(28,'BOL','Bolivia',NULL,NULL,'9'),(29,'BOT','Botswana',NULL,NULL,'4'),(30,'BRB','Barbados',NULL,NULL,'8'),(31,'BRM','Myanmar',NULL,NULL,'5'),(32,'BRU','Brunei Darussalam',NULL,NULL,'5'),(33,'BTN','Bhutan',NULL,NULL,'5'),(34,'BUL','Bulgaria',NULL,NULL,'1'),(35,'CAF','Central African Rep.',NULL,NULL,'4'),(36,'CAN','Canada',NULL,NULL,'7'),(37,'CBG','Cambodia',NULL,NULL,'5'),(38,'CHL','Chile',NULL,NULL,'9'),(39,'CHN','China',NULL,NULL,'5'),(40,'CLM','Colombia',NULL,NULL,'9'),(41,'CLN','Sri Lanka',NULL,NULL,'5'),(42,'CME','Cameroon',NULL,NULL,'4'),(43,'COD','Dem. Reb. of Congo',NULL,NULL,'4'),(44,'COG','Congo',NULL,NULL,'4'),(45,'COM','Comoros',NULL,NULL,'4'),(46,'CPV','Cape Verde',NULL,NULL,'4'),(47,'CTI','Côte d\'Ivoire',NULL,NULL,'4'),(48,'CTR','Costa Rica',NULL,NULL,'8'),(49,'CUB','Cuba',NULL,NULL,'8'),(50,'CVA','Vatican',NULL,NULL,'1'),(51,'CYP','Cyprus',NULL,NULL,'5'),(52,'CZE','Czech Republic',NULL,NULL,'1'),(53,'D','Germany','Saksa',NULL,'1'),(54,'DJI','Djibouti',NULL,NULL,'4'),(55,'DMA','Dominica',NULL,NULL,'8'),(56,'DNK','Denmark','Tanska',NULL,'1'),(57,'DOM','Dominican Rep.',NULL,NULL,'8'),(58,'E','Spain','Espanja',NULL,'3'),(59,'EGY','Egypt',NULL,NULL,'4'),(60,'EQA','Ecuador',NULL,NULL,'9'),(61,'ERI','Eritrea',NULL,NULL,'4'),(62,'EST','Estonia',NULL,NULL,'1'),(63,'ETH','Ethiopia',NULL,NULL,'4'),(64,'F','France',NULL,NULL,'1'),(65,'FIN','Finland','Suomi',NULL,'1'),(66,'FJI','Fiji',NULL,NULL,'6'),(67,'FSM','Micronesia',NULL,NULL,'6'),(68,'G','United Kingdom',NULL,NULL,'2'),(69,'GAB','Gabon',NULL,NULL,'4'),(70,'GEO','Georgia',NULL,NULL,'5'),(71,'GHA','Ghana',NULL,NULL,'4'),(72,'GMB','Gambia',NULL,NULL,'4'),(73,'GNB','Guinea-Bissau',NULL,NULL,'4'),(74,'GNE','Equatorial Guinea',NULL,NULL,'4'),(75,'GRC','Greece',NULL,NULL,'1'),(76,'GRD','Grenada',NULL,NULL,'8'),(77,'GTM','Guatemala',NULL,NULL,'8'),(78,'GUI','Guinea',NULL,NULL,'4'),(79,'GUY','Guyana',NULL,NULL,'9'),(80,'HND','Honduras',NULL,NULL,'8'),(81,'HNG','Hungary',NULL,NULL,'1'),(82,'HOL','Netherlands',NULL,NULL,'1'),(83,'HRV','Croatia',NULL,NULL,'1'),(84,'HTI','Haiti',NULL,NULL,'8'),(85,'I','Italy',NULL,NULL,'1'),(86,'IND','India','Intia',NULL,'5'),(87,'INS/A','Indonesia (Asia)','Indonesia (Aasia)',NULL,'5'),(88,'IRL','Ireland',NULL,NULL,'2'),(89,'IRN','Iran (Islamic Rep. of)',NULL,NULL,'5'),(90,'IRQ','Iraq',NULL,NULL,'5'),(91,'ISL','Iceland',NULL,NULL,'1'),(92,'ISR','Israel',NULL,NULL,'5'),(93,'J','Japan',NULL,NULL,'5'),(94,'JMC','Jamaica',NULL,NULL,'8'),(95,'JOR','Jordan',NULL,NULL,'5'),(96,'KAZ','Kazakhstan',NULL,NULL,'5'),(97,'KEN','Kenya',NULL,NULL,'4'),(98,'KGZ','Kyrgyz Republic',NULL,NULL,'5'),(99,'KIR','Kiribati',NULL,NULL,'6'),(100,'KOR','Korea (Rep. of)',NULL,NULL,'5'),(101,'KRE','Dem. People\'s Rep. of Korea',NULL,NULL,'5'),(102,'KWT','Kuwait',NULL,NULL,'5'),(103,'LAO','Lao P.D.R.',NULL,NULL,'5'),(104,'LBN','Lebanon',NULL,NULL,'5'),(105,'LBR','Liberia',NULL,NULL,'4'),(106,'LBY','Libya',NULL,NULL,'4'),(107,'LCA','Saint Lucia',NULL,NULL,'8'),(108,'LIE','Liechtenstein',NULL,NULL,'1'),(109,'LSO','Lesotho',NULL,NULL,'4'),(110,'LTU','Lithuania',NULL,NULL,'1'),(111,'LUX','Luxembourg',NULL,NULL,'1'),(112,'LVA','Latvia',NULL,NULL,'1'),(113,'MAU','Mauritius',NULL,NULL,'4'),(114,'MCO','Monaco',NULL,NULL,'1'),(115,'MDA','Moldava',NULL,NULL,'1'),(116,'MDG','Madagascar',NULL,NULL,'4'),(117,'MEX','Mexico',NULL,NULL,'8'),(118,'MHL','Marshall Islands',NULL,NULL,'6'),(119,'MKD','Macedonia',NULL,NULL,'1'),(120,'MLA','Malaysia',NULL,NULL,'5'),(121,'MLD','Maldives',NULL,NULL,'5'),(122,'MLI','Mali',NULL,NULL,'4'),(123,'MLT','Malta',NULL,NULL,'1'),(124,'MNG','Mongolia',NULL,NULL,'5'),(125,'MOZ','Mozambique',NULL,NULL,'4'),(126,'MRC','Morocco',NULL,NULL,'4'),(127,'MTN','Mauritania',NULL,NULL,'4'),(128,'MWI','Malawi',NULL,NULL,'4'),(129,'NCG','Nicaragua',NULL,NULL,'8'),(130,'NGR','Niger',NULL,NULL,'4'),(131,'NIG','Nigeria',NULL,NULL,'4'),(132,'NMB','Namibia',NULL,NULL,'4'),(133,'NOR','Norway',NULL,NULL,'1'),(134,'NPL','Nepal',NULL,NULL,'5'),(135,'NRU','Nauru',NULL,NULL,'6'),(136,'NZL','New Zealand',NULL,NULL,'6'),(137,'OMA','Oman',NULL,NULL,'5'),(138,'PAK','Pakistan',NULL,NULL,'5'),(139,'PHL','Philippines',NULL,NULL,'5'),(140,'PNG','Papua New Guinea',NULL,NULL,'6'),(141,'PNR','Panama',NULL,NULL,'8'),(142,'POL','Poland',NULL,NULL,'1'),(143,'POR','Portugal',NULL,NULL,'3'),(144,'PRG','Paraguay',NULL,NULL,'9'),(145,'PRU','Peru',NULL,NULL,'9'),(146,'QAT','Qatar',NULL,NULL,'5'),(147,'ROU','Romania',NULL,NULL,'1'),(148,'RRW','Rwanda',NULL,NULL,'4'),(149,'RUS/E','Russia (Europe)','Venäjä (Eurooppa)',NULL,'1,5'),(150,'S','Sweden','Ruotsi','Sverige','1'),(151,'SDN','Sudan',NULL,NULL,'4'),(152,'SEN','Senegal',NULL,NULL,'4'),(153,'SEY','Seychelles',NULL,NULL,'4'),(154,'SLM','Solomon',NULL,NULL,'6'),(155,'SLV','El Salvador',NULL,NULL,'8'),(156,'SMO','Western Samoa',NULL,NULL,'6'),(157,'SMR','San Marino',NULL,NULL,'1'),(158,'SNG','Singapore',NULL,NULL,'5'),(159,'SOM','Somalia',NULL,NULL,'4'),(160,'SRL','Sierra Leone',NULL,NULL,'4'),(161,'STP','Sao Tome and Principe',NULL,NULL,'4'),(162,'SUI','Switzerland',NULL,NULL,'1'),(163,'SUR','Suriname',NULL,NULL,'9'),(164,'SVK','Slovak Republic',NULL,NULL,'1'),(165,'SVN','Slovenia',NULL,NULL,'1'),(166,'SWZ','Swaziland',NULL,NULL,'4'),(167,'SYR','Syria',NULL,NULL,'5'),(168,'TCD','Chad',NULL,NULL,'4'),(169,'TGO','Togo',NULL,NULL,'4'),(170,'THA','Thailand',NULL,NULL,'5'),(171,'TJK','Tajikistan',NULL,NULL,'5'),(172,'TKM','Turkmenistan',NULL,NULL,'5'),(173,'TON','Tonga',NULL,NULL,'6'),(174,'TRD','Trinidad and Tobago',NULL,NULL,'8'),(175,'TUN','Tunisia',NULL,NULL,'4'),(176,'TUR/E','Turkey (Europe)','Turkki (Eurooppa)',NULL,'1'),(177,'TUV','Tuvalu',NULL,NULL,'6'),(178,'TZA','Tanzania',NULL,NULL,'4'),(179,'UAE','United Arab Emirates',NULL,NULL,'5'),(180,'UGA','Uganda',NULL,NULL,'4'),(181,'UKR','Ukraine',NULL,NULL,'1'),(182,'URG','Uruguay',NULL,NULL,'9'),(183,'USA','United States',NULL,NULL,'7'),(184,'UZB','Ouzbékistan',NULL,NULL,'5'),(185,'VCT','St Vincent and the Grenadines',NULL,NULL,'8'),(186,'VEN','Venezuela',NULL,NULL,'9'),(187,'VTN','Viet Nam',NULL,NULL,'5'),(188,'VUT','Vanuatu',NULL,NULL,'6'),(189,'YEM','Yemen',NULL,NULL,'5'),(190,'YUG','Serbia and Montenegro',NULL,NULL,'1'),(191,'ZMB','Zambia',NULL,NULL,'4'),(192,'ZWE','Zimbabwe',NULL,NULL,'4'),(193,'CLA','Clandestine',NULL,NULL,'1,2,3,4,5,6,7,8,9,10,11,12,13,20'),(194,'PIR','Pirate',NULL,NULL,'1,2,3,4,5,6,7,8,9,10,11,12,13,20'),(195,'HWA','Hawaii',NULL,NULL,'6'),(196,'GUM','Guam',NULL,NULL,'6'),(197,'PTR','Puerto Rico',NULL,NULL,'8'),(198,'TWN','Taiwan',NULL,NULL,'5'),(199,'ALA','Alaska',NULL,NULL,'7'),(200,'CNR','Canary Islands',NULL,NULL,'4'),(201,'RUS/A','Russia (Asia)','Venäjä (Aasia)',NULL,'5'),(202,'TUR/A','Turkey (Asia)','Turkki (Aasia)',NULL,'5'),(203,'INS/O','Indonesia (Oceania)','Indonesia (Oseania)',NULL,'6'),(204,'GBR','Gibraltar','Gibraltar',NULL,'3'),(205,'','Azores Islands','Azorit',NULL,'3'),(206,'GRE','Greenland','Grönlanti',NULL,'7'),(207,'SPM','St. Pierre & Miquelon',NULL,NULL,'7'),(208,'RUS','Russia','','','1,5'),(209,'TUR','Turkey','','','1,5');
/*!40000 ALTER TABLE `ITU` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bands`
--

DROP TABLE IF EXISTS `Bands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bands` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Start` float DEFAULT NULL,
  `End` float DEFAULT NULL,
  `oid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bands`
--

LOCK TABLES `Bands` WRITE;
/*!40000 ALTER TABLE `Bands` DISABLE KEYS */;
INSERT INTO `Bands` VALUES (1,'FM',87500,108500,8),(2,'LW',140,300,7),(3,'MW',510,1750,8),(4,'120mb',2295,2510,2),(5,'90mb',3200,3400,1),(6,'60mb',4500,5500,1),(7,'49mb',5800,6300,1),(8,'41mb',7000,7500,1),(9,'31mb',9200,10100,1),(10,'25mb',11500,12200,1),(11,'19mb',15000,15900,1),(12,'16mb',17400,18000,1),(13,'13mb',21440,21900,1),(14,'11mb',25300,26200,1),(15,'Air',109000,140000,9),(16,'2000-5800 kHz',2000,5800,5),(17,'5800-30000 kHz',5800,30000,5),(18,'SW',2000,30000,5),(19,'75mb',3800,4100,1);
/*!40000 ALTER TABLE `Bands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categories` (
  `k` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Category` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`k`),
  UNIQUE KEY `k` (`k`),
  KEY `k_2` (`k`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES (1,'Europe'),(2,'British Isles'),(3,'Iberia'),(4,'Africa'),(5,'Asia'),(6,'Oceania'),(7,'North America'),(8,'Central America'),(9,'South America'),(10,'FM'),(11,'TV'),(12,'Pirate'),(13,'Utility'),(20,'Misc');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(32) NOT NULL DEFAULT '',
  `maturity` enum('alpha','beta','prod') NOT NULL DEFAULT 'alpha',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'english','prod'),(2,'finnish','prod'),(3,'swedish','prod'),(4,'german','alpha'),(5,'italian','alpha'),(6,'french','alpha'),(7,'spanish','alpha'),(8,'portuguese','alpha');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-26  2:16:18
