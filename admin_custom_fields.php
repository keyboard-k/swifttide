<?php
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
$action = get_param("action");


if (!strlen($action))
	$action="none";

//Add or Remove School Name according to admin choice
switch ($action){
	case "remove":
		$id = get_param("id");
		$used_studentbio = $db->get_results("SELECT custom_studentbio_id 
			FROM custom_studentbio WHERE custom_field_id ='".$id."'");
		$used_discipline = $db->get_results("SELECT custom_discipline_history_id 
			FROM custom_discipline_history 
			WHERE custom_field_id = '".$id."'");
		$used_attendance = $db->get_results("SELECT custom_attendance_history_id
			FROM custom_attendance_history
			WHERE custom_field_id = '".$id."'");
		if ($used_studentbio || $used_discipline || $used_attendance) {
			$msgFormErr=_ADMIN_CUSTOM_FIELDS_FORM_ERROR;
		} else {
			$sSQL="DELETE FROM custom_fields WHERE custom_field_id='".$id."'";
			$db->query($sSQL);
		};
		break;
	case "add":
		$name=get_param("name");
		//Check for duplicates
		$tot=$db->get_var("SELECT count(*) FROM custom_fields WHERE name='".$name."'");
		if($tot>0){
			$msgFormErr=_ADMIN_CUSTOM_FIELDS_DUP;
		}else{
		$cSQL="INSERT INTO custom_fields (name) VALUES (".tosql($name, "Text").")"; 
		$db->query($cSQL);
		};
		break;
	case "edit":
		$id =get_param("id");
		$cSQL="SELECT name FROM custom_fields WHERE custom_field_id = '$id'";
		$name = $db->get_var($cSQL);
		break;
	case "update":
		$id = get_param("id");
		$name = get_param("name");
		$cSQL="UPDATE custom_fields SET name = '$name' WHERE custom_field_id = '$id'";
		$db->query($cSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=" . $_SERVER['PHP_SELF'] . "?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_CUSTOM_FIELDS_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=#  onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_CUSTOM_FIELDS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT * FROM custom_fields ORDER BY custom_field_id");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value != "") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_CUSTOM_FIELDS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_custom_fields?action=remove&id=" + id;
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
    <td width="50%"><?php echo _ADMIN_CUSTOM_FIELDS_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_CUSTOM_FIELDS_TITLE?></h1>
	<br>
	<?php
	if ($action != "edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="manage_custom_fields" method="post" action="<?echo($_SERVER['PHP_SELF']);?>">						
		  <p class="pform"><?php echo _ADMIN_CUSTOM_FIELDS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="name" size="20">&nbsp;<A class="aform" href="javascript: submitform('name')"><?php echo _ADMIN_CUSTOM_FIELDS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	} else {
	?>
		<br>
		<form name="edit_custom_field" method="post" action="<?echo($_SERVER['PHP_SELF']);?>">
		  <p class="pform"><?php echo _ADMIN_CUSTOM_FIELDS_UPDATE_CUSTOM?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="name" size="20" value="<?echo ($name);?>">&nbsp;<A class="aform" href="javascript: submitform('name')"><?php echo _ADMIN_CUSTOM_FIELDS_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo($id);?>">
	      </p>
	    </form>
	<?php
	};
    ?>
	<h3><?php echo $msgFormErr; ?></h3>
	</div>
<?php include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
