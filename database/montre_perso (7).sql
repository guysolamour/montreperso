-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 13 juin 2023 à 14:35
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `montre_perso`
--

-- --------------------------------------------------------

--
-- Structure de la table `arriere_plan_horloge`
--

CREATE TABLE `arriere_plan_horloge` (
  `id_arriere_plan` int(11) NOT NULL,
  `nom_arriere_plan` varchar(255) NOT NULL,
  `image_arriere_plan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `arriere_plan_horloge`
--

INSERT INTO `arriere_plan_horloge` (`id_arriere_plan`, `nom_arriere_plan`, `image_arriere_plan`, `created_at`, `updated_at`) VALUES
(5, 'arrière plan1', '20221026114858.jpg', '2022-10-26 11:48:58', '2022-10-26 11:48:58'),
(6, 'arrière plan2', '20221026120855.jpg', '2022-10-26 12:08:55', '2022-10-26 12:08:55'),
(7, 'arrière plan ok', '20221026140520.jpg', '2022-10-26 14:03:41', '2022-10-26 14:05:20');

-- --------------------------------------------------------

--
-- Structure de la table `arriere_plan_montre`
--

CREATE TABLE `arriere_plan_montre` (
  `id_arriere_plan` int(11) NOT NULL,
  `nom_arriere_plan` varchar(255) NOT NULL,
  `image_arriere_plan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `arriere_plan_montre`
--

INSERT INTO `arriere_plan_montre` (`id_arriere_plan`, `nom_arriere_plan`, `image_arriere_plan`, `created_at`, `updated_at`) VALUES
(3, 'arrière plan1', '20221024013304.jpg', '2022-10-24 01:33:04', '2022-10-24 01:33:04'),
(4, 'arrière plan2', '20221026141504.png', '2022-10-24 01:33:42', '2022-10-28 00:37:30');

-- --------------------------------------------------------

--
-- Structure de la table `couleur_bracelet`
--

CREATE TABLE `couleur_bracelet` (
  `id_couleur_bracelet` int(11) NOT NULL,
  `nom_couleur` varchar(100) NOT NULL,
  `image_bracelet_couleur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleur_bracelet`
--

INSERT INTO `couleur_bracelet` (`id_couleur_bracelet`, `nom_couleur`, `image_bracelet_couleur`, `created_at`, `updated_at`) VALUES
(2, 'bracelet1', '20221026234049.jpg', '2022-10-26 23:40:49', '2022-10-26 23:40:49'),
(3, 'bracelet2', '20221026234104.jpg', '2022-10-26 23:41:04', '2022-10-26 23:41:04');

-- --------------------------------------------------------

--
-- Structure de la table `couleur_index`
--

CREATE TABLE `couleur_index` (
  `id_couleur_index` int(11) NOT NULL,
  `nom_couleur` varchar(255) NOT NULL,
  `image_couleur_index` varchar(255) NOT NULL,
  `id_index` int(11) NOT NULL,
  `id_forme_montre` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleur_index`
--

INSERT INTO `couleur_index` (`id_couleur_index`, `nom_couleur`, `image_couleur_index`, `id_index`, `id_forme_montre`, `created_at`, `updated_at`) VALUES
(1, 'Orange', '20221026174204.png', 2, 1, '2022-10-26 17:42:04', '2022-10-27 14:16:38'),
(2, 'Noir', '20221026180510.png', 2, 1, '2022-10-26 17:59:45', '2022-10-27 14:17:44'),
(3, 'Noir', '20230517162129.png', 1, 2, '2023-05-17 16:21:29', '2023-05-17 16:21:29');

-- --------------------------------------------------------

--
-- Structure de la table `forme_horloge`
--

CREATE TABLE `forme_horloge` (
  `id_forme_horloge` int(11) NOT NULL,
  `libelle_forme` varchar(100) NOT NULL,
  `image_forme` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forme_horloge`
--

INSERT INTO `forme_horloge` (`id_forme_horloge`, `libelle_forme`, `image_forme`, `created_at`, `updated_at`) VALUES
(6, 'Forme1', '20221101143202.jpg', '2022-11-01 14:28:51', '2022-11-01 14:32:02');

-- --------------------------------------------------------

--
-- Structure de la table `forme_montre`
--

CREATE TABLE `forme_montre` (
  `id_forme_montre` int(11) NOT NULL,
  `libelle_forme` varchar(100) NOT NULL,
  `image_forme` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forme_montre`
--

INSERT INTO `forme_montre` (`id_forme_montre`, `libelle_forme`, `image_forme`, `created_at`, `updated_at`) VALUES
(1, 'Ronde', '20221027133130.png', '2022-10-27 13:31:30', '2022-10-27 13:31:30'),
(2, 'Carrée', '20221027134147.png', '2022-10-27 13:41:47', '2022-10-27 13:41:47');

-- --------------------------------------------------------

--
-- Structure de la table `horloge_client`
--

CREATE TABLE `horloge_client` (
  `id_horloge_client` int(11) NOT NULL,
  `id_forme_horloge` int(11) NOT NULL,
  `id_taille` int(11) DEFAULT NULL,
  `id_couleur_index` int(11) NOT NULL,
  `id_text` int(11) DEFAULT NULL,
  `id_image_perso` int(11) DEFAULT NULL,
  `id_position_image_perso` int(11) NOT NULL,
  `id_arriere_plan` int(11) NOT NULL,
  `quantite` int(4) DEFAULT NULL,
  `prix` int(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image_perso`
--

CREATE TABLE `image_perso` (
  `id_image_perso` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `montre_client`
--

CREATE TABLE `montre_client` (
  `id_montre_client` int(11) NOT NULL,
  `id_forme_montre` int(11) NOT NULL,
  `id_taille_cadran` int(11) NOT NULL,
  `id_couleur_index` int(11) NOT NULL,
  `id_texte_montre` int(11) DEFAULT NULL,
  `id_image_perso` int(11) DEFAULT NULL,
  `id_position_image_perso` int(11) NOT NULL,
  `id_arriere_plan` int(11) NOT NULL,
  `quantite` int(4) DEFAULT NULL,
  `prix` int(6) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `montre_perso_index`
--

CREATE TABLE `montre_perso_index` (
  `id_index` int(11) NOT NULL,
  `nom_index` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `montre_perso_index`
--

INSERT INTO `montre_perso_index` (`id_index`, `nom_index`, `created_at`, `updated_at`) VALUES
(1, 'Chiffres romains', '2022-10-24 01:37:13', '2022-10-24 01:39:01'),
(2, 'Chiffres intégrants', '2022-10-24 01:38:51', '2022-10-24 01:38:51'),
(3, 'Traits intégrants', '2022-10-24 01:40:02', '2022-10-24 01:40:02'),
(4, 'Chiffres et traits', '2022-10-24 01:40:21', '2022-10-24 01:40:21');

-- --------------------------------------------------------

--
-- Structure de la table `police`
--

CREATE TABLE `police` (
  `id_police` int(11) NOT NULL,
  `valeur_police` varchar(255) NOT NULL,
  `valeur_anglaise` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `police`
--

INSERT INTO `police` (`id_police`, `valeur_police`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1, '\'sans-serif\': polices normales sans \'évasement\' (without serifs)', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(2, 'Arial, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(3, 'Helvetica, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(4, 'Verdana, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(5, 'Trebuchet MS, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(6, 'Gill Sans, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(7, 'Noto Sans, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(8, 'Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(9, 'Optima, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(10, 'Arial Narrow, sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(11, 'sans-serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(13, 'Times, Times New Roman, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(14, 'Didot, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(15, 'Georgia, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(16, 'Palatino, URW Palladio L, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(17, 'Bookman, URW Bookman L, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(18, 'New Century Schoolbook, TeX Gyre Schola, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(19, 'American Typewriter, serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(20, 'serif', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(21, '\'monospace\': chaque caractère à la même largeur', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(22, 'Andale Mono, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(23, 'Courier New, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(24, 'Courier, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(25, 'FreeMono, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(26, 'OCR A Std, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(27, 'DejaVu Sans Mono, monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(28, 'monospace', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(29, '\'cursive\': polices qui ont un aspect manuscrit', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(30, 'Comic Sans MS, Comic Sans, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(31, 'Apple Chancery, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(32, 'Bradley Hand, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(33, 'Brush Script MT, Brush Script Std, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(34, 'Snell Roundhand, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(35, 'URW Chancery L, cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(36, 'cursive', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(37, '\'fantasy\': polices décoratives, pour les titres, etc.', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(38, 'Impact, fantasy', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(39, 'Luminari, fantasy', NULL, '2022-11-11 20:03:27', '2022-11-11 20:03:27'),
(40, 'Chalkduster, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(41, 'Jazz LET, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(42, 'Blippo, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(43, 'Stencil Std, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(44, 'Marker Felt, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(45, 'Trattatello, fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28'),
(46, 'fantasy', NULL, '2022-11-11 20:03:28', '2022-11-11 20:03:28');

-- --------------------------------------------------------

--
-- Structure de la table `position_image_perso`
--

CREATE TABLE `position_image_perso` (
  `id_position_image_perso` int(11) NOT NULL,
  `valeur_position_img` varchar(50) NOT NULL,
  `valeur_anglaise` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `position_image_perso`
--

INSERT INTO `position_image_perso` (`id_position_image_perso`, `valeur_position_img`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1, 'Centré', '', NULL, NULL),
(2, 'Aligné à gauche', '', NULL, NULL),
(3, 'Aligné à droite', '', NULL, NULL),
(4, 'Aligné en haut', '', NULL, NULL),
(5, 'Aligné en bas', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `position_texte`
--

CREATE TABLE `position_texte` (
  `id_position_texte` int(11) NOT NULL,
  `valeur_position` varchar(50) NOT NULL,
  `valeur_anglaise` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `position_texte`
--

INSERT INTO `position_texte` (`id_position_texte`, `valeur_position`, `valeur_anglaise`, `created_at`, `updated_at`) VALUES
(1, 'Centré', '', NULL, NULL),
(2, 'Aligné à gauche', '', NULL, NULL),
(3, 'Aligné à droite', '', NULL, NULL),
(4, 'Aligné en haut', '', NULL, NULL),
(5, 'Aligné en bas', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `taille_cadran`
--

CREATE TABLE `taille_cadran` (
  `id_taille_cadran` int(11) NOT NULL,
  `valeur_taille` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taille_cadran`
--

INSERT INTO `taille_cadran` (`id_taille_cadran`, `valeur_taille`, `created_at`, `updated_at`) VALUES
(1, 32, NULL, NULL),
(2, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `texte_horloge`
--

CREATE TABLE `texte_horloge` (
  `id_texte_horloge` int(11) NOT NULL,
  `id_police` int(11) NOT NULL,
  `taille_police` int(4) NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `id_position_texte` int(11) NOT NULL,
  `contenu_texte` varchar(255) DEFAULT NULL,
  `id_horloge_client` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `texte_montre`
--

CREATE TABLE `texte_montre` (
  `id_texte_montre` int(11) NOT NULL,
  `id_police` int(11) NOT NULL,
  `taille_police` int(4) NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `id_position_texte` int(11) NOT NULL,
  `contenu_texte` varchar(255) DEFAULT NULL,
  `id_montre_client` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenoms`, `contact`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '07000000', '000000', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arriere_plan_horloge`
--
ALTER TABLE `arriere_plan_horloge`
  ADD PRIMARY KEY (`id_arriere_plan`);

--
-- Index pour la table `arriere_plan_montre`
--
ALTER TABLE `arriere_plan_montre`
  ADD PRIMARY KEY (`id_arriere_plan`);

--
-- Index pour la table `couleur_bracelet`
--
ALTER TABLE `couleur_bracelet`
  ADD PRIMARY KEY (`id_couleur_bracelet`);

--
-- Index pour la table `couleur_index`
--
ALTER TABLE `couleur_index`
  ADD PRIMARY KEY (`id_couleur_index`),
  ADD KEY `id_index` (`id_index`),
  ADD KEY `id_forme_montre` (`id_forme_montre`);

--
-- Index pour la table `forme_horloge`
--
ALTER TABLE `forme_horloge`
  ADD PRIMARY KEY (`id_forme_horloge`);

--
-- Index pour la table `forme_montre`
--
ALTER TABLE `forme_montre`
  ADD PRIMARY KEY (`id_forme_montre`);

--
-- Index pour la table `horloge_client`
--
ALTER TABLE `horloge_client`
  ADD PRIMARY KEY (`id_horloge_client`),
  ADD KEY `id_forme` (`id_forme_horloge`),
  ADD KEY `id_taille` (`id_taille`),
  ADD KEY `id_couleur_index` (`id_couleur_index`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_text` (`id_text`),
  ADD KEY `id_image_perso` (`id_image_perso`),
  ADD KEY `id_position_image_perso` (`id_position_image_perso`),
  ADD KEY `id_arriere_plan` (`id_arriere_plan`);

--
-- Index pour la table `image_perso`
--
ALTER TABLE `image_perso`
  ADD PRIMARY KEY (`id_image_perso`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `montre_client`
--
ALTER TABLE `montre_client`
  ADD PRIMARY KEY (`id_montre_client`),
  ADD KEY `id_forme` (`id_forme_montre`),
  ADD KEY `id_taille` (`id_taille_cadran`),
  ADD KEY `id_couleur_index` (`id_couleur_index`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_text` (`id_texte_montre`),
  ADD KEY `id_image_perso` (`id_image_perso`),
  ADD KEY `id_position_image_perso` (`id_position_image_perso`),
  ADD KEY `id_arriere_plan` (`id_arriere_plan`);

--
-- Index pour la table `montre_perso_index`
--
ALTER TABLE `montre_perso_index`
  ADD PRIMARY KEY (`id_index`);

--
-- Index pour la table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`id_police`);

--
-- Index pour la table `position_image_perso`
--
ALTER TABLE `position_image_perso`
  ADD PRIMARY KEY (`id_position_image_perso`);

--
-- Index pour la table `position_texte`
--
ALTER TABLE `position_texte`
  ADD PRIMARY KEY (`id_position_texte`);

--
-- Index pour la table `taille_cadran`
--
ALTER TABLE `taille_cadran`
  ADD PRIMARY KEY (`id_taille_cadran`);

--
-- Index pour la table `texte_horloge`
--
ALTER TABLE `texte_horloge`
  ADD PRIMARY KEY (`id_texte_horloge`),
  ADD KEY `id_police` (`id_police`),
  ADD KEY `id_couleur` (`id_couleur`),
  ADD KEY `id_position_texte` (`id_position_texte`),
  ADD KEY `id_montre_client` (`id_horloge_client`);

--
-- Index pour la table `texte_montre`
--
ALTER TABLE `texte_montre`
  ADD PRIMARY KEY (`id_texte_montre`),
  ADD KEY `id_police` (`id_police`),
  ADD KEY `id_couleur` (`id_couleur`),
  ADD KEY `id_position_texte` (`id_position_texte`),
  ADD KEY `id_montre_client` (`id_montre_client`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arriere_plan_horloge`
--
ALTER TABLE `arriere_plan_horloge`
  MODIFY `id_arriere_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `arriere_plan_montre`
--
ALTER TABLE `arriere_plan_montre`
  MODIFY `id_arriere_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `couleur_bracelet`
--
ALTER TABLE `couleur_bracelet`
  MODIFY `id_couleur_bracelet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `couleur_index`
--
ALTER TABLE `couleur_index`
  MODIFY `id_couleur_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `forme_horloge`
--
ALTER TABLE `forme_horloge`
  MODIFY `id_forme_horloge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `forme_montre`
--
ALTER TABLE `forme_montre`
  MODIFY `id_forme_montre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `horloge_client`
--
ALTER TABLE `horloge_client`
  MODIFY `id_horloge_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image_perso`
--
ALTER TABLE `image_perso`
  MODIFY `id_image_perso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `montre_client`
--
ALTER TABLE `montre_client`
  MODIFY `id_montre_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `montre_perso_index`
--
ALTER TABLE `montre_perso_index`
  MODIFY `id_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `police`
--
ALTER TABLE `police`
  MODIFY `id_police` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `position_image_perso`
--
ALTER TABLE `position_image_perso`
  MODIFY `id_position_image_perso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `position_texte`
--
ALTER TABLE `position_texte`
  MODIFY `id_position_texte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `taille_cadran`
--
ALTER TABLE `taille_cadran`
  MODIFY `id_taille_cadran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `texte_horloge`
--
ALTER TABLE `texte_horloge`
  MODIFY `id_texte_horloge` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `texte_montre`
--
ALTER TABLE `texte_montre`
  MODIFY `id_texte_montre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `couleur_index`
--
ALTER TABLE `couleur_index`
  ADD CONSTRAINT `couleur_index_ibfk_1` FOREIGN KEY (`id_index`) REFERENCES `montre_perso_index` (`id_index`),
  ADD CONSTRAINT `couleur_index_ibfk_2` FOREIGN KEY (`id_forme_montre`) REFERENCES `forme_montre` (`id_forme_montre`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `horloge_client`
--
ALTER TABLE `horloge_client`
  ADD CONSTRAINT `horloge_client_ibfk_1` FOREIGN KEY (`id_text`) REFERENCES `texte_horloge` (`id_texte_horloge`),
  ADD CONSTRAINT `horloge_client_ibfk_3` FOREIGN KEY (`id_couleur_index`) REFERENCES `couleur_index` (`id_couleur_index`),
  ADD CONSTRAINT `horloge_client_ibfk_4` FOREIGN KEY (`id_arriere_plan`) REFERENCES `arriere_plan_horloge` (`id_arriere_plan`),
  ADD CONSTRAINT `horloge_client_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `horloge_client_ibfk_6` FOREIGN KEY (`id_image_perso`) REFERENCES `image_perso` (`id_image_perso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `horloge_client_ibfk_7` FOREIGN KEY (`id_forme_horloge`) REFERENCES `forme_horloge` (`id_forme_horloge`),
  ADD CONSTRAINT `horloge_client_ibfk_8` FOREIGN KEY (`id_position_image_perso`) REFERENCES `position_image_perso` (`id_position_image_perso`);

--
-- Contraintes pour la table `montre_client`
--
ALTER TABLE `montre_client`
  ADD CONSTRAINT `montre_client_ibfk_1` FOREIGN KEY (`id_arriere_plan`) REFERENCES `arriere_plan_montre` (`id_arriere_plan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `montre_client_ibfk_2` FOREIGN KEY (`id_position_image_perso`) REFERENCES `position_image_perso` (`id_position_image_perso`),
  ADD CONSTRAINT `montre_client_ibfk_3` FOREIGN KEY (`id_forme_montre`) REFERENCES `forme_montre` (`id_forme_montre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `montre_client_ibfk_4` FOREIGN KEY (`id_couleur_index`) REFERENCES `couleur_index` (`id_couleur_index`) ON UPDATE CASCADE,
  ADD CONSTRAINT `montre_client_ibfk_5` FOREIGN KEY (`id_image_perso`) REFERENCES `image_perso` (`id_image_perso`),
  ADD CONSTRAINT `montre_client_ibfk_6` FOREIGN KEY (`id_taille_cadran`) REFERENCES `taille_cadran` (`id_taille_cadran`),
  ADD CONSTRAINT `montre_client_ibfk_7` FOREIGN KEY (`id_texte_montre`) REFERENCES `texte_montre` (`id_texte_montre`) ON DELETE CASCADE,
  ADD CONSTRAINT `montre_client_ibfk_8` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
