-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 04:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renter_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `renter`
--

CREATE TABLE `renter` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `permanent_address` varchar(250) NOT NULL,
  `family_members` int(100) NOT NULL,
  `job_location` varchar(250) NOT NULL,
  `spouse` varchar(100) NOT NULL,
  `children` int(10) NOT NULL,
  `national_id` int(20) NOT NULL,
  `phone_1` int(11) NOT NULL,
  `phone_2` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `room_rent` int(50) NOT NULL,
  `other_amount` int(50) NOT NULL,
  `total_rent_amount` int(50) NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `last_update_by` varchar(10) NOT NULL,
  `last_update_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `renter`
--

INSERT INTO `renter` (`user_id`, `full_name`, `permanent_address`, `family_members`, `job_location`, `spouse`, `children`, `national_id`, `phone_1`, `phone_2`, `entry_date`, `room_rent`, `other_amount`, `total_rent_amount`, `created_by`, `creation_date`, `last_update_by`, `last_update_date`) VALUES
(13, 'Mamun', 'Baikhula,Tangail', 4, 'Jitarmor', 'Mrs mamun', 4, 14785214, 2147483647, 2147483647, '2011-01-01', 7000, 50, 7050, 'Pranto', '2023-11-14 11:10:30.739161', 'Pranto', '2023-11-14 11:10:30.739161'),
(14, 'Jalal', 'Jossor', 3, 'Kashimpur', 'Mrs Jalal', 2, 1258741258, 177777777, 177777777, '2008-11-14', 7000, 50, 7050, 'Pranto', '2023-11-14 11:11:54.677451', 'Pranto', '2023-11-14 11:11:54.677451'),
(15, 'Milon', 'Rajshahi', 4, 'Radix,kashimpur', 'Mrs Milon', 2, 12587415, 177777777, 177777777, '2017-03-14', 3500, 50, 3550, 'Pranto', '2023-11-14 11:12:51.008187', 'Pranto', '2023-11-14 11:12:51.008187'),
(16, 'Mr. Yousuf', 'SirajGonj', 4, 'Kashimpur', 'Afroja', 2, 2147483647, 177777777, 177777777, '2011-12-14', 7000, 50, 7050, 'Pranto', '2023-11-14 11:13:56.250080', 'Pranto', '2023-11-14 11:13:56.250080');

-- --------------------------------------------------------

--
-- Table structure for table `rent_bill`
--

CREATE TABLE `rent_bill` (
  `rent_bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `rent_date` date NOT NULL,
  `rent` int(11) NOT NULL,
  `previous_due` int(11) NOT NULL,
  `current_rent` int(11) NOT NULL,
  `electric_rent` int(11) NOT NULL,
  `other_bill` int(11) NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `last_update_by` varchar(10) NOT NULL,
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rent_bill`
--

INSERT INTO `rent_bill` (`rent_bill_id`, `user_id`, `room_number`, `rent_date`, `rent`, `previous_due`, `current_rent`, `electric_rent`, `other_bill`, `created_by`, `creation_date`, `last_update_by`, `last_update_date`) VALUES
(4, 13, 101, '2023-11-15', 7000, 0, 8513, 1463, 50, 'Pranto', '2023-11-15 03:36:28.754452', 'Pranto', '2023-11-15 03:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_number` int(100) NOT NULL,
  `room_category` varchar(100) NOT NULL,
  `room_place` varchar(100) NOT NULL,
  `current_renter` varchar(100) NOT NULL,
  `room_status` tinyint(1) NOT NULL,
  `room_stove` varchar(10) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `last_update_by` varchar(100) NOT NULL,
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_number`, `room_category`, `room_place`, `current_renter`, `room_status`, `room_stove`, `created_by`, `creation_date`, `last_update_by`, `last_update_date`) VALUES
(9, 101, '5', '8th room', '13', 1, 'single', 'Pranto', '2023-11-14 11:41:47.845161', 'Pranto', '2023-11-14 11:41:47'),
(10, 103, '5', '8th room', '14', 1, 'single', 'Pranto', '2023-11-14 11:42:12.980869', 'Pranto', '2023-11-14 11:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `room_category`
--

CREATE TABLE `room_category` (
  `id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room_category`
--

INSERT INTO `room_category` (`id`, `category`) VALUES
(4, 'Flat'),
(5, 'None Flat');

-- --------------------------------------------------------

--
-- Table structure for table `unit_calculator`
--

CREATE TABLE `unit_calculator` (
  `calculator_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `month` int(11) NOT NULL,
  `unit_range` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `sub_meter` int(11) NOT NULL,
  `previous_month_unit` float NOT NULL,
  `current_month_unit` float NOT NULL,
  `previous_due_bill` float NOT NULL,
  `current_month_bill` float NOT NULL,
  `total_electric_bill` float NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `last_update_by` varchar(100) NOT NULL,
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unit_calculator`
--

INSERT INTO `unit_calculator` (`calculator_id`, `user_id`, `month`, `unit_range`, `unit_price`, `sub_meter`, `previous_month_unit`, `current_month_unit`, `previous_due_bill`, `current_month_bill`, `total_electric_bill`, `created_by`, `creation_date`, `last_update_by`, `last_update_date`) VALUES
(5, 13, 7, 101, 6.65, 0, 100, 320, 0, 1463, 1463, 'Pranto', '2023-11-15 03:35:25.958105', 'Pranto', '2023-11-15 03:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `unit_price`
--

CREATE TABLE `unit_price` (
  `unit_price_id` int(11) NOT NULL,
  `price_month` varchar(100) NOT NULL,
  `unit_range` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `creation_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `last_update_by` varchar(100) NOT NULL,
  `last_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unit_price`
--

INSERT INTO `unit_price` (`unit_price_id`, `price_month`, `unit_range`, `price`, `created_by`, `creation_date`, `last_update_by`, `last_update_date`) VALUES
(5, 'November 2023', '00-50', 4.45, 'Pranto', '2023-11-14 11:23:00.578570', 'Pranto', '2023-11-14 11:23:00'),
(6, 'November 2023', '51-100', 5, 'Pranto', '2023-11-14 11:23:09.951531', 'Pranto', '2023-11-14 11:23:09'),
(7, 'November 2023', '101-200', 6.65, 'Pranto', '2023-11-14 11:23:18.243227', 'Pranto', '2023-11-14 11:23:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `renter`
--
ALTER TABLE `renter`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `rent_bill`
--
ALTER TABLE `rent_bill`
  ADD PRIMARY KEY (`rent_bill_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_calculator`
--
ALTER TABLE `unit_calculator`
  ADD PRIMARY KEY (`calculator_id`);

--
-- Indexes for table `unit_price`
--
ALTER TABLE `unit_price`
  ADD PRIMARY KEY (`unit_price_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `renter`
--
ALTER TABLE `renter`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rent_bill`
--
ALTER TABLE `rent_bill`
  MODIFY `rent_bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_category`
--
ALTER TABLE `room_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_calculator`
--
ALTER TABLE `unit_calculator`
  MODIFY `calculator_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_price`
--
ALTER TABLE `unit_price`
  MODIFY `unit_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
