-- phpMyAdmin SQL Dump
-- version 4.1.14.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2014 at 12:29 PM
-- Server version: 5.5.40
-- PHP Version: 5.5.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `FDTree`
--
CREATE DATABASE IF NOT EXISTS `FDTree` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `FDTree`;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(600) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `parent_id`) VALUES
(1, 'Iran', 0),
(2, 'Alborz', 1),
(3, 'Azarbayjan Sharghi', 1),
(4, 'Boushehr', 1),
(5, 'Chahar Mahal Bakhtiari', 1),
(6, 'Fars', 1),
(7, 'Ghom', 1),
(8, 'Gilan', 1),
(9, 'Golestan', 1),
(10, 'Hamedan', 1),
(11, 'Hormozgan', 1),
(12, 'Ielam', 1),
(13, 'Isfahan', 1),
(14, 'Kermanshah', 1),
(15, 'Khorasan', 1),
(16, 'Lorestan', 1),
(17, 'Mazandaran', 1),
(18, 'Qazvin', 1),
(19, 'Semnan', 1),
(20, 'Sistan Balochestan', 1),
(21, 'Tehran', 1),
(22, 'Yazd', 1),
(23, 'Zanjan', 1),
(24, 'Ardebil', 1),
(25, 'Kerman', 1),
(26, 'khozestan', 1),
(27, 'Kordestan', 1),
(28, 'Malaysia', 0),
(29, 'Malaysia', 28);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
