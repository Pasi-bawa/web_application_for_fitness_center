-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 06:19 AM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `instructor_id` int(255) NOT NULL,
  `class_date` date NOT NULL,
  `class_time` time NOT NULL,
  `duration` int(255) NOT NULL,
  `capacity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_enrollments`
--

CREATE TABLE `class_enrollments` (
  `enrollment_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `enrollment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fitness_points`
--

CREATE TABLE `fitness_points` (
  `point_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `points` int(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fitness_progress`
--

CREATE TABLE `fitness_progress` (
  `progress_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `bmi` decimal(4,2) NOT NULL,
  `record_date` date NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructors_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `status` enum('active','inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_ratings`
--

CREATE TABLE `instructor_ratings` (
  `rating_id` int(255) NOT NULL,
  `instructor_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(255) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `join_date` date NOT NULL,
  `status` enum('active','inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `membership_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `plan_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_classes`
--

CREATE TABLE `scheduled_classes` (
  `schedule_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `instructor_id` int(255) NOT NULL,
  `member_id` int(255) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `class_date` date NOT NULL,
  `class_time` time NOT NULL,
  `status` enum('Scheduled','Completed','Cancelled','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`user_id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'test', 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(2, 'new', 'new@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(3, 'instructor', 'instructor@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(4, '123', '123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(5, 'bawa', 'bawa@gmail.com', '4ba29b9f9e5732ed33761840f4ba6c53', 'admin'),
(6, 'bawantha', 'bawantha@gmail.com', '4ba29b9f9e5732ed33761840f4ba6c53', 'admin'),
(7, 'pasidu', 'pasidu@gmail.com', '4ba29b9f9e5732ed33761840f4ba6c53', 'admin'),
(8, 'test1', 'test1@gmail.com', '1234', 'instructor'),
(9, 'bawantha1', 'bawantha1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'instructor'),
(10, 'sunil', 'sunil@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'instructor'),
(11, 'test2', 'test2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(12, 'admin', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(13, 'user', 'user@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(14, 'member1', 'member1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'member'),
(15, 'john', 'john@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'member'),
(16, 'instructor5', 'instructor5@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'instructor'),
(17, 'sadun', 'sadun@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'member'),
(18, 'instructor6', 'instructor6@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'instructor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `class_enrollments`
--
ALTER TABLE `class_enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `fitness_points`
--
ALTER TABLE `fitness_points`
  ADD PRIMARY KEY (`point_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `fitness_progress`
--
ALTER TABLE `fitness_progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructors_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `instructor_ratings`
--
ALTER TABLE `instructor_ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `scheduled_classes`
--
ALTER TABLE `scheduled_classes`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_enrollments`
--
ALTER TABLE `class_enrollments`
  MODIFY `enrollment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fitness_points`
--
ALTER TABLE `fitness_points`
  MODIFY `point_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fitness_progress`
--
ALTER TABLE `fitness_progress`
  MODIFY `progress_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructors_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_ratings`
--
ALTER TABLE `instructor_ratings`
  MODIFY `rating_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `membership_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scheduled_classes`
--
ALTER TABLE `scheduled_classes`
  MODIFY `schedule_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `class_enrollments`
--
ALTER TABLE `class_enrollments`
  ADD CONSTRAINT `class_enrollments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_enrollments` (`enrollment_id`),
  ADD CONSTRAINT `class_enrollments_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `class_enrollments` (`enrollment_id`);

--
-- Constraints for table `fitness_points`
--
ALTER TABLE `fitness_points`
  ADD CONSTRAINT `fitness_points_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `fitness_points` (`point_id`);

--
-- Constraints for table `fitness_progress`
--
ALTER TABLE `fitness_progress`
  ADD CONSTRAINT `fitness_progress_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `fitness_progress` (`progress_id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `instructor` (`instructors_id`);

--
-- Constraints for table `instructor_ratings`
--
ALTER TABLE `instructor_ratings`
  ADD CONSTRAINT `instructor_ratings_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructor_ratings` (`rating_id`),
  ADD CONSTRAINT `instructor_ratings_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `instructor_ratings` (`rating_id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`user_id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `memberships_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `memberships` (`membership_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `payments` (`payment_id`);

--
-- Constraints for table `scheduled_classes`
--
ALTER TABLE `scheduled_classes`
  ADD CONSTRAINT `scheduled_classes_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `scheduled_classes` (`schedule_id`),
  ADD CONSTRAINT `scheduled_classes_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `scheduled_classes` (`schedule_id`),
  ADD CONSTRAINT `scheduled_classes_ibfk_3` FOREIGN KEY (`member_id`) REFERENCES `scheduled_classes` (`schedule_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
