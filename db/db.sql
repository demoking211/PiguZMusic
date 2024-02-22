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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'PremiumAccount'),
(3, 'RegisteredUser');


-- --------------------------------------------------------

--
-- Table structure for table `UserRole`
--

CREATE TABLE `UserRole` (
  `user_id` int NOT NULL ,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` char(38) NOT NULL ,
  `username` text NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `passwordHash`, `email`, `path`, `created_by`,`created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'kangxiang', 'kangxiang123','kangxiang@123','','sohai' , '2023-01-27 11:44:10', 'admin', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'yanhong', 'yanhong123','yanhong@123','' ,'sohai', '2023-01-27 11:44:10', 'admin', '2023-01-27 11:44:27', 1, 'pls redo');

-- --------------------------------------------------------

--
-- Table structure for table `UserPlayList`
--

CREATE TABLE `UserPlayList` (
  `playlist_id` char(38) NOT NULL ,
  `user_id` int NOT NULL,
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NOT NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`playlist_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UserPlayList`
--

INSERT INTO `UserPlayList` (`playlist_id`, `user_id`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 1, 'shoai', '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 1, 'sohai' , '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `Tracks`
--

CREATE TABLE `Tracks` (
  `id` char(38) NOT NULL ,
  `genre_id` int NOT NULL,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `thumbnail_path` text NOT NULL,
  `music_path` text NOT NULL,
  `music_premium_path` text NOT NULL,
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NOT NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Tracks`
--

INSERT INTO `Tracks` (`id`, `genre_id`,`name`,`description`,`thumbnail_path`,`music_path`,`music_premium_path`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 1,'try1' ,'still trying 1','','','' , 'KangXiang', '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 1,'try2','still trying','','','', 'KangXiang', '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `id` char(38) NOT NULL ,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NOT NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`id`, `name`, `description`,  `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'normal', 'budong','KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'premium', 'budong','KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 2, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `PlaylistTracks`
--

CREATE TABLE `PlaylistTracks` (
  `id` char(38) NOT NULL ,
  `playlist_id` int NOT NULL,
  `track_id` int NOT NULL,
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NOT NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PlaylistTracks`
--

INSERT INTO `PlaylistTracks` (`id`, `playlist_id`, `track_id`,  `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'normal', 'budong','KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 1, 'pls redo'),
(2, 'premium', 'budong','KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 2, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `Playlists`
--

CREATE TABLE `Playlists` (
  `id` char(38) NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `isUserPlaylist` tinyint NOT NULL DEFAULT '0',
  `created_by` varchar(50) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(50) NOT NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Playlists`
--

INSERT INTO `Playlists` (`id`, `name`,`description`,`path`,`isUserPlaylist`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'try1' ,'still trying 1','' ,0, 'KangXiang', '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2,'try2','still trying','',0, 'KangXiang', '2023-01-27 11:44:10','KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');

-- --------------------------------------------------------
--
-- Table structure for table `TrackArtist`
--

CREATE TABLE `TrackArtist` (
  `id` char(38) NOT NULL ,
  `track_id` int NOT NULL,
  `artist_id` int NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `updated_datetime` datetime DEFAULT NULL ,
  `status` int NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TrackArtist`
--

INSERT INTO `TrackArtist` (`id`, `track_id`, `artist_id` , `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 1, 1,'KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 1, 1,'KangXiang' , '2023-01-27 11:44:10', 'KangXiang', '2023-01-27 11:44:27', 0, 'pls redo');
-- --------------------------------------------------------
--
-- Table structure for table `Artist`
--

CREATE TABLE `Artist` (
  `id` char(38) NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `created_by` int NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int NOT NULL ,
  `updated_datetime` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' ,
  `reamrks` text NOT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Artist`
--

INSERT INTO `Artist` (`id`, `name`, `description` , `created_by`, `created_datetime`, `updated_by`, `updated_datetime`, `status`, `reamrks`) VALUES
(1, 'yifan', 'lianggeshabi','1' , '2023-01-27 11:44:10', '1', '2023-01-27 11:44:27', 0, 'pls redo'),
(2, 'kunkun', 'yigeshabi','1' , '2023-01-27 11:44:10', '1', '2023-01-27 11:44:27', 0, 'pls redo');
