-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 08 août 2022 à 06:16
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `upskill-conge`
--

-- --------------------------------------------------------

--
-- Structure de la table `frequences_solde`
--

DROP TABLE IF EXISTS `frequences_solde`;
CREATE TABLE IF NOT EXISTS `frequences_solde` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `frequence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mensuelle, trimestrielle, annuelle',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `frequences_solde`
--

INSERT INTO `frequences_solde` (`id`, `frequence`, `created_at`, `updated_at`) VALUES
(1, 'Mensuelle', NULL, NULL),
(2, 'Trimestrielle', NULL, NULL),
(3, 'Semestrielle', NULL, NULL),
(4, 'Annuelle', NULL, NULL),
(5, 'Unique', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
