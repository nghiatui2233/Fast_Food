-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 12:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fast_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `IDAdmin` int(10) NOT NULL,
  `Account` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `FullName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IDAdmin`, `Account`, `Password`, `FullName`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `icon`) VALUES
('EI1336', 'Pizza', 'fa-pizza-slice'),
('FY1730', 'Fries', 'fa-bacon'),
('JL3972', 'Burger', 'fa-hamburger'),
('LX3204', 'Chicken', 'fa-drumstick-bite'),
('YP3430', 'Drink', 'fa-beer');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Day` int(11) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `UserName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=UTF8MB4_UNICODE_CI;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerName`, `Gender`, `Address`, `Phone`, `Email`, `Day`, `Month`, `Year`, `UserName`, `Password`, `date_created`) VALUES
('Sumo', 0, 'TP.HCM', '0914755372', 'nghiatui2255@gmail.com', 18, 2, 2002, 'nghiatui112', 'e10adc3949ba59abbe56e057f20f883e', '2023-04-19 05:18:24'),
('Pham Huu Nghia', 0, 'TP.Can Tho', '0914755372', 'nghiatui5588@gmail.com', 19, 2, 1989, 'nghiatui113', 'e10adc3949ba59abbe56e057f20f883e', '2023-04-19 05:18:24'),
('Nghia', 0, 'TP.Can Tho', '12312321', 'nghiatui113@gmail.com', 21, 3, 2007, 'nghiatui2233', '25f9e794323b453885f5181f1b624d0b', '2023-04-19 05:18:24');


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_price` float NOT NULL,
  `date_buy` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `total_price`, `date_buy`, `status`) VALUES
('CB6158', 'nghiatui112', 8.4, '2023-04-10 14:50:41', 0),
('FQ7336', 'nghiatui112', 16.17, '2023-04-10 14:32:34', 0),
('HY6528', 'nghiatui2233', 21.525, '2023-04-08 13:19:25', 3),
('QI4006', 'nghiatui112', 8.61, '2023-04-10 14:33:21', 0),
('SF8115', 'nghiatui113', 11.025, '2023-04-08 11:58:58', 2),
('TI6999', 'nghiatui113', 17.01, '2023-04-08 11:53:27', 3),
('VP7966', 'nghiatui113', 19.32, '2023-04-08 11:53:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_buy` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `price`, `total_price`, `quantity`, `username`, `date_buy`) VALUES
('AE6882', 'FQ7336', 'KMJ60391', 5, 5, 1, 'nghiatui112', '2023-04-10 07:32:34'),
('CT3046', 'SF8115', 'DSH74104', 2.5, 2.5, 1, 'nghiatui113', '2023-04-08 04:58:58'),
('GN1045', 'FQ7336', 'WER89736', 2.5, 2.5, 1, 'nghiatui112', '2023-04-10 07:32:34'),
('GW7777', 'FQ7336', 'CHJ64364', 7.9, 7.9, 1, 'nghiatui112', '2023-04-10 07:32:34'),
('LG2748', 'HY6528', 'DOK21416', 12.5, 12.5, 1, 'nghiatui2233', '2023-04-08 06:19:25'),
('LK2062', 'HY6528', 'CGH36117', 8, 8, 1, 'nghiatui2233', '2023-04-08 06:19:25'),
('MS1644', 'TI6999', 'BKJ62110', 8.2, 8.2, 1, 'nghiatui113', '2023-04-08 04:53:27'),
('OP4327', 'VP7966', 'CHJ64364', 7.9, 7.9, 1, 'nghiatui113', '2023-04-08 04:53:54'),
('OR3638', 'SF8115', 'CGH36117', 8, 8, 1, 'nghiatui113', '2023-04-08 04:58:58'),
('OV2620', 'VP7966', 'HBY12921', 2.5, 2.5, 1, 'nghiatui113', '2023-04-08 04:53:54'),
('UA7512', 'QI4006', 'BKJ62110', 8.2, 8.2, 1, 'nghiatui112', '2023-04-10 07:33:21'),
('UZ7873', 'VP7966', 'CGH36117', 8, 8, 1, 'nghiatui113', '2023-04-08 04:53:54'),
('VL6321', 'YI9588', 'CGH36117', 8, 8, 1, 'nghiatui112', '2023-04-10 07:33:41'),
('WO2130', 'CB6158', 'CGH36117', 8, 8, 1, 'nghiatui112', '2023-04-10 07:50:41'),
('YN8458', 'TI6999', 'CGH36117', 8, 8, 1, 'nghiatui113', '2023-04-08 04:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` varchar(10) NOT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(5) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `category_id`, `price`, `image`, `status`, `description`) VALUES
('BFL54404', 'Cheese Burger 2', 'JL3972', 5.3, 'cheeseburger-2.png', 0, 'Special Burger With Hot Beef Sausage'),
('BKJ62110', 'Pepperoni Pizza', 'EI1336', 8.2, 'pepperoni-pizza.png', 1, 'Special Dengan Topping Peperoni Ayam'),
('CGH36117', 'Roller Box', 'LX3204', 8, 'box-1.png', 1, 'Special Menu Kebab Ayam + Pepsi'),
('CHJ64364', 'Xtra Bacon Special', 'JL3972', 7.9, 'bacon.png', 1, 'Special Burger With Hot Beef Sausage'),
('DOK21416', 'French Fries Original 2', 'FY1730', 12.5, 'fries-4.png', 1, 'Kentang Goreng Crispy Original'),
('DOK26936', 'Pepperoni Pizza With Extra Cheese', 'EI1336', 8.2, 'pizza-1.png', 1, 'Special Dengan Topping Peperoni Ayam + Xtra Keju'),
('DSH74104', 'Fanta', 'YP3430', 2.5, 'fanta.png', 1, 'Minuman Segar Bersoda'),
('ESJ94995', 'Beef Burger 2', 'JL3972', 4.7, 'beef-2.png', 1, 'Special Burger with Cheese Hot Beef Sausage'),
('FMW61246', 'Cheese Fries', 'FY1730', 10, 'cheese-fries.png-2.png', 0, 'Kentang Goreng Dengan Topping Keju'),
('FPY46303', 'Salad Pizza', 'EI1336', 10, 'pizza-5.png', 1, 'Special Dengan Topping Sayur & Daging'),
('FRO28222', 'French Fries KFC', 'FY1730', 8.2, 'fries-2.png', 1, 'KFC Kentang Goreng Crispy Original'),
('GQR21786', 'Chicken Deluxe 3', 'LX3204', 6.2, 'deluxe-3.png', 0, 'Paket Special Deluxe Daging Ayam Panjang'),
('HBY12921', 'Sprite', 'YP3430', 2.5, 'Product_thumb_Sprite.png', 1, 'Minuman Segar Bersoda'),
('KDI56491', 'Tomato Pizza', 'EI1336', 8.2, 'pizza-2.png', 1, 'Special Dengan Topping Tomat & Cabai'),
('KMJ60391', 'Chicken Burger', 'JL3972', 5, 'double-chicken.png', 1, 'Special Burger With Chicken Meat'),
('KON80673', 'Chicken Burger 2', 'JL3972', 4.8, 'double-chicken-2.png', 1, 'Special Burger With Chicken Meat'),
('KSY44971', 'Beef Burger 4', 'JL3972', 4.9, 'beef-4.png', 1, 'Hot Beef Special Burger with extra meat'),
('MPN62894', 'Hot Chips Bowl', 'FY1730', 9.3, 'chips-2.png', 1, 'Keripik Kentang Goreng Dengan Rasa Pedas'),
('MSR56461', 'Hot Spicy Fries', 'FY1730', 12.5, 'hot-fries.png', 1, 'Kentang Goreng Pedas Crispy'),
('NGU44668', 'Bacon Burger', 'JL3972', 4.9, 'bacon-3.png', 1, 'Special Burger With Hot Beef Sausage'),
('NYP88408', 'Chips Bowl', 'FY1730', 15, 'chips-1.png', 1, 'Keripik Kentang Goreng Dengan Original'),
('OZQ44773', 'Chicken Deluxe 2', 'LX3204', 6.3, 'deluxe-2.png', 0, 'Paket Special Deluxe Daging Ayam Lebar'),
('PCU12332', 'Mushroom Pizza', 'EI1336', 15, 'pizza-7.png', 1, 'Special Dengan Campuran Topping Sayur & Jamur'),
('PEX19180', 'Paket Bucket 3', 'LX3204', 15.3, 'combo-3.png', 1, 'Special Bucket Ayam Dengan Porsi Kuli'),
('QAK27609', 'Cheese Burger', 'JL3972', 4.8, 'cheeseburger.png', 1, 'Special Burger With Hot Beef Sausage'),
('QCP28797', 'Cheese Burger 3', 'JL3972', 4.9, 'beef-3.png', 1, 'Special Burger With Hot Beef Sausage'),
('SIV62299', 'Chicken Deluxe', 'LX3204', 5.2, 'deluxe-1.png', 1, 'Paket Special Deluxe Paha Ayam'),
('SJR72982', 'Beef Burger', 'JL3972', 5.9, 'beef.png', 1, 'Special Burger With Hot Beef Sausage with Potatoes'),
('SNP38906', 'Combo Pizza chili + tomato + beef', 'EI1336', 12, 'pizza-6.png', 1, 'Special Dengan Campuran Topping Sayur & Daging'),
('SUW60278', 'Cheese Fries 2', 'FY1730', 12, 'cheese-fries.png', 0, 'Kentang Goreng Pedas Dengan Topping Keju'),
('TGS29510', 'Signature Box', 'LX3204', 8, 'box-3.png', 1, 'Special Menu Burger Chicken + Pepsi'),
('UGE29031', 'Pizza Beef', 'EI1336', 12.5, 'pizza-3.png', 1, 'Special Dengan Xtra Topping Daging Sapi'),
('VJC75630', 'Twister Box', 'LX3204', 8, 'box-2.png', 1, 'Special Menu Kebab Ayam + Pepsi'),
('VQR96528', 'Hot Spicy Pizza', 'EI1336', 12.5, 'pizza-4.png', 1, 'Special Dengan Topping Sayur & Cabai'),
('VQW46233', 'Beef Burger 3', 'JL3972', 4, 'beef-3.png', 1, 'Special Burger With Hot Beef Sausage with many tomatoes'),
('VSB93102', 'French Fries KFC 2', 'FY1730', 8.2, 'fries-1.png', 1, 'KFC Kentang Goreng Crispy Special'),
('WER89736', 'Coca Cola Drink', 'YP3430', 2.5, 'coca-cola.png', 1, 'Minuman Segar Bersoda'),
('WFC80218', 'Bacon Burger Cheese', 'JL3972', 4.9, 'bacon-2.png', 0, 'Special Burger With Hot Beef Sausage'),
('XBS11909', 'Barbeque Chips Bowl', 'FY1730', 9.3, 'chips-3.png', 1, 'Keripik Kentang Goreng Dengan Taburan Bumbu Barbeque'),
('XNS74903', 'Paket Bucket 1', 'LX3204', 12.5, 'combo-1.png', 1, 'Special Bucket Ayam Dengan Porsi Kuli'),
('YEI86673', 'French Fries Original ', 'FY1730', 8.2, 'fries-3.png', 1, 'Kentang Goreng Crispy Original'),
('YOP93029', 'Paket Bucket 2', 'LX3204', 12, 'combo-2.png', 1, 'Special Bucket Ayam Dengan Porsi Kuli'),
('ZDQ82477', 'Hawaii Chicken Burger', 'JL3972', 4.5, 'hawaii-chicken.png', 1, 'Special Burger With Chicken Meat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDAdmin`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

