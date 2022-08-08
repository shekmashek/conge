-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 08 août 2022 à 06:15
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
-- Structure de la table `conges`
--

DROP TABLE IF EXISTS `conges`;
CREATE TABLE IF NOT EXISTS `conges` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_conge_id` bigint UNSIGNED NOT NULL,
  `employe_id` bigint UNSIGNED NOT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `intervale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'duree demandée en string DateInterval',
  `duree_conge` int DEFAULT NULL COMMENT 'durée en minute : SELECT TIMESTAMPDIFF(MINUTE,debut,fin); ',
  `motif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `etat_conge_id` bigint UNSIGNED NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cumul_perso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cumul de jour périodiquement : en string DateInterval',
  `j_utilise` double DEFAULT NULL COMMENT 'Jour à déduire :1/1.5/0.5',
  `restant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Jours restant après demande : en string DateInterval',
  PRIMARY KEY (`id`),
  KEY `conges_type_conge_id_foreign` (`type_conge_id`),
  KEY `conges_employe_id_foreign` (`employe_id`),
  KEY `conges_etat_conge_id_foreign` (`etat_conge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id`, `type_conge_id`, `employe_id`, `debut`, `fin`, `intervale`, `duree_conge`, `motif`, `etat_conge_id`, `created_at`, `updated_at`, `cumul_perso`, `j_utilise`, `restant`) VALUES
(1, 1, 2, '2022-01-10 08:00:00', '2022-01-10 17:00:00', '0 days 09 hours 0 minutes  0 seconds', 1440, 'Besoin d\'un pause sur mes congé payé', 3, NULL, '2022-08-05 13:34:43', '30 days', 1, '30 days'),
(2, 1, 1, '2022-01-01 08:00:00', '2022-01-03 17:00:00', '02 days 09 hours', 3420, 'premier congé payé', 1, NULL, NULL, '30 days', 3, '28 days'),
(3, 1, 1, '2022-01-01 00:00:00', '2022-01-03 19:00:00', '02 days 19 hours', 4020, 'j\'ai la flemme', 1, NULL, '2022-08-05 13:10:57', '32 days 12 hours', 1.5, '32 days 12 hours'),
(4, 1, 2, '2020-01-01 08:00:00', '2020-01-01 17:00:00', '0 days 09 hours 0 minutes  0 seconds', 1440, 'test : le jour de l\'an retire 0 jours', 3, NULL, '2022-08-05 13:35:56', '30 days', 0, '30 days'),
(5, 1, 1, '2020-03-01 08:00:00', '2020-03-03 17:00:00', '2 days 09 hours 0 minutes  0 seconds', 3420, 'Congé payé', 2, NULL, NULL, '30 days', 0, '30 days'),
(6, 1, 2, '2022-01-01 08:00:00', '2022-01-03 17:00:00', '02 days 09 hours', 3420, 'premier congé payé', 1, NULL, NULL, '30 days', 3, '27 days'),
(7, 3, 5, '2022-02-01 08:00:00', '2022-02-10 17:00:00', '09 days 09 hours', 13500, 'congé maladie', 1, NULL, NULL, '35 days', 9, '26 days'),
(8, 2, 1, '2022-01-01 00:00:00', '2022-01-03 19:00:00', '02 days 19 hours', 4020, 'Exceptionnelement j\'ai la flemme', 2, NULL, NULL, '32 days 12 hours', 0, '32 days 12 hours');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_employe_id_foreign` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conges_etat_conge_id_foreign` FOREIGN KEY (`etat_conge_id`) REFERENCES `etats_conge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
