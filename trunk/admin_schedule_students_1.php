<?
//*
// admin_schedule_students_1.php
// Admin Section
// Form to schedule students against teacher schedules
// V1.0 April 18,2006
//*

//Check if Admin is logged in

session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

$cyear=$_SESSION['CurrentYear'];
$schedid=get_param("schedid");

//Gather info on the relevant schedule
$sSQL="SELECT school_years_desc,
grade_terms.grade_terms_desc,
grade_subjects.grade_subject_desc, teacher_schedule_classperiod,
teacher_schedule_id, teacher_schedule_teacherid  FROM
((teacher_schedule INNER JOIN
grade_terms ON teacher_schedule_termid=grade_terms_id) INNER JOIN
grade_subjects ON teacher_schedule_subjectid=grade_subject_id) INNER
JOIN school_years ON teacher_schedule_year=school_years.school_years_id
WHERE teacher_schedule_id=$schedid";

$sched_info=$db->get_row($sSQL);

$subject=$sched_info->grade_subject_desc;
$period=$sched_info->teacher_schedule_classperiod;
$term=$sched_info->grade_terms_desc;
$teacher=$sched_info->teacher_schedule_teacherid;

//Gather Teacher info
$sSQL="SELECT * FROM teachers WHERE teachers_id=$teacher";
$teacher_info=$db->get_row($sSQL);

$tfname=$teacher_info->teachers_fname;
$tlname=$teacher_info->teachers_lname;

//Gather all information for drop-downs from basic tables
$sSQL="SELECT * FROM school_names ORDER BY school_names_desc";
$schools = $db->get_results($sSQL);

$sSQL="SELECT * FROM grades ORDER BY grades_desc";
$grades = $db->get_results($sSQL);

$sSQL="SELECT * FROM grade_terms ORDER BY grade_terms_desc";
$terms = $db->get_results($sSQL);

$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_desc";
$subjects = $db->get_results($sSQL);

$sSQL="SELECT * FROM teachers ORDER BY teachers_lname ASC";
$teachers=$db->get_results($sSQL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value == _ADMIN_SCHEDULE_STUDENT_1_CHOOSE) 
	f.submit();
  else
	alert("<? echo _ENTER_VALUE?>");
}


</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body> <img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_SCHEDULE_STUDENT_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_SCHEDULE_STUDENT_1_TITLE?></h1>
	<br>
	<h2><? echo _ADMIN_SCHEDULE_STUDENT_1_SCHEDULE?>: </h2>
	<h2><?echo $tfname. " " .$tlname ?></h2>
	<h2><?echo $subject ?></h2>
	<h2><?echo $term ?></h2>
	<h2><? echo _ADMIN_SCHEDULE_STUDENT_1_PERIOD?><?echo $period ?></h2>
	<br>
	  <tr>
	    <td width="50%" height="21">
	      <table border="1" cellpadding="0" cellspacing="0" width="100%">
		    <tr class="trform">
	          <td width="50%" colspan="4">&nbsp;<? echo _ADMIN_SCHEDULE_STUDENT_1_CHOOSE?></td>
	        </tr>
		    <tr>
			  <form name="srchall" method="POST" 
action="admin_schedule_students_2.php">
	          <td width="50%" class="tdinput" colspan="4">
			    <select name="grade">
				   <option value="" selected=selected><? echo _ADMIN_SCHEDULE_STUDENT_1_CHOOSE?></option>
				   <?
				   //Display grades from table
				   foreach($grades as $grade){
				   ?>
			       <option value="<? echo $grade->grades_id; ?>"><? echo $grade->grades_desc; ?></option>
				   <?
				   };
				   ?>
			    </select>
		    <tr class="trform">
			  <td width="25%" class="tdinput" align="center">			  
	          <input type="submit" value="<? echo _ADMIN_SCHEDULE_STUDENT_1_BUILD?>" name="submit" 
class="frmbut">
			  <input type="hidden" name="action" value="srchall"></td>
			  <input type="hidden" name="schedid" value=<? 
echo $schedid; ?></td>
			  </form>
	        </tr>
			  </table>
	    </td>
	  </tr>
	  <tr>
	    <td width="50%">
		<table border="1" cellpadding="0" cellspacing="0" 
width="50%">
		<tr class="trform">

		</form>
	</tr>
	</table></td> </tr>		
</div>
<? include "admin_menu.inc.php";
?>

</body>

</html>
