-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 12:05 PM
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
-- Database: `fypsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `username` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `coorName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`username`, `password`, `coorName`) VALUES
('01658586879', '$2y$10$ohOOU5YTpKggdtWVfuXcQ.hDMzT7G81RnXFjtcLaXoV6OLDLL4s6i', 'Mr Coordinator');

-- --------------------------------------------------------

--
-- Table structure for table `fypinfo`
--

CREATE TABLE `fypinfo` (
  `infoID` int(11) NOT NULL,
  `infoDetail` text NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `postDate` datetime NOT NULL,
  `pp` tinyint(1) NOT NULL,
  `krk` tinyint(1) NOT NULL,
  `ki` tinyint(1) NOT NULL,
  `im` tinyint(1) NOT NULL,
  `coorID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pairwise`
--

CREATE TABLE `pairwise` (
  `pairwiseID` int(11) NOT NULL,
  `c12` float NOT NULL,
  `c13` float NOT NULL,
  `c21` float NOT NULL,
  `c23` float NOT NULL,
  `c31` float NOT NULL,
  `c32` float NOT NULL,
  `cw1` float NOT NULL,
  `cw2` float NOT NULL,
  `cw3` float NOT NULL,
  `username` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectdetails`
--

CREATE TABLE `projectdetails` (
  `projectID` int(6) NOT NULL,
  `projectTitle` varchar(50) NOT NULL,
  `projectSynopsis` longtext DEFAULT NULL,
  `projectScope` varchar(30) NOT NULL,
  `projectSubmission` varchar(30) NOT NULL,
  `confirmStatus` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(15) NOT NULL,
  `projectProgress2` varchar(100) DEFAULT NULL,
  `supervisorReview2` longtext DEFAULT NULL,
  `projectProgress3` varchar(100) DEFAULT NULL,
  `supervisorReview3` longtext DEFAULT NULL,
  `projectProgress4` varchar(100) DEFAULT NULL,
  `supervisorReview4` longtext DEFAULT NULL,
  `projectProgress5` varchar(100) DEFAULT NULL,
  `proposalReportGrade1` int(10) DEFAULT NULL,
  `proposalReportGrade2` int(10) DEFAULT NULL,
  `proposalReportGrade3` int(10) DEFAULT NULL,
  `proposalReportGrade4` int(10) DEFAULT NULL,
  `proposalReportGrade5` int(10) DEFAULT NULL,
  `proposalReportGrade6` int(10) DEFAULT NULL,
  `proposalReportTotal` int(19) DEFAULT NULL,
  `projectProgress6` varchar(100) DEFAULT NULL,
  `supervisorReview6` longtext DEFAULT NULL,
  `projectProgress7` varchar(100) DEFAULT NULL,
  `supervisorReview7` longtext DEFAULT NULL,
  `projectProgress8` varchar(100) DEFAULT NULL,
  `reportGrade1` int(10) DEFAULT NULL,
  `reportGrade2` int(10) DEFAULT NULL,
  `reportGrade3` int(10) DEFAULT NULL,
  `reportGrade4` int(10) DEFAULT NULL,
  `reportGrade5` int(10) DEFAULT NULL,
  `reportGrade6` int(10) DEFAULT NULL,
  `reportGrade7` int(10) DEFAULT NULL,
  `reportGrade8` int(10) DEFAULT NULL,
  `reportTotal` int(10) DEFAULT NULL,
  `matricNo` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scope`
--

CREATE TABLE `scope` (
  `scopeID` int(11) NOT NULL,
  `scope` varchar(100) NOT NULL,
  `pp` tinyint(1) NOT NULL,
  `krk` tinyint(1) NOT NULL,
  `ki` tinyint(1) NOT NULL,
  `im` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `matricNo` varchar(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentName` varchar(50) NOT NULL,
  `course` varchar(10) NOT NULL,
  `assignedSV` varchar(20) DEFAULT 'NA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `username` varchar(11) NOT NULL,
  `password` varchar(300) NOT NULL,
  `svName` varchar(50) NOT NULL,
  `field` varchar(10) NOT NULL,
  `expertise` varchar(30) DEFAULT NULL,
  `projectPreference` varchar(30) DEFAULT NULL,
  `assignedCount` int(5) NOT NULL,
  `confirmStatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `fypinfo`
--
ALTER TABLE `fypinfo`
  ADD PRIMARY KEY (`infoID`);

--
-- Indexes for table `pairwise`
--
ALTER TABLE `pairwise`
  ADD PRIMARY KEY (`pairwiseID`);

--
-- Indexes for table `projectdetails`
--
ALTER TABLE `projectdetails`
  ADD PRIMARY KEY (`projectID`);

--
-- Indexes for table `scope`
--
ALTER TABLE `scope`
  ADD PRIMARY KEY (`scopeID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`matricNo`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fypinfo`
--
ALTER TABLE `fypinfo`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pairwise`
--
ALTER TABLE `pairwise`
  MODIFY `pairwiseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectdetails`
--
ALTER TABLE `projectdetails`
  MODIFY `projectID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scope`
--
ALTER TABLE `scope`
  MODIFY `scopeID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
