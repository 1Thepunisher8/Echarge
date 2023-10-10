-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 02:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echarge`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_information`
--

CREATE TABLE `car_information` (
  `id` int(11) NOT NULL,
  `number` varchar(8) NOT NULL,
  `charging_type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_information`
--

INSERT INTO `car_information` (`id`, `number`, `charging_type`, `created_at`) VALUES
(1, '22-23233', 'slow', '2023-05-25 19:33:32'),
(3, '22-2323', 'fast', '2023-05-25 19:38:37'),
(4, '43-87878', 'slow', '2023-05-26 12:36:12'),
(5, '32-32323', 'slow', '2023-05-26 12:37:38'),
(6, '32-32455', 'slow', '2023-05-26 12:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `name`, `message`) VALUES
(1, 'moath2651@gmail.com', 'moath', 'fdsfdsfdsagg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `station` varchar(255) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `station`, `time`) VALUES
(3, 'al manasser', '16:33:00'),
(4, 'al manasser', '16:33:00'),
(7, 'al manasser', '20:07:00'),
(8, 'al manasser', '20:07:00'),
(22, 'al manasser', '17:55:00'),
(23, 'al manasser', '17:55:00'),
(24, 'al mansser', '17:55:00'),
(25, 'al mansser', '17:55:00'),
(26, 'al mansser', '17:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `station_information`
--

CREATE TABLE `station_information` (
  `id` int(11) NOT NULL,
  `charger_number` int(11) DEFAULT NULL,
  `station_location` varchar(255) DEFAULT NULL,
  `station_name` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station_information`
--

INSERT INTO `station_information` (`id`, `charger_number`, `station_location`, `station_name`, `start_time`, `end_time`) VALUES
(1, 3, 'amman', 'al manasser', '10:48:00', '10:46:00'),
(8, 12, 'amman', 'al mansser', '10:52:00', '01:55:00'),
(9, 12, 'moadba', 'total', '23:32:00', '04:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `carPlate` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `email`, `name`, `phone`, `carPlate`) VALUES
(1, '$2y$10$5ngc18jpj6uYdfgHEuW3.Om3rokfROnYqnC6Vd1Kp5XL8Vgs.oMWW', 'moath2651@gmail.com', 'rewrewrewrw', '', '34342211'),
(3, '$2y$10$WhODOIExwJ7KTVJ/1WY5keRwWb/TqEoOTIJ7Cc7c2Qgj.lzmMGYZm', 'moa@gmail.com', 'mono', '0987967986', '34433433'),
(4, '$2y$10$BH027Z9dQ.BrxK84Ps9WL.7q27DKlcEQJ5sO0YeCshLA73ePe7pjC', 'mayahayajenh@gmail.com', 'fsdfdfds', NULL, NULL),
(5, '$2y$10$7tPtkXpPKXUkvVBwXEmv9uTr4ImsOnYXZd8jQviI/WzI520cqnrI.', 'mayahayafsfjenh@gmail.com', 'fsdfdfdsffdsds', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_information`
--
ALTER TABLE `car_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_information`
--
ALTER TABLE `station_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `station_name` (`station_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_information`
--
ALTER TABLE `car_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `station_information`
--
ALTER TABLE `station_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
