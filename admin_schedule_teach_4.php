<?php
//*
// admin_schedule_teach_4.php
// Admin Section
// Add or update schedule note
// 040907 doug support for diff days for scheduling
// 041307 support for rooms in schedules (Helmut)
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

$cyear=$_SESSION['CurrentYear'];

//Get teacher id
$teacherid=get_param("teacherid");
//Get schedule id
$schedid=get_param("schedid");
//Get action
$action=get_param("action");
//Get info from form
$term=get_param("term2");
$subject=get_param("subject");
$period=get_param("period");
$days=get_param("days");
$room=get_param("room");

//Get info on this teacher
	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;

//Validate fields
$msgFormErr="";
if(!strlen($term)){
	$msgFormErr.=_ADMIN_SCHEDULE_TEACH_4_SELECT_TERM . "<br>";
};
if(!strlen($subject)){
	$msgFormErr.=_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR . "<br>";
};
if(!strlen($period)){
	$msgFormErr.=_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR2 . "<br>";
};
//if no weekdays specified, get default value
if(!strlen($days)){
	$days=_ADMIN_SCHEDULE_TEACH_4_DEF_DAYS;
};

		//Check for duplicates, we don't want dupe entries in the scheduler
	if($action=="new"){	
	$sSQL="SELECT count(*) FROM teacher_schedule WHERE 
teacher_schedule_termid=$term AND 
teacher_schedule_year=$cyear AND 
teacher_schedule_classperiod='$period' AND 
teacher_schedule_subjectid=$subject AND 
teacher_schedule_teacherid=$teacherid AND 
teacher_schedule_days=$days AND 
teacher_schedule_room='$room' AND 
teacher_schedule_schoolid=$tschool";
		$tot=$db->get_var($sSQL);
		if($tot>0){
			$msgFormErr=_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR3;
	};
    };


//No errors found
if(!strlen($msgFormErr)){
	if($action=="update"){
		$msgheader="Updating";
		$sSQL="UPDATE teacher_schedule SET 
teacher_schedule_termid=$term, 
teacher_schedule_year=$cyear, teacher_schedule_subjectid=$subject, 
teacher_schedule_teacherid=$teacherid, teacher_schedule_classperiod='$period', 
teacher_schedule_schoolid=$tschool, teacher_schedule_days='$days',
teacher_schedule_room='$room' WHERE 
teacher_schedule_id=$schedid";
		$db->query($sSQL);


		
$url="admin_schedule_teach_2.php?teacherid=".$teacherid."&schedid=".$schedid;
		header("Location: $url");
		exit();
	}else{

		$msgheader="Adding";
			
		$sSQL="INSERT INTO teacher_schedule 
(teacher_schedule_termid, teacher_schedule_year, 
teacher_schedule_subjectid, teacher_schedule_teacherid, 
teacher_schedule_classperiod, teacher_schedule_schoolid, 
teacher_schedule_days, teacher_schedule_room) VALUES ($term, 
$cyear, $subject, $teacherid, '$period', $tschool, '$days', '$room')";
		$db->query($sSQL);

		$url="admin_schedule_teach_1.php?teacherid=".$teacherid;
		header("Location: $url");
		exit();
	};
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
    <td width="50%"><?php echo _ADMIN_SCHEDULE_TEACH_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ERROR?> <?php echo $msgheader; ?> <? echo _ADMIN_SCHEDULE_TEACH_4_TITLE?></h1>
	<br>
	<h2><?php echo _ADMIN_SCHEDULE_TEACH_4_TITLE?></h2>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>

