<?
//*
// health_med_student_2.php
// Health Section
// Display details on medicines for student
//*
//Version 1.00 April 27,2005
//1.00 Initial write

//Check if admin or nurse is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N" &&
$_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

$menustudent=1;

//Get Studentid
$studentid=get_param("studentid");

//Get attendace id
$disid=get_param("disid");

//Get info
$sSQL="SELECT health_med_history.health_med_history_id, 
studentbio.studentbio_fname, studentbio.studentbio_lname, 
school_names.school_names_desc, school_years.school_years_desc, 
DATE_FORMAT(health_med_history.health_med_history_date,'" . _EXAMS_DATE . "') AS disdate, 
health_medicine.health_medicine_desc, 
health_med_history.health_med_history_reason, 
health_med_history.health_med_history_notes, 
web_users.web_users_flname FROM ((((health_med_history INNER JOIN studentbio ON health_med_history.health_med_history_student = studentbio.studentbio_id) INNER JOIN school_names ON health_med_history.health_med_history_school = school_names.school_names_id) INNER JOIN school_years ON health_med_history.health_med_history_year = school_years.school_years_id) INNER JOIN health_medicine ON health_med_history.health_med_history_code = health_medicine.health_medicine_id) INNER JOIN web_users ON health_med_history.health_med_history_user = web_users.web_users_id WHERE health_med_history.health_med_history_id=$disid";

$discipline=$db->get_row($sSQL);

//get the custom fields associated with this discipline event added by Joshua
//$custom_discipline_sql = "SELECT * from custom_health_med_history, custom_fields WHERE (custom_health_med_history.custom_field_id = custom_fields.custom_field_id)AND (custom_health_med_history.health_med_history_id = '$disid')";
//$custom_discipline_fields = $db->get_results($custom_discipline_sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _HEALTH_MED_STUDENT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _HEALTH_MED_STUDENT_2_TITLE?></h1>
	<br>
	<h2><? echo $discipline->studentbio_fname. " " .$discipline->studentbio_lname; ?></h2>
	<br>
	<h2><? echo _HEALTH_MED_STUDENT_2_INSERTED?><? echo $discipline->web_users_flname; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<? echo _HEALTH_MED_STUDENT_2_SCHOOL?></td>
	    <td width="50%">&nbsp;<? echo _HEALTH_MED_STUDENT_2_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<? echo $discipline->school_names_desc ; ?></td>
	    <td width="50%">&nbsp;<? echo $discipline->school_years_desc ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<? echo _HEALTH_MED_STUDENT_2_MED?></td>
	    <td width="50%">&nbsp;<? echo _HEALTH_MED_STUDENT_2_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<? echo $discipline->health_medicine_desc ; ?></td>
		<td width="50%">&nbsp;<? echo $discipline->disdate ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<? echo _HEALTH_MED_STUDENT_2_REASON?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<? echo $discipline->health_med_history_reason ;?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<? echo _HEALTH_MED_STUDENT_2_NOTES?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<? echo $discipline->health_med_history_notes ; ?></td>
	  </tr>

	<?// display custom fields added by Joshua
	if(count($custom_discipline_fields)) {
		?><tr><td colspan=2><h2><? echo _HEALTH_MED_STUDENT_2_CUSTOM_FIELDS?></h2></td></tr>
		<tr><td colspan=2><table width="100%"><?
     	foreach($custom_discipline_fields as $custom_discipline_field) {
  			?><tr><td class="tblhead"><?
  			echo($custom_discipline_field->name);
  			?>:</td><td class="tblcont"><?
			echo($custom_discipline_field->data);
     	    	?></td></tr><?
     	 }
		 ?></table></td></tr><?
	} 
	//end of custom fields
	?>

	<table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="health_med_student_1.php?studentid=<? 
echo 
$studentid; ?>" class="aform"><? echo _HEALTH_MED_STUDENT_2_BACK?></a></td>
	    <td width="50%" align="right"><a 
href="health_med_student_3.php?studentid=<? echo $studentid; 
?>&disid=<? 
echo $disid; ?>&action=edit" class="aform"><? echo _HEALTH_MED_STUDENT_2_EDIT?></a></td>
	  </tr>
	</table>
</div>
<? include "health_menu.inc.php"; ?>
</body>

</html>
