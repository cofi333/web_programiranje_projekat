-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2023 at 08:31 PM
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

CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'createEventAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_to_user_msg`
--

CREATE TABLE `admin_to_user_msg` (
  `msg_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_sent` date NOT NULL,
  `event_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_to_user_msg`
--

INSERT INTO `admin_to_user_msg` (`msg_id`, `admin_id`, `user_id`, `message`, `date_sent`, `event_name`) VALUES
(1, 1, 4, 'Los Ban Status, event je obrisan', '2023-07-20', 'Drugi Event');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `event_id` int NOT NULL,
  `guest_id` int NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int NOT NULL,
  `ec_id` int NOT NULL,
  `id_user` int NOT NULL,
  `event_title` varchar(60) NOT NULL,
  `event_organizer` varchar(30) NOT NULL,
  `event_location` varchar(50) NOT NULL,
  `is_banned` tinyint(1) DEFAULT '0',
  `event_img` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_description` text NOT NULL,
  `event_comments` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `ec_id`, `id_user`, `event_title`, `event_organizer`, `event_location`, `is_banned`, `event_img`, `event_date`, `event_time`, `event_description`, `event_comments`) VALUES
(3, 2, 4, 'Summer3p Festival', 'SUMMER3P', 'Segedinski put Subotica - Palic', 0, 'images/event_images/nightlife_category.jpg', '2023-07-20', '12:05:00', 'Festival je pokrenut 2003. godine sa osnovnim ciljem da pokrene omladinu Subotice i ponudi drugačiji i viši standard zabave omladini. Ono što izdvaja „Summer3p“ od većine drugih festivala jeste postojanje raznovrsnog dnevnog programa, koji posetiocima pruža šansu i da učestvuju u radionicama muzičke produkcije, novinarskim, slikarskim, hip-hop radionicama, da svakog dana rade jogu, prisustvuju promociji kampanja. The festival was launched in 2003 with the basic goal of mobilizing the youth of Subotica and offering a different and higher standard of entertainment to the youth. What sets „Summer3p“ apart from most other festivals is the existence of a diverse daily program, which gives visitors a chance to participate in music production workshops, journalism, painting, hip-hop workshops, to do yoga, attend campaign promotions .', 'on'),
(4, 1, 4, 'Naslov eventa', 'test', 'Segedinski put Subotica - Palic', 0, 'images/event_images/music_category.jpg', '2023-07-25', '12:05:00', 'Ovo je opis ovog eventa', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `ec_id` int NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE `guests` (
  `guest_id` int NOT NULL,
  `event_id` int NOT NULL,
  `id_user` int NOT NULL,
  `guest_mail` varchar(45) NOT NULL,
  `guest_name` varchar(25) NOT NULL,
  `wish_id` int DEFAULT NULL,
  `is_coming` tinyint(1) DEFAULT NULL,
  `guest_token` char(40) NOT NULL,
  `comment_sent` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_event`
--

CREATE TABLE `guest_event` (
  `guest_event_id` int NOT NULL,
  `event_id` int NOT NULL,
  `guest_id` int NOT NULL,
  `is_coming` tinyint(1) NOT NULL,
  `comment_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `registration_token` char(40) NOT NULL,
  `registration_expires` datetime DEFAULT NULL,
  `active` smallint NOT NULL DEFAULT '0',
  `forgotten_password_token` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `forgotten_password_expires` datetime DEFAULT NULL,
  `is_banned` smallint DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `firstname`, `registration_token`, `registration_expires`, `active`, `forgotten_password_token`, `forgotten_password_expires`, `is_banned`, `date_time`) VALUES
(3, 'buljic77@gmail.com', '$2y$10$yQGeW.0tLf.q5lqO12/9veRmc//qQ3C79z5GWwR.HFJLkJREIWpEu', 'Stefan', 'c2bebff713fe8ea601fd1cfdac30a46d42958452', '2023-07-21 19:30:55', 0, NULL, NULL, 0, '2023-07-20 20:00:53'),
(4, 'filipkujundzic3@gmail.com', '$2y$10$.1FGqtYoOXoo8mZJFuVvHuutmib0VHSbJdnghDmTKY0t20og7szRa', 'Filip', '', NULL, 1, NULL, NULL, 0, '2023-07-20 20:23:07'),
(5, 'stefanbvts@gmail.com', '$2y$10$mqgvkuCYcIasZGrxD/zqluHHeyf.ScQEJeOdzxCIMMd8HCcPq1qcG', 'Stefan', 'ec1e749b60da2ce67870d548daf9478355c88a33', '2023-07-21 20:03:29', 0, NULL, NULL, 0, '2023-07-20 20:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `wish_id` int NOT NULL,
  `id_user` int NOT NULL,
  `event_id` int NOT NULL,
  `wish_gift_name` varchar(30) NOT NULL,
  `wish_gift_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_to_user_msg`
--
ALTER TABLE `admin_to_user_msg`
  MODIFY `msg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `ec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest_event`
--
ALTER TABLE `guest_event`
  MODIFY `guest_event_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `wish_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_guest_wish` FOREIGN KEY (`wish_id`) REFERENCES `wish_list` (`wish_id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
