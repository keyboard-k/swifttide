<?
//*
// contact_change_password.php
// Contacts Section
// Form to change password
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Inizialize databse functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";
// config
include_once "configuration.php";

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$cid=$_SESSION['UserId'];
$action=get_param("action");

if($action=="update"){
	$cpass=tosql(get_param("password"), "Text");
	$sSQL="UPDATE web_users SET web_users_password=$cpass WHERE web_users_type='C' AND web_users_relid=$cid";
	$db->query($sSQL);
}else{
	$sSQL="SELECT web_users_password FROM web_users WHERE web_users_type='C' AND web_users_relid=$cid";
	$cpass=$db->get_var($sSQL);
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
</script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<? echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?
	if($action=="update"){
	?>
	<h1><? echo _CONTACT_CHANGE_PASSWORD_SUCCESSFUL?></h1>
	<?
	}else{
	?>
	<h1><? echo _CONTACT_CHANGE_PASSWORD_TITLE?></h1>
	<br>
	<form name="changepass" method="POST" action="contact_change_password.php">
	<input type="text" size="20" name="password" value="<? echo $cpass; ?>" onchange="this.value=this.value.toLowerCase();">
	<br>
	<input type="hidden" name="action" value="update">
	<a class="aform" href="javascript: submitform('password')"><? echo _CONTACT_CHANGE_PASSWORD_UPDATE?></a>
	</form>
	<?
	};
	?>
</div>
<? include "contact_menu.inc.php"; ?>
</body>

</html>
