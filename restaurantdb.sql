-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 11:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_order`
--

CREATE TABLE `cart_order` (
  `order_id` varchar(12) NOT NULL,
  `customer_id` varchar(12) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `time_date` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `delivery` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_order`
--

INSERT INTO `cart_order` (`order_id`, `customer_id`, `total_amount`, `time_date`, `status`, `delivery`) VALUES
('0O3TKHYXF6', 'I7FM9LAM08', '12426.00', '2021-11-12 08:19:03am', 1, 1),
('1VNCZM621I', 'F4YPFD6C7S', '8390.00', '2021-10-07 06:18:46am', 1, 1),
('48MQ6Z2432', 'F4YPFD6C7S', '15650.00', '2021-11-11 11:15:59am', 1, 1),
('4NWDBQUVY2', 'F4YPFD6C7S', '7430.00', '2021-11-12 01:26:59am', 1, 1),
('6Z4A4GUCO2', 'F4YPFD6C7S', '13700.00', '2021-10-07 06:16:11am', 1, 1),
('78A0E50VYY', 'KC0D4B37DW', '8420.00', '2021-11-12 04:57:49am', 1, 1),
('I8Y8T8D2QO', 'F4YPFD6C7S', '1800.00', '2021-10-07 01:25:59pm', 1, 1),
('JQME7HJCM0', 'KC0D4B37DW', '7720.00', '2021-11-15 08:22:21am', 0, 1),
('M9ZDZ3DYJU', 'F4YPFD6C7S', '8070.00', '2021-11-12 02:41:16am', 1, 1),
('OAPZHI9QF6', 'KC0D4B37DW', '2370.00', '2021-11-15 08:20:16am', 1, 1),
('ODFFS6FSSI', 'F4YPFD6C7S', '2190.00', '2021-11-12 04:54:10am', 1, 1),
('PPX856HIYA', 'F4YPFD6C7S', '6720.00', '2021-11-12 04:32:03am', 1, 1),
('QSC0NLDUSH', 'KC0D4B37DW', '1703.00', '2021-11-15 08:25:12am', 0, 1),
('WQYRCM8XQ8', 'F4YPFD6C7S', '9090.00', '2021-11-11 11:50:56am', 1, 1),
('XYHHVEP9XY', 'F4YPFD6C7S', '2039.00', '2021-10-07 01:25:15pm', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_order_items`
--

CREATE TABLE `cart_order_items` (
  `order_id` varchar(12) NOT NULL,
  `product_id` varchar(12) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_order_items`
--

INSERT INTO `cart_order_items` (`order_id`, `product_id`, `description`, `price`, `quantity`, `total`) VALUES
('6Z4A4GUCO2', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('6Z4A4GUCO2', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('6Z4A4GUCO2', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '2.00', '12000.00'),
('6Z4A4GUCO2', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('6Z4A4GUCO2', 'KE8VOVAD39', 'fish fingers', '300.00', '2.00', '600.00'),
('1VNCZM621I', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('1VNCZM621I', '1067X2MA6F', 'stuffed Pancake', '230.00', '2.00', '460.00'),
('1VNCZM621I', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('1VNCZM621I', 'DL8QUFJBWS', 'Humberger', '200.00', '3.00', '600.00'),
('1VNCZM621I', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '2.00', '2400.00'),
('1VNCZM621I', 'N9UYDZY0KT', 'Spanish Omlet', '190.00', '1.00', '190.00'),
('1VNCZM621I', 'WTDKUD0MJG', 'Bacardi Superior', '3500.00', '1.00', '3500.00'),
('I8Y8T8D2QO', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('I8Y8T8D2QO', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('I8Y8T8D2QO', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '1.00', '1200.00'),
('48MQ6Z2432', '1HUS5LMFIR', 'Italian Cheese', '720.00', '3.00', '2160.00'),
('48MQ6Z2432', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '2.00', '12000.00'),
('48MQ6Z2432', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '2.00', '1040.00'),
('48MQ6Z2432', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('FR343UPHS6', '5QK7FH656F', 'Pancake', '150.00', '2.00', '300.00'),
('FR343UPHS6', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('FR343UPHS6', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('FR343UPHS6', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('WQYRCM8XQ8', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('WQYRCM8XQ8', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('WQYRCM8XQ8', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('WQYRCM8XQ8', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('WQYRCM8XQ8', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '2.00', '900.00'),
('WQYRCM8XQ8', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('4NWDBQUVY2', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('4NWDBQUVY2', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('4NWDBQUVY2', '5QK7FH656F', 'Pancake', '150.00', '3.00', '450.00'),
('4NWDBQUVY2', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('4NWDBQUVY2', 'KE8VOVAD39', 'fish fingers', '300.00', '1.00', '300.00'),
('M9ZDZ3DYJU', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('M9ZDZ3DYJU', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('M9ZDZ3DYJU', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '1.00', '1200.00'),
('M9ZDZ3DYJU', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('PPX856HIYA', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('PPX856HIYA', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('PPX856HIYA', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('ODFFS6FSSI', '1HUS5LMFIR', 'Italian Cheese', '720.00', '2.00', '1440.00'),
('ODFFS6FSSI', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('ODFFS6FSSI', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('78A0E50VYY', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('78A0E50VYY', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('78A0E50VYY', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '2.00', '900.00'),
('78A0E50VYY', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('0O3TKHYXF6', '1067X2MA6F', 'stuffed Pancake', '230.00', '2.00', '460.00'),
('0O3TKHYXF6', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('0O3TKHYXF6', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '2.00', '1040.00'),
('0O3TKHYXF6', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('0O3TKHYXF6', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '1.00', '1200.00'),
('0O3TKHYXF6', 'KE8VOVAD39', 'fish fingers', '300.00', '2.00', '600.00'),
('0O3TKHYXF6', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('0O3TKHYXF6', 'RCZYBYGIA9', 'Chocolate Cupcake', '63.00', '2.00', '126.00'),
('0O3TKHYXF6', 'VPIEXR5FHJ', 'ChickPea Meatball', '650.00', '1.00', '650.00'),
('0O3TKHYXF6', 'VI8C8YFYL9', 'FriendRichs Dr G', '5000.00', '1.00', '5000.00'),
('0O3TKHYXF6', 'ZMC9IDDFC1', 'Meat Humbergur', '520.00', '1.00', '520.00'),
('0O3TKHYXF6', '6XWQJHXK8U', 'Pizza', '800.00', '1.00', '800.00'),
('0O3TKHYXF6', 'N9UYDZY0KT', 'Spanish Omlet', '190.00', '1.00', '190.00'),
('0O3TKHYXF6', 'QADLINDXVD', 'Pierogi with tomato', '120.00', '1.00', '120.00'),
('OAPZHI9QF6', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('OAPZHI9QF6', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('OAPZHI9QF6', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '2.00', '900.00'),
('OAPZHI9QF6', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('JQME7HJCM0', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('JQME7HJCM0', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('JQME7HJCM0', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('JQME7HJCM0', '6XWQJHXK8U', 'Pizza', '800.00', '1.00', '800.00'),
('QSC0NLDUSH', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('QSC0NLDUSH', 'RCZYBYGIA9', 'Chocolate Cupcake', '63.00', '1.00', '63.00'),
('QSC0NLDUSH', '6XWQJHXK8U', 'Pizza', '800.00', '1.00', '800.00'),
('QSC0NLDUSH', 'QADLINDXVD', 'Pierogi with tomato', '120.00', '1.00', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE `cart_temp` (
  `product_id` varchar(12) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `image` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `town` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `email`, `phone`, `town`, `street`, `password`) VALUES
('F4YPFD6C7S', 'Andrew', 'rony', 'customer@mail.com', '+25455424442', 'Busia', 'Busia, Corindah', 'customer1'),
('KC0D4B37DW', 'samwel', 'Lee', 'lee@gmail.com', '0755566623', 'busia', 'nambale', 'samwellee'),
('I7FM9LAM08', 'David', 'Miya', 'david@gmail.com', '0755566888', 'busia', 'matayos', 'david'),
('UGXOQFQ512', 'David', 'Miya', 'david@gmail.com', '0755566888', 'busia', 'matayos', 'david');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `order_id` varchar(15) NOT NULL,
  `driverid` varchar(15) NOT NULL,
  `customerid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverid` varchar(12) NOT NULL,
  `drivername` varchar(50) NOT NULL,
  `driverphone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverid`, `drivername`, `driverphone`) VALUES
('K49WK', 'Bethsheba Davids', '0778452135'),
('K51UN', 'Sarah Abrahams', '0725896324'),
('UL8RD', 'Benard Luka', '0789652312');

-- --------------------------------------------------------

--
-- Table structure for table `kot_order`
--

CREATE TABLE `kot_order` (
  `kot_order_id` varchar(12) NOT NULL,
  `kot_date` varchar(30) NOT NULL,
  `order_table` varchar(10) NOT NULL,
  `waiter` varchar(30) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `bill` decimal(10,2) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'DineInn',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kot_order`
--

INSERT INTO `kot_order` (`kot_order_id`, `kot_date`, `order_table`, `waiter`, `sumtotal`, `discount`, `bill`, `type`, `status`) VALUES
('BCCQLTCE38', '2021-11-11 05:20:48pm', 'Table 5', 'Michael D.', '6220.00', '50.00', '6170.00', 'DineInn', 1),
('GKQ9D026SM', '2021-11-12 01:47:16am', 'Table 8', 'Kate', '2120.00', '0.00', '2120.00', 'DineInn', 1),
('IEBA2CQZVN', '2021-10-06 11:43:11am', 'Table 0', 'Cashier', '14120.00', '0.00', '14120.00', 'DineInn', 1),
('KP1ERGNU2Q', '2021-09-29 01:45:46pm', 'Table 4', 'Robert M. K.', '1650.00', '0.00', '1650.00', 'DineInn', 1),
('M87TM4D4O1', '2021-10-06 11:43:49am', 'Table 5', 'Kate', '19390.00', '0.00', '19390.00', 'DineInn', 1),
('OVVML2FWGL', '2021-11-11 11:53:00am', 'Table 7', 'Michael D.', '7550.00', '10.00', '7540.00', 'DineInn', 1),
('P78MD4V7GX', '2021-09-29 01:44:52pm', 'Table 3', 'Cashier', '10800.00', '0.00', '10800.00', 'DineInn', 1),
('VLX6CBSSGV', '2021-11-15 08:23:01am', 'Table 0', 'Cashier', '7370.00', '0.00', '7370.00', 'DineInn', 1),
('WDFHH62E31', '2021-11-12 03:40:17am', 'Table 2', 'Robert M. K.', '6600.00', '0.00', '6600.00', 'DineInn', 1),
('WWOEP9BX4S', '2021-11-15 08:43:56am', 'Table 0', 'Cashier', '7100.00', '0.00', '7100.00', 'Take Away', 0),
('YXZ7NG1URR', '2021-11-11 3:40:10pm', 'Table 0', 'Nimron H.', '7970.00', '50.00', '7920.00', 'DineInn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kot_order_items`
--

CREATE TABLE `kot_order_items` (
  `kot_order_id` varchar(12) NOT NULL,
  `product_id` varchar(12) NOT NULL,
  `product_description` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kot_order_items`
--

INSERT INTO `kot_order_items` (`kot_order_id`, `product_id`, `product_description`, `price`, `quantity`, `total`) VALUES
('P78MD4V7GX', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '2.00', '2400.00'),
('P78MD4V7GX', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('P78MD4V7GX', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '3.00', '2400.00'),
('KP1ERGNU2Q', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '1.00', '520.00'),
('KP1ERGNU2Q', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('KP1ERGNU2Q', 'KE8VOVAD39', 'fish fingers', '300.00', '1.00', '300.00'),
('KP1ERGNU2Q', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('KP1ERGNU2Q', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('IEBA2CQZVN', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '1.00', '1200.00'),
('IEBA2CQZVN', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('IEBA2CQZVN', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('IEBA2CQZVN', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '2.00', '12000.00'),
('M87TM4D4O1', '0C6EVMDLPI', 'Grilled Garlic herb Shrimp', '520.00', '2.00', '1040.00'),
('M87TM4D4O1', '1067X2MA6F', 'stuffed Pancake', '230.00', '2.00', '460.00'),
('M87TM4D4O1', '1HUS5LMFIR', 'Italian Cheese', '720.00', '2.00', '1440.00'),
('M87TM4D4O1', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '2.00', '12000.00'),
('M87TM4D4O1', '5QK7FH656F', 'Pancake', '150.00', '2.00', '300.00'),
('M87TM4D4O1', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('M87TM4D4O1', 'HOHL6C2UKL', 'Swedish Meatball Pasta', '1200.00', '1.00', '1200.00'),
('M87TM4D4O1', 'KE8VOVAD39', 'fish fingers', '300.00', '1.00', '300.00'),
('M87TM4D4O1', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('M87TM4D4O1', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('M87TM4D4O1', 'BFVNX1P4JZ', 'Garlic Butter and Potatoes Skillet', '400.00', '1.00', '400.00'),
('M87TM4D4O1', '6XWQJHXK8U', 'Pizza', '800.00', '1.00', '800.00'),
('OVVML2FWGL', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('OVVML2FWGL', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('OVVML2FWGL', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00'),
('OVVML2FWGL', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('OVVML2FWGL', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('YXZ7NG1URR', '1067X2MA6F', 'stuffed Pancake', '230.00', '2.00', '460.00'),
('YXZ7NG1URR', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('YXZ7NG1URR', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('BCCQLTCE38', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('BCCQLTCE38', 'TMKWF6KB1F', 'Glenfiddich Excellence', '4500.00', '1.00', '4500.00'),
('BCCQLTCE38', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('BCCQLTCE38', 'LBW5SFHOKP', 'Lamb Chops', '800.00', '1.00', '800.00'),
('GKQ9D026SM', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('GKQ9D026SM', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('GKQ9D026SM', 'BFVNX1P4JZ', 'Garlic Butter and Potatoes Skillet', '400.00', '1.00', '400.00'),
('GKQ9D026SM', '6XWQJHXK8U', 'Pizza', '800.00', '1.00', '800.00'),
('WDFHH62E31', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('WDFHH62E31', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('WDFHH62E31', 'BFVNX1P4JZ', 'Garlic Butter and Potatoes Skillet', '400.00', '1.00', '400.00'),
('VLX6CBSSGV', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('VLX6CBSSGV', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('VLX6CBSSGV', '6C3J0Z25D8', 'Garlic Mushroom Skillet', '450.00', '1.00', '450.00'),
('VLX6CBSSGV', 'DL8QUFJBWS', 'Humberger', '200.00', '1.00', '200.00'),
('WWOEP9BX4S', '1067X2MA6F', 'stuffed Pancake', '230.00', '1.00', '230.00'),
('WWOEP9BX4S', '1HUS5LMFIR', 'Italian Cheese', '720.00', '1.00', '720.00'),
('WWOEP9BX4S', '2TF2D7KON9', 'Stella Rosa Black', '6000.00', '1.00', '6000.00'),
('WWOEP9BX4S', '5QK7FH656F', 'Pancake', '150.00', '1.00', '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `kot_request`
--

CREATE TABLE `kot_request` (
  `kot_order_id` varchar(12) NOT NULL,
  `product_id` varchar(12) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tableno` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kot_tables`
--

CREATE TABLE `kot_tables` (
  `table_id` varchar(10) NOT NULL,
  `table_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kot_tables`
--

INSERT INTO `kot_tables` (`table_id`, `table_name`) VALUES
('2YR7P', 'Table 7'),
('89HYM', 'Table 6'),
('AN8CG', 'Table 5'),
('Q8ZGA', 'Table 4'),
('SKY0L', 'Table 3'),
('SQK2Z', 'Table 9'),
('TWVI8', 'Table 2'),
('YO1V0', 'Table 8'),
('YYZ7N', 'Table 1');

-- --------------------------------------------------------

--
-- Table structure for table `kot_waiters`
--

CREATE TABLE `kot_waiters` (
  `waiter_id` varchar(10) NOT NULL,
  `waitername` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kot_waiters`
--

INSERT INTO `kot_waiters` (`waiter_id`, `waitername`) VALUES
('31C01', 'Nimron H.'),
('ANPXD', 'Michael D.'),
('DDXQ9', 'Robert M. K.'),
('XS8PY', 'Kate');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(12) NOT NULL,
  `description` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  `image` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `description`, `category`, `price`, `status`, `image`) VALUES
('0C6EVMDLPI', 'Grilled Garlic herb Shrimp', 'Snack', '520.00', 'available', 'images/7V5JLc46/60101f44bed364b36728862a78c684fd.jpg'),
('1067X2MA6F', 'stuffed Pancake', 'Breakfast Foods', '230.00', 'available', 'images/si4ey176/e0131cb4d89d8dfa15c2d6141483e974.jpg'),
('1HUS5LMFIR', 'Italian Cheese', 'Coffee & Tea', '720.00', 'available', 'images/X4Yhkb9i/105096c070b17b4cc7c45a77c75117e9.jpg'),
('2TF2D7KON9', 'Stella Rosa Black', 'Wines & Spirits', '6000.00', 'available', 'images/6prIF3xh/f4121291cfba4757d960d8b361e6e5f6.jpg'),
('5QK7FH656F', 'Pancake', 'Breakfast Foods', '150.00', 'available', 'images/AHBa7Z0v/0ae8362275ad128edf572f50dfedbfe1.jpg'),
('6C3J0Z25D8', 'Garlic Mushroom Skillet', 'Snack', '450.00', 'available', 'images/WYvFjuGb/55ca98775e75532bade3390acd1421b9.jpg'),
('6XWQJHXK8U', 'Pizza', 'Lunch Foods', '800.00', 'available', 'images/RewLQAQx/a7a890821bf9a824e2bd32759cfb1d46.jpg'),
('BFVNX1P4JZ', 'Garlic Butter and Potatoes Skillet', 'Lunch Foods', '400.00', 'available', 'images/seQLzq9r/6544d17994fbee6fa1e2f08c6f7dd130.jpg'),
('DL8QUFJBWS', 'Humberger', 'Snack', '200.00', 'available', 'images/boAwta4H/ea3ea7201b6cb21a538590204ee4eb0e.jpg'),
('HOHL6C2UKL', 'Swedish Meatball Pasta', 'mutton', '1200.00', 'out of stock', 'images/DTn4ZoLC/2ddeeb45dd33ce2762e2d0d18ab5a82a.jpg'),
('KE8VOVAD39', 'fish fingers', 'mutton', '300.00', 'available', 'images/BJiJz79d/323cad559a5c949d36e457674dcb1cc8.jpg'),
('LBW5SFHOKP', 'Lamb Chops', 'Supper Foods', '800.00', 'available', 'images/Klu5ShSF/9a8f1493c3ca9687fc1990927699f630.jpg'),
('MGRGNN1XDK', 'Sauerkraut', 'salad', '430.00', 'available', 'images/ogpWIO0e/f780278c786c855143fee9dae089a605.jpg'),
('N9UYDZY0KT', 'Spanish Omlet', 'Breakfast Foods', '190.00', 'available', 'images/o4ZawzvJ/726afdcbec7debb317470436082c084b.jpg'),
('QADLINDXVD', 'Pierogi with tomato', 'Chicken', '120.00', 'available', 'images/CpRJ7SVN/d26d39631c69853079ed59fb8e922d6e.jpg'),
('RCZYBYGIA9', 'Chocolate Cupcake', 'Snack', '63.00', 'available', 'images/MTsB5JiT/2f523e46b3a2a8e1fc5a047088340954.jpg'),
('SAB0NQIJJ6', 'Mexican Chicken', 'Snack', '590.00', 'available', 'images/AFnPwr7C/ac67b041413b8eddea8863edb5b8cd83.jpg'),
('TMKWF6KB1F', 'Glenfiddich Excellence', 'Drinks', '4500.00', 'available', 'images/NWltQNXs/8cf10ef1dc54146810e6d2bee4ca7bb7.jpg'),
('VI8C8YFYL9', 'FriendRichs Dr G', 'Wines & Spirits', '5000.00', 'available', 'images/aFAdD3kV/45ba965956c446ac21f87faf21187635.jpg'),
('VPIEXR5FHJ', 'ChickPea Meatball', 'Snack', '650.00', 'available', 'images/SsoWL7RW/f70d2760a2e68e01d75e88758f642702.jpg'),
('WTDKUD0MJG', 'Bacardi Superior', 'Drinks', '3500.00', 'available', 'images/KV0zVSv7/bb58d57a398a6649c38bc6949cfaeb8d.jpg'),
('YWNPRUPE6J', 'La Promenade', 'Wines & Spirits', '1200.00', 'available', 'images/XznbXbjj/39e4f790a898b8376abf63734ab2291e.jpg'),
('ZMC9IDDFC1', 'Meat Humbergur', 'Snack', '520.00', 'available', 'images/BQzk3qae/cc82aa5c780f157fe6064b7bf6fcd4b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` varchar(6) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`) VALUES
('5Z4UO', 'mutton'),
('97GO9', 'Wines & Spirits'),
('CBNI6', 'Coffee & Tea'),
('N7R1P', 'Supper Foods'),
('O61B0', 'Lunch Foods'),
('QLTGV', 'Breakfast Foods'),
('QX1MV', 'snack'),
('RWRO6', 'Dessert'),
('SO2XI', 'Drinks'),
('U4D95', 'salad');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_table`
--

CREATE TABLE `restaurant_table` (
  `table_id` int(10) NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_kot`
--

CREATE TABLE `temp_kot` (
  `kotproduct_id` varchar(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `full_names` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`full_names`, `email`, `username`, `password`, `type`) VALUES
('admin2', 'admin2@gmail.com', 'admin2', 'admin2', 'super admin'),
('main admin', 'admin@mail.com', 'admin', 'admin', 'super admin'),
('kotadmnin1', 'kotadmin1@gmail.com', 'kotadmin1', 'kotadmin1', 'admin'),
('user1', 'user1@mail.com', 'user1', 'user1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_order`
--
ALTER TABLE `cart_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverid`);

--
-- Indexes for table `kot_order`
--
ALTER TABLE `kot_order`
  ADD PRIMARY KEY (`kot_order_id`);

--
-- Indexes for table `kot_tables`
--
ALTER TABLE `kot_tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `kot_waiters`
--
ALTER TABLE `kot_waiters`
  ADD PRIMARY KEY (`waiter_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `restaurant_table`
--
ALTER TABLE `restaurant_table`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `temp_kot`
--
ALTER TABLE `temp_kot`
  ADD PRIMARY KEY (`kotproduct_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurant_table`
--
ALTER TABLE `restaurant_table`
  MODIFY `table_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
