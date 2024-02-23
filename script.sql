-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 31 mai 2023 à 18:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_une_bibliothèque`
--
DROP DATABASE IF EXISTS `gestion_une_bibliothèque`;
CREATE DATABASE IF NOT EXISTS `gestion_une_bibliothèque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `gestion_une_bibliothèque`;

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `NUMERO_EMPRUNT` int NOT NULL AUTO_INCREMENT,
  `NUMERO_USAGER` int NOT NULL,
  `_NUMERO_EXEMPLAIRE` int NOT NULL,
  `DATE_EMPRUNT` date DEFAULT NULL,
  `DATE_RETOUR_PREVUE` date DEFAULT NULL,
  `DATE_RETOUR_REELLE` date DEFAULT NULL,
  PRIMARY KEY (`NUMERO_EMPRUNT`),
  KEY `FK_EFFECTUE` (`NUMERO_USAGER`),
  KEY `FK_EST_EMPRUNTE` (`_NUMERO_EXEMPLAIRE`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `_NUMERO_EXEMPLAIRE` int NOT NULL AUTO_INCREMENT,
  `NUMERO_LIVRE` int NOT NULL,
  PRIMARY KEY (`_NUMERO_EXEMPLAIRE`),
  KEY `FK_APPARTIENT_A` (`NUMERO_LIVRE`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`_NUMERO_EXEMPLAIRE`, `NUMERO_LIVRE`) VALUES
(154, 2),
(153, 2);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `NUMERO_LIVRE` int NOT NULL,
  `TITRE` varchar(50) DEFAULT NULL,
  `AUTEUR` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `MAISON_EDITION` varchar(50) DEFAULT NULL,
  `NB_PAGES` int DEFAULT NULL,
  PRIMARY KEY (`NUMERO_LIVRE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`NUMERO_LIVRE`, `TITRE`, `AUTEUR`, `MAISON_EDITION`, `NB_PAGES`) VALUES
(2, 'tttt', 'tttt', 'tttt', 50);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('Abdessamad', '123456');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `NUMERO_USAGER` int NOT NULL,
  `NOM` char(30) DEFAULT NULL,
  `PRENOM` char(30) DEFAULT NULL,
  `ADRESSE` varchar(60) DEFAULT NULL,
  `STATUS` char(20) DEFAULT NULL,
  `EMAIL` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`NUMERO_USAGER`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO `usager` (`NUMERO_USAGER`, `NOM`, `PRENOM`, `ADRESSE`, `STATUS`, `EMAIL`) VALUES
(1, 'yyyy', 'yyyy', 'yyyy', 'yyyy', 'yyyy@yyyy');
--
-- Base de données : `magasin`
--
DROP DATABASE IF EXISTS `magasin`;
CREATE DATABASE IF NOT EXISTS `magasin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `magasin`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` char(5) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `categorie` enum('tous','photo','vidéo','informatique','divers') NOT NULL DEFAULT 'tous',
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `CIN` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prenom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Age` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Adresse` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pas de mail',
  `Ville` varchar(20) NOT NULL,
  PRIMARY KEY (`CIN`),
  UNIQUE KEY `CIN` (`CIN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`CIN`, `Nom`, `Prenom`, `Age`, `Adresse`, `Mail`, `Ville`) VALUES
('', 'ff', 'gg', 'ggg', 'gg', 'ggg@hh', 'gg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_comm` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_client` mediumint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_comm`,`id_client`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE IF NOT EXISTS `ligne` (
  `id_comm` mediumint UNSIGNED NOT NULL,
  `id_article` char(5) NOT NULL,
  `quantite` tinyint UNSIGNED NOT NULL,
  `prix_unit` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_comm`,`id_article`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
