<?
//*
// admin_media_codes_2.php
// Admin Section
// Display media that are due within 7 days
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
	DATE_FORMAT(media_history.media_history_dateout, '" . _EXAMS_DATE . "') AS disdate, 
	DATE_FORMAT(media_history.media_history_datedue, '" . _EXAMS_DATE . "') AS sdate, 
	media_codes.media_codes_desc 
	FROM media_history 
	INNER JOIN media_codes ON  media_history.media_history_code = media_codes.media_codes_id 
	WHERE media_history.media_history_year='$current_year' 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') <= 7) 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') >= 0) 
	ORDER BY media_history.media_history_datedue ASC";
	echo $sSQL;

	//Set paging appearence
	$ezr->results_open = "<table width=90% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead>
	<td width=20%>" . _ADMIN_MEDIA_CODES_2_DATEOUT . "</td>
	<td width=20%>" . _ADMIN_MEDIA_CODES_2_DATEDUE . "</td>
	<td width=35%>" . _ADMIN_MEDIA_CODES_2_CODE . "</td>
	<td width=25%>" . _ADMIN_MEDIA_CODES_2_NOTIFY . "</td>
	</tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr>
	<td align=center class=paging width=20%>COL2</td>
	<td align=center class=paging width=20%>COL3</td>
	<td class=paging width=35% align=center>COL4</td>
	<td class=paging width=25% align=center>
	  <a href=admin_manage_media_3.php?disid=COL1 class=aform>&nbsp;" . _ADMIN_MEDIA_CODES_2_SEND . "</a>
	</td>
	</tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
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
	$ezr->display();
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
