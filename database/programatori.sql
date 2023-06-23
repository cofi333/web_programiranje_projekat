-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2023 at 06:36 PM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programatori`
--
CREATE DATABASE IF NOT EXISTS `programatori` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `programatori`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `event_id` int NOT NULL,
  `guest_id` int NOT NULL,
  `comment` tinytext NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `event_id` int NOT NULL,
  `id_user` int NOT NULL,
  `event_title` varchar(30) NOT NULL,
  `event_organizer` varchar(30) NOT NULL,
  `event_type` varchar(25) NOT NULL,
  `event_category` varchar(25) NOT NULL,
  `event_location` varchar(20) NOT NULL,
  `event_date_time` datetime NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `event_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

DROP TABLE IF EXISTS `event_category`;
CREATE TABLE `event_category` (
  `ec_id` int NOT NULL,
  `event_id` int NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
CREATE TABLE `guests` (
  `guest_id` int NOT NULL,
  `id_user` int NOT NULL,
  `guest_fname` varchar(25) NOT NULL,
  `guest_lname` varchar(25) NOT NULL,
  `guest_mail` varchar(45) NOT NULL,
  `wish_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest_event`
--

DROP TABLE IF EXISTS `guest_event`;
CREATE TABLE `guest_event` (
  `guest_event_id` int NOT NULL,
  `event_id` int NOT NULL,
  `guest_id` int NOT NULL,
  `is_coming` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `wish_id` int NOT NULL,
  `address` varchar(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_token` char(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint NOT NULL DEFAULT '0',
  `forgotten_password_token` char(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `forgotten_password_expires` datetime NOT NULL,
  `is_banned` smallint NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

DROP TABLE IF EXISTS `wish_list`;
CREATE TABLE `wish_list` (
  `wish_id` int NOT NULL,
  `id_user` int NOT NULL,
  `wish_gift_name` varchar(30) NOT NULL,
  `wish_gift_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comments_guests` (`guest_id`),
  ADD KEY `fk_comments_events` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_users_event` (`id_user`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD KEY `fk_eventcategory_event` (`event_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`),
  ADD KEY `fk_guest_user` (`id_user`),
  ADD KEY `fk_guest_wish` (`wish_id`);

--
-- Indexes for table `guest_event`
--
ALTER TABLE `guest_event`
  ADD PRIMARY KEY (`guest_event_id`),
  ADD KEY `event_guest1` (`event_id`),
  ADD KEY `eveng_guest2` (`guest_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_wish` (`wish_id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_event`
--
ALTER TABLE `guest_event`
  MODIFY `guest_event_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `wish_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_events` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `fk_comments_guests` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_users_event` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `event_category`
--
ALTER TABLE `event_category`
  ADD CONSTRAINT `fk_eventcategory_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `fk_guest_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_guest_wish` FOREIGN KEY (`wish_id`) REFERENCES `wish_list` (`wish_id`);

--
-- Constraints for table `guest_event`
--
ALTER TABLE `guest_event`
  ADD CONSTRAINT `eveng_guest2` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`),
  ADD CONSTRAINT `event_guest1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_wish` FOREIGN KEY (`wish_id`) REFERENCES `wish_list` (`wish_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
