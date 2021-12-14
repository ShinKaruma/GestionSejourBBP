-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 14 déc. 2021 à 12:22
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sejourbbp`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C509E4FF624BE96D` (`num_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `num_service_id`) VALUES
(10, 2),
(11, 2),
(12, 2),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(1, 4),
(2, 4),
(3, 4),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(8, 6),
(9, 6),
(18, 7);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211116134042', '2021-11-19 15:21:49', 3524),
('DoctrineMigrations\\Version20211122074046', '2021-11-22 07:40:56', 418);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `prenom`, `datenaissance`) VALUES
(1, 'Alfred', 'Fred', '2011-11-02'),
(2, 'Gertrude', 'Claude', '2002-12-14'),
(6, 'Valentin', 'Briim', '2002-05-15'),
(7, 'Antoine', 'Peautiee', '2000-04-29'),
(8, 'michel', 'michel', '2003-07-22'),
(9, 'Bouchez', 'Charly', '2001-12-26'),
(10, 'michel', NULL, '1980-12-20');

-- --------------------------------------------------------

--
-- Structure de la table `sejour`
--

DROP TABLE IF EXISTS `sejour`;
CREATE TABLE IF NOT EXISTS `sejour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_chambre_id` int(11) DEFAULT NULL,
  `num_patient_id` int(11) DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `date_depart` date DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_entree` tinyint(1) NOT NULL DEFAULT '0',
  `validation_depart` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_96F5202814003FDF` (`num_chambre_id`),
  KEY `IDX_96F52028E49ED2F2` (`num_patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sejour`
--

INSERT INTO `sejour` (`id`, `num_chambre_id`, `num_patient_id`, `date_arrivee`, `date_depart`, `commentaire`, `validation_entree`, `validation_depart`) VALUES
(1, 1, 1, '2021-11-16', NULL, NULL, 0, 0),
(2, 2, 2, '2021-11-12', NULL, NULL, 0, 0),
(3, 5, 2, '2021-11-25', NULL, NULL, 0, 0),
(4, 3, 8, '2021-11-23', NULL, NULL, 0, 0),
(5, 5, 6, '2021-11-29', NULL, NULL, 0, 0),
(6, 2, 6, '2021-11-22', '2021-11-24', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `nom`) VALUES
(1, 'Administration'),
(2, 'Radiologie'),
(3, 'Chirurgie'),
(4, 'Cardiologie'),
(5, 'Traumatologie'),
(6, 'Hématologie'),
(7, 'Urologie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_service_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D649624BE96D` (`num_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `num_service_id`, `username`, `roles`, `password`) VALUES
(2, NULL, 'compteDev', '[\"ROLE_USER\", \"ROLE_DEV\"]', '$2y$13$dvIbhe.zh6BNUeK6Fbt11eSL59Hkf/bnXBTPLVYe2O1qigeCn6Xh6'),
(4, NULL, 'compteAdmin', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$SXR3I1y4D.KgvpE2WUV76Ol9qK85dmzy97GaoFdH/OL62SYauiy5S'),
(5, NULL, 'compteInfirmier', '[\"ROLE_USER\", \"ROLE_INFIRMIER\"]', '$2y$13$Ze3WaTXAPbNArkqjAoSimuZVfUc3Jl0RBVCajKGdjHg.Kpw3b5yTW'),
(6, NULL, 'compteTest', '[\"ROLE_USER\", \"ROLE_INFIRMIER\"]', '$2y$13$HJTrujErUGYH.FkIETosweZIWCmw.Rk2t1mpatHlUSdO6lKtqHFCK'),
(7, NULL, 'CompteTest3', '[]', '$2y$13$XvNrxOxzPkywhm8/bTBfB.bsWDd.b4vdCLgdEicKJiMEGsxzXQsoi');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `FK_C509E4FF624BE96D` FOREIGN KEY (`num_service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `sejour`
--
ALTER TABLE `sejour`
  ADD CONSTRAINT `FK_96F5202814003FDF` FOREIGN KEY (`num_chambre_id`) REFERENCES `chambre` (`id`),
  ADD CONSTRAINT `FK_96F52028E49ED2F2` FOREIGN KEY (`num_patient_id`) REFERENCES `patient` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649624BE96D` FOREIGN KEY (`num_service_id`) REFERENCES `service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
