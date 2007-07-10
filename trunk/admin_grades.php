<?
//*
// admin_grades.php
// Admin Section
// Display and Manage Grades Table
//v1.5 12-03-05 added notice about ordering of grades, changed sort order to comply
//010107 added fix to prevent us from deleting if it's already used in the system
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
//Add or Remove Grades according to admin choice
switch ($action){
	case "remove":
		$grades_id=get_param("id");
		if($norem=$db->get_results("SELECT student_grade_year_grade
FROM student_grade_year WHERE student_grade_year_grade='$grades_id'")){
                        $msgFormErr=_ADMIN_GRADES_FORM_ERROR;
                }else{
                        	//pq - 2007-02-22 - fixed typo so grades delete
			$sSQL="DELETE FROM grades WHERE grades_id='$grades_id";
                        $db->query($sSQL);
                };
                break;
	case "add":
		//Check for duplicates
		$grades_desc=get_param("gradename");
		$tot=$db->get_var("SELECT count(*) FROM grades WHERE
grades_desc='$gradename'");
                if($tot>0){
                        $msgFormErr=_ADMIN_GRADES_DUP;
                }else{

		$sSQL="INSERT INTO grades (grades_desc) VALUES (".tosql($grades_desc, "Text").")"; 
		$db->query($sSQL);
		};
		break;
	case "edit":
		$grades_id=get_param("id");
		$sSQL="SELECT grades_desc FROM grades WHERE grades_id=$grades_id";
		$grades_desc = $db->get_var($sSQL);
		break;
	case "update":
		$grades_id=get_param("id");
		$grades_desc=get_param("gradename");
		$sSQL="UPDATE grades SET grades_desc='$grades_desc' WHERE grades_id=$grades_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_grades.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_GRADES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_GRADES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grades_id, grades_desc FROM grades ORDER BY 
grades_id");
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
	answer = window.confirm("<? echo _ADMIN_GRADES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_grades.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_GRADES_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_GRADES_TITLE?></h1>
	<br>
	<h2><? echo _ADMIN_GRADES_SUBTITLE?></h2>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addgrade" method="post" action="admin_grades.php">						
		  <p class="pform"><? echo _ADMIN_GRADES_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="gradename" size="20">&nbsp;<A class="aform" href="javascript: submitform('gradename')"><? echo _ADMIN_GRADES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editgrade" method="post" action="admin_grades.php">	
		  <p class="pform"><? echo _ADMIN_GRADES_UPDATE_GRADE?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="gradename" size="20" value="<? echo $grades_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('gradename')"><? echo _ADMIN_GRADES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $grades_id; ?>">
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
