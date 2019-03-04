-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 04 mars 2019 à 07:56
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `peva_admin`
--

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

DROP TABLE IF EXISTS `emplacement`;
CREATE TABLE IF NOT EXISTS `emplacement` (
  `emplacement_id` int(11) NOT NULL AUTO_INCREMENT,
  `emplacement_name` varchar(40) DEFAULT NULL,
  `emplacement_slug` varchar(40) DEFAULT NULL,
  `emplacement_owner` varchar(40) DEFAULT NULL,
  `emplacement_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`emplacement_id`),
  KEY `emplacement_owner` (`emplacement_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacement`
--

INSERT INTO `emplacement` (`emplacement_id`, `emplacement_name`, `emplacement_slug`, `emplacement_owner`, `emplacement_type`) VALUES
(1, 'Bernex - Home - Webcams', 'bernex_home_webcams', '2', 'Webcam'),
(2, 'Bernex - Webcams', 'bernex_webcams', '2', 'Webcam'),
(3, 'Abondance - Home - Webcams', 'abondance_home_webcams', '3', 'Webcam'),
(4, 'Chapelle - Brochures', 'chapelle_brochures', '7', 'Brochure'),
(5, 'Thollon - Webcams', 'thollon_webcams', '6', 'Webcam'),
(9, 'Abondance webcams', 'abondance_webcams', '3', 'Webcam'),
(10, 'Bernex footer', 'bernex_footer', '2', 'Webcam'),
(11, 'Home Bernex', 'home_bernex', '2', 'News');

-- --------------------------------------------------------

--
-- Structure de la table `emplacementwebcam`
--

DROP TABLE IF EXISTS `emplacementwebcam`;
CREATE TABLE IF NOT EXISTS `emplacementwebcam` (
  `e_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  PRIMARY KEY (`e_id`,`w_id`),
  KEY `w_fk` (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplacementwebcam`
--

INSERT INTO `emplacementwebcam` (`e_id`, `w_id`) VALUES
(1, 1),
(2, 1),
(5, 1),
(10, 1),
(1, 2),
(2, 2),
(10, 2),
(3, 11),
(9, 11),
(1, 32),
(2, 32),
(5, 32),
(10, 32),
(3, 33),
(9, 33),
(10, 33),
(1, 34),
(2, 34),
(5, 34),
(9, 34),
(10, 34),
(1, 41),
(2, 41),
(5, 41),
(9, 41),
(10, 41),
(1, 42),
(2, 42),
(10, 42),
(3, 44),
(9, 44);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(40) DEFAULT NULL,
  `user_pass` varchar(40) DEFAULT NULL,
  `user_privilege` int(11) DEFAULT NULL,
  `user_slug` varchar(40) DEFAULT NULL,
  `user_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_pass`, `user_privilege`, `user_slug`, `user_name`) VALUES
(1, 'admin', 'admin', 1, 'admin', 'Admin'),
(2, 'bernex', 'bernex', 2, 'bernex', 'Bernex'),
(3, 'abondance', 'abondance', 2, 'abondance', 'Abondance'),
(6, 'thollon', 'thollon', 2, 'thollon', 'Thollon les MÃ©mises'),
(7, 'chapelle', 'chapelle', 2, 'chapelle', 'Chapelle d\'Abondance');

-- --------------------------------------------------------

--
-- Structure de la table `webcam`
--

DROP TABLE IF EXISTS `webcam`;
CREATE TABLE IF NOT EXISTS `webcam` (
  `webcam_id` int(11) NOT NULL AUTO_INCREMENT,
  `webcam_name` varchar(40) DEFAULT NULL,
  `webcam_slug` varchar(80) DEFAULT NULL,
  `webcam_owner` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`webcam_id`),
  KEY `webcam_owner` (`webcam_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `webcam`
--

INSERT INTO `webcam` (`webcam_id`, `webcam_name`, `webcam_slug`, `webcam_owner`) VALUES
(1, 'Sommet Bernex', 'sommet_bernex', '2'),
(2, 'Village Bernex', 'village_bernex', '2'),
(11, 'Village Abondance', 'village_abondance', '3'),
(32, 'Thollon Genepi', 'thollon_genepi', '6'),
(33, 'Sommet Abondance', 'sommet_abondance', '3'),
(34, 'Thollon sommet', 'thollon_sommet', '6'),
(41, 'Thollon test webcam', 'thollon', '6'),
(42, 'Thollon test', 'thollon_test', '6'),
(44, 'mlkqsjdflkqsjdfkl', 'mlkjsdklfjqsdml', '3');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emplacementwebcam`
--
ALTER TABLE `emplacementwebcam`
  ADD CONSTRAINT `e_fk` FOREIGN KEY (`e_id`) REFERENCES `emplacement` (`emplacement_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `w_fk` FOREIGN KEY (`w_id`) REFERENCES `webcam` (`webcam_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
