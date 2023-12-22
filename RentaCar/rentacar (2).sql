-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Gegenereerd op: 22 dec 2023 om 22:46
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
  `VehicleType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`CarID`, `Brand`, `Model`, `Year`, `LicensePlate`, `Availability`, `Image`, `PricePerMonth`, `VehicleType`) VALUES
(2, 'porche', '4', 4, '23', 1, '../assets/img/657ac5c6a26b4_porsche.png', 0.00, ''),
(3, 'porche', '4', 4, '23', 1, '../assets/img/657ac5e982ca5_porsche.png', 0.00, ''),
(4, 'porche', '5', 34, '324324', 1, '../assets/img/657ac5f3e64e5_porsche.png', 0.00, ''),
(5, 'porche', '7', 2, '123123', 1, '../assets/img/657ac608b1a01_porsche.png', 0.00, ''),
(6, 'porche', '7', 2, '123123', 1, '../assets/img/657ac71484f9b_porsche.png', 0.00, ''),
(7, 'asdsad', '5', 2, 'qweqwe', 0, '../assets/img/657c267ada998_657ac71484f9b_porsche.png', 0.00, ''),
(8, 'asdsad', '5', 2, 'qweqwe', 0, '../assets/img/657c267aee982_657ac71484f9b_porsche.png', 0.00, ''),
(9, 'porche', '2333', 2007, '324324', 0, '../assets/img/657c2691d7935_657ac5c6a26b4_porsche.png', 0.00, ''),
(10, 'porche', '5', 2013, 'XorSMD', 1, '../assets/img/657c27ec20121_657ac5c6a26b4_porsche.png', 250.00, 'Electric');

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
(29, 'dino angel', 'angel', '', '', '', '2165302@talnet.nl', '$2y$10$c/rYic5GJaydJ99iZN59L.FMtPyjDNygpejejvQWKyJJJki1BShGa', NULL, 0),
(30, 'ad', 'ad', '', '', '', 'jamesberca091@gmail.com', '$2y$10$GpsuAuGqBUFH5H8L2Hbfs.P.rV9Vq/MQB7tfANe9.s1Vih0H4J5Dm', NULL, 0),
(32, 'ad', 'ad', '', '', '', 'ebukavy@hotmail.com', '$2y$10$8k.Ij7QXCaAGEFXQbkr7re3kKoYSbG0S78Ya1REgQI9Ja5xWkHhGi', NULL, 0),
(33, 'ad', 'ad', '', '', '', 'aasd@gmail.com', '$2y$10$x7chHC1BLPKQrT0Z/c26supGXYSWRn8TX4woM3zgJ2o0cyYnlViua', NULL, 0),
(34, 'ad', 'ad', '', '', '', 'dejahmarshall031@gmail.com', '$2y$10$.NOR9cvCE.OyG1g/YDSjmuvl.1oOo9V9SPoiD/QZOGJvFp6BfgiZm', NULL, 0),
(35, 'dino ', 'angel', '', '', '', 'dejahmarshall01@gmail.com', '$2y$10$09dOg9C0MqC1xx30Unr38.PNihP44gjAxM6.267z7z.3tqKCNDU2i', NULL, 0),
(38, 'dino angel', 'an', '', '', '', 'dejahmarshall02@gmail.com', '$2y$10$od6YIus83sxG8kgMkYR9vOtSW8f3smbnYQOMDGY6zTWus28BK78z6', NULL, 0),
(39, 'ad', 'ad', '', '', '', 'dejahmarshall0244@gmail.com', '$2y$10$yd.uHJlupGBClIwvw3OUWu.3wg5dnMYVt/iS7TzMmmdcOjRlJZ79.', NULL, 0),
(40, 'way2', 'devious', '', '', '', 'dejahmarshall0133@gmail.com33', '$2y$10$bwbysNgacISLlfqYhkJ2OuNl/Pc.9UJoO94G2lrpSHyNnzmwcxGP.', NULL, 0);

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
  `RentperiodDays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rentals`
--

INSERT INTO `rentals` (`RentalID`, `StartDate`, `CustomerID`, `CarID`, `EndDate`, `Cost`, `EmployeeID`, `PickUpLocation`, `RentperiodDays`) VALUES
(1, '2023-12-10', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(2, '2023-12-10', NULL, 2, '2023-12-30', 0.00, NULL, '', ''),
(3, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(4, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(5, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(6, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(7, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(8, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(9, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(10, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(11, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(12, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(13, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(14, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(15, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(16, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(17, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(18, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(19, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(20, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(21, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(22, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(23, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(24, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(25, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(26, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(27, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(28, '2023-12-03', NULL, 2, '2023-12-31', 0.00, NULL, '', ''),
(29, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(30, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(31, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(32, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(33, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(34, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(35, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(36, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(37, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(38, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(39, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(40, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(41, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(42, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(43, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(44, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(45, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(46, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(47, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(48, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', ''),
(49, '2023-12-02', NULL, 10, '2023-12-31', 0.00, NULL, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tempdata`
--

CREATE TABLE `tempdata` (
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `CarId` int(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Customer','Employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

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
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT voor een tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `RentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
