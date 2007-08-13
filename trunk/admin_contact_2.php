<?
//*
// admin_contact_2.php
// Admin Section
// Search and display list of results or redirect to page to display single result
//*
// Version 1.0, 2007-05-224
//
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

//Get search field info
$action=get_param("action");

//Special field-defines teachers as active
$active="Y";

//Determine what field(s) to search
switch ($action){

	case "searchcontacts":
		$contactid=get_param("contactid");
		if ($contactid == "") {
		$sSQL = "SELECT web_users_id, web_users_flname, active 
		FROM web_users 
		WHERE web_users_type = 'C'";
		} else {
		$sSQL = "SELECT web_users_id, web_users_flname, active 
		FROM web_users 
		WHERE web_users_relid = '$contactid' 
		AND web_users_type = 'C'"; }
		if($cont = $db->get_row($sSQL)){
			//Set paging appearence
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_heading = "<tr class=tblhead>
			<td width=30%>" . _ADMIN_CONTACT_2_NAME . "</td>
			<td width=30%>" . _ADMIN_CONTACT_2_ACTIVE . "</td>
			<td width=20%>&nbsp;</td>
			<td width=20%>&nbsp;</td>
			</tr>";
			$ezr->results_row = "<tr class=tblcont>
			<td class=paging width=30%>COL2</td>
			<td class=paging width=30% align=center>COL3</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=1&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_ACTIVATE . "</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=0&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_DEACTIVATE . "</td>
			</tr>";
			$ezr->query_mysql($sSQL);
		}else{
			$msgFormErr=_ADMIN_CONTACT_2_FORM_ERROR;
		};
		break;
	case "searchlname":
		$cname=get_param("cname");
		$sSQL = "SELECT web_users_id, web_users_flname, active 
		FROM (web_users 
		INNER JOIN studentcontact ON studentcontact_id = web_users_relid) 
		WHERE studentcontact_lname = '$cname' 
		AND web_users_type = 'C'";
		if ($cont = $db->get_row($sSQL)) {
			//Set paging appearence
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_heading = "<tr class=tblhead>
			  <td width=30%>" . _ADMIN_CONTACT_2_NAME . "</td>
			  <td width=30%>" . _ADMIN_CONTACT_2_ACTIVE . "</td>
			  <td width=20%>&nbsp;</td>
			  <td width=20%>&nbsp;</td>
			</tr>";
			$ezr->results_row = "<tr class=tblcont>
			<td class=paging width=30%>COL2</td>
			<td class=paging width=30% align=center>COL3</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=1&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_ACTIVATE . "</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=0&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_DEACTIVATE . "</td>
			</tr>";
			$ezr->query_mysql($sSQL);

			$ezr->set_qs_val("cname", $cname);
			$ezr->set_qs_val("action", "searchlname"); 
		}else{
			$msgFormErr=_ADMIN_CONTACT_2_FORM_ERROR2 . $cname;
		};
		break;
	case "letter":
		$letter=get_param("letter");
		$sSQL = "SELECT web_users_id, web_users_flname, active 
		FROM web_users 
		INNER JOIN studentcontact ON web_users_relid = studentcontact_id 
		WHERE studentcontact_lname LIKE '$letter%' 
		AND web_users_type = 'C'";
		if ($cont = $db->get_row($sSQL)) {
			//Set paging appearence
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_heading = "<tr class=tblhead>
			<td width=30%>" . _ADMIN_CONTACT_2_NAME . "</td>
			<td width=30%>" . _ADMIN_CONTACT_2_ACTIVE . "</td>
			<td width=20%>&nbsp;</td>
			<td width=20%>&nbsp;</td>
			</tr>";
			$ezr->results_row = "<tr class=tblcont>
			<td class=paging width=30%>COL2</td>
			<td class=paging width=30% align=center>COL3</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=1&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_ACTIVATE . "</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=0&contactid=COL1 class=aform>
			  &nbsp;" . _ADMIN_CONTACT_2_DEACTIVATE . "</td>
			</tr>";
			$ezr->query_mysql($sSQL);

			$ezr->set_qs_val("letter", $letter);
			$ezr->set_qs_val("action", "letter"); 
		}else{
			$msgFormErr=_ADMIN_CONTACT_2_FORM_ERROR3 . $letter;
		};
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
        var answer;
	answer = window.confirm("<? echo _ADMIN_CONTACT_2_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_teacher_1.php?action=remove&teacherid=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer
	}
	return false;
}
</SCRIPT>

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_CONTACT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_CONTACT_2_TITLE?></h1>
	<br>
	<?
	if (strlen($msgFormErr)){
		//No results
	?>
		<h3><? echo $msgFormErr; ?></h3>
	<?
	}else{
		//Dislay results with paging options
		$ezr->display();
	};
	?>
	<br>
	<A class="aform" href="admin_users_1.php"><? echo _ADMIN_CONTACT_2_NEW?></a>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
