-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2013 at 11:37 AM
-- Server version: 5.1.66-community
-- PHP Version: 5.4.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scouting2013`
--

-- --------------------------------------------------------

--
-- Table structure for table `matchdata`
--

CREATE TABLE IF NOT EXISTS `matchdata` (
  `Event` text NOT NULL,
  `MatchType` text NOT NULL,
  `MatchNumber` int(11) NOT NULL,
  `RedFinal` int(11) NOT NULL,
  `BlueFinal` int(11) NOT NULL,
  `Red1` int(11) NOT NULL,
  `Red2` int(11) NOT NULL,
  `Red3` int(11) NOT NULL,
  `Blue1` int(11) NOT NULL,
  `Blue2` int(11) NOT NULL,
  `Blue3` int(11) NOT NULL,
  `RedClimb` int(11) NOT NULL,
  `BlueClimb` int(11) NOT NULL,
  `RedFoul` int(11) NOT NULL,
  `BlueFoul` int(11) NOT NULL,
  `RedAuto` int(11) NOT NULL,
  `BlueAuto` int(11) NOT NULL,
  `RedTeleop` int(11) NOT NULL,
  `BlueTeleop` int(11) NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `Id` (`Id`),
  KEY `Timestamp` (`Timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `matchdata`
--

INSERT INTO `matchdata` (`Event`, `MatchType`, `MatchNumber`, `RedFinal`, `BlueFinal`, `Red1`, `Red2`, `Red3`, `Blue1`, `Blue2`, `Blue3`, `RedClimb`, `BlueClimb`, `RedFoul`, `BlueFoul`, `RedAuto`, `BlueAuto`, `RedTeleop`, `BlueTeleop`, `Id`, `Timestamp`) VALUES
('#FRCDEV1', 'P', 6, 50, 179, 5, 10, 8, 4, 2, 3, 30, 30, 0, 0, 0, 60, 20, 89, 1, '2013-02-25 19:47:32'),
('#FRCDEV1', 'P', 5, 189, 43, 12, 1, 6, 11, 9, 7, 40, 30, 0, 0, 72, 6, 77, 7, 2, '2013-02-25 19:48:46'),
('#FRCDEV1', 'P', 6, 50, 179, 5, 10, 8, 4, 2, 3, 30, 30, 0, 0, 0, 60, 20, 89, 3, '2013-02-26 19:36:23'),
('#FRCDEV1', 'P', 5, 189, 43, 12, 1, 6, 11, 9, 7, 40, 30, 0, 0, 72, 6, 77, 7, 4, '2013-02-26 19:36:23'),
('#FRCDEV1', 'P', 4, 135, 161, 12, 5, 3, 1, 9, 8, 50, 40, 26, 55, 12, 18, 47, 48, 5, '2013-02-26 19:36:23'),
('#FRCmike', 'P', 3, 0, 0, 1, 10, 9, 2, 3, 102, 0, 0, 0, 0, 0, 0, 0, 0, 6, '2013-02-26 19:36:23'),
('#FRCDEV1.1', 'P', 4, 43, 46, 4, 5, 2, 1, 3, 102, 0, 20, 43, 26, 0, 0, 0, 0, 7, '2013-02-26 19:36:23'),
('#FRCDEV1.1', 'P', 4, 0, 0, 4, 5, 2, 1, 3, 102, 0, 0, 0, 0, 0, 0, 0, 0, 8, '2013-02-26 19:36:23'),
('#FRCNHMA', 'Q', 1, 0, 0, 172, 610, 1729, 811, 151, 131, 0, 0, 0, 0, 0, 0, 0, 0, 9, '2013-02-26 19:36:23'),
('#FRCNHMA', 'P', 2, 0, 0, 1729, 213, 509, 1991, 166, 1517, 0, 0, 0, 0, 0, 0, 0, 0, 10, '2013-02-26 19:36:23'),
('#FRCNHMA', 'P', 1, 0, 0, 138, 1512, 1153, 3360, 1973, 4124, 0, 0, 0, 0, 0, 0, 0, 0, 11, '2013-02-26 19:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `teamdata`
--

CREATE TABLE IF NOT EXISTS `teamdata` (
  `TeamNumber` int(11) NOT NULL,
  `MatchNumber` int(11) NOT NULL,
  `Overall` int(11) NOT NULL,
  `Shooting` int(11) NOT NULL,
  `Lifting` int(11) NOT NULL,
  `Assisting` int(11) NOT NULL,
  `Penalties` text,
  `Comments` text,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `Id` (`Id`,`Timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teamdata`
--

INSERT INTO `teamdata` (`TeamNumber`, `MatchNumber`, `Overall`, `Shooting`, `Lifting`, `Assisting`, `Penalties`, `Comments`, `Id`, `Timestamp`) VALUES
(1234, 2, 3, 2, 0, 2, 'Yellow Card', 'N/A', 1, '2013-02-25 20:03:11'),
(6378, 86, 4, 0, 3, 2, 'Red card', 'None', 2, '2013-02-26 00:27:53'),
(6468, 86, 2, 2, 0, 3, 'None', 'None', 3, '2013-02-26 00:27:53'),
(7573, 86, 4, 3, 3, 3, 'None', 'Pick me', 4, '2013-02-26 00:27:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
