<?
//*
// teacher_change_student_year.php
// Teachers Section
// Change Current year for selected operations on students
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
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

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION['CurrentYear'];
$end_year=$db->get_var("SELECT current_year FROM tbl_config WHERE id=1");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _ADMIN_MAIN_MENU_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to ask confirmation before changing year */
function confirmchange(id) {
	var answer;	
	answer = window.confirm("<?php echo _TEACHER_CHANGE_STUDENT_YEAR_CONFIRM?>");
	if (answer == 1) {
		var url;
		url = "teacher_set_student_year.php?yearid="+ id;
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
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _TEACHER_CHANGE_STUDENT_YEAR_TITLE?></h1>
	<br>
	<p class="ltext"><?php echo _TEACHER_CHANGE_STUDENT_YEAR_SELECT?></p><br>
	<?
	for ($i=1; $i<=$end_year; $i++){
		$tyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$i");
	?>
	<a href="#" onclick="javascript:confirmchange(<? echo $i;?>);" class="aform"><? echo $tyear; ?></a><br>
	<?
	};
	?>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
