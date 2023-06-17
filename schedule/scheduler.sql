-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 01:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `request_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `type_of_event` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `facility` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `start_datetime` date NOT NULL,
  `end_datetime` date NOT NULL,
  `arrival_time` time NOT NULL,
  `priority_level` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`, `priority_level`, `status`) VALUES
(203, 'STUDENT', 'Student', 'Meeting', 200, 'Function hall', 'ASSDA', 'kenny@gmail.com', '09123761628', '2023-01-25', '2023-01-25', '00:00:00', 0, 'Approved'),
(208, 'Sample To FDat', 'Employee', 'Meeting', 12, 'Gymnasium', 'Sample To FDat', 'sampe@gmail.com', '09009876543', '2023-01-28', '2023-01-29', '21:10:00', 1, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacilities`
--

CREATE TABLE `tblfacilities` (
  `fid` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfacilities`
--

INSERT INTO `tblfacilities` (`fid`, `fname`, `capacity`) VALUES
(1, 'Gymnasium', 5000),
(2, 'Auditorium', 500),
(3, 'Lecture hall', 300),
(4, 'Function hall', 200),
(5, 'Audio-Visual Room', 100),
(6, 'Mat Laboratory', 70);

-- --------------------------------------------------------

--
-- Table structure for table `tblrejected`
--

CREATE TABLE `tblrejected` (
  `request_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `type_of_event` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `facility` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `arrival_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority_level` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblrejected`
--

INSERT INTO `tblrejected` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`, `priority_level`, `status`) VALUES
(207, 'Sample To FDat', 'Student', 'Meeting', 12, 'Gymnasium', 'saSample To FDat', 'sample@gmail.com', '09506445138', '2023-01-28 00:00:00', '2023-01-29 00:00:00', '2023-01-29 13:00:00', 1, 'Rejected'),
(210, 'My trial', 'Guest', 'Seminar/Training/Workshop', 200, 'Gymnasium', 'Nothing lang hahah', 'n@gmail.com', '09998888888', '2023-01-28 00:00:00', '2023-01-29 00:00:00', '2023-01-29 15:22:07', 0, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tblrequests`
--

CREATE TABLE `tblrequests` (
  `request_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `type_of_event` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `facility` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `start_datetime` date NOT NULL,
  `end_datetime` date NOT NULL,
  `arrival_time` time NOT NULL DEFAULT current_timestamp(),
  `priority_level` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblrequests`
--

INSERT INTO `tblrequests` (`request_id`, `title`, `designation`, `type_of_event`, `guests`, `facility`, `description`, `email`, `phone`, `start_datetime`, `end_datetime`, `arrival_time`, `priority_level`, `status`) VALUES
(207, 'Sample To FDat', 'Student', 'Meeting', 12, 'Gymnasium', 'saSample To FDat', 'sample@gmail.com', '09506445138', '2023-01-28', '2023-01-29', '21:00:00', 1, 'Rejected'),
(208, 'Sample To FDat', 'Employee', 'Meeting', 12, 'Gymnasium', 'Sample To FDat', 'sampe@gmail.com', '09009876543', '2023-01-28', '2023-01-29', '21:10:00', 1, 'Approved'),
(210, 'My trial', 'Guest', 'Seminar/Training/Workshop', 200, 'Gymnasium', 'Nothing lang hahah', 'n@gmail.com', '09998888888', '2023-01-28', '2023-01-29', '23:22:07', 0, 'Rejected'),
(211, 'sssss', 'Guest', 'Seminar/Training/Workshop', 23, 'Gymnasium', 'sasdad', 'a@gmail.com', '09999999999', '2023-01-29', '2023-01-30', '00:40:09', 0, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tblfacilities`
--
ALTER TABLE `tblfacilities`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `tblrejected`
--
ALTER TABLE `tblrejected`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tblrequests`
--
ALTER TABLE `tblrequests`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfacilities`
--
ALTER TABLE `tblfacilities`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblrejected`
--
ALTER TABLE `tblrejected`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `tblrequests`
--
ALTER TABLE `tblrequests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
