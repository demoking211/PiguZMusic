-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 07:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `PGZ_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `id` int NOT NULL ,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`id`, `name`) VALUES
(1, 'Normal User',  NULL),
(2, 'premium User',  NULL),
(3, 'admin', NULL);


-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `passwordHash` text NOT NULL,
  `profile_path` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `current_timestamp` datetime DEFAULT NULL ON UPDATE current_timestamp() ,
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`user_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `passwordHash`, `profile_path`, `created_timestamp`, `update_by`, `updated_datetime`, `current_timestamp`, `status`, `reamrks`) VALUES
(1, 'kangxiang', 'kangxiang123','' , '2023-01-27 11:44:10', 'admin', '2023-01-27 11:44:27', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'yanhong', 'yanhong123','' , '2023-01-27 11:44:10', 'admin', '2023-01-27 11:44:27', '2023-01-27 11:44:27', 1, 'pls redo');

-- --------------------------------------------------------

--
-- Table structure for table `PlayList`
--

CREATE TABLE `PlayList` (
  `play_list_id` int NOT NULL AUTO_INCREMENT,
  `play_list_name` text NOT NULL,
  `description` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`play_list_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PlayList`
--

INSERT INTO `PlayList` (`play_list_id`, `play_list_name`, `description`, `created_by`, `created_datetime`, `update_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'Chinese Songs', 'top in 2025',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 'English Songs', 'top in 2023',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `genre_id` int NOT NULL AUTO_INCREMENT,
  `genre_name` text NOT NULL,
  `description` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`genre_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`genre_id`, `genre_name`, `description`,  `created_by`, `created_datetime`, `update_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'normal', 'budong',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'premium', 'budong',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 2, 'pls redo');

-- --------------------------------------------------------

--
-- Table structure for table `Track`
--

CREATE TABLE `Track` (
  `track_id` int NOT NULL AUTO_INCREMENT,
  `track_name` text NOT NULL,
  `description` text NOT NULL,
  `music_profile_path` text NOT NULL,
  `music_path` text NOT NULL,
  `music_premium_path` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`track_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Track`
--

INSERT INTO `Track` (`play_list_id`, `play_list_name`, `description`, `music_profile_path`, `music_path`,`music_premium_path` , `created_by`, `created_datetime`, `update_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'track1', 'track description','','','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'track2', 'track description','','','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 2, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `Artist`
--

CREATE TABLE `Artist` (
  `artist_id` int NOT NULL AUTO_INCREMENT,
  `artist_name` text NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Artist`
--

INSERT INTO `Artist` (`artist_id`, `artist_name`, `description`,`path` , `created_by`, `created_datetime`, `update_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'kunkun', 'it is a chicken','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 'yifan', 'it is a boy!','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `RecommendedPlaylist`
--

CREATE TABLE `RecommendedPlaylist` (
  `recommendedplaylist_id` int NOT NULL AUTO_INCREMENT,
  `recommendedplaylist_name` text NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `update_datetime` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int NOT NULL ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`recommendedplaylist_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `RecommendedPlaylist`
--

INSERT INTO `RecommendedPlaylist` (`recommendedplaylist_id`, `recommendedplaylist_name`, `description`,`path` , `created_by`, `created_datetime`, `update_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'kunkunlist', 'it is a chicken list','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 'yifan list', 'it is a boy list','',1 , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');