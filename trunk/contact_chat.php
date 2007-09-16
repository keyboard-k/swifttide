<?
//*
// contact_chat.php
// Contact Section
// Contact enters chat
//v1.0 2007-06-20 Helmut
//*

//Check if admin is logged in
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
// config
include_once "configuration.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>

<script language="JavaScript">
function display_chat() {
	window.open("chat/index.php", "Chat","scrollbars=yes,menubar=yes,status=no,toolbar=yes,resizable=yes");
// return true;
}
//-->
</script>

<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>

    <td width="50%"><? echo _CNOTACT_CHAT_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _CONTACT_CHAT_TITLE?></h1>
	<br>
	<h3><a href="javascript:display_chat();"><? echo _CONTACT_CHAT_TEXT?></a></h3>
</div>
<? include "contact_menu.inc.php"; ?>
</body>

</html>
