-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 05:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '$2y$10$S6uvnuNLOIj3qNnIKjATk.XDxFEJjxZYg6upsysyGxj3hhP2tE0zC', '2025-10-06 20:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `areaName` varchar(255) NOT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDescription` longtext NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Drainage', '•	Blocked Chains\r\n•	Broken Manholes\r\n•	Sewage Pipeline Repair \r\n', '2025-09-10 14:35:29', '07-10-2025 09:40:55 AM'),
(2, 'Foothpaths', '', '2025-09-10 14:59:31', ''),
(3, 'Government buildings', '', '2025-09-10 15:00:12', ''),
(4, 'Gardens', '', '2025-09-10 15:00:30', ''),
(5, 'Public properties', '', '2025-09-10 15:01:49', ''),
(6, 'Roads', '', '2025-09-10 15:15:45', ''),
(7, 'Streetlights', '', '2025-09-10 15:16:01', ''),
(8, 'Sewage Lines', '', '2025-09-10 15:20:05', ''),
(9, 'Supply Systems', '', '2025-09-10 15:20:19', ''),
(10, 'Sanitation facilities', '', '2025-09-10 15:20:57', ''),
(11, 'Solid waste management vehicles / Equipment', '', '2025-09-10 15:21:50', ''),
(12, 'Water pipelines', '', '2025-09-10 15:22:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `cityName` varchar(255) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--

CREATE TABLE `complaintremark` (
  `id` int(11) NOT NULL,
  `complaintNumber` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `stateName` varchar(255) NOT NULL,
  `stateDescription` tinytext NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(2, 1, 'Blocked Drains 1', '2025-09-10 16:05:14', '07-10-2025 09:39:33 AM'),
(3, 1, 'Sewage Problems', '2025-09-10 16:05:29', ''),
(4, 1, 'Monsoon/Waterlogging Issues', '2025-09-10 16:05:47', ''),
(5, 1, 'Leakage & Breakage', '2025-09-10 16:06:06', ''),
(6, 1, 'Illegal connections', '2025-09-10 16:06:30', ''),
(7, 1, 'Maintenance work', '2025-09-10 16:06:44', ''),
(8, 1, 'Public Health & Safety', '2025-09-10 16:07:02', ''),
(9, 2, 'Damaged / Broken Footpaths', '2025-09-10 16:16:47', ''),
(10, 2, 'Accessibility Issues ', '2025-09-10 16:17:24', ''),
(11, 2, 'Cleanliness & Maintenance', '2025-09-10 16:17:46', ''),
(12, 2, 'Street Furniture & safety', '2025-09-10 16:18:07', ''),
(13, 2, 'New connections and Upgradation ', '2025-09-10 16:18:30', ''),
(14, 3, 'Structural Repair', '2025-09-10 16:19:30', ''),
(15, 3, 'Water Supply & Sanitation', '2025-09-10 16:20:43', ''),
(16, 3, 'Electrical & Lighting Issues', '2025-09-10 16:21:14', ''),
(17, 3, 'Cleanliness & Maintenance', '2025-09-10 16:21:36', ''),
(18, 3, 'Public Facility Repairs', '2025-09-10 16:22:35', ''),
(19, 3, 'Safety & Emergency Issues', '2025-09-10 16:22:55', ''),
(20, 3, 'Renovation & Upgradation', '2025-09-10 16:23:13', ''),
(21, 4, 'Maintenance of Lawns & Plants', '2025-09-11 05:48:15', ''),
(22, 4, 'Cleanliness Issues', '2025-09-11 05:48:36', ''),
(23, 4, 'damaged infrastructure ', '2025-09-11 05:49:23', ''),
(24, 4, 'Water supply & Irrigation ', '2025-09-11 05:50:08', ''),
(25, 4, 'Lighting & Safety ', '2025-09-11 05:50:30', ''),
(26, 4, 'Encroachments & Misuse ', '2025-09-11 05:51:15', ''),
(27, 4, 'Upgradation & Beautification ', '2025-09-11 05:51:49', ''),
(28, 5, 'Roads & Transportation Property ', '2025-09-11 05:53:14', ''),
(29, 5, 'Water & Drainage Property ', '2025-09-11 05:54:38', ''),
(30, 5, 'Street & Lighting property ', '2025-09-11 06:00:03', ''),
(31, 5, 'Garden & Recreational property ', '2025-09-11 06:00:49', ''),
(32, 5, 'Public Buildings & Utilities ', '2025-09-11 06:01:30', ''),
(33, 5, 'Markets & Shops ', '2025-09-11 06:01:50', ''),
(34, 5, 'Solid Waste & Sanitation property', '2025-09-11 06:02:46', ''),
(35, 5, 'Heritage & Civic property ', '2025-09-11 06:03:32', ''),
(36, 6, 'City roads & internal streets ', '2025-09-11 06:05:17', ''),
(37, 6, 'Main city roads ', '2025-09-11 06:05:37', ''),
(38, 6, 'Footpaths & side roads ', '2025-09-11 06:06:30', ''),
(39, 6, 'Public access roads ', '2025-09-11 06:07:11', ''),
(40, 7, 'Roadside streetlights ', '2025-09-11 06:08:44', ''),
(41, 7, 'Footpath & Public Areas Lights ', '2025-09-11 06:09:24', ''),
(42, 7, 'High - Mast & Special streetlights ', '2025-09-11 06:10:01', ''),
(43, 7, 'Streetlights in municipal  premises ', '2025-09-11 06:10:48', ''),
(44, 8, 'Underground sewage lines ', '2025-09-11 06:11:56', ''),
(45, 8, 'Sewage pumping stations & connected lines ', '2025-09-11 06:12:29', ''),
(46, 8, 'Manholes & connection lines ', '2025-09-11 06:12:57', ''),
(47, 8, 'Industrial & commercial Areas lines ', '2025-09-11 06:13:44', ''),
(48, 8, 'Slum & low-lying area sewage lines', '2025-09-11 06:14:24', ''),
(49, 9, 'Pipeline Supply Systems', '2025-09-11 06:15:20', ''),
(50, 9, 'Water Treatment & Distribution System', '2025-09-11 06:15:59', ''),
(51, 9, 'Public Water supply Points', '2025-09-11 06:16:26', ''),
(52, 9, 'Household & Local Supply Connections', '2025-09-11 06:16:51', ''),
(53, 9, 'Special Supply Systems', '2025-09-11 06:17:08', ''),
(54, 10, 'Public Toilets & Urinals', '2025-09-11 06:18:01', ''),
(55, 10, 'Community Toilets ', '2025-09-11 06:18:24', ''),
(56, 10, 'Mobile / Portable Toilet Units', '2025-09-11 06:18:53', ''),
(57, 10, 'Public Bathing / Washing Facilities ', '2025-09-11 06:19:30', ''),
(58, 10, 'Sanitation in Municipal Premises ', '2025-09-11 06:20:03', ''),
(59, 11, 'Garbage collections Vehicles ', '2025-09-11 06:21:30', ''),
(60, 11, 'Transportation Vehicles', '2025-09-11 06:21:41', ''),
(61, 11, 'Special Vehicles', '2025-09-11 06:21:52', ''),
(62, 12, 'Main Supply Pipelines', '2025-09-11 06:22:26', ''),
(63, 12, 'Distribution Pipelines', '2025-09-11 06:22:47', ''),
(64, 12, 'Service Pipelines', '2025-09-11 06:23:13', ''),
(65, 12, 'Special Pipelines', '2025-09-11 06:23:24', ''),
(66, 10, 'v1', '2025-10-07 04:28:08', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

CREATE TABLE `tblcomplaints` (
  `complaintNumber` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `complaintType` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `noc` varchar(255) NOT NULL,
  `complaintDetails` mediumtext NOT NULL,
  `complaintFile` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `lastUpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `address` tinytext DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL,
  `aadhar_card` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `complaintremark`
--
ALTER TABLE `complaintremark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD PRIMARY KEY (`complaintNumber`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `complaintremark`
--
ALTER TABLE `complaintremark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  MODIFY `complaintNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
