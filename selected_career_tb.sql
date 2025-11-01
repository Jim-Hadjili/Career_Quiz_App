-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 09:51 AM
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
-- Database: `career_quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `selected_career_tb`
--

CREATE TABLE `selected_career_tb` (
  `selectedCareer_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_selected` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selected_career_tb`
--

INSERT INTO `selected_career_tb` (`selectedCareer_id`, `result_id`, `user_id`, `career_selected`) VALUES
(1, 17, 1, 'Human Resources Specialist'),
(2, 15, 1, 'Data Scientist'),
(3, 18, 1, 'Market Research Analyst'),
(4, 20, 1, 'High School Science Teacher'),
(5, 22, 1, 'Environmental Scientist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `selected_career_tb`
--
ALTER TABLE `selected_career_tb`
  ADD PRIMARY KEY (`selectedCareer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `selected_career_tb`
--
ALTER TABLE `selected_career_tb`
  MODIFY `selectedCareer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
