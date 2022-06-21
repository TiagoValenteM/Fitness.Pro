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
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `people` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_done` date NOT NULL,
  `total_time` time NOT NULL,
  `total_kcal` int(5) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `exercise_id`, `status`, `place`, `people`, `date_added`, `date_done`, `total_time`, `total_kcal`, `user_id`) VALUES
(9, 3, 'Done', 'Outdoor', 'Duo', '2022-05-22 23:28:57', '2022-05-22', '01:30:00', 675, 3),
(14, 10, 'Done', 'Gym', 'Group', '2022-05-23 14:34:15', '2022-05-23', '02:34:00', 257, 7),
(26, 7, 'Ongoing', 'Gym', 'Duo', '2022-05-24 00:49:28', '2022-05-11', '05:49:00', 582, 3),
(27, 11, 'Ongoing', 'Home', 'Duo', '2022-05-24 00:49:42', '2022-05-05', '04:53:00', 488, 3),
(28, 16, 'Ongoing', 'Gym', 'Solo', '2022-05-24 00:58:12', '2022-05-07', '00:59:00', 325, 3),
(30, 3, 'Done', 'Outdoor', 'Duo', '2022-05-24 02:36:00', '2022-05-22', '01:18:00', 585, 2),
(31, 11, 'Done', 'Home', 'Solo', '2022-05-24 02:37:31', '2022-03-25', '00:31:00', 124, 2),
(33, 1, 'Done', 'Outdoor', 'Solo', '2022-05-24 02:41:08', '2022-03-06', '01:01:00', 102, 2),
(35, 2, 'Done', 'Gym', 'Duo', '2022-05-24 02:43:22', '2022-02-25', '00:45:00', 275, 2),
(36, 12, 'Ongoing', 'Home', 'Solo', '2022-05-24 02:44:08', '2021-12-14', '00:11:00', 70, 2),
(40, 16, 'Ongoing', 'Home', 'Solo', '2022-05-26 11:06:47', '2022-05-25', '01:30:00', 150, 7),
(42, 3, 'Done', 'Outdoor', 'Duo', '2022-05-30 16:08:45', '2022-05-28', '01:28:00', 660, 2),
(43, 1, 'Done', 'Outdoor', 'Solo', '2022-05-30 16:10:01', '2021-10-12', '01:46:00', 177, 2),
(44, 10, 'Done', 'Gym', 'Solo', '2022-05-30 16:11:07', '2021-05-26', '00:10:00', 453, 2),
(45, 11, 'Done', 'Home', 'Solo', '2022-05-30 16:11:50', '2021-05-07', '00:32:00', 342, 2),
(46, 2, 'Done', 'Outdoor', 'Solo', '2022-05-30 16:12:26', '2017-08-06', '00:45:00', 78, 2),
(47, 13, 'Done', 'Home', 'Solo', '2022-05-30 16:12:54', '2022-05-25', '00:11:00', 1218, 2),
(53, 1, 'Done', 'Outdoor', 'Group', '2022-06-12 19:04:47', '2022-06-06', '01:42:00', 170, 2),
(54, 3, 'Done', 'Outdoor', 'Duo', '2022-06-12 20:55:05', '2022-06-09', '00:09:00', 453, 2),
(55, 1, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:29:12', '2022-06-12', '02:29:00', 248, 31),
(56, 2, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:29:26', '2022-06-12', '02:29:00', 248, 31),
(57, 3, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:29:36', '2022-06-06', '02:34:00', 456, 31),
(58, 4, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:29:46', '2022-06-13', '06:29:00', 648, 31),
(59, 5, 'Ongoing', 'Home', 'Duo', '2022-06-13 02:29:57', '2022-06-01', '02:34:00', 257, 31),
(60, 7, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:30:16', '2022-06-07', '02:30:00', 250, 31),
(61, 8, 'Done', 'Gym', 'Group', '2022-06-13 02:30:41', '2022-06-09', '02:35:00', 258, 31),
(63, 10, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:31:07', '2022-06-29', '02:34:00', 257, 31),
(64, 5, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:31:17', '2022-06-15', '02:35:00', 258, 31),
(65, 4, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:31:28', '2022-06-16', '02:36:00', 260, 31),
(66, 10, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:31:40', '2022-06-29', '05:31:00', 552, 31),
(67, 10, 'Ongoing', 'Home', 'Solo', '2022-06-13 02:31:42', '2022-06-29', '05:31:00', 552, 31),
(69, 15, 'Done', 'Home', 'Solo', '2022-06-14 10:30:07', '2022-06-16', '02:40:00', 267, 7),
(79, 1, 'Done', 'Outdoor', 'Duo', '2022-06-15 02:02:37', '2022-06-11', '00:17:00', 71, 2),
(80, 7, 'Done', 'Home', 'Solo', '2022-06-17 14:07:50', '2022-06-10', '00:11:00', 106, 2),
(81, 1, 'Ongoing', 'Outdoor', 'Duo', '2022-06-17 18:43:04', '2022-06-17', '00:30:00', 125, 2),
(82, 6, 'Done', 'Gym', 'Duo', '2022-06-17 19:14:02', '2022-06-17', '00:30:00', 215, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`user_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises_default` (`exercise_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
