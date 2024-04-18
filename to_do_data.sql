-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 12:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `to_do_data`
--

CREATE TABLE `to_do_data` (
  `id` int(10) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `added_date` date NOT NULL DEFAULT current_timestamp(),
  `due_date` varchar(100) DEFAULT NULL,
  `checked` tinyint(5) NOT NULL DEFAULT 0,
  `email_id` varchar(150) DEFAULT NULL,
  `mobile_no` varchar(150) DEFAULT NULL,
  `gmail_flag` tinyint(10) NOT NULL DEFAULT 0,
  `mobile_flag` tinyint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_data`
--

INSERT INTO `to_do_data` (`id`, `title`, `added_date`, `due_date`, `checked`, `email_id`, `mobile_no`, `gmail_flag`, `mobile_flag`) VALUES
(24, 'Buy groceries', '2024-04-18', '04/21/2024', 1, NULL, NULL, 0, 0),
(25, 'Goa Trip', '2024-04-18', '04/29/2024', 0, NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_data`
--
ALTER TABLE `to_do_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `to_do_data`
--
ALTER TABLE `to_do_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
