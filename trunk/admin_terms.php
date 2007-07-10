<?
//*
// admin_terms.php
// Admin Section
// Display and Manage Grade Terms Table
//v1.0 12-27-05 Doug
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
//Add or Remove Terms according to admin choice
switch ($action){
	case "remove":
		$term_id=get_param("id");
		if($norem=$db->get_results("SELECT grade_history_quarter 
FROM grade_history WHERE grade_history_quarter=$term_id")){
			$msgFormErr=_ADMIN_TERMS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM grade_terms WHERE 
grade_terms_id=$term_id";
			$db->query($sSQL);
		};
		break;
	case "add":
		//Check for duplicates
		$term_desc=get_param("termname");
		$tot=$db->get_var("SELECT count(*) FROM grade_terms WHERE 
grade_terms_desc='$term_desc'");
		if($tot>0){
			$msgFormErr=_ADMIN_TERMS_DUP;
		}else{
			$sSQL="INSERT INTO grade_terms (grade_terms_desc) 
VALUES (".tosql($term_desc, "Text").")"; 
			$db->query($sSQL);
		};
		break;
	case "edit":
		$term_id=get_param("id");
		$sSQL="SELECT grade_terms_desc FROM grade_terms WHERE 
grade_terms_id=$term_id";
		$term_desc = $db->get_var($sSQL);
		break;
	case "update":
		$term_id=get_param("id");
		$term_desc=get_param("termname");
		$sSQL="UPDATE grade_terms SET 
grade_terms_desc='$term_desc' WHERE grade_terms_id=$term_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td 
class=paging width=15% align=center><a 
href=admin_terms.php?action=edit&id=COL1 
class=aform>&nbsp;" . _ADMIN_TERMS_EDIT . "</a></td><td 
class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_TERMS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grade_terms_id, grade_terms_desc FROM 
grade_terms ORDER BY grade_terms_desc");
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
    alert("<? echo _ADMIN_TERMS_ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<? echo _ADMIN_TERMS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_terms.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_TERMS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_TERMS_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addethnicity" method="post" 
action="admin_terms.php">						
		  <p class="pform"><? echo _ADMIN_TERMS_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" 
name="termname" size="20">&nbsp;<A class="aform" href="javascript: 
submitform('termname')"><? echo _ADMIN_TERMS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" 
action="admin_terms.php">						
		  <p class="pform"><? echo _ADMIN_TERMS_UPDATE_TERM?><br>
	      <input type="text" onChange="capitalizeMe(this)" 
name="termname" size="20" value="<? echo $term_desc; ?>">&nbsp;<A 
class="aform" href="javascript: submitform('termname')"><? echo _ADMIN_TERMS_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $term_id; 
?>">
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
