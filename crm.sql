-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2016 at 06:02 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

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
-- Table structure for table `certificates`
--

CREATE TABLE IF NOT EXISTS `certificates` (
  `cid` int(100) NOT NULL AUTO_INCREMENT,
  `cname` varchar(500) NOT NULL,
  `officergrp` int(50) NOT NULL,
  `highergrp` int(50) NOT NULL,
  `maxdays` int(50) NOT NULL,
  `test` int(11) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cname` (`cname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`cid`, `cname`, `officergrp`, `highergrp`, `maxdays`, `test`) VALUES
(1, 'INCOME CERTIFICATE', 1, 2, 6, 270),
(2, 'CASTE CERTIFICATE', 1, 2, 6, 270),
(3, 'RESIDENTIAL CERTIFICATE', 1, 2, 3, 270),
(4, 'POSSESSION CERTIFICATE', 1, 2, 7, 270);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `comid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(15) NOT NULL,
  `rid` int(20) NOT NULL,
  `descr` varchar(1000) NOT NULL,
  `stat` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `username` varchar(300) NOT NULL,
  PRIMARY KEY (`comid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`comid`, `userid`, `rid`, `descr`, `stat`, `title`, `username`) VALUES
(1, 1, 1, 'wrong income', 1, 'Request Complaint', 'User 1'),
(2, 1, 0, 'djdklajldqdowefnwejlnjwencnwec', 2, 'Delay in Service', '	\nUser 1'),
(3, 1, 3, 'over amount', 2, 'Request Complaint', '	\nUser 1'),
(4, 1, 0, 'I had a bad experience from an officer at XXXX office. ', 1, 'Bad BEhaviour', '	\nUser 1'),
(5, 2, 6, 'Very high income', 1, 'Request Complaint', 'USER 2'),
(6, 2, 6, 'Very high income', 0, 'Request Complaint', 'USER 2'),
(7, 2, 0, 'An Offical in XXXX office asked me for bribe', 0, 'Asked for Bribe', 'USER 2');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE IF NOT EXISTS `dept` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`deptid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptid`, `deptname`) VALUES
(1, 'REVENUE');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phno` varchar(20) DEFAULT NULL,
  `tcount` int(11) DEFAULT NULL,
  `todaycount` int(11) DEFAULT NULL,
  `totcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `name`, `deptid`, `designation`, `role`, `username`, `password`, `email`, `phno`, `tcount`, `todaycount`, `totcount`) VALUES
(1, 'Officer 1', 1, 'VILLAGE OFFICER', 1, 'officer1', 'officer1', 'jpa895@gmail.com', '9496908070', 0, 22, 0),
(2, 'Officer 2', 1, 'VILLAGE OFFICER', 1, 'officer2', 'officer2', 'abhinavdinesh95@gmail.com', '9495206270', 0, 21, 0),
(3, 'Higher Officer', 1, 'THASASILDHAR', 2, 'officer3', 'officer3', 'justforahorror37@gmail.com', '9999999999', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requesta`
--

CREATE TABLE IF NOT EXISTS `requesta` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `officerid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `apptime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `maxdays` int(11) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `stat` int(11) DEFAULT NULL,
  `description` varchar(800) DEFAULT NULL,
  `remdays` int(11) NOT NULL DEFAULT '6',
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `requesta`
--

INSERT INTO `requesta` (`rid`, `officerid`, `userid`, `cid`, `apptime`, `maxdays`, `deptid`, `stat`, `description`, `remdays`, `code`) VALUES
(1, 2, 1, 1, '2016-11-04 17:16:26', 6, 1, 0, 'INCOME CERTIFICATE', 6, 'wqeq'),
(2, 2, 1, 2, '2016-11-04 19:55:10', 6, 1, 0, 'NATIVITY CERTIFICATE', 6, '0ffsdf'),
(3, 1, 1, 2, '2016-11-04 19:56:50', 6, 1, 2, 'NATIVITY CERTIFICATE', 6, 'vdvdf'),
(4, 2, 1, 2, '2016-10-31 19:56:55', 6, 1, 0, 'NATIVITY CERTIFICATE', 2, '0vdffdger'),
(5, 1, 1, 2, '2016-10-31 19:57:00', 6, 1, 1, 'NATIVITY CERTIFICATE', 2, 'brth'),
(6, 2, 2, 1, '2016-11-04 22:18:44', 6, 1, 0, 'INCOME CERTIFICATE', 6, '663ae'),
(7, 2, 2, 2, '2016-11-04 22:23:04', 6, 1, 0, 'CASTE CERTIFICATE', 6, '35815'),
(8, 1, 1, 1, '2016-11-04 22:46:31', 6, 1, 2, 'INCOME CERTIFICATE', 6, '77892');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `address` varchar(800) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `pass` varchar(256) DEFAULT NULL,
  `uidaino` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `address`, `email`, `phone`, `username`, `pass`, `uidaino`) VALUES
(1, 'User 1', 'MADAVAM, 37/362C Karuvissery PO Calicut 10', 'rgautamkrishna@gmail.com', '9446335048', 'user1', 'user1', '789987654123');

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `myevent` ON SCHEDULE EVERY 30 SECOND STARTS '2016-11-04 01:55:30' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE certificates SET test=test+1$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
