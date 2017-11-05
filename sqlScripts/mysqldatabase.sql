CREATE DATABASE  IF NOT EXISTS `cs482502fa17_jsteele` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cs482502fa17_jsteele`;
-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: dbclass.cs.nmsu.edu    Database: cs482502fa17_jsteele
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.31-MariaDB

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
-- Table structure for table `AssignTraining`
--

DROP TABLE IF EXISTS `AssignTraining`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AssignTraining` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(11) NOT NULL DEFAULT '0',
  `ManagerID` int(11) NOT NULL DEFAULT '0',
  `TrainingID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PlayerTraining` (`PlayerID`,`TrainingID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Game`
--

DROP TABLE IF EXISTS `Game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Game` (
  `GameID` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Result` varchar(16) NOT NULL,
  `PlayingVenue` varchar(256) NOT NULL,
  `OpponentTeam` varchar(32) NOT NULL,
  PRIMARY KEY (`GameID`)
) ENGINE=InnoDB AUTO_INCREMENT=1019 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `GameView`
--

DROP TABLE IF EXISTS `GameView`;
/*!50001 DROP VIEW IF EXISTS `GameView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `GameView` AS SELECT 
 1 AS `GameID`,
 1 AS `Date`,
 1 AS `PlayingVenue`,
 1 AS `OpponentTeam`,
 1 AS `Result`,
 1 AS `Action`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Manager`
--

DROP TABLE IF EXISTS `Manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LoginID` varchar(16) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Password` varchar(8) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Address` varchar(128) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL,
  `PhoneNumber` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ManagerCertificate`
--

DROP TABLE IF EXISTS `ManagerCertificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ManagerCertificate` (
  `CertificateID` int(11) NOT NULL AUTO_INCREMENT,
  `Certificate` blob,
  `ManagerID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CertificateID`,`ManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=1026 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `ManagerView`
--

DROP TABLE IF EXISTS `ManagerView`;
/*!50001 DROP VIEW IF EXISTS `ManagerView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ManagerView` AS SELECT 
 1 AS `ID`,
 1 AS `LoginID`,
 1 AS `Name`,
 1 AS `Password`,
 1 AS `Birthday`,
 1 AS `Address`,
 1 AS `Email`,
 1 AS `PhoneNumber`,
 1 AS `ManagerID`,
 1 AS `CertificateID`,
 1 AS `Certificate`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Play`
--

DROP TABLE IF EXISTS `Play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Play` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(11) NOT NULL DEFAULT '0',
  `GameID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PlayerGame` (`PlayerID`,`GameID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `PlayGame`
--

DROP TABLE IF EXISTS `PlayGame`;
/*!50001 DROP VIEW IF EXISTS `PlayGame`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `PlayGame` AS SELECT 
 1 AS `PlayID`,
 1 AS `GameID`,
 1 AS `Date`,
 1 AS `PlayingVenue`,
 1 AS `Name`,
 1 AS `Action`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `PlayGameView`
--

DROP TABLE IF EXISTS `PlayGameView`;
/*!50001 DROP VIEW IF EXISTS `PlayGameView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `PlayGameView` AS SELECT 
 1 AS `PlayID`,
 1 AS `GameID`,
 1 AS `Date`,
 1 AS `PlayingVenue`,
 1 AS `OpponentTeam`,
 1 AS `Result`,
 1 AS `PlayerID`,
 1 AS `Action`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Player`
--

DROP TABLE IF EXISTS `Player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Player` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LoginID` varchar(16) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Password` varchar(8) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Address` varchar(128) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL,
  `PhoneNumber` char(10) DEFAULT NULL,
  `PlayPos` varchar(16) DEFAULT NULL,
  `ApprovedTF` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `PlayerData`
--

DROP TABLE IF EXISTS `PlayerData`;
/*!50001 DROP VIEW IF EXISTS `PlayerData`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `PlayerData` AS SELECT 
 1 AS `PlayerID`,
 1 AS `LoginID`,
 1 AS `Name`,
 1 AS `Birthday`,
 1 AS `Email`,
 1 AS `YearForStats`,
 1 AS `TotalPoints`,
 1 AS `ASPG`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `PlayerTraining`
--

DROP TABLE IF EXISTS `PlayerTraining`;
/*!50001 DROP VIEW IF EXISTS `PlayerTraining`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `PlayerTraining` AS SELECT 
 1 AS `PlayerID`,
 1 AS `LoginID`,
 1 AS `Name`,
 1 AS `AssignedBy`,
 1 AS `AssignedTrainingID`,
 1 AS `TrainingID`,
 1 AS `TrainingName`,
 1 AS `Instruction`,
 1 AS `Actions`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `PlayerView`
--

DROP TABLE IF EXISTS `PlayerView`;
/*!50001 DROP VIEW IF EXISTS `PlayerView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `PlayerView` AS SELECT 
 1 AS `ID`,
 1 AS `LoginID`,
 1 AS `Name`,
 1 AS `Password`,
 1 AS `Email`,
 1 AS `Birthday`,
 1 AS `Address`,
 1 AS `PhoneNumber`,
 1 AS `PlayPos`,
 1 AS `ApprovedTF`,
 1 AS `Stats`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Staff`
--

DROP TABLE IF EXISTS `Staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Staff` (
  `ID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Address` varchar(128) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL,
  `PhoneNumber` char(10) DEFAULT NULL,
  `Title` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Stats`
--

DROP TABLE IF EXISTS `Stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Stats` (
  `PlayerID` int(11) NOT NULL DEFAULT '0',
  `Year` char(4) NOT NULL DEFAULT '',
  `TotalPoints` int(11) DEFAULT NULL,
  `ASPG` int(11) DEFAULT NULL,
  PRIMARY KEY (`PlayerID`,`Year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Training`
--

DROP TABLE IF EXISTS `Training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Training` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TrainingName` varchar(16) NOT NULL,
  `Instruction` varchar(256) NOT NULL,
  `TimePeriodInHour` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TrainingName_UNIQUE` (`TrainingName`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `TrainingAdmin`
--

DROP TABLE IF EXISTS `TrainingAdmin`;
/*!50001 DROP VIEW IF EXISTS `TrainingAdmin`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `TrainingAdmin` AS SELECT 
 1 AS `ID`,
 1 AS `TrainingName`,
 1 AS `Instruction`,
 1 AS `TimePeriodInHour`,
 1 AS `Action`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `TrainingView`
--

DROP TABLE IF EXISTS `TrainingView`;
/*!50001 DROP VIEW IF EXISTS `TrainingView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `TrainingView` AS SELECT 
 1 AS `PlayerID`,
 1 AS `PlayerName`,
 1 AS `TrainingID`,
 1 AS `TrainingName`,
 1 AS `Instruction`,
 1 AS `ManagerName`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `UserView`
--

DROP TABLE IF EXISTS `UserView`;
/*!50001 DROP VIEW IF EXISTS `UserView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `UserView` AS SELECT 
 1 AS `Role`,
 1 AS `ID`,
 1 AS `LoginID`,
 1 AS `Name`,
 1 AS `Password`,
 1 AS `Birthday`,
 1 AS `Address`,
 1 AS `Email`,
 1 AS `PhoneNumber`,
 1 AS `PlayPos`,
 1 AS `ApprovedTF`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `GameView`
--

/*!50001 DROP VIEW IF EXISTS `GameView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `GameView` AS select `G`.`GameID` AS `GameID`,`G`.`Date` AS `Date`,`G`.`PlayingVenue` AS `PlayingVenue`,`G`.`OpponentTeam` AS `OpponentTeam`,`G`.`Result` AS `Result`,'' AS `Action` from (`Game` `G` left join `Play` `PL` on((`G`.`GameID` = `PL`.`GameID`))) order by `G`.`Date` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ManagerView`
--

/*!50001 DROP VIEW IF EXISTS `ManagerView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `ManagerView` AS select `M`.`ID` AS `ID`,`M`.`LoginID` AS `LoginID`,`M`.`Name` AS `Name`,`M`.`Password` AS `Password`,`M`.`Birthday` AS `Birthday`,`M`.`Address` AS `Address`,`M`.`Email` AS `Email`,`M`.`PhoneNumber` AS `PhoneNumber`,`MC`.`ManagerID` AS `ManagerID`,`MC`.`CertificateID` AS `CertificateID`,`MC`.`Certificate` AS `Certificate` from (`Manager` `M` join `ManagerCertificate` `MC`) where (`M`.`ID` = `MC`.`ManagerID`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `PlayGame`
--

/*!50001 DROP VIEW IF EXISTS `PlayGame`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `PlayGame` AS select `PL`.`ID` AS `PlayID`,`PL`.`GameID` AS `GameID`,`G`.`Date` AS `Date`,`G`.`PlayingVenue` AS `PlayingVenue`,`P`.`Name` AS `Name`,'' AS `Action` from ((`Play` `PL` left join `Game` `G` on((`PL`.`GameID` = `G`.`GameID`))) left join `Player` `P` on((`P`.`ID` = `PL`.`PlayerID`))) order by `G`.`Date` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `PlayGameView`
--

/*!50001 DROP VIEW IF EXISTS `PlayGameView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `PlayGameView` AS select `PL`.`ID` AS `PlayID`,`PL`.`GameID` AS `GameID`,`G`.`Date` AS `Date`,`G`.`PlayingVenue` AS `PlayingVenue`,`G`.`OpponentTeam` AS `OpponentTeam`,`G`.`Result` AS `Result`,`P`.`ID` AS `PlayerID`,'' AS `Action` from ((`Play` `PL` left join `Game` `G` on((`PL`.`GameID` = `G`.`GameID`))) left join `Player` `P` on((`P`.`ID` = `PL`.`PlayerID`))) order by `G`.`Date` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `PlayerData`
--

/*!50001 DROP VIEW IF EXISTS `PlayerData`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `PlayerData` AS select `P`.`ID` AS `PlayerID`,`P`.`LoginID` AS `LoginID`,`P`.`Name` AS `Name`,`P`.`Birthday` AS `Birthday`,`P`.`Email` AS `Email`,`S`.`Year` AS `YearForStats`,`S`.`TotalPoints` AS `TotalPoints`,`S`.`ASPG` AS `ASPG` from (`Player` `P` left join `Stats` `S` on((`P`.`ID` = `S`.`PlayerID`))) order by `P`.`Name` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `PlayerTraining`
--

/*!50001 DROP VIEW IF EXISTS `PlayerTraining`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `PlayerTraining` AS select `P`.`ID` AS `PlayerID`,`P`.`LoginID` AS `LoginID`,`P`.`Name` AS `Name`,`M`.`Name` AS `AssignedBy`,`AST`.`ID` AS `AssignedTrainingID`,`AST`.`TrainingID` AS `TrainingID`,`T`.`TrainingName` AS `TrainingName`,`T`.`Instruction` AS `Instruction`,'' AS `Actions` from (((`Player` `P` left join `AssignTraining` `AST` on((`P`.`ID` = `AST`.`PlayerID`))) left join `Manager` `M` on((`AST`.`ManagerID` = `M`.`ID`))) left join `Training` `T` on((`AST`.`TrainingID` = `T`.`ID`))) where ((`P`.`ID` = `AST`.`PlayerID`) and (`AST`.`ManagerID` = `M`.`ID`)) order by `P`.`Name`,`T`.`TrainingName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `PlayerView`
--

/*!50001 DROP VIEW IF EXISTS `PlayerView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `PlayerView` AS select `P`.`ID` AS `ID`,`P`.`LoginID` AS `LoginID`,`P`.`Name` AS `Name`,`P`.`Password` AS `Password`,`P`.`Email` AS `Email`,`P`.`Birthday` AS `Birthday`,`P`.`Address` AS `Address`,`P`.`PhoneNumber` AS `PhoneNumber`,`P`.`PlayPos` AS `PlayPos`,`P`.`ApprovedTF` AS `ApprovedTF`,'' AS `Stats` from `Player` `P` order by `P`.`Name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `TrainingAdmin`
--

/*!50001 DROP VIEW IF EXISTS `TrainingAdmin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `TrainingAdmin` AS select `T`.`ID` AS `ID`,`T`.`TrainingName` AS `TrainingName`,`T`.`Instruction` AS `Instruction`,`T`.`TimePeriodInHour` AS `TimePeriodInHour`,'' AS `Action` from `Training` `T` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `TrainingView`
--

/*!50001 DROP VIEW IF EXISTS `TrainingView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `TrainingView` AS select `P`.`ID` AS `PlayerID`,`P`.`Name` AS `PlayerName`,`AST`.`TrainingID` AS `TrainingID`,`T`.`TrainingName` AS `TrainingName`,`T`.`Instruction` AS `Instruction`,`M`.`Name` AS `ManagerName` from (((`Training` `T` join `AssignTraining` `AST`) join `Manager` `M`) join `Player` `P`) where ((`M`.`ID` = `AST`.`ManagerID`) and (`T`.`ID` = `AST`.`TrainingID`) and (`P`.`ID` = `AST`.`PlayerID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `UserView`
--

/*!50001 DROP VIEW IF EXISTS `UserView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`jsteele`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `UserView` AS select 'Player' AS `Role`,`P`.`ID` AS `ID`,`P`.`LoginID` AS `LoginID`,`P`.`Name` AS `Name`,`P`.`Password` AS `Password`,`P`.`Birthday` AS `Birthday`,`P`.`Address` AS `Address`,`P`.`Email` AS `Email`,`P`.`PhoneNumber` AS `PhoneNumber`,`P`.`PlayPos` AS `PlayPos`,`P`.`ApprovedTF` AS `ApprovedTF` from `Player` `P` union select 'Manager' AS `Role`,`M`.`ID` AS `ID`,`M`.`LoginID` AS `LoginID`,`M`.`Name` AS `Name`,`M`.`Password` AS `Password`,`M`.`Birthday` AS `Birthday`,`M`.`Address` AS `Address`,`M`.`Email` AS `Email`,`M`.`PhoneNumber` AS `PhoneNumber`,NULL AS `PlayPos`,'1' AS `ApprovedTF` from `Manager` `M` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-05  0:16:35
