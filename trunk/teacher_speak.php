<?
//*
// teacher_speak.php
// Teacher Section
// Display Speaking Hours Table
//*
//Version 1 2007-05-03 Helmut
//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || (($_SESSION['UserType'] != "T") && ($_SESSION['UserType'] != "N")))
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
$msgFormErr="";

//Get current year
$cyear=$_SESSION['CurrentYear'];
$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear");

$teacherid=$_SESSION['teacherid'];
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];

//get list of teachers
$sSQL="SELECT * FROM teachers ORDER BY teachers_id";
$teachers=$db->get_results($sSQL);
//get list of days
$sSQL="SELECT * FROM tbl_days ORDER BY days_id";
$days=$db->get_results($sSQL);

//Check what we have to do
$action=get_param("action");
$sort=get_param("sort");
$id=get_param("id");
$day=get_param("day");
$period=get_param("period");

if (!strlen($action))
  $action="none";

switch ($action) {
	case "update":
	$sSQL="UPDATE speak SET speak_teacherid='$teacherid', speak_day='$day', speak_period='$period' 
	WHERE speak_id='$id'";
	$db->query($sSQL);
	break;
}

//Set paging appearence
$pSQL = "SELECT speak_id, days_desc, speak_period, teachers_fname, teachers_lname, speak_teacherid 
FROM ((speak 
INNER JOIN teachers ON teachers_id = speak_teacherid) 
INNER JOIN tbl_days ON days_id = speak_day) "; 
switch ($sort) {
case "teacher":
        $order = "teachers_lname, speak_day, speak_period";
	break;
case "day":
	$order = "speak_day, speak_period, teachers_lname";
	break;
case "period":
	$order = "speak_period, speak_day, teachers_lname";
	break;
default:
	$order = "teachers_lname, speak_day, speak_period";
}
$pSQL .= "ORDER BY " . $order;
$ezr->query_mysql($pSQL);
$ezr->results_open = "<table width=80% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_heading = "<tr class=tblhead>
<td width=50%><a href=\"teacher_speak.php?sort=name\">" . _TEACHER_SPEAK_TEACHER . "</td>
<td width=25%><a href=\"teacher_speak.php?sort=day\">" . _TEACHER_SPEAK_DAY . "</td>
<td width=25%><a href=\"teacher_speak.php?sort=period\">" . _TEACHER_SPEAK_PERIOD . "</td>
</tr>";
$ezr->results_row = "<tr>
<td class=paging width=50%>COL5 COL4</td>
<td class=paging width=25% align=center>COL2</td>
<td class=paging width=25% align=center>COL3</td>
</tr>";

$sSQL = "SELECT speak_id, days_desc, speak_day, speak_period 
FROM (speak 
INNER JOIN tbl_days ON days_id = speak_day) 
WHERE speak_teacherid='$teacherid'";
$own = $db->get_row($sSQL);

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
    <td width="50%"><? echo _TEACHER_SPEAK_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _TEACHER_SPEAK_TITLE?></h1>
	<br>
	<?
	//Dislay results with paging options
	$ezr->display();
	?>
	<br>

<form name="editspeak" method="post" action="teacher_speak.php">
<p class="pform"><? echo _TEACHER_SPEAK_UPDATE_SUBJECT?>
<table border="0" cellpadding="0" cellspacing="0"><tr>

<td><b><? echo $tfname . " " . $tlname . ": " ; ?></b></td>

<td>&nbsp;</td>

<td><? echo _TEACHER_SPEAK_DAY?>:</td>
<td class="tdinput">
<select name="day">
	<? //Display teachers from table
	foreach($days as $day){
	?>
		<option value="<? echo $day->days_id; ?>"
		<? if ($day->days_id==$own->speak_day){echo
		"selected=selected";};?>><? echo $day->days_desc ?></option>
	<? }; ?>
</select>
</td>

<td>&nbsp;</td>

<td>&nbsp;<? echo _TEACHER_SPEAK_PERIOD?>:</td>
<td class="tdinput">
<select name="period">
<? for ($i=1; $i<=10; $i++) { ?>
<option value="<? echo $i; ?>" <?
if ($i==$own->speak_period) {echo
"selected=selected";};?>>
<? echo $i; ?>
<? }; ?>
</select>
</td>

<td>&nbsp;</td>

<td>
&nbsp;<input type=submit value="<? echo _TEACHER_SPEAK_UPDATE?>">
</td>

</tr></table>
<input type="hidden" name="action" value="update">
<input type="hidden" name="id" value="<? echo $own->speak_id; ?>">
</p>
</form>


</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
