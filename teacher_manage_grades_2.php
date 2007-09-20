<?php
//*
// teacher_manage_grades_2.php
// Teacher Section
// Display details on grade record for student
//V1.01 11-27-05, Get and display the subject
//v1.51 12-28-05 subject display fix
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
// Include configuration
include_once "configuration.php";

//Get Studentid
$studentid=get_param("studentid");

//Get attendace id
$gradeid=get_param("gradeid");

//Get info
$sSQL="SELECT studentbio.studentbio_fname, studentbio.studentbio_lname, 
school_names.school_names_desc, school_years.school_years_desc, 
grade_history.grade_history_quarter, grade_names.grade_names_desc AS 
desc1, grade_names_1.grade_names_desc AS desc2, 
grade_names_2.grade_names_desc AS desc3, 
grade_history.grade_history_notes, web_users.web_users_flname, 
grade_history.grade_history_grade, grade_history.grade_history_effort, 
grade_history.grade_history_conduct, 
grade_history.grade_history_subject FROM ((((((studentbio INNER 
JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) INNER JOIN grade_history ON studentbio.studentbio_id = grade_history.grade_history_student) INNER JOIN web_users ON grade_history.grade_history_user = web_users.web_users_id) INNER JOIN school_years ON grade_history.grade_history_year = school_years.school_years_id) INNER JOIN grade_names ON grade_history.grade_history_comment1 = grade_names.grade_names_id) INNER JOIN grade_names AS grade_names_1 ON grade_history.grade_history_comment2 = grade_names_1.grade_names_id) INNER JOIN grade_names AS grade_names_2 ON grade_history.grade_history_comment3 = grade_names_2.grade_names_id WHERE grade_history_id=$gradeid";
$grade=$db->get_row($sSQL);

//now do a little handy work to get the subject name
$subj_id=$grade->grade_history_subject;
$sSQL="SELECT grade_subject_desc FROM grade_subjects WHERE 
grade_subject_id='$subj_id'";
$subject=$db->get_var($sSQL);

//And display a term we can all understand, not some number!
$qtr=$grade->grade_history_quarter;
$sSQL="SELECT grade_terms_desc FROM grade_terms WHERE 
grade_terms_id='$qtr'";
$term_disp=$db->get_var($sSQL);

//get the custom fields associated with this grade event added by Joshua
$custom_grade_sql = "SELECT * from custom_grade_history, custom_fields 
	WHERE (custom_grade_history.custom_field_id = custom_fields.custom_field_id)
	AND (custom_grade_history.grade_history_id = '$gradeid')";
$custom_grade_fields = $db->get_results($custom_grade_sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _TEACHER_MANAGE_GRADES_2_TITLE?></h1>
	<br>
	<h2><?php echo $grade->studentbio_fname. " " .$grade->studentbio_lname; ?></h2>
	<br>
	<h2><?php echo _TEACHER_MANAGE_GRADES_2_INSERTED?><?php echo $grade->web_users_flname; ?> <?php echo _TEACHER_MANAGE_GRADES_2_FOR?> <? 
echo $subject ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $grade->school_names_desc ; ?></td>
	    <td width="50%">&nbsp;<?php echo $grade->school_years_desc ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_TERM?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_GRADE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $term_disp ; ?></td>
		<td width="50%">&nbsp;<?php echo $grade->grade_history_grade ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_EFFORT?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_CONDUCT?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $grade->grade_history_effort ; ?></td>
		<td width="50%">&nbsp;<?php echo $grade->grade_history_conduct ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_COMMENTS?></td>
	    <td width="50%">&nbsp;</td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<? if($grade->desc1!="Select Comment"){echo $grade->desc1;}; ?></td>
	  </tr>
	 <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<? if($grade->desc2!="Select Comment"){echo $grade->desc2;};?></td>
	  </tr>
	 <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<? if($grade->desc3!="Select Comment"){echo $grade->desc3;};?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_2_NOTES?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php echo $grade->grade_history_notes ; ?></td>
	  </tr>
	<table>

	<? //display custom fields added by Joshua
     if(count($custom_grade_fields)) {
		?><tr><td colspan=2><h2><?php echo _TEACHER_MANAGE_GRADES_2_CUSTOM_FIELDS?></h2></td></tr>
		<tr><td colspan=2><table width="100%"><?php
     	foreach($custom_grade_fields as $custom_grade_field) {
  			?><tr><td class="tblhead"><?php
  			echo($custom_grade_field->name);
  			?>:</td><td class="tblcont"><?php
			echo($custom_grade_field->data);
     	    	?></td></tr><?php
     	 }
		 ?></table></td></tr><?php
	} 
	//end of custom fields
	?>

	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _TEACHER_MANAGE_GRADES_2_BACK?></a></td>
	    <td width="50%" align="right"><a href="teacher_manage_grades_3.php?studentid=<?php echo $studentid; ?>&gradeid=<? echo $gradeid; ?>&action=edit" class="aform"><?php echo _TEACHER_MANAGE_GRADES_2_EDIT?></a></td>
	  </tr>
	</table>
</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>
