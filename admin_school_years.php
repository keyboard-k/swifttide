<?
//*
// admin_school_years.php
// Admin Section
// Display and Manage School Years Table
//*

//Updated 032007.  Don't remove if school year is in use.  Don't add dupes.
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

//Check what we have to do
$action=get_param("action");

//What year are we dealing with
$yearid=get_param("id");
//$sSQL="SELECT school_years_desc FROM school_years WHERE hool_years_id=$yearid";
//$school_years_desc2=$db->query($sSQL);

if (!strlen($action))
	$action="none";
//Add or Remove School Year according to admin choice
switch ($action){
	case "remove":
		$school_years_id=get_param("id");
                if($norem=$db->get_results("SELECT studentcontact_year FROM studentcontact WHERE studentcontact_year=$yearid")){
			$msgFormErr=_ADMIN_SCHOOL_YEARS_FORM_ERROR;
		}else{
		$sSQL="DELETE FROM school_years WHERE school_years_id=$school_years_id";
		$db->query($sSQL);
		};
		break;
	case "add":
		$school_years_desc=get_param("schoolyear");
		$tot=$db->get_var("SELECT count(*) FROM school_years WHERE school_years_desc='$school_years_desc'");
		// echo "total is $tot, school year desc is $school_years_desc";
		if($tot>0){
			$msgFormErr=_ADMIN_SCHOOL_YEARS_FORM_ERROR2;
		}else{
		$sSQL="INSERT INTO school_years (school_years_desc) VALUES (".tosql($school_years_desc, "Text").")"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$school_years_id=get_param("id");
		$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$school_years_id";
		$school_years_desc = $db->get_var($sSQL);
		break;
	case "update":
		$school_years_id=get_param("id");
		$school_years_desc=get_param("schoolyear");
		echo _ADMIN_SCHOOL_YEARS_SCHOOLYEAR . "$school_years_desc";
		$sSQL="UPDATE school_years SET school_years_desc='$school_years_desc' WHERE school_years_id=$school_years_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_school_years.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_SCHOOL_YEARS_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_SCHOOL_YEARS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT school_years_id, school_years_desc FROM school_years ORDER BY school_years_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
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
	answer = window.confirm("<? echo _ADMIN_SCHOOL_YEARS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_school_years.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_SCHOOL_YEARS_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_SCHOOL_YEARS_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addyear" method="post" action="admin_school_years.php">						
		  <p class="pform"><? echo _ADMIN_SCHOOL_YEARS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolyear" size="20">&nbsp;<A class="aform" href="javascript: submitform('schoolyear');"><? echo _ADMIN_SCHOOL_YEARS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="edityear" method="post" action="admin_school_years.php">						
		  <p class="pform"><? echo _ADMIN_SCHOOL_YEARS_UPDATE_YEAR?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolyear" size="20" value="<? echo $school_years_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform();"><? echo _ADMIN_SCHOOL_YEARS_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $school_years_id; ?>">
	      </p>
	    </form>
	<?
	};
	?>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? // include "admin_menu.inc.php"; ?>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
