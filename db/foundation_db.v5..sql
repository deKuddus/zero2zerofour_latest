-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2020 at 08:19 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

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
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `objective` varchar(255) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `objective`, `description`, `is_active`) VALUES
(5, 'WE ARE HELPING HANDS 123', 'ddress will be appear here, some details of text will be here. ', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. ', 1),
(6, 'WE ARE HELPING HANDS', 'asfasdfdasf asfasdfasdfasd asfasdfasdfasdf', '', 0);

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
(1, 'WE ARE HELPING HANDS', 'we-are-helping-hands', 'blog_image/950680c2c971993f7965a3ff4db103a6.jpg', 'Md Abdul Kuddus', '<p>Quisque eros leo, pellentesque id leo non, scelerisque hendrerit mauris. Integer dapibus purus in aliquet vehicula. In laoreet justo ac sapien malesuada laoreet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\n\n<p>Aenean sit amet arcu leo. Donec erat nulla, condimentum eget velit id, condimentum feugiat sem. In pharetra, neque id cursus aliquam, metus justo scelerisque ligula, non rutrum justo massa id velit. Cras vitae magna ipsum.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac augue in libero malesuada aliquam tempus quis justo. Cras mi dolor, consequat quis pellentesque et, laoreet eget libero. Proin luctus sollicitudin venenatis.</p>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.<br />\n<br />\n&lt;blockquote&gt;&lt;p&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.&lt;/p&gt;&lt;/blockquote&gt;<br />\n<br />\n&nbsp;</p>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.</p>\n\n<p></p>\n', 3, 5, '[\"11\"]', '2020-04-06 12:08:00', 4, 1);

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
(3, 'High School', 1, 1),
(5, 'test', 3, 1);

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
  `website` varchar(80) DEFAULT NULL,
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
(14, 13, 1, 'fggasdfasdfasd asfasdfasd asfasdfasdf asdfasdf', 'for@1.comererere', 'www.facebook.com', 'asdfasdf', '2020-03-27 20:43:01', 1),
(15, 0, 2, 'Hello world', 'hello@world.com', 'www.facebook.com', 'asfasdfasdfa', '2020-03-28 05:06:19', 1),
(16, 0, 2, 'test category', 'id@2.com', 'www.facebook.com', '666yyy', '2020-03-28 05:06:38', 1),
(17, 15, 2, 'second time form 2', 'for@1.com', 'www.facebook.com', 'ftfttft', '2020-03-28 05:06:51', 1);

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
  `coupon_amount` decimal(8,2) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 0, 'yuio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `images` varchar(80) NOT NULL,
  `short_description` text,
  `content` text NOT NULL,
  `category` int(11) NOT NULL,
  `goal_fund` decimal(8,2) DEFAULT NULL,
  `current_fund` decimal(8,2) DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `title`, `slug`, `images`, `short_description`, `content`, `category`, `goal_fund`, `current_fund`, `created_at`, `is_active`, `is_featured`) VALUES
(10, 'WE ARE HELPING HANDS', 'we-are-helping-hands', 'causes_images/7c7143780e8727f9c7232a15ddb2058a.jpg', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra qua.', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 4, '5000.00', '0.00', '2020-04-07 14:34:21', 1, 1),
(11, 'School Management System', 'school-management-system', 'causes_images/8c2e4c74dba23fedec118b221fa0bbb4.jpg', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 4, '78000.00', '0.00', '2020-04-07 14:34:49', 1, 1),
(12, 'WE ARE HELPING HANDS 123', 'we-are-helping-hands-', 'causes_images/809008ce50f0618f13a560e96aaaeb4e.jpg', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 6, '343434.00', '0.00', '2020-04-07 14:35:09', 1, 0),
(13, 'afadsfd afadsfa asdfadsfasdf asdfasdfa', 'afadsfd-afadsfa-asdfadsfasdf-asdfasdfa', 'causes_images/9c624a9c7c8c9be3d1d0a0d6afbc2d60.jpg', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 4, '343434.00', '0.00', '2020-04-07 14:35:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `causes_category`
--

CREATE TABLE `causes_category` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `unique_name` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `causes_category`
--

INSERT INTO `causes_category` (`id`, `name`, `unique_name`, `is_active`) VALUES
(4, 'Dry Food', 'dry_food', 1),
(6, 'beef food', 'beef_food', 1);

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
  `title` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `value`, `title`, `status`) VALUES
(1, 'shipping_charge', '100', 'Product Shipping Charge', 1),
(2, 'product_per_page', '6', 'Product show Per Page', 1),
(3, 'company_name', 'Zero2Zero4', NULL, 1),
(4, 'company_address', 'test address', NULL, 1),
(5, 'company_city', 'test city', NULL, 1),
(6, 'company_country', 'Bangladesh', NULL, 1),
(7, 'company_phone', '0123456789', NULL, 1),
(8, 'company_email', 'email@email.com', NULL, 1),
(9, 'site_logo', 'logo_image/f77ec9e985ab1a5d8647da008f6054b3.png', 'zero2zero4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `is_read`) VALUES
(3, 'Md Abdul Kuddus', 'kuddus@gmail.com', 'adsf', 'asdf', 0),
(4, 'Imtiaz Ur Rahman Khan', 'admin@admin.com', 'asdfasdf', 'asdfasdf asdfsa asdf as\nif ($this->contact_model->save_message($data) == true) {\n                $response = array(\'status\' => 200, \'message\' => \'Message was sent successfully\');\n                header(\"Content-type: application/json\");\n                echo json_encode($response);\n                exit();\n            }', 0);

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
-- Table structure for table `desclaimer`
--

CREATE TABLE `desclaimer` (
  `id` int(11) NOT NULL,
  `desclaimer_heading` varchar(255) DEFAULT NULL,
  `desclaimer` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desclaimer`
--

INSERT INTO `desclaimer` (`id`, `desclaimer_heading`, `desclaimer`, `status`) VALUES
(3, 'This is First Desclaimer', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;amp;quot; Website&amp;amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).lt By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website. The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes&lt;/p&gt;\r\n', 0),
(4, 'This is second desclaimer', '&lt;p&gt;Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n\r\n&lt;p&gt;Laoreet sodales turpis, sit amet fermentum orci ultrices lentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n', 0),
(5, 'This is third desclaimer', '&lt;p&gt;Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n\r\n&lt;p&gt;Laoreet sodales turpis, sit amet fermentum orci ultrices lentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `donor_photo` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `email`, `mobile`, `donor_photo`, `is_active`) VALUES
(5, 'masudur rahman', 'masud@gmail.com', '012345678920', 'donor/16a97054e31528a96cb2e3179de40693.png', 1),
(6, 'Ln Md Ismail Hossain Regan', 'admin@admin.com45', '32544353456', 'donor/350e2aa3e159245c25c7552f7f8d0a9d.jpg', 0),
(7, 'Hello world', 'hello@world.com', '012345678901', 'donor/eda7e870dd1f9825357ed94aea69343e.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donors_qoute`
--

CREATE TABLE `donors_qoute` (
  `id` int(11) NOT NULL,
  `qoute` text NOT NULL,
  `donor_name` varchar(150) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donors_qoute`
--

INSERT INTO `donors_qoute` (`id`, `qoute`, `donor_name`, `company_name`, `designation`, `is_active`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Nam malesuada dapi bus diam, ut fringilla purus efficitur  eget. Morbi sagittis mi ac eros semper  pharetra. Praesent sed.', 'ANDY DUFRESNE', 'Test Company', 'CEO', 1),
(2, 'Lorem ipsum dolor sit amet, consectet adipiscing elit. Nam malesuada dapi bus diam, ut fringilla purus efficitur  eget. Morbi sagittis mi ac eros semper  pharetra. Praesent sed.', 'JOHN DOE', 'Test Company', 'COO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
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

INSERT INTO `events` (`id`, `title`, `slug`, `objective`, `category`, `start_date`, `end_date`, `picture`, `description`, `location`, `ticket_price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'GIVE EDUCATION TO CHILDREN', 'give-education-to-children', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 1, '2020-03-25', '2020-11-19', 'events/4b29e106abb0154bccdb8096b76dd373.png', '<p>Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu. Praesent gravida facilisis augue, vel malesuada elit dignissim ut. Praesent bibendum orci ac mollis bibendum.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.</p>\n<p>Vulputate feugiat tortor condimentum eu. Praesent gravida facilisis augue, vel malesuada elit dignissim ut. Praesent bibendum orci ac mollis bibendum.</p>\n<p>Etiam hendrerit maximus urna a lobortis. Etiam commodo metus volutpat, tempor diam sit amet, suscipit eros. Morbi laoreet sodales turpis, sit amet fermentum orci ultrices non.</p>', '23, STREET NAME LONDON, USA', '23.00', 1, '2020-03-25 08:33:29', '2020-03-25 08:33:29');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `faq_heading` varchar(255) DEFAULT NULL,
  `faq` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_heading`, `faq`, `status`) VALUES
(2, 'This is second Faq question', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;amp;amp;quot;Website&amp;amp;amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).&amp;amp;amp;lt;/p&amp;amp;amp;gt; &amp;amp;amp;lt;p&amp;amp;amp;gt;By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website.&lt;/p&gt;\r\n\r\n&lt;p&gt;The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes.&lt;/p&gt;\r\n', 0),
(4, 'This is first faq question', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;amp;quot;Website&amp;amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).&amp;amp;lt;/p&amp;amp;gt; &amp;amp;lt;p&amp;amp;gt;By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website. The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes.&lt;/p&gt;\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'member', 'General User'),
(3, 'Moderator', 'This is moderator description');

-- --------------------------------------------------------

--
-- Table structure for table `header_image`
--

CREATE TABLE `header_image` (
  `id` int(11) NOT NULL,
  `page_key` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `image` text,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_image`
--

INSERT INTO `header_image` (`id`, `page_key`, `page_name`, `image`, `status`) VALUES
(5, 'events_page', 'Event Page Header Image', 'header_image/c18b5ec2476deda55dd2cecc23ee381b.jpg', 1),
(6, 'news_page', 'News Page Header Image', 'header_image/e3ab21520ca822e11ece11a7d8e24a58.jpg', 1),
(7, 'causes_page', 'Causes Page Header Image', 'header_image/5800b51e68e7b2f1a1157e05868ef44a.png', 1),
(8, 'volunteer_page', 'Volunteer  Page Header Image', 'header_image/122a055555eeb2a0a0779a11c6bbed71.jpg', 1),
(9, 'merchandise_page', 'Merchandise Page Header Image', 'header_image/d38c2bf23dff98d6c03dc03f80f3cd38.jpg', 1),
(10, 'contact_page', 'Contact Page Header Image', 'header_image/5c40ff728c9714633f3813340c18d769.jpg', 1),
(11, 'about_page', 'About Page Header Image', 'header_image/f81f4a0b21b3bf7a1641ce913da1ffa1.jpg', 1),
(12, 'account_page', 'Account Page image', 'header_image/ca8c97993c53f275b39f72ab5bb94147.jpg', 1),
(13, 'test_image', 'Test image', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `year` varchar(200) NOT NULL,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `year`, `description`, `is_active`) VALUES
(7, '2018', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.', 1),
(8, '2019', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.', 1),
(9, '2020', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.\n\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `member_photo` text,
  `registration_card` text,
  `designation` varchar(200) DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `password_reset_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `mobile`, `street_address`, `address_line`, `city`, `post_code`, `country`, `state`, `password`, `member_photo`, `registration_card`, `designation`, `is_active`, `password_reset_code`) VALUES
(5, 'Mohammad Habibur Rahman', 'ma.kuddus37@gmail.com', '01780410319', 'dfsasdfasdf', 'dfsasdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', '$argon2i$v=19$m=2048,t=4,p=3$bFZDUURlY0pSc3dUdHk3aA$F8ivMRTQ/O8uULeFEa0nchsO34CCHY0hqymUhICfUR0', 'member/c94b8a5ad29ab871ca4aa933f63287af.jpg', 'member/21f3ce8525c8a9add6a9064daf4af47b.jpg', '0', 1, '5e9aa49fc5cc5'),
(6, 'Ln Md Ismail Hossain Regan', 'admin@admin.com45', '32544353456', 'dfsasdfasdf', 'dfsasdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', '$argon2i$v=19$m=2048,t=4,p=3$Q01rSVdwNzQzNU9DM2dRbw$khRVTVqz/FCKF50rOwLheTroT9j9kQUOjvkAqPfNdts', 'member/350e2aa3e159245c25c7552f7f8d0a9d.jpg', 'member/9b0ff552c64e9923e0968b7b2018565f.jpg', '4', 0, NULL),
(7, 'Ln Md Ismail Hossain Regan', 'ma.kuddus37@gmail.com123', '3254435345435', 'dfsasdfasdf', 'dfsasdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', '1234567890', 'member/3003534ca1cc67ffeb2b6dd4a05e06f2.jpg', 'member/13ae2aa8dacda4ccd31c3613e83ebb02.jpg', '0', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_designation`
--

CREATE TABLE `member_designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(200) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_designation`
--

INSERT INTO `member_designation` (`id`, `designation_name`, `is_active`) VALUES
(1, 'President', 1),
(2, 'Secretary', 1),
(3, 'Vice President', 1),
(4, 'Board Member', 1);

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
-- Table structure for table `mission_vision`
--

CREATE TABLE `mission_vision` (
  `id` int(11) NOT NULL,
  `mission` text,
  `vision` text,
  `theme_title` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mission_vision`
--

INSERT INTO `mission_vision` (`id`, `mission`, `vision`, `theme_title`) VALUES
(1, 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.', 'A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog. A quick brown fox jumps over the lazy dog.');

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
(34, '5e877adca39b2', 0, NULL, 6, 'adfasd', 'asdf', 'k@g.c', '34343435454545', 'asdf', 'asdf', '', 'Barbados', 'Saint Lucy', '3434', NULL, NULL, NULL, NULL, '624.02', 6, '1.02', '', 0, '2020-04-04 14:04:05'),
(35, '5e8893d6716be', 0, NULL, 6, 'Ln Md Ismail Hossain Regan', '', 'admin@admin.com45', '32544353456', 'asdfasdf', 'dfsasdfasdf', 'dfsasdfasdf', 'Algeria', 'Ain Temouchent', '354435', NULL, NULL, NULL, NULL, '64.04', 2, '2.04', '', 0, '2020-04-16 19:03:55');

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
  `product_id` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_lists`
--

INSERT INTO `order_lists` (`id`, `order_id`, `status`, `email_sent`, `product_name`, `product_price`, `product_total_quantity`, `product_discount`, `product_tax`, `coupon`, `coupon_amount`, `product_id`, `type`) VALUES
(36, '5e877adca39b2', 1, 0, 'GIVE EDUCATION TO CHILDREN', '23.00', 4, '0.00', '0.00', '0.00', '0.00', 1, 'event'),
(37, '5e877adca39b2', 1, 0, 'Hand sanitizer', '34.00', 1, '3.00', '1.02', '0.00', '0.00', 2, 'product'),
(38, '5e877adca39b2', 1, 0, 'SEMINAR FOR CHILDRENS TO KNOW ABOUT FUTURE', '500.00', 1, '0.00', '0.00', '0.00', '0.00', 6, 'cause'),
(39, '5e8893d6716be', 1, 0, 'Shirt', '34.00', 1, '3.00', '1.02', '0.00', '0.00', 1, 'product'),
(40, '5e8893d6716be', 1, 0, 'Hand sanitizer', '34.00', 1, '3.00', '1.02', '0.00', '0.00', 2, 'product');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `privacy_heading` varchar(255) DEFAULT NULL,
  `privacy` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `privacy_heading`, `privacy`, `status`) VALUES
(1, 'This is first heading', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;quot;Website&amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).&amp;lt;/p&amp;gt; &amp;lt;p&amp;gt;By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website. The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes.&lt;/p&gt;\r\n', 0),
(2, 'This is second heading', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;quot;Website&amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).&amp;lt;/p&amp;gt; &amp;lt;p&amp;gt;By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website. The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes.&lt;/p&gt;\r\n', 0),
(3, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
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

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `category_id`, `sub_category_id`, `purchase_price`, `sale_price`, `discount`, `discount_type`, `tax`, `color`, `size`, `quantity`, `feature_picture`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Shirt', NULL, '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/1241e76ff476bb3091a3bcf0f04b63c7.jpg', '2020-03-21 06:28:37', '2020-03-21 06:28:37', 1),
(2, 'Hand sanitizer', NULL, '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '34', '34', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/838a1de5f6c4c940bee0204fc302f8b9.jpg', '2020-03-21 06:51:12', '2020-03-21 06:51:12', 1),
(3, 'Winter Hoddie', NULL, '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '433', '33', '3', '1', '3', NULL, '[\"1\",\"2\"]', '0', 'products/9d020fc6069f9050286f2df69c2847f7.jpg', '2020-03-21 10:27:19', '2020-03-21 10:27:19', 1),
(4, 'Chicken Item', NULL, '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '4535', '4554', '454', '1', '45', NULL, '[\"2\",\"1\"]', '0', 'products/e90b3bf5fed5bc0d06581677adae708f.jpg', '2020-03-21 10:27:59', '2020-03-21 10:27:59', 1),
(5, 'asdfasdfasdf asdfasdf', NULL, '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '4324', '3434', '3434', '1', '34', NULL, '[\"1\",\"2\"]', '0', 'products/91982b042c47d554d44c1ea90e535a96.jpg', '2020-03-21 10:28:28', '2020-03-21 10:28:28', 1),
(6, 'Beef food', NULL, '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '3434', '343434', '34', '1', '34', NULL, '[\"1\",\"2\"]', '0', 'products/64ea478e2148777abeb9e018f86bd2ce.jpg', '2020-03-21 10:29:00', '2020-03-21 10:29:00', 1);

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
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text,
  `image` varchar(80) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `offer` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `image`, `url`, `is_active`, `offer`) VALUES
(6, 'Place Autocomplete Address Form', 'test', 'slider_image/f349d2bd26ed5d5be4d510a89be11e0e.jpeg', 'asdfadf', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditons`
--

CREATE TABLE `terms_conditons` (
  `id` int(11) NOT NULL,
  `terms_heading` varchar(255) DEFAULT NULL,
  `terms` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_conditons`
--

INSERT INTO `terms_conditons` (`id`, `terms_heading`, `terms`, `status`) VALUES
(3, 'This is First Heading', '&lt;p&gt;The domain name www.rokomari.com (referred to as &amp;amp;amp;quot; Website&amp;amp;amp;quot;) is owned by Onnorokom Web Services Limited a company incorporated under the Companies Act, 1994(Act XVIII of 1994).lt By accessing this Site, you confirm your understanding of the Terms of Use. If you do not agree to these Terms, you shall not use this website. The Site reserves the right to change, modify, add, or remove portions of these Terms at any time. Changes will be effective when posted on the Site with no other notice provided. Please check these Terms of Use regularly for updates. Your continued use of the Site following the posting of changes to these Terms of Use constitutes your acceptance of those changes&lt;/p&gt;\r\n', 0),
(4, 'This is second terms and condition', '&lt;p&gt;Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n\r\n&lt;p&gt;Laoreet sodales turpis, sit amet fermentum orci ultrices lentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentum eu.&lt;/p&gt;\r\n', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$FvfpQho1FzlkN/BNP557yeQ//.aBWRJoyoetxmfQeUEfv4PdbdOxC', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1587318220, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'kuddus@gmail.com', '$2y$10$MjDP1pqF8HAP0BnIVtdxBOB3D5mq86UbjghirR8JHH3oBIgPwJP9.', 'kuddus@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1586890704, NULL, 1, 'Md Abdul', 'Kuddus', 'ZerotwoZeroFour', '012345678910'),
(3, '::1', 'admin@admin.com45', '$2y$10$U45ywIDtzmz6mOFLo1ld0.nyfasnPIa79o9h6u41nNTfWFTuCkC.G', 'admin@admin.com45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1586891750, NULL, 1, 'Md Abdul', 'Kuddus', 'ZerotwoZeroFour', '012345678910'),
(4, '::1', 'administrator', '$2y$12$bFa7vCuauy/QH6f09U.c.OpEFmAfRomjVcKxoq8YtlcjGx270sq5.', 'ma.kuddus37@gmail.com', 'aa7bf65bd1ec4d51b7e6', '$2y$10$hQPque/7MtV8SSrLXOkkNeLoNbhg88t6UkTpKBnZTGdwpvSUiDNMy', NULL, NULL, NULL, NULL, NULL, 1586983909, 1586985215, 0, 'Md Abdul', 'Kuddus', 'ZerotwoZeroFour', '012345678910');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(9, 1, 1),
(10, 1, 2),
(11, 1, 3),
(3, 2, 2),
(4, 3, 2),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `address_line` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `volunteer_photo` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `email`, `mobile`, `street_address`, `address_line`, `city`, `post_code`, `country`, `state`, `volunteer_photo`, `is_active`) VALUES
(11, 'Ln Md Ismail Hossain Regan', 'admin@admin.com', '3254435345', 'dfsasdfasdf', 'dfsasdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', 'volunteer/e73f4a51a675ad225d77c5a0da0cbf5b.jpg', 1),
(12, 'Ln Md Ismail Hossain Regan', 'admin@admin.com45', '3254435345', 'dfsasdfasdf', 'dfsasdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', 'volunteer/6bfc3c1f3213f8169269da842af32a02.jpg', 1),
(13, 'Ln Md Ismail Hossain Regan', 'ma.kuddus37@gmail.com', '0178041031934543', 'asdfasdf', 'asdfasdf', 'asdfasdf', '354435', 'Australia', 'Australian Capital Territory', 'volunteer/bbfae70c1c9aeb889cc996d86177c331.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `causes_category`
--
ALTER TABLE `causes_category`
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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desclaimer`
--
ALTER TABLE `desclaimer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors_qoute`
--
ALTER TABLE `donors_qoute`
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
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_image`
--
ALTER TABLE `header_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_designation`
--
ALTER TABLE `member_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission_vision`
--
ALTER TABLE `mission_vision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_lists`
--
ALTER TABLE `order_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
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
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_conditons`
--
ALTER TABLE `terms_conditons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `causes_category`
--
ALTER TABLE `causes_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `desclaimer`
--
ALTER TABLE `desclaimer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `donors_qoute`
--
ALTER TABLE `donors_qoute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `header_image`
--
ALTER TABLE `header_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `member_designation`
--
ALTER TABLE `member_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mission_vision`
--
ALTER TABLE `mission_vision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `terms_conditons`
--
ALTER TABLE `terms_conditons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`category`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `causes`
--
ALTER TABLE `causes`
  ADD CONSTRAINT `causes_ibfk_1` FOREIGN KEY (`category`) REFERENCES `causes_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
