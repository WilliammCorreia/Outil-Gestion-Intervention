-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : lun. 18 mars 2024 à 16:19
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `b2-paris`
--

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_note` int NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_ticket` int NOT NULL,
  `id_auteur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_note`, `note`, `id_ticket`, `id_auteur`) VALUES
(1, 'Thomas NEVOUX : Il faut l\'utiliser en HORS DOMAINE', 8, 6),
(2, 'Thomas NEVOUX : 8Go', 9, 6),
(3, 'Thomas NEVOUX : Minimum 8Go', 10, 6),
(4, 'Thomas NEVOUX : Minimum 8Go', 11, 6),
(5, 'William CORREIA : Réaffectation à M. TORIYAMA', 12, 5),
(6, 'William CORREIA : Réaffectation à M. TORIYAMA', 13, 5),
(7, 'William CORREIA : Réaffectation à M. TORIYAMA', 14, 5),
(8, 'William CORREIA : Départ de société de Mme IONESCU le 18/03/2024', 15, 5),
(9, 'Thomas NEVOUX : Merci pour votre aide', 8, 6),
(10, 'Thomas NEVOUX : + Accès libre service ', 8, 6),
(15, 'Thomas NEVOUX : Disponible le 23/03', 9, 6),
(18, 'Thomas NEVOUX : Données à effacer', 13, 6),
(19, 'ADMINISTRATEUR : Panne Général', 8, 1),
(20, 'Nicolas QUEIROS : Quand seriez vous disponible ?', 13, 3),
(21, 'ADMINISTRATEUR : Panne Général', 13, 1),
(22, 'Thomas NEVOUX : Besoin d\'un téléphone fixe avec liste de contact du groupe 510', 16, 6),
(23, 'Thomas NEVOUX : Pas de réponse depuis 10 jours ?', 7, 6),
(24, 'ADMINISTRATEUR : Bonjour, il y a eu un bug dans votre ticket, votre ticket est maintenant réparé. Merci de votre compréhension. Cordialement, Service ADMIN', 7, 1),
(25, 'TETETETE', 17, 6),
(26, 'ADMINISTRATEUR : RAS', 7, 1),
(27, 'Nicolas QUEIROS : Prise de RDV', 7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int NOT NULL,
  `sujet` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `priorite` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `assigne` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `demandeur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_client` int NOT NULL,
  `id_intervenant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `sujet`, `statut`, `priorite`, `assigne`, `demandeur`, `date`, `id_client`, `id_intervenant`) VALUES
(7, 'Ordinateur G9', 'Attente Matériel', 'Urgent', 'Nicolas QUEIROS', 'Thomas NEVOUX', '2024-03-17 14:35:18', 6, 3),
(9, 'Clef Chiffrante', 'En attente', 'normal', 'Nicolas QUEIROS', 'Thomas NEVOUX', '2024-03-17 15:10:03', 6, 0),
(13, 'Réaffectation PC Portable', 'En attente', 'Urgent', 'Nicolas QUEIROS', 'Thomas NEVOUX', '2024-03-17 17:01:36', 6, 3),
(16, 'Téléphone Fixe', 'En attente', 'normal', '-', 'Thomas NEVOUX', '2024-03-18 14:06:11', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_nb` int NOT NULL,
  `statut` enum('client','intervenant','standardiste','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`, `last_name`, `first_name`, `postal_nb`, `statut`) VALUES
(1, 'admin@test.com', '$2y$10$2LJnsTKfaxE0yzTb1IbKvun9gO8cpWPJc.Di2a7Q3F4KJ/UPGfXyW', '2024-01-29 10:35:58', '2024-01-29 10:35:58', 'ADMIN', 'Admin', 0, 'admin'),
(5, 'william@test.com', '$2y$10$Npxl.1x/MLKl/TFDJJqugu8G0EM4ZPk1OKpCuItxZUjMSsh3a8JnG', '2024-03-17 12:25:40', '2024-03-17 12:25:40', 'CORREIA', 'William', 78490, 'standardiste'),
(6, 'thomas@test.com', '$2y$10$LzpsNwc8x0mj8alXjInW6ujEBqGRcROpdq.I7Mw1/xyBgrr9QlCEK', '2024-03-17 12:27:06', '2024-03-17 12:27:06', 'NEVOUX', 'Thomas', 78600, 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
