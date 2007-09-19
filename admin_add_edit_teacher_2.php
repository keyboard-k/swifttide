<?php
//*
// admin_add_edit_teacher_2.php
// Admin Section
// Process update/add teacher
//*
//Version 1.01, April 10,2005.  Fixed:inability to add teachers.
//Version 1.02, April 20, 2005.  Added "Access to Health" field to assign 
//health personnel.
//V1.03 11-26-05, check for dupe username.  don't add if dupe.
//v1.52 12-30-05 display username/password, allow updating
//v1.52 12-31-05 when updating a teacher to add web access, update web users (add the 
//record if it doesn't already exist.
// 04-18-07 inserted missing line ("get_param") so teacher gets inserted correctly

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

//Gather info from form
$tfname=get_param("tfname");
$tlname=get_param("tlname");
$tmi=get_param("tmi");
$school=get_param("school");
$title=get_param("title");
$email=get_param("email");
$username=get_param("username");
$password=get_param("password");
$flname=$tfname." ".$tlname;
$health=get_param("health");
$stype=get_param("stype");
$webid=get_param("webid");
$action=get_param("action");

if($health=='N')
	$stype="N";
    elseif($health=='A')
	$stype="A";
  else $stype="T";

//Validate mandatory fields
$msgFormErr="";
if(!strlen($tfname))
      $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_ENTER_FIRST . "<br>";
if(!strlen($tlname))
      $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_ENTER_LAST . "<br>";
if(!strlen($username))
      $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_ENTER_USER . "<br>";
if(!strlen($password))
      $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_ENTER_PASS . "<br>";
if(!strlen($email)){
	  $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_ENTER_EMAIL . "<br>";
}else{
	 $oEmail = new email;
	 if (!$oEmail->valida($email)){ 
      $msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_EMAIL_VALID . "<br>";
	};
};

//Check to make sure duplicate usernames are not being assigned
	//check for duplicate username. 
	$tot=$db->get_var("SELECT COUNT(*) FROM web_users WHERE 
web_users_username='$username' AND web_users_id<>'$webid'");
	if($tot>0){
	$msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_DUP;
	};

//If a new user, check to make sure we're not adding dupe username.
//If a new user, webid will be empty	
	if($webid==""){
	$tot=$db->get_var("SELECT COUNT(*) FROM web_users WHERE 
web_users_username='$username'");
	if($tot>0){
	$msgFormErr .= _ADMIN_ADD_EDIT_TEACHER_2_DUP;
	};
	};

//No errors on validation, insert/update record
if ($msgFormErr==""){
	if ($action=="new"){
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_ADDED;
		$sSQL="INSERT INTO teachers (teachers_fname, teachers_lname, teachers_mi, teachers_school, teachers_email, teachers_title, teachers_active) VALUES (".tosql($tfname, "Text").", ".tosql($tlname, "Text").", ".tosql($tmi, "text").", $school, ".tosql($email, "Text").", $title, 'Y')";
		$db->query($sSQL);
		$teacherid=mysql_insert_id();
		$sSQL="INSERT INTO web_users (web_users_username, 
web_users_password, web_users_type, web_users_relid, web_users_flname, active) 
VALUES ('$username', '$password', '$stype', $teacherid, '$flname', 1)";
		$db->query($sSQL);
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_ADDED;
	}else{
		$teacherid=get_param("teacherid");
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_UPDATED;
		$sSQL="UPDATE teachers SET teachers_fname=".tosql($tfname, "Text").", teachers_lname=".tosql($tlname, "Text").", teachers_mi=".tosql($tmi, "Text").", teachers_school=$school, teachers_title=$title, teachers_email=".tosql($email, "text")."    WHERE teachers_id=$teacherid";
		$db->query($sSQL);
		$webid=get_param("webid");
		if($webid<>""){
		//must update existing record.
		 $sSQL="UPDATE web_users SET 
web_users_username=".tosql($username, "Text").", 
web_users_password=".tosql($password, "Text").", 
web_users_flname=".tosql($flname, "Text").", 
web_users_type=".tosql($stype, "Text")." WHERE web_users_id=$webid";
		}else{
		//insert a new record.
		$sSQL="INSERT INTO web_users (web_users_username, web_users_password, 
web_users_type, web_users_relid, web_users_flname, active) VALUES ('$username', 
'$password', '$stype', $teacherid, '$flname', 1)";
		}
		$db->query($sSQL);
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_UPDATED;
	};
}else{
	if ($action=="new"){
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_ADDING;
	}else{
		$msg_header=_ADMIN_ADD_EDIT_TEACHER_2_UPDATING;
	};
};
//Set appropriate menu
$rback=get_param("rback");
if(strlen($rback)){
	$menustudent=1;
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_ADD_EDIT_TEACHER_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_TEACHER_2_TITLE?> <?php echo $msg_header; ?> <?php echo _ADMIN_ADD_EDIT_TEACHER_2_TEACHER?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_EDIT_TEACHER_2_ERROR_BACK?></h2>
	   <br>
	   <h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_TEACHER_2_SUCCESSFULLY?> <?php echo $msg_header; ?> <?php echo _ADMIN_ADD_EDIT_TEACHER_2_TEACHER?></h1>
	   <br>
	   <h2><?php echo $tfname." ".$tlname; ?></h2>
	   <br>
	   <a href="admin_add_edit_teacher_1.php?action=new" class="aform"><?php echo _ADMIN_ADD_EDIT_TEACHER_2_ADD_TEACHER?></a>
	<?php
	};
	?>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
