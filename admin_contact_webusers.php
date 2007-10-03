<?
//*
// admin_contact_webusers.php
// Admin Section
// Process update contact for webusers
// V1, 9-22-07 Doug
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

//Get current year
$current_year=$_SESSION['CurrentYear'];

//Set variable for menu
$menustudent=1;

//Gather info from form
$cid=get_param("contactid");

//No errors on validation, insert/update record
if ($msgFormErr==""){

			  $sSQL="SELECT web_users_username, 
web_users_password,web_users_relid FROM web_users WHERE 
web_users_type='C' AND web_users_id=$contactid";
			  $webuser=$db->get_row($sSQL);
			  $username=$webuser->web_users_username;
			  $password=$webuser->web_users_password;
			  $webrelid=$webuser->web_users_relid;
	$sSQL="SELECT studentcontact_email from studentcontact where 
studentcontact_id=$webrelid";
	$email=$db->get_var($sSQL);

};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if fields are empty */
function submitform()
{
  var f = document.forms[0];
  var x = "";
  var t = f.elements['email']; 
  if (t.value=="") 
     x = x+"x";
  var t = f.elements['username']; 
  if (t.value=="") 
     x = x+"x";
  var t = f.elements['password']; 
  if (t.value=="") 
     x = x+"x";

  if (x != ""){
	  alert('<?php echo _ADMIN_ADD_EDIT_CONTACT_6_ENTER_ALL?>');
	  return false;
  }
  else{
	  return true;
  }
}
</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_ADD_EDIT_CONTACT_6_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_CONTACT_6_TITLE?> <?php echo $msg_header; ?> <?php echo _ADMIN_ADD_EDIT_CONTACT_6_CONTACT?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_EDIT_CONTACT_6_ERROR_BACK?></h2>
	   <br>
	   <h3><?php echo $msgFormErr; ?></h3>
	<?
	}else{
	?>
	   <h1><?php echo _ADMIN_CONTACT_WEBUSERS_TOP?> <?php echo $msg_header; ?> <?php echo _ADMIN_ADD_EDIT_CONTACT_6_CONTACT?></h1>
	   <br>
	   <h2>Contact : <?php echo stripslashes($cfname)." 
".stripslashes($clname); ?></h2>
	   <br>
	   <p class="ltext"><?php echo _ADMIN_ADD_EDIT_CONTACT_6_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><?php echo _ADMIN_ADD_EDIT_CONTACT_6_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<?php echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_6_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10" value="<?php echo $username; ?>">&nbsp;
	   <?php echo _ADMIN_ADD_EDIT_CONTACT_6_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10" value="<?php echo $password; ?>"></p>
	   <input type="submit" name="submit" value="<?php echo 
_ADMIN_CONTACT_WEBUSERS_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<?php echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<?php echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<?php echo $sfname ; ?>">
	   <input type="hidden" name="cfflname" value="<?php echo $cfname." ".$clname ; ?>">
	   <input type="hidden" name="rback" value="back">
	   </form>
	   <a href="admin_contact_2.php?action=searchcontacts<?php echo 
$studentid; ?>" class="aform"><?php echo _ADMIN_CONTACT_WEBUSERS_BACK?></a>
	<?
	};
	?>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
