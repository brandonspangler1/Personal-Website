-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2022 at 09:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EVI_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT 0,
  `user_status` int(2) NOT NULL DEFAULT 0,
  `pass_reset_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `university_status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `username`, `password`, `name`, `email`, `phone`, `date`, `verification_code`, `verification_status`, `user_status`, `pass_reset_token`, `university_status`) VALUES
(8, 'falfyro', '$2y$10$i0BkTaLpAZTuUw/d9jN/UOQsaqrvvtQc0MSKDB.MjkloY6LNsbG3O', 'Alfred Yoo', 'alfy001118@gmail.com', '333-333-3333', '2022-03-28 19:25:27', 'f8ebb9e5aae9cd02a42f6302c432595c', 1, 2, NULL, 1),
(9, 'zebaugh', '$2y$10$l3K3.xb5mpdvjV0JDxM4GeZK7FqgXWEzVUQW8hxqOk8tobcOTBhCq', 'Zachary Ebaugh', 'alfy13149@gmail.com', '111-111-2222', '2022-03-26 03:59:51', '3df07196f327685aea1bb020a301e28c', 1, 1, NULL, 0),
(10, 'bspangler', '$2y$10$M1qov4QUHUw99xnKwHRA.uX0xTWad6CnVCQZTbjSveWdwt/iKzAbG', 'Brandon Spangler', 'falfy001118@gmail.com', '111-222-3333', '2022-03-26 03:32:10', 'd0d1e048e5853b549713cbba1c2c6b5d', 1, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
