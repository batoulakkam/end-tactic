-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2018 at 10:08 PM
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
(2, 'hejaziula@gmail.com', '2ola Adeeb Hejazi Albash', 530843573, '0000-00-00', 2, 6, 'مخرب', 105, 123456789, NULL, '', '', 49, 0, 1),
(3, '435204442@student.ksu.edu.sa', '3ola Adeeb Hejazi Albash', 53084573, '2018-10-03', 2, 5, 'مهندسة', 102, 123456789, NULL, '', '', 49, 0, 0),
(4, '435204441@student.ksu.edu.sa', '4ola Adeeb Hejazi Albash', 53084573, '1968-10-08', 2, 5, 'دكتور أعصاب', 102, 123456789, NULL, '', '', 49, 0, 0),
(5, '435204443@student.ksu.edu.sa', '5ola Adeeb Hejazi Albash', 53084573, '2000-10-04', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(6, '435204444@student.ksu.edu.sa', '6ola Adeeb Hejazi Albash', 53084573, '2000-10-05', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(7, '435204445@student.ksu.edu.sa', '7ola Adeeb Hejazi Albash', 53084573, '2000-10-06', 2, 5, 'مساعد', 102, 123456789, NULL, '', '', 49, 0, 0),
(8, '435204421@student.ksu.edu.sa', '8ola Adeeb Hejazi Albash', 53084573, '2000-10-07', 2, 5, 'دكتور', 102, 123456789, NULL, '', '', 49, 0, 0),
(9, '435204422@student.ksu.edu.sa', '9ola Adeeb Hejazi Albash', 53084573, '2001-10-08', 2, 5, 'دكتور', 102, 123456789, NULL, '', '', 49, 0, 0),
(10, '435204423@student.ksu.edu.sa', '10ola Adeeb Hejazi Albash', 53084573, '1995-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(11, '435204424@student.ksu.edu.sa', '11ola Adeeb Hejazi Albash', 53084573, '1996-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(12, '435204425@student.ksu.edu.sa', '12ola Adeeb Hejazi Albash', 53084573, '1995-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 0, 0),
(13, '435204426@student.ksu.edu.sa', '13ola Adeeb Hejazi Albash', 53084573, '1999-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 1, 0),
(14, '435204427@student.ksu.edu.sa', '14ola Adeeb Hejazi Albash', 53084573, '1998-10-08', 2, 5, 'دكتور', 110, 123456789, NULL, '', '', 49, 1, 0),
(15, '435204428@student.ksu.edu.sa', '15ola Adeeb Hejazi Albash', 53084573, '1994-10-08', 2, 5, 'دكتور', 101, 123456789, NULL, '', '', 49, 1, 0),
(16, '435204429@student.ksu.edu.sa', '16ola Adeeb Hejazi Albash', 53084573, '1992-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(17, '435204441@student.ksu.edu.sa', '17ola Adeeb Hejazi Albash', 53084573, '1990-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(18, '435204451@student.ksu.edu.sa', '18ola Adeeb Hejazi Albash', 53084573, '1990-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(19, '435204452@student.ksu.edu.sa', '19ola Adeeb Hejazi Albash', 53084573, '1992-10-08', 2, 5, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 49, 1, 0),
(20, '435204446@student.ksu.edu.sa', '20ola Adeeb Hejazi Albash', 53084573, '1992-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(21, '435204442@student.ksu.edu.sa', '21ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(22, '435204447@student.ksu.edu.sa', '22ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(23, '435204448@student.ksu.edu.sa', '23ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(24, '435204449@student.ksu.edu.sa', '24ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 5, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(25, '435204412@student.ksu.edu.sa', '25ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(26, '435204413@student.ksu.edu.sa', '26ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(27, '435204414@student.ksu.edu.sa', '27ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(28, '435204415@student.ksu.edu.sa', '28ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(29, '435204416@student.ksu.edu.sa', '29ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(30, '435204417@student.ksu.edu.sa', '30ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 5, 'مهندس ديكور', 117, 123456789, NULL, '', '', 53, 1, 0),
(31, '435204418@student.ksu.edu.sa', '31ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 2, 5, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(32, '435204419@student.ksu.edu.sa', '32ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 2, 5, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(33, '435204461@student.ksu.edu.sa', '33ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 1, 5, 'مهندسة', 102, 123456789, NULL, '', '', 53, 1, 0),
(34, '435204462@student.ksu.edu.sa', '34ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 1, 5, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(35, '435204463@student.ksu.edu.sa', '35ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 5, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(36, '435204464@student.ksu.edu.sa', '36ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(37, '435204465@student.ksu.edu.sa', '37ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(38, '435204467@student.ksu.edu.sa', '38ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 5, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(39, '435204466@student.ksu.edu.sa', '39ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(40, '435204468@student.ksu.edu.sa', '40ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(41, '435204469@student.ksu.edu.sa', '41ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 1, 5, 'مهندس ميداني', 119, 123456789, NULL, '', '', 53, 1, 0),
(42, '435204471@student.ksu.edu.sa', '42ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 1, 5, 'طبيب جراحة', 119, 123456789, NULL, '', '', 53, 1, 0),
(43, '435204472@student.ksu.edu.sa', '43ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 119, 123456789, NULL, '', '', 53, 1, 0),
(44, '435204473@student.ksu.edu.sa', '44ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 101, 123456789, NULL, '', '', 53, 1, 0),
(45, '435204474@student.ksu.edu.sa', '45ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'طبيب جراحة', 101, 123456789, NULL, '', '', 53, 1, 0),
(46, '435204475@student.ksu.edu.sa', '46ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(47, '435204476@student.ksu.edu.sa', '47ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(48, '435204477@student.ksu.edu.sa', '48ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(49, '435204478@student.ksu.edu.sa', '49ola Adeeb Hejazi Albash', 53084573, '1989-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(50, '435204479@student.ksu.edu.sa', '50ola Adeeb Hejazi Albash', 53084573, '1991-10-08', 1, 5, 'دكتور عينية', 101, 123456789, NULL, '', '', 53, 1, 0),
(51, '435204480@student.ksu.edu.sa', '51ola Adeeb Hejazi Albash', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(52, '435204481@student.ksu.edu.sa', '52ola Adeeb Hejazi Albash', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(53, '435204482@student.ksu.edu.sa', '53ola Adeeb Hejazi Albash', 53084573, '1991-10-08', 1, 5, 'دكتور أذنية', 101, 123456789, NULL, '', '', 53, 1, 0),
(54, '435204483@student.ksu.edu.sa', '54ola Adeeb Hejazi Albash', 53084573, '1975-10-08', 1, 5, 'دكتور أذنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(55, '435204484@student.ksu.edu.sa', '55ola Adeeb Hejazi Albash', 53084573, '1975-10-08', 1, 5, 'دكتور أذنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(56, '435204485@student.ksu.edu.sa', '56ola Adeeb Hejazi Albash', 53084573, '1975-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(57, '435204486@student.ksu.edu.sa', '57ola Adeeb Hejazi Albash', 53084573, '1975-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(58, '435204487@student.ksu.edu.sa', '58ola Adeeb Hejazi Albash', 53084573, '1970-10-08', 1, 5, 'دكتور باطنية', 121, 123456789, NULL, '', '', 53, 1, 0),
(59, '435204488@student.ksu.edu.sa', '59ola Adeeb Hejazi Albash', 53084573, '1970-10-08', 1, 5, 'دكتور باطنية', 122, 123456789, NULL, '', '', 53, 1, 0),
(60, '435204489@student.ksu.edu.sa', '60ola Adeeb Hejazi Albash', 53084573, '1969-10-08', 1, 5, 'دكتور أعصاب', 122, 123456789, NULL, '', '', 53, 1, 0),
(61, '435204491@student.ksu.edu.sa', '61ola Adeeb Hejazi Albash', 53084573, '1969-10-08', 1, 5, 'دكتور أعصاب', 122, 123456789, NULL, '', '', 53, 1, 0),
(62, '435204011@student.ksu.edu.sa', '62ola Adeeb Hejazi Albash', 53084573, '1990-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(63, '435204012@student.ksu.edu.sa', '63ola Adeeb Hejazi Albash', 53084573, '1990-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(64, '435204013@student.ksu.edu.sa', '64ola Adeeb Hejazi Albash', 53084573, '1992-10-08', 2, 1, 'أستاذ جامعي', 101, 123456789, NULL, '', '', 53, 1, 0),
(65, '435204014@student.ksu.edu.sa', '65ola Adeeb Hejazi Albash', 53084573, '1992-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(66, '435204015@student.ksu.edu.sa', '66ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(67, '435204016@student.ksu.edu.sa', '67ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(68, '435204017@student.ksu.edu.sa', '68ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(69, '435204018@student.ksu.edu.sa', '69ola Adeeb Hejazi Albash', 53084573, '1987-10-08', 2, 1, 'مهندس معمار', 101, 123456789, NULL, '', '', 53, 1, 0),
(70, '435204019@student.ksu.edu.sa', '70ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(71, '435204110@student.ksu.edu.sa', '71ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(72, '435204111@student.ksu.edu.sa', '72ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(73, '435204112@student.ksu.edu.sa', '73ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 1, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(74, '435204113@student.ksu.edu.sa', '74ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 2, 'مهندس ديكور', 116, 123456789, NULL, '', '', 53, 1, 0),
(75, '435204114@student.ksu.edu.sa', '75ola Adeeb Hejazi Albash', 53084573, '1985-10-08', 2, 2, 'مهندس ديكور', 117, 123456789, NULL, '', '', 53, 1, 0),
(76, '435204115@student.ksu.edu.sa', '76ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 2, 2, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(77, '435204116@student.ksu.edu.sa', '77ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 2, 2, 'مهندسة', 117, 123456789, NULL, '', '', 53, 1, 0),
(78, '435204117@student.ksu.edu.sa', '78ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 1, 2, 'مهندسة', 102, 123456789, NULL, '', '', 53, 1, 0),
(79, '435204118@student.ksu.edu.sa', '79ola Adeeb Hejazi Albash', 53084573, '1983-10-08', 1, 2, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(80, '435204119@student.ksu.edu.sa', '80ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 2, 'مهندسة', 118, 123456789, NULL, '', '', 53, 1, 0),
(81, '435204210@student.ksu.edu.sa', '81ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(82, '435204211@student.ksu.edu.sa', '82ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0),
(83, '435204212@student.ksu.edu.sa', '83ola Adeeb Hejazi Albash', 53084573, '1984-10-08', 1, 2, 'مهندس ميداني', 118, 123456789, NULL, '', '', 53, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendeewinners`
--

CREATE TABLE `attendeewinners` (
  `Id` int(11) NOT NULL,
  `attendeeId` int(11) NOT NULL,
  `prizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendeewinners`
--

INSERT INTO `attendeewinners` (`Id`, `attendeeId`, `prizeId`) VALUES
(100, 29, 49),
(101, 30, 49),
(102, 41, 49),
(103, 42, 49),
(104, 55, 49),
(105, 60, 49),
(116, 28, 51),
(117, 35, 51),
(118, 52, 51),
(119, 55, 51),
(120, 81, 51);

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
(8, 2, 50, 'ClassDiagramV2.PNG', 48534, 'image/png', 'UploadFile/badges/ClassDiagramV2.PNG'),
(9, 2, 53, 'badges_try.PNG', 71904, 'image/png', 'UploadFile/badges/badges_try.PNG');

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
(6, 49, 'ClassDiagramV3.PNG', 52666, 'image/png', 'UploadFile/certificate/ClassDiagramV3.PNG'),
(7, 53, 'badges_badges_ClassDiagramV2 (1) (1).PNG', 48534, 'image/png', 'UploadFile/certificate/badges_badges_ClassDiagramV2 (1) (1).PNG'),
(8, 57, 'certificate.jpg', 771823, 'image/jpeg', 'certificate.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `certificateimageinfo`
--

CREATE TABLE `certificateimageinfo` (
  `Id` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `fontSize` int(11) NOT NULL,
  `certificateId` int(11) NOT NULL,
  `eventnameposition` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `visitornameposition` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `eventdateposition` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imageposition` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `templateName` varchar(256) NOT NULL,
  `templateSize` int(11) NOT NULL,
  `templateType` varchar(256) NOT NULL,
  `templateLocation` varchar(256) NOT NULL,
  `organizer_ID` int(11) NOT NULL,
  `VIPCode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_ID`, `name_Event`, `descrption_Event`, `sartDate_Event`, `endDate_Event`, `location_Event`, `organization_name_Event`, `eventLink`, `maxNumOfAttendee`, `templateName`, `templateSize`, `templateType`, `templateLocation`, `organizer_ID`, `VIPCode`) VALUES
(49, 'test manage', 'test manage', '2018-10-11', '2018-10-18', 'test manage', 'test manage', 'http://localhost/tactic2-master/Form.php?token=&rfnjJaKgu', 100, '', 0, '', '', 12, 0),
(50, 'badge', 'bad', '2018-10-03', '2018-10-17', 'bad', 'bad', 'http://localhost/tactic/Form.php?token=MrsBCoqSA6', 100, '', 0, '', '', 12, 0),
(53, 'ola', 'desc', '2018-10-13', '2018-10-20', 'حجازي', 'اسم الشركة المنظمة', '', 100, '', 0, '', '', 12, 0),
(55, 'marwa', 'marwa', '2018-10-03', '2018-10-09', 'مروة', '', '', 0, '', 0, '', '', 12, 0),
(57, 'ahmed', 'ahmed', '2018-10-12', '2018-10-26', 'ahmed', 'ahmed', '', 100, '', 0, '', '', 12, 0),
(58, 'test batoul', 'test', '2018-11-15', '2018-11-23', 'test', 'test', '', 100, '', 0, '', '', 12, 0);

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
  `color` varchar(25) NOT NULL,
  `barSize` varchar(20) NOT NULL,
  `fontSize` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `namePosition` varchar(30) NOT NULL,
  `careerPosition` varchar(30) NOT NULL,
  `barcodePosition` varchar(30) NOT NULL,
  `imgPosition` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageinfo`
--

INSERT INTO `imageinfo` (`imageId`, `color`, `barSize`, `fontSize`, `badgeId`, `namePosition`, `careerPosition`, `barcodePosition`, `imgPosition`) VALUES
(9, 'black', '100x100', 10, 15, 'X228Y65', '', '', ''),
(10, 'black', '100x100', 10, 16, 'X228Y65', '', '', ''),
(11, 'red', '50x50', 10, 10, 'X96.375Y217 ', 'X140.671875Y122', 'X26.25Y87', 'X503.171875Y627'),
(12, 'red', '50x50', 12, 11, 'X101.9375Y125 ', 'X139.796875Y205', 'X34.3125Y211', 'X503.171875Y632'),
(13, 'red', '50x50', 10, 12, 'X109.046875Y65 ', 'X87.765625Y176', 'X76.3125Y234', 'X503.171875Y627');

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
(51, 'test8', 5, 53, 11),
(52, 'prize6', 7, 49, 0);

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
  `subevent_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_ID`, `rateValue`, `event_ID`, `subevent_ID`) VALUES
(2, 1, 49, NULL),
(3, 1, 50, NULL),
(4, 1, 53, 11),
(5, 1, 55, NULL),
(6, 1, 57, NULL),
(7, 1, 58, NULL),
(10, 2, 49, NULL),
(11, 2, 50, NULL),
(12, 2, 53, 11),
(13, 2, 55, NULL),
(14, 2, 57, NULL),
(15, 2, 58, NULL),
(17, 3, 49, NULL),
(18, 3, 50, NULL),
(20, 3, 55, NULL),
(21, 3, 57, NULL),
(22, 3, 58, NULL),
(24, 4, 49, NULL),
(25, 4, 50, NULL),
(26, 4, 53, 11),
(27, 4, 55, NULL),
(28, 4, 57, NULL),
(29, 4, 58, NULL),
(31, 5, 49, NULL),
(32, 5, 50, NULL),
(33, 5, 53, 11),
(34, 5, 55, NULL),
(35, 5, 57, NULL),
(36, 5, 58, NULL),
(38, 5, 53, NULL),
(39, 5, 53, NULL),
(40, 5, 53, NULL),
(41, 5, 53, NULL),
(42, 2, 53, NULL),
(43, 2, 53, NULL),
(44, 2, 53, NULL),
(45, 2, 53, NULL),
(46, 3, 53, NULL),
(47, 3, 53, NULL),
(48, 3, 53, NULL),
(49, 3, 53, NULL),
(50, 3, 53, NULL),
(51, 4, 53, NULL),
(52, 4, 53, NULL),
(53, 4, 53, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratingvalue`
--

CREATE TABLE `ratingvalue` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratingvalue`
--

INSERT INTO `ratingvalue` (`Id`, `Name`) VALUES
(1, 'سيء جدا'),
(2, 'سيء'),
(3, 'جيد'),
(4, 'جيد جداٌ'),
(5, 'ممتاز');

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
(6, '', '??????', 1, 0, 0, 49),
(7, 'MrsBCoqSA6', '?????', 1, 1, 0, 50),
(8, 'MrsBCoqSA6', '???????', 1, 1, 0, 50),
(9, 'MrsBCoqSA6', '?????', 1, 1, 0, 50),
(10, 'MrsBCoqSA6', '???????', 1, 1, 0, 50),
(11, 'MrsBCoqSA6', '?????', 1, 1, 0, 50),
(12, 'MrsBCoqSA6', '???????', 1, 1, 0, 50),
(13, 'MrsBCoqSA6', '?????', 1, 1, 0, 50),
(14, 'MrsBCoqSA6', '???????', 1, 1, 0, 50);

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
  `attendeeId` int(11) DEFAULT NULL,
  `subEventId` int(11) NOT NULL,
  `checkInSubeventAttende` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subeventattendee`
--

INSERT INTO `subeventattendee` (`Id`, `attendeeId`, `subEventId`, `checkInSubeventAttende`) VALUES
(1, 64, 11, 1),
(2, 62, 11, 1),
(3, 63, 11, 1),
(4, 64, 11, 0),
(5, 20, 11, 1),
(6, 21, 11, 1),
(7, 22, 11, 1),
(8, 23, 11, 1),
(9, 24, 11, 1),
(10, 25, 11, 1),
(11, 26, 11, 1),
(12, 27, 11, 1),
(13, 28, 11, 1),
(14, 29, 11, 1),
(20, 31, 11, 1),
(21, 32, 11, 1),
(22, 33, 11, 1),
(23, 34, 11, 1),
(24, 35, 11, 1),
(25, 36, 11, 1),
(26, 37, 11, 1),
(27, 38, 11, 1),
(28, 39, 11, 1),
(29, 40, 11, 1),
(30, 41, 11, 1),
(31, 42, 11, 1),
(32, 43, 11, 1),
(33, 44, 11, 1),
(34, 45, 11, 1),
(35, 46, 11, 1),
(36, 47, 11, 1),
(37, 48, 11, 1),
(38, 49, 11, 1);

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
-- Indexes for table `certificateimageinfo`
--
ALTER TABLE `certificateimageinfo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_certificateId` (`certificateId`),
  ADD KEY `fk_color` (`color`),
  ADD KEY `fk_fontSize` (`fontSize`);

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
-- Indexes for table `ratingvalue`
--
ALTER TABLE `ratingvalue`
  ADD PRIMARY KEY (`Id`);

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
  ADD KEY `fk_attendeeSub` (`attendeeId`),
  ADD KEY `fk_subevent` (`subEventId`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `badge_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `certificate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `certificateimageinfo`
--
ALTER TABLE `certificateimageinfo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `Prize_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `ratingvalue`
--
ALTER TABLE `ratingvalue`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registration_form`
--
ALTER TABLE `registration_form`
  MODIFY `form_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subevent`
--
ALTER TABLE `subevent`
  MODIFY `subevent_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subeventattendee`
--
ALTER TABLE `subeventattendee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Constraints for table `certificateimageinfo`
--
ALTER TABLE `certificateimageinfo`
  ADD CONSTRAINT `fk_certificateId` FOREIGN KEY (`certificateId`) REFERENCES `certificate` (`certificate_ID`),
  ADD CONSTRAINT `fk_color` FOREIGN KEY (`color`) REFERENCES `color` (`ID`),
  ADD CONSTRAINT `fk_fontSize` FOREIGN KEY (`fontSize`) REFERENCES `fontsize` (`ID`);

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
  ADD CONSTRAINT `fk_attendeeSub` FOREIGN KEY (`attendeeId`) REFERENCES `attendee` (`Id`),
  ADD CONSTRAINT `fk_subevent` FOREIGN KEY (`subEventId`) REFERENCES `subevent` (`subevent_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
