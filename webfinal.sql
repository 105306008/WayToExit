-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 06 月 13 日 23:30
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `webfinal`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_username` varchar(11) NOT NULL,
  `comment_nickname` varchar(11) NOT NULL,
  `comment_content` varchar(1024) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_love` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `player_x` int(11) NOT NULL DEFAULT '100',
  `player_temX` int(11) NOT NULL DEFAULT '100',
  `player_moveX` int(11) NOT NULL DEFAULT '0',
  `robot01_passed` tinyint(1) NOT NULL DEFAULT '0',
  `robot02_passed` tinyint(1) NOT NULL DEFAULT '0',
  `robot03_passed` tinyint(1) NOT NULL DEFAULT '0',
  `robot01_destroy` tinyint(1) NOT NULL DEFAULT '0',
  `robot02_destroy` tinyint(1) NOT NULL DEFAULT '0',
  `robot03_destroy` tinyint(1) NOT NULL DEFAULT '0',
  `robot01_temPass` tinyint(1) NOT NULL DEFAULT '0',
  `robot02_temPass` tinyint(1) NOT NULL DEFAULT '0',
  `robot03_temPass` tinyint(1) NOT NULL DEFAULT '0',
  `robot01_temDest` tinyint(1) NOT NULL DEFAULT '0',
  `robot02_temDest` tinyint(1) NOT NULL DEFAULT '0',
  `robot03_temDest` tinyint(1) NOT NULL DEFAULT '0',
  `robot01_love` tinyint(1) NOT NULL DEFAULT '0',
  `robot02_love` tinyint(1) NOT NULL DEFAULT '0',
  `robot03_love` tinyint(1) NOT NULL DEFAULT '0',
  `first_play` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `data`
--

INSERT INTO `data` (`id`, `username`, `nickname`, `password`, `player_x`, `player_temX`, `player_moveX`, `robot01_passed`, `robot02_passed`, `robot03_passed`, `robot01_destroy`, `robot02_destroy`, `robot03_destroy`, `robot01_temPass`, `robot02_temPass`, `robot03_temPass`, `robot01_temDest`, `robot02_temDest`, `robot03_temDest`, `robot01_love`, `robot02_love`, `robot03_love`, `first_play`) VALUES
(1, 'test123', 'test123', 'cc03e747a6afbbcbf8be7668acfebee5', 100, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, 'test456', 'test456', '309031d05eb343448b725b09a3635f13', 100, 770, -410, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- 資料表索引 `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
