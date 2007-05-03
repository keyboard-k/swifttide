<?
//*
// admin_add_edit_contact_5.php
// Admin Section
// Edit contact
//v1.5 12-07-05 true multiyear feature
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
$contactid=get_param("contactid");
$studentid=get_param("studentid");
$type=get_param("type");
$contacttostudentsid=get_param("contacttostudentsid");

//Set variable for menu
$menustudent=1;

//Get current year
$current_year=$_SESSION['CurrentYear'];

$sSQL="SELECT studentcontact.*, 
contact_to_students.contact_to_students_internet, 
contact_to_students.contact_to_students_relation, 
contact_to_students.contact_to_students_residence FROM studentcontact 
INNER JOIN contact_to_students ON studentcontact.studentcontact_id = 
contact_to_students.contact_to_students_contact WHERE 
contact_to_students.contact_to_students_id=$contacttostudentsid";
 
$contact=$db->get_row($sSQL); $set_state=$contact->studentcontact_state;
$set_title=$contact->studentcontact_title;
$set_relation=$contact->contact_to_students_relation;

//Doug fix so titles are displayed and stored correctly.
$sSQL="SELECT title_desc FROM tbl_titles WHERE title_id=$set_title";
$set_title=$db->get_var($sSQL);
//end of fix

//Get list of states
$states=$db->get_results("SELECT * FROM tbl_states ORDER BY state_code");
//Get list of Salutations
$titles=$db->get_results("SELECT * FROM tbl_titles ORDER BY title_id");
//Get list of relations
$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");

//Get student first and last name
$student=$db->get_row("SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id=$studentid");
$sfname=$student->studentbio_fname;
$slname=$student->studentbio_lname;


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
    <td width="50%"><? echo _ADMIN_ADD_EDIT_CONTACT_5_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	   <h1><? echo _ADMIN_ADD_EDIT_CONTACT_5_EDIT?> <? echo $type;?> <? echo _ADMIN_ADD_EDIT_CONTACT_5_CFS?></h1>
	   <br>
	   <h2><? echo $sfname." ".$slname; ?></h2>
	   <br>
	   <table border="0" cellpadding="1" cellspacing="1" width="100%">
	    <tr>
		<form name="addcontact" method="POST" action="admin_add_edit_contact_6.php">
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_P_TITLE?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_FIRST?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_LAST?></td>
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_RESIDENCE?></td>
	            </tr>
	            <tr>
	              <td width="15%" class="tdinput">
				  <select name="title">
				   <?
				   //Display titles from table
				   foreach($titles as $title){
				   ?>
			       <option value="<? echo $title->title_desc; ?>" <? if ($title->title_desc==$set_title){echo "selected=selected";};?>><? echo $title->title_desc; ?></option>
				   <?
				   };
				   ?>
				   </select>

	              </td>
	              <td width="35%" class="tdinput">
	                  <input type="text" onChange="capitalizeMe(this)" name="cfname" size="25" <? echo " value=\"".strip($contact->studentcontact_fname)."\""; ?>>
	              </td>
		          <td width="35%" class="tdinput">
		              <input type="text" onChange="capitalizeMe(this)" name="clname" size="25" <? echo " value=\"".strip($contact->studentcontact_lname)."\""; ?>>
	              </td>
	              <td width="15%" class="tdinput" align="center">
					  <input type="checkbox" name="residence" value="1" <? if($contact->contact_to_students_residence==1){echo "checked=checked";};?>>
	              </td>
	            </tr>
		      </table>
	        </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="20%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_RELATION?></td>
	              <td width="40%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_ADDRESS?></td>
		          <td width="40%">&nbsp;</td>
				</tr>
				<tr>
	              <td width="20%" class="tdinput">
				  <select name="relation">
				   <?
				   //Display relations from table
				   foreach($relations as $relation){
				   ?>
			       <option value="<? echo $relation->relation_codes_id; ?>" <? if ($relation->relation_codes_id==$set_relation){echo "selected=selected";};?>><? echo $relation->relation_codes_desc; ?></option>
				   <?
				   };
				   ?>
				   </select>
		          </td>
		          <td width="40%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="address1" size="40" <? echo " value=\"".strip($contact->studentcontact_address1)."\""; ?>>
	              </td>
		          <td width="40%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="address2" size="40" <? echo " value=\"".strip($contact->studentcontact_address2)."\""; ?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_CITY?></td>
	              <td width="10%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_STATE?></td>
		          <td width="10%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_ZIP?></td>
				  <td width="45%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_EMAIL?></td>
				</tr>
				<tr>
	              <td width="35%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="city" size="20" <? echo " value=\"".strip($contact->studentcontact_city)."\""; ?>>
		          </td>
		          <td width="10%" class="tdinput">
					<select name="state">
				   <?
				   //Display states from table
				   foreach($states as $state){
				   ?>
			       <option value="<? echo $state->state_code; ?>" <? if ($state->state_code==$set_state){echo "selected=selected";};?>><? echo $state->state_name; ?></option>
				   <?
				   };
				   ?>
					</select>
	              </td>
		          <td width="10%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="zip" size="10" <? echo " value=\"".strip($contact->studentcontact_zip)."\""; ?>>
		          </td>
		          <td width="45%" class="tdinput">
					<input type="text" onchange="this.value=this.value.toLowerCase();" name="email" size="50" <? echo " value=\"".strip($contact->studentcontact_email)."\""; ?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="30%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_PHONE1?></td>
	              <td width="30%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_PHONE2?></td>
		          <td width="30%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_PHONE3?></td>
				  <td width="10%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_MAILINGS?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone1" size="20" <? echo " value=\"".strip($contact->studentcontact_phone1)."\""; ?>>
		          </td>
		          <td width="30%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="phone2" size="20" <? echo " value=\"".strip($contact->studentcontact_phone2)."\""; ?>>
	              </td>
		          <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone3" size="20" <? echo " value=\"".strip($contact->studentcontact_phone3)."\""; ?>>
		          </td>
		          <td width="10%" class="tdinput">
					  <input type="checkbox" name="mailings" value="1" <? if($contact->studentcontact_mailings==1){echo "checked=checked";}; ?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="100%">&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_5_OTHER?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput" align="center">
					<textarea name="other" cols="40" rows="5"><? echo strip($contact->studentcontact_other); ?></textarea>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
      </td>
    </tr>
    <tr>
      <td width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
		    <td width="50%"><a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_ADD_EDIT_CONTACT_5_BACK?></a>
			</td>
			<td width="50%" align="right">
			   <input type="submit" name="sumbit" value="<? echo _ADMIN_ADD_EDIT_CONTACT_5_UPDATE?>" class="frmbut">
			</td>
		  </tr>
	   </table>
	   <input type="hidden" name="contactid" value="<? echo $contactid; ?>">	
	   <input type="hidden" name="studentid" value="<? echo $studentid; ?>">	   
	   <input type="hidden" name="contacttostudentsid" value="<? echo $contacttostudentsid ?>">	   
	  </td>
    </tr>
  </form>
</table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
