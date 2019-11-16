-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2019 at 04:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'Nike', 1, 1),
(2, 'Adidas', 1, 1),
(3, 'Levis', 1, 1),
(4, 'Red Tape', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Shirt', 1, 1),
(2, 'Pants', 1, 1),
(3, 'T-Shirt', 1, 1),
(4, 'Jeans', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `total_amount`, `discount`, `payment_type`, `order_status`, `user_id`) VALUES
(1, '2019-11-11', 'Ram', '9812244847', '3776.00', '300', 2, 2, 1),
(2, '2019-11-07', 'Shyam Sharm', '8708741206', '3894.00', '100', 3, 1, 1),
(3, '2019-11-12', 'Soni', '0000000000', '944.00', '50', 2, 1, 11),
(4, '2019-11-14', 'Harshit', '8877996644', '1888.00', '200', 2, 2, 1),
(5, '2019-11-14', 'Purvansh', '7845123265', '1416.00', '0', 2, 1, 1),
(6, '2019-11-15', 'FF', 'AA', '1888.00', '0', 1, 2, 1),
(7, '2019-11-15', 'QQ', 'AA', '3304.00', '0', 3, 2, 1),
(8, '2019-11-15', 'LK', 'KJ', '1652.00', '0', 3, 2, 1),
(9, '2019-11-16', 'Mandeep', '9812244967', '1416.00', '0', 2, 1, 12),
(10, '2019-11-16', 'Tapan', '7894566547', '2478.00', '100', 1, 1, 13),
(11, '2019-11-16', 'Abhinav', '9845632107', '9912.00', '100', 1, 1, 1),
(12, '2019-11-15', 'Deepak', '78945612130', '826.00', '800', 2, 1, 1),
(13, '2019-11-16', 'Sunil', '1234567890', '1416.00', '0', 1, 1, 1),
(14, '2019-11-15', '0', '0', '826.00', '0', 1, 1, 1),
(15, '2019-11-16', '0', '0', '826.00', '826.00', 1, 1, 1),
(16, '2019-11-16', 'Khimraj', '123456789', '826.00', '100', 1, 1, 1),
(17, '2019-11-16', 'Hello', 'World', '826.00', '0', 2, 1, 1),
(18, '2019-11-16', 'ww', 'ww', '826.00', '1', 1, 1, 1),
(19, '2019-11-16', 'Samik', '1234567890', '10620.00', '10000', 1, 1, 1),
(20, '2019-11-16', 'Shivansh', '7894561230', '4248.00', '1000', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, '1', '800', '800.00', 2),
(1, 3, '2', '1200', '2400.00', 2),
(2, 2, '3', '700', '2100.00', 1),
(2, 3, '1', '1200', '1200.00', 1),
(3, 1, '1', '800', '800.00', 1),
(4, 1, '2', '800', '1600.00', 2),
(5, 3, '1', '1200', '1200.00', 1),
(6, 1, '2', '800', '1600.00', 2),
(7, 2, '4', '700', '2800.00', 2),
(8, 2, '2', '700', '1400.00', 2),
(9, 3, '1', '1200', '1200.00', 1),
(10, 2, '3', '700', '2100.00', 1),
(11, 2, '12', '700', '8400.00', 1),
(12, 2, '1', '700', '700.00', 1),
(13, 3, '1', '1200', '1200.00', 1),
(14, 2, '1', '700', '700.00', 1),
(15, 2, '1', '700', '700.00', 1),
(16, 2, '1', '700', '700.00', 1),
(18, 2, '4', '700', '700.00', 1),
(19, 4, '18', '4500', '4500.00', 1),
(20, 3, '3', '1200', '1200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`) VALUES
(1, 'Shirt XL', '../assests/images/stock/12926066305dc9657eae2e7.jpg', 1, 1, '23', '800', 2, 1),
(2, 'TShirt L', '../assests/images/stock/774213185dc965ac936f9.jpg', 2, 3, '4', '700', 1, 1),
(3, 'Pants 32', '../assests/images/stock/4131115665dc965cd85c7c.jpg', 3, 2, '8', '1200', 1, 1),
(4, 'Jeans 36', '../assests/images/stock/17145764095dcfcbf7b58bb.jpg', 4, 4, '18', '4500', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', ''),
(11, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', ''),
(12, 'Franchise_Jaipur', 'edd752712eb0e2089797413723463531', 'jaipur@inventory.com'),
(13, 'Franchise_Jodhpur', '509746236e422315083f1191243190a4', 'jodhpur@inventory.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
