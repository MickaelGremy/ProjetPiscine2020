-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 avr. 2020 à 21:58
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `piscine2020`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Motdepasse` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Codepostal` int(11) NOT NULL,
  `Ville` varchar(255) NOT NULL,
  `Telephone` int(11) NOT NULL,
  `Numcarte` bigint(11) NOT NULL,
  `Cvc` int(11) NOT NULL,
  `Moisexp` int(11) NOT NULL,
  `Anneeexp` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`ID`, `Nom`, `Prenom`, `Email`, `Motdepasse`, `Adresse`, `Codepostal`, `Ville`, `Telephone`, `Numcarte`, `Cvc`, `Moisexp`, `Anneeexp`) VALUES
(15, 'HILT', 'Florian', 'florianhilt@outlook.com', 'D(\"7=sY6?pD#?', '4 rue Desmont Dupont', 92700, 'COLOMBES', 669725049, 1234123412341234, 123, 12, 2021);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
