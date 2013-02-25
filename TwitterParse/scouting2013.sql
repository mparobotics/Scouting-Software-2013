-- phpMyAdmin SQL Dump
-- version 4.0.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2013 at 01:51 PM
-- Server version: 5.6.10
-- PHP Version: 5.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  UNIQUE KEY `Timestamp` (`Timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `matchdata`
--

INSERT INTO `matchdata` (`Event`, `MatchType`, `MatchNumber`, `RedFinal`, `BlueFinal`, `Red1`, `Red2`, `Red3`, `Blue1`, `Blue2`, `Blue3`, `RedClimb`, `BlueClimb`, `RedFoul`, `BlueFoul`, `RedAuto`, `BlueAuto`, `RedTeleop`, `BlueTeleop`, `Id`, `Timestamp`) VALUES
('#FRCDEV1', 'P', 6, 50, 179, 5, 10, 8, 4, 2, 3, 30, 30, 0, 0, 0, 60, 20, 89, 1, '2013-02-25 19:47:32'),
('#FRCDEV1', 'P', 5, 189, 43, 12, 1, 6, 11, 9, 7, 40, 30, 0, 0, 72, 6, 77, 7, 2, '2013-02-25 19:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `teamdata`
--

CREATE TABLE IF NOT EXISTS `teamdata` (
  `MatchNumber` int(11) NOT NULL,
  `TeamNumber` int(11) NOT NULL,
  `Overall` int(11) NOT NULL,
  `Shooting` int(11) NOT NULL,
  `Lifting` int(11) NOT NULL,
  `Assisting` int(11) NOT NULL,
  `Penalties` text,
  `Comments` text,
  `Id` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `Id` (`Id`,`Timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
