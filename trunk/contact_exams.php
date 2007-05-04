<?
//*
// contact_exams.php
// Contacts Section
// Display exams for student
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get current year
$cyear=$_SESSION['CurrentYear'];

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$current_year=$_SESSION['CurrentYear'];

// $schoolid=$_SESSION['tschool'];

//Get student id
$studentid=$_SESSION['StudentId'];
if(!strlen($studentid)){
	$msgFormErr=_CONTACT_EXAMS_FORM_ERROR . "<br>";
}else{
	//Get Student Name and Homeroom!
	$sSQL="SELECT studentbio_lname, studentbio_fname, studentbio_homeroom FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sroom=$student->studentbio_homeroom;
}

// get exams data
$sSQL="SELECT school_names_desc, school_rooms_desc, DATE_FORMAT(exams_date,'" . _EXAMS_DATE . "') as examdate, 
grade_subject_desc, exams_types_desc, exams_id, days_desc, exams_date 
FROM (((((exams 
INNER JOIN school_names ON exams_schoolid=school_names_id) 
INNER JOIN school_rooms ON exams_roomid=school_rooms_id) 
INNER JOIN grade_subjects ON exams_subjectid=grade_subject_id) 
INNER JOIN exams_types ON exams_typeid=exams_types_id) 
INNER JOIN tbl_days ON WEEKDAY(exams_date)+1 = days_id) 
WHERE exams_year='$cyear' AND 
      exams_roomid='$sroom' 
ORDER BY school_names_desc, school_rooms_desc, exams_date";

if ($srch = $db->get_results($sSQL)){
//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_heading = "<tr class=tblhead>
<td width=20% align=center>" . _CONTACT_EXAMS_SCHOOL . "</td>
<td width=15% align=center>" . _CONTACT_EXAMS_ROOM . "</td>
<td width=20% align=center>" . _CONTACT_EXAMS_DAYS . "</td>
<td width=20% align=center>" . _CONTACT_EXAMS_SUBJECT . "</td>
<td width=25% align=center>" . _CONTACT_EXAMS_TYPE . "</td>
</tr>";

$ezr->results_row = "<tr>
<td class=paging width=20% align=center>COL1</td>
<td class=paging width=15% align=center>COL2</td>
<td class=paging width=20% align=center>COL8 (COL7)</td>
<td class=paging width=20% align=center>COL4</td>
<td class=paging width=25% align=center>COL5</td>
</tr>";
$ezr->results_close = "</table>";
$ezr->query_mysql($sSQL);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"></link><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<? echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">

	<h1><? echo _CONTACT_EXAMS_TITLE?></h1>
	<br>
	<h2><? echo $sfname. " " .$slname; ?></h2>
	<br>

        <p><? $ezr->display();?></p>
	<p>&nbsp;</p>

</div>
<? include "contact_menu.inc.php"; ?>
</body>

</html>
