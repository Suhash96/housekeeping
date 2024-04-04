-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 12:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housekeeping`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `asset_name` varchar(100) DEFAULT NULL,
  `request_id` int(11) NOT NULL,
  `bio_id` int(11) NOT NULL,
  `asset_history` int(11) NOT NULL,
  `asset_quantity` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `requested_quantity` int(11) NOT NULL,
  `alocated_qty` int(11) NOT NULL,
  `utilised_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_name`, `request_id`, `bio_id`, `asset_history`, `asset_quantity`, `asset_id`, `requested_quantity`, `alocated_qty`, `utilised_qty`) VALUES
('mop', 0, 0, 0, 200, 1, 0, 0, 0),
('bucket', 0, 0, 0, 300, 2, 0, 0, 0),
('scrub brush', 0, 0, 0, 2, 3, 0, 0, 0),
('broom', 0, 0, 0, 200, 4, 0, 0, 0),
('toilet brush', 0, 0, 0, 300, 5, 0, 0, 0),
('dust pan', 0, 0, 0, 300, 6, 0, 0, 0),
('gloves', 0, 0, 0, 300, 7, 0, 0, 0),
('acid', 0, 0, 0, 299, 8, 0, 0, 0),
('phenol', 0, 0, 0, 300, 9, 0, 0, 0),
('vacuum', 0, 0, 0, 300, 10, 0, 0, 0),
('cell', 0, 0, 0, 300, 11, 0, 0, 0),
('kk', 0, 0, 0, 500, 13, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `asset_history`
--

CREATE TABLE `asset_history` (
  `asset_id` int(11) NOT NULL,
  `asset_name` varchar(40) NOT NULL,
  `bio_id` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `asset_quantity` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_history`
--

INSERT INTO `asset_history` (`asset_id`, `asset_name`, `bio_id`, `firstName`, `asset_quantity`, `date`) VALUES
(1, 'bucket', 192011035, 'sony', 20, '2023-09-23'),
(2, 'bucket', 192011035, 'sony', 10, '2023-09-23'),
(3, 'broom', 192011114, 'karan', 20, '2023-09-23'),
(4, 'broom', 192011114, 'karan', 10, '2023-09-23'),
(11, 'phone', 192011114, 'karan', 200, '2023-09-26'),
(11, 'phone', 192011026, 'mokshu', 50, '2023-09-28'),
(1, 'mop', 192011026, 'mokshu', 100, '2023-09-28'),
(1, 'mop', 192011028, 'uday', 200, '2023-09-28'),
(1, 'mop', 192011035, 'sony', 10, '2023-10-28'),
(3, 'scrub brush', 192011114, 'karan', 100, '2023-10-28'),
(12, 'mop', 192011035, 'sony', 300, '2023-11-17'),
(11, 'mop', 192011035, 'sony', 500, '2023-11-17'),
(10, 'vacuum', 192011035, 'sony', 100, '2023-11-17'),
(1, 'mop', 192011035, 'sony', 200, '2023-11-17'),
(1, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(2, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(3, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(4, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(5, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(6, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(7, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(8, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(9, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(10, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(11, 'cell', 192011035, 'sony', 1, '2023-11-17'),
(4, 'mop', 192011035, 'sony', 100, '2023-12-11'),
(1, 'mop', 192011035, 'sony', 10, '2023-12-11'),
(3, 'scrub brush', 192011250, 'raju', 200, '2024-02-19'),
(1, 'mop', 192011250, 'raju', 290, '2024-03-19'),
(3, 'acid', 192011250, 'raju', 22, '2024-04-02'),
(8, 'acid', 192011250, 'raju', 1, '2024-04-02'),
(3, 'scrub brush', 192011250, 'raju', 76, '2024-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `buildingname` varchar(20) NOT NULL,
  `building_id` int(11) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `room_type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingname`, `building_id`, `floor_no`, `room_no`, `room_type`) VALUES
('sse', 0, 1, 1, 'class room'),
('sse', 1, 1, 3, 'class room'),
('sse', 1, 1, 4, 'class room'),
('sse', 1, 1, 5, 'class room'),
('sse', 1, 1, 6, 'class room'),
('sse', 1, 1, 7, 'class room'),
('sse', 1, 1, 8, 'class room'),
('sse', 1, 1, 9, 'class room'),
('sse', 1, 1, 10, 'class room'),
('sse', 1, 1, 11, 'class room'),
('sse', 1, 1, 12, 'class room'),
('sse', 1, 1, 13, 'class room'),
('sse', 1, 1, 14, 'class room'),
('sse', 1, 1, 15, 'class room'),
('sse', 1, 1, 16, 'class room'),
('sse', 1, 1, 17, 'class room'),
('sse', 1, 1, 18, 'class room'),
('sse', 1, 1, 19, 'class room'),
('sse', 1, 1, 20, 'class room'),
('sse', 1, 1, 2, 'class room'),
('sse', 1, 1, 2, 'class room'),
('sse', 1, 1, 21, 'staff room'),
('sse', 1, 1, 22, 'staff room'),
('sse', 1, 1, 0, 'restroom'),
('sse', 1, 1, 0, 'restroom'),
('sse', 1, 1, 23, 'lab'),
('sse', 1, 1, 24, 'lab'),
('sse', 1, 2, 1, 'class room'),
('sse', 1, 2, 2, 'class room'),
('sse', 1, 2, 3, 'class room'),
('sse', 1, 2, 4, 'class room'),
('sse', 1, 2, 5, 'class room'),
('sse', 1, 2, 6, 'class room'),
('sse', 1, 2, 7, 'class room'),
('sse', 1, 2, 8, 'class room'),
('sse', 1, 2, 9, 'class room'),
('sse', 1, 2, 10, 'class room'),
('sse', 1, 2, 11, 'class room'),
('sse', 1, 2, 12, 'class room'),
('sse', 1, 2, 13, 'class room'),
('sse', 1, 2, 14, 'class room'),
('sse', 1, 2, 15, 'class room'),
('sse', 1, 2, 16, 'class room'),
('sse', 1, 2, 17, 'class room'),
('sse', 1, 2, 18, 'class room'),
('sse', 1, 2, 19, 'class room'),
('sse', 1, 2, 20, 'class room'),
('sse', 1, 2, 21, 'staff room'),
('sse', 1, 2, 22, 'staff room'),
('sse', 1, 2, 23, 'lab'),
('sse', 1, 2, 24, 'lab'),
('sse', 1, 2, 0, 'restroom'),
('sse', 1, 2, 0, 'restroom'),
('sse', 1, 1, 29, 'restroom'),
('sse', 1, 3, 225, 'lab'),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 33, 0, 0, ''),
('', 33, 0, 0, ''),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 33, 2, 22, 'lab'),
('sail', 43, 2, 22, 'lab'),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('sail', 9, 2, 288, 'lab'),
('see', 0, 10, 222, ''),
('sail', 12, 2, 288, 'lab'),
('Sail IOS', 0, 1223, 2211, ''),
('iOS Saul', 0, 1122, 2211, ''),
('IIOS', 0, 12, 21, ''),
('ooS', 0, 0, 1100, ''),
('dress', 0, 0, 0, ''),
('add add', 0, 0, 0, ''),
('added', 0, 0, 151626, ''),
('cxvdvd', 0, 0, 0, ''),
('cxvdvd', 0, 0, 0, ''),
('cxvdvd', 0, 0, 0, ''),
('add', 0, 0, 0, ''),
('', 0, 0, 0, ''),
('do', 0, 0, 0, ''),
('SSE SAIL', 0, 2, 202, 'Office Room'),
('sail', 0, 2, 22, 'Office Room'),
('kids', 0, 0, 0, 'Class Room'),
('', 0, 0, 0, 'Class Room'),
('Sail', 0, 1, 0, ''),
('Sail 2', 0, 1, 109, 'Laboratory'),
('see', 0, 1, 101, 'Laboratory'),
('saw', 0, 9, 901, 'Class Room'),
('hall 4', 342, 4, 121, 'staff room');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `bio_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `floor_no` int(11) NOT NULL,
  `supervisor` varchar(40) NOT NULL,
  `assigned_classroom` varchar(50) NOT NULL,
  `assigned_classroom2` varchar(50) NOT NULL,
  `assigned_classroom3` varchar(50) NOT NULL,
  `assigned_classroom4` varchar(50) NOT NULL,
  `assigned_classroom5` varchar(50) NOT NULL,
  `assigned_classroom6` varchar(50) NOT NULL,
  `assigned_classroom7` varchar(50) NOT NULL,
  `assigned_classroom8` varchar(50) NOT NULL,
  `assigned_classroom9` varchar(50) NOT NULL,
  `user_info_id` int(11) DEFAULT NULL,
  `worker_name` varchar(234) NOT NULL,
  `image` text NOT NULL,
  `status` varchar(233) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_id`, `bio_id`, `from_date`, `to_date`, `floor_no`, `supervisor`, `assigned_classroom`, `assigned_classroom2`, `assigned_classroom3`, `assigned_classroom4`, `assigned_classroom5`, `assigned_classroom6`, `assigned_classroom7`, `assigned_classroom8`, `assigned_classroom9`, `user_info_id`, `worker_name`, `image`, `status`) VALUES
(313, 0, '2024-02-20', '2024-02-29', 1, '192011250', '', '', '', '', '', '', '', '', '', NULL, '', '', 'completed'),
(314, 0, '2024-02-19', '2024-02-21', 1, '192011250', '', '', '', '', '', '', '', '', '', NULL, '', '', 'completed'),
(315, 0, '2024-02-20', '2024-02-28', 1, '192011250', 'pattan', '', '', '', '', '', '', '', '', NULL, '', '', 'completed'),
(316, 0, '2024-03-01', '2024-03-13', 7, '192011250', 'nitiesh, wassy', '', '', '', 'roshan', '', '', '', '', NULL, '', '', ''),
(317, 0, '2024-04-02', '2024-04-03', 3, '192011250', '', '', '', '', '', '', '', '', '', NULL, '', '', ''),
(318, 0, '2024-04-03', '2024-04-18', 2, '192011250', 'karthick', '', '', '', '', '', '', '', '', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `requestasset`
--

CREATE TABLE `requestasset` (
  `asset_id` int(11) NOT NULL,
  `bio_id` int(11) NOT NULL,
  `request_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestasset`
--

INSERT INTO `requestasset` (`asset_id`, `bio_id`, `request_quantity`) VALUES
(4, 192011250, 2);

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_jobs`
--

CREATE TABLE `scheduled_jobs` (
  `classroom` varchar(32) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduled_jobs`
--

INSERT INTO `scheduled_jobs` (`classroom`, `job_id`) VALUES
('', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `bio_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qualification` varchar(30) DEFAULT NULL,
  `Designation` varchar(20) NOT NULL,
  `Supervisor` text NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `busy` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`bio_id`, `firstName`, `lastName`, `email`, `qualification`, `Designation`, `Supervisor`, `contact`, `password`, `birthday`, `busy`) VALUES
(192011011, 'karthick', 'k', 'karthick@gmail.com', '10', 'student', '192011250', '1234567890', 'karthick', '2023-11-01', 1),
(192011021, 'roshan', 'r', 'roshan123@gmail.com', 'be', 'Worker', '192011250', '1234567890', 'roshan123', '2023-11-05', 1),
(192011022, 'shaym', 's', 'shyam123@gmail.com', 'be', 'Worker', '192011114', '1234567890', 'iuhawdl', '2023-11-14', 0),
(192011023, 'suresh', 's', 'suresh123@gmail.com', 'be', 'Worker', '192011114', '1234567890', 'sdf', '2023-11-06', 0),
(192011024, 'basheer', 'b', 'basheer@gmail.com', 'be', 'Worker', '192011114', '1234567890', 'sd', '2023-11-06', 0),
(192011025, 'khan', 'k', 'khan@gmail.com', 'be', 'Worker', '192011114', '1234567890', 'sd', '2023-11-14', 0),
(192011055, 'krish', 'k', 'krish123@gmail.com', 'be', 'Worker', '192011250', '1234567890', 'krish', '2023-12-05', 0),
(192011111, 'kamesh', 'b', 'kamesh123@gmail.com', 'be', 'Worker', '192011035', '1234567890', '1234566', '2023-11-22', 0),
(192011112, 'pattan', 'k', 'pattan@gmail.com', 'be', 'Worker', '192011114', '1234567899', 'pattan1', '2023-12-07', 1),
(192011250, 'raju', 's', 'raju@gmail.com', 'be', 'supervisor', '', '123455556', 'raju123', '2023-10-16', 0),
(192011251, 'suhash', 'b', 'suhash123@gmail.com', 'be', 'admin', '', '1234567899', 'suhash123', '2023-09-12', 0),
(192011252, 'jyo', 'n', 'jyo123@gmail.com', 'be', 'manager', '', '1234568789', 'jyo123', '2023-11-13', 0),
(192011263, 'rakesh', 's', 'rakesh@gmail.com', 'be', 'storekeeper', '', '123456788', 'rakesh123', '2023-09-12', 0),
(564347832, 'thahur', 'Reddy', 'tt434330@gmail.com', '12', 'Worker', '192011114', '9640482517', '5556', '2024-03-14', 0),
(963258741, 'VR Tharun', 'Reddy', 'tt434330@gmail.com', 'ss', 'Worker', '123456789', '9640482517', '123', '2024-04-03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `user_info_id` (`user_info_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`bio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `fk_user_info` FOREIGN KEY (`user_info_id`) REFERENCES `userinfo` (`bio_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
