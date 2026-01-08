-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 08 jan. 2026 à 15:51
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
-- Base de données : `tomtroc_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `id_user`, `title`, `author`, `content`, `availability`, `picture`, `creation_date`, `date_update`) VALUES
(1, 2, 'The Kinfolk Table', 'Nathan Williams', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '/Website_TomTroc/images/bookDetails.jpg', '2022-05-18 15:27:59', '2025-11-27 15:27:59'),
(2, 2, 'Wabi Sabi', 'Beth Kempton', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '/Website_TomTroc/images/books/wabiSabi.jpg', '2024-07-31 15:33:03', '2025-11-27 15:33:03'),
(3, 1, 'Milk & Honey', 'Rupi Kapur', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '/Website_TomTroc/images/books/milk&honey.jpg', '2025-10-16 08:32:35', '2026-01-06 14:36:20'),
(4, 2, 'Delight', 'Justin Rossow', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '/Website_TomTroc/images/books/delight.jpg', '2025-07-23 08:32:35', '2025-12-04 08:32:35'),
(5, 3, 'Psalms', 'Alabaster', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '/Website_TomTroc/images/books/psalms.jpg', '2025-07-23 08:37:35', '2025-12-04 08:49:49'),
(6, 2, 'Milwaukee Mission', 'Elder Cooper Low', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '/Website_TomTroc/images/books/miwaukeeMission.jpg', '2025-12-01 08:37:35', '2025-12-04 08:49:49'),
(7, 2, 'Minimalist Graphics', 'Julia Schonlau', 'Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam, non nulla levius actitata constaret, post multorum clades Apollinares ambo pater et filius in exilium acti cum ad locum Crateras nomine pervenissent, villam scilicet suam quae ab Antiochia vicensimo et quarto disiungitur lapide, ut mandatum est, fractis cruribus occiduntur.', 1, '/Website_TomTroc/images/books/minimalist.jpg', '2025-12-04 09:49:38', '2025-12-04 09:49:38'),
(8, 1, 'Hygge', 'Meik Wiking', 'Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam, non nulla levius actitata constaret, post multorum clades Apollinares ambo pater et filius in exilium acti cum ad locum Crateras nomine pervenissent, villam scilicet suam quae ab Antiochia vicensimo et quarto disiungitur lapide, ut mandatum est, fractis cruribus occiduntur.', 0, '/Website_TomTroc/images/books/hygge.jpg', '2025-12-04 10:06:33', '2026-01-06 16:34:53'),
(9, 3, 'Esther', 'Alabaster', 'Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam, non nulla levius actitata constaret, post multorum clades Apollinares ambo pater et filius in exilium acti cum ad locum Crateras nomine pervenissent, villam scilicet suam quae ab Antiochia vicensimo et quarto disiungitur lapide, ut mandatum est, fractis cruribus occiduntur.', 0, '/Website_TomTroc/images/books/esther.jpg', '2025-05-14 10:24:12', '2025-12-04 10:24:12'),
(28, 12, 'Hygge', 'Test', 'Test', 0, '/Website_TomTroc/images/books/hygge.jpg', '2026-01-07 13:47:15', '2026-01-07 13:47:24');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_sender`, `id_recipient`, `message`, `is_read`, `creation_date`) VALUES
(1, 4, 1, 'Salut', 0, '2025-12-05 11:28:52'),
(14, 4, 1, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', 0, '2025-12-08 16:01:50'),
(15, 3, 1, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', 0, '2025-12-08 16:45:38'),
(16, 2, 1, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', 0, '2025-12-08 16:46:42'),
(17, 1, 2, 'Salut', 0, '2025-12-08 17:43:58'),
(18, 1, 3, 'Tu vas bien ?', 0, '2025-12-08 17:45:07'),
(20, 3, 1, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', 0, '2025-12-09 11:13:38'),
(21, 1, 3, 'test', 0, '2025-12-18 15:39:26'),
(22, 1, 3, 'Salut', 0, '2025-12-19 15:21:34'),
(23, 1, 4, 'Salut', 0, '2026-01-06 16:36:00'),
(24, 6, 1, 'Bonjour', 0, '2026-01-07 13:30:12'),
(25, 1, 12, 'Salut', 0, '2026-01-07 14:26:42'),
(26, 1, 12, 'Salut', 0, '2026-01-07 14:35:18'),
(32, 1, 12, 'Salut', 0, '2026-01-08 12:33:06');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `user_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `creation_date`, `user_picture`) VALUES
(1, 'JadeOrlire', 'jadeorlire@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2023-11-08 12:15:57', '/Website_TomTroc/images/books/delight.jpg'),
(2, 'Natalire', 'natalire@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2025-07-16 17:33:46', '/Website_TomTroc/images/books/esther.jpg'),
(3, 'JeanneLecture', 'jeanne@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2025-12-04 10:20:42', '/Website_TomTroc/images/books/delight.jpg'),
(4, 'FabSoleil', 'fabsol@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2025-12-04 10:21:24', '/Website_TomTroc/images/books/wabiSabi.jpg'),
(6, 'TomLis', 'tomlis@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2025-12-18 14:05:44', '/Website_TomTroc/images/books/minimalist.jpg'),
(10, 'FabriceLecture', 'fabrice.lecture@gmail.com', '$2y$12$FKYFPSkXVJpAjxiZYN/hXecZcGkUkei0khWL5YZDj7eCb/4gcNxT.', '2026-01-07 12:42:30', '/Website_TomTroc/images/books/milk&honey.jpg'),
(12, 'JejeLu', 'jejelu@gmail.com', '$2y$12$tG4Z30ULCZ5aFXvcM9UMFeGHapJyX1f1XTpmvI30Bcz3h4O4D0Bl6', '2026-01-07 13:46:26', '/Website_TomTroc/images/books/hygge.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_msg_sender` (`id_sender`),
  ADD KEY `idx_msg_recipient` (`id_recipient`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_messaging_recipient` FOREIGN KEY (`id_recipient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_messaging_sender` FOREIGN KEY (`id_sender`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
