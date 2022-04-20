-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2022 at 08:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astoncv`
--

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyprogramming` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `URLlinks` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `name`, `email`, `password`, `keyprogramming`, `profile`, `education`, `URLlinks`) VALUES
(1, 'Khush', 'Khush@nvkk.co.uk', 'Khush123.', 'Python, JS, HTML, CSS, GO', 'Nothing here', 'Primary, Secondary,College', 'https://khush-bot-key-management.herokuapp.com'),
(2, 'John', 'john@gmail.com', 'John123.', 'Java, GO, C#', 'none', 'CS Degree', 'none'),
(4, 'Alan Smith', 'alan@gmail.com', '$2y$15$PEdWLLRe68T2jGdKY4O3zOtfgxffj7ixCy9sJMMmS4TDDS8JMrPBG', NULL, NULL, NULL, NULL),
(5, 'jose', 'andyrob@gmail.com', '$2y$15$xacJmNb5BW5J.fyH8fsu6OaABIgKu5pbztKIwqMbr3KzNcPlMpEFy', ' ', 'i like footy innit ', 'java', 'https://phpdelusions.net/pdo_examples/update,https://phpdelusions.net/pdo_examples/update'),
(21, 'John', 'johnmgin@gmail.com', '$2y$15$s/.pOtAX0Birp1X4./4kc.E2zKc5IaBSRXccn5HIMRddkjo9CaFnK', NULL, NULL, NULL, NULL),
(22, 'Ron', 'ron@gmail.com', '$2y$15$3Mkc4HJ0/739Pf5cfelqsegmMwJG6zPJP6hmyY2iFNSbom20HT5R.', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
