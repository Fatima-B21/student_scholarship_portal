-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `education_profile`
--

CREATE TABLE `education_profile` (
  `student_id` int(11) NOT NULL,
  `metric_percentage` float NOT NULL,
  `inter_percentage` float NOT NULL,
  `has_bs` enum('yes','no') NOT NULL,
  `bs_cgpa` float DEFAULT NULL,
  `has_ms` enum('yes','no') NOT NULL,
  `ms_cgpa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_profile`
--

INSERT INTO `education_profile` (`student_id`, `metric_percentage`, `inter_percentage`, `has_bs`, `bs_cgpa`, `has_ms`, `ms_cgpa`) VALUES
(1, 60, 50, 'yes', 3.5, 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `institute` varchar(100) NOT NULL,
  `degree` varchar(10) NOT NULL,
  `min_cgpa` float NOT NULL,
  `country` varchar(50) NOT NULL,
  `benefits` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `name`, `institute`, `degree`, `min_cgpa`, `country`, `benefits`) VALUES
(1, 'Merit Based', 'UAF', 'BS', 2.6, 'Pakistan', 'Fully Funded'),
(2, 'Merit Based', 'LUMS', 'BS', 3, 'Pakistan', 'Tuition Fee'),
(3, 'Merit Based', 'NUST', 'MS', 3.2, 'Pakistan', 'Tuition Fee + Hostel');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `cnic`, `password`) VALUES
(9, 'Sadaaf Emaan', 'sadaaf@gmail.com', '3310482871512', 'asdfghjkl'),
(10, 'Fatima Javaid', 'javaidfatima480@gmail.com', '3310422241178', 'asdfghjkl'),
(11, 'Emaan', 'emaan@gmail.com', '3310422241178', 'asdfghjkl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education_profile`
--
ALTER TABLE `education_profile`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
