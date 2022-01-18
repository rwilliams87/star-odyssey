-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2022 at 04:04 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star_odyssey`
--

-- --------------------------------------------------------

--
-- Table structure for table `drafting`
--

DROP TABLE IF EXISTS `drafting`;
CREATE TABLE IF NOT EXISTS `drafting` (
  `placed_by` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `number` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `time_left` tinyint(3) UNSIGNED NOT NULL DEFAULT '24',
  `placed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_number`),
  KEY `placed_by` (`placed_by`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drafting`
--

INSERT INTO `drafting` (`placed_by`, `type`, `number`, `time_left`, `placed_on`, `order_number`, `active`) VALUES
(17, 1, 5, 11, '2022-01-18 02:27:41', 1, 1),
(17, 2, 4, 11, '2022-01-18 02:27:41', 2, 1),
(17, 3, 5, 11, '2022-01-18 02:27:41', 3, 1),
(17, 1, 69, 10, '2022-01-18 02:29:52', 4, 1),
(17, 2, 69, 10, '2022-01-18 02:29:52', 5, 1),
(17, 3, 69, 10, '2022-01-18 02:29:52', 6, 1),
(17, 1, 421, 12, '2022-01-18 02:39:57', 7, 1),
(17, 2, 421, 12, '2022-01-18 02:39:57', 8, 1),
(17, 3, 421, 12, '2022-01-18 02:39:57', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drafting_engineers`
--

DROP TABLE IF EXISTS `drafting_engineers`;
CREATE TABLE IF NOT EXISTS `drafting_engineers` (
  `id` int(10) UNSIGNED NOT NULL,
  `t12` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t11` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t10` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t9` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t8` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t7` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t6` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t5` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drafting_engineers`
--

INSERT INTO `drafting_engineers` (`id`, `t12`, `t11`, `t10`, `t9`, `t8`, `t7`, `t6`, `t5`, `t4`, `t3`, `t2`, `t1`) VALUES
(15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `drafting_scientists`
--

DROP TABLE IF EXISTS `drafting_scientists`;
CREATE TABLE IF NOT EXISTS `drafting_scientists` (
  `id` int(10) UNSIGNED NOT NULL,
  `t12` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t11` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t10` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t9` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t8` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t7` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t6` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t5` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drafting_scientists`
--

INSERT INTO `drafting_scientists` (`id`, `t12`, `t11`, `t10`, `t9`, `t8`, `t7`, `t6`, `t5`, `t4`, `t3`, `t2`, `t1`) VALUES
(15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `drafting_soldiers`
--

DROP TABLE IF EXISTS `drafting_soldiers`;
CREATE TABLE IF NOT EXISTS `drafting_soldiers` (
  `id` int(10) UNSIGNED NOT NULL,
  `t12` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t11` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t10` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t9` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t8` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t7` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t6` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t5` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `t1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drafting_soldiers`
--

INSERT INTO `drafting_soldiers` (`id`, `t12`, `t11`, `t10`, `t9`, `t8`, `t7`, `t6`, `t5`, `t4`, `t3`, `t2`, `t1`) VALUES
(15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mining`
--

DROP TABLE IF EXISTS `mining`;
CREATE TABLE IF NOT EXISTS `mining` (
  `id` int(11) NOT NULL,
  `ridon` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `briterium` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `kriden` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `rp4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `rp3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `rp2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `rp1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bp4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bp3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bp2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `bp1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `kp4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `kp3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `kp2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `kp1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `e4` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `e3` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `e2` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `e1` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mining`
--

INSERT INTO `mining` (`id`, `ridon`, `briterium`, `kriden`, `rp4`, `rp3`, `rp2`, `rp1`, `bp4`, `bp3`, `bp2`, `bp1`, `kp4`, `kp3`, `kp2`, `kp1`, `e4`, `e3`, `e2`, `e1`) VALUES
(17, 300, 300, 300, 157, 0, 0, 0, 157, 0, 0, 0, 52, 0, 0, 0, 225, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '5000',
  `ridon` int(11) NOT NULL DEFAULT '500',
  `briterium` int(11) NOT NULL DEFAULT '500',
  `kriden` int(11) NOT NULL DEFAULT '500',
  `civilians` int(11) NOT NULL DEFAULT '1000',
  `soldiers` int(11) NOT NULL DEFAULT '500',
  `scientists` int(11) NOT NULL DEFAULT '500',
  `engineers` int(11) NOT NULL DEFAULT '500',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `money`, `ridon`, `briterium`, `kriden`, `civilians`, `soldiers`, `scientists`, `engineers`) VALUES
(3, 1755, 500, 500, 500, 1848, 500, 500, 500),
(8, 1755, 500, 500, 500, 1848, 500, 500, 500),
(9, 1755, 500, 500, 500, 1848, 500, 500, 500),
(10, 1755, 500, 500, 500, 1848, 500, 500, 500),
(14, 1755, 500, 500, 500, 1848, 500, 500, 500),
(15, 1755, 500, 500, 500, 1848, 500, 500, 500),
(16, 1755, 500, 500, 500, 1848, 500, 500, 500),
(17, 1755, 500, 500, 500, 1845, 500, 500, 137);

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

DROP TABLE IF EXISTS `sectors`;
CREATE TABLE IF NOT EXISTS `sectors` (
  `sector_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `x` tinyint(4) UNSIGNED NOT NULL,
  `y` tinyint(4) UNSIGNED NOT NULL,
  `belongs_to` smallint(255) NOT NULL DEFAULT '0',
  `home_sector` smallint(6) NOT NULL DEFAULT '0',
  `starbase` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `sector_id` (`sector_id`)
) ENGINE=MyISAM AUTO_INCREMENT=401 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`sector_id`, `x`, `y`, `belongs_to`, `home_sector`, `starbase`) VALUES
(1, 1, 1, 0, 0, 0),
(2, 1, 2, 0, 0, 0),
(3, 1, 3, 0, 0, 0),
(4, 1, 4, 0, 0, 0),
(5, 1, 5, 0, 0, 0),
(6, 1, 6, 0, 0, 0),
(7, 1, 7, 0, 0, 0),
(8, 1, 8, 0, 0, 0),
(9, 1, 9, 0, 0, 0),
(10, 1, 10, 0, 0, 0),
(11, 1, 11, 15, 1, 0),
(12, 1, 12, 0, 0, 0),
(13, 1, 13, 0, 0, 0),
(14, 1, 14, 0, 0, 0),
(15, 1, 15, 0, 0, 0),
(16, 1, 16, 0, 0, 0),
(17, 1, 17, 0, 0, 0),
(18, 1, 18, 0, 0, 0),
(19, 1, 19, 0, 0, 0),
(20, 1, 20, 0, 0, 0),
(21, 2, 1, 0, 0, 0),
(22, 2, 2, 0, 0, 0),
(23, 2, 3, 0, 0, 0),
(24, 2, 4, 0, 0, 0),
(25, 2, 5, 0, 0, 0),
(26, 2, 6, 0, 0, 0),
(27, 2, 7, 0, 0, 0),
(28, 2, 8, 0, 0, 0),
(29, 2, 9, 0, 0, 0),
(30, 2, 10, 0, 0, 0),
(31, 2, 11, 0, 0, 0),
(32, 2, 12, 0, 0, 0),
(33, 2, 13, 0, 0, 0),
(34, 2, 14, 0, 0, 0),
(35, 2, 15, 0, 0, 0),
(36, 2, 16, 0, 0, 0),
(37, 2, 17, 0, 0, 0),
(38, 2, 18, 0, 0, 0),
(39, 2, 19, 0, 0, 0),
(40, 2, 20, 0, 0, 0),
(41, 3, 1, 0, 0, 0),
(42, 3, 2, 0, 0, 0),
(43, 3, 3, 0, 0, 0),
(44, 3, 4, 0, 0, 0),
(45, 3, 5, 0, 0, 0),
(46, 3, 6, 0, 0, 0),
(47, 3, 7, 0, 0, 0),
(48, 3, 8, 0, 0, 0),
(49, 3, 9, 0, 0, 0),
(50, 3, 10, 0, 0, 0),
(51, 3, 11, 0, 0, 0),
(52, 3, 12, 0, 0, 0),
(53, 3, 13, 0, 0, 0),
(54, 3, 14, 0, 0, 0),
(55, 3, 15, 0, 0, 0),
(56, 3, 16, 0, 0, 0),
(57, 3, 17, 0, 0, 0),
(58, 3, 18, 0, 0, 0),
(59, 3, 19, 0, 0, 0),
(60, 3, 20, 0, 0, 0),
(61, 4, 1, 0, 0, 0),
(62, 4, 2, 0, 0, 0),
(63, 4, 3, 0, 0, 0),
(64, 4, 4, 0, 0, 0),
(65, 4, 5, 0, 0, 0),
(66, 4, 6, 0, 0, 0),
(67, 4, 7, 0, 0, 0),
(68, 4, 8, 0, 0, 0),
(69, 4, 9, 0, 0, 0),
(70, 4, 10, 0, 0, 0),
(71, 4, 11, 0, 0, 0),
(72, 4, 12, 0, 0, 0),
(73, 4, 13, 0, 0, 0),
(74, 4, 14, 0, 0, 0),
(75, 4, 15, 0, 0, 0),
(76, 4, 16, 0, 0, 0),
(77, 4, 17, 17, 1, 0),
(78, 4, 18, 0, 0, 0),
(79, 4, 19, 0, 0, 0),
(80, 4, 20, 0, 0, 0),
(81, 5, 1, 0, 0, 0),
(82, 5, 2, 0, 0, 0),
(83, 5, 3, 0, 0, 0),
(84, 5, 4, 0, 0, 0),
(85, 5, 5, 0, 0, 0),
(86, 5, 6, 0, 0, 0),
(87, 5, 7, 0, 0, 0),
(88, 5, 8, 0, 0, 0),
(89, 5, 9, 0, 0, 0),
(90, 5, 10, 0, 0, 0),
(91, 5, 11, 0, 0, 0),
(92, 5, 12, 0, 0, 0),
(93, 5, 13, 0, 0, 0),
(94, 5, 14, 0, 0, 0),
(95, 5, 15, 0, 0, 0),
(96, 5, 16, 0, 0, 0),
(97, 5, 17, 0, 0, 0),
(98, 5, 18, 0, 0, 0),
(99, 5, 19, 0, 0, 0),
(100, 5, 20, 0, 0, 0),
(101, 6, 1, 0, 0, 0),
(102, 6, 2, 0, 0, 0),
(103, 6, 3, 0, 0, 0),
(104, 6, 4, 0, 0, 0),
(105, 6, 5, 0, 0, 0),
(106, 6, 6, 0, 0, 0),
(107, 6, 7, 0, 0, 0),
(108, 6, 8, 0, 0, 0),
(109, 6, 9, 0, 0, 0),
(110, 6, 10, 0, 0, 0),
(111, 6, 11, 0, 0, 0),
(112, 6, 12, 0, 0, 0),
(113, 6, 13, 0, 0, 0),
(114, 6, 14, 0, 0, 0),
(115, 6, 15, 0, 0, 0),
(116, 6, 16, 0, 0, 0),
(117, 6, 17, 0, 0, 0),
(118, 6, 18, 0, 0, 0),
(119, 6, 19, 0, 0, 0),
(120, 6, 20, 0, 0, 0),
(121, 7, 1, 0, 0, 0),
(122, 7, 2, 0, 0, 0),
(123, 7, 3, 0, 0, 0),
(124, 7, 4, 0, 0, 0),
(125, 7, 5, 0, 0, 0),
(126, 7, 6, 0, 0, 0),
(127, 7, 7, 0, 0, 0),
(128, 7, 8, 0, 0, 0),
(129, 7, 9, 0, 0, 0),
(130, 7, 10, 0, 0, 0),
(131, 7, 11, 0, 0, 0),
(132, 7, 12, 0, 0, 0),
(133, 7, 13, 0, 0, 0),
(134, 7, 14, 0, 0, 0),
(135, 7, 15, 0, 0, 0),
(136, 7, 16, 0, 0, 0),
(137, 7, 17, 0, 0, 0),
(138, 7, 18, 0, 0, 0),
(139, 7, 19, 0, 0, 0),
(140, 7, 20, 0, 0, 0),
(141, 8, 1, 0, 0, 0),
(142, 8, 2, 0, 0, 0),
(143, 8, 3, 0, 0, 0),
(144, 8, 4, 0, 0, 0),
(145, 8, 5, 0, 0, 0),
(146, 8, 6, 0, 0, 0),
(147, 8, 7, 0, 0, 0),
(148, 8, 8, 0, 0, 0),
(149, 8, 9, 0, 0, 0),
(150, 8, 10, 0, 0, 0),
(151, 8, 11, 0, 0, 0),
(152, 8, 12, 0, 0, 0),
(153, 8, 13, 0, 0, 0),
(154, 8, 14, 0, 0, 0),
(155, 8, 15, 0, 0, 0),
(156, 8, 16, 0, 0, 0),
(157, 8, 17, 0, 0, 0),
(158, 8, 18, 0, 0, 0),
(159, 8, 19, 0, 0, 0),
(160, 8, 20, 0, 0, 0),
(161, 9, 1, 0, 0, 0),
(162, 9, 2, 0, 0, 0),
(163, 9, 3, 0, 0, 0),
(164, 9, 4, 0, 0, 0),
(165, 9, 5, 0, 0, 0),
(166, 9, 6, 0, 0, 0),
(167, 9, 7, 0, 0, 0),
(168, 9, 8, 0, 0, 0),
(169, 9, 9, 0, 0, 0),
(170, 9, 10, 0, 0, 0),
(171, 9, 11, 0, 0, 0),
(172, 9, 12, 0, 0, 0),
(173, 9, 13, 0, 0, 0),
(174, 9, 14, 0, 0, 0),
(175, 9, 15, 0, 0, 0),
(176, 9, 16, 0, 0, 0),
(177, 9, 17, 0, 0, 0),
(178, 9, 18, 0, 0, 0),
(179, 9, 19, 0, 0, 0),
(180, 9, 20, 0, 0, 0),
(181, 10, 1, 0, 0, 0),
(182, 10, 2, 0, 0, 0),
(183, 10, 3, 0, 0, 0),
(184, 10, 4, 0, 0, 0),
(185, 10, 5, 0, 0, 0),
(186, 10, 6, 0, 0, 0),
(187, 10, 7, 0, 0, 0),
(188, 10, 8, 0, 0, 0),
(189, 10, 9, 0, 0, 0),
(190, 10, 10, 0, 0, 0),
(191, 10, 11, 0, 0, 0),
(192, 10, 12, 0, 0, 0),
(193, 10, 13, 0, 0, 0),
(194, 10, 14, 0, 0, 0),
(195, 10, 15, 0, 0, 0),
(196, 10, 16, 0, 0, 0),
(197, 10, 17, 0, 0, 0),
(198, 10, 18, 0, 0, 0),
(199, 10, 19, 0, 0, 0),
(200, 10, 20, 0, 0, 0),
(201, 11, 1, 0, 0, 0),
(202, 11, 2, 0, 0, 0),
(203, 11, 3, 0, 0, 0),
(204, 11, 4, 0, 0, 0),
(205, 11, 5, 0, 0, 0),
(206, 11, 6, 0, 0, 0),
(207, 11, 7, 0, 0, 0),
(208, 11, 8, 0, 0, 0),
(209, 11, 9, 0, 0, 0),
(210, 11, 10, 0, 0, 0),
(211, 11, 11, 0, 0, 0),
(212, 11, 12, 0, 0, 0),
(213, 11, 13, 0, 0, 0),
(214, 11, 14, 0, 0, 0),
(215, 11, 15, 0, 0, 0),
(216, 11, 16, 0, 0, 0),
(217, 11, 17, 0, 0, 0),
(218, 11, 18, 0, 0, 0),
(219, 11, 19, 0, 0, 0),
(220, 11, 20, 0, 0, 0),
(221, 12, 1, 0, 0, 0),
(222, 12, 2, 0, 0, 0),
(223, 12, 3, 0, 0, 0),
(224, 12, 4, 0, 0, 0),
(225, 12, 5, 0, 0, 0),
(226, 12, 6, 0, 0, 0),
(227, 12, 7, 0, 0, 0),
(228, 12, 8, 0, 0, 0),
(229, 12, 9, 0, 0, 0),
(230, 12, 10, 0, 0, 0),
(231, 12, 11, 0, 0, 0),
(232, 12, 12, 0, 0, 0),
(233, 12, 13, 0, 0, 0),
(234, 12, 14, 0, 0, 0),
(235, 12, 15, 0, 0, 0),
(236, 12, 16, 0, 0, 0),
(237, 12, 17, 0, 0, 0),
(238, 12, 18, 0, 0, 0),
(239, 12, 19, 0, 0, 0),
(240, 12, 20, 0, 0, 0),
(241, 13, 1, 0, 0, 0),
(242, 13, 2, 0, 0, 0),
(243, 13, 3, 13, 1, 0),
(244, 13, 4, 0, 0, 0),
(245, 13, 5, 0, 0, 0),
(246, 13, 6, 0, 0, 0),
(247, 13, 7, 0, 0, 0),
(248, 13, 8, 0, 0, 0),
(249, 13, 9, 0, 0, 0),
(250, 13, 10, 0, 0, 0),
(251, 13, 11, 0, 0, 0),
(252, 13, 12, 0, 0, 0),
(253, 13, 13, 14, 1, 0),
(254, 13, 14, 0, 0, 0),
(255, 13, 15, 0, 0, 0),
(256, 13, 16, 0, 0, 0),
(257, 13, 17, 0, 0, 0),
(258, 13, 18, 0, 0, 0),
(259, 13, 19, 0, 0, 0),
(260, 13, 20, 0, 0, 0),
(261, 14, 1, 0, 0, 0),
(262, 14, 2, 0, 0, 0),
(263, 14, 3, 0, 0, 0),
(264, 14, 4, 0, 0, 0),
(265, 14, 5, 0, 0, 0),
(266, 14, 6, 0, 0, 0),
(267, 14, 7, 0, 0, 0),
(268, 14, 8, 0, 0, 0),
(269, 14, 9, 0, 0, 0),
(270, 14, 10, 0, 0, 0),
(271, 14, 11, 0, 0, 0),
(272, 14, 12, 0, 0, 0),
(273, 14, 13, 0, 0, 0),
(274, 14, 14, 0, 0, 0),
(275, 14, 15, 0, 0, 0),
(276, 14, 16, 0, 0, 0),
(277, 14, 17, 0, 0, 0),
(278, 14, 18, 0, 0, 0),
(279, 14, 19, 0, 0, 0),
(280, 14, 20, 0, 0, 0),
(281, 15, 1, 0, 0, 0),
(282, 15, 2, 0, 0, 0),
(283, 15, 3, 0, 0, 0),
(284, 15, 4, 0, 0, 0),
(285, 15, 5, 0, 0, 0),
(286, 15, 6, 0, 0, 0),
(287, 15, 7, 0, 0, 0),
(288, 15, 8, 0, 0, 0),
(289, 15, 9, 0, 0, 0),
(290, 15, 10, 0, 0, 0),
(291, 15, 11, 0, 0, 0),
(292, 15, 12, 0, 0, 0),
(293, 15, 13, 0, 0, 0),
(294, 15, 14, 0, 0, 0),
(295, 15, 15, 0, 0, 0),
(296, 15, 16, 0, 0, 0),
(297, 15, 17, 0, 0, 0),
(298, 15, 18, 0, 0, 0),
(299, 15, 19, 0, 0, 0),
(300, 15, 20, 0, 0, 0),
(301, 16, 1, 0, 0, 0),
(302, 16, 2, 0, 0, 0),
(303, 16, 3, 0, 0, 0),
(304, 16, 4, 0, 0, 0),
(305, 16, 5, 0, 0, 0),
(306, 16, 6, 0, 0, 0),
(307, 16, 7, 0, 0, 0),
(308, 16, 8, 0, 0, 0),
(309, 16, 9, 0, 0, 0),
(310, 16, 10, 0, 0, 0),
(311, 16, 11, 0, 0, 0),
(312, 16, 12, 0, 0, 0),
(313, 16, 13, 0, 0, 0),
(314, 16, 14, 0, 0, 0),
(315, 16, 15, 0, 0, 0),
(316, 16, 16, 0, 0, 0),
(317, 16, 17, 0, 0, 0),
(318, 16, 18, 0, 0, 0),
(319, 16, 19, 0, 0, 0),
(320, 16, 20, 0, 0, 0),
(321, 17, 1, 0, 0, 0),
(322, 17, 2, 0, 0, 0),
(323, 17, 3, 0, 0, 0),
(324, 17, 4, 0, 0, 0),
(325, 17, 5, 0, 0, 0),
(326, 17, 6, 0, 0, 0),
(327, 17, 7, 0, 0, 0),
(328, 17, 8, 0, 0, 0),
(329, 17, 9, 0, 0, 0),
(330, 17, 10, 0, 0, 0),
(331, 17, 11, 0, 0, 0),
(332, 17, 12, 0, 0, 0),
(333, 17, 13, 0, 0, 0),
(334, 17, 14, 0, 0, 0),
(335, 17, 15, 0, 0, 0),
(336, 17, 16, 0, 0, 0),
(337, 17, 17, 0, 0, 0),
(338, 17, 18, 0, 0, 0),
(339, 17, 19, 0, 0, 0),
(340, 17, 20, 0, 0, 0),
(341, 18, 1, 0, 0, 0),
(342, 18, 2, 0, 0, 0),
(343, 18, 3, 0, 0, 0),
(344, 18, 4, 0, 0, 0),
(345, 18, 5, 0, 0, 0),
(346, 18, 6, 0, 0, 0),
(347, 18, 7, 0, 0, 0),
(348, 18, 8, 0, 0, 0),
(349, 18, 9, 0, 0, 0),
(350, 18, 10, 0, 0, 0),
(351, 18, 11, 0, 0, 0),
(352, 18, 12, 0, 0, 0),
(353, 18, 13, 0, 0, 0),
(354, 18, 14, 0, 0, 0),
(355, 18, 15, 0, 0, 0),
(356, 18, 16, 0, 0, 0),
(357, 18, 17, 0, 0, 0),
(358, 18, 18, 0, 0, 0),
(359, 18, 19, 0, 0, 0),
(360, 18, 20, 0, 0, 0),
(361, 19, 1, 0, 0, 0),
(362, 19, 2, 0, 0, 0),
(363, 19, 3, 0, 0, 0),
(364, 19, 4, 0, 0, 0),
(365, 19, 5, 0, 0, 0),
(366, 19, 6, 0, 0, 0),
(367, 19, 7, 0, 0, 0),
(368, 19, 8, 0, 0, 0),
(369, 19, 9, 0, 0, 0),
(370, 19, 10, 0, 0, 0),
(371, 19, 11, 0, 0, 0),
(372, 19, 12, 0, 0, 0),
(373, 19, 13, 0, 0, 0),
(374, 19, 14, 0, 0, 0),
(375, 19, 15, 0, 0, 0),
(376, 19, 16, 0, 0, 0),
(377, 19, 17, 0, 0, 0),
(378, 19, 18, 0, 0, 0),
(379, 19, 19, 0, 0, 0),
(380, 19, 20, 0, 0, 0),
(381, 20, 1, 0, 0, 0),
(382, 20, 2, 0, 0, 0),
(383, 20, 3, 0, 0, 0),
(384, 20, 4, 0, 0, 0),
(385, 20, 5, 0, 0, 0),
(386, 20, 6, 0, 0, 0),
(387, 20, 7, 0, 0, 0),
(388, 20, 8, 0, 0, 0),
(389, 20, 9, 0, 0, 0),
(390, 20, 10, 0, 0, 0),
(391, 20, 11, 0, 0, 0),
(392, 20, 12, 16, 1, 0),
(393, 20, 13, 0, 0, 0),
(394, 20, 14, 0, 0, 0),
(395, 20, 15, 0, 0, 0),
(396, 20, 16, 0, 0, 0),
(397, 20, 17, 0, 0, 0),
(398, 20, 18, 0, 0, 0),
(399, 20, 19, 0, 0, 0),
(400, 20, 20, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `leader_title` varchar(20) NOT NULL DEFAULT 'test',
  `leader_name` varchar(255) NOT NULL DEFAULT 'test',
  `sector_id` smallint(6) NOT NULL DEFAULT '0',
  `alliance_id` smallint(6) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `leader_title`, `leader_name`, `sector_id`, `alliance_id`) VALUES
(3, 'test@test', 'test', '$2y$10$iZjD1sf8QdWreelBXKAvRuxOLyzbNm4oL6lmPp6k6rmRa8tEoZZ6.', '', '', 0, 4),
(8, 'test2@test', 'test2', '$2y$10$bcl7SiHaVlwkOjoo5FoqcebiP9UChDnuu.2VVQaPWGJSm1I86FnKe', '', '', 0, 4),
(9, 'test3@test', 'test3', '$2y$10$5H9fHK.GML6BE/bTxsKCQ.yPPJQWdAoVtv5jFwtleS1MlyC3A/oGq', '', '', 0, 4),
(10, 'test4@test', 'test4', '$2y$10$KqwTItVMFLqfgcm/jL6cz.J.8IFSHE.hkuGfchBYJK78/XNxT9jia', '', '', 0, 4),
(12, 'test6@test', 'test6', '$2y$10$ezSNr.C3tARziqEdcSrcreo9LNg.ireepDcQGdR7pQ.KNSt4TroWC', 'Mr', 'Tester', 96, 4),
(13, 'test7@test', 'test7', '$2y$10$uYDhKn0FUwgi94oujXBsh.1bZswNJSx3cOxYgiHcWD9F6iIahKn.y', 'King', 'Tester', 243, 4),
(14, 'test8@test', 'test8', '$2y$10$IBfHkTCFgHv6lzMlMq6djOydpGO.uceIjnfpggtNF3dNi3/f6znZ.', 'Mrs', 'testssss', 253, 4),
(15, 'test9@test', 'test9', '$2y$10$olhl8GyI7YjQ0hImVelLwONZg7VjINGrwyuR7NtIsqYh.9oQ7edPq', 'Mr', 'test9', 11, 4),
(16, 'test10@test', 'test10', '$2y$10$KkZaXiG.fs8ipRPB6sPMuuvQfKiGHaRUYilomJdwEwh7lmpFkd4Em', 'Mr', 'test10', 392, 4),
(17, 'test11@test', 'test11', '$2y$10$o3pkGuRztODluJYA6TQ7BeJEs06mtWkRtTZmrGvF6TBzBrbIwHd9a', 'Mr', 'Test 11', 77, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
