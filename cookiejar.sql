-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2021 at 04:44 PM
-- Server version: 8.0.16
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookiejar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE `cookie` (
  `cid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_public` int(1) NOT NULL DEFAULT '0',
  `likes` int(5) NOT NULL DEFAULT '0'
)    ;

--
-- Dumping data for table `cookie`
--

INSERT INTO `cookie` (`cid`, `uid`, `title`, `edit_date`, `is_public`, `likes`) VALUES
(37, 3, 'New testing cookie', '2021-10-17 17:29:14', 0, 0),
(38, 3, 'only 15 min to deside', '2021-10-17 17:22:51', 0, 0),
(39, 3, 'Cookie with description and 2 tags          ', '2021-10-17 17:21:29', 1, 0),
(40, 3, 'Khali Time', '2021-11-01 18:17:31', 0, 0),
(50, 3, 'Be Happy', '2021-11-19 11:15:53', 0, 0),
(51, 3, 'Hard Time', '2021-11-19 11:19:10', 0, 0),
(52, 3, 'I\'m stronger', '2021-11-19 11:23:41', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_msg`
--

CREATE TABLE `cookie_msg` (
  `cid` int(10) NOT NULL,
  `msg` text NOT NULL
)    ;

--
-- Dumping data for table `cookie_msg`
--

INSERT INTO `cookie_msg` (`cid`, `msg`) VALUES
(38, ' nice decision to utilize time'),
(39, '   how'),
(40, '- Em nm besi revanu k vicharya krvanu ny.\r\n- Action: max 15 min no time levano, je yogya laage te chalu kri devanu\r\n- Ky n suje to aaju baju sfaay kri levani (badhu organized manner ma mukvanu)\r\n- That work will become greate dots when you see backward.'),
(50, 'Why are you sad. You have great body, sweet and supportive family. what else you needed to achieve your goals. Go ahead and enjoy your journey.'),
(51, 'If you are living, it means you will have to face some hard problems. Life is just no straight forward.\r\nOur body and mind both needs problems to sustain. \r\nSo its part of life. Just enjoy it.'),
(52, 'Don\'t be afraid by thinking future problems. Your are strong enough to handle that situation. If something breaks down at that hard time, that would be your weaknesses.');

-- --------------------------------------------------------

--
-- Table structure for table `cookie_tag`
--

CREATE TABLE `cookie_tag` (
  `cid` int(10) NOT NULL,
  `tid` int(10) NOT NULL
)    ;

--
-- Dumping data for table `cookie_tag`
--

INSERT INTO `cookie_tag` (`cid`, `tid`) VALUES
(37, 17),
(38, 17),
(38, 18),
(39, 19),
(40, 17),
(40, 18),
(40, 19),
(50, 17),
(50, 18),
(51, 18),
(52, 17);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `feedback` text NOT NULL
)    ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `uid`, `feedback`) VALUES
(1, 3, 'Nice website..');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
)    ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tid`, `uid`, `name`) VALUES
(17, 3, 'Daily Dose'),
(18, 3, 'Favourit'),
(19, 3, 'Study');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
)    ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `password`) VALUES
(3, 'Zala Jaydip', 'jbzala004@gmail.com', '$2y$10$WuVJgA8vCMou0x1o8DUX6enzM5sbQjv5lYIfKjHrRIMRQe0D2kHei');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `cookie_msg`
--
ALTER TABLE `cookie_msg`
  ADD UNIQUE KEY `cid_2` (`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `cookie_tag`
--
ALTER TABLE `cookie_tag`
  ADD UNIQUE KEY `cid_2` (`cid`,`tid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cookie`
--
ALTER TABLE `cookie`
  ADD CONSTRAINT `cookie_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cookie_msg`
--
ALTER TABLE `cookie_msg`
  ADD CONSTRAINT `cookie_msg_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `cookie` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cookie_tag`
--
ALTER TABLE `cookie_tag`
  ADD CONSTRAINT `cookie_tag_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `cookie` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cookie_tag_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tags` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
