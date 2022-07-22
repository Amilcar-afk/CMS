-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : databaseCms
-- Généré le : dim. 10 juil. 2022 à 21:29
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
-- CREATE DATABASE IF NOT EXISTS `cmsDataBase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `cmsDataBase`;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Categories`
--

CREATE TABLE IF NOT EXISTS `cmspf_Categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('nav','tag') NOT NULL,
  `title` varchar(140) NOT NULL,
  `backgroundColor` varchar(25) DEFAULT NULL,
  `btnColor` varchar(25) DEFAULT NULL,
  `btnTextHoverColor` varchar(25) DEFAULT NULL,
  `btnTextColor` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Categorie_categorie`
--

CREATE TABLE IF NOT EXISTS `cmspf_Categorie_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `categorie_parent_key` int(11) NOT NULL,
  `categorie_child_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Conversations`
--

CREATE TABLE IF NOT EXISTS `cmspf_Conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Messages`
--

CREATE TABLE IF NOT EXISTS `cmspf_Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `publish` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `type` int(11) DEFAULT NULL,
  `user_key` int(11) NOT NULL,
  `conversation_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Newsletters`
--

CREATE TABLE IF NOT EXISTS `cmspf_Newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `date_update` date DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `user_key` int(11) NOT NULL,
  `status` enum('Public','Draft') NOT NULL,
  `content` longtext,
  PRIMARY KEY (`id`,`user_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Newsletter_subscribers`
--

CREATE TABLE IF NOT EXISTS `cmspf_Newsletter_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `user_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Options`
--

CREATE TABLE IF NOT EXISTS `cmspf_Options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('bessels','main_color','second_color','third_color','shadow','radius','background_color','font','image','file','logo','favicon','headCode','footerCode','text_color') NOT NULL,
  `path` varchar(250) DEFAULT NULL,
  `value` text,
  `user_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Pages`
--

CREATE TABLE IF NOT EXISTS `cmspf_Pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `user_key` int(11) NOT NULL,
  `status` enum('Public','Draft','Tag','Nav') DEFAULT NULL,
  `content` longtext,
  `slug` varchar(100) NOT NULL,
  `categorie_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Page_categorie`
--

CREATE TABLE IF NOT EXISTS `cmspf_Page_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_key` int(11) NOT NULL,
  `categorie_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Projets`
--

CREATE TABLE IF NOT EXISTS `cmspf_Projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text,
  `user_key` int(11) NOT NULL,
  `page_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Rdvs`
--

CREATE TABLE IF NOT EXISTS `cmspf_Rdvs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `status` enum('slot','rdv') NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `description` text,
  `rdv_step_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Reseaux_soc`
--

CREATE TABLE IF NOT EXISTS `cmspf_Reseaux_soc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('linkedin','twitter','youtube','tik_tok','instagram') NOT NULL,
  `path` varchar(250) NOT NULL,
  `user_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Stats`
--

CREATE TABLE IF NOT EXISTS `cmspf_Stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `country` char(2) DEFAULT NULL,
  `reseau_soc_key` int(11) DEFAULT NULL,
  `page_key` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `type` enum('view','reseaux_soc') NOT NULL,
  `device` enum('Windows','MacOs','Ios','Android','Other','NULL') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Steps`
--

CREATE TABLE IF NOT EXISTS `cmspf_Steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `projet_key` int(11) NOT NULL,
  `user_key` int(11) NOT NULL,
  PRIMARY KEY (`id`,`projet_key`,`user_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_Users`
--

CREATE TABLE IF NOT EXISTS `cmspf_Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `pwd` varchar(60) NOT NULL,
  `pwd1` varchar(60) DEFAULT NULL,
  `pwd2` varchar(60) DEFAULT NULL,
  `rank` enum('user','admin') DEFAULT NULL,
  `mail` varchar(250) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `confirm` int(11) DEFAULT NULL,
  `token` varchar(60) DEFAULT NULL,
  `date_update_pwd` date DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `tries` int(11) DEFAULT NULL,
  `2FAToken` varchar(60) DEFAULT NULL,
  `2FAKey` char(6) DEFAULT NULL,
  `confirmkey` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_User_conversation`
--

CREATE TABLE IF NOT EXISTS `cmspf_User_conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_key` int(11) NOT NULL,
  `user_key` int(11) NOT NULL,
  `seen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_User_projet`
--

CREATE TABLE IF NOT EXISTS `cmspf_User_projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('owner','customer') NOT NULL,
  `user_key` int(11) NOT NULL,
  `projet_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmspf_User_rdv`
--

CREATE TABLE IF NOT EXISTS `cmspf_User_rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('owner','customer') NOT NULL,
  `user_key` int(11) NOT NULL,
  `rdv_key` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
