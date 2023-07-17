-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 juil. 2023 à 12:08
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

CREATE DATABASE IF NOT EXISTS instatome;

USE instatome;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `instatome`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_user` bigint NOT NULL,
  `id_post` bigint NOT NULL,
  `contenu` text,
  `date_heure` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`,`id_post`),
  KEY `id_post` (`id_post`)
)

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `id_user` bigint NOT NULL,
  `id_user_follow` bigint NOT NULL,
  PRIMARY KEY (`id_user`,`id_user_follow`),
  KEY `id_user_follow` (`id_user_follow`)
)

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_user` bigint NOT NULL,
  `id_post` bigint NOT NULL,
  PRIMARY KEY (`id_user`,`id_post`),
  KEY `id_post` (`id_post`)
)

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_user` bigint NOT NULL,
  `id_user_send` bigint NOT NULL,
  `date_heure` datetime NOT NULL,
  `content` text,
  PRIMARY KEY (`id_user`,`id_user_send`),
  KEY `id_user_send` (`id_user_send`)
)

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` bigint NOT NULL AUTO_INCREMENT,
  `photo` text NOT NULL,
  `description` text,
  `date_heure` datetime NOT NULL,
  `id_user` bigint NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
)

-- --------------------------------------------------------

--
-- Structure de la table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id_post` bigint NOT NULL,
  `id_tag` bigint NOT NULL,
  PRIMARY KEY (`id_post`,`id_tag`),
  KEY `id_tag` (`id_tag`)
)

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` bigint NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tag`)
)

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` bigint NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `avatar` text,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudo` (`pseudo`)
)

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `pseudo`, `mdp`, `avatar`) VALUES
(1, 'Jeremey', 'd8c93860c7892dc6d662f4493e4ffd71badeab64', 'jeremey.png'),
(2, 'Vincenzo', '27b7c809b569e2a89c84826e023cba4db292066a', 'vincenzo.jpg'),
(3, 'Abdoul', 'd1f74df3136f09cfe5fbd2a2ec0fdd15aa74e1b4', 'abdoul.jpg'),
(4, 'Juney', '24da17d50002e4927a0eeba6b5d507ef8006d62c', 'juney.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
