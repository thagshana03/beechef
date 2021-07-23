-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 03:55 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `footsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `c_name`) VALUES
(1, 'Rice & Curry'),
(2, 'Burgers'),
(3, 'Pizza'),
(4, 'Chicken'),
(7, 'Noodles'),
(10, 'Dessert'),
(11, 'Rotti'),
(13, 'Special Rice');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(11) NOT NULL,
  `f_description` varchar(500) NOT NULL,
  `uname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `f_description`, `uname`) VALUES
(31, 'overall experience is good and great service and ambiance is quite nice for your workgroup to have a friendly chat and chill', 'Charlotte'),
(32, 'Very delicious food and reasonable price. UberEATS available and they have delivery service as well. But their delivery service little late about navigation.', 'Emma'),
(34, 'That\'s was a best Indian food place on Colombo... Best rate five star quality  foods', 'kiru'),
(35, 'Ok with service  😒 , Beef Noodles and Chicken 65 is lit 💥', 'jadu'),
(36, 'You wanna eat something spicy and Indian ? This is the place...', 'madonna'),
(37, 'You wanna eat something spicy and Indian ? This is the place...', 'madonna');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `cid`, `p_name`, `price`, `photo`, `description`) VALUES
(1, 1, 'Tandoori Chicken Biriyani\r\n', 600, '../images/foodPic/rice1.jpg', 'Tandoori oven baked shredded chicken breasts, onions, and capsicum'),
(2, 3, 'Cheese Pizza', 800, '../images/foodPic/pizza2 (1).jpg', 'Mozzarella cheese, Sauce: Combine pureed tomatoes'),
(3, 3, 'Hot Chili Chicken', 989, '../images/foodPic/pizza2 (3).jpg', 'Quick fried hot chili chicken, capsicum, onion, red paprika slices, and devil sauce'),
(4, 13, 'Biryani', 450, '../images/foodPic/briyani.jpg', 'basmati rice, chicken thighs, hung curd, onion, tomato, milk, saffron'),
(5, 10, 'chocolate cake', 1500, '../images/foodPic/choc_cake_1625491206.jpg', '1 kg - chocolate cake '),
(6, 10, 'Oreo Cake', 182, '../images/foodPic/pexels-alexander-dummer-132694_1625497470.jpg', 'Sour cream, chocolate chips, egg whites, heavy cream, baking soda'),
(8, 11, 'Garlic Naan', 150, '../images/foodPic/pexels-francesco-paggiaro-1117862_1625492095.jpg', 'milk, yoghurt, oil, minced garlic, flour baking powder and salt.'),
(9, 2, 'Chicken Burger', 250, '../images/foodPic/bg2_1625492697.jpg', 'ground chicken, Italian-Spicy-seasoned bread crumbs, onion, egg, cloves, garlic,salt'),
(10, 2, 'Spicy Chicken Burger', 450, '../images/foodPic/b1_1625492877.jpg', 'ground chicken, Italian-seasoned bread crumbs, onion, egg, cloves, garlic,salt'),
(11, 2, 'Crispy Chicken Burger', 550, '../images/foodPic/bg3_1625493004.jpg', 'ground chicken, Italian-seasoned bread crumbs, onion, egg, cloves, garlic, salt'),
(13, 7, 'Red Sauce Pasta', 600, '../images/foodPic/n2_1625493374.jpg', 'red sauce, fresh cherry tomatoes, capers, tinned tuna, olive oil'),
(14, 7, 'White Sauce Pasta', 600, '../images/foodPic/n3_1625493458.jpg', 'white sauce, fresh cherry tomatoes, capers, tinned tuna, olive oil'),
(16, 4, 'Chicken 65', 680, '../images/foodPic/c1_1625493636.jpg', 'Chicken breast, rice flour, curry leaves, vinegar, plain yogurt'),
(17, 4, 'Chilli chicken', 750, '../images/foodPic/c2_1625493708.jpg', 'Soy sauce, boneless chicken, green thai, honey, rice vinegar');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `pur_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `pur_date` datetime NOT NULL,
  `pay_method` char(1) NOT NULL DEFAULT '0',
  `pay_description` varchar(500) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`pur_id`, `uid`, `total_amount`, `pur_date`, `pay_method`, `pay_description`, `vid`, `status`) VALUES
(22, 1, 1646, '2021-07-21 17:59:56', '0', 'speed delivery plz', NULL, 1),
(23, 8, 5606, '2021-07-21 18:28:15', '0', 'extra cheese plz', NULL, 1),
(24, 1, 1850, '2021-07-21 19:15:16', '0', 'fgggggggggggggggggggggggggg', NULL, 1),
(25, 11, 3000, '2021-07-22 17:34:04', '0', 'extra cheese plzzzz', NULL, 1),
(26, 12, 2400, '2021-07-22 18:13:46', '0', 'dddddddddd', NULL, 2),
(27, 1, 3800, '2021-07-22 22:54:18', '0', '', NULL, 1),
(28, 11, 150, '2021-07-23 00:26:59', '0', '1 naan', NULL, 1),
(29, 8, 3000, '2021-07-23 05:22:05', '0', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pdid` int(11) NOT NULL,
  `pur_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pdid`, `pur_id`, `pid`, `quantity`) VALUES
(10, 22, 9, 2),
(11, 22, 13, 1),
(12, 22, 6, 3),
(13, 23, 4, 2),
(14, 23, 3, 4),
(15, 23, 8, 5),
(16, 24, 9, 2),
(17, 24, 10, 3),
(18, 25, 13, 2),
(19, 25, 10, 3),
(20, 25, 4, 1),
(21, 26, 1, 4),
(22, 27, 2, 4),
(23, 27, 1, 1),
(24, 28, 8, 1),
(25, 29, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `address`, `email`, `tel`, `username`, `password`, `admin`) VALUES
(1, 'Kirushanthi ', '14, Armour street, Colombo - 12.', 'kiru.it@gmail.com', 771594562, 'kiru', 'kiru123', 0),
(2, 'Admin', '15, 2nd cross street, Colombo - 13', 'admin12@gmail.com', 771874562, 'admin', 'admin', 1),
(8, 'Madonna', 'old moor street, colombo-12', 'madonna123@gmail.com', 771594562, 'madonna', 'madonna123', 0),
(11, 'jadurkshi', '36/4 -B, Pamankada road, colombo-6', 'jadu1@gmail.com', 77159159, 'jadu', 'jadu123', 0),
(12, 'lashanthi', '55, moon street, colombo 15', 'lasha16@gmail.com', 77561588, 'lasha', 'lasha123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `vid` int(11) NOT NULL,
  `dir_name` varchar(50) NOT NULL,
  `type` varchar(25) NOT NULL,
  `Reg_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`vid`, `dir_name`, `type`, `Reg_no`) VALUES
(1, 'Jackson', 'Bike', 'MSE666'),
(2, 'Aiden', 'Bike', 'MSE667');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `vid` (`vid`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pdid`),
  ADD KEY `pur_id` (`pur_id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `pur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
