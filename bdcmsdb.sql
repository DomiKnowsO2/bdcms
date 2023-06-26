-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 06:27 AM
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
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `link`) VALUES
(1, 'admin', 'admin', 'Dominic Bañaria', 'https://scontent.fmnl26-1.fna.fbcdn.net/v/t39.30808-1/320521404_565065432100842_5358095008287230586_n.jpg?stp=dst-jpg_p320x320&_nc_cat=100&cb=99be929b-59f725be&ccb=1-7&_nc_sid=7206a8&_nc_eui2=AeFM3Io6Sm8L-RmhWf259URrhU92RFqbhLGFT3ZEWpuEsan290F18TyGfdGbfrI0vz6YH6aOZ3VMv2RQ0q-onOku&_nc_ohc=R-L3IG074XkAX9J5p9S&_nc_ht=scontent.fmnl26-1.fna&oh=00_AfAIGfKz0FqVFtwTvpf2vwNq3TLSFwj-Er0KxutW966t7Q&oe=649A56D2'),
(2, 'admin', 'jayson', 'Jayson Ani Alamo', 'https://scontent.fmnl26-2.fna.fbcdn.net/v/t39.30808-1/352743983_646894333536212_117214995778575484_n.jpg?stp=dst-jpg_s320x320&_nc_cat=111&cb=99be929b-59f725be&ccb=1-7&_nc_sid=7206a8&_nc_eui2=AeEI3A--cvx6pkS6Gh35KSFQ_4JLIRf05_D_gkshF_Tn8Nh7HjY440yDs9vWE8PRMP9NQVpBxhhO8Q1oWxePnfCC&_nc_ohc=4OYwWacckW4AX919r92&_nc_ht=scontent.fmnl26-2.fna&oh=00_AfBQRTBunqCG8EYGFU-q-ItKuDzZpF0QFCtlW4U3mPIXHg&oe=649BC92C');

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
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_tb`
--

INSERT INTO `patient_tb` (`patient_id`, `firstName`, `middleName`, `lastName`, `birthdate`, `address`, `phone`, `email`, `password`) VALUES
(1, 'John Llenard', 'Prestado', 'Nagal', '2002-05-29', 'Tagbong Pili Camarines sur', '09222555100', 'nagaljohnllenard@gmail.com', 'john');

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
(30, 1, 3, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong Pili Camarines sur', 'nagaljohnllenard@gmail.com', '09222555100', '2023-06-30 11:00:00', 'Pending'),
(31, 1, 3, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong Pili Camarines sur', 'nagaljohnllenard@gmail.com', '09222555100', '2023-06-29 11:00:00', 'Pending'),
(32, 1, 4, 'John Llenard', 'Prestado', 'Nagal', 'Tagbong Pili Camarines sur', 'nagaljohnllenard@gmail.com', '09222555100', '2023-06-29 17:00:00', 'Pending');

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
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient_tb`
--
ALTER TABLE `patient_tb`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `requests_tb`
--
ALTER TABLE `requests_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `services_tb`
--
ALTER TABLE `services_tb`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
