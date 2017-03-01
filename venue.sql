-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2017 at 03:35 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `venue`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `Booking_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Booking_VenueID` int(11) NOT NULL,
  `Booking_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Booking_From` datetime NOT NULL,
  `Booking_To` datetime NOT NULL,
  `Booking_Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Booking_Phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Booking_Active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Booking_ID`),
  KEY `FK_BOOKING_VENUE` (`Booking_VenueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `Booking_VenueID`, `Booking_Name`, `Booking_From`, `Booking_To`, `Booking_Email`, `Booking_Phone`, `Booking_Active`) VALUES
(1, 5, 'my name', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'malloboany1@gmail.com', '984524865489', '1'),
(2, 20, 'Mohammed', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'jojo@hotmail.com', '0963123456789', '1'),
(3, 5, 'efefe', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'malloboany1@gmail.com', '9632486', '1');

-- --------------------------------------------------------

--
-- Table structure for table `booking_req`
--

CREATE TABLE IF NOT EXISTS `booking_req` (
  `Booking_Req_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Booking_Req_BookingID` int(11) NOT NULL,
  `Booking_Req_Time` datetime DEFAULT NULL,
  PRIMARY KEY (`Booking_Req_ID`),
  KEY `FK_BOOKING_REQ_BOOKING` (`Booking_Req_BookingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `create_req`
--

CREATE TABLE IF NOT EXISTS `create_req` (
  `Create_Req_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Create_Req_VenueID` int(11) NOT NULL,
  `Create_Req_Time` datetime DEFAULT NULL,
  PRIMARY KEY (`Create_Req_ID`),
  KEY `FK_CREATE_REQ_VENUE` (`Create_Req_VenueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `Email_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email_Receiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email_Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Email_Time` datetime NOT NULL,
  PRIMARY KEY (`Email_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`Email_ID`, `Email_Receiver`, `Email_Content`, `Email_Time`) VALUES
(1, 'malloboany1@gmail.com', 'Your Booking have been accepted successfully in Wizme.com \n Thank you for your choice.', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kind`
--

CREATE TABLE IF NOT EXISTS `kind` (
  `Kind_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Kind_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Kind_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kind`
--

INSERT INTO `kind` (`Kind_ID`, `Kind_Name`) VALUES
(1, 'offices'),
(2, 'hotels');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `Message_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Message_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message_Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Message_Content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Message_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Message_ID`, `Message_Name`, `Message_Email`, `Message_Content`) VALUES
(1, 'name', 'madfdfsdfsdf', 'mes');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `Rule_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Rule_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Rule_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`Rule_ID`, `Rule_Name`) VALUES
(1, 'ADMIN'),
(2, 'VENUE_MANAGER');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_Rule` int(11) NOT NULL,
  `User_Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `User_Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  KEY `FK_USER_RULE` (`User_Rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `User_Name`, `User_Rule`, `User_Password`, `User_Email`) VALUES
(1, 'Admin', 1, 'abd614f501d2964c312253902703e7d4e79d77cc', 'malloboany1@gmail.com'),
(2, 'First', 2, 'abd614f501d2964c312253902703e7d4e79d77cc', 'fffffff@gmail.co');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `Venue_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Venue_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Venue_Kind` int(11) NOT NULL,
  `Venue_Price` float DEFAULT NULL,
  `Venue_Manager` int(11) NOT NULL,
  `Venue_Address` text COLLATE utf8_unicode_ci NOT NULL,
  `Venue_Phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Venue_Active` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Venue_ID`),
  KEY `FK_VENUE_USER` (`Venue_Manager`),
  KEY `FK_VENUE_KIND` (`Venue_Kind`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`Venue_ID`, `Venue_Name`, `Venue_Kind`, `Venue_Price`, `Venue_Manager`, `Venue_Address`, `Venue_Phone`, `Venue_Active`) VALUES
(5, 'trial 2', 2, 6000, 1, 'Address 2', '096325564789', '1'),
(20, 'First Venue', 1, 6000, 2, 'Address for first Venues', '096321456987', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_BOOKING_VENUE` FOREIGN KEY (`Booking_VenueID`) REFERENCES `venue` (`Venue_ID`);

--
-- Constraints for table `booking_req`
--
ALTER TABLE `booking_req`
  ADD CONSTRAINT `FK_BOOKING_REQ_BOOKING` FOREIGN KEY (`Booking_Req_BookingID`) REFERENCES `booking` (`Booking_ID`);

--
-- Constraints for table `create_req`
--
ALTER TABLE `create_req`
  ADD CONSTRAINT `FK_CREATE_REQ_VENUE` FOREIGN KEY (`Create_Req_VenueID`) REFERENCES `venue` (`Venue_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_RULE` FOREIGN KEY (`User_Rule`) REFERENCES `rule` (`Rule_ID`);

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `FK_VENUE_KIND` FOREIGN KEY (`Venue_Kind`) REFERENCES `kind` (`Kind_ID`),
  ADD CONSTRAINT `FK_VENUE_USER` FOREIGN KEY (`Venue_Manager`) REFERENCES `user` (`User_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
