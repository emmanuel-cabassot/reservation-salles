-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 06 déc. 2020 à 22:56
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(1, 'Salsa', 'C’est une danse très dynamique et festive sur la piste qui se pratique en cercle, généralement en couple, la fille tournant autours du garçons. Elle peut aussi se danser à plusieurs, les couples forment un cercle, font les passes de manière synchronisée généralement annoncé par un chanteur au sein du groupe et où les danseuses passent d’un danseur à l’autre. Ce style de salsa qui permet de danser en groupe s’appelle la Rueda (la roue ). Dans ce style, les danseurs « marchent » beaucoup. ', '2020-12-07 09:00:00', '2020-12-07 10:00:00', 1),
(2, 'Boxe ', 'Ils sont accompagnés et encadrés de manière étroite afin que leurs objectifs personnels et sportifs soient atteints. Dans cette voie, c’est surtout les temps de préparation physique et mentale, de dépassement de soi et l’investissement nécessaire qui compteront plus que le résultat lui-même.', '2020-12-08 13:00:00', '2020-12-08 15:00:00', 1),
(3, 'Yoga', 'Venez vous relaxer tout en faisant du bien à votre corps', '2020-12-11 15:00:00', '2020-12-11 18:00:00', 1),
(4, 'Gainage', 'Ca va transpirer. Alors bienvenue aux courageux', '2020-12-11 14:00:00', '2020-12-11 15:00:00', 2),
(16, 'lecture', 'hannibal', '2020-12-10 08:00:00', '2020-12-10 09:00:00', 2),
(15, 'Karaté kid', 'Cour de karaté pour les enfants', '2020-12-09 10:00:00', '2020-12-09 12:00:00', 2),
(14, 'Pilate', 'Le pilate va faire travailler tous les muscles de votre corps', '2020-12-08 12:00:00', '2020-12-08 13:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'Manu', '$2y$10$Trv.mu08XAyhD1Ggwnap8OJ8VoA1hlLSDN6HEzSNCpUB4Zl8L1z9G'),
(2, 'Chacha', '$2y$10$kuPelUA2xAUDSYeCYQKIMOQMj5q6IYPlXXhIMrBkt98dYC0BHjQMq'),
(3, 'Mirabelle', '$2y$10$9l1.UOdy1fAIHI5yZO04OeRywsXIZ/rYVMGU.L9MlY6b/RUPX0wYS'),
(4, 'John', '$2y$10$.LjLtzWu.73gaC3wKjKMcu4ULVviV/4v9/ZcgL.jYOsOIgSoZO3qS'),
(5, 'admin', '$2y$10$USQx0bbiPT46vL4KuH3pcuDrefNqZAlbR1/4JG51G48K.WHJkFCXe'),
(6, 'Plateforme', '$2y$10$SdB/U6dgDQjWOjPRVxIax.OLDmxvCExU/lfQRczDT7Liyqo4qmiVq'),
(7, 'bipbip', '$2y$10$IoqC/mVdyo15vJqjvEaHqex1txuHfltxKrkPvkYCJ.mkM1fkPkcwe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
