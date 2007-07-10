<?
//*
// admin_edit_student_2.php
// Admin Section
// Display additional contact details
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

//Gather student id
$studentid=get_param("studentid");
$contactid=get_param("contactid");

//Set variable for menu
$menustudent=1;

//Get all info to display
$sSQL="SELECT studentcontact.*, contact_to_students.contact_to_students_internet, contact_to_students.contact_to_students_relation, contact_to_students.contact_to_students_id, contact_to_students.contact_to_students_residence, relations_codes.relation_codes_desc FROM (studentcontact INNER JOIN contact_to_students ON studentcontact.studentcontact_id = contact_to_students.contact_to_students_contact) INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id WHERE studentcontact.studentcontact_id=$contactid";
$continfo=$db->get_row($sSQL);

$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
$studentinfo=$db->get_row($sSQL);
$slname=$studentinfo->studentbio_lname;
$sfname=$studentinfo->studentbio_fname;

//doug fix so titles are stored and displayed correctly
$sSQL="SELECT title_desc FROM tbl_titles WHERE 
title_id=$continfo->studentcontact_title";
$studentcontact_title=$db->get_var($sSQL);
//end of fix

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
    <td width="50%"><? echo _ADMIN_EDIT_STUDENT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_EDIT_STUDENT_2_TITLE?></h1>
	<br>
	<h2><? echo $sfname . " " . $slname; ?></h2>
	<br>
		<h2><? echo _ADMIN_EDIT_STUDENT_2_CONTACT?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $studentcontact_title . " " . $continfo->studentcontact_fname . " " .$continfo->studentcontact_lname . " (" . $continfo->relation_codes_desc . ")" ;?>
			<? if ($continfo->contact_to_students_residence==1){echo " <b>" . _ADMIN_EDIT_STUDENT_2_RESIDENCE . "</b>";}; ?>
			</td>
		  </tr>
		  <tr class="tblhead">
		    <td width="100%" colspan="3">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_ADDRESS?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $continfo->studentcontact_address1 . " " . $continfo->studentcontact_address2 ;?> </td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_CITY?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_STATE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_ZIP?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $continfo->studentcontact_city ; ?></td>
		    <td width="33%">&nbsp;<? echo $continfo->studentcontact_state ; ?></td>
		    <td width="33%">&nbsp;<? echo $continfo->studentcontact_zip ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_PHONE1?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_PHONE2?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_PHONE3?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $continfo->studentcontact_phone1 ; ?></td>
		    <td width="33%">&nbsp;<? echo $continfo->studentcontact_phone2 ; ?></td>
		    <td width="33%">&nbsp;<? echo $continfo->studentcontact_phone3 ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="67%" colspan="2">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_EMAIL?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_2_WEB_USER?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="67%" colspan="2">&nbsp;<? echo $continfo->studentcontact_email ; ?></td>
		    <td width="33%">&nbsp;<? if($continfo->contact_to_students_internet==1){echo _YES;}else{echo _NO;};?></td>
		  </tr>
		  <tr>
		    <td width="100%" colspan="3" align="right"><a href="admin_add_edit_contact_5.php?&contactid=<? echo $contactid; ?>&studentid=<? echo $studentid; ?>&contacttostudentsid=<? echo $continfo->contact_to_students_id; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_2_EDIT?></a>&nbsp;</td>
		  </tr>
	</table>
	<a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_2_BACK?></a>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
