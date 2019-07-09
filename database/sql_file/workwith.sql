-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2019 at 05:22 AM
-- Server version: 5.6.44
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vooap_workwith`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Delete',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `image`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Title article 1', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. ', '1536930457.jpeg', 1, '2019-02-15 00:00:00', '2019-02-28 00:00:00'),
(2, 'Title article 2', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. ', '1536930490.jpeg', 1, '2019-01-20 00:00:00', '2019-02-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 => active 1 => deactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => active 1 => deactive\n sender can hide message from his/her side',
  `receiver_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => active 1 => deactive\n receiver can hide message from his/her side',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `message`, `sender_status`, `receiver_status`, `created_at`, `updated_at`) VALUES
(1, 3, 12, ' test', 1, 1, NULL, NULL),
(2, 4, 12, 'I have another account in this appds', 1, 1, '2019-02-28 01:04:52', NULL),
(3, 3, 12, 'fsdfsdf', 1, 1, '2019-02-28 01:05:27', NULL),
(4, 12, 3, 'I have another account in this appds', 0, 1, '2019-02-28 02:10:49', NULL),
(5, 12, 3, 'I have another account in this appds', 0, 1, '2019-02-28 02:11:04', NULL),
(6, 35, 39, 'huiii', 1, 1, '2019-04-01 16:48:01', NULL),
(7, 35, 39, 'huiii', 1, 1, '2019-04-01 16:48:02', NULL),
(8, 35, 39, 'hiiii', 1, 1, '2019-04-01 16:50:29', NULL),
(9, 35, 39, 'hmmmm', 1, 1, '2019-04-01 16:50:58', NULL),
(10, 35, 39, 'uiiiii', 1, 1, '2019-04-01 17:02:37', NULL),
(11, 35, 39, 'hmmmm', 1, 1, '2019-04-01 17:03:00', NULL),
(12, 35, 39, 'hmmmm', 1, 1, '2019-04-01 17:03:00', NULL),
(13, 35, 39, 'qwer', 1, 1, '2019-04-01 17:03:23', NULL),
(14, 35, 39, 'hii', 1, 1, '2019-04-01 17:11:35', NULL),
(15, 35, 39, 'hey', 1, 1, '2019-04-01 17:11:46', NULL),
(16, 35, 39, 'hmm', 1, 1, '2019-04-01 17:12:49', NULL),
(17, 39, 35, 'hii', 1, 1, '2019-04-01 17:16:42', NULL),
(18, 39, 35, 'hii', 1, 1, '2019-04-01 17:16:43', NULL),
(19, 39, 35, 'you', 1, 1, '2019-04-01 17:17:09', NULL),
(20, 35, 39, 'goo', 1, 1, '2019-04-01 17:18:18', NULL),
(21, 35, 39, 'goo', 1, 1, '2019-04-01 17:18:18', NULL),
(22, 35, 39, 'ko', 1, 1, '2019-04-01 17:19:39', NULL),
(23, 39, 35, 'ummm', 1, 1, '2019-04-01 17:20:10', NULL),
(24, 39, 35, 'twywyw', 1, 1, '2019-04-01 17:24:57', NULL),
(25, 39, 35, 'vdjejseheh', 1, 1, '2019-04-01 17:25:04', NULL),
(26, 39, 44, 'tuui', 1, 1, '2019-04-01 17:25:40', NULL),
(27, 39, 44, 'fwhwh', 1, 1, '2019-04-01 17:25:45', NULL),
(28, 44, 35, 'Hello, This is a testing message', 1, 1, '2019-04-01 17:33:47', NULL),
(29, 44, 39, 'Hello, This is a testing messagessss', 1, 1, '2019-04-01 17:33:47', NULL),
(30, 39, 35, 'hmmm', 1, 1, '2019-04-01 17:45:17', NULL),
(31, 39, 35, 'huuuuuu', 1, 1, '2019-04-01 17:45:37', NULL),
(32, 35, 39, 'last message 39 receive', 1, 1, '2019-04-01 17:46:35', NULL),
(33, 35, 39, 'kii', 1, 1, '2019-04-01 17:51:58', NULL),
(34, 35, 39, 'kuch ni', 1, 1, '2019-04-01 17:52:22', NULL),
(35, 35, 39, 'hmm', 1, 1, '2019-04-01 18:00:06', NULL),
(36, 39, 35, 'kya huq', 1, 1, '2019-04-01 18:00:15', NULL),
(37, 35, 39, 'bsd', 1, 1, '2019-04-01 18:00:25', NULL),
(38, 39, 35, 'sfgh', 1, 1, '2019-04-01 18:00:28', NULL),
(39, 35, 39, 'ccc', 1, 1, '2019-04-01 18:00:32', NULL),
(40, 39, 35, 'qwerty', 1, 1, '2019-04-01 18:00:36', NULL),
(41, 35, 39, 'typhoon', 1, 1, '2019-04-01 18:00:44', NULL),
(42, 39, 35, 'ap', 1, 1, '2019-04-01 18:01:00', NULL),
(43, 39, 35, 'rgh', 1, 1, '2019-04-01 18:01:05', NULL),
(44, 39, 35, 'rtt', 1, 1, '2019-04-01 18:01:19', NULL),
(45, 35, 39, 'cghj', 1, 1, '2019-04-01 18:01:24', NULL),
(46, 39, 35, 'ap', 1, 1, '2019-04-01 18:01:29', NULL),
(47, 35, 39, 'Kendrick y\'all kal Grayson Israel will am stuck', 1, 1, '2019-04-01 18:01:45', NULL),
(48, 35, 39, 'gwhwjsn shaken Shashank daubs Ahab windbag dhdbsbhsjsjsnejwbshsbd shins dhsbdudhsb', 1, 1, '2019-04-01 18:01:59', NULL),
(49, 39, 35, 'gooodd', 1, 1, '2019-04-01 18:08:28', NULL),
(50, 39, 35, 'hmmm', 1, 1, '2019-04-01 18:08:32', NULL),
(51, 35, 39, 'kya', 1, 1, '2019-04-01 18:08:41', NULL),
(52, 35, 39, 'kyahuaa', 1, 1, '2019-04-01 18:08:42', NULL),
(53, 35, 39, 'hey', 1, 1, '2019-05-03 14:30:19', NULL),
(54, 35, 39, 'hii', 1, 1, '2019-05-06 10:49:53', NULL),
(55, 35, 39, 'geee', 1, 1, '2019-05-14 12:38:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `reply_message` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=relied,0=not replied',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `email`, `subject`, `message`, `reply_message`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 'mdsknfskjdfds@gmail.com', 'sdfsdf', 'sdfdsf', '', 0, '2019-05-29 11:38:50', '2018-10-30 12:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `days` varchar(400) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `days`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Monday', 'Monday', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00'),
(2, 'Tuesday', 'Tuesday', 1, '2018-04-19 12:18:00', '2018-04-19 12:18:00'),
(3, 'Wednesday', 'Wednesday', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00'),
(4, 'Thursday', 'Thursday', 1, '', ''),
(5, 'Friday', 'Friday', 1, '', ''),
(6, 'Saturday', 'Saturday', 1, '', ''),
(7, 'Sunday', 'Sunday', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `delete_account`
--

CREATE TABLE `delete_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delete_account`
--

INSERT INTO `delete_account` (`id`, `user_id`, `message`, `created_at`) VALUES
(4, 12, 'I have another acfdsfsdcount idn this appsssss', '2019-02-26 10:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=deactive',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Work/Study Partner', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00'),
(2, 'Collaborators', 1, '2018-04-19 12:18:00', '2018-04-19 12:18:00'),
(3, 'Input/inspiration', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00'),
(4, 'Friendship', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '//0=>Match request, 1=> Matched, 2=>Match cancelled,3 => unmatch',
  `message` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `user_id`, `other_user_id`, `status`, `message`, `updated_at`, `created_at`) VALUES
(35, 29, 39, 1, NULL, '2019-03-22 13:14:29', '2019-03-22 01:11:19'),
(36, 39, 32, 1, NULL, NULL, '2019-03-22 02:03:26'),
(37, 32, 30, 0, NULL, NULL, '2019-03-22 02:03:43'),
(38, 32, 33, 0, NULL, NULL, '2019-03-22 02:03:49'),
(39, 32, 34, 0, NULL, NULL, '2019-03-22 02:03:54'),
(40, 32, 24, 0, NULL, NULL, '2019-03-22 02:03:59'),
(41, 32, 35, 0, NULL, NULL, '2019-03-22 02:04:08'),
(42, 32, 29, 0, NULL, NULL, '2019-03-22 02:04:12'),
(43, 39, 5, 1, NULL, '2019-03-22 13:14:29', '2019-03-22 01:11:19'),
(44, 39, 30, 0, NULL, NULL, '2019-03-22 02:13:32'),
(45, 39, 35, 1, NULL, NULL, '2019-03-22 02:20:40'),
(46, 30, 33, 0, NULL, NULL, '2019-03-22 03:23:11'),
(47, 30, 29, 0, NULL, NULL, '2019-03-22 03:23:15'),
(48, 30, 34, 0, NULL, NULL, '2019-03-22 03:26:03'),
(49, 40, 33, 0, NULL, NULL, '2019-03-22 03:52:50'),
(50, 40, 34, 0, NULL, NULL, '2019-03-22 03:52:53'),
(51, 40, 29, 0, NULL, NULL, '2019-03-22 03:52:59'),
(52, 40, 35, 0, NULL, NULL, '2019-03-22 03:53:03'),
(53, 40, 30, 0, NULL, NULL, '2019-03-22 03:54:41'),
(54, 40, 39, 0, NULL, NULL, '2019-03-22 03:54:50'),
(55, 40, 32, 0, NULL, NULL, '2019-03-22 03:55:47'),
(56, 39, 33, 0, NULL, NULL, '2019-03-22 03:58:09'),
(57, 39, 34, 0, NULL, NULL, '2019-03-22 03:58:54'),
(58, 33, 34, 0, NULL, NULL, '2019-03-22 04:01:07'),
(59, 33, 29, 0, NULL, NULL, '2019-03-22 04:01:43'),
(60, 29, 34, 0, NULL, NULL, '2019-03-22 04:02:42'),
(61, 41, 33, 0, NULL, NULL, '2019-03-22 04:06:41'),
(62, 41, 30, 0, NULL, NULL, '2019-03-22 04:06:46'),
(63, 41, 32, 0, NULL, NULL, '2019-03-22 04:06:55'),
(64, 41, 39, 1, NULL, NULL, '2019-03-22 04:07:00'),
(65, 41, 40, 0, NULL, NULL, '2019-03-22 04:15:16'),
(66, 41, 34, 0, NULL, NULL, '2019-03-22 04:15:32'),
(67, 41, 29, 0, NULL, NULL, '2019-03-22 04:15:36'),
(68, 41, 35, 0, NULL, NULL, '2019-03-22 04:15:46'),
(69, 42, 33, 0, NULL, NULL, '2019-03-22 04:18:39'),
(70, 42, 40, 0, NULL, NULL, '2019-03-22 04:18:42'),
(71, 42, 41, 0, NULL, NULL, '2019-03-22 04:18:45'),
(72, 42, 30, 0, NULL, NULL, '2019-03-22 04:18:47'),
(73, 42, 34, 0, NULL, NULL, '2019-03-22 04:18:50'),
(74, 42, 32, 0, NULL, NULL, '2019-03-22 04:18:53'),
(75, 42, 29, 0, NULL, NULL, '2019-03-22 04:18:55'),
(76, 42, 39, 0, NULL, NULL, '2019-03-22 04:18:58'),
(77, 42, 35, 0, NULL, NULL, '2019-03-22 04:19:01'),
(78, 43, 29, 0, NULL, NULL, '2019-03-26 09:25:15'),
(79, 43, 42, 0, NULL, NULL, '2019-03-26 09:25:22'),
(80, 45, 43, 0, NULL, NULL, '2019-04-01 03:58:20'),
(81, 45, 33, 0, NULL, NULL, '2019-04-01 03:58:22'),
(82, 33, 43, 0, NULL, NULL, '2019-04-01 03:59:10'),
(83, 32, 43, 0, NULL, NULL, '2019-04-01 04:00:01'),
(84, 32, 45, 0, NULL, NULL, '2019-04-01 04:00:03'),
(85, 45, 42, 0, NULL, NULL, '2019-04-01 04:00:37'),
(86, 45, 40, 0, NULL, NULL, '2019-04-01 04:00:39'),
(87, 45, 41, 0, NULL, NULL, '2019-04-01 04:00:41'),
(88, 45, 30, 0, NULL, NULL, '2019-04-01 04:00:44'),
(89, 50, 29, 0, NULL, NULL, '2019-04-11 08:49:59'),
(90, 35, 43, 0, NULL, NULL, '2019-04-12 12:50:03'),
(91, 51, 29, 0, NULL, NULL, '2019-04-29 02:15:30'),
(92, 1, 35, 0, NULL, NULL, '2019-05-03 03:27:03'),
(93, 60, 47, 0, NULL, NULL, '2019-05-10 06:53:06'),
(94, 60, 46, 0, NULL, NULL, '2019-05-10 06:53:10'),
(95, 60, 29, 0, NULL, NULL, '2019-05-10 06:53:13'),
(96, 60, 39, 0, NULL, NULL, '2019-05-10 06:53:15'),
(97, 60, 48, 0, NULL, NULL, '2019-05-10 06:53:23'),
(98, 60, 35, 0, NULL, NULL, '2019-05-10 06:53:31'),
(99, 60, 49, 0, NULL, NULL, '2019-05-10 06:53:34'),
(100, 60, 50, 0, NULL, NULL, '2019-05-10 06:53:36'),
(101, 60, 51, 0, NULL, NULL, '2019-05-10 06:53:38'),
(102, 60, 40, 0, NULL, NULL, '2019-05-10 06:53:40'),
(103, 60, 59, 0, NULL, NULL, '2019-05-10 06:53:42'),
(104, 60, 41, 0, NULL, NULL, '2019-05-10 06:53:44'),
(105, 60, 56, 0, NULL, NULL, '2019-05-10 06:59:59'),
(106, 60, 30, 0, NULL, NULL, '2019-05-10 07:00:00'),
(107, 60, 32, 0, NULL, NULL, '2019-05-10 07:00:02'),
(108, 60, 34, 0, NULL, NULL, '2019-05-10 07:00:04'),
(109, 60, 42, 0, NULL, NULL, '2019-05-10 07:00:05'),
(110, 60, 43, 0, NULL, NULL, '2019-05-10 07:00:07'),
(111, 60, 45, 0, NULL, NULL, '2019-05-10 07:00:09'),
(112, 60, 33, 0, NULL, NULL, '2019-05-10 07:00:10'),
(113, 61, 47, 0, NULL, NULL, '2019-05-10 07:08:03'),
(114, 61, 46, 0, NULL, NULL, '2019-05-10 07:08:05'),
(115, 61, 29, 0, NULL, NULL, '2019-05-10 07:08:06'),
(116, 61, 39, 0, NULL, NULL, '2019-05-10 07:08:08'),
(117, 61, 48, 0, NULL, NULL, '2019-05-10 07:08:09'),
(118, 61, 35, 0, NULL, NULL, '2019-05-10 07:08:11'),
(119, 61, 49, 0, NULL, NULL, '2019-05-10 07:08:13'),
(120, 61, 50, 0, NULL, NULL, '2019-05-10 07:08:15'),
(121, 61, 51, 0, NULL, NULL, '2019-05-10 07:08:16'),
(122, 61, 40, 0, NULL, NULL, '2019-05-10 07:08:19'),
(123, 61, 59, 0, NULL, NULL, '2019-05-10 07:08:21'),
(124, 61, 41, 0, NULL, NULL, '2019-05-10 07:08:25'),
(125, 61, 60, 0, NULL, NULL, '2019-05-10 07:11:54'),
(126, 61, 30, 0, NULL, NULL, '2019-05-10 07:11:57'),
(127, 61, 32, 0, NULL, NULL, '2019-05-10 07:11:59'),
(128, 61, 34, 0, NULL, NULL, '2019-05-10 07:12:03'),
(129, 61, 42, 0, NULL, NULL, '2019-05-10 07:12:05'),
(130, 61, 43, 0, NULL, NULL, '2019-05-10 07:12:08'),
(131, 61, 45, 0, NULL, NULL, '2019-05-10 07:12:12'),
(132, 61, 56, 0, NULL, NULL, '2019-05-10 07:12:16'),
(133, 61, 33, 0, NULL, NULL, '2019-05-10 07:12:18'),
(134, 62, 46, 0, NULL, NULL, '2019-05-10 07:18:01'),
(135, 62, 47, 0, NULL, NULL, '2019-05-10 07:18:03'),
(136, 62, 29, 0, NULL, NULL, '2019-05-10 07:18:08'),
(137, 62, 39, 0, NULL, NULL, '2019-05-10 07:18:10'),
(138, 62, 51, 0, NULL, NULL, '2019-05-10 07:18:11'),
(139, 62, 40, 0, NULL, NULL, '2019-05-10 07:18:13'),
(140, 62, 59, 0, NULL, NULL, '2019-05-10 07:18:42'),
(141, 62, 41, 0, NULL, NULL, '2019-05-10 07:18:44'),
(142, 62, 30, 0, NULL, NULL, '2019-05-10 07:18:47'),
(143, 62, 56, 0, NULL, NULL, '2019-05-10 07:18:49'),
(144, 62, 42, 0, NULL, NULL, '2019-05-10 07:18:53'),
(145, 62, 60, 0, NULL, NULL, '2019-05-10 07:21:53'),
(146, 62, 34, 0, NULL, NULL, '2019-05-10 07:21:55'),
(147, 62, 61, 0, NULL, NULL, '2019-05-10 07:21:57'),
(148, 62, 35, 0, NULL, NULL, '2019-05-10 07:21:59'),
(149, 62, 43, 0, NULL, NULL, '2019-05-10 07:22:01'),
(150, 62, 45, 0, NULL, NULL, '2019-05-10 07:22:02'),
(151, 62, 48, 0, NULL, NULL, '2019-05-10 07:22:04'),
(152, 62, 49, 0, NULL, NULL, '2019-05-10 07:22:06'),
(153, 62, 50, 0, NULL, NULL, '2019-05-10 07:22:08'),
(154, 62, 32, 0, NULL, NULL, '2019-05-10 07:22:18'),
(155, 62, 33, 0, NULL, NULL, '2019-05-10 07:22:20'),
(156, 63, 46, 0, NULL, NULL, '2019-05-10 07:28:07'),
(157, 63, 47, 0, NULL, NULL, '2019-05-10 07:28:09'),
(158, 63, 29, 0, NULL, NULL, '2019-05-10 07:28:11'),
(159, 63, 39, 0, NULL, NULL, '2019-05-10 07:28:13'),
(160, 63, 32, 0, NULL, NULL, '2019-05-10 07:28:15'),
(161, 63, 60, 0, NULL, NULL, '2019-05-10 07:28:16'),
(162, 63, 43, 0, NULL, NULL, '2019-05-10 07:28:18'),
(163, 63, 34, 0, NULL, NULL, '2019-05-10 07:28:20'),
(164, 63, 61, 0, NULL, NULL, '2019-05-10 07:28:22'),
(165, 63, 42, 0, NULL, NULL, '2019-05-10 07:32:47'),
(166, 63, 62, 0, NULL, NULL, '2019-05-10 07:32:49'),
(167, 63, 45, 0, NULL, NULL, '2019-05-10 07:32:51'),
(168, 63, 48, 0, NULL, NULL, '2019-05-10 07:32:53'),
(169, 63, 49, 0, NULL, NULL, '2019-05-10 07:32:55'),
(170, 63, 30, 0, NULL, NULL, '2019-05-10 07:32:57'),
(171, 63, 50, 0, NULL, NULL, '2019-05-10 07:32:59'),
(172, 63, 35, 0, NULL, NULL, '2019-05-10 07:33:00'),
(173, 63, 51, 0, NULL, NULL, '2019-05-10 07:33:02'),
(174, 63, 59, 0, NULL, NULL, '2019-05-10 07:33:04'),
(175, 63, 40, 0, NULL, NULL, '2019-05-10 07:33:06'),
(176, 63, 41, 0, NULL, NULL, '2019-05-10 07:33:07'),
(177, 63, 56, 0, NULL, NULL, '2019-05-10 07:44:08'),
(178, 63, 33, 0, NULL, NULL, '2019-05-10 07:44:10'),
(179, 64, 46, 0, NULL, NULL, '2019-05-10 07:48:58'),
(180, 64, 47, 0, NULL, NULL, '2019-05-10 07:49:00'),
(181, 64, 29, 0, NULL, NULL, '2019-05-10 07:49:01'),
(182, 64, 39, 0, NULL, NULL, '2019-05-10 07:49:03'),
(183, 64, 42, 0, NULL, NULL, '2019-05-10 07:49:05'),
(184, 64, 30, 0, NULL, NULL, '2019-05-10 07:49:07'),
(185, 64, 51, 0, NULL, NULL, '2019-05-10 07:55:38'),
(186, 64, 41, 0, NULL, NULL, '2019-05-10 07:57:20'),
(187, 64, 50, 0, NULL, NULL, '2019-05-10 07:59:26'),
(188, 64, 48, 0, NULL, NULL, '2019-05-10 07:59:39'),
(189, 64, 59, 0, NULL, NULL, '2019-05-10 07:59:46'),
(190, 64, 60, 0, NULL, NULL, '2019-05-10 08:00:12'),
(191, 64, 34, 0, NULL, NULL, '2019-05-10 08:00:14'),
(192, 64, 61, 0, NULL, NULL, '2019-05-10 08:00:16'),
(193, 64, 40, 0, NULL, NULL, '2019-05-10 08:00:29'),
(194, 64, 43, 0, NULL, NULL, '2019-05-10 08:00:35'),
(195, 64, 45, 0, NULL, NULL, '2019-05-10 08:00:37'),
(196, 64, 49, 0, NULL, NULL, '2019-05-10 08:00:41'),
(197, 64, 56, 0, NULL, NULL, '2019-05-10 08:00:43'),
(198, 64, 32, 0, NULL, NULL, '2019-05-10 08:00:45'),
(199, 64, 62, 0, NULL, NULL, '2019-05-10 08:00:47'),
(200, 64, 35, 0, NULL, NULL, '2019-05-10 08:00:50'),
(201, 64, 63, 0, NULL, NULL, '2019-05-10 08:00:51'),
(202, 64, 33, 0, NULL, NULL, '2019-05-10 08:00:53'),
(203, 64, 0, 0, NULL, NULL, '2019-05-10 08:02:24'),
(204, 65, 46, 0, NULL, NULL, '2019-05-13 03:06:27'),
(205, 65, 47, 0, NULL, NULL, '2019-05-13 03:06:29'),
(206, 66, 46, 0, NULL, NULL, '2019-05-13 04:22:44'),
(207, 66, 34, 0, NULL, NULL, '2019-05-13 04:23:10'),
(208, 66, 61, 0, NULL, NULL, '2019-05-13 04:23:11'),
(209, 66, 45, 0, NULL, NULL, '2019-05-13 04:23:12'),
(210, 65, 29, 0, NULL, NULL, '2019-05-13 04:42:04'),
(211, 65, 39, 0, NULL, NULL, '2019-05-13 04:42:07'),
(212, 65, 42, 0, NULL, NULL, '2019-05-13 04:42:09'),
(213, 65, 66, 0, NULL, NULL, '2019-05-13 04:42:29'),
(214, 65, 51, 0, NULL, NULL, '2019-05-13 04:42:32'),
(215, 65, 40, 0, NULL, NULL, '2019-05-13 04:42:34'),
(216, 65, 59, 0, NULL, NULL, '2019-05-13 04:42:36'),
(217, 65, 62, 0, NULL, NULL, '2019-05-13 05:00:19'),
(218, 65, 63, 0, NULL, NULL, '2019-05-13 05:00:20'),
(219, 65, 64, 0, NULL, NULL, '2019-05-13 05:00:22'),
(220, 65, 32, 0, NULL, NULL, '2019-05-13 05:00:24'),
(221, 65, 34, 0, NULL, NULL, '2019-05-13 05:00:26'),
(222, 65, 35, 0, NULL, NULL, '2019-05-13 05:00:27'),
(223, 65, 49, 0, NULL, NULL, '2019-05-13 05:00:29'),
(224, 65, 50, 0, NULL, NULL, '2019-05-13 05:00:30'),
(225, 65, 33, 0, NULL, NULL, '2019-05-13 05:00:32'),
(226, 60, 65, 0, NULL, NULL, '2019-05-13 05:10:27'),
(227, 60, 66, 0, NULL, NULL, '2019-05-13 05:10:29'),
(228, 67, 46, 0, NULL, NULL, '2019-05-13 05:21:53'),
(229, 67, 39, 0, NULL, NULL, '2019-05-13 05:22:04'),
(230, 67, 48, 0, NULL, NULL, '2019-05-13 05:22:06'),
(231, 67, 35, 0, NULL, NULL, '2019-05-13 05:22:08'),
(232, 67, 62, 0, NULL, NULL, '2019-05-13 05:22:09'),
(233, 60, 67, 0, NULL, NULL, '2019-05-13 05:25:41'),
(234, 61, 65, 0, NULL, NULL, '2019-05-13 06:07:58'),
(235, 61, 67, 0, NULL, NULL, '2019-05-13 06:08:00'),
(236, 66, 62, 0, NULL, NULL, '2019-05-13 06:25:15'),
(237, 66, 63, 0, NULL, NULL, '2019-05-13 06:25:18'),
(238, 68, 46, 0, NULL, NULL, '2019-05-13 06:54:36'),
(239, 68, 29, 0, NULL, NULL, '2019-05-13 06:57:13'),
(240, 68, 39, 0, NULL, NULL, '2019-05-13 06:57:15'),
(241, 68, 45, 0, NULL, NULL, '2019-05-13 06:57:17'),
(242, 68, 34, 0, NULL, NULL, '2019-05-13 06:57:26'),
(243, 68, 61, 0, NULL, NULL, '2019-05-13 06:57:29'),
(244, 68, 48, 0, NULL, NULL, '2019-05-13 06:57:30'),
(245, 68, 35, 0, NULL, NULL, '2019-05-13 06:57:32'),
(246, 68, 62, 0, NULL, NULL, '2019-05-13 06:57:34'),
(247, 68, 49, 0, NULL, NULL, '2019-05-13 06:57:36'),
(248, 68, 63, 0, NULL, NULL, '2019-05-13 06:57:38'),
(249, 68, 50, 0, NULL, NULL, '2019-05-13 06:57:39'),
(250, 35, 34, 0, NULL, NULL, '2019-05-14 12:37:50'),
(251, 60, 68, 0, NULL, NULL, '2019-05-14 05:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_02_26_041334_create_delete_account_table', 2),
(8, '2019_02_26_042426_add_votes_to_users_table', 3),
(11, '2019_02_27_100847_create_blocks_table', 4),
(12, '2019_03_05_125533_create_user_suggestion_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'A=Active, D=Deactive',
  `read_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Unread,1=read',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `receiver_id`, `label`, `message`, `status`, `read_status`, `updated_at`, `created_at`) VALUES
(1, 35, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 15:32:08', '2019-03-26 15:32:08'),
(2, 35, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 15:33:50', '2019-03-26 15:33:50'),
(3, 35, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 15:46:21', '2019-03-26 15:46:21'),
(4, 30, 35, 'meet match', 'You have got a match', 1, 1, '2019-03-26 15:48:48', '2019-03-26 15:48:48'),
(5, 30, 30, 'meet match', 'You have got a match', 1, 1, '2019-03-26 16:24:40', '2019-03-26 16:24:40'),
(6, 30, 30, 'meet match', 'You have got a match', 1, 1, '2019-03-26 17:02:36', '2019-03-26 17:02:36'),
(7, 30, 30, 'meet match', 'You have got a match', 1, 1, '2019-03-26 17:14:12', '2019-03-26 17:14:12'),
(8, 30, 30, 'meet match', 'You have got a match', 1, 1, '2019-03-26 17:14:45', '2019-03-26 17:14:45'),
(9, 0, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 17:24:03', '2019-03-26 17:24:03'),
(10, 30, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 17:35:55', '2019-03-26 17:35:55'),
(11, 30, 30, 'meet match', 'You have got a match', 1, 1, '2019-03-26 18:03:44', '2019-03-26 18:03:44'),
(12, 30, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 18:10:56', '2019-03-26 18:10:56'),
(13, 30, 39, 'meet match', 'You have got a match', 1, 1, '2019-03-26 18:13:38', '2019-03-26 18:13:38'),
(14, 34, 39, 'meet match', 'You got a meet match', 1, 1, '2019-03-27 14:22:10', '2019-03-27 14:22:10'),
(15, 34, 39, 'meet match', 'You got a meet match', 1, 1, '2019-03-27 14:23:00', '2019-03-27 14:23:00'),
(16, 30, 30, 'meet match', 'You got a meet match', 1, 1, '2019-03-27 14:24:51', '2019-03-27 14:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `passUsers`
--

CREATE TABLE `passUsers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passUsers`
--

INSERT INTO `passUsers` (`id`, `user_id`, `other_user_id`, `status`, `date`) VALUES
(18, 43, 39, 1, '2019-03-26 09:18:25'),
(19, 43, 41, 1, '2019-03-26 09:20:25'),
(20, 45, 34, 1, '2019-04-01 16:47:00'),
(21, 45, 29, 1, '2019-04-01 16:49:00'),
(22, 45, 39, 1, '2019-04-01 16:51:00'),
(23, 45, 35, 1, '2019-04-01 16:54:00'),
(24, 35, 33, 1, '2019-04-12 11:30:07'),
(25, 35, 45, 1, '2019-05-06 10:56:53'),
(26, 35, 48, 1, '2019-05-06 10:31:55'),
(27, 66, 47, 1, '2019-05-13 16:46:22'),
(28, 66, 29, 1, '2019-05-13 16:51:22'),
(29, 66, 39, 1, '2019-05-13 16:56:22'),
(30, 65, 41, 1, '2019-05-13 16:40:42'),
(31, 65, 56, 1, '2019-05-13 16:42:42'),
(32, 65, 43, 1, '2019-05-13 16:46:42'),
(33, 65, 60, 1, '2019-05-13 16:49:42'),
(34, 65, 45, 1, '2019-05-13 16:52:42'),
(35, 65, 30, 1, '2019-05-13 16:55:42'),
(36, 65, 61, 1, '2019-05-13 16:59:42'),
(37, 65, 48, 1, '2019-05-13 16:02:43'),
(38, 67, 47, 1, '2019-05-13 17:57:21'),
(39, 67, 29, 1, '2019-05-13 17:01:22'),
(40, 67, 49, 1, '2019-05-13 17:11:22'),
(41, 65, 67, 1, '2019-05-13 17:23:37'),
(42, 66, 42, 1, '2019-05-13 18:17:25'),
(43, 68, 47, 1, '2019-05-13 18:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_bug`
--

CREATE TABLE `report_bug` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `subject` text,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_bug`
--

INSERT INTO `report_bug` (`id`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'test@gmail.com', 'Dont able to install app', 'Dont able to install app , Installed it but crashed at last', '2019-05-29 10:05:19'),
(2, 'test@gmail.com', 'Dont able to install app', 'Dont able to install app , Installed it but crashed at last', '2019-05-29 10:06:18'),
(3, 'aman@gmail.com', 'qwerty', 'qwerty', '2019-05-29 11:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `report_users`
--

CREATE TABLE `report_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_users`
--

INSERT INTO `report_users` (`id`, `user_id`, `other_user_id`, `message`, `updated_at`, `created_at`) VALUES
(6, 12, 1, 'Fake Profile', '2019-02-23 09:28:07', '2019-02-23 09:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `transation_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Delete',
  `subscribe_date` date NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `year_months` enum('M','Y') NOT NULL DEFAULT 'M' COMMENT 'M = month ,Y = year',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Delete',
  `amount` float NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `time`, `year_months`, `status`, `amount`, `updated_at`, `created_at`) VALUES
(1, 1, 'M', 1, 19.99, '2018-10-30 08:48:51', '2018-10-30 08:48:51'),
(2, 3, 'M', 1, 45.99, '2018-10-30 08:48:51', '2018-10-30 08:48:51'),
(3, 6, 'M', 1, 75.99, '2018-10-30 08:48:51', '2018-10-30 08:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `times`
--

INSERT INTO `times` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, 'mornings', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00'),
(2, 'afternoons', 1, '2018-04-19 12:18:00', '2018-04-19 12:18:00'),
(3, 'evenings', 1, '2018-08-09 12:18:00', '2018-08-09 12:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `social_id` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `gender` varchar(255) NOT NULL DEFAULT '',
  `dob` varchar(255) NOT NULL DEFAULT '',
  `profile_pic` varchar(255) NOT NULL DEFAULT '',
  `job_title` varchar(255) NOT NULL DEFAULT '',
  `bio` varchar(255) NOT NULL DEFAULT '',
  `project` varchar(255) NOT NULL DEFAULT '',
  `work_place` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `latitude` varchar(255) NOT NULL DEFAULT '',
  `longitude` varchar(255) NOT NULL DEFAULT '',
  `day` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(255) NOT NULL DEFAULT '',
  `register_type` enum('O','F','L') NOT NULL DEFAULT 'O' COMMENT 'O=Email,F=Facebook,L=LinkedIn',
  `device_id` varchar(255) NOT NULL DEFAULT '',
  `device_type` varchar(255) NOT NULL DEFAULT '',
  `notification_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= Active , 0 = ''DE-Active''',
  `version` float(5,1) DEFAULT NULL,
  `token` varchar(255) NOT NULL DEFAULT '',
  `updated_at` varchar(255) NOT NULL DEFAULT '',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL COMMENT '0 = Inactive \n 1 = Active \n 2 = disable \n 3 = deleted',
  `goal` varchar(255) DEFAULT NULL,
  `verifiy_email` tinyint(1) NOT NULL DEFAULT '1',
  `user_type` varchar(5) DEFAULT NULL COMMENT '//A=>Admin',
  `remember_token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `social_id`, `email`, `password`, `name`, `gender`, `dob`, `profile_pic`, `job_title`, `bio`, `project`, `work_place`, `address`, `latitude`, `longitude`, `day`, `time`, `register_type`, `device_id`, `device_type`, `notification_status`, `version`, `token`, `updated_at`, `created_at`, `status`, `goal`, `verifiy_email`, `user_type`, `remember_token`) VALUES
(1, '12345', 'admin@gmail.com', '$2y$10$8/fm7877fgKinUR8UyHvTOXeb74tLsWOxR53k9oncFHk9WXVOyGYy', 'Netset', 'M', '', '1540551067.jpeg', 'Testing', 'Hello', 'Mohali,chandighar', 'Mohali', '', '30.818180', '76.114160', 'wed', 'sdfasd', 'F', '', '', 1, 1.0, '', '2019-05-29 11:40:27', '2018-10-23 06:17:19', 1, NULL, 1, 'A', 'YFngG2nWUcElbfNRpoUwbdda8I4jVTwehyaclv417E0U99QUeixxkWHJy3nv'),
(2, '', 'vbn', '$2y$10$N2jNn6yK7orBVx1xFnRRSeKbj1Re9xZ2IjDDSa8D7o1jebKGGgSsu', 'Sample test', '', '', '', '', '', '', '', '', '', '', '', '', 'L', 'efdsfdfd', 'A', 1, 1.0, 'D9BY66TDMP0c7027', '2018-10-23 06:17:26', '2018-10-23 06:17:26', 1, NULL, 1, NULL, NULL),
(4, '', 'ravi@yopmail.com', '$2y$10$JCers5IjrZ7eEpTWCNPEmONRPIjCJCwWGPgs.2c6oFMWeKYsae0xK', '', '', '', '', '', '', '', '', '', '30.768180', '76.714160', '', '', 'O', 'sdaf', 'A', 1, 1.0, '9G8MRYZA544ae028', '2018-10-23 07:42:48', '2018-10-23 07:42:48', 1, NULL, 1, NULL, NULL),
(5, '', 'a@yopmail.com', '$2y$10$5YNqhWEmfMUH4F.mlilqcexkqcyc/1EURsiDYvoDWS7Jo/5Hr2ym2', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'dfdfgds', 'A', 1, 1.0, '83FD144SS80d2046', '2018-10-25 10:40:28', '2018-10-25 10:40:28', 1, NULL, 1, NULL, NULL),
(6, '', 'h@g.com', '$2y$10$lZfyBnEdPDtWlANcM.WRvu8FmUhrilLbIasYdNE.NCePLM0byRhZu', 'Sample', '', '', '', '', '', '', '', '', '30.768180', '76.714160', '', '', 'O', 'efdsfdfd', 'A', 1, 1.0, 'ZV0ZDOJ6HX1ba046', '2018-10-25 10:44:35', '2018-10-25 10:44:35', 1, NULL, 1, NULL, NULL),
(7, '', 'himesh@gmail.com', '$2y$10$T4bfM25zj/yC3mDpHC4tWuLoCWfKM/3Uda5TeMLR.9wG.MFC5kpaC', 'testing sample', '', '2018-11-11', '', '', '5jlhkh', '', '', '', '30.88', '70.88', '', '', 'O', 'asdsadsadsad', 'A', 1, 1.0, '', '2019-05-03 16:22:19', '2018-10-30 08:48:51', 2, NULL, 1, NULL, NULL),
(8, '', 'yahoo@gmail.com', '$2y$10$/KNmAJIYXb6C2O3f5vHyl.U31uT6OOKGQ9X1A4XwUnh7xkmSTpmYO', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'asdsadsadsad', 'A', 0, 1.0, 'NDD2IPU89S337089', '2018-10-30 10:45:40', '2018-10-30 09:30:21', 1, NULL, 1, NULL, NULL),
(9, '', 'aman@gmail.com', '$2y$10$N6tetU23ulhuRcBgKiu/JuY7rGvgqC5mohwbXTPG4GrX7tZPA.8dW', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, '1234567890', '2019-02-14 12:36:39', '2019-02-14 12:36:39', 1, NULL, 1, NULL, NULL),
(24, '', 'aman1@gmail.com', '$2y$10$xabpz2gzkk7iV2I2oEydGuTw23JlP6hO5sujOLme9Yo6IKKjxEh5C', 'Amandeep', 'M', '2019-3-22', '1552547296.jpg', 'React native developer', 'hiiiiiii.. working on functionality', 'workwith functionality', '1', '', '', '', '2', '1', 'O', '', '', 1, 1.0, '', '2019-03-19 16:19:42', '2019-03-14 12:36:18', 0, NULL, 1, NULL, NULL),
(28, '', 'johnson@gmail.com', '$2y$10$oP9W2yyFwPzPKY9bZ8eQ.O8dWrrhboF3kIzVeTVj/l8Xkb0U3Ie9K', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', '465465445', 'A', 1, 1.0, 'I7C6EWKFYAbd9262', '2019-03-15 10:50:07', '2019-03-15 10:50:07', 1, NULL, 1, NULL, NULL),
(29, '', 'sample@gmail.com', '$2y$10$odIf5cxCptJhszduEMKVyeILwKZsebtPdqK2q6mgKOCVOvcJJ1EEu', 'fsdfsdfsdfsdf', 'M', '2019-01-01', '1552633923.jpeg', 'Web dev', 'jhhg', 'Work', '', 'Mohali', '', '', '3', '1', 'O', '', '', 1, 1.0, '', '2019-03-22 16:03:05', '2019-03-15 11:04:48', 1, NULL, 1, NULL, NULL),
(30, '', 'aman2@gmail.com', '$2y$10$p72oFtfDz6lE1HK3gaTE9OxRm4N2NU.XU5P0UDzWlcbpmmwY0b/0u', 'Aman', 'F', '2019-3-22', '1552280481.png', 'Web developer', '', 'workwith', 'Netset', 'Mohali', '30.778180', '76.714160', '1', '1', 'O', '', '', 1, 1.0, '', '2019-03-28 13:06:06', '2019-02-25 09:06:38', 1, NULL, 1, NULL, NULL),
(31, '', 'avahah@h.com', '$2y$10$bkCFNPAi/VR0.aszkNDz/uTz.XaYpGN1O5D6SqZuu9SaEqOvidRSO', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, '97FO0MEJT6b30264', '2019-03-15 15:49:52', '2019-03-15 15:49:52', 1, NULL, 1, NULL, NULL),
(32, '', 'hani@gmail.com', '$2y$10$MfWigj6EWV7GrWdUsFGB9O48K5snLjO9xYC2LgAn4X6ulDvXqODKa', 'Hani', 'M', '2019-03-15', '', 'Web developer', '2019-10-10', 'Workwith', '2', 'Netset', '33.44', '77.22', '4', '2', 'O', '', '', 1, 1.0, '4356456464HJH23454', '2019-05-14 11:49:27', '2019-03-18 15:54:06', 1, 'dgfdsfgsdfgdgfgsd', 1, NULL, NULL),
(33, '', 'johnson1@gmail.com', '$2y$10$auSBURauHBwJjDT9kimdteby019ugRwfwarTds8mHCeddpW8baBJ.', 'test', 'F', '2019-3-22', '', 'fHa', 'ghiii', 'vaha', '1', '', '30.7046', '76.7179', '1', '1', 'O', '', '', 1, 1.0, '', '2019-04-01 15:59:38', '2019-03-18 16:16:01', 1, NULL, 1, NULL, NULL),
(34, '', 'johnson@gmail.com', '$2y$10$oP9W2yyFwPzPKY9bZ8eQ.O8dWrrhboF3kIzVeTVj/l8Xkb0U3Ie9K', 'Johnson', 'M', '2019-03-15', '', 'Web developer', '2019-10-10', 'Workwith', '2', 'Netset', '33.44', '77.22', '1', '2', 'O', '465465445', 'A', 1, 1.0, '5VMNCW31ME65c290', '2019-04-02 19:02:55', '2019-03-18 16:16:14', 1, 'dgfdsfgsdfgdgfgsd', 1, NULL, NULL),
(35, '', 'sunil@gmail.com', '$2y$10$UJVQNNDZuNsIQm0S2j9nNef7QJOa28tig3mUq6m4BRdYKoBmD6UqK', 'Johnson', 'M', '2019-03-15', '', 'Web developer', '2019-10-10', 'Workwith', '2', 'Netset', '33.44', '77.22', '1', '2', 'O', 'cz7Ax-6bdHQ:APA91bH2MiwgXdxqrRH-tX4sILFBVbGj7tr-p_Jb_cMWhrN4sdd_WIdzbrgRrDrCtQVnHfrWhzFY4gQbMj02baz0MLThvk6I1PNv2mnTjBWRRRXNdJ1B0OPPD4RTcJ3dtmk7CwZEoVbm', 'A', 1, 1.0, 'PE4X3ITJIY797781', '2019-05-10 12:04:54', '2019-03-19 10:48:21', 1, 'dgfdsfgsdfgdgfgsd', 1, NULL, NULL),
(36, '', 'sunil1@gmail.com', '$2y$10$EDjQXzrpMrqlkwqDDR.HL.0NFy4D/.ng5xBPV5DHtzoJQlwCdi5l.', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', '465465445', 'A', 1, 1.0, '92V2KMX5ES39f299', '2019-03-19 15:43:53', '2019-03-19 15:43:53', 1, NULL, 1, NULL, NULL),
(38, '', 'johnson2@gmail.com', '$2y$10$Ro.ac1IPrT06c8188UNfzel9VBopSDWFvpU.6LoYxvqF6KnzJ7Q6u', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', '125814', 'A', 1, 1.0, 'POBJJSPDZ9ec6308', '2019-03-20 17:39:16', '2019-03-20 17:39:16', 1, NULL, 1, NULL, NULL),
(39, '', 'johnson3@gmail.com', '$2y$10$/mU0b3p0JvRKMMjY91oyXuY9QPQJob4q5mWicR8sB6PGekHpkfHB6', 'Johnsonddddd', 'M', '2019-03-15', '1553085004.jpg', 'Web developer', '2019-10-10', 'Workwith', '2', 'Netset', '33.44', '77.22', '1', '2', 'O', 'dqkKVHFGbfo:APA91bFm1WHUvJrrVSvogO1T046KQySBa89PgImfcHz4Zm4FPPtNKIKZ6lZLFdE1jx5EHX-r6jPVVkklq7Y5KI3vvx1jGyOdz4qCdTiFsqRIUn5Mbsz-TqNJ-WX4oM_12ZVog98IdqaV', 'A', 1, 1.0, 'J5ASDGEKBY9f9411', '2019-03-22 15:59:36', '2019-03-20 17:41:58', 1, 'dgfdsfgsdfgdgfgsd', 1, NULL, NULL),
(40, '', 'test@gmail.com', '$2y$10$wUpXvJtT3Lf1o.qCbi5lJ.mmHn0ExZCdHCEei08nEvNn.CHmWvrpm', 'test user 1', 'M', '1997-3-22', '', 'testing', 'hiiii', 'matches test', '1', '', '30.7046', '76.7179', '1', '2', 'O', '', '', 1, 1.0, '', '2019-03-22 16:04:26', '2019-03-22 15:48:56', 1, 'testing', 1, NULL, NULL),
(41, '', 'testing@gmail.com', '$2y$10$sBbMrThRMpXFYpAy8Tzqg.fv7Wtp.zA2EMqVM5BZ4itR6.J6B.Ysm', 'test 2', 'F', '2005-3-22', '', 'test', 'hmmmm', 'matches', '1', '', '30.7046', '76.7179', '1', '1', 'O', '', '', 1, 1.0, '', '2019-03-22 16:16:53', '2019-03-22 16:04:53', 1, 'hiii', 1, NULL, NULL),
(42, '', 'preet@gmail.com', '$2y$10$yZ/Mr7BxwwYnMJx7Z28l..BX5pquQooyUAaTNqsrNa9mKUBhjDsmW', 'Preet', 'F', '1993-3-22', '', 'developer', 'hii', 'freeee', '1', '', '30.7046', '76.7179', '1', '1', 'O', '', '', 1, 1.0, '', '2019-03-22 16:20:14', '2019-03-22 16:17:18', 1, 'kya', 1, NULL, NULL),
(43, '', 'fvrvrv@gmail.com', '$2y$10$oREB4l5VuKutirewjD7oc..PFcORgip1UUpYArlaf92n2gYgABJca', 'beech', 'O', '2019-3-20', '', 'anthropologist', 'I like cheese', 'stuff', '', '', '30.7046', '76.7179', '', '', 'O', '', '', 1, 1.0, '', '2019-03-26 09:26:49', '2019-03-26 09:18:15', 1, 'undefined', 1, NULL, NULL),
(45, '', 'aman29@gmail.com', '$2y$10$EkNIT7q9NB.sGc9BheuMceCpeOps32qUDJ/.MjcSKIcocIrMhs4HW', 'amannn', 'F', '1992-4-29', '', 'developer', 'hiiii', 'dreams', '2', '', '30.7046', '76.7179', '1', '1', 'O', '', '', 1, 1.0, '', '2019-04-01 16:01:24', '2019-04-01 15:50:47', 1, 'hmmm', 1, NULL, NULL),
(46, '', 'test1@gmail.com', '$2y$10$.08kjzYparD3DTR.i.Q9s.TMMM55hPanHvKfvDqrun3jjpG84bGgS', 'vsvsv', 'M', '1989-4-25', '', 'csvsv', 'gshsh', 'gsgaha', '', '', '30.7046', '76.7179', '', '', 'O', '', '', 1, 1.0, '', '2019-04-02 19:09:15', '2019-04-02 18:37:58', 1, 'undefined', 1, NULL, NULL),
(47, '', 'try@gmail.com', '$2y$10$.tPfeEiuh/CFkE9FdEIKGOLPwduosHHBFfE/psC0ZzUq/bcqFPwdq', 'testimg', 'M', '1998-4-11', '', 'well', 'dfh', 'well', '', '', '30.7046', '76.7179', '', '', 'O', '', '', 1, 1.0, '', '2019-04-03 12:41:07', '2019-04-03 12:31:59', 1, 'cvb', 1, NULL, NULL),
(48, '', 'yes@gmail.com', '$2y$10$S1MZQAAW3kaXFdNrj/46ButYAthRTb/w9tfOE/3J4hA4ZxDezkHnS', 'undefined', 'undefined', 'undefined', '', 'undefined', 'undefined', 'undefined', '', '', '30.7046', '76.7179', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'WS3N37ZHG5958427', '2019-04-05 13:19:47', '2019-04-03 12:41:35', 1, 'etuii', 1, NULL, NULL),
(49, '', 'yo@gmail.com', '$2y$10$Ok1zpCUpxDOE8b4M7CdglOMwYso0saFOYJsHalJ2ujLqux4j0I9/y', 'yo', 'M', '1977-4-5', '', 'fsgs', 'fshshsh', 'fsgsgs', '', '', 'undefined', 'undefined', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'N3GCS9BCIF9ea447', '2019-04-05 19:20:58', '2019-04-05 19:19:48', 1, 'fsgs', 1, NULL, NULL),
(50, '', 'hello@hi.com', '$2y$10$UerclcfsBNr9NF2OD7Sb7uPbQjLk0Xrb8i0Px6c5iEMADychmDRLC', 'hi', 'F', '2019-4-10', '', 'ji', 'hi', 'ji', '', '', 'undefined', 'undefined', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'LZRR0C4TQ90b8495', '2019-04-11 08:46:04', '2019-04-11 08:28:14', 1, '', 1, NULL, NULL),
(51, '', 'boop@test.com', '$2y$10$RAPJQR8nxynamOMH1YpAO.6FroteuXnAbHcSBo0YTBcr97x3ihgse', 'erika', 'F', '2019-4-28', '', 'tech worker', 'hello.', 'stuff', '', '', 'undefined', 'undefined', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'GD3AIS9530e27648', '2019-04-29 02:12:21', '2019-04-29 02:08:37', 1, 'stuff', 1, NULL, NULL),
(52, '', 'vasu.netset@gmail.com', '$2y$10$sF4AVpIoGIphFuJFaZLncONdYGYKppVtJ56xTpqR7Sho6WS.ukdla', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'NCZUDSXA854ec688', '2019-05-03 16:56:12', '2019-05-03 16:56:12', 1, NULL, 1, NULL, NULL),
(53, '', 'tallent78@netsetsoftware.com', '$2y$10$3yRp.pdCG1BA98clS9h6E.iY8sadPcJp2UeS7Mj3ln7yfMZVmn8Ka', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'R2OSUS15B31d3688', '2019-05-03 16:58:45', '2019-05-03 16:58:45', 1, NULL, 1, NULL, NULL),
(54, '', 'tallent94@netsetsoftware.com', '$2y$10$JjHybu2ROgP3CYVZYoWceuPv959iFH6Syu1oMBtV0xNlIlwstnOGe', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'cvKhAxkbitk:APA91bE0sdYo0SHWB_Lk9guP7J1FEc-4QOSkrKe8PD53eeGp3WEVTjfGpXT-82sIdjqeMRAx8e1g84bMcMPY7QIsugelqLQoT1gLg0HWvkv8Je6Rl9wqCQwGsFUJQmf45-4RoG5HtZUx', 'A', 1, 1.0, 'WMQUCDONKE4cb688', '2019-05-03 17:00:23', '2019-05-03 17:00:23', 1, NULL, 1, NULL, NULL),
(55, '', 'tallent1@netsetsoftware.com', '$2y$10$yYIfZtu3F8zlQTE0hAh/SugDCGG9DN8SttE1IxvDn5Bf586jKqAEq', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'OMFIN6WG4Pb2b688', '2019-05-03 17:04:30', '2019-05-03 17:04:30', 1, NULL, 1, NULL, NULL),
(56, '', 'tallent67@netsetsoftware.com', '$2y$10$XBAlJI12MT1wDX2V2ntlgO4SRGp2lc/QR3lG4boQXxCIOMIC3d5EO', 'testing', 'M', '1994-5-6', '', 'sagga', 'gaahja', 'sgaha', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-06 10:44:08', '2019-05-03 17:13:14', 1, 'twyw', 1, NULL, NULL),
(57, '', 'test@test.com', '$2y$10$C1uUwCjDhyCLdatUCswprurmuuW.DncHog.IhwQcv.2PGugWJIuiK', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, '70A5BKHRH7d00707', '2019-05-05 23:32:05', '2019-05-05 23:32:05', 1, NULL, 0, NULL, NULL),
(58, '', 'hello@whatever.com', '$2y$10$gjoDVRCRZ88yJu0O65F76uxcUV2yjsQW5JDDRCHFrKhCnjhiY3Bkm', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'WAHG3KDKY17c4707', '2019-05-05 23:33:54', '2019-05-05 23:33:54', 1, NULL, 0, NULL, NULL),
(59, '', 'erikalegernes@gmail.com', '$2y$10$Q8rNlLLlMZmvn7uIUNm8Ietnb6ytL/qz3wJQmpyLnnloQWN1L5RKu', 'erika', 'F', '1990-10-12', '', 'researcher', 'I like stufff', 'cool stuff', '', '', 'null', 'null', '', '', 'O', 'daHw_bhlyBM:APA91bHmjTqeOsu5R0Zl2pDSk2BmghmVyNO4mOHcyXNDKGnesJb-O5g1u9jamLsaaEis-saEELpOGo0k6GXpYt18ST_U3u6F_H1Qid-pHTLbAhCf-cKtj9GIpRjalGHIud6uUFDDUQP6', 'A', 1, 1.0, 'OQH7T848QT4a5707', '2019-05-05 23:53:13', '2019-05-05 23:36:37', 1, 'I wanna be the very best', 1, NULL, NULL),
(60, '', 'amandeep@yopmail.com', '$2y$10$GB1TeC5JGe7xkxOZiGlATOvuAlIy3VXTr1rHc554oHEqeI8n3bHrS', 'Aman', 'Male', '1992-6-10', '75cd51c0f71653.jpg', 'Developer', 'Hiiiiiibabba', 'Qwrty', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-29 17:58:27', '2019-05-10 12:05:25', 1, 'Dsgah', 1, NULL, NULL),
(61, '', 'amanpreet@gmail.com', '$2y$10$1t/Cw1bTTmyhJb15/dipjuxGG7APFL41Ec7xmsLN1af30mB4Q0NbO', 'Amanpreet', 'F', '1996-5-10', '', 'Adaf', 'Qtqyqh', 'Svsbb', '', '', 'null', 'null', '', '', 'O', '', '', 1, 1.0, '', '2019-05-13 18:52:37', '2019-05-10 19:04:27', 1, 'Cavav', 1, NULL, NULL),
(62, '', 'ramandeep@gmail.com', '$2y$10$YOdqWQLw6crf.T9eesdwPOEjyAEpLbBDjBCtBFZgUsRWIugZskioC', 'Raman', 'M', '2000-5-10', '', 'Fagag', 'Gagha', 'Avavah', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-10 19:26:06', '2019-05-10 19:16:48', 1, 'Gagag', 1, NULL, NULL),
(63, '', 'hash@gmail.com', '$2y$10$CGwHa899CB3IML8VTsdpLuhf8qlxU5Lux7fJBaa8yp7R6C4koZU5K', 'Hash', 'M', '1992-5-10', '', 'FFS fAf', 'Gaha', 'Avavvq', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-10 19:45:31', '2019-05-10 19:26:26', 1, 'Fsgsh', 1, NULL, NULL),
(64, '', 'you@gmail.com', '$2y$10$tjX7ohV9FnK3e8pKkaVzge2cn6VVx0b3UQ1g3U2BdxoMvOZAvxZFa', 'Youuu', 'F', '2000-5-10', '', 'Cwvw', 'Fsbah', 'Wvwv', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-13 14:43:27', '2019-05-10 19:46:36', 1, 'Csvs', 1, NULL, NULL),
(65, '', 'hani@yopmail.com', '$2y$10$uCjPlufmwmwAaGAnfmOQUuQLK2opwXUPXLWlhNR.JUyfVN9CJXx.u', 'Hani', 'M', '1995-5-13', '', 'Qwert', 'Fgjjk', 'Qwrrt', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-13 18:51:47', '2019-05-13 15:00:12', 1, 'Fgg', 1, NULL, NULL),
(66, '', 'jack@yopmail.com', '$2y$10$6dfIi4E66gnRT/mDHC8g2e4UxIuVuNdKjYtUgUcpK8/OGrxRrulAy', 'Jack', 'M', '2019-5-13', '15cd94c720b463.jpg', 'Testing', 'Test data dummy user.', 'Test Data', '', '', 'undefined', 'undefined', '', '', 'O', 'czyzS2k7Nog:APA91bHqS1jjDHFwW6r5HXXpVxWnqc6YOqQQ5JwMmr_86KPNk0rI_BYB-0Ca4KHrUqOW3AWdvOn4TcyljsX-14kJzrusZ_jhh8NLkODiRrOXFZURXC7j8oNsErh4O_yGnS7wtjqusi1b', 'A', 1, 1.0, '3ZKNUZQVE0da8775', '2019-05-13 16:22:34', '2019-05-13 16:20:33', 1, 'Test Dara', 1, NULL, NULL),
(67, '', 'harry@yopmail.com', '$2y$10$/yBGbBGrf.EnoeGGvn6x3usuiqaSBAeRFm.Fniog140.r23aOm4Ba', 'Test', 'M', '2019-5-13', '95cd95a52adb15.jpg', 'Test Data', 'Test', 'Test Eata', '', '', 'undefined', 'undefined', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'VIND7WHQLPe4b774', '2019-05-13 17:21:46', '2019-05-13 17:14:14', 1, 'Test', 1, NULL, NULL),
(68, '', 'tester@gmail.com', '$2y$10$E.So5QXLsf8mEfpZ6jOHV.6oMHXZSXrF.pXQTKxL5ioKzNc2td1uO', 'Tester', 'Male', '1996-5-13', '', 'Developer', 'Testing bio data', 'Work with', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-14 12:36:46', '2019-05-13 18:53:19', 1, 'Fagah', 1, NULL, NULL),
(69, '', 'lehon.lachance@gmail.com', '$2y$10$954aP/D0AsLruoU4Bj3VoevJruw1OhXYpguqqEssElwXHEJSxz5KC', 'Poof', 'O', '2019-5-14', '', 'Worker', 'I\'m a babu', 'Working', '', '', 'null', 'null', '', '', 'O', '', '', 1, 1.0, '', '2019-05-27 01:40:06', '2019-05-15 03:41:35', 1, 'Working', 1, NULL, NULL),
(70, '', 'sidhu@gmail.com', '$2y$10$U4Hi1Zki0tyr41opz9FpdOcd4X4pDrfLrNH1Pv2c1M1sE7OiXCmSC', 'Sidhu', 'Male', '1994-5-29', '', 'Developer', 'Qwetyu', 'Qwerty', '', '', 'undefined', 'undefined', '', '', 'O', '', '', 1, 1.0, '', '2019-05-30 11:03:04', '2019-05-29 17:59:11', 1, 'Qwert', 1, NULL, NULL),
(71, '', 'poop@poop.com', '$2y$10$dmCJRnJ4ACoWnNlBraOBNuMBRMwqyv0oCbPZQtI8Dlfpns/qsEX4G', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'HQ764YF0OSd85918', '2019-05-30 09:46:22', '2019-05-30 09:46:22', 1, NULL, 1, NULL, NULL),
(72, '', 'tester@fake.com', '$2y$10$KMHEEZc4Vn./EGt5B5qftO8OcxF/D2QxvXqWHqTZlsE1fNj7i9G46', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'D6UE2VNX5Fd82918', '2019-05-30 09:47:51', '2019-05-30 09:47:51', 1, NULL, 1, NULL, NULL),
(73, '', 'rajanbir@netsetsoftware.com', '$2y$10$.uSeXPNWasGkoOUln63lmeSEP3UDPsqFMR5EJKz/3inJMOToTtQoW', 'Singh', 'Male', '1995-4-30', '', 'Qwerty', 'Etqyqh', 'Qwerrty', '', '', 'undefined', 'undefined', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'D4RTAR9JDS76c919', '2019-05-30 11:14:11', '2019-05-30 11:03:45', 1, 'Fagah', 1, NULL, NULL),
(74, '', 'cheese@cheese.com', '$2y$10$QWry3w.nxip6uGsRiEyCquPM3sRR9UozglbdHgoZmVyCCJvXN6TgK', '', '', '', '', '', '', '', '', '', '', '', '', '', 'O', 'fhukefjrgjnrk', 'A', 1, 1.0, 'TDB0N67P9M427004', '2019-06-09 08:20:23', '2019-06-09 08:20:23', 1, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_days`
--

CREATE TABLE `user_days` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 => inactive 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_days`
--

INSERT INTO `user_days` (`id`, `user_id`, `day_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 32, 4, '1', '2019-03-29 18:37:04', '2019-03-29 18:37:04'),
(8, 32, 2, '1', '2019-03-29 18:37:04', '2019-03-29 18:37:04'),
(9, 35, 2, '1', '2019-04-02 18:33:58', NULL),
(10, 35, 3, '1', '2019-04-02 18:33:58', NULL),
(11, 34, 2, '1', '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(12, 34, 3, '1', '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(13, 48, 6, '1', '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(14, 48, 7, '1', '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(15, 44, 2, '1', '2019-04-05 18:55:23', '2019-04-05 18:55:23'),
(16, 44, 3, '1', '2019-04-05 18:55:24', '2019-04-05 18:55:24'),
(17, 49, 5, '1', '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(18, 49, 6, '1', '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(19, 51, 0, '1', '2019-04-29 02:12:21', '2019-04-29 02:12:21'),
(20, 56, 0, '1', '2019-05-06 10:43:30', '2019-05-06 10:43:30'),
(21, 60, 0, '1', '2019-05-10 12:07:03', '2019-05-10 12:07:03'),
(22, 61, 0, '1', '2019-05-10 19:06:20', '2019-05-10 19:06:20'),
(23, 62, 0, '1', '2019-05-10 19:17:36', '2019-05-10 19:17:36'),
(24, 63, 0, '1', '2019-05-10 19:27:20', '2019-05-10 19:27:20'),
(25, 64, 0, '1', '2019-05-10 19:47:41', '2019-05-10 19:47:41'),
(26, 65, 0, '1', '2019-05-13 15:01:07', '2019-05-13 15:01:07'),
(27, 66, 0, '1', '2019-05-13 16:22:34', '2019-05-13 16:22:34'),
(28, 67, 0, '1', '2019-05-13 17:21:46', '2019-05-13 17:21:46'),
(29, 68, 0, '1', '2019-05-13 18:54:15', '2019-05-13 18:54:15'),
(30, 70, 0, '0', '2019-05-29 18:00:59', '2019-05-29 18:00:59'),
(31, 70, 5, '1', '2019-05-29 18:51:52', NULL),
(32, 70, 6, '1', '2019-05-29 18:51:52', NULL),
(33, 73, 5, '1', '2019-05-30 11:12:53', '2019-05-30 11:12:53'),
(34, 73, 6, '1', '2019-05-30 11:12:53', '2019-05-30 11:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE `user_interests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Deactive',
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`id`, `user_id`, `interest_id`, `status`, `updated_at`, `created_at`) VALUES
(16, 24, 1, 1, '2019-03-14 12:38:16', '2019-03-14 12:38:16'),
(17, 29, 2, 1, '2019-03-15 12:42:03', '2019-03-15 11:43:44'),
(20, 30, 1, 1, '2019-03-15 15:47:01', '2019-03-15 15:47:01'),
(21, 30, 2, 1, '2019-03-15 15:47:01', '2019-03-15 15:47:01'),
(22, 32, 1, 1, '2019-03-18 15:55:15', '2019-03-18 15:55:15'),
(23, 34, 1, 1, '2019-03-18 16:17:45', '2019-03-18 16:17:45'),
(24, 34, 2, 1, '2019-03-18 16:17:45', '2019-03-18 16:17:45'),
(25, 35, 1, 1, '2019-03-19 10:48:51', '2019-03-19 10:48:51'),
(26, 35, 2, 1, '2019-03-19 10:48:51', '2019-03-19 10:48:51'),
(27, 35, 3, 1, '2019-03-19 10:48:51', '2019-03-19 10:48:51'),
(28, 33, 2, 1, '2019-03-20 18:37:44', '2019-03-20 16:59:16'),
(29, 7, 1, 1, '2019-03-20 17:46:57', '2019-03-20 17:46:57'),
(30, 7, 2, 1, '2019-03-20 17:46:57', '2019-03-20 17:46:57'),
(31, 39, 1, 1, NULL, '2019-03-20 17:59:43'),
(32, 39, 2, 1, NULL, '2019-03-20 17:59:43'),
(33, 33, 1, 1, NULL, '2019-03-20 18:37:44'),
(34, 33, 3, 1, NULL, '2019-03-20 18:37:44'),
(35, 39, 3, 1, '2019-03-22 12:34:09', '2019-03-22 12:34:09'),
(36, 40, 1, 1, '2019-03-22 15:50:32', '2019-03-22 15:50:32'),
(37, 41, 1, 1, '2019-03-22 16:06:15', '2019-03-22 16:06:15'),
(38, 42, 1, 1, '2019-03-22 16:18:21', '2019-03-22 16:18:21'),
(39, 43, 1, 1, '2019-03-26 09:22:20', '2019-03-26 09:22:20'),
(40, 32, 2, 1, '2019-03-29 18:26:19', '2019-03-29 18:26:19'),
(41, 32, 3, 1, '2019-03-29 18:26:19', '2019-03-29 18:26:19'),
(42, 45, 1, 1, '2019-04-01 15:51:56', '2019-04-01 15:51:56'),
(43, 34, 3, 1, '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(44, 46, 0, 1, '2019-04-02 19:08:50', '2019-04-02 19:08:50'),
(45, 47, 0, 1, '2019-04-03 12:33:00', '2019-04-03 12:33:00'),
(46, 48, 2, 1, '2019-04-05 13:07:29', '2019-04-05 13:07:29'),
(47, 48, 3, 0, '2019-04-05 13:07:29', '2019-04-05 13:07:29'),
(48, 48, 1, 1, '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(49, 44, 1, 1, '2019-04-05 18:55:23', '2019-04-05 18:55:23'),
(50, 44, 2, 1, '2019-04-05 18:55:23', '2019-04-05 18:55:23'),
(51, 44, 3, 1, '2019-04-05 18:55:23', '2019-04-05 18:55:23'),
(52, 49, 3, 1, '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(53, 49, 4, 1, '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(54, 50, 2, 1, '2019-04-11 08:46:05', '2019-04-11 08:46:05'),
(55, 50, 3, 1, '2019-04-11 08:46:05', '2019-04-11 08:46:05'),
(56, 51, 0, 1, '2019-04-29 02:12:21', '2019-04-29 02:12:21'),
(57, 59, 0, 1, '2019-05-05 23:50:43', '2019-05-05 23:50:43'),
(58, 56, 0, 1, '2019-05-06 10:43:29', '2019-05-06 10:43:29'),
(59, 60, 0, 0, '2019-05-29 17:33:09', '2019-05-10 12:07:03'),
(60, 61, 0, 1, '2019-05-10 19:06:20', '2019-05-10 19:06:20'),
(61, 62, 0, 1, '2019-05-10 19:17:36', '2019-05-10 19:17:36'),
(62, 63, 0, 1, '2019-05-10 19:27:20', '2019-05-10 19:27:20'),
(63, 64, 0, 1, '2019-05-10 19:47:40', '2019-05-10 19:47:40'),
(64, 65, 0, 1, '2019-05-13 15:01:07', '2019-05-13 15:01:07'),
(65, 66, 0, 1, '2019-05-13 16:22:34', '2019-05-13 16:22:34'),
(66, 67, 0, 1, '2019-05-13 17:21:46', '2019-05-13 17:21:46'),
(67, 68, 0, 1, '2019-05-13 18:54:15', '2019-05-13 18:54:15'),
(68, 69, 0, 1, '2019-05-15 03:43:09', '2019-05-15 03:43:09'),
(69, 70, 0, 0, '2019-05-29 18:08:28', '2019-05-29 18:00:58'),
(70, 70, 1, 0, '2019-05-29 19:00:13', '2019-05-29 18:08:28'),
(71, 70, 2, 1, '2019-05-29 19:00:13', '2019-05-29 18:08:28'),
(72, 70, 3, 0, '2019-05-29 18:51:52', '2019-05-29 18:08:28'),
(73, 73, 2, 1, '2019-05-30 11:12:53', '2019-05-30 11:12:53'),
(74, 73, 3, 1, '2019-05-30 11:12:53', '2019-05-30 11:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_prefer_distance`
--

CREATE TABLE `user_prefer_distance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `distance` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = active 0 = deactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_prefer_distance`
--

INSERT INTO `user_prefer_distance` (`id`, `user_id`, `distance`, `status`, `created_at`, `updated_at`) VALUES
(64, 29, '12', 1, '2019-03-15 12:52:30', NULL),
(65, 30, '35', 1, '2019-03-15 10:17:01', NULL),
(66, 32, '35', 1, '2019-03-18 10:25:15', NULL),
(67, 34, '35', 1, '2019-03-18 10:47:45', NULL),
(68, 35, '35', 1, '2019-03-19 05:18:51', NULL),
(69, 33, '50', 1, '2019-03-20 13:06:15', NULL),
(70, 7, '35', 1, '2019-03-20 12:16:57', NULL),
(71, 39, '23', 1, '2019-03-20 12:29:43', NULL),
(72, 40, '35', 1, '2019-03-22 10:20:32', NULL),
(73, 41, '35', 1, '2019-03-22 10:36:15', NULL),
(74, 42, '35', 1, '2019-03-22 10:48:21', NULL),
(75, 43, '35', 1, '2019-03-26 03:52:20', NULL),
(76, 45, '35', 1, '2019-04-01 10:21:55', NULL),
(77, 46, '35', 1, '2019-04-02 13:38:50', NULL),
(78, 47, '35', 1, '2019-04-03 07:02:59', NULL),
(79, 48, '35', 1, '2019-04-05 07:37:29', NULL),
(80, 44, '35', 1, '2019-04-05 13:25:23', NULL),
(81, 49, '35', 1, '2019-04-05 13:50:58', NULL),
(82, 50, '35', 1, '2019-04-11 03:16:05', NULL),
(83, 51, '35', 1, '2019-04-28 20:42:21', NULL),
(84, 59, '35', 1, '2019-05-05 18:20:42', NULL),
(85, 56, '35', 1, '2019-05-06 05:13:29', NULL),
(86, 60, '35', 1, '2019-05-10 06:37:03', NULL),
(87, 61, '35', 1, '2019-05-10 13:36:20', NULL),
(88, 62, '35', 1, '2019-05-10 13:47:36', NULL),
(89, 63, '35', 1, '2019-05-10 13:57:19', NULL),
(90, 64, '35', 1, '2019-05-10 14:17:40', NULL),
(91, 65, '35', 1, '2019-05-13 09:31:07', NULL),
(92, 66, '35', 1, '2019-05-13 10:52:34', NULL),
(93, 67, '35', 1, '2019-05-13 11:51:46', NULL),
(94, 68, '35', 1, '2019-05-13 13:24:14', NULL),
(95, 69, '35', 1, '2019-05-14 22:13:09', NULL),
(96, 70, '35', 1, '2019-05-29 12:30:58', NULL),
(97, 73, '35', 1, '2019-05-30 05:42:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_suggestion`
--

CREATE TABLE `user_suggestion` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `suggestions_ids` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion_count` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `todays` timestamp NULL DEFAULT NULL,
  `next_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_suggestion`
--

INSERT INTO `user_suggestion` (`id`, `user_id`, `suggestions_ids`, `suggestion_count`, `status`, `todays`, `next_date`) VALUES
(34, 32, '30,34,24,35,29,33,39,43,45,44', 10, 1, '2019-03-19 15:46:17', '2019-03-20 15:46:17'),
(35, 24, '29', 1, 1, '2019-03-19 16:18:09', '2019-03-20 16:18:09'),
(36, 33, '30,34,29,35,39,43', 6, 1, '2019-03-20 16:59:18', '2019-03-21 16:59:18'),
(37, 28, '29,39', 2, 1, '2019-03-20 17:44:31', '2019-03-21 17:44:31'),
(38, 30, '34,24,29,35,39,32,33,43', 8, 1, '2019-03-22 10:57:04', '2019-03-23 10:57:04'),
(39, 29, '39,34', 2, 1, '2019-03-22 11:47:56', '2019-03-23 11:47:56'),
(40, 35, '29,39,34,43,45,33,30,48,46,47', 10, 1, '2019-03-22 13:05:27', '2019-03-23 13:05:27'),
(41, 34, '39,33,24,29,35,30', 6, 1, '2019-03-22 13:07:03', '2019-03-23 13:07:03'),
(42, 39, '32,30,34,33,24,35,43,45', 8, 1, '2019-03-22 13:12:27', '2019-03-23 13:12:27'),
(43, 40, '33,30,34,32,29,39,35', 7, 1, '2019-03-22 15:50:38', '2019-03-23 15:50:38'),
(44, 41, '40,33,30,34,32,29,39,35', 8, 1, '2019-03-22 16:06:22', '2019-03-23 16:06:22'),
(45, 42, '40,41,33,30,34,32,29,39,35', 9, 1, '2019-03-22 16:18:30', '2019-03-23 16:18:30'),
(46, 43, '29,39,41,42,30,32,34,35,40', 9, 1, '2019-03-26 09:22:28', '2019-03-27 09:22:28'),
(47, 45, '33,40,41,42,43,30,34,29,39,32', 10, 1, '2019-04-01 15:52:02', '2019-04-02 15:52:02'),
(48, 45, '35', 1, 1, '2019-04-02 15:52:02', '2019-04-03 15:52:02'),
(49, 46, '29,39,40,41,42,43,30,45,32,34', 10, 1, '2019-04-02 19:08:51', '2019-04-03 19:08:51'),
(50, 46, '35', 1, 1, '2019-04-03 19:08:51', '2019-04-04 19:08:51'),
(51, 47, '46,29,39,41,42,43,30,45,32,34', 10, 1, '2019-04-03 12:40:15', '2019-04-04 12:40:15'),
(52, 47, '35,40', 2, 1, '2019-04-04 12:40:15', '2019-04-05 12:40:15'),
(53, 48, '33,40,41,42,43,45,30,29,39,32', 10, 1, '2019-04-05 14:43:38', '2019-04-06 14:43:38'),
(54, 48, '34,35,46,47', 4, 1, '2019-04-06 14:43:38', '2019-04-07 14:43:38'),
(55, 32, '48', 1, 1, '2019-03-20 15:46:17', '2019-03-21 15:46:17'),
(56, 49, '33,48,29,39,32,45,34,46,35,47', 10, 1, '2019-04-05 19:21:21', '2019-04-06 19:21:21'),
(57, 49, '44,40,42,43,30', 5, 1, '2019-04-06 19:21:21', '2019-04-07 19:21:21'),
(58, 50, '29,39,40,44,41,49,42,30,43,32', 10, 1, '2019-04-11 08:46:13', '2019-04-12 08:46:13'),
(59, 50, '45,34,47,48', 4, 1, '2019-04-12 08:46:13', '2019-04-13 08:46:13'),
(60, 35, '44,49,50,51,59,56,66', 7, 1, '2019-03-23 13:05:27', '2019-03-24 13:05:27'),
(61, 51, '29,39,34,45,35,46,47,48,44,40', 10, 1, '2019-04-29 02:12:29', '2019-04-30 02:12:29'),
(62, 51, '49,41,30,50,42,32,43', 7, 1, '2019-04-30 02:12:29', '2019-05-01 02:12:29'),
(63, 59, '29,39,40,49,41,50,42,30,51,43', 10, 1, '2019-05-05 23:50:50', '2019-05-06 23:50:50'),
(64, 59, '32,45,34,35,46,47,48', 7, 1, '2019-05-06 23:50:50', '2019-05-07 23:50:50'),
(65, 60, '46,47,29,39,42,30,56,43,32,45', 10, 1, '2019-05-10 12:08:13', '2019-05-11 12:08:13'),
(66, 60, '34,48,49,50,51,40,59,41,35,33', 10, 1, '2019-05-11 12:08:13', '2019-05-12 12:08:13'),
(67, 61, '46,47,29,39,49,50,40,51,41,59', 10, 1, '2019-05-10 19:06:30', '2019-05-11 19:06:30'),
(68, 61, '42,30,56,48,35,60,32,34,43,45', 10, 1, '2019-05-11 19:06:30', '2019-05-12 19:06:30'),
(69, 61, '33,65,67', 3, 1, '2019-05-12 19:06:30', '2019-05-13 19:06:30'),
(70, 62, '46,47,29,39,49,50,51,40,59,41', 10, 1, '2019-05-10 19:17:53', '2019-05-11 19:17:53'),
(71, 62, '30,56,42,32,60,34,61,35,43,45', 10, 1, '2019-05-11 19:17:53', '2019-05-12 19:17:53'),
(72, 62, '48,33', 2, 1, '2019-05-12 19:17:53', '2019-05-13 19:17:53'),
(73, 63, '46,47,29,39,42,30,56,43,32,60', 10, 1, '2019-05-10 19:27:58', '2019-05-11 19:27:58'),
(74, 63, '45,34,61,35,62,59,40,41,48,49', 10, 1, '2019-05-11 19:27:58', '2019-05-12 19:27:58'),
(75, 63, '50,51,33', 3, 1, '2019-05-12 19:27:58', '2019-05-13 19:27:58'),
(76, 64, '46,47,29,39,50,51,40,59,41,30', 10, 1, '2019-05-10 19:47:47', '2019-05-11 19:47:47'),
(77, 64, '56,42,32,63,49,48,35,62,43,60', 10, 1, '2019-05-11 19:47:47', '2019-05-12 19:47:47'),
(78, 64, '45,34,61,33', 4, 1, '2019-05-12 19:47:47', '2019-05-13 19:47:47'),
(79, 65, '46,47,29,39,34,61,45,35,62,48', 10, 1, '2019-05-13 15:01:18', '2019-05-14 15:01:18'),
(80, 65, '49,63,51,40,59,41,30,56,42,32', 10, 1, '2019-05-14 15:01:18', '2019-05-15 15:01:18'),
(81, 65, '50,64,60,43,66,33,67', 7, 1, '2019-05-15 15:01:18', '2019-05-16 15:01:18'),
(82, 66, '46,47,29,39,34,61,45,35,62,48', 10, 1, '2019-05-13 16:22:40', '2019-05-14 16:22:40'),
(83, 66, '49,63,40,59,41,56,42,60,43,30', 10, 1, '2019-05-14 16:22:40', '2019-05-15 16:22:40'),
(84, 66, '64,51,32,67,50', 5, 1, '2019-05-15 16:22:40', '2019-05-16 16:22:40'),
(85, 60, '65,66,67,68,69', 5, 1, '2019-05-12 12:08:13', '2019-05-13 12:08:13'),
(86, 67, '46,47,29,39,48,35,62,49,63,50', 10, 1, '2019-05-13 17:21:51', '2019-05-14 17:21:51'),
(87, 67, '64,51', 2, 1, '2019-05-14 17:21:51', '2019-05-15 17:21:51'),
(88, 68, '46,47,29,39,35,62,48,63,49,64', 10, 1, '2019-05-13 18:54:23', '2019-05-14 18:54:23'),
(89, 68, '50,40,51,65,59,41,66,30,56,42', 10, 1, '2019-05-14 18:54:23', '2019-05-15 18:54:23'),
(90, 68, '67,32,60,43,34,61,45', 7, 1, '2019-05-15 18:54:23', '2019-05-16 18:54:23'),
(91, 69, '29,39,46,35,60,47,61,48,62,49', 10, 1, '2019-05-15 03:43:19', '2019-05-16 03:43:19'),
(92, 69, '40,63,45,68,67,34,56,50,41,64', 10, 1, '2019-05-16 03:43:19', '2019-05-17 03:43:19'),
(93, 69, '65,30,51,42,66,32,43,59', 8, 1, '2019-05-17 03:43:19', '2019-05-18 03:43:19'),
(94, 70, '46,47,29,39,62,48,35,63,49,64', 10, 1, '2019-05-29 18:01:06', '2019-05-30 18:01:06'),
(95, 70, '50,40,42,65,30,51,43,66,32,59', 10, 1, '2019-05-30 18:01:06', '2019-05-31 18:01:06'),
(96, 70, '45,67,41,33,61,68,60,34', 8, 1, '2019-05-31 18:01:06', '2019-06-01 18:01:06'),
(97, 73, '33,48,30,29,39,70,35,62,47,49', 10, 1, '2019-05-30 11:13:16', '2019-05-31 11:13:16'),
(98, 73, '63,50,64,40,41,65,60,45,68,32', 10, 1, '2019-05-31 11:13:16', '2019-06-01 11:13:16'),
(99, 73, '34,61,46', 3, 1, '2019-06-01 11:13:16', '2019-06-02 11:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_times`
--

CREATE TABLE `user_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 => inactive 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_times`
--

INSERT INTO `user_times` (`id`, `user_id`, `time_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 35, 9, '1', '2019-04-02 18:33:59', NULL),
(2, 35, 1, '1', '2019-04-02 18:33:59', NULL),
(3, 34, 9, '1', '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(4, 34, 1, '1', '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(5, 48, 3, '1', '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(6, 44, 9, '1', '2019-04-05 18:55:24', '2019-04-05 18:55:24'),
(7, 44, 1, '1', '2019-04-05 18:55:24', '2019-04-05 18:55:24'),
(8, 50, 2, '1', '2019-04-11 08:46:05', '2019-04-11 08:46:05'),
(9, 51, 0, '1', '2019-04-29 02:12:21', '2019-04-29 02:12:21'),
(10, 56, 0, '1', '2019-05-06 10:43:30', '2019-05-06 10:43:30'),
(11, 60, 0, '1', '2019-05-10 12:07:03', '2019-05-10 12:07:03'),
(12, 62, 0, '1', '2019-05-10 19:17:36', '2019-05-10 19:17:36'),
(13, 63, 0, '1', '2019-05-10 19:27:20', '2019-05-10 19:27:20'),
(14, 65, 0, '1', '2019-05-13 15:01:08', '2019-05-13 15:01:08'),
(15, 66, 0, '1', '2019-05-13 16:22:34', '2019-05-13 16:22:34'),
(16, 67, 0, '1', '2019-05-13 17:21:46', '2019-05-13 17:21:46'),
(17, 68, 0, '1', '2019-05-13 18:54:16', '2019-05-13 18:54:16'),
(18, 70, 0, '0', '2019-05-29 18:00:59', '2019-05-29 18:00:59'),
(19, 70, 3, '1', '2019-05-29 18:51:52', '2019-05-29 19:00:13'),
(20, 73, 3, '1', '2019-05-30 11:12:53', '2019-05-30 11:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_workplace`
--

CREATE TABLE `user_workplace` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `workplace_id` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 => inactive 1 => active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_workplace`
--

INSERT INTO `user_workplace` (`id`, `user_id`, `workplace_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 35, 2, '1', '2019-04-02 18:33:59', NULL),
(2, 34, 2, '1', '2019-04-02 18:54:48', '2019-04-02 18:54:48'),
(3, 48, 2, '1', '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(4, 48, 3, '1', '2019-04-05 13:19:47', '2019-04-05 13:19:47'),
(5, 44, 2, '1', '2019-04-05 18:55:24', '2019-04-05 18:55:24'),
(6, 49, 3, '1', '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(7, 49, 2, '1', '2019-04-05 19:20:58', '2019-04-05 19:20:58'),
(8, 50, 1, '1', '2019-04-11 08:46:05', '2019-04-11 08:46:05'),
(9, 51, 0, '1', '2019-04-29 02:12:21', '2019-04-29 02:12:21'),
(10, 56, 0, '1', '2019-05-06 10:43:30', '2019-05-06 10:43:30'),
(11, 61, 0, '1', '2019-05-10 19:06:20', '2019-05-10 19:06:20'),
(12, 62, 0, '1', '2019-05-10 19:17:36', '2019-05-10 19:17:36'),
(13, 63, 0, '1', '2019-05-10 19:27:20', '2019-05-10 19:27:20'),
(14, 64, 0, '1', '2019-05-10 19:47:41', '2019-05-10 19:47:41'),
(15, 65, 0, '1', '2019-05-13 15:01:08', '2019-05-13 15:01:08'),
(16, 66, 0, '1', '2019-05-13 16:22:34', '2019-05-13 16:22:34'),
(17, 67, 0, '1', '2019-05-13 17:21:47', '2019-05-13 17:21:47'),
(18, 68, 0, '1', '2019-05-13 18:54:16', '2019-05-13 18:54:16'),
(19, 70, 0, '0', '2019-05-29 18:00:59', '2019-05-29 18:00:59'),
(20, 70, 1, '0', '2019-05-29 18:51:52', NULL),
(21, 70, 2, '0', '2019-05-29 18:51:52', NULL),
(22, 70, 3, '1', '2019-05-29 19:00:13', NULL),
(23, 73, 2, '1', '2019-05-30 11:12:53', '2019-05-30 11:12:53'),
(24, 73, 3, '1', '2019-05-30 11:12:53', '2019-05-30 11:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `workplace`
--

CREATE TABLE `workplace` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '//0=>inActive,1 => active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workplace`
--

INSERT INTO `workplace` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 1, '2019-02-20 10:55:02', '2019-02-20 10:55:02'),
(2, 'College', 1, '2019-02-20 10:55:02', '2019-02-20 10:55:02'),
(3, 'Public space', 1, '2019-03-28 07:35:42', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delete_account`
--
ALTER TABLE `delete_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passUsers`
--
ALTER TABLE `passUsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `report_bug`
--
ALTER TABLE `report_bug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_users`
--
ALTER TABLE `report_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_days`
--
ALTER TABLE `user_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_prefer_distance`
--
ALTER TABLE `user_prefer_distance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_suggestion`
--
ALTER TABLE `user_suggestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_times`
--
ALTER TABLE `user_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_workplace`
--
ALTER TABLE `user_workplace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workplace`
--
ALTER TABLE `workplace`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delete_account`
--
ALTER TABLE `delete_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `passUsers`
--
ALTER TABLE `passUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `report_bug`
--
ALTER TABLE `report_bug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report_users`
--
ALTER TABLE `report_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_days`
--
ALTER TABLE `user_days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_interests`
--
ALTER TABLE `user_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_prefer_distance`
--
ALTER TABLE `user_prefer_distance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_suggestion`
--
ALTER TABLE `user_suggestion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user_times`
--
ALTER TABLE `user_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_workplace`
--
ALTER TABLE `user_workplace`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `workplace`
--
ALTER TABLE `workplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
