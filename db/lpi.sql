-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2023 at 05:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id_employee` int UNSIGNED NOT NULL,
  `id` int NOT NULL,
  `name` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `position` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  `salary` int NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id_employee`, `id`, `name`, `phone`, `address`, `position`, `join_date`, `salary`, `image`, `created_at`, `updated_at`) VALUES
(1, 1001, 'Andi', '08123456789', 'Jakarta', 'Owner', '2021-01-01', 100000000, '7.jpg', '2023-09-01 13:30:59', '2023-09-01 13:40:57'),
(2, 1002, 'Rudi', '32423', 'Bekasi', 'Manager IT', '2020-01-01', 20000000, '6.jpg', '2023-09-01 13:34:25', '2023-09-01 13:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(11, '2023-09-01-071745', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1693569872, 1),
(12, '2023-09-01-072252', 'App\\Database\\Migrations\\CreateEmployeesTable', 'default', 'App', 1693569872, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `islogin` varchar(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `level`, `image`, `islogin`, `created_at`, `updated_at`) VALUES
(1, 'Andi', 'andi@mail.com', '$2y$10$NM8kswi/O4uDrz5i9IALTuN4uE9oAZNCRBcSxa0/8.IdszJ7pnnJO', '2', '6.jpg', '0', '2023-09-01 13:39:35', '2023-09-01 16:19:33'),
(2, 'Admins', 'admin@mail.com', '$2y$10$yRCauMzYiEVURNOFMjpbx.ErH7kt65hwVQjclFGsKKncdx3O0BZQS', '1', '7.jpg', '1', '2023-09-01 14:56:38', '2023-09-01 17:10:10'),
(3, 'Test', 'test@mail.com', '$2y$10$MR34S5wtiEM3mfWCzyhmrOvF6O8EnCtbWDFuvaEsAwoYcrt.oJaRK', '1', '1.jpg', NULL, '2023-09-01 17:11:57', '2023-09-01 17:12:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id_employee` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
