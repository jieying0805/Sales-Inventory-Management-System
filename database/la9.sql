-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 08:12 PM
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
-- Database: `la9`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(20) NOT NULL,
  `agent_phone` varchar(20) NOT NULL,
  `agent_email` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `agent_name`, `agent_phone`, `agent_email`, `user_id`) VALUES
(2, 'Aisyah', '0192837492', 'aisyah@gmail.com', 13),
(6, 'Liana', '0122344492', 'liana@gmail.com', 14),
(7, 'Jane', '0137483900', 'suzaina@gmail.com', 15),
(13, 'test', '0192888384', 'test@gmail.com', 13);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL,
  `categories_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Long Shawl', 1, 1),
(2, 'Square', 1, 1),
(3, 'Tudung Sarung', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `comm_payment_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`comm_payment_id`, `date`, `amount`, `agent_id`) VALUES
(3, '05/16/2023', '11', 5),
(4, '05/16/2023', '11', 5),
(7, '05/02/2023', '11', 5),
(8, '2023-05-15', '10', 7),
(9, '2023-05-09', '10', 7),
(11, '2023-06-28', '5', 6);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(20) NOT NULL,
  `cust_phone` varchar(20) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `agent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `cust_phone`, `cust_address`, `agent_id`) VALUES
(1, 'Ashley', '0192837465', '121 Jln Temenggong 06100 Jitra Kedah', 0),
(8, 'Evelyn', '0183746288', 'No. 98 2Nd Floor Jln Green Hill Sarawak Kuching', 6),
(15, 'Hannah', '0129933029', '100, Jalan Laksamana, 80300 Kluang, Johor', 2),
(19, 'Penny', '0187744930', '10-4 Blk A, Berjaya Suites, 55000 Kuala Lumpur', 7),
(23, 'Minong', '0193884492', '93, Taman Bukit Hitam, 24000 Kuantan, Pahang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `po_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `qty_ordered` varchar(255) NOT NULL,
  `qty_received` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`po_id`, `date`, `product_id`, `status`, `qty_ordered`, `qty_received`) VALUES
(1, '2023-05-11', 2, 'received', '100', '100'),
(3, '2023-05-10', 6, 'received', '50', '50'),
(4, '2023-06-08', 5, 'ordered', '200', '0'),
(10, '2023-06-09', 1, 'ordered', '100', '0'),
(14, '2023-06-29', 1, 'received', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `shipping` float NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `total_commission` float NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_ref` varchar(50) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `tracking` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `cust_id`, `sub_total`, `shipping`, `total_amount`, `total_commission`, `payment_type`, `payment_ref`, `order_status`, `tracking`, `user_id`) VALUES
(33, '2024-03-24', 8, '160.00', 8, '168.00', 15, 'rhb bank', '2933002111', 'Shipped', '2395500622', 13),
(36, '2024-05-10', 15, '180.00', 8, '188.00', 15, 'public bank', '09384899101', 'Processing', '', 15),
(40, '2024-01-03', 23, '170.00', 8, '178.00', 15, 'public bank', '2029393884', 'Delivered', '4003999219', 13),
(41, '2024-02-09', 1, '60.00', 8, '68.00', 10, 'bank islam', '03031992884', 'Processing', '', 13),
(43, '2024-06-01', 19, '70.00', 8, '78.00', 5, 'bank islam', '987654321', 'Shipped', '987654321', 13),
(44, '2024-06-06', 8, '240.00', 8, '248.00', 20, '', '', 'Pending', '', 14),
(51, '2024-06-08', 19, '160.00', 8, '168.00', 20, 'bank islam', '2002938842', 'Processing', '', 14);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `commission` float NOT NULL,
  `total` varchar(255) NOT NULL,
  `total_commission` float NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`, `commission`, `total`, `total_commission`, `order_item_status`) VALUES
(118, 31, 5, '1', '60', 5, '60.00', 5, 1),
(119, 32, 2, '5', '50', 5, '250.00', 25, 1),
(121, 34, 6, '3', '70', 5, '210.00', 15, 1),
(127, 40, 2, '1', '50', 5, '50.00', 5, 1),
(128, 40, 5, '2', '60', 5, '120.00', 10, 1),
(129, 41, 1, '2', '30', 5, '60.00', 10, 1),
(132, 43, 6, '1', '70', 5, '70.00', 5, 0),
(138, 44, 5, '4', '60', 5, '240.00', 20, 1),
(139, 33, 2, '2', '50', 5, '100.00', 10, 0),
(140, 33, 5, '1', '60', 5, '60.00', 5, 0),
(147, 36, 5, '3', '60', 5, '180.00', 15, 0),
(152, 51, 1, '2', '30', 5, '60.00', 10, 1),
(153, 51, 2, '2', '50', 5, '100.00', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_cost` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `commission` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `categories_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `unit_cost`, `price`, `commission`, `quantity`, `categories_id`) VALUES
(1, 'Nelly', '15', '30', '5', '169', '2'),
(2, 'Airene', '30', '50', '5', '510', '1'),
(5, 'Fallon', '35', '60', '5', '150', '3'),
(6, 'Ashlyn', '40', '70', '5', '96', '1'),
(7, 'Iris', '45', '65', '5', '40', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type_id`) VALUES
(14, 'Liana', 'fc5b22eacd42daffeb5f58784fcd98c1', 1),
(15, 'Jane', 'e532f80dd58695c13d80423bb08ac218', 2),
(28, 'Eline', '26bb533df5747c7a3f2a9cc48a8cf3ee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_id`, `type`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`comm_payment_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `comm_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
