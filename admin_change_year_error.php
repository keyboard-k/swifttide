<?
//*
// admin_change_year_error.php
// Admin Section
// Notify that attempt to change year was unsuccessful
//v1.5 12-4-05 initial
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

//Get the error message from the sending form
$error=get_param($msgFormErr);

$current_year=$_SESSION['CurrentYear'];

$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year");
$nextyear=$current_year+1;
$next_year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nextyear");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>

<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_CHANGE_YEAR_ERROR_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_CHANGE_YEAR_ERROR_TITLE?></h1>
	<br><br>
	<h3><? echo _ADMIN_CHANGE_YEAR_ERROR_TEXT1?></h3><br>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
