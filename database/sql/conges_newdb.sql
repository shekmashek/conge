-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 01 sep. 2022 à 06:00
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
-- Base de données : `test_newdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--


-- suppression des anciennes tables
drop table if exists `frequences_solde`;
drop table if exists `type_conges`;
drop table if exists `conges_type_conges`;
drop table if exists `conges`;
drop table if exists `heures_de_travail`;



DROP TABLE IF EXISTS `conges`;
CREATE TABLE IF NOT EXISTS `conges` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_conge_id` bigint UNSIGNED NOT NULL,
  `employe_id` bigint UNSIGNED NOT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `intervalle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'duree en string DateInterval',
  `duree_conge` int DEFAULT NULL COMMENT 'durée en minute',
  `motif` text COLLATE utf8mb4_unicode_ci,
  `etat_conge_id` bigint UNSIGNED NOT NULL,
  `cumul_perso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cumul de jour personnel : en string DateInterval',
  `j_utilise` double DEFAULT NULL COMMENT 'Jour à déduire : 1/1.5/0.5',
  `restant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Jours restant après demande : en string DateInterval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conges_type_conge_id_foreign` (`type_conge_id`),
  KEY `conges_etat_conge_id_foreign` (`etat_conge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `conges_etats_conge`
--

DROP TABLE IF EXISTS `conges_etats_conge`;
CREATE TABLE IF NOT EXISTS `conges_etats_conge` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `etat_conge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `conges_etats_conge`
--

INSERT INTO `conges_etats_conge` (`id`, `etat_conge`, `created_at`, `updated_at`) VALUES
(1, 'Validé', NULL, NULL),
(2, 'Refusé', NULL, NULL),
(3, 'En attente', NULL, NULL),
(4, 'Annulé', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `conges_frequences_solde`
--

DROP TABLE IF EXISTS `conges_frequences_solde`;
CREATE TABLE IF NOT EXISTS `conges_frequences_solde` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `frequence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mensuelle, trimestrielle, annuelle',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `conges_frequences_solde`
--

INSERT INTO `conges_frequences_solde` (`id`, `frequence`, `created_at`, `updated_at`) VALUES
(1, 'Mensuelle', NULL, NULL),
(2, 'Trimestrielle', NULL, NULL),
(3, 'Semestrielle', NULL, NULL),
(4, 'Annuelle', NULL, NULL),
(5, 'Unique', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `conges_heures_de_travail`
--

DROP TABLE IF EXISTS `conges_heures_de_travail`;
CREATE TABLE IF NOT EXISTS `conges_heures_de_travail` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Heures de jour ou de nuit',
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `debut_pause` time NOT NULL COMMENT 'ex : déjeuner à 12h00',
  `fin_pause` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `conges_heures_de_travail`
--

INSERT INTO `conges_heures_de_travail` (`id`, `designation`, `heure_debut`, `heure_fin`, `debut_pause`, `fin_pause`, `created_at`, `updated_at`) VALUES
(1, 'Heures de jour', '08:00:00', '17:00:00', '12:00:00', '13:00:00', NULL, NULL),
(2, 'Heures de nuit', '20:00:00', '05:00:00', '00:00:00', '01:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `conges_types_conge`
--

DROP TABLE IF EXISTS `conges_types_conge`;
CREATE TABLE IF NOT EXISTS `conges_types_conge` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_conge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'durée en DateInterval',
  `duree_max` int DEFAULT NULL COMMENT 'unité de base d'' heure : minute',
  `solde_format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'type string : DateInterval',
  `solde` int DEFAULT NULL COMMENT 'Solde mensuelle en unité de temps: minute',
  `frequence_solde_id` bigint UNSIGNED NOT NULL,
  `paye` tinyint(1) DEFAULT NULL COMMENT '0 : non paye, 1 : paye',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conges_types_conge_frequence_solde_id_foreign` (`frequence_solde_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `conges_types_conge`
--

INSERT INTO `conges_types_conge` (`id`, `type_conge`, `couleur`, `max_duration`, `duree_max`, `solde_format`, `solde`, `frequence_solde_id`, `paye`, `created_at`, `updated_at`) VALUES
(1, 'Congé payé', '#14cdc8', '', NULL, '2 days 12 hours', 3600, 1, 1, NULL, NULL),
(2, 'Congé exceptionnel', '#dadfe1', '4 days', 5760, '10 days', 14400, 4, 1, NULL, NULL),
(3, 'Congé maladie', '#fcd670', '6 months', 262980, '', NULL, 5, 1, NULL, NULL),
(4, 'Congé de maternité', '#fbe7ef', '14 weeks', 2157120, '', NULL, 5, 1, NULL, NULL),
(5, 'Congé assistance enfant malade', '#fbe7ef', '6 months', 262980, '', NULL, 5, 1, NULL, NULL),
(6, 'Congé éducation', '#038aff', '12 days', 17280, '', NULL, 5, 1, NULL, NULL),
(7, 'Congé impayés', '#f27935', '', NULL, '', NULL, 5, 0, NULL, NULL),
(8, 'Irrégulier', '#f22613', '', NULL, '', NULL, 5, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `employers`
--

DROP TABLE IF EXISTS `employers`;
CREATE TABLE IF NOT EXISTS `employers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `matricule_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance_emp` datetime DEFAULT CURRENT_TIMESTAMP,
  `cin_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_emp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `branche_id` bigint UNSIGNED DEFAULT NULL,
  `genre_id` bigint UNSIGNED DEFAULT '1',
  `departement_entreprises_id` bigint UNSIGNED DEFAULT NULL,
  `adresse_quartier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_code_postal` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_lot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `niveau_etude_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `activiter` tinyint(1) NOT NULL DEFAULT '1',
  `prioriter` tinyint(1) NOT NULL DEFAULT '0',
  `url_photo` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_embauche` datetime DEFAULT '2021-08-16 09:00:00',
  `categorie_emploi_id` bigint UNSIGNED DEFAULT NULL,
  `statut_emploi_id` bigint UNSIGNED DEFAULT NULL,
  `fonction_id` bigint UNSIGNED DEFAULT NULL,
  `status_matri_id` bigint UNSIGNED DEFAULT NULL,
  `nationalite_id` bigint UNSIGNED DEFAULT NULL,
  `date_mariage` date DEFAULT NULL,
  `passeport` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_ostie` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_cnaps` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heure_de_travail_id` bigint UNSIGNED DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employers`
--

INSERT INTO `employers` (`id`, `user_id`, `matricule_emp`, `nom_emp`, `prenom_emp`, `date_naissance_emp`, `cin_emp`, `email_emp`, `telephone_emp`, `entreprise_id`, `service_id`, `branche_id`, `genre_id`, `departement_entreprises_id`, `adresse_quartier`, `adresse_code_postal`, `adresse_lot`, `adresse_ville`, `adresse_region`, `photos`, `niveau_etude_id`, `activiter`, `prioriter`, `url_photo`, `created_at`, `updated_at`, `date_embauche`, `categorie_emploi_id`, `statut_emploi_id`, `fonction_id`, `status_matri_id`, `nationalite_id`, `date_mariage`, `passeport`, `num_ostie`, `num_cnaps`, `heure_de_travail_id`) VALUES
(1, 46, '5521', 'Doe', 'Foo', '2022-06-08 00:00:00', '101456123789', 'foo@gmail.com', '546341632', 1, 2, 1, 2, 1, 'A place', '007', '50', 'Antananarivo', 'Analamanga', 'bema.jpg', 1, 1, 0, 'https://via.placeholder.com/150', '2022-05-19 10:05:41', '2022-05-19 10:05:41', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(2, 53, '101', 'Doe', 'Luc', NULL, '101123459452', 'luc@test.com', '0381536400', 1, 1, 1, 2, 2, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 0, 0, NULL, '2022-05-25 08:42:56', '2022-06-03 10:28:45', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(3, 58, '456', 'Fan', 'Soei', NULL, '100125456852', 'fan.soei@gmail.com', '0336556950', 1, 1, 1, 2, 2, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 1, 0, NULL, '2022-05-27 08:54:02', '2022-06-03 10:29:30', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(4, 67, '4585B', 'Marten', 'Ops', NULL, '101125785456', 'marten.l@gmail.com', '+1255785654', 4, 3, 1, 2, 4, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 1, 0, NULL, '2022-05-27 10:17:28', '2022-05-27 10:17:28', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(5, 68, '12', 'Forger', 'Loid', '2022-06-28 00:00:00', '101021455123', 'forger.loid@gmail.com', '+8825620101', 1, 1, 1, 2, 2, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 0, 0, NULL, '2022-05-27 10:25:53', '2022-05-27 10:25:53', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(6, 69, '54', 'True', 'Lin', NULL, '452015698451', 'true.lin@test.com', '+350452261', 1, 1, 1, 2, 1, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 1, 0, NULL, '2022-05-27 10:27:09', '2022-05-27 10:27:09', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(7, 70, '0659', 'Area', 'Louise', NULL, '2001454801', 'louise.area@gmail.com', '+332156950', 1, 1, 1, 2, 2, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 0, 0, NULL, '2022-05-27 10:37:51', '2022-05-27 10:37:51', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(8, 75, 'j565', 'Mendez', 'Elio', '2022-06-28 00:00:00', '25606450654', 'elio.mendez@test.com', '+252125454', 9, 1, 1, 11, 1, 'Somewhere', '102', '125', 'Tana', 'Analamanga', NULL, 1, 1, 0, 'https://via.placeholder.com/150', '2022-05-30 12:39:40', '2022-05-30 12:39:40', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(9, 78, 'D45635', 'Warp', 'Line', NULL, '121306510651', 'warp.line@test.com', '+26458812515', 9, 3, 1, 10, 1, 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', NULL, 1, 1, 0, NULL, '2022-05-31 07:07:19', '2022-05-31 07:07:19', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1),
(10, 81, 'd45', 'Redo', 'Klee', NULL, '21312103210', 'klee.do@test.com', '+0546052', 2, 1, 1, 5, 2, 'Somewhere', '102', '20', 'Antananarivo', 'Analamanga', NULL, 1, 1, 0, 'https://via.placeholder.com/150', '2022-05-31 12:54:04', '2022-05-31 12:54:04', '2021-08-16 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_08_03_155317_create_frequence_solde_table', 1),
(4, '2022_08_03_155413_create_type_conge_table', 1),
(5, '2022_08_03_155823_create_etat_conge_table', 1),
(6, '2022_08_03_155943_create_conge_table', 1),
(7, '2022_08_16_115724_create_jobs_table', 1),
(8, '2022_08_16_142147_create_heure_de_travails_table', 1),
(9, '2022_08_16_160642_add_heure_de_travail_employe', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_etat_conge_id_foreign` FOREIGN KEY (`etat_conge_id`) REFERENCES `conges_etats_conge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conges_type_conge_id_foreign` FOREIGN KEY (`type_conge_id`) REFERENCES `conges_types_conge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conges_types_conge`
--
ALTER TABLE `conges_types_conge`
  ADD CONSTRAINT `conges_types_conge_frequence_solde_id_foreign` FOREIGN KEY (`frequence_solde_id`) REFERENCES `conges_frequences_solde` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
