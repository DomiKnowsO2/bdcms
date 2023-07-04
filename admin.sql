-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 05:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
(1, 'admin', 'admin', 'Dominic Bañaria', 'https://scontent.fmnl26-1.fna.fbcdn.net/v/t39.30808-6/320521404_565065432100842_5358095008287230586_n.jpg?_nc_cat=100&cb=99be929b-59f725be&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFM3Io6Sm8L-RmhWf259URrhU92RFqbhLGFT3ZEWpuEsan290F18TyGfdGbfrI0vz6YH6aOZ3VMv2RQ0q-onOku&_nc_ohc=Kc8wBc6VakgAX-V6qPj&_nc_zt=23&_nc_ht=scontent.fmnl26-1.fna&oh=00_AfDyKqB4zzWcwPU_fd7EJg0xsiVL6mUHvkE0gBpMrFwD0A&oe=64A2D3D8'),
(2, 'admin', 'jayson', 'Jayson Ani Alamo', 'https://scontent.fmnl26-2.fna.fbcdn.net/v/t39.30808-1/352743983_646894333536212_117214995778575484_n.jpg?stp=dst-jpg_s320x320&_nc_cat=111&cb=99be929b-59f725be&ccb=1-7&_nc_sid=7206a8&_nc_eui2=AeEI3A--cvx6pkS6Gh35KSFQ_4JLIRf05_D_gkshF_Tn8Nh7HjY440yDs9vWE8PRMP9NQVpBxhhO8Q1oWxePnfCC&_nc_ohc=4OYwWacckW4AX919r92&_nc_ht=scontent.fmnl26-2.fna&oh=00_AfBQRTBunqCG8EYGFU-q-ItKuDzZpF0QFCtlW4U3mPIXHg&oe=649BC92C'),
(3, 'john', 'john', 'John Llenard Nagal', 'https://scontent.fmnl26-1.fna.fbcdn.net/v/t39.30808-6/254245895_607397313736815_7944426749009364327_n.jpg?_nc_cat=108&cb=99be929b-59f725be&ccb=1-7&_nc_sid=174925&_nc_eui2=AeFHglVTHqbkdbHH5s3jPZSK0ty_5yIVJlXS3L_nIhUmVcMWMrSV7T3vx2bnxkPVXUqZOyrv06z9uuC1iex4_bA4&_nc_ohc=7gX_-tWvwgsAX8Faarz&_nc_zt=23&_nc_ht=scontent.fmnl26-1.fna&oh=00_AfAl6NR62PLi6ckN5j4eP7xIfppIM2RDdQzCbhqi2md-QQ&oe=64A18861');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
