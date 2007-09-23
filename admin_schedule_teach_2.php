<?php
//*
// admin_schedule_teach_2.php
// Admin Section
// Display details on schedule record for teacher
// Modified 032107 to display kids in the selected schedule
// 041307 support for rooms in schedules (Helmut)
// 041707 timetable listing
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
$teacherid=get_param("teacherid");

//Get schedule id
$schedid=get_param("schedid");
//Get current year
$cyear=$_SESSION['CurrentYear'];
//Get the action and studentid
$action=get_param("action");
$stu_id=get_param("studentid");

//Get Teacher Name
	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;

	//Get current schedule
$sSQL="SELECT school_years_desc, grade_terms_desc, 
days_desc, teacher_schedule_classperiod, 
grade_subject_desc, school_rooms_desc, teacher_schedule_id 
FROM (((((teacher_schedule 
INNER JOIN grade_terms ON teacher_schedule_termid=grade_terms_id) 
INNER JOIN grade_subjects ON teacher_schedule_subjectid=grade_subject_id) 
INNER JOIN school_names ON teacher_schedule_schoolid=school_names_id)
INNER JOIN tbl_days ON teacher_schedule_days=days_id)
INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room)
INNER JOIN school_years ON teacher_schedule_year=school_years.school_years_id 
WHERE teacher_schedule_id=$schedid";
$sched=$db->get_row($sSQL);

if($action == "remove"){
        $sSQL="DELETE FROM student_schedule WHERE
student_schedule_studentid='$stu_id' AND
student_schedule_schedid='$schedid'";
        $db->query($sSQL);
}

//Get the kids in the schedule
$sSQL_k="SELECT studentbio.studentbio_id, studentbio.studentbio_fname,
studentbio.studentbio_lname FROM (studentbio INNER JOIN student_schedule
ON studentbio.studentbio_id = student_schedule.student_schedule_studentid)
WHERE student_schedule.student_schedule_schedid = '$schedid'";

//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0
border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr>
<td class=paging width=40%>COL2</td>
<td class=paging width=40%>COL3</td>
<td class paging width=20% align=center><a
href=admin_schedule_teach_2.php?action=
remove&studentid=COL1&teacherid=$teacherid&schedid=$schedid
class=aform>&nbsp;" . _ADMIN_SCHEDULE_TEACH_2_REMOVE . "</a></td>
</tr>";
// this next $ezr line commented our by Helmut
// we get the students by comparing their
// homeroom with the teacher_schedule_roomid
// $ezr->query_mysql($sSQL_k);

//$ezr->set_qs_val("schedid", $schedid);

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
    <td width="50%"><?php echo _ADMIN_SCHEDULE_TEACH_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_SCHEDULE_TEACH_2_TITLE?></h1>
	<br>
	<h2><?php echo $tfname. " " .$tlname; ?></h2>
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="35%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_YEAR?></td>
	    <td width="30%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_TERM?></td>
	    <td width="35%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_DAYS?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%">&nbsp;<?php echo $sched->school_years_desc; ?></td>
	    <td width="30%">&nbsp;<?php echo $sched->grade_terms_desc; ?></td>
	    <td width="35%">&nbsp;<?php echo $sched->days_desc; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="35%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_PERIOD?></td>
	    <td width="30%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_SUBJECT?></td>
	    <td width="35%">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_ROOM?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="35%">&nbsp;<?php echo $sched->teacher_schedule_classperiod; ?></td>
	    <td width="30%">&nbsp;<?php echo $sched->grade_subject_desc; ?></td>
	    <td width="35%">&nbsp;<?php echo $sched->school_rooms_desc; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="3">&nbsp;<?php echo _ADMIN_SCHEDULE_TEACH_2_NOTES?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="3">&nbsp;<?php echo $grade->grade_history_notes ; ?></td>
	  </tr>


	</table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="33%"><a 
href="admin_schedule_teach_1.php?teacherid=<?php 
echo $teacherid; ?>" class="aform"><?php echo _ADMIN_SCHEDULE_TEACH_2_BACK?></a></td>
	   <!--
	   <td width="33%"><a 
href="admin_schedule_students_1.php?schedid=<?echo 
$schedid; ?>" class="aform"><?php echo _ADMIN_SCHEDULE_TEACH_2_ADD?></a></td>
	   -->
	   <td width="33%">&nbsp;</td>
	   <td width="34%" align="right"><a 
href="admin_schedule_teach_3.php?teacherid=<?php 
echo $teacherid; ?>&schedid=<?php echo $schedid; ?>&action=edit" 
class="aform"><?php echo _ADMIN_SCHEDULE_TEACH_2_EDIT?></a></td>
	  </tr>
	</table><br><br>
	<!--
	<h2><?php echo _ADMIN_SCHEDULE_TEACH_2_STUDENTS?></h2><align="center">
	<?php $ezr->display(); ?>
	-->
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
