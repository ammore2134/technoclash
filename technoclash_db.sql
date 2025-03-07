-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 09:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technoclash_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('Admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `battle`
--

CREATE TABLE `battle` (
  `battle_id` int(11) NOT NULL,
  `battle_name` varchar(255) NOT NULL,
  `is_private` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `battle_participants`
--

CREATE TABLE `battle_participants` (
  `participant_name` varchar(50) NOT NULL,
  `battle_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gate_quizzes`
--

CREATE TABLE `gate_quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stream` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `total_xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gate_quizzes`
--

INSERT INTO `gate_quizzes` (`quiz_id`, `quiz_name`, `description`, `stream`, `duration`, `total_xp`) VALUES
(1, 'dbms', 'knowledge about sql querys.operation on database', 'CSE', 15, 150);

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `username` varchar(50) DEFAULT NULL,
  `total_score` int(11) DEFAULT 0,
  `quiz_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mocktest`
--

CREATE TABLE `mocktest` (
  `mock_id` int(11) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `mock_name` varchar(255) NOT NULL,
  `mock_duration` int(11) NOT NULL,
  `mock_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mocktest`
--

INSERT INTO `mocktest` (`mock_id`, `stream`, `mock_name`, `mock_duration`, `mock_description`) VALUES
(1, 'cs', 'crack gate', 50, 'crack gate in first attempt.....!'),
(2, 'cs', 'crack gate', 180, 'help to crack gate>>>>>>>>>');

-- --------------------------------------------------------

--
-- Table structure for table `mock_questions`
--

CREATE TABLE `mock_questions` (
  `id` int(11) NOT NULL,
  `mock_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mock_tests`
--

CREATE TABLE `mock_tests` (
  `mock_id` int(11) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `mock_name` varchar(255) NOT NULL,
  `mock_duration` int(11) NOT NULL,
  `mock_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` enum('1','2','3','4') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`, `created_at`) VALUES
(1, 2, 'what is the correct syntax to declare pointer in c?', 'int ptr;', 'int *ptr;', 'int &ptr;', 'pointer int ptr;', '2', '2025-03-06 20:09:13'),
(2, 2, 'Which of the following is used to print output in C?', 'print()', 'echo()', 'printf()', 'cout <<', '3', '2025-03-06 20:10:56'),
(3, 3, 'dsa', 'data stru', 'ds', 'a', 'b', '1', '2025-03-06 22:47:21'),
(4, 3, 'stack', 'fifo', 'lifo', 'lilo', 'filo', '1', '2025-03-06 22:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `total_xp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_name`, `description`, `duration`, `total_xp`, `created_at`) VALUES
(2, 'c', 'c bascic', 15, 20, '2025-03-06 20:01:01'),
(3, 'dsa', 'basic of dsa', 2, 1, '2025-03-06 22:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES
(1, 1, 'long form of dbms', 'data structture', 'databse mangement system', 'datAWAREHOUSE ', 'data mining', 2),
(2, 1, 'which qurey is use to create database. ', 'create database databasename;', 'create', 'insert', 'drop', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `college_name` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `xp` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `college_name`, `email`, `password`, `phone_no`, `xp`) VALUES
('Admin', '', NULL, 'admin@gmail.com', 'admin123', '', 0),
('te23', 'tejas', 'git', 'tejust@gmail.com', '$2y$10$o6XxT3L2Uy5vDqaoLiZIwemLPP4RDbuDXG5.ZibnLk8WZoLpZw.XO', '9854632174', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `battle`
--
ALTER TABLE `battle`
  ADD PRIMARY KEY (`battle_id`);

--
-- Indexes for table `battle_participants`
--
ALTER TABLE `battle_participants`
  ADD PRIMARY KEY (`participant_name`,`battle_id`),
  ADD KEY `battle_id` (`battle_id`);

--
-- Indexes for table `gate_quizzes`
--
ALTER TABLE `gate_quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD KEY `username` (`username`);

--
-- Indexes for table `mocktest`
--
ALTER TABLE `mocktest`
  ADD PRIMARY KEY (`mock_id`);

--
-- Indexes for table `mock_questions`
--
ALTER TABLE `mock_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mock_id` (`mock_id`);

--
-- Indexes for table `mock_tests`
--
ALTER TABLE `mock_tests`
  ADD PRIMARY KEY (`mock_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battle`
--
ALTER TABLE `battle`
  MODIFY `battle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gate_quizzes`
--
ALTER TABLE `gate_quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mocktest`
--
ALTER TABLE `mocktest`
  MODIFY `mock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mock_questions`
--
ALTER TABLE `mock_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mock_tests`
--
ALTER TABLE `mock_tests`
  MODIFY `mock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `battle_participants`
--
ALTER TABLE `battle_participants`
  ADD CONSTRAINT `battle_participants_ibfk_1` FOREIGN KEY (`participant_name`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `battle_participants_ibfk_2` FOREIGN KEY (`battle_id`) REFERENCES `battle` (`battle_id`) ON DELETE CASCADE;

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `mock_questions`
--
ALTER TABLE `mock_questions`
  ADD CONSTRAINT `mock_questions_ibfk_1` FOREIGN KEY (`mock_id`) REFERENCES `mock_tests` (`mock_id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `gate_quizzes` (`quiz_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
