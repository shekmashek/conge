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
-- Structure de la table `types_conge`
--

DROP TABLE IF EXISTS `types_conge`;
CREATE TABLE IF NOT EXISTS `types_conge` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_conge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'durée en DateInterval',
  `duree_max` int DEFAULT NULL COMMENT 'unité de base d'' heure : minute',
  `solde_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'type string : DateInterval',
  `solde` int DEFAULT NULL COMMENT 'Solde mensuelle en unité de temps: minute',
  `frequence_solde_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paye` tinyint(1) DEFAULT NULL COMMENT '0 : non paye, 1 : paye',
  PRIMARY KEY (`id`),
  KEY `types_conge_frequence_solde_id_foreign` (`frequence_solde_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `types_conge`
--

INSERT INTO `types_conge` (`id`, `type_conge`, `couleur`, `max_duration`, `duree_max`, `solde_format`, `solde`, `frequence_solde_id`, `created_at`, `updated_at`, `paye`) VALUES
(1, 'Congé payé', '#14cdc8', '', NULL, '2 days 12 hours', 3600, 1, NULL, NULL, 1),
(2, 'Congé exceptionnel', '#dadfe1', '4 days', 5760, '10 days', 14400, 4, NULL, NULL, 1),
(3, 'Congé maladie', '#fcd670', '6 months', 262980, '2 days 12 hours', NULL, 5, NULL, NULL, 1),
(4, 'Congé de maternité', '#fbe7ef', '14 weeks', 2157120, '', NULL, 5, NULL, NULL, 1),
(5, 'Congé assistance enfant malade', '#fbe7ef', '6 months', 262980, '', NULL, 5, NULL, NULL, 1),
(6, 'Congé éducation', '#038aff', '12 days', 17280, '', NULL, 5, NULL, NULL, 1),
(7, 'Congé impayés', '#f27935', '', NULL, '', NULL, 5, NULL, NULL, 0),
(8, 'Irrégulier', '#f22613', '', NULL, '', NULL, 5, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
