-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 08:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oxygen`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_orders`
--

CREATE TABLE `assign_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `t_code` varchar(255) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_orders`
--

INSERT INTO `assign_orders` (`id`, `staff_id`, `t_code`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'y0B3tyhzpnv0cY1PAmZC202308936305', NULL, 1, '2023-09-06 06:34:13', '2023-09-06 06:34:13'),
(2, 3, 'NAvB9Q5IsLyI99O6idqL202308495626', 'oxygen tank', 0, '2023-09-07 05:40:26', '2023-09-07 05:40:26'),
(6, 4, 'NAvB9Q5IsLyI99O6idqL202308495626', 'This task is reasigned', 2, '2023-09-10 04:04:08', '2023-09-10 04:04:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_orders`
--
ALTER TABLE `assign_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_orders`
--
ALTER TABLE `assign_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
