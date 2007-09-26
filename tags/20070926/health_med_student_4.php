<?php
//*
// health_med_student_4.php
// Health Section
// Add or update medicine note
//*
//Version 1.00, April 18,2005.  
//Version 1.01, May 9 2005.  If admin, use student's school id.
//

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N" && 
$_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

$menustudent=1;

$web_user=$_SESSION['UserId'];
$current_year=$_SESSION['CurrentYear'];
$sschool=$_SESSION['sschool'];
//Get student id
$studentid=get_param("studentid");
//Get discipline id
$disid=get_param("disid");
//Get action
$action=get_param("action");

//Get info from form
$discode=get_param("discode");
$disaction=get_param("disaction"); //reason for med change
$disreporter=get_param("disreporter");
$disnotes=get_param("disnotes");
$disdate=date("Y/m/d", strtotime(get_param("disdate")));

//Get other fields
$sSQL="SELECT web_users_relid FROM web_users WHERE web_users_id='". $web_user ."'";
$rel_link=$db->get_var($sSQL);
$sSQL="SELECT teachers_school from teachers WHERE teachers_id='". $rel_link ."'";
$sschool=$db->get_var($sSQL);
//If admin, we don't have a school, so use student's school
if($_SESSION['UserType'] == "A") {
	$sSQL="SELECT studentbio_school FROM studentbio WHERE studentbio_id = '". $studentid ."'";
	$sschool=$db->get_var($sSQL);
};

//Validate mandatory fields
$msgFormErr="";
if(!strlen($discode)){
	$msgFormErr.=_HEALTH_MED_STUDENT_3_ENTER_MED . "<br>";
};
//not sure this will ever be needed, but let's keep it here for now.
//if(!strlen($disaction)){
//	$msgFormErr.=_HEALTH_MED_STUDENT_3_ENTER_REASON . "<br>";
//};

if(!strlen($msgFormErr)){
	if($action=="update"){
		$sSQL="UPDATE health_med_history SET 
health_med_history_code='". $discode ."', 
health_med_history_date='". $disdate ."', 
health_med_history_reason=".tosql($disaction, 
"Text").", health_med_history_notes=".tosql($disnotes, "Text")." WHERE 
health_med_history_id='". $disid ."'";
		$db->query($sSQL);

$url="health_med_student_2.php?studentid=".$studentid."&disid=".$disid;
		header("Location: $url");
		exit();
	}else{
		//$notify=get_param("notify");
		$sSQL="INSERT INTO health_med_history 
(health_med_history_student, health_med_history_school, 
health_med_history_year, health_med_history_code, health_med_history_date, 
health_med_history_notes, health_med_history_reason, 
health_med_history_user) VALUES ($studentid, $sschool, 
$current_year, $discode, '$disdate', ".tosql($disnotes, "Text").", 
".tosql($disaction, "Text").", $web_user)";
		$db->query($sSQL);
		};
		
$url="health_med_student_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _HEALTH_MED_STUDENT_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
  <h1><?php echo _ERROR?></h1>
   <br>
   <h2><?php echo _HEALTH_MED_STUDENT_4_ERROR_BACK?>:</h2>
   <br>
   <h3><?php echo $msgFormErr; ?></h3>
</div>
<?php include "health_menu.inc.php"; ?>
</body>

</html>
