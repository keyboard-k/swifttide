<?
//*
// admin_infraction_codes.php
// Admin Section
// Display and Manage Infraction Codes Table
//
//v1.5 12-03-05, removed echo statement
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
//Add or Remove Infraction Codes according to admin choice
switch ($action){
	case "remove":
		$infraction_codes_id=get_param("id");
		if($norem=$db->get_results("SELECT discipline_history_code FROM discipline_history WHERE discipline_history_code=$infraction_codes_id")){
			$msgFormErr=_ADMIN_INFRACTION_CODES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM infraction_codes WHERE infraction_codes_id=$infraction_codes_id";
			$db->query($sSQL);
		};
		break;
case "add":
		$infraction_codes_desc=get_param("infractionname");
		//Check for duplicates
		$tot = $db->get_var("SELECT count(*) FROM infraction_codes WHERE infraction_codes.infraction_codes_desc = '$infraction_codes_desc'");
		if ($tot>0){
			$msgFormErr=_ADMIN_INFRACTION_CODES_DUP;
		}else{
			$sSQL="INSERT INTO infraction_codes (infraction_codes_desc) VALUES (".tosql($infraction_codes_desc, "Text").")"; 
			$db->query($sSQL);
		};
		break;
	case "edit":
		$infraction_codes_id=get_param("id");
		$sSQL="SELECT infraction_codes_desc FROM infraction_codes WHERE infraction_codes_id=$infraction_codes_id";
		$infraction_codes_desc = $db->get_var($sSQL);
		break;
	case "update":
		$infraction_codes_id=get_param("id");
		$infraction_codes_desc=get_param("infractionname");
		$sSQL="UPDATE infraction_codes SET infraction_codes_desc='$infraction_codes_desc' WHERE infraction_codes_id=$infraction_codes_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_infraction_codes.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_INFRACTION_CODES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_INFRACTION_CODES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT infraction_codes_id, infraction_codes_desc FROM infraction_codes ORDER BY infraction_codes_desc");
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
	answer = window.confirm("<? echo _ADMIN_INFRACTION_CODES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_infraction_codes.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_INFRACTION_CODES_UPPER?>
    </td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_INFRACTION_CODES_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addinfraction" method="post" action="admin_infraction_codes.php">						
		  <p class="pform"><? echo _ADMIN_INFRACTION_CODES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="infractionname" size="20">&nbsp;<A class="aform" href="javascript: submitform('infractionname')"><? echo _ADMIN_INFRACTION_CODES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editinfraction" method="post" action="admin_infraction_codes.php">						
		  <p class="pform"><? echo _ADMIN_INFRACTION_CODES_UPDATE_INFR?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="infractionname" size="20" value="<? echo $infraction_codes_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('infractionname')"><? echo _ADMIN_INFRACTION_CODES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $infraction_codes_id; ?>">
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
