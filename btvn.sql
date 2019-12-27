-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2019 at 01:18 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

DROP TABLE IF EXISTS `friendship`;
CREATE TABLE IF NOT EXISTS `friendship` (
  `userId1` int(11) NOT NULL,
  `userId2` int(11) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId1`,`userId2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`userId1`, `userId2`, `createAt`) VALUES
(1, 2, '2019-12-27 10:27:56'),
(2, 1, '2019-12-27 10:28:12'),
(1, 3, '2019-12-27 10:34:29'),
(3, 2, '2019-12-27 10:34:09'),
(3, 1, '2019-12-27 10:34:53'),
(2, 3, '2019-12-27 10:35:21'),
(4, 2, '2019-12-27 12:00:26'),
(2, 4, '2019-12-27 12:00:45'),
(3, 4, '2019-12-27 18:50:48'),
(4, 3, '2019-12-27 18:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`postId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromUserID` int(11) NOT NULL,
  `toUserID` int(11) NOT NULL,
  `content` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleteUserID` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `fromUserID`, `toUserID`, `content`, `deleteUserID`, `createdAt`) VALUES
(181, 4, 2, 'xx', NULL, '2019-12-27 19:01:33'),
(182, 4, 3, 'cc', NULL, '2019-12-27 19:01:50'),
(183, 4, 3, 'lone', NULL, '2019-12-27 19:02:30'),
(184, 4, 2, 'duma cái cc', NULL, '2019-12-27 19:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phoneNumber` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`phoneNumber`(10))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` mediumblob,
  `privacy` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `userID`, `createdAt`, `mime`, `image`, `privacy`) VALUES
(7, 'cc', 4, '2019-12-27 20:06:21', '', '', 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `displayName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date DEFAULT NULL,
  `phoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `code` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatars` mediumblob,
  PRIMARY KEY (`id`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `surname`, `displayName`, `gender`, `email`, `password`, `DOB`, `phoneNumber`, `status`, `code`, `mime`, `avatars`) VALUES
(2, 'Hữu', 'Duong', 'Hữu Duong', 'female', 'huuduong3105@gmail.com', '$2y$10$FTphhdhnrxYUE5adYXGWluKfiipV75IB9vcTZXLqcFl/GwuxDJ/gC', '2019-01-01', '1234567890', 1, '', '', NULL),
(3, 'Nguyen', 'Du', 'Nguyen Du', 'female', 'songdu2802@gmail.com', '$2y$10$9Wrb5WxoAweh1lW5LivpgejaffrZVoxDzMBOkjQuvFng8qQB.xti6', '2019-01-01', '213123123', 1, '', NULL, NULL),
(4, 'Nguyen', 'Song Du', 'Nguyen Song Du', 'female', 'nsdu.17ck1@gmail.com', '$2y$10$2zCBolBFxKcR5oZeKf8JXOkJjy.1DuzTS3z10TwYbZCBXlv0dlR8y', '2019-01-01', '234234234', 1, '', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
