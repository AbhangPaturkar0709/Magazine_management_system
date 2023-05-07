-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 08:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magazinedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL,
  `uploaddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `stud_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `d_name` varchar(50) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `d_name`, `code`) VALUES
(1, 'CIVIL ENGINEERING', 'CE'),
(2, 'MECHANICAL ENGINEERING', 'ME'),
(3, 'ELECTRICAL ENGINEERING', 'EE'),
(4, 'ELECTRONICS AND TELECOMMUNICTION ENGINEERING', 'EC'),
(5, 'COMPUTER ENGINEERING', 'CM'),
(6, 'INFORMATION TECHNILOGY', 'IF'),
(7, 'CHEMICAL ENGINEERING', 'CH'),
(8, 'PLASTIC AND POLYMER ENGINEERING', 'PP');

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) NOT NULL,
  `name` longtext DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `coverpage` varchar(255) DEFAULT NULL,
  `uploadyear` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(7) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `deptno` int(11) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '',
  `mob` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `deptno`, `year`, `role`, `email`, `password`, `mob`) VALUES
('001', 'ADMIN', 'ADMIN', 'ADMIN', NULL, NULL, 'ADMIN', 'admin123@gmail.com', 'admin@123', 7894561230);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SID` (`stud_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKDEPTNO` (`deptno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_SID` FOREIGN KEY (`stud_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FKDEPTNO` FOREIGN KEY (`deptno`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
