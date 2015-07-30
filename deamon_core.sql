-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2015 at 08:59 AM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deamon_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `D_Accounts`
--

CREATE TABLE IF NOT EXISTS `D_Accounts` (
  `UserId` int(11) NOT NULL,
  `PassPhrase` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Length` int(11) NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Accounts`
--

INSERT INTO `D_Accounts` (`UserId`, `PassPhrase`, `Length`, `Username`, `FirstName`, `LastName`, `DateOfBirth`, `Email`) VALUES
(5, 'a642ed884986e198286db36341aa4538', 9, 'deamon', 'Damon', 'Jones', '2015-05-02', 'dittopower@gmail.com'),
(6, '3d036780f6ec3f859e24c35515928874', 8, 'dittopower', 'Damon', 'Jones', '1994-12-02', 'dittopower@live.com.au'),
(7, '531e96c98d9ca8682154e067c2531817', 7, 'roflmonsterjh', 'Jesh', 'Henley', '1995-09-30', 'roflmonster.josh@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `D_Articles`
--

CREATE TABLE IF NOT EXISTS `D_Articles` (
  `art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mod_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Articles`
--

INSERT INTO `D_Articles` (`art_id`, `user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES
(1, 5, '2015-07-10 05:00:00', '2015-07-10 05:00:00', 'Testing|coding|', 'Newfeed Testing', 'Just testing the new feeds code.'),
(2, 5, '2015-07-10 11:30:24', '2015-07-10 11:36:52', 'Testing|coding|', 'Ordering', 'just testing ordering'),
(3, 5, '2015-07-11 06:06:57', '2015-07-11 06:06:57', 'coding|search|', 'Testing newfeed search', 'testing my newfeed search things'),
(4, 5, '2015-07-11 06:10:56', '2015-07-11 06:10:56', 'gaming|', 'Gamebase', 'Coming soonish, a game database with information on and ratings of various games.'),
(5, 5, '2015-07-14 03:50:09', '2015-07-14 03:50:09', 'tech|work', '...', 'So the Tech section will likely be the last section i make.'),
(6, 5, '2015-07-30 12:35:39', '2015-07-30 12:35:39', '|site/|/css/|/html', 'Site Appearance', 'So a new look for the site is on it''s way! A template has been created now to made it look reasonable...');

-- --------------------------------------------------------

--
-- Table structure for table `D_Media`
--

CREATE TABLE IF NOT EXISTS `D_Media` (
  `media_id` int(11) NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `share` smallint(6) NOT NULL,
  `people` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Media`
--

INSERT INTO `D_Media` (`media_id`, `location`, `owner`, `share`, `people`) VALUES
(1, 'files/me.jpg', 5, 3, '|6|'),
(8, 'test/css/frame.html', 5, 3, ''),
(7, '../media/5/photo.PNG', 5, 3, ''),
(6, 'files/6/Skelly_2.jpg', 6, 3, ''),
(9, 'test/css/local.css', 5, 3, ''),
(10, '../media/5/FreshPaint-0-2015.05.23-02.23.18.png', 5, 3, ''),
(11, '../media/5/morsecode.mp3', 5, 3, ''),
(12, '../media/5/me.jpg', 5, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `D_Perms`
--

CREATE TABLE IF NOT EXISTS `D_Perms` (
  `Perm_No` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `what` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `other` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Perms`
--

INSERT INTO `D_Perms` (`Perm_No`, `UserId`, `what`, `level`, `other`) VALUES
(1, 5, 'edit', 1, '.*'),
(2, 5, 'debug', 1, ''),
(3, 5, 'post', 2, '.*'),
(4, 6, 'edit', 1, '/test/css'),
(5, 7, 'edit', 1, '/test/css');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `D_Accounts`
--
ALTER TABLE `D_Accounts`
  ADD PRIMARY KEY (`UserId`), ADD UNIQUE KEY `usernames` (`Username`), ADD KEY `Username` (`Username`);

--
-- Indexes for table `D_Articles`
--
ALTER TABLE `D_Articles`
  ADD PRIMARY KEY (`art_id`), ADD UNIQUE KEY `art_id` (`art_id`);

--
-- Indexes for table `D_Media`
--
ALTER TABLE `D_Media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `D_Perms`
--
ALTER TABLE `D_Perms`
  ADD PRIMARY KEY (`Perm_No`), ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `D_Accounts`
--
ALTER TABLE `D_Accounts`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `D_Articles`
--
ALTER TABLE `D_Articles`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `D_Media`
--
ALTER TABLE `D_Media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `D_Perms`
--
ALTER TABLE `D_Perms`
  MODIFY `Perm_No` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
