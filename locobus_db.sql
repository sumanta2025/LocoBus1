-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 06:12 AM
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
-- Database: `locobus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_table`
--

CREATE TABLE `booked_table` (
  `id` int(11) NOT NULL,
  `bookingId` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tdate` varchar(255) DEFAULT NULL,
  `bid` varchar(255) DEFAULT NULL,
  `lid` varchar(255) DEFAULT NULL,
  `qnt` varchar(255) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `status` enum('pending','rejected','collected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_table`
--

INSERT INTO `booked_table` (`id`, `bookingId`, `name`, `phone`, `email`, `tdate`, `bid`, `lid`, `qnt`, `seats`, `status`) VALUES
(25, 'LOCO671730093', 'Koushik Ghosh', '7557034298', 'ghoshkoushik928@gmail.com', '2023-05-19', '2', '1', '2', '2D,2E', 'collected');

-- --------------------------------------------------------

--
-- Table structure for table `bus_table`
--

CREATE TABLE `bus_table` (
  `id` int(11) NOT NULL,
  `bus_name` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  `btime` varchar(50) NOT NULL,
  `week` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_table`
--

INSERT INTO `bus_table` (`id`, `bus_name`, `route`, `btime`, `week`) VALUES
(1, 'Asok Bus Travel', 'Purulia - Kolkata', '05:00', 'Sun,Tue,Fri'),
(2, 'Rahul Travel', 'Asansol-Kolkata', '13:00', 'Mon,Web'),
(3, 'Rahul Travel', 'Kolkata-Asansol', '06:00', 'Tue, Thus'),
(4, 'Asok Bus Travel', 'Kolkata-Purulia', '17:00', 'Sun,Tue,Fri'),
(6, 'Puspo Bus Service', 'Asansol-Bardwan', '10:00', 'Sun');

-- --------------------------------------------------------

--
-- Table structure for table `location_table`
--

CREATE TABLE `location_table` (
  `id` int(11) NOT NULL,
  `location_name` varchar(300) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location_table`
--

INSERT INTO `location_table` (`id`, `location_name`, `price`) VALUES
(1, 'Asansol-Bardwan', 100),
(4, 'Durgapur-Bardwan', 50),
(5, 'Asansol - Durgapur', 50),
(6, 'Purulia-Asansol', 50),
(7, 'Purulia-Durgapur', 100),
(9, 'Kolkata-Durgapur', 150),
(10, 'Kolkata-Purulia', 250),
(11, 'Bardwan-Asansol', 100),
(12, 'Durgapur-Asansol', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(150) NOT NULL,
  `userid` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `utype` varchar(30) NOT NULL,
  `uref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `userid`, `password`, `utype`, `uref`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin', 'j54fxgf431b3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_table`
--
ALTER TABLE `booked_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_table`
--
ALTER TABLE `bus_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_table`
--
ALTER TABLE `location_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_table`
--
ALTER TABLE `booked_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bus_table`
--
ALTER TABLE `bus_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `location_table`
--
ALTER TABLE `location_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
