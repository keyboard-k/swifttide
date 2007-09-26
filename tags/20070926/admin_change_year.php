<?php
//*
// admin_change_year.php
// Admin Section
// Change Current year to next one and switch students grades
//v1.5 12-4-05 spelling errors
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
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

$current_year=$_SESSION['CurrentYear'];

$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id='".$current_year."'");
$nextyear=$current_year+1;
$next_year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id='".$nextyear."'");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to ask confirmation before changing year */
function confirmchange() {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_CHANGE_YEAR_CONFIRM?>");
	if (answer == 1) {
		var url;
		url = "admin_conf_change_year.php"
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}
</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_CHANGE_YEAR_CONFIRM?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_CHANGE_YEAR_TITLE?></h1>
	<br>
	<p class="ltext">
	<?php echo _ADMIN_CHANGE_YEAR_TEXT1?><strong><?php echo $year; ?></strong><?php echo _ADMIN_CHANGE_YEAR_TO?><strong><?php echo $next_year;?></strong> ?<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT2?><strong><?php echo $next_year;?></strong><?php echo _ADMIN_CHANGE_YEAR_TEXT3?>
	<br>
	<?php echo _ADMIN_CHANGE_YEAR_TEXT4?>
	<br><br>
	<a href="#" onclick="javascript: confirmchange();" class="aform"><?php echo _ADMIN_CHANGE_YEAR_CONFIRM2?></a>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
