-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2020 at 08:56 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
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
(5, 'We are SSC 02 and HSC 04 Batch bangladesh organization.', 'address will be appear here, some details of text will be here. ', 'SSC 2002 & HSC 2004 Bangladesh is today more than just any other social group on not only Facebook but any social networking website in the world. Officially this is the largest social networking group found on entire World Wide Web (WWW) which has been formed on 12th May 2019 with nationwide batch mates from Secondary School Certificate (SSC) of 2002 and Higher Secondary Certificate (HSC) of 2004 of Bangladesh. The primary idea was to know each other, make friends, planning for meetings & hangouts in social occasions. Today this group has grown beyond imagination with a vast worldwide network with the sincere dedication and efforts of the enthusiastic group members. A platform beyond religion, beyond casts and countries, full of cross cultural energetic youths ready to come up with any sort of help required by a friend. With the vision -Friend for a friend and together friends for the nation-, for social & environmental well being, this group started blood donation activities in 15th February 2018 under the banner of Blood Bank 0204, and in the first year of operation, we have collected more than 1700 bags of blood from 1000 members of this great group and donated to save many lives. However, the motto is... No life losses for blood. “Warm Love” (Winter Clothes distribution program) a social welfare program coordinated by this group is an example that significantly indicates the affection and enthusiasm of group members towards humanity. In the year of 2017, the group “SSC 2002 & HSC 2004 Bangladesh” distributed more than 3000 blankets and 2000 winter clothes to the poverty-stricken people in rural areas of Kurigram, Bangladesh. The program “Silent Smile” initiated in the year 2018 and 2019, has brought significant contribution to the socially deprived children, especially for those who cannot afford new dresses in religious festivals like EID & PUJA. We believe, if children are our future then a little smile can bring a brighter future for us to enlighten this society. Evermore, “Run for humanity’ (POST flood campaign) is another social welfare program initiated in 2017 by this group to help the people who are dramatically affected by natural disaster. Every year in Bangladesh, a large number of rural population is affected by over rain, flood & land slide losing their households ending up under the open sky without any food. Most of the time government aid takes too long to reach those disastrous area which is not enough compared to the number of people affected every year. ‘SSC 2002 & HSC 2004 Bangladesh’ distributed dry food and medicine to the people who lost their homes and even lives of close ones in natural devastation. It really is a matter of utmost pride for this group that we came so far only with the sincere contribution of our group members and no fund has yet been raised from outside this group. Being a part of this group really makes one feel proud and prestigious. We are working with same dedication to turn this group into a global platform of peace, friends and beyond all, well being of the humanity.We want to laugh , cry, play and above all, unite and stand together. In every hard time, the harsh world might whisper WHO CARES?? WE proudly SAY, YES WE DO, ALL THE TIME ALL THE WAY ... TOGETHER WITH SSC 2002 & HSC 2004 BANGLADESH FOUNDATION.', 1);

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
-- Table structure for table `app_config_options`
--

CREATE TABLE `app_config_options` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_config_options`
--

INSERT INTO `app_config_options` (`key`, `value`) VALUES
('site_description', 'Web developments by arjunphp.com'),
('site_name', 'arjunphp.com');

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
(1, 'WE ARE HELPING HANDS', 'we-are-helping-hands', 'blog_image/950680c2c971993f7965a3ff4db103a6.jpg', 'Md Abdul Kuddus', '<p>Quisque eros leo, pellentesque id leo non, scelerisque hendrerit mauris. Integer dapibus purus in aliquet vehicula. In laoreet justo ac sapien malesuada laoreet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\n\n<p>Aenean sit amet arcu leo. Donec erat nulla, condimentum eget velit id, condimentum feugiat sem. In pharetra, neque id cursus aliquam, metus justo scelerisque ligula, non rutrum justo massa id velit. Cras vitae magna ipsum.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac augue in libero malesuada aliquam tempus quis justo. Cras mi dolor, consequat quis pellentesque et, laoreet eget libero. Proin luctus sollicitudin venenatis.</p>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.<br />\n<br />\n&lt;blockquote&gt;&lt;p&gt;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.&lt;/p&gt;&lt;/blockquote&gt;<br />\n<br />\n&nbsp;</p>\n\n<p>Sed convallis eleifend volutpat. Sed justo ex, efficitur sit amet nulla at, semper congue nibh. Praesent at convallis nisi. In vehicula eleifend diam, ut tincidunt risus blandit sit amet. Suspendisse potenti. Vestibulum mollis facilisis ligula at convallis.</p>\n\n<p>Nam lacinia, augue ut placerat fermentum, quam sapien congue nisl, vel feugiat mauris diam sit amet nisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut vitae sem pharetra, lacinia diam et, mattis metus.</p>\n\n<p></p>\n', 3, 5, '[\"11\"]', '2020-04-06 12:08:00', 5, 1);

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
(17, 15, 2, 'second time form 2', 'for@1.com', 'www.facebook.com', 'ftfttft', '2020-03-28 05:06:51', 1),
(18, 12, 1, 'Ln Md Ismail Hossain Regan', 'admin@admin.com45', 'dfsasdfasdf', 'asdfasdfasd asdfsadf asdf', '2020-04-20 15:07:38', 1),
(19, 10, 1, 'Imtiaz Ur Rahman Khan', 'admin@admin.com', 'dfsasdfasdf', 'asdfasdfasdfasdfasdf asdfasdf asdf 3242342324', '2020-04-20 15:07:56', 1),
(20, 10, 1, 'Jibanananda Das', 'ma.kuddus37@gmail.com', 'dfsasdfasdf', 'oliyutrbtgvrfefwekifyumtrbevw afsdasd fa', '2020-04-20 15:08:21', 1);

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

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `order_id`, `customer_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `tax`, `discount`, `subtotal`, `picture`, `coupon`, `coupon_amount`, `type`) VALUES
(7, '5ec0e1417800e', 0, 10, 'WE ARE HELPING HANDS', 2, '500.00', '0.00', '0.00', '1000.00', 'causes_images/7c7143780e8727f9c7232a15ddb2058a.jpg', NULL, NULL, 'cause'),
(9, '5ec0e1417800e', 0, 11, 'School Management System', 2, '300.00', '0.00', '0.00', '600.00', 'causes_images/8c2e4c74dba23fedec118b221fa0bbb4.jpg', NULL, NULL, 'cause'),
(10, '5ec0e1417800e', 0, 2, 'YELLOW SKIRT', 2, '1500.00', '300.00', '0.00', '3000.00', 'products/0b7c434489d5cf412b4c554c7693680e.jpg', NULL, NULL, 'product'),
(11, '5ec0e1417800e', 0, 1, 'Warm Cloths For Street Child in Bangladesh', 2, '200.00', '0.00', '0.00', '400.00', 'events/b94bd507249329582a2278de34376d1e.jpg', NULL, NULL, 'event');

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
(1, 0, 'Cloths', 1),
(2, 1, 'Ladies', 1),
(3, 1, 'Jents', 1);

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
(12, 'WE ARE HELPING HANDS 123', 'we-are-helping-hands-', 'causes_images/809008ce50f0618f13a560e96aaaeb4e.jpg', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 'Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quam. Etiam molestie odio lacus, vulputate feugiat tortor condimentumsimple dummy content eu.', 6, '343434.00', '0.00', '2020-04-07 14:35:09', 1, 0);

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
  `value` varchar(500) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `value`, `title`, `status`) VALUES
(1, 'shipping_charge', '100', 'Product Shipping Charge', 1),
(2, 'product_per_page', '6', 'Product show Per Page', 1),
(3, 'company_name', 'ZerotwoZerofour', 'Company Name', 1),
(4, 'company_address', 'test address', 'Company Address', 1),
(5, 'company_city', 'test city', 'Company City', 1),
(6, 'company_country', 'Bangladesh', 'Company Country', 1),
(7, 'company_phone', '0123456789', 'Company  Phone', 1),
(8, 'company_email', 'email@email.com', 'Company  Email', 1),
(9, 'site_logo', 'logo_image/f77ec9e985ab1a5d8647da008f6054b3.png', 'Company Logo', 1),
(10, 'protocol', 'smtp', 'Mail Protocol', 1),
(11, 'smtp_host', 'smtp.googlemail.com', 'SMTP Host Name', 1),
(12, 'smtp_user', 'kuddus.ecom1@gmail.com', 'SMTP User', 1),
(13, 'smtp_pass', 'kuddus@gmail.01834776137', 'SMTP password', 1),
(14, 'smtp_port', '465', 'SMTP Port', 1),
(15, 'smtp_crypto', 'ssl', 'SMTP encryption', 1),
(16, 'newline', '\\r\\n', 'New Line', 1),
(17, 'crlf', '\\r\\n', NULL, 1),
(18, 'mailtype', 'html', 'Mail Type', 1),
(19, 'fb_link', 'kuddus137', 'Facebook Page Name (eg. zerotwozerofour)', 1),
(20, 'twt_link', 'kuddus137', 'Twitter Account Name', 1),
(21, 'linkedin_link', 'kuddus137', 'Linked In Account Name', 1),
(23, 'donation_first_amount', '10', 'Pre defined First amount for donation', 1),
(24, 'donation_second_amount', '100', 'Pre defined Second amount for donation', 1),
(25, 'donation_third_amount', '200', 'Pre defined Third amount for donation', 1),
(26, 'donation_fourth_amount', '300', 'Pre defined Fourth amount for donation', 1),
(27, 'donation_fifth_amount', '500', 'Pre defined Fifth amount for donation', 1),
(28, 'aamarpay_store_id', '0204bangladesh', 'Aamarpay Store Id', 1),
(29, 'aamarpay_merchant_id', '0204bangladesh', 'Aamarpay Merchant Id', 1),
(30, 'aamarpay_signature_key', 'ad4684e4ca8ea850643a016279f9b6d6', 'Aamarpay Signature Key', 1);

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
(3, 'This is First Desclaimer', '&lt;p&gt;This is the first disclaimer content&lt;/p&gt;\r\n', 1);

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
(8, 'Md Saheh Uddin', 'saleh@gmail.com', '01234567891', 'donor/183832e7da9a3ba57548c346c4698976.jpg', 1);

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
(1, 'Warm Cloths For Street Child in Bangladesh', 'warm-cloths-for-street-child-in-bangladesh', 'Street and slum children desperately need warm clothes to get protection from cold but these poor children face shivery cold with bare body. But, this winter, these 150 poor street children may get protection from cold with woolen Dress (jacket, sweater, ', 2, '2020-11-26', '2021-06-30', 'events/b94bd507249329582a2278de34376d1e.jpg', '<h2>Challenge</h2>\n\n<p><span xss=removed>Street and slum children have to live nearby streets in cold breeze without warm clothes which gets them pneumonia, fever and many other seasonal ailment.</span></p>\n\n<h2>Solution</h2>\n\n<p><span xss=removed>The warm clothes Dress (sweater, jacket, woolen cap, socks) will protect the 150 poor street children from cold in winter and also get them relief by which these children will have sound sleep fearless of cold.</span></p>\n\n<h2>Long-Term Impact</h2>\n\n<p><span xss=removed>Street & slum children will get protection from seasonal ail in winter. The destitute street children will have more faith on humanity and mankind. They health will be better.</span></p>\n', 'po : 4000, Chittagong, Bangladesh', '200.00', 1, '2020-03-25 08:33:29', '2020-03-25 08:33:29');

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
(1, 'Food for Child', 1),
(2, 'Warm Cloths for street child ', 1);

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
(2, 'This is second Faq question', '&lt;p&gt;This is our first faq&lt;/p&gt;\r\n', 1);

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
(2, 'members', 'General User'),
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
(13, 'checkout_page', 'Checkout Page Header Image', 'header_image/acae6d7f63e78b1e29564679ef3472ca.jpg', 1),
(14, 'cart_page', 'Cart Page Header Image', 'header_image/cf4e83290ec16853da04a3d68a47a471.jpg', 1);

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
  `board_member_order` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `password_reset_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `mobile`, `street_address`, `address_line`, `city`, `post_code`, `country`, `state`, `password`, `member_photo`, `registration_card`, `designation`, `board_member_order`, `is_active`, `password_reset_code`) VALUES
(6, 'Md Jasim Uddin', 'jasim@gmail.com', '01234567891', '5 no road', 'nasirabad', 'chittagong', '4225', 'Bangladesh', 'Chittagong', '$argon2i$v=19$m=2048,t=4,p=3$cDVxVDRsN2YyUGNDSzZmMQ$CSEkN9ZNGSfm6jqjxk1l5C2BOGI3667Ri82CLrLICPw', 'member/167b9021593f9df3af8a609830047e13.jpg', 'member/9ac6e39c100ee6c34dde03867fe56a90.jpg', '1', 1, 1, NULL);

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
(1, 'This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description This is the mission description ', 'This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description This is the vision description ', 'WHO CARES?? WE proudly SAY, YES WE DO, ALL THE TIME ALL THE WAY ... TOGETHER WITH SSC 2002 & HSC 2004 BANGLADESH FOUNDATION.');

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
  `tran_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `orders` (`id`, `order_id`, `order_status`, `coupon`, `customer_id`, `company_name`, `customer_name`, `customer_email`, `customer_phone`, `customer_city`, `customer_address1`, `customer_address2`, `customer_country`, `customer_state`, `customer_zipp_code`, `payment_method`, `tran_id`, `paid_amount`, `payment_status`, `price`, `quantity`, `tax`, `order_notes`, `is_active`, `order_at`) VALUES
(2, '5eb51318041e6', 0, NULL, 6, '', 'Md Jasim Uddin', 'jasim@gmail.com', '01234567891', 'chittagong', '5 no road', 'nasirabad', 'Bangladesh', 'Chittagong', '4225', NULL, 'EVIVS9PLXV', '5.00', 'Successful', '5.00', 1, '0.00', NULL, 0, '2020-05-17 15:52:52'),
(4, '5eb51318041e4', 0, NULL, 6, '', 'Md Jasim Uddin', 'jasim@gmail.com', '01234567891', 'chittagong', '5 no road', 'nasirabad', 'Bangladesh', 'Chittagong', '4225', NULL, 'VB6QG47L5W', '5.00', 'Successful', '5.00', 1, '0.00', NULL, 0, '2020-05-17 16:15:23');

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
(1, '5eb51318041e4', 1, 0, 'School Management System', '5.00', 1, '0.00', '0.00', '0.00', '0.00', 11, 'cause'),
(2, '5eb51318041e6', 1, 0, 'School Management System', '5.00', 1, '0.00', '0.00', '0.00', '0.00', 11, 'cause');

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
(1, 'This is first heading', '&lt;p&gt;This is the first privacy policy&lt;/p&gt;\r\n', 1),
(2, 'This is second heading', '&lt;p&gt;This is the second privacy&lt;/p&gt;\r\n', 1);

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
(1, 'gray t-shirt', 'gray-tshirt', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 3, '200', '500', '', '1', '15', '[\"1\"]', '[\"1\",\"2\"]', '0', 'products/301c7059efc8e54a3c846bad0c75ad86.jpg', '2020-03-21 06:28:37', '2020-03-21 06:28:37', 1),
(2, 'YELLOW SKIRT', 'yellow-skirt', '', '<p>fadfasdf sadfasdf asfasdf</p>\n', 1, 2, '1000', '1500', '', '1', '20', '[\"2\"]', '[\"1\",\"3\"]', '0', 'products/0b7c434489d5cf412b4c554c7693680e.jpg', '2020-03-21 06:51:12', '2020-03-21 06:51:12', 1),
(3, 'cool blue top', 'cool-blue-top', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '600', '1000', '', '1', '99', '[\"1\"]', '[\"3\"]', '0', 'products/b07ba7f07cfee31fe6dcdd372e783813.jpg', '2020-03-21 10:27:19', '2020-03-21 10:27:19', 1),
(4, 'gray t-shirt', 'gray-tshirt-01', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 3, '1000', '1200', '', '1', '20', '[\"1\"]', '[\"1\",\"2\"]', '0', 'products/80e7a2656e41017744f599ea0f1d6919.jpg', '2020-03-21 10:27:59', '2020-03-21 10:27:59', 1),
(5, 'yellow top', 'yellow-top', '', '<p>A quick brown fox jumps over the layt dog.</p>\n', 1, 2, '400', '500', '', '1', '10', '[\"2\"]', '[\"2\"]', '0', 'products/6ee1a9936f6727d647c86d08008d3fa4.jpg', '2020-03-21 10:28:28', '2020-03-21 10:28:28', 1);

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
(34, 6, 'products/3fa2a74666eac6f35cdba8a079b06791.jpg', 1),
(35, 6, 'products/f803a260245b4b2a5cc5bc969d7925ee.jpg', 1),
(37, 5, 'products/ef3c0933133b0f7eeea48d7a8fb7023e.jpg', 1),
(38, 5, 'products/77baffcd9c0ece1685c989677b07aa18.jpg', 1),
(39, 5, 'products/d1e240c5caa36644b33a77bf83a6b914.jpg', 1),
(40, 3, 'products/51e1a6a3f011804b82dce008a201a8cd.jpg', 1),
(41, 3, 'products/e9db977f58603ab5d1b9dd3ef96c9a88.jpg', 1),
(42, 3, 'products/88314ac88d8a6d263d517bd85002a411.jpg', 1),
(43, 2, 'products/a4c6d88e61e52008715e6c091f2a1318.jpg', 1),
(44, 2, 'products/d48f0aebcb0f5a8e0394af8151b9e29b.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `product_id`, `member_id`, `review`, `is_active`, `is_seen`, `created_at`, `rating`) VALUES
(8, 1, 5, 'aasdfadsf', 1, 0, '2020-04-20 14:57:36', NULL),
(9, 1, 5, 'asdfasdf adf', 0, 0, '2020-04-20 15:21:44', 4);

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
(6, 'This is frist title', 'This is first description', 'slider_image/fd598f69b252c3fdc7cbdfe8438d740f.jpg', 'www.facebook.com', 1, ''),
(7, 'School Management System', 'This is test deswcription', 'slider_image/48a0439c3774e882b040a16241484551.jpg', 'test url', 1, '');

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
(3, 'This is First Heading', '&lt;p&gt;Here will be terms and condition&lt;/p&gt;\r\n', 1),
(4, 'This is second terms and condition', '&lt;p&gt;This is the second term and conditions&lt;/p&gt;\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `mer_txnid` varchar(200) NOT NULL,
  `store_id` varchar(200) DEFAULT NULL,
  `store_amount` varchar(200) DEFAULT NULL,
  `pay_time` varchar(200) DEFAULT NULL,
  `bank_txn` text,
  `card_number` varchar(200) DEFAULT NULL,
  `card_holder` varchar(200) DEFAULT NULL,
  `card_type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `phone` varchar(20) DEFAULT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `image`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$FvfpQho1FzlkN/BNP557yeQ//.aBWRJoyoetxmfQeUEfv4PdbdOxC', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1589913630, 1, 'Admin', 'istrator', 'ADMIN', '0', 'administration/443d2456b5b0d2fc47908803b086ae1e.jpg'),
(5, '::1', 'ma.kuddus37@gmail.com', '$2y$12$MIkKliqQ1ancapULc.BcdOzCz8iBNMv5xsX58ocZxdxcSXkpkMDoK', 'ma.kuddus37@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1587377964, 1587383576, 1, 'Md Abdul', 'Kuddus', 'ZerotwoZeroFour', '012345678910', 'administration/61572ccc262c582512a69ac8e45a7d25.jpg');

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
(16, 1, 1),
(17, 1, 2),
(18, 1, 3),
(27, 5, 1),
(28, 5, 2);

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
(11, 'Hasibur Rahman', 'hasib@gmail.com', '01234567891', ' khulsi ', '4 no. road', 'chittagong', '4225', 'Bangladesh', 'Chittagong', 'volunteer/e73f4a51a675ad225d77c5a0da0cbf5b.jpg', 1);

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
-- Indexes for table `app_config_options`
--
ALTER TABLE `app_config_options`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
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
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `header_image`
--
ALTER TABLE `header_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_pictures`
--
ALTER TABLE `product_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `terms_conditons`
--
ALTER TABLE `terms_conditons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
