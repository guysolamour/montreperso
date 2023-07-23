-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `monte_perso` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `monte_perso`;

DROP TABLE IF EXISTS `arriere_plan_horloge`;
CREATE TABLE `arriere_plan_horloge` (
  `id_arriere_plan` int NOT NULL AUTO_INCREMENT,
  `nom_arriere_plan` varchar(255) NOT NULL,
  `image_arriere_plan` varchar(255) NOT NULL,
  `url_complet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_arriere_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `arriere_plan_horloge` (`id_arriere_plan`, `nom_arriere_plan`, `image_arriere_plan`, `url_complet`, `created_at`, `updated_at`) VALUES
(5,	'arrière plan1',	'20221026114858.jpg',	NULL,	'2022-10-26 11:48:58',	'2022-10-26 11:48:58'),
(6,	'arrière plan2',	'20221026120855.jpg',	NULL,	'2022-10-26 12:08:55',	'2022-10-26 12:08:55'),
(7,	'arrière plan ok',	'20221026140520.jpg',	NULL,	'2022-10-26 14:03:41',	'2022-10-26 14:05:20');

DROP TABLE IF EXISTS `arriere_plan_montre`;
CREATE TABLE `arriere_plan_montre` (
  `id_arriere_plan` int NOT NULL AUTO_INCREMENT,
  `nom_arriere_plan` varchar(255) NOT NULL,
  `image_arriere_plan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_arriere_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `arriere_plan_montre` (`id_arriere_plan`, `nom_arriere_plan`, `image_arriere_plan`, `created_at`, `updated_at`) VALUES
(3,	'arrière plan1',	'20221024013304.jpg',	'2022-10-24 01:33:04',	'2022-10-24 01:33:04'),
(4,	'arrière plan2',	'20221026141504.png',	'2022-10-24 01:33:42',	'2022-10-28 00:37:30');

DROP TABLE IF EXISTS `couleur_bracelet`;
CREATE TABLE `couleur_bracelet` (
  `id_couleur_bracelet` int NOT NULL AUTO_INCREMENT,
  `nom_couleur` varchar(100) NOT NULL,
  `image_bracelet_couleur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_couleur_bracelet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `couleur_bracelet` (`id_couleur_bracelet`, `nom_couleur`, `image_bracelet_couleur`, `created_at`, `updated_at`) VALUES
(2,	'bracelet1',	'20221026234049.jpg',	'2022-10-26 23:40:49',	'2022-10-26 23:40:49'),
(3,	'bracelet2',	'20221026234104.jpg',	'2022-10-26 23:41:04',	'2022-10-26 23:41:04');

DROP TABLE IF EXISTS `couleur_index`;
CREATE TABLE `couleur_index` (
  `id_couleur_index` int NOT NULL AUTO_INCREMENT,
  `nom_couleur` varchar(255) NOT NULL,
  `image_couleur_index` varchar(255) NOT NULL,
  `id_index` int NOT NULL,
  `id_forme_montre` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_couleur_index`),
  KEY `id_index` (`id_index`),
  KEY `id_forme_montre` (`id_forme_montre`),
  CONSTRAINT `couleur_index_ibfk_1` FOREIGN KEY (`id_index`) REFERENCES `montre_perso_index` (`id_index`),
  CONSTRAINT `couleur_index_ibfk_2` FOREIGN KEY (`id_forme_montre`) REFERENCES `forme_montre` (`id_forme_montre`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `couleur_index` (`id_couleur_index`, `nom_couleur`, `image_couleur_index`, `id_index`, `id_forme_montre`, `created_at`, `updated_at`) VALUES
(1,	'Orange',	'20221026174204.png',	2,	1,	'2022-10-26 17:42:04',	'2022-10-27 14:16:38'),
(2,	'Noir',	'20221026180510.png',	2,	1,	'2022-10-26 17:59:45',	'2022-10-27 14:17:44'),
(3,	'Noir',	'20230517162129.png',	1,	2,	'2023-05-17 16:21:29',	'2023-05-17 16:21:29');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `forme_horloge`;
CREATE TABLE `forme_horloge` (
  `id_forme_horloge` int NOT NULL AUTO_INCREMENT,
  `libelle_forme` varchar(100) NOT NULL,
  `image_forme` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_forme_horloge`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `forme_horloge` (`id_forme_horloge`, `libelle_forme`, `image_forme`, `created_at`, `updated_at`) VALUES
(6,	'Forme1',	'20221101143202.jpg',	'2022-11-01 14:28:51',	'2022-11-01 14:32:02');

DROP TABLE IF EXISTS `forme_montre`;
CREATE TABLE `forme_montre` (
  `id_forme_montre` int NOT NULL AUTO_INCREMENT,
  `libelle_forme` varchar(100) NOT NULL,
  `image_forme` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_forme_montre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `forme_montre` (`id_forme_montre`, `libelle_forme`, `image_forme`, `created_at`, `updated_at`) VALUES
(1,	'Ronde',	'20221027133130.png',	'2022-10-27 13:31:30',	'2022-10-27 13:31:30'),
(2,	'Carrée',	'20221027134147.png',	'2022-10-27 13:41:47',	'2022-10-27 13:41:47');

DROP TABLE IF EXISTS `guysolamour_aiguilles`;
CREATE TABLE `guysolamour_aiguilles` (
  `id_aiguille` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_aiguille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_aiguilles` (`id_aiguille`, `nom`, `chemin`, `created_at`, `updated_at`) VALUES
(1,	'aiguille1',	'/uploads/guysolamour/aiguilles/aiguille1.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13'),
(2,	'aiguille2',	'/uploads/guysolamour/aiguilles/aiguille2.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13'),
(3,	'aiguille3',	'/uploads/guysolamour/aiguilles/aiguille3.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13'),
(4,	'aiguille4',	'/uploads/guysolamour/aiguilles/aiguille4.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13'),
(5,	'aiguille5',	'/uploads/guysolamour/aiguilles/aiguille5.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13'),
(6,	'aiguille6',	'/uploads/guysolamour/aiguilles/aiguille6.png',	'2023-07-09 14:09:13',	'2023-07-09 14:09:13');

DROP TABLE IF EXISTS `guysolamour_arriere_plans`;
CREATE TABLE `guysolamour_arriere_plans` (
  `id_arriere_plan` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_arriere_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_arriere_plans` (`id_arriere_plan`, `nom`, `created_at`, `updated_at`) VALUES
(1,	'afrique',	NULL,	NULL),
(2,	'amoirie',	NULL,	NULL),
(5,	'amour',	NULL,	NULL),
(6,	'chretien',	NULL,	NULL),
(7,	'colombe',	NULL,	NULL),
(8,	'fete',	NULL,	NULL),
(9,	'motif',	NULL,	NULL),
(10,	'paysage',	NULL,	NULL),
(11,	'simple',	NULL,	NULL);

DROP TABLE IF EXISTS `guysolamour_arriere_plans_media`;
CREATE TABLE `guysolamour_arriere_plans_media` (
  `id_arriere_plan_media` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `id_arriere_plan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_arriere_plan_media`),
  KEY `id_arriere_plan` (`id_arriere_plan`),
  CONSTRAINT `guysolamour_arriere_plans_media_ibfk_1` FOREIGN KEY (`id_arriere_plan`) REFERENCES `guysolamour_arriere_plans` (`id_arriere_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_arriere_plans_media` (`id_arriere_plan_media`, `nom`, `chemin`, `id_arriere_plan`, `created_at`, `updated_at`) VALUES
(4,	'afrique1',	'/uploads/guysolamour/arriere_plans/afrique1.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:38:42'),
(5,	'afrique2',	'/uploads/guysolamour/arriere_plans/afrique2.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(6,	'afrique3',	'/uploads/guysolamour/arriere_plans/afrique3.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(7,	'afrique4',	'/uploads/guysolamour/arriere_plans/afrique4.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(8,	'afrique5',	'/uploads/guysolamour/arriere_plans/afrique5.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(9,	'afrique6',	'/uploads/guysolamour/arriere_plans/afrique6.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(10,	'afrique7',	'/uploads/guysolamour/arriere_plans/afrique7.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(11,	'afrique8',	'/uploads/guysolamour/arriere_plans/afrique8.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(12,	'afrique9',	'/uploads/guysolamour/arriere_plans/afrique9.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(13,	'afrique10',	'/uploads/guysolamour/arriere_plans/afrique10.jpg',	1,	'2023-07-09 10:08:19',	'2023-07-09 11:57:18'),
(20,	'amoirie1',	'/uploads/guysolamour/arriere_plans/amoirie1.jpg',	2,	'2023-07-09 10:19:54',	'2023-07-09 11:38:42'),
(21,	'amoirie2',	'/uploads/guysolamour/arriere_plans/amoirie2.jpg',	2,	'2023-07-09 10:19:54',	'2023-07-09 11:38:42'),
(22,	'amour1',	'/uploads/guysolamour/arriere_plans/amour1.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(23,	'amour2',	'/uploads/guysolamour/arriere_plans/amour2.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(24,	'amour3',	'/uploads/guysolamour/arriere_plans/amour3.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(25,	'amour4',	'/uploads/guysolamour/arriere_plans/amour4.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(26,	'amour5',	'/uploads/guysolamour/arriere_plans/amour5.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(27,	'amour6',	'/uploads/guysolamour/arriere_plans/amour6.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(28,	'amour7',	'/uploads/guysolamour/arriere_plans/amour7.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(29,	'amour8',	'/uploads/guysolamour/arriere_plans/amour8.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(30,	'amour9',	'/uploads/guysolamour/arriere_plans/amour9.jpg',	5,	'2023-07-09 10:22:27',	'2023-07-09 12:01:32'),
(32,	'chretien1',	'/uploads/guysolamour/arriere_plans/chretien1.jpg',	6,	'2023-07-09 10:23:42',	'2023-07-09 11:38:42'),
(33,	'colombe1',	'/uploads/guysolamour/arriere_plans/colombe1.jpg',	7,	'2023-07-09 10:27:02',	'2023-07-09 12:02:11'),
(34,	'colombe2',	'/uploads/guysolamour/arriere_plans/colombe2.jpg',	7,	'2023-07-09 10:27:02',	'2023-07-09 12:02:11'),
(35,	'colombe3',	'/uploads/guysolamour/arriere_plans/colombe3.jpg',	7,	'2023-07-09 10:27:02',	'2023-07-09 12:02:11'),
(36,	'colombe4',	'/uploads/guysolamour/arriere_plans/colombe4.jpg',	7,	'2023-07-09 10:27:02',	'2023-07-09 12:02:11'),
(37,	'colombe5',	'/uploads/guysolamour/arriere_plans/colombe5.jpg',	7,	'2023-07-09 10:27:03',	'2023-07-09 12:02:11'),
(38,	'colombe6',	'/uploads/guysolamour/arriere_plans/colombe6.jpg',	7,	'2023-07-09 10:27:03',	'2023-07-09 12:02:11'),
(39,	'colombe7',	'/uploads/guysolamour/arriere_plans/colombe7.jpg',	7,	'2023-07-09 10:27:03',	'2023-07-09 12:02:11'),
(40,	'colombe8',	'/uploads/guysolamour/arriere_plans/colombe8.jpg',	7,	'2023-07-09 10:27:03',	'2023-07-09 12:02:11'),
(41,	'fete1',	'/uploads/guysolamour/arriere_plans/fete1.jpg',	8,	'2023-07-09 10:29:08',	'2023-07-09 12:02:34'),
(42,	'fete2',	'/uploads/guysolamour/arriere_plans/fete2.jpg',	8,	'2023-07-09 10:29:08',	'2023-07-09 12:02:34'),
(43,	'fete3',	'/uploads/guysolamour/arriere_plans/fete3.jpg',	8,	'2023-07-09 10:29:08',	'2023-07-09 12:02:34'),
(44,	'fete4',	'/uploads/guysolamour/arriere_plans/fete4.jpg',	8,	'2023-07-09 10:29:08',	'2023-07-09 12:02:34'),
(45,	'motif1',	'/uploads/guysolamour/arriere_plans/motif1.jpg',	9,	'2023-07-09 10:30:32',	'2023-07-09 12:02:53'),
(46,	'motif2',	'/uploads/guysolamour/arriere_plans/motif2.jpg',	9,	'2023-07-09 10:30:32',	'2023-07-09 12:02:53'),
(47,	'motif3',	'/uploads/guysolamour/arriere_plans/motif3.jpg',	9,	'2023-07-09 10:30:32',	'2023-07-09 12:02:53'),
(48,	'motif4',	'/uploads/guysolamour/arriere_plans/motif4.jpg',	9,	'2023-07-09 10:30:32',	'2023-07-09 12:02:53'),
(49,	'paysage1',	'/uploads/guysolamour/arriere_plans/paysage1.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(50,	'paysage2',	'/uploads/guysolamour/arriere_plans/paysage2.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(51,	'paysage3',	'/uploads/guysolamour/arriere_plans/paysage3.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(52,	'paysage4',	'/uploads/guysolamour/arriere_plans/paysage4.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(53,	'paysage5',	'/uploads/guysolamour/arriere_plans/paysage5.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(54,	'paysage6',	'/uploads/guysolamour/arriere_plans/paysage6.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(55,	'paysage7',	'/uploads/guysolamour/arriere_plans/paysage7.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(56,	'paysage8',	'/uploads/guysolamour/arriere_plans/paysage8.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(57,	'paysage9',	'/uploads/guysolamour/arriere_plans/paysage9.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(58,	'paysage10',	'/uploads/guysolamour/arriere_plans/paysage10.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(59,	'paysage11',	'/uploads/guysolamour/arriere_plans/paysage11.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(60,	'paysage12',	'/uploads/guysolamour/arriere_plans/paysage12.jpg',	10,	'2023-07-09 10:32:35',	'2023-07-09 12:03:13'),
(61,	'simple1',	'/uploads/guysolamour/arriere_plans/simple1.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(62,	'simple2',	'/uploads/guysolamour/arriere_plans/simple2.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(63,	'simple3',	'/uploads/guysolamour/arriere_plans/simple3.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(64,	'simple4',	'/uploads/guysolamour/arriere_plans/simple4.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(65,	'simple5',	'/uploads/guysolamour/arriere_plans/simple5.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(66,	'simple6',	'/uploads/guysolamour/arriere_plans/simple6.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(67,	'simple7',	'/uploads/guysolamour/arriere_plans/simple7.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(68,	'simple8',	'/uploads/guysolamour/arriere_plans/simple8.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(69,	'simple9',	'/uploads/guysolamour/arriere_plans/simple9.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(70,	'simple10',	'/uploads/guysolamour/arriere_plans/simple10.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:24'),
(71,	'simple11',	'/uploads/guysolamour/arriere_plans/simple11.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:25'),
(72,	'simple12',	'/uploads/guysolamour/arriere_plans/simple12.jpg',	11,	'2023-07-09 10:34:27',	'2023-07-09 12:03:25');

DROP TABLE IF EXISTS `guysolamour_formes`;
CREATE TABLE `guysolamour_formes` (
  `id_forme` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_forme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_formes` (`id_forme`, `nom`, `chemin`, `created_at`, `updated_at`) VALUES
(1,	'ronde',	'/uploads/guysolamour/formes/ronde.png',	'2023-07-09 10:39:49',	'2023-07-09 10:39:49'),
(2,	'carre',	'/uploads/guysolamour/formes/carre.png',	'2023-07-09 10:39:49',	'2023-07-09 10:39:49');

DROP TABLE IF EXISTS `guysolamour_index`;
CREATE TABLE `guysolamour_index` (
  `id_index` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `forme_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_index`),
  KEY `forme_id` (`forme_id`),
  CONSTRAINT `guysolamour_index_ibfk_1` FOREIGN KEY (`forme_id`) REFERENCES `guysolamour_formes` (`id_forme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_index` (`id_index`, `nom`, `description`, `forme_id`, `created_at`, `updated_at`) VALUES
(1,	'chiffres',	NULL,	1,	'2023-07-09 10:47:59',	'2023-07-09 10:47:59'),
(2,	'romains',	NULL,	1,	'2023-07-09 10:47:59',	'2023-07-09 10:47:59'),
(3,	'simples',	NULL,	1,	'2023-07-09 10:47:59',	'2023-07-09 10:47:59'),
(5,	'chiffres',	NULL,	2,	'2023-07-09 10:47:59',	'2023-07-09 10:47:59'),
(6,	'simples',	NULL,	2,	'2023-07-09 10:47:59',	'2023-07-09 10:47:59');

DROP TABLE IF EXISTS `guysolamour_index_media`;
CREATE TABLE `guysolamour_index_media` (
  `id_index_media` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `index_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_index_media`),
  KEY `index_id` (`index_id`),
  CONSTRAINT `guysolamour_index_media_ibfk_2` FOREIGN KEY (`index_id`) REFERENCES `guysolamour_index` (`id_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_index_media` (`id_index_media`, `nom`, `chemin`, `index_id`, `created_at`, `updated_at`) VALUES
(1,	'ronde_chiffre1',	'/uploads/guysolamour/index/ronde_chiffre1.png',	1,	'2023-07-09 11:02:51',	'2023-07-09 11:39:31'),
(2,	'ronde_chiffre2',	'/uploads/guysolamour/index/ronde_chiffre2.png',	1,	'2023-07-09 11:02:51',	'2023-07-09 11:39:31'),
(3,	'ronde_chiffre3',	'/uploads/guysolamour/index/ronde_chiffre3.png',	1,	'2023-07-09 11:02:51',	'2023-07-09 11:39:31'),
(4,	'ronde_chiffre4',	'/uploads/guysolamour/index/ronde_chiffre4.png',	1,	'2023-07-09 11:02:51',	'2023-07-09 11:39:31'),
(6,	'ronde_chiffre1',	'/uploads/guysolamour/index/ronde_chiffre1.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(7,	'ronde_chiffre2',	'/uploads/guysolamour/index/ronde_chiffre2.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(8,	'ronde_chiffre3',	'/uploads/guysolamour/index/ronde_chiffre3.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(9,	'ronde_chiffre4',	'/uploads/guysolamour/index/ronde_chiffre4.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(10,	'ronde_chiffre5',	'/uploads/guysolamour/index/ronde_chiffre5.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(11,	'ronde_chiffre6',	'/uploads/guysolamour/index/ronde_chiffre6.png',	1,	'2023-07-09 11:03:47',	'2023-07-09 11:39:31'),
(12,	'ronde_romain1',	'/uploads/guysolamour/index/ronde_romain1.png',	2,	'2023-07-09 11:05:01',	'2023-07-09 11:39:31'),
(13,	'ronde_simple1',	'/uploads/guysolamour/index/ronde_simple1.png',	3,	'2023-07-09 11:06:19',	'2023-07-09 11:39:31'),
(14,	'ronde_simple2',	'/uploads/guysolamour/index/ronde_simple2.png',	3,	'2023-07-09 11:06:19',	'2023-07-09 11:39:31'),
(15,	'ronde_simple3',	'/uploads/guysolamour/index/ronde_simple3.png',	3,	'2023-07-09 11:06:19',	'2023-07-09 11:39:31'),
(16,	'ronde_simple4',	'/uploads/guysolamour/index/ronde_simple4.png',	3,	'2023-07-09 11:06:19',	'2023-07-09 11:39:31'),
(17,	'ronde_simple5',	'/uploads/guysolamour/index/ronde_simple5.png',	3,	'2023-07-09 11:06:19',	'2023-07-09 11:39:31'),
(18,	'carre_chiffre1',	'/uploads/guysolamour/index/carre_chiffre1.png',	5,	'2023-07-09 11:09:21',	'2023-07-09 11:39:31'),
(19,	'carre_simple1',	'/uploads/guysolamour/index/carre_simple1.png',	6,	'2023-07-09 11:09:45',	'2023-07-09 11:39:31'),
(20,	'carre_simple2',	'/uploads/guysolamour/index/carre_simple2.png',	6,	'2023-07-09 11:09:45',	'2023-07-09 11:39:31');

DROP TABLE IF EXISTS `guysolamour_montres`;
CREATE TABLE `guysolamour_montres` (
  `id_montre_client` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bracelet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `id_forme` int DEFAULT NULL,
  `id_index` int DEFAULT NULL,
  `id_index_image` int DEFAULT NULL,
  `id_aiguille` int DEFAULT NULL,
  `id_arriere_plan` int DEFAULT NULL,
  `id_arriere_plan_image` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `texte_fond` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `image_fond` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_montre_client`),
  KEY `id_forme` (`id_forme`),
  KEY `id_index` (`id_index`),
  KEY `id_index_image` (`id_index_image`),
  KEY `id_aiguille` (`id_aiguille`),
  KEY `id_arriere_plan` (`id_arriere_plan`),
  KEY `id_arriere_plan_image` (`id_arriere_plan_image`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `guysolamour_montres_ibfk_1` FOREIGN KEY (`id_forme`) REFERENCES `guysolamour_formes` (`id_forme`),
  CONSTRAINT `guysolamour_montres_ibfk_2` FOREIGN KEY (`id_index`) REFERENCES `guysolamour_index` (`id_index`),
  CONSTRAINT `guysolamour_montres_ibfk_3` FOREIGN KEY (`id_index_image`) REFERENCES `guysolamour_index_media` (`id_index_media`),
  CONSTRAINT `guysolamour_montres_ibfk_4` FOREIGN KEY (`id_aiguille`) REFERENCES `guysolamour_aiguilles` (`id_aiguille`),
  CONSTRAINT `guysolamour_montres_ibfk_5` FOREIGN KEY (`id_arriere_plan`) REFERENCES `guysolamour_arriere_plans` (`id_arriere_plan`),
  CONSTRAINT `guysolamour_montres_ibfk_6` FOREIGN KEY (`id_arriere_plan_image`) REFERENCES `guysolamour_arriere_plans_media` (`id_arriere_plan_media`),
  CONSTRAINT `guysolamour_montres_ibfk_7` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guysolamour_montres` (`id_montre_client`, `nom`, `bracelet`, `id_forme`, `id_index`, `id_index_image`, `id_aiguille`, `id_arriere_plan`, `id_arriere_plan_image`, `id_user`, `texte_fond`, `image_fond`, `created_at`, `updated_at`) VALUES
(3,	'premiere montre',	'{\"couleur\":\"#bf4040\"}',	1,	1,	10,	6,	7,	39,	2,	'{\"texte\":null,\"police\":null,\"couleur\":null,\"positionX\":10,\"positionY\":48}',	'{\"taille\":null}',	'2023-07-17 13:53:00',	'2023-07-17 13:53:00');
INSERT INTO `guysolamour_montres` (`id_montre_client`, `nom`, `bracelet`, `id_forme`, `id_index`, `id_index_image`, `id_aiguille`, `id_arriere_plan`, `id_arriere_plan_image`, `id_user`, `texte_fond`, `image_fond`, `created_at`, `updated_at`) VALUES
INSERT INTO `guysolamour_montres` (`id_montre_client`, `nom`, `bracelet`, `id_forme`, `id_index`, `id_index_image`, `id_aiguille`, `id_arriere_plan`, `id_arriere_plan_image`, `id_user`, `texte_fond`, `image_fond`, `created_at`, `updated_at`) VALUES
(6,	'Montre guysolamour',	'{\"couleur\":\"#000000\"}',	2,	5,	18,	6,	5,	24,	2,	'{\"texte\":\"guy\",\"police\":\"Helvetica, sans-serif\",\"couleur\":null,\"taille\":16,\"positionX\":10,\"positionY\":48}',	'{\"taille\":null,\"image\":null}',	'2023-07-23 10:49:52',	'2023-07-23 10:49:52');

DROP TABLE IF EXISTS `horloge_client`;
CREATE TABLE `horloge_client` (
  `id_horloge_client` int NOT NULL AUTO_INCREMENT,
  `id_forme_horloge` int NOT NULL,
  `id_taille` int DEFAULT NULL,
  `id_couleur_index` int NOT NULL,
  `id_text` int DEFAULT NULL,
  `id_image_perso` int DEFAULT NULL,
  `id_position_image_perso` int NOT NULL,
  `id_arriere_plan` int NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_horloge_client`),
  KEY `id_forme` (`id_forme_horloge`),
  KEY `id_taille` (`id_taille`),
  KEY `id_couleur_index` (`id_couleur_index`),
  KEY `id_user` (`id_user`),
  KEY `id_text` (`id_text`),
  KEY `id_image_perso` (`id_image_perso`),
  KEY `id_position_image_perso` (`id_position_image_perso`),
  KEY `id_arriere_plan` (`id_arriere_plan`),
  CONSTRAINT `horloge_client_ibfk_1` FOREIGN KEY (`id_text`) REFERENCES `texte_horloge` (`id_texte_horloge`),
  CONSTRAINT `horloge_client_ibfk_3` FOREIGN KEY (`id_couleur_index`) REFERENCES `couleur_index` (`id_couleur_index`),
  CONSTRAINT `horloge_client_ibfk_4` FOREIGN KEY (`id_arriere_plan`) REFERENCES `arriere_plan_horloge` (`id_arriere_plan`),
  CONSTRAINT `horloge_client_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `horloge_client_ibfk_6` FOREIGN KEY (`id_image_perso`) REFERENCES `image_perso` (`id_image_perso`) ON UPDATE CASCADE,
  CONSTRAINT `horloge_client_ibfk_7` FOREIGN KEY (`id_forme_horloge`) REFERENCES `forme_horloge` (`id_forme_horloge`),
  CONSTRAINT `horloge_client_ibfk_8` FOREIGN KEY (`id_position_image_perso`) REFERENCES `position_image_perso` (`id_position_image_perso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `image_perso`;
CREATE TABLE `image_perso` (
  `id_image_perso` int NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) NOT NULL,
  `id_user` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_image_perso`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1);

DROP TABLE IF EXISTS `montre_client`;
CREATE TABLE `montre_client` (
  `id_montre_client` int NOT NULL AUTO_INCREMENT,
  `id_forme_montre` int NOT NULL,
  `id_taille_cadran` int NOT NULL,
  `id_couleur_index` int NOT NULL,
  `id_texte_montre` int DEFAULT NULL,
  `id_image_perso` int DEFAULT NULL,
  `id_position_image_perso` int NOT NULL,
  `id_arriere_plan` int NOT NULL,
  `quantite` int DEFAULT NULL,
  `prix` int DEFAULT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_montre_client`),
  KEY `id_forme` (`id_forme_montre`),
  KEY `id_taille` (`id_taille_cadran`),
  KEY `id_couleur_index` (`id_couleur_index`),
  KEY `id_user` (`id_user`),
  KEY `id_text` (`id_texte_montre`),
  KEY `id_image_perso` (`id_image_perso`),
  KEY `id_position_image_perso` (`id_position_image_perso`),
  KEY `id_arriere_plan` (`id_arriere_plan`),
  CONSTRAINT `montre_client_ibfk_1` FOREIGN KEY (`id_arriere_plan`) REFERENCES `arriere_plan_montre` (`id_arriere_plan`) ON UPDATE CASCADE,
  CONSTRAINT `montre_client_ibfk_2` FOREIGN KEY (`id_position_image_perso`) REFERENCES `position_image_perso` (`id_position_image_perso`),
  CONSTRAINT `montre_client_ibfk_3` FOREIGN KEY (`id_forme_montre`) REFERENCES `forme_montre` (`id_forme_montre`) ON UPDATE CASCADE,
  CONSTRAINT `montre_client_ibfk_4` FOREIGN KEY (`id_couleur_index`) REFERENCES `couleur_index` (`id_couleur_index`) ON UPDATE CASCADE,
  CONSTRAINT `montre_client_ibfk_5` FOREIGN KEY (`id_image_perso`) REFERENCES `image_perso` (`id_image_perso`),
  CONSTRAINT `montre_client_ibfk_6` FOREIGN KEY (`id_taille_cadran`) REFERENCES `taille_cadran` (`id_taille_cadran`),
  CONSTRAINT `montre_client_ibfk_7` FOREIGN KEY (`id_texte_montre`) REFERENCES `texte_montre` (`id_texte_montre`) ON DELETE CASCADE,
  CONSTRAINT `montre_client_ibfk_8` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `montre_perso_index`;
CREATE TABLE `montre_perso_index` (
  `id_index` int NOT NULL AUTO_INCREMENT,
  `nom_index` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `montre_perso_index` (`id_index`, `nom_index`, `created_at`, `updated_at`) VALUES
(1,	'Chiffres romains',	'2022-10-24 01:37:13',	'2022-10-24 01:39:01'),
(2,	'Chiffres intégrants',	'2022-10-24 01:38:51',	'2022-10-24 01:38:51'),
(3,	'Traits intégrants',	'2022-10-24 01:40:02',	'2022-10-24 01:40:02'),
(4,	'Chiffres et traits',	'2022-10-24 01:40:21',	'2022-10-24 01:40:21');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `police`;
CREATE TABLE `police` (
  `id_police` int NOT NULL AUTO_INCREMENT,
  `valeur_police` varchar(255) NOT NULL,
  `valeur_anglaise` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_police`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `police` (`id_police`, `valeur_police`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1,	'\'sans-serif\': polices normales sans \'évasement\' (without serifs)',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(2,	'Arial, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(3,	'Helvetica, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(4,	'Verdana, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(5,	'Trebuchet MS, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(6,	'Gill Sans, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(7,	'Noto Sans, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(8,	'Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(9,	'Optima, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(10,	'Arial Narrow, sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(11,	'sans-serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(13,	'Times, Times New Roman, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(14,	'Didot, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(15,	'Georgia, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(16,	'Palatino, URW Palladio L, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(17,	'Bookman, URW Bookman L, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(18,	'New Century Schoolbook, TeX Gyre Schola, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(19,	'American Typewriter, serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(20,	'serif',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(21,	'\'monospace\': chaque caractère à la même largeur',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(22,	'Andale Mono, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(23,	'Courier New, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(24,	'Courier, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(25,	'FreeMono, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(26,	'OCR A Std, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(27,	'DejaVu Sans Mono, monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(28,	'monospace',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(29,	'\'cursive\': polices qui ont un aspect manuscrit',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(30,	'Comic Sans MS, Comic Sans, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(31,	'Apple Chancery, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(32,	'Bradley Hand, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(33,	'Brush Script MT, Brush Script Std, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(34,	'Snell Roundhand, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(35,	'URW Chancery L, cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(36,	'cursive',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(37,	'\'fantasy\': polices décoratives, pour les titres, etc.',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(38,	'Impact, fantasy',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(39,	'Luminari, fantasy',	NULL,	'2022-11-11 20:03:27',	'2022-11-11 20:03:27'),
(40,	'Chalkduster, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(41,	'Jazz LET, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(42,	'Blippo, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(43,	'Stencil Std, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(44,	'Marker Felt, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(45,	'Trattatello, fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28'),
(46,	'fantasy',	NULL,	'2022-11-11 20:03:28',	'2022-11-11 20:03:28');

DROP TABLE IF EXISTS `position_image_perso`;
CREATE TABLE `position_image_perso` (
  `id_position_image_perso` int NOT NULL AUTO_INCREMENT,
  `valeur_position_img` varchar(50) NOT NULL,
  `valeur_anglaise` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_position_image_perso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `position_image_perso` (`id_position_image_perso`, `valeur_position_img`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1,	'Centré',	'',	NULL,	NULL),
(2,	'Aligné à gauche',	'',	NULL,	NULL),
(3,	'Aligné à droite',	'',	NULL,	NULL),
(4,	'Aligné en haut',	'',	NULL,	NULL),
(5,	'Aligné en bas',	'',	NULL,	NULL);

DROP TABLE IF EXISTS `position_texte`;
CREATE TABLE `position_texte` (
  `id_position_texte` int NOT NULL AUTO_INCREMENT,
  `valeur_position` varchar(50) NOT NULL,
  `valeur_anglaise` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_position_texte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `position_texte` (`id_position_texte`, `valeur_position`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1,	'Centré',	'',	NULL,	NULL),
(2,	'Aligné à gauche',	'',	NULL,	NULL),
(3,	'Aligné à droite',	'',	NULL,	NULL),
(4,	'Aligné en haut',	'',	NULL,	NULL),
(5,	'Aligné en bas',	'',	NULL,	NULL);

DROP TABLE IF EXISTS `taille_cadran`;
CREATE TABLE `taille_cadran` (
  `id_taille_cadran` int NOT NULL AUTO_INCREMENT,
  `valeur_taille` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_taille_cadran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `taille_cadran` (`id_taille_cadran`, `valeur_taille`, `created_at`, `updated_at`) VALUES
(1,	32,	NULL,	NULL),
(2,	26,	NULL,	NULL);

DROP TABLE IF EXISTS `texte_horloge`;
CREATE TABLE `texte_horloge` (
  `id_texte_horloge` int NOT NULL AUTO_INCREMENT,
  `id_police` int NOT NULL,
  `taille_police` int NOT NULL,
  `id_couleur` int NOT NULL,
  `id_position_texte` int NOT NULL,
  `contenu_texte` varchar(255) DEFAULT NULL,
  `id_horloge_client` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_texte_horloge`),
  KEY `id_police` (`id_police`),
  KEY `id_couleur` (`id_couleur`),
  KEY `id_position_texte` (`id_position_texte`),
  KEY `id_montre_client` (`id_horloge_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `texte_montre`;
CREATE TABLE `texte_montre` (
  `id_texte_montre` int NOT NULL AUTO_INCREMENT,
  `id_police` int NOT NULL,
  `taille_police` int NOT NULL,
  `id_couleur` int NOT NULL,
  `id_position_texte` int NOT NULL,
  `contenu_texte` varchar(255) DEFAULT NULL,
  `id_montre_client` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_texte_montre`),
  KEY `id_police` (`id_police`),
  KEY `id_couleur` (`id_couleur`),
  KEY `id_position_texte` (`id_position_texte`),
  KEY `id_montre_client` (`id_montre_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `prenoms` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `contact` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id_user`, `nom`, `prenoms`, `email`, `contact`, `password`, `created_at`, `updated_at`) VALUES
(2,	'guy-roland',	'assale',	'rolandassale@aswebagency.com',	'0748393773',	'$2y$10$wUBxXoHBr9IRvK9n/gveS.JN3SP7aqqFwnCejefFzcHLdz6P48Ey.',	NULL,	NULL),
(5,	'kra',	'bahoken marie de couille',	'test@asorf.com',	'789651462',	'$2y$10$QQ29gjS12/KvdSiRQpPhNeLNL4GYKCTWipRjGrebpqN0Zd7Wb6Z5C',	'2023-07-02 12:15:29',	'2023-07-02 12:15:29');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2023-07-23 10:59:39