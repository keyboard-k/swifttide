<?
//*
// admin_stu_schedule.php
// Admin Section
// Display and Manage Student Schedule Entries
//*
//update 032407 doug create display, cleanup code, show kid name, remove junk
//040907 doug support days for schedules

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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get student id, we'll need that!
$studentid=get_param("studentid");
$schedid=get_param("schedid");
$action=get_param("action");
$cyear=$_SESSION['CurrentYear'];



if (!strlen($action))
	$action="none";
//Add or Remove Schedule Entries according to admin choice
switch ($action){
	case "remove":
		$sSQL="DELETE FROM student_schedule WHERE
	student_schedule_studentid='$studentid' AND
	student_schedule_schedid='$schedid'";
        	$db->query($sSQL);
		break;
	case "add":
		$schedid2=get_param("sched_ntry");
		//Check for duplicates
		$tot=$db->get_var("SELECT count(*) FROM student_schedule 
WHERE student_schedule_schedid='$schedid2' AND 
student_schedule_studentid=$studentid");
		if($tot>0){
			$msgFormErr=_ADMIN_STU_SCHEDULE_DUP;
		}else{
		$sSQL="INSERT INTO student_schedule 
VALUES (0,'$studentid','$cyear',0,'$schedid2')"; 
		$db->query($sSQL);
		};
		break;
};

//Get schedule entries
        //Get Student Name
        $sSQL="SELECT studentbio_lname, studentbio_fname FROM
studentbio  WHERE studentbio_id=$studentid";
        $student=$db->get_row($sSQL);
        $slname=$student->studentbio_lname;
        $sfname=$student->studentbio_fname;
        //Get schedule id info
        $sSQL="SELECT student_schedule_schedid FROM student_schedule
WHERE student_schedule_studentid=$studentid AND
student_schedule_year=1";
        $schedid=$db->get_results($sSQL);

//***GOLD
//Get the schedule entries for this student
//$sSQL="SELECT teacher_schedule_id, teacher_schedule_days, grade_terms.grade_terms_desc, grade_subjects.grade_subject_desc, teacher_schedule_classperiod FROM ((teacher_schedule INNER JOIN grade_terms ON teacher_schedule_termid = grade_terms_id) INNER JOIN grade_subjects ON teacher_schedule_subjectid = grade_subject_id) INNER JOIN school_years ON teacher_schedule_year =school_years.school_years_id WHERE teacher_schedule_id = ANY(SELECT student_schedule_schedid FROM student_schedule WHERE student_schedule_studentid =$studentid) ORDER BY grade_terms.grade_terms_desc,teacher_schedule.teacher_schedule_classperiod";
$sSQL="SELECT teacher_schedule_id, grade_terms.grade_terms_desc, 
grade_subjects.grade_subject_desc, teacher_schedule_classperiod, 
teachers.teachers_lname, teachers.teachers_fname, teacher_schedule_days 
FROM 
(((teacher_schedule INNER JOIN grade_terms ON teacher_schedule_termid = 
grade_terms_id) INNER JOIN grade_subjects ON teacher_schedule_subjectid 
= grade_subject_id) INNER JOIN school_years ON teacher_schedule_year 
=school_years.school_years_id) INNER JOIN teachers ON 
teachers.teachers_id=teacher_schedule.teacher_schedule_teacherid WHERE 
teacher_schedule_id = ANY(SELECT 
student_schedule_schedid FROM student_schedule WHERE student_schedule_studentid =$studentid) ORDER BY grade_terms.grade_terms_desc,teacher_schedule.teacher_schedule_classperiod";

$sched_entries=$db->get_results($sSQL);
//****

//Display all available Schedule Entries to add to this student
$sSQL2="SELECT teachers.teachers_fname, teachers.teachers_lname, 
teachers.teachers_school, subjects.subjects_desc, grade_terms.grade_terms_desc, 
teacher_schedule.teacher_schedule_id, 
teacher_schedule.teacher_schedule_days,
teacher_schedule.teacher_schedule_year, teacher_schedule_teacherid,
teacher_schedule_subjectid, teacher_schedule_termid,teacher_schedule.teacher_schedule_classperiod FROM teacher_schedule INNER JOIN subjects ON subjects.subjects_id=teacher_schedule.teacher_schedule_subjectid INNER JOIN grade_terms ON grade_terms.grade_terms_id=teacher_schedule.teacher_schedule_termid INNER JOIN teachers ON teachers.teachers_id=teacher_schedule.teacher_schedule_teacherid WHERE 
teacher_schedule.teacher_schedule_year=$cyear";

$schedposs=$db->get_results($sSQL2);

        //Set paging appearence
        $ezr->results_open = "<table width=90% cellpadding=2 
cellspacing=0 border=1>";
        $ezr->results_heading = "<tr class=tblhead><td
width=20%>" . _ADMIN_STU_SCHEDULE_TERM . "</td><td width=22%>" . 
_ADMIN_STU_SCHEDULE_TEACHER . "</td><td 
width=24%>" . _ADMIN_STU_SCHEDULE_SUBJECT . "</td><td width=10%>" . 
_ADMIN_STU_SCHEDULE_PERIOD . "</td><td width=12%>" . 
_ADMIN_STU_SCHEDULE_DAYS . "</td><td
width=12%>" . _ADMIN_STU_SCHEDULE_REMOVE . "</td></tr>";
        $ezr->results_close = "</table>";
        $ezr->results_row = "<tr><td class=paging
width=20%>COL2</td><td class=paging width=22%>COL6 COL5</td><td
class=paging width=24%>COL3</td><td
class=paging width=10% align=center>COL4</td><td class=paging 
width=12%>COL7</td><td class=paging width=12%
align=center><a
href=admin_stu_schedule.php?studentid=$studentid&schedid=COL1&action=remove
class=aform>&nbsp;" . _ADMIN_STU_SCHEDULE_REMOVE . "</a></td></tr>";
        $ezr->query_mysql($sSQL);
        $ezr->set_qs_val("studentid",$studentid);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<? echo _ADMIN_STU_SCHEDULE_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_attendance_codes.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date("l F j, Y"); ?></font></td>
    <td width="50%"><? echo _ADMIN_STU_SCHEDULE_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_STU_SCHEDULE_TITLE?>&nbsp;<? echo $sfname; ?>&nbsp;<? 
echo $slname; ?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br><br><br>
<tr>
<form>                          
<form name="addentry" method="POST"
action="admin_stu_schedule.php?action=add">
	      <input type="hidden" name="action" value="add">
	      <input type="hidden" name="studentid" value="<? echo 
$studentid; ?>">

                  <td width="100%" class="tdinput" colspan="4">
<p class="pform"><? _ADMIN_STU_SCHEDULE_ADD_NEW?><br>

<select name="sched_ntry">
                <?
                //Display name of subjects from table
                foreach($schedposs as $schedposs1){
                
                echo "<option 
value='".$schedposs1->teacher_schedule_id."'>\n" ;
echo $schedposs1->teachers_fname . " " . $schedposs1->teachers_lname . " " 
. $schedposs1->subjects_desc . " Period " . 
$schedposs1->teacher_schedule_classperiod . " " .
$schedposs1->grade_terms_desc . " Days " . 
$schedposs1->teacher_schedule_days .
"</option>\n"; } ?>
        </select>
	<input type="submit" value="<? echo _ADMIN_STU_SCHEDULE_ADD?>">
	<?}else{
	};
?>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
