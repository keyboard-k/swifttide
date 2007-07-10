<?
//*
// teacher_manage_grades_1.php
// Teachers Section
// Display grades for student
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
//Include configuration
include_once "configuration.php";
$msgFormErr = "";

//Get student id
$studentid=get_param("studentid");
if(!strlen($studentid)){
	$msgFormErr=_TEACHER_MANAGE_GRADES_1_FORM_ERROR . "<br>";
}else{
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;

	//Get Subject Name
	$sSQL="SELECT grade_subject_desc FROM (grade_subjects INNER JOIN grade_history ON grade_subjects.grade_subject_id = grade_history.grade_history_subject)";
	$subjectname=$db->get_row($sSQL);
	$sub=$subjectname->grade_subject_desc;

	//Get grade history
	$sSQL="SELECT grade_terms.grade_terms_desc, 
grade_history.grade_history_grade, grade_history.grade_history_effort, 
grade_history.grade_history_conduct, grade_history.grade_history_id, 
grade_subjects.grade_subject_desc FROM ((grade_history INNER 
JOIN grade_terms ON grade_history.grade_history_quarter=grade_terms.grade_terms_id) INNER JOIN grade_subjects ON grade_history.grade_history_subject=grade_subjects.grade_subject_id) 
WHERE 
grade_history.grade_history_student = 
'$studentid' ORDER BY grade_history.grade_history_quarter DESC";

	//Set paging appearence
	$ezr->results_open = "<table width=85% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead>
	<td width=20% align=center>" . _TEACHER_MANAGE_GRADES_1_QUARTER . "</td>
	<td width=15% align=center>" . _TEACHER_MANAGE_GRADES_1_GRADE . "</td>
	<td width=15% align=center>" . _TEACHER_MANAGE_GRADES_1_EFFORT . "</td>
	<td width=15% align=center>" . _TEACHER_MANAGE_GRADES_1_CONDUCT . "</td>
	<td width=20% align=center>" . _TEACHER_MANAGE_GRADES_1_SUBJECT . "</td>
	<td width=15% align=center>" . _TEACHER_MANAGE_GRADES_1_DETAILS . "</td>
	</tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr>
	<td class=paging width=20% align=center>COL1</td>
	<td class=paging width=15% align=center>COL2</td>
	<td class=paging width=15% align=center>COL3</td>
	<td class=paging width=15% align=center>COL4</td>
	<td class=paging width=20% align=center>COL6</td>
	<td class=paging width=15% align=center><a href=teacher_manage_grades_2.php?studentid=$studentid&gradeid=COL5 class=aform>&nbsp;" . _TEACHER_MANAGE_GRADES_1_DETAILS . "</a></td>
	</tr>";
	$ezr->query_mysql($sSQL);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _TEACHER_MANAGE_GRADES_1_TITLE?></h1>
	<br>
	<h2><? echo $sfname. " " .$slname; ?></h2>
	<br>
	<?
	$ezr->display();
	?>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="80%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><?php echo _TEACHER_MANAGE_GRADES_1_BACK?></a></td>
	    <td width="50%" align="right"><a href="teacher_manage_grades_3.php?studentid=<? echo $studentid; ?>&action=new" class="aform"><?php echo _TEACHER_MANAGE_GRADES_1_ADD?></a></td>
	  </tr>
	</table>
	<?
	}else{
	?>
	<h1><? echo _ERROR?></h1>
	<br>
	<h3><? echo $msgFormErr; ?></h3>
	<br>
	<?
	};
	?>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
