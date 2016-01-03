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
  `salt` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Accounts`
--

INSERT INTO `D_Accounts` (`UserId`, `PassPhrase`, `Length`, `salt`, `Username`, `FirstName`, `LastName`, `DateOfBirth`, `Email`) VALUES
(6, '3d036780f6ec3f859e24c35515928874', 8, '', 'dittopower', 'Damon', 'Jones', '1994-12-02', 'dittopower@live.com.au'),
(8, '2a29b01a7156471dbd66a345bde0983b', 11, 'sÌå™è\Z‰—5‹œi²4!jùÊM|3''Ù’P]Oý³k™Ö˜ó™Ù¦ù0)çˆ´ì©…K‚}ÊE3ÓÆ', 'test', 'Meee', 'Test', '2015-08-20', 'admin@deamon.info'),
(5, '7f7ac595eb3759901987a55130f0d099', 8, '§¢F)†®¢“7”Tb¿Tóñ^§pðƒo¥ørí¹z1Âë‹¬‚š‘1®I‹òô©9‘Pš¤•‚ æ=aäYÉ', 'deamon', 'Damon', 'Jones', '1994-12-02', 'dittopower@gmail.com'),
(11, '53b8163129b624b1e6cb9e3294422bdb', 8, 'E4h€b€|2é¡÷¶t2þï4tBÆ#´£ÿò¾`UA/tGš]JY*ŒzšoÜ4ÛüÉ¢ó½!£ßùWü5Š', 'roflmonsterjh', 'Jesh', 'Henley', '1995-09-30', 'roflmonster.jh@gmail.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Articles`
--

INSERT INTO `D_Articles` (`art_id`, `user_id`, `post_date`, `mod_date`, `tags`, `title`, `contents`) VALUES
(1, 5, '2015-07-10 05:00:00', '2015-07-10 05:00:00', 'Testing|coding|', 'Newfeed Testing', 'Just testing the new feeds code.'),
(2, 5, '2015-07-10 11:30:24', '2015-07-10 11:36:52', 'Testing|coding|', 'Ordering', 'just testing ordering'),
(3, 5, '2015-07-11 06:06:57', '2015-07-11 06:06:57', 'coding|search|', 'Testing newfeed search', 'testing my newfeed search things'),
(4, 5, '2015-07-11 06:10:56', '2015-07-11 06:10:56', 'gaming|', 'Gamebase', 'Coming soonish, a game database with information on and ratings of various games.'),
(5, 5, '2015-07-14 03:50:09', '2015-07-14 03:50:09', 'tech|work', '...', 'So the Tech section will likely be the last section i make.'),
(6, 5, '2015-07-30 12:35:39', '2015-07-30 12:35:39', 'site|css|html|', 'Site Appearance', 'So a new look for the site is on it''s way! A template has been created now to made it look reasonable...'),
(7, 5, '2015-07-31 09:50:19', '2015-07-31 09:50:19', 'tech|hdd|', 'HDD Failure Rates', 'There''s a nice article over on <a target=''_blank'' href=''https://www.backblaze.com/blog/hard-drive-reliability-update-september-2014/''>BackBlaze</a> about hard drive failure rates in their data centres. Definitely worth some consideration next time your getting a new HDD.'),
(13, 5, '2015-08-27 01:35:12', '2015-08-27 01:35:12', '|coding|lib|', 'Library access unification', 'So my backend access is now alot more automated :D'),
(9, 5, '2015-08-07 13:19:49', '2015-08-07 13:19:49', 'coding|tags|bugs|', 'bug fix - tag', 'posts will no longer have extra slashes added in their tags.'),
(12, 5, '2015-08-08 14:50:21', '2015-08-08 14:50:21', 'coding|css|', 'Customise', 'You can now use your own custom css on my site! Either upload a ''custom.css'' file to your directory or visit my <a href=''/me/customise''>customiser</a> .'),
(11, 5, '2015-08-07 14:37:45', '2015-08-07 14:37:45', 'coding|RegEx|', 'RegEx', 'RegEx is one of the best tools available to anyone dealing with user input. It''s natively supported in most languages and very dynamic. A great tool to help test your regex is <a href=''http://www.phpliveregex.com/''>http://www.phpliveregex.com/</a>'),
(14, 5, '2015-10-15 16:55:23', '2015-10-15 16:55:23', 'University|Free time|Website', 'Almost Done', 'So I''m almost finished my university course which is awesome! Soon i''ll have free time again and can finish making this site and to start a couple of other personal project like a couple of html/js games, maybe make a mobile app for this site maybe a webapp with a service worker.');

-- --------------------------------------------------------

--
-- Table structure for table `D_Games`
--

CREATE TABLE IF NOT EXISTS `D_Games` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `release date` date NOT NULL,
  `series` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publisher` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `developer` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modes` tinyint(4) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `steam` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `origin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gog` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Games`
--

INSERT INTO `D_Games` (`id`, `name`, `release date`, `series`, `publisher`, `developer`, `genre`, `modes`, `description`, `steam`, `origin`, `gog`) VALUES
(1, 'Skyrim', '2011-11-10', 'The Elder Scrolls', 'Bethesda', 'Bethesda', 'Open World, RPG', 0, 'EPIC FANTASY REBORN \r\nThe next chapter in the highly anticipated Elder Scrolls saga arrives from the makers of the 2006 and 2008 Games of the Year, Bethesda Game Studios. Skyrim reimagines and revolutionizes the open-world fantasy epic, bringing to life a complete virtual world open for you to explore any way you choose. \r\n\r\nLIVE ANOTHER LIFE, IN ANOTHER WORLD \r\nPlay any type of character you can imagine, and do whatever you want; the legendary freedom of choice, storytelling, and adventure of The Elder Scrolls is realized like never before. \r\n\r\nALL NEW GRAPHICS AND GAMEPLAY ENGINE \r\nSkyrim’s new game engine brings to life a complete virtual world with rolling clouds, rugged mountains, bustling cities, lush fields, and ancient dungeons. \r\n\r\nYOU ARE WHAT YOU PLAY \r\nChoose from hundreds of weapons, spells, and abilities. The new character system allows you to play any way you want and define yourself through your actions. \r\n\r\nDRAGON RETURN \r\nBattle ancient dragons like you’ve never seen. As Dragonborn, learn their secrets and harness their power for yourself.', '72850', NULL, NULL),
(3, 'Killing Floor', '2009-05-14', '', 'Tripwire Interactive', 'Tripwire Interactive', 'Action, Hoard', 1, 'Killing Floor is a Co-op Survival Horror FPS set in the devastated cities and countryside of England after a series of cloning experiments for the military goes horribly wrong. You and your friends are members of the military dropped into these locations with a simple mission: Survive long enough to cleanse the area of the failed experiments! \r\nCooperative gameplay for up to six players against multiple waves of specimens \r\nPersistent Perks system, allowing players to convert their in-game achievements into permanent improvements to their character''s skills and abilities \r\nOver 170 Steam Achievements, including “Dignity for the dead” for killing 10 enemies feeding on dead teammates'' corpses and “Hot Cross Fun” for finishing off 25 burning enemies with a Crossbow \r\nSlow-motion “ZEDtime” to better watch those crucial and violent creature deaths, even in multiplayer \r\nSolo game mode for offline play \r\nTen different monster types trying to eat your face off, armed with everything from teeth and claws, to chainsaws, chain-guns and rocket-launchers \r\n33+ weapons for the players to chose from, ranging from knives and fire-axes to pump shotguns, rifles and a flamethrower \r\nEquip your team with welders, medical tools and body armor to help your odds of survival \r\nChoose which Perks to play with to best balance out your co-op team against the horrors \r\nOpen, non-linear play areas: choose when and where to fight — or run; weld doors closed to direct the monster horde down alternate corridors \r\nFully-configurable, allowing players to change the difficulty level, number of creature waves, or even set up their own favorite waves of monsters \r\nSupport for Steam Friends and other Steamworks features \r\nIncludes Windows-only SDK for the creation of new levels and mods ', '1250', '', ''),
(4, 'Terraria', '2011-05-17', '', 'Re-Logic', 'Re-Logic', 'Side Scroller, Wiki, Adventure, Crafting', 10, 'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory. Will you delve deep into cavernous expanses in search of treasure and raw materials with which to craft ever-evolving gear, machinery, and aesthetics? Perhaps you will choose instead to seek out ever-greater foes to test your mettle in combat? Maybe you will decide to construct your own city to house the host of mysterious allies you may encounter along your travels? \r\n\r\nIn the World of Terraria, the choice is yours! \r\n\r\nBlending elements of classic action games with the freedom of sandbox-style creativity, Terraria is a unique gaming experience where both the journey and the destination are completely in the player’s control. The Terraria adventure is truly as unique as the players themselves! \r\n\r\nAre you up for the monumental task of exploring, creating, and defending a world of your own? \r\n\r\nKey features: \r\nSandbox Play \r\nRandomly generated worlds \r\nFree Content Updates ', '105600', '', ''),
(5, 'Warhammer 40,000: Space Marine', '2011-09-08', '', 'SEGA', 'Relic', 'Action, Brawler', 10, 'In Warhammer® 40,000® Space Marine® you are Captain Titus, a Space Marine of the Ultramarines chapter and a seasoned veteran of countless battles. \r\nA millions-strong Ork horde has invaded an Imperial Forge World, one of the planet-sized factories where the war machines for humanity’s never ending battle for survival are created. Losing this planet is not an option and be aware of the far more evil threat lurking large in the shadows of this world. \r\n\r\nDEVASTATING WEAPONRY \r\nExperience 40,000 years of combat, evolved. Enhance your vast arsenal as you unlock new weapons, upgrades, armor & abilities through an accessible progression system. This devastating weaponry empowers players to deliver bone crushing violence and dismemberment to their enemies. \r\n\r\nBLOCKBUSTER ENTERTAINMENT \r\nWith an Imperial liberation fleet en-route, the Ultramarines are sent in to hold key locations until reinforcements arrive. Captain Titus and a squad of Ultramarine veterans use the bolter and chainsword to take the fight to the enemies of mankind. \r\n\r\nBRUTAL 8VS8 ONLINE COMBAT \r\nForm your own Space Marine squad or Chaos Space Marine warband and face off in 8 vs 8 online matches. Gain experience and unlock new weapons and armor to customize the Devastator, Assault, and Tactical Marine classes.', '55150', '', ''),
(6, 'Hearthstone: Heroes of Warcraft', '2014-03-11', 'Warcraft', 'Blizzard Entertainment', 'Blizzard Entertainment', 'Card Game', 2, 'DECEPTIVELY SIMPLE. INSANELY FUN.\r\nPick up your cards and throw down the gauntlet! In Hearthstone, you play the hero in a fast-paced, whimsical card game of cunning strategy. In minutes, you’ll be unleashing powerful cards to sling spells, summon minions, and seize control of an ever-shifting battlefield. Whether it’s your first card game or you’re an experienced pro, the depth and charm of Hearthstone will draw you in.\r\n\r\nJUMP RIGHT IN: Fun introductory missions bring you into the world of Hearthstone’s intuitive gameplay.\r\n\r\nBUILD YOUR DECK: With hundreds of additional cards to win and craft - your collection grows with you.\r\n\r\nHONE YOUR SKILLS: Play in practice matches against computer-controlled heroes of the Warcraft universe. Thrall, Uther, Gul’dan - they’re all here!\r\n\r\nCOLLECTION TRAVELS WITH YOU: Your card collection is linked to your Battle.net account - enabling you to switch your play between tablet and desktop with ease. \r\n\r\nAND FIGHT FOR GLORY: When you’re ready, step into the Arena and duel other players for the chance to win awesome prizes!', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `D_Games_Review`
--

CREATE TABLE IF NOT EXISTS `D_Games_Review` (
  `id` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `version` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `difficulty` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `performance rating` tinyint(4) NOT NULL,
  `internet rating` tinyint(4) NOT NULL,
  `responsiveness rating` tinyint(4) NOT NULL,
  `graphics style` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `graphics rating` tinyint(4) NOT NULL,
  `gameplay rating` tinyint(4) NOT NULL,
  `overall rating` tinyint(4) NOT NULL,
  `opinion` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Games_Review`
--

INSERT INTO `D_Games_Review` (`id`, `game`, `user`, `version`, `difficulty`, `performance rating`, `internet rating`, `responsiveness rating`, `graphics style`, `graphics rating`, `gameplay rating`, `overall rating`, `opinion`) VALUES
(1, 1, 5, '1.9.32.0.8', 'Average', 75, -1, 85, '3D Fantasy', 78, 85, 90, 'It is an Elder Scrolls game through and through. They have made some nice advancements on the combat system with dual wielding and first person spell casting. However the game''s magic system has suffered as custom spell crafting a strong feature of the previous game has been removed.\r\n\r\nThe game features a large world you a free to explore. There are lot''s of little details, encounters and mini-stories hidden all over the country.\r\n\r\nThe main story isn''t very interest though the main guild side quest are better. That said compared to the previous game''s quests the story lines are for some less compelling.'),
(3, 3, 5, '1064', 'Hard', 90, 90, 95, 'Gritty 3D', 70, 100, 90, 'This is one of the best "zombie" hoard mode games available (I know they''re not technical zombies). The bullet times are done excellently, the guns handle well which makes slaughtering the hoard so enjoyable.'),
(4, 4, 5, '1.3.0.8', 'Average', 80, 90, 85, '2D, Block Based', 70, 90, 85, 'A nice game with good progression that involves combat, exploration and resource gathering. The game has some interesting boss fights and various play styles that allows for greater replayability and group play.'),
(5, 5, 5, '', 'Above Average', 90, 80, 75, '3D, 3rd Person', 80, 90, 85, 'A great 3rd person action game that makes slaying hoards of orcs loads of fun.'),
(6, 6, 5, '4.0.0.10833', 'Average', 95, 95, 90, 'Cards, 3 & 1/2 D', 100, 75, 90, 'It''s a good card game, definitely less complicated than Magic the Gathering or Yu-gi-oh. This both makes it simple and easy to enjoy while lacking control and missing the ability to respond or counter your opponent''s moves in a variety of ways.\r\n\r\nOverall, it''s a good game but there''s definitely room for improvement.');

-- --------------------------------------------------------

--
-- Table structure for table `D_Media`
--

CREATE TABLE IF NOT EXISTS `D_Media` (
  `media_id` int(11) NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `share` smallint(6) NOT NULL,
  `people` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Media`
--

INSERT INTO `D_Media` (`media_id`, `location`, `owner`, `share`, `people`) VALUES
(8, 'test/css/frame.html', 5, 3, ''),
(7, '../media/5/photo.PNG', 5, 3, ''),
(9, 'test/css/local.css', 5, 3, ''),
(25, '../media/5/this_is_why_qut_cant_have_nice_things.png', 5, 3, ''),
(11, '../media/5/morsecode.mp3', 5, 3, ''),
(1, '../media/5/me.jpg', 5, 3, ''),
(26, '../media/6/page.php', 6, 3, ''),
(35, '../media/5/superbuswalk.png', 5, 3, ''),
(34, '../media/5/uAx8Z2p.png', 5, 3, ''),
(37, '../media/5/Josh.wav', 5, 3, ''),
(39, '../media/5/Games.ico', 5, 0, ''),
(40, '../media/5/Tconnect v0.2.apk', 5, 3, ''),
(41, '../media/5/Screenshot_2015-09-22-10-30-58.png', 5, 3, ''),
(42, '../media/5/git.png', 5, 3, ''),
(43, '../media/5/Hearthstone Screenshot 10-24-15 01.13.36.png', 5, 3, '');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `D_Perms`
--

INSERT INTO `D_Perms` (`Perm_No`, `UserId`, `what`, `level`, `other`) VALUES
(1, 5, 'edit', 1, '.*'),
(2, 5, 'debug', 1, ''),
(3, 5, 'post', 2, '.*'),
(5, 11, 'access', 2, '.*'),
(6, 5, 'admin', 1, ''),
(7, 5, 'access', 2, '.*'),
(8, 5, 'mc', 1, ''),
(9, 5, 'review', 1, 'game');

-- --------------------------------------------------------

--
-- Table structure for table `MC_objects`
--

CREATE TABLE IF NOT EXISTS `MC_objects` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `MC_objects`
--

INSERT INTO `MC_objects` (`id`, `Name`, `image`) VALUES
('0', 'Air', 'icon items-21-0-0'),
('1', 'Stone', 'icon items-21-1-0'),
('1:01', 'Granite', 'icon items-21-1-1'),
('1:02', 'Polished Granite', 'icon items-21-1-2'),
('1:03', 'Diorite', 'icon items-21-1-3'),
('1:04', 'Polished Diorite', 'icon items-21-1-4'),
('1:05', 'Andesite', 'icon items-21-1-5'),
('1:06', 'Polished Andesite', 'icon items-21-1-6'),
('2', 'Grass', 'icon items-21-2-0'),
('3', 'Dirt', 'icon items-21-3-0'),
('3:01', 'Coarse Dirt', 'icon items-21-3-1'),
('3:02', 'Podzol', 'icon items-21-3-2'),
('4', 'Cobblestone', 'icon items-21-4-0'),
('5', 'Oak Wood Plank', 'icon items-21-5-0'),
('5:01', 'Spruce Wood Plank', 'icon items-21-5-1'),
('5:02', 'Birch Wood Plank', 'icon items-21-5-2'),
('5:03', 'Jungle Wood Plank', 'icon items-21-5-3'),
('5:04', 'Acacia Wood Plank', 'icon items-21-5-4'),
('5:05', 'Dark Oak Wood Plank', 'icon items-21-5-5'),
('6', 'Oak Sapling', 'icon items-21-6-0'),
('6:01', 'Spruce Sapling', 'icon items-21-6-1'),
('6:02', 'Birch Sapling', 'icon items-21-6-2'),
('6:03', 'Jungle Sapling', 'icon items-21-6-3'),
('6:04', 'Acacia Sapling', 'icon items-21-6-4'),
('6:05', 'Dark Oak Sapling', 'icon items-21-6-5'),
('7', 'Bedrock', 'icon items-21-7-0'),
('8', 'Flowing Water', 'icon items-21-8-0'),
('9', 'Still Water', 'icon items-21-9-0'),
('10', 'Flowing Lava', 'icon items-21-10-0'),
('11', 'Still Lava', 'icon items-21-11-0'),
('12', 'Sand', 'icon items-21-12-0'),
('12:01', 'Red Sand', 'icon items-21-12-1'),
('13', 'Gravel', 'icon items-21-13-0'),
('14', 'Gold Ore', 'icon items-21-14-0'),
('15', 'Iron Ore', 'icon items-21-15-0'),
('16', 'Coal Ore', 'icon items-21-16-0'),
('17', 'Oak Wood', 'icon items-21-17-0'),
('17:01', 'Spruce Wood', 'icon items-21-17-1'),
('17:02', 'Birch Wood', 'icon items-21-17-2'),
('17:03', 'Jungle Wood', 'icon items-21-17-3'),
('18', 'Oak Leaves', 'icon items-21-18-0'),
('18:01', 'Spruce Leaves', 'icon items-21-18-1'),
('18:02', 'Birch Leaves', 'icon items-21-18-2'),
('18:03', 'Jungle Leaves', 'icon items-21-18-3'),
('19', 'Sponge', 'icon items-21-19-0'),
('19:01', 'Wet Sponge', 'icon items-21-19-1'),
('20', 'Glass', 'icon items-21-20-0'),
('21', 'Lapis Lazuli Ore', 'icon items-21-21-0'),
('22', 'Lapis Lazuli Block', 'icon items-21-22-0'),
('23', 'Dispenser', 'icon items-21-23-0'),
('24', 'Sandstone', 'icon items-21-24-0'),
('24:01:00', 'Chiseled Sandstone', 'icon items-21-24-1'),
('24:02:00', 'Smooth Sandstone', 'icon items-21-24-2'),
('25', 'Note Block', 'icon items-21-25-0'),
('26', 'Bed', 'icon items-21-26-0'),
('27', 'Powered Rail', 'icon items-21-27-0'),
('28', 'Detector Rail', 'icon items-21-28-0'),
('29', 'Sticky Piston', 'icon items-21-29-0'),
('30', 'Cobweb', 'icon items-21-30-0'),
('31', 'Dead Shrub', 'icon items-21-31-0'),
('31:01:00', 'Grass', 'icon items-21-31-1'),
('31:02:00', 'Fern', 'icon items-21-31-2'),
('32', 'Dead Bush', 'icon items-21-32-0'),
('33', 'Piston', 'icon items-21-33-0'),
('34', 'Piston Head', 'icon items-21-34-0'),
('35', 'White Wool', 'icon items-21-35-0'),
('35:01:00', 'Orange Wool', 'icon items-21-35-1'),
('35:02:00', 'Magenta Wool', 'icon items-21-35-2'),
('35:03:00', 'Light Blue Wool', 'icon items-21-35-3'),
('35:04:00', 'Yellow Wool', 'icon items-21-35-4'),
('35:05:00', 'Lime Wool', 'icon items-21-35-5'),
('35:06:00', 'Pink Wool', 'icon items-21-35-6'),
('35:07:00', 'Gray Wool', 'icon items-21-35-7'),
('35:08:00', 'Light Gray Wool', 'icon items-21-35-8'),
('35:09:00', 'Cyan Wool', 'icon items-21-35-9'),
('35:10:00', 'Purple Wool', 'icon items-21-35-10'),
('35:11:00', 'Blue Wool', 'icon items-21-35-11'),
('35:12:00', 'Brown Wool', 'icon items-21-35-12'),
('35:13:00', 'Green Wool', 'icon items-21-35-13'),
('35:14:00', 'Red Wool', 'icon items-21-35-14'),
('35:15:00', 'Black Wool', 'icon items-21-35-15'),
('37', 'Dandelion', 'icon items-21-37-0'),
('38', 'Poppy', 'icon items-21-38-0'),
('38:01:00', 'Blue Orchid', 'icon items-21-38-1'),
('38:02:00', 'Allium', 'icon items-21-38-2'),
('38:03:00', 'Azure Bluet', 'icon items-21-38-3'),
('38:04:00', 'Red Tulip', 'icon items-21-38-4'),
('38:05:00', 'Orange Tulip', 'icon items-21-38-5'),
('38:06:00', 'White Tulip', 'icon items-21-38-6'),
('38:07:00', 'Pink Tulip', 'icon items-21-38-7'),
('38:08:00', 'Oxeye Daisy', 'icon items-21-38-8'),
('39', 'Brown Mushroom', 'icon items-21-39-0'),
('40', 'Red Mushroom', 'icon items-21-40-0'),
('41', 'Gold Block', 'icon items-21-41-0'),
('42', 'Iron Block', 'icon items-21-42-0'),
('43', 'Double Stone Slab', 'icon items-21-43-0'),
('43:01:00', 'Double Sandstone Sla', 'icon items-21-43-1'),
('43:02:00', 'Double Wooden Slab', 'icon items-21-43-2'),
('43:03:00', 'Double Cobblestone S', 'icon items-21-43-3'),
('43:04:00', 'Double Brick Slab', 'icon items-21-43-4'),
('43:05:00', 'Double Stone Brick S', 'icon items-21-43-5'),
('43:06:00', 'Double Nether Brick ', 'icon items-21-43-6'),
('43:07:00', 'Double Quartz Slab', 'icon items-21-43-7'),
('44', 'Stone Slab', 'icon items-21-44-0'),
('44:01:00', 'Sandstone Slab', 'icon items-21-44-1'),
('44:02:00', 'Wooden Slab', 'icon items-21-44-2'),
('44:03:00', 'Cobblestone Slab', 'icon items-21-44-3'),
('44:04:00', 'Brick Slab', 'icon items-21-44-4'),
('44:05:00', 'Stone Brick Slab', 'icon items-21-44-5'),
('44:06:00', 'Nether Brick Slab', 'icon items-21-44-6'),
('44:07:00', 'Quartz Slab', 'icon items-21-44-7'),
('45', 'Bricks', 'icon items-21-45-0'),
('46', 'TNT', 'icon items-21-46-0'),
('47', 'Bookshelf', 'icon items-21-47-0'),
('48', 'Moss Stone', 'icon items-21-48-0'),
('49', 'Obsidian', 'icon items-21-49-0'),
('50', 'Torch', 'icon items-21-50-0'),
('51', 'Fire', 'icon items-21-51-0'),
('52', 'Monster Spawner', 'icon items-21-52-0'),
('53', 'Oak Wood Stairs', 'icon items-21-53-0'),
('54', 'Chest', 'icon items-21-54-0'),
('55', 'Redstone Wire', 'icon items-21-55-0'),
('56', 'Diamond Ore', 'icon items-21-56-0'),
('57', 'Diamond Block', 'icon items-21-57-0'),
('58', 'Crafting Table', 'icon items-21-58-0'),
('59', 'Wheat Crops', 'icon items-21-59-0'),
('60', 'Farmland', 'icon items-21-60-0'),
('61', 'Furnace', 'icon items-21-61-0'),
('62', 'Burning Furnace', 'icon items-21-62-0'),
('63', 'Standing Sign Block', 'icon items-21-63-0'),
('64', 'Oak Door Block', 'icon items-21-64-0'),
('65', 'Ladder', 'icon items-21-65-0'),
('66', 'Rail', 'icon items-21-66-0'),
('67', 'Cobblestone Stairs', 'icon items-21-67-0'),
('68', 'Wall-mounted Sign Bl', 'icon items-21-68-0'),
('69', 'Lever', 'icon items-21-69-0'),
('70', 'Stone Pressure Plate', 'icon items-21-70-0'),
('71', 'Iron Door Block', 'icon items-21-71-0'),
('72', 'Wooden Pressure Plat', 'icon items-21-72-0'),
('73', 'Redstone Ore', 'icon items-21-73-0'),
('74', 'Glowing Redstone Ore', 'icon items-21-74-0'),
('75', 'Redstone Torch (off)', 'icon items-21-75-0'),
('76', 'Redstone Torch (on)', 'icon items-21-76-0'),
('77', 'Stone Button', 'icon items-21-77-0'),
('78', 'Snow', 'icon items-21-78-0'),
('79', 'Ice', 'icon items-21-79-0'),
('80', 'Snow Block', 'icon items-21-80-0'),
('81', 'Cactus', 'icon items-21-81-0'),
('82', 'Clay', 'icon items-21-82-0'),
('83', 'Sugar Canes', 'icon items-21-83-0'),
('84', 'Jukebox', 'icon items-21-84-0'),
('85', 'Oak Fence', 'icon items-21-85-0'),
('86', 'Pumpkin', 'icon items-21-86-0'),
('87', 'Netherrack', 'icon items-21-87-0'),
('88', 'Soul Sand', 'icon items-21-88-0'),
('89', 'Glowstone', 'icon items-21-89-0'),
('90', 'Nether Portal', 'icon items-21-90-0'),
('91', 'Jack o''Lantern', 'icon items-21-91-0'),
('92', 'Cake Block', 'icon items-21-92-0'),
('93', 'Redstone Repeater Bl', 'icon items-21-93-0'),
('94', 'Redstone Repeater Bl', 'icon items-21-94-0'),
('95', 'White Stained Glass', 'icon items-21-95-0'),
('95:01:00', 'Orange Stained Glass', 'icon items-21-95-1'),
('95:02:00', 'Magenta Stained Glas', 'icon items-21-95-2'),
('95:03:00', 'Light Blue Stained G', 'icon items-21-95-3'),
('95:04:00', 'Yellow Stained Glass', 'icon items-21-95-4'),
('95:05:00', 'Lime Stained Glass', 'icon items-21-95-5'),
('95:06:00', 'Pink Stained Glass', 'icon items-21-95-6'),
('95:07:00', 'Gray Stained Glass', 'icon items-21-95-7'),
('95:08:00', 'Light Gray Stained G', 'icon items-21-95-8'),
('95:09:00', 'Cyan Stained Glass', 'icon items-21-95-9'),
('95:10:00', 'Purple Stained Glass', 'icon items-21-95-10'),
('95:11:00', 'Blue Stained Glass', 'icon items-21-95-11'),
('95:12:00', 'Brown Stained Glass', 'icon items-21-95-12'),
('95:13:00', 'Green Stained Glass', 'icon items-21-95-13'),
('95:14:00', 'Red Stained Glass', 'icon items-21-95-14'),
('95:15:00', 'Black Stained Glass', 'icon items-21-95-15'),
('96', 'Wooden Trapdoor', 'icon items-21-96-0'),
('97', 'Stone Monster Egg', 'icon items-21-97-0'),
('97:01:00', 'Cobblestone Monster ', 'icon items-21-97-1'),
('97:02:00', 'Stone Brick Monster ', 'icon items-21-97-2'),
('97:03:00', 'Mossy Stone Brick Mo', 'icon items-21-97-3'),
('97:04:00', 'Cracked Stone Brick ', 'icon items-21-97-4'),
('97:05:00', 'Chiseled Stone Brick', 'icon items-21-97-5'),
('98', 'Stone Bricks', 'icon items-21-98-0'),
('98:01:00', 'Mossy Stone Bricks', 'icon items-21-98-1'),
('98:02:00', 'Cracked Stone Bricks', 'icon items-21-98-2'),
('98:03:00', 'Chiseled Stone Brick', 'icon items-21-98-3'),
('99', 'Brown Mushroom Block', 'icon items-21-99-0'),
('100', 'Red Mushroom Block', 'icon items-21-100-0'),
('101', 'Iron Bars', 'icon items-21-101-0'),
('102', 'Glass Pane', 'icon items-21-102-0'),
('103', 'Melon Block', 'icon items-21-103-0'),
('104', 'Pumpkin Stem', 'icon items-21-104-0'),
('105', 'Melon Stem', 'icon items-21-105-0'),
('106', 'Vines', 'icon items-21-106-0'),
('107', 'Oak Fence Gate', 'icon items-21-107-0'),
('108', 'Brick Stairs', 'icon items-21-108-0'),
('109', 'Stone Brick Stairs', 'icon items-21-109-0'),
('110', 'Mycelium', 'icon items-21-110-0'),
('111', 'Lily Pad', 'icon items-21-111-0'),
('112', 'Nether Brick', 'icon items-21-112-0'),
('113', 'Nether Brick Fence', 'icon items-21-113-0'),
('114', 'Nether Brick Stairs', 'icon items-21-114-0'),
('115', 'Nether Wart', 'icon items-21-115-0'),
('116', 'Enchantment Table', 'icon items-21-116-0'),
('117', 'Brewing Stand', 'icon items-21-117-0'),
('118', 'Cauldron', 'icon items-21-118-0'),
('119', 'End Portal', 'icon items-21-119-0'),
('120', 'End Portal Frame', 'icon items-21-120-0'),
('121', 'End Stone', 'icon items-21-121-0'),
('122', 'Dragon Egg', 'icon items-21-122-0'),
('123', 'Redstone Lamp (inact', 'icon items-21-123-0'),
('124', 'Redstone Lamp (activ', 'icon items-21-124-0'),
('125', 'Double Oak Wood Slab', 'icon items-21-125-0'),
('125:01:00', 'Double Spruce Wood S', 'icon items-21-125-1'),
('125:02:00', 'Double Birch Wood Sl', 'icon items-21-125-2'),
('125:03:00', 'Double Jungle Wood S', 'icon items-21-125-3'),
('125:04:00', 'Double Acacia Wood S', 'icon items-21-125-4'),
('125:05:00', 'Double Dark Oak Wood', 'icon items-21-125-5'),
('126', 'Oak Wood Slab', 'icon items-21-126-0'),
('126:01:00', 'Spruce Wood Slab', 'icon items-21-126-1'),
('126:02:00', 'Birch Wood Slab', 'icon items-21-126-2'),
('126:03:00', 'Jungle Wood Slab', 'icon items-21-126-3'),
('126:04:00', 'Acacia Wood Slab', 'icon items-21-126-4'),
('126:05:00', 'Dark Oak Wood Slab', 'icon items-21-126-5'),
('127', 'Cocoa', 'icon items-21-127-0'),
('128', 'Sandstone Stairs', 'icon items-21-128-0'),
('129', 'Emerald Ore', 'icon items-21-129-0'),
('130', 'Ender Chest', 'icon items-21-130-0'),
('131', 'Tripwire Hook', 'icon items-21-131-0'),
('132', 'Tripwire', 'icon items-21-132-0'),
('133', 'Emerald Block', 'icon items-21-133-0'),
('134', 'Spruce Wood Stairs', 'icon items-21-134-0'),
('135', 'Birch Wood Stairs', 'icon items-21-135-0'),
('136', 'Jungle Wood Stairs', 'icon items-21-136-0'),
('137', 'Command Block', 'icon items-21-137-0'),
('138', 'Beacon', 'icon items-21-138-0'),
('139', 'Cobblestone Wall', 'icon items-21-139-0'),
('139:01:00', 'Mossy Cobblestone Wa', 'icon items-21-139-1'),
('140', 'Flower Pot', 'icon items-21-140-0'),
('141', 'Carrots', 'icon items-21-141-0'),
('142', 'Potatoes', 'icon items-21-142-0'),
('143', 'Wooden Button', 'icon items-21-143-0'),
('144', 'Mob Head', 'icon items-21-144-0'),
('145', 'Anvil', 'icon items-21-145-0'),
('146', 'Trapped Chest', 'icon items-21-146-0'),
('147', 'Weighted Pressure Pl', 'icon items-21-147-0'),
('148', 'Weighted Pressure Pl', 'icon items-21-148-0'),
('149', 'Redstone Comparator ', 'icon items-21-149-0'),
('150', 'Redstone Comparator ', 'icon items-21-150-0'),
('151', 'Daylight Sensor', 'icon items-21-151-0'),
('152', 'Redstone Block', 'icon items-21-152-0'),
('153', 'Nether Quartz Ore', 'icon items-21-153-0'),
('154', 'Hopper', 'icon items-21-154-0'),
('155', 'Quartz Block', 'icon items-21-155-0'),
('155:01:00', 'Chiseled Quartz Bloc', 'icon items-21-155-1'),
('155:02:00', 'Pillar Quartz Block', 'icon items-21-155-2'),
('156', 'Quartz Stairs', 'icon items-21-156-0'),
('157', 'Activator Rail', 'icon items-21-157-0'),
('158', 'Dropper', 'icon items-21-158-0'),
('159', 'White Stained Clay', 'icon items-21-159-0'),
('159:01:00', 'Orange Stained Clay', 'icon items-21-159-1'),
('159:02:00', 'Magenta Stained Clay', 'icon items-21-159-2'),
('159:03:00', 'Light Blue Stained C', 'icon items-21-159-3'),
('159:04:00', 'Yellow Stained Clay', 'icon items-21-159-4'),
('159:05:00', 'Lime Stained Clay', 'icon items-21-159-5'),
('159:06:00', 'Pink Stained Clay', 'icon items-21-159-6'),
('159:07:00', 'Gray Stained Clay', 'icon items-21-159-7'),
('159:08:00', 'Light Gray Stained C', 'icon items-21-159-8'),
('159:09:00', 'Cyan Stained Clay', 'icon items-21-159-9'),
('159:10:00', 'Purple Stained Clay', 'icon items-21-159-10'),
('159:11:00', 'Blue Stained Clay', 'icon items-21-159-11'),
('159:12:00', 'Brown Stained Clay', 'icon items-21-159-12'),
('159:13:00', 'Green Stained Clay', 'icon items-21-159-13'),
('159:14:00', 'Red Stained Clay', 'icon items-21-159-14'),
('159:15:00', 'Black Stained Clay', 'icon items-21-159-15'),
('160', 'White Stained Glass ', 'icon items-21-160-0'),
('160:01:00', 'Orange Stained Glass', 'icon items-21-160-1'),
('160:02:00', 'Magenta Stained Glas', 'icon items-21-160-2'),
('160:03:00', 'Light Blue Stained G', 'icon items-21-160-3'),
('160:04:00', 'Yellow Stained Glass', 'icon items-21-160-4'),
('160:05:00', 'Lime Stained Glass P', 'icon items-21-160-5'),
('160:06:00', 'Pink Stained Glass P', 'icon items-21-160-6'),
('160:07:00', 'Gray Stained Glass P', 'icon items-21-160-7'),
('160:08:00', 'Light Gray Stained G', 'icon items-21-160-8'),
('160:09:00', 'Cyan Stained Glass P', 'icon items-21-160-9'),
('160:10:00', 'Purple Stained Glass', 'icon items-21-160-10'),
('160:11:00', 'Blue Stained Glass P', 'icon items-21-160-11'),
('160:12:00', 'Brown Stained Glass ', 'icon items-21-160-12'),
('160:13:00', 'Green Stained Glass ', 'icon items-21-160-13'),
('160:14:00', 'Red Stained Glass Pa', 'icon items-21-160-14'),
('160:15:00', 'Black Stained Glass ', 'icon items-21-160-15'),
('161', 'Acacia Leaves', 'icon items-21-161-0'),
('161:01:00', 'Dark Oak Leaves', 'icon items-21-161-1'),
('162', 'Acacia Wood', 'icon items-21-162-0'),
('162:01:00', 'Dark Oak Wood', 'icon items-21-162-1'),
('163', 'Acacia Wood Stairs', 'icon items-21-163-0'),
('164', 'Dark Oak Wood Stairs', 'icon items-21-164-0'),
('165', 'Slime Block', 'icon items-21-165-0'),
('166', 'Barrier', 'icon items-21-166-0'),
('167', 'Iron Trapdoor', 'icon items-21-167-0'),
('168', 'Prismarine', 'icon items-21-168-0'),
('168:01:00', 'Prismarine Bricks', 'icon items-21-168-1'),
('168:02:00', 'Dark Prismarine', 'icon items-21-168-2'),
('169', 'Sea Lantern', 'icon items-21-169-0'),
('170', 'Hay Bale', 'icon items-21-170-0'),
('171', 'White Carpet', 'icon items-21-171-0'),
('171:01:00', 'Orange Carpet', 'icon items-21-171-1'),
('171:02:00', 'Magenta Carpet', 'icon items-21-171-2'),
('171:03:00', 'Light Blue Carpet', 'icon items-21-171-3'),
('171:04:00', 'Yellow Carpet', 'icon items-21-171-4'),
('171:05:00', 'Lime Carpet', 'icon items-21-171-5'),
('171:06:00', 'Pink Carpet', 'icon items-21-171-6'),
('171:07:00', 'Gray Carpet', 'icon items-21-171-7'),
('171:08:00', 'Light Gray Carpet', 'icon items-21-171-8'),
('171:09:00', 'Cyan Carpet', 'icon items-21-171-9'),
('171:10:00', 'Purple Carpet', 'icon items-21-171-10'),
('171:11:00', 'Blue Carpet', 'icon items-21-171-11'),
('171:12:00', 'Brown Carpet', 'icon items-21-171-12'),
('171:13:00', 'Green Carpet', 'icon items-21-171-13'),
('171:14:00', 'Red Carpet', 'icon items-21-171-14'),
('171:15:00', 'Black Carpet', 'icon items-21-171-15'),
('172', 'Hardened Clay', 'icon items-21-172-0'),
('173', 'Block of Coal', 'icon items-21-173-0'),
('174', 'Packed Ice', 'icon items-21-174-0'),
('175', 'Sunflower', 'icon items-21-175-0'),
('175:01:00', 'Lilac', 'icon items-21-175-1'),
('175:02:00', 'Double Tallgrass', 'icon items-21-175-2'),
('175:03:00', 'Large Fern', 'icon items-21-175-3'),
('175:04:00', 'Rose Bush', 'icon items-21-175-4'),
('175:05:00', 'Peony', 'icon items-21-175-5'),
('176', 'Free-standing Banner', 'icon items-21-176-0'),
('177', 'Wall-mounted Banner', 'icon items-21-177-0'),
('178', 'Inverted Daylight Se', 'icon items-21-178-0'),
('179', 'Red Sandstone', 'icon items-21-179-0'),
('179:01:00', 'Chiseled Red Sandsto', 'icon items-21-179-1'),
('179:02:00', 'Smooth Red Sandstone', 'icon items-21-179-2'),
('180', 'Red Sandstone Stairs', 'icon items-21-180-0'),
('181', 'Double Red Sandstone', 'icon items-21-181-0'),
('182', 'Red Sandstone Slab', 'icon items-21-182-0'),
('183', 'Spruce Fence Gate', 'icon items-21-183-0'),
('184', 'Birch Fence Gate', 'icon items-21-184-0'),
('185', 'Jungle Fence Gate', 'icon items-21-185-0'),
('186', 'Dark Oak Fence Gate', 'icon items-21-186-0'),
('187', 'Acacia Fence Gate', 'icon items-21-187-0'),
('188', 'Spruce Fence', 'icon items-21-188-0'),
('189', 'Birch Fence', 'icon items-21-189-0'),
('190', 'Jungle Fence', 'icon items-21-190-0'),
('191', 'Dark Oak Fence', 'icon items-21-191-0'),
('192', 'Acacia Fence', 'icon items-21-192-0'),
('193', 'Spruce Door Block', 'icon items-21-193-0'),
('194', 'Birch Door Block', 'icon items-21-194-0'),
('195', 'Jungle Door Block', 'icon items-21-195-0'),
('196', 'Acacia Door Block', 'icon items-21-196-0'),
('197', 'Dark Oak Door Block', 'icon items-21-197-0'),
('256', 'Iron Shovel', 'icon items-21-256-0'),
('257', 'Iron Pickaxe', 'icon items-21-257-0'),
('258', 'Iron Axe', 'icon items-21-258-0'),
('259', 'Flint and Steel', 'icon items-21-259-0'),
('260', 'Apple', 'icon items-21-260-0'),
('261', 'Bow', 'icon items-21-261-0'),
('262', 'Arrow', 'icon items-21-262-0'),
('263', 'Coal', 'icon items-21-263-0'),
('263:01:00', 'Charcoal', 'icon items-21-263-1'),
('264', 'Diamond', 'icon items-21-264-0'),
('265', 'Iron Ingot', 'icon items-21-265-0'),
('266', 'Gold Ingot', 'icon items-21-266-0'),
('267', 'Iron Sword', 'icon items-21-267-0'),
('268', 'Wooden Sword', 'icon items-21-268-0'),
('269', 'Wooden Shovel', 'icon items-21-269-0'),
('270', 'Wooden Pickaxe', 'icon items-21-270-0'),
('271', 'Wooden Axe', 'icon items-21-271-0'),
('272', 'Stone Sword', 'icon items-21-272-0'),
('273', 'Stone Shovel', 'icon items-21-273-0'),
('274', 'Stone Pickaxe', 'icon items-21-274-0'),
('275', 'Stone Axe', 'icon items-21-275-0'),
('276', 'Diamond Sword', 'icon items-21-276-0'),
('277', 'Diamond Shovel', 'icon items-21-277-0'),
('278', 'Diamond Pickaxe', 'icon items-21-278-0'),
('279', 'Diamond Axe', 'icon items-21-279-0'),
('280', 'Stick', 'icon items-21-280-0'),
('281', 'Bowl', 'icon items-21-281-0'),
('282', 'Mushroom Stew', 'icon items-21-282-0'),
('283', 'Golden Sword', 'icon items-21-283-0'),
('284', 'Golden Shovel', 'icon items-21-284-0'),
('285', 'Golden Pickaxe', 'icon items-21-285-0'),
('286', 'Golden Axe', 'icon items-21-286-0'),
('287', 'String', 'icon items-21-287-0'),
('288', 'Feather', 'icon items-21-288-0'),
('289', 'Gunpowder', 'icon items-21-289-0'),
('290', 'Wooden Hoe', 'icon items-21-290-0'),
('291', 'Stone Hoe', 'icon items-21-291-0'),
('292', 'Iron Hoe', 'icon items-21-292-0'),
('293', 'Diamond Hoe', 'icon items-21-293-0'),
('294', 'Golden Hoe', 'icon items-21-294-0'),
('295', 'Wheat Seeds', 'icon items-21-295-0'),
('296', 'Wheat', 'icon items-21-296-0'),
('297', 'Bread', 'icon items-21-297-0'),
('298', 'Leather Helmet', 'icon items-21-298-0'),
('299', 'Leather Tunic', 'icon items-21-299-0'),
('300', 'Leather Pants', 'icon items-21-300-0'),
('301', 'Leather Boots', 'icon items-21-301-0'),
('302', 'Chainmail Helmet', 'icon items-21-302-0'),
('303', 'Chainmail Chestplate', 'icon items-21-303-0'),
('304', 'Chainmail Leggings', 'icon items-21-304-0'),
('305', 'Chainmail Boots', 'icon items-21-305-0'),
('306', 'Iron Helmet', 'icon items-21-306-0'),
('307', 'Iron Chestplate', 'icon items-21-307-0'),
('308', 'Iron Leggings', 'icon items-21-308-0'),
('309', 'Iron Boots', 'icon items-21-309-0'),
('310', 'Diamond Helmet', 'icon items-21-310-0'),
('311', 'Diamond Chestplate', 'icon items-21-311-0'),
('312', 'Diamond Leggings', 'icon items-21-312-0'),
('313', 'Diamond Boots', 'icon items-21-313-0'),
('314', 'Golden Helmet', 'icon items-21-314-0'),
('315', 'Golden Chestplate', 'icon items-21-315-0'),
('316', 'Golden Leggings', 'icon items-21-316-0'),
('317', 'Golden Boots', 'icon items-21-317-0'),
('318', 'Flint', 'icon items-21-318-0'),
('319', 'Raw Porkchop', 'icon items-21-319-0'),
('320', 'Cooked Porkchop', 'icon items-21-320-0'),
('321', 'Painting', 'icon items-21-321-0'),
('322', 'Golden Apple', 'icon items-21-322-0'),
('322:01:00', 'Enchanted Golden App', 'icon items-21-322-1'),
('323', 'Sign', 'icon items-21-323-0'),
('324', 'Oak Door', 'icon items-21-324-0'),
('325', 'Bucket', 'icon items-21-325-0'),
('326', 'Water Bucket', 'icon items-21-326-0'),
('327', 'Lava Bucket', 'icon items-21-327-0'),
('328', 'Minecart', 'icon items-21-328-0'),
('329', 'Saddle', 'icon items-21-329-0'),
('330', 'Iron Door', 'icon items-21-330-0'),
('331', 'Redstone', 'icon items-21-331-0'),
('332', 'Snowball', 'icon items-21-332-0'),
('333', 'Boat', 'icon items-21-333-0'),
('334', 'Leather', 'icon items-21-334-0'),
('335', 'Milk Bucket', 'icon items-21-335-0'),
('336', 'Brick', 'icon items-21-336-0'),
('337', 'Clay', 'icon items-21-337-0'),
('338', 'Sugar Canes', 'icon items-21-338-0'),
('339', 'Paper', 'icon items-21-339-0'),
('340', 'Book', 'icon items-21-340-0'),
('341', 'Slimeball', 'icon items-21-341-0'),
('342', 'Minecart with Chest', 'icon items-21-342-0'),
('343', 'Minecart with Furnac', 'icon items-21-343-0'),
('344', 'Egg', 'icon items-21-344-0'),
('345', 'Compass', 'icon items-21-345-0'),
('346', 'Fishing Rod', 'icon items-21-346-0'),
('347', 'Clock', 'icon items-21-347-0'),
('348', 'Glowstone Dust', 'icon items-21-348-0'),
('349', 'Raw Fish', 'icon items-21-349-0'),
('349:01:00', 'Raw Salmon', 'icon items-21-349-1'),
('349:02:00', 'Clownfish', 'icon items-21-349-2'),
('349:03:00', 'Pufferfish', 'icon items-21-349-3'),
('350', 'Cooked Fish', 'icon items-21-350-0'),
('350:01:00', 'Cooked Salmon', 'icon items-21-350-1'),
('351', 'Ink Sack', 'icon items-21-351-0'),
('351:01:00', 'Rose Red', 'icon items-21-351-1'),
('351:02:00', 'Cactus Green', 'icon items-21-351-2'),
('351:03:00', 'Coco Beans', 'icon items-21-351-3'),
('351:04:00', 'Lapis Lazuli', 'icon items-21-351-4'),
('351:05:00', 'Purple Dye', 'icon items-21-351-5'),
('351:06:00', 'Cyan Dye', 'icon items-21-351-6'),
('351:07:00', 'Light Gray Dye', 'icon items-21-351-7'),
('351:08:00', 'Gray Dye', 'icon items-21-351-8'),
('351:09:00', 'Pink Dye', 'icon items-21-351-9'),
('351:10:00', 'Lime Dye', 'icon items-21-351-10'),
('351:11:00', 'Dandelion Yellow', 'icon items-21-351-11'),
('351:12:00', 'Light Blue Dye', 'icon items-21-351-12'),
('351:13:00', 'Magenta Dye', 'icon items-21-351-13'),
('351:14:00', 'Orange Dye', 'icon items-21-351-14'),
('351:15:00', 'Bone Meal', 'icon items-21-351-15'),
('352', 'Bone', 'icon items-21-352-0'),
('353', 'Sugar', 'icon items-21-353-0'),
('354', 'Cake', 'icon items-21-354-0'),
('355', 'Bed', 'icon items-21-355-0'),
('356', 'Redstone Repeater', 'icon items-21-356-0'),
('357', 'Cookie', 'icon items-21-357-0'),
('358', 'Map', 'icon items-21-358-0'),
('359', 'Shears', 'icon items-21-359-0'),
('360', 'Melon', 'icon items-21-360-0'),
('361', 'Pumpkin Seeds', 'icon items-21-361-0'),
('362', 'Melon Seeds', 'icon items-21-362-0'),
('363', 'Raw Beef', 'icon items-21-363-0'),
('364', 'Steak', 'icon items-21-364-0'),
('365', 'Raw Chicken', 'icon items-21-365-0'),
('366', 'Cooked Chicken', 'icon items-21-366-0'),
('367', 'Rotten Flesh', 'icon items-21-367-0'),
('368', 'Ender Pearl', 'icon items-21-368-0'),
('369', 'Blaze Rod', 'icon items-21-369-0'),
('370', 'Ghast Tear', 'icon items-21-370-0'),
('371', 'Gold Nugget', 'icon items-21-371-0'),
('372', 'Nether Wart', 'icon items-21-372-0'),
('373', 'Potion', 'icon items-21-373-0'),
('374', 'Glass Bottle', 'icon items-21-374-0'),
('375', 'Spider Eye', 'icon items-21-375-0'),
('376', 'Fermented Spider Eye', 'icon items-21-376-0'),
('377', 'Blaze Powder', 'icon items-21-377-0'),
('378', 'Magma Cream', 'icon items-21-378-0'),
('379', 'Brewing Stand', 'icon items-21-379-0'),
('380', 'Cauldron', 'icon items-21-380-0'),
('381', 'Eye of Ender', 'icon items-21-381-0'),
('382', 'Glistering Melon', 'icon items-21-382-0'),
('383:50:00', 'Spawn Creeper', 'icon items-21-383-50'),
('383:51:00', 'Spawn Skeleton', 'icon items-21-383-51'),
('383:52:00', 'Spawn Spider', 'icon items-21-383-52'),
('383:54:00', 'Spawn Zombie', 'icon items-21-383-54'),
('383:55:00', 'Spawn Slime', 'icon items-21-383-55'),
('383:56:00', 'Spawn Ghast', 'icon items-21-383-56'),
('383:57:00', 'Spawn Pigman', 'icon items-21-383-57'),
('383:58:00', 'Spawn Enderman', 'icon items-21-383-58'),
('383:59:00', 'Spawn Cave Spider', 'icon items-21-383-59'),
('383:60', 'Spawn Silverfish', 'icon items-21-383-60'),
('383:61', 'Spawn Blaze', 'icon items-21-383-61'),
('383:62', 'Spawn Magma Cube', 'icon items-21-383-62'),
('383:65', 'Spawn Bat', 'icon items-21-383-65'),
('383:66', 'Spawn Witch', 'icon items-21-383-66'),
('383:67', 'Spawn Endermite', 'icon items-21-383-67'),
('383:68', 'Spawn Guardian', 'icon items-21-383-68'),
('383:90', 'Spawn Pig', 'icon items-21-383-90'),
('383:91', 'Spawn Sheep', 'icon items-21-383-91'),
('383:92', 'Spawn Cow', 'icon items-21-383-92'),
('383:93', 'Spawn Chicken', 'icon items-21-383-93'),
('383:94', 'Spawn Squid', 'icon items-21-383-94'),
('383:95', 'Spawn Wolf', 'icon items-21-383-95'),
('383:96', 'Spawn Mooshroom', 'icon items-21-383-96'),
('383:98', 'Spawn Ocelot', 'icon items-21-383-98'),
('383:100', 'Spawn Horse', 'icon items-21-383-10'),
('383:101', 'Spawn Rabbit', 'icon items-21-383-10'),
('383:120', 'Spawn Villager', 'icon items-21-383-12'),
('384', 'Bottle o'' Enchanting', 'icon items-21-384-0'),
('385', 'Fire Charge', 'icon items-21-385-0'),
('386', 'Book and Quill', 'icon items-21-386-0'),
('387', 'Written Book', 'icon items-21-387-0'),
('388', 'Emerald', 'icon items-21-388-0'),
('389', 'Item Frame', 'icon items-21-389-0'),
('390', 'Flower Pot', 'icon items-21-390-0'),
('391', 'Carrot', 'icon items-21-391-0'),
('392', 'Potato', 'icon items-21-392-0'),
('393', 'Baked Potato', 'icon items-21-393-0'),
('394', 'Poisonous Potato', 'icon items-21-394-0'),
('395', 'Empty Map', 'icon items-21-395-0'),
('396', 'Golden Carrot', 'icon items-21-396-0'),
('397', 'Mob Head (Skeleton)', 'icon items-21-397-0'),
('397:01:00', 'Mob Head (Wither Ske', 'icon items-21-397-1'),
('397:02:00', 'Mob Head (Zombie)', 'icon items-21-397-2'),
('397:03:00', 'Mob Head (Human)', 'icon items-21-397-3'),
('397:04:00', 'Mob Head (Creeper)', 'icon items-21-397-4'),
('398', 'Carrot on a Stick', 'icon items-21-398-0'),
('399', 'Nether Star', 'icon items-21-399-0'),
('400', 'Pumpkin Pie', 'icon items-21-400-0'),
('401', 'Firework Rocket', 'icon items-21-401-0'),
('402', 'Firework Star', 'icon items-21-402-0'),
('403', 'Enchanted Book', 'icon items-21-403-0'),
('404', 'Redstone Comparator', 'icon items-21-404-0'),
('405', 'Nether Brick', 'icon items-21-405-0'),
('406', 'Nether Quartz', 'icon items-21-406-0'),
('407', 'Minecart with TNT', 'icon items-21-407-0'),
('408', 'Minecart with Hopper', 'icon items-21-408-0'),
('409', 'Prismarine Shard', 'icon items-21-409-0'),
('410', 'Prismarine Crystals', 'icon items-21-410-0'),
('411', 'Raw Rabbit', 'icon items-21-411-0'),
('412', 'Cooked Rabbit', 'icon items-21-412-0'),
('413', 'Rabbit Stew', 'icon items-21-413-0'),
('414', 'Rabbit''s Foot', 'icon items-21-414-0'),
('415', 'Rabbit Hide', 'icon items-21-415-0'),
('416', 'Armor Stand', 'icon items-21-416-0'),
('417', 'Iron Horse Armor', 'icon items-21-417-0'),
('418', 'Golden Horse Armor', 'icon items-21-418-0'),
('419', 'Diamond Horse Armor', 'icon items-21-419-0'),
('420', 'Lead', 'icon items-21-420-0'),
('421', 'Name Tag', 'icon items-21-421-0'),
('422', 'Minecart with Comman', 'icon items-21-422-0'),
('423', 'Raw Mutton', 'icon items-21-423-0'),
('424', 'Cooked Mutton', 'icon items-21-424-0'),
('425', 'Banner', 'icon items-21-425-0'),
('427', 'Spruce Door', 'icon items-21-427-0'),
('428', 'Birch Door', 'icon items-21-428-0'),
('429', 'Jungle Door', 'icon items-21-429-0'),
('430', 'Acacia Door', 'icon items-21-430-0'),
('431', 'Dark Oak Door', 'icon items-21-431-0'),
('2256', '13 Disc', 'icon items-21-2256-0'),
('2257', 'Cat Disc', 'icon items-21-2257-0'),
('2258', 'Blocks Disc', 'icon items-21-2258-0'),
('2259', 'Chirp Disc', 'icon items-21-2259-0'),
('2260', 'Far Disc', 'icon items-21-2260-0'),
('2261', 'Mall Disc', 'icon items-21-2261-0'),
('2262', 'Mellohi Disc', 'icon items-21-2262-0'),
('2263', 'Stal Disc', 'icon items-21-2263-0'),
('2264', 'Strad Disc', 'icon items-21-2264-0'),
('2265', 'Ward Disc', 'icon items-21-2265-0'),
('2266', '11 Disc', 'icon items-21-2266-0'),
('2267', 'Wait Disc', 'icon items-21-2267-0');

-- --------------------------------------------------------

--
-- Table structure for table `MC_recipes`
--

CREATE TABLE IF NOT EXISTS `MC_recipes` (
  `src` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dst` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `method` enum('Crafting','Furnace','Brewwing','Enchant','Mine') COLLATE utf8_unicode_ci NOT NULL,
  `qsrc` int(11) NOT NULL,
  `qdst` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `MC_recipes`
--

INSERT INTO `MC_recipes` (`src`, `dst`, `method`, `qsrc`, `qdst`) VALUES
('17', '5', 'Crafting', 1, 4),
('4', '1', 'Furnace', 1, 1),
('5', '280', 'Crafting', 2, 4),
('280', '270', 'Crafting', 2, 1),
('15', '265', 'Crafting', 1, 1),
('265', '42', 'Crafting', 9, 1),
('42', '145', 'Crafting', 3, 1),
('17', '58', 'Crafting', 4, 1),
('270', '4', 'Mine', 1, 1),
('4', '61', 'Crafting', 8, 1),
('4', '274', 'Crafting', 3, 1),
('274', '15', 'Crafting', 1, 1),
('280', '274', 'Crafting', 2, 1),
('280', '257', 'Crafting', 2, 1),
('265', '257', 'Crafting', 3, 1),
('338', '353', 'Crafting', 1, 1),
('296', '297', 'Crafting', 3, 1),
('295', '59', 'Crafting', 1, 1),
('60', '59', 'Mine', 1, 1),
('59', '296', 'Mine', 1, 1),
('266', '41', 'Crafting', 9, 1),
('265', '101', 'Crafting', 6, 1),
('129', '388', 'Mine', 1, 1),
('14', '266', 'Furnace', 1, 1),
('141', '391', 'Mine', 1, 1),
('391', '141', 'Crafting', 1, 1),
('60', '141', 'Crafting', 1, 1),
('392', '393', 'Furnace', 1, 1),
('280', '50', 'Crafting', 1, 1),
('16', '263', 'Mine', 1, 1),
('270', '263', 'Mine', 1, 1),
('352', '351:15:00', 'Crafting', 1, 1),
('37', '351:11:00', 'Crafting', 1, 1),
('340', '386', 'Crafting', 1, 1),
('340', '47', 'Crafting', 3, 1),
('81', '351:02:00', 'Furnace', 1, 1),
('18:02', '6:02', 'Mine', 1, 1),
('369', '377', 'Crafting', 1, 1),
('45', '44:04:00', 'Crafting', 3, 1),
('336', '45', 'Crafting', 4, 1),
('82', '337', 'Crafting', 1, 1),
('4', '44:03:00', 'Crafting', 3, 1),
('4', '67', 'Crafting', 6, 1),
('4', '139', 'Crafting', 6, 1),
('257', '14', 'Mine', 1, 1),
('257', '263', 'Mine', 1, 1),
('257', '4', 'Mine', 1, 1),
('257', '15', 'Mine', 1, 1),
('257', '73', 'Mine', 1, 1),
('388', '133', 'Crafting', 9, 1),
('348', '89', 'Crafting', 4, 1),
('50', '91', 'Crafting', 1, 1),
('86', '91', 'Crafting', 1, 1),
('361', '104', 'Mine', 1, 1),
('60', '104', 'Mine', 1, 1),
('104', '86', 'Mine', 1, 1),
('86', '400', 'Crafting', 1, 1),
('344', '400', 'Crafting', 1, 1),
('353', '400', 'Crafting', 1, 1),
('325', '335', 'Mine', 1, 1),
('325', '326', 'Mine', 1, 1),
('325', '327', 'Mine', 1, 1),
('265', '325', 'Crafting', 3, 1),
('17', '143', 'Crafting', 1, 1),
('257', '388', 'Mine', 1, 1),
('257', '264', 'Crafting', 1, 1),
('264', '278', 'Crafting', 3, 1),
('280', '278', 'Crafting', 2, 1),
('278', '49', 'Mine', 1, 1),
('327', '49', 'Mine', 1, 1),
('326', '49', 'Mine', 1, 1);

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
-- Indexes for table `D_Games`
--
ALTER TABLE `D_Games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `D_Games_Review`
--
ALTER TABLE `D_Games_Review`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `MC_objects`
--
ALTER TABLE `MC_objects`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `D_Accounts`
--
ALTER TABLE `D_Accounts`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `D_Articles`
--
ALTER TABLE `D_Articles`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `D_Games`
--
ALTER TABLE `D_Games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `D_Games_Review`
--
ALTER TABLE `D_Games_Review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `D_Media`
--
ALTER TABLE `D_Media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `D_Perms`
--
ALTER TABLE `D_Perms`
  MODIFY `Perm_No` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
