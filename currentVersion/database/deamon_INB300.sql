-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2015 at 07:12 AM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deamon_INB300`
--

-- --------------------------------------------------------

--
-- Table structure for table `Forms`
--

CREATE TABLE IF NOT EXISTS `Forms` (
  `Form_Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Creator` int(11) NOT NULL,
  `Target` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Forms`
--

INSERT INTO `Forms` (`Form_Id`, `Name`, `Creator`, `Target`) VALUES
(1, 'Graduate Group Activity', 5, 'applicants');

-- --------------------------------------------------------

--
-- Table structure for table `Form_1`
--

CREATE TABLE IF NOT EXISTS `Form_1` (
  `Id` int(11) NOT NULL,
  `question` int(11) DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answers` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Form_1`
--

INSERT INTO `Form_1` (`Id`, `question`, `type`, `text`, `answers`) VALUES
(1, NULL, 'text', 'Candidate Name', NULL),
(2, NULL, 'text', 'Leader Name', NULL),
(3, NULL, 'instr', NULL, 'Observe the candidate;Take notes in relation to significant observations and comments.  Also, tally the number of contributions that the candidate makes to the discussion. A contribution tends to be 5 words or more;Evaluate and rate the candidate''s level of competency based on the behaviours and strength of evidence observed. Note feedback that can be provided to the candidate'),
(4, NULL, 'number', 'Contribution tally', '0'),
(13, NULL, 'textarea', 'Comments/feedback:', NULL),
(7, NULL, 'heading', 'Competencies: Relentless Execution/Simplicity & Agility', 'Knows and clarifies what is expected<br>Takes accountability for delivering results<br>Understands and helps identify risks and issues<br>Looks for ways to do things more effectively<br>Raises and solves problems.'),
(8, NULL, 'checkbox', 'Tick (if observed)', NULL),
(9, NULL, 'slider', 'How well did the candidate perform this competency', '1;5;0.5;Much less than acceptable;Less than acceptable;Acceptable;More than acceptable;Much more than acceptable.'),
(10, NULL, 'heading', 'Competencies: Building great teams/Clarity of Purpose', 'Contributes and shares ideas and values views from others<br>Encourages others to participate<br>Appropriately challenges others viewpoints<br>Works effectively in the team<br>Understands Group priorities<br>Demonstrates a sense of purpose in everything we do'),
(11, NULL, 'checkbox', 'Tick (if observed)', NULL),
(12, NULL, 'radio', 'How well did the candidate perform this competency.', 'Much less than acceptable;Less than acceptable;Acceptable;More than acceptable;Much more than acceptable.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Forms`
--
ALTER TABLE `Forms`
  ADD PRIMARY KEY (`Form_Id`);

--
-- Indexes for table `Form_1`
--
ALTER TABLE `Form_1`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Forms`
--
ALTER TABLE `Forms`
  MODIFY `Form_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Form_1`
--
ALTER TABLE `Form_1`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
