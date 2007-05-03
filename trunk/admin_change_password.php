<?
//*
// admin_change_password.php
// Admin Section
// Form to change password
// 033007 first version, doug
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Inizialize databse functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";

// Include configuration
include_once "configuration.php";

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$user_id=$_SESSION['UserId'];
$action=get_param("action");

$sSQL="SELECT web_users_flname FROM web_users WHERE 
web_users_id=$user_id";
$web_users_flname=$db->get_var($sSQL);


if($action=="update"){
	$tpass=tosql(get_param("password"), "Text");
	$sSQL="UPDATE web_users SET web_users_password=$tpass WHERE web_users_id=$user_id";
	$db->query($sSQL);
}else{
	$sSQL="SELECT web_users_password FROM web_users WHERE web_users_id=$user_id";
	$tpass=$db->get_var($sSQL);
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
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
    alert("You have to enter a value !");
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
    <td width="50%"><?php echo _WELCOME?>, <? echo $web_users_flname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?
	if($action=="update"){
	?>
	<h1><?php echo _ADMIN_CHANGE_PASSWORD_SUCCESSFUL?></h1>
	<?
	}else{
	?>
	<h1><?php echo _ADMIN_CHANGE_PASSWORD_TITLE?></h1>
	<br>
	<form name="changepass" method="POST" action="admin_change_password.php">
	<input type="text" size="20" name="password" value="<? echo $tpass; ?>" onchange="this.value=this.value.toLowerCase();">
	<br>
	<input type="hidden" name="action" value="update">
	<a class="aform" href="javascript: submitform('password')"><?php echo _ADMIN_CHANGE_PASSWORD_UPDATE?></a>
	</form>
	<?
	};
	?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
