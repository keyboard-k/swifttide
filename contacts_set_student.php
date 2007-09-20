<?php
//*
// contact_set_student.php
// Contacts Section
// Set the student
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
//Include Crypt class
include_once "classCrypt.php";
// config
include_once "configuration.php";


$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];

//Get student id
$student=get_param("studentid");
//Decrypt
$crpt = &New EncDec;
$crpt->hash="nscegfbzucbrfzugrfzugcr";
$studentid=substr($crpt->phpDecrypt($student), 4);


//Set session to permit only this student to be displayed
//this is to avoid direct linking to other students
set_session("StudentId", $studentid);

//Get name
$student=$db->get_row("SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid");
$slname=$student->studentbio_lname;
$sfname=$student->studentbio_fname;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _CONTACTS_SET_STUDENT_TITLE?></h1>
	<p><?php echo _CONTACTS_SET_STUDENT_SUBTITLE?></p>
	<br>
	<h2><?php echo $sfname. " " .$slname; ?></h2>
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
