<?php
//*
// admin_manage_media_3.php
// Admin Section
// Edit media record for student
// V1.0 Sept 2007 Doug
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

$menustudent=1;
$web_user=$_SESSION['UserId'];
$current_year=$_SESSION['CurrentYear'];

//Get student id
$studentid=get_param("studentid");
//Get action
$action=get_param("action");


if ($action=="edit"){
	//Get discipline id
	$disid=get_param("disid");
	//Gather info from db
	$sSQL="SELECT media_history.media_history_id, studentbio.studentbio_fname, studentbio.studentbio_lname, 
	school_names.school_names_desc, school_years.school_years_desc, 
	media_history.media_history_dateout AS disdate, 
	media_codes.media_codes_desc, media_codes.media_codes_id, 
	media_history.media_history_datedue AS sdate, 
	media_history.media_history_dateret AS edate, 
	media_history.media_history_action, media_history.media_history_notes, 
	media_history.media_history_reporter, web_users.web_users_flname 
	FROM ((((media_history INNER JOIN studentbio ON media_history.media_history_student = studentbio.studentbio_id) 
	INNER JOIN school_names ON media_history.media_history_school = school_names.school_names_id) 
	INNER JOIN school_years ON media_history.media_history_year = school_years.school_years_id) 
	INNER JOIN media_codes ON media_history.media_history_code = media_codes.media_codes_id) 
	INNER JOIN web_users ON media_history.media_history_user = web_users.web_users_id 
	WHERE media_history.media_history_id=$disid";
	$discipline=$db->get_row($sSQL);
	$slname=$discipline->studentbio_lname;
	$sfname=$discipline->studentbio_fname;
	$user=$discipline->web_users_flname;
	$cyear=$discipline->school_years_desc;
	$sschool=$discipline->school_names_desc;

/*comment out custom fields, use them later if we want.
	//get the custom fields associated with this discipline event added by Joshua
	$custom_discipline_sql = "SELECT * from custom_media_history, custom_fields 
		WHERE (custom_media_history.custom_field_id = custom_fields.custom_field_id)
		AND (custom_media_history.media_history_id = '$disid')";

	$custom_discipline_fields = $db->get_results($custom_discipline_sql);
*/

}elseif ($action == "remove") {
        $media_codes_id=get_param("disid");
        if($norem=$db->get_results("SELECT * FROM media_history WHERE media_history_id=$media_codes_id")){
        	$msgFormErr=_ADMIN_MANAGE_MEDIA_FORM_ERROR;
        }else{
        	$sSQL="DELETE FROM media_history WHERE media_history_id=$media_codes_id";
        	$db->query($sSQL);
        };
}
else {
	//Get student names
	$sSQL="SELECT studentbio_fname, studentbio_lname, studentbio_school 
	FROM studentbio 
	WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sschoolid=$student->studentbio_school;;
	//Get user name
	$sSQL="SELECT web_users_flname FROM web_users WHERE web_users_id=$web_user";
	$user=$db->get_var($sSQL);
	//Get Year
	$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year";
	$cyear=$db->get_var($sSQL);
	//Get School
	$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$sschoolid";
	$sschool=$db->get_var($sSQL);
	$discipline="";
	$custom_discipline_fields = "";

};
//Get list of media codes
$disciplinecodes=$db->get_results("SELECT * FROM media_codes ORDER BY media_codes_desc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<script language="JavaScript" src="datepicker.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<SCRIPT LANGUAGE="JAVASCRIPT">
<!--


// -->
</SCRIPT>


<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_MANAGE_MEDIA_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_MANAGE_MEDIA_3_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname ; ?></h2>
	<br>
	<h2><?php echo _ADMIN_MANAGE_MEDIA_3_INSERTED?><?php echo $user; ?></h2>
	<form name="discipline" method="POST" action="admin_manage_media_4.php">
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $sschool ; ?></td>
	    <td width="50%">&nbsp;<?php echo $cyear ; ?></td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_INFRACTION?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%" class="tdinput">
			  <select name="discode">
			  <option><?php echo _ADMIN_MANAGE_MEDIA_3_SELECT_INFRACTION?></option>
			   <?php
			   //Display discipline codes from table
			   foreach($disciplinecodes as $disciplinecode){
			   ?>
		       <option value="<?php echo $disciplinecode->media_codes_id; ?>" <? if ($disciplinecode->media_codes_id==$discipline->media_codes_id){echo "selected=selected";};?>><?php echo $disciplinecode->media_codes_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
		<td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="disdate" size="10" value="<? if($action=="edit"){echo $discipline->disdate;};?>" READONLY onclick="javascript:show_calendar('discipline.disdate');"><a href="javascript:show_calendar('discipline.disdate');"><img src="images/cal.gif" border="0" class="imma"></a>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_START_DATE?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_END_DATE?></td>
	  </tr>
	  <tr>
		<td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="sdate" size="10" value="<? if($action=="edit"){echo $discipline->sdate;};?>" READONLY onclick="javascript:show_calendar('discipline.sdate');"><a href="javascript:show_calendar('discipline.sdate');"><img src="images/cal.gif" border="0" class="imma"></a>
		</td>
		<td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="edate" size="10" value="<? if($action=="edit"){echo $discipline->edate;};?>" READONLY onclick="javascript:show_calendar('discipline.edate');"><a href="javascript:show_calendar('discipline.edate');"><img src="images/cal.gif" border="0" class="imma"></a>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_NOTES?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<textarea name="disnotes" cols="40" rows="5"><? if($action=="edit"){echo strip($discipline->media_history_notes);};?></textarea></td>
	  </tr>
	  <?php
	  if($action=="new"){
	  ?>
	  <tr>
	  <td width="100%" colspan="2" class="tdinput">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_3_NOTIFY?> :<input type="checkbox" name="notify" value="1" checked=checked></td>
		<input type="hidden" name="sschool" value="<?php echo $sschoolid; ?>">
	  </tr>
	  <?php
	  };
	  ?>
<?php
/*comment out custom field stuff
    <? //custom fields added by Joshua
    	//get all the custom field names for the select loops
     $cfSQL = "SELECT * FROM custom_fields";
     $custom_fields = $db->get_results($cfSQL);

	?> <tr class="trform"><td colspan=2><?php echo _ADMIN_MANAGE_MEDIA_3_CUSTOM_FIELDS?></td></tr>
	<tr><td colspan=2><table width="100%"> <?php

    	if($custom_discipline_fields) {
		foreach($custom_discipline_fields as $custom_discipline_field) {
			?> <tr><td><select name="custom_fields[<?php
			echo($custom_discipline_field->custom_media_history_id);
			?>]"><option value="0"><?php echo _ADMIN_MANAGE_MEDIA_3_DELETE?>...</option><?php
			foreach($custom_fields as $custom_field) {
				?><option value="<?php echo($custom_field->custom_field_id);
				?>" <?php
				if($custom_field->custom_field_id == $custom_discipline_field->custom_field_id) {
					echo" selected";
				}
				?>><?php
				echo($custom_field->name);
				?></option><?php
			}
			?></select></td><td><input type="text" name="custom_discipline_fields[<?php
	    		echo($custom_discipline_field->custom_media_history_id);
	    		?>]" value="<?php echo($custom_discipline_field->data);
	    		?>" size=70></td></tr> <?php
		} 
	}
	?><tr><td><select name="new_custom_field_id">
	<option value="0" selected><?php echo _ADMIN_MANAGE_MEDIA_3_ADD_NEW?>...</option><?php
	foreach($custom_fields as $custom_field) {
		?><option value="<?echo($custom_field->custom_field_id);
		?>"><?php echo($custom_field->name);
		?></option><?php
	} 
	?></td><td><input type="text" name="new_custom_field_data" size=70>
	</td></tr></table></td></tr><?php
	//end custom fields
	?>

Gosh I hope that is the end of that block
*/?>
	</table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_MANAGE_MEDIA_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _ADMIN_MANAGE_MEDIA_3_UPDATE;}else{echo _ADMIN_MANAGE_MEDIA_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="disid" value="<?php echo $disid; ?>">
	  <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">

	</table>
	</form>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
