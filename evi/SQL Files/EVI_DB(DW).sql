-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2022 at 10:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `rso`
--

CREATE TABLE `rso` (
  `id` int(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso`
--

INSERT INTO `rso` (`id`, `name`) VALUES
(1, 'Phrat Gods');

-- --------------------------------------------------------

--
-- Table structure for table `university_info`
--

CREATE TABLE `university_info` (
  `id` int(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `university_info`
--

INSERT INTO `university_info` (`id`, `name`, `address`) VALUES
(1, 'University of Central Florida ', '4000 Central Florida Blvd, Orlando, FL 32816');

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
  `uni_id` int(128) NOT NULL,
  `pass_reset_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `username`, `password`, `name`, `email`, `phone`, `date`, `verification_code`, `verification_status`, `user_status`, `uni_id`, `pass_reset_token`) VALUES
(8, 'falfyro', '$2y$10$2DadjV7Vg41IlQ5UbN1YZewsNk/ss1xx0s0sPa8HW5N0CkCrpkupO', 'Alfred Yoo', 'alfy001118@gmail.com', '333-333-3333', '2022-03-16 06:35:54', 'f8ebb9e5aae9cd02a42f6302c432595c', 1, 0, 0, NULL),
(9, 'Spangy', '$2y$10$xOpMXJtfui7SfWva5ZgDSeNwrKxtMI24Wkqf1ys9NLhoFmxIqfRca', 'Brandon Spangler', 'brandons0207@gmail.com', '111-111-1111', '2022-03-22 21:23:46', 'd609e586240bf87a9ac2c52ca8e45bd7', 1, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rso`
--
ALTER TABLE `rso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_info`
--
ALTER TABLE `university_info`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
