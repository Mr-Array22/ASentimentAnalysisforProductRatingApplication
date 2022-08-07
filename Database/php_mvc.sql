-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 12:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Man'),
(2, 'Women'),
(3, 'Children'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `member_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `comment_description` text CHARACTER SET utf8 NOT NULL,
  `comment_date` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comment_value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `member_name`, `comment_description`, `comment_date`, `product_id`, `member_id`, `comment_value`) VALUES
(38, 'Mostafa ', 'good for price\r\nfair for quality\r\namazing in leg', '2022-05-11 22:59:18', 3, 7, 7.3333333333333),
(44, 'mostafa', 'bad and Horrible', '2022-05-11 22:50:50', 5, 2, 2),
(45, 'mostafa', 'good and fair', '2022-05-11 22:53:08', 4, 2, 6),
(47, 'Mostafa ', 'cool and amazing for quality\r\n', '2022-05-20 20:42:44', 1, 7, 9),
(48, 'Mostafa ', 'excellent for quality\r\nfair for price', '2022-05-12 17:13:22', 2, 7, 8.5),
(49, 'Hana', 'amazing', '2022-05-12 20:38:52', 1, 8, 10),
(50, 'Hana', 'cool for quailty\r\ngood for price', '2022-05-12 20:39:18', 5, 8, 6.5),
(53, 'Mostafa ', 'excellent', '2022-05-12 22:10:05', 5, 7, 10),
(54, 'hana', 'amazing', '2022-05-13 01:16:31', 5, 9, 10),
(55, 'salah', 'good for price and fair for quality', '2022-05-13 01:17:17', 4, 10, 6),
(56, 'nour', 'excellent', '2022-05-13 01:18:05', 3, 11, 10),
(57, 'nour', 'excellent', '2022-05-13 01:18:19', 4, 11, 10),
(58, 'nour', 'fair and cool', '2022-05-13 01:18:28', 6, 11, 7.5),
(59, 'hana', 'good and cute', '2022-05-13 02:41:51', 6, 9, 7),
(62, 'mariam', 'amazing', '2022-05-16 15:04:44', 5, 13, 10),
(63, 'mariam', 'bad and horriable', '2022-05-16 15:05:19', 1, 13, 2),
(65, 'fatima', 'good and fair', '2022-05-16 19:49:13', 3, 12, 6),
(66, 'fatima', 'excellent', '2022-05-16 19:49:25', 6, 12, 10),
(67, 'fatima', 'cute and amazing', '2022-05-16 19:49:38', 2, 12, 9.5),
(68, 'fatima', 'good for price, excellent for quality ', '2022-05-16 19:50:11', 1, 12, 7.5),
(69, 'fatima', 'amazing and fair', '2022-05-16 19:50:51', 5, 12, 8.5),
(70, 'amel', 'amazing', '2022-05-16 20:38:04', 6, 14, 10),
(72, 'Mostafa ', 'fair and amazing', '2022-05-20 20:42:28', 6, 7, 8.5);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `name`, `value`) VALUES
(2, 'bad', 2),
(3, 'Excellent', 10),
(10, 'Good', 5),
(11, 'acceptable', 8),
(12, 'adorable', 10),
(13, 'amazing', 10),
(14, 'attractive', 10),
(15, 'beautiful', 10),
(16, 'awesome', 10),
(17, 'cool', 8),
(18, 'fabulous', 10),
(19, 'cute', 9),
(20, 'fair', 7),
(21, 'gorgeous', 10),
(22, 'incredible', 10),
(23, 'satisfied', 9),
(24, 'Horrible', 2),
(25, 'terrible', 2),
(26, 'disgusting', 1),
(27, 'odious', 1),
(28, 'exaggerated', 2),
(29, 'dreadful', 2),
(30, 'foul', 1),
(31, 'upsetting', 1),
(32, 'ugly', 1),
(33, 'healthful', 6);

-- --------------------------------------------------------

--
-- Table structure for table `lines_orders`
--

CREATE TABLE `lines_orders` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `units_order` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lines_orders`
--

INSERT INTO `lines_orders` (`id`, `order_id`, `product_id`, `units_order`) VALUES
(2, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `cost` float(200,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `state`, `city`, `adress`, `cost`, `status`, `date`, `hour`) VALUES
(2, 2, 'helwan', 'cairo', '27 moahmed syad ahmed', 350.00, 'sended', '2022-05-03', '18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `offer` varchar(2) DEFAULT NULL,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `offer`, `date`, `image`) VALUES
(1, 1, 'Adidas 1', 'Adidas Tennis for Men', 100.00, 50, NULL, '2022-05-03', 'adidas1.jpg'),
(2, 2, 'Adidas 2', 'Adidas Tennis for Women', 150.00, 100, NULL, '2022-05-03', 'adidas2.jpg'),
(3, 3, 'Adidas 3', 'Adidas Tennis for Kids', 200.00, 50, NULL, '2022-05-03', 'adidas3.jpg'),
(4, 4, 'Adidas4', 'Sportive and gorgoues', 350.00, 10, NULL, '2022-05-03', 'addidas 5.jpg'),
(5, 4, 'Adidas 5', 'adidas 4DFWD Shoes New Colorways\r\n', 400.00, 50, NULL, '2022-05-06', '003bcf24e0f144028770ad4f00abc0e6_9366.png'),
(6, 4, 'Adidas 6', 'Adidas Mens Barricade Team 4', 700.00, 200, NULL, '2022-05-11', 'Adidas-Shoes-8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `rol`, `image`) VALUES
(2, 'mostafa', 'gamal', 'mostafa@mo.com', '$2y$04$0z0WRqISho0v5EcQ5q/69eghRhQcVGztNFQ/76TQoiaK3MBXxyW4e', 'admin', NULL),
(7, 'Mostafa ', 'Gamal', 'mostafa22@gmail.com', '$2y$04$WBmxdW7mjDCieGYOQ7NWi.m1T3Blv7JI3kDKwsd57eZs8FUJa5LNi', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lines_orders`
--
ALTER TABLE `lines_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_line_order` (`order_id`),
  ADD KEY `fk_line_product` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `lines_orders`
--
ALTER TABLE `lines_orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lines_orders`
--
ALTER TABLE `lines_orders`
  ADD CONSTRAINT `fk_line_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_line_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
