-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2022 at 08:48 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_rioc`
--

-- --------------------------------------------------------

--
-- Table structure for table `identification`
--

DROP TABLE IF EXISTS `identification`;
CREATE TABLE IF NOT EXISTS `identification` (
  `id_identification` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_identification`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identification`
--

INSERT INTO `identification` (`id_identification`, `user`, `password`) VALUES
(1, 'admin', '00d70c561892a94980befd12a400e26aeb4b8599');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `session_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id_session`, `active`, `session_name`) VALUES
(1, 0, 'test'),
(2, 0, 'test'),
(3, 0, 'ceciestuntest'),
(4, 0, 'ceciestuntest2'),
(5, 0, 'new session'),
(6, 0, 'test'),
(7, 0, 'test'),
(8, 0, 'test2'),
(9, 0, 'test4'),
(10, 0, 'ceciestuntest'),
(11, 0, 'arg'),
(12, 0, 'sq'),
(14, 0, 'new session'),
(15, 1, 'new session2');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_line`
--

DROP TABLE IF EXISTS `waiting_line`;
CREATE TABLE IF NOT EXISTS `waiting_line` (
  `id_waiting` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `waiting_time` timestamp NOT NULL,
  `call_type` tinyint(1) NOT NULL,
  `processing` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_waiting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
