-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2026 at 06:44 AM
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
-- Table structure for table `pokedex`
--

CREATE TABLE `pokedex` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pokemonNumber` varchar(4) NOT NULL,
  `type` varchar(50) NOT NULL,
  `weakAgainst` varchar(255) DEFAULT NULL,
  `generation` varchar(50) NOT NULL,
  `evolvesInto` varchar(50) NOT NULL,
  `imageName` varchar(50) DEFAULT NULL,
  `legendaryID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pokedex`
--

INSERT INTO `pokedex` (`id`, `name`, `pokemonNumber`, `type`, `weakAgainst`, `generation`, `evolvesInto`, `imageName`, `legendaryID`) VALUES
(20, 'Mew', '0151', 'Psychic, Flying', 'Electric', 'gen 1', 'No Evolution', 'mew_100.png', 1),
(23, 'Charmander', '0004', 'Fire', 'Water', 'gen 1', 'Charmeleon', 'Charmander_100.png', 2),
(27, 'Bulbasaur', '0001', 'grass', 'fire', 'gen 1', 'Ivysaur', 'Bulbasaur_100.png', 2),
(28, 'Squirtle', '0007', 'Water', 'Electric', 'gen 1', 'Wartortle', 'Squirtle_100.png', 2),
(29, 'Lugia', '0249', 'Psychic, Flying', 'Electric, Ice, Rock, Ghost, Dark', 'Gen 2', 'No Evolution', 'Lugia_100.png', 1),
(30, 'Pikachu', '0025', 'electric', 'rock, ground', 'Gen 1', 'Raichu', 'placeholder_100.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokedex`
--
ALTER TABLE `pokedex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_legendaryID` (`legendaryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokedex`
--
ALTER TABLE `pokedex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pokedex`
--
ALTER TABLE `pokedex`
  ADD CONSTRAINT `FK_legendaryID` FOREIGN KEY (`legendaryID`) REFERENCES `Legendary_status` (`legendaryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
