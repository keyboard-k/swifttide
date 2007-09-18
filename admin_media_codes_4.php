<?
//*
// admin_media_codes_3.php
// Admin Section
// Send notifications to contacts of media due within 7 days
// Version 1.0 Sept 2007 Helmut
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

$menustudent=1;		// do we need this?
$current_year=$_SESSION['CurrentYear'];

// what to do
$action=get_param("action");

	$today = date("Y-m-d");

	// $startdate=mktime (0,0,0,9,13,2007);
	// $tage2=floor((time()-$startdate)/86400);
	// echo "<b>$tage2</b>";

	//Get media history
	$sSQL="SELECT media_history.media_history_id, 
	media_codes.media_codes_desc, 
	studentbio.studentbio_fname, studentbio.studentbio_lname, 
	studentcontact.studentcontact_email 
	FROM (((media_history 
	INNER JOIN media_codes ON media_history.media_history_code = media_codes.media_codes_id) 
	INNER JOIN studentbio ON studentbio.studentbio_id = media_history.media_history_student) 
	INNER JOIN studentcontact ON studentcontact.studentcontact_id = studentbio.studentbio_primarycontact) 
	WHERE media_history.media_history_year='$current_year' 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') <= 7) 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') >= 0) 
	ORDER BY media_history.media_history_datedue ASC";
	$tmp = $db->get_results($sSQL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_MEDIA_CODES_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	if(!strlen($msgFormErr)){
	?>
	<h1><? echo _ADMIN_MEDIA_CODES_2_TITLE?></h1>
	<br>
	<?
	// $ezr->display();
	print_r($tmp);
	?>
	<br>
	<table>

	</table>

	<?
	}else{
	?>
	<h1><? echo _ERROR?></h1>
	<br>
	<h3><? echo $msgFormErr; ?></h3>
	<br>
	<?
	};
	?>
</div>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
