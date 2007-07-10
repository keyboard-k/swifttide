<?
//*
// admin_schedule_teach_3.php
// Admin Section
// Edit schedule for teacher
// v1.0 April 17,2006
// 041307 support for rooms in schedules (Helmut)
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
// config
include_once "configuration.php";

$cyear=$_SESSION['CurrentYear'];

//Get teacher id
$teacherid=get_param("teacherid");

//Get action
$action=get_param("action");
//Get list of Terms
$sSQL="SELECT * FROM grade_terms ORDER BY grade_terms_desc";
$termcodes=$db->get_results($sSQL);
//get list of subjects
$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_desc ASC";
$subjectcodes=$db->get_results($sSQL);
//Get list of Days
$sSQL="SELECT * FROM tbl_days ORDER BY days_id";
$weekdays=$db->get_results($sSQL);
//Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$rooms=$db->get_results($sSQL);

if ($action=="edit"){
	//Get schedule id
	$schedid=get_param("schedid");
	//Gather info from db
	$sSQL="SELECT school_years_desc,
grade_terms.grade_terms_desc,
grade_subjects.grade_subject_desc, teacher_schedule_classperiod,
teacher_schedule_id, teacher_schedule_termid, teacher_schedule_subjectid, 
teacher_schedule_days, teacher_schedule_room  FROM
((teacher_schedule INNER JOIN
grade_terms ON teacher_schedule_termid=grade_terms_id) INNER JOIN
grade_subjects ON teacher_schedule_subjectid=grade_subject_id) INNER
JOIN school_years ON teacher_schedule_year=school_years.school_years_id WHERE teacher_schedule_id=$schedid";

	$schedule=$db->get_row($sSQL);
	$term=$schedule->grade_terms_desc;
	$subject=$schedule->grade_subject_desc;
	$period=$schedule->teacher_schedule_classperiod;
	$room=$schedule->teacher_schedule_room;
	//$cyear=$schedule->school_years_desc;
	$sschool=$schedule->school_names_desc;

	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;
	//Get School
	$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$tschool";
	$sschool=$db->get_var($sSQL);

}else{
	//Get teacher name
	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;

	//Get Year
	$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear";
	$textyear=$db->get_var($sSQL);
	//Get School
	$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$tschool";
	$sschool=$db->get_var($sSQL);
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_SCHEDULE_TEACH_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_SCHEDULE_TEACH_3_TITLE?></h1>
	<br>
	<h2><? echo $tfname. " " .$tlname ; ?></h2>
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<form name="attendance" method="POST" 
action="admin_schedule_teach_4.php">
	  <tr class="trform">
	    <td width="35%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_SCHOOL?></td>
	    <td width="30%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_PERIOD?></td>
	    <td width="35%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_DAYS ?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%">&nbsp;<? echo $sschool ; ?></td>
	<td width="30%" class="tdinput"> 
	<input type="text" onChange="capitalizeMe(this)" name="period" 
size="20" <? if($action=="edit"){echo " 
value=".strip($schedule->teacher_schedule_classperiod);}; ?>>
	</td>
	<td width="35%" class="tdinput">
		  <select name="days">
		<? //Display days from table
		foreach($weekdays as $weekday){
		?>
		<option value="<? echo $weekday->days_id; ?>" <? 
if ($weekday->days_id==$schedule->teacher_schedule_days){echo 
"selected=selected";};?>><? echo $weekday->days_desc; ?></option> 
<? }; ?>
		   </select>
	</td>
	</tr>
	  <tr class="trform">
	    <td width="35%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_TERM?></td>
	    <td width="30%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_SUBJECT?></td>
	    <td width="35%">&nbsp;<? echo _ADMIN_SCHEDULE_TEACH_3_ROOM?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%" class="tdinput">
		  <select name="term2">
		<? //Display terms from table
		foreach($termcodes as $termcode){
		?>
		<option value="<? echo $termcode->grade_terms_id; ?>" <? 
if ($termcode->grade_terms_id==$schedule->teacher_schedule_termid){echo 
"selected=selected";};?>><? echo $termcode->grade_terms_desc; ?></option> 
<? }; ?>
		   </select>
		</td>
		<td width="30%" class="tdinput">
			<select name="subject">
		<? //Display subjects from table
		foreach($subjectcodes as $subjectcode){
		?>
		<option value="<? echo $subjectcode->grade_subject_id; ?>" 
<? 
if($subjectcode->grade_subject_id==$schedule->teacher_schedule_subjectid){echo 
"selected=selected";};?>> <?echo $subjectcode->grade_subject_desc; 
?></option> <? }; ?> 
		</select>
		</td>
		<!--
		<td width="35%" class="tdinput"><input type="text" name="room" 
size="15" <? if($action=="edit"){echo " 
value=".strip($schedule->teacher_schedule_room);}; ?>> </td> 
		-->
		<td width="30%" class="tdinput">
			<select name="room">
		<? //Display rooms from table
		foreach($rooms as $room){
		?>
		<option value="<? echo $room->school_rooms_id; ?>" 
<? 
if($room->school_rooms_id==$schedule->teacher_schedule_room){echo 
"selected=selected";};?>> <?echo $room->school_rooms_desc;
?></option> <? }; ?> 
		</select>
		</td>
	  </tr>
	  <?
	  if($action=="new"){
	  ?>
	  <?
	  };
	  ?>


	<table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a 
href="admin_schedule_teach_1.php?teacherid=<? 
echo $teacherid; ?>" class="aform"><? echo _ADMIN_SCHEDULE_TEACH_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _ADMIN_SCHEDULE_TEACH_3_UPDATE;}else{echo _ADMIN_SCHEDULE_TEACH_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="teacherid" value="<? echo $teacherid; ?>">
	  <input type="hidden" name="schedid" value="<? echo $schedid; ?>">
	  <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
