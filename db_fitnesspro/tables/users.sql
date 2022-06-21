-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2022 at 04:01 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `initial_weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `kcal_objective` int(11) NOT NULL DEFAULT 600,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(11) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user`, `gender`, `initial_weight`, `height`, `kcal_objective`, `date`, `user_type`) VALUES
(1, 'Administrator', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'm', 1, 1, 1, '2022-06-01 00:00:00', 'admin'),
(2, 'Tiago Valente', 'tiagomilheiro13@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'tiagovalente', 'm', 69, 182, 600, '2022-05-18 11:58:00', 'user'),
(3, 'Daniel Lopes', 'daniel.ramos.lopes@hotmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'danlopes', 'm', 75, 179, 600, '2022-05-18 11:58:00', 'user'),
(7, 'Osmainy Raimundo', 'osmainy@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'osmainy.raimundo', 'f', 50, 174, 600, '2022-05-18 11:58:00', 'user'),
(8, 'Filipa Marques', 'flipinhamarques@hotmail.com', '2fe04e524ba40505a82e03a2819429cc', 'filipamarques', 'f', 11, 11, 600, '2022-05-18 11:58:00', 'user'),
(25, 'Núria Fernandes', 'nuria@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'nuriafernandes', 'f', 67, 89, 600, '2022-05-18 11:58:00', 'user'),
(26, 'João Marco', 'joaomarco@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'joaomarco', 'm', 56, 125, 600, '2022-05-18 12:06:50', 'user'),
(31, 'Paulo Antunes', 'paulito@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'paulito', 'm', 27, 146, 600, '2022-05-24 01:08:46', 'user'),
(107, 'Rafael Lopes', 'rafaellopes@gmail.com', 'e5dc74ac9a1deac059d93981178144c3', 'rafaellopes', 'm', 89, 194, 600, '2022-06-16 04:02:38', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `initial_weight` (`initial_weight`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
