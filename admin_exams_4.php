<?php
//*
// admin_exams_4.php
// Admin Section
// Add or update exams note
// v1.0 April 19, 2007
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

//Get action
$action=get_param("action");

//Get exam id
$examid=get_param("examid");

//Get info from form
$schoolid=get_param("schoolid");
$roomid=get_param("roomid");
$examdate=date("Y-m-d", strtotime(get_param("examdate")));
$subjectid=get_param("subjectid");
$typeid=get_param("typeid");
$teacherid=get_param("teacherid");

//Get school id from teacher
$sSQL="SELECT teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	// $tlname=$teacher->teachers_lname;
	// $tfname=$teacher->teachers_fname;
	$school=$teacher->teachers_school;

//Validate fields
$msgFormErr="";
if(!$roomid){
	$msgFormErr.=_ADMIN_EXAMS_4_SELECT_ROOM . "<br>";
};
if(!strlen($examdate)){
	$msgFormErr.=_ADMIN_EXAMS_4_FORM_DATE . "<br>";
};
if(!$subjectid){
	$msgFormErr.=_ADMIN_EXAMS_4_FORM_SUBJECT . "<br>";
};
if(!$typeid){
	$msgFormErr.=_ADMIN_EXAMS_4_FORM_TYPE . "<br>";
};
if(!$teacherid){
	$msgFormErr.=_ADMIN_EXAMS_4_FORM_TEACHER . "<br>";
};

		//Check for duplicates, we don't want dupe entries in the scheduler
	if($action=="new"){	
	$sSQL="SELECT count(*) FROM exams WHERE 
	exams_year='$cyear' AND 
	exams_schoolid='$schoolid' AND 
	exams_roomid='$roomid' AND 
	exams_date='$examdate' AND 
	exams_subjectid='$subjectid' AND 
	exams_typeid='$typeid' AND 
	exams_teacherid='$teacherid'"; 
		$tot=$db->get_var($sSQL);
		if($tot>0){
			$msgFormErr=_ADMIN_EXAMS_4_DUP;
	};
    };


//No errors found
if(!strlen($msgFormErr)){
	if($action=="update"){
		$msgheader=_ADMIN_EXAMS_4_UPDATING;
		$sSQL="UPDATE exams SET 
		exams_year='$cyear', 
		exams_schoolid='$schoolid', exams_roomid='$roomid', 
		exams_date='$examdate', exams_subjectid='$subjectid', 
		exams_typeid='$typeid', exams_teacherid='$teacherid' 
		WHERE exams_id='$examid'";
		$db->query($sSQL);

		$url="admin_exams_2.php?examid=".$examid;
		header("Location: $url");
		exit();
	}else{

		$msgheader=_ADMIN_EXAMS_4_ADDING;

		$sSQL="INSERT INTO exams 
		(exams_year, exams_schoolid, 
		exams_roomid, exams_date, 
		exams_subjectid, exams_typeid, 
		exams_teacherid) VALUES 
		('$cyear', '$schoolid', '$roomid', '$examdate', '$subjectid', '$typeid', '$teacherid')";
		$db->query($sSQL);

		$url="admin_exams_1.php";
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
    <td width="50%"><?php echo _ADMIN_EXAMS_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ERROR?> <?php echo $msgheader; ?> <?php echo _ADMIN_EXAMS_4_TITLE?></h1>
	<br>
	<h2><?php echo _ADMIN_EXAMS_4_TITLE?></h2>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>

