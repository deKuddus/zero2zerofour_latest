-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 01:02 PM
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
-- Database: `foundation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `picture` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `picture` text DEFAULT NULL,
  `coupon` varchar(100) DEFAULT NULL,
  `coupon_amount` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `customer_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `tax`, `discount`, `subtotal`, `picture`, `coupon`, `coupon_amount`) VALUES
(7, '94crnaqmfc1p8gjq57obk39l1hrk548n', 0, 3, 'Winter Hoddie', 1, '33.00', '0.99', '3.00', '30.00', 'products/9d020fc6069f9050286f2df69c2847f7.jpg', NULL, NULL),
(8, '94crnaqmfc1p8gjq57obk39l1hrk548n', 0, 4, 'Chicken Item', 2, '4554.00', '2049.30', '908.00', '8200.00', 'products/e90b3bf5fed5bc0d06581677adae708f.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `pid`, `category_name`, `is_active`) VALUES
(1, 0, 'test category', 1),
(2, 1, 'test sub category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `value`, `is_active`) VALUES
(1, 'black', 1),
(2, 'white', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config_key` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `value`, `title`) VALUES
(1, 'shipping_charge', '100', 'Product Shipping Charge'),
(2, 'product_per_page', '2', 'Product show Per Page');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `picture` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20200226121748);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `purchase_price` varchar(10) NOT NULL,
  `sale_price` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `discount_type` varchar(10) NOT NULL,
  `tax` varchar(10) NOT NULL,
  `color` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `quantity` varchar(10) NOT NULL DEFAULT '0',
  `feature_picture` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `description`, `category_id`, `sub_category_id`, `purchase_price`, `sale_price`, `discount`, `discount_type`, `tax`, `color`, `size`, `quantity`, `feature_picture`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Shirt', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/1241e76ff476bb3091a3bcf0f04b63c7.jpg', '2020-03-21 06:28:37', '2020-03-21 06:28:37', 1),
(2, 'Hand sanitizer', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/838a1de5f6c4c940bee0204fc302f8b9.jpg', '2020-03-21 06:51:12', '2020-03-21 06:51:12', 1),
(3, 'Winter Hoddie', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '433', '33', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/9d020fc6069f9050286f2df69c2847f7.jpg', '2020-03-21 10:27:19', '2020-03-21 10:27:19', 1),
(4, 'Chicken Item', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '4535', '4554', '454', '1', '45', NULL, '[\"2\",\"1\"]', '0', 'products/e90b3bf5fed5bc0d06581677adae708f.jpg', '2020-03-21 10:27:59', '2020-03-21 10:27:59', 1),
(5, 'asdfasdfasdf asdfasdf', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '4324', '3434', '3434', '1', '34', NULL, '[\"1\",\"2\"]', '0', 'products/91982b042c47d554d44c1ea90e535a96.jpg', '2020-03-21 10:28:28', '2020-03-21 10:28:28', 1),
(6, 'Beef food', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '3434', '343434', '34', '1', '34', NULL, '[\"1\",\"2\"]', '0', 'products/64ea478e2148777abeb9e018f86bd2ce.jpg', '2020-03-21 10:29:00', '2020-03-21 10:29:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_pictures`
--

CREATE TABLE `product_pictures` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_pictures`
--

INSERT INTO `product_pictures` (`id`, `product_id`, `picture`, `is_active`) VALUES
(4, 2, 'products/c8c13bc670ed2744bc63e4f0728f58a2.png', 1),
(5, 2, 'products/6d9e4ee3a0a2e603b916ec7c20873ba3.jpg', 1),
(12, 1, 'products/3e512c5e9df2e2af025b93a6a028402f.jpg', 1),
(13, 1, 'products/fcb0822d9016a9372ad6fe323cbffa3f.jpg', 1),
(14, 1, 'products/20019fd4c4c9d190113f7a2911a7e74c.jpg', 1),
(15, 1, 'products/b2c98112491e64f5382da63ad34afdf3.jpg', 1),
(16, 1, 'products/9bc896684f003a7c208863b520a66a78.jpg', 1),
(17, 1, 'products/78ceb8c00a409a12e6bb387eb90365fa.jpg', 1),
(18, 1, 'products/37657943cfbb50db42a37d192fcc1ea2.jpg', 1),
(19, 1, 'products/f207c1bcbea5bb7ab5766321de83928e.png', 1),
(20, 1, 'products/3b2d896fcd6761c1ac953ae3c99087dd.jpg', 1),
(21, 1, 'products/64b7b2b994ff72cf39ace39d1ecdcfe8.jpg', 1),
(22, 1, 'products/6efe21c42b1ae750f12eb57a23bbb1fa.jpg', 1),
(23, 1, 'products/ab66eda1d480180d28844ff4345cef84.jpg', 1),
(24, 1, 'products/bb485197c4ff599c4898bbcec59addf1.jpg', 1),
(25, 3, 'products/0f16f2467110948a8b1e35b591311062.png', 1),
(26, 3, 'products/5217287211a2764a50fc243f8921df0b.jpg', 1),
(27, 3, 'products/1a3d27aa0d486a3382df7258646538d2.jpg', 1),
(34, 6, 'products/3fa2a74666eac6f35cdba8a079b06791.jpg', 1),
(35, 6, 'products/f803a260245b4b2a5cc5bc969d7925ee.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `value`, `is_active`) VALUES
(1, 'x', 1),
(2, 'xl', 1),
(3, 'm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `symbol` varchar(5) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `symbol`, `is_active`) VALUES
(1, '$', 1),
(2, '%', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pictures`
--
ALTER TABLE `product_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_pictures`
--
ALTER TABLE `product_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
