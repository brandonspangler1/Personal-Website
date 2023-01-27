-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 06:27 AM
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
-- Table structure for table `private_events`
--

CREATE TABLE `private_events` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `location` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `public_events`
--

CREATE TABLE `public_events` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `location` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `public_requests`
--

CREATE TABLE `public_requests` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `admin_email` varchar(128) NOT NULL,
  `admin_phone` varchar(128) NOT NULL,
  `university` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `location` varchar(256) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public_requests`
--

INSERT INTO `public_requests` (`id`, `admin_name`, `admin_email`, `admin_phone`, `university`, `name`, `date`, `time`, `category`, `description`, `location`, `status`) VALUES
(1, 'Alfred Yoo', 'alfy001118@gmail.com', '111-111-1111', 'Seoul National University', 'National Korea Day', '2022-08-15', '00:00:00', 'Social', 'South Korea Liberation Day', 'Seoul, South Korea', 0),
(2, 'Brandon Spangler', 'brandonspangler@gmail.com', '222-222-2222', 'Harvard University', 'Independence Day', '2022-07-04', '00:00:00', 'Social', 'Fourth of July!', 'Orlando, FL', 0),
(3, 'Zachary Ebaugh', 'zacharyebaugh@gmail.com', '333-333-3333', 'University of Florida', 'National Day of the People\'s Republic of China\r\n', '2022-10-01', '00:00:00', 'Social', 'National Day, holiday celebrated on October 1 to mark the formation of the People\'s Republic of China. \r\n', 'Beijing, China', 0),
(4, 'Someone Someone', 'someonesomeone@gmail.com', '444-444-4444', 'Johns Hopkins University', 'World Cancer Day', '2023-02-04', '00:00:00', 'Social', 'World Cancer Day is an international day marked on 4 February to raise awareness of cancer and to encourage its prevention, detection, and treatment. World Cancer Day is led by the Union for International Cancer Control to support the goals of the World Cancer Declaration, written in 2008. ', 'Somewhere, World', 0),
(5, 'John Smith', 'johnsmith@gmail.com', '555-555-5555', 'University of Central Florida', 'World No-Tobacco Day', '2022-05-31', '00:00:00', 'Social', 'World No Tobacco Day is observed around the world every year on 31 May. This yearly celebration informs the public on the dangers of using tobacco, the business practices of tobacco companies, what the ... ', 'Somewhere, US', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rso_events`
--

CREATE TABLE `rso_events` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `location` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rso_requests`
--

CREATE TABLE `rso_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `university` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `member_one` varchar(128) NOT NULL,
  `member_two` varchar(128) NOT NULL,
  `member_three` varchar(128) NOT NULL,
  `member_four` varchar(128) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso_requests`
--

INSERT INTO `rso_requests` (`id`, `name`, `university`, `admin_name`, `description`, `member_one`, `member_two`, `member_three`, `member_four`, `status`) VALUES
(1, 'Korean Culture Organization', 'University of Central Florida', 'Alfred Yoo', 'Welcome~~', 'Brandon Spangler', 'Zachary Ebaugh', 'Someone Someone', 'Someone Someone', 0),
(2, 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh', 'Welcome~~', 'Alfred Yoo', 'Brandon Spangler', 'Someone Someone', 'Someone Someone', 0),
(3, 'American Culture Organization ', 'Harvard University', 'Brandon Spanler', 'Welcome~~', 'Alfred Yoo', 'Zachary Ebaugh', 'Someone Someone', 'Someone Someone', 0),
(4, 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo', 'Welcome~~', 'Brandon Spangler', 'Zachary Ebaugh', 'Someone Someone', 'Someone Someone', 0),
(5, 'Global Medical Society', 'Johns Hopkins University', 'Brandon Spangler', 'Welcome~~', 'Alfred Yoo', 'Zachary Ebaugh', 'Someone Someone', 'Someone Someone', 0),
(6, 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo', 'Welcome~~', 'Alfred Yoo', 'Zachary Ebaugh', 'Someone Someone', 'Someone Someone', 0);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `super_admin_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `location` varchar(256) NOT NULL,
  `num_students` int(5) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `picture_name` varchar(128) NOT NULL,
  `picture_link` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `super_admin_id`, `name`, `location`, `num_students`, `description`, `picture_name`, `picture_link`) VALUES
(1, 8, 'University of Central Florida', 'Orlando, FL', 70000, 'UCF is an academic, partnership and research leader in numerous fields, such as optics and lasers, modeling and simulation, engineering and computer science, business, public administration, education, hospitality management, healthcare and video game design.\r\n', 'About UCF', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.ucf.edu%2Fabout-ucf%2F&psig=AOvVaw2tRKR9ZMma8bO6vZbaf2Ed&ust=1648262618161000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCICM-POe4PYCFQAAAAAdAAAAABAD'),
(2, 8, 'University of Florida', 'Gainesville, Florida', 60000, 'University of Florida is a public institution that was founded in 1853. It has a total undergraduate enrollment of 34,931 (fall 2020), its setting is suburban, and the campus size is 2,000 acres. It utilizes a semester-based academic calendar.\r\n', 'University of Florida ', 'https://www.google.com/search?q=uf+description&tbm=isch&source=iu&ictx=1&vet=1&fir=JWu4_fTtD0JnOM%252CcoURSxUbcYgGXM%252C_&usg=AI4_-kRbz3mYTKgOn2mVpgKOLc8kJFpsxw&sa=X&ved=2ahUKEwjzvb2Yn-D2AhUdRjABHa7aDe4Q9QF6BAgFEAE#imgrc=JWu4_fTtD0JnOM'),
(3, 8, 'Seoul National University', 'Seoul, South Korea', 30000, 'Seoul National University is a national research university located in Seoul, South Korea. It is one of the flagship Korean national universities. Founded in 1946, Seoul National University is considered the most prestigious university in South Korea. Wikipedia\r\n', 'Seoul National University Entrance', 'https://www.google.com/maps/uv?pb=!1s0x357c9fe8a0a1e2a5:0xa1e2eebc04f0c5e7!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipNlux6tLrFJcuGInql6Qn24BZYbRTdrW4a7vpQ7%3Dw523-h352-k-no!5sseoul+national+university+-+Google+Search!15zQ2dJZ0FRPT0&imagekey=!1e10!2sAF1QipNlux6tLrFJcuGInql6Qn24BZYbRTdrW4a7vpQ7&hl=en&sa=X&ved=2ahUKEwiMu93Nn-D2AhVHSjABHfiUB_EQoip6BAgyEAM'),
(4, 8, 'Harvard University', 'Cambridge, Massachusetts', 25000, 'Harvard University is a private Ivy League research university in Cambridge, Massachusetts. Founded in 1636 as Harvard College and named for its first benefactor, the Puritan clergyman John Harvard, it is the oldest institution of higher learning in the United States and among the most prestigious in the world. \r\n', 'Harvard Profile', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.cnbc.com%2F2021%2F09%2F10%2Fharvard-university-will-divest-itself-from-fossil-fuels.html&psig=AOvVaw2ADEmX4KMUI1pE-t-aOIs1&ust=1648262919602000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCID3y4Gg4PYCFQAAAAAdAAAAABAD'),
(5, 8, 'Johns Hopkins University', 'Baltimore, Maryland', 24000, 'The Johns Hopkins University is a private research university in Baltimore, Maryland. Founded in 1876, the university was named for its first benefactor, the American entrepreneur and philanthropist Johns Hopkins. Johns Hopkins is the oldest research university in the United States. ', 'Johns Hopkins University', 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.cumuonline.org%2Fwp-content%2Fuploads%2F2018%2F07%2Fjohns-hopkins-university.jpeg&imgrefurl=https%3A%2F%2Fwww.cumuonline.org%2Fjohns-hopkins-university-joins-cumu%2F&tbnid=Z3m_Jmj2k7EiGM&vet=12ahUKEwjr5vSpoOD2AhXmAd8KHZSHDmMQMygBegUIARDZAQ..i&docid=SC3tlz3CDYCU-M&w=1200&h=627&q=johns%20hopkins%20university&ved=2ahUKEwjr5vSpoOD2AhXmAd8KHZSHDmMQMygBegUIARDZAQ');

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
  `pass_reset_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `username`, `password`, `name`, `email`, `phone`, `date`, `verification_code`, `verification_status`, `user_status`, `pass_reset_token`) VALUES
(8, 'falfyro', '$2y$10$nb0THlD6mtxth6JXgSP9WO2.HZEjk.gYx0vDIcFplcEAp/AbGY0kq', 'Alfred Yoo', 'alfy001118@gmail.com', '333-333-3333', '2022-03-25 05:27:07', 'f8ebb9e5aae9cd02a42f6302c432595c', 1, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `private_events`
--
ALTER TABLE `private_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_events`
--
ALTER TABLE `public_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_requests`
--
ALTER TABLE `public_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rso_events`
--
ALTER TABLE `rso_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rso_requests`
--
ALTER TABLE `rso_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
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
-- AUTO_INCREMENT for table `private_events`
--
ALTER TABLE `private_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_events`
--
ALTER TABLE `public_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_requests`
--
ALTER TABLE `public_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rso_events`
--
ALTER TABLE `rso_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rso_requests`
--
ALTER TABLE `rso_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
