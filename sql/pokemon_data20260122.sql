-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2026 at 02:23 PM
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
  `name` varchar(50) NOT NULL,
  `pokemonNumber` varchar(4) NOT NULL,
  `type` varchar(50) NOT NULL,
  `weakAgainst` varchar(255) DEFAULT NULL,
  `generation` varchar(50) NOT NULL,
  `evolvesInto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pokedex`
--

INSERT INTO `pokedex` (`name`, `pokemonNumber`, `type`, `weakAgainst`, `generation`, `evolvesInto`) VALUES
('Charmander', '0004', 'Fire', 'Water, Ground, Rock', 'Gen 1', 'Charmeleon'),
('Lugia', '0249', 'Psychic, Flying', 'Electric, Ice, Rock, Ghost, Dark', 'Gen 2', 'No Evolution'),
('Rayquaza', '0384', 'Dragon, Flying', 'Ice, Rock, Dragon, Fairy', 'Gen 3', 'No Evolution'),
('Marill', '0183', 'Water, Fairy', 'Grass, Electric, Poison', 'Gen 2', 'Azumarill'),
('Koffing', '0109', 'Poison', 'Ground, Psychic', 'Gen 1', 'Weezing');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
