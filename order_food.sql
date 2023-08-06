-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 أغسطس 2023 الساعة 23:31
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_food`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'shaheen aerf', 'shaheen', '123456'),
(6, 'husam khaled', 'alwfa', ' 1130120'),
(7, 'moaed basher', 'abu khaled', ' 130120'),
(8, 'ahmed bassam', 'abu bassam', ' 321654'),
(9, 'yahya salman', ' abu aljoud', ' 0592525'),
(10, 'abdullah adly', ' abu adam', ' 4324'),
(11, 'mohammed hussein', ' doctor', ' 1234');

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Featured` varchar(30) NOT NULL,
  `Active` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id`, `title`, `Image`, `Featured`, `Active`) VALUES
(15, 'zzzzz', ' ../images/logo.png', 'No', 'Yes'),
(20, 'dcdscsd', ' ../images/logo.png', ' Yes', 'Yes'),
(21, 'sssssaaaa', ' ../images/logo.png', ' No', 'Yes'),
(22, 'ccccc', ' ../images/logo.png', ' Yes', 'No');

-- --------------------------------------------------------

--
-- بنية الجدول `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `titele` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Featured` varchar(30) NOT NULL,
  `Active` varchar(20) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `food`
--

INSERT INTO `food` (`id`, `titele`, `Price`, `Image`, `Featured`, `Active`, `cat_id`, `Description`) VALUES
(5, '4533', 235, ' ../images/logo.png', ' Yes', 'No', 15, 'ergt'),
(7, 'uuuuuu', 21, ' ../images/logo.png', ' Yes', 'No', 20, 'frgergfrg');

-- --------------------------------------------------------

--
-- بنية الجدول `order_food`
--

CREATE TABLE `order_food` (
  `id` int(11) NOT NULL,
  `Food` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `Qty` double NOT NULL,
  `Total` double NOT NULL,
  `Order_date` datetime NOT NULL,
  `Status_order` int(11) NOT NULL,
  `Customer_name` varchar(50) NOT NULL,
  `Contact` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_food`
--

INSERT INTO `order_food` (`id`, `Food`, `Price`, `Qty`, `Total`, `Order_date`, `Status_order`, `Customer_name`, `Contact`, `Email`, `Address`) VALUES
(9, 'jgyhhj', 6, 5, 30, '2023-06-22 12:31:57', 5, 'ddddddd', 0, 'shaheen.a.h.abusitta@gmail.com', 'gegth');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_food` (`cat_id`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_order` (`Status_order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `cat_food` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- القيود للجدول `order_food`
--
ALTER TABLE `order_food`
  ADD CONSTRAINT `cat_order` FOREIGN KEY (`Status_order`) REFERENCES `food` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
