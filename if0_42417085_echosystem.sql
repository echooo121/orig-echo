-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.infinityfree.com
-- Generation Time: Jul 18, 2026 at 09:34 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42417085_echosystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `user` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `target` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`user`, `user_name`, `action`, `target`, `data`, `timestamp`) VALUES
('20267791', 'john sazon', 'Changed user role', 'User Table', '20261304 set to Admin', '2026-07-14 13:37:24'),
('20267791', 'john sazon', 'Changed user role', 'User Table', '20261304 set to Buyer', '2026-07-14 13:37:25'),
('20267791', 'john sazon', 'Inserted an item', 'Item Table', 'Tote Bags (ID = 9)', '2026-07-14 13:43:17'),
('20267791', 'john sazon', 'Changed user role', 'User Table', '20261304 set to Admin', '2026-07-14 14:45:21'),
('20267791', 'john sazon', 'Changed user role', 'User Table', '20261304 set to Buyer', '2026-07-14 14:45:22'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20262000 set to Buyer', '2026-07-14 19:26:11'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20262000 set to Admin', '2026-07-14 19:26:13'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Crossbody Bags (ID = 8)', '2026-07-14 19:26:41'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20265463 set to Admin', '2026-07-14 19:28:13'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20265463 set to Buyer', '2026-07-14 19:28:18'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Crossbody Bags (ID = 8)', '2026-07-14 19:28:31'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Sling Bags (ID = 10)', '2026-07-14 20:15:40'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20267567 set to Admin', '2026-07-15 14:57:05'),
('20267567', 'Lei Caabay', 'Changed user role', 'User Table', '20267567 set to Buyer', '2026-07-15 14:57:32'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Sling Bags (ID = 10)', '2026-07-15 15:34:42'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Sling Bags (ID = 10)', '2026-07-15 15:34:57'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Tote Bags (ID = 11)', '2026-07-15 15:36:09'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Tote Bags (ID = 11)', '2026-07-15 15:36:34'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Tote Bags (ID = 12)', '2026-07-15 15:37:05'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Tote Bags (ID = 12)', '2026-07-15 15:38:14'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Tote Bags (ID = 13)', '2026-07-15 15:38:26'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Tote Bags (ID = 13)', '2026-07-15 15:39:27'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Tote Bags (ID = 14)', '2026-07-15 15:39:42'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Tote Bags (ID = 14)', '2026-07-15 15:40:12'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Sling Bags (ID = 10)', '2026-07-15 15:40:31'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20267567 set to Admin', '2026-07-15 22:20:22'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20267567 set to Buyer', '2026-07-15 22:20:27'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Crossbody Bags (ID = 8)', '2026-07-16 13:08:45'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Crossbody Bags (ID = 8)', '2026-07-16 13:09:24'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20269862 set to Buyer', '2026-07-18 02:02:54'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20269862 set to Admin', '2026-07-18 02:03:02'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20269862 set to Buyer', '2026-07-18 02:03:14'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20265463 set to Admin', '2026-07-18 12:58:20'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20265463 set to Buyer', '2026-07-18 12:58:28'),
('20262000', 'Admin Account', 'Changed user role', 'User Table', '20265463 set to Admin', '2026-07-18 12:59:56'),
('20262000', 'Admin Account', 'Inserted an item', 'Item Table', 'Crossbody Bags (ID = 15)', '2026-07-18 13:16:39'),
('20262000', 'Admin Account', 'Edited an item', 'Item Table', 'Crossbody Bags (ID = 15)', '2026-07-18 13:21:00'),
('20262000', 'Admin Account', 'Deleted an item', 'Item Table', 'Crossbody Bags (ID = 15)', '2026-07-18 13:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `category` varchar(25) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `category`, `price`, `quantity`) VALUES
(9, 'Nomad Canvas Tote', 'Tote Bags', 999, 170),
(10, 'Nomad Sling Pack', 'Sling Bags', 1299, 998);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `token` varchar(64) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `address`, `contact`, `password`, `user_type`, `date_creation`, `token`, `is_confirmed`) VALUES
(20262000, 'Admin', 'Account', 'adminaccount@gmail.com', 'none', 'none', '@dmin05', 'Admin', '0000-00-00 00:00:00', '', 1),
(20265463, 'Mark', 'Santos', 'xohoxe9213@acoxs.com', 'Antipolo City', '+639921348007', 'password', 'Admin', '2026-07-15 03:18:37', '', 1),
(20265385, 'Carl Anthony', 'Cruz', 'jirayi2222@diarshop.com', 'Marikina City', '+639087105881', 'sample', 'Buyer', '2026-07-15 06:59:39', '3f2d56f508dbe04b0a7b2b6a36b3a852f685afe5839371eeeba0cde784a74676', 0),
(20262687, 'Brent Adam', 'Jumpay', 'bexifas936@luckfeed.com', 'San Mateo Rizal', '+639953044151', 'pass123', 'Buyer', '2026-07-15 07:04:32', '0b8689a1cc5ed7cb2c0950b02c44289f36baf0e7123ad131edb0a32c4f4ab752', 0),
(20261430, 'Austin', 'Reeves', 'menivok726@luckfeed.com', 'Caloocan City', '+639187656653', '123', 'Buyer', '2026-07-15 07:06:53', '', 1),
(20265844, 'Carl Andre', 'Guia', 'menivok726@luckfeed.com', 'Montalban, Rizal', '+639987108872', 'pass', 'Buyer', '2026-07-15 07:13:54', '28648e04b2994fc7555a555458737dae10d2b69fece1a58ff107e4ba75ac07fa', 0),
(20261101, 'Austin James', 'Atienza', 'rorev46259@luckfeed.com', 'Montalban, Rizal', '+639987635542', '321', 'Buyer', '2026-07-15 07:19:52', '', 1),
(20263009, 'paulo', 's', 'paulosazon@yahoo.com.ph', 'none', '+639221122312', '123456789000000000000000000000', 'Buyer', '2026-07-16 06:03:05', '661720a7e211826da6ffa0d1545ee5ce34bcdf3ac30289cd13ebef15d2ccc760', 0),
(20269862, 'Allyssa Kirsten', 'Yasona', 'allyssakirsten09@gmail.com', '9 F. Cruz St. Santolan, Pasig City', '+639637895060', 'isakirsten06', 'Buyer', '2026-07-16 09:03:45', '', 1),
(20269807, 'Mike', 'Cruz', 'nakake7978@gicont.com', '855 P. Paredes Street, Sampaloc, Manila, Philippines', '+639637895060', 'mikec07', 'Buyer', '2026-07-17 15:03:14', '', 1),
(20264812, 'Ekko', 'Santos', 'ekkocruz21@gmail.com', '855 P. Paredes Street, Sampaloc, Manila, Philippines', '+639637895060', '8kko!@', 'Buyer', '2026-07-17 20:02:02', 'ed20ad8c9864b3bfabd2fa7ff0a177fbc3e16aa7ff48f3ce51ebf18c2f6957a8', 0),
(20264740, 'Ekko', 'Santos', 'ekkouser21@gmail.com', '851 Nicanor Reyes St., Sampaloc, Manila', '+639935163435', '8kko!@', 'Buyer', '2026-07-17 20:06:07', '8606b7cdda3a7ac6dc1a215fe53270589a70e6aace8823823b7ab1b028840298', 0),
(20267098, 'Adrina', 'Larinay', 'roseisamermaid@gmail.com', '12 F. Pasco, Santolan, Pasig City', '+639947349708', '@ccount', 'Buyer', '2026-07-17 20:10:00', '', 1),
(20269290, 'Carl Anthony', 'Guia', 'kamona9754@meikeya.com', 'Montalban, Rizal', '+639187656653', '456', 'Buyer', '2026-07-18 06:30:07', '1da7eb66cfb60fcf13da4ab1450b4f8831635cc4a9c9f40bed99c2758be7dcd3', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
