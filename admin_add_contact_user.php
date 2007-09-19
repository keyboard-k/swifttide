<?
//admin_add_contact_user.php
//Admin section - add logins to web users table
//Version 1.01 April 30,2005
//Writes to the parent_to_kids table
//V1.5 true multiyear capability
//v1.51 12-27-05 write contact full name to web users, set them to active

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

//Gather Information from form
$studentid=get_param("studentid");
$contactid=get_param("contactid");
$email=get_param("email");
$username=tosql(get_param("username"), "Text");
$password=tosql(get_param("password"), "Text");
$sfname=tosql(get_param("sfname"), "Text");
$slname=tosql(get_param("slname"), "Text");
$rback=get_param("rback");
$contact=$db->get_row("SELECT studentcontact_fname, studentcontact_lname FROM studentcontact WHERE studentcontact_id='".$contactid."'");
$flname=$contact->studentcontact_fname." ".$contact->studentcontact_lname;

//Validate email
$oEmail = new email;
if (!$oEmail->valida($email))
	$msgFormErr = _ADMIN_ADD_CONTACT_USER_FORM_ERROR . "<br>";

//No errors found
//Set as internet user
if ($msgFormErr==""){
	$sSQL="UPDATE contact_to_students 
	SET contact_to_students_internet=1 
	WHERE contact_to_students_student='".$studentid."'" 
	AND contact_to_students_contact='".$contactid."'" 
	AND contact_to_students_year='".$current_year."'";
	$db->query($sSQL);
	$sSQL="UPDATE studentcontact 
	SET studentcontact_email=".tosql($email, "Text")." 
	WHERE studentcontact_id='".$contactid."'" 
	AND studentcontact_year='".$current_year."'";
	$db->query($sSQL);
	//Check if it is new or coming from student screen (if it is coming from the student screen, it is an update of existing info)
	//Here, it's a new entry
	if (!strlen($rback)){
		//check to see if this user already exists in web_users
		//$sSQL="SELECT web_users_username, web_users_password, web_users_flname FROM web_users WHERE web_users_username=i'".$username."'"; 
		$sSQL="INSERT INTO web_users (web_users_type, web_users_relid, 
		web_users_username, web_users_password, web_users_flname, active) 
		VALUES ('C', $contactid, $username, $password, '$flname', 1)";
		$db->query($sSQL);
		if (!($web=$db->get_row("SELECT parent_id, student_id 
			FROM parent_to_kids 
			WHERE parent_id='".$contactid."'" 
			AND student_id='".$studentid."'"))) {
		$sSQL="INSERT INTO parent_to_kids (parent_id, student_id) VALUES ($contactid, $studentid)"; }
		$db->query($sSQL);
	//here, we're coming from student info, so it's an update
	}else{
		$menustudent=1;
		if($web=$db->get_var("SELECT web_users_id FROM web_users WHERE web_users_type='C' AND web_users_relid='"$contactid."'")){
			$sSQL="UPDATE web_users SET web_users_username='".$username."', web_users_password='".$password."' WHERE web_users_id='".$web."'";
			$db->query($sSQL);
		}else{
			$sSQL="INSERT INTO web_users (web_users_type, web_users_relid, web_users_username, 
			web_users_password, web_users_flname, active) 
			VALUES ('C', $contactid, $username, $password, '$flname', 1)";
			$db->query($sSQL);
			$sSQL="INSERT INTO parent_to_kids (parent_id, student_id) VALUES ($contactid, $studentid)";
			$db->query($sSQL);
		};
	};
};
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
    <td width="50%"><? echo _ADMIN_ADD_CONTACT_USER_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><? echo _ADMIN_ADD_CONTACT_USER_TITLE_ERROR?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_CONTACT_USER_ERROR_BACK?></h2>
	   <br>
	   <h3><? echo $msgFormErr; ?></h3>
	<?
	}else{
	?>
	   <h1><? echo _ADMIN_ADD_CONTACT_USER_TITLE_SUCCESS?></h1>
	   <br>
	   <h2>Student : <? echo $sfname." ".$slname; ?></h2>
	   <br>
	   <h2>User : <? echo $username; ?></h2>
	   <br>
	   <?
		if(!strlen($rback)){
		?>
	      <a href="admin_add_edit_contact_1.php?id=<? echo $studentid; ?>&action=add" class="aform"><? echo _ADMIN_ADD_CONTACT_USER_ADD?></a>
		<?
		}else{
		?>
		<a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_ADD_CONTACT_USER_BACK?></a>
	    <?
		};
	};
	?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
