-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 05:54 AM
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

--
-- Dumping data for table `history_tb`
--

INSERT INTO `history_tb` (`history_id`, `patient_id`, `service_id`, `service_details`, `appointment_date`) VALUES
(14, 30, 30, 'Patient Information:\r\nFull Name: John Llenard Prestado Nagal\r\nDate of Birth: 0001-12-03\r\nContact Number: 0909090909\r\n\r\nProcedure Information:\r\nProcedure Name: Dental Examination/Check Up\r\nDate of Procedure: June-23-2023 12:00am\r\nDentist: Dr. Ricardo P. Enciso\r\n\r\nPost-Operative Care Instructions:\r\n____________________________\r\nVital Signs and Observations:\r\n____________________________\r\nComments for the Doctor:\r\n____________________________\r\nTotal Payment: ₱150.00\r\n\r\nFollow-Up Appointment:\r\nDate: _________________________________\r\nTime: _________________________________\r\n        ', '2023-06-23 00:00:00'),
(15, 31, 31, 'Patient Information:\r\nFull Name: Ricardo  Prestado Enciso\r\nDate of Birth: 0001-01-02\r\nContact Number: 0909090909\r\n\r\nProcedure Information:\r\nProcedure Name: Dental Examination/Check Up\r\nDate of Procedure: June-23-2023 12:00am\r\nDentist: Dr. Ricardo P. Enciso\r\n\r\nPost-Operative Care Instructions:\r\n____________________________\r\nVital Signs and Observations:\r\ndead\r\nComments for the Doctor:\r\ndid not survive the operation\r\nTotal Payment: ₱150.00\r\n\r\nFollow-Up Appointment:\r\nDate: _________________________________\r\nTime: _________________________________\r\n        ', '2023-06-23 00:00:00'),
(16, 32, 32, 'Patient Information:\r\nFull Name: John Llenard Prestado Nagal\r\nDate of Birth: 2023-06-24\r\nContact Number: 0909090909\r\n\r\nProcedure Information:\r\nProcedure Name: Dental Examination/Check Up\r\nDate of Procedure: June-23-2023 12:00am\r\nDentist: Dr. Ricardo P. Enciso\r\n\r\nPost-Operative Care Instructions:\r\n____________________________\r\n\r\nVital Signs and Observations:\r\nhahahahah gadan na\r\n\r\nComments for the Doctor:\r\n____________________________\r\n\r\nTotal Payment: ₱150.00\r\n\r\nFollow-Up Appointment:\r\nDate: _________________________________\r\nTime: _________________________________\r\n        ', '2023-06-23 00:00:00');

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
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_tb`
--

INSERT INTO `patient_tb` (`patient_id`, `firstName`, `middleName`, `lastName`, `birthdate`, `address`, `phone`, `email`, `password`) VALUES
(1, 'John Llenard', 'Prestado', 'Nagal', '2002-05-29', 'Tagbong Pili Camarines sur', '09222555100', 'nagaljohnllenard@gmail.com', 'john'),
(32, 'John Llenard', 'Prestado', 'Nagal', '2023-06-24', 'Tagbong', '0909090909', NULL, '');

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
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_tb`
--

INSERT INTO `requests_tb` (`request_id`, `patient_id`, `service_id`, `firstName`, `middleName`, `lastName`, `address`, `email`, `phone`, `appointment_date`, `status`) VALUES
(13, 30, 4, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong', NULL, '0909090909', '2023-06-23 00:00:00', 'Done'),
(14, 31, 4, 'Ricardo ', 'Prestado', 'Enciso', 'Tagbong', NULL, '0909090909', '2023-06-23 00:00:00', 'Done'),
(15, 32, 4, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong', NULL, '0909090909', '2023-06-23 00:00:00', 'Done'),
(16, 1, 3, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong Pili Camarines sur', 'nagaljohnllenard@gmail.com', '09222555100', '2023-06-24 12:00:00', 'Approve');

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
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient_tb`
--
ALTER TABLE `patient_tb`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `requests_tb`
--
ALTER TABLE `requests_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services_tb`
--
ALTER TABLE `services_tb`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
