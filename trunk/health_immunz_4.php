<?
//*
// health_med_student_4.php
// Health Section
// Add or update medication note
//*
//Version 1.00, April 19,2005.  
//

//Check if nurse is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N")
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

$menustudent=1;

$web_user=$_SESSION['UserId'];
$current_year=$_SESSION['CurrentYear'];
//Get student id
$studentid=get_param("studentid");
//Get discipline id
$disid=get_param("disid");
//Get action
$action=get_param("action");

//Get info from form
$discode=get_param("discode");
$disdate=date("Y/m/d", strtotime(get_param("disdate")));
$disaction=get_param("disaction");
$disnotes=get_param("disnotes");

//kludge.  get this normally at some point.
$sschool=7;

//Validate mandatory fields
$msgFormErr="";
//if(!strlen($discode)){
//	$msgFormErr.=_HEALTH_IMMUNZ_4_ENTER_MED . "<br>";
//};
if(!strlen($disdate)){
	$msgFormErr.=_HEALTH_IMMUNZ_4_ENTER_DATE . "<br>";
};
if(!strlen($disaction)){
	$msgFormErr.=_HEALTH_IMMUNZ_4_ENTER_REASON . "<br>";
};

if(!strlen($msgFormErr)){
	if($action=="update"){
		$sSQL="UPDATE health_immunz_history SET
health_immunz_history_code=$discode, health_immunz_history_date='$disdate',
health_immunz_history_action=".tosql($disaction, "Text").",
health_immunz_history_notes=".tosql($disnotes, "Text")." WHERE
health_immunz_history_id=$disid";
		$db->query($sSQL);


$url="health_immunz_student_2.php?studentid=".$studentid."&disid=".$disid;
		header("Location: $url");
		exit();
	}else{
		//$sschool=get_param("sschool");
		//$notify=get_param("notify");
		$sSQL="INSERT INTO health_immunz_history
(health_immunz_history_student, health_immunz_history_school,
health_immunz_history_year, health_immunz_history_code, health_immunz_history_date,
health_immunz_history_reason, health_immunz_history_notes,
health_immunz_history_user)
VALUES ($studentid, $sschool, $current_year, $discode, '$disdate', ".tosql($disaction, "Text").", ".tosql($disnotes, "Text").", $web_user)";
		$db->query($sSQL);

$url="health_immunz_student_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	};
//
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _HEALTH_IMMUNZ_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
  <h1><? echo _ERROR?></h1>
   <br>
   <h2><? echo _HEALTH_IMMUNZ_4_ERROR_BACK?></h2>
   <br>
   <h3><? echo $msgFormErr; ?></h3>
</div>
<? include "health_menu.inc.php"; ?>
</body>

</html>
