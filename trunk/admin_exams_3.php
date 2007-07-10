<?
//*
// admin_exams_3.php
// Admin Section
// Edit exams
// v1.0 April 19,2007
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

//Get schedule id
$examid=get_param("examid");

//Get action
$action=get_param("action");

//Get list of school names
$sSQL="SELECT * FROM school_names ORDER BY school_names_id";
$schoolnames=$db->get_results($sSQL);
//Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$schoolrooms=$db->get_results($sSQL);
//get list of subjects
$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_id";
$subjectcodes=$db->get_results($sSQL);
//get list of exam types
$sSQL="SELECT * FROM exams_types ORDER BY exams_types_id ASC";
$examstypes=$db->get_results($sSQL);
//get list of teachers
$sSQL="SELECT * FROM teachers ORDER BY teachers_id ASC";
$teachers=$db->get_results($sSQL);

// DATE_FORMAT(exams_date,'" . _EXAMS_DATE . "') as examdate, grade_subject_desc, 

if ($action=="edit"){
	//Gather info from db
	
	$sSQL="SELECT exams_id, exams_year, exams_schoolid, exams_roomid, 
	exams_date, exams_subjectid, exams_typeid, exams_teacherid, 
	school_years_desc, school_names_desc, school_rooms_desc, 
	exams_date as examdate, grade_subject_desc, 
	exams_types_desc, days_desc, exams_teacherid, exams_roomid  
	FROM ((((((exams 
	INNER JOIN school_years ON exams_year=school_years_id) 
	INNER JOIN school_names ON exams_schoolid=school_names_id) 
	INNER JOIN school_rooms ON exams_roomid=school_rooms_id) 
	INNER JOIN grade_subjects ON exams_subjectid=grade_subject_id) 
	INNER JOIN exams_types ON exams_typeid=exams_types_id) 
	INNER JOIN tbl_days ON WEEKDAY(exams_date)+1 = days_id) 
	WHERE exams_id='$examid' 
	ORDER BY school_names_desc, school_rooms_desc, exams_date";
	$exam=$db->get_row($sSQL);
	$year = $exam->school_years_desc;

	$school=$exam->school_names_desc;
	$room=$exam->school_rooms_desc;
	$subject=$exam->grade_subject_desc;
	// $type=$exam->exams_types_id;

	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school 
	FROM (teachers INNER JOIN exams ON teachers_id=exams_teacherid)";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;

}else{
	// get year name
	$year=$db->get_var("SELECT school_years_desc FROM exams INNER JOIN school_years WHERE exams_year=school_years_id");
	//Get teacher name
	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school 
	FROM (teachers INNER JOIN exams ON teachers_id=exams_teacherid)";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;

};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_EXAMS_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_EXAMS_3_TITLE?></h1>
	<br>

        <table border="1" cellpadding="0" cellspacing="0" width="100%">
	<form name="exam" method="POST" action="admin_exams_4.php">
	  <tr class="trform">
	    <td width="35%">&nbsp;<? echo _ADMIN_EXAMS_3_YEAR?></td>
	    <td width="30%">&nbsp;<? echo _ADMIN_EXAMS_3_SCHOOL?></td>
	    <td width="35%">&nbsp;<? echo _ADMIN_EXAMS_3_ROOM?></td>
	  </tr>
	<tr class="tblcont">
	  <td width="35%">&nbsp;<? echo $year; ?></td>
	  <td width="30%" class="tdinput">
		  <select name="schoolid">
		<? //Display rooms from table
		foreach($schoolnames as $schoolname){
		?>
		<option value="<? echo $schoolname->school_names_id; ?>" <? 
if ($action=="edit" && $schoolname->school_names_id==$exam->exams_schoolid){echo 
"selected=selected";};?>><? echo $schoolname->school_names_desc; ?></option> 
<? }; ?>
		   </select>
	  </td>
	  <td width="35%" class="tdinput">
		  <select name="roomid">
		<? //Display rooms from table
		foreach($schoolrooms as $room){
		?>
		<option value="<? echo $room->school_rooms_id; ?>" <? 
if ($action=="edit" && $room->school_rooms_id==$exam->exams_roomid){echo 
"selected=selected";};?>><? echo $room->school_rooms_desc; ?></option> 
<? }; ?>
		   </select>
	  </td>
	</tr>
	<tr class="tblhead">
	  <td width="35%">&nbsp;<? echo _ADMIN_EXAMS_3_DATE?></td>
	  <td width="30%">&nbsp;<? echo _ADMIN_EXAMS_3_SUBJECT?></td>
	  <td width="35%">&nbsp;<? echo _ADMIN_EXAMS_3_TYPE?></td>
	</tr>
	<tr class="tblcont">
	  <td width="35%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="examdate" size="10" value="<? if($action=="edit"){echo $exam->examdate;};?>" READONLY onclick="javascript:show_calendar('exam.examdate');"><a href="javascript:show_calendar('exam.examdate');"><img src="images/cal.gif" border="0" class="imma"></a>
	                  </td>
	  <td width="30%" class="tdinput">
		  <select name="subjectid">
		<? //Display subjects from table
		foreach($subjectcodes as $subject){
		?>
		<option value="<? echo $subject->grade_subject_id; ?>" <? 
if ($action=="edit" && $subject->grade_subject_id==$exam->exams_subjectid){echo 
"selected=selected";};?>><? echo $subject->grade_subject_desc; ?></option> 
<? }; ?>
		   </select>
	  </td>
	  <td width="35%" class="tdinput">
		  <select name="typeid">
		<? //Display exams_types from table
		foreach($examstypes as $type){
		?>
		<option value="<? echo $type->exams_types_id; ?>" <? 
if ($action=="edit" && $type->exams_types_id==$exam->exams_typeid){echo 
"selected=selected";};?>><? echo $type->exams_types_desc; ?></option> 
<? }; ?>
		   </select>
	  </td>
	</tr>
	<tr class="tblhead">
	  <td colspan="3" width="100%">&nbsp;<? echo _ADMIN_EXAMS_3_TEACHER?></td>
	</tr>
	<tr class="tblcont">
	  <td colspan="3" width="100%" class="tdinput">
		<select name="teacherid">
		<? //Display teachers from table
		foreach($teachers as $teach){
		?>
		<option value="<? echo $teach->teachers_id; ?>" <? 
if ($action=="edit" && $teach->teachers_id==$exam->exams_teacherid){echo 
"selected=selected";};?>><? echo $teach->teachers_fname . " " . $teach->teachers_lname; ?></option> 
<? }; ?>
		</select>
	  </td>
	</tr>
	<?
	if($action=="new"){
	?>
	<?
	};
	?>

	</table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a 
href="admin_exams_1.php" class="aform"><? echo _ADMIN_EXAMS_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _ADMIN_EXAMS_3_UPDATE;}else{echo _ADMIN_EXAMS_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="examid" value="<? echo $examid;?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>
	</form>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
