-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 08:50 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `images` varchar(200) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `datetime`, `title`, `category`, `author`, `images`, `post`) VALUES
(22, 'March-18-2020 12:44:45', 'Student management system', 'C++', 'Piyush Pipriye', 'Screenshot (9).png', 'C++ is a general-purpose object-oriented programming (OOP) language, developed by Bjarne Stroustrup, and is an extension of the C language. C++ is considered to be an intermediate-level language, as it encapsulates both high- and low-level language features.'),
(23, 'March-18-2020 12:45:24', 'Student management system', 'Python and flask', 'Piyush Pipriye', 'Screenshot (15).png', 'Python is an interpreted, high-level, general-purpose programming language. Python is dynamically typed and garbage-collected. \r\nIt supports multiple programming paradigms, including procedural, object-oriented, and functional programming.'),
(25, 'March-18-2020 22:32:41', 'IOT based Car control from web app(raspberry pi)', 'Java', 'Piyush Pipriye', 'Screenshot (12).png', 'Java is a general-purpose programming language that is class-based, object-oriented, and designed to have as few implementation dependencies as possible. \r\nJava applications are typically compiled to bytecode that can run on any Java virtual machine (JVM) regardless of the underlying computer architecture.'),
(26, 'March-18-2020 12:49:18', 'PHP', 'PHP', 'Piyush Pipriye', 'IMG-20200317-WA0007.jpeg', 'PHP is a server side scripting language. that is used to develop Static websites or Dynamic websites or Web applications. PHP stands for Hypertext Pre-processor, that earlier stood for Personal Home Pages. The client computers accessing the PHP scripts require a web browser only.'),
(28, 'March-20-2020 21:05:28', 'angular', 'HTML', 'piyush', 'Lighthouse.jpg', 'demo for angular');

-- --------------------------------------------------------

--
-- Table structure for table `admins_reg`
--

CREATE TABLE `admins_reg` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `addby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_reg`
--

INSERT INTO `admins_reg` (`id`, `datetime`, `username`, `password`, `addby`) VALUES
(1, 'December-31-2008 21:23:39', 'ashu', 'ashu#12', 'Piyush Pipriye'),
(3, 'December-31-2008 21:29:49', 'piyush', 'pp@12', 'Piyush Pipriye'),
(4, 'March-20-2020 21:09:11', 'Varun', 'vp12', 'piyush');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatornm` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatornm`) VALUES
(5, 'March-18-2020 03:36:07', 'Trending', 'Piyush Pipriye'),
(6, 'March-18-2020 03:49:03', 'PHP', 'Piyush Pipriye'),
(8, 'March-18-2020 12:43:08', 'Java', 'Piyush Pipriye'),
(10, 'March-19-2020 00:22:04', 'Bootstrap', 'Piyush Pipriye'),
(11, 'March-20-2020 21:07:48', 'React', 'piyush'),
(12, 'March-20-2020 21:08:10', 'angular', 'ashu');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `addby` varchar(200) NOT NULL,
  `status` varchar(5) NOT NULL,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `addby`, `status`, `admin_id`) VALUES
(5, 'March-18-2020 23:28:35', 'Piyush Pipriye', 'pipriyepiyush00@gmail.com', 'Testing', 'ashu', 'on', 26),
(10, 'March-20-2020 00:53:40', 'Varun Pipriye', 'varun15@gmail.com', 'Awsome blog...', 'piyush', 'off', 25),
(11, 'December-31-2008 20:26:12', 'Ashu', 'ashu@gmail.com', 'completed', 'ashu', 'on', 22),
(12, 'December-31-2008 20:45:09', 'Ashu', 'ashu@gmail.com', 'demo', '', 'off', 23),
(13, 'December-31-2008 20:45:47', 'piyush', 'pipriyepiyush@gmial.com', 'demo2', 'piyush', 'on', 23),
(14, 'March-20-2020 21:17:50', 'Ashu', 'Pipriyenilima@rediffmail.com', 'nicee one', 'ashu', 'off', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins_reg`
--
ALTER TABLE `admins_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admins_reg`
--
ALTER TABLE `admins_reg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign key to admin table` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
