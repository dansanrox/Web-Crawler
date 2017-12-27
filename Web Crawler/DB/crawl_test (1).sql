-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2015 at 03:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crawl_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Dhanuka Abeywardhane', 'asd@gmail.com', '12345'),
(2, 'Test Admin', 'teast@test.com', '123'),
(3, 'test 2 admin', 'dssds@test.com', '123'),
(4, 'Test Admin 2 ', 'test@restes.bnm', '321'),
(5, 'test 3 name', 'sdasd@raer', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `name`, `comment`) VALUES
(33, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'tst'),
(34, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'ok now'),
(35, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'Hi'),
(36, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'Hahahaha'),
(37, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'testing from Admin'),
(38, 'asd@gmail.com', 'Dhanuka Abeywardhane', '    '),
(39, 'asd@gmail.com', 'Dhanuka Abeywardhane', ''),
(40, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'test'),
(41, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'OK NOW???'),
(42, 'asd@gmail.com', 'Dhanuka Abeywardhane', 'A B V test'),
(43, 'asd@gmail.com', 'Dhanuka Abeywardhane', '           a');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
`user_id` int(100) NOT NULL,
  `user_name` text NOT NULL,
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(4, 'test name', 'test@dsad.com', '1234'),
(6, 'Shanuka Siriwansa', 'sha@test.com', '543');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
