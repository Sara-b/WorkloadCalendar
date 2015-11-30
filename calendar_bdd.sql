-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 30 Novembre 2015 à 18:03
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `calendar`
--
CREATE DATABASE IF NOT EXISTS `calendar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `calendar`;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_professeur` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `hoursOfWork` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `id_professeur`, `id_promotion`, `title`, `description`, `start_date`, `end_date`, `hoursOfWork`) VALUES
(3, 1, 1, 'Travailler avec Elodie et Elisa', '', '2015-11-30', '2015-11-30', 5),
(8, 3, 1, 'TP de C#', '', '2015-12-01', '2015-12-08', 6),
(9, 3, 1, 'Developpement d''une application iOS', 'Travail en autonomie sur trois semaines', '2015-11-01', '2015-11-15', 15),
(10, 3, 4, 'Projet IOT', 'Mise en place d''une solution de surveillance de domicile', '2015-11-15', '2015-12-06', 20),
(11, 3, 2, 'Projet Réseau', '', '2015-12-06', '2015-12-20', 10),
(12, 3, 1, 'Developpement d''un site web de gestion', 'Cahier des charges + soutenance', '2015-11-01', '2015-11-30', 18),
(13, 3, 1, 'Mini TP Java pour appliquer le cours', 'Langage Java', '2015-12-03', '2015-12-04', 1);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id`, `title`) VALUES
(1, 'Bachelor 3'),
(2, 'Bachelor 2'),
(3, 'Bachelor 1'),
(4, 'Expert 1'),
(5, 'Expert 2');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '3',
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_promotion` int(11) DEFAULT NULL,
  `specialization` varchar(55) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `role`, `email`, `password`, `id_promotion`, `specialization`) VALUES
(1, 'Sara', 'Brin', 3, 'sara.brin@ynov.com', 'ynov', 1, 'Developpement'),
(2, 'Yoann', 'Rousset', 1, 'yoann.rousset@ynov.com', 'ynov', NULL, NULL),
(3, 'Nicolas', 'Bellino', 2, 'nicolas.bellino@ynov.com', 'ynov', NULL, NULL),
(4, 'Elodie', 'Bironneau', 3, 'elodie.bironeau@ynov.com', 'ynov', 1, NULL),
(5, 'Elisa', 'Collot', 3, 'elisa.collot@ynov.com', 'ynov', 1, NULL),
(7, 'Martin', 'Dupont', 3, 'martin.dupont@ynov.com', 'ynov', 2, NULL),
(8, 'Pierre', 'Benoit', 3, 'pierre.benoit@ynov.com', 'ynov', 5, 'Systemes et Réseaux'),
(9, 'Thomas', 'Leblanc', 3, 'thomas.leblanc@ynov.com', 'ynov', 4, 'Developpement');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
