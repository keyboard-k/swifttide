<?php
//*
// health_immunz.php
// Health Section
// Display and Manage Immunization Codes Table
//*
//Version 1.00, April 16 2005
//V1.5 12-03-05 add proper menu depending on who is logged in

//Check if nurse is logged in
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove Immunization Codes according to user choice
switch ($action){
	case "remove":
		$health_immunz_id=get_param("id");
		if($norem=$db->get_results("SELECT health_immunz_history_code FROM health_immunz_history WHERE health_immunz_history_code='". $health_immunz_id ."'")){
			$msgFormErr=_HEALTH_IMMUNZ_NOT_REMOVED;
		}else{
			$sSQL="DELETE FROM health_immunz WHERE health_immunz_id='". $health_immunz_id ."'";
			$db->query($sSQL);
		};
		break;
	case "add":
		$health_immunz_desc=get_param("healthname");
		//Check for duplicates
		$tot=$db->get_var("SELECT count(*) FROM health_immunz 
WHERE health_immunz_desc='$health_immunz_desc'");
		if($tot>0){
			$msgFormErr=_HEALTH_IMMUNZ_DUP;
		}else{
		$sSQL="INSERT INTO health_immunz (health_immunz_desc) 
VALUES (".tosql($health_immunz_desc, "Text").")"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$health_immunz_id=get_param("id");
		$sSQL="SELECT health_immunz_desc FROM health_immunz WHERE health_immunz_id='". $health_immunz_id ."'";
		$health_immunz_desc = $db->get_var($sSQL);
		break;
	case "update":
		$health_immunz_id=get_param("id");
		$health_immunz_desc=get_param("healthname");
		$sSQL="UPDATE health_immunz SET 
health_immunz_desc='$health_immunz_desc' WHERE 
health_immunz_id='". $health_immunz_id ."'";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td 
class=paging width=15% align=center><a 
href=health_immunz.php?action=edit&id=COL1 
class=aform>&nbsp;" . _HEALTH_IMMUNZ_EDIT . "</a></td><td 
class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _HEALTH_IMMUNZ_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT health_immunz_id, health_immunz_desc FROM 
health_immunz ORDER BY health_immunz_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _HEALTH_IMMUNZ_SURE?>");
	if (answer == 1) {
		var url;
		url = "health_immunz.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _HEALTH_IMMUNZ_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _HEALTH_IMMUNZ_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addattendance" method="post" 
action="health_immunz.php">						
		  <p class="pform"><?php echo _HEALTH_IMMUNZ_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="healthname" size="20">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><?php echo _HEALTH_IMMUNZ_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editattendance" method="post" action="health_immunz.php">
		  <p class="pform"><?php echo _HEALTH_IMMUNZ_UPDATE_CODE?><br>
	      <input type="text" onChange="capitalizeMe(this)" 
name="healthname" size="20" value="<?php echo $health_immunz_desc; 
?>">&nbsp;<A class="aform" href="javascript: submitform('healthname')"><?php echo _HEALTH_IMMUNZ_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo 
$health_immunz_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php if($_SESSION['UserType'] == "A") {
	include "admin_maint_tables_menu.inc.php"; 
	} else { 
include "health_menu.inc.php"; 
}; ?>
</body>

</html>
