-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 01:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techclinica`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `appointment_id` int(50) NOT NULL,
  `appointment_user` varchar(100) NOT NULL,
  `appointment_email` varchar(100) NOT NULL,
  `appointment_number` int(50) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `appointment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`appointment_id`, `appointment_user`, `appointment_email`, `appointment_number`, `appointment_date`, `appointment_status`) VALUES
(36, 'Tech Clinica', 'j.hortel.482069@umindanao.edu.ph', 965445665, '2024-07-20 13:20:00', 'Approved!'),
(37, 'juan Dela Cruz', 'horteljoahnie@gmail.com', 2147483647, '2024-07-28 21:20:00', 'Declined'),
(38, 'Nightcrows', 'Joahhortel31@gmail.com', 2147483647, '2024-07-31 23:22:00', 'Declined'),
(39, 'Nightcrows', 'Joahhortel31@gmail.com', 2147483647, '2024-07-18 22:22:00', 'Waiting for approval'),
(40, 'Nightcrows', 'horteljoahnie@gmail.com', 986526322, '2024-07-28 12:25:00', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(10) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `time_approved` datetime NOT NULL,
  `appoint_status` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `reference_number`, `time_approved`, `appoint_status`, `admin_name`) VALUES
(24, '02391514967197115075', '2024-07-18 13:18:20', 'Approved!', 'eldrick Pingal'),
(25, '99379160493067747009', '2024-07-18 13:18:30', 'Declined', 'James Loayon'),
(26, '21508438316833111007', '2024-07-18 13:18:37', 'Declined', 'Joahnie Hortel'),
(27, '48723202315681181455', '2024-07-18 13:39:32', 'Declined', 'eldrick Pingal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `password`, `role`) VALUES
(11, 'eldrick Pingal', 'Admin1', 'Iqrwf1', 'admin'),
(12, 'James Loayon', 'Admin2', 'Iqrwf2', 'admin'),
(13, 'Joahnie Hortel', 'Admin3', 'Iqrwf3', 'admin'),
(14, 'juan Dela Cruz', 'juandelacruz12345', 'Rhfbvinipwir12345', 'patient'),
(15, 'Joahnie hortel', 'Joahniehortel31', 'Rbfvfmgpbwhwp31', 'patient'),
(16, 'Tech Clinica', 'TechClinica123', 'BrhvUpkvvho123', 'patient'),
(17, 'Nightcrows', 'Nightcrows123', 'Vvlvlgtwjx123', 'patient'),
(18, 'juan Dela', 'JuanDela123', 'RhfbVini123', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `appointment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
