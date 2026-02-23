-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2026 at 12:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokemon_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `userID` int(4) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `failed_attempts` int(4) DEFAULT NULL,
  `last_failed_login` datetime DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`userID`, `userName`, `password`, `emailAddress`, `failed_attempts`, `last_failed_login`, `role`) VALUES
(3, 'BNaugs321', '$2y$10$LtACTvBkK9u9g1gaINlm/.Oupt3HpQergbN2I7K7K5YojNYTc2/L6', 'Bfake@fake.com', 0, NULL, 'admin'),
(4, 'RickGrimes321', '$2y$10$y/NvdT6kHMcGWwOXOyUAJ.CsTlPFvQ2spBb.l4HrpP9BQY3HQifEW', 'RGrimes@TWD.com', 0, NULL, 'user'),
(5, 'Cmander89', '$2y$10$0b3sth1VgtqOe5QzhDe.UevaiU0p2i4ihQmt6PJub1uBCH1GPlZ/i', 'Fakeest@notfake.com', NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
