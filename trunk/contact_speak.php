<?
//*
// contact_speak.php
// Admin Section
// Display Speaking Hours Table
//*
//Version 1 2007-05-03 Helmut
//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}


//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get current year
$cyear=$_SESSION['CurrentYear'];
$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear");

//get list of teachers
$sSQL="SELECT * FROM teachers ORDER BY teachers_id";
$teachers=$db->get_results($sSQL);
//get list of days
$sSQL="SELECT * FROM tbl_days ORDER BY days_id";
$days=$db->get_results($sSQL);


//Set paging appearence
$ezr->query_mysql("SELECT speak_id, days_desc, speak_period, teachers_fname, teachers_lname, speak_teacherid 
FROM ((speak 
INNER JOIN teachers ON teachers_id = speak_teacherid) 
INNER JOIN tbl_days ON days_id = speak_day) 
ORDER BY teachers_lname, speak_day, speak_period");
$ezr->results_open = "<table width=75% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_heading = "<tr class=tblhead>
<td width=50%>" . _CONTACT_SPEAK_TEACHER . "</td>
<td width=25%>" . _CONTACT_SPEAK_DAY . "</td>
<td width=25%>" . _CONTACT_SPEAK_PERIOD . "</td>
</tr>";
$ezr->results_row = "<tr>
<td class=paging width=50%>COL5 COL4</td>
<td class=paging width=25% align=center>COL2</td>
<td class=paging width=25% align=center>COL3</td>
</tr>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _CONTACT_SPEAK_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _CONTACT_SPEAK_TITLE?></h1>
	<br>
	<?
	//Dislay results with paging options
	$ezr->display();
	?>
	<br>
</div>
<? include "contact_menu.inc.php"; ?>
</body>

</html>
