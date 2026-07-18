-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2026 at 06:50 PM
-- Server version: 8.0.42
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amrita_placement`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics_results`
--

DROP TABLE IF EXISTS `analytics_results`;
CREATE TABLE IF NOT EXISTS `analytics_results` (
  `company_id` int NOT NULL,
  `eligible_count` int DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `analytics_results`
--

INSERT INTO `analytics_results` (`company_id`, `eligible_count`) VALUES
(1, 3),
(2, 5),
(3, 2),
(4, 6),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `min_cgpa` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `industry`, `min_cgpa`) VALUES
(1, 'Google', 'IT', 8.00),
(2, 'TATA Motors', 'Manufacturing', 7.00),
(3, 'Microsoft', 'IT', 8.50),
(4, 'XYZ', 'IT', 6.00),
(7, 'cisco', 'IT', 7.00);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `cgpa` decimal(4,2) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `cgpa`, `branch`) VALUES
(2, 'Priya Das', 7.20, 'ECE'),
(3, 'Arjun V', 9.10, 'ME'),
(4, 'Sneha M', 6.50, 'CSE'),
(5, 'Priya', 8.30, 'CSE'),
(6, 'Yash', 5.60, 'ME'),
(10, 'siri', 7.00, 'CSE'),
(11, 'Rahul', 10.00, 'CSE');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analytics_results`
--
ALTER TABLE `analytics_results`
  ADD CONSTRAINT `analytics_results_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
