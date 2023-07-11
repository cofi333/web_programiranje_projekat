-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 01:13 AM
-- Server version: 10.4.27-MariaDB
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
CREATE DATABASE IF NOT EXISTS `programatori` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `programatori`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'createEventAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_to_user_msg`
--

DROP TABLE IF EXISTS `admin_to_user_msg`;
CREATE TABLE `admin_to_user_msg` (
  `msg_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_to_user_msg`
--

INSERT INTO `admin_to_user_msg` (`msg_id`, `admin_id`, `user_id`, `message`) VALUES
(1, 1, 59, 'aaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `ec_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `event_title` varchar(60) NOT NULL,
  `event_organizer` varchar(30) NOT NULL,
  `event_location` varchar(50) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `event_img` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_description` text NOT NULL,
  `event_comments` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

DROP TABLE IF EXISTS `event_category`;
CREATE TABLE `event_category` (
  `ec_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`ec_id`, `category`) VALUES
(1, 'Music'),
(2, 'Nightlife'),
(3, 'Culture'),
(4, 'Food'),
(5, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `guest_mail` varchar(45) NOT NULL,
  `guest_name` varchar(25) NOT NULL,
  `wish_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_event`
--

DROP TABLE IF EXISTS `guest_event`;
CREATE TABLE `guest_event` (
  `guest_event_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `is_coming` tinyint(1) NOT NULL,
  `comment_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `registration_token` char(40) NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT 0,
  `forgotten_password_token` char(40) NOT NULL,
  `forgotten_password_expires` datetime NOT NULL,
  `is_banned` smallint(6) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `firstname`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `date_time`) VALUES
(51, 'filipkujundzic2@gmail.com', '$2y$10$5kAtW52xRuEMW9QN8WwfweRdH2ySg8/Dx2ysORggUe2By0oq1P6gO', 'Filip', '518867b4df90f38a4cc493dbfa1878384cac8dcd', '2023-06-25 12:00:25', 0, '6e05c5e2975bb7d99ba2b5e5518aef93ce8731f2', '2023-06-27 19:26:00', 0, '2023-07-10 18:15:36'),
(52, 'filip@gmail.com', '$2y$10$KQB1kp4ydSEcciLWkovaJOyEjT.mGj.MSJCWKLCOjOP14WeeGC/Ti', 'Filip', '79c6988ad490d64d9e49874239c688e940f0cc9e', '2023-06-25 12:15:30', 0, '', '0000-00-00 00:00:00', 0, '2023-06-24 12:15:30'),
(53, 'fili65p@gmail.com', '$2y$10$C7PMExHrK7Ya1.YF/.KR9.wIKNlRKGnKte.9bYnZ4xbr/ODugNhWG', 'Filip123', '7fdc6fd8098fa9c84ffb1cbe4a084d6441d3598d', '2023-06-25 12:17:09', 0, '', '0000-00-00 00:00:00', 0, '2023-07-11 19:43:10'),
(54, 'filipkujundzic3123@gmail.com', '$2y$10$m5BZlfwTqesMiz1u6mR66uIaxTkC6SAii9Xv/jx9mqKXDkUcazq4u', 'Filip13515', '23765df4b4c3e66f267bc99921a5465fb1eca469', '2023-06-25 12:20:14', 0, '', '0000-00-00 00:00:00', 0, '2023-06-24 12:20:14'),
(55, 'filipkujundzic152@gmail.com', '$2y$10$aRZA1s6A8ldP3bXiuVOGHOzftIlNtXVosO17AZtQDHaJATPFuabv2', 'Filip13515', 'ed42bb583d5b394345cddca1da856e6560e770d1', '2023-06-25 12:24:21', 0, '', '0000-00-00 00:00:00', 0, '2023-06-24 12:24:21'),
(56, 'Filip123613@gmail.com', '$2y$10$.5p/MQjjmyi9AeMFtAaoH.JLXh9dkbeDGpP2bLuXOYGqTeqD4QG/m', 'Filip', '6383b19dfa66184acf3c922f0b1b806a94a970ca', '2023-06-25 12:40:47', 0, '', '0000-00-00 00:00:00', 0, '2023-06-24 12:40:47'),
(58, 'filipkujundzic21256@gmail.com', '$2y$10$GG2xwZ6gVeqT7t/h/xdV1ezTFloZQp2Bg9g8mjgU5QuEIPflWFWDW', 'filip', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '2023-06-24 13:33:32'),
(59, 'filipkujundzic3@gmail.com', '$2y$10$kaMBukuMJuf9JWioMlJh9uChMxPTRU8qMUF1AbGLZM2I4IQiT.yy.', 'Filip', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '2023-06-26 23:29:38'),
(62, '26121049@vts.su.ac.rs', '$2y$10$04zpq96pD2./RMluZLNk4.m8rivJxPuXFWBKlj4N9YC8LD4kDRiBa', 'Cofi', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '2023-06-24 15:34:48'),
(64, 'filipkujundzic2@gmail.com', '$2y$10$g0gFKMPRYL0Vad9S3.NEruk6YJnJOxntxIN8pDQmfB621etA5CHey', 'filip', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 1, '2023-07-10 16:20:14'),
(65, 'filipkujundzic55@gmail.com', '$2y$10$sv32VxuUTG1hHbvQY5sUVOc5mYpAePRWBLZD/ZcJy3z9s5C/QlY4K', 'Filip', '', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', 0, '2023-07-01 17:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

DROP TABLE IF EXISTS `wish_list`;
CREATE TABLE `wish_list` (
  `wish_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `wish_gift_name` varchar(30) NOT NULL,
  `wish_gift_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `admin_to_user_msg`
--
ALTER TABLE `admin_to_user_msg`
  ADD PRIMARY KEY (`msg_id`);

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
  ADD KEY `fk_user_events` (`id_user`),
  ADD KEY `fk_event_category` (`ec_id`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`ec_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`),
  ADD KEY `fk_guest_user` (`id_user`),
  ADD KEY `fk_guest_wish` (`wish_id`),
  ADD KEY `fk_guest_event` (`event_id`);

--
-- Indexes for table `guest_event`
--
ALTER TABLE `guest_event`
  ADD PRIMARY KEY (`guest_event_id`),
  ADD KEY `eveng_guest2` (`guest_id`),
  ADD KEY `event_guest1` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`wish_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_to_user_msg`
--
ALTER TABLE `admin_to_user_msg`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `ec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `guest_event`
--
ALTER TABLE `guest_event`
  MODIFY `guest_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_events` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_guests` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_category` FOREIGN KEY (`ec_id`) REFERENCES `event_category` (`ec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_events` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `fk_guest_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guest_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_guest_wish` FOREIGN KEY (`wish_id`) REFERENCES `wish_list` (`wish_id`);

--
-- Constraints for table `guest_event`
--
ALTER TABLE `guest_event`
  ADD CONSTRAINT `eveng_guest2` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`),
  ADD CONSTRAINT `event_guest1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
