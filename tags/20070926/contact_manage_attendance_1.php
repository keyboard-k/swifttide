<?php
//*
// contact_manage_attendance_1.php
// Contacts Section
// Display attendance records for student
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$current_year=$_SESSION['CurrentYear'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get student id
$studentid=$_SESSION['StudentId'];
if(!strlen($studentid)){
	$msgFormErr=_CONTACT_MANAGE_ATTENDANCE_1_FORM_ERROR . "<br>";
}else{
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get attendance history
	$sSQL="SELECT attendance_history.attendance_history_id, DATE_FORMAT(attendance_history.attendance_history_date, '" . _EXAMS_DATE . "') as attdate ,attendance_codes.attendance_codes_desc FROM attendance_history INNER JOIN attendance_codes ON  attendance_history.attendance_history_code = attendance_codes.attendance_codes_id WHERE attendance_history.attendance_history_student=$studentid AND attendance_history.attendance_history_year=$current_year ORDER BY  attendance_history.attendance_history_date DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td width=40%>" . _CONTACT_MANAGE_ATTENDANCE_1_DATE . "</td><td width=40%>" . _CONTACT_MANAGE_ATTENDANCE_1_CODE . "</td><td width=20%>" . _CONTACT_MANAGE_ATTENDANCE_1_DETAILS . "</td></tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40%>COL2</td><td class=paging width=40% align=center>COL3</td><td class=paging width=20% align=center><a href=contact_manage_attendance_2.php?studentid=$studentid&attid=COL1 class=aform>&nbsp;" . _CONTACT_MANAGE_ATTENDANCE_1_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _CONTACT_MANAGE_ATTENDANCE_1_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname; ?></h2>
	<br>
	<?php
	$ezr->display();
	?>
	<br>
	<?php
	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<?php
	};
	?>
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
