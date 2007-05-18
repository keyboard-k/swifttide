<?
//*
// admin_school_names.php
// Admin Section
// Display and Manage School Names Table
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
//Add or Remove School Name according to admin choice
switch ($action){
	case "remove":
		$school_names_id=get_param("id");
		if($norem=$db->get_results("SELECT studentbio_school FROM studentbio WHERE studentbio_school=$school_names_id")){
			$msgFormErr=_ADMIN_SCHOOL_NAMES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM school_names WHERE school_names_id=$school_names_id";
			$db->query($sSQL);
		};
		break;
	case "add":
		$school_names_desc=get_param("schoolname");
		//Check for duplicate school name
		$tot=$db->get_var("SELECT count(*) FROM school_names WHERE school_names_desc = '$school_names_desc'");
		if($tot>0){
			$msgFormErr.=_ADMIN_SCHOOL_NAMES_DUP;
		}else{
			$sSQL="INSERT INTO school_names (school_names_desc) VALUES (".tosql($school_names_desc, "Text").")"; 
			$db->query($sSQL);
		};
		break;
	case "edit":
		$school_names_id=get_param("id");
		$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$school_names_id";
		$school_names_desc = $db->get_var($sSQL);
		break;
	case "update":
		$school_names_id=get_param("id");
		$school_names_desc=get_param("schoolname");
		$sSQL="UPDATE school_names SET school_names_desc='$school_names_desc' WHERE school_names_id=$school_names_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_school_names.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_SCHOOL_NAMES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_SCHOOL_NAMES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT school_names_id, school_names_desc FROM school_names ORDER BY school_names_desc");
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
	answer = window.confirm("<? echo _ADMIN_SCHOOL_NAMES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_school_names.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_SCHOOL_NAMES_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_SCHOOL_NAMES_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addschool" method="post" action="admin_school_names.php">						
		  <p class="pform"><? echo _ADMIN_SCHOOL_NAMES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolname" size="20">&nbsp;<A class="aform" href="javascript: submitform('schoolname')"><? echo _ADMIN_SCHOOL_NAMES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editschool" method="post" action="admin_school_names.php">						
		  <p class="pform"><? echo _ADMIN_SCHOOL_NAMES_UPDATE_NAME?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="schoolname" size="20" value="<? echo $school_names_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('schoolname')"><? echo _ADMIN_SCHOOL_NAMES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $school_names_id; ?>">
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
