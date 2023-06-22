-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 06:59 AM
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
-- Database: `bdcmsdb`
--
CREATE DATABASE IF NOT EXISTS `bdcmsdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdcmsdb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password'),
(4, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_tb`
--

DROP TABLE IF EXISTS `history_tb`;
CREATE TABLE `history_tb` (
  `history_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_details` text DEFAULT NULL,
  `appointment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_tb`
--

DROP TABLE IF EXISTS `patient_tb`;
CREATE TABLE `patient_tb` (
  `patient_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_tb`
--

INSERT INTO `patient_tb` (`patient_id`, `firstName`, `middleName`, `lastName`, `birthdate`, `address`, `phone`, `email`, `password`) VALUES
(1, 'John Llenard', 'Prestado', 'Nagal', '2002-05-29', 'Tagbong Pili Camarines sur', '09222555100', 'nagaljohnllenard@gmail.com', 'john'),
(23, 'John Llenard', 'Prestado', 'Nagal', '2002-05-29', 'Tagbong', '09222555100', 'jonagal@my.cspc.edu.ph', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `requests_tb`
--

DROP TABLE IF EXISTS `requests_tb`;
CREATE TABLE `requests_tb` (
  `request_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_tb`
--

INSERT INTO `requests_tb` (`request_id`, `patient_id`, `service_id`, `firstName`, `middleName`, `lastName`, `address`, `email`, `phone`, `appointment_date`, `status`) VALUES
(1, 1, 1, 'Jayson', '', 'Alamo', 'Balatan', 'jay@gmail.com', '09518961446', '2023-06-21 08:58:00', 'Pending'),
(2, 1, 2, 'Brent', '', 'Alcoba', 'Sta. Cruz', 'brent1213@gmail.com', '09123568921', '2023-06-21 21:54:00', 'Pending'),
(3, 1, 3, 'Juan', '', 'Juan', 'Balatan', 'juan123@gmail.com', '09501657896', '2023-06-21 14:56:00', 'Pending'),
(4, 1, 4, 'charm', '', 'obero', 'lapsi', 'charm123@gmail.com', '09785961464', '2023-06-21 16:38:00', 'Pending'),
(5, 1, 4, 'Dominic', '', 'Bañaria', 'San Juan, Baao, Cam. Sur', 'dominicbanaria28@gmail.com', '09518971564', '2023-06-21 00:55:00', 'Pending'),
(6, 1, 1, 'john llenard', 'prestado', 'nagal', 'tagbong', 'nagaljohnllenard@gmail.com', '09567201068', '2023-06-23 12:00:00', 'Pending'),
(7, 23, 1, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong', 'jonagal@my.cspc.edu.ph', '09222555100', '2023-06-23 12:00:00', 'Pending'),
(8, 23, 1, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong', 'jonagal@my.cspc.edu.ph', '09222555100', '2023-06-23 12:00:00', 'Pending'),
(9, 23, 1, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong', 'jonagal@my.cspc.edu.ph', '09222555100', '2023-06-23 14:00:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `services_tb`
--

DROP TABLE IF EXISTS `services_tb`;
CREATE TABLE `services_tb` (
  `service_id` int(100) NOT NULL,
  `service_name` varchar(50) DEFAULT NULL,
  `service_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_tb`
--

INSERT INTO `services_tb` (`service_id`, `service_name`, `service_price`) VALUES
(1, 'Tooth Extraction', 250.00),
(2, 'Teeth Cleaning', 300.00),
(3, 'Cavity Fillings', 500.00),
(4, 'Dental Examination/Check Up', 150.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_tb`
--
ALTER TABLE `history_tb`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `patient_tb`
--
ALTER TABLE `patient_tb`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `requests_tb`
--
ALTER TABLE `requests_tb`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `services_tb`
--
ALTER TABLE `services_tb`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history_tb`
--
ALTER TABLE `history_tb`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_tb`
--
ALTER TABLE `patient_tb`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `requests_tb`
--
ALTER TABLE `requests_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services_tb`
--
ALTER TABLE `services_tb`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
