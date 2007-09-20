<?php
//*
// contact_manage_attendance_2.php
// Contacts Section
// Display details on attendance record for student
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
$disid=get_param("attid");

//Get info
$sSQL="SELECT studentbio.studentbio_lname, studentbio.studentbio_fname, school_names.school_names_desc, school_years.school_years_desc, DATE_FORMAT(attendance_history.attendance_history_date, '" . _EXAMS_DATE . "') as attdate, attendance_codes.attendance_codes_desc, attendance_history.attendance_history_notes, web_users.web_users_flname FROM ((((studentbio INNER JOIN attendance_history ON studentbio.studentbio_id = attendance_history.attendance_history_student) INNER JOIN school_names ON attendance_history.attendance_history_school = school_names.school_names_id) INNER JOIN school_years ON attendance_history.attendance_history_year = school_years.school_years_id) INNER JOIN attendance_codes ON attendance_history.attendance_history_code = attendance_codes.attendance_codes_id) INNER JOIN web_users ON attendance_history.attendance_history_user = web_users.web_users_id WHERE attendance_history_id='$attid'";
$attendance=$db->get_row($sSQL);

//get the custom fields associated with this attendance event added by Joshua
$custom_attendance_sql = "SELECT * from custom_attendance_history, custom_fields 
	WHERE (custom_attendance_history.custom_field_id = custom_fields.custom_field_id) 
	AND (attendance_history_id = '$attid')";
$custom_attendance_fields = $db->get_results($custom_attendance_sql);

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
    <td width="50%"><?php echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _CONTACT_MANAGE_ATTENDANCE_2_TITLE?></h1>
	<br>
	<h2><?php echo $attendance->studentbio_fname. " " .$attendance->studentbio_lname; ?></h2>
	<br>
	<h2><?php echo _CONTACT_MANAGE_ATTENDANCE_2_INSERTED?><? echo $attendance->web_users_flname; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_ATTENDANCE_2_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_ATTENDANCE_2_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $attendance->school_names_desc ; ?></td>
	    <td width="50%">&nbsp;<?php echo $attendance->school_years_desc ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_ATTENDANCE_2_CODE?></td>
	    <td width="50%">&nbsp;<?php echo _CONTACT_MANAGE_ATTENDANCE_2_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $attendance->attendance_codes_desc ; ?></td>
		<td width="50%">&nbsp;<?php echo $attendance->attdate ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<?php echo _CONTACT_MANAGE_ATTENDANCE_2_NOTES?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php echo $attendance->attendance_history_notes ; ?></td>
	  </tr>
	  	<? //display custom fields added by Joshua
     if(count($custom_attendance_fields)) {
		?><tr><td colspan=2><h2><?php echo _CONTACT_MANAGE_ATTENDANCE_2_CUSTOM_FIELDS?></h2></td></tr>
		<tr><td colspan=2><table width="100%"><?php
     	foreach($custom_attendance_fields as $custom_attendance_field) {
  			?><tr><td class="tblhead"><?php
  			echo($custom_attendance_field->name);
  			?>:</td><td class="tblcont"><?php
			echo($custom_attendance_field->data);
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
 	    <td width="50%"><a href="contact_manage_attendance_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _CONTACT_MANAGE_ATTENDANCE_2_BACK?></a></td>
 	    <td width="50%" align="right"><a href="contact_manage_attendance_1.php?studentid=<?php echo $studentid; ?>&attid=<? echo $attid; ?>&action=edit" class="aform"><?php echo _CONTACT_MANAGE_ATTENDANCE_2_EDIT?></a></td>
           </tr>
        </table>
-->
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
