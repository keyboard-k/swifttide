<?php
//*
// contact_exams.php
// Contacts Section
// Display exams for student
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

$sort = get_param("sort");

//Get current year
$cyear=$_SESSION['CurrentYear'];

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$current_year=$_SESSION['CurrentYear'];

// $schoolid=$_SESSION['tschool'];

//Get student id
$studentid=$_SESSION['StudentId'];
if(!strlen($studentid)){
	$msgFormErr=_CONTACT_EXAMS_FORM_ERROR . "<br>";
}else{
	//Get Student Name and Homeroom!
	$sSQL="SELECT studentbio_lname, studentbio_fname, studentbio_homeroom FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sroom=$student->studentbio_homeroom;
}

// get exams data
$sSQL="SELECT school_names_desc, school_rooms_desc, DATE_FORMAT(exams_date,'" . _EXAMS_DATE . "') as examdate, 
grade_subject_desc, exams_types_desc, exams_id, days_desc, exams_date, teachers_id, teachers_fname, teachers_lname 
FROM ((((((exams 
INNER JOIN school_names ON exams_schoolid=school_names_id) 
INNER JOIN school_rooms ON exams_roomid=school_rooms_id) 
INNER JOIN grade_subjects ON exams_subjectid=grade_subject_id) 
INNER JOIN exams_types ON exams_typeid=exams_types_id) 
INNER JOIN tbl_days ON WEEKDAY(exams_date)+1 = days_id) 
INNER JOIN teachers ON exams_teacherid = teachers_id)
WHERE exams_year='$cyear' AND 
      exams_roomid='$sroom' ";
switch ($sort) {
case "room":
        $order = "school_rooms_desc, exams_date";
	break;
case "date":
	$order = "exams_date";
	break;
case "subject":
	$order = "grade_subject_desc";
	break;
case "type":
	$order = "exams_types_desc";
	break;
case "teacher":
	$order = "teachers_lname";
	break;
default:
	$order = "school_names_desc, school_rooms_desc, exams_date";
	break;
	}
$sSQL .= "ORDER BY " . $order;

if ($srch = $db->get_results($sSQL)){
//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_heading = "<tr class=tblhead>
<td width=20% align=center><a href=\"contact_exams.php?sort=room\">" . _CONTACT_EXAMS_ROOM . "</a></td>
<td width=20% align=center><a href=\"contact_exams.php?sort=date\">" . _CONTACT_EXAMS_DAYS . "</a></td>
<td width=20% align=center><a href=\"contact_exams.php?sort=subject\">" . _CONTACT_EXAMS_SUBJECT . "</a></td>
<td width=20% align=center><a href=\"contact_exams.php?sort=type\">" . _CONTACT_EXAMS_TYPE . "</a></td>
<td width=20% align=center><a href=\"contact_exams.php?sort=teacher\">" . _CONTACT_EXAMS_TEACHER . "</a></td>
</tr>";

$ezr->results_row = "<tr>
<td class=paging width=20% align=center>COL2</td>
<td class=paging width=20% align=center>COL3 (COL7)</td>
<td class=paging width=20% align=center>COL4</td>
<td class=paging width=20% align=center>COL5</td>
<td class=paging width=20% align=center>COL10 COL11</td>
</tr>";
$ezr->results_close = "</table>";
$ezr->query_mysql($sSQL);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"></link><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">

	<h1><?php echo _CONTACT_EXAMS_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname; ?></h2>
	<br>

        <p><?php $ezr->display();?></p>
	<p>&nbsp;</p>

</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
