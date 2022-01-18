-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 18, 2022 at 01:03 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'gateau', 1, 1, '2022-01-10 08:53:35'),
(17, 'Le ketchup j&#039;addore ca ', 2, 5, '2022-01-18 11:17:21'),
(3, 'tewst', 1, 4, '2022-01-10 09:05:29'),
(4, 'ismail est en pls malheureusement la sorcellerie ne marche pas sur php', 1, 4, '2022-01-10 09:05:52'),
(8, 'je suis jaward 3 eme de kassos', 1, 1, '2022-01-11 12:01:39'),
(10, 'yiugyehjvz&quot;aekziodfuvuihjevzbjfsdbufydiuygsjhz', 2, 1, '2022-01-14 11:26:57'),
(11, 'ueyrtèsdieuhbznghjsfduiosjlzkabvdsghjyuiojhzaevbndhsjcivxojdlsk', 2, 1, '2022-01-14 11:27:02'),
(13, 'yauyauyau', 2, 6, '2022-01-18 10:27:08'),
(16, 'les bon \r\n', 2, 1, '2022-01-18 07:26:51'),
(18, 'Le ketchup j&#039;addore ca ', 2, 5, '2022-01-18 11:17:27'),
(19, 'non la mayo c&#039;est meilleur ', 2, 7, '2022-01-18 11:17:38'),
(20, 'lomzrjkdhmgosflidqkufsvdcbn ,xodsilkjgdvklqdshjbvlqbsd;jbvwopvhyamf\r\nq\r\n\r\nqsfv\r\nqsfvgovdi&lt;sfgcljbklfgclqkDF\r\n\r\nJHdvqcvghdvschjcklwxjihghjvdcznbkjqlsmcowxiuigchjvdsbanJQMOCWXU IOUGIVWHKDBnadqksmcowvxc puvh', 2, 1, '2022-01-18 11:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'salopette'),
(4, 'moustache'),
(5, 'ketchup'),
(6, 'ma bite'),
(7, 'mayo');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'JAWAD le melon ', 8, 2, '2022-01-14 08:32:35'),
(2, 'Why so jew ', 8, 1, '2022-01-14 08:32:35'),
(3, 'yo you the real Sadam big fan', 8, 2, '2022-01-14 08:32:35'),
(4, 'You fat stach you got there my men ', 8, 2, '2022-01-14 10:08:15'),
(5, 'ma bite', 8, 2, '2022-01-14 10:08:31'),
(6, 'mon couteau ', 8, 2, '2022-01-14 10:09:13'),
(7, 'ah l\'afrique ', 8, 2, '2022-01-14 10:09:25'),
(8, 'ah l\'afrique ', 8, 2, '2022-01-14 10:09:56'),
(9, 'sghdqjkxj', 3, 2, '2022-01-14 12:01:53'),
(10, 'hgxwjk', 3, 2, '2022-01-14 12:01:56'),
(11, 'dsfghjklm', 3, 2, '2022-01-14 12:02:04'),
(12, 'wdxfcgvhbjnk,lkmjhgcqsvhjkxM^poiuhzgkjv,abnqsdciuhgqsvkhs<dnhcpisofudiwgdhsmlQJWVÔQZJHNBELJDHQÙ^DPSJFDabcoiqhfqegdvoihqzkrbqslhc^pqkDABZFOJQZKLFGVHPOZMLZKE', 3, 2, '2022-01-17 13:53:33'),
(13, 'dsfghjkhj;klù=lmkurhesrsdhfkljmhoug', 11, 2, '2022-01-17 13:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'sadamWashere', '$2y$10$LOr68vP9L2M17VnNiYGc5eDxmshU4qe0lgkLbF9qSIekxv6vtyMva', 'sadam.h@gmail.com', 1337),
(2, 'JeanJean', '$2y$10$L2XdV.va2z3rigJsYNwVoOaM52U2hSQ0xnH.SVREeuutKJcPNMpGq', 'jean@jean', 1337);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
