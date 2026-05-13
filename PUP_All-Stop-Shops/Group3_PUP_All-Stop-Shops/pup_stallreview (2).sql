-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2026 at 07:43 PM
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
-- Database: `pup_stallreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(50) DEFAULT NULL,
  `AdminEmail` varchar(50) DEFAULT NULL,
  `AdminPassword` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `AdminEmail`, `AdminPassword`) VALUES
(1, 'Apor', 'Apor@email.com', 'admin123'),
(2, 'Dustin', 'Dustin@email.com', 'admin321'),
(3, 'Carlos', 'Carlos@email.com', 'admin789'),
(4, 'Oasan', 'Oasan@email.com', 'admin321'),
(5, 'Mirabel', 'Mirabel@email.com', 'admin654');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(50) DEFAULT NULL,
  `ProductPrice` decimal(10,2) DEFAULT NULL,
  `VendorStallID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(64) DEFAULT NULL,
  `UserPass` varchar(64) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserID`, `UserName`, `UserPass`, `UserEmail`) VALUES
(1, 'Josh', 'pass1234', 'Josh@email.com'),
(2, 'Bob Jones', 'pass123', 'bob@example.com'),
(3, 'Charlie Brown', 'pass123', 'charlie@example.com'),
(4, 'Diana Prince', 'pass123', 'diana@example.com'),
(5, 'Evan Wright', 'pass123', 'evan@example.com'),
(6, 'Fiona Gallagher', 'pass123', 'fiona@example.com'),
(7, 'George Miller', 'pass123', 'george@example.com'),
(8, 'Hannah Abbott', 'pass123', 'hannah@example.com'),
(9, 'Ian Malcolm', 'pass123', 'ian@example.com'),
(10, 'Jane Doe', 'pass123', 'jane@example.com'),
(11, 'Alice Smith', 'pass123', 'alice@example.com'),
(12, 'Bob Jones', 'pass123', 'bob@example.com'),
(13, 'Charlie Brown', 'pass123', 'charlie@example.com'),
(14, 'Diana Prince', 'pass123', 'diana@example.com'),
(15, 'Evan Wright', 'pass123', 'evan@example.com'),
(16, 'Fiona Gallagher', 'pass123', 'fiona@example.com'),
(17, 'George Miller', 'pass123', 'george@example.com'),
(18, 'Hannah Abbott', 'pass123', 'hannah@example.com'),
(19, 'Ian Malcolm', 'pass123', 'ian@example.com'),
(20, 'Jane Doe', 'pass123', 'jane@example.com'),
(21, 'Alice Smith', 'pass123', 'alice@example.com'),
(22, 'Bob Jones', 'pass123', 'bob@example.com'),
(23, 'Charlie Brown', 'pass123', 'charlie@example.com'),
(24, 'Diana Prince', 'pass123', 'diana@example.com'),
(25, 'Evan Wright', 'pass123', 'evan@example.com'),
(26, 'Fiona Gallagher', 'pass123', 'fiona@example.com'),
(27, 'George Miller', 'pass123', 'george@example.com'),
(28, 'Hannah Abbott', 'pass123', 'hannah@example.com'),
(29, 'Ian Malcolm', 'pass123', 'ian@example.com'),
(30, 'Jane Doe', 'pass123', 'jane@example.com'),
(31, 'John Marcos', 'Marcos123', 'Marcos@gmail.com'),
(32, 'John Aaron ', 'aaron123', 'Aaron@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendorStallID` int(11) NOT NULL,
  `VendorName` varchar(50) DEFAULT NULL,
  `VendorEmail` varchar(50) DEFAULT NULL,
  `VendorPassword` varchar(50) NOT NULL,
  `Stall_Name` varchar(255) DEFAULT NULL,
  `Category` varchar(255) NOT NULL,
  `Stall_Photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendorStallID`, `VendorName`, `VendorEmail`, `VendorPassword`, `Stall_Name`, `Category`, `Stall_Photo`) VALUES
(1, 'NewVendorName', 'newvendor@example.com', 'NewVendorPassword', NULL, '', ''),
(2, 'NewVendorName', 'newvendor@example.com', 'NewVendorPassword', NULL, '', ''),
(3, 'Kape Express', 'info@kapeexpress.com', 'vendorpass3', NULL, '', ''),
(4, 'Sweet Treats', 'sales@sweettreats.com', 'vendorpass4', NULL, '', ''),
(5, 'The Sizzling Plate', 'order@sizzlingplate.com', 'vendorpass5', NULL, '', ''),
(6, 'Healthy Greens', 'hello@healthygreens.com', 'vendorpass6', NULL, '', ''),
(7, 'Burger Corner', 'admin@burgercorner.com', 'vendorpass7', NULL, '', ''),
(8, 'Noodle House', 'contact@noodlehouse.com', 'vendorpass8', NULL, '', ''),
(9, 'Fruit Stand 101', 'info@fruitstand101.com', 'vendorpass9', NULL, '', ''),
(10, 'BBQ Master', 'sales@bbqmaster.com', 'vendorpass10', NULL, '', ''),
(11, 'Printan Ni Man Bento1', 'BentoPrint@gmail.com', 'Bento123', 'Printan Ni Man Bento1', 'Service', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `VendorStallID` (`VendorStallID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VendorStallID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VendorStallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`VendorStallID`) REFERENCES `vendors` (`VendorStallID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
