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
-- Table structure for table `friends_post`
--

CREATE TABLE `friends_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends_post`
--

INSERT INTO `friends_post` (`post_id`, `user_id`, `content`, `created`, `created_by`, `like_count`) VALUES
(1, 2, 'Boa tarde, treininho bom acabado de sair do forno!', '2022-05-31 00:10:21', 3, 7),
(2, 2, 'Mais um treino? Estás rijo!', '2022-05-31 00:23:14', 2, 4),
(5, 3, 'És grande irmão.', '2022-05-31 00:28:07', 2, 1),
(10, 7, 'Sua preguiçosa!\r\n', '2022-05-31 11:07:19', 2, 7),
(13, 25, 'Oi Núria! Tas boa?\r\n', '2022-06-01 16:11:01', 3, 0),
(15, 26, 'Hey! Soube que partiste uma perna, estás bem?', '2022-06-03 21:16:03', 2, 2),
(17, 8, 'Como estás Filipinha? Não te vejo há anos...', '2022-06-04 10:47:37', 31, 10),
(21, 7, 'Oioi Osmainy, faz tempo que não te vejo lá na quinta! Beijocas ;D', '2022-06-04 15:36:52', 31, 3),
(23, 25, 'Olá!! Como vai isso?', '2022-06-04 16:34:38', 7, 0),
(24, 7, 'Salut Paulito :D Tenho estado na Alemanha a trabalhar!', '2022-06-04 16:35:54', 7, 4),
(31, 7, 'Boa tarde, tudo bem?', '2022-06-16 17:44:01', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends_post`
--
ALTER TABLE `friends_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends_post`
--
ALTER TABLE `friends_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends_post`
--
ALTER TABLE `friends_post`
  ADD CONSTRAINT `friends_post_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
