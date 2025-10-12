-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2025 at 04:15 PM
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
-- Table structure for table `quiz_results_tb`
--

CREATE TABLE `quiz_results_tb` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `quiz_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`quiz_data`)),
  `recommended_careers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`recommended_careers`)),
  `completion_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_guest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results_tb`
--

INSERT INTO `quiz_results_tb` (`result_id`, `user_id`, `session_id`, `quiz_data`, `recommended_careers`, `completion_date`, `is_guest`) VALUES
(1, NULL, 'guest_68ebb021277b20.46025613', '[{\"question_id\":\"1\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"2\",\"scale_value\":3,\"option_value\":3},{\"question_id\":\"3\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"4\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"5\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"6\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"7\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"8\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"9\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"10\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"11\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"12\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"13\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"14\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"15\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"16\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"17\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"18\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"19\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"20\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"21\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"22\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"23\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"24\",\"scale_value\":3,\"option_value\":3},{\"question_id\":\"25\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"26\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"27\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"28\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"29\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"30\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"31\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"32\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"33\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"34\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"35\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"36\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"37\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"38\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"39\",\"scale_value\":2,\"option_value\":2},{\"question_id\":\"40\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"41\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"42\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"43\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"44\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"45\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"46\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"47\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"48\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"49\",\"scale_value\":3,\"option_value\":3},{\"question_id\":\"50\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"51\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"52\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"53\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"54\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"55\",\"scale_value\":3,\"option_value\":3},{\"question_id\":\"56\",\"scale_value\":7,\"option_value\":7},{\"question_id\":\"57\",\"scale_value\":6,\"option_value\":6},{\"question_id\":\"58\",\"scale_value\":5,\"option_value\":5},{\"question_id\":\"59\",\"scale_value\":4,\"option_value\":4},{\"question_id\":\"60\",\"scale_value\":1,\"option_value\":1}]', '{\"technology\":0,\"business\":0,\"healthcare\":0}', '2025-10-12 14:13:48', 1);

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
(1, 'Jim Hadjili', 'jim.hadjili@gmail.com', '$2y$10$.QECVubGTW38PZhkpFieIupxMLtrsv44hBvfQvzzwsXiEyvO5B88W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_results_tb`
--
ALTER TABLE `quiz_results_tb`
  ADD CONSTRAINT `quiz_results_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
