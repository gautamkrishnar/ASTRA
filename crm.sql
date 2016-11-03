-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 08:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE IF NOT EXISTS `dept` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`deptid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phno` int(15) DEFAULT NULL,
  `tcount` int(11) DEFAULT NULL,
  `todaycount` int(11) DEFAULT NULL,
  `totcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requesta`
--

CREATE TABLE IF NOT EXISTS `requesta` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `officerid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `apptime` date DEFAULT NULL,
  `maxdays` int(11) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `stat` int(11) DEFAULT NULL,
  `description` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `address` varchar(800) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` int(14) DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `pass` varchar(256) DEFAULT NULL,
  `uidaino` int(15) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
