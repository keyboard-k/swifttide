<?
//*
// admin_mass_email.php
// Admin Section
// Send email message to selected recipients or all
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

// config
include_once "configuration.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
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
    <td width="50%"><? echo _ADMIN_MASS_EMAIL_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_MASS_EMAIL_TITLE?></h1>
	<table width="85%">
	    <tr> 
	      <td>
			  <p class="ltext"><? echo _ADMIN_MASS_EMAIL_SUBTITLE?></p>
		  </td>
		</tr>
		  <form name="massmail" method="post" action="admin_process_mass_mail.php">
		<tr>
		  <td class="tdinput"><? echo _ADMIN_MASS_EMAIL_SEND?> : <br>
			<input type="radio" value="studentcontact" checked name="mailto"> <? echo _ADMIN_MASS_EMAIL_CONTACTS?>
		    <input type="radio" value="teachers" name="mailto"> <? echo _ADMIN_MASS_EMAIL_TEACHERS?>
			<input type="radio" value="both" name="mailto"> <? echo _ADMIN_MASS_EMAIL_BOTH?> <br>
			<? echo _ADMIN_MASS_EMAIL_SUBJECT?> :<br>
			<input type="text" name="subject" size="50"><br>
		 </td>
	  </tr>
	  <tr> 
	      <td class="tdinput">
		  <? echo _ADMIN_MASS_EMAIL_MESSAGE?> : <br>
	        <textarea name="message" cols="65" rows="6"></textarea>
	      </td>
     </tr>
	 <tr> 
		<td><b><A href="javascript: submitform('message')" class="aform"><? echo _ADMIN_MASS_EMAIL_NOW?></a></b></td>
  </tr>					  
  </form>
 </table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
