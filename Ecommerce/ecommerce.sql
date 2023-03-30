-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 13, 2022 at 05:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit_price` varchar(100) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_id`, `product_name`, `unit_price`, `product_image`, `quantity`) VALUES
(1, 0, 'Black Official Dress', '', '', 0),
(2, 0, 'Midi dress', '', 'image-2.jpg', 0),
(3, 0, 'Bodycam', '', 'index.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` varchar(11) NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `is_deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `is_deleted`) VALUES
('', '', ''),
('001', 'Female', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_amount` double NOT NULL,
  `order_status` enum('pending','pending payment','paid','') NOT NULL,
  `created_at` datetime NOT NULL,
  `payment_type` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `orderdetails_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `orderdetails_total` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paymenttypes`
--

CREATE TABLE `tbl_paymenttypes` (
  `paymenttype_id` int(11) NOT NULL,
  `paymenttype_name` varchar(20) NOT NULL,
  `description` varchar(40) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` varchar(11) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(40) NOT NULL,
  `unit_price` varchar(25) NOT NULL,
  `available_quantity` varchar(11) NOT NULL,
  `category_name` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `added_by` varchar(11) NOT NULL,
  `is_deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_image`, `unit_price`, `available_quantity`, `category_name`, `created_at`, `update_at`, `added_by`, `is_deleted`) VALUES
('0001', 'Midi dress', 'Maroon', 'image-2.jpg', '3000', '8', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productimages`
--

CREATE TABLE `tbl_productimages` (
  `productimages_id` varchar(11) NOT NULL,
  `product_image` varchar(40) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` varchar(11) NOT NULL,
  `role_name` varchar(15) NOT NULL,
  `is_deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategories`
--

CREATE TABLE `tbl_subcategories` (
  `subcategory_id` varchar(11) NOT NULL,
  `subcategory_name` varchar(25) NOT NULL,
  `category` varchar(11) NOT NULL,
  `is_deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlogins`
--

CREATE TABLE `tbl_userlogins` (
  `userlogin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(25) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` varchar(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `tel_number` int(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `gender` enum('male','female','','') NOT NULL,
  `role` varchar(11) NOT NULL,
  `is_deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `tel_number`, `email`, `password`, `gender`, `role`, `is_deleted`) VALUES
('', 'Wayans', 'Beck', 45874584, 'wayans@gmail.com', '123456789', 'male', '', ''),
('0001', 'Jesse', 'Williams', 71245678, 'Jwillis@gmail.com', '1234567', 'male', '', ''),
('003', 'Ruth', 'Lesa', 112345678, 'r.lesa@gmail.com', 'ruthlesa', 'female', '', ''),
('01234', 'Mary', 'Jones', 754644554, 'mary.jones@yahoo.com', 'mj42069', 'female', 'User', '0'),
('21322', 'Andrew', 'Nabaala', 71245678, 'a.nabaala@gmail.com', '1234567', 'male', '', ''),
('21323', 'Jesse', 'Williams', 71245678, 'Jwilliams@gmail.com', '1234567', 'male', '', ''),
('36523', 'Sandra', 'Nthenya', 757281868, 'sandra.n.masila@gmail.com', 'sandra', 'female', 'admin', '0'),
('544644', 'Nick', 'Beck', 2147483647, 'nbeck@gmail.com', '123456789', 'male', '', ''),
('74555265', 'Nicole', 'Beck', 2147483647, 'nbeck1234@gmail.com', '123456789', 'female', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `wallet_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount_available` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`orderdetails_id`);

--
-- Indexes for table `tbl_paymenttypes`
--
ALTER TABLE `tbl_paymenttypes`
  ADD PRIMARY KEY (`paymenttype_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_productimages`
--
ALTER TABLE `tbl_productimages`
  ADD PRIMARY KEY (`productimages_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_userlogins`
--
ALTER TABLE `tbl_userlogins`
  ADD PRIMARY KEY (`userlogin_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
