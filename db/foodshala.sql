-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 09:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `food_id` int(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `pref` tinyint(1) NOT NULL,
  `phone_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `pref`, `phone_no`) VALUES
(1, 'a', 'a@a', 'b09a418e0be8e9bde0d091738c655d066b5b7e30441672d79251708c58e577bc', 0, '1234567890'),
(2, 'b', 'b@b', 'bdb6286b5bf42fd244242bc68adb189bbce9e7628e8ef1fc3f210fd744066926', 0, '0123456789'),
(3, 'c', 'c@c', '0e634c8845d25fe60b7b2b564ec5036ef524d397206e84265a30d20897cd1b6a', 0, '9999999999'),
(4, 'd', 'd@d', '82b9af81aebaed62bc06db1e9bc08baa661502d5481536097969050d2ba7f01d', 1, '9999999999'),
(5, 'abcd', 'abcd@abcd', 'a5e18d5420ee6f9020ffadfd4a5d59a5e766034f098798dcce558e955066e5e9', 1, '8888888888');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(5) NOT NULL,
  `res_id` int(5) NOT NULL,
  `pref` tinyint(1) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `price`, `res_id`, `pref`, `image`) VALUES
(1, 'Biryani', 120, 1, 1, 'images/biryani.jpg'),
(4, 'Pizza', 200, 2, 0, 'images/pizza.jpg'),
(6, 'Salad', 80, 3, 0, 'images/salads.jpg'),
(7, 'Fish', 250, 3, 1, 'images/fish.jpg'),
(8, 'Prawn Biryani', 180, 3, 1, 'images/prawn_biryani.jpg'),
(9, 'Mutton', 300, 4, 1, 'images/mutton_dum_biryani.jpg'),
(10, 'Jalebi', 320, 4, 0, 'images/jalebi.jpg'),
(11, 'Pulaav', 70, 4, 0, 'images/pulav.jpg'),
(14, 'Plain Naan', 15, 1, 0, 'images/plain_naan.JPG'),
(15, 'Samosa', 10, 1, 0, 'images/indian_cuisine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(5) NOT NULL,
  `food_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food_id`, `quantity`, `user_id`, `time`) VALUES
(2, 10, 1, 1, '2020-05-25 20:57:51'),
(3, 4, 1, 1, '2020-05-25 20:57:51'),
(4, 7, 3, 2, '2020-05-25 20:59:01'),
(5, 11, 2, 2, '2020-05-25 20:59:01'),
(6, 4, 1, 2, '2020-05-25 20:59:01'),
(8, 6, 3, 3, '2020-05-25 21:00:12'),
(10, 9, 1, 3, '2020-05-25 21:00:12'),
(11, 1, 2, 4, '2020-05-25 21:01:19'),
(12, 9, 3, 4, '2020-05-25 21:01:19'),
(13, 8, 1, 4, '2020-05-25 21:01:20'),
(14, 7, 2, 4, '2020-05-25 21:01:20'),
(15, 6, 2, 4, '2020-05-25 21:01:20'),
(17, 4, 1, 4, '2020-05-25 21:01:20'),
(19, 10, 1, 4, '2020-05-25 21:01:20'),
(20, 11, 2, 4, '2020-05-25 21:01:20'),
(21, 9, 3, 1, '2020-05-25 21:09:43'),
(22, 4, 10, 3, '2020-05-25 22:00:54'),
(23, 10, 1, 3, '2020-05-25 22:00:54'),
(24, 1, 2, 3, '2020-05-25 22:02:00'),
(25, 6, 2, 3, '2020-05-25 22:31:00'),
(26, 6, 2, 1, '2020-05-27 01:15:04'),
(27, 14, 6, 1, '2020-05-27 01:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `restaurents`
--

CREATE TABLE `restaurents` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurents`
--

INSERT INTO `restaurents` (`id`, `name`, `email`, `password`, `location`) VALUES
(1, 'a', 'a@a', 'b09a418e0be8e9bde0d091738c655d066b5b7e30441672d79251708c58e577bc', 'a'),
(2, 'b', 'b@b', 'bdb6286b5bf42fd244242bc68adb189bbce9e7628e8ef1fc3f210fd744066926', 'b'),
(3, 'c', 'c@c', '0e634c8845d25fe60b7b2b564ec5036ef524d397206e84265a30d20897cd1b6a', 'c'),
(4, 'd', 'd@d', '82b9af81aebaed62bc06db1e9bc08baa661502d5481536097969050d2ba7f01d', 'd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurents`
--
ALTER TABLE `restaurents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `restaurents`
--
ALTER TABLE `restaurents`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
