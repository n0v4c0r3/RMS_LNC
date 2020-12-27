-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 10:45 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_lnc`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin_tb`
--

CREATE TABLE `adminlogin_tb` (
  `a_login_id` int(11) NOT NULL,
  `a_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `a_email` varchar(60) COLLATE utf8_bin NOT NULL,
  `a_password` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `adminlogin_tb`
--

INSERT INTO `adminlogin_tb` (`a_login_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'admin', 'admin@admin.com', 'admin@nova');

-- --------------------------------------------------------

--
-- Table structure for table `complete_order`
--

CREATE TABLE `complete_order` (
  `pid` int(11) NOT NULL,
  `bname` varchar(55) NOT NULL,
  `pdop` date NOT NULL,
  `pitems` varchar(800) NOT NULL,
  `tableno` int(11) NOT NULL,
  `totalbill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complete_order`
--

INSERT INTO `complete_order` (`pid`, `bname`, `pdop`, `pitems`, `tableno`, `totalbill`) VALUES
(1, 'testbuyer', '2020-12-27', '[{\"ITEM\":\" chicken\",\"PRICE\":\" 250\",\"Quantity\":\" 2\"},{\"ITEM\":\" pulaw\",\"PRICE\":\" 120\",\"Quantity\":\" 2\"},{\"ITEM\":\" butter chicken\",\"PRICE\":\" 350\",\"Quantity\":\" 1\"}]', 1, 1090);

-- --------------------------------------------------------

--
-- Table structure for table `menu_tb`
--

CREATE TABLE `menu_tb` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdop` date NOT NULL,
  `poriginalcost` int(11) NOT NULL,
  `pava` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_tb`
--

INSERT INTO `menu_tb` (`id`, `pname`, `pdop`, `poriginalcost`, `pava`) VALUES
(1, 'chicken', '2020-12-27', 250, 100),
(2, 'pasta', '2020-12-27', 50, 100),
(3, 'roll', '2020-12-27', 80, 30),
(4, 'butter chicken', '2020-12-27', 350, 50),
(5, 'rice', '2020-12-27', 80, 100),
(6, 'pulaw', '2020-12-27', 120, 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders_tb`
--

CREATE TABLE `orders_tb` (
  `pid` int(11) NOT NULL,
  `pname` varchar(60) COLLATE utf8_bin NOT NULL,
  `pdop` date NOT NULL,
  `pqty` int(11) NOT NULL,
  `tableno` int(11) NOT NULL,
  `psellingcost` int(11) NOT NULL,
  `psum` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `requesterlogin_tb`
--

CREATE TABLE `requesterlogin_tb` (
  `r_login_id` int(11) NOT NULL,
  `r_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `r_email` varchar(60) COLLATE utf8_bin NOT NULL,
  `r_password` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff_tb`
--

CREATE TABLE `staff_tb` (
  `empid` int(11) NOT NULL,
  `empName` varchar(60) COLLATE utf8_bin NOT NULL,
  `empCity` varchar(60) COLLATE utf8_bin NOT NULL,
  `empMobile` bigint(11) NOT NULL,
  `empEmail` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `staff_tb`
--

INSERT INTO `staff_tb` (`empid`, `empName`, `empCity`, `empMobile`, `empEmail`) VALUES
(1, 'worker1', 'jorhat', 7638011234, 'work2test@test.com'),
(2, 'cook', 'jrht', 1234567890, ''),
(3, 'owner', 'jrht', 123456789, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `table_available`
--

CREATE TABLE `table_available` (
  `id` int(11) NOT NULL,
  `No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_available`
--

INSERT INTO `table_available` (`id`, `No`) VALUES
(1, 1),
(2, 2),
(3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  ADD PRIMARY KEY (`a_login_id`);

--
-- Indexes for table `complete_order`
--
ALTER TABLE `complete_order`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `menu_tb`
--
ALTER TABLE `menu_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_tb`
--
ALTER TABLE `orders_tb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  ADD PRIMARY KEY (`r_login_id`);

--
-- Indexes for table `staff_tb`
--
ALTER TABLE `staff_tb`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `table_available`
--
ALTER TABLE `table_available`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  MODIFY `a_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complete_order`
--
ALTER TABLE `complete_order`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_tb`
--
ALTER TABLE `menu_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_tb`
--
ALTER TABLE `orders_tb`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  MODIFY `r_login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_tb`
--
ALTER TABLE `staff_tb`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_available`
--
ALTER TABLE `table_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
