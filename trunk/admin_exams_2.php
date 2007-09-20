<?php
//*
// admin_exams_2.php
// Admin Section
// Display details on exams records
// v1.0 April 19, 2007
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get teacherid
$examid=get_param("examid");

//Get current year
$cyear=$_SESSION['CurrentYear'];
// $year = $db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear");

//Get the action and studentid
$action=get_param("action");

//Get Teacher Name
$sSQL="SELECT teachers_fname, teachers_lname, teachers_school 
FROM teachers INNER JOIN exams 
WHERE exams_teacherid=teachers_id AND 
      exams_id='$examid'";
$teacher=$db->get_row($sSQL);
$tlname=$teacher->teachers_lname;
$tfname=$teacher->teachers_fname;
$tschool=$teacher->teachers_school;

//Get current listing of exams
$sSQL="SELECT school_names_desc, school_rooms_desc, DATE_FORMAT(exams_date,'" . _EXAMS_DATE . "') as examdate, 
grade_subject_desc, exams_types_desc, exams_id, days_desc, exams_teacherid, school_years_desc 
FROM ((((((exams 
INNER JOIN school_years ON exams_year=school_years_id) 
INNER JOIN school_names ON exams_schoolid=school_names_id) 
INNER JOIN school_rooms ON exams_roomid=school_rooms_id) 
INNER JOIN grade_subjects ON exams_subjectid=grade_subject_id) 
INNER JOIN exams_types ON exams_typeid=exams_types_id) 
INNER JOIN tbl_days ON WEEKDAY(exams_date)+1 = days_id) 
WHERE exams_year='$cyear' AND 
      exams_id='$examid' 
ORDER BY school_names_desc, school_rooms_desc, exams_date";
$exam=$db->get_row($sSQL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_EXAMS_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_EXAMS_2_TITLE?></h1>
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="35%">&nbsp;<?php echo _ADMIN_EXAMS_2_YEAR?></td>
	    <td width="30%">&nbsp;<?php echo _ADMIN_EXAMS_2_SCHOOL?></td>
	    <td width="35%">&nbsp;<?php echo _ADMIN_EXAMS_2_ROOM?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%">&nbsp;<?php echo $exam->school_years_desc; ?></td>
	    <td width="30%">&nbsp;<?php echo $exam->school_names_desc; ?></td>
	    <td width="35%">&nbsp;<?php echo $exam->school_rooms_desc; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="35%">&nbsp;<?php echo _ADMIN_EXAMS_2_DATE?></td>
	    <td width="30%">&nbsp;<?php echo _ADMIN_EXAMS_2_SUBJECT?></td>
	    <td width="35%">&nbsp;<?php echo _ADMIN_EXAMS_2_TYPE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%">&nbsp;<?php echo $exam->examdate; ?></td>
	    <td width="30%">&nbsp;<?php echo $exam->grade_subject_desc; ?></td>
	    <td width="35%">&nbsp;<?php echo $exam->exams_types_desc; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="3">&nbsp;<?php echo _ADMIN_EXAMS_2_TEACHER?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="3">&nbsp;<?php echo $tfname . " " . $tlname; ?></td>
	  </tr>


	</table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a 
href="admin_exams_1.php" class="aform"><?php echo _ADMIN_EXAMS_2_BACK?></a></td>
	    <td width="50%" align="right"><a 
href="admin_exams_3.php?examid=<? 
echo $examid; ?>&action=edit" 
class="aform"><?php echo _ADMIN_EXAMS_2_EDIT?></a></td>
	  </tr>
	</table><br><br>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
