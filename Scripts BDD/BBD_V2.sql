-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 19 nov. 2021 à 15:06
-- Version du serveur :  5.7.23
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sejourbbp`
--

-- --------------------------------------------------------


INSERT INTO `service` (`id`, `nom`) VALUES
(1, 'Administration'),
(2, 'Radiologie'),
(3, 'Chirurgie'),
(4, 'Cardiologie'),
(5, 'Traumatologie'),
(6, 'Hématologie'),
(7, 'Urologie');

--
-- Structure de la table `chambre`
--


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


--
-- Déchargement des données de la table `doctrine_migration_versions`
--


-- --------------------------------------------------------

--
-- Structure de la table `patient`
--


--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`) VALUES
(1, 'Alfred'),
(2, 'Gertrude');

-- --------------------------------------------------------

--
-- Structure de la table `sejour`
--


--
-- Déchargement des données de la table `sejour`
--

INSERT INTO `sejour` (`id`, `num_chambre_id`, `num_patient_id`, `date_arrivee`, `date_depart`, `commentaire`) VALUES
(1, 1, 1, '2021-11-16', NULL, NULL),
(2, 2, 2, '2021-11-12', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--


--
-- Déchargement des données de la table `service`
--



-- --------------------------------------------------------

--
-- Structure de la table `user`
--


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambre`


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
