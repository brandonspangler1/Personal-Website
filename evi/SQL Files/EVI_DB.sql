-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 12:02 AM
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
-- Table structure for table `event_comments`
--

CREATE TABLE `event_comments` (
  `id` int(11) NOT NULL,
  `event_type` varchar(128) NOT NULL COMMENT 'public=0, private=1, rso=2	',
  `university_name` varchar(128) NOT NULL,
  `event_name` varchar(256) NOT NULL,
  `username` varchar(128) NOT NULL,
  `comment` varchar(256) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_comments`
--

INSERT INTO `event_comments` (`id`, `event_type`, `university_name`, `event_name`, `username`, `comment`) VALUES
(49, '1', 'Wow University', 'National Holiday', 'falfyro', 'wow'),
(50, '1', 'Wow University', 'National Holiday', 'falfyro', 'wo'),
(51, '1', 'Wow University', 'National Holiday', 'falfyro', 'wowo'),
(52, '1', 'Wow University', 'National Holiday', 'falfyro', 'w'),
(53, '1', 'Wow University', 'National Holiday', 'falfyro', 'wowowow'),
(54, '1', 'Wow University', 'National Holiday', 'falfyro', 'huh'),
(68, '1', 'Wow University', 'National US Holiday', 'falfyro', 'time'),
(69, '1', 'Wow University', 'National US Holiday', 'falfyro', 'wow'),
(70, '1', 'Wow University', 'National US Holiday', 'falfyro', 'ugh'),
(71, '1', 'Wow University', 'National US Holiday', 'falfyro', 'some'),
(72, '1', 'Wow University', 'National US Holiday', 'falfyro', 'guess'),
(73, '1', 'Wow University', 'National US Holiday', 'falfyro', 'This event should be quite long'),
(78, '1', 'Seoul National University', 'Learn Hangul', 'falfyro', 'this is amazing'),
(79, '1', 'Seoul National University', 'Learn Hangul', 'falfyro', 'ugh my life'),
(80, '1', 'Seoul National University', 'Learn Hangul', 'falfyro', 'this is tiring'),
(81, '1', 'Seoul National University', 'Learn Hangul', 'falfyro', 'huuh'),
(83, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'wow'),
(84, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'why am i doing this'),
(85, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'somehow i am'),
(86, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'therefore do okay'),
(87, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'ugh'),
(88, '0', 'Johns Hopkins University', 'World Cancer Day', 'falfyro', 'ooh'),
(90, '0', 'Johns Hopkins University', 'World Cancer Day', 'falfyro', 'not'),
(91, '0', 'Johns Hopkins University', 'World Cancer Day', 'falfyro', 'fun'),
(92, '0', 'Seoul National University', 'Origami Day', 'falfyro', 'ooh'),
(93, '0', 'Seoul National University', 'Origami Day', 'falfyro', 'too'),
(94, '0', 'Seoul National University', 'Origami Day', 'falfyro', 'not'),
(95, '0', 'Seoul National University', 'Origami Day', 'falfyro', 'ugh'),
(96, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 's\'s'),
(97, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'huh'),
(98, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'lo'),
(99, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'hello'),
(100, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'my name'),
(101, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'is al'),
(102, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'wowowowowowo'),
(103, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'wow'),
(104, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'ooh'),
(105, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'ahh'),
(106, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'ugh'),
(107, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'ahahaha'),
(108, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'haha'),
(109, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'wowowowow'),
(110, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'wowo'),
(111, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'ooh'),
(112, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'huh'),
(113, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'why'),
(114, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'am'),
(115, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'i'),
(116, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'doing'),
(117, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'thing'),
(118, '0', 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', 'falfyro', 'wowo'),
(119, '0', 'Seoul National University', 'Origami Day', 'falfyro', 'ooh'),
(120, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'l'),
(121, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'wow\''),
(122, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'ooh\''),
(123, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', '\'\'\'\'\'\''),
(124, '0', 'University of Central Florida', 'World No-Sleeping Day', 'falfyro', 'someone\'s comment'),
(125, '1', 'Wow University', 'National Holiday', 'falfyro', 'someone\'s'),
(129, '2', 'University of Central Florida', 'Programming Day', 'falfyro', 'comment'),
(130, '2', 'University of Central Florida', 'Programming Day', 'falfyro', 'alfred\'s comment'),
(132, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'ooh\'s'),
(133, '0', 'University of Central Florida', 'World No-Talking Day', 'falfyro', 'wowow'),
(134, '0', 'University of Central Florida', 'World No-Talking Day', 'falfyro', 'ugh\'s'),
(135, '0', 'University of Central Florida', 'World No-Talking Day', 'falfyro', 'wow'),
(136, '2', 'University of Central Florida', 'Introduction Day', 'falfyro', 'huh\'?'),
(137, '1', 'University of Central Florida', 'Programming Weekend', 'falfyro', 'ssh'),
(138, '0', 'Seoul National University', 'National Korea Day', 'falfyro', 'wow'),
(139, '0', 'Seoul National University', 'National Korea Day', 'falfyro', 'oos\''),
(140, '0', 'Seoul National University', 'National Korea Day', 'falfyro', 'sosos\'\'ss'),
(141, '0', 'Seoul National University', 'National Korea Day', 'falfyro', 'ugh'),
(142, '2', 'University of Central Florida', 'Introduction to Objective Oriented Programming ', 'falfyro', 'wowo'),
(143, '2', 'University of Central Florida', 'Introduction to Objective Oriented Programming ', 'falfyro', 'ugh\''),
(144, '2', 'University of Central Florida', 'Introduction to Objective Oriented Programming ', 'falfyro', 'ooh\'ss'),
(146, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'sosososo'),
(147, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', 'sjsjs'),
(148, '0', 'University of Central Florida', 'World No-Tobacco Day', 'falfyro', '\\\\wjsjw\\');

-- --------------------------------------------------------

--
-- Table structure for table `event_rating`
--

CREATE TABLE `event_rating` (
  `id` int(11) NOT NULL,
  `event_type` varchar(128) NOT NULL COMMENT 'public=0, private=1, rso=2',
  `event_name` varchar(256) NOT NULL,
  `university_name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `rate` varchar(128) DEFAULT NULL COMMENT '1 - 5',
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0=none yet, 1=rated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_rating`
--

INSERT INTO `event_rating` (`id`, `event_type`, `event_name`, `university_name`, `username`, `rate`, `status`) VALUES
(2, '1', 'National Korea Holiday', 'Wow University', 'falfyro', '3', 1),
(6, '1', 'Learn Hangul', 'Seoul National University', 'falfyro', '5', 1),
(7, '1', 'National Europe Holiday', 'Wow University', 'falfyro', '5', 1),
(8, '1', 'National Holiday', 'Wow University', 'falfyro', '5', 1),
(9, '0', 'World No-Tobacco Day', 'University of Central Florida', 'falfyro', '3', 1),
(10, '1', 'Programming Weekend', 'University of Central Florida', 'falfyro', '5', 1),
(11, '2', 'Introduction Day', 'University of Central Florida', 'falfyro', '4', 1),
(12, '2', 'Programming Day', 'University of Central Florida', 'falfyro', '2', 1),
(13, '0', 'National Korea Day', 'Seoul National University', 'falfyro', '5', 1),
(14, '2', 'Introduction to Objective Oriented Programming ', 'University of Central Florida', 'falfyro', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `private_events`
--

CREATE TABLE `private_events` (
  `id` int(11) NOT NULL,
  `university` varchar(128) NOT NULL,
  `name` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `location` varchar(512) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `private_events`
--

INSERT INTO `private_events` (`id`, `university`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES
(1, 'Wow University', 'National Holiday', '2022-06-16', '00:00:00', '10:10:00', 'Holiday', 'WOW', 'Somewhere, World', 'someone@gmail.com', '111-111-2222'),
(2, 'Wow University', 'National Korea Holiday', '2022-03-30', '00:00:01', '02:30:00', 'Holiday', 'WOW', 'Somewhere, Korea', 'someone@gmail.com', '111-222-2222'),
(3, 'Wow University', 'National US Holiday', '2022-05-27', '10:30:00', '12:40:00', 'Holiday', 'WOW', 'Somewhere, US', 'someone@gmail.com', '333-222-2222'),
(4, 'Wow University', 'National Europe Holiday', '2022-07-20', '00:00:05', '09:30:00', 'Holiday', 'WOW', 'Somewhere, Europe', 'someone@gmail.com', '333-444-2222'),
(5, 'Wow University', 'National Asia Holiday', '2022-09-21', '00:00:11', '04:35:00', 'Holiday', 'WOW', 'Somewhere, Asia', 'someone@gmail.com', '333-444-9999'),
(6, 'Seoul National University', 'Learn Hangul In Here To Become Better and Fluent In Korean', '2022-05-05', '10:00:00', '14:00:00', 'Social', 'Come learn the original Korean alphabet! ', 'Seoul National University', 'alfy001118@gmail.com', '010-293-2292'),
(7, 'University of Central Florida', 'Programming Weekend', '2022-04-02', '12:00:00', '13:30:00', 'Learning', 'Come learn to program!', 'University of Central Florida', 'alfy001118@gmail.com', '292-393-3332'),
(8, 'University of Central Florida', 'Ugh', '2022-03-30', '00:00:00', '01:00:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.\'\'\'', '4000 Central Florida Blvd, Orlando, FL 32816', 'alfy001118@gmail.com', '111-222-3333');

-- --------------------------------------------------------

--
-- Table structure for table `public_events`
--

CREATE TABLE `public_events` (
  `id` int(11) NOT NULL,
  `university` varchar(128) NOT NULL,
  `name` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `location` varchar(512) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public_events`
--

INSERT INTO `public_events` (`id`, `university`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES
(1, 'Johns Hopkins University', 'World Cancer World Cancerourvery Day', '2023-02-04', '04:00:00', '06:30:00', 'Social', 'World Cancer Day is an international day marked on 4 February to raise awareness of cancer and to encourage its prevention, detection, and treatment. World Cancer Day is led by the Union for International Cancer Control to support the goals of the World Cancer Declaration, written in 2008. ', 'Johns Hopkins University', 'alfy13149@gmail.com', ' 444-444-4444'),
(2, 'University of Central Florida', 'World No-Tobacco Day', '2022-05-31', '12:00:00', '18:30:00', 'Fundraisingofthisisi', 'World No Tobacco Day is observed around the world every year on 31 May. This yearly celebration informs the public on the dangers of using tobacco, the business practices of tobacco companies, what the ... ', 'University of Central Florida', 'johnsmith@gmail.com', ' 555-555-5555'),
(4, 'Seoul National University', 'National Korea Day', '2022-08-15', '10:00:00', '12:00:00', 'Social', 'South Korea Liberation Day', 'Seoul National University', 'alfy001118@gmail.com', ' 111-111-1111'),
(5, 'Seoul National University', 'Origami Day', '2022-04-18', '12:00:00', '14:30:00', 'Fundraising ofthisisi', 'Come join us in our first Origami Day! We will be handing out origami paper!', 'Seoul National University', 'alfy001118@gmail.com', '222-333-4444'),
(6, 'University of Central Florida', 'World No-Talking Day', '2023-03-15', '13:00:00', '18:00:00', 'Holiday', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'wowowow@gmail.com', '555-555-5555'),
(7, 'University of Central Florida', 'World No-Spending Day', '2023-03-15', '13:00:00', '18:00:00', 'Holiday', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'wowowow@gmail.com', '555-555-5555'),
(8, 'University of Central Florida', 'World No-Sleeping Day', '2023-03-15', '13:00:00', '18:00:00', 'Holiday', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'wowowow@gmail.com', '555-555-5555'),
(9, 'Johns Hopkins University', 'World Money Day', '2023-02-04', '04:00:00', '06:30:00', 'Social', 'World Cancer Day is an international day marked on 4 February to raise awareness of cancer and to encourage its prevention, detection, and treatment. World Cancer Day is led by the Union for International Cancer Control to support the goals of the World Cancer Declaration, written in 2008. ', 'Johns Hopkins University', 'alfy13149@gmail.com', ' 444-444-4444'),
(10, 'University of Florida', 'Historical Korea Day', '2022-04-20', '12:00:00', '18:00:00', 'Historical', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.\r\n', 'University of Florida', 'alfy001118@gmail.com', '333-444-5555'),
(12, 'Johns Hopkins University', 'Ice Cream Day', '2022-04-01', '06:00:00', '12:00:00', 'Social', 'April Fool\'s Day!', '3400 N Charles St, Baltimore, MD 21218', 'alfy001118@gmail.com', '333-222-5555');

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
  `name` varchar(256) NOT NULL COMMENT 'Event Name',
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `location` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public_requests`
--

INSERT INTO `public_requests` (`id`, `admin_name`, `admin_email`, `admin_phone`, `university`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`) VALUES
(8, 'Alfred Yoo', 'alfy001118@gmail.com', '333-444-2222', 'Columbia University', 'Happy Columbia Day', '2022-06-21', '10:00:00', '12:40:00', 'Social', 'Come join and have fun', 'Columbia, New York');

-- --------------------------------------------------------

--
-- Table structure for table `rso_active`
--

CREATE TABLE `rso_active` (
  `id` int(11) NOT NULL,
  `super_admin_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `university` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `admin_email` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso_active`
--

INSERT INTO `rso_active` (`id`, `super_admin_id`, `name`, `university`, `admin_name`, `admin_email`, `description`, `status`) VALUES
(2, 8, 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh', 'alfy13149@gmail.com', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 0),
(3, 8, 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo', 'alfy001118@gmail.com', '\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"', 0),
(4, 8, 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo', 'alfy001118@gmail.com', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 0),
(5, 8, 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo', 'alfy001118@gmail.com', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 0),
(6, 8, 'IDK Do Not Ask', 'University of Florida', 'Someone Name', 'alfy13149@gmail.com', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 0),
(7, 8, 'Welcome Event', 'University of Florida', 'Someone Else', 'falfy001118@gmail.com', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.\r\n\r\n', 0),
(8, 8, 'Global Society', 'Johns Hopkins University', 'Brandon Spangler', 'alfy001118@gmail.com', '\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rso_events`
--

CREATE TABLE `rso_events` (
  `id` int(11) NOT NULL,
  `university` varchar(256) DEFAULT NULL,
  `rso_name` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `category` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `location` varchar(512) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso_events`
--

INSERT INTO `rso_events` (`id`, `university`, `rso_name`, `name`, `date`, `time_from`, `time_to`, `category`, `description`, `location`, `email`, `phone`) VALUES
(1, 'University of Central Florida', 'Global Programming Society', 'Programming Day', '2022-06-22', '13:06:00', '16:00:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(2, 'University of Central Florida', 'Global Programming Society', 'Introduction Day', '2022-05-10', '12:00:00', '13:30:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(3, 'University of Central Florida', 'Global Programming Society', 'Introduction to Programming ', '2022-05-13', '08:00:00', '10:30:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(4, 'University of Central Florida', 'Global Programming Society', 'Introduction to Objective Oriented Programming ', '2022-05-16', '10:00:00', '14:30:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(5, 'University of Central Florida', 'Global Programming Society', 'Introduction to Web Programming ', '2022-06-16', '10:30:00', '14:30:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(6, 'University of Central Florida', 'Global Programming Society', 'Introduction to Mobile Programming ', '2022-07-16', '12:30:00', '14:30:00', 'Social', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', 'University of Central Florida', 'alfy001118@gmail.com', '333-444-3333'),
(7, NULL, 'Asian Culture Organization ', 'jslsjlsjks', '2022-03-30', '17:25:00', '17:28:00', 'cat_1', 'aldkjakljfladklajflkadjflkjflakdf', 'HOME', 'alfy001118@gmail.com', '222-222-2222');

-- --------------------------------------------------------

--
-- Table structure for table `rso_members`
--

CREATE TABLE `rso_members` (
  `id` int(11) NOT NULL,
  `member_email` varchar(128) NOT NULL,
  `rso_name` varchar(128) NOT NULL,
  `university` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso_members`
--

INSERT INTO `rso_members` (`id`, `member_email`, `rso_name`, `university`, `admin_name`) VALUES
(5, 'alfy001118@gmail.com', 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh'),
(6, 'falfy001118@gmail.com', 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh'),
(7, 'someone@gmail.com', 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh'),
(8, 'someone@gmail.com', 'Asian Culture Organization ', 'University of Florida', 'Zachary Ebaugh'),
(9, 'falfy001118@gmail.com', 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo'),
(10, 'alfy13149@gmail.com', 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo'),
(11, 'alfy001118@gmail.com', 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo'),
(12, 'someone@gmail.com', 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo'),
(13, 'falfy001118@gmail.com', 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo'),
(14, 'alfy13149@gmail.com', 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo'),
(15, 'someone@gmail.com', 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo'),
(16, 'someone@gmail.com', 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo'),
(17, 'alfy13149@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(18, 'falfy001118@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(19, 'someone@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(20, 'someone@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(21, 'alfy13149@gmail.com', 'Asian Culture Organization ', 'Univerisity of Florida', 'Zachary Ebaugh'),
(22, 'ugh13149@gmail.com', 'Computer Science Organization', 'Seoul National University', 'Alfred Yoo'),
(25, 'wowowowowo@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(26, 'huh13149@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(27, 'someoneidk@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(28, 'todayismonday@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(29, 'wow@gmail.com', 'IDK Do Not Ask', 'University of Florida', 'Someone Name'),
(30, 'huh@gmail.com', 'IDK Do Not Ask', 'University of Florida', 'Someone Name'),
(31, 'ooh@gmail.com', 'IDK Do Not Ask', 'University of Florida', 'Someone Name'),
(32, 'ahh@gmail.com', 'IDK Do Not Ask', 'University of Florida', 'Someone Name'),
(33, 'alfy13149@gmail.com', 'IDK Do Not Ask', 'University of Florida', 'Someone Name'),
(34, 'huh@gmail.com', 'Welcome Event', 'University of Florida', 'Someone Else'),
(35, 'wow@gmail.com', 'Welcome Event', 'University of Florida', 'Someone Else'),
(36, 'ooh@gmail.com', 'Welcome Event', 'University of Florida', 'Someone Else'),
(37, 'ahh@gmail.com', 'Welcome Event', 'University of Florida', 'Someone Else'),
(38, 'falfy001118@gmail.com', 'Welcome Event', 'University of Florida', 'Someone Else'),
(44, 'alfy001118@gmail.com', 'Korean Culture Association', 'University of Central Florida', 'Alfred Yoo'),
(45, 'falfy001118@gmail.com', 'Global Society', 'Johns Hopkins University', 'Brandon Spangler'),
(46, 'alfy13149@gmail.com', 'Global Society', 'Johns Hopkins University', 'Brandon Spangler'),
(47, 'someone@gmail.com', 'Global Society', 'Johns Hopkins University', 'Brandon Spangler'),
(48, 'someone@gmail.com', 'Global Society', 'Johns Hopkins University', 'Brandon Spangler'),
(49, 'alfy001118@gmail.com', 'Global Society', 'Johns Hopkins University', 'Brandon Spangler'),
(50, 'alfy001118@gmail.com', 'Global Programming Society', 'University of Central Florida', 'Alfred Yoo');

-- --------------------------------------------------------

--
-- Table structure for table `rso_requests`
--

CREATE TABLE `rso_requests` (
  `id` int(11) NOT NULL,
  `super_admin_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `university` varchar(128) NOT NULL,
  `admin_name` varchar(128) NOT NULL,
  `admin_email` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `member_one` varchar(128) NOT NULL,
  `member_two` varchar(128) NOT NULL,
  `member_three` varchar(128) NOT NULL,
  `member_four` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rso_requests`
--

INSERT INTO `rso_requests` (`id`, `super_admin_id`, `name`, `university`, `admin_name`, `admin_email`, `description`, `member_one`, `member_two`, `member_three`, `member_four`) VALUES
(5, 8, 'Global Medical Society', 'Johns Hopkins University', 'Brandon Spangler', 'falfy001118@gmail.com', '\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'alfy001118@gmail.com', 'alfy13149@gmail.com', 'someone@gmail.com', 'someone@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `super_admin_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `location` varchar(512) NOT NULL,
  `num_students` int(5) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `picture_name` varchar(128) DEFAULT NULL,
  `picture_link` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `super_admin_id`, `name`, `location`, `num_students`, `description`, `picture_name`, `picture_link`) VALUES
(1, 8, 'University of Central Florida', 'Orlando, FL', 329299, 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.\r\n\r\n', 'UCF', 'uploads/6242c7f8225d16.74457463.jpeg'),
(2, 8, 'University of Florida', 'Gainesville, FL', 52367, 'The University of Florida is a public land-grant research university in Gainesville, Florida. It is a senior member of the State University System of Florida, traces its origins to 1853, and has operated continuously on its Gainesville campus since September 1906. Wikipedia\r\n', 'UF Home', 'uploads/623fea057ea9a0.14181296.jpeg'),
(3, 8, 'Seoul National University', 'Seoul, South Korea', 27813, 'Seoul National University is a national research university located in Seoul, South Korea. It is one of the flagship Korean national universities. Founded in 1946, Seoul National University is considered the most prestigious university in South Korea. Wikipedia\r\n', 'SNU Entrance', 'uploads/623fea92820eb2.09923183.jpeg'),
(4, 8, 'Harvard University', 'Cambridge, MA', 22947, 'Harvard University is a private Ivy League research university in Cambridge, Massachusetts. Founded in 1636 as Harvard College and named for its first benefactor, the Puritan clergyman John Harvard, it is the oldest institution of higher learning in the United States and among the most prestigious in the world. Wikipedia\r\n', 'Harvard', 'uploads/623feada4a7c51.04496417.jpeg'),
(6, 8, 'Johns Hopkins University', 'Baltimore, MD', 23917, 'The Johns Hopkins University is a private research university in Baltimore, Maryland. Founded in 1876, the university was named for its first benefactor, the American entrepreneur and philanthropist Johns Hopkins. Johns Hopkins is the oldest research university in the United States. Wikipedia\r\n', 'JHU', 'uploads/623feb7b8b72e3.10676311.jpeg'),
(7, 8, 'Yonsei University', 'Seoul, South Korea', 40291, 'Yonsei University is a private research university in Seoul, South Korea. As a member of the \"SKY\" universities, Yonsei University is deemed one of the three most prestigious institutions in the country. It is particularly respected in the studies of medicine and business administration. Wikipedia\r\n', 'Yonsei', 'uploads/623feba8ae6210.81391501.jpeg'),
(8, 8, 'Goryeo University', 'Seoul, South Korea', 37493, 'Korea University is a private research university in Seoul, South Korea. As one of the SKY universities, it is one of the oldest and most prestigious universities in the country. For the past 5 years, it has consecutively been ranked as one of the top 100 universities in the world by the QS World University Rankings. Wikipedia\r\n', 'Korea University', 'uploads/623febfb5f9357.02305823.png'),
(9, 8, 'Korea University', 'Seoul, South Korea', 20202, 'SKY, Land, Sea ~ Ugh', 'Korea University', 'uploads/62405525bef541.86303692.jpeg'),
(18, 8, 'Wow University', 'Seoul, South Korea', 38000, 'soememsmsmsm', 'oww', 'uploads/623fa25b6d97a7.73980913.jpeg');

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
  `university_status` int(2) NOT NULL DEFAULT 0,
  `uni_id` int(128) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `username`, `password`, `name`, `email`, `phone`, `date`, `verification_code`, `verification_status`, `user_status`, `pass_reset_token`, `university_status`, `uni_id`) VALUES
(8, 'falfyro', '$2y$10$.LSgFLDe/wTYXpKgNml5Lu0rWjvLqeewqQodx2DaNQqXTzcoP9HiS', 'Alfred Yoo', 'alfy001118@gmail.com', '333-333-3333', '2022-03-28 22:54:10', 'f8ebb9e5aae9cd02a42f6302c432595c', 1, 2, NULL, 1, 0),
(9, 'zebaugh', '$2y$10$l3K3.xb5mpdvjV0JDxM4GeZK7FqgXWEzVUQW8hxqOk8tobcOTBhCq', 'Zachary Ebaugh', 'alfy13149@gmail.com', '111-111-2222', '2022-03-29 20:48:50', '3df07196f327685aea1bb020a301e28c', 1, 1, NULL, 1, 1),
(10, 'bspangler', '$2y$10$M1qov4QUHUw99xnKwHRA.uX0xTWad6CnVCQZTbjSveWdwt/iKzAbG', 'Brandon Spangler', 'falfy001118@gmail.com', '111-222-3333', '2022-03-26 03:32:10', 'd0d1e048e5853b549713cbba1c2c6b5d', 1, 0, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_rating`
--
ALTER TABLE `event_rating`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `rso_active`
--
ALTER TABLE `rso_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rso_events`
--
ALTER TABLE `rso_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rso_members`
--
ALTER TABLE `rso_members`
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
-- AUTO_INCREMENT for table `event_comments`
--
ALTER TABLE `event_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `event_rating`
--
ALTER TABLE `event_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `private_events`
--
ALTER TABLE `private_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `public_events`
--
ALTER TABLE `public_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `public_requests`
--
ALTER TABLE `public_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rso_active`
--
ALTER TABLE `rso_active`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rso_events`
--
ALTER TABLE `rso_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rso_members`
--
ALTER TABLE `rso_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `rso_requests`
--
ALTER TABLE `rso_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
