-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 05:56 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tactic`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `organizer_ID` int(6) NOT NULL,
  `emailOrg` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `passwordOrg` varchar(255) NOT NULL,
  `isEmailconfirm` tinyint(4) NOT NULL,
  `token` varchar(30) NOT NULL,
  `name_org` varchar(30) CHARACTER SET utf8 NOT NULL,
  `gender_org` varchar(6) CHARACTER SET utf8 NOT NULL,
  `DOB_org` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`organizer_ID`, `emailOrg`, `passwordOrg`, `isEmailconfirm`, `token`, `name_org`, `gender_org`, `DOB_org`) VALUES
(10, 'marwa.salahi.790@gmail.com', '$2y$10$CMagsO/jV5nceOence4xYOP/cyTGvgZ4z8eSe4faCPwgk7Z0w7BXW', 1, '', 'مروة', 'ذكر', '1995-09-29'),
(11, 'hejaziula@gmail.com', '$2y$10$vAMIPbXl3hroz6vDBlV77e40uSIjPU8wZlZg9jx82Y52G4a.zqbFu', 1, 'VQAN0JGRiU', 'ola', 'انثى', '1990-06-12'),
(12, '435204442@student.ksu.edu.sa', '$2y$10$aoMKZMv1G7gxujODepcxl.JQl5lDIzmwESM6hG8AU9bM9n8BqqAAW', 1, 'umEdM!AKfk', 'علا', '', '1997-03-06'),
(13, 'safooo1324@gmail.com', '$2y$10$0G7kQ/RwH6WDSP7aY12RA.bnQ8mkE901W/i0bEUIAzVbyhzAqN1Yi', 0, 'nhBAl>MqpD', 'صفاء', 'ذكر', '1999-03-05'),
(14, 'batolakam@hotmail.com', '$2y$10$Y7FyrNNbP9SkCj4uXXWNjeKyBcMYI1AeMolsod5TXy5nlV0Cntcfe', 1, '', 'batoul', '', '2018-10-10'),
(15, 'batolakam@gmail.com', '$2y$10$ilkIDEqa5tJIo29P0XEmgeEddASHQPakVTrapUWqN1heUSl1rFIYO', 0, '%1ZeC82H#I', 'akkam', 'ذكر', '1985-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `Id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` int(10) NOT NULL,
  `DOB` date DEFAULT NULL,
  `genderId` int(11) DEFAULT NULL,
  `educationalLevelId` int(11) DEFAULT NULL,
  `jobTitle` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `nationalityId` int(11) DEFAULT NULL,
  `nationalId` int(11) DEFAULT NULL,
  `VIPCode` int(11) DEFAULT NULL,
  `optional` varchar(100) CHARACTER SET utf8 NOT NULL,
  `form` varchar(30) NOT NULL,
  `eventId` int(11) NOT NULL,
  `checkInEventAttende` tinyint(1) DEFAULT '0',
  `prizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`Id`, `email`, `name`, `phone`, `DOB`, `genderId`, `educationalLevelId`, `jobTitle`, `nationalityId`, `nationalId`, `VIPCode`, `optional`, `form`, `eventId`, `checkInEventAttende`, `prizeId`) VALUES
(2, 'hejaziula@gmail.com', '2ola', 530843573, '0000-00-00', 2, 6, 'مخرب', 105, 123456789, NULL, '', '', 49, 0, 1),
(3, '435204442@student.ksu.edu.sa', '3ola', 53084573, '2018-10-03', 2, 5, 'مهندسة', 102, 123456789, NULL, '', '', 49, 0, 0),
(4, '435204441@student.ksu.edu.sa', '4ola', 53084573, '1968-10-08', 2, 5, 'دكتور أعصاب', 102, 123456789, NULL, '', '', 49, 0, 0),
(5, '435204443@student.ksu.edu.sa', '5ola', 53084573, '2000-10-04', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(6, '435204444@student.ksu.edu.sa', '6ola', 53084573, '2000-10-05', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(7, '435204445@student.ksu.edu.sa', '7ola', 53084573, '2000-10-06', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(8, '435204421@student.ksu.edu.sa', '8ola', 53084573, '2000-10-07', 2, 5, 'دكتور', 102, 123456789, NULL, '', '', 49, 0, 0),
(9, '435204422@student.ksu.edu.sa', '9ola', 53084573, '2001-10-08', 2, 5, 'دكتور', 102, 123456789, NULL, '', '', 49, 0, 0),
(10, '435204423@student.ksu.edu.sa', '10ola', 53084573, '1995-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(11, '435204424@student.ksu.edu.sa', '11ola', 53084573, '1996-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(12, '435204425@student.ksu.edu.sa', '12ola', 53084573, '1995-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(13, '435204426@student.ksu.edu.sa', '13ola', 53084573, '1999-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 1, 0),
(14, '435204427@student.ksu.edu.sa', '14ola', 53084573, '1998-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 1, 0),
(15, '435204428@student.ksu.edu.sa', '15ola', 53084573, '1994-10-08', 2, 5, 'دكتور', 101, 123456789, NULL, '', '', 49, 1, 0),
(16, '435204429@student.ksu.edu.sa', '16ola', 53084573, '1992-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(17, '435204441@student.ksu.edu.sa', '17ola', 53084573, '1990-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(18, '435204451@student.ksu.edu.sa', '18ola', 53084573, '1990-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(19, '435204452@student.ksu.edu.sa', '19ola', 53084573, '1992-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(20, '435204446@student.ksu.edu.sa', '20ola', 53084573, '1992-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(21, '435204442@student.ksu.edu.sa', '21ola', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(22, '435204447@student.ksu.edu.sa', '22ola', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(23, '435204448@student.ksu.edu.sa', '23ola', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(24, '435204449@student.ksu.edu.sa', '24ola', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(25, '435204412@student.ksu.edu.sa', '25ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(26, '435204413@student.ksu.edu.sa', '26ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(27, '435204414@student.ksu.edu.sa', '27ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(28, '435204415@student.ksu.edu.sa', '28ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(29, '435204416@student.ksu.edu.sa', '29ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(30, '435204417@student.ksu.edu.sa', '30ola', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 117, 123456789, NULL, '', '', 53, 1, 0),
(31, '435204418@student.ksu.edu.sa', '31ola', 53084573, '1983-10-08', 2, 5, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(32, '435204419@student.ksu.edu.sa', '32ola', 53084573, '1983-10-08', 2, 5, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(33, '435204461@student.ksu.edu.sa', '33ola', 53084573, '1983-10-08', 1, 5, 'مهندسة', 102, 123456789, NULL, '', '', 53, 1, 0),
(34, '435204462@student.ksu.edu.sa', '34ola', 53084573, '1983-10-08', 1, 5, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(35, '435204463@student.ksu.edu.sa', '35ola', 53084573, '1984-10-08', 1, 5, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(36, '435204464@student.ksu.edu.sa', '36ola', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(37, '435204465@student.ksu.edu.sa', '37ola', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(38, '435204467@student.ksu.edu.sa', '38ola', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(39, '435204466@student.ksu.edu.sa', '39ola', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(40, '435204468@student.ksu.edu.sa', '40ola', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(41, '435204469@student.ksu.edu.sa', '41ola', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(42, '435204471@student.ksu.edu.sa', '42ola', 53084573, '1987-10-08', 1, 5, 'طبيب جراحة', 119, 123456789, NULL, '', '', 53, 1, 0),
(43, '435204472@student.ksu.edu.sa', '43ola', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 119, 123456789, NULL, '', '', 53, 1, 0),
(44, '435204473@student.ksu.edu.sa', '44ola', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 101, 123456789, NULL, '', '', 53, 1, 0),
(45, '435204474@student.ksu.edu.sa', '45ola', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 101, 123456789, NULL, '', '', 53, 1, 0),
(46, '435204475@student.ksu.edu.sa', '46ola', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(47, '435204476@student.ksu.edu.sa', '47ola', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(48, '435204477@student.ksu.edu.sa', '48ola', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(49, '435204478@student.ksu.edu.sa', '49ola', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(50, '435204479@student.ksu.edu.sa', '50ola', 53084573, '1991-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(51, '435204480@student.ksu.edu.sa', '51ola', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(52, '435204481@student.ksu.edu.sa', '52ola', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(53, '435204482@student.ksu.edu.sa', '53ola', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(54, '435204483@student.ksu.edu.sa', '54ola', 53084573, '1975-10-08', 1, 5, 'دكتور أذنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(55, '435204484@student.ksu.edu.sa', '55ola', 53084573, '1975-10-08', 1, 5, 'دكتور أذنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(56, '435204485@student.ksu.edu.sa', '56ola', 53084573, '1975-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(57, '435204486@student.ksu.edu.sa', '57ola', 53084573, '1975-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(58, '435204487@student.ksu.edu.sa', '58ola', 53084573, '1970-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(59, '435204488@student.ksu.edu.sa', '59ola', 53084573, '1970-10-08', 1, 5, 'دكتور باطنية', 122, 123456789, NULL, '', '', 53, 1, 0),
(60, '435204489@student.ksu.edu.sa', '60ola', 53084573, '1969-10-08', 1, 5, 'دكتور أعصاب', 122, 123456789, NULL, '', '', 53, 1, 0),
(61, '435204491@student.ksu.edu.sa', '61ola', 53084573, '1969-10-08', 1, 5, 'دكتور أعصاب', 122, 123456789, NULL, '', '', 53, 1, 0),
(62, '435204011@student.ksu.edu.sa', '62ola', 53084573, '1990-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(63, '435204012@student.ksu.edu.sa', '63ola', 53084573, '1990-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(64, '435204013@student.ksu.edu.sa', '64ola', 53084573, '1992-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(65, '435204014@student.ksu.edu.sa', '65ola', 53084573, '1992-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(66, '435204015@student.ksu.edu.sa', '66ola', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(67, '435204016@student.ksu.edu.sa', '67ola', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(68, '435204017@student.ksu.edu.sa', '68ola', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(69, '435204018@student.ksu.edu.sa', '69ola', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(70, '435204019@student.ksu.edu.sa', '70ola', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(71, '435204110@student.ksu.edu.sa', '71ola', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(72, '435204111@student.ksu.edu.sa', '72ola', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(73, '435204112@student.ksu.edu.sa', '73ola', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(74, '435204113@student.ksu.edu.sa', '74ola', 53084573, '1985-10-08', 2, 2, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(75, '435204114@student.ksu.edu.sa', '75ola', 53084573, '1985-10-08', 2, 2, 'مهندس ديكور', 117, 123456789, NULL, '', '', 53, 1, 0),
(76, '435204115@student.ksu.edu.sa', '76ola', 53084573, '1983-10-08', 2, 2, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(77, '435204116@student.ksu.edu.sa', '77ola', 53084573, '1983-10-08', 2, 2, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(78, '435204117@student.ksu.edu.sa', '78ola', 53084573, '1983-10-08', 1, 2, 'مهندسة', 102, 123456789, NULL, '', '', 53, 1, 0),
(79, '435204118@student.ksu.edu.sa', '79ola', 53084573, '1983-10-08', 1, 2, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(80, '435204119@student.ksu.edu.sa', '80ola', 53084573, '1984-10-08', 1, 2, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(81, '435204210@student.ksu.edu.sa', '81ola', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(82, '435204211@student.ksu.edu.sa', '82ola', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(83, '435204212@student.ksu.edu.sa', '83ola', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendeewinners`
--

CREATE TABLE `attendeewinners` (
  `Id` int(11) NOT NULL,
  `attendeeId` int(11) NOT NULL,
  `prizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `badge_ID` int(11) NOT NULL,
  `BadgeTypeId` int(11) DEFAULT NULL,
  `event_ID` int(11) NOT NULL,
  `badgeTemplateName` varchar(256) NOT NULL,
  `badgeTemplateSize` int(11) NOT NULL,
  `badgeTemplateType` varchar(256) NOT NULL,
  `badgeTemplateLocation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`badge_ID`, `BadgeTypeId`, `event_ID`, `badgeTemplateName`, `badgeTemplateSize`, `badgeTemplateType`, `badgeTemplateLocation`) VALUES
(5, NULL, 55, 'test', 0, '', ''),
(8, 2, 50, 'ClassDiagramV2.PNG', 48534, 'image/png', 'UploadFile/badges/ClassDiagramV2.PNG'),
(9, 2, 53, 'badges_try.PNG', 71904, 'image/png', 'UploadFile/badges/badges_try.PNG'),
(10, 1, 53, 'badges_badges_ClassDiagramV2 (1) (1).PNG', 48534, 'image/png', 'UploadFile/badges/badges_badges_ClassDiagramV2 (1) (1).PNG');

-- --------------------------------------------------------

--
-- Table structure for table `badgetype`
--

CREATE TABLE `badgetype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `badgetype`
--

INSERT INTO `badgetype` (`Id`, `Name`) VALUES
(1, 'بطاقة الأشخاص العاديين'),
(2, 'بطاقة الشخصيات الهامة');

-- --------------------------------------------------------

--
-- Table structure for table `barcodesize`
--

CREATE TABLE `barcodesize` (
  `ID` int(11) NOT NULL,
  `size` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barcodesize`
--

INSERT INTO `barcodesize` (`ID`, `size`, `name`) VALUES
(1, '50x50', 'صغير جدا'),
(2, '100x100', 'صغير'),
(3, '150x150', 'وسط'),
(4, '200x200', 'كبير'),
(5, '300x300', 'كبير جدا');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificate_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `templateName` varchar(256) NOT NULL,
  `templateSize` int(11) NOT NULL,
  `templateType` varchar(256) NOT NULL,
  `templateLocation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`certificate_ID`, `event_ID`, `templateName`, `templateSize`, `templateType`, `templateLocation`) VALUES
(4, 50, 'ClassDiagramV2.PNG', 48534, 'image/png', 'UploadFile/certificate/ClassDiagramV2.PNG'),
(6, 49, 'ClassDiagramV3.PNG', 52666, 'image/png', 'UploadFile/certificate/ClassDiagramV3.PNG'),
(7, 53, 'badges_badges_ClassDiagramV2 (1) (1).PNG', 48534, 'image/png', 'UploadFile/certificate/badges_badges_ClassDiagramV2 (1) (1).PNG');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `ID` int(11) NOT NULL,
  `value` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`ID`, `value`, `name`) VALUES
(1, 'black', 'اسود'),
(2, 'white', 'ابيض'),
(3, 'red', 'احمر');

-- --------------------------------------------------------

--
-- Table structure for table `educationallevel`
--

CREATE TABLE `educationallevel` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `educationallevel`
--

INSERT INTO `educationallevel` (`Id`, `Name`) VALUES
(1, 'ابتدائي'),
(2, 'متوسط'),
(5, 'ثانوي'),
(6, 'بكالوريوس'),
(9, 'دبلوم'),
(12, 'ماجستير'),
(13, 'دكتوراة');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_ID` int(5) NOT NULL,
  `name_Event` varchar(30) CHARACTER SET utf8 NOT NULL,
  `descrption_Event` varchar(200) CHARACTER SET utf8 NOT NULL,
  `sartDate_Event` date NOT NULL,
  `endDate_Event` date NOT NULL,
  `location_Event` varchar(30) CHARACTER SET utf8 NOT NULL,
  `organization_name_Event` varchar(30) CHARACTER SET utf8 NOT NULL,
  `eventLink` varchar(140) NOT NULL,
  `maxNumOfAttendee` int(11) NOT NULL,
  `organizer_ID` int(11) NOT NULL,
  `VIPCode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_ID`, `name_Event`, `descrption_Event`, `sartDate_Event`, `endDate_Event`, `location_Event`, `organization_name_Event`, `eventLink`, `maxNumOfAttendee`, `organizer_ID`, `VIPCode`) VALUES
(49, 'test manage', 'test manage', '2018-10-11', '2018-10-18', 'test manage', 'test manage', 'http://localhost/tactic2-master/Form.php?token=&rfnjJaKgu', 100, 12, 0),
(50, 'badge', 'bad', '2018-10-03', '2018-10-17', 'bad', 'bad', '', 100, 12, 0),
(53, 'ola', 'desc', '2018-10-13', '2018-10-20', 'حجازي', 'اسم الشركة المنظمة', '', 100, 12, 0),
(55, 'marwa', 'marwa', '2018-10-03', '2018-10-09', 'مروة', '', '', 0, 12, 0),
(57, 'ahmed', 'ahmed', '2018-10-12', '2018-10-26', 'ahmed', 'ahmed', '', 100, 12, 0),
(58, 'ahm', 'de', '2018-10-27', '2018-10-29', 'lo', 'test', '', 100, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fontsize`
--

CREATE TABLE `fontsize` (
  `ID` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fontsize`
--

INSERT INTO `fontsize` (`ID`, `size`) VALUES
(1, 10),
(2, 12),
(3, 14),
(4, 16),
(5, 18),
(6, 20),
(7, 22),
(8, 24),
(9, 26),
(10, 28);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`Id`, `Name`) VALUES
(1, 'ذكر'),
(2, 'أنثى');

-- --------------------------------------------------------

--
-- Table structure for table `imageinfo`
--

CREATE TABLE `imageinfo` (
  `imageId` int(11) NOT NULL,
  `xyposition` varchar(20) NOT NULL,
  `color` varchar(25) NOT NULL,
  `barSize` varchar(20) NOT NULL,
  `fontSize` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `namePosition` varchar(30) NOT NULL,
  `careerPosition` varchar(30) NOT NULL,
  `barcodePosition` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageinfo`
--

INSERT INTO `imageinfo` (`imageId`, `xyposition`, `color`, `barSize`, `fontSize`, `badgeId`) VALUES
(9, 'X228Y65', 'black', '100x100', 10, 15),
(10, 'X228Y65', 'black', '100x100', 10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`Id`, `Name`) VALUES
(101, 'المملكة العربية السعودية'),
(102, 'آروبا'),
(103, 'أذربيجان'),
(104, 'أرمينيا'),
(105, 'أسبانيا'),
(106, 'أستراليا'),
(107, 'ألمانيا'),
(108, 'أنتيجوا وبربودا'),
(109, 'أنجولا'),
(110, 'أنجويلا'),
(111, 'أندورا'),
(112, 'أورجواي'),
(113, 'أوزبكستان'),
(114, 'أوغندا'),
(115, 'أوكرانيا'),
(116, 'أيرلندا'),
(117, 'أيسلندا'),
(118, 'اثيوبيا'),
(119, 'اريتريا'),
(120, 'استونيا'),
(121, 'الأرجنتين'),
(122, 'الأردن'),
(123, 'الاكوادور'),
(124, 'الامارات العربية المتحدة'),
(125, 'الباهاما'),
(126, 'البحرين'),
(127, 'البرازيل'),
(128, 'البرتغال'),
(129, 'البوسنة والهرسك'),
(130, 'الجابون'),
(131, 'الجبل الأسود'),
(132, 'الجزائر'),
(133, 'الدانمارك'),
(134, 'الرأس الأخضر'),
(135, 'السلفادور'),
(136, 'السنغال'),
(137, 'السودان'),
(138, 'السويد'),
(139, 'الصحراء الغربية'),
(140, 'الصومال'),
(141, 'الصين'),
(142, 'العراق'),
(143, 'الفاتيكان'),
(144, 'الفيلبين'),
(145, 'القطب الجنوبي'),
(146, 'الكاميرون'),
(147, 'الكونغو - برازافيل'),
(148, 'الكويت'),
(149, 'المجر'),
(150, 'المحيط الهندي البريطاني'),
(151, 'المغرب'),
(152, 'المقاطعات الجنوبية الفرنسية'),
(153, 'المكسيك'),
(154, 'المملكة المتحدة'),
(155, 'النرويج'),
(156, 'النمسا'),
(157, 'النيجر'),
(158, 'الهند'),
(159, 'الولايات المتحدة الأمريكية'),
(160, 'اليابان'),
(161, 'اليمن'),
(162, 'اليونان'),
(163, 'اندونيسيا'),
(164, 'ايران'),
(165, 'ايطاليا'),
(166, 'بابوا غينيا الجديدة'),
(167, 'باراجواي'),
(168, 'باكستان'),
(169, 'بالاو'),
(170, 'بتسوانا'),
(171, 'بتكايرن'),
(172, 'بربادوس'),
(173, 'برمودا'),
(174, 'بروناي'),
(175, 'بلجيكا'),
(176, 'بلغاريا'),
(177, 'بليز'),
(178, 'بنجلاديش'),
(179, 'بنما'),
(180, 'بنين'),
(181, 'بوتان'),
(182, 'بورتوريكو'),
(183, 'بوركينا فاسو'),
(184, 'بوروندي'),
(185, 'بولندا'),
(186, 'بوليفيا'),
(187, 'بولينيزيا الفرنسية'),
(188, 'بيرو'),
(189, 'تانزانيا'),
(190, 'تايلند'),
(191, 'تايوان'),
(192, 'تركمانستان'),
(193, 'تركيا'),
(194, 'ترينيداد وتوباغو'),
(195, 'تشاد'),
(196, 'توجو'),
(197, 'توفالو'),
(198, 'توكيلو'),
(199, 'تونجا'),
(200, 'تونس'),
(201, 'تيمور الشرقية'),
(202, 'جامايكا'),
(203, 'جبل طارق'),
(204, 'جرينادا'),
(205, 'جرينلاند'),
(206, 'جزر أولان'),
(207, 'جزر الأنتيل الهولندية'),
(208, 'جزر الترك وجايكوس'),
(209, 'جزر القمر'),
(210, 'جزر الكايمن'),
(211, 'جزر المارشال'),
(212, 'جزر الملديف'),
(213, 'جزر الولايات المتحدة البعيدة الصغيرة'),
(214, 'جزر سليمان'),
(215, 'جزر فارو'),
(216, 'جزر فرجين الأمريكية'),
(217, 'جزر فرجين البريطانية'),
(218, 'جزر فوكلاند'),
(219, 'جزر كوك'),
(220, 'جزر كوكوس'),
(221, 'جزر ماريانا الشمالية'),
(222, 'جزر والس وفوتونا'),
(223, 'جزيرة الكريسماس'),
(224, 'جزيرة بوفيه'),
(225, 'جزيرة مان'),
(226, 'جزيرة نورفوك'),
(227, 'جزيرة هيرد وماكدونالد'),
(228, 'جمهورية افريقيا الوسطى'),
(229, 'جمهورية التشيك'),
(230, 'جمهورية الدومينيك'),
(231, 'جمهورية الكونغو الديمقراطية'),
(232, 'جمهورية جنوب افريقيا'),
(233, 'جواتيمالا'),
(234, 'جوادلوب'),
(235, 'جوام'),
(236, 'جورجيا'),
(237, 'جورجيا الجنوبية وجزر ساندويتش الجنوبية'),
(238, 'جيبوتي'),
(239, 'جيرسي'),
(240, 'دومينيكا'),
(241, 'رواندا'),
(242, 'روسيا'),
(243, 'روسيا البيضاء'),
(244, 'رومانيا'),
(245, 'روينيون'),
(246, 'زامبيا'),
(247, 'زيمبابوي'),
(248, 'ساحل العاج'),
(249, 'ساموا'),
(250, 'ساموا الأمريكية'),
(251, 'سان مارينو'),
(252, 'سانت بيير وميكولون'),
(253, 'سانت فنسنت وغرنادين'),
(254, 'سانت كيتس ونيفيس'),
(255, 'سانت لوسيا'),
(256, 'سانت مارتين'),
(257, 'سانت هيلنا'),
(258, 'ساو تومي وبرينسيبي'),
(259, 'سريلانكا'),
(260, 'سفالبارد وجان مايان'),
(261, 'سلوفاكيا'),
(262, 'سلوفينيا'),
(263, 'سنغافورة'),
(264, 'سوازيلاند'),
(265, 'سوريا'),
(266, 'سورينام'),
(267, 'سويسرا'),
(268, 'سيراليون'),
(269, 'سيشل'),
(270, 'شيلي'),
(271, 'صربيا'),
(272, 'صربيا والجبل الأسود'),
(273, 'طاجكستان'),
(274, 'عمان'),
(275, 'غامبيا'),
(276, 'غانا'),
(277, 'غويانا'),
(278, 'غيانا'),
(279, 'غينيا'),
(280, 'غينيا الاستوائية'),
(281, 'غينيا بيساو'),
(282, 'فانواتو'),
(283, 'فرنسا'),
(284, 'فلسطين'),
(285, 'فنزويلا'),
(286, 'فنلندا'),
(287, 'فيتنام'),
(288, 'فيجي'),
(289, 'قبرص'),
(290, 'قرغيزستان'),
(291, 'قطر'),
(292, 'كازاخستان'),
(293, 'كاليدونيا الجديدة'),
(294, 'كرواتيا'),
(295, 'كمبوديا'),
(296, 'كندا'),
(297, 'كوبا'),
(298, 'كوريا الجنوبية'),
(299, 'كوريا الشمالية'),
(300, 'كوستاريكا'),
(301, 'كولومبيا'),
(302, 'كيريباتي'),
(303, 'كينيا'),
(304, 'لاتفيا'),
(305, 'لاوس'),
(306, 'لبنان'),
(307, 'لوكسمبورج'),
(308, 'ليبيا'),
(309, 'ليبيريا'),
(310, 'ليتوانيا'),
(311, 'ليختنشتاين'),
(312, 'ليسوتو'),
(313, 'مارتينيك'),
(314, 'ماكاو الصينية'),
(315, 'مالطا'),
(316, 'مالي'),
(317, 'ماليزيا'),
(318, 'مايوت'),
(319, 'مدغشقر'),
(320, 'مصر'),
(321, 'مقدونيا'),
(322, 'ملاوي'),
(323, 'منطقة غير معرفة'),
(324, 'منغوليا'),
(325, 'موريتانيا'),
(326, 'موريشيوس'),
(327, 'موزمبيق'),
(328, 'مولدافيا'),
(329, 'موناكو'),
(330, 'مونتسرات'),
(331, 'ميانمار'),
(332, 'ميكرونيزيا'),
(333, 'ناميبيا'),
(334, 'نورو'),
(335, 'نيبال'),
(336, 'نيجيريا'),
(337, 'نيكاراجوا'),
(338, 'نيوزيلاندا'),
(339, 'نيوي'),
(340, 'هايتي'),
(341, 'هندوراس'),
(342, 'هولندا'),
(343, 'هونج كونج الصينية');

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE `prize` (
  `Prize_ID` int(11) NOT NULL,
  `namePrize` varchar(100) NOT NULL,
  `numOfPrize` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `subevent_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prize`
--

INSERT INTO `prize` (`Prize_ID`, `namePrize`, `numOfPrize`, `event_ID`, `subevent_ID`) VALUES
(49, 'test1000', 6, 53, 0),
(50, 'test2', 6, 53, 0),
(51, 'test8', 5, 53, 11);

-- --------------------------------------------------------

--
-- Table structure for table `qr`
--

CREATE TABLE `qr` (
  `badge_ID` int(11) NOT NULL,
  `QR_code` int(11) NOT NULL,
  `Attendee_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_ID` int(11) NOT NULL,
  `rateValue` tinyint(1) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `subevent_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration_form`
--

CREATE TABLE `registration_form` (
  `form_ID` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `name_of_field` varchar(25) NOT NULL,
  `selected_field` tinyint(1) NOT NULL DEFAULT '1',
  `required_field` tinyint(1) NOT NULL DEFAULT '1',
  `optional` tinyint(1) NOT NULL DEFAULT '0',
  `event_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_form`
--

INSERT INTO `registration_form` (`form_ID`, `token`, `name_of_field`, `selected_field`, `required_field`, `optional`, `event_ID`) VALUES
(1, '', '?????', 1, 1, 0, 49),
(2, '', '???????', 1, 1, 0, 49),
(3, '', '??????', 1, 0, 0, 49),
(4, '', '?????', 1, 0, 0, 49),
(5, '', '??????', 1, 0, 0, 49),
(6, '', '??????', 1, 0, 0, 49);

-- --------------------------------------------------------

--
-- Table structure for table `subevent`
--

CREATE TABLE `subevent` (
  `subevent_ID` int(6) NOT NULL,
  `event_ID` int(5) NOT NULL,
  `nameSubEvent` varchar(30) CHARACTER SET utf8 NOT NULL,
  `description_subevent` varchar(150) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subevent`
--

INSERT INTO `subevent` (`subevent_ID`, `event_ID`, `nameSubEvent`, `description_subevent`) VALUES
(11, 53, 'olaSub', 'des');

-- --------------------------------------------------------

--
-- Table structure for table `subeventattendee`
--

CREATE TABLE `subeventattendee` (
  `Id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `subeventId` int(11) NOT NULL,
  `checkInSubeventAttende` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`organizer_ID`);

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `attendee_ibfk_3` (`prizeId`),
  ADD KEY `attendee_ibfk_4` (`eventId`),
  ADD KEY `fk_genderId` (`genderId`),
  ADD KEY `fk_nationalityId` (`nationalityId`),
  ADD KEY `fk_educationalLevelId` (`educationalLevelId`);

--
-- Indexes for table `attendeewinners`
--
ALTER TABLE `attendeewinners`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_attendee` (`attendeeId`),
  ADD KEY `fk_prize` (`prizeId`);

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`badge_ID`),
  ADD KEY `badge_ibfk_1` (`event_ID`);

--
-- Indexes for table `badgetype`
--
ALTER TABLE `badgetype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `barcodesize`
--
ALTER TABLE `barcodesize`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_ID`),
  ADD KEY `certificate_ibfk_1` (`event_ID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `educationallevel`
--
ALTER TABLE `educationallevel`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `organizer_ID` (`organizer_ID`);

--
-- Indexes for table `fontsize`
--
ALTER TABLE `fontsize`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `imageinfo`
--
ALTER TABLE `imageinfo`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `badge_ID` (`badgeId`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prize`
--
ALTER TABLE `prize`
  ADD PRIMARY KEY (`Prize_ID`),
  ADD KEY `prize_ibfk_1` (`event_ID`),
  ADD KEY `subevent_ID` (`subevent_ID`);

--
-- Indexes for table `qr`
--
ALTER TABLE `qr`
  ADD PRIMARY KEY (`badge_ID`,`QR_code`),
  ADD KEY `qr_ibfk_1` (`Attendee_ID`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_ID`),
  ADD KEY `rate_ibfk_1` (`event_ID`),
  ADD KEY `rate_ibfk_2` (`subevent_ID`);

--
-- Indexes for table `registration_form`
--
ALTER TABLE `registration_form`
  ADD PRIMARY KEY (`form_ID`),
  ADD KEY `registration_form_ibfk_1` (`event_ID`);

--
-- Indexes for table `subevent`
--
ALTER TABLE `subevent`
  ADD PRIMARY KEY (`subevent_ID`,`event_ID`),
  ADD KEY `event_ID` (`event_ID`);

--
-- Indexes for table `subeventattendee`
--
ALTER TABLE `subeventattendee`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_event` (`eventId`),
  ADD KEY `fk_subevent` (`subeventId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `organizer_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `attendeewinners`
--
ALTER TABLE `attendeewinners`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `badge_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `badgetype`
--
ALTER TABLE `badgetype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barcodesize`
--
ALTER TABLE `barcodesize`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `educationallevel`
--
ALTER TABLE `educationallevel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `fontsize`
--
ALTER TABLE `fontsize`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imageinfo`
--
ALTER TABLE `imageinfo`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `Prize_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_form`
--
ALTER TABLE `registration_form`
  MODIFY `form_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subevent`
--
ALTER TABLE `subevent`
  MODIFY `subevent_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subeventattendee`
--
ALTER TABLE `subeventattendee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendee`
--
ALTER TABLE `attendee`
  ADD CONSTRAINT `attendee_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_educationalLevelId` FOREIGN KEY (`educationalLevelId`) REFERENCES `educationallevel` (`Id`),
  ADD CONSTRAINT `fk_genderId` FOREIGN KEY (`genderId`) REFERENCES `gender` (`Id`),
  ADD CONSTRAINT `fk_nationalityId` FOREIGN KEY (`nationalityId`) REFERENCES `nationality` (`Id`);

--
-- Constraints for table `attendeewinners`
--
ALTER TABLE `attendeewinners`
  ADD CONSTRAINT `fk_attendee` FOREIGN KEY (`attendeeId`) REFERENCES `attendee` (`Id`),
  ADD CONSTRAINT `fk_prize` FOREIGN KEY (`prizeId`) REFERENCES `prize` (`Prize_ID`);

--
-- Constraints for table `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `badge_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`organizer_ID`) REFERENCES `account` (`organizer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prize`
--
ALTER TABLE `prize`
  ADD CONSTRAINT `prize_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qr`
--
ALTER TABLE `qr`
  ADD CONSTRAINT `qr_ibfk_1` FOREIGN KEY (`Attendee_ID`) REFERENCES `attendee` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_ibfk_2` FOREIGN KEY (`subevent_ID`) REFERENCES `subevent` (`subevent_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registration_form`
--
ALTER TABLE `registration_form`
  ADD CONSTRAINT `registration_form_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subevent`
--
ALTER TABLE `subevent`
  ADD CONSTRAINT `subevent_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subeventattendee`
--
ALTER TABLE `subeventattendee`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`eventId`) REFERENCES `event` (`event_ID`),
  ADD CONSTRAINT `fk_subevent` FOREIGN KEY (`subeventId`) REFERENCES `subevent` (`subevent_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
