-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 11:42
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`id`, `Nom`, `Prenom`, `Email`, `Motdepasse`, `Adresse`, `Codepostal`, `Ville`, `Telephone`, `Numcarte`, `Cvc`, `Moisexp`, `Anneeexp`) VALUES
(38, 'Hilt', 'Florian', 'florian.hilt@edu.ece.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '4 rue Desmont Dupont', 92700, 'Colombes', 654321345, 1234123412341239, 444, 12, 2021),
(39, 'Ã©loi', 'Florian', 'florian.hilt@edu.ece', '92f2fd99879b0c2466ab8648afb63c49032379c1', '4 rue Desmont Dupont', 92700, 'Colombes', 654321345, 4444444444444444, 444, 10, 2022);

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
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `Nom`, `Categorie`, `Prix`, `Typedevente`, `Description`, `idVendeur`, `Photo`, `Video`, `idAcheteur`) VALUES
(202, 'EpÃ©e d\'Ulfberht', 'Bon pour Musee', 32400, 'Achat immediat', 'Objet d\'une raretÃ© sans prÃ©cÃ©dent', 9, '202.jpg', '202.mp4', ''),
(201, 'MÃ©canisme d\'anticitaire', 'Bon pour Musee', 470, 'Achat immediat', 'PiÃ¨ce d\'origine retrouvÃ©e dans les fond marins', 9, '201.jpg', '201.mp4', ''),
(200, 'DodÃ©caÃ¨dre', 'Bon pour Musee', 11400, 'Achat immediat', 'DodÃ©caÃ¨dre romain original', 8, '199.jpg', '199.mp4', ''),
(192, 'Louis d\'Or', 'Accessoire VIP', 5480, 'Achat immediat', 'Louis d\'or de 1704', 8, '192.jpg', '', ''),
(197, 'Jeu de clÃ©s', 'Ferraille ou Tresor', 210, 'Achat immediat', 'Jeu de clÃ©s dÃ©coratives en fer forgÃ©', 8, '197.jpg', '', ''),
(193, 'Chaise en bois - Louis XV', 'Bon pour Musee', 2460, 'Achat immediat', 'Chaise Louis XV CannÃ©e', 8, '193.jpg', '', ''),
(194, 'Vase en Cristal', 'Ferraille ou Tresor', 540, 'Achat immediat', 'Vase en cristal Bohemia - 27cm', 8, '194.jpg', '', ''),
(195, 'Boite en or', 'Accessoire VIP', 3600, 'Achat immediat', 'Boite en or - 24 carats', 8, '195.jpg', '', ''),
(196, 'Paire de jumelles', 'Ferraille ou Tresor', 370, 'Achat immediat', 'Jumelles antique de marine', 8, '196.jpg', '', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `idAcheteur`, `idArticle`, `idVendeur`, `Nom`, `Categorie`, `Prix`, `Typedevente`, `Description`, `Photo`, `Video`, `Somme`) VALUES
(54, 38, 198, 8, 'Sysmographe de Zang Heng', 'Accessoire VIP', 1540, 'Achat immediat', 'Sysmographe selon Zang Heng', '198.jpg', '198.mp4', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id`, `Pseudo`, `Nom`, `Prenom`, `Email`, `Profil`, `Fond`) VALUES
(8, 'micka', 'Gremy', 'Mickael', 'mickagremy@outlook.com', '8.gif', '8.png'),
(9, 'flo', 'Hilt', 'Florian', 'florian.hilt@edu.ece.fr', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
