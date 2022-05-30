-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 mai 2022 à 15:05
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_rioc`
--

-- --------------------------------------------------------

--
-- Structure de la table `identification`
--

DROP TABLE IF EXISTS `identification`;
CREATE TABLE IF NOT EXISTS `identification` (
  `id_identification` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_identification`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `identification`
--

INSERT INTO `identification` (`id_identification`, `user`, `password`) VALUES
(1, 'admin', '00d70c561892a94980befd12a400e26aeb4b8599');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `session_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sessions`
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
(15, 0, 'new session2'),
(16, 0, 'test1234'),
(17, 0, 'test'),
(18, 0, 'test'),
(19, 0, 'testttt'),
(20, 0, 'test'),
(21, 0, 'enfiiin'),
(22, 0, 'SessionX'),
(23, 0, 'new'),
(24, 0, 'Nouvelle'),
(25, 0, 'TP LoRaWan'),
(26, 0, '4'),
(27, 1, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `waiting_line`
--

DROP TABLE IF EXISTS `waiting_line`;
CREATE TABLE IF NOT EXISTS `waiting_line` (
  `id_waiting` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `waiting_time` timestamp NOT NULL,
  `call_type` tinyint(1) NOT NULL,
  `processing` tinyint(1) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `solved_date` timestamp NULL DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_waiting`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `waiting_line`
--

INSERT INTO `waiting_line` (`id_waiting`, `session_id`, `user_id`, `waiting_time`, `call_type`, `processing`, `rate`, `solved_date`, `comment`) VALUES
(32, 23, 1, '2022-05-17 13:27:08', 1, 1, NULL, NULL, NULL),
(31, 23, 1, '2022-05-17 13:27:04', 0, 1, NULL, NULL, NULL),
(30, 23, 1, '2022-05-17 13:22:16', 0, 1, NULL, NULL, NULL),
(29, 23, 1, '2022-05-17 13:22:14', 1, 1, NULL, NULL, NULL),
(28, 23, 1, '2022-05-17 13:22:11', 0, 1, NULL, NULL, NULL),
(27, 23, 1, '2022-05-17 13:21:54', 0, 1, NULL, NULL, NULL),
(26, 23, 1, '2022-05-17 13:21:52', 1, 1, NULL, NULL, NULL),
(25, 23, 1, '2022-05-17 13:21:50', 0, 1, NULL, NULL, NULL),
(24, 23, 1, '2022-05-17 13:21:10', 0, 1, NULL, NULL, NULL),
(23, 23, 1, '2022-05-17 13:21:00', 1, 1, NULL, NULL, NULL),
(22, 23, 1, '2022-05-17 13:20:57', 0, 1, NULL, NULL, NULL),
(21, 23, 1, '2022-05-17 13:20:50', 1, 1, NULL, NULL, NULL),
(20, 23, 1, '2022-05-17 13:20:48', 0, 1, NULL, NULL, NULL),
(19, 23, 1, '2022-05-17 13:20:46', 0, 1, NULL, NULL, NULL),
(18, 23, 1, '2022-05-17 13:19:35', 1, 1, NULL, NULL, NULL),
(17, 23, 1, '2022-05-17 13:19:33', 0, 1, NULL, NULL, NULL),
(33, 23, 1, '2022-05-17 14:45:38', 0, 1, NULL, NULL, NULL),
(34, 23, 1, '2022-05-17 14:49:09', 0, 1, NULL, NULL, NULL),
(35, 23, 2, '2022-05-17 14:55:12', 0, 1, NULL, NULL, NULL),
(36, 23, 2, '2022-05-17 14:55:21', 1, 1, NULL, NULL, NULL),
(37, 23, 2, '2022-05-17 14:58:58', 0, 1, NULL, NULL, NULL),
(38, 23, 2, '2022-05-17 14:59:20', 0, 1, NULL, NULL, NULL),
(39, 23, 2, '2022-05-17 14:59:21', 1, 1, NULL, NULL, NULL),
(40, 23, 6, '2022-05-23 13:30:01', 0, 1, NULL, NULL, NULL),
(41, 23, 6, '2022-05-23 13:30:03', 1, 1, NULL, NULL, NULL),
(42, 23, 6, '2022-05-23 13:30:14', 0, 0, NULL, NULL, NULL),
(43, 24, 1, '2022-05-23 15:39:19', 0, 1, 4, NULL, NULL),
(44, 24, 2, '2022-05-23 15:39:26', 1, 1, 5, NULL, NULL),
(45, 24, 3, '2022-05-23 15:39:34', 0, 1, NULL, '2022-05-25 12:51:52', NULL),
(46, 24, 9, '2022-05-24 12:56:02', 0, 1, NULL, NULL, NULL),
(47, 24, 9, '2022-05-24 13:19:16', 0, 1, 4, NULL, NULL),
(48, 24, 7, '2022-05-25 07:32:37', 1, 1, 5, NULL, NULL),
(49, 24, 9, '2022-05-25 12:08:10', 0, 1, 5, '2022-05-25 12:40:10', NULL),
(50, 24, 8, '2022-05-25 12:43:29', 0, 1, 1, '2022-05-25 12:49:31', NULL),
(51, 24, 10, '2022-05-26 23:39:03', 0, 0, NULL, NULL, NULL),
(52, 24, 2, '2022-05-27 20:10:24', 1, 1, NULL, NULL, NULL),
(53, 24, 2, '2022-05-27 20:10:29', 0, 1, NULL, NULL, NULL),
(54, 24, 2, '2022-05-27 20:10:38', 0, 1, NULL, NULL, NULL),
(55, 24, 2, '2022-05-27 20:13:08', 0, 1, NULL, NULL, NULL),
(56, 24, 2, '2022-05-27 20:13:19', 1, 1, NULL, NULL, NULL),
(57, 24, 6, '2022-05-30 06:36:19', 0, 1, NULL, NULL, NULL),
(58, 24, 6, '2022-05-30 06:36:40', 0, 1, NULL, NULL, NULL),
(59, 24, 6, '2022-05-30 06:36:43', 1, 1, NULL, NULL, NULL),
(60, 24, 6, '2022-05-30 06:36:49', 0, 1, NULL, NULL, NULL),
(61, 24, 6, '2022-05-30 06:37:13', 0, 1, NULL, NULL, NULL),
(62, 24, 6, '2022-05-30 06:37:15', 1, 1, NULL, NULL, NULL),
(63, 25, 3, '2022-05-30 07:40:31', 0, 1, NULL, NULL, NULL),
(64, 25, 2, '2022-05-30 07:40:57', 1, 1, NULL, NULL, NULL),
(65, 25, 1, '2022-05-30 07:45:05', 1, 1, 5, '2022-05-30 13:01:34', NULL),
(66, 25, 3, '2022-05-30 12:20:12', 0, 1, NULL, NULL, NULL),
(67, 25, 3, '2022-05-30 12:20:14', 1, 1, NULL, NULL, NULL),
(68, 25, 3, '2022-05-30 12:24:28', 0, 1, NULL, NULL, NULL),
(69, 25, 3, '2022-05-30 12:25:07', 0, 1, NULL, NULL, NULL),
(70, 25, 3, '2022-05-30 12:26:48', 0, 1, NULL, NULL, NULL),
(71, 25, 5, '2022-05-30 12:29:54', 0, 1, NULL, NULL, NULL),
(72, 25, 5, '2022-05-30 12:34:42', 0, 1, NULL, NULL, NULL),
(73, 25, 5, '2022-05-30 12:34:45', 1, 1, NULL, NULL, NULL),
(74, 25, 5, '2022-05-30 12:34:52', 0, 1, 3, '2022-05-30 13:01:52', NULL),
(75, 25, 5, '2022-05-30 12:34:53', 1, 1, 4, '2022-05-30 13:10:05', NULL),
(76, 25, 2, '2022-05-30 12:35:28', 0, 1, NULL, NULL, NULL),
(77, 25, 2, '2022-05-30 12:35:32', 1, 1, NULL, NULL, NULL),
(78, 25, 2, '2022-05-30 12:35:34', 0, 1, NULL, NULL, NULL),
(79, 25, 2, '2022-05-30 12:36:54', 0, 1, NULL, NULL, NULL),
(80, 25, 2, '2022-05-30 12:39:54', 0, 1, NULL, NULL, NULL),
(81, 25, 2, '2022-05-30 12:39:55', 1, 1, NULL, NULL, NULL),
(82, 25, 12, '2022-05-30 12:40:30', 0, 1, NULL, NULL, NULL),
(83, 25, 12, '2022-05-30 12:40:32', 1, 1, NULL, NULL, NULL),
(84, 25, 12, '2022-05-30 12:42:43', 0, 1, NULL, NULL, NULL),
(85, 25, 12, '2022-05-30 12:42:46', 1, 1, NULL, NULL, NULL),
(86, 25, 12, '2022-05-30 12:48:05', 0, 1, NULL, NULL, NULL),
(87, 25, 12, '2022-05-30 12:48:40', 0, 1, NULL, NULL, NULL),
(88, 25, 12, '2022-05-30 12:49:04', 0, 1, NULL, NULL, NULL),
(89, 25, 12, '2022-05-30 12:49:17', 0, 1, NULL, NULL, NULL),
(90, 25, 12, '2022-05-30 12:49:21', 1, 1, NULL, NULL, NULL),
(91, 25, 12, '2022-05-30 12:50:04', 0, 1, NULL, NULL, NULL),
(92, 25, 12, '2022-05-30 12:51:13', 0, 1, NULL, NULL, NULL),
(93, 25, 12, '2022-05-30 12:54:39', 1, 1, NULL, NULL, NULL),
(94, 25, 12, '2022-05-30 12:54:58', 0, 1, NULL, NULL, NULL),
(95, 25, 12, '2022-05-30 12:56:12', 0, 1, NULL, NULL, NULL),
(96, 25, 12, '2022-05-30 12:57:41', 0, 1, NULL, NULL, NULL),
(97, 25, 12, '2022-05-30 12:58:57', 0, 1, NULL, NULL, NULL),
(98, 25, 12, '2022-05-30 12:59:01', 0, 1, NULL, NULL, NULL),
(99, 25, 12, '2022-05-30 12:59:03', 1, 1, NULL, NULL, NULL),
(100, 25, 12, '2022-05-30 12:59:07', 0, 1, NULL, NULL, NULL),
(101, 25, 12, '2022-05-30 12:59:09', 1, 1, NULL, NULL, NULL),
(102, 25, 12, '2022-05-30 12:59:18', 0, 1, NULL, NULL, NULL),
(103, 25, 12, '2022-05-30 12:59:21', 1, 1, NULL, NULL, NULL),
(104, 25, 12, '2022-05-30 12:59:59', 0, 1, NULL, NULL, NULL),
(105, 25, 12, '2022-05-30 13:00:52', 0, 1, NULL, NULL, NULL),
(106, 25, 12, '2022-05-30 13:01:01', 0, 1, 4, '2022-05-30 13:01:47', NULL),
(107, 25, 12, '2022-05-30 13:05:27', 0, 1, 4, '2022-05-30 13:05:46', NULL),
(108, 25, 3, '2022-05-30 13:20:12', 0, 1, NULL, NULL, NULL),
(109, 25, 12, '2022-05-30 13:22:55', 0, 0, NULL, NULL, NULL),
(110, 25, 3, '2022-05-30 13:26:20', 0, 1, NULL, NULL, NULL),
(111, 25, 3, '2022-05-30 13:27:15', 0, 0, NULL, NULL, NULL),
(112, 26, 5, '2022-05-30 13:46:51', 0, 1, NULL, NULL, NULL),
(113, 27, 3, '2022-05-30 13:51:33', 0, 1, NULL, NULL, NULL),
(114, 27, 3, '2022-05-30 13:57:46', 0, 1, NULL, NULL, NULL),
(115, 27, 12, '2022-05-30 14:31:32', 0, 1, 3, '2022-05-30 14:48:42', 'Hello !'),
(116, 27, 4, '2022-05-30 14:48:58', 0, 1, 5, '2022-05-30 14:49:23', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
