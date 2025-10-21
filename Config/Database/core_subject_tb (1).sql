-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2025 at 04:34 PM
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
-- Table structure for table `core_subject_tb`
--

CREATE TABLE `core_subject_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Statistics_and_Probability` varchar(255) NOT NULL,
  `Physical_Science` varchar(255) NOT NULL,
  `mbti_type` varchar(10) DEFAULT NULL,
  `oral_comm_context` varchar(255) NOT NULL,
  `komunikasyon_pananaliksik` varchar(255) NOT NULL,
  `general_math` varchar(255) NOT NULL,
  `earth_life_sci` varchar(255) NOT NULL,
  `personal_dev` varchar(255) NOT NULL,
  `ucsp` varchar(255) NOT NULL,
  `pe_health_1` varchar(255) NOT NULL,
  `pe_health_2` varchar(255) NOT NULL,
  `reading_writing` varchar(255) NOT NULL,
  `pagbasa_pagsusuri` varchar(255) NOT NULL,
  `lit21_ph_world` varchar(255) NOT NULL,
  `media_info_lit` varchar(255) NOT NULL,
  `stats_prob` varchar(255) NOT NULL,
  `physical_sci` varchar(255) NOT NULL,
  `cp_arts_regions` varchar(255) NOT NULL,
  `intro_philo_human` varchar(255) NOT NULL,
  `pe_health_3` varchar(255) NOT NULL,
  `pe_health_4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
