-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 18 avr. 2020 à 20:51
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`id`, `Nom`, `Prenom`, `Email`, `Motdepasse`, `Adresse`, `Codepostal`, `Ville`, `Telephone`, `Numcarte`, `Cvc`, `Moisexp`, `Anneeexp`) VALUES
(34, 'Hilt', 'Florian', 'florian.hilt@edu.ece.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '4 rue Desmont Dupont', 92700, 'Colombes', 654321345, 111111111111, 111, 12, 2021),
(35, 'Gremy', 'Mickael', 'gremymicka@edu.ece.fr', '75d4c9b02467d96bc2ea6d655eb983d5a7a97a9b', '4 rue Desmont', 92700, 'Colombes', 654321345, 1234123412341234, 142, 1, 1999),
(36, 'Boudjemai', 'Illyas', 'illyas.boudjemai@edu.ece.fr', '323621a00c94f0d1c848e8962af7adbe478f274e', '46 rue du general de gaulle', 94430, 'Chennevieres', 770972413, 3412564789067865, 657, 7, 2022),
(37, 'Trouducul', 'Annus', 'anutrouduc@metlamoidanslefion.com', 'd142ecd924d8aa1c828cfa46db7ff1f3f21488b5', '10 rue du Fion', 696969, 'Troudbal', 1001001, 789456123, 123, 12, 2024);

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(255) NOT NULL,
  `Motdepasse` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100000 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `Pseudo`, `Motdepasse`) VALUES
(99999, 'root', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Typedevente` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `idVendeur` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Video` varchar(255) NOT NULL,
  `idAcheteur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `Nom`, `Categorie`, `Prix`, `Typedevente`, `Description`, `idVendeur`, `Photo`, `Video`, `idAcheteur`) VALUES
(173, 'Vase en cristal', 'Accessoire VIP', 5400, 'Achat immediat', 'Rare vas en cristal', 8, '', '', ''),
(172, 'Boite en or', 'Bon pour Musee', 1800, 'Negociation', 'Petite boite en or 24 carats', 8, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAcheteur` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `idVendeur` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Typedevente` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Somme` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Profil` varchar(255) NOT NULL,
  `Fond` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id`, `Pseudo`, `Nom`, `Prenom`, `Email`, `Profil`, `Fond`) VALUES
(8, 'micka', 'Gremy', 'Mickael', 'mickagremy@outlook.com', '8.gif', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
