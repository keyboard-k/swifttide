<?php
//*
// admin_manage_media_2.php
// Admin Section
// Display details on media information for student
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

//Get Studentid
$studentid=get_param("studentid");

//Get attendace id
$disid=get_param("disid");

//Get info
$sSQL="SELECT media_history.media_history_id, 
studentbio.studentbio_fname, studentbio.studentbio_lname, 
school_names.school_names_desc, school_years.school_years_desc, 
DATE_FORMAT(media_history.media_history_dateout,'" . _EXAMS_DATE . "') AS disdate, 
media_codes.media_codes_desc, 
DATE_FORMAT(media_history.media_history_datedue,'" . _EXAMS_DATE . "') AS sdate, 
DATE_FORMAT(media_history.media_history_dateret,'" . _EXAMS_DATE . "') AS edate, 
media_history.media_history_action, media_history.media_history_notes, 
media_history.media_history_reporter, web_users.web_users_flname 
FROM ((((media_history INNER JOIN studentbio ON media_history.media_history_student = studentbio.studentbio_id) 
INNER JOIN school_names ON media_history.media_history_school = school_names.school_names_id) 
INNER JOIN school_years ON media_history.media_history_year = school_years.school_years_id) 
INNER JOIN media_codes ON media_history.media_history_code = media_codes.media_codes_id) 
INNER JOIN web_users ON media_history.media_history_user = web_users.web_users_id 
WHERE media_history.media_history_id=$disid";

$discipline=$db->get_row($sSQL);

/*comment out custom field stuff, bring back later if we want
//get the custom fields associated with this discipline event added by Joshua
$custom_discipline_sql = "SELECT * from custom_media_history, custom_fields 
	WHERE (custom_media_history.custom_field_id = custom_fields.custom_field_id)
	AND (custom_media_history.media_history_id = '$disid')";
$custom_discipline_fields = $db->get_results($custom_discipline_sql);
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_MANAGE_MEDIA_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_MANAGE_MEDIA_2_TITLE?></h1>
	<br>
	<h2><?php echo $discipline->studentbio_fname. " " .$discipline->studentbio_lname; ?></h2>
	<br>
	<h2><?php echo _ADMIN_MANAGE_MEDIA_2_INSERTED?><?php echo $discipline->web_users_flname; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $discipline->school_names_desc ; ?></td>
	    <td width="50%">&nbsp;<?php echo $discipline->school_years_desc ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_INFRACTION?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $discipline->media_codes_desc ; ?></td>
	    <td width="50%">&nbsp;<? if ($discipline->disdate > 0) echo $discipline->disdate ; ?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_START_DATE?></td>
	    <td width="50%">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_END_DATE?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<? if ($discipline->sdate > 0) echo $discipline->sdate ; ?></td>
	    <td width="50%">&nbsp;<? if ($discipline->edate > 0) echo $discipline->edate ; ?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php echo $discipline->media_history_reporter ;?></td>
	  </tr>
	  <tr class="tblhead">
	    <td width="100%" colspan="2">&nbsp;<?php echo _ADMIN_MANAGE_MEDIA_2_NOTES?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" colspan="2">&nbsp;<?php echo $discipline->media_history_notes ; ?></td>
	  </tr>

<?/*comment out custom field work
	<? //display custom fields added by Joshua
     if(count($custom_discipline_fields)) {
		?><tr><td colspan=2><h2><?php echo _ADMIN_MANAGE_MEDIA_2_CUSTOM_FIELDS?></h2></td></tr>
		<tr><td colspan=2><table width="100%"><?php
     	foreach($custom_discipline_fields as $custom_discipline_field) {
  			?><tr><td class="tblhead"><?php
  			echo($custom_discipline_field->name);
  			?>:</td><td class="tblcont"><?php
			echo($custom_discipline_field->data);
     	    	?></td></tr><?php
     	 }
		 ?></table></td></tr><?php
	} 
	//end of custom fields
	?>
*/?>
	</table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="admin_manage_media_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_MANAGE_MEDIA_2_BACK?></a></td>
	    <td width="50%" align="right"><a 
href="admin_manage_media_3.php?studentid=<?php echo $studentid; ?>&disid=<? 
echo $disid; ?>&action=edit" class="aform"><?php echo _ADMIN_MANAGE_MEDIA_2_EDIT?></a></td>
	  </tr>
	</table>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
