-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 08 déc. 2024 à 14:09
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
-- Base de données : `ecolebdd`
--

-- --------------------------------------------------------

---
--- L'admin de la BDD
---

DROP USER IF EXISTS 'adminbdd'@'localhost';
CREATE USER 'adminbdd'@'localhost' IDENTIFIED BY 'bddconnect';
GRANT ALL PRIVILEGES ON ecolebdd.* TO 'adminbdd'@'localhost';
FLUSH PRIVILEGES;


--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'adminecole', 'helloworld');

-- --------------------------------------------------------

--
-- Structure de la table `appreciations`
--

CREATE TABLE `appreciations` (
  `id_appreciation` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appreciations`
--

INSERT INTO `appreciations` (`id_appreciation`, `id_eleve`, `id_matiere`, `commentaire`) VALUES
(1, 34, 1, 'Excellent élève, Albus a su faire preuve de rigueur et de discipline.');

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id_classe` int(11) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `id_profprincip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id_classe`, `niveau`, `id_profprincip`) VALUES
(1, '6ème', 3),
(2, '5ème', 5),
(3, '4ème', 1),
(4, '3ème', 4);

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id_eleve` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prénom` varchar(100) NOT NULL,
  `Sexe` enum('M','F') NOT NULL,
  `id_classe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`id_eleve`, `Nom`, `Prénom`, `Sexe`, `id_classe`) VALUES
(1, 'DiCaprio', 'Leonardo', 'M', 1),
(2, 'Washington', 'Denzel', 'M', 1),
(3, 'Meryl', 'Streep', 'F', 1),
(4, 'Johansson', 'Scarlett', 'F', 1),
(5, 'Pitt', 'Brad', 'M', 1),
(6, 'Portman', 'Natalie', 'F', 1),
(7, 'De Niro', 'Robert', 'M', 1),
(8, 'Robbie', 'Margot', 'F', 1),
(9, 'Hanks', 'Tom', 'M', 1),
(10, 'Lawrence', 'Jennifer', 'F', 1),
(11, 'Stark', 'Tony', 'M', 2),
(12, 'Romanoff', 'Natasha', 'F', 2),
(13, 'Parker', 'Peter', 'M', 2),
(14, 'Maximoff', 'Wanda', 'F', 2),
(15, 'Odinson', 'Thor', 'M', 2),
(16, 'Danvers', 'Carol', 'F', 2),
(17, 'Strange', 'Stephen', 'M', 2),
(18, 'Grey', 'Jean', 'F', 2),
(19, 'Barton', 'Clint', 'M', 2),
(20, 'Munroe', 'Ororo', 'F', 2),
(21, 'Wayne', 'Bruce', 'M', 3),
(22, 'Prince', 'Diana', 'F', 3),
(23, 'Kent', 'Clark', 'M', 3),
(24, 'Quinzel', 'Harleen', 'F', 3),
(25, 'Allen', 'Barry', 'M', 3),
(26, 'Kyle', 'Selina', 'F', 3),
(27, 'Curry', 'Arthur', 'M', 3),
(28, 'Zatara', 'Zatanna', 'F', 3),
(29, 'Jordan', 'Hal', 'M', 3),
(30, 'Lance', 'Dinah', 'F', 3),
(31, 'Potter', 'Harry', 'M', 4),
(32, 'Granger', 'Hermione', 'F', 4),
(33, 'Weasley', 'Ron', 'M', 4),
(34, 'Dumbledore', 'Albus', 'M', 4),
(35, 'Rogue', 'Severus', 'M', 4),
(36, 'Malfoy', 'Draco', 'M', 4),
(37, 'Lovegood', 'Luna', 'F', 4),
(38, 'Black', 'Sirius', 'F', 4),
(39, 'Jedusor', 'Tom', 'M', 4),
(40, 'Lestrange', 'Bellatrix', 'F', 4),
(42, 'Statham', 'Jason', 'M', 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `id_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `Nom`, `id_prof`) VALUES
(1, 'Mathématiques', 1),
(2, 'Français', 2),
(3, 'Histoire-Géographie', 3),
(4, 'Sciences', 4),
(5, 'Anglais', 5),
(6, 'Espagnol', 6),
(7, 'Éducation Physique (EPS)', 7),
(8, 'Technologie', 8),
(9, 'Arts Plastiques', 9),
(10, 'Musique', 10);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id_note` int(11) NOT NULL,
  `valeur` decimal(4,2) DEFAULT NULL CHECK (`valeur` between 0 and 20),
  `id_eleve` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id_note`, `valeur`, `id_eleve`, `id_matiere`) VALUES
(34, 18.00, 34, 1);

-- --------------------------------------------------------

--
-- Structure de la table `profs`
--

CREATE TABLE `profs` (
  `id_prof` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prénom` varchar(100) NOT NULL,
  `Sexe` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profs`
--

INSERT INTO `profs` (`id_prof`, `Nom`, `Prénom`, `Sexe`) VALUES
(1, 'Dupont', 'Marie', 'F'),
(2, 'Martin', 'Sophie', 'F'),
(3, 'Bernard', 'Pierre', 'M'),
(4, 'Leroy', 'Julien', 'M'),
(5, 'Moreau', 'Claire', 'F'),
(6, 'Dubois', 'Luc', 'M'),
(7, 'Petit', 'Nathalie', 'F'),
(8, 'Garnier', 'Paul', 'M'),
(9, 'Lefevre', 'Isabelle', 'F'),
(10, 'Rousseau', 'Jean', 'M');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `appreciations`
--
ALTER TABLE `appreciations`
  ADD PRIMARY KEY (`id_appreciation`),
  ADD KEY `id_eleve` (`id_eleve`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `id_profprincip` (`id_profprincip`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_eleve` (`id_eleve`),
  ADD KEY `id_matiere` (`id_matiere`);

--
-- Index pour la table `profs`
--
ALTER TABLE `profs`
  ADD PRIMARY KEY (`id_prof`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `appreciations`
--
ALTER TABLE `appreciations`
  MODIFY `id_appreciation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `profs`
--
ALTER TABLE `profs`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appreciations`
--
ALTER TABLE `appreciations`
  ADD CONSTRAINT `appreciations_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleves` (`id_eleve`),
  ADD CONSTRAINT `appreciations_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`);

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`id_profprincip`) REFERENCES `profs` (`id_prof`);

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`);

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `profs` (`id_prof`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleves` (`id_eleve`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
