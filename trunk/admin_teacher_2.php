<?
//*
// admin_teacher_2.php
// Admin Section
// Search and display list of results or redirect to page to display single result
//*
//Version 1.01, April 4 2005
//V1.02, May 10, 2005.  Added "remove" to remove teachers from the db.
//v1.52 12-31-05 removed the remove feature.  oh well.
//v2.0 2007-04-24 reinstalled the remove option. Now it's a either a bug or a real feature! ;-)
//Doug Sept 15 07.  Added the edit link, active is YES or NO, not 0 or 1.
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

	case "srchschool":
		$school=get_param("school");
		if($school==""){
			$sSQL = "SELECT web_users_relid, 
web_users_flname, school_names_desc, active 
			FROM ((web_users 
			INNER JOIN teachers ON teachers_id = web_users_relid) 
			INNER JOIN school_names ON teachers_school = school_names_id) 
			WHERE web_users_type = 'T'";
		} else {
			$sSQL = "SELECT web_users_relid, 
web_users_flname, 
school_names_desc, active 
			FROM ((web_users
			INNER JOIN teachers ON teachers_id = web_users_relid) 
			INNER JOIN school_names ON teachers_school = school_names_id) 
			WHERE teachers_school = '$school'
			AND web_users_type = 'T'"; }
		if($teach = $db->get_results($sSQL)){
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_heading = "<tr class=tblhead>
			  <td width=20%>" . _ADMIN_TEACHER_2_NAME . "</td>
			  <td width=20%>" . _ADMIN_TEACHER_2_SCHOOL . "</td>
			  <td width=5%>" . _ADMIN_TEACHER_2_ACTIVE . "</td>
			  <td width=20%>&nbsp;</td>
			  <td width=20%>&nbsp;</td>
			  <td width=15%>&nbsp;</td>
			</tr>";
			$ezr->results_row = "<tr>
			<td class=paging width=20%>COL2</td>
			<td class=paging width=20% align=center>COL3</td>
			<td class=paging width=5% align=center>COL4</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=1&teacherid=COL1 class=aform>
			  &nbsp;" . _ADMIN_TEACHER_2_ACTIVATE . "</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=0&teacherid=COL1 class=aform>
			  &nbsp;" . _ADMIN_TEACHER_2_DEACTIVATE . "</td>
			<td class=paging width=15% align=center>
			  <a 
href=admin_add_edit_teacher_1.php?action=edit&teacherid=COL1 
class=aform>
			  &nbsp;" . _ADMIN_TEACHER_2_EDIT . "</td>
			
			</tr>";
			$ezr->query_mysql($sSQL);
		}else{
			if($school!=""){
				$schoolname=$db->get_var("SELECT school_names_desc FROM school_names WHERE school_names_id=$school");
				$msgFormErr=_ADMIN_TEACHER_2_FORM_ERROR . $schoolname . ".";
			}else{
				$msgFormErr=_ADMIN_TEACHER_2_FORM_ERROR2;
			};
		};
		break;
	case "searchlname":
		$tlname=get_param("tlname");
                $sSQL = "SELECT web_users_relid, web_users_flname, 
school_names_desc, active 
                FROM ((web_users 
		INNER JOIN teachers ON teachers_id = web_users_relid) 
		INNER JOIN school_names ON teachers_school = school_names_id) 
                WHERE teachers_lname = '$tlname' 
                AND web_users_type = 'T'";
                if ($cont = $db->get_row($sSQL)) {
                        //Set paging appearence
                        $ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
                        $ezr->results_close = "</table>";
                        $ezr->results_heading = "<tr class=tblhead>
			  <td width=20%>" . _ADMIN_TEACHER_2_NAME . "</td>
			  <td width=20%>" . _ADMIN_TEACHER_2_SCHOOL . "</td>
			  <td width=5%>" . _ADMIN_TEACHER_2_ACTIVE . "</td>
			  <td width=20%>&nbsp;</td>
			  <td width=20%>&nbsp;</td>
			  <td width=15%>&nbsp;</td>
			</tr>";
                        $ezr->results_row = "<tr class=tblcont>
                        <td class=paging width=20%>COL2</td>
                        <td class=paging width=20% align=center>COL3</td>
                        <td class=paging width=5% align=center>COL4</td>
                        <td class=paging width=20% align=center>
                          <a href=admin_webusers_active.php?act=1&teacherid=COL1 class=aform>
                          &nbsp;" . _ADMIN_TEACHER_2_ACTIVATE . "</td>
                        <td class=paging width=20% align=center>
                          <a href=admin_webusers_active.php?act=0&teacherid=COL1 class=aform>
                          &nbsp;" . _ADMIN_TEACHER_2_DEACTIVATE . "</td>
<td class=paging width=15% align=center>
                          <a
href=admin_add_edit_teacher_1.php?action=edit&teacherid=COL1
class=aform>
                          &nbsp;" . _ADMIN_TEACHER_2_EDIT . "</td>
                        </tr>";
                        $ezr->query_mysql($sSQL);

			$ezr->set_qs_val("tlname", $tlname);
                        $ezr->set_qs_val("action", "searchlname");
			}else{
				$msgFormErr=_ADMIN_TEACHER_2_FORM_ERROR3 . $tlname;
			};
                break;
	case "letter":
                $letter=get_param("letter");
		$sSQL = "SELECT web_users_relid, web_users_flname, 
school_names_desc, active
		FROM ((web_users 
		INNER JOIN teachers ON teachers_id = web_users_relid) 
		INNER JOIN school_names ON teachers_school = school_names_id) 
		WHERE teachers_lname LIKE '$letter%' 
		AND web_users_type = 'T'";
		if ($cont = $db->get_row($sSQL)) {
			//Set paging appearence
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_heading = "<tr class=tblhead>
			<td width=20%>" . _ADMIN_TEACHER_2_NAME . "</td>
			<td width=20%>" . _ADMIN_TEACHER_2_SCHOOL . "</td>
			<td width=5%>" . _ADMIN_TEACHER_2_ACTIVE . "</td>
			<td width=20%>&nbsp;</td>
			<td width=20%>&nbsp;</td>
			<td width=15%>&nbsp;</td>
			</tr>";
			$ezr->results_row = "<tr class=tblcont>
			<td class=paging width=20%>COL2</td>
			<td class=paging width=20% align=center>COL3</td>
			<td class=paging width=20% align=center>COL4</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=1&teacherid=COL1 class=aform>
			  &nbsp;" . _ADMIN_TEACHER_2_ACTIVATE . "</td>
			<td class=paging width=20% align=center>
			  <a href=admin_webusers_active.php?act=0&teacherid=COL1 class=aform>
			  &nbsp;" . _ADMIN_TEACHER_2_DEACTIVATE . "</td>
<td class=paging width=15% align=center>
                          <a
href=admin_add_edit_teacher_1.php?action=edit&teacherid=COL1
class=aform>
                          &nbsp;" . _ADMIN_TEACHER_2_EDIT . "</td>			
</tr>";
			$ezr->query_mysql($sSQL);

			$ezr->set_qs_val("letter", $letter);
			$ezr->set_qs_val("action", "letter");
		}else{
			$msgFormErr=_ADMIN_TEACHER_2_FORM_ERROR3 . $letter;
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
	answer = window.confirm("<? echo _ADMIN_TEACHER_2_SURE?>");
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
    <td width="50%"><? echo _ADMIN_TEACHER_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_TEACHER_2_TITLE?></h1>
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
	<a class="aform" href="admin_teacher_1.php"><? echo 
_ADMIN_TEACHER_2_NEW?></a>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
