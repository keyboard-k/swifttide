<?php
//*
// contact_manage_grades_2.php
// Contacts Section
// Display details on grade record for student
//v1.5 01-01-06 properly display term and comments, add subject, remove year
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$current_year=$_SESSION['CurrentYear'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

//Get Studentid
$studentid=$_SESSION['StudentId'];
//Get attendace id
$gradeid=get_param("gradeid");

//Get info
$sSQL="SELECT studentbio.studentbio_fname, studentbio.studentbio_lname, 
school_names.school_names_desc, school_years.school_years_desc, 
grade_history.grade_history_quarter, grade_names.grade_names_desc AS desc1, 
grade_names_1.grade_names_desc AS desc2, 
grade_names_2.grade_names_desc AS desc3, 
grade_history.grade_history_notes, grade_history_comment1, 
grade_history_comment2, grade_history_comment3, 
web_users.web_users_flname, grade_history.grade_history_grade, 
grade_history.grade_history_effort, 
grade_history.grade_history_conduct, 
grade_subjects.grade_subject_desc, grade_terms.grade_terms_desc 
FROM ((((((((studentbio 
INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
INNER JOIN grade_subjects ON grade_subjects.grade_subject_id=grade_history.grade_history_subject) 
INNER JOIN grade_history ON studentbio.studentbio_id = grade_history.grade_history_student) 
INNER JOIN grade_terms ON grade_terms_id=grade_history_quarter) 
INNER JOIN web_users ON grade_history.grade_history_user = web_users.web_users_id) 
INNER JOIN school_years ON grade_history.grade_history_year = school_years.school_years_id) 
INNER JOIN grade_names ON grade_history.grade_history_comment1 = grade_names.grade_names_id) 
INNER JOIN grade_names AS grade_names_1 ON grade_history.grade_history_comment2 = grade_names_1.grade_names_id) 
INNER JOIN grade_names AS grade_names_2 ON grade_history.grade_history_comment3 = grade_names_2.grade_names_id 
WHERE grade_history_id='".$gradeid."'";
echo $sSQL;
$grade=$db->get_row($sSQL);

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
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _CONTACT_MANAGE_GRADES_2_TITLE?></h1>
	<br>
	<h2><?php echo $grade->studentbio_fname. " " .$grade->studentbio_lname; ?></h2>
	<br>
	<h2><?php echo _CONTACT_MANAGE_GRADES_2_INSERTED?><?php echo $grade->web_users_flname; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_SUBJECT?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $grade->school_names_desc ; ?></td>
	    <td width="50%">&nbsp;<?php echo $grade->grade_subject_desc ; 
?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_QUARTER?></td>
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_GRADE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $grade->grade_terms_desc ; 
?></td>
		<td width="50%">&nbsp;<?php echo $grade->grade_history_grade 
; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_EFFORT?></td>
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_CONDUCT?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $grade->grade_history_effort ; 
?></td>
		<td width="50%">&nbsp;<?php echo 
$grade->grade_history_conduct ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_COMMENTS?></td>
	    <td width="50%">&nbsp;</td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php if($grade->desc1!="Select Comment"){echo $grade->desc1;}; ?></td>
	  </tr>
	 <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php if($grade->desc2!="Select Comment"){echo $grade->desc2;};?></td>
	  </tr>
	 <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php if($grade->desc3!="Select Comment"){echo $grade->desc3;};?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<?php echo _CONTACT_MANAGE_GRADES_2_NOTES?></td>
	  </tr>

	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php echo $grade->grade_history_notes ; ?></td>
	  </tr>

	<?php //display custom fields added by Joshua
     if(count($custom_grade_fields)) {
		?><tr><td colspan=2><h2><?php echo _CONTACT_MANAGE_GRADES_2_CUSTOM_FIELDS?></h2></td></tr>
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

	</table>
	<br>
<!--
         <table border="0" cellpadding="0" cellspacing="0" width="100%">
 	  <tr>
 	    <td width="50%"><a href="contact_manage_grades_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _CONTACT_MANAGE_GRADES_2_BACK?></a></td>
 	    <td width="50%" align="right"><a href="contact_manage_grades_1.php?studentid=<?php echo $studentid; ?>&attid=<?php echo $attid; ?>&action=edit" class="aform"><?php echo _CONTACT_MANAGE_GRADES_2_EDIT?></a></td>
 	  </tr>
 	</table>
-->
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
