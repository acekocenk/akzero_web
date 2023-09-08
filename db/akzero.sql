-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 11:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akzero`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_code` varchar(20) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_code`, `item_name`, `slug`, `item_img`, `created_at`, `updated_at`) VALUES
('aaa', 'aaa', 'aaa', 'aaa.jpg', '2023-05-17 03:32:52', '2023-05-17 03:32:52'),
('CRLCBRBEI38MM', 'COMPONENT ROLLER COVER BREAKET BEIGE 38MM', 'component-roller-cover-breaket-beige-38mm', 'CRLCBRBEI38MM.jpg', '2023-05-10 09:22:25', '2023-05-10 09:22:25'),
('CRLCBRBLK38MM', 'COMPONENT ROLLER COVER BREAKET BLACK 38MM', 'component-roller-cover-breaket-black-38mm', 'CRLCBRBLK38MM.jpg', '2023-05-10 09:10:50', '2023-05-10 09:10:50'),
('CRLCBRGRY38MM', 'COMPONENT ROLLER COVER BREAKET GREY 38MM', 'component-roller-cover-breaket-grey-38mm', 'CRLCBRGRY38MM.jpg', '2023-05-10 09:18:40', '2023-05-10 09:18:40'),
('CRLCBRIVR38MM', 'COMPONENT ROLLER COVER BREAKET IVORY 38MM', 'component-roller-cover-breaket-ivory-38mm', 'CRLCBRIVR38MM.jpg', '2023-05-10 09:17:55', '2023-05-10 09:17:55'),
('CRLCBRWHT38MM', 'COMPONENT ROLLER COVER BREAKET WHITE 38MM', 'component-roller-cover-breaket-white-38mm', '', '2023-05-10 09:07:43', '2023-05-10 09:07:43'),
('CRLIDLXXX38MM', 'COMPONENT ROLLER IDLE 38MM', 'component-roller-idle-38mm', 'CRLIDLXXX38MM.jpg', '2023-05-11 02:41:07', '2023-05-11 02:41:07'),
('CRLMCHXXX38MM', 'COMPONENT ROLLER MECHANISM 38MM', 'component-roller-mechanism-38mm', 'CRLMCHXXX38MM.jpg', '2023-05-11 02:40:00', '2023-05-11 02:40:00'),
('FRRESSICE03.00M', 'FABRIC ESSENTIAL ICE 03.00M', 'FABRIC_ESSENTIAL_ICE_03.00M', 'FABRIC_ESSENTIAL_ICE_03.00M.jpg', '2023-05-05 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `product_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `product_name`, `slug`, `created_at`, `updated_at`, `product_img`) VALUES
(1, 'ROLL', 'ROLLER BLIND', 'roller-blind', '2023-05-16', '2023-05-23', 'ROLL.jpg'),
(2, 'VERT', 'VERTICAL BLIND', 'vertical-blind', '2023-05-16', '2023-05-16', 'VERT.jpg'),
(3, 'PNEL', 'PANEL GLIGE', 'panel-glige', '2023-05-17', '2023-05-17', 'PNEL.jpg'),
(4, 'ROMN', 'ROMAN BLIND', 'roman-blind', '2023-05-17', '2023-05-23', 'ROMN.jpg'),
(23, 'ASD', 'ASD', 'asd', '2023-05-23', '2023-05-23', '1684830684_949e8f281cdf5ad5e3c2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(3) NOT NULL,
  `kode` varchar(3) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `kode`, `warna`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'WHT', 'WHITE', 'WHITE', '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
