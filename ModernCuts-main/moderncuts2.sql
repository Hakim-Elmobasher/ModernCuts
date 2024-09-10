-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2023 at 06:23 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moderncuts2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_logs`
--

CREATE TABLE `admin_activity_logs` (
  `id` int NOT NULL,
  `admin_user_id` int NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('VIEWER','EDITOR','SUPER_ADMIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `professional_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `professional_id`, `service_id`, `user_id`, `appointment_date`, `appointment_time`) VALUES
(13, 2, 2, 2, '2023-11-30', '10:00:00'),
(14, 1, 1, 2, '2023-11-30', '10:00:00'),
(15, 1, 1, 2, '2023-11-30', '10:00:00'),
(16, 3, 3, 2, NULL, NULL),
(17, 1, 1, 2, NULL, NULL),
(18, 1, 1, 2, NULL, NULL),
(19, 1, 1, 2, NULL, NULL),
(20, 1, 1, 2, '2023-11-30', '10:00:00'),
(21, 1, 1, 2, '2023-11-30', '10:00:00'),
(22, 1, 1, 2, '2023-11-29', '10:00:00'),
(23, 2, 2, 2, '2023-11-26', '10:00:00'),
(25, 2, 2, 2, '2023-11-30', '10:00:00'),
(26, 4, 1, 2, '2023-11-30', '14:00:00'),
(27, 3, 3, 2, '2023-12-01', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `availability` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `name`, `image`, `availability`, `created_at`) VALUES
(1, 'Walter', 'Walter3.jpg', 'Available', '2023-10-20 05:19:22'),
(2, 'Miguel', 'The real Miguel.jpg', 'Available', '2023-10-20 05:19:22'),
(3, 'Greg', 'Greg1.jpg', 'Available', '2023-10-20 05:19:22'),
(4, 'Hakim', 'Hakim.jpg', 'Available', '2023-10-20 05:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `professional_hourly_availability`
--

CREATE TABLE `professional_hourly_availability` (
  `id` int NOT NULL,
  `professional_id` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_of_week` enum('MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY','SUNDAY') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_hourly_availability`
--

INSERT INTO `professional_hourly_availability` (`id`, `professional_id`, `start_time`, `end_time`, `day_of_week`, `is_available`, `notes`, `created_at`, `updated_at`) VALUES
(181, 1, '10:00:00', '11:00:00', 'MONDAY', 1, NULL, '2023-10-24 23:09:14', '2023-10-24 23:09:14'),
(240, 1, '19:00:00', '20:00:00', 'SATURDAY', 1, NULL, '2023-10-24 23:09:14', '2023-10-24 23:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `duration`, `price`, `created_at`) VALUES
(1, 'Clipper Haircut', '1 HR', 50.00, '2023-11-14 08:42:00'),
(2, 'Clipper Haircut', '1 HR', 50.00, '2023-11-14 08:42:07'),
(3, 'Clipper Haircut + Beard/Shave', '1 HR', 60.00, '2023-11-14 08:42:07'),
(4, 'Scissor Haircut/Styled', '1 HR', 60.00, '2023-11-14 08:42:07'),
(5, 'Scissor Haircut/Styled + Beard/Shave', '1 HR', 65.00, '2023-11-14 08:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashed_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`, `email`, `first_name`, `last_name`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(1, 'sean1', '$2y$10$ebpQtjp8p2wan8rJaSWhDuQ7eCRShIjdPSnnZRzr6rvRosxBuQvS6', 'justGivemeThelight@gmail.com', 'sean', 'paul', NULL, '2023-11-08 03:40:34', '2023-11-08 03:40:34'),
(2, 'mike1', '$2y$10$ypMNarPd18DuAigALqS/N.In7gqmtrCzY3GSkPPbkLunNg.09RBH2', 'mike@gmail.com', 'Mike', 'Combs', NULL, '2023-11-16 03:04:09', '2023-11-16 03:04:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_id` (`professional_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
