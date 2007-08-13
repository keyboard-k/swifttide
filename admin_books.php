<?
//*
// admin_books.php
// Admin Section
// Order books
// V1.0 2007-05-21
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";

$sSQL = "SELECT books_flname, books_address, books_city, books_state, books_zip, books_country, 
	books_phone, books_fax, books_email, books_notes, books_discount, subscription_id 
	FROM books";
$booksorder = $db->get_row($sSQL);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName];
  if (t.value!="")
    f.submit();
  else
    alert("<? echo _ENTER_VALUE?>");
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
    <td width="50%"><? echo _ADMIN_BOOKS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_BOOKS_TITLE?></h1>
	<br>
	<h2><? echo _ADMIN_BOOKS_SUBTITLE?></h2>
	<br>
	<table border="0">
	  <tr><td><b><? echo $booksorder->books_flname?></b></td></tr>
	  <tr><td>
	  <? echo $booksorder->books_address . ", " .
	    $booksorder->books_zip . " " .
	    $booksorder->books_city . ", " .
	    $booksorder->books_country?></td></tr>
	  </td></tr>
	  <tr><td><? echo _ADMIN_BOOKS_PHONE . ": " . $booksorder->books_phone?></td></tr>
	  <tr><td><? echo _ADMIN_BOOKS_FAX . ": " . $booksorder->books_fax?></td></tr>
	  <tr><td><? echo _ADMIN_BOOKS_EMAIL . ": " . $booksorder->books_email?></td></tr>
	  <tr><td><? echo $booksorder->books_notes?></td></tr>
	  <tr><td><? echo _ADMIN_BOOKS_DISCOUNT . ": " . $booksorder->books_discount . "%"?></td></tr>
	</table>

	<br>
	<br>
	<? echo _ADMIN_BOOKS_TEXT?>
	<br>
	<br>
	<? echo _ADMIN_BOOKS_TEXT2?>
	<br>
	<br>
	<b><? echo _ADMIN_BOOKS_TEXT3?></b>
	<br>
	<br>
	<form name="orderbooks" method="post" action="admin_books_2.php">
	  <table cellpadding=0>
	  <tr>
	    <td><? echo _ADMIN_BOOKS_ISBN?></td>
	    <td class=tdinput><input type="text" name="isbn" size="30"></td></tr>
	  <tr><td colspan="2">&nbsp;</td></tr>
	  <tr><td colspan="2">
	      <a class="aform" href="javascript: submitform('isbn')"><? echo _ADMIN_BOOKS_LOOKUP?></a></td>
	  </tr>
	  </table>
	  <input type="hidden" name="sub_id" value="<? echo $booksorder->subscription_id?>">
	</form>
	<br>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
