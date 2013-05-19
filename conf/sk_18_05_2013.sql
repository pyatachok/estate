-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2013 at 12:58 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sk`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE IF NOT EXISTS `ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publisher_id` int(10) unsigned NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  KEY `publisher_id` (`publisher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`id`, `creation_date`, `publisher_id`) VALUES
(1, '2013-04-21 17:06:28', 1),
(2, '2013-04-21 17:06:38', 2),
(3, '2013-04-21 17:06:37', 3),
(4, '2013-04-21 17:06:48', 1),
(5, '2013-05-03 15:09:04', 3),
(6, '2013-05-03 15:09:03', 1),
(7, '2013-05-03 18:31:34', 2),
(8, '2013-05-04 09:52:40', 3),
(9, '2012-11-06 22:00:00', 3),
(10, '2018-08-17 21:00:00', 3),
(11, '2013-05-17 16:04:37', 2),
(12, '2013-05-19 09:53:51', 3),
(14, '2013-05-19 09:55:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ad_field_value`
--

CREATE TABLE IF NOT EXISTS `ad_field_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ad_id` int(10) unsigned NOT NULL DEFAULT '0',
  `value` varchar(1024) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_ad` (`field_id`,`ad_id`),
  KEY `field_id` (`field_id`,`ad_id`,`value`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ad_field_value`
--

INSERT INTO `ad_field_value` (`id`, `field_id`, `ad_id`, `value`) VALUES
(1, 4, 12, 'some value'),
(4, 4, 14, 'some data'),
(5, 8, 14, 'soma data2');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artist`, `title`) VALUES
(1, 'The  Military  Wives', 'In  My  Dreams'),
(2, 'Adele', '21'),
(3, 'Bruce  Springsteen', 'Wrecking Ball (Deluxe)'),
(4, 'Lana  Del  Rey', 'Born  To  Die'),
(5, 'Gotye', 'Making  Mirrors'),
(6, 'Okean Elzy', '1211'),
(7, 'Vivaldi', 'Four seasons'),
(8, 'Okean Elzy', 'Brussels2');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `name`) VALUES
(4, 'address'),
(8, 'adress2'),
(9, 'adress3'),
(3, 'contact_person'),
(2, 'description'),
(6, 'email'),
(7, 'floor'),
(5, 'phone'),
(1, 'title');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(2, 'iris'),
(5, 'iris2'),
(1, 'kira'),
(3, 'mice'),
(4, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `related_fields`
--

CREATE TABLE IF NOT EXISTS `related_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned NOT NULL DEFAULT '0',
  `related_field_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`,`related_field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `related_fields`
--

INSERT INTO `related_fields` (`id`, `field_id`, `related_field_id`) VALUES
(1, 4, 7),
(2, 7, 4),
(3, 8, 4),
(4, 9, 4),
(6, 9, 7),
(5, 9, 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad`
--
ALTER TABLE `ad`
  ADD CONSTRAINT `ad_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
