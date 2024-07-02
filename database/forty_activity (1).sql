-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2024 at 03:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forty_activity`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` longtext NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(50) DEFAULT NULL,
  `hobby` longtext DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `photo_path`, `email`, `birthday`, `gender`, `hobby`, `password`, `confirm_password`, `date_created`, `date_updated`, `last_login_time`) VALUES
(52, 'Cyrel M. Xander', 'uploads/download (2).jpeg', 'cywellacamson@gmail.com', '2024-06-26', 2, 'My Name is Cyrel camson\r\nI Live on Talaga,Argao,Cebu\r\nI Love to play Basketball and \r\nvolleyball ', '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', 'eb0527a21e0640f2e865bac55c1635b724dbf9f3', '2024-07-01 17:42:41', '2024-07-01 17:42:41', '2024-07-01 17:42:01'),
(53, 'Louella Jane Ortega', NULL, 'louellajaneortega@gmail.com', NULL, NULL, NULL, '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '2024-06-26 17:03:14', '2024-06-26 17:03:14', '2024-06-27 14:08:28'),
(54, 'Roldan Camson', NULL, 'roldancamson@gmail.com', NULL, NULL, NULL, '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '2024-06-26 17:03:45', '2024-06-26 17:03:45', '2024-06-26 17:15:18'),
(57, 'New User', NULL, 'newuser@gmail.com', NULL, NULL, NULL, '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '7cc5c31bf1ac75da70ed5dfbcfa99bb3dfdbee27', '2024-06-27 13:43:59', '2024-06-27 13:43:59', '2024-06-27 13:44:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
