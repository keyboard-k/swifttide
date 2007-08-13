<?
//*
// admin_books_3.php
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

// get data from form
$quantity = get_param("quantity");
$isbn = get_param("isbn");
$booktitle = get_param("booktitle");
$bookpublisher = get_param("bookpublisher");
$booksummary = get_param("booksummary");
$sub_id = get_param("sub_id");

$schoolname = get_param("schoolname");
$schooladdress = get_param("schooladdress");
$schooladdress2 = get_param("schooladdress2");

// get data of book merchant
$sSQL = "SELECT books_flname, books_address, books_city, books_state, books_zip, books_country, 
	books_phone, books_fax, books_email, books_notes, books_discount, subscription_id 
	FROM books";
$booksorder = $db->get_row($sSQL);

// get data of admin
$sSQL = "SELECT tbl_admin_fname, tbl_admin_lname, tbl_admin_email FROM tbl_admin";
$admindata = $db->get_row($sSQL);

// get school data - needed?
$sSQL = "SELECT school_names_desc FROM school_names WHERE 1";
$schoolname = $db->get_var($sSQL);

// write text from email containing order
$bestellung = _ADMIN_BOOKS_3_SUBJECT . "\n\n";
$bestellung .= _ADMIN_BOOKS_3_ISBN . ": " . $isbn . "\n";
$bestellung .= _ADMIN_BOOKS_3_BOOKTITLE . ": " . $booktitle . "\n";
$bestellung .= _ADMIN_BOOKS_3_BOOKPUBLISHER . ": " . $bookpublisher . "\n";
$bestellung .= _ADMIN_BOOKS_3_BOOKSUMMARY . ": " . $booksummary . "\n";
$bestellung .= _ADMIN_BOOKS_3_QUANTITY . ": " . $quantity . "\n\n";

$bestellung .= _ADMIN_BOOKS_3_SCHOOLNAME . ": " . $schoolname . "\n";
$bestellung .= _ADMIN_BOOKS_3_SCHOOLADDRESS . ": " . $schooladdress . "\n";
$bestellung .= _ADMIN_BOOKS_3_SCHOOLADDRESS2 . ": " . $schooladress2 . "\n\n";
$bestellung .= _ADMIN_BOOKS_3_SENT_TO . ": " . $admindata->tbl_admin_fname . " " . $admindata->tbl_admin_lname . "\n";
$bestellung .= _ADMIN_BOOKS_3_SENT_TO_EMAIL . ": " . $admindata->tbl_admin_email . "\n\n";

// comment out later!!!
// $result = mail("h.leinfellner@sbg.at", "Buch-Bestellung", $bestellung);
// uncomment this later!!!
$result = mail($admindata->tbl_admin_email, "Buch-Bestellung", $bestellung);

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
    <td width="50%"><? echo _ADMIN_BOOKS_3_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
        <h1><? echo _ADMIN_BOOKS_3_TITLE?></h1>
	<br>
	<h2><? echo _ADMIN_BOOKS_3_SUBTITLE?></h2>
	<br>

<table cellpadding=0>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_ISBN . ":</b> " . $isbn;?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_BOOKTITLE . ":</b> " . $booktitle?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_BOOKPUBLISHER . ":</b> " . $bookpublisher?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_BOOKSUMMARY . ":</b> " . $booksummary?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_QUANTITY . ":</b> " . $quantity?></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_SENT_TO . ":</b> " . $admindata->tbl_admin_fname . " "
							    . $admindata->tbl_admin_lname?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_SENT_TO_EMAIL . ":</b> " . $admindata->tbl_admin_email?></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_SCHOOLNAME . ":</b> " . $schoolname?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_SCHOOLADDRESS . ":</b> " . $schooladdress?></td></tr>
  <tr><td><? echo "<b>" . _ADMIN_BOOKS_3_SCHOOLADDRESS2 . ":</b> " . $schooladdress2?></td></tr>
</table>

</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
