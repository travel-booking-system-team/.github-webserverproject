-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 04:32 PM
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
-- Database: `travel_bookingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `flight_number` varchar(50) NOT NULL,
  `departure_airport` varchar(100) NOT NULL,
  `arrival_airport` varchar(100) NOT NULL,
  `departure_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `flight_number`, `departure_airport`, `arrival_airport`, `departure_date`, `arrival_date`, `price`, `available_seats`, `created_at`, `updated_at`) VALUES
(1, 'AA101', 'JFK International Airport', 'Toronto Pearson International Airport', '2025-05-01 08:00:00', '2025-05-01 10:30:00', 320.00, 150, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(2, 'DL202', 'Toronto Pearson International Airport', 'Montreal-Pierre Elliott Trudeau International Airport', '2025-05-02 11:00:00', '2025-05-02 12:30:00', 180.00, 120, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(3, 'UA303', 'Montreal-Pierre Elliott Trudeau International Airport', 'Vancouver International Airport', '2025-05-03 13:00:00', '2025-05-03 15:30:00', 220.00, 180, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(4, 'SW404', 'Vancouver International Airport', 'Calgary International Airport', '2025-05-04 07:30:00', '2025-05-04 09:00:00', 250.00, 200, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(5, 'BA505', 'Calgary International Airport', 'Ottawa Macdonald-Cartier International Airport', '2025-05-05 14:00:00', '2025-05-05 17:00:00', 210.00, 100, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(6, 'AA606', 'Los Angeles International Airport', 'Miami International Airport', '2025-05-06 09:00:00', '2025-05-06 12:30:00', 230.00, 180, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(7, 'DL707', 'Miami International Airport', 'John F. Kennedy International Airport', '2025-05-07 14:00:00', '2025-05-07 16:30:00', 280.00, 160, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(8, 'AV202', 'Mariscal Sucre International Airport', 'El Dorado International Airport', '2025-05-08 08:00:00', '2025-05-08 10:30:00', 200.00, 140, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(9, 'AV307', 'Simón Bolívar International Airport', 'El Dorado International Airport', '2025-05-09 11:00:00', '2025-05-09 13:30:00', 220.00, 130, '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(10, 'GG510', 'São Paulo–Guarulhos International Airport', 'Rio de Janeiro–Galeão International Airport', '2025-05-10 06:00:00', '2025-05-10 07:30:00', 150.00, 200, '2025-04-04 15:25:51', '2025-04-04 15:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `flight_seats`
--

CREATE TABLE `flight_seats` (
  `seat_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_seats`
--

INSERT INTO `flight_seats` (`seat_id`, `flight_id`, `seat_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(2, 1, '1B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(3, 1, '1C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(4, 1, '1D', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(5, 1, '2A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(6, 1, '2B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(7, 1, '2C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(8, 1, '2D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(9, 1, '3A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(10, 1, '3B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(11, 2, '1A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(12, 2, '1B', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(13, 2, '1C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(14, 2, '1D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(15, 2, '2A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(16, 2, '2B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(17, 2, '2C', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(18, 2, '2D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(19, 2, '3A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(20, 2, '3B', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(21, 3, '1A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(22, 3, '1B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(23, 3, '1C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(24, 3, '1D', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(25, 3, '2A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(26, 3, '2B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(27, 3, '2C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(28, 3, '2D', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(29, 3, '3A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(30, 3, '3B', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(31, 4, '1A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(32, 4, '1B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(33, 4, '1C', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(34, 4, '1D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(35, 4, '2A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(36, 4, '2B', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(37, 4, '2C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(38, 4, '2D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(39, 4, '3A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(40, 4, '3B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(41, 5, '1A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(42, 5, '1B', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(43, 5, '1C', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(44, 5, '1D', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(45, 5, '2A', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(46, 5, '2B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(47, 5, '2C', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(48, 5, '2D', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(49, 5, '3A', 'booked', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(50, 5, '3B', 'available', '2025-04-04 15:25:51', '2025-04-04 15:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `reservation_id`, `fullname`, `date_of_birth`, `passport_number`, `email`, `phone_number`, `created_at`, `updated_at`) VALUES
(6, 1, 'John Doe', '1985-06-15', 'P123456789', 'john.doe@example.com', '555-1234', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(7, 1, 'Jane Doe', '1990-11-20', 'P987654321', 'jane.doe@example.com', '555-5678', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(8, 2, 'Alice Smith', '1987-03-25', 'P123459876', 'alice.smith@example.com', '555-4321', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(9, 3, 'Bob Johnson', '1982-09-30', 'P555666777', 'bob.johnson@example.com', '555-8765', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(10, 3, 'Emily Johnson', '1992-12-10', 'P888999000', 'emily.johnson@example.com', '555-3456', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(11, 3, 'Michael Johnson', '1988-05-18', 'P112233445', 'michael.johnson@example.com', '555-6789', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(12, 4, 'Chris Brown', '1989-02-10', 'P554433221', 'chris.brown@example.com', '555-9876', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(13, 4, 'Katie Brown', '1995-07-22', 'P778899445', 'katie.brown@example.com', '555-4321', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(14, 5, 'David White', '1993-04-14', 'P445566778', 'david.white@example.com', '555-1234', '2025-04-04 15:25:51', '2025-04-04 15:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `flight_id`, `reservation_date`, `status`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-04-04 15:25:51', 'pending', 'unpaid', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(2, 1, 2, '2025-04-04 15:25:51', 'pending', 'unpaid', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(3, 2, 3, '2025-04-04 15:25:51', 'pending', 'unpaid', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(4, 3, 4, '2025-04-04 15:25:51', 'pending', 'unpaid', '2025-04-04 15:25:51', '2025-04-04 15:25:51'),
(5, 4, 5, '2025-04-04 15:25:51', 'pending', 'unpaid', '2025-04-04 15:25:51', '2025-04-04 15:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Zenha Solorzano', 'zenha.solo@example.com', '$2y$10$T0QPLdZPpkMuVdD/mU4O7e/a6OAY8QHvGZAYY3lKkQgkO3rBL05bm', '2025-04-04 15:24:41', '2025-04-04 15:24:41'),
(2, 'Diana Toala', 'diana.toala@example.com', '$2y$10$PrllnVyn1K1yQDe/9IkXKO9bysp3m2d1OcR4Z28UK6XT/HE1hENlK', '2025-04-04 15:24:41', '2025-04-04 15:24:41'),
(3, 'Jessica Narita', 'jessica.narita@example.com', '$2y$10$17y4RvNhitDIOT4PZo8HceLiwOHvBH2WtawAA5ofdegG5idpyQmo2', '2025-04-04 15:24:41', '2025-04-04 15:24:41'),
(4, 'Lucas Meira', 'lucas.meira@example.com', '$2y$10$pp6Z9EQ84ZttnJzI5BcuGuDyv/tBH.RR.lMH4eaK64O2WvS3q6hMO', '2025-04-04 15:24:41', '2025-04-04 15:24:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `flight_seats`
--
ALTER TABLE `flight_seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flight_seats`
--
ALTER TABLE `flight_seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight_seats`
--
ALTER TABLE `flight_seats`
  ADD CONSTRAINT `flight_seats_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
