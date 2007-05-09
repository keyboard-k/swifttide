<?
//*
// teacher_exams_1.php
// Teacher Section
// Display and handle exams
// v1.0 April 22, 2007
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
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

//Get current year
$cyear=$_SESSION['CurrentYear'];
$year=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$cyear");

//Get action
$action=get_param("action");

$sort=get_param("sort");

$schoolid=get_param("schoolid");
$roomid=get_param("roomid");
// $examdate=date("Y-m-d", strtotime(get_param("examdate")));
$subjectid=get_param("typeid");
$typeid=get_param("typeid");

if (!strlen($action))
        $action="none";
	
//Get list of school names
$sSQL="SELECT * FROM school_names ORDER BY school_names_id";
$schoolnames=$db->get_results($sSQL);
//Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$schoolrooms=$db->get_results($sSQL);
//get list of subjects
$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_id";
$subjectcodes=$db->get_results($sSQL);
//get list of exam types
$sSQL="SELECT * FROM exams_types ORDER BY exams_types_id ASC";
$examstypes=$db->get_results($sSQL);

if ($action=="remove") {
	$id_to_delete = get_param("examid");
	$sSQL="DELETE FROM exams WHERE exams_id=$id_to_delete";
	$db->query($sSQL);
}

//Get current listing of exams
$sSQL="SELECT school_names_desc, school_rooms_desc, DATE_FORMAT(exams_date,'" . _EXAMS_DATE . "') as examdate, 
grade_subject_desc, exams_types_desc, exams_id, days_desc, exams_date, teachers_id, teachers_fname, teachers_lname 
FROM ((((((exams 
INNER JOIN school_names ON exams_schoolid=school_names_id) 
INNER JOIN school_rooms ON exams_roomid=school_rooms_id) 
INNER JOIN grade_subjects ON exams_subjectid=grade_subject_id) 
INNER JOIN exams_types ON exams_typeid=exams_types_id) 
INNER JOIN tbl_days ON WEEKDAY(exams_date)+1 = days_id) 
INNER JOIN teachers ON exams_teacherid = teachers_id)
WHERE exams_year='$cyear' ";
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
// echo $sSQL;

//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_heading = "<tr class=tblhead>
<td width=10%><a href=\"teacher_exams_1.php?sort=room\">" . _TEACHER_EXAMS_1_ROOM . "</a></td>
<td width=15%><a href=\"teacher_exams_1.php?sort=date\">" . _TEACHER_EXAMS_1_DATE . "</a></td>
<td width=15%><a href=\"teacher_exams_1.php?sort=subject\">" . _TEACHER_EXAMS_1_SUBJECT . "</a></td>
<td width=15%><a href=\"teacher_exams_1.php?sort=type\">" . _TEACHER_EXAMS_1_TYPE . "</a></td>
<td width=15%><a href=\"teacher_exams_1.php?sort=teacher\">" . _TEACHER_EXAMS_1_TEACHER . "</a></td>
<td width=15%>&nbsp;</td>
<td width=15%>&nbsp;</td>
</tr>"; 
$ezr->results_close = "</table>";
$ezr->results_row = "<tr>
<td class=paging width=10% align=center>COL2</td>
<td class=paging width=15% align=center>COL3 (COL7)</td>
<td class=paging width=15% align=center>COL4</td>
<td class=paging width=15% align=center>COL5</td>
<td class=paging width=15% align=center>COL10 COL11</td>
<td class=paging width=15% align=center>
  <a href=teacher_exams_2.php?examid=COL6 class=aform>&nbsp;" . _TEACHER_EXAMS_1_DETAILS . "</a></td>
<td class=paging width=15% align=center>
  <a name=href_remove href=#  onclick=cnfremove(COL6); class=aform>&nbsp;" . _TEACHER_EXAMS_1_REMOVE. "</a></td>
</tr>";

$ezr->query_mysql($sSQL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<SCRIPT>
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
        var answer;
	answer = window.confirm("<? echo _ADMIN_ROOMS_SURE?>");
	if (answer == 1) {
	var url;
	url = "teacher_exams_1?action=remove&examid=" + id;
	window.location = url; // other browsers
	href_remove.href = url; // explorer
	}
	return false;
	}
</SCRIPT>

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _TEACHER_EXAMS_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _TEACHER_EXAMS_1_TITLE?></h1>
	<br>
	<?
	$ezr->display();
	?>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
	    <td width="50%">&nbsp;</td>
	    <td width="50%" align="right"><a
	    href="teacher_exams_3.php?action=new" class="aform"><? echo _TEACHER_EXAMS_1_ADD?></a></td>
	</tr>
	</table>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>

