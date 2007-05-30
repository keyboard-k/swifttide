-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 18. April 2007 um 09:42
-- Server Version: 5.0.38
-- PHP-Version: 4.4.4-9
-- 
-- Datenbank: `new`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `attendance_codes`
-- 

DROP TABLE IF EXISTS `attendance_codes`;
CREATE TABLE IF NOT EXISTS `attendance_codes` (
  `attendance_codes_id` int(10) unsigned NOT NULL auto_increment,
  `attendance_codes_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`attendance_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `attendance_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `contact_to_students`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_attendance_history`
-- 

DROP TABLE IF EXISTS `custom_attendance_history`;
CREATE TABLE IF NOT EXISTS `custom_attendance_history` (
  `custom_attendance_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `attendance_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_attendance_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_discipline_history`
-- 

DROP TABLE IF EXISTS `custom_discipline_history`;
CREATE TABLE IF NOT EXISTS `custom_discipline_history` (
  `custom_discipline_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `discipline_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_discipline_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_fields`
-- 

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `custom_field_id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  PRIMARY KEY  (`custom_field_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_grade_history`
-- 

DROP TABLE IF EXISTS `custom_grade_history`;
CREATE TABLE IF NOT EXISTS `custom_grade_history` (
  `custom_grade_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `grade_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_grade_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_health_history`
-- 

DROP TABLE IF EXISTS `custom_health_history`;
CREATE TABLE IF NOT EXISTS `custom_health_history` (
  `custom_health_history_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `health_history_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_health_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `custom_studentbio`
-- 

DROP TABLE IF EXISTS `custom_studentbio`;
CREATE TABLE IF NOT EXISTS `custom_studentbio` (
  `custom_studentbio_id` int(11) NOT NULL auto_increment,
  `custom_field_id` int(11) NOT NULL default '0',
  `studentbio_id` int(11) NOT NULL default '0',
  `data` blob,
  PRIMARY KEY  (`custom_studentbio_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `discipline_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `entry_actions`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `ethnicity`
-- 

DROP TABLE IF EXISTS `ethnicity`;
CREATE TABLE IF NOT EXISTS `ethnicity` (
  `ethnicity_id` int(10) unsigned NOT NULL auto_increment,
  `ethnicity_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`ethnicity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `forum_posts`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `forum_replies`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `generations`
-- 

DROP TABLE IF EXISTS `generations`;
CREATE TABLE IF NOT EXISTS `generations` (
  `generations_id` int(10) unsigned NOT NULL auto_increment,
  `generations_desc` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`generations_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO `generations` (generations_id, generations_desc) VALUES (1, '---');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `grade_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `grade_names`
-- 

DROP TABLE IF EXISTS `grade_names`;
CREATE TABLE IF NOT EXISTS `grade_names` (
  `grade_names_id` int(10) unsigned NOT NULL auto_increment,
  `grade_names_desc` varchar(80) default NULL,
  PRIMARY KEY  (`grade_names_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `grade_subjects`
-- 

DROP TABLE IF EXISTS `grade_subjects`;
CREATE TABLE IF NOT EXISTS `grade_subjects` (
  `grade_subject_id` int(11) NOT NULL auto_increment,
  `grade_subject_desc` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`grade_subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='storing subject names';

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `grade_terms`
-- 

DROP TABLE IF EXISTS `grade_terms`;
CREATE TABLE IF NOT EXISTS `grade_terms` (
  `grade_terms_id` int(11) NOT NULL auto_increment,
  `grade_terms_desc` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`grade_terms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `grades`
-- 

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `grades_id` int(10) unsigned NOT NULL auto_increment,
  `grades_desc` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`grades_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_allergy`
-- 

DROP TABLE IF EXISTS `health_allergy`;
CREATE TABLE IF NOT EXISTS `health_allergy` (
  `health_allergy_id` int(10) unsigned NOT NULL auto_increment,
  `health_allergy_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_allergy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_allergy_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_codes`
-- 

DROP TABLE IF EXISTS `health_codes`;
CREATE TABLE IF NOT EXISTS `health_codes` (
  `health_codes_id` int(10) unsigned NOT NULL auto_increment,
  `health_codes_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_immunz`
-- 

DROP TABLE IF EXISTS `health_immunz`;
CREATE TABLE IF NOT EXISTS `health_immunz` (
  `health_immunz_id` int(10) unsigned NOT NULL auto_increment,
  `health_immunz_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_immunz_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_immunz_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_med_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_medicine`
-- 

DROP TABLE IF EXISTS `health_medicine`;
CREATE TABLE IF NOT EXISTS `health_medicine` (
  `health_medicine_id` int(10) unsigned NOT NULL auto_increment,
  `health_medicine_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_medicine_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_visit_codes`
-- 

DROP TABLE IF EXISTS `health_visit_codes`;
CREATE TABLE IF NOT EXISTS `health_visit_codes` (
  `health_visit_id` int(10) unsigned NOT NULL auto_increment,
  `health_visit_desc` varchar(60) default NULL,
  PRIMARY KEY  (`health_visit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `health_visit_history`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `homework`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `homework_files`
-- 

DROP TABLE IF EXISTS `homework_files`;
CREATE TABLE IF NOT EXISTS `homework_files` (
  `homework_file_id` int(11) NOT NULL auto_increment,
  `homework_id` int(11) default NULL,
  `title` varchar(50) default NULL,
  `location` varchar(100) default NULL,
  PRIMARY KEY  (`homework_file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `infraction_codes`
-- 

DROP TABLE IF EXISTS `infraction_codes`;
CREATE TABLE IF NOT EXISTS `infraction_codes` (
  `infraction_codes_id` int(10) unsigned NOT NULL auto_increment,
  `infraction_codes_desc` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`infraction_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `parent_to_kids`
-- 

DROP TABLE IF EXISTS `parent_to_kids`;
CREATE TABLE IF NOT EXISTS `parent_to_kids` (
  `parent_id` int(11) NOT NULL auto_increment,
  `student_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `relations_codes`
-- 

DROP TABLE IF EXISTS `relations_codes`;
CREATE TABLE IF NOT EXISTS `relations_codes` (
  `relation_codes_id` int(10) unsigned NOT NULL auto_increment,
  `relation_codes_desc` varchar(30) default NULL,
  `relation_codes_unique` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`relation_codes_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `school_names`
-- 

DROP TABLE IF EXISTS `school_names`;
CREATE TABLE IF NOT EXISTS `school_names` (
  `school_names_id` int(10) unsigned NOT NULL auto_increment,
  `school_names_desc` varchar(35) default NULL,
  PRIMARY KEY  (`school_names_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `school_rooms`
-- 

DROP TABLE IF EXISTS `school_rooms`;
CREATE TABLE IF NOT EXISTS `school_rooms` (
  `school_rooms_id` int(10) unsigned NOT NULL auto_increment,
  `school_rooms_desc` varchar(35) default NULL,
  PRIMARY KEY  (`school_rooms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `school_years`
-- 

DROP TABLE IF EXISTS `school_years`;
CREATE TABLE IF NOT EXISTS `school_years` (
  `school_years_id` int(10) unsigned NOT NULL auto_increment,
  `school_years_desc` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`school_years_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `student_grade_year`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `student_schedule`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `studentbio`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `studentbio_pictures`
-- 

DROP TABLE IF EXISTS `studentbio_pictures`;
CREATE TABLE IF NOT EXISTS `studentbio_pictures` (
  `id` int(11) NOT NULL auto_increment,
  `studentid` int(11) NOT NULL default '0',
  `picturepath` char(255) default NULL,
  `grade` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `studentcontact`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `subjects`
-- 

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subjects_id` int(11) NOT NULL auto_increment,
  `subjects_desc` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`subjects_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `tbl_admin`
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
-- Installation routine changes entries! (install4.php)
--

INSERT INTO tbl_admin (`tbl_admin_id`, `tbl_admin_fname`, `tbl_admin_lname`, `tbl_admin_email`)
VALUES ('1', 'Doug', 'Poulin', 'dougp25@yahoo.com');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `tbl_config`
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

INSERT INTO `tbl_config` (id, current_year) VALUES (1, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `tbl_days`
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
-- Tabellenstruktur für Tabelle `tbl_states`
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
-- Tabellenstruktur für Tabelle `tbl_titles`
-- 

DROP TABLE IF EXISTS `tbl_titles`;
CREATE TABLE IF NOT EXISTS `tbl_titles` (
  `title_id` int(10) unsigned NOT NULL auto_increment,
  `title_desc` varchar(15) default NULL,
  PRIMARY KEY  (`title_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `teacher_schedule`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `teachers`
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

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `teachers_students`
-- 

DROP TABLE IF EXISTS `teachers_students`;
CREATE TABLE IF NOT EXISTS `teachers_students` (
  `teacher_student_id` int(11) NOT NULL auto_increment,
  `teacher_id` int(11) NOT NULL default '0',
  `studentid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`teacher_student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `web_users`
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

INSERT INTO `web_users` (web_users_id, web_users_type, web_users_relid, web_users_username, web_users_password, web_users_flname, web_users_active, active) VALUES (1, 'A', 1, 'admin', 'admin123', 'Doug Poulin', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exams`
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
  `exams_types_desc` varchar(20) default NULL,
  PRIMARY KEY (`exams_types_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`books_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

