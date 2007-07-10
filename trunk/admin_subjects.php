<?
//*
// admin_subjects.php
// Admin Section
// Display and Manage Subjects Table
//*
//Version 1 12-27-05 Doug
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
//Add or Remove subjects according to admin choice
switch ($action){
	case "remove":
		$subject_id=get_param("id");
		if($norem=$db->get_results("SELECT 
grade_history_subject FROM 
grade_history WHERE grade_history_subject=$subject_id")){
			$msgFormErr=_ADMIN_SUBJECTS_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM grade_subjects WHERE 
grade_subject_id=$subject_id";
			$db->query($sSQL);
		};
		break;
	case "add":
		//Check for duplicates
		$subject_desc=tosql(get_param("subjectname"), "Text");
		$sSQL="SELECT COUNT(*) FROM grade_subjects WHERE 
grade_subject_desc=$subject_desc";
		$tot=$db->get_var($sSQL);
		if($tot>0){
			$msgFormErr=_ADMIN_SUBJECTS_DUP;
			}else{
		$sSQL="INSERT INTO grade_subjects (grade_subject_desc) 
VALUES (".$subject_desc.")"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$subject_id=get_param("id");
		$sSQL="SELECT grade_subject_desc FROM grade_subjects 
WHERE grade_subject_id=$subject_id";
		$subject_desc = $db->get_var($sSQL);
		break;
	case "update":
		$subject_id=get_param("id");
		$subject_desc=get_param("subjectname");
		$sSQL="UPDATE grade_subjects SET 
grade_subject_desc='$subject_desc' WHERE grade_subject_id=$subject_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=80% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td 
class=paging width=15% align=center><a 
href=admin_subjects.php?action=edit&id=COL1 
class=aform>&nbsp;" . _ADMIN_SUBJECTS_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_SUBJECTS_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grade_subject_id, grade_subject_desc FROM 
grade_subjects ORDER BY grade_subject_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?echo _BROWSER_TITLE?></title>
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
	answer = window.confirm("<? echo _ADMIN_SUBJECTS_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_subjects.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_SUBJECTS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_SUBJECTS_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addgrade" method="post" 
action="admin_subjects.php">						
		  <p class="pform"><? echo _ADMIN_SUBJECTS_ADD_NEW?><br>
	      <input type="text" name="subjectname" size="50" 
maxlength="80">&nbsp;<A class="aform" href="javascript: 
submitform('subjectname')"><? echo _ADMIN_SUBJECTS_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" 
action="admin_subjects.php">						
		  <p class="pform"><? echo _ADMIN_SUBJECTS_UPDATE_SUBJECT?><br>
	      <input type="text" name="subjectname" size="50" 
maxlength="80" 
value="<? echo $subject_desc; ?>">&nbsp;<A class="aform" href="javascript: 
submitform('subjectname')"><? echo _ADMIN_SUBJECTS_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo 
$subject_id; ?>">
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
