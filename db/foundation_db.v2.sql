-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2020 at 08:55 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `picture` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `images` varchar(80) NOT NULL,
  `author` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `tags` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `counter` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `images`, `author`, `content`, `category`, `sub_category`, `tags`, `created_at`, `counter`, `is_active`) VALUES
(1, 'SEMINAR FOR CHILDRENS TO KNOW ABOUT FUTURE', 'seminar-for-childrens-to-know-about-future', 'blog_image/f5712b72347d3d1f7d0192eb08f6fb19.jpg', 'Md Abdul Kuddus', '<p>Quisque eros leo, pellentesque id leo non, scelerisque hendrerit mauris. Integer dapibus purus in aliquet vehicula. In laoreet justo ac sapien malesuada laoreet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\n\n<p>Aenean sit amet arcu leo. Donec erat nulla, condimentum eget velit id, condimentum feugiat sem. In pharetra, neque id cursus aliquam, metus justo scelerisque ligula, non rutrum justo massa id velit. Cras vitae magna ipsum.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac augue in libero malesuada aliquam tempus quis justo. Cras mi dolor, consequat quis pellentesque et, laoreet eget libero. Proin luctus sollicitudin venenatis.</p>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.</p>\n\n<p>&nbsp;</p>\n\n<blockquote>\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.</p>\n</blockquote>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', 1, 3, '[\"13\",\"15\"]', '2020-03-27 16:05:16', 106, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `pid` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`id`, `name`, `pid`, `is_active`) VALUES
(1, 'Education', 0, 1),
(2, 'Food', 0, 1),
(3, 'High School', 1, 1),
(4, 'Dry Food', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(80) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `parent_id`, `post_id`, `name`, `email`, `website`, `message`, `created_at`, `is_active`) VALUES
(10, 0, 1, 'Md Abdul Kuddus', 'kuddus@gmail.com', 'www.facebook.com', 'dafa afadsf adsfaf', '2020-03-27 20:36:03', 1),
(11, 10, 1, 'adfdasasdfdsf asdfasdf', 'second@2.com', 'www.facebook.com', 'asdfasfdf', '2020-03-27 20:36:14', 1),
(12, 11, 1, 'test category', 'hello@world.com', 'www.facebook.com', 'asdfasd', '2020-03-27 20:36:26', 1),
(13, 12, 1, 'adsfasd asdfasd asdf', 'id@2.com', 'www.facebook.com', 'waeraewrwear asr', '2020-03-27 20:36:40', 1),
(14, 13, 1, 'fggasdfasdfasd asfasdfasd asfasdfasdf asdfasdf', 'for@1.comererere', 'www.facebook.com', 'asdfasdf', '2020-03-27 20:43:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`id`, `name`, `is_active`) VALUES
(11, 'causes', 1),
(12, 'donate', 1),
(13, 'child', 1),
(14, 'care', 1),
(15, 'children help', 1),
(17, 'child', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `order_id` varchar(80) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `picture` text,
  `coupon` varchar(100) DEFAULT NULL,
  `coupon_amount` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `order_id`, `customer_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `tax`, `discount`, `subtotal`, `picture`, `coupon`, `coupon_amount`) VALUES
(36, '5e79cdb5934f8', 0, 2, 'Hand sanitizer', 1, '34.00', '1.02', '3.00', '31.00', 'products/838a1de5f6c4c940bee0204fc302f8b9.jpg', NULL, NULL),
(37, '5e79cdb5934f8', 0, 3, 'Winter Hoddie', 8, '33.00', '0.99', '3.00', '240.00', 'products/9d020fc6069f9050286f2df69c2847f7.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `pid`, `category_name`, `is_active`) VALUES
(1, 0, 'test category', 1),
(2, 1, 'test sub category', 1),
(3, 2, 'yuio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `value` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
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
(2, 'product_per_page', '6', 'Product show Per Page');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `town_city` varchar(80) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `zip_code` varchar(30) DEFAULT NULL,
  `street_address1` text,
  `street_address2` text,
  `password` varchar(150) NOT NULL,
  `picture` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `town_city`, `state`, `country`, `zip_code`, `street_address1`, `street_address2`, `password`, `picture`, `is_active`, `joined_at`) VALUES
(14, 'Md Abdul Kuddus', 'kuddus@gmail.com', '01780410319', 'Chittagong', 'Chittagong', 'Bangladesh', '4225', 'Foy\'s Lake', 'Abdu Hamid Khan Road', '$argon2i$v=19$m=2048,t=4,p=3$ZVJZa3BmZkNGd09RQWFSWg$LZC3wq30nPTB7OWpR2ULF7mPloa1g0m/G3vZk/xHCqU', NULL, 1, '2020-03-24 07:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `objective` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `picture` text,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `ticket_price` decimal(8,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `objective`, `category`, `start_date`, `end_date`, `picture`, `description`, `location`, `ticket_price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'GIVE EDUCATION TO CHILDREN', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 1, '2020-03-25', '2020-11-19', 'events/4b29e106abb0154bccdb8096b76dd373.png', '<p>Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu. Praesent gravida facilisis augue, vel malesuada elit dignissim ut. Praesent bibendum orci ac mollis bibendum.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.</p>\n<p>Vulputate feugiat tortor condimentum eu. Praesent gravida facilisis augue, vel malesuada elit dignissim ut. Praesent bibendum orci ac mollis bibendum.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.</p>', '23, STREET NAME LONDON, USA', '23.00', 1, '2020-03-25 08:33:29', '2020-03-25 08:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`, `is_active`) VALUES
(1, 'test category', 1);

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `coupon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `company_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address1` text COLLATE utf8mb4_unicode_ci,
  `customer_address2` text COLLATE utf8mb4_unicode_ci,
  `customer_country` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_state` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_zipp_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` decimal(8,2) DEFAULT NULL,
  `payment_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `order_notes` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `order_status`, `coupon`, `customer_id`, `company_name`, `customer_name`, `customer_email`, `customer_phone`, `customer_city`, `customer_address1`, `customer_address2`, `customer_country`, `customer_state`, `customer_zipp_code`, `payment_method`, `transaction_id`, `paid_amount`, `payment_status`, `price`, `quantity`, `tax`, `order_notes`, `is_active`, `order_at`) VALUES
(20, '5e79a86fedd92', 0, NULL, 0, 'Md Abdul Kuddus', '', 'kuddus@gmail.com', '01780410319', 'Chittagong', NULL, NULL, 'Bangladesh', 'Chittagong', '4225', NULL, NULL, NULL, NULL, '467579.45', 6, NULL, 'Please process the order as early as possible', 0, '2020-03-24 07:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_lists`
--

CREATE TABLE `order_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `product_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_total_quantity` int(11) NOT NULL,
  `product_discount` decimal(8,2) DEFAULT NULL,
  `product_tax` decimal(8,2) DEFAULT NULL,
  `coupon` decimal(8,2) DEFAULT NULL,
  `coupon_amount` decimal(8,2) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_lists`
--

INSERT INTO `order_lists` (`id`, `order_id`, `status`, `email_sent`, `product_name`, `product_price`, `product_total_quantity`, `product_discount`, `product_tax`, `coupon`, `coupon_amount`, `product_id`) VALUES
(20, '5e79a86fedd92', 1, 0, 'Shirt', '34.00', 1, '3.00', '1.02', '0.00', '0.00', 1),
(21, '5e79a86fedd92', 1, 0, 'Hand sanitizer', '34.00', 1, '3.00', '1.02', '0.00', '0.00', 2),
(22, '5e79a86fedd92', 1, 0, 'Winter Hoddie', '33.00', 1, '3.00', '0.99', '0.00', '0.00', 3),
(23, '5e79a86fedd92', 1, 0, 'Chicken Item', '4554.00', 1, '454.00', '2049.30', '0.00', '0.00', 4),
(24, '5e79a86fedd92', 1, 0, 'asdfasdfasdf asdfasdf', '3434.00', 1, '3434.00', '1167.56', '0.00', '0.00', 5),
(25, '5e79a86fedd92', 1, 0, 'Beef food', '343434.00', 1, '34.00', '116767.56', '0.00', '0.00', 6);

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
  `color` text,
  `size` text,
  `quantity` varchar(10) NOT NULL DEFAULT '0',
  `feature_picture` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `description`, `category_id`, `sub_category_id`, `purchase_price`, `sale_price`, `discount`, `discount_type`, `tax`, `color`, `size`, `quantity`, `feature_picture`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Shirt', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/1241e76ff476bb3091a3bcf0f04b63c7.jpg', '2020-03-21 06:28:37', '2020-03-21 06:28:37', 1),
(2, 'Hand sanitizer', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/838a1de5f6c4c940bee0204fc302f8b9.jpg', '2020-03-21 06:51:12', '2020-03-21 06:51:12', 1),
(3, 'Winter Hoddie', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 2, 3, '433', '33', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/9d020fc6069f9050286f2df69c2847f7.jpg', '2020-03-21 10:27:19', '2020-03-21 10:27:19', 1),
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
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
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
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
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
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_lists`
--
ALTER TABLE `order_lists`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
