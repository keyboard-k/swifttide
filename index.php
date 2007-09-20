<?php
//*
// index.php
// All Sections
// Main login page
//*
//This is GPL software, licensed under version 2.0 of the GPL license.  For a copy of the GPL
//license, read LICENSE.TXT in this directory, or visit http://www.fsf.org
//
//Version 1.5.01

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";
// get version
include_once "installation/version.php";

$action=get_param("action");
//Set errors if any
if ($action=="errlog")
	$msgLogin=_INDEX_ERRLOG;
else if ($action=="notauth")
	$msgLogin=_INDEX_NOTAUTH;
else if ($action=="notfound")
	$msgLogin=_INDEX_NOTFOUND;
else if ($action=="gotpass")
	$msgLogin=_INDEX_GOTPASS;
else if ($action=="attempt")
	$msgLogin=_INDEX_ATTEMPT;
else $msgLogin="";

//Start a session to check repetitive attempts to login
session_start();
$tryattempts = $_SESSION['tryattempts'];

if(!strlen($tryattempts)){
	set_session("tryattempts", "0");
};

//Get general message
$msgall=$db->get_var("SELECT messageto_all FROM tbl_config WHERE id=1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>

<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body onLoad="document.forms.login.username.focus()">
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
      <td align="left" width="100%"><?php echo "Version " . $release; ?></td>
      <td align="right" width="100%"><?php echo $reldate; ?></td>
  </tr>
</table>
</div>

<div id="loginerr">
<?php echo $msgLogin; ?>
</div>
<div id="login">
	<form name="login" method="POST" action="login.php">	
	
<!--	<img src="images/sms_logo_small.gif" border="0" class="smlogo"><br>&nbsp; ---- Tony Sodano - 05.02.05 -->

	<div align=center>
	<table border=0><tr>
	<td align=center colspan=2>
	</td></tr>
	<tr>
	<td align=right>
	  <?php echo _INDEX_USERNAME?> :</td>
	<td align=left>
	  <input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="20">
	</td></tr>
	<tr>
	<td align=right>
	  <?php echo _INDEX_PASSWORD?> :</td>
	<td align=left>
	  <input type="password" name="password" onchange="this.value=this.value.toLowerCase();" size="20">
	</td></tr>
	</table>
	</div>
	<br>
	<input type="submit" name="submit" value="<?php echo _INDEX_LOGIN?>" class="frmlogin"></form><br><a class="forgot" href="forgot_password.php"><?php echo _INDEX_FORGOT_PASSWORD?> ?</a>
</div>
<div id="loginmsg">
<?php echo $msgall; ?>
</div>
</body>

</html>

