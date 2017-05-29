-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2017 at 10:17 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `our_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_cust`
--

CREATE TABLE `company_cust` (
  `ac_id` smallint(5) UNSIGNED NOT NULL,
  `employee_id` char(6) NOT NULL,
  `employee_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_cust`
--

INSERT INTO `company_cust` (`ac_id`, `employee_id`, `employee_name`) VALUES
(55, 'aiaiai', 'pantelis'),
(55, 'hhhhhh', 'fenia'),
(55, 'nnnnnn', 'katerina'),
(55, 'tttrrr', 'ksenia'),
(66, 'eaaaaa', 'vasia'),
(66, 'zzzzzz', 'antonis'),
(33100, 'per01', 'vhghf'),
(33100, 'per02', 'hjfxh'),
(33100, 'per03', 'leoni');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ac_id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `active` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ac_id`, `name`, `active`) VALUES
(55, 'choco', 'false'),
(66, 'intel', 'true'),
(111, 'lola', 'true'),
(121, 'john', 'true'),
(123, 'sofia', 'false'),
(144, 'dd', 'false'),
(177, 'Leonidas', 'true'),
(200, 'loukas', 'false'),
(350, 'babis', 'true'),
(556, 'fs', 'true'),
(2424, 'hgg', 'false'),
(33100, 'agrino', 'true'),
(65535, 'nionios', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `ac_id` smallint(5) UNSIGNED NOT NULL,
  `supply` float NOT NULL,
  `profit` float NOT NULL,
  `debt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`ac_id`, `supply`, `profit`, `debt`) VALUES
(200, 15, 47709.3, 14660.685),
(350, 10, 7040.58, 36.30954831625),
(2424, 10, 0, 0),
(65535, 20, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `simple_cust`
--

CREATE TABLE `simple_cust` (
  `ac_id` smallint(5) UNSIGNED NOT NULL,
  `credit_limit` float NOT NULL,
  `cur_due_amount` double NOT NULL,
  `avail_amount` float NOT NULL,
  `exp_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simple_cust`
--

INSERT INTO `simple_cust` (`ac_id`, `credit_limit`, `cur_due_amount`, `avail_amount`, `exp_date`) VALUES
(55, 5555, 0, 15000, '2018-04-12'),
(66, 44444, 5234.48, 9936.7, '2017-06-08'),
(111, 500, 20.5, 2411.8, '2017-08-16'),
(121, 1000, 0, 689.36, '2017-01-28'),
(123, 500, -521.234, 0.7, '2017-01-26'),
(144, 330, 0, 44, '2017-01-18'),
(177, 600, 50, 1000, '2017-01-31'),
(556, 44, 566, 223, '2017-01-20'),
(33100, 100, 0, 150, '2017-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tran_id` int(11) UNSIGNED NOT NULL,
  `cust_name` varchar(25) NOT NULL,
  `merch_name` varchar(25) NOT NULL,
  `tran_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tran_amount` double NOT NULL,
  `kind` enum('credit','charge') NOT NULL,
  `c_tran` enum('true','false') NOT NULL,
  `emp_id` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tran_id`, `cust_name`, `merch_name`, `tran_date`, `tran_amount`, `kind`, `c_tran`, `emp_id`) VALUES
(63, 'lola', 'loukas', '2017-01-23 16:04:02', 12, 'credit', 'false', ''),
(64, 'lola', 'babis', '2017-01-23 16:04:10', 23, 'credit', 'false', ''),
(65, 'lola', 'babis', '2017-01-23 16:04:18', 28.9, 'charge', 'false', ''),
(66, 'lola', 'loukas', '2017-01-23 16:04:25', 89.3, 'charge', 'false', ''),
(67, 'intel', 'loukas', '2017-01-23 18:25:42', 52.3, 'credit', 'true', 'eaaaaa'),
(68, 'intel', 'loukas', '2017-01-23 18:28:07', 52.3, 'credit', 'true', 'eaaaaa'),
(69, 'intel', 'babis', '2017-01-23 18:28:16', 12.3, 'credit', 'true', 'eaaaaa'),
(70, 'intel', 'babis', '2017-01-23 18:28:25', 5.3, 'charge', 'true', 'eaaaaa'),
(71, 'intel', 'babis', '2017-01-23 18:28:32', 52.5, 'charge', 'true', 'eaaaaa'),
(72, 'intel', 'babis', '2017-01-23 18:28:42', 47.58, 'credit', 'true', 'eaaaaa'),
(73, 'intel', 'babis', '2017-01-23 18:28:51', 57.3, 'credit', 'true', 'eaaaaa'),
(74, 'Leonidas', 'babis', '2017-01-23 20:42:39', 0, 'charge', 'false', ''),
(75, 'Leonidas', 'babis', '2017-01-23 20:39:13', 149.5, 'credit', 'false', ''),
(76, 'Leonidas', 'nionios', '2017-01-23 20:54:20', 50, 'credit', 'false', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_cust`
--
ALTER TABLE `company_cust`
  ADD PRIMARY KEY (`ac_id`,`employee_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ac_id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `simple_cust`
--
ALTER TABLE `simple_cust`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tran_id`,`cust_name`,`merch_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tran_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_cust`
--
ALTER TABLE `company_cust`
  ADD CONSTRAINT `company_cust_ibfk_1` FOREIGN KEY (`ac_id`) REFERENCES `simple_cust` (`ac_id`);

--
-- Constraints for table `merchant`
--
ALTER TABLE `merchant`
  ADD CONSTRAINT `merchant_ibfk_1` FOREIGN KEY (`ac_id`) REFERENCES `customer` (`ac_id`);

--
-- Constraints for table `simple_cust`
--
ALTER TABLE `simple_cust`
  ADD CONSTRAINT `simple_cust_ibfk_1` FOREIGN KEY (`ac_id`) REFERENCES `customer` (`ac_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
