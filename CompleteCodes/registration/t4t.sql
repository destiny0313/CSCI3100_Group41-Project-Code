-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 10:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t4t`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_information`
--

CREATE TABLE `card_information` (
  `code` int(11) NOT NULL,
  `cardno` bigint(20) NOT NULL,
  `ExpireMM` int(11) NOT NULL,
  `ExpireYY` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_information`
--

INSERT INTO `card_information` (`code`, `cardno`, `ExpireMM`, `ExpireYY`, `name`) VALUES
(123, 1234123412341234, 1, 2023, 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `pricedb`
--

CREATE TABLE `pricedb` (
  `productname` varchar(100) NOT NULL,
  `market_price` float NOT NULL,
  `depreciation` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricedb`
--

INSERT INTO `pricedb` (`productname`, `market_price`, `depreciation`) VALUES
('stone', 1000, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productname` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `sellerid` int(11) NOT NULL,
  `buyerid` int(11) NOT NULL,
  `status` text NOT NULL,
  `requestid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `change_item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 't4t_admin', 'admin@t4t.com', '0192023a7bbd73250516f069df18b500'),
(2, 't4t_admin2', 'admin2@t4t.com', '0192023a7bbd73250516f069df18b500'),
(3, 'admin123', 'admin123@123.123', '0192023a7bbd73250516f069df18b500'),
(4, 'baka', 'dsf@asd.asd', '202cb962ac59075b964b07152d234b70'),
(5, 'mouse', 'mouse@ff.com', '7815696ecbf1c96e6894b779456d330e'),
(6, 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_information`
--
ALTER TABLE `card_information`
  ADD UNIQUE KEY `cardno` (`cardno`);

--
-- Indexes for table `pricedb`
--
ALTER TABLE `pricedb`
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD UNIQUE KEY `requestid` (`requestid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
