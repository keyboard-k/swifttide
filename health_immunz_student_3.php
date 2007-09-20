<?php
//*
// health_immunz_student_3.php
// Health Section
// Edit immunization record for student
//*
//Version 1.00 April 27,2005
//v1.01 May 01, 2005.  various little fixes
//V1.02 May 9, 2005.  Wasn't echoing reason for immunz to form.

//Check if admin or nurse is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N"  && 
$_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

$menustudent=1;
$web_user=$_SESSION['UserId'];
$current_year=$_SESSION['CurrentYear'];

//Get student id
$studentid=get_param("studentid");
//Get action
$action=get_param("action");


if ($action=="edit"){
	//Get health event id
	$disid=get_param("disid");
	//Gather info from db
	$sSQL="SELECT health_immunz_history.health_immunz_history_id, 
studentbio.studentbio_fname, studentbio.studentbio_lname, 
school_names.school_names_desc, school_years.school_years_desc, 
DATE_FORMAT(health_immunz_history.health_immunz_history_date, 
'" . _EXAMS_DATE . "') AS disdate, 
health_immunz_history.health_immunz_history_reason, 
health_immunz.health_immunz_desc, health_immunz.health_immunz_id, 
health_immunz_history.health_immunz_history_notes, 
web_users.web_users_flname FROM ((((health_immunz_history INNER JOIN 
studentbio 
ON health_immunz_history.health_immunz_history_student = 
studentbio.studentbio_id) 
INNER JOIN school_names ON health_immunz_history.health_immunz_history_school = 
school_names.school_names_id) INNER JOIN school_years ON 
health_immunz_history.health_immunz_history_year = school_years.school_years_id) 
INNER 
JOIN health_immunz ON health_immunz_history.health_immunz_history_code = 
health_immunz.health_immunz_id) INNER JOIN web_users ON 
health_immunz_history.health_immunz_history_user = web_users.web_users_id WHERE 
health_immunz_history.health_immunz_history_id=$disid";
	$health=$db->get_row($sSQL);
	$slname=$health->studentbio_lname;
	$sfname=$health->studentbio_fname;
	$user=$health->web_users_flname;
	$cyear=$health->school_years_desc;
	$sschool=$health->school_names_desc;

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
//Get list of immunization codes
$healthcodes=$db->get_results("SELECT * FROM health_immunz ORDER BY health_immunz_desc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<SCRIPT LANGUAGE="JAVASCRIPT">
<!--


// -->
</SCRIPT>


<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _HEALTH_IMMUNZ_STUDENT_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _HEALTH_IMMUNZ_STUDENT_3_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname ; ?></h2>
	<br>
	<h2><?php echo _HEALTH_IMMUNZ_STUDENT_3_INSERTED?><? echo $user; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<form name="health" method="POST" 
action="health_immunz_student_4.php">
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $sschool ; ?></td>
	    <td width="50%">&nbsp;<?php echo $cyear ; ?></td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_IMM?></td>
	    <td width="50%">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%" class="tdinput">
			  <select name="discode">
			  <option><?php echo _HEALTH_IMMUNZ_STUDENT_3_SELECT?></option>
			   <?php
			   //Display immunization codes from table
			   foreach($healthcodes as $healthcode){
			   ?>
		       <option value="<?php echo 
$healthcode->health_immunz_id; ?>" 
<? if ($healthcode->health_immunz_id==$health->health_immunz_id){echo 
"selected=selected";};?>><?php echo $healthcode->health_immunz_desc; 
?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
		<td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="disdate" size="10" value="<? if($action=="edit"){echo $health->disdate;};?>" READONLY onclick="javascript:show_calendar('health.disdate');"><a href="javascript:show_calendar('health.disdate');"><img src="images/cal.gif" border="0" class="imma"></a>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_REASON?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<input type="text" 
onChange="capitalizeMe(this)" name="disaction" value="<? 
if($action=="edit"){echo 
strip($health->health_immunz_history_reason);};?>"></td>
	  </tr>	  
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _HEALTH_IMMUNZ_STUDENT_3_NOTES?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<textarea name="disnotes" 
cols="40" rows="5"><? if($action=="edit"){echo 
strip($health->health_immunz_history_notes);};?></textarea></td>
	  </tr>

	<table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><? echo _HEALTH_IMMUNZ_STUDENT_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _HEALTH_IMMUNZ_STUDENT_3_UPDATE_NOTE;}else{echo _HEALTH_IMMUNZ_STUDENT_3_ADD_NOTE;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="disid" value="<?php echo $disid; ?>">
	  <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>
</div>
<?php include "health_menu.inc.php"; ?>
</body>

</html>
