-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2022 at 04:00 AM
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
-- Database: `fitnesspro`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends_follow`
--

CREATE TABLE `friends_follow` (
  `follow_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends_follow`
--

INSERT INTO `friends_follow` (`follow_id`, `follower_id`, `followed_user_id`) VALUES
(3, 3, 2),
(43, 31, 2),
(44, 31, 3),
(45, 31, 7),
(46, 31, 8),
(47, 31, 15),
(48, 31, 25),
(49, 31, 26),
(50, 3, 25),
(52, 3, 7),
(53, 7, 2),
(54, 7, 25),
(56, 32, 2),
(57, 32, 7),
(59, 8, 2),
(60, 8, 3),
(61, 8, 7),
(62, 8, 15),
(63, 8, 25),
(64, 8, 26),
(65, 8, 31),
(66, 31, 2),
(67, 2, 3),
(68, 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends_follow`
--
ALTER TABLE `friends_follow`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `followed_user_id` (`followed_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends_follow`
--
ALTER TABLE `friends_follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
