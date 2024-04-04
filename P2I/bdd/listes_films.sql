-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 06 mars 2024 à 22:35
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ozusquare`
--

-- --------------------------------------------------------

--
-- Structure de la table `listes_films`
--

CREATE TABLE `listes_films` (
  `id_film` int(255) NOT NULL,
  `id_liste` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `listes_films`
--
ALTER TABLE `listes_films`
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_liste` (`id_liste`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `listes_films`
--
ALTER TABLE `listes_films`
  ADD CONSTRAINT `listes_films_ibfk_1` FOREIGN KEY (`id_liste`) REFERENCES `listes` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `listes_films_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `films` (`Code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
