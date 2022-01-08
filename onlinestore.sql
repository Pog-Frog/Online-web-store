-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 05:02 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'omar5621@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_title`) VALUES
(1, 'Lenovo'),
(2, 'Samsung'),
(3, 'HP'),
(4, 'Razor'),
(5, 'Apple'),
(6, 'DELL'),
(7, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(10) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(100) NOT NULL,
  `category_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Desktops'),
(2, 'Mobile Phones'),
(3, 'Tablets'),
(4, 'Laptops'),
(5, 'Accessories'),
(6, 'Monitors'),
(7, 'Printers'),
(10, 'car');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_street` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_membership` varchar(100) NOT NULL,
  `account_status` text NOT NULL,
  `recovery_question` text NOT NULL,
  `recovery_answer` text NOT NULL,
  `report_status` text NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_password`, `customer_country`, `customer_city`, `customer_street`, `customer_image`, `customer_contact`, `customer_membership`, `account_status`, `recovery_question`, `recovery_answer`, `report_status`) VALUES
(12, '::1', 'omar', 'yolo56@gmail.com', '1234', 'Egypt', 'Alexandria', '21. st jump', '447513.jpg', '123456', 'Gold', 'true', 'whats your name?', 'omar', 'false'),
(16, '::1', 'Cryo Btye', 'cryobyte56@gmail.com', '1234', 'Egypt', 'Alexandria', '21. st jump', 'Cryo Byte.jpg', '123456', 'Platinum', 'true', 'whats your name?', 'omar', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fav_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `date_added` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`fav_id`, `customer_id`, `product_id`, `date_added`) VALUES
(9, 12, 3, '2021/01/07'),
(10, 12, 4, '2021/01/07'),
(12, 16, 3, '2021/01/13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `date_added` text NOT NULL,
  `custom_country` varchar(255) NOT NULL,
  `custom_city` varchar(255) NOT NULL,
  `custom_street` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `product_quantity`, `date_added`, `custom_country`, `custom_city`, `custom_street`) VALUES
(2, 16, 5, 1, '2021/01/09', '', '', ''),
(3, 16, 4, 1, '2021/01/09', 'Egypt', 'Alexandria', '21. st jump'),
(4, 16, 13, 1, '2021/01/09', 'Egypt', 'Alexandria', '21. st jump'),
(5, 16, 3, 1, '2021/01/13', '', '', ''),
(6, 16, 3, 4, '2021/01/13', '', '', ''),
(7, 16, 3, 4, '2021/01/13', '', '', ''),
(8, 16, 3, 4, '2021/01/13', '', '', ''),
(9, 16, 13, 1, '2021/01/13', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_category` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_describtion` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category`, `product_brand`, `product_title`, `product_price`, `product_describtion`, `product_image`, `product_keywords`, `product_quantity`) VALUES
(3, 4, 3, 'HP laptop', '440.00', 'this is a hot bhabi', '2vq6l1.png', 'hp,laptop,new', 8),
(4, 2, 2, 'samsung phone', '100.00', 'good phone ', '6404601.png', 'mobile,phone,new', 2),
(5, 7, 7, 'canon printer', '230.00', 'bad printer', '1573001651873.jpg', 'printer,new', 12),
(13, 5, 2, 'Samsun watch', '600.00', 'good', '2018-Porsche-911-GT3-V14-1080.jpg', 'watch,new', 2),
(26, 10, 2, 'samsung galaxy tv', '6000.00', 'this is a good tv', '584-5846700_coomer-meme-hd-png-download.png', 'tv,new,samsung', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `fav_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
