<?
//*
// health_manage_4.php
// Health Section
// Add or update health note
//*
//Version 1.00, April 11,2005.  
//1.00 Removed notify function, we won't notify parents of nurse visits.
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
$disreporter=get_param("disreporter");
$disnotes=get_param("disnotes");

//Get school number (if a teacher)
$sSQL="SELECT web_users_relid FROM web_users WHERE 
web_users_id='$web_user'";
$hold=$db->get_var($sSQL);
$sSQL="SELECT teachers_school FROM teachers WHERE teachers_id=$hold";
$sschool=$db->get_var($sSQL);
//If admin, schoolid will be student's school id
if ($_SESSION['UserType'] == "A") {
	$sSQL="SELECT studentbio_school FROM studentbio WHERE studentbio_id = $studentid";
	$sschool=$db->get_var($sSQL);
};
//get custom fields
$custom_discipline_fields = get_param("custom_discipline_fields");	//array
$custom_fields = get_param("custom_fields");	//array
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");

//Validate mandatory fields
$msgFormErr="";
if(!strlen($discode)){
	$msgFormErr.=_HEALTH_MANAGE_4_ENTER_INFRACTION . "<br>";
};
if(!strlen($disdate)){
	$msgFormErr.=_HEALTH_MANAGE_4_ENTER_DATE . "<br>";
};
if(!strlen($disaction)){
	$msgFormErr.=_HEALTH_MANAGE_4_ENTER_ACTION . "<br>";
};
if(!strlen($disreporter)){
	$msgFormErr.=_HEALTH_MANAGE_4_ENTER_WHO . "<br>";
};

if(!strlen($msgFormErr)){
	if($action=="update"){
		$sSQL="UPDATE health_history SET 
health_history_code=$discode, health_history_date='$disdate', 
health_history_action=".tosql($disaction, "Text").", 
health_history_sentby=".tosql($disreporter, "Text").", 
health_history_notes=".tosql($disnotes, "Text")." WHERE health_history_id=$disid";
		$db->query($sSQL);

		//update custom fields added by Joshua
		if(count($custom_discipline_fields) && $custom_discipline_fields != NULL) {
			while(list($custom_discipline_id, $custom_discipline_data)  = each($custom_discipline_fields)) {
				if($custom_discipline_id == '0') {
					//delete the field if delete is selected
					$custom_discipline_update_sql = "DELETE from custom_health_history 
						WHERE custom_health_history_id = '$custom_discipline_id'";
				} else {
					$custom_discipline_update_sql = "UPDATE custom_health_history SET custom_field_id = '";
					$custom_discipline_update_sql .= $custom_fields[$custom_discipline_id];
					$custom_discipline_update_sql .= "', data = '$custom_discipline_data' 
						WHERE custom_health_history_id = '";
					$custom_discipline_update_sql .= $custom_discipline_id;
					$custom_discipline_update_sql .= "'";
				}
				$db->query($custom_discipline_update_sql);
			}
		} 
		//adding a new field if one has been entered
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_health_history SET 
				custom_field_id = '$new_custom_field_id', 
				health_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields

		
		$url="health_manage_2.php?studentid=".$studentid."&disid=".$disid;
		header("Location: $url");
		exit();
	}else{
		$studentid=get_param("studentid");
		//$notify=get_param("notify");
		$sSQL="INSERT INTO health_history (health_history_student, health_history_school, health_history_year, health_history_code, health_history_date, health_history_action, health_history_notes, health_history_sentby, health_history_user) VALUES ('$studentid', $sschool, $current_year, $discode, '$disdate', ".tosql($disaction, "Text").", ".tosql($disnotes, "Text").", '$disreporter', $web_user)";
		$db->query($sSQL);
		};

		//adding a new field if one has been entered by Joshua
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_health_history SET 
				custom_field_id = '$new_custom_field_id', 
				health_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields
	
		
$url="health_manage_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _HEALTH_MANAGE_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
  <h1><? echo _ERROR?></h1>
   <br>
   <h2><? echo _HEALTH_MANAGE_4_ERROR_BACK?>Please use your browser 'back' button to correct the following error(s):</h2>
   <br>
   <h3><? echo $msgFormErr; ?></h3>
</div>
<? include "health_menu.inc.php"; ?>
</body>

</html>
