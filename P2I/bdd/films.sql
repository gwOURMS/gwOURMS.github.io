-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 07 mars 2024 à 00:17
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
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `Titre` varchar(30) NOT NULL,
  `Réalisateur` varchar(30) NOT NULL,
  `Date` varchar(4) NOT NULL,
  `Synopsis` text NOT NULL,
  `Affiche` varchar(30) NOT NULL,
  `Image1` varchar(30) NOT NULL,
  `Image2` varchar(30) NOT NULL,
  `Image3` varchar(30) NOT NULL,
  `Code` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`Titre`, `Réalisateur`, `Date`, `Synopsis`, `Affiche`, `Image1`, `Image2`, `Image3`, `Code`) VALUES
('Irma Vep', 'Olivier Assayas', '1996', 'La grande star du cinéma asiatique Maggie Cheung débarque à Paris pour reprendre le rôle d\'Irma Vep dans un remake des Vampires, la célèbre série réalisée par Louis Feuillade entre 1915 et 1916, rôle qu\'avait incarné à l\'époque Musidora. En effet, René Vidal, le réalisateur, hanté par le fantôme de Musidora, voit en Maggie la seule actrice digne de reprendre son rôle et de donner vie à une Irma Vep moderne, malgré les problèmes de communications, Maggie Cheung ne parlant pas français et l\'équipe baragouinant en anglais...', 'images/IVaffiche.jpg', 'images/IVpluie.jpg', 'images/IVnavet.jpg', 'images/IVsourire.jpg', 1),
('L\'Impossible Monsieur Bébé', 'Howard Hawks', '1938', 'La rencontre d’une jeune femme du monde, d’un léopard apprivoisé et d’un paléontologue à la recherche d’un os de dinosaure.', 'images/MBaffiche.jpg', 'images/MBbebe.jpg', 'images/MBrobe.jpg', 'images/MBrisque.jpg', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`Code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `Code` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
