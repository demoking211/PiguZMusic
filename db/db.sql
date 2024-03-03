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

CREATE TABLE `Roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Role`
--

INSERT INTO `Roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'PremiumAccount'),
(3, 'RegisteredUser');


-- --------------------------------------------------------

--
-- Table structure for table `UserRole`
--

CREATE TABLE `UserRoles` (
  `user_id` char(38) NOT NULL ,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
--
-- Table structure for table `User`
--

CREATE TABLE `Users` (
  `id` char(38) NOT NULL ,
  `username` text NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `path` text NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `UserPlayList`
--

CREATE TABLE `UserPlayLists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `playlist_id` char(38) NOT NULL ,
  `user_id` char(38) NOT NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `Tracks`
--

CREATE TABLE `Tracks` (
  `id` char(38) NOT NULL ,
  `genre_id` int NOT NULL,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `thumbnail_path` text NULL,
  `music_path` text NOT NULL,
  `music_premium_path` text NOT NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `Genre`
--

CREATE TABLE `Genres` (
  `id` char(38) NOT NULL ,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `PlaylistTracks`
--

CREATE TABLE `PlaylistTracks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `playlist_id` char(38) NOT NULL,
  `track_id` char(38) NOT NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `Playlists`
--

CREATE TABLE `Playlists` (
  `id` char(38) NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `path` text NULL,
  `isUserPlaylist` tinyint NOT NULL DEFAULT '0',
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime(6)  NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime(6) DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `TrackArtist`
--

CREATE TABLE `ArtistTracks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `track_id` char(38) NOT NULL,
  `artist_id` char(38) NOT NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime DEFAULT NULL ,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------
--
-- Table structure for table `Artist`
--

CREATE TABLE `Artists` (
  `id` char(38) NOT NULL ,
  `name` varchar(255)  NOT NULL,
  `description` text NOT NULL,
  `path` text NULL,
  `created_by` varchar(38) NOT NULL ,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(6),
  `updated_by` varchar(38) NULL ,
  `updated_datetime` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' ,
  `remarks` text NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;