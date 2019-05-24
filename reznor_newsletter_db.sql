-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host:
-- Generation Time: May 24, 2019 at 03:30 PM
-- Server version: 5.6.43-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reznortejhadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `reznor_newsletter_admins`
--

CREATE TABLE `reznor_newsletter_admins` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reznor_newsletter_admins`
--

INSERT INTO `reznor_newsletter_admins` (`id`, `login`, `password`) VALUES
(1, 'adam', '$2y$10$4sZdn0EaurMzGCAla1Up7OJ8vDmhJjKdsyCtQIAIuJ3AuxQ0m0Tly');

-- --------------------------------------------------------

--
-- Table structure for table `reznor_newsletter_users`
--

CREATE TABLE `reznor_newsletter_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reznor_newsletter_users`
--

INSERT INTO `reznor_newsletter_users` (`id`, `email`) VALUES
(1, 'adam@gmail.com'),
(2, 'marek@gmail.com'),
(3, 'anna@gmail.com'),
(4, 'andrzej@gmail.com'),
(5, 'justyna@gmail.com'),
(6, 'kasia@gmail.com'),
(7, 'beata@gmail.com'),
(8, 'jakub@gmail.com'),
(9, 'janusz@gmail.com'),
(10, 'roman@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reznor_newsletter_admins`
--
ALTER TABLE `reznor_newsletter_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reznor_newsletter_users`
--
ALTER TABLE `reznor_newsletter_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reznor_newsletter_admins`
--
ALTER TABLE `reznor_newsletter_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reznor_newsletter_users`
--
ALTER TABLE `reznor_newsletter_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
