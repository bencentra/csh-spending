-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: db.csh.rit.edu
-- Generation Time: Jul 22, 2012 at 10:44 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `financial`
--

-- --------------------------------------------------------

--
-- Table structure for table `spending2012`
--

CREATE TABLE IF NOT EXISTS `spending2012` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` text NOT NULL,
  `item` text NOT NULL,
  `committee` text NOT NULL,
  `purchaser` text NOT NULL,
  `merchant` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `spending2012`
--

INSERT INTO `spending2012` (`id`, `date`, `item`, `committee`, `purchaser`, `merchant`, `amount`, `description`) VALUES
(1, '7/16/12', 'Imps Test', 'imps', 'Josh McSaveney', 'Home Depot', 20.00, 'Power tools ''n shit.'),
(2, '7/16/12', 'OpComm Item', 'opcomm', 'Slackwill', 'Cisco', 100.00, 'A fuckton of CAT5'),
(3, '7/16/12', 'Evals Item', 'evals', 'Gabbie Burns', 'Wal-mart', 10.00, 'Open House candy'),
(4, '7/16/12', 'R&D Item', 'randd', 'Duncan', 'Digikey', 50.00, 'Lots of LED''s'),
(5, '7/16/12', 'Social Item', 'social', 'Ben Meyer', 'BJs', 150.00, 'Burgers and Hot Dogs'),
(6, '7/16/12', 'History Item', 'history', 'Emily Egeland', 'Plaques and Such', 75.00, 'New Eboard Plaques'),
(7, '7/16/12', 'Misc Item', 'misc', 'Ben Centra', 'RIT Print Hub', 30.00, 'Deposit Slips'),
(8, '7/22/12', 'Alumni Donation', 'donations', 'Guy Alumni', '---', 90.00, 'User Rack Dues');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
