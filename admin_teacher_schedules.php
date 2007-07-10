<?
//*
// admin_teacher_schedules.php
// Admin Section
// Display and Manage teacher Schedules
// V1.0, April 16, 2006
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Grab a few constants
$teacherid=get_param("teacherid");
$current_year=$_SESSION['CurrentYear'];

//Gather school name and teacher name, some other stuff
$sSQL="SELECT teachers_school, teachers_fname, teachers_lname FROM teachers WHERE teachers_id=$teacherid";
$info=$db->get_row($sSQL);
$tlname=$info->teachers_lname;
$tfname=$info->teachers_fname;
$schoolid=$info->teachers_school;

//Gather all info relevant to this schedule_id
$sched_id=get_param("id");
//$sSQL="SELECT teacher_schedule_year, teacher_schedule_schoolid, teacher_schedule_teacherid, teacher_schedule_subjectid,  teacher_schedule_termid, teacher_schedule_classperiod FROM teacher_schedule WHERE teacher_schedule_id=$sched_id"; 
//$sched_details=$db->get_row($sSQL);
//$schoolid=$sched_details->teacher_schedule__school;
//$subjectid=$sched_details->teacher_schedule_subjectid;
//$termid=$sched_details->teacher_schedule_termid;
//$classperiod=$sched_details->teacher_schedule_classperiod;

//Gather subject names, term names, school names
//$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$schoolid";
//$schoolname=$db->get_var($sSQL);
$sSQL="SELECT grade_subject_desc FROM grade_subjects WHERE grade_subject_id=$subjectid";
//$subjectname=$db->get_var($sSQL);
$sSQL="SELECT grade_terms_desc FROM grade_terms WHERE grade_terms_id=$termid";
//$termname=$db->get_var($sSQL);

 
//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Attendance Codes according to admin choice
switch ($action){
	case "remove":
		$schedule_codes_id=get_param("id");
		//if($norem=$db->get_results("SELECT attendance_history_code FROM  attendance_history WHERE attendance_history_code=$attendance_codes_id")){
		if($norem=$db->get_results("SELECT 
student_schedule_schedid FROM student_schedule WHERE 
student_schedule_schedid=$schedule_codes_id")){		
	$msgFormErr=_ADMIN_TEACHER_SCHEDULES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM teacher_schedule WHERE 
teacher_schedule_id=$schedule_codes_id";
			$db->query($sSQL);
		};
		break;
	case "add":
		//Check for duplicates
		//$tot=$db->get_var("SELECT count(*) FROM attendance_codes WHERE attendance_codes_desc='$attendance_codes_desc'");
		$tot=$db->get_var("SELECT count(*) FROM teacher_schedule 
WHERE teacher_schedule_teacherid=$teacherid AND 
teacher_schedule_subject=$subject AND teacher_schedule_term=$term AND 
teacher_schedule_classperiod=$classperiod AND 
teacher_schedule_year=$current_year");
		if($tot>0){
			$msgFormErr=_ADMIN_TEACHER_SCHEDULES_DUP;
		}else{
		//$sSQL="INSERT INTO attendance_codes (attendance_codes_desc) VALUES (".tosql($attendance_codes_desc, "Text").")"; 
		$sSQL="INSERT INTO teacher_schedule (teacher_schedule_year, teacher_schedule_schoolid, teacher_schedule_teacherid, teacher_schedule_subjectid, teacher_schedule_termid, teacher_schedule_classperiod) VALUES ($current_year, $schoolid, $teacherid, $subjectid, $term, $classperiod)"; 

		$db->query($sSQL);
		};
		break;
	case "edit":
		$schedule_codes_id=get_param("id");
		//$sSQL="SELECT attendance_codes_desc FROM attendance_codes WHERE attendance_codes_id=$attendance_codes_id";
		$sSQL="SELECT * FROM teacher_schedule WHERE 
teacher_schedule_id=$schedule_codes_id";
		$schedule_desc = $db->get_row($sSQL);
		break;
	case "update":
		$schedule_codes_id=get_param("id");
		//$attendance_codes_desc=get_param("attendancename");
		$sSQL="SELECT * FROM teacher_schedule WHERE 
teacher_schedule_id=$schedule_codes_id";
		$schedule_desc=$db->get_row($sSQL);
		//$sSQL="UPDATE attendance_codes SET attendance_codes_desc='$attendance_codes_desc' WHERE attendance_codes_id=$attendance_codes_id";
		$sSQL="UPDATE teacher_schedule SET 
teacher_schedule_year=$current_year, teacher_schedule_schoolid=$schoolid, 
teacher_schedule_teacherid=$teacherid, 
teacher_schedule_subjectid=$subject, 
teacher_schedule_termid=$term, teacher_schedule_classperiod=$classperiod 
WHERE teacher_schedule_id=$schedule_codes_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
//$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_attendance_codes.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_TEACHER_SCHEDULES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_TEACHER_SCHEDULES_REMOVE . "</a></td></tr>";
$ezr->results_row = "<tr><td class=paging width=35%>COL2</td><td class=paging 
width=35%>COL3</td><td class=paging 
width=15% align=center><a href=admin_attendance_codes.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_TEACHER_SCHEDULES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_TEACHER_SCHEDULES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT classperiod, grade_subjects.grade_subject_desc 
FROM teacher_schedule 
INNER JOIN grade_subjects ON grade_subject_id=$subjectid 
ORDER BY teacher_schedule_classperiod");
echo "Year is $current_year, school is $schoolid, teacher is $teacherid"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<? echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<? echo _ADMIN_TEACHER_SCHEDULES_SURE?>");
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
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_TEACHER_SCHEDULES_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_TEACHER_SCHEDULES_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addattendance" method="post" action="admin_attendance_codes.php">						
		  <p class="pform"><? echo _ADMIN_TEACHER_SCHEDULES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="attendancename" size="20">&nbsp;<A class="aform" href="javascript: submitform('attendancename')"><? echo _ADMIN_TEACHER_SCHEDULES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editattendance" method="post" action="admin_attendance_codes.php">						
		  <p class="pform"><? echo _ADMIN_TEACHER_SCHEDULES_UPDATE_SCHEDULE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="attendancename" size="20" value="<? echo $attendance_codes_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('attendancename')"><? echo _ADMIN_TEACHER_SCHEDULES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $attendance_codes_id; ?>">
	      </p>
	    </form>
	<?
	};
	?>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
