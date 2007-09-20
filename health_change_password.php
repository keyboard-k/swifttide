<?php
//*
// health_change_password.php
// Health Section
// Form to change password
//*
//Version 1.00 April 12,2005

//Check if nurse is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Inizialize database functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";
// config
include_once "configuration.php";

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$user_id=$_SESSION['UserId'];
$action=get_param("action");

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
<title><` echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
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
    alert("<?php echo _ENTER_VALUE?>");
}
</script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?php
	if($action=="update"){
	?>
	<h1><?php echo _HEALTH_CHANGE_PASSWORD_SUCCESSFUL?></h1>
	<?php
	}else{
	?>
	<h1><?php echo _HEALTH_CHANGE_PASSWORD_TITLE?></h1>
	<br>
	<form name="changepass" method="POST" action="health_change_password.php">
	<input type="text" size="20" name="password" value="<?php echo $tpass; ?>" onchange="this.value=this.value.toLowerCase();">
	<br>
	<input type="hidden" name="action" value="update">
	<a class="aform" href="javascript: submitform('password')"><?php echo _HEALTH_CHANGE_PASSWORD_UPDATE?></a>
	</form>
	<?php
	};
	?>
</div>
<?php include "health_menu.inc.php"; ?>
</body>

</html>
