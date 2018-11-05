-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2018 at 10:34 PM
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
(13, 'safooo1324@gmail.com', '$2y$10$0G7kQ/RwH6WDSP7aY12RA.bnQ8mkE901W/i0bEUIAzVbyhzAqN1Yi', 0, 'nhBAl>MqpD', 'صفاء', 'ذكر', '1999-03-05');

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
  `checkInEventAttende` varchar(8) DEFAULT NULL,
  `prizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `eductionallevel`
--

CREATE TABLE `eductionallevel` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eductionallevel`
--

INSERT INTO `eductionallevel` (`Id`, `Name`) VALUES
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
(49, 'test manage', 'test manage', '2018-10-11', '2018-10-18', 'test manage', 'test manage', 'http://localhost/tactic2-master/Form.php?token=&rfnjJaKgu', 100, 11, 0),
(50, 'badge', 'bad', '2018-10-03', '2018-10-17', 'bad', 'bad', '', 100, 11, 0),
(53, 'ola', 'desc', '2018-10-13', '2018-10-20', 'حجازي', 'اسم الشركة المنظمة', '', 100, 12, 0),
(55, 'marwa', 'marwa', '2018-10-03', '2018-10-09', 'مروة', '', '', 0, 10, 0),
(57, 'ahmed', 'ahmed', '2018-10-12', '2018-10-26', 'ahmed', 'ahmed', '', 100, 11, 0),
(58, 'ahm', 'de', '2018-10-27', '2018-10-29', 'lo', 'test', '', 100, 12, 0);

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
-- Indexes for table `eductionallevel`
--
ALTER TABLE `eductionallevel`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `organizer_ID` (`organizer_ID`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `organizer_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
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
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eductionallevel`
--
ALTER TABLE `eductionallevel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `form_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subevent`
--
ALTER TABLE `subevent`
  MODIFY `subevent_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendee`
--
ALTER TABLE `attendee`
  ADD CONSTRAINT `attendee_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `event` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_educationalLevelId` FOREIGN KEY (`educationalLevelId`) REFERENCES `eductionallevel` (`Id`),
  ADD CONSTRAINT `fk_genderId` FOREIGN KEY (`genderId`) REFERENCES `gender` (`Id`),
  ADD CONSTRAINT `fk_nationalityId` FOREIGN KEY (`nationalityId`) REFERENCES `nationality` (`Id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
