-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 27 mars 2022 à 15:15
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plumeo`
--

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

CREATE TABLE `discussion` (
  `id_discussion` int(11) NOT NULL,
  `FK_user1` int(11) NOT NULL,
  `FK_user2` int(11) NOT NULL,
  `date_crea` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id_discussion`, `FK_user1`, `FK_user2`, `date_crea`, `isDeleted`) VALUES
(1, 1, 2, '2022-03-27 11:11:16', 0),
(2, 1, 3, '2022-03-27 11:11:17', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `msg_text` text NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FK_id_user` int(11) NOT NULL,
  `FK_id_discussion` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `msg_text`, `msg_time`, `FK_id_user`, `FK_id_discussion`, `isDeleted`) VALUES
(1, 'Coucou bébé', '2022-03-26 09:28:51', 1, 1, 0),
(2, 'Coucou beb comment tu vas ?', '2022-03-26 09:28:51', 2, 1, 0),
(3, 'Yo mec', '2022-03-26 09:28:51', 3, 2, 0),
(4, 'Salut ma gueule en mode tn lacoste ou bien ?', '2022-03-26 09:28:51', 1, 2, 0),
(5, 'BEBEBEBEBEBEEEEE', '2022-03-26 16:26:27', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_crea` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar_lien` varchar(100) NOT NULL DEFAULT 'Portrait_Placeholder.png',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `password`, `mail`, `date_crea`, `avatar_lien`, `isDeleted`) VALUES
(1, 'Raillard', 'Lwi', 'elisa', 'lwi@gmail.com', '2022-03-26 09:20:38', 'Portrait_Placeholder.png', 0),
(2, 'Saucisse', 'Elisa', 'lwi', 'elisa@gmail.com', '2022-03-26 09:22:31', 'Portrait_Placeholder.png', 0),
(3, 'Burcez', 'Jule', 'coucou', 'jules@gmail.com', '2022-03-26 09:23:00', 'Portrait_Placeholder.png', 0),
(4, 'Le Goff', 'Guillaume', 'guitoune', 'guigui@gmail.com', '2022-03-26 09:24:08', 'Portrait_Placeholder.png', 0),
(5, 'Schaeffer', 'Alexandre', 'alex', 'alex@gmail.com', '2022-03-26 09:24:08', 'Portrait_Placeholder.png', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id_discussion`),
  ADD KEY `FK_user1` (`FK_user1`),
  ADD KEY `FK_user2` (`FK_user2`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `FK_id_discussion` (`FK_id_discussion`),
  ADD KEY `FK_id_user` (`FK_id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id_discussion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`FK_user1`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`FK_user2`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_id_discussion` FOREIGN KEY (`FK_id_discussion`) REFERENCES `discussion` (`id_discussion`),
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`FK_id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
