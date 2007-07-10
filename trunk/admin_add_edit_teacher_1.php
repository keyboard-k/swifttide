<?
//*
// admin_add_edit_teacher_1.php
// Admin Section
// Edit teacher info
// Last update 11-24-05.  Page headers not displayed properly.
// Same update: added text to submit button.
// Display username, password, health info.
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
// config
include_once "configuration.php";

$action=get_param("action");
$teacherid=get_param("teacherid");

switch ($action) {
    case "edit":
		$action="update";
		$sub_button=_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_SUB;
		$pag_header=_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_PAG;
		$sSQL="SELECT * FROM teachers WHERE teachers_id=$teacherid";
		$teacher=$db->get_row($sSQL);
		$set_title=$teacher->teachers_title;
		$set_school=$teacher->teachers_school;
		$sSQL="SELECT * from web_users WHERE web_users_type <>'C' AND web_users_relid=$teacherid";
		$web=$db->get_row($sSQL);
		break;
    case "new":
		$action="new";
		$sub_button=_ADMIN_ADD_EDIT_TEACHER_1_ADD_SUB;
		$pag_header=_ADMIN_ADD_EDIT_TEACHER_1_ADD_PAG;
		break;
   case "remove":
	//pop up javascript 'are you sure' window
		$sSQL="DELETE FROM web_users WHERE web_users_relid = $teacherid"; 	
		$db->query($sSQL);
		break;
}
//Get list of schools
$schools=$db->get_results("SELECT * FROM school_names ORDER BY school_names_desc");
//Get list of Salutations
$titles=$db->get_results("SELECT * FROM tbl_titles ORDER BY title_id");

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
    return true;
  else
    alert("<? echo _ENTER_VALUE?>");
    return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_ADD_EDIT_TEACHER_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	   <h1><? echo $pag_header; ?></h1>
	   <br>
	   <table border="0" cellpadding="1" cellspacing="1" width="100%">
	    <tr>
		<form name="addteacher" method="POST"  
action="admin_add_edit_teacher_2.php?action=<? echo $action; ?>">
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_TITLE?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_FIRST?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_LAST?></td>
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_MIDDLE?></td>
	            </tr>
	            <tr>
	              <td width="15%" class="tdinput">
				  <select name="title">
				   <?
				   //Display titles from table
				   foreach($titles as $title){
				   ?>
			       <option value="<? echo $title->title_id; ?>" <? if ($title->title_id==$set_title){echo "selected=selected";};?>><? echo $title->title_desc; ?></option>
				   <?
				   };
				   ?>
				   </select>
	              </td>
	              <td width="35%" class="tdinput">
	                  <input type="text" onChange="capitalizeMe(this)" name="tfname" size="25" <? if($action=="update"){echo " value=".strip($teacher->teachers_fname);}; ?>>
	              </td>
		          <td width="35%" class="tdinput">
		              <input type="text" onChange="capitalizeMe(this)" name="tlname" size="25" <? if($action=="update"){echo " value=".strip($teacher->teachers_lname);}; ?>>
	              </td>
	              <td width="15%" class="tdinput" align="center">
					  <input type="text" onChange="capitalizeMe(this)" size="5" name="tmi" <? if($action=="update"){echo " value=".strip($teacher->teachers_mi);}; ?>>
	              </td>
	            </tr>
		      </table>
	        </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="20%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_SCHOOL?></td>
	              <td width="40%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_EMAIL?></td>
		          <td width="40%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_ACCESS?></td>
		    </tr>
		    <tr>
	              <td width="20%" class="tdinput">
				  <select name="school">
				   <?
				   //Display schools from table
				   foreach($schools as $school){
				   ?>
			       <option value="<? echo $school->school_names_id; ?>" <? if ($school->school_names_id==$set_school){echo "selected=selected";};?>><? echo $school->school_names_desc; ?></option>
				   <?
				   };
				   ?>
				   </select>
		      </td>
		      <td width="40%" class="tdinput">
				    <input type="text" 
onchange="this.value=this.value.toLowerCase();" name="email" size="40" <?  
if($action=="update"){echo " value=".strip($teacher->teachers_email);}; ?>>
		      </td>
		      <td width="40%" class="tdinput">
		        	    <input type="text" 
name="health" size="10" <? 
if($action=="update"){echo " value=".strip($web->web_users_type);}; ?>>
		      </td>
	            </tr>
	          </table>
		  </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="50%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_USERNAME?></td>
	              <td width="50%">&nbsp;<? echo _ADMIN_ADD_EDIT_TEACHER_1_PASSWORD?></td>
				</tr>
				<tr>
	              <td width="50%" class="tdinput">
					<input type="text" 
onchange="this.value=this.value.toLowerCase();" name="username" size="20" 
<? if($action=="update"){echo " value=".strip($web->web_users_username);}; 
?>>
		          </td>
	              <td width="50%" class="tdinput">
					<input type="text" class="tolco" 
name="password" size="20" <? if($action=="update"){echo " 
value=".strip($web->web_users_password);}; ?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
    <tr>
	<td width="50%">
	   <input type="button" name="addp2" value="<? echo _ADMIN_ADD_EDIT_TEACHER_1_ADD_SCH?>" 
class="frmbut" onclick="javascript: 
window.location='admin_schedule_teach_1.php?teacherid=<? echo 
$teacherid?>';"><input 
type="submit" 
name="sumbit" value="<? echo $sub_button; ?>" class="frmbut">
	   <input type="hidden" name="teacherid" value="<? echo $teacherid; ?>">	
	   <input type="hidden" name="webid" value="<? echo $web->web_users_id; ?>">
	   <input type="hidden" name="action" value="<? echo $action; ?>">	   
	</td>
    </tr>
  </form>
</table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
