-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 08 Novembre 2016 à 14:28
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Test`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(4, 'John O&#39;Callagan'),
(5, 'Sven Väth'),
(6, 'Rank1'),
(7, 'Markus Schuls'),
(8, 'xcxcw');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Classic');

-- --------------------------------------------------------

--
-- Structure de la table `playlist_track`
--

CREATE TABLE `playlist_track` (
  `playlist_id` int(10) NOT NULL,
  `track_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `playlist_user`
--

CREATE TABLE `playlist_user` (
  `playlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `playlist_name` varchar(120) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `playlist_user`
--

INSERT INTO `playlist_user` (`playlist_id`, `user_id`, `playlist_name`, `img_url`) VALUES
(56, 6, 'trucmuch', 'default.png'),
(57, 10, 'sfddsf', 'default.png');

-- --------------------------------------------------------

--
-- Structure de la table `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `authorid` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `genreid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `track`
--

INSERT INTO `track` (`id`, `title`, `authorid`, `year`, `duration`, `genreid`) VALUES
(25, 'LE titre', 6, 2100, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'robert', 'robertdu29', 'robert@bla.fr'),
(2, 'lucien', 'luciendu29', 'lucien@bla.fr'),
(4, 'josé', '$2y$10$r2f6Wzsu8.71ihGZujNWy.cx91ULG52Lu.GDIWc/5vQ2tgwItlEgO', 'none'),
(6, 'admin', '$2y$10$IpNFgqx6reXcODwu5MZm7.bsIHs/vD3P..YAm3Nv89YoHHNjvwrnm', 'none'),
(10, 'root', '$2y$10$YR.ZZOSnQRLxoM9wN.9ZueNHNumko8yJEjTtgIJJwqgYHaRhrJNwu', 'none'),
(11, 'admin', '$2y$10$AzPrN8CIgm5pTcHjHzdgRube3RySD96NdZ9Tt00x1K0snrveS1mfK', 'none');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `playlist_track`
--
ALTER TABLE `playlist_track`
  ADD PRIMARY KEY (`playlist_id`,`track_id`);

--
-- Index pour la table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD PRIMARY KEY (`playlist_id`,`user_id`),
  ADD KEY `Supress_a_user` (`user_id`);

--
-- Index pour la table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`,`authorid`,`genreid`),
  ADD KEY `Delete from author` (`authorid`),
  ADD KEY `Delete from genre` (`genreid`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `playlist_user`
--
ALTER TABLE `playlist_user`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `playlist_track`
--
ALTER TABLE `playlist_track`
  ADD CONSTRAINT `supress` FOREIGN KEY (`playlist_id`) REFERENCES `playlist_user` (`playlist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD CONSTRAINT `Supress_a_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `Delete from author` FOREIGN KEY (`authorid`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Delete from genre` FOREIGN KEY (`genreid`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
