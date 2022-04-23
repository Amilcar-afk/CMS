-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : databaseCms
-- Généré le : mar. 01 fév. 2022 à 10:51
-- Version du serveur : 5.7.35
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cmsDataBase`
--

-- --------------------------------------------------------

--
-- Structure de la table `cmsp_user`
--

CREATE TABLE `cmsp_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(130) NOT NULL,
  `lastname` varchar(130) NOT NULL,
  `email` varchar(260) NOT NULL,
  `password` varchar(250) NOT NULL,
  `passwordOldFirst` varchar(250) DEFAULT NULL,
  `passwordOldSecond` varchar(250) DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` datetime DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL,
  `rank` int(11) NOT NULL DEFAULT '1',
  `try` int(11) DEFAULT NULL,
  `confirmKey` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cmsp_user`
--
ALTER TABLE `cmsp_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cmsp_user`
--
ALTER TABLE `cmsp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
