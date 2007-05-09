<?
//*
// teacher_manage_attendance_3.php
// Teachers Section
// Edit attendance record for student
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


if ($action=="edit"){
	//Get attendace id
	$attid=get_param("attid");
	//Gather info from db
	$sSQL="SELECT studentbio.studentbio_fname, studentbio.studentbio_lname, school_names.school_names_desc, school_years.school_years_desc, DATE_FORMAT(attendance_history.attendance_history_date, '" . _EXAMS_DATE . "') as attdate, attendance_codes.attendance_codes_desc, attendance_history.attendance_history_notes, web_users.web_users_flname, attendance_codes.attendance_codes_id FROM ((((attendance_history INNER JOIN studentbio ON attendance_history.attendance_history_student = studentbio.studentbio_id) INNER JOIN school_years ON attendance_history.attendance_history_year = school_years.school_years_id) INNER JOIN school_names ON attendance_history.attendance_history_school = school_names.school_names_id) INNER JOIN attendance_codes ON attendance_history.attendance_history_code = attendance_codes.attendance_codes_id) INNER JOIN web_users ON attendance_history.attendance_history_user = web_users.web_users_id WHERE attendance_history.attendance_history_id=$attid";
	$attendance=$db->get_row($sSQL);
	$slname=$attendance->studentbio_lname;
	$sfname=$attendance->studentbio_fname;
	$user=$attendance->web_users_flname;
	$cyear=$attendance->school_years_desc;
	$sschool=$attendance->school_names_desc;

	//get the custom fields associated with this attendance event added by Joshua
	$custom_attendance_sql = "SELECT * from custom_attendance_history, custom_fields 
		WHERE (custom_attendance_history.custom_field_id = custom_fields.custom_field_id)
		AND (attendance_history_id = '$attid')";
	$custom_attendance_fields = $db->get_results($custom_attendance_sql);

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

};
//Get list of attendance codes
$attendancecodes=$db->get_results("SELECT * FROM attendance_codes ORDER BY attendance_codes_desc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if fields are empty */
function submitform(fldName1, fldName2)
{
  var f = document.forms[0];
  var t = f.elements[fldName1]; 
  var y = f.elements[fldName2];
  if(t.value=="" || y.selectedIndex==0){
	  alert('Code and Date should be entered');
	  return false;
  }
  else{
	  return true;
  };
}; 

</SCRIPT>
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
	<h1><?php echo _TEACHER_MANAGE_ATTENDANCE_3_TITLE?></h1>
	<br>
	<h2><? echo $sfname. " " .$slname ; ?></h2>
	<br>
	<h2><?php echo _TEACHER_MANAGE_ATTENDANCE_3_INSERTED?><? echo $user; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<form name="attendance" method="POST" action="teacher_manage_attendance_4.php" onsubmit="return submitform('attdate','attcode');">
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<? echo $sschool ; ?></td>
	    <td width="50%">&nbsp;<? echo $cyear ; ?></td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_CODE?></td>
	    <td width="50%">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%" class="tdinput">
			  <select name="attcode">
			  <option><?php echo _TEACHER_MANAGE_ATTENDANCE_3_SELECT_CODE?></option>
			   <?
			   //Display attendance codes from table
			   foreach($attendancecodes as $attendancecode){
			   ?>
		       <option value="<? echo $attendancecode->attendance_codes_id; ?>" <? if ($attendancecode->attendance_codes_id==$attendance->attendance_codes_id){echo "selected=selected";};?>><? echo $attendancecode->attendance_codes_desc; ?></option>
			   <?
			   };
			   ?>
			   </select>
		</td>
		<td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="attdate" size="10" value="<? if($action=="edit"){echo $attendance->attdate;};?>" READONLY onclick="javascript:show_calendar('attendance.attdate');"><a href="javascript:show_calendar('attendance.attdate');"><img src="images/cal.gif" border="0" class="imma"></a>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_NOTES?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<textarea name="attnotes" cols="40" rows="5"><? if($action=="edit"){echo strip($attendance->attendance_history_notes);};?></textarea></td>
	  </tr>
	  <?
	  if($action=="new"){
	  ?>
	  <tr>
	    <td width="100%" colspan="2" class="tdinput">&nbsp;<?php echo _TEACHER_MANAGE_ATTENDANCE_3_NOTIFY?>:<input type="checkbox" name="notify" value="1" checked=checked></td>
		<input type="hidden" name="sschool" value="<? echo $sschoolid; ?>">
	  </tr>
	  <?
	  };
	  ?>

    <? //custom fields added by Joshua
    	//get all the custom field names for the select loops
     $cfSQL = "SELECT * FROM custom_fields";
     $custom_fields = $db->get_results($cfSQL);

	?> <tr class="trform"><td colspan=2><?php echo _TEACHER_MANAGE_ATTENDANCE_3_CUSTOM_FIELDS?></td></tr>
	<tr><td colspan=2><table width="100%"> <?

    	if($custom_attendance_fields) {
		foreach($custom_attendance_fields as $custom_attendance_field) {
			?> <tr><td><select name="custom_fields[<?
			echo($custom_attendance_field->custom_attendance_history_id);
			?>]"><option value="0"><?php echo _TEACHER_MANAGE_ATTENDANCE_3_DELETE?>...</option><?
			foreach($custom_fields as $custom_field) {
				?><option value="<? echo($custom_field->custom_field_id);
				?>" <?
				if($custom_field->custom_field_id == $custom_attendance_field->custom_field_id) {
					echo" selected";
				}
				?>><?
				echo($custom_field->name);
				?></option><?
			}
			?></select></td><td><input type="text" name="custom_attendance_fields[<?
	    		echo($custom_attendance_field->custom_attendance_history_id);
	    		?>]" value="<? echo($custom_attendance_field->data);
	    		?>" size=70></td></tr> <?
		} 
	}
	?><tr><td><select name="new_custom_field_id">
	<option value="0" selected><?php echo _TEACHER_MANAGE_ATTENDANCE_3_NEW?>...</option><?
	foreach($custom_fields as $custom_field) {
		?><option value="<?echo($custom_field->custom_field_id);
		?>"><? echo($custom_field->name);
		?></option><?
	} 
	?></td><td><input type="text" name="new_custom_field_data" size=70>
	</td></tr></table></td></tr><?
	//end custom fields
	?>

	<table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><?php echo _TEACHER_MANAGE_ATTENDANCE_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _TEACHER_MANAGE_ATTENDANCE_3_UPDATE;}else{echo _TEACHER_MANAGE_ATTENDANCE_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="attid" value="<? echo $attid; ?>">
	  <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
