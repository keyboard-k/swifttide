<?
//*
// admin_backup.php
// Admin Section
// Backup MySQL Table
//*

//Check if Admin is logged in
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

//Check what we have to do
$action = get_param("action");

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
    <td width="50%"><? echo _ADMIN_BACKUP_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
<h1><? echo _ADMIN_BACKUP_2_TITLE?></h1>
<br>
<h2><? echo _ADMIN_BACKUP_2_SUBTITLE?></h2>
<BR>
<?php
switch ($action) {
case "file":
	echo _ADMIN_BACKUP_2_FILE_OK;
	break;

case "screen":
	echo _ADMIN_BACKUP_2_SCREEN_OK;
	break;

case "download":
	echo _ADMIN_BACKUP_2_DOWNLOAD_OK;
	break;

default:
	break;
} // end switch
?>

</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
