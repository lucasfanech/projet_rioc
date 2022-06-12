-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 12 juin 2022 à 18:15
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
-- Base de données : `cmm`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
