<?
//*
// admin_titles.php
// Admin Section
// Display and Manage Titles Table
//V1.5 12-03-05 fixed spelling error
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

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Titles according to admin choice
switch ($action){
	case "remove":
		$title_id=get_param("id");
		//$title_desc=get_param("titlename");
		//$desc="SELECT title_desc FROM tbl_titles WHERE title_id=$title_id";
		//$title_desc=$db->get_var($desc);
		if($norem=$db->get_results("SELECT studentcontact_title 
FROM studentcontact WHERE studentcontact_title='$title_id'")){
			$msgFormErr=_ADMIN_TITLES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM tbl_titles WHERE title_id='$title_id'";
			$db->query($sSQL);
		};
		break;
	case "add":
		//Check for duplicates
		$title_desc=get_param("titlename");
		$tot=$db->get_var("SELECT count(*) FROM tbl_titles WHERE 
title_desc='$title_desc'");
		if($tot>0){
			$msgFormErr=_ADMIN_TITLES_DUP;
		}else{
		$sSQL="INSERT INTO tbl_titles (title_desc) VALUES (".tosql($title_desc, "Text").")"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$title_id=get_param("id");
		$sSQL="SELECT title_desc FROM tbl_titles WHERE title_id=$title_id";
		$title_desc = $db->get_var($sSQL);
		break;
	case "update":
		$title_id=get_param("id");
		$title_desc=get_param("titlename");
		$sSQL="UPDATE tbl_titles SET title_desc=".tosql($title_desc, "Text")." WHERE title_id=$title_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td 
class=paging width=15% align=center><a href=admin_titles.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_TITLES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove('COL1'); class=aform>&nbsp;" . _ADMIN_TITLES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT title_id, title_desc FROM tbl_titles ORDER BY title_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<? echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<? echo _ADMIN_TITLES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_titles.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_TITLES_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_TITLES_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addtitle" method="post" action="admin_titles.php">						
		  <p class="pform"><? echo _ADMIN_TITLES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><? echo _ADMIN_TITLES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="edittitle" method="post" action="admin_titles.php">						
		  <p class="pform"><? echo _ADMIN_TITLES_UPDATE_TITLE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="titlename" size="20" value="<? echo $title_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('titlename')"><? echo _ADMIN_TITLES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $title_id; ?>">
	      </p>
	    </form>
	<?
	};
	?>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
