-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2021 at 03:55 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `comment_user` int(11) NOT NULL,
  `comment_post` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `comment_text`, `comment_user`, `comment_post`, `date_created`, `comment_parent`) VALUES
(52, 'asdasd', 9, 0, '2021-06-06 21:58:28', NULL),
(51, 'asdasd', 9, 0, '2021-06-06 21:57:32', NULL),
(50, 'asdasd', 9, 0, '2021-06-06 21:56:58', NULL),
(49, 'asdasd', 9, 0, '2021-06-06 21:40:07', NULL),
(48, 'asdasd', 9, 0, '2021-06-06 21:39:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_body` text NOT NULL,
  `post_author` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `post_img` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `post_title`, `post_body`, `post_author`, `date_created`, `date_modified`, `post_img`) VALUES
(29, 'asdasda', 'asdadadasd', 7, '2021-06-06 15:55:23', NULL, 'images/60bc8d7bd7cbb.jpeg'),
(30, 'asdasd', 'asdasdasjk ajs n sandasd asd', 7, '2021-06-06 15:55:42', NULL, 'images/60bc8d8e06cda.jpeg'),
(31, 'a', 'wefwewfe wfewfwef', 7, '2021-06-06 15:59:22', NULL, 'images/60bc8e6a119a7.jpeg'),
(35, 'adsa', 'sadadad', 9, '2021-06-06 21:10:32', NULL, 'images/60bcd758c196d.png'),
(33, 'asdasd', 'asdhabsk asbdkasbd asd jbskdjbak jb bsakjdbajkdbjb adskabd bjkb jkba jbdk asbkdb asbj kbsk jbka sd', 8, '2021-06-06 20:11:57', NULL, 'images/60bcc99d5048d.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_img` varchar(255) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `date_created`, `user_img`, `user_role`) VALUES
(6, 'Coftbred', 'nkluyen123@gmail.com', '$2y$10$N1g0eCOK4rQtg42MjEFmZ.qghU7rALx2dnKJE4LfyOglT1fTW7F0C', '2021-06-06 13:30:40', NULL, 0),
(1, 'admin', 'admin@gmail.com', '$2y$10$naICwx0o9hKxXz0HqyIDDeLzL5U0ocO8NRBSeQk0r5cyctRqI8RE2', '2021-06-06 13:29:43', NULL, 1),
(7, 'NKLuyen', 'nkluyen123@gmail.com', '$2y$10$vZ9SaQkWGyMH7zsR0H0rH.3MTQyStd23Ol8oHVWnxznfit27MGnty', '2021-06-06 14:53:14', NULL, 0),
(8, 'admin1', 'nkluyen123@gmail.com', '$2y$10$.yC1/O0KgJ1tK2Dujy694eVFI3npLhvHKzVFaZ2Ianzej0MbWkEg.', '2021-06-06 16:15:43', NULL, 0),
(9, 'Coftbred123123', 'sad@sda.com', '$2y$10$2ovmzyzWPSmVDKfRw578WeZ/YSXCWqh9lzvyU0Hu.zcvBZqshA7d6', '2021-06-06 20:31:13', NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
