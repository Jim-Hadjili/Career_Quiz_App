-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 01:54 PM
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
-- Table structure for table `career_path_tb`
--

CREATE TABLE `career_path_tb` (
  `id` int(11) NOT NULL,
  `career_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career_path_tb`
--

INSERT INTO `career_path_tb` (`id`, `career_type`) VALUES
(1, 'Engineering'),
(2, 'Architecture'),
(3, 'Information Technology'),
(4, 'Computer Science'),
(5, 'Computer Engineering'),
(6, 'Civil Engineering'),
(7, 'Mechanical Engineering'),
(8, 'Electrical Engineering'),
(9, 'Electronics Engineering'),
(10, 'Industrial Engineering'),
(11, 'Chemical Engineering'),
(12, 'Marine Engineering'),
(13, 'Aerospace Engineering'),
(14, 'Environmental Science'),
(15, 'Biology'),
(16, 'Chemistry'),
(17, 'Physics'),
(18, 'Mathematics'),
(19, 'Data Science'),
(20, 'Cybersecurity'),
(21, 'Nursing'),
(22, 'Medical Technology'),
(23, 'Pharmacy'),
(24, 'Physical Therapy'),
(25, 'Occupational Therapy'),
(26, 'Dentistry'),
(27, 'Medicine'),
(28, 'Public Health'),
(29, 'Radiologic Technology'),
(30, 'Nutrition and Dietetics'),
(31, 'Midwifery'),
(32, 'Respiratory Therapy'),
(33, 'Veterinary Medicine'),
(34, 'Health Care Services'),
(35, 'Biomedical Engineering'),
(36, 'Accountancy'),
(37, 'Business Administration'),
(38, 'Marketing Management'),
(39, 'Financial Management'),
(40, 'Entrepreneurship'),
(41, 'Human Resource Management'),
(42, 'Economics'),
(43, 'Real Estate Management'),
(44, 'Hospitality Management'),
(45, 'Tourism Management'),
(46, 'Customs Administration'),
(47, 'Office Administration'),
(48, 'Logistics and Supply Chain Management'),
(49, 'Psychology'),
(50, 'Political Science'),
(51, 'Sociology'),
(52, 'Philosophy'),
(53, 'Communication Arts'),
(54, 'Mass Communication'),
(55, 'Public Administration'),
(56, 'International Studies'),
(57, 'Criminology'),
(58, 'Social Work'),
(59, 'Education'),
(60, 'Linguistics'),
(61, 'History'),
(62, 'Literature'),
(63, 'Fine Arts'),
(64, 'Multimedia Arts'),
(65, 'Interior Design'),
(66, 'Fashion Design'),
(67, 'Graphic Design'),
(68, 'Film and Television'),
(69, 'Performing Arts'),
(70, 'Theater Arts'),
(71, 'Photography'),
(72, 'Animation'),
(73, 'Music'),
(74, 'Creative Writing'),
(75, 'Automotive Technology'),
(76, 'Electrical Installation and Maintenance'),
(77, 'Welding Technology'),
(78, 'Carpentry'),
(79, 'Plumbing'),
(80, 'Masonry'),
(81, 'Housekeeping'),
(82, 'Cookery'),
(83, 'Bread and Pastry Production'),
(84, 'Food and Beverage Services'),
(85, 'Tour Guiding Services'),
(86, 'Front Office Services'),
(87, 'Computer Systems Servicing'),
(88, 'Animation NCII'),
(89, 'Programming NCII'),
(90, 'Agriculture'),
(91, 'Forestry'),
(92, 'Fisheries'),
(93, 'Agroforestry'),
(94, 'Environmental Management'),
(95, 'Animal Science'),
(96, 'Crop Science'),
(97, 'Food Technology'),
(98, 'Law'),
(99, 'Legal Management'),
(100, 'Customs and Border Protection'),
(101, 'Public Safety Administration'),
(102, 'Community Development'),
(103, 'Military Science'),
(104, 'Forensic Science');

-- --------------------------------------------------------

--
-- Table structure for table `core_subject_tb`
--

CREATE TABLE `core_subject_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Statistics_and_Probability` varchar(255) NOT NULL,
  `Physical_Science` varchar(255) NOT NULL,
  `oral_comm_context` varchar(255) NOT NULL,
  `general_math` varchar(255) NOT NULL,
  `earth_life_sci` varchar(255) NOT NULL,
  `ucsp` varchar(255) NOT NULL,
  `reading_writing` varchar(255) NOT NULL,
  `lit21_ph_world` varchar(255) NOT NULL,
  `media_info_lit` varchar(255) NOT NULL,
  `mbti_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `core_subject_tb`
--

INSERT INTO `core_subject_tb` (`id`, `user_id`, `Statistics_and_Probability`, `Physical_Science`, `oral_comm_context`, `general_math`, `earth_life_sci`, `ucsp`, `reading_writing`, `lit21_ph_world`, `media_info_lit`, `mbti_type`) VALUES
(1, 1, '88', '88', '88', '88', '88', '88', '88', '88', '88', 'ENFP');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results_tb`
--

CREATE TABLE `quiz_results_tb` (
  `id` int(11) NOT NULL,
  `result_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `quiz_answers` longtext NOT NULL,
  `core_subjects` longtext DEFAULT NULL,
  `ai_analysis` longtext NOT NULL,
  `career_recommendations` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `userName`, `userEmail`, `userPassword`) VALUES
(1, 'Jim Hadjili', 'jim.hadjili@gmail.com', '$2y$10$hnzpCDOCwuj21q6senkLxuhDCYRK0egpJd5fDRVYJZ5ASQUJhp5vO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career_path_tb`
--
ALTER TABLE `career_path_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `result_id` (`result_id`),
  ADD KEY `idx_result_id` (`result_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_session_id` (`session_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career_path_tb`
--
ALTER TABLE `career_path_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `core_subject_tb`
--
ALTER TABLE `core_subject_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
