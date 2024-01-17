-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Gegenereerd op: 17 jan 2024 om 19:50
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentacar`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `hashed_password`) VALUES
(1, 'admin@admin', '$2y$10$7PRFt/i8Y3JC5/7ERboUUeihiP.XSPRTNwisuduWeGs4L1UfTz4Yi'),
(2, 'dejah@admin', '$2y$10$7PRFt/i8Y3JC5/7ERboUUeihiP.XSPRTNwisuduWeGs4L1UfTz4Yi'),
(3, 'admin@1', '$2y$10$JI0M8t.mFqr5tXmOxJV9kuZu8SBAUvSNsr7ZQr5ce.IqoWrMuMG5W'),
(4, 'admin@2', '$2y$10$3idcrRs862SJ9LXNi5N99ON3F5z5WhxAIKi8YXegJfALGfagbBk.u');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Year` int(11) NOT NULL,
  `LicensePlate` varchar(20) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `PricePerMonth` decimal(10,2) NOT NULL,
  `VehicleType` varchar(255) NOT NULL,
  `description` varchar(1800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`CarID`, `Brand`, `Model`, `Year`, `LicensePlate`, `Availability`, `Image`, `PricePerMonth`, `VehicleType`, `description`) VALUES
(24, 'Honda', 'Civic', 2021, 'XYZ789', 1, 'C:\\xampp\\htdocs\\car-rental2\\classes/../assets/img/65a2da04cf864_honda.png', 31.00, '', NULL),
(25, 'Ford', 'Mustang', 2023, 'DEF456', 1, 'C:\\xampp\\htdocs\\car-rental2\\classes/../assets/img/65a2da156f696_ford.png', 120.00, '', NULL),
(26, 'Tesla', 'Model 3', 2022, 'JKL012', 1, 'C:\\xampp\\htdocs\\car-rental2\\classes/../assets/img/65a2dadd37deb_tesla model3.png', 55.00, '', NULL),
(27, 'Chevrolet', 'Suburban', 2022, 'GHI789', 1, 'C:\\xampp\\htdocs\\car-rental2\\classes/../assets/img/65a2dafc78cda_chevrolet.png', 65.00, '', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `LicenseNumber` varchar(20) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `adress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`CustomerID`, `name`, `LastName`, `Address`, `LicenseNumber`, `PhoneNumber`, `email`, `password`, `country`, `adress`) VALUES
(34, 'biggestcaruser', 'jonathan', '', '', '', 'dejahmarshall031@gmail.com', '$2y$10$FzTScY28Jgqy8HcXIQFMF.i650etlI87TbHr5Kxpn5k/fFwVqkdKe', NULL, 0),
(35, 'dino ', 'angel', '', '', '', 'dejahmarshall01@gmail.com', '$2y$10$09dOg9C0MqC1xx30Unr38.PNihP44gjAxM6.267z7z.3tqKCNDU2i', NULL, 0),
(39, 'ad', 'ad', '', '', '', 'dejahmarshall0244@gmail.com', '$2y$10$yd.uHJlupGBClIwvw3OUWu.3wg5dnMYVt/iS7TzMmmdcOjRlJZ79.', NULL, 0),
(40, 'way2', 'devious', '', '', '', 'dejahmarshall0133@gmail.com33', '$2y$10$bwbysNgacISLlfqYhkJ2OuNl/Pc.9UJoO94G2lrpSHyNnzmwcxGP.', NULL, 0),
(41, 'dino ', 'angel', '', '', '', 'jamesberca0911@gmail.com', '$2y$10$Xkdr/ZAWkg5pcgF7wPwm3uPeulD0jNAFsSVITTqiRwnIb6Mfwobmq', NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rentals`
--

CREATE TABLE `rentals` (
  `RentalID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `EndDate` date NOT NULL,
  `Cost` decimal(10,2) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `PickUpLocation` varchar(255) NOT NULL,
  `RentperiodDays` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rentals`
--

INSERT INTO `rentals` (`RentalID`, `StartDate`, `CustomerID`, `CarID`, `EndDate`, `Cost`, `EmployeeID`, `PickUpLocation`, `RentperiodDays`, `name`, `LastName`) VALUES
(101, '2024-01-07', 35, 24, '2024-01-14', 7.13, NULL, '', '', '', ''),
(102, '2024-01-07', 35, 25, '2024-01-14', 27.62, NULL, '', '', '', ''),
(103, '2024-03-21', 35, 24, '2024-04-21', 31.59, NULL, '', '', '', ''),
(104, '2024-01-21', 35, 25, '2024-01-28', 27.62, NULL, '', '', '', ''),
(105, '2024-03-18', 35, 24, '2024-04-28', 41.79, NULL, '', '', '', ''),
(106, '2024-01-04', NULL, 24, '2024-01-06', 2.04, NULL, '', '', '', ''),
(107, '2024-01-17', NULL, 25, '2024-01-31', 55.23, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservations`
--

CREATE TABLE `reservations` (
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `ReservationID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Firstname` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reservations`
--

INSERT INTO `reservations` (`StartDate`, `EndDate`, `CarID`, `ReservationID`, `CustomerID`, `Firstname`, `LastName`) VALUES
('2024-01-21', '2024-01-21', 24, 1, NULL, '', ''),
('2024-01-27', '2024-02-03', 24, 2, NULL, '', ''),
('2024-02-18', '2024-03-03', 26, 3, NULL, '', ''),
('2024-01-01', '2024-01-03', 24, 4, NULL, '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexen voor tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`);

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexen voor tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `EmployeeID` (`EmployeeID`),
  ADD KEY `name` (`name`),
  ADD KEY `LastName` (`LastName`);

--
-- Indexen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `idx_car_id` (`CarID`),
  ADD KEY `idx_start_date_end_date` (`StartDate`,`EndDate`),
  ADD KEY `name` (`Firstname`),
  ADD KEY `LastName` (`LastName`),
  ADD KEY `Firstname` (`Firstname`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT voor een tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `RentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT voor een tabel `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Beperkingen voor tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `rentals_ibfk_3` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`);

--
-- Beperkingen voor tabel `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
