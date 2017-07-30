-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 10:18 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(6) NOT NULL,
  `mem_name` varchar(50) NOT NULL,
  `mem_lname` varchar(50) NOT NULL,
  `mem_user` varchar(20) NOT NULL,
  `mem_pass` varchar(20) DEFAULT NULL,
  `mem_status` varchar(10) NOT NULL,
  `mem_img` varchar(200) NOT NULL DEFAULT 'user.jpg',
  `mem_img_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_name`, `mem_lname`, `mem_user`, `mem_pass`, `mem_status`, `mem_img`, `mem_img_date`) VALUES
(1, 'นายรอฮีมี', 'ดือราแม', '405659003', '111', 'admin', '201703221733206953.jpg', '2017-04-09 04:03:40'),
(2, 'นายมูฮามะฟาอิส', 'จูเปาะ', '405659006', '111', 'user', '20170322274441927.jpg', '2017-04-09 04:01:37'),
(3, 'นายอานัส', 'หะยีปูเต๊ะ', '405659021', '111', 'user', 'user.jpg', '2017-04-09 04:03:48'),
(4, 'admin', 'admin', 'admin', 'admin', 'admin', '20170409128671634.jpg', '2017-04-08 20:20:27'),
(5, 'user', 'user', 'user', 'user', 'user', 'user.jpg', '2017-03-29 17:50:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
