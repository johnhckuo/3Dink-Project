-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Mar 11, 2014, 08:31 AM
-- 伺服器版本: 5.1.72
-- PHP 版本: 5.3.3-7+squeeze18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `test`
--

-- --------------------------------------------------------

--
-- 資料表格式： `3D Image`
--

CREATE TABLE IF NOT EXISTS `3D Image` (
  `3dimageNo` int(10) NOT NULL AUTO_INCREMENT,
  `3dimagePath` varchar(50) NOT NULL,
  `imageCategory` varchar(5) NOT NULL,
  PRIMARY KEY (`3dimageNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `3D Image`
--


-- --------------------------------------------------------

--
-- 資料表格式： `3D Printer`
--

CREATE TABLE IF NOT EXISTS `3D Printer` (
  `printerNo` int(10) NOT NULL AUTO_INCREMENT,
  `printerModel` varchar(20) NOT NULL,
  `printerInfo` varchar(50) NOT NULL,
  `printerStatus` varchar(10) NOT NULL,
  `currentorderNo` int(10) NOT NULL,
  `videoLink` int(10) NOT NULL,
  PRIMARY KEY (`printerNo`),
  KEY `videoLink` (`videoLink`),
  KEY `currentorderNo` (`currentorderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `3D Printer`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Article Category`
--

CREATE TABLE IF NOT EXISTS `Article Category` (
  `articlecategoryNo` int(10) NOT NULL AUTO_INCREMENT,
  `articleCategory` varchar(5) NOT NULL,
  PRIMARY KEY (`articlecategoryNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Article Category`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Forum`
--

CREATE TABLE IF NOT EXISTS `Forum` (
  `forumNo` int(10) NOT NULL AUTO_INCREMENT,
  ` forumCategory` varchar(5) NOT NULL,
  ` forumIntro` varchar(50) NOT NULL,
  PRIMARY KEY (`forumNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Forum`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Forum Content`
--

CREATE TABLE IF NOT EXISTS `Forum Content` (
  `contentNo` int(11) NOT NULL,
  `Title` int(11) NOT NULL,
  `Content` int(11) NOT NULL,
  ` belongTo` int(11) NOT NULL,
  ` postTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 列出以下資料庫的數據： `Forum Content`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Image Category`
--

CREATE TABLE IF NOT EXISTS `Image Category` (
  `categoryNo` int(10) NOT NULL AUTO_INCREMENT,
  `imageCategory` varchar(5) NOT NULL,
  `imageIntro` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categoryNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Image Category`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Member`
--

CREATE TABLE IF NOT EXISTS `Member` (
  `memberNo` int(100) NOT NULL AUTO_INCREMENT,
  `facebook ID` varchar(20) NOT NULL,
  `Account` varchar(16) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `pPath` varchar(100) DEFAULT NULL,
  `lastloginDate` date NOT NULL,
  `registeredDate` date NOT NULL,
  `platformNo` int(10) NOT NULL,
  `Nickname` varchar(15) NOT NULL,
  PRIMARY KEY (`memberNo`),
  KEY `platformNo` (`platformNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Member`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Order Info`
--

CREATE TABLE IF NOT EXISTS `Order Info` (
  `orderNo` int(10) NOT NULL AUTO_INCREMENT,
  `createTime` date NOT NULL,
  `Memo` varchar(100) DEFAULT NULL,
  `orderStatus` varchar(10) NOT NULL,
  `traceCode` varchar(20) NOT NULL,
  PRIMARY KEY (`orderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Order Info`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Platform`
--

CREATE TABLE IF NOT EXISTS `Platform` (
  `pictureNo` int(10) NOT NULL AUTO_INCREMENT,
  `3dimageLink` varchar(100) DEFAULT NULL,
  `2dimageLink` varchar(100) DEFAULT NULL,
  `productInfo` varchar(100) DEFAULT NULL,
  `Score` int(10) DEFAULT NULL,
  ` Hitrate` int(10) DEFAULT NULL,
  `updateTime` date NOT NULL,
  PRIMARY KEY (`pictureNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Platform`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `productNo` int(10) NOT NULL AUTO_INCREMENT,
  `productName` varchar(10) NOT NULL,
  ` videoLink` varchar(50) NOT NULL,
  PRIMARY KEY (`productNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Product`
--


-- --------------------------------------------------------

--
-- 資料表格式： `Receiver Info`
--

CREATE TABLE IF NOT EXISTS `Receiver Info` (
  `receiverNo` int(10) NOT NULL AUTO_INCREMENT,
  `receiverName` varchar(5) NOT NULL,
  `receiverAddress` varchar(50) NOT NULL,
  `receiverTelephone` varchar(10) NOT NULL,
  `zip` int(3) NOT NULL,
  `Country` varchar(10) NOT NULL,
  PRIMARY KEY (`receiverNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 列出以下資料庫的數據： `Receiver Info`
--


--
-- 備份資料表限制
--

--
-- 資料表限制 `3D Printer`
--
ALTER TABLE `3D Printer`
  ADD CONSTRAINT `3D Printer_ibfk_1` FOREIGN KEY (`currentorderNo`) REFERENCES `Order Info` (`orderNo`);

--
-- 資料表限制 `Member`
--
ALTER TABLE `Member`
  ADD CONSTRAINT `Member_ibfk_1` FOREIGN KEY (`platformNo`) REFERENCES `Platform` (`pictureNo`);
