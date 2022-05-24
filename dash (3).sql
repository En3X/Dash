-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 06:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `aid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`aid`, `name`, `username`, `password`) VALUES
(1, 'Admin Bahadur', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `dis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `dis`) VALUES
(1, 'NAVI Wins Stockholm Major', 'With close match and quick comeback, Natus Vincere (NAVI) won the major. It was their first win in major.'),
(2, 'AOT En3X Leaves Pro Scene', 'Due to some issues, En3X from team AOT will not be plying competitive CS:GO. More details to come soon.'),
(3, 'Dota 2 Spring Update', 'Dota 2 dropping Spring Update 2022 makes the players happy. A lot of expectations are bound with the news.'),
(5, 'Sahil Prajapati switching to Valorant', 'Young and well known PUBG M player Zer0 Sahil is moving to Valorant. Will he bee able to have same level of impact there?'),
(7, 'Test Articlewe', 'akjhdaojwdoajdoikjmasdkolmw'),
(8, 'This is new article', 'Description for new article'),
(9, 'This is article', 'Article 101');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gid` int(11) NOT NULL,
  `gname` varchar(50) NOT NULL,
  `distributor` varchar(50) NOT NULL,
  `logopath` varchar(100) NOT NULL,
  `bgpath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gid`, `gname`, `distributor`, `logopath`, `bgpath`) VALUES
(1, 'Apex Legends', 'EA Games', './img/glogo/apex_logo.svg', './img/gbg/apex.jpg'),
(2, 'CS:GO', 'Valve Corporation', './img/glogo/csgo_logo.svg', './img/gbg/csgo.jpg'),
(3, 'Dota 2', 'Valve Corporation', './img/glogo/dota_logo.svg', './img/gbg/dota.jpg'),
(4, 'Fortnite', 'Epic Games', './img/glogo/fortnite_logo.svg', './img/gbg/fortnite.jpg'),
(5, 'League Of Legends', 'Riot Games', './img/glogo/lol_logo.svg', './img/gbg/lol.jpg'),
(6, 'PUBG', 'KRAFTON, PUBG Corporation', './img/glogo/pubg_logo.svg', './img/gbg/pubg.jpg'),
(7, 'Rocket League', 'Psyonix', './img/glogo/rocket_league_logo.svg', './img/gbg/rocket.png'),
(8, 'Valorant', 'Riot Games', './img/glogo/valorant_logo.svg', './img/gbg/valorant.jpg'),
(9, 'Call of Duty: Warzone', 'Activision', './img/glogo/warzone_logo.svg', './img/gbg/warzone.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `purchaselog`
--

CREATE TABLE `purchaselog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `itemid` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaselog`
--

INSERT INTO `purchaselog` (`id`, `uid`, `username`, `itemid`, `itemname`, `price`) VALUES
(4, 7, 'Maneesh Pandey', 1, '1000 Apex-legend  coin', 8.99),
(5, 7, 'Maneesh Pandey', 41, '475 VALORANT POINT', 4.99),
(6, 8, 'Sahil Prajapati', 36, '8400 pubg uc', 99.99),
(7, 8, 'Sahil Prajapati', 2, '2150 Apex-legend  coin', 17.99),
(8, 8, 'Sahil Prajapati', 12, 'wildlily', 1063),
(9, 8, 'Sahil Prajapati', 46, '11000 VALORANT POINT', 99.99),
(10, 7, 'Maneesh Pandey', 1, '1000 Apex-legend  coin', 8.99),
(11, 7, 'Maneesh Pandey', 5, 'Gamma Doppler Emerald Karambit', 9800),
(12, 7, 'Maneesh Pandey', 2, '2150 Apex-legend  coin', 17.99),
(13, 7, 'Maneesh Pandey', 1, '1000 Apex-legend  coin', 8.99),
(14, 7, 'Maneesh Pandey', 41, '475 VALORANT POINT', 4.99),
(15, 14, 'Test User', 1, '1000 Apex-legend  coin', 8.99);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `itemid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`itemid`, `gameid`, `name`, `price`, `img`) VALUES
(1, 1, '1000 Apex-legend  coin', '8.99', 'Apex.png'),
(2, 1, '2150 Apex-legend  coin', '17.99', 'Apex.png'),
(3, 1, '4350 Apex-legend  coin', '35.99', 'Apex.png'),
(4, 1, '6700 Apex-legend  coin', '53.99', 'Apex.png'),
(5, 2, 'Gamma Doppler Emerald Karambit', '9800', 'gammaemeraldkarambit.png'),
(6, 2, 'Crimson Kimono ', '8815', 'crimsonkimono.png'),
(7, 2, 'Gungnir ', '9428', 'gungnir.png'),
(8, 2, 'howl', '7224', 'howl.png'),
(9, 2, 'Gold Arabesque ', '9285', 'goldarabesque.png'),
(10, 2, 'fade', '1050', 'fade.png'),
(11, 2, 'handcannon', '953', 'handcannon.png'),
(12, 2, 'wildlily', '1063', 'wildlily.png'),
(13, 2, 'emeralddragon p90', '255', 'emeralddragonp90.png'),
(14, 2, 'akihabara aug', '5388', 'akihabaraaug.png'),
(15, 2, 'cinquedea', '641', 'cinquedea.png'),
(16, 2, 'fallout warning', '102', 'falloutwarning.png'),
(17, 2, 'mjolnir', '1785', 'mjolnir.png'),
(18, 2, 'anodized navy', '348', 'anodizednavy.png'),
(19, 2, 'Operation Breakout Case Key', '15.36', 'Operation Breakout Case Key.png'),
(20, 2, 'Gamma Case Key', '9', 'Gamma Case Key.png'),
(21, 4, '1000 fortnite bucks', '7.99', 'fortnite.png'),
(22, 4, '2800 fortnite bucks', '19.99', 'fortnite.png'),
(23, 4, '5000 fortnite bucks', '31.99', 'fortnite.png'),
(24, 4, '13500 fortnite bucks', '79.99', 'fortnite.png'),
(25, 5, '650 league of legends', '5', 'lol.png'),
(26, 5, '1380 league of legends', '10', 'lol.png'),
(27, 5, '2800 league of legends', '20', 'lol.png'),
(28, 5, '5000 league of legends', '35', 'lol.png'),
(29, 5, '7200 league of legends', '50', 'lol.png'),
(30, 5, '15000 league of legends', '100', 'lol.png'),
(31, 6, '63 pubg uc', '0.99', 'pubg.png'),
(32, 6, '340 pubg uc', '4.99', 'pubg.png'),
(33, 6, '690 pubg uc', '9.99', 'pubg.png'),
(34, 6, '1875 pubg uc', '24.99', 'pubg.png'),
(35, 6, '4000 pubg uc', '49.99', 'pubg.png'),
(36, 6, '8400 pubg uc', '99.99', 'pubg.png'),
(37, 7, '500 Rocket league ', '4.99', 'rocketleague.png'),
(38, 7, '1100 Rocket league ', '9.99', 'rocketleague.png'),
(39, 7, '3000 Rocket league ', '24.99', 'rocketleague.png'),
(40, 7, '6500 Rocket league ', '49.99', 'rocketleague.png'),
(41, 8, '475 VALORANT POINT', '4.99', 'valorant.png'),
(42, 8, '1000 VALORANT POINT', '9.99', 'valorant.png'),
(43, 8, '2050 VALORANT POINT', '19.99', 'valorant.png'),
(44, 8, '3650 VALORANT POINT', '34.99', 'valorant.png'),
(45, 8, '5350 VALORANT POINT', '49.99', 'valorant.png'),
(46, 8, '11000 VALORANT POINT', '99.99', 'valorant.png');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `tid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `month` varchar(5) NOT NULL,
  `day` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `sec` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ended` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tid`, `gid`, `name`, `description`, `status`, `month`, `day`, `hour`, `min`, `sec`, `uid`, `ended`) VALUES
(10, 2, 'Dota 2 Champs', 'A tournament where you can show your skill and get a dub. Play against the best and win the tournament. Best of best will be rewarded by recruiting in pro scene.', 'Open', 'Mar', 25, 9, 0, 0, 7, 1),
(12, 2, 'Tournament by Maneesh Pandey', 'You can edit the name of the tournament, description or even the date and time of tournament. When you are done, press \"Host Tournament\" button to host the tournament.', 'Open', 'Mar', 25, 9, 0, 0, 7, 1),
(13, 4, 'Fortnite Tournament For Gamers', 'Fortnite is an online video game developed by Epic Games and released in 2017. It is available in three distinct game mode versions that otherwise share the same general gameplay and game engine: Fortnite', 'Open', 'Mar', 25, 9, 0, 0, 14, 0),
(14, 2, 'CSGO Tournament', 'Counter-Strike: Global Offensive is a 2012 multiplayer first-person shooter developed by Valve and Hidden Path Entertainment. It is the fourth game in the Counter-Strike series. ', 'Open', 'Mar', 25, 9, 0, 0, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentcomment`
--

CREATE TABLE `tournamentcomment` (
  `id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournamentcomment`
--

INSERT INTO `tournamentcomment` (`id`, `msg`, `username`, `tid`) VALUES
(1, 'hello, when is the tournament?', 'Maneesh Pandey', 10),
(2, 'hi, wassup guys', 'Maneesh Pandey', 10),
(3, 'hello', 'Maneesh Pandey', 10),
(4, 'hello, when is the tournament?', 'Maneesh Pandey', 11),
(5, 'hello', 'Sahil Prajapati', 11),
(6, 'hi', 'Maneesh Pandey', 11),
(7, 'hello guys', 'Sahil Prajapati', 11),
(8, 'hello this is sahil', 'Sahil Prajapati', 11),
(9, 'hello', 'Maneesh Pandey', 14),
(10, 'hi there', 'Test User', 14),
(11, 'thank you for letting me join', 'Sahil Prajapati', 14),
(12, 'any one else joining?', 'Sahil Prajapati', 14),
(13, 'not sure', 'Maneesh Pandey', 14),
(14, 'Hello, thank you for inviting', 'Test User 1', 13),
(15, 'Thank you for joining', 'Test User', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentmembers`
--

CREATE TABLE `tournamentmembers` (
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournamentmembers`
--

INSERT INTO `tournamentmembers` (`tid`, `uid`, `username`) VALUES
(11, 7, 'Maneesh Pandey'),
(12, 14, 'Test User'),
(15, 8, 'Sahil Prajapati'),
(10, 8, 'Sahil Prajapati'),
(13, 15, 'Test User 1'),
(18, 14, 'Test User');

-- --------------------------------------------------------

--
-- Table structure for table `tournamentwinner`
--

CREATE TABLE `tournamentwinner` (
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournamentwinner`
--

INSERT INTO `tournamentwinner` (`tid`, `uid`) VALUES
(10, 8),
(12, 14),
(18, 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `balance`) VALUES
(7, 'Maneesh Pandey', 'manish@gmail.com', '$2y$10$hcnf7nX1yhDYE1fajeQbNOwWF6OefVlttdtSwzCIXjaeHVWdW/hYi', 945.03),
(8, 'Sahil Prajapati', 'sahil@gmail.com', '$2y$10$srBS/gIMqGlfRoVNxlMZBOvaM8en9NX/LxVONA1dslqHtvshR.igC', 1919.03),
(10, 'Simran Ghimire', 'simran@gmail.com', '$2y$10$IqKHn1./ingpyvDabanty.po/4B8QQOZ9DZKZNSeIX0Ii/y0.SfZa', 0),
(14, 'Test User', 'test@gmail.com', '$2y$10$5wRS0MOuH/aAOj/uwRxowe8RijoaGROHNhTOd8eIb8CX4z/sIi.d.', 991.01);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `purchaselog`
--
ALTER TABLE `purchaselog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `tournamentcomment`
--
ALTER TABLE `tournamentcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tournamentwinner`
--
ALTER TABLE `tournamentwinner`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchaselog`
--
ALTER TABLE `purchaselog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tournamentcomment`
--
ALTER TABLE `tournamentcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tournamentwinner`
--
ALTER TABLE `tournamentwinner`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
