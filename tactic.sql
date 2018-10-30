-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2018 at 08:22 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

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
(10, 1, 53, 'badges_badges_ClassDiagramV2 (1) (1).PNG', 48534, 'image/png', 'UploadFile/badges/badges_badges_ClassDiagramV2 (1) (1).PNG'),
(15, 1, 49, 'text_to_image.jpg', 17371, 'image/jpeg', 'UploadFile/badges/491text_to_image.jpg'),
(16, 2, 58, '245px-Linum_usitatissimum_-_Köhler–s_Medizinal-Pflanzen-088.jpg', 23626, 'image/jpeg', 'UploadFile/badges/582245px-Linum_usitatissimum_-_Köhler–s_Medizinal-Pflanzen-088.jpg');

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
-- Table structure for table `checkinsub`
--

CREATE TABLE `checkinsub` (
  `Attendee_ID` int(11) NOT NULL,
  `subevent_ID` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(49, 'test manage', 'test manage', '2018-10-11', '2018-10-18', 'test manage', 'test manage', 'http://localhost/tactic2-master/Form.php?token=&rfnjJaKgu', 100, 11, 0),
(50, 'badge', 'bad', '2018-10-03', '2018-10-17', 'bad', 'bad', '', 100, 11, 0),
(53, 'ola', 'desc', '2018-10-13', '2018-10-20', 'حجازي', 'اسم الشركة المنظمة', '', 100, 12, 0),
(55, 'marwa', 'marwa', '2018-10-03', '2018-10-09', 'مروة', '', '', 0, 10, 0),
(57, 'ahmed', 'ahmed', '2018-10-12', '2018-10-26', 'ahmed', 'ahmed', '', 100, 11, 0),
(58, 'تجربة بتول', 'ثقفغعهخح', '2018-10-27', '2018-10-31', 'الرياض', 'الرفاعي', '', 100, 14, 0);

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
(0, 26),
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
-- Table structure for table `imageinfo`
--

CREATE TABLE `imageinfo` (
  `image_ID` int(11) NOT NULL,
  `x_yposition` varchar(20) NOT NULL,
  `color` varchar(25) NOT NULL,
  `barSize` varchar(20) NOT NULL,
  `fontSize` int(11) NOT NULL,
  `badge_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageinfo`
--

INSERT INTO `imageinfo` (`image_ID`, `x_yposition`, `color`, `barSize`, `fontSize`, `badge_ID`) VALUES
(9, 'X228Y65', 'black', '100x100', 10, 15),
(10, 'X228Y65', 'black', '100x100', 10, 16);

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
(37, 'OLA', 2, 53, 11);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`organizer_ID`);

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
-- Indexes for table `checkinsub`
--
ALTER TABLE `checkinsub`
  ADD PRIMARY KEY (`Attendee_ID`,`subevent_ID`,`event_ID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `imageinfo`
--
ALTER TABLE `imageinfo`
  ADD PRIMARY KEY (`image_ID`),
  ADD KEY `badge_ID` (`badge_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `organizer_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `badge_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `fontsize`
--
ALTER TABLE `fontsize`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `imageinfo`
--
ALTER TABLE `imageinfo`
  MODIFY `image_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `Prize_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `imageinfo`
--
ALTER TABLE `imageinfo`
  ADD CONSTRAINT `imageinfo_ibfk_1` FOREIGN KEY (`badge_ID`) REFERENCES `badge` (`badge_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
