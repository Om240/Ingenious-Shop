-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `price`) VALUES
(1, '8901000100011', 'Rice', 40.00),
(2, '8901000100022', 'Wheat Flour', 40.00),
(3, '8901000100033', 'Lentils (Dal)', 80.00),
(4, '8901000100044', 'Sugar', 43.00),
(5, '8901000100055', 'Salt', 80.00),
(6, '8901000100066', 'Tea Leaves', 800.00),
(7, '8901000100077', 'Coffee Powder', 600.00),
(8, '8901000100088', 'Cooking Oil', 100.00),
(9, '8901000100099', 'Turmeric Powder', 250.00),
(10, '8901000100105', 'Coriander Powder', 600.00),
(11, '8901000100116', 'Cumin Seeds (Jeera)', 1000.00),
(12, '8901000100127', 'Mustard Seeds (Sarson)', 800.00),
(13, '8901000100138', 'Red Chili Powder', 700.00),
(14, '8901000100149', 'Garam Masala', 600.00),
(15, '8901000100150', 'Cinnamon (Dalchini)', 400.00),
(16, '8901000100161', 'Cardamom (Elaichi)', 1500.00),
(17, '8901000100172', 'Cloves (Laung)', 200.00),
(18, '8901000100183', 'Black Pepper', 200.00),
(19, '8901000100194', 'Fenugreek Seeds (Methi)', 300.00),
(20, '8901000100200', 'Curry Leaves', 300.00),
(21, '8901000100211', 'Basmati Rice', 100.00),
(22, '8901000100222', 'Sona Masoori Rice', 120.00),
(23, '8901000100233', 'Rava (Semolina)', 40.00),
(24, '8901000100244', 'Poha (Flattened Rice)', 40.00),
(25, '8901000100255', 'Vermicelli', 50.00),
(26, '8901000100266', 'Jaggery (Gur)', 70.00),
(27, '8901000100277', 'Honey', 180.00),
(28, '8901000100288', 'Peanut Butter', 320.00),
(29, '8901000100299', 'Jam', 145.00),
(30, '8901000100305', 'Tomato Ketchup', 110.00),
(31, '8901000100316', 'Vinegar', 80.00),
(32, '8901000100327', 'Soy Sauce', 99.00),
(33, '8901000100338', 'Chili Sauce', 99.00),
(34, '8901000100349', 'Pickles', 99.00),
(35, '8901000100350', 'Mayonnaise', 99.00),
(36, '8901000100361', 'Instant Noodles', 14.00),
(37, '8901000100372', 'Pasta', 80.00),
(38, '8901000100383', 'Macaroni', 80.00),
(39, '8901000100394', 'Breakfast Cereals', 99.00),
(40, '8901000100400', 'Oats', 99.00),
(41, '8901000100411', 'Cornflakes', 99.00),
(42, '8901000100422', 'Muesli', 99.00),
(43, '8901000100433', 'Bread', 40.00),
(44, '8901000100444', 'Butter', 50.00),
(45, '8901000100455', 'Cheese', 90.00),
(46, '8901000100466', 'Milk', 32.00),
(47, '8901000100477', 'Yogurt', 55.00),
(48, '8901000100488', 'Paneer', 44.00),
(49, '8901000100499', 'Cream', 50.00),
(50, '8901000100505', 'Ice-Cream', 80.00),
(96, '2343434343434', 'jdjhfjdhfjdhf', 600.00),
(97, '7676767676767', 'Sample Product', 700.00),
(98, '1212121312131', 'Sample Product', 434.00),
(99, '1232323232323', 'Sample Product', 11.00),
(101, '1232123212321', 'Ice Box', 200.00),
(102, '1212121212121', 'Parle G', 20.00),
(103, '1212121212121', 'Sample Product', 50.00),
(104, '0987654321234', 'Kitkat', 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `gst_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `company_name`, `address`, `gst_number`) VALUES
('Akshi@123', 'Akshi@992', NULL, NULL, NULL),
('Bansi@123', 'Bansi@992', NULL, NULL, NULL),
('Megh@123', 'Megh@992', 'Meghraj Association', 'Bodeli', '24ABCDE1234C1FG'),
('Om@123', 'om@992', 'OM ASSOCIATION', 'Navsari', '24HTJPD4355N1ZQ'),
('Raj@123', 'Raj@992', 'RAJ ASSOCIATION', 'PADRA', '24RAJAB1234N1BC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `gst_number` (`gst_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
