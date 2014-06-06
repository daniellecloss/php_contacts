-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2012 at 11:39 PM
-- Server version: 5.5.8
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `yui_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(5) NOT NULL AUTO_INCREMENT,
  `contact_firstname` varchar(50) NOT NULL,
  `contact_lastname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(35) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(9) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `contact_firstname`, `contact_lastname`, `address`, `city`, `state`, `zip`) VALUES
(2, 'Joe', 'Sally', '1 New Lane', 'New City', 'MI', '48888'),
(5, 'Julie', 'Tanner', '111 Lucy Lane', 'Cityscape', 'MI', '48000'),
(15, 'Norm', 'Shields', '1122 Lucy Lane', 'Cityscape', 'mi', '48000'),
(16, 'Susie', 'Lastly', '123 Howell Drive', 'Howell', 'MI', '48888'),
(17, 'Norm', 'Shields', '1122 Lucy Lane', 'Cityscape', 'MI', '48000'),
(24, 'Sheila', 'Shields', '11223 Lucy Lane', 'Cityscape', 'MI', '48000'),
(28, 'Luck', 'Javis', '888 Thunder Ct', 'Moonville', 'CA', '88001'),
(30, 'Julie', 'Jewels', '1111 Diamond Lane', 'Allenton', 'MS', '63982'),
(32, 'James', 'Jovial', '6985 Laughing Court', 'Hootsville', 'ID', '44785');