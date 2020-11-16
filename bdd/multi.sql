-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 nov. 2020 à 12:41
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `multi`
--

-- --------------------------------------------------------

--
-- Structure de la table `cd`
--

DROP TABLE IF EXISTS `cd`;
CREATE TABLE IF NOT EXISTS `cd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `auteur` varchar(250) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `proprietaire_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genre_id` (`genre_id`),
  KEY `proprietaire_id` (`proprietaire_id`),
  KEY `stock_id` (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cd`
--

INSERT INTO `cd` (`id`, `nom`, `auteur`, `genre_id`, `proprietaire_id`, `stock_id`) VALUES
(3, 'Machine Head', 'DeepPurple', 4, 2, 1),
(4, 'France Afrique', 'Tiken Jha  Fakoly', 7, 3, 2),
(5, 'Arise', 'Sepultura', 7, 2, 1),
(6, 'undifined', 'Burial', 9, 2, 1),
(9, 'Blood Sugar Sex Magik', 'RTed Hot chili Peppers', 4, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(250) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `genre`) VALUES
(1, 'REGGAE'),
(2, 'SALSA'),
(3, 'SKA'),
(4, 'ROCK'),
(5, 'CLASSIQUE'),
(6, 'POP'),
(7, 'METAL'),
(8, 'CALIPSO'),
(9, 'DUB'),
(10, 'FOLK'),
(11, 'RAP'),
(12, 'HIP HOP'),
(13, 'JAZZ'),
(14, 'RAI');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

DROP TABLE IF EXISTS `proprietaires`;
CREATE TABLE IF NOT EXISTS `proprietaires` (
  `id_proprio` int(11) NOT NULL AUTO_INCREMENT,
  `nom_proprio` varchar(250) NOT NULL,
  `email_proprio` varchar(250) NOT NULL,
  `telephone_proprio` varchar(250) NOT NULL,
  PRIMARY KEY (`id_proprio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `proprietaires`
--

INSERT INTO `proprietaires` (`id_proprio`, `nom_proprio`, `email_proprio`, `telephone_proprio`) VALUES
(1, 'FNAC', 'fnac@hotmail.fr', '06 25 45 87 98'),
(2, 'AMAZONE', 'amazon@hotmail.fr', '04 48 58 47 58'),
(3, 'CDISCOUNT', 'cdiscount@laposte.net', '06 54 78 45 25'),
(4, 'DEZZER', 'dezzer@yahoo.com', '04 89 58 54 41');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `disponible` varchar(250) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id_stock`, `disponible`, `quantite`) VALUES
(1, 'OUI', 250),
(2, 'NON', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cd`
--
ALTER TABLE `cd`
  ADD CONSTRAINT `cd_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `cd_ibfk_2` FOREIGN KEY (`proprietaire_id`) REFERENCES `proprietaires` (`id_proprio`),
  ADD CONSTRAINT `cd_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id_stock`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
