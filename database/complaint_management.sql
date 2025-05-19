-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 09:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaint_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` varchar(8) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(335) NOT NULL,
  `phoneNos` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `dateRegistered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaintId` int(11) NOT NULL,
  `complaint` varchar(1250) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `studentId` varchar(8) NOT NULL,
  `workerId` varchar(8) DEFAULT NULL,
  `adminId` varchar(8) DEFAULT NULL,
  `status` varchar(9) NOT NULL DEFAULT 'pending',
  `dateCompleted` timestamp NULL DEFAULT NULL,
  `type` varchar(13) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `complaints`
--
DELIMITER $$
CREATE TRIGGER `update_timestamp_on_complaint_change` BEFORE UPDATE ON `complaints` FOR EACH ROW IF OLD.complaint <> NEW.complaint THEN
    SET NEW.dateAdded = NOW();
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_timestamp_on_status_change` BEFORE UPDATE ON `complaints` FOR EACH ROW IF OLD.status <> NEW.status THEN
    SET NEW.dateCompleted = NOW();
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` varchar(8) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(335) NOT NULL,
  `roomNos` varchar(4) NOT NULL,
  `phoneNos` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `dateRegistered` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `workerId` varchar(8) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(335) NOT NULL,
  `phoneNos` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `role` varchar(13) NOT NULL,
  `dateRegistered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaintId`),
  ADD KEY `fk_complaints_users` (`studentId`),
  ADD KEY `fk_complaints_workers` (`workerId`),
  ADD KEY `fk_complaints_admins` (`adminId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`workerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaintId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fk_complaints_admins` FOREIGN KEY (`adminId`) REFERENCES `admins` (`adminId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_complaints_users` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_complaints_workers` FOREIGN KEY (`workerId`) REFERENCES `workers` (`workerId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
