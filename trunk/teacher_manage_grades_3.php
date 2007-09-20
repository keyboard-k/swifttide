<?php
//*
// teacher_manage_grades_3.php
// Teachers Section
// Edit grades for student
//Version 1.01 May 9, 2005
//V1.01  Add a field for subject name and code to display it.
//v1.51 subject display fix
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

//Get student id
$studentid=get_param("studentid");
//Get action
$action=get_param("action");
//Get subject
$subject1=get_param("subject");

if ($action=="edit"){
	//Get grade id
	$gradeid=get_param("gradeid");
	//Gather info from db
	$sSQL="SELECT studentbio.studentbio_fname, 
studentbio.studentbio_lname, school_names.school_names_desc, 
school_years.school_years_desc, grade_history.grade_history_quarter, 
grade_names.grade_names_desc AS desc1, grade_names_1.grade_names_desc AS 
desc2, grade_names_2.grade_names_desc AS desc3, 
grade_history.grade_history_notes, grade_history_comment1, 
grade_history_comment2, grade_history_comment3, 
web_users.web_users_flname, grade_history.grade_history_grade, 
grade_history.grade_history_effort, grade_history.grade_history_conduct, 
grade_history.grade_history_subject, grade_terms.grade_terms_desc FROM 
(((((((studentbio 
INNER JOIN 
school_names ON 
studentbio.studentbio_school = school_names.school_names_id) INNER JOIN grade_history 
ON studentbio.studentbio_id = grade_history.grade_history_student) INNER JOIN web_users 
ON grade_history.grade_history_user = web_users.web_users_id) INNER JOIN school_years 
ON grade_history.grade_history_year = school_years.school_years_id) INNER JOIN 
grade_names ON grade_history.grade_history_comment1 = grade_names.grade_names_id) 
INNER JOIN grade_terms ON grade_history.grade_history_quarter=grade_terms_id) INNER 
JOIN grade_names AS grade_names_1 ON grade_history.grade_history_comment2 = 
grade_names_1.grade_names_id) INNER JOIN grade_names AS grade_names_2 ON grade_history.grade_history_comment3 = grade_names_2.grade_names_id WHERE grade_history_id=$gradeid";	
	$grade=$db->get_row($sSQL);
	$slname=$grade->studentbio_lname;
	$sfname=$grade->studentbio_fname;
	$user=$grade->web_users_flname;
	$cyear=$grade->school_years_desc;
	$sschool=$grade->school_names_desc;
	$subj_id=$grade->grade_history_subject;

//Now get stuff for subjects
//$sSQL="SELECT * FROM grade_subjects";
//$subject=$db->get_row($sSQL);

	//get the custom fields associated with this grade event added by Joshua
	$custom_grade_sql = "SELECT * from custom_grade_history, custom_fields 
		WHERE (custom_grade_history.custom_field_id = custom_fields.custom_field_id)
		AND (custom_grade_history.grade_history_id = '$gradeid')";
	$custom_grade_fields = $db->get_results($custom_grade_sql);

}else{
	//Get student names
	$sSQL="SELECT studentbio_fname, studentbio_lname, studentbio_school FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sschoolid=$student->studentbio_school;;
	//Get user name
	$sSQL="SELECT web_users_flname FROM web_users WHERE web_users_id=$web_user";
	$user=$db->get_var($sSQL);
	//Get Year
	$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year";
	$cyear=$db->get_var($sSQL);
	//Get School
	$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$sschoolid";
	$sschool=$db->get_var($sSQL);
	$grade = "";
	$custom_grade_fields = "";

};
//Get list of grade codes
$gradecodes=$db->get_results("SELECT * FROM grade_names ORDER BY grade_names_desc");
//Get list of Terms
$termcodes=$db->get_results("SELECT * FROM grade_terms ORDER BY grade_terms_desc");
//Get list of Subjects
$subject=$db->get_results("SELECT * FROM grade_subjects ORDER BY grade_subject_desc");
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
    <td width="50%"><?php _WELCOME?>, <?php echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _TEACHER_MANAGE_GRADES_3_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname ; ?></h2>
	<br>
	<h2><?php echo _TEACHER_MANAGE_GRADES_3_INSERTED?><?php echo $user; ?> for <? echo $sschool; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<form name="grade" method="POST" action="teacher_manage_grades_4.php">
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_YEAR?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_SUBJECT?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $cyear ; ?></td>
	    <td width="50%" class="tdinput">
	    <select name="subject">
		<?php
		//Display name of subjects from table
		foreach($subject as $subjects){
		?>
		<option value="<?php echo $subjects->grade_subject_id; 
?>" <? if 
($subjects->grade_subject_id==$grade->grade_history_subject){echo 
"selected=selected";};?>><?php echo $subjects->grade_subject_desc; 
?></option>
	<? }; ?></select>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_TERM?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_OVERALL?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%" class="tdinput">
		<select name="quarter">
		<?php
		//Display terms from table
		foreach($termcodes as $termcode){
		?>
		<option value="<?php echo $termcode->grade_terms_id; ?>" <? if 
($termcode->grade_terms_id==$grade->grade_history_quarter){echo 
"selected=selected";};?>> <? 
echo $termcode->grade_terms_desc; 
?></option>
         <? }; ?></select>
		</td>
		<td width="50%" class="tdinput">
			<input type="text" name="grade" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_grade);};?>">
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_EFFORT?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_CONDUCT?></td>
	  </tr>
	  <tr class="tblcont">
		<td width="50%" class="tdinput">
			<input type="text" name="effort" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_effort);};?>">
		</td>
		<td width="50%" class="tdinput">
			<input type="text" name="conduct" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_conduct);};?>">
		</td>	    
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_COMMENTS?></td>
	    <td width="50%">&nbsp;</td>
	  </tr>
	  <tr class="tblcont">
		<td width="100%" class="tdinput" colspan="2">
			  <select name="comment1">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <?php
 if ($gradecode->grade_names_id==$grade->grade_history_comment1){echo "selected=selected";};?>><?php echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
		</tr>
		<tr class="tblcont">
		<td width="100%" class="tdinput" colspan="2">
			  <select name="comment2">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <? if ($gradecode->grade_names_id==$grade->grade_history_comment2){echo "selected=selected";};?>><? echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" class="tdinput" colspan="2">
			  <select name="comment3">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <? if ($gradecode->grade_names_id==$grade->grade_history_comment3){echo "selected=selected";};?>><? echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_NOTES?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<textarea name="gradenotes" cols="40" rows="5"><? if($action=="edit"){echo strip($grade->grade_history_notes);};?></textarea></td>
	  </tr>
	  <?php
	  if($action=="new"){
	  ?>
	  <tr>
	    <td width="100%" colspan="2" class="tdinput">&nbsp;<?php echo _TEACHER_MANAGE_GRADES_3_NOTIFY?>:<input type="checkbox" name="notify" value="1" checked=checked></td>
		<input type="hidden" name="sschool" value="<?php echo $sschoolid; ?>">
	  </tr>
	  <?php
	  };
	  ?>

    <? //custom fields added by Joshua
    	//get all the custom field names for the select loops
     $cfSQL = "SELECT * FROM custom_fields";
     $custom_fields = $db->get_results($cfSQL);

	?> <tr><td><h2><?php echo _TEACHER_MANAGE_GRADES_3_CUSTOM_FIELDS?></h2></td></tr>
	<tr><td><table width="100%"> <?php

    	if($custom_grade_fields && $custom_grade_fields != NULL) {
		foreach($custom_grade_fields as $custom_grade_field) {
			?> <tr><td><select name="custom_fields[<?php
			echo($custom_grade_field->custom_grade_history_id);
			?>]"><option value="0"><?php echo _TEACHER_MANAGE_GRADES_3_DELETE?>...</option><?php
			foreach($custom_fields as $custom_field) {
				?><option value="<?php echo($custom_field->custom_field_id);
				?>" <?php
				if($custom_field->custom_field_id == $custom_grade_field->custom_field_id) {
					echo" selected";
				}
				?>><?php
				echo($custom_field->name);
				?></option><?php
			}
			?></select></td><td><input type="text" name="custom_grade_fields[<?php
	    		echo($custom_grade_field->custom_grade_history_id);
	    		?>]" value="<?php echo($custom_grade_field->data);
	    		?>" size=70></td></tr> <?php
		} 
	}
	?><tr><td><select name="new_custom_field_id">
	<option value="0" selected><?php echo _TEACHER_MANAGE_GRADES_3_NEW?>...</option><?php
	foreach($custom_fields as $custom_field) {
		?><option value="<?echo($custom_field->custom_field_id);
		?>"><?php echo($custom_field->name);
		?></option><?php
	} 
	?></td><td><input type="text" name="new_custom_field_data" size=70>
	</td></tr></table></td></tr><?php
	//end custom fields
	?>

	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _TEACHER_MANAGE_GRADES_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _TEACHER_MANAGE_GRADES_3_UPDATE;}else{echo _TEACHER_MANAGE_GRADES_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="gradeid" value="<?php echo $gradeid; ?>">
	  <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>

	</form>
	</table>
</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>
