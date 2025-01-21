-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 04:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawnshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `admin_id`, `password`) VALUES
('admin1', 1, '1234'),
('admin2', 2, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `buy/sell/pawn`
--

CREATE TABLE `buy/sell/pawn` (
  `customer_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`) VALUES
('electronics'),
('jewellery'),
('musical instruments'),
('sporting goods'),
('toy'),
('watch');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` varchar(50) NOT NULL,
  `nid` bigint(13) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `house_number` int(11) NOT NULL,
  `road_number` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `Dob` varchar(50) NOT NULL,
  `customer_id` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `nid`, `user_name`, `house_number`, `road_number`, `city`, `Dob`, `customer_id`, `email`, `password`, `phone`, `date`) VALUES
('adiba alam', 1235463789019, '', 20, 71, 'kansas', '2001-09-20', 1, 'adibalam@mail.com', '12345', '27364536272', '2023-08-29 07:50:54'),
('peppa pig', 1263748537463, '', 32, 21, 'chittagong', '1998-08-14', 2, 'peppapig@mail.com', '09876', '17283746278', '2023-08-29 07:50:54'),
('yogi bear', 192738291027, '', 22, 53, 'kolkata', '2000-08-01', 3, 'yogibear@bear.com', '1111', '17283946253', '2023-08-29 07:50:54'),
('Nafis Al Shams', 82672683628398, 'nafis', 16, 19, 'Uttara', '2001-12-18', 7, 'nafisdrubo@gmail.com', '1234', '01625291102', '2023-08-29 11:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `nid` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift` time NOT NULL,
  `salary` int(11) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`nid`, `name`, `employee_id`, `shift`, `salary`, `phone_number`, `position`) VALUES
('23546', 'john wick', 1, '09:00:00', 30000, '01928374653', 'warehouse'),
('12738', 'jim beesly', 2, '10:00:00', 30000, '01928374899', 'shop');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `name` varchar(50) NOT NULL,
  `location` varchar(20) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `expertise` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`name`, `location`, `expert_id`, `phone_number`, `expertise`) VALUES
('expert1', 'new jersey', 1, '01928374657', 'jewellery'),
('expert2', 'newark', 2, '01928394058', 'watch'),
('expert3', 'dhaka', 3, '9765456898', 'musical instruments'),
('expert4', 'delhi', 4, '89765432123', 'toy'),
('expert5', 'kolkata', 5, '91827364536', 'sporting goods'),
('expert6', 'dhaka', 10, '72635463556', 'electronics');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `buying_price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `selling_price` varchar(50) NOT NULL,
  `date_of_payment` date NOT NULL,
  `action` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `item_id`, `buying_price`, `customer_id`, `selling_price`, `date_of_payment`, `action`) VALUES
(8, 45, 80000, 3, '150000', '2023-08-02', 'for sale'),
(20, 24, 17000, 2, '25000', '2023-08-24', 'sold'),
(22, 46, 100000, 3, '1900000', '2023-08-24', 'sold'),
(23, 45, 80000, 1, '150000', '2023-08-24', 'sold'),
(25, 47, 4000, 1, '5000', '2023-08-27', 'for sale');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `employee_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `name` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `model` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `expert_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`name`, `item_id`, `customer_id`, `brand`, `type`, `model`, `status`, `expert_id`) VALUES
('ruby rings', 2, 1, 'tiff', 'jewellery', '000', 'pawn', 1),
('rare pokemon card', 3, 1, 'poki', 'toy', '123', 'sold', 4),
('electric guitar', 24, 2, 'beegees', 'electronics', '200', 'sold', 3),
('old bicyle', 44, 3, 'joncycles', 'sporting goods', '190', 'pawn', 2),
('motorcycle', 45, 3, 'mmm', 'sporting goods', '199', 'sold', 5),
('grand piano', 46, 3, 'abc', 'musical instruments', '125', 'sold', 3),
('signed bat', 47, 1, 'abc', 'sporting goods', '111', 'for sale', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pawn_ticket`
--

CREATE TABLE `pawn_ticket` (
  `item_id` int(11) NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `pawn_ticket_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `interest` float NOT NULL,
  `date_of_payment` date NOT NULL,
  `redeem_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pawn_ticket`
--

INSERT INTO `pawn_ticket` (`item_id`, `loan_amount`, `pawn_ticket_id`, `customer_id`, `interest`, `date_of_payment`, `redeem_date`) VALUES
(3, 2000, 4, 1, 2, '2023-07-13', '2023-10-14'),
(24, 17000, 5, 2, 15, '2023-03-10', '2023-08-10'),
(46, 100000, 7, 3, 10, '2023-07-01', '2023-10-01'),
(44, 5000, 8, 3, 1, '2023-08-24', '2023-11-24'),
(47, 4000, 9, 1, 0.25, '2023-08-26', '2023-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `invoice_number` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `buy/sell/pawn`
--
ALTER TABLE `buy/sell/pawn`
  ADD PRIMARY KEY (`customer_id`,`loan_id`,`invoice_number`,`item_id`),
  ADD KEY `invoice number` (`invoice_number`),
  ADD KEY `item ID` (`item_id`),
  ADD KEY `loan ID` (`loan_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `date` (`date`),
  ADD KEY `nid` (`nid`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `Ssn` (`nid`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`expert_id`),
  ADD KEY `expertise` (`expertise`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_ibfk_1` (`item_id`),
  ADD KEY `invoice_ibfk_2` (`customer_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`employee_id`,`loan_id`,`customer_id`),
  ADD KEY `customer ID` (`customer_id`),
  ADD KEY `loan ID` (`loan_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `custom id` (`customer_id`),
  ADD KEY `item_ibfk_1` (`expert_id`),
  ADD KEY `item_ibfk_2` (`type`);

--
-- Indexes for table `pawn_ticket`
--
ALTER TABLE `pawn_ticket`
  ADD PRIMARY KEY (`pawn_ticket_id`),
  ADD KEY `pawn_ticket_ibfk_1` (`item_id`),
  ADD KEY `pawn_ticket_ibfk_2` (`customer_id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`invoice_number`,`customer_id`,`loan_id`),
  ADD KEY `customer ID` (`customer_id`),
  ADD KEY `loan ID` (`loan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pawn_ticket`
--
ALTER TABLE `pawn_ticket`
  MODIFY `pawn_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy/sell/pawn`
--
ALTER TABLE `buy/sell/pawn`
  ADD CONSTRAINT `buy/sell/pawn_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `buy/sell/pawn_ibfk_2` FOREIGN KEY (`invoice_number`) REFERENCES `invoice` (`invoice_id`),
  ADD CONSTRAINT `buy/sell/pawn_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `buy/sell/pawn_ibfk_4` FOREIGN KEY (`loan_id`) REFERENCES `pawn_ticket` (`pawn_ticket_id`);

--
-- Constraints for table `expert`
--
ALTER TABLE `expert`
  ADD CONSTRAINT `expert_ibfk_1` FOREIGN KEY (`expertise`) REFERENCES `category` (`name`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `issue_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `issue_ibfk_3` FOREIGN KEY (`loan_id`) REFERENCES `pawn_ticket` (`pawn_ticket_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `custom id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`expert_id`) REFERENCES `expert` (`expert_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`type`) REFERENCES `category` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `pawn_ticket`
--
ALTER TABLE `pawn_ticket`
  ADD CONSTRAINT `pawn_ticket_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pawn_ticket_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `receive`
--
ALTER TABLE `receive`
  ADD CONSTRAINT `receive_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `receive_ibfk_2` FOREIGN KEY (`invoice_number`) REFERENCES `invoice` (`invoice_id`),
  ADD CONSTRAINT `receive_ibfk_3` FOREIGN KEY (`loan_id`) REFERENCES `pawn_ticket` (`pawn_ticket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
