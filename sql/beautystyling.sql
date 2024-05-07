-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 21 avr. 2024 à 03:37
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `beautystyling`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

CREATE TABLE `effectuer` (
  `id_presta` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `effectuer`
--

INSERT INTO `effectuer` (`id_presta`, `id_employe`) VALUES
(1, 1),
(1, 2),
(1, 8),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 3),
(6, 6),
(7, 1),
(7, 2),
(7, 3),
(7, 8),
(8, 1),
(8, 2),
(8, 3),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id_employe` int(11) NOT NULL,
  `nom_employe` varchar(50) NOT NULL,
  `id_salon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom_employe`, `id_salon`) VALUES
(1, 'Johnny', 1),
(2, 'Jacques', 1),
(3, 'Dorothée', 2),
(4, 'Gertrude', 2),
(5, 'Maria', 3),
(6, 'Takako', 3),
(7, 'Hermine', 4),
(8, 'Thierry', 5);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id_etat` int(11) NOT NULL,
  `libel_etat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `libel_etat`) VALUES
(1, 'En cours'),
(2, 'Reservee'),
(3, 'Realisee'),
(4, 'Annulee');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_detail`
--

CREATE TABLE `ligne_detail` (
  `num_ligne` smallint(6) NOT NULL,
  `id_presta` int(11) NOT NULL,
  `id_rndv` int(11) NOT NULL,
  `qte` smallint(6) NOT NULL CHECK (`qte` > 0),
  `id_employe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne_detail`
--

INSERT INTO `ligne_detail` (`num_ligne`, `id_presta`, `id_rndv`, `qte`, `id_employe`) VALUES
(1, 1, 1, 4, 1),
(2, 1, 2, 1, 1),
(1, 1, 3, 5, 1),
(1, 1, 4, 3, 1),
(1, 1, 5, 3, 1),
(2, 3, 1, 4, 2),
(3, 4, 1, 2, 1),
(1, 5, 2, 5, 1),
(1, 5, 3, 5, 5),
(1, 5, 9, 5, 5),
(1, 5, 10, 4, 5),
(1, 5, 11, 1, 5),
(1, 5, 17, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `offrir`
--

CREATE TABLE `offrir` (
  `id_presta` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `prix_prest_salon` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offrir`
--

INSERT INTO `offrir` (`id_presta`, `id_salon`, `prix_prest_salon`) VALUES
(1, 1, 25.00),
(1, 2, 20.00),
(1, 3, 20.00),
(2, 1, 35.00),
(2, 2, 40.00),
(2, 3, 40.00),
(3, 1, 20.00),
(3, 2, 8.00),
(3, 3, 15.00),
(3, 4, 9.00),
(3, 5, 12.00),
(4, 1, 85.50),
(4, 2, 70.00),
(4, 3, 75.00),
(4, 5, 75.50),
(5, 1, 65.50),
(5, 2, 50.00),
(5, 3, 62.20),
(6, 1, 20.00),
(6, 2, 18.00),
(6, 3, 20.00),
(6, 4, 19.00),
(7, 1, 20.00),
(7, 2, 20.00),
(7, 4, 18.40),
(8, 1, 30.00),
(8, 2, 28.00),
(8, 4, 27.00),
(9, 1, 100.00),
(9, 2, 95.00),
(9, 4, 88.00);

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id_presta` int(11) NOT NULL,
  `nom_presta` varchar(50) NOT NULL,
  `duree_presta` int(11) NOT NULL,
  `desc_presta` varchar(128) DEFAULT NULL,
  `prix_ind_presta` int(7) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modif_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id_presta`, `nom_presta`, `duree_presta`, `desc_presta`, `prix_ind_presta`, `creation_date`, `modif_date`) VALUES
(1, 'Coupe Homme', 3600, 'Coupe ciseaux et tondeuse', 5075, '2024-04-15 23:09:25', '2024-04-20'),
(2, 'Coupe Femme', 3600, 'Coupe ciseaux et peigne', 4000, '2024-04-15 23:09:25', NULL),
(3, 'Shampooing', 3600, 'Shampoing et séchage', 3000, '2024-04-15 23:09:25', '2024-04-21'),
(4, 'Meches', 10800, 'Balayage de couleurs differentes', 4000, '2024-04-15 23:09:25', NULL),
(5, 'Couleur', 7200, 'Couleur integrale', 3000, '2024-04-15 23:09:25', NULL),
(6, 'Coupe Enfant', 1800, '', 2000, '2024-04-15 23:09:25', '2024-04-17'),
(7, 'Barbe Homme', 3600, 'Soins pour la barbe', 2000, '2024-04-15 23:09:25', NULL),
(8, 'Boucle Femme', 3600, '', 3000, '2024-04-15 23:09:25', NULL),
(9, 'Lissage Femme', 3600, ' ', 3000, '2024-04-15 23:09:25', NULL),
(10, 'Une nouvelle prestation', 3600, 'Coupe ciseaux et tondeuse, extras', 5099, '2024-04-16 14:05:12', '2024-04-20'),
(11, 'Encore une prestation', 1800, 'BlahBlahBlah', 9999, '2024-04-20 06:38:37', NULL),
(12, 'pop', 3600, '', 100, '2024-04-20 06:42:41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_rndv` int(11) NOT NULL,
  `h_rndv` time NOT NULL,
  `d_rndv` date NOT NULL,
  `nom_rndv` char(50) NOT NULL,
  `detail_rndv` char(50) DEFAULT NULL,
  `id_etat` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_rndv`, `h_rndv`, `d_rndv`, `nom_rndv`, `detail_rndv`, `id_etat`, `id_client`, `id_salon`) VALUES
(1, '11:00:00', '2024-03-15', 'reservation 1', 'Je veux la coupe de cheveux aux ciseaux', 1, 1, 1),
(2, '10:00:00', '2024-03-13', 'reservation 2', NULL, 1, 1, 1),
(3, '11:30:00', '2024-03-16', 'reservation 3', 'Je veux une teinture verte pour les cheveux', 1, 1, 2),
(4, '14:00:00', '2024-03-18', 'reservation 4', 'Je veux une coupe dégradée', 1, 1, 3),
(5, '14:30:00', '2024-03-19', 'reservation 5', NULL, 1, 1, 4),
(9, '10:00:00', '2024-04-19', 'thierry', '', 1, 1, 4),
(10, '10:00:00', '2024-04-27', 'toto', 'titi', 1, 1, 5),
(11, '10:00:00', '2024-04-30', 'red studio', '', 1, 1, 4),
(17, '13:30:00', '2024-04-26', 'coupe rapide', 'hello i want a coffee', 1, 1, 5);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `reservation_details`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `reservation_details` (
`id_presta` int(11)
,`num_ligne` smallint(6)
,`qte` smallint(6)
,`id_rndv` int(11)
,`id_employe` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `salon`
--

CREATE TABLE `salon` (
  `id_salon` int(11) NOT NULL,
  `nom_res` varchar(20) NOT NULL,
  `prenom_res` varchar(20) NOT NULL,
  `ad_1` varchar(50) NOT NULL,
  `ad_2` varchar(50) DEFAULT NULL,
  `nom_salon` varchar(40) NOT NULL,
  `email_salon` varchar(30) NOT NULL,
  `cp_salon` int(5) NOT NULL,
  `tel_salon` int(11) NOT NULL,
  `url_salon` varchar(50) DEFAULT NULL,
  `photo_salon` varchar(80) DEFAULT NULL,
  `pw_salon` varchar(15) DEFAULT NULL,
  `date_cre` date DEFAULT NULL,
  `nom_ville` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `salon`
--

INSERT INTO `salon` (`id_salon`, `nom_res`, `prenom_res`, `ad_1`, `ad_2`, `nom_salon`, `email_salon`, `cp_salon`, `tel_salon`, `url_salon`, `photo_salon`, `pw_salon`, `date_cre`, `nom_ville`) VALUES
(1, 'CLAIR', 'Agathe', '140 Rue de Créqui', NULL, 'Julie Borne Coiffure Création', 'agt@gmail.com', 69006, 611223344, NULL, 'salon1.jpg', 'dnPf5z9OQz07CBv', '2024-01-01', 'LYON'),
(2, 'Théberge', 'Channing ', '27, Avenue De Marlioz', NULL, 'Salon Antony', 'ChanningTheberge@rhyta.com', 92160, 125547928, 'www.ComedyDiary.fr', 'salon2.jpg', 'Jee1ceeXin', '2024-01-02', 'ANTONY'),
(3, 'Aupry', 'Guy', '81, rue Marie de Médicis', NULL, 'Salon Guy', 'GuyAupry@dayrep.com', 34500, 458098057, 'www.guy-salon.fr', 'salon3.jpg', 'EeW7iechu', '2024-01-03', 'BEZIERS'),
(4, 'Tessier', 'Laurent', '3,  Rue Neuve', NULL, 'Red Studio', 'LaurentTessier@rhyta.com', 69001, 461124244, NULL, 'salon4.jpg', 'eichia4ahS', '2024-01-05', 'LYON'),
(5, 'Magnolia', 'Sciverit', '77, quai Saint-Nicolas', NULL, 'Frédéric Moréno', 'MagnoliaSciverit@rhyta.com', 59200, 365847757, NULL, 'salon5.jpg', 'IeNgangu4u', '2024-01-07', 'TOURCOING');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `spe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `spe` (
`id_salon` int(11)
,`nom_salon` varchar(40)
,`id_presta` int(11)
,`nom_presta` varchar(50)
,`id_employe` int(11)
,`nom_employe` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `reservation_details`
--
DROP TABLE IF EXISTS `reservation_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservation_details`  AS SELECT `ld`.`id_presta` AS `id_presta`, `ld`.`num_ligne` AS `num_ligne`, `ld`.`qte` AS `qte`, `ld`.`id_rndv` AS `id_rndv`, `ld`.`id_employe` AS `id_employe` FROM ((`ligne_detail` `ld` join `reservation` `r` on(`r`.`id_rndv` = `ld`.`id_rndv`)) join `prestation` `p` on(`ld`.`id_presta` = `p`.`id_presta`)) WHERE `r`.`id_client` = 1 ORDER BY `r`.`id_rndv` ASC ;

-- --------------------------------------------------------

--
-- Structure de la vue `spe`
--
DROP TABLE IF EXISTS `spe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `spe`  AS   (select `s`.`id_salon` AS `id_salon`,`s`.`nom_salon` AS `nom_salon`,`p`.`id_presta` AS `id_presta`,`p`.`nom_presta` AS `nom_presta`,`e`.`id_employe` AS `id_employe`,`e`.`nom_employe` AS `nom_employe` from ((((`offrir` `o` join `salon` `s` on(`o`.`id_salon` = `s`.`id_salon`)) join `prestation` `p` on(`o`.`id_presta` = `p`.`id_presta`)) join `effectuer` `ef` on(`o`.`id_presta` = `ef`.`id_presta`)) join `employe` `e` on(`ef`.`id_employe` = `e`.`id_employe` and `ef`.`id_presta` = `o`.`id_presta` and `e`.`id_salon` = `s`.`id_salon`)) order by 1)  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `effectuer`
--
ALTER TABLE `effectuer`
  ADD PRIMARY KEY (`id_presta`,`id_employe`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id_employe`),
  ADD KEY `id_salon` (`id_salon`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `ligne_detail`
--
ALTER TABLE `ligne_detail`
  ADD PRIMARY KEY (`id_presta`,`id_rndv`),
  ADD KEY `id_rndv` (`id_rndv`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Index pour la table `offrir`
--
ALTER TABLE `offrir`
  ADD PRIMARY KEY (`id_presta`,`id_salon`),
  ADD KEY `id_salon` (`id_salon`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id_presta`),
  ADD UNIQUE KEY `nom_presta` (`nom_presta`),
  ADD KEY `idx_nom_presta` (`nom_presta`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_rndv`),
  ADD KEY `id_etat` (`id_etat`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_salon` (`id_salon`);

--
-- Index pour la table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id_salon`),
  ADD UNIQUE KEY `email_salon` (`email_salon`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id_presta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_rndv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `salon`
--
ALTER TABLE `salon`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `effectuer`
--
ALTER TABLE `effectuer`
  ADD CONSTRAINT `effectuer_ibfk_1` FOREIGN KEY (`id_presta`) REFERENCES `prestation` (`id_presta`),
  ADD CONSTRAINT `effectuer_ibfk_2` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`);

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`id_salon`) REFERENCES `salon` (`id_salon`);

--
-- Contraintes pour la table `ligne_detail`
--
ALTER TABLE `ligne_detail`
  ADD CONSTRAINT `ligne_detail_ibfk_1` FOREIGN KEY (`id_presta`) REFERENCES `prestation` (`id_presta`),
  ADD CONSTRAINT `ligne_detail_ibfk_2` FOREIGN KEY (`id_rndv`) REFERENCES `reservation` (`id_rndv`),
  ADD CONSTRAINT `ligne_detail_ibfk_3` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`);

--
-- Contraintes pour la table `offrir`
--
ALTER TABLE `offrir`
  ADD CONSTRAINT `offrir_ibfk_1` FOREIGN KEY (`id_presta`) REFERENCES `prestation` (`id_presta`),
  ADD CONSTRAINT `offrir_ibfk_2` FOREIGN KEY (`id_salon`) REFERENCES `salon` (`id_salon`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id_etat`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_salon`) REFERENCES `salon` (`id_salon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
