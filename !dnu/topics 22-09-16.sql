-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2022 at 12:01 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commissions`
--

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `related` text NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `date` timestamp(6) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `tag`, `related`, `img`, `date`, `type`) VALUES
(1, 'Work Placement and Co-op', 'coop', 'orientation, prof', NULL, '2022-09-06 14:00:00.000000', 'misc'),
(2, 'Definitions', 'definitions', 'network, logic, windows, data, nw-terms, win-terms', NULL, '2022-09-07 13:30:00.000000', 'misc'),
(6, 'Orientation', 'orientation', 'network, logic, webdev, windows, data, prof, coop', NULL, '2022-09-06 12:30:00.000000', 'misc'),
(4, 'Logic and Programming I', 'logic', 'definitions, orientation, git, vm', NULL, '2022-09-07 11:30:03.000000', 'logic'),
(5, 'Intro to Networking and Security', 'network', 'p-tracer, definitions, orientation, nw-terms, lan-wire, switch-config', NULL, '2022-09-07 13:30:00.000000', 'network'),
(7, 'Packet Tracer', 'p-tracer', 'network, definitions, lan-wire, switch-config', NULL, '2022-09-07 13:30:00.000000', 'network'),
(8, 'Website Development', 'webdev', 'orientation, logic, git', NULL, '2022-09-07 16:30:00.000000', 'webdev'),
(9, 'Data Fundamentals', 'data', 'orientation, definitions, git, vm, db-basics, nf', NULL, '2022-09-08 13:30:00.000000', 'data'),
(10, 'Intro to Windows Administration', 'windows', 'orientation, definitions, vm, settings, os, win-terms, license', NULL, '2022-09-08 16:30:00.000000', 'windows'),
(11, 'GIT Version Control', 'git', 'logic, webdev, data, command', 'git', '2022-09-09 13:30:00.000000', 'software'),
(12, 'Virtual Machines', 'vm', 'logic, network, data, windows, os', NULL, '2022-09-09 13:30:00.000000', 'software'),
(13, 'Networking Vocabulary', 'nw-terms', 'network, definitions, lan-wire, switch-config', NULL, '2022-09-09 15:30:00.000000', 'network'),
(14, 'Database Basics', 'db-basics', 'data, definitions, nf', NULL, '2022-09-13 11:30:00.000000', 'data'),
(15, 'Normalization Forms', 'nf', 'data, db-basics, definitions', NULL, '2022-09-16 13:30:00.000000', 'data'),
(16, 'Professional Practices for IT', 'prof', 'orientation, coop', NULL, '2022-09-13 13:30:00.000000', 'prof'),
(17, 'JavaScript Basics', 'js-basics', 'js-operators, logic, definitions, command', NULL, '2022-09-13 16:30:00.000000', 'logic'),
(18, 'JavaScript Operators', 'js-operators', 'js-basics, logic', NULL, '2022-09-14 13:30:00.000000', 'logic'),
(19, 'LAN Wiring: Where Does This Jack Go?', 'lan-wire', 'network, p-tracer, nw-terms, definitions, switch-config', NULL, '2022-09-16 16:30:00.000000', 'network'),
(20, 'Switch Configuration', 'switch-config', 'lan-wire, network, nw-terms, definitions, p-tracer, command', NULL, '2022-09-16 16:30:00.000000', 'network'),
(21, 'What Is An Operating System', 'os', 'windows, definitions, vm, win-terms, license', NULL, '2022-09-12 13:30:00.000000', 'windows'),
(22, 'Windows Licensing Models', 'license', 'windows, os, win-terms, settings', NULL, '2022-09-13 13:30:00.000000', 'windows'),
(23, 'Windows Settings & Administration\r\n', 'settings', 'windows, os, license, win-terms, vm, command', NULL, '2022-09-15 16:30:00.000000', 'windows'),
(24, 'Windows Vocabulary', 'win-terms', 'windows, settings, os, definitions', NULL, '2022-09-15 16:30:00.000000', 'windows'),
(25, 'Command List', 'command', 'git, js-basics, switch-config, settings', NULL, '2022-09-16 17:30:00.000000', 'software');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
