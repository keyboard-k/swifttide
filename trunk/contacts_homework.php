<?
//*
// contacts_homework.php
// Contacts Section
// View Assigned Homework
//*
//Version 1.01 April 15 2005
//V 1.01 Just display all homework since kids aren't assigned yet.

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
// config
include_once "configuration.php";

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];

$studentid=$_SESSION['StudentId'];

//Get name
$student=$db->get_row("SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid");
$slname=$student->studentbio_lname;
$sfname=$student->studentbio_fname;

$sroom=$db->get_var("SELECT studentbio_homeroom FROM studentbio WHERE studentbio_id='$studentid'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
<script language="JavaScript" src="datepicker.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>

<!-- the homework content table -->
<div id="Content">
<h1><? echo _CONTACTS_HOMEWORK_TITLE?></h1>
<br>

<table width="100%" border=1>

<?
//add date comparisons
$homework_query = "SELECT *, grade_subject_desc, school_rooms_desc, 
	teachers_fname, teachers_lname, 
	WEEKDAY(date_assigned) + 1 as on_day, 
	WEEKDAY(date_due) + 1 as due_day 
	FROM ((((homework 
	INNER JOIN grade_subjects ON subjectid=grade_subject_id) 
	INNER JOIN school_rooms ON roomid=school_rooms_id) 
	INNER JOIN teachers ON homework.teacher_id=teachers.teachers_id) 
	INNER JOIN tbl_days ON WEEKDAY(date_assigned)+1 = days_id)
	WHERE (homework.roomid = '$sroom') 
	AND ((date_assigned <= CURDATE()) AND (date_due >= CURDATE())) 
	ORDER BY date_due";



$homework = $db->get_results($homework_query);

if(is_array($homework)) {

foreach($homework as $assignment) {
$sSQL = "SELECT days_desc FROM tbl_days WHERE days_id='$assignment->on_day'";
$onday = $db->get_var($sSQL);
$sSQL = "SELECT days_desc FROM tbl_days WHERE days_id='$assignment->due_day'";
$dueday = $db->get_var($sSQL);

//display all active homework
?><tr><td>

<!-- start of new homework table -->
<table border=0 width="100%">
  <th align="left" colspan="3"><?echo($assignment->name);?></th>
  <tr>
    <td class="tblcont">
      <? echo _CONTACTS_HOMEWORK_SUBJECT?>:
      <?echo($assignment->grade_subject_desc);?>
    </td>
    <td class="tblcont">
      <? echo _CONTACTS_HOMEWORK_ROOM?>:
      <?echo($assignment->school_rooms_desc);?>
    </td>
    <td class="tblcont">
      <? echo _CONTACTS_HOMEWORK_TEACHER?>:
      <? if($assignment->teachers_email) { ?>
      <a href="mailto:<?echo($assignment->teachers_email);?>">
        <?echo("$assignment->teachers_fname $assignment->teachers_mi $assignment->teachers_lname");?>
      </a>
      <? } else { 
      echo("$assignment->teachers_fname $assignment->teachers_mi $assignment->teachers_lname");
      }
      ?>
    </td>
  </tr>
  <tr><td colspan=3>&nbsp;</td></tr>
  <tr>
    <td align="left" width="20%" class="tblcont">
      <? echo _CONTACTS_HOMEWORK_ASSIGNED_ON?>:<br>
      <?echo $assignment->date_assigned  . " (" . $onday . ")";?>
    </td>
    <td align="left" width="20%" class="tblcont">
      <? echo _CONTACTS_HOMEWORK_DUE_ON?>:<br>
      <?echo $assignment->date_due . " (" . $dueday . ")";?>
    </td>
    <td align="left" width="60%" class="tblcont">
      <? echo _CONTACTS_HOMEWORK_NOTES?>:<br>
      <?echo($assignment->notes);?>
    </td>
  </tr>
  <tr><td colspan=3>&nbsp;</td></tr>

<?
$homework_files_query = "SELECT * FROM homework_files WHERE homework_id = '$assignment->homework_id'";
$homework_files = $db->get_results($homework_files_query);
if(is_array($homework_files)) { ?>
  <tr>
    <td align="left" class="tblcont" colspan="3"><? echo _CONTACTS_HOMEWORK_FILES?>:
      <?
      foreach($homework_files as $hf) {
	echo"&nbsp;&nbsp;<a href='$hf->location' target='_blank'>$hf->title</a>";
      } ?>
    </td>
  </tr>
<?
}
?>


  <tr><td colspan=3>&nbsp;</td></tr>
</table>
<!-- end of current homework table --><?

}

} else {
	//no homework returned
}

?>

</table>
</div>
<? include "contact_menu.inc.php"; ?>
</body>

</html>
