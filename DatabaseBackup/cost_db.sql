-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 05:10 AM
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
-- Database: `cost_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `Id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`Id`, `name`) VALUES
(1, 'USD'),
(2, 'AZN'),
(7, 'Pound'),
(14, 'Ruble'),
(15, 'EURO');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Id` int(11) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `is_income` tinyint(1) NOT NULL,
  `comment` varchar(191) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Id`, `amount`, `payment_type_id`, `currency_id`, `is_income`, `comment`, `created_date`) VALUES
(2, '450', 2, 2, 0, 'lorem ipsum dolor sit', '2023-07-04 11:16:53'),
(10, '10000', 3, 2, 1, 'lorem ipsum dolor sit amet', '2023-07-04 20:24:43'),
(14, '2000', 3, 15, 0, 'Lorem ipsum dolor sit amet', '2023-07-05 04:44:10'),
(15, '455', 3, 2, 1, 'lorem ipsum dolor sit', '2023-07-05 04:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `payment_options`
--

CREATE TABLE `payment_options` (
  `Id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_options`
--

INSERT INTO `payment_options` (`Id`, `name`) VALUES
(1, 'Cash'),
(2, 'Checks'),
(3, 'Debit cards'),
(17, 'Mobile');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `paymentrelation` (`payment_type_id`),
  ADD KEY `currencyrelation` (`currency_id`);

--
-- Indexes for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `currencyrelation` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`Id`),
  ADD CONSTRAINT `paymentrelation` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_options` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
