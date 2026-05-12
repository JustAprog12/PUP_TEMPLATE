-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2026 at 04:18 PM
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
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_name` varchar(100) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `stall_photo` longblob NOT NULL,
  `VendorPassword` varchar(255) NOT NULL,
  `stall_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_name`, `owner_email`, `category`, `stall_photo`, `VendorPassword`, `stall_ID`) VALUES
('Sisigan Ni Man Bento', 'Test@email.com', 'Food', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067, '$2y$10$OOkKMV3Y8b2tlEwNZbRDdeDgmUHkkYdRq9wleYVqXnbm1O07uhtyS', 1),
('Test', 'Test@email.com', 'Vanity', '', '$2y$10$W.5.0Rb/9anegSjonOuT3O5Ctlgr8BbL3PFgK5c3JZ/USMPO7SqrW', 2),
('MangkanorCubes', 'cubes@email.com', 'Food', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067, '$2y$10$87SijvwlalPKm1T6goOABuzEgA/B9SjB/SKSzLialR3PB3deBSeIO', 3),
('adasdada', 'test2@email.com', 'Food', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067, '$2y$10$fpzaz3l/kDmAoh85iUj4nOeDdhJvowZQOCm9mIv8ZdLKwCYLfVNUy', 4),
('Test2', 'test2@email.com', 'Food', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067, '$2y$10$lD3Q/jW3dTdfSaoJ5PRR6O6OrrI/97rojff9KZGxtWX.d.KxubA.K', 5),
('Test2', 'test2@email.com', 'Food', 0x7468616e6b732d666f722d7761746368696e672d746578742d667265652d766563746f722e6a7067, '$2y$10$7IRb./rcfyXEi.9G7o0.WOVWPBqAtJWzjkfj8ICgdHlHjruQO7epu', 6);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(64) DEFAULT NULL,
  `UserPass` varchar(64) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `StudentID` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserID`, `UserName`, `UserPass`, `UserEmail`, `StudentID`) VALUES
(1, 'Josh', 'pass1234', 'Josh@email.com', NULL),
(2, 'Bob Jones', 'pass123', 'bob@example.com', NULL),
(3, 'Charlie Brown', 'pass123', 'charlie@example.com', NULL),
(4, 'Diana Prince', 'pass123', 'diana@example.com', NULL),
(5, 'Evan Wright', 'pass123', 'evan@example.com', NULL),
(6, 'Fiona Gallagher', 'pass123', 'fiona@example.com', NULL),
(7, 'George Miller', 'pass123', 'george@example.com', NULL),
(8, 'Hannah Abbott', 'pass123', 'hannah@example.com', NULL),
(9, 'Ian Malcolm', 'pass123', 'ian@example.com', NULL),
(10, 'Jane Doe', 'pass123', 'jane@example.com', NULL),
(11, 'Alice Smith', 'pass123', 'alice@example.com', NULL),
(12, 'Bob Jones', 'pass123', 'bob@example.com', NULL),
(13, 'Charlie Brown', 'pass123', 'charlie@example.com', NULL),
(14, 'Diana Prince', 'pass123', 'diana@example.com', NULL),
(15, 'Evan Wright', 'pass123', 'evan@example.com', NULL),
(16, 'Fiona Gallagher', 'pass123', 'fiona@example.com', NULL),
(17, 'George Miller', 'pass123', 'george@example.com', NULL),
(18, 'Hannah Abbott', 'pass123', 'hannah@example.com', NULL),
(19, 'Ian Malcolm', 'pass123', 'ian@example.com', NULL),
(20, 'Jane Doe', 'pass123', 'jane@example.com', NULL),
(21, 'Alice Smith', 'pass123', 'alice@example.com', NULL),
(22, 'Bob Jones', 'pass123', 'bob@example.com', NULL),
(23, 'Charlie Brown', 'pass123', 'charlie@example.com', NULL),
(24, 'Diana Prince', 'pass123', 'diana@example.com', NULL),
(25, 'Evan Wright', 'pass123', 'evan@example.com', NULL),
(26, 'Fiona Gallagher', 'pass123', 'fiona@example.com', NULL),
(27, 'George Miller', 'pass123', 'george@example.com', NULL),
(28, 'Hannah Abbott', 'pass123', 'hannah@example.com', NULL),
(29, 'Ian Malcolm', 'pass123', 'ian@example.com', NULL),
(30, 'Jane Doe', 'pass123', 'jane@example.com', NULL),
(31, 'John Marcos', 'Marcos123', 'Marcos@gmail.com', '2025-09954-MN-0'),
(32, 'John Aaron ', 'aaron123', 'Aaron@email.com', ''),
(33, '-123131', 'pass123', 'num@email.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendorStallID` int(11) NOT NULL,
  `VendorName` varchar(50) DEFAULT NULL,
  `VendorEmail` varchar(50) DEFAULT NULL,
  `VendorPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendorStallID`, `VendorName`, `VendorEmail`, `VendorPassword`) VALUES
(1, 'NewVendorName', 'newvendor@example.com', 'NewVendorPassword'),
(2, 'NewVendorName', 'newvendor@example.com', 'NewVendorPassword'),
(3, 'Kape Express', 'info@kapeexpress.com', 'vendorpass3'),
(4, 'Sweet Treats', 'sales@sweettreats.com', 'vendorpass4'),
(5, 'The Sizzling Plate', 'order@sizzlingplate.com', 'vendorpass5'),
(6, 'Healthy Greens', 'hello@healthygreens.com', 'vendorpass6'),
(7, 'Burger Corner', 'admin@burgercorner.com', 'vendorpass7'),
(8, 'Noodle House', 'contact@noodlehouse.com', 'vendorpass8'),
(9, 'Fruit Stand 101', 'info@fruitstand101.com', 'vendorpass9'),
(10, 'BBQ Master', 'sales@bbqmaster.com', 'vendorpass10');

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
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_ID`);

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
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VendorStallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
