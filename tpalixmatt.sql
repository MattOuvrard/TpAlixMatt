-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 16 juin 2019 à 10:25
-- Version du serveur :  10.1.39-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tpalixmatt`
--

CREATE DATABASE tpalixmatt;
use tpalixmatt;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `suivi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id`, `utilisateur_id`, `suivi_id`) VALUES
(1, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type_de_magie` varchar(50) NOT NULL,
  `maison` varchar(20) DEFAULT NULL,
  `nblike` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id`, `nom`, `prenom`, `nom_utilisateur`, `mot_de_passe`, `age`, `profession`, `description`, `type_de_magie`, `maison`, `nblike`) VALUES
(1, 'Barry', 'Farnigan', 'Fafa', 'Fafa', 32, '', '0', '', 'Griffondor', NULL),
(2, 'Henriette', 'LaGrange', 'Ronron', 'Ronron', 22, '', '0', '', 'Griffondor', NULL),
(3, 'Ulrich', 'Malicum', 'Malefis', 'Malefis', 25, '', '0', '', 'Serpentard', NULL),
(4, 'Peter', 'Parkerer', 'Spidy', 'Spidy', 16, '', '0', '', 'Serdaigle', NULL),
(5, '', '', 'goyave', '$2y$10$0CqFAXoRZzul6XrVuiSVye8WizGcuz4TfZKjn042LPww9XiiCDy..', 0, '', 'Bonjour', '', 'Serpentard', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `contenu` varchar(280) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nb_retweet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id`, `contenu`, `auteur_id`, `date`, `nb_retweet`) VALUES
(1, 'hello world !', 5, '2019-06-15', 0),
(2, 'Bonjour', 5, '2019-06-16', 1),
(3, 'hjjj', 5, '2019-06-16', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
