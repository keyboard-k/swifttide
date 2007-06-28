-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Time: 18. April 2007 at 09:48
-- Server Version: 5.0.38
-- PHP-Version: 4.4.4-9
-- 
-- Datenbank: `new`
-- 

-- --------------------------------------------------------

-- 
-- table structure for table `attendance_codes`
-- 

DROP TABLE IF EXISTS `attendance_codes`;
CREATE TABLE IF NOT EXISTS `attendance_codes` (
  `attendance_codes_id` int(10) unsigned NOT NULL auto_increment,
  `attendance_codes_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`attendance_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `attendance_codes`
-- 

INSERT INTO `attendance_codes` (`attendance_codes_id`, `attendance_codes_desc`) VALUES 
(1, 'MOM DROVE/NO NOTE'),
(2, 'DAD DROVE/NO NOTE'),
(3, 'AUNT/UNCLE DROVE/NO NOTE'),
(4, 'GRANDPARENT DR/NO NOTE'),
(5, 'DRS APPT'),
(6, 'DENTAL APPT'),
(7, 'ILL/NURSE/PARENT IN'),
(8, 'Walked - Late '),
(9, 'Rode Bike - Late '),
(10, 'Travel -Field Trip Excused '),
(11, 'LATE MORE THAN 1 HOUR'),
(12, 'Tardy - Parent Brought In '),
(13, 'Note From Parent - OK '),
(14, 'PARENT/GUARDIAN CAME IN'),
(16, 'FUNERAL'),
(21, 'AM ILLNESS '),
(30, 'FIELD TRIP EXCUSED AM'),
(31, 'FIELD TRIP EXCUSED'),
(32, 'Starting HomeSchooling'),
(36, 'ISS Other ');

-- --------------------------------------------------------

-- 
-- table structure for table `attendance_history`
-- 

DROP TABLE IF EXISTS `attendance_history`;
CREATE TABLE IF NOT EXISTS `attendance_history` (
  `attendance_history_id` int(10) unsigned NOT NULL auto_increment,
  `attendance_history_student` int(10) unsigned default NULL,
  `attendance_history_school` int(10) unsigned default NULL,
  `attendance_history_year` int(10) unsigned default NULL,
  `attendance_history_date` date default NULL,
  `attendance_history_code` int(10) unsigned default NULL,
  `attendance_history_notes` tinytext,
  `attendance_history_user` int(10) unsigned default NULL,
  PRIMARY KEY  (`attendance_history_id`),
  KEY `attendance_history_student_ndx` (`attendance_history_student`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `attendance_history`
-- 

INSERT INTO `attendance_history` (`attendance_history_id`, `attendance_history_student`, `attendance_history_school`, `attendance_history_year`, `attendance_history_date`, `attendance_history_code`, `attendance_history_notes`, `attendance_history_user`) VALUES 
(8, 26, 7, 1, '2005-09-08', 10, 'FUNERAL', 9),
(13, 90, 7, 1, '2005-09-08', 4, '', 9),
(14, 90, 7, 1, '2005-09-07', 4, '', 9),
(15, 2, 7, 1, '2005-09-08', 11, '', 9),
(25, 1, 7, 1, '2005-09-09', 10, '', 9),
(26, 62, 7, 1, '2005-09-09', 10, '', 9),
(34, 24, 7, 1, '2005-09-10', 10, '', 9),
(35, 1, 7, 1, '2005-09-10', 10, '', 9),
(39, 69, 7, 1, '2005-09-10', 2, 'NOTE/PARENT', 9),
(41, 37, 7, 1, '2005-09-10', 10, 'DRS APPT', 9),
(43, 72, 7, 1, '2005-09-10', 7, 'PARENT/GUARDIAN CAME IN', 9),
(47, 47, 7, 1, '2005-09-10', 5, 'PARENT/GUARDIAN CAME IN', 9),
(48, 55, 7, 1, '2005-09-10', 9, 'PARENT/GUARDIAN CAME IN', 9),
(57, 92, 7, 1, '2005-09-13', 2, 'NOTE/PARENT', 9),
(63, 76, 7, 1, '2005-09-13', 1, '', 9),
(67, 37, 7, 1, '2005-09-13', 3, 'ILL/NURSE/PARENT IN', 9),
(68, 39, 7, 1, '2005-09-13', 5, 'PARENT/GUARDIAN CAME IN', 9),
(75, 64, 7, 1, '2005-09-14', 2, 'MOM DROVE/NO NOTE', 9),
(83, 2, 7, 1, '2005-09-14', 5, 'NOTE/PARENT', 9),
(89, 81, 7, 1, '2005-09-15', 2, 'GRANDPARENT DR/NO NOTE', 9),
(91, 38, 7, 1, '2005-09-15', 2, 'NO NOTE', 9),
(92, 85, 7, 1, '2005-09-15', 2, 'GRANDPARENT DR/NO NOTE', 9),
(101, 68, 7, 1, '2005-09-15', 2, 'NOTE/PARENT', 9),
(104, 85, 7, 1, '2005-09-15', 5, '', 9),
(110, 37, 7, 1, '2005-09-16', 8, '', 9),
(121, 37, 7, 1, '2005-09-17', 10, '', 9),
(122, 85, 7, 1, '2005-09-17', 10, '', 9),
(124, 69, 7, 1, '2005-09-17', 10, 'NOTE/PARENT', 9),
(139, 27, 7, 1, '2005-09-17', 10, '', 9),
(141, 81, 7, 1, '2005-09-17', 1, '', 9),
(143, 64, 7, 1, '2005-09-17', 10, '', 9),
(144, 93, 7, 1, '2005-09-17', 1, '', 9),
(151, 17, 7, 1, '2005-09-17', 5, 'ILL/NURSE/PARENT IN', 9),
(160, 71, 7, 1, '2005-09-20', 2, 'NO NOTE', 9),
(164, 22, 7, 1, '2005-09-20', 2, 'DAD DROVE/NO NOTE', 9),
(171, 46, 7, 1, '2005-09-20', 10, '', 9),
(172, 48, 7, 1, '2005-09-20', 10, '', 9),
(173, 38, 7, 1, '2005-09-20', 1, '', 9),
(177, 15, 7, 1, '2005-09-20', 1, '', 9),
(181, 25, 7, 1, '2005-09-20', 10, '', 9),
(183, 52, 7, 1, '2005-09-16', 10, 'NOTE/PARENT', 9),
(184, 52, 7, 1, '2005-09-17', 10, 'NOTE/PARENT', 9),
(189, 8, 7, 1, '2005-09-21', 10, '', 9),
(190, 31, 7, 1, '2005-09-21', 10, '', 9),
(197, 38, 7, 1, '2005-09-21', 2, 'GRANDPARENT DR/NO NOTE', 9),
(200, 49, 7, 1, '2005-09-21', 1, '', 9),
(210, 85, 7, 1, '2005-09-21', 10, '', 9),
(219, 37, 7, 1, '2005-09-22', 8, '', 9),
(221, 9, 7, 1, '2005-09-21', 5, 'PARENT/GUARDIAN CAME IN', 9),
(228, 71, 7, 1, '2005-09-22', 2, 'NO NOTE', 9),
(230, 83, 7, 1, '2005-09-22', 2, 'OVERSLEPT', 9),
(232, 31, 7, 1, '2005-09-22', 10, '', 9),
(236, 66, 7, 1, '2005-09-22', 10, '', 9),
(237, 69, 7, 1, '2005-09-22', 10, 'DRS APPT', 9),
(241, 81, 7, 1, '2005-09-22', 1, '', 9),
(242, 6, 7, 1, '2005-09-22', 1, 'NOTE/PARENT', 9),
(254, 6, 7, 1, '2005-09-23', 1, 'NOTE/PARENT', 9),
(255, 93, 7, 1, '2005-09-23', 1, '', 9),
(256, 27, 7, 1, '2005-09-23', 2, 'DRS APPT', 9),
(259, 55, 7, 1, '2005-09-23', 5, 'PARENT/GUARDIAN CAME IN', 9),
(260, 70, 7, 1, '2005-09-23', 5, 'PARENT/GUARDIAN CAME IN', 9),
(263, 64, 7, 1, '2005-09-24', 5, 'DRS APPT', 9),
(264, 21, 7, 1, '2005-09-24', 5, 'NOTE/PARENT', 9),
(267, 50, 7, 1, '2005-09-24', 10, '', 9),
(268, 50, 7, 1, '2005-09-27', 10, '', 9),
(269, 96, 7, 1, '2005-09-24', 10, '', 9),
(274, 6, 7, 1, '2005-09-24', 2, 'NOTE/PARENT', 9),
(279, 85, 7, 1, '2005-09-24', 10, '', 9),
(281, 20, 7, 1, '2005-09-24', 1, '', 9),
(282, 93, 7, 1, '2005-09-24', 1, '', 9),
(286, 40, 7, 1, '2005-09-24', 8, '', 9),
(289, 40, 7, 1, '2005-09-27', 8, '', 9),
(291, 40, 7, 1, '2005-09-28', 8, '', 9),
(293, 40, 7, 1, '2005-09-29', 8, '', 9),
(296, 49, 7, 1, '2005-09-24', 3, 'PARENT/GUARDIAN CAME IN', 9),
(298, 40, 7, 1, '2005-09-23', 14, 'OFF SCHOOL GROUNDS', 9),
(303, 38, 7, 1, '2005-09-27', 2, 'GRANDPARENT DR/NO NOTE', 9),
(313, 81, 7, 1, '2005-09-27', 2, 'GRANDPARENT DR/NO NOTE', 9),
(316, 92, 7, 1, '2005-09-27', 2, 'NOTE/PARENT', 9),
(320, 80, 7, 1, '2005-09-27', 1, '', 9),
(321, 93, 7, 1, '2005-09-27', 1, '', 9),
(331, 6, 7, 1, '2005-09-28', 2, 'MOM DROVE/NO NOTE', 9),
(332, 41, 7, 1, '2005-09-28', 2, 'MOM DROVE/NO NOTE', 9),
(339, 43, 7, 1, '2005-09-28', 1, '', 9),
(340, 55, 7, 1, '2005-09-28', 1, '', 9),
(343, 83, 7, 1, '2005-09-28', 1, '', 9),
(350, 85, 7, 1, '2005-09-28', 10, '', 9),
(352, 9, 7, 1, '2005-09-28', 5, 'PARENT/GUARDIAN CAME IN', 9),
(361, 74, 7, 1, '2005-09-29', 2, 'TARDY/WITH PARENT', 9),
(363, 64, 7, 1, '2005-09-29', 2, 'MOM DROVE/NO NOTE', 9),
(365, 13, 7, 1, '2005-09-29', 2, 'NOTE/PARENT', 9),
(368, 65, 7, 1, '2005-09-29', 5, 'DENTAL APPT', 9),
(370, 22, 7, 1, '2005-09-29', 1, '', 9),
(371, 94, 7, 1, '2005-09-29', 1, '', 9),
(373, 76, 7, 1, '2005-09-29', 1, 'NOTE/PARENT', 9),
(379, 62, 7, 1, '2005-09-29', 10, '', 9),
(384, 37, 7, 1, '2005-09-30', 4, '', 9),
(385, 37, 7, 1, '2005-10-01', 8, '', 9),
(387, 6, 7, 1, '2005-09-30', 2, 'MOM DROVE/NO NOTE', 9),
(388, 66, 7, 1, '2005-09-30', 2, 'TARDY/PARENT CALLED IN', 9),
(398, 43, 7, 1, '2005-09-30', 1, '', 9),
(399, 40, 7, 1, '2005-09-30', 8, '', 9),
(402, 14, 7, 1, '2005-09-30', 1, '', 9),
(409, 88, 7, 1, '2005-09-30', 10, '', 9),
(416, 72, 7, 1, '2005-09-30', 9, 'DRS APPT', 9),
(420, 20, 7, 1, '2005-10-01', 10, '', 9),
(423, 6, 7, 1, '2005-10-01', 2, 'NOTE/PARENT', 9),
(425, 41, 7, 1, '2005-10-01', 2, 'PARENT/GUARDIAN CAME IN', 9),
(430, 68, 7, 1, '2005-10-01', 10, '', 9),
(433, 49, 7, 1, '2005-10-01', 1, '', 9),
(435, 54, 7, 1, '2005-10-01', 3, 'PARENT/GUARDIAN CAME IN', 9),
(438, 83, 7, 1, '2005-10-01', 1, '', 9),
(444, 38, 7, 1, '2005-10-01', 2, 'NOTE/PARENT', 9),
(447, 86, 7, 1, '2005-10-01', 3, 'PARENT/GUARDIAN CAME IN', 9),
(449, 85, 7, 1, '2005-10-01', 10, '', 9),
(454, 72, 7, 1, '2005-10-01', 9, 'PARENT/GUARDIAN CAME IN', 9),
(455, 58, 7, 1, '2005-10-04', 10, '', 9),
(456, 10, 7, 1, '2005-10-04', 10, '', 9),
(457, 11, 7, 1, '2005-10-04', 10, '', 9),
(461, 41, 7, 1, '2005-10-04', 2, 'TARDY/WITH PARENT', 9),
(466, 6, 7, 1, '2005-10-04', 2, 'MOM DROVE/NO NOTE', 9),
(469, 38, 7, 1, '2005-10-04', 2, 'GRANDPARENT DR/NO NOTE', 9),
(473, 71, 7, 1, '2005-10-04', 10, '', 9),
(475, 5, 7, 1, '2005-10-04', 2, 'TARDY/WITH PARENT', 9),
(477, 92, 7, 1, '2005-10-04', 2, 'NOTE/PARENT', 9),
(479, 37, 7, 1, '2005-10-04', 8, '', 9),
(480, 37, 7, 1, '2005-10-01', 4, 'PARENT/GUARDIAN CAME IN', 9),
(487, 1, 7, 1, '2005-10-04', 10, '', 9),
(492, 62, 7, 1, '2005-10-04', 2, 'NOTE/PARENT', 9),
(497, 90, 7, 1, '2005-10-04', 5, 'PARENT/GUARDIAN CAME IN', 9),
(498, 19, 7, 1, '2005-10-04', 3, 'PARENT/GUARDIAN CAME IN', 9),
(499, 58, 7, 1, '2005-10-05', 10, '', 9);

-- --------------------------------------------------------

-- 
-- table structure for table `contact_to_students`
-- 

DROP TABLE IF EXISTS `contact_to_students`;
CREATE TABLE IF NOT EXISTS `contact_to_students` (
  `contact_to_students_id` int(10) unsigned NOT NULL auto_increment,
  `contact_to_students_contact` int(10) unsigned default NULL,
  `contact_to_students_student` int(10) unsigned default NULL,
  `contact_to_students_internet` smallint(5) unsigned default NULL,
  `contact_to_students_relation` int(10) unsigned default NULL,
  `contact_to_students_residence` smallint(5) unsigned default NULL,
  `contact_to_students_year` int(11) NOT NULL default '0',
  `contact_to_students_primary` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`contact_to_students_id`),
  KEY `contact_to_students_student_ndx` (`contact_to_students_student`),
  KEY `contact_to_students_contact_ndx` (`contact_to_students_contact`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `contact_to_students`
-- 

INSERT INTO `contact_to_students` (`contact_to_students_id`, `contact_to_students_contact`, `contact_to_students_student`, `contact_to_students_internet`, `contact_to_students_relation`, `contact_to_students_residence`, `contact_to_students_year`, `contact_to_students_primary`) VALUES 
(1, 1, 1, NULL, 2, 1, 1, 1),
(2, 2, 2, NULL, 1, 1, 1, 1),
(3, 3, 3, 1, 2, 1, 1, 1),
(4, 4, 4, NULL, 2, 1, 1, 1),
(5, 5, 5, NULL, 2, 1, 1, 1),
(6, 6, 6, NULL, 1, 1, 1, 1),
(7, 7, 7, NULL, 2, 1, 1, 1),
(8, 8, 8, NULL, 1, 1, 1, 1),
(9, 9, 9, NULL, 1, 1, 1, 1),
(10, 10, 10, NULL, 1, 1, 1, 1),
(11, 11, 11, NULL, 1, 1, 1, 1),
(12, 12, 12, NULL, 1, 1, 1, 1),
(13, 13, 13, NULL, 2, 1, 1, 1),
(14, 14, 14, NULL, 1, 1, 1, 1),
(15, 15, 15, NULL, 1, 1, 1, 1),
(16, 16, 16, NULL, 1, 1, 1, 1),
(17, 17, 17, NULL, 1, 1, 1, 1),
(18, 18, 18, NULL, 1, 1, 1, 1),
(19, 19, 19, NULL, 1, 1, 1, 1),
(20, 20, 20, NULL, 1, 1, 1, 1),
(21, 21, 21, NULL, 1, 1, 1, 1),
(22, 22, 22, NULL, 2, 1, 1, 1),
(23, 23, 23, NULL, 1, 1, 1, 1),
(24, 24, 24, NULL, 2, 1, 1, 1),
(25, 25, 25, NULL, 1, 1, 1, 1),
(26, 26, 26, NULL, 1, 1, 1, 1),
(27, 27, 27, NULL, 1, 1, 1, 1),
(28, 28, 28, NULL, 1, 1, 1, 1),
(29, 29, 29, 1, 1, 1, 1, 1),
(30, 30, 30, NULL, 2, 1, 1, 1),
(31, 31, 31, NULL, 1, 1, 1, 1),
(32, 32, 32, NULL, 1, 1, 1, 1),
(33, 33, 33, NULL, 2, 1, 1, 1),
(34, 34, 34, 1, 2, 1, 1, 1),
(35, 35, 35, NULL, 1, 1, 1, 1),
(36, 36, 36, NULL, 1, 1, 1, 1),
(37, 37, 37, NULL, 1, 1, 1, 1),
(38, 38, 38, NULL, 8, 1, 1, 1),
(39, 39, 39, NULL, 1, 1, 1, 1),
(40, 40, 40, NULL, 1, 1, 1, 1),
(41, 41, 41, NULL, 2, 1, 1, 1),
(42, 42, 42, NULL, 2, 1, 1, 1),
(43, 43, 43, NULL, 1, 1, 1, 1),
(44, 44, 44, NULL, 2, 1, 1, 1),
(45, 45, 45, NULL, 2, 1, 1, 1),
(46, 46, 46, NULL, 1, 1, 1, 1),
(47, 47, 47, NULL, 1, 1, 1, 1),
(48, 48, 48, NULL, 2, 1, 1, 1),
(49, 49, 49, NULL, 9, 1, 1, 1),
(50, 50, 50, NULL, 2, 1, 1, 1),
(51, 51, 51, NULL, 2, 1, 1, 1),
(52, 52, 52, NULL, 1, 1, 1, 1),
(53, 53, 53, NULL, 1, 1, 1, 1),
(54, 54, 54, NULL, 2, 1, 1, 1),
(55, 55, 55, NULL, 1, 1, 1, 1),
(56, 56, 56, NULL, 1, 1, 1, 1),
(57, 57, 57, NULL, 2, 1, 1, 1),
(58, 58, 58, NULL, 2, 1, 1, 1),
(59, 59, 59, NULL, 1, 1, 1, 1),
(60, 60, 60, NULL, 1, 1, 1, 1),
(61, 61, 61, NULL, 1, 1, 1, 1),
(62, 62, 62, NULL, 2, 1, 1, 1),
(63, 63, 63, NULL, 9, 1, 1, 1),
(64, 64, 64, NULL, 1, 1, 1, 1),
(65, 65, 65, NULL, 2, 1, 1, 1),
(66, 66, 66, 1, 1, 1, 1, 1),
(67, 67, 67, NULL, 1, 1, 1, 1),
(68, 68, 68, NULL, 2, 1, 1, 1),
(69, 69, 69, NULL, 1, 1, 1, 1),
(70, 70, 70, NULL, 1, 1, 1, 1),
(71, 71, 71, NULL, 1, 1, 1, 1),
(72, 72, 72, NULL, 2, 1, 1, 1),
(73, 73, 73, NULL, 1, 1, 1, 1),
(74, 74, 74, NULL, 1, 1, 1, 1),
(75, 75, 75, NULL, 1, 1, 1, 1),
(76, 76, 76, NULL, 1, 1, 1, 1),
(77, 77, 77, NULL, 7, 1, 1, 1),
(78, 78, 78, NULL, 1, 1, 1, 1),
(79, 79, 79, NULL, 1, 1, 1, 1),
(80, 80, 80, NULL, 1, 1, 1, 1),
(81, 81, 81, NULL, 1, 1, 1, 1),
(82, 82, 82, NULL, 1, 1, 1, 1),
(83, 83, 83, NULL, 1, 1, 1, 1),
(84, 84, 84, NULL, 1, 1, 1, 1),
(85, 85, 85, NULL, 2, 1, 1, 1),
(86, 86, 86, NULL, 1, 1, 1, 1),
(87, 87, 87, NULL, 1, 1, 1, 1),
(88, 88, 88, NULL, 1, 1, 1, 1),
(89, 89, 89, NULL, 2, 1, 1, 1),
(90, 90, 90, NULL, 2, 1, 1, 1),
(91, 91, 91, NULL, 2, 1, 1, 1),
(92, 92, 92, NULL, 2, 1, 1, 1),
(93, 93, 93, NULL, 1, 1, 1, 1),
(94, 94, 94, NULL, 1, 1, 1, 1),
(95, 95, 95, NULL, 7, 1, 1, 1),
(96, 96, 96, NULL, 2, 1, 1, 1),
(97, 97, 97, NULL, 2, 1, 1, 1),
(98, 98, 98, NULL, 2, 1, 1, 1),
(99, 99, 99, NULL, 1, 1, 1, 1),
(100, 100, 100, NULL, 1, 1, 1, 1),
(371, 111, 45, NULL, 5, 0, 1, 0),
(370, 110, 103, NULL, 5, 0, 1, 0),
(369, 109, 103, NULL, 6, 1, 1, 1),
(368, 108, 102, NULL, 6, 1, 1, 1),
(367, 107, 101, NULL, 6, 1, 1, 1),
(366, 106, 78, NULL, 7, 0, 1, 0),
(365, 105, 78, NULL, 7, 0, 1, 0),
(364, 104, 78, NULL, 7, 0, 1, 0),
(363, 103, 78, NULL, 7, 0, 1, 0),
(362, 102, 78, NULL, 6, 0, 1, 0),
(361, 101, 78, NULL, 6, 0, 1, 0),
(359, 71, 66, NULL, 5, 0, 1, 1),
(360, 72, 66, NULL, 6, 0, 1, 1);

-- --------------------------------------------------------

-- 
-- table structure for table `custom_attendance_history`
-- 

DROP TABLE IF EXISTS `custom_attendance_history`;
CREATE TABLE IF NOT EXISTS `custom_attendance_history` (
  `custom_attendance_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `attendance_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_attendance_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_attendance_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `custom_discipline_history`
-- 

DROP TABLE IF EXISTS `custom_discipline_history`;
CREATE TABLE IF NOT EXISTS `custom_discipline_history` (
  `custom_discipline_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `discipline_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_discipline_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_discipline_history`
-- 

INSERT INTO `custom_discipline_history` (`custom_discipline_history_id`, `custom_field_id`, `discipline_history_id`, `data`) VALUES 
(1, 1, 0, 0x74657374),
(2, 1, 1467, 0x74657374),
(3, 2, 0, 0x736466736466),
(4, 1, 0, 0x736466647366),
(5, 1, 0, 0x736466736466),
(6, 1, 0, 0x736466736466),
(7, 3, 0, 0x646667646667),
(8, 3, 0, 0x736466),
(9, 3, 0, 0x736466736466736466),
(10, 1, 0, 0x67646667646667646667),
(11, 2, 0, 0x646667646667),
(12, 2, 0, 0x736466736466),
(13, 2, 0, 0x736466736466),
(14, 1, 0, 0x74657374);

-- --------------------------------------------------------

-- 
-- table structure for table `custom_fields`
-- 

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `custom_field_id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  PRIMARY KEY  (`custom_field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_fields`
-- 

INSERT INTO `custom_fields` (`custom_field_id`, `name`) VALUES 
(1, 'Title I Reading'),
(2, 'English Limited'),
(3, 'After School Tutored');

-- --------------------------------------------------------

-- 
-- table structure for table `custom_grade_history`
-- 

DROP TABLE IF EXISTS `custom_grade_history`;
CREATE TABLE IF NOT EXISTS `custom_grade_history` (
  `custom_grade_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `grade_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_grade_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_grade_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `custom_health_history`
-- 

DROP TABLE IF EXISTS `custom_health_history`;
CREATE TABLE IF NOT EXISTS `custom_health_history` (
  `custom_health_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `health_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_health_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_health_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `custom_studentbio`
-- 

DROP TABLE IF EXISTS `custom_studentbio`;
CREATE TABLE IF NOT EXISTS `custom_studentbio` (
  `custom_studentbio_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `studentbio_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_studentbio_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `custom_studentbio`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `discipline_history`
-- 

DROP TABLE IF EXISTS `discipline_history`;
CREATE TABLE IF NOT EXISTS `discipline_history` (
  `discipline_history_id` int(10) unsigned NOT NULL auto_increment,
  `discipline_history_student` int(10) unsigned default NULL,
  `discipline_history_school` int(10) unsigned default NULL,
  `discipline_history_year` int(10) unsigned default NULL,
  `discipline_history_code` int(10) unsigned default NULL,
  `discipline_history_date` date default NULL,
  `discipline_history_sdate` date default NULL,
  `discipline_history_edate` date default NULL,
  `discipline_history_action` varchar(50) default NULL,
  `discipline_history_notes` tinytext,
  `discipline_history_reporter` varchar(40) default NULL,
  `discipline_history_user` int(10) unsigned default NULL,
  PRIMARY KEY  (`discipline_history_id`),
  KEY `discipline_history_student_ndx` (`discipline_history_student`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `discipline_history`
-- 

INSERT INTO `discipline_history` (`discipline_history_id`, `discipline_history_student`, `discipline_history_school`, `discipline_history_year`, `discipline_history_code`, `discipline_history_date`, `discipline_history_sdate`, `discipline_history_edate`, `discipline_history_action`, `discipline_history_notes`, `discipline_history_reporter`, `discipline_history_user`) VALUES 
(14, 54, 7, 1, 23, '2005-09-13', '2005-09-14', '2005-09-14', 'Warning', 'Threw pencil at student out bus window', 'Jeff McDonald', 9),
(17, 24, 7, 1, 23, '2005-09-14', '2005-09-15', '2005-09-15', 'Warning', '', 'Mr. Shanpe', 9),
(24, 37, 7, 1, 3, '2005-09-16', '2005-09-16', '2005-09-16', 'Suspended 1 day', '', 'Mr. Shanpe', 9),
(26, 66, 7, 1, 22, '2005-09-17', '2005-09-20', '2005-09-20', 'Warning', 'Removed another''s material from desk & trying to get student out of chair.', 'Ruth Libertine', 9),
(34, 83, 7, 1, 22, '2005-09-20', '2005-09-21', '2005-09-21', 'Warning', 'Failure to complete class work; lack of class materials.Third Team warning.', 'Miss Sullivan', 9),
(37, 6, 7, 1, 22, '2005-09-20', '2005-09-21', '2005-09-21', 'Warning', 'Third Team warning; failure to complete classwork & lack of class materials. Detention from 8th grade team.', 'Amy Hannah', 9),
(41, 67, 7, 1, 22, '2005-09-20', '2005-09-21', '2005-09-21', 'Warning', 'Failure to complete classwork.; needs to return safety contract for science.', 'Miss Sullivan', 9),
(42, 66, 7, 1, 1, '2005-09-17', '2005-09-22', '2005-09-22', 'Warning', 'Threw eraser at student in Mrs. Smiht''s class.', '', 9),
(47, 67, 7, 1, 15, '2005-09-21', '2005-09-22', '2005-09-23', 'Demerit', '', 'Mr. OConnor', 9),
(49, 90, 7, 1, 22, '2005-09-22', '2005-09-23', '2005-09-23', 'Warning', 'Failure to complete class work.', 'Carole LePlanque', 9),
(50, 96, 7, 1, 22, '2005-09-21', '2005-09-23', '2005-09-23', 'Warning', 'Failure to complete class work.', 'Carole LePlanque', 9),
(53, 37, 7, 1, 14, '2005-09-21', '2005-09-21', '2005-09-22', 'Suspended 2 days', '', 'Mr. Shanpe', 9),
(57, 38, 7, 1, 22, '2005-09-22', '2005-09-23', '2005-09-23', 'Warning', 'Failure to complete class work. Did not return science safety contract.', 'Miss Sullivan', 9),
(61, 40, 7, 1, 21, '2005-09-23', '2005-09-24', '2005-09-30', 'Notice sent home', '', 'Mr. OConnor', 9),
(63, 83, 7, 1, 15, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', '', 'Miss Sullivan', 9),
(67, 9, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', '3 Team warnings.', 'Miss Sullivan', 9),
(68, 44, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', 'And shouting; 3Team warnings', 'Miss Sullivan', 9),
(70, 64, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', 'Removed from classroom by police', 'Miss Sullivan', 9),
(71, 66, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', 'Pretended to vomit.', 'Miss Sullivan', 9),
(72, 90, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', 'Very loud noises.', 'Miss Sullivan', 9),
(78, 64, 7, 1, 22, '2005-09-24', '2005-09-27', '2005-09-27', 'Warning', 'Kicking, hitting, pushing another student.', 'June Casey', 9),
(79, 66, 7, 1, 8, '2005-09-24', '2005-09-28', '2005-09-28', 'Warning', 'Hands on horseplay.', 'June Casey', 9),
(80, 72, 7, 1, 8, '2005-09-24', '2005-09-28', '2005-09-28', 'Warning', 'Hands on horseplay.', 'Mr. OConnor', 9),
(96, 99, 7, 1, 22, '2005-09-23', '2005-09-29', '2005-09-29', 'Warning', '3 Team warnings', '', 9),
(102, 90, 7, 1, 2, '2005-09-28', '2005-09-30', '2005-09-30', 'Warning', 'Pushed the books out of another student''s arms.\r\n', '', 9),
(103, 72, 7, 1, 15, '2005-09-28', '2005-09-29', '2005-09-30', 'Demerit', '', 'Mr. OConnor', 9),
(108, 90, 7, 1, 15, '2005-10-01', '2005-10-01', '2005-10-04', 'Demerit', '', 'Mr. OConnor', 9),
(109, 38, 7, 1, 22, '2005-09-29', '2005-10-04', '2005-10-04', 'Warning', 'Running in the cafeteria.', 'Miss Sullivan', 9),
(112, 52, 7, 1, 22, '2005-09-29', '2005-10-04', '2005-10-04', 'Warning', 'Laughed at teacher when disciplined.', 'Miss Sullivan', 9),
(113, 41, 7, 1, 22, '2005-09-29', '2005-10-04', '2005-10-04', 'Warning', 'Threatened teacher.', 'Miss Sullivan', 9),
(115, 37, 7, 1, 4, '2005-09-29', '2005-09-30', '2005-10-01', 'Notice sent home', 'Insolence to staff; out of assigned area.', 'Mr. Shanpe', 9),
(117, 37, 7, 1, 22, '2005-10-01', '2005-10-01', '2005-10-04', 'Suspended 1 day', 'Inappropriate physical behavior.', 'Mr. Shanpe', 9),
(128, 41, 7, 1, 10, '2005-10-05', '2005-10-05', '2005-10-05', 'Warning', '', 'Mr. OConnor', 9),
(135, 81, 7, 1, 22, '2005-10-05', '2005-10-06', '2005-10-06', 'Warning', 'Repeated gum chewing.', 'Lu Grondin', 9),
(138, 99, 7, 1, 22, '2005-09-30', '2005-09-30', '2005-09-30', 'Warning', 'Pushing & shoving.', 'Mrs. Dunbar', 9),
(140, 95, 7, 1, 3, '2005-10-05', '2005-10-07', '2005-10-07', 'Warning', 'Inappropriate language to field hockey team.', 'Mr. OConnor', 9),
(142, 19, 7, 1, 8, '2005-10-05', '2005-10-06', '2005-10-06', 'Warning', 'Jumping on a student. From M.Taylor.', '', 9),
(143, 38, 7, 1, 10, '2005-10-06', '2005-10-07', '2005-10-07', 'Warning', '', 'Mr. OConnor', 9),
(145, 37, 7, 1, 22, '2005-10-05', '2005-10-05', '2005-10-05', 'Suspended 1 day', 'Insubordination', 'Mr. Shanpe', 9),
(147, 90, 7, 1, 8, '2005-10-05', '2005-10-06', '2005-10-06', 'Warning', 'Hands on horseplay on a student.', 'Mr. OConnor', 9),
(167, 38, 7, 1, 15, '2005-10-04', '2005-10-07', '2005-10-08', 'Demerit', 'And 3 Team warnings. From Cappiello too.', 'Miss Sullivan', 9),
(172, 83, 7, 1, 22, '2005-10-08', '2005-10-12', '2005-10-12', 'Warning', 'From Mrs. Cappiello too. 3 Team warnings.', 'Miss Sullivan', 9),
(180, 67, 7, 1, 22, '2005-10-08', '2005-10-12', '2005-10-12', 'Warning', 'And Mrs. Cappiello too. 3 Team warnings.', 'Miss Sullivan', 9),
(185, 37, 7, 1, 22, '2005-10-08', '2005-10-08', '2005-10-08', 'Suspended 1 day', 'Inappropriate physical behavior. Refusal to follow directions.', 'Mr. OConnor', 9),
(188, 99, 7, 1, 17, '2005-10-08', '2005-10-08', '2005-10-08', 'Suspended 3 days', 'To another student.', 'Mr. OConnor', 9),
(191, 19, 7, 1, 6, '2005-10-12', '2005-10-13', '2005-10-13', 'Warning', 'Shooting pencil lead in class.', 'Mr. OConnor', 9),
(194, 64, 7, 1, 22, '2005-10-13', '2005-10-15', '2005-10-15', 'Warning', '3 Team warnings. Team teachers.', '', 9),
(208, 54, 7, 1, 5, '2005-10-15', '2005-10-18', '2005-10-18', 'Warning', 'Would not do modified classwork .', 'Donna Butcher', 9),
(209, 44, 7, 1, 22, '2005-10-15', '2005-10-18', '2005-10-18', 'Warning', 'Candy/gum.', 'Miss Sullivan', 9),
(213, 54, 7, 1, 3, '2005-10-18', '2005-10-19', '2005-10-21', 'Notice sent home', 'Inappropriate comments & drawing.', 'Mr. OConnor', 9),
(216, 44, 7, 1, 15, '2005-10-18', '2005-10-19', '2005-10-20', 'Demerit', 'And on the 19th.', 'Mr. OConnor', 9),
(219, 64, 7, 1, 8, '2005-10-19', '2005-10-20', '2005-10-20', 'Warning', 'Attempting to drag student by the leg.', 'Mary Capster', 9),
(220, 66, 7, 1, 2, '2005-10-19', '2005-10-20', '2005-10-20', 'Warning', 'Repeatedly using the word "gay" when asked to stop.', 'Ruth Libertine', 9),
(221, 9, 7, 1, 22, '2005-10-18', '2005-10-20', '2005-10-20', 'Warning', 'Took student''s paper without permission.', 'Mr. Shanpe', 9),
(224, 83, 7, 1, 22, '2005-10-19', '2005-10-22', '2005-10-22', 'Warning', '3 Team warnings. From Team 8.', 'Mary Capster', 9),
(227, 52, 7, 1, 22, '2005-10-19', '2005-10-22', '2005-10-22', 'Warning', 'And Team 8. 3 Team warnings.', 'Mary Capster', 9),
(232, 100, 7, 1, 8, '2005-10-20', '2005-10-25', '2005-10-25', 'Warning', '', 'Beth Donohoe', 9),
(238, 26, 7, 1, 8, '2005-10-19', '2005-10-22', '2005-10-22', 'Warning', 'Repeated pushing of forehead of a student.', 'Sixth Grade', 9),
(240, 6, 7, 1, 10, '2005-10-21', '2005-10-22', '2005-10-22', 'Warning', '', 'Mr. OConnor', 9),
(241, 19, 7, 1, 23, '2005-10-18', '2005-10-22', '2005-10-22', 'Warning', 'Not staying in assigned seat.', 'Mr. OConnor', 9),
(245, 41, 7, 1, 10, '2005-10-22', '2005-10-25', '2005-10-25', 'Warning', '', 'Mr. OConnor', 9),
(248, 99, 7, 1, 23, '2005-10-22', '2005-10-26', '2005-10-26', 'Warning', 'Failure to sit in assigned seat.', 'Mr. Shanpe', 9),
(250, 6, 7, 1, 1, '2005-10-22', '2005-10-27', '2005-10-27', 'Warning', 'Chasing another student around the room.', 'Mary Capster', 9),
(253, 66, 7, 1, 22, '2005-10-22', '2005-10-26', '2005-10-26', 'Warning', '3 Team warnings from Team 8.', 'Mary Capster', 9),
(254, 44, 7, 1, 22, '2005-10-22', '2005-10-26', '2005-10-26', 'Warning', '3 Team warnings from Team 8.', 'Mary Capster', 9),
(255, 90, 7, 1, 22, '2005-10-22', '2005-10-26', '2005-10-26', 'Warning', '3 Team warnings from Team 8.', 'Mary Capster', 9),
(260, 55, 7, 1, 5, '2005-10-26', '2005-10-27', '2005-10-27', 'Warning', 'Talking during NHEACAP.', 'Amy Hannah', 9),
(262, 6, 7, 1, 1, '2005-10-22', '2005-10-27', '2005-10-27', 'Warning', 'Wiped paint on his face & chased another student.', 'Mary Capster', 9),
(264, 18, 7, 1, 14, '2005-10-26', '2005-10-27', '2005-10-27', 'Warning', 'Skipped Skills class.', 'Ann Ganhunner', 9),
(266, 19, 7, 1, 17, '2005-10-22', '2005-10-25', '2005-10-27', 'Suspended 5 days', 'Bullying & inappropriate physical behavior.', 'Mr. OConnor', 9),
(273, 38, 7, 1, 2, '2005-10-27', '2005-10-29', '2005-10-29', 'Warning', 'Behavior with a Sub.', 'Mrs. Dunbar', 9),
(274, 44, 7, 1, 2, '2005-10-27', '2005-10-29', '2005-10-29', 'Warning', 'With a Sub.', 'Mrs. Dunbar', 9),
(275, 41, 7, 1, 10, '2005-10-28', '2005-10-29', '2005-10-29', 'Warning', '', 'Mr. OConnor', 9),
(276, 6, 7, 1, 10, '2005-10-28', '2005-10-29', '2005-10-29', 'Warning', '', 'Mr. OConnor', 9),
(280, 83, 7, 1, 22, '2005-10-29', '2005-11-01', '2005-11-01', 'Warning', 'And Team 8. 3 Team warnings.', 'Mary Capster', 9),
(289, 83, 7, 1, 14, '2005-10-29', '2005-11-01', '2005-11-01', 'Suspended 1 day', 'Cut class.', 'Mr. OConnor', 9),
(295, 37, 7, 1, 1, '2005-10-18', '2005-10-18', '2005-10-19', 'Suspended 1 day', '', 'Mr. OConnor', 9),
(297, 6, 7, 1, 8, '2005-10-22', '2005-10-25', '2005-10-25', 'Suspended 3 days', 'Inappropriate physical behavior, kicked a student.', 'Mr. Shanpe', 9),
(300, 6, 7, 1, 15, '2005-11-01', '2005-11-01', '2005-11-01', 'Suspended 1 day', '', 'Mr. OConnor', 9),
(302, 35, 7, 1, 22, '2005-10-29', '2005-11-01', '2005-11-01', 'Warning', 'Misbehavior during lunch.', 'Mr. Shanpe', 9),
(303, 64, 7, 1, 5, '2005-11-01', '2005-11-02', '2005-11-02', 'Warning', 'Kept talking.', 'Ann Ganhunner', 9),
(311, 66, 7, 1, 5, '2005-11-02', '2005-11-02', '2005-11-02', 'Notice sent home', 'Refusing to sit when asked , ripped up detention.', 'Ruth Libertine', 9),
(320, 67, 7, 1, 8, '2005-11-03', '2005-11-04', '2005-11-04', 'Warning', 'And O''Brien.', 'Miss Sullivan', 9),
(321, 64, 7, 1, 8, '2005-11-03', '2005-11-04', '2005-11-04', 'Warning', 'And o''Brien.', 'Miss Sullivan', 9),
(323, 99, 7, 1, 22, '2005-11-02', '2005-11-03', '2005-11-03', 'Warning', 'Inappropriate comments to a student.', 'Mr. Shanpe', 9),
(324, 90, 7, 1, 4, '2005-11-01', '2005-11-03', '2005-11-03', 'Warning', '', 'Mary Capster', 9),
(327, 6, 7, 1, 14, '2005-11-04', '2005-11-10', '2005-11-10', 'Warning', 'Failure to report to the Planning Room.', 'Miss Sullivan', 9),
(333, 72, 7, 1, 6, '2005-11-04', '2005-11-08', '2005-11-08', 'Warning', 'Planner across the floor.', 'Tricia Valcich', 9),
(335, 64, 7, 1, 2, '2005-11-04', '2005-11-09', '2005-11-09', 'Warning', 'Disturbing class, poor attitude, lack of class materials, excessive talking.', 'Miss Sullivan', 9),
(336, 63, 7, 1, 2, '2005-11-05', '2005-11-09', '2005-11-09', 'Warning', 'Poor attitude.', 'Tricia Valcich', 9),
(339, 66, 7, 1, 23, '2005-11-01', '2005-11-02', '2005-11-16', 'Notice sent home', 'Set off stink bomb on the bus.', 'Mr. Shanpe', 9),
(343, 6, 7, 1, 22, '2005-11-08', '2005-11-09', '2005-11-09', 'Suspended 1 day', 'Forgery, unauthorized use of school form.', 'Mr. Shanpe', 9),
(349, 37, 7, 1, 14, '2005-11-08', '2005-11-08', '2005-11-08', 'Suspended 1 day', '', 'Mr. OConnor', 9),
(352, 92, 7, 1, 18, '2005-11-10', '2005-11-12', '2005-11-12', 'Suspended 1 day', '', 'Mr. Shanpe', 9),
(353, 77, 7, 1, 2, '2005-11-09', '2005-11-10', '2005-11-10', 'Warning', 'Failed to follow directions or make any effort to complete his project.', 'Carole LePlanque', 9),
(355, 80, 7, 1, 2, '2005-11-12', '2005-11-12', '2005-11-12', 'Warning', 'Talking back.', 'Joan Ettelson', 9),
(361, 89, 7, 1, 22, '2005-11-12', '2005-11-15', '2005-11-15', 'Warning', 'Shoving student in the hall.', 'Pat Hallinan', 9),
(362, 18, 7, 1, 22, '2005-11-12', '2005-11-15', '2005-11-15', 'Warning', 'Insubordination; failure to comply with a direct request.', 'Denise Morrill', 9),
(363, 9, 7, 1, 2, '2005-11-12', '2005-11-16', '2005-11-16', 'Warning', 'Insubordinate; poor attitude, disturbing class, failure to complete classwork.', 'Miss Sullivan', 9),
(369, 66, 7, 1, 1, '2005-11-15', '2005-11-16', '2005-11-16', 'Warning', 'Disturbing class, excessive talking.', 'Ann Ganhunner', 9),
(374, 66, 7, 1, 1, '2005-11-16', '2005-11-17', '2005-11-17', 'Warning', 'Kicked over chair, threw paper, opened door with excessive force. From Ms. Taylor.', '', 9),
(379, 72, 7, 1, 2, '2005-11-16', '2005-11-19', '2005-11-19', 'Warning', 'Inappropriate language, repeated refusal to follow Planning Room rules, Attempt to destroy school property ie break a chair.', 'Mr. OConnor', 9),
(381, 66, 7, 1, 15, '2005-11-17', '2005-11-19', '2005-11-22', 'Demerit', '', 'Mr. OConnor', 9),
(385, 41, 7, 1, 2, '2005-11-16', '2005-11-17', '2005-11-17', 'Warning', 'Repeatedly referring to someone as "gay".', 'Mary Capster', 9),
(394, 83, 7, 1, 22, '2005-11-19', '2005-11-22', '2005-11-22', 'Warning', 'Pushing, shoving, tripping a student.', 'Pat Hallinan', 9),
(399, 72, 7, 1, 2, '2005-11-19', '2005-11-23', '2005-11-23', 'Warning', 'Talking back.', 'Denise Morrill', 9),
(406, 66, 7, 1, 15, '2005-11-22', '2005-11-22', '2005-11-22', 'Suspended 1 day', 'And disrespectful language to a student.', 'Mr. Shanpe', 9),
(411, 80, 7, 1, 2, '2005-11-22', '2005-11-29', '2005-11-29', 'Warning', 'From Mrs. Gamache. Excessive talking, disturbing class, poor attitude.', '', 9),
(415, 80, 7, 1, 1, '2005-11-29', '2005-11-30', '2005-11-30', 'Warning', 'Disturbing class, excessive talking, poor attitude.', 'Tricia Valcich', 9),
(416, 80, 7, 1, 22, '2005-11-30', '2005-12-02', '2005-12-03', 'Demerit', 'Forging detention slips.', 'Mr. OConnor', 9),
(417, 85, 7, 1, 10, '2005-11-23', '2005-12-01', '2005-12-01', 'Warning', '', 'Mr. OConnor', 9),
(419, 54, 7, 1, 1, '2005-11-29', '2005-12-01', '2005-12-01', 'Warning', 'Sent out of 3 classes for disturbing classmates, poor attitude, disobedience/disrepect.', 'Cathy Nelson', 9),
(426, 41, 7, 1, 1, '2005-12-01', '2005-12-01', '2005-12-01', 'Warning', 'Excessive talking.', 'Mr. OConnor', 9),
(433, 66, 7, 1, 22, '2005-12-03', '2005-12-07', '2005-12-07', 'Warning', 'From Team 8. Received 3 warning slips.', '', 9),
(437, 18, 7, 1, 22, '2005-12-03', '2005-12-08', '2005-12-08', 'Warning', 'From Team 8. Received 3 warning slips.', '', 9),
(438, 83, 7, 1, 1, '2005-12-02', '2005-12-03', '2005-12-03', 'Warning', 'Disturbing class, throwing paper airplane.', 'Ann Ganhunner', 9),
(440, 54, 7, 1, 6, '2005-12-03', '2005-12-06', '2005-12-06', 'Warning', '', 'Cathy Nelson', 9),
(443, 66, 7, 1, 2, '2005-12-02', '2005-12-03', '2005-12-03', 'Warning', '', 'Ann Ganhunner', 9),
(446, 64, 7, 1, 22, '2005-12-03', '2005-12-06', '2005-12-06', 'Warning', 'Refusal to do work.', 'Denise Morrill', 9),
(455, 83, 7, 1, 14, '2005-12-03', '2005-12-07', '2005-12-07', 'Warning', 'Left class without permission.', 'Mr. Shanpe', 9),
(459, 72, 7, 1, 2, '2005-12-06', '2005-12-07', '2005-12-07', 'Warning', 'Threw away test; poor attitude.', 'Ettelson Enman', 9),
(464, 37, 7, 1, 14, '2005-12-06', '2005-12-09', '2005-12-09', 'Warning', '', 'Steve Rosberger', 9),
(467, 66, 7, 1, 22, '2005-12-06', '2005-12-10', '2005-12-10', 'Warning', 'Pushing student into lockers. From Ms. Taylor.', '', 9),
(476, 81, 7, 1, 10, '2005-12-09', '2005-12-13', '2005-12-13', 'Warning', '', 'Mr. OConnor', 9),
(478, 72, 7, 1, 1, '2005-12-10', '2005-12-13', '2005-12-13', 'Warning', 'Disturbing class by refusing to stop talking, talking back, and rude to classmates.', 'Denise Morrill', 9),
(483, 52, 7, 1, 2, '2005-12-10', '2005-12-13', '2005-12-13', 'Warning', '', 'Ruth Libertine', 9),
(486, 85, 7, 1, 10, '2005-12-13', '2005-12-14', '2005-12-14', 'Warning', '', 'Mr. OConnor', 9),
(490, 54, 7, 1, 1, '2005-12-07', '2005-12-08', '2005-12-08', 'Warning', 'Throwing eraser at a student.', 'Tricia Valcich', 9),
(492, 24, 7, 1, 22, '2005-12-08', '2005-12-08', '2005-12-08', 'Warning', 'Refusal to bring reading book to class & jacket issue.', 'Les Shepard', 9),
(493, 46, 7, 1, 22, '2005-12-07', '2005-12-08', '2005-12-08', 'Warning', 'Tripping student in hallway & knocking him down to the floor.', 'Pat Hallinan', 9),
(494, 83, 7, 1, 14, '2005-12-07', '2005-12-10', '2005-12-10', 'Warning', 'Late to class without a note.', 'Miss Sullivan', 9),
(499, 26, 7, 1, 22, '2005-12-07', '2005-12-10', '2005-12-10', 'Warning', 'Excessive talking.', 'Amy Hannah', 9),
(501, 83, 7, 1, 15, '2005-12-13', '2005-12-13', '2005-12-13', 'Suspended 1 day', '', 'Mr. OConnor', 9),
(502, 18, 7, 1, 8, '2005-12-13', '2005-12-13', '2005-12-13', 'Suspended 1 day', 'Inappropriate physical behavior.', 'Mr. OConnor', 9),
(510, 68, 7, 1, 2, '2005-12-14', '2005-12-15', '2005-12-15', 'Warning', 'From Ms. Boynton.', '', 9),
(511, 72, 7, 1, 15, '2005-12-13', '2005-12-15', '2005-12-16', 'Demerit', '', 'Mr. Shanpe', 9),
(516, 89, 7, 1, 22, '2005-12-14', '2005-12-14', '2005-12-14', 'Warning', 'Excessive talking.', 'Mary Capster', 9),
(520, 64, 7, 1, 22, '2005-12-06', '2005-12-08', '2005-12-08', 'Warning', 'Failure to complete classroom policy.', 'Carole LePlanque', 9),
(525, 7, 7, 1, 22, '2005-12-02', '2005-12-06', '2005-12-06', 'Warning', 'Failure to complete policy.', 'Carole LePlanque', 9),
(527, 19, 7, 1, 22, '2005-12-13', '2005-12-14', '2005-12-14', 'Warning', 'Refusal to do as teacher requested.', 'Ann Ganhunner', 9),
(528, 89, 7, 1, 22, '2005-12-14', '2005-12-14', '2005-12-14', 'Warning', 'Collection of three warning slips. From Team 8.', '', 9),
(529, 41, 7, 1, 22, '2005-12-10', '2005-12-14', '2005-12-14', 'Warning', 'Walking on chairs.', 'Miss Sullivan', 9),
(532, 67, 7, 1, 1, '2005-12-13', '2005-12-14', '2005-12-14', 'Warning', '', 'Miss Sullivan', 9),
(533, 41, 7, 1, 22, '2005-12-14', '2005-12-15', '2005-12-15', 'Warning', 'From Team 8. Collection of 3 warning slips.', '', 9),
(535, 6, 7, 1, 1, '2005-12-13', '2005-12-14', '2005-12-14', 'Warning', 'No teacher signed detention.', '', 9),
(536, 90, 7, 1, 2, '2005-12-13', '2005-12-14', '2005-12-14', 'Warning', 'Excessive talking.', 'Mary Capster', 9),
(545, 99, 7, 1, 15, '2005-12-15', '2005-12-16', '2005-12-17', 'Demerit', '', 'Mr. Shanpe', 9),
(546, 99, 7, 1, 22, '2005-12-15', '2005-12-15', '2005-12-15', 'Warning', 'From Team 8. Collection of 3 warning slips.', '', 9),
(547, 99, 7, 1, 2, '2005-12-15', '2005-12-17', '2005-12-17', 'Warning', '', 'Mr. Shanpe', 9),
(548, 99, 7, 1, 2, '2005-12-16', '2005-12-17', '2005-12-17', 'Warning', 'Inappropriate talking back to teacher.', 'Donna Butcher', 9),
(555, 6, 7, 1, 22, '2005-12-15', '2005-12-15', '2005-12-15', 'Warning', 'From Team 8. 3 Team warnings.', '', 9),
(556, 6, 7, 1, 2, '2005-12-17', '2005-12-20', '2005-12-20', 'Warning', 'To a teacher.', 'Miss Sullivan', 9),
(557, 66, 7, 1, 2, '2005-12-17', '2005-12-20', '2005-12-20', 'Warning', '', 'Ruth Libertine', 9),
(560, 46, 7, 1, 2, '2005-12-17', '2005-12-21', '2005-12-21', 'Warning', 'To a student.', 'Mr. Shanpe', 9),
(562, 26, 7, 1, 2, '2005-12-20', '2005-12-21', '2005-12-21', 'Warning', 'Excessive talking.', 'Mike Wolker', 9),
(567, 41, 7, 1, 10, '2005-12-20', '2005-12-21', '2005-12-21', 'Warning', '', 'Mr. Shanpe', 9),
(568, 64, 7, 1, 10, '2005-12-20', '2005-12-21', '2005-12-21', 'Warning', '', 'Mr. Shanpe', 9),
(573, 85, 7, 1, 10, '2005-12-21', '2005-12-22', '2005-12-22', 'Warning', '', 'Mr. Shanpe', 9),
(574, 52, 7, 1, 5, '2005-12-21', '2005-12-22', '2005-12-22', 'Warning', '', 'Donna Butcher', 9),
(575, 66, 7, 1, 22, '2005-12-21', '2005-12-22', '2005-12-22', 'Warning', 'Inappropriate language.', 'Miss Sullivan', 9),
(577, 41, 7, 1, 14, '2005-12-21', '2005-12-22', '2005-12-22', 'Warning', '', 'Miss Sullivan', 9),
(581, 72, 7, 1, 1, '2005-12-21', '2005-12-23', '2005-12-23', 'Warning', 'Disturbing class by excessive talking, ripping poster paper, littering; not completing class work & poor attitude.', 'Tricia Valcich', 9),
(586, 99, 7, 1, 22, '2005-12-23', '2006-01-04', '2006-01-04', 'Warning', 'Pushed student into lockers.', 'Mr. Shanpe', 9),
(589, 54, 7, 1, 22, '2006-01-03', '2006-01-05', '2006-01-05', 'Warning', 'Throwing snowballs.', 'Steve Rosberger', 9),
(595, 37, 7, 1, 21, '2005-12-15', '2005-12-16', '2005-12-16', 'Suspended 1 day', '', 'Mr. Shanpe', 9),
(596, 46, 7, 1, 22, '2005-12-15', '2005-12-16', '2005-12-16', 'Suspended 1 day', 'Inappropriate behavior, sprayed a student with a noxious liquid.', 'Mr. Shanpe', 9),
(598, 6, 7, 1, 15, '2005-12-15', '2005-12-15', '2005-12-15', 'Suspended 1 day', '', 'Mr. Shanpe', 9),
(600, 38, 7, 1, 13, '2005-12-16', '2005-12-16', '2005-12-16', 'Suspended 1 day', 'Truant on 15th.', 'Mr. Shanpe', 9),
(601, 90, 7, 1, 22, '2005-12-16', '2005-12-17', '2005-12-20', 'Suspended 2 days', 'Inappropriate physical behavior.', 'Mr. Shanpe', 9),
(605, 6, 7, 1, 15, '2005-12-17', '2005-12-20', '2005-12-20', 'Suspended 1 day', 'Skipped on 16th.', 'Mr. Shanpe', 9),
(607, 47, 7, 1, 22, '2005-12-20', '2005-12-21', '2005-12-21', 'Suspended 1 day', 'Pushed a student''s hand.', 'Mr. Shanpe', 9),
(611, 18, 7, 1, 22, '2005-12-21', '2005-12-23', '2005-12-23', 'Suspended 1 day', 'Inappropriate physical behavior in hallway.', 'Mr. Shanpe', 9),
(613, 82, 7, 1, 23, '2005-12-22', '2005-12-23', '2005-12-23', 'Suspended 1 day', 'Pushed a student while on the bus.', 'Mr. Shanpe', 9),
(620, 66, 7, 1, 22, '2006-01-04', '2006-01-05', '2006-01-05', 'Suspended 1 day', 'Insubordination to a teacher.', 'Mr. Shanpe', 9),
(623, 72, 7, 1, 22, '2006-01-04', '2006-01-05', '2006-01-05', 'Suspended 1 day', 'Insubordinate to teacher/destruction of home school communication form.', 'Mr. Shanpe', 9),
(627, 41, 7, 1, 22, '2006-01-04', '2006-01-05', '2006-01-05', 'Warning', '3 team warnings from Team 8.', '', 9),
(633, 41, 7, 1, 1, '2006-01-05', '2006-01-07', '2006-01-07', 'Warning', 'From Mrs. Doyle; refusing to follow the rules of detention.', '', 9),
(639, 41, 7, 1, 10, '2006-01-07', '2006-01-10', '2006-01-10', 'Warning', '', 'Mr. Shanpe', 9),
(644, 64, 7, 1, 14, '2006-01-05', '2006-01-07', '2006-01-07', 'Warning', '', 'Tom Schwekheimmer', 9),
(649, 64, 7, 1, 1, '2006-01-07', '2006-01-10', '2006-01-10', 'Warning', 'Disturbing class, poor attitude, excessive talking.', 'Mary Capster', 9),
(650, 9, 7, 1, 22, '2006-01-05', '2006-01-07', '2006-01-07', 'Warning', 'Insubordination, refusal to sit in assigned seat.', 'Denise Morrill', 9),
(658, 9, 7, 1, 6, '2006-01-07', '2006-01-10', '2006-01-10', 'Warning', 'Threw pencil top hitting student in the face.', 'Ann Ganhunner', 9),
(662, 18, 7, 1, 2, '2006-01-10', '2006-01-11', '2006-01-11', 'Warning', 'Sub sent to the Planning Room.', '', 9),
(664, 44, 7, 1, 2, '2006-01-10', '2006-01-11', '2006-01-11', 'Warning', 'Sub sent to Planning Room.', '', 9),
(675, 64, 7, 1, 22, '2006-01-10', '2006-01-11', '2006-01-11', 'Warning', 'Sent to Planning Room by Sub.', '', 9),
(676, 64, 7, 1, 5, '2006-01-11', '2006-01-13', '2006-01-13', 'Warning', 'Refusing to change seat; sent to Planning Room.', 'Mike Wolker', 9),
(677, 54, 7, 1, 2, '2006-01-10', '2006-01-11', '2006-01-11', 'Suspended 1 day', 'Insubordination & inappropriate language.', 'Mr. Shanpe', 9),
(679, 66, 7, 1, 22, '2006-01-12', '2006-01-12', '2006-01-12', 'Suspended 1 day', 'Inappropriate physical behavior, insubordination to teacher.', 'Mr. Shanpe', 9),
(683, 37, 7, 1, 3, '2006-01-11', '2006-01-12', '2006-01-13', 'Suspended 3 days', 'Throwing objects, insubordination, property damage.', 'Mr. Shanpe', 9),
(692, 64, 7, 1, 6, '2006-01-12', '2006-01-18', '2006-01-18', 'Warning', 'Snowballs.', 'Mr. Shanpe', 9),
(696, 72, 7, 1, 2, '2006-01-13', '2006-01-14', '2006-01-14', 'Warning', '', 'Mr. Shanpe', 9),
(699, 41, 7, 1, 22, '2006-01-12', '2006-01-13', '2006-01-13', 'Warning', 'Inappropriate behavior in science lab.', 'Miss Sullivan', 9),
(702, 44, 7, 1, 17, '2006-01-12', '2006-01-14', '2006-01-14', 'Warning', '', 'Mike Wolker', 9),
(703, 72, 7, 1, 6, '2006-01-12', '2006-01-13', '2006-01-13', 'Suspended 1 day', 'In cafeteria & refused to clean up mess.', 'Mr. Shanpe', 9),
(710, 18, 7, 1, 22, '2006-01-14', '2006-01-18', '2006-01-18', 'Suspended 1 day', '3 warnings from Team 8.', 'Miss Sullivan', 9),
(714, 64, 7, 1, 5, '2006-01-13', '2006-01-19', '2006-01-19', 'Warning', 'Insubordination, refuse to move a balloon hat from his head.', 'Miss Sullivan', 9),
(715, 64, 7, 1, 14, '2006-01-12', '2006-01-13', '2006-01-13', 'Warning', '', 'Tom Schwekheimmer', 9),
(716, 99, 7, 1, 22, '2006-01-14', '2006-01-18', '2006-01-18', 'Warning', 'Name calling.', 'Ruth Libertine', 9),
(718, 41, 7, 1, 22, '2006-01-11', '2006-01-14', '2006-01-14', 'Warning', 'Unsafe hallway behavior.', 'Mary Capster', 9),
(721, 18, 7, 1, 1, '2006-01-14', '2006-01-19', '2006-01-19', 'Warning', 'From Mrs. Taylor.', '', 9),
(722, 89, 7, 1, 1, '2006-01-14', '2006-01-18', '2006-01-18', 'Warning', 'From Mrs. Taylor.', '', 9),
(730, 37, 7, 1, 22, '2006-01-18', '2006-01-19', '2006-01-19', 'Warning', 'Mischief.', 'Steve Rosberger', 9),
(734, 6, 7, 1, 22, '2006-01-19', '2006-01-19', '2006-01-19', 'Warning', '3 warnings from Team 8.', '', 9),
(735, 9, 7, 1, 22, '2006-01-19', '2006-01-19', '2006-01-19', 'Warning', '3 warnings from Team 8.', '', 9),
(743, 64, 7, 1, 5, '2006-01-18', '2006-01-20', '2006-01-20', 'Warning', '', 'Ann Ganhunner', 9),
(745, 99, 7, 1, 15, '2006-01-18', '2006-01-20', '2006-01-21', 'Demerit', '', 'Mr. Shanpe', 9),
(746, 54, 7, 1, 1, '2006-01-18', '2006-01-20', '2006-01-20', 'Warning', 'From Ms. Shoer.', '', 9),
(748, 47, 7, 1, 22, '2006-01-14', '2006-01-18', '2006-01-18', 'Suspended 1 day', 'Insubordination.', 'Mr. Shanpe', 9),
(750, 18, 7, 1, 22, '2006-01-14', '2006-01-18', '2006-01-18', 'Suspended 1 day', 'Inappropriate physical behavior; knocking books out of student''s hand.', 'Mr. Shanpe', 9),
(759, 41, 7, 1, 22, '2006-01-19', '2006-01-21', '2006-01-21', 'Warning', 'Holding bathroom door to prevent student from exiting.', 'Ann Ganhunner', 9),
(761, 99, 7, 1, 22, '2006-01-20', '2006-01-21', '2006-01-21', 'Warning', 'Name calling, "gay".', 'Ruth Libertine', 9),
(764, 47, 7, 1, 3, '2006-01-19', '2006-01-20', '2006-01-21', 'Notice sent home', 'Profanity directed at staff.', 'Mr. Shanpe', 9),
(769, 99, 7, 1, 23, '2006-01-21', '2006-01-21', '2006-01-27', 'Notice sent home', '', 'Mr. Shanpe', 9),
(773, 54, 7, 1, 6, '2006-01-27', '2006-01-28', '2006-01-28', 'Suspended 3 days', 'Risk of injury to staff.', 'Mr. Shanpe', 9),
(774, 66, 7, 1, 7, '2006-01-27', '2006-01-28', '2006-02-03', 'Notice sent home', '', 'Mr. Shanpe', 9),
(782, 42, 7, 1, 7, '2006-01-31', '2006-02-01', '2006-02-07', 'Notice sent home', '', 'Mr. OConnor', 9),
(783, 72, 7, 1, 22, '2006-02-02', '2006-02-03', '2006-02-03', 'Suspended 1 day', 'Inappropriate actions;  multiple detentions.', 'Mr. OConnor', 9),
(795, 37, 7, 1, 22, '2006-02-04', '2006-02-04', '2006-02-04', 'Suspended 3 days', 'Spitting on entrance door window, throwing snowballs at entrance door window, insubordination to teacher, unsafe.', 'Mr. Shanpe', 9),
(796, 90, 7, 1, 22, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', 'Inappropriate physical behavior in hallway.', 'Mr. Shanpe', 9),
(797, 47, 7, 1, 22, '2006-02-07', '2006-02-07', '2006-02-07', 'Suspended 3 days', 'Insubordination.', 'Mr. OConnor', 9),
(798, 37, 7, 1, 22, '2006-02-04', '2006-02-04', '2006-02-04', 'Suspended 3 days', 'Inappropriate physical behavior.', 'Mr. Shanpe', 9),
(799, 18, 7, 1, 22, '2006-02-04', '2006-02-07', '2006-02-07', 'Suspended 1 day', 'Inappropriate physical behavior in hallway, pushing a student.', 'Mr. Shanpe', 9),
(802, 100, 7, 1, 2, '2006-01-31', '2006-02-01', '2006-02-01', 'Warning', 'From Mrs. Gamache. Disturbing class, poor attitude, excessive talking, several warnings.', '', 9),
(803, 100, 7, 1, 1, '2006-01-28', '2006-02-01', '2006-02-01', 'Warning', '', 'Tricia Valcich', 9),
(805, 85, 7, 1, 1, '2006-01-31', '2006-02-01', '2006-02-01', 'Warning', 'Excessive talking.', 'June Casey', 9),
(807, 72, 7, 1, 6, '2006-02-01', '2006-02-02', '2006-02-02', 'Warning', '', 'Tricia Valcich', 9),
(809, 100, 7, 1, 15, '2006-02-03', '2006-02-03', '2006-02-04', 'Demerit', '', 'Mr. Shanpe', 9),
(815, 72, 7, 1, 14, '2006-02-02', '2006-02-04', '2006-02-04', 'Warning', 'Went to Planning Room without permission.', 'Les Shepard', 9),
(821, 83, 7, 1, 1, '2006-01-31', '2006-02-04', '2006-02-04', 'Warning', '', 'Mary Capster', 9),
(822, 64, 7, 1, 2, '2006-02-02', '2006-02-04', '2006-02-04', 'Warning', '', 'Mary Capster', 9),
(827, 64, 7, 1, 2, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', 'Sent from Sub.', '', 9),
(828, 20, 7, 1, 22, '2006-02-08', NULL, NULL, '', '3 warnings from Team 8.', '', 9),
(829, 9, 7, 1, 2, '2006-02-04', '2006-02-08', '2006-02-08', 'Warning', 'Sent to Planning Room by a Sub.', '', 9),
(830, 44, 7, 1, 2, '2006-02-04', '2006-02-08', '2006-02-08', 'Warning', 'Sent to Planning Room by a Sub.', '', 9),
(834, 72, 7, 1, 3, '2006-02-10', '2006-02-10', '2006-02-11', 'Suspended 4 days', '', 'Mr. Shanpe', 9),
(839, 37, 7, 1, 3, '2006-02-09', '2006-02-09', '2006-02-11', 'Suspended 5 days', 'Profanity directed at staff; insubordination.', 'Mr. Shanpe', 9),
(848, 47, 7, 1, 2, '2006-02-07', '2006-02-08', '2006-02-08', 'Warning', '', 'Ettelson Enman', 9),
(853, 41, 7, 1, 1, '2006-02-02', '2006-02-02', '2006-02-02', 'Warning', '', 'Mr. OConnor', 9),
(855, 55, 7, 1, 22, '2006-02-03', '2006-02-04', '2006-02-04', 'Warning', 'Name calling.', 'Amy Hannah', 9),
(861, 63, 7, 1, 2, '2006-02-02', '2006-02-07', '2006-02-07', 'Warning', 'Disruptive, rude.', 'Tricia Valcich', 9),
(862, 64, 7, 1, 2, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', 'And gum chewing.', 'Miss Sullivan', 9),
(864, 89, 7, 1, 1, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', 'Disturbing class, excessive talking, poor attitude, failure to start work.', 'Ann Ganhunner', 9),
(865, 83, 7, 1, 22, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', '3 warnings from Team 8.', 'Ann Ganhunner', 9),
(866, 90, 7, 1, 22, '2006-02-04', '2006-02-07', '2006-02-07', 'Warning', '3 warnings from Team 8.', 'Mr. OConnor', 9),
(874, 7, 7, 1, 8, '2006-02-07', '2006-02-09', '2006-02-09', 'Warning', 'Poking a student.', 'Mr. Shanpe', 9),
(875, 47, 7, 1, 2, '2006-02-08', '2006-02-09', '2006-02-09', 'Warning', 'Refusal to complete assigned work.', 'Les Shepard', 9),
(877, 37, 7, 1, 2, '2006-02-08', '2006-02-09', '2006-02-09', 'Warning', 'From Ms. Shoer.', '', 9),
(878, 6, 7, 1, 2, '2006-02-04', '2006-02-09', '2006-02-09', 'Warning', 'To a Substitute.', '', 9),
(882, 41, 7, 1, 14, '2006-02-09', '2006-02-10', '2006-02-10', 'Warning', 'Left class without permission.', 'Denise Morrill', 9),
(884, 83, 7, 1, 15, '2006-02-10', '2006-02-10', '2006-02-10', 'Suspended 1 day', '', 'Mr. OConnor', 9),
(890, 64, 7, 1, 15, '2006-02-11', '2006-02-15', '2006-02-15', 'Suspended 1 day', '', 'Mr. Shanpe', 9),
(900, 47, 7, 1, 15, '2006-02-15', '2006-02-15', '2006-02-15', 'Suspended 1 day', '', 'Mr. Shanpe', 9);

-- --------------------------------------------------------

-- 
-- table structure for table `entry_actions`
-- 

DROP TABLE IF EXISTS `entry_actions`;
CREATE TABLE IF NOT EXISTS `entry_actions` (
  `entry_actions_id` int(11) NOT NULL auto_increment,
  `student_id` int(11) NOT NULL default '0',
  `school_id` int(11) NOT NULL default '0',
  `school_year_id` int(11) NOT NULL default '0',
  `action_code` varchar(20) default NULL,
  `action_date` date default NULL,
  `action_notes` blob,
  PRIMARY KEY  (`entry_actions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `entry_actions`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `ethnicity`
-- 

DROP TABLE IF EXISTS `ethnicity`;
CREATE TABLE IF NOT EXISTS `ethnicity` (
  `ethnicity_id` int(10) unsigned NOT NULL auto_increment,
  `ethnicity_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`ethnicity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `ethnicity`
-- 

INSERT INTO `ethnicity` (`ethnicity_id`, `ethnicity_desc`) VALUES 
(1, 'Pacific Islander'),
(2, 'Alaskan'),
(3, 'African American'),
(4, 'Asian'),
(5, 'Caucasian'),
(7, 'Native American');

-- --------------------------------------------------------

-- 
-- table structure for table `forum_posts`
-- 

DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `member` varchar(20) default NULL,
  `headline` varchar(40) default NULL,
  `body` text,
  `date_posted` datetime default NULL,
  `views` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `forum_posts`
-- 

INSERT INTO `forum_posts` (`id`, `member`, `headline`, `body`, `date_posted`, `views`) VALUES 
(1, 'Administrator', 'Forum test', 'This is a test for a forum thread', '2006-01-25 18:31:27', 11),
(2, 'Test T.', 'My new post', 'This is a new post by teacher', '2006-01-25 18:33:45', NULL),
(3, 'Di Prova C.', 'As Parent', 'Post as parent', '2006-01-26 12:24:36', 1),
(4, 'Irvin R.', 'What about Math', 'What about the math scores in this school?  they seem real low.  Does any other parent ever notice this?', '2006-01-26 16:25:52', 6),
(5, 'Smith R.', 'Railroads on PB', 'Absolutley excellent show on railroads tonight on PBS!', '2006-04-12 20:58:20', NULL);

-- --------------------------------------------------------

-- 
-- table structure for table `forum_replies`
-- 

DROP TABLE IF EXISTS `forum_replies`;
CREATE TABLE IF NOT EXISTS `forum_replies` (
  `id` int(11) NOT NULL auto_increment,
  `member` varchar(20) default NULL,
  `headline` varchar(40) default NULL,
  `body` text,
  `date_posted` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `forum_replies`
-- 

INSERT INTO `forum_replies` (`id`, `member`, `headline`, `body`, `date_posted`) VALUES 
(1, 'Test T.', 'Re:Forum test', 'This is my reply', '2006-01-25 18:33:15'),
(2, '', 'Re:Forum test', 'I figured I would add one too!', '2006-04-12 20:46:25'),
(3, '', 'Re:Forum test', 'I figured I would add one too!', '2006-04-12 20:57:14'),
(4, 'Smith R.', 'Re:What about M', 'As a math teacher here, I can tell you that our math scores are quite adequate.  However, further parental involvement could only push the scores up more, so keep up the good work parents!', '2006-04-17 17:33:19');

-- --------------------------------------------------------

-- 
-- table structure for table `generations`
-- 

DROP TABLE IF EXISTS `generations`;
CREATE TABLE IF NOT EXISTS `generations` (
  `generations_id` int(10) unsigned NOT NULL auto_increment,
  `generations_desc` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`generations_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `generations`
-- 

INSERT INTO `generations` (`generations_id`, `generations_desc`) VALUES 
(1, '--'),
(2, 'Sr.'),
(3, 'Jr.'),
(4, 'III');

-- --------------------------------------------------------

-- 
-- table structure for table `grade_history`
-- 

DROP TABLE IF EXISTS `grade_history`;
CREATE TABLE IF NOT EXISTS `grade_history` (
  `grade_history_id` int(10) unsigned NOT NULL auto_increment,
  `grade_history_student` int(10) unsigned default NULL,
  `grade_history_year` int(10) unsigned default NULL,
  `grade_history_quarter` int(15) default NULL,
  `grade_history_grade` varchar(5) default NULL,
  `grade_history_effort` varchar(5) default NULL,
  `grade_history_conduct` varchar(5) default NULL,
  `grade_history_notes` tinytext,
  `grade_history_school` int(10) unsigned default NULL,
  `grade_history_user` int(10) unsigned default NULL,
  `grade_history_comment1` int(10) unsigned default '1',
  `grade_history_comment2` int(10) unsigned default '1',
  `grade_history_comment3` int(10) unsigned default '1',
  `grade_history_subject` int(20) default NULL,
  PRIMARY KEY  (`grade_history_id`),
  KEY `grade_history_student_ndx` (`grade_history_student`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='In this table, grade_history_user is the Teacher name.';

-- 
-- dumping data into table `grade_history`
-- 

INSERT INTO `grade_history` (`grade_history_id`, `grade_history_student`, `grade_history_year`, `grade_history_quarter`, `grade_history_grade`, `grade_history_effort`, `grade_history_conduct`, `grade_history_notes`, `grade_history_school`, `grade_history_user`, `grade_history_comment1`, `grade_history_comment2`, `grade_history_comment3`, `grade_history_subject`) VALUES 
(1, 1, 1, 1, 'B+', 'C-', 'B', 'Could be doing better', 7, 1, 12, 15, 11, 4),
(2, 1, 1, 1, 'B+', 'C-', 'B', 'Could be doing better', 7, 1, 12, 15, 11, 5),
(3, 23, 1, 1, 'A', 'B', 'B', 'Yes siree', 7, 1, 12, 12, 12, 6),
(4, 322, 1, 1, 'C-', 'C+', 'B', 'Alyssa could be trying a whole lot harder.', 7, 1, 16, 15, 13, 7),
(5, 322, 1, 1, 'C-', 'C+', 'B', 'Alyssa could be trying a whole lot harder.', 7, 1, 16, 15, 13, 8),
(6, 322, 1, 1, 'C-', 'C+', 'B', 'Alyssa could be trying a whole lot harder.', 7, 1, 16, 15, 13, 9),
(7, 322, 1, 1, 'C-', 'C+', 'B', 'Alyssa could be trying a whole lot harder.', 7, 1, 16, 15, 13, 10),
(8, 27, 1, 1, 'A', 'B', 'F', 'Go for it Ashley!  Great eye candy on those real tired days.', 7, 1, 12, 16, 1, 11),
(9, 27, 1, 1, 'A', 'B', 'F', 'Go for it Ashley!  Great eye candy on those real tired days.', 7, 1, 12, 16, 1, 12),
(10, 159, 1, 1, 'A-', 'B+', 'B+', 'Good person to know.', 7, 1, 12, 16, 15, 13),
(11, 31, 1, 1, 'B-', 'B', 'B+', 'Ya ya get yer ya yas out', 7, 1, 14, 11, 13, 14),
(12, 51, 1, 1, 'F', 'F', NULL, 'Has never appeared in my class.  Perhaps she is vacationing with Osama in the mountains of Pakistan.', 7, 1, 12, 16, 15, 1),
(13, 1, 1, 1, NULL, NULL, NULL, NULL, 7, 1, 12, 12, 12, 2),
(14, 169, 1, 1, 'A', NULL, NULL, NULL, 7, 1, 16, 15, 18, 3),
(15, 23, 1, 1, 'B', NULL, 'C', NULL, 7, 1, 12, 14, 13, 4),
(16, 14, 1, 1, 'A', NULL, 'C', NULL, 7, 1, 16, 14, 11, 5),
(17, 31, 1, 1, 'B', 'B', 'B', NULL, 7, 1, 16, 18, 18, 11),
(18, 224, 1, 1, 'B', 'B', 'B', NULL, 7, 1, 18, 11, 13, 12),
(19, 322, 1, 1, 'C', 'F', 'F', NULL, 7, 1, 12, 14, 10, 13),
(20, 279, 1, 4, 'A-', 'A', 'A-', 'Atik is a pleasure to teach. I strongly suggest enrolling him in challenging summer schools over the break.', 7, 9, 22, 25, 21, 14),
(21, 279, 1, 4, 'A-', 'A', 'A-', 'I strongly suggest finding challenging courses for Atik over the summer break.  He is truly gifted.', 7, 9, 22, 25, 21, 1),
(22, 2, 1, 1, 'A-', 'B+', 'C-', 'Keep going!', 7, 19, 22, 25, 13, 2),
(23, 66, 1, 1, 'A-', 'B+', 'B+', 'Duston is a joy to teach!', 7, 32, 22, 20, 24, 3),
(24, 10, 1, 1, 'F', 'F', 'F', 'Bad stuff.', 7, 16, 25, 20, 10, 4),
(25, 66, 1, 1, 'A', 'A', 'A', 'Needs to work harder.', 7, 9, 22, 10, 1, 5),
(26, 66, 1, 1, 'B', 'B+', 'C', 'Good worker.  Pays attention to detail.', 7, 19, 22, 22, 22, 6),
(27, 21, 1, 1, 'A', 'B', 'A', NULL, 1, 12, 1, 3, 4, 2),
(28, 21, 1, 2, 'B+', 'C-', 'C-', NULL, 1, 13, 1, 6, 17, 1),
(29, 23, 1, 2, 'A', 'A-', 'B-', NULL, 1, 15, 1, 6, 4, 4),
(30, 23, 1, 3, 'C+', 'C-', 'C-', NULL, 1, 18, 1, 4, 3, 10),
(31, 23, 1, 4, 'A', 'A', 'A+', NULL, 1, 21, 1, 6, 5, 12),
(32, 29, 1, 1, 'D', 'D-', 'D', NULL, 1, 31, 1, 4, 7, 11),
(33, 19, 1, 1, 'A', 'B', 'C', NULL, 1, 21, 1, 2, 3, 3),
(34, 81, 1, 1, 'A', 'B', 'B', NULL, 1, 31, 1, 6, 5, 15),
(35, 100, 1, 2, 'A', 'B', 'B', NULL, 1, 48, 1, 2, 3, 11),
(36, 100, 1, 3, 'B', 'B', 'B', NULL, 1, 44, 1, 6, 3, 10),
(37, 100, 1, 4, 'A', 'A-', 'B+', NULL, 1, 44, 1, 3, 6, 12),
(38, 101, 1, 1, 'C', 'C', 'C+', NULL, 1, 45, 1, 2, 3, 14),
(39, 102, 1, 2, 'A', 'B', 'C', NULL, 1, 43, 1, 4, 3, 12),
(40, 102, 1, 1, 'B+', 'B+', 'B-', NULL, 1, 22, 1, 5, 6, 3),
(41, 99, 1, 1, 'B', 'A', 'C', NULL, 1, 12, 1, 2, 3, 15),
(42, 98, 1, 1, 'A', 'B', 'C', NULL, 1, 43, 1, 2, 5, 16),
(43, 92, 1, 1, 'A', 'B', 'C', NULL, 1, 11, 1, 2, 3, 16),
(44, 90, 1, 2, 'A', 'B', 'B', NULL, 1, 22, 1, 2, 3, 14),
(45, 88, 1, 1, 'A', 'A', 'A', NULL, 1, 11, 1, 6, 5, 16),
(46, 88, 1, 2, 'A', 'A-', 'A-', NULL, 1, 45, 1, 1, 1, 14),
(47, 33, 1, 2, 'A', 'B', 'C', NULL, 1, 40, 1, 1, 1, 14),
(48, 33, 1, 1, 'B+', 'B+', 'B-', NULL, 1, 45, 1, 5, 4, 14),
(49, 24, 1, 1, 'A-', 'F', 'F', NULL, 1, 12, 1, 2, 4, 14),
(50, 25, 1, 1, 'A', 'A', 'A', NULL, 1, 1, 1, 2, 3, 1),
(51, 1, 1, 1, 'A', 'B', 'C', NULL, 1, 1, 1, 2, 3, 1),
(52, 2, 1, 1, 'B', 'B-', 'C+', NULL, 1, 3, 1, 3, 5, 3);

-- --------------------------------------------------------

-- 
-- table structure for table `grade_names`
-- 

DROP TABLE IF EXISTS `grade_names`;
CREATE TABLE IF NOT EXISTS `grade_names` (
  `grade_names_id` int(10) unsigned NOT NULL auto_increment,
  `grade_names_desc` varchar(80) default NULL,
  PRIMARY KEY  (`grade_names_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `grade_names`
-- 

INSERT INTO `grade_names` (`grade_names_id`, `grade_names_desc`) VALUES 
(10, 'Test scores are low due to lack of preparation.'),
(11, 'Student Does not turn in most homework'),
(12, 'A pleasure to teach'),
(13, 'Student does excellent work when motivated'),
(14, 'Rude to Other Students'),
(15, 'Often rude to teacher'),
(16, 'Displays no effort at all in the subject matter'),
(18, 'Just a test comment'),
(19, 'Student needs extra help with homework.'),
(20, 'Excellent work all around.'),
(21, 'Often assists other struggling students.'),
(22, 'A joy to have in the classroom.'),
(23, 'This student should seek out more challenging work.'),
(24, 'Always the first one done.'),
(25, 'Always does quality work.'),
(26, 'A truly excellent student.');

-- --------------------------------------------------------

-- 
-- table structure for table `grade_subjects`
-- 

DROP TABLE IF EXISTS `grade_subjects`;
CREATE TABLE IF NOT EXISTS `grade_subjects` (
  `grade_subject_id` int(11) NOT NULL auto_increment,
  `grade_subject_desc` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`grade_subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='storing subject names';

-- 
-- dumping data into table `grade_subjects`
-- 

INSERT INTO `grade_subjects` (`grade_subject_id`, `grade_subject_desc`) VALUES 
(1, 'Math'),
(2, 'Social Studies'),
(3, 'Language Arts'),
(4, 'Computer Studies'),
(5, 'Reading'),
(6, 'Chemistry'),
(7, 'Physics'),
(8, 'Remedial Math'),
(9, 'Physical Education'),
(10, 'Home Economics'),
(11, 'Woodshop'),
(12, 'Music'),
(13, 'General Science'),
(14, 'General Business'),
(15, 'Algebra'),
(16, 'Algebra II');

-- --------------------------------------------------------

-- 
-- table structure for table `grade_terms`
-- 

DROP TABLE IF EXISTS `grade_terms`;
CREATE TABLE IF NOT EXISTS `grade_terms` (
  `grade_terms_id` int(11) NOT NULL auto_increment,
  `grade_terms_desc` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`grade_terms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `grade_terms`
-- 

INSERT INTO `grade_terms` (`grade_terms_id`, `grade_terms_desc`) VALUES 
(1, 'Fall 2004'),
(2, 'Winter 2004'),
(3, 'Spring 2004'),
(4, 'Summer 2004');

-- --------------------------------------------------------

-- 
-- table structure for table `grades`
-- 

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `grades_id` int(10) unsigned NOT NULL auto_increment,
  `grades_desc` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`grades_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `grades`
-- 

INSERT INTO `grades` (`grades_id`, `grades_desc`) VALUES 
(8, 'Grade 8'),
(2, 'Grade 2'),
(3, 'Grade 3'),
(4, 'Grade 4'),
(5, 'Grade 5'),
(6, 'Grade 6'),
(7, 'Grade 7'),
(1, 'Grade 1'),
(9, 'Grade 9'),
(10, 'Grade 10');

-- --------------------------------------------------------

-- 
-- table structure for table `health_allergy`
-- 

DROP TABLE IF EXISTS `health_allergy`;
CREATE TABLE IF NOT EXISTS `health_allergy` (
  `health_allergy_id` int(10) unsigned NOT NULL auto_increment,
  `health_allergy_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_allergy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_allergy`
-- 

INSERT INTO `health_allergy` (`health_allergy_id`, `health_allergy_desc`) VALUES 
(1, 'Peanuts '),
(2, 'Mold '),
(3, 'Polyester Carpeting '),
(4, 'Aspirin ');

-- --------------------------------------------------------

-- 
-- table structure for table `health_allergy_history`
-- 

DROP TABLE IF EXISTS `health_allergy_history`;
CREATE TABLE IF NOT EXISTS `health_allergy_history` (
  `health_allergy_history_id` int(10) unsigned NOT NULL auto_increment,
  `health_allergy_history_student` int(11) unsigned default '0',
  `health_allergy_history_year` int(10) unsigned default '0',
  `health_allergy_history_school` int(11) unsigned default '0',
  `health_allergy_history_code` int(11) unsigned default '0',
  `health_allergy_history_date` date default '0000-00-00',
  `health_allergy_history_notes` tinytext,
  `health_allergy_history_user` int(11) unsigned NOT NULL default '0',
  `health_allergy_history_reason` varchar(80) default NULL,
  PRIMARY KEY  (`health_allergy_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_allergy_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `health_codes`
-- 

DROP TABLE IF EXISTS `health_codes`;
CREATE TABLE IF NOT EXISTS `health_codes` (
  `health_codes_id` int(10) unsigned NOT NULL auto_increment,
  `health_codes_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_codes`
-- 

INSERT INTO `health_codes` (`health_codes_id`, `health_codes_desc`) VALUES 
(1, 'Headache'),
(2, 'Stomach Ache '),
(3, 'Hungry'),
(17, 'Twisted Ankle'),
(5, 'Hit head'),
(6, 'Nosebleed'),
(7, 'Difficulty breathing'),
(8, 'Take Prescription Drugs'),
(9, 'Menstural Issues'),
(18, 'Black Eye'),
(11, 'Ear Ache'),
(12, 'Sore Throat '),
(13, 'Loose/Lost Tooth'),
(14, 'Nauseous'),
(15, 'Needed a Break from the world'),
(16, 'Ask Health Question');

-- --------------------------------------------------------

-- 
-- table structure for table `health_history`
-- 

DROP TABLE IF EXISTS `health_history`;
CREATE TABLE IF NOT EXISTS `health_history` (
  `health_history_id` int(10) unsigned NOT NULL auto_increment,
  `health_history_student` int(10) unsigned default NULL,
  `health_history_school` int(10) unsigned default NULL,
  `health_history_year` int(10) unsigned default NULL,
  `health_history_code` int(10) unsigned default NULL,
  `health_history_date` date default NULL,
  `health_history_action` varchar(50) default NULL,
  `health_history_notes` tinytext,
  `health_history_sentby` varchar(40) default NULL,
  `health_history_user` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`health_history_id`),
  KEY `discipline_history_student_ndx` (`health_history_student`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_history`
-- 

INSERT INTO `health_history` (`health_history_id`, `health_history_student`, `health_history_school`, `health_history_year`, `health_history_code`, `health_history_date`, `health_history_action`, `health_history_notes`, `health_history_sentby`, `health_history_user`) VALUES 
(1, 66, 7, 1, 16, '2006-04-04', 'Answered Question', 'Had a personal question.', 'Mr. Freeze', '9'),
(2, 66, 7, 1, 7, '2006-04-01', 'Stepped Outside', 'Once outside, he was fine.', 'Mr. Grup', '9'),
(3, 66, 7, 1, 13, '2006-04-05', 'Put Tooth In A Towel', 'All set!', 'Mr. Grup', '31'),
(4, 66, 7, 1, 1, '2006-04-06', 'Gave Him Aspirin', 'All set.  Feeling much better!', 'Mr. Freeze', '31');

-- --------------------------------------------------------

-- 
-- table structure for table `health_immunz`
-- 

DROP TABLE IF EXISTS `health_immunz`;
CREATE TABLE IF NOT EXISTS `health_immunz` (
  `health_immunz_id` int(10) unsigned NOT NULL auto_increment,
  `health_immunz_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_immunz_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_immunz`
-- 

INSERT INTO `health_immunz` (`health_immunz_id`, `health_immunz_desc`) VALUES 
(2, 'Rubella'),
(3, 'Polio'),
(4, 'Mumps'),
(5, 'Chickenpox');

-- --------------------------------------------------------

-- 
-- table structure for table `health_immunz_history`
-- 

DROP TABLE IF EXISTS `health_immunz_history`;
CREATE TABLE IF NOT EXISTS `health_immunz_history` (
  `health_immunz_history_id` int(10) unsigned NOT NULL auto_increment,
  `health_immunz_history_student` int(11) unsigned default '0',
  `health_immunz_history_year` int(10) unsigned default '0',
  `health_immunz_history_school` int(11) unsigned default '0',
  `health_immunz_history_code` int(11) unsigned default '0',
  `health_immunz_history_date` date default '0000-00-00',
  `health_immunz_history_notes` tinytext,
  `health_immunz_history_user` int(11) unsigned NOT NULL default '0',
  `health_immunz_history_reason` varchar(80) default NULL,
  PRIMARY KEY  (`health_immunz_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_immunz_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `health_med_history`
-- 

DROP TABLE IF EXISTS `health_med_history`;
CREATE TABLE IF NOT EXISTS `health_med_history` (
  `health_med_history_id` int(10) unsigned NOT NULL auto_increment,
  `health_med_history_student` int(11) unsigned default '0',
  `health_med_history_year` int(10) unsigned default '0',
  `health_med_history_school` int(11) unsigned default '0',
  `health_med_history_code` int(11) unsigned default '0',
  `health_med_history_date` date default '0000-00-00',
  `health_med_history_notes` tinytext,
  `health_med_history_user` int(11) unsigned NOT NULL default '0',
  `health_med_history_reason` varchar(80) default NULL,
  PRIMARY KEY  (`health_med_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_med_history`
-- 

INSERT INTO `health_med_history` (`health_med_history_id`, `health_med_history_student`, `health_med_history_year`, `health_med_history_school`, `health_med_history_code`, `health_med_history_date`, `health_med_history_notes`, `health_med_history_user`, `health_med_history_reason`) VALUES 
(1, 168, 1, 7, 1, '2006-04-06', 'doctor', 31, 'Doctor'),
(2, 248, 1, 7, 3, '2006-04-14', 'doctor wants this', 31, 'Doctor'),
(3, 248, 1, 7, 3, '2006-04-14', 'doctor wants this', 31, 'Doctor'),
(4, 248, 1, 7, 3, '2006-04-14', 'doctor wants this', 31, 'Doctor'),
(5, 248, 1, 7, 3, '2006-04-14', 'doctor wants this', 31, 'Doctor'),
(6, 248, 1, 7, 1, '2006-04-05', 'no real reason', 31, 'See Me'),
(7, 307, 1, 7, 1, '2005-09-08', 'Tyler should take 1 pill per day after lunch.', 31, 'Family Doctor'),
(8, 307, 1, 7, 4, '2006-02-09', 'Tyler displayed shortness of breath and other classis asthmatic symptoms.  He now has an inhaler in the office for emergencies.', 31, 'Recent Physical'),
(9, 66, 1, 7, 4, '2006-01-04', 'Per family doctor''s orders, Duston needs the asthma inhaler.', 31, 'Mild Asthma');

-- --------------------------------------------------------

-- 
-- table structure for table `health_medicine`
-- 

DROP TABLE IF EXISTS `health_medicine`;
CREATE TABLE IF NOT EXISTS `health_medicine` (
  `health_medicine_id` int(10) unsigned NOT NULL auto_increment,
  `health_medicine_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_medicine_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_medicine`
-- 

INSERT INTO `health_medicine` (`health_medicine_id`, `health_medicine_desc`) VALUES 
(1, 'Ritalin'),
(2, 'Tylenol'),
(3, 'Ampicillin2'),
(4, 'Asthma Inhaler');

-- --------------------------------------------------------

-- 
-- table structure for table `health_visit_codes`
-- 

DROP TABLE IF EXISTS `health_visit_codes`;
CREATE TABLE IF NOT EXISTS `health_visit_codes` (
  `health_visit_id` int(10) unsigned NOT NULL auto_increment,
  `health_visit_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_visit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_visit_codes`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `health_visit_history`
-- 

DROP TABLE IF EXISTS `health_visit_history`;
CREATE TABLE IF NOT EXISTS `health_visit_history` (
  `health_visit_history_id` int(10) unsigned NOT NULL auto_increment,
  `health_visit_history_student` int(10) unsigned default NULL,
  `health_visit_history_school` int(10) unsigned default NULL,
  `health_visit_history_year` int(10) unsigned default NULL,
  `health_visit_history_code` int(10) unsigned default NULL,
  `health_visit_history_date` date default NULL,
  `health_visit_history_action` varchar(50) default NULL,
  `health_visit_history_notes` tinytext,
  `health_visit_history_sentby` varchar(40) default NULL,
  PRIMARY KEY  (`health_visit_history_id`),
  KEY `discipline_history_student_ndx` (`health_visit_history_student`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `health_visit_history`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `homework`
-- 

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `homework_id` int(11) NOT NULL auto_increment,
  `teacher_id` int(11) default NULL,
  `name` varchar(50) default NULL,
  `subjectid` int(11) default NULL,
  `roomid` int(11) default NULL,
  `date_assigned` date NOT NULL default '0000-00-00',
  `date_due` date NOT NULL default '0000-00-00',
  `notes` blob,
  PRIMARY KEY  (`homework_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `homework`
-- 

INSERT INTO `homework` (`homework_id`, `teacher_id`, `name`, `subjectid`, `roomid`, `date_assigned`, `date_due`, `notes`) VALUES 
(6, 4, 'Spongebob', '1', '4', '2005-04-13', '2005-05-26', 0x4a75737420646f2069742e),
(5, 4, 'Apeman in Spain', '1', '3', '2005-04-07', '2005-05-25', 0x546865206170656d616e20676f65732077696c6421),
(7, 3, 'The Great Depression', '3', '4', '2005-11-08', '2006-11-15', 0x596f752073686f756c6420626520726561647920746f206469736375737320686f77207468652047726561742044657072657373696f6e20616666656374656420746865206176657261676520706572736f6e2e202052656164207061676573203130362d31353520696e20796f757220746578742e);

-- --------------------------------------------------------

-- 
-- table structure for table `homework_files`
-- 

DROP TABLE IF EXISTS `homework_files`;
CREATE TABLE IF NOT EXISTS `homework_files` (
  `homework_file_id` int(11) NOT NULL auto_increment,
  `homework_id` int(11) default NULL,
  `title` varchar(50) default NULL,
  `location` varchar(100) default NULL,
  PRIMARY KEY  (`homework_file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `homework_files`
-- 

INSERT INTO `homework_files` (`homework_file_id`, `homework_id`, `title`, `location`) VALUES 
(2, 6, 'Work paper', 'homework/rsmith/SMS.tar.gz'),
(3, 7, 'Overview', 'homework/teacher/log.txt');

-- --------------------------------------------------------

-- 
-- table structure for table `infraction_codes`
-- 

DROP TABLE IF EXISTS `infraction_codes`;
CREATE TABLE IF NOT EXISTS `infraction_codes` (
  `infraction_codes_id` int(10) unsigned NOT NULL auto_increment,
  `infraction_codes_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`infraction_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `infraction_codes`
-- 

INSERT INTO `infraction_codes` (`infraction_codes_id`, `infraction_codes_desc`) VALUES 
(1, 'Disruptive Behavior'),
(2, 'Disrespect'),
(11, 'Theft'),
(12, 'Substance Abuse'),
(13, 'Truancy'),
(14, 'Not Where Assigned '),
(15, 'Skipping Detention'),
(16, 'Vandalism'),
(17, 'Threatening Behavior'),
(18, 'Harassment'),
(19, 'Explosive devices'),
(20, 'Flammable devices'),
(21, 'Unauthorized Leaving '),
(22, 'Other'),
(23, 'Bus Issue '),
(3, 'Obscene Language'),
(4, 'Obscene Gesture'),
(5, 'Not Following Direction '),
(6, 'Throwing Objects '),
(7, 'Fighting'),
(8, 'Roughhousing'),
(9, 'Cheating'),
(10, 'Late');

-- --------------------------------------------------------

-- 
-- table structure for table `parent_to_kids`
-- 

DROP TABLE IF EXISTS `parent_to_kids`;
CREATE TABLE IF NOT EXISTS `parent_to_kids` (
  `parent_id` int(11) NOT NULL auto_increment,
  `student_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `parent_to_kids`
-- 

INSERT INTO `parent_to_kids` (`parent_id`, `student_id`) VALUES 
(34, 34),
(3, 3);

-- --------------------------------------------------------

-- 
-- table structure for table `relations_codes`
-- 

DROP TABLE IF EXISTS `relations_codes`;
CREATE TABLE IF NOT EXISTS `relations_codes` (
  `relation_codes_id` int(10) unsigned NOT NULL auto_increment,
  `relation_codes_desc` varchar(30) default NULL,
  `relation_codes_unique` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`relation_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `relations_codes`
-- 

INSERT INTO `relations_codes` (`relation_codes_id`, `relation_codes_desc`, `relation_codes_unique`) VALUES 
(1, 'Father', 1),
(2, 'Mother', 1),
(3, 'Brother', 0),
(4, 'Sister', 0),
(5, 'Uncle', 0),
(6, 'Aunt', 0),
(7, 'Grandfather', 0),
(8, 'Grandmother', 0),
(9, 'Stepfather', 1),
(10, 'Stepmother', 1),
(12, 'Grandparents', NULL),
(13, 'Guardian', NULL);

-- --------------------------------------------------------

-- 
-- table structure for table `school_names`
-- 

DROP TABLE IF EXISTS `school_names`;
CREATE TABLE IF NOT EXISTS `school_names` (
  `school_names_id` int(10) unsigned NOT NULL auto_increment,
  `school_names_desc` varchar(35) default NULL,
  PRIMARY KEY  (`school_names_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `school_names`
-- 

INSERT INTO `school_names` (`school_names_id`, `school_names_desc`) VALUES 
(4, 'Prova Scuola'),
(6, 'Halleyville Junior High '),
(7, 'Newtown Elementary ');

-- --------------------------------------------------------

-- 
-- table structure for table `school_rooms`
-- 

DROP TABLE IF EXISTS `school_rooms`;
CREATE TABLE IF NOT EXISTS `school_rooms` (
  `school_rooms_id` int(10) unsigned NOT NULL auto_increment,
  `school_rooms_desc` varchar(35) default NULL,
  PRIMARY KEY  (`school_rooms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `school_rooms`
-- 

INSERT INTO `school_rooms` (`school_rooms_id`, `school_rooms_desc`) VALUES 
(1, '1a'),
(2, '1b'),
(3, '2a'),
(4, '2b');

-- --------------------------------------------------------

-- 
-- table structure for table `school_years`
-- 

DROP TABLE IF EXISTS `school_years`;
CREATE TABLE IF NOT EXISTS `school_years` (
  `school_years_id` int(10) unsigned NOT NULL auto_increment,
  `school_years_desc` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`school_years_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `school_years`
-- 

INSERT INTO `school_years` (`school_years_id`, `school_years_desc`) VALUES 
(1, '2005-2006'),
(2, '2006-2007'),
(3, '2007-2008'),
(4, '2008-2009'),
(5, '2009-2010'),
(6, '2010-2011'),
(7, '2011-2012'),
(8, '2012-2013'),
(9, '2013-2014');

-- --------------------------------------------------------

-- 
-- table structure for table `student_grade_year`
-- 

DROP TABLE IF EXISTS `student_grade_year`;
CREATE TABLE IF NOT EXISTS `student_grade_year` (
  `student_grade_year_id` int(10) unsigned NOT NULL auto_increment,
  `student_grade_year_student` int(10) unsigned default NULL,
  `student_grade_year_year` int(10) unsigned default NULL,
  `student_grade_year_grade` int(10) unsigned default NULL,
  PRIMARY KEY  (`student_grade_year_id`),
  KEY `student_grade_year_ndx` (`student_grade_year_student`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `student_grade_year`
-- 

INSERT INTO `student_grade_year` (`student_grade_year_id`, `student_grade_year_student`, `student_grade_year_year`, `student_grade_year_grade`) VALUES 
(1, 1, 1, 7),
(2, 2, 1, 6),
(3, 3, 1, 1),
(4, 4, 1, 7),
(5, 5, 1, 7),
(6, 6, 1, 8),
(7, 7, 1, 6),
(8, 8, 1, 7),
(9, 9, 1, 8),
(10, 10, 1, 7),
(11, 11, 1, 8),
(12, 12, 1, 8),
(13, 13, 1, 7),
(14, 14, 1, 7),
(15, 15, 1, 7),
(16, 16, 1, 6),
(17, 17, 1, 7),
(18, 18, 1, 8),
(19, 19, 1, 8),
(20, 20, 1, 8),
(21, 21, 1, 6),
(22, 22, 1, 6),
(23, 23, 1, 7),
(24, 24, 1, 7),
(25, 25, 1, 6),
(26, 26, 1, 6),
(27, 27, 1, 7),
(28, 28, 1, 7),
(29, 29, 1, 6),
(30, 30, 1, 8),
(31, 31, 1, 7),
(32, 32, 1, 8),
(33, 33, 1, 8),
(34, 34, 1, 7),
(35, 35, 1, 6),
(36, 36, 1, 7),
(37, 37, 1, 8),
(38, 38, 1, 8),
(39, 39, 1, 7),
(40, 40, 1, 6),
(41, 41, 1, 8),
(42, 42, 1, 7),
(43, 43, 1, 6),
(44, 44, 1, 8),
(45, 45, 1, 6),
(46, 46, 1, 7),
(47, 47, 1, 7),
(48, 48, 1, 7),
(49, 49, 1, 7),
(50, 50, 1, 6),
(51, 51, 1, 7),
(52, 52, 1, 8),
(53, 53, 1, 8),
(54, 54, 1, 7),
(55, 55, 1, 6),
(56, 56, 1, 8),
(57, 57, 1, 7),
(58, 58, 1, 6),
(59, 59, 1, 7),
(60, 60, 1, 8),
(61, 61, 1, 7),
(62, 62, 1, 6),
(63, 63, 1, 7),
(64, 64, 1, 8),
(65, 65, 1, 6),
(66, 66, 1, 1),
(67, 67, 1, 8),
(68, 68, 1, 7),
(69, 69, 1, 8),
(70, 70, 1, 6),
(71, 71, 1, 7),
(72, 72, 1, 7),
(73, 73, 1, 6),
(74, 74, 1, 8),
(75, 75, 1, 7),
(76, 76, 1, 8),
(77, 77, 1, 8),
(78, 78, 1, 7),
(79, 79, 1, 7),
(80, 80, 1, 7),
(81, 81, 1, 6),
(82, 82, 1, 6),
(83, 83, 1, 8),
(84, 84, 1, 7),
(85, 85, 1, 8),
(86, 86, 1, 6),
(87, 87, 1, 7),
(88, 88, 1, 7),
(89, 89, 1, 8),
(90, 90, 1, 8),
(91, 91, 1, 6),
(92, 92, 1, 8),
(93, 93, 1, 7),
(94, 94, 1, 6),
(95, 95, 1, 6),
(96, 96, 1, 7),
(97, 97, 1, 6),
(98, 98, 1, 7),
(99, 99, 1, 8),
(100, 100, 1, 7),
(101, 101, 1, 8),
(102, 102, 1, 8),
(103, 103, 1, 8),
(104, 104, 1, 8),
(105, 105, 1, 7),
(106, 106, 1, 8),
(107, 107, 1, 7),
(108, 108, 1, 6),
(109, 109, 1, 8),
(110, 110, 1, 8),
(111, 111, 1, 8),
(112, 112, 1, 7),
(113, 113, 1, 6),
(114, 114, 1, 7),
(115, 115, 1, 8),
(116, 116, 1, 7),
(117, 117, 1, 8),
(118, 118, 1, 6),
(119, 119, 1, 6),
(120, 120, 1, 8),
(121, 121, 1, 7),
(122, 122, 1, 8),
(123, 123, 1, 8),
(124, 124, 1, 7),
(125, 125, 1, 7),
(126, 126, 1, 6),
(127, 127, 1, 7),
(128, 128, 1, 6),
(129, 129, 1, 7),
(130, 130, 1, 6),
(131, 131, 1, 8),
(132, 132, 1, 7),
(133, 133, 1, 6),
(134, 134, 1, 7),
(135, 135, 1, 8),
(136, 136, 1, 8),
(137, 137, 1, 7),
(138, 138, 1, 6),
(139, 139, 1, 7),
(140, 140, 1, 7),
(141, 141, 1, 5),
(142, 142, 1, 7),
(143, 143, 1, 8),
(144, 144, 1, 8),
(145, 145, 1, 7),
(146, 146, 1, 7),
(147, 147, 1, 7),
(148, 148, 1, 6),
(149, 149, 1, 7),
(150, 150, 1, 8),
(151, 151, 1, 6),
(152, 152, 1, 6),
(153, 153, 1, 6),
(154, 154, 1, 8),
(155, 155, 1, 8),
(156, 156, 1, 6),
(157, 157, 1, 7),
(158, 158, 1, 8),
(159, 159, 1, 7),
(160, 160, 1, 6),
(161, 161, 1, 8),
(162, 162, 1, 8),
(163, 163, 1, 7),
(164, 164, 1, 8),
(165, 165, 1, 7),
(166, 166, 1, 6),
(167, 167, 1, 8),
(168, 168, 1, 6),
(169, 169, 1, 7),
(170, 170, 1, 8),
(171, 171, 1, 8),
(172, 172, 1, 7),
(173, 173, 1, 6),
(174, 174, 1, 8),
(175, 175, 1, 6),
(176, 176, 1, 6),
(177, 177, 1, 6),
(178, 178, 1, 8),
(179, 179, 1, 8),
(180, 180, 1, 8),
(181, 181, 1, 7),
(182, 182, 1, 7),
(183, 183, 1, 7),
(184, 184, 1, 6),
(185, 185, 1, 7),
(186, 186, 1, 6),
(187, 187, 1, 6),
(188, 188, 1, 7),
(189, 189, 1, 8),
(190, 190, 1, 6),
(191, 191, 1, 6),
(192, 192, 1, 6),
(193, 193, 1, 6),
(194, 194, 1, 6),
(195, 195, 1, 8),
(196, 196, 1, 6),
(197, 197, 1, 6),
(198, 198, 1, 8),
(199, 199, 1, 6),
(200, 200, 1, 6),
(201, 201, 1, 8),
(202, 202, 1, 6),
(203, 203, 1, 8),
(204, 204, 1, 7),
(205, 205, 1, 8),
(206, 206, 1, 7),
(207, 207, 1, 8),
(208, 208, 1, 8),
(209, 209, 1, 6),
(210, 210, 1, 6),
(211, 211, 1, 8),
(212, 212, 1, 8),
(213, 213, 1, 8),
(214, 214, 1, 6),
(215, 215, 1, 7),
(216, 216, 1, 8),
(217, 217, 1, 7),
(218, 218, 1, 8),
(219, 219, 1, 6),
(220, 220, 1, 8),
(221, 221, 1, 7),
(222, 222, 1, 7),
(223, 223, 1, 6),
(224, 224, 1, 7),
(225, 225, 1, 6),
(226, 226, 1, 6),
(227, 227, 1, 7),
(228, 228, 1, 7),
(229, 229, 1, 6),
(230, 230, 1, 7),
(231, 231, 1, 8),
(232, 232, 1, 6),
(233, 233, 1, 7),
(234, 234, 1, 7),
(235, 235, 1, 6),
(236, 236, 1, 5),
(237, 237, 1, 5),
(238, 238, 1, 5),
(239, 239, 1, 5),
(240, 240, 1, 5),
(241, 241, 1, 5),
(242, 242, 1, 5),
(243, 243, 1, 5),
(244, 244, 1, 5),
(245, 245, 1, 5),
(246, 246, 1, 5),
(247, 247, 1, 5),
(248, 248, 1, 5),
(249, 249, 1, 5),
(250, 250, 1, 5),
(251, 251, 1, 5),
(252, 252, 1, 5),
(253, 253, 1, 5),
(254, 254, 1, 5),
(255, 255, 1, 5),
(256, 256, 1, 5),
(257, 257, 1, 5),
(258, 258, 1, 5),
(259, 259, 1, 5),
(260, 260, 1, 5),
(261, 261, 1, 5),
(262, 262, 1, 5),
(263, 263, 1, 5),
(264, 264, 1, 5),
(265, 265, 1, 5),
(266, 266, 1, 5),
(267, 267, 1, 5),
(268, 268, 1, 5),
(269, 269, 1, 5),
(270, 270, 1, 5),
(271, 271, 1, 5),
(272, 272, 1, 5),
(273, 273, 1, 5),
(274, 274, 1, 5),
(275, 275, 1, 5),
(276, 276, 1, 5),
(277, 277, 1, 5),
(278, 278, 1, 5),
(279, 279, 1, 5),
(280, 280, 1, 5),
(281, 281, 1, 5),
(282, 282, 1, 5),
(283, 283, 1, 5),
(284, 284, 1, 5),
(285, 285, 1, 5),
(286, 286, 1, 5),
(287, 287, 1, 5),
(288, 288, 1, 5),
(289, 289, 1, 5),
(290, 290, 1, 5),
(291, 291, 1, 5),
(292, 292, 1, 5),
(293, 293, 1, 5),
(294, 294, 1, 5),
(295, 295, 1, 5),
(296, 296, 1, 5),
(297, 297, 1, 5),
(298, 298, 1, 5),
(299, 299, 1, 5),
(300, 300, 1, 5),
(301, 301, 1, 5),
(302, 302, 1, 5),
(303, 303, 1, 5),
(304, 304, 1, 5),
(305, 305, 1, 5),
(306, 306, 1, 5),
(307, 307, 1, 5),
(308, 308, 1, 5),
(309, 309, 1, 5),
(310, 310, 1, 5),
(311, 311, 1, 5),
(312, 312, 1, 5),
(313, 313, 1, 5),
(314, 314, 1, 5),
(315, 315, 1, 5),
(316, 316, 1, 5),
(317, 317, 1, 5),
(318, 318, 1, 5),
(319, 319, 1, 5),
(320, 320, 1, 5),
(321, 321, 1, 5),
(322, 322, 1, 7),
(323, 323, 1, 5),
(324, 324, 1, 8),
(325, 325, 1, 7),
(326, 326, 1, 6),
(327, 327, 1, 7),
(328, 328, 1, 6),
(329, 329, 1, 6),
(330, 330, 1, 6),
(331, 331, 1, 7),
(332, 332, 1, 8),
(333, 333, 1, 6),
(334, 334, 1, 6),
(335, 335, 1, 8),
(336, 336, 1, 8),
(337, 337, 1, 6),
(338, 338, 1, 6),
(339, 339, 1, 8),
(340, 340, 1, 5),
(341, 341, 1, 6),
(342, 342, 1, 5),
(343, 343, 1, 6),
(344, 344, 1, 6),
(345, 345, 1, 8),
(346, 346, 1, 6),
(347, 347, 1, 5),
(348, 348, 1, 6),
(349, 349, 1, 6),
(350, 350, 1, 6),
(351, 351, 1, 7),
(352, 352, 1, 7),
(353, 353, 1, 5),
(354, 354, 1, 8),
(355, 356, 1, 9),
(356, 355, 1, 7),
(357, 101, 1, 1),
(358, 102, 1, 1),
(359, 103, 1, 1);

-- --------------------------------------------------------

-- 
-- table structure for table `student_schedule`
-- 

DROP TABLE IF EXISTS `student_schedule`;
CREATE TABLE IF NOT EXISTS `student_schedule` (
  `student_schedule_id` int(11) NOT NULL auto_increment,
  `student_schedule_studentid` int(11) NOT NULL default '0',
  `student_schedule_year` int(11) NOT NULL default '0',
  `student_schedule_schoolid` int(11) NOT NULL default '0',
  `student_schedule_schedid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`student_schedule_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `student_schedule`
-- 

INSERT INTO `student_schedule` (`student_schedule_id`, `student_schedule_studentid`, `student_schedule_year`, `student_schedule_schoolid`, `student_schedule_schedid`) VALUES 
(1, 3, 1, 7, 4),
(2, 6, 1, 7, 4),
(3, 9, 1, 7, 4),
(4, 11, 1, 7, 4),
(5, 12, 1, 7, 4),
(6, 1, 1, 7, 18),
(7, 5, 1, 7, 18),
(8, 10, 1, 7, 18),
(9, 8, 1, 7, 18),
(10, 13, 1, 7, 18),
(11, 14, 1, 7, 18),
(12, 15, 1, 7, 18),
(13, 17, 1, 7, 18),
(14, 23, 1, 7, 18),
(15, 49, 1, 7, 18),
(16, 66, 1, 7, 20),
(17, 2, 1, 7, 20),
(18, 7, 1, 7, 20),
(19, 16, 1, 7, 20),
(20, 6, 1, 7, 14),
(21, 9, 1, 7, 14),
(22, 11, 1, 7, 14);

-- --------------------------------------------------------

-- 
-- table structure for table `studentbio`
-- 

DROP TABLE IF EXISTS `studentbio`;
CREATE TABLE IF NOT EXISTS `studentbio` (
  `studentbio_id` int(10) unsigned NOT NULL auto_increment,
  `studentbio_internalid` varchar(20) NOT NULL default '',
  `studentbio_active` smallint(5) unsigned NOT NULL default '0',
  `studentbio_lname` varchar(30) NOT NULL default '',
  `studentbio_fname` varchar(30) NOT NULL default '',
  `studentbio_mi` varchar(5) default NULL,
  `studentbio_generation` smallint(5) unsigned default NULL,
  `studentbio_sped` smallint(5) unsigned default NULL,
  `studentbio_gender` varchar(6) NOT NULL default '',
  `studentbio_ethnicity` smallint(5) unsigned NOT NULL default '0',
  `studentbio_dob` date NOT NULL default '0000-00-00',
  `studentbio_birthcity` varchar(50) default NULL,
  `studentbio_birthstate` varchar(30) default NULL,
  `studentbio_birthcountry` varchar(40) default NULL,
  `studentbio_prevschoolname` varchar(40) default NULL,
  `studentbio_prevschooladdress` varchar(40) default NULL,
  `studentbio_prevschoolcity` varchar(40) default NULL,
  `studentbio_prevschoolstate` varchar(30) default NULL,
  `studentbio_prevschoolzip` varchar(10) default NULL,
  `studentbio_prevschoolcountry` varchar(40) default NULL,
  `studentbio_school` smallint(5) unsigned default NULL,
  `studentbio_homed` smallint(5) unsigned default NULL,
  `studentbio_primarycontact` smallint(5) unsigned default NULL,
  `studentbio_teacher` int(10) unsigned default NULL,
  `studentbio_homeroom` varchar(20) default NULL,
  `studentbio_bus` varchar(20) default NULL,
  PRIMARY KEY  (`studentbio_id`),
  KEY `studentbio_internalidndx` (`studentbio_internalid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `studentbio`
-- 

INSERT INTO `studentbio` (`studentbio_id`, `studentbio_internalid`, `studentbio_active`, `studentbio_lname`, `studentbio_fname`, `studentbio_mi`, `studentbio_generation`, `studentbio_sped`, `studentbio_gender`, `studentbio_ethnicity`, `studentbio_dob`, `studentbio_birthcity`, `studentbio_birthstate`, `studentbio_birthcountry`, `studentbio_prevschoolname`, `studentbio_prevschooladdress`, `studentbio_prevschoolcity`, `studentbio_prevschoolstate`, `studentbio_prevschoolzip`, `studentbio_prevschoolcountry`, `studentbio_school`, `studentbio_homed`, `studentbio_primarycontact`, `studentbio_teacher`, `studentbio_homeroom`, `studentbio_bus`) VALUES 
(1, '410015', 1, 'Abrahams', 'Hosta', 'S', 4, NULL, 'Male', 5, '1992-05-19', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 1, 4, '2', '12'),
(2, '410092', 1, 'Ahearn', 'Chester', 'M', 4, NULL, 'Female', 5, '1993-02-07', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 2, 4, '2', '8'),
(3, '409002', 1, 'Antonivik', 'Hannah', 'L', 4, 0, 'Female', 5, '1990-12-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 0, 3, 4, '2', '8'),
(4, '410080', 1, 'Rogers', 'Tyler', 'J', 4, NULL, 'Male', 5, '1992-07-20', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 4, 4, '2', '8'),
(5, '409119', 1, 'Aprim', 'Sally', 'L', 4, NULL, 'Female', 5, '1992-06-11', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 5, 4, '2', '1'),
(6, '409068', 1, 'Banister', 'Benjamin', 'M', 4, NULL, 'Male', 5, '1991-04-20', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 6, 4, '2', '14'),
(7, '410102', 1, 'Baker', 'Robert', 'J', 4, NULL, 'Male', 5, '1993-04-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 7, 4, '2', '2'),
(8, '410018', 1, 'Billipoue', 'Amanda', 'L', 4, NULL, 'Female', 5, '1991-12-01', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 8, 4, '2', '14'),
(9, '409004', 1, 'Bergeroux', 'Michael', 'J', 4, NULL, 'Male', 5, '1990-10-17', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 9, 4, '2', '14'),
(10, '410019', 1, 'Bergeroux', 'Shaun', 'T', 4, NULL, 'Male', 5, '1992-05-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 10, 4, '2', '12'),
(11, '409005', 1, 'Bergers', 'Steven', 'E', 4, NULL, 'Male', 5, '1990-10-30', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 11, 4, '2', '12'),
(12, '409070', 1, 'Bilodoux', 'Krystyn', 'L', 4, NULL, 'Female', 5, '1991-05-21', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 12, 4, '2', '11'),
(13, '410140', 1, 'Bouvier', 'Lauren', 'E', 4, NULL, 'Female', 5, '1992-03-08', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 13, 4, '2', '4'),
(14, '410021', 1, 'Boxley', 'Jennifer', 'L', 4, NULL, 'Female', 5, '1992-08-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 14, 4, '2', '6'),
(15, '410023', 1, 'Braggart', 'Curt', 'A', 4, NULL, 'Male', 5, '1991-12-11', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 15, 4, '2', '6'),
(16, '410126', 1, 'Browne', 'Louise', 'M', 4, NULL, 'Female', 5, '1992-11-08', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 16, 4, '2', '6'),
(17, '410024', 1, 'Brownstone', 'Samantha', 'R', 4, NULL, 'Female', 5, '1991-10-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 17, 4, '2', '5'),
(18, '409071', 1, 'Burne', 'Joshua', 'A', 4, NULL, 'Male', 5, '1990-10-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 18, 4, '2', '3'),
(19, '408015', 1, 'Cameron  III', 'Ralph', 'J', 4, NULL, 'Male', 5, '1990-09-22', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 19, 4, '2', '14'),
(20, '409008', 1, 'Calder', 'Ashley', 'J', 4, NULL, 'Female', 5, '1990-11-21', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 20, 4, '2', '13'),
(21, '410110', 1, 'Carterman', 'Alexis', 'L', 4, NULL, 'Female', 5, '1992-10-08', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 21, 4, '2', '14'),
(22, '410100', 1, 'Chaptown', 'Melissa', 'J', 4, NULL, 'Female', 5, '1993-01-27', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 22, 4, '2', '8'),
(23, '410139', 1, 'Charton', 'Laurie', 'F', 4, NULL, 'Female', 5, '1992-07-24', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 23, 4, '2', '4'),
(24, '410026', 1, 'Chase', 'John', 'B', 4, NULL, 'Male', 5, '1991-12-28', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 24, 4, '2', '4'),
(25, '410123', 1, 'Corburn', 'Michael', 'J', 4, NULL, 'Male', 5, '1993-07-28', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 25, 4, '2', '7'),
(26, '410121', 1, 'Crockster', 'Scott', 'D', 4, NULL, 'Male', 5, '1993-03-10', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 26, 4, '2', '4'),
(27, '410030', 1, 'Crosstown', 'Ashley', 'M', 4, NULL, 'Female', 5, '1991-11-15', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 27, 4, '2', '10'),
(28, '410008', 1, 'Crosstown', 'Chelsea', 'A', 4, NULL, 'Female', 5, '1992-09-27', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 28, 4, '2', '6'),
(29, '410120', 1, 'Dashbin', 'Katrina', 'M', 4, NULL, 'Female', 5, '1993-02-17', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 29, 4, '2', '5'),
(30, '409073', 1, 'D''Annolfo', 'Natalie', 'L', 4, NULL, 'Female', 5, '1991-07-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 30, 4, '2', '13'),
(31, '409118', 1, 'Delvin', 'Samisser', 'N', 4, NULL, 'Female', 5, '1991-10-30', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 31, 4, '2', '9'),
(32, '409011', 1, 'Dumais', 'Breanna-Jean', 'M', 4, NULL, 'Female', 5, '1991-01-09', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 32, 4, '2', '12'),
(33, '409012', 1, 'Provenchal', 'Stefanie', 'R', 4, NULL, 'Female', 5, '1991-09-16', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 33, 4, '2', '14'),
(34, '410082', 1, 'DeStevens', 'Mitchell', 'S', 4, NULL, 'Male', 5, '1992-02-27', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 34, 4, '2', '14'),
(35, '410108', 1, 'Donnolly', 'Michael', 'R', 4, NULL, 'Male', 5, '1993-04-13', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 35, 4, '2', '11'),
(36, '410032', 1, 'Douvier', 'Tymin', 'J', 4, NULL, 'Male', 5, '1992-07-22', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 36, 4, '2', '5'),
(37, '408027', 1, 'Downer', 'Jervald', 'W', 4, NULL, 'Male', 5, '1990-07-20', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 37, 4, '2', '12'),
(38, '408029', 1, 'Downcast', 'Patricia', 'A', 4, NULL, 'Female', 5, '1990-06-17', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 38, 4, '2', '2'),
(39, '410033', 1, 'Dufoustie, III', 'Kevein', 'G', 4, NULL, 'Male', 5, '1992-05-06', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 39, 4, '2', '3'),
(40, '410130', 1, 'Eatimmer', 'Brandon', 'J', 4, NULL, 'Male', 5, '1993-01-18', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 40, 4, '2', '13'),
(41, '409015', 1, 'Eataxer', 'Marc', 'W', 4, NULL, 'Male', 5, '1991-04-03', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 41, 4, '2', '6'),
(42, '410061', 1, 'Elliville', 'Leon', 'F', 4, NULL, 'Male', 5, '1992-02-07', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 42, 4, '2', '6'),
(43, '410128', 1, 'Evansheer', 'Sarah', 'A', 4, NULL, 'Female', 5, '1993-03-26', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 43, 4, '2', '3'),
(44, '409074', 1, 'Frist', 'Sheila', 'E', 4, NULL, 'Female', 5, '1991-05-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 44, 4, '2', '3'),
(45, '410109', 1, 'Fearch, IV', 'Charles', 'H', 4, NULL, 'Male', 5, '1993-07-19', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 45, 4, '2', '6'),
(46, '409120', 1, 'Fornier', 'Jeremy', 'B', 4, NULL, 'Male', 5, '1992-03-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 46, 4, '2', '13'),
(47, '410035', 1, 'Fousier', 'William', 'S', 4, NULL, 'Male', 5, '1992-09-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 47, 4, '2', '5'),
(48, '410065', 1, 'Framatose', 'Healey', 'N', 4, NULL, 'Female', 5, '1992-07-24', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 48, 4, '2', '2'),
(49, '410038', 1, 'Gardner', 'Kim', 'E', 4, NULL, 'Female', 5, '1992-07-18', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 49, 4, '2', '6'),
(50, '410115', 1, 'Gardner', 'Rae-leen', 'E', 4, NULL, 'Female', 5, '1993-08-11', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 50, 4, '2', '14'),
(51, '409117', 1, 'Gardner', 'Shapilia', 'L', 4, NULL, 'Female', 5, '1992-02-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 51, 4, '2', '4'),
(52, '409020', 1, 'Gaurion', 'Gregory', 'J', 4, NULL, 'Male', 5, '1991-07-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 52, 4, '2', '12'),
(53, '408128', 1, 'Gentius', 'Brittney', 'A', 4, NULL, 'Female', 5, '1991-03-09', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 53, 4, '2', '14'),
(54, '410039', 1, 'Gerantile', 'Sean', 'K', 4, NULL, 'Male', 5, '1992-09-25', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 54, 4, '2', '8'),
(55, '410134', 1, 'Gossimer', 'Lisa', 'N', 4, NULL, 'Female', 5, '1992-12-17', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 55, 4, '2', '5'),
(56, '409021', 1, 'Grandare', 'Priscilla', 'M', 4, NULL, 'Female', 5, '1990-10-05', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 56, 4, '2', '11'),
(57, '410040', 1, 'Griggoni', 'Erika', 'L', 4, NULL, 'Female', 5, '1992-06-01', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 57, 4, '2', '3'),
(58, '410097', 1, 'Grinnim', 'Adam', 'J', 4, NULL, 'Male', 5, '1993-02-18', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 58, 4, '2', '8'),
(59, '410041', 1, 'Haybale', 'Amanda', 'L', 4, NULL, 'Female', 5, '1992-02-25', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 59, 4, '2', '14'),
(60, '409022', 1, 'Halliton', 'Mika', 'F', 4, NULL, 'Male', 5, '1990-12-20', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 60, 4, '2', '2'),
(61, '409121', 1, 'Haywood', 'Brian', 'F', 4, NULL, 'Male', 5, '1992-08-19', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 61, 4, '2', '10'),
(62, '410106', 1, 'Hillion', 'Cameron', 'L', 4, NULL, 'Male', 5, '1993-04-18', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 62, 4, '2', '1'),
(63, '410062', 1, 'Marston', 'Robbin', '', 4, NULL, 'Female', 5, '1992-08-10', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 63, 4, '2', '5'),
(64, '409075', 1, 'Hinton', 'Jameston', 'M', 4, NULL, 'Male', 5, '1990-12-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 64, 4, '2', '2'),
(65, '410118', 1, 'Houmen', 'Adam', 'E', 4, NULL, 'Male', 5, '1993-06-29', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 65, 4, '2', '6'),
(66, '409024', 1, 'Jirvin', 'Duston', 'A', 4, NULL, 'Male', 5, '1990-12-03', 'Tilmasic', 'Arkansas', 'USA', 'Tilmasic Elementary', NULL, 'Tilamsic', 'Arkansas', '45356', 'USA', 7, NULL, 66, 4, '2', '10'),
(67, '409025', 1, 'Jacobman', 'Carlos', 'E', 4, NULL, 'Male', 5, '1991-02-12', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 67, 4, '2', '4'),
(68, '410064', 1, 'Janniton', 'Cassandra', 'L', 4, NULL, 'Female', 5, '1992-07-12', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 68, 4, '2', '3'),
(69, '409027', 1, 'Kentman', 'Nicola', 'C', 4, NULL, 'Female', 5, '1991-08-02', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 69, 4, '2', '12'),
(70, '411064', 1, 'Knowles', 'Brandy', '', 4, NULL, 'Female', 5, '1993-05-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 70, 4, '2', '2'),
(71, '410043', 1, 'Knowle', 'Chelsea', 'R', 4, NULL, 'Female', 5, '1992-06-05', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 71, 4, '2', '2'),
(72, '410044', 1, 'Knowledge', 'Harold', 'R', 4, NULL, 'Male', 5, '1991-10-08', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 72, 4, '2', '10'),
(73, '410093', 1, 'Knomes', 'Jasper', 'S', 4, NULL, 'Male', 5, '1993-06-24', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 73, 4, '2', '10'),
(74, '408056', 1, 'Konosta', 'Lance', 'R', 4, NULL, 'Male', 5, '1990-09-30', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 74, 4, '2', '14'),
(75, '410046', 1, 'Kearns', 'Steven', 'A', 4, NULL, 'Male', 5, '1992-02-09', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 75, 4, '2', '14'),
(76, '408058', 1, 'Lennon', 'Anna-Jane', 'L', 4, NULL, 'Female', 5, '1990-09-11', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 76, 4, '2', '8'),
(77, '409017', 1, 'Litchen', 'Randall', 'G', 4, NULL, 'Male', 5, '1991-02-22', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 77, 4, '2', '1'),
(78, '410076', 1, 'MacKown', 'Brandon', 'S', 4, NULL, 'Male', 5, '1992-09-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 78, 4, '2', '12'),
(79, '410070', 1, 'Magiar', 'Jessica', 'R', 4, NULL, 'Female', 5, '1992-03-29', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 79, 4, '2', '11'),
(80, '410050', 1, 'Marshton', 'Anna', 'E', 4, NULL, 'Female', 5, '1991-11-07', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 80, 4, '2', '5'),
(81, '410098', 1, 'Manston', 'Andrea', 'L', 4, NULL, 'Female', 5, '1993-01-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 81, 4, '2', '8'),
(82, '410101', 1, 'Mawton', 'Nathaniel', 'G', 4, NULL, 'Male', 5, '1992-11-21', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 82, 4, '2', '7'),
(83, '409028', 1, 'Melevere', 'Cody', 'J', 4, NULL, 'Male', 5, '1991-04-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 83, 4, '2', '14'),
(84, '410051', 1, 'Mastrum', 'Justin', 'M', 4, NULL, 'Male', 5, '1992-09-30', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 84, 4, '2', '5'),
(85, '409029', 1, 'Merville', 'Shamaya', 'D', 4, NULL, 'Female', 5, '1991-03-08', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 85, 4, '2', '12'),
(86, '410099', 1, 'Millsark', 'Patty', 'L', 4, NULL, 'Female', 5, '1993-02-28', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 86, 4, '2', '12'),
(87, '410068', 1, 'Quizzi', 'Daynevon', 'E', 4, NULL, 'Male', 5, '1991-11-15', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 87, 4, '2', '7'),
(88, '410052', 1, 'Mooreston', 'Jonson', 'S', 4, NULL, 'Female', 5, '1992-06-17', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 88, 4, '2', '6'),
(89, '409030', 1, 'Moxton', 'Shanya', 'G', 4, NULL, 'Male', 5, '1991-03-31', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 89, 4, '2', '12'),
(90, '409031', 1, 'Nickers', 'Johan', 'J', 4, NULL, 'Male', 5, '1991-05-11', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 90, 4, '2', '8'),
(91, '410132', 1, 'Nuddmirt', 'Kaimley', 'S', 4, NULL, 'Male', 5, '1992-10-14', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 91, 4, '2', '13'),
(92, '409032', 1, 'Owens', 'Sebastian', 'B', 4, NULL, 'Male', 4, '1990-12-23', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 92, 4, '2', '10'),
(93, '409098', 1, 'Patterman', 'Audrey', 'H', 4, NULL, 'Female', 5, '1990-11-20', NULL, NULL, NULL, 'Kissimmee Middle', NULL, 'Kissimmee', NULL, NULL, '', 7, NULL, 93, 4, '2', '2'),
(94, '410089', 1, 'Perkins', 'Ashley', 'A', 4, NULL, 'Female', 5, '1993-05-24', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 94, 4, '2', '6'),
(95, '410111', 1, 'Perkin', 'Timothy', 'W', 4, NULL, 'Male', 5, '1993-09-02', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 95, 4, '2', '14'),
(96, '410054', 1, 'Prescott', 'Maynley', 'L', 4, NULL, 'Female', 5, '1992-01-09', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 96, 4, '2', '13'),
(97, '411075', 1, 'Pricetree', 'Bobbie', 'M', 4, NULL, 'Female', 5, '1993-08-04', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 97, 4, '2', '4'),
(98, '410075', 1, 'Pricetree', 'Sara', 'F', 4, NULL, 'Female', 5, '1992-01-31', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 98, 4, '2', '4'),
(99, '408078', 1, 'Fordmall', 'Andrew', 'F', 4, NULL, 'Male', 5, '1990-08-01', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 99, 4, '2', '5'),
(100, '410055', 1, 'Fordmall', 'Robert', 'G', 4, NULL, 'Male', 5, '1992-09-24', NULL, NULL, NULL, '', NULL, '', NULL, NULL, '', 7, NULL, 100, 4, '2', '5');

-- --------------------------------------------------------

-- 
-- table structure for table `studentbio_pictures`
-- 

DROP TABLE IF EXISTS `studentbio_pictures`;
CREATE TABLE IF NOT EXISTS `studentbio_pictures` (
  `id` int(11) NOT NULL auto_increment,
  `studentid` int(11) NOT NULL default '0',
  `picturepath` char(255) default NULL,
  `grade` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `studentbio_pictures`
-- 

INSERT INTO `studentbio_pictures` (`id`, `studentid`, `picturepath`, `grade`) VALUES 
(1, 49, 'pictures/49_7_1167748859.jpeg', 7),
(2, 49, 'pictures/49_6_1167748862.jpeg', 6),
(3, 45, 'pictures/45_6_1167748924.jpeg', 6),
(4, 45, 'pictures/45_5_1167749069.jpeg', 5),
(5, 100, 'pictures/100_6_1167749092.jpeg', 6);

-- --------------------------------------------------------

-- 
-- table structure for table `studentcontact`
-- 

DROP TABLE IF EXISTS `studentcontact`;
CREATE TABLE IF NOT EXISTS `studentcontact` (
  `studentcontact_id` int(10) unsigned NOT NULL auto_increment,
  `studentcontact_studentid` int(10) unsigned default NULL,
  `studentcontact_title` int(10) NOT NULL default '0',
  `studentcontact_fname` varchar(30) default NULL,
  `studentcontact_lname` varchar(30) default NULL,
  `studentcontact_address1` varchar(40) default NULL,
  `studentcontact_address2` varchar(40) default NULL,
  `studentcontact_city` varchar(30) default NULL,
  `studentcontact_state` char(2) default NULL,
  `studentcontact_zip` varchar(10) default NULL,
  `studentcontact_phone1` varchar(20) default NULL,
  `studentcontact_phone2` varchar(20) default NULL,
  `studentcontact_phone3` varchar(20) default NULL,
  `studentcontact_email` varchar(70) default NULL,
  `studentcontact_other` tinytext,
  `studentcontact_mailings` smallint(5) unsigned default NULL,
  `studentcontact_year` int(11) NOT NULL default '0',
  `studentcontact_primary` int(11) NOT NULL default '0',
  PRIMARY KEY  (`studentcontact_id`),
  KEY `studentcontact_studentidndx` (`studentcontact_studentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `studentcontact`
-- 

INSERT INTO `studentcontact` (`studentcontact_id`, `studentcontact_studentid`, `studentcontact_title`, `studentcontact_fname`, `studentcontact_lname`, `studentcontact_address1`, `studentcontact_address2`, `studentcontact_city`, `studentcontact_state`, `studentcontact_zip`, `studentcontact_phone1`, `studentcontact_phone2`, `studentcontact_phone3`, `studentcontact_email`, `studentcontact_other`, `studentcontact_mailings`, `studentcontact_year`, `studentcontact_primary`) VALUES 
(1, 1, 4, 'Amy', 'Davenport', '96 North Main Street', NULL, 'Seatown', 'NJ', '12566', '432-5768', '844-1673', NULL, NULL, NULL, 1, 1, 1),
(2, 2, 3, 'Raymond', 'Welch, Jr.', '43 Wimbley Street', NULL, 'Seatown', 'NJ', '12566', '432-9913', '908-461-7481', NULL, NULL, NULL, 1, 1, 1),
(3, 3, 0, 'Ann', 'Antoinette', '201A South Wall Street', NULL, 'Seatown', 'NJ', '12566', '432-1891', '879-1270', NULL, 'leinfellner@yeshua.at', NULL, 1, 1, 1),
(4, 4, 1, 'Michelle', 'Heytown', '231 Strong Street', NULL, 'Seatown', 'NJ', '12566', '432-2144', '471-1124', NULL, NULL, NULL, 1, 1, 1),
(5, 5, 1, 'Cora', 'Welmonth', '6 Jasmine Park', NULL, 'Seatown', 'NJ', '12566', '555-1206', '998-7988', NULL, NULL, NULL, 1, 1, 1),
(6, 6, 3, 'Donald', 'Bagstrom', '505 Railmont Avenue', NULL, 'Seatown', 'NJ', '12566', '432-5634', '908-365-7640', NULL, NULL, NULL, 1, 1, 1),
(7, 7, 1, 'Mindi', 'Brandon', '119 Upper Belknap St.', NULL, 'Seatown', 'NJ', '12566', '435-0978 cel', '430-1922', NULL, NULL, NULL, 1, 1, 1),
(8, 8, 3, 'Mark', 'Beaumont', '119 Faeston Lane', NULL, 'Seatown', 'NJ', '12566', '459-2146', '', NULL, NULL, NULL, 1, 1, 1),
(9, 9, 3, 'Michael', 'Bergermont', '16 Kathytown Drive', NULL, 'Seatown', 'NJ', '12566', '432-3589', '', NULL, NULL, NULL, 1, 1, 1),
(10, 10, 3, 'Chaz', 'Bergermont', '49 Lincoln Ave.', NULL, 'Seatown', 'NJ', '12566', '432-2384', '', NULL, NULL, NULL, 1, 1, 1),
(11, 11, 3, 'Chaz', 'Bergstrom', '49 Lincoln Ave.', NULL, 'Seatown', 'NJ', '12566', '434-2384', '', NULL, NULL, NULL, 1, 1, 1),
(12, 12, 3, 'Robert', 'Biloxmou', '27 Spring Street', NULL, 'Seatown', 'NJ', '12566', '443-2148', '432-5555', NULL, NULL, NULL, 1, 1, 1),
(13, 13, 1, 'Tracy', 'Broutime', '177 Cinnamon Drive', NULL, 'Seatown', 'NJ', '12566', '432-3817', '997-1633', NULL, NULL, NULL, 1, 1, 1),
(14, 14, 3, 'Jason', 'Boxton', '16 Bovine Way', NULL, 'Seatown', 'NJ', '12566', '432-7374', '908-241-8774', NULL, NULL, NULL, 1, 1, 1),
(15, 15, 3, 'Kyle', 'Braggster', '137 Dimlight Avenue', NULL, 'Seatown', 'NJ', '12566', '432-1680', '941-2694', NULL, NULL, NULL, 1, 1, 1),
(16, 16, 3, 'Steven', 'Brownstone', '3 Middle Brook Road', NULL, 'Seatown', 'NJ', '12566', '432-3615', '940-6040', NULL, NULL, NULL, 1, 1, 1),
(17, 17, 3, 'Pierce', 'Brownville', '43 HighOak Road', NULL, 'Seatown', 'NJ', '12566', '925-3911', '947-6280', NULL, NULL, NULL, 1, 1, 1),
(18, 18, 2, 'Fred', 'Brunsmin', '20 Lesser Lane', NULL, 'Seatown', 'NJ', '12566', '397-0913', '976-452-5711', NULL, NULL, NULL, 1, 1, 1),
(19, 19, 2, 'Richard', 'Cameron Jr.', '17 Tractor Lane', NULL, 'Seatown', 'NJ', '12566', '432-5608', '438-0525', NULL, NULL, NULL, 1, 1, 1),
(20, 20, 3, 'Dervish', 'Calderman', '85 Dowjones Lane', NULL, 'Seatown', 'NJ', '12566', '432-2749', '947-5471', NULL, NULL, NULL, 1, 1, 1),
(21, 21, 3, 'Oman', 'Carterman', '93 Treetop Avenue', NULL, 'Seatown', 'NJ', '12566', '432-5644', '990-1844', NULL, NULL, NULL, 1, 1, 1),
(22, 22, 1, 'Kim', 'Chapster', '117 Upper Frypan Street', NULL, 'Seatown', 'NJ', '12566', '432-5493', '479-5481', NULL, NULL, NULL, 1, 1, 1),
(23, 23, 3, 'Mark', 'Chartruese', '66 Stone Road', NULL, 'Seatown', 'NJ', '12566', '398-7732', '978-934-9434', NULL, NULL, NULL, 1, 1, 1),
(24, 24, 1, 'Terrance', 'Chasmine', '111 Cimaville Dr.  B16', NULL, 'Seatown', 'NJ', '12566', '432-8964', '479-3229', NULL, NULL, NULL, 1, 1, 1),
(25, 25, 3, 'Mitchell', 'Corburn', '399 Dearston Avenue', NULL, 'Seatown', 'NJ', '12566', '432-7664', '979-211-1161', NULL, NULL, NULL, 1, 1, 1),
(26, 26, 2, 'Scoty', 'Crockvine', '118 Castle Dr.   C7', NULL, 'Seatown', 'NJ', '12566', '432-7129', '', NULL, NULL, NULL, 1, 1, 1),
(27, 27, 3, 'Roy', 'Crosshatch', '187 Prairie Road', NULL, 'Seatown', 'NJ', '12566', '604-8940', '928-6339', NULL, NULL, NULL, 1, 1, 1),
(28, 28, 3, 'Mark', 'Crossmat', '27 Select Avenue', NULL, 'Seatown', 'NJ', '12566', '432-2299', '202-4397', NULL, NULL, NULL, 1, 1, 1),
(29, 29, 2, 'William', 'Dalehamp', '18 Old Maple Road', NULL, 'Seatown', 'NJ', '12566', '923-8028', '432-5381', NULL, 'dougp25@yahoo.com', NULL, 1, 1, 1),
(30, 30, 1, 'Amy', 'D''Annolfo', '91 Lafayette Rd.', NULL, 'Seatown', 'NJ', '12566', '924-1280', NULL, NULL, NULL, NULL, 1, 1, 1),
(31, 31, 3, 'Stephen', 'Delmonico', '19 Milton Turnpike', NULL, 'Seatown', 'NJ', '12566', '432-5391', '771-4711', NULL, NULL, NULL, 1, 1, 1),
(32, 32, 3, 'Johannes', 'Dumais', '16 Theodore Street', NULL, 'Seatown', 'NJ', '12566', '432-4216', '866-210-3159', NULL, NULL, NULL, 1, 1, 1),
(33, 33, 4, 'Anne', 'Rowman', '11B Farmtown Lane', NULL, 'Seatown', 'NJ', '12566', '432-2284', '', NULL, NULL, NULL, 1, 1, 1),
(34, 34, 1, 'Denise', 'Vasamincini', '17 Cassandra Drive', NULL, 'Seatown', 'NJ', '12566', '432-8306', '751-958-6730', NULL, 'dvach@vacher.edu', NULL, 1, 1, 1),
(35, 35, 3, 'Michael', 'Dovenly, Sr.', '113 Pine Tree Drive', NULL, 'Seatown', 'NJ', '12566', '432-3512', '', NULL, NULL, NULL, 1, 1, 1),
(36, 36, 3, 'Larry', 'Dosterpack', '48 Mapletown Road', NULL, 'Seatown', 'NJ', '12566', '927-8217', '808-731-7692', NULL, NULL, NULL, 1, 1, 1),
(37, 37, 3, 'Jameson', 'Downeast', '79 Wilmington Street', NULL, 'Seatown', 'NJ', '12566', '432-2029', '', NULL, NULL, NULL, 1, 1, 1),
(38, 38, 4, 'Anneville', 'Streemer', '224 Brookstone Road', NULL, 'Seatown', 'NJ', '12566', '432-0518', '', NULL, NULL, NULL, 1, 1, 1),
(39, 39, 3, 'Jerry', 'Dumont', '11 Peter Dixon Way', NULL, 'Seatown', 'NJ', '12566', '928-0129', '432-3944', NULL, NULL, NULL, 1, 1, 1),
(40, 40, 3, 'James', 'Santonivich', '45 Brown Lane', NULL, 'Seatown', 'NJ', '12566', '432-0611', '432-6891', NULL, NULL, NULL, 1, 1, 1),
(41, 41, 4, 'Katherine', 'Endon', '301 Railroad Trestle Avenue', NULL, 'Seatown', 'NJ', '12566', '432-2577', '432-5380', NULL, NULL, NULL, 1, 1, 1),
(42, 42, 1, 'Barbara', 'Ellisman', '10 A Whitehouse Rd', NULL, 'Seatown', 'NJ', '12566', '432-8033', '555-9357', NULL, NULL, NULL, 1, 1, 1),
(43, 43, 2, 'James', 'Evenstart', '96 Torro Drive', NULL, 'Seatown', 'NJ', '12566', '432-2539', '970-412-6883', NULL, NULL, NULL, 1, 1, 1),
(44, 44, 1, 'Maureen', 'Fayton-Vark', '19B Bigaddle Lane', NULL, 'Seatown', 'NJ', '12566', '391-9773', '209-2612 cel', NULL, NULL, NULL, 1, 1, 1),
(45, 45, 1, 'Vicki', 'Fieldstone', '71 Perrionista Lane', NULL, 'Seatown', 'NJ', '12566', '432-7111', '', NULL, NULL, NULL, 1, 1, 1),
(46, 46, 3, 'Sherman', 'Forcible', ' PO Box 971', NULL, 'Lincoln Park', 'NJ', '15563', '432-7887', '924-6228', NULL, NULL, NULL, 1, 1, 1),
(47, 47, 2, 'Glenn', 'Fromier', '37 Bigtop Avenue', NULL, 'Seatown', 'NJ', '12566', '928-1228', '961-5938', NULL, NULL, NULL, 1, 1, 1),
(48, 48, 1, 'Tonia', 'Frisconti', '45 Kuzeja Street', NULL, 'Seatown', 'NJ', '12566', '432-3448', '503-4997 cel', NULL, NULL, NULL, 1, 1, 1),
(49, 49, 3, 'Brian', 'Bouissier', '19 Mitterton Drive', NULL, 'Seatown', 'NJ', '12566', '432-8447', '', NULL, NULL, NULL, 1, 1, 1),
(50, 50, 1, 'Tammy', 'Farmer', '117 Gardner Lane', NULL, 'Seatown', 'NJ', '12566', '432-7696', '432-9551', NULL, NULL, NULL, 1, 1, 1),
(51, 51, 1, 'Linda', 'Grandon', '53A Blackwater Road', NULL, 'Seatown', 'NJ', '12566', '391-7774', '974-794-5991', NULL, NULL, NULL, 1, 1, 1),
(52, 52, 3, 'Scott', 'Goshein', '91 Meryl Drive', NULL, 'Seatown', 'NJ', '12566', '432-3554', '471-9662', NULL, NULL, NULL, 1, 1, 1),
(53, 53, 3, 'Michael', 'Gentleman', '118 Truepart Lane', NULL, 'Seatown', 'NJ', '12566', '432-7820', '961-1775', NULL, NULL, NULL, 1, 1, 1),
(54, 54, 1, 'Ellen', 'Grandmasion', '316 Parkers Village', NULL, 'Seatown', 'NJ', '12566', '432-1666', '971-366-3811', NULL, NULL, NULL, 1, 1, 1),
(55, 55, 3, 'Jack', 'Gossemeyer', '255 Mapletown Road', NULL, 'Seatown', 'NJ', '12566', '927-2333', '201-9766', NULL, NULL, NULL, 1, 1, 1),
(56, 56, 3, 'Thomas', 'Granster', '118 Pine Sap Drive', NULL, 'Seatown', 'NJ', '12566', '432-3336', '', NULL, NULL, NULL, 1, 1, 1),
(57, 57, 1, 'Mary', 'Hazeltown', '12 Grandview Acres', NULL, 'Seatown', 'NJ', '12566', '399-7227', '399-4280', NULL, NULL, NULL, 1, 1, 1),
(58, 58, 1, 'Davina', 'Daveston', '181B South Upper Street', NULL, 'Seatown', 'NJ', '12566', '432-8661', '432-3992', NULL, 'gauravsworld@gmail.com', NULL, 1, 1, 1),
(59, 59, 3, 'William', 'Hailstone', '89 Railtie Road', NULL, 'Seatown', 'NJ', '12566', '432-5559', '971-499-8001', NULL, NULL, NULL, 1, 1, 1),
(60, 60, 3, 'Robert', 'Hallitown', '311 Overcollins St.', NULL, 'Seatown', 'NJ', '12566', '432-8885', '769-5005', NULL, NULL, NULL, 1, 1, 1),
(61, 61, 3, 'Ricardo', 'Heyman, Jr.', '21 Large Hill Terrace', NULL, 'Seatown', 'NJ', '12566', '432-7771', '979-834-1773', NULL, NULL, NULL, 1, 1, 1),
(62, 62, 1, 'Lana', 'Frostmind', '3 Riverbank Street', NULL, 'Seatown', 'NJ', '12566', '432-1440', '432-7186', NULL, NULL, NULL, 1, 1, 1),
(63, 63, 3, 'Steve', 'Marshbog', '24 Route 16-B', NULL, 'Seatown', 'NJ', '12566', '761-2447', '602-552-2779', NULL, NULL, NULL, 1, 1, 1),
(64, 64, 3, 'Mark', 'Hanscom', '17 Evergreen Rd.', NULL, 'Seatown', 'NJ', '12566', '432-0662', '432-3992', NULL, NULL, NULL, 1, 1, 1),
(65, 65, 4, 'Lonista', 'Endervon', '2 Fowler Mistic Road', NULL, 'Seatown', 'NJ', '12566', '432-2336', '398-5214', NULL, NULL, NULL, 1, 1, 1),
(66, 66, 0, 'Richard', 'Inkstrom', '21 Tannery Road', NULL, 'Seatown', 'NJ', '12566', '432-9889', '971-355-9992', NULL, 'rinkstrom1979@yahoo.com', NULL, 1, 1, 1),
(67, 67, 3, 'Shawn', 'Jamoniton', '21 New Zealand Rd.', NULL, 'Seatown', 'NJ', '12566', '432-5759', '779-4334', NULL, NULL, NULL, 1, 1, 1),
(68, 68, 1, 'Hamiston', 'Janikowski', '817 Short Road', NULL, 'Seatown', 'NJ', '12566', '398-0448', '919-6252', NULL, NULL, NULL, 1, 1, 1),
(69, 69, 3, 'Brian', 'Kenniston', '67 Reagan Street', NULL, 'Seatown', 'NJ', '12566', '432-7936', '235-9660', NULL, NULL, NULL, 1, 1, 1),
(70, 70, 3, 'William', 'Kanoli', '7 Upper Ridge Road', NULL, 'Seatown', 'NJ', '12566', '432-2339', '432-9551', NULL, NULL, NULL, 1, 1, 1),
(71, 71, 3, 'Robert', 'Knoliston', '7A Upper Ridge Ro', NULL, 'Seatown', 'NJ', '12566', '432-5559', '432-9821', NULL, NULL, NULL, 1, 1, 1),
(72, 72, 1, 'Ann', 'Knolwestron', '98 Dirt Prairie Road', NULL, 'Seatown', 'NJ', '12566', '765-2558', '569-6344', NULL, NULL, NULL, 1, 1, 1),
(73, 73, 3, 'Jeffrey', 'Kanister', '10 Prankster Way', NULL, 'Seatown', 'NJ', '12566', '432-7447', '432-7718', NULL, NULL, NULL, 1, 1, 1),
(74, 74, 3, 'Lance', 'Kimister', '110 Grass Lane', NULL, 'Seatown', 'NJ', '12566', '432-7349', '974-755-2908', NULL, NULL, NULL, 1, 1, 1),
(75, 75, 3, 'Lance', 'Kimister', '110 Grass Lane', NULL, 'Seatown', 'NJ', '12566', '432-7438', '970-737-2558', NULL, NULL, NULL, 1, 1, 1),
(76, 76, 2, 'Thomas', 'Lennon', '50 Beatles Road', NULL, 'Seatown', 'NJ', '12566', '432-2758', '', NULL, NULL, NULL, 1, 1, 1),
(77, 77, 3, 'Walter', 'Littleman', '113 Cross Town Road', NULL, 'Seatown', 'NJ', '12566', '432-0455', '', NULL, NULL, NULL, 1, 1, 1),
(78, 78, 3, 'Steven', 'MacKendall', '54 Washington Street', NULL, 'Seatown', 'NJ', '12566', '432-7786', '231-3669', NULL, NULL, NULL, 1, 1, 1),
(79, 79, 2, 'Robert', 'Mangionix', '19 Layman''s Road', NULL, 'Seatown', 'NJ', '12566', '432-2556', '', NULL, NULL, NULL, 1, 1, 1),
(80, 80, 3, 'Dana', 'Marston', '61 Mapletree Road', NULL, 'Seatown', 'NJ', '12566', '766-2991', '', NULL, NULL, NULL, 1, 1, 1),
(81, 81, 3, 'Gregory', 'Marshville', '317 South Grain Street', NULL, 'Seatown', 'NJ', '12566', '432-2448', '919-6377', NULL, NULL, NULL, 1, 1, 1),
(82, 82, 3, 'Robert', 'Manikosta', '314 Dearhead Avenue', NULL, 'Seatown', 'NJ', '12566', '432-8761', '432-2991', NULL, NULL, NULL, 1, 1, 1),
(83, 83, 3, 'Kelly', 'Manifest', '35 Grasshopper Lane', NULL, 'Seatown', 'NJ', '12566', '432-3779', '', NULL, NULL, NULL, 1, 1, 1),
(84, 84, 3, 'Mark', 'Meldstrom', '64A Lease Avenue', NULL, 'Seatown', 'NJ', '12566', '921-3908', '609-0362', NULL, NULL, NULL, 1, 1, 1),
(85, 85, 1, 'Tina', 'Merriville', '47A South Grain St', NULL, 'Seatown', 'NJ', '12566', '769-2363', '', NULL, NULL, NULL, 1, 1, 1),
(86, 86, 2, 'Richard', 'Millisbrooke', '87A Lincoln Avenue', NULL, 'Seatown', 'NJ', '12566', '432-7991', '432-5811', NULL, NULL, NULL, 1, 1, 1),
(87, 87, 3, 'Wayne', 'Manzipope', '319 Dearhead Avenue', NULL, 'Seatown', 'NJ', '12566', '432-3028', '970-811-0662', NULL, NULL, NULL, 1, 1, 1),
(88, 88, 3, 'Jon', 'Morevipe', '12 Manicotti Lane', NULL, 'Seatown', 'NJ', '12566', '432-3226', '432-6794', NULL, NULL, NULL, 1, 1, 1),
(89, 89, 1, 'Cathy', 'Mooreman', '326D Washbrun Street', NULL, 'Seatown', 'NJ', '12566', '432-1558', '878-236-0775', NULL, NULL, NULL, 1, 1, 1),
(90, 90, 1, 'Kim', 'Nickermain', '400 Wrigley Avenue', NULL, 'Seatown', 'NJ', '12566', '432-7325', '', NULL, NULL, NULL, 1, 1, 1),
(91, 91, 1, 'Dandrie', 'Wiltoon', '66 Mancowmb Lane', NULL, 'Seatown', 'NJ', '12566', '432-8993', '819-2123', NULL, NULL, NULL, 1, 1, 1),
(92, 92, 1, 'Stephanie', 'Gramand-Bradman', '59 Dry Brook Lane', NULL, 'Seatown', 'NJ', '12566', '432-2780', '976-469-9679', NULL, NULL, NULL, 1, 1, 1),
(93, 93, 3, 'Joseph', 'Pimerock', '29 Drinking Lane', NULL, 'Seatown', 'NJ', '12566', '432-3810', '239-9466', NULL, NULL, NULL, 1, 1, 1),
(94, 94, 3, 'Wayne', 'Proulmount', '713 Railroadman Avenue', NULL, 'Seatown', 'NJ', '12566', '432-5007', '432-8118', NULL, NULL, NULL, 1, 1, 1),
(95, 95, 3, 'Charles', 'Plankton', '155 Wheat Lane', NULL, 'Seatown', 'NJ', '12566', '432-2110', '', NULL, NULL, NULL, 1, 1, 1),
(96, 96, 4, 'Robyn', 'Edgerin', '51 Palimost Avenue', NULL, 'Seatown', 'NJ', '12566', '432-9990', '866-232-7668', NULL, NULL, NULL, 1, 1, 1),
(97, 97, 1, 'Wanda', 'Prince', '713 Blackrock Avenue', NULL, 'Seatown', 'NJ', '12566', '390-9227', '877-6996', NULL, NULL, NULL, 1, 1, 1),
(98, 98, 1, 'Wanda', 'Prince', '73 Blackshark Road', NULL, 'Seatown', 'NJ', '12566', '391-9669', '890-6225', NULL, NULL, NULL, 1, 1, 1),
(99, 99, 3, 'George', 'Fordstrom', '15A Upper Maple Rd.', NULL, 'Seatown', 'NJ', '12566', '925-4112', '', NULL, NULL, NULL, 1, 1, 1),
(100, 100, 3, 'George', 'Frame', '15 Upper Rock Rd.', NULL, 'Seatown', 'NJ', '12566', '922-4342', '432-7770', NULL, NULL, NULL, 1, 1, 1),
(106, 78, 3, 'Johannes', 'Milkern', '34 Rester Borth', NULL, 'Indianapolis', 'KY', '12322', '123-232-2322', NULL, NULL, NULL, '										', NULL, 1, 0),
(109, 103, 4, 'Karen', 'Morton', '23 Raolutl Lane', NULL, 'Indianapolis', 'KY', '23222', '120-203-2322', NULL, NULL, NULL, NULL, 1, 1, 0),
(110, 103, 2, 'Doug', 'Poulin', '23 Thre Terr', NULL, 'Indianapolis', 'KY', '14566', '210-459-0056', NULL, NULL, NULL, '										', NULL, 1, 0),
(111, 45, 2, 'Ralph', 'Fearch', '44 East Kingston', NULL, 'Indianapolis', 'KY', '75684', '321-544-2373', NULL, NULL, NULL, '										', NULL, 1, 0);

-- --------------------------------------------------------

-- 
-- table structure for table `subjects`
-- 

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subjects_id` int(11) NOT NULL auto_increment,
  `subjects_desc` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`subjects_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `subjects`
-- 

INSERT INTO `subjects` (`subjects_id`, `subjects_desc`) VALUES 
(1, 'Math'),
(2, 'Social Studies'),
(3, 'Language Arts'),
(4, 'Computer Studies'),
(5, 'Reading'),
(6, 'Chemistry'),
(7, 'Physics'),
(8, 'Remedial Math'),
(9, 'Physical Education'),
(10, 'Home Economics'),
(11, 'Woodshop'),
(12, 'Music'),
(13, 'General Science'),
(14, 'General Business'),
(15, 'Algebra'),
(16, 'Algebra 2');

-- --------------------------------------------------------

-- 
-- table structure for table `tbl_admin`
-- 

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `tbl_admin_id` int(10) unsigned NOT NULL auto_increment,
  `tbl_admin_fname` varchar(30) default NULL,
  `tbl_admin_lname` varchar(30) default NULL,
  `tbl_admin_email` varchar(70) default NULL,
  PRIMARY KEY  (`tbl_admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data into table `tbl_admin`
-- Installation routine changes this entry! (install4.php)
--

INSERT INTO tbl_admin (`tbl_admin_id`, `tbl_admin_fname`, `tbl_admin_lname`, `tbl_admin_email`)
VALUES ('1', 'Doug', 'Poulin', 'dougp25@yahoo.com');


-- --------------------------------------------------------

-- 
-- table structure for table `tbl_config`
-- 

DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `current_year` int(10) unsigned default NULL,
  `messageto_teachers` tinytext,
  `messageto_parents` tinytext,
  `messageto_all` tinytext,
  `default_city` varchar(30) default NULL,
  `default_state` char(2) default NULL,
  `default_zip` varchar(10) default NULL,
  `default_entry_date` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `tbl_config`
-- 

INSERT INTO `tbl_config` (`id`, `current_year`, `messageto_teachers`, `messageto_parents`, `messageto_all`, `default_city`, `default_state`, `default_zip`, `default_entry_date`) VALUES 
(1, 1, 'Welcome Staff Members!  Let''s do our very best for our students!', 'Welcome to our online student information portal.  We welcome your comments.         ', 'Welcome to our school!', 'Indianapolis', 'KY', '05896 ', NULL);

-- --------------------------------------------------------

-- 
-- table structure for table `tbl_days`
-- 

DROP TABLE IF EXISTS `tbl_days`;
CREATE TABLE IF NOT EXISTS `tbl_days` (
  `days_id` int(10) unsigned NOT NULL auto_increment,
  `days_desc` varchar(15) default NULL,
  PRIMARY KEY  (`days_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `tbl_days`
-- 

INSERT INTO `tbl_days` (`days_id`, `days_desc`) VALUES 
(1, 'Mo'),
(2, 'Di'),
(3, 'Mi'),
(4, 'Do'),
(5, 'Fr');

-- --------------------------------------------------------

-- 
-- table structure for table `tbl_states`
-- 

DROP TABLE IF EXISTS `tbl_states`;
CREATE TABLE IF NOT EXISTS `tbl_states` (
  `state_code` char(2) NOT NULL default '',
  `state_name` varchar(20) default NULL,
  PRIMARY KEY  (`state_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `tbl_states`
-- 

INSERT INTO `tbl_states` (`state_code`, `state_name`) VALUES 
('AL', 'Alabama'),
('AK', 'Alaska'),
('AZ', 'Arizona'),
('AR', 'Arkansas'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DE', 'Delaware'),
('DC', 'District of Columbia'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('IA', 'Iowa'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('ME', 'Maine'),
('MD', 'Maryland'),
('MA', 'Massachusetts'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MS', 'Mississipi'),
('MO', 'Missouri'),
('MT', 'Montana'),
('NE', 'Nebraska'),
('NV', 'Nevada'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NY', 'New York'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pensylvania'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VT', 'Vermont'),
('VA', 'Virginia'),
('WA', 'Washington'),
('WV', 'West Virginia'),
('WI', 'Wisconsin'),
('WY', 'Wyoming');

-- --------------------------------------------------------

-- 
-- table structure for table `tbl_titles`
-- 

DROP TABLE IF EXISTS `tbl_titles`;
CREATE TABLE IF NOT EXISTS `tbl_titles` (
  `title_id` int(10) unsigned NOT NULL auto_increment,
  `title_desc` varchar(15) default NULL,
  PRIMARY KEY  (`title_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `tbl_titles`
-- 

INSERT INTO `tbl_titles` (`title_id`, `title_desc`) VALUES 
(1, 'Ms.'),
(2, 'Mister'),
(3, 'Mr.'),
(4, 'Mrs.');

-- --------------------------------------------------------

-- 
-- table structure for table `teacher_schedule`
-- 

DROP TABLE IF EXISTS `teacher_schedule`;
CREATE TABLE IF NOT EXISTS `teacher_schedule` (
  `teacher_schedule_id` int(11) NOT NULL auto_increment,
  `teacher_schedule_year` int(11) NOT NULL default '0',
  `teacher_schedule_schoolid` int(11) NOT NULL default '0',
  `teacher_schedule_teacherid` int(11) NOT NULL default '0',
  `teacher_schedule_subjectid` int(11) NOT NULL default '0',
  `teacher_schedule_termid` int(11) NOT NULL default '0',
  `teacher_schedule_classperiod` varchar(10) NOT NULL default '',
  `teacher_schedule_days` varchar(20) NOT NULL,
  `teacher_schedule_room` varchar(20) NOT NULL,
  PRIMARY KEY  (`teacher_schedule_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `teacher_schedule`
-- 

INSERT INTO `teacher_schedule` (`teacher_schedule_id`, `teacher_schedule_year`, `teacher_schedule_schoolid`, `teacher_schedule_teacherid`, `teacher_schedule_subjectid`, `teacher_schedule_termid`, `teacher_schedule_classperiod`, `teacher_schedule_days`, `teacher_schedule_room`) VALUES 
(1, 1, 7, 4, 3, 3, '3', '1', '2'),
(12, 2, 7, 4, 4, 3, '8', '1', '2'),
(4, 1, 7, 4, 6, 1, '7', '1', '2'),
(5, 1, 7, 4, 8, 4, '6', '1', '2'),
(7, 1, 7, 9, 15, 1, '3', '2', '2'),
(8, 1, 7, 9, 15, 1, '4', '2', '2'),
(9, 1, 7, 9, 15, 1, '6', '3', '2'),
(10, 1, 7, 9, 15, 1, '7', '3', '2'),
(11, 1, 7, 4, 15, 1, '6', '1', '4'),
(13, 2, 7, 4, 4, 3, '7', '1', '4'),
(14, 1, 7, 4, 11, 1, '1', '1', '4'),
(15, 1, 7, 9, 15, 3, '2', '3', '4'),
(16, 1, 7, 9, 3, 4, '3', '1', '4'),
(17, 1, 7, 9, 13, 3, '6', '5', '4'),
(18, 1, 7, 4, 10, 1, '1 ', '5', '4'),
(19, 1, 7, 12, 1, 1, '2 ', '5', '4'),
(20, 1, 7, 4, 15, 1, '2 ', '2', '4'),
(21, 1, 7, 4, 15, 1, '1 ', '4', '4');

-- --------------------------------------------------------

-- 
-- table structure for table `teachers`
-- 

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `teachers_id` int(10) unsigned NOT NULL auto_increment,
  `teachers_fname` varchar(30) default NULL,
  `teachers_lname` varchar(30) default NULL,
  `teachers_mi` varchar(5) default NULL,
  `teachers_school` int(10) unsigned default NULL,
  `teachers_email` varchar(60) default NULL,
  `teachers_title` int(10) unsigned default NULL,
  `teachers_active` varchar(1) NOT NULL,
  PRIMARY KEY  (`teachers_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `teachers`
-- 

INSERT INTO `teachers` (`teachers_id`, `teachers_fname`, `teachers_lname`, `teachers_mi`, `teachers_school`, `teachers_email`, `teachers_title`, `teachers_active`) VALUES 
(3, 'Teacher', 'Test', NULL, 7, 'planet1@netzero.com', 3, ''),
(4, 'Ron', 'Smith', 'X', 7, 'teacherrs@teacher.edu', 3, ''),
(5, 'Trying', 'Teacher', NULL, 7, 'zopper45@gmail.com', 3, ''),
(1, 'Select', 'Teacher', NULL, 7, 'bigguy@yahoo.com', 3, ''),
(7, 'Doug', 'Poulin', 'E', 7, 'ibetheteacher@hotmail.com', 3, ''),
(8, 'Direi', 'Lljsdks', 'D', 7, 'jhfhdk@edu.org', 3, ''),
(9, 'Mary', 'Catcher', 'M', 7, 'leinfellner@yeshua.at', 4, ''),
(10, 'John', 'Proulx', 'J', 7, 'jpoukl@hdkjs.edu', 3, ''),
(11, 'Paul', 'Confgdjf', 'B', 7, 'gfhdhed@ed.edu', 3, ''),
(12, 'Ray', 'Kronis', 'W', 7, 'rktonic@eds.edu', 3, '');

-- --------------------------------------------------------

-- 
-- table structure for table `teachers_students`
-- 

DROP TABLE IF EXISTS `teachers_students`;
CREATE TABLE IF NOT EXISTS `teachers_students` (
  `teacher_student_id` int(11) NOT NULL auto_increment,
  `teacher_id` int(11) NOT NULL default '0',
  `studentid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`teacher_student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `teachers_students`
-- 


-- --------------------------------------------------------

-- 
-- table structure for table `web_users`
-- 

DROP TABLE IF EXISTS `web_users`;
CREATE TABLE IF NOT EXISTS `web_users` (
  `web_users_id` int(10) unsigned NOT NULL auto_increment,
  `web_users_type` char(1) default NULL,
  `web_users_relid` int(10) unsigned default NULL,
  `web_users_username` varchar(15) default NULL,
  `web_users_password` varchar(10) default NULL,
  `web_users_flname` varchar(60) default NULL,
  `web_users_active` int(11) NOT NULL default '0',
  `active` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`web_users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- dumping data into table `web_users`
-- entry #1 will be changed by installation routine (install4.php)
-- 

INSERT INTO `web_users` (`web_users_id`, `web_users_type`, `web_users_relid`, `web_users_username`, `web_users_password`, `web_users_flname`, `web_users_active`, `active`) VALUES 
(1, 'A', 1, 'admin', 'admin123', 'Doug Poulin', 0, 1),
(16, 'T', 3, 'teacher', 'teacher', 'Teacher Test', 0, 1),
(17, 'C', 49, 'pippo', 'pappa', 'Pippo Pappa', 0, 1),
(18, 'C', 50, 'rirvin', 'ralph', 'Ronald Junins', 0, 1),
(19, 'T', 4, 'rsmith', 'rsmith', 'Ron Smith', 0, 1),
(25, 'T', 8, 'dfgst', 'dgsfs', 'Direi  Lljsdks', 0, 1),
(26, 'C', 119, 'kteague', 'kteague', 'Kristi Treag', 0, 1),
(27, 'C', 120, 'kteague', 'kteague', 'Kristi Treag', 0, 1),
(30, 'T', 11, 'mgolf', 'mgolf', 'Paul  Confgdjf', 0, 1),
(31, 'N', 12, 'rkronis', 'rkronis', 'Ray  Kronis', 0, 1),
(40, 'C', 3, 'ann', 'ann', ' ', 0, 1),
(41, 'T', 9, 'catcher', 'catcher', 'Mary Catcher', 0, 1);

-- --------------------------------------------------------

--
-- table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `exams_id` int(11) unsigned NOT NULL auto_increment,
  `exams_year` int(11) NOT NULL default '0',
  `exams_schoolid` int(11) NOT NULL default '0',
  `exams_roomid` int(11) NOT NULL default '0',
  `exams_date` date default NULL,
  `exams_subjectid` int(11) default NULL,
  `exams_typeid` varchar(20) default NULL,
  `exams_teacherid` int(11) NOT NULL default'0',
  PRIMARY KEY (`exams_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `exams_types`;
CREATE TABLE IF NOT EXISTS `exams_types` (
  `exams_types_id` int(11) unsigned NOT NULL auto_increment,
  `exams_types_desc` varchar(50) default NULL,
  PRIMARY KEY (`exams_types_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- dumping data into table `web_users`
--

INSERT INTO `exams_types` (`exams_types_id`, `exams_types_desc`) VALUES
(1, 'Exam'),
(2, 'Test'),
(3, 'Qualification Test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `speak`
--

DROP TABLE IF EXISTS `speak`;
CREATE TABLE IF NOT EXISTS `speak` (
  `speak_id` int(11) unsigned NOT NULL auto_increment,
  `speak_teacherid` int(11) NOT NULL default '0',
  `speak_day` int(11) NOT NULL default '0',
  `speak_period` int(11) default '0',
  PRIMARY KEY (`speak_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur fuer Tabelle `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `books_id` int(11) unsigned NOT NULL auto_increment,
  `books_flname` varchar(50) default NULL,
  `books_address` varchar(50) default NULL,
  `books_city` varchar(30) default NULL,
  `books_state` varchar(20) default NULL,
  `books_zip` varchar(6) default NULL,
  `books_country` varchar(20) default NULL,
  `books_phone` varchar(20) default NULL,
  `books_fax` varchar(20) default NULL,
  `books_email` varchar(30) default NULL,
  `books_notes` varchar(100) default NULL,
  `books_discount` int(5) default NULL,
  `subscription_id` varchar(30) NOT NULL default '1RKBH4RC7WZR95MX5102',
  PRIMARY KEY (`books_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `books` (`books_id`, `books_flname`, `books_address`, `books_city`, `books_state`, `books_zip`, `books_country`, `books_phone`, `books_fax`, `books_email`, `books_notes`, `books_discount`, `subscription_id`) VALUES 
(1, 'Versandbuchhandlung Werner M&auml;rz', 'P&uuml;rstling 3', 'Regau', 'Ober&ouml;sterreich', '4844', '&Ouml;sterreich', '07672-72072', '07672-72072-4', 'maerz@team-f.at', 'UID-Nr. ATU 56385236', 10, '1RKBH4RC7WZR95MX5102');

