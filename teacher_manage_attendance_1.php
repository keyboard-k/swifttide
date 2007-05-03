<?
//*
// teacher_manage_attendance_1.php
// Teachers Section
// Display attendance records for student
//*
//Verison 1.01 April 4.2005

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// Include configuration
include_once "configuration.php";

//Get student id
$studentid=get_param("studentid");
if(!strlen($studentid)){
	$msgFormErr=_TEACHER_MANAGE_ATTENDANCE_1_FORM_ERROR . "<br>";
}else{
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get attendance history
	$sSQL="SELECT attendance_history.attendance_history_id, DATE_FORMAT(attendance_history.attendance_history_date, '%m/%d/%Y') as attdate ,attendance_codes.attendance_codes_desc FROM attendance_history INNER JOIN attendance_codes ON  attendance_history.attendance_history_code = attendance_codes.attendance_codes_id WHERE attendance_history.attendance_history_student=$studentid AND attendance_history.attendance_history_year=$current_year ORDER BY  attendance_history.attendance_history_date DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td width=40%>" . _TEACHER_MANAGE_ATTENDANCE_1_DATE . "</td><td width=40%>" . _TEACHER_MANAGE_ATTENDANCE_1_CODE . "</td><td width=20%>" . _TEACHER_MANAGE_ATTENDANCE_1_DETAILS . "</td></tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40%>COL2</td><td class=paging width=40% align=center>COL3</td><td class=paging width=20% align=center><a href=teacher_manage_attendance_2.php?studentid=$studentid&attid=COL1 class=aform>&nbsp;" . _TEACHER_MANAGE_ATTENDANCE_1_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _TEACHER_MANAGE_ATTENDANCE_1_TITLE?></h1>
	<br>
	<h2><? echo $sfname. " " .$slname; ?></h2>
	<br>
	<?
	$ezr->display();
	?>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><?php echo _TEACHER_MANAGE_ATTENDANCE_1_BACK?></a></td>
	    <td width="50%" align="right"><a href="teacher_manage_attendance_3.php?studentid=<? echo $studentid; ?>&action=new" class="aform"><?php echo _TEACHER_MANAGE_ATTENDANCE_1_ADD_NOTE?></a></td>
	  </tr>
	</table>
	<?
	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><? echo $msgFormErr; ?></h3>
	<br>
	<?
	};
	?>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
