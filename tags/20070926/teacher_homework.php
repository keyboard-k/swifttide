<?php
//*
// teacher_change_password.php
// Teachers Section
// Form to change password
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
{
  header ("Location: index.php?action=notauth");
	exit;
}

//Inizialize databse functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";
// Include configuration
include_once "configuration.php";

$action = get_param("action");
$homework_id = get_param("homework_id");
$name = get_param("name");
$subject = get_param("subject");
$date_assigned = get_param("date_assigned");
$date_due = get_param("date_due");
$notes = get_param("notes");

$teacher_query = "SELECT * FROM teachers, web_users 
	WHERE (web_users.web_users_id = '". $_SESSION[UserId] ."') 
	AND (web_users.web_users_relid = teachers.teachers_id)";
$teacher = $db->get_row($teacher_query);

if ($fixed_date_assigned) { $fixed_date_assigned = fix_date($date_assigned); }
if ($fixed_date_due) { $fixed_date_due = fix_date($date_due); }

if($action == 'add') {
	
	$new_homework_query = "INSERT into homework SET 
		teacher_id = '". $teacher->teachers_id ."', 
		name = '". $name ."', 
		subject = '". $subject ."', 
		date_assigned = '". $fixed_date_assigned ."', 
		date_due = '". $fixed_date_due ."', 
		notes = '". $notes ."'";
	$db->query($new_homework_query);
	
	unset($action);

} else if($action == 'update') {

	$update_homework_query = "UPDATE homework SET 
		subject = '". $subject ."',
		date_assigned = '". $fixed_date_assigned ."',
		date_due = '". $fixed_date_due ."',
		date_assigned = '". $fixed_date_assigned ."',
		notes = '". $notes ."' 
		WHERE homework_id = '". $homework_id ."'";
	$db->query($update_homework_query);	
	unset($action);

} else if($action == 'delete') {
	$delete_homework_query = "DELETE from homework WHERE homework_id = '". $homework_id ."'";
	$db->query($delete_homework_query);
	unset($action);	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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

//validation just for new homework
function validateNewHomework() {

	if(!document.forms.new_homework.name.value || document.forms.new_homework.name.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_NAME?>");
		return false;
	}
	if(!document.forms.new_homework.subject.value 
		|| document.forms.new_homework.subject.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_SUBJECT?>");
		return false;
	}
	if(!document.forms.new_homework.date_assigned.value 
		|| document.forms.new_homework.date_assigned.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_DATE?>");
		return false;
	}
	if(!document.forms.new_homework.date_due.value 
		|| document.forms.new_homework.date_due.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_DATE_DUE?>");
		return false;
	}

	document.forms.new_homework.action.value = "add";
	return true;
	
}

//validation function for the updating of all existing homework entries
function validateHomework(homework_form_name) {

	var f = eval("document.forms." + homework_form_name);

	if(!f.subject.value || f.subject.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_SUBJECT?>");
		return false;
	}
	if(!f.date_assigned.value || f.date_assigned.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_DATE?>");
		return false;
	}
	if(!f.date_due.value || f.date_due.value == '') {
		alert("<?php echo _TEACHER_HOMEWORK_ENTER_DATE_DUE?>");
		return false;
	}

	f.action.value = "update";
	return true;
	
}

function deleteHomework(homework_form_name) {

	var f = eval("document.forms." + homework_form_name);
	if(confirm("<?php echo _TEACHER_HOMEWORK_DELETE_ASSIGNMENT?>")) {
		f.action.value = "delete";
		f.submit();
	} 

}	

</script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
<script language="JavaScript" src="datepicker.js"></script>
</head>

<body>
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>

<img src="images/<?php echo _LOGO?>" border="0">
<!-- the homework content table -->
<div id="Content">
<h1><?php echo _TEACHER_HOMEWORK_TITLE?></h1>
<br>

<table width="100%">

<!-- new homework -->
<tr><td><form name="new_homework" method="POST" action="<?echo($PHP_SELF);?>">

<!-- start of new homework table -->
<table border=1><th><?php echo _TEACHER_HOMEWORK_NEW_HOMEWORK?></th><tr><td><table>

<tr><td><table><tr><td class="tblhead"><?php echo _TEACHER_HOMEWORK_HOMEWORK_NAME?></td>
<td class="tblcont"><input type="text" size=70 name="name"></td></tr>
<tr><td class="tblhead">Subject:</td><td class="tblcont"><input type="text" size=70 name="subject"></td></tr></table></td></tr>

<tr><td><table>
<tr><td width="40%"><table>

<tr><td class="tblhead"><?php echo _TEACHER_HOMEWORK_ASSIGNED_ON?></td>
<td class="tblcont"><input type="text" size=10 name="date_assigned" READONLY onclick="javascript:show_calendar('new_homework.date_assigned');"><a href="javascript:show_calendar('new_homework.date_assigned');"><img src="images/cal.gif" border="0" class="imma"></a>
</td></tr>
<tr><td class="tblhead">
<?php echo _TEACHER_HOMEWORK_DUE_ON?></td><td class="tblcont">
<input type="text" size=10 name="date_due" READONLY onclick="javascript:show_calendar('new_homework.date_due');"><a href="javascript:show_calendar('new_homework.date_due');"><img src="images/cal.gif" border="0" class="imma"></a></td></tr>

</table></td>

<td align="center" width="60%">

<table>
<tr><td align="center" class="tblhead"><?php echo _TEACHER_HOMEWORK_NOTES?></td></tr>
<tr><td>
<textarea name="notes" cols=50 rows=4></textarea>
</td></tr>
</table>
</td></tr>

</table></td></tr>
<tr><td align="right">
<input type="hidden" name="action" value="<?echo($action);?>">
<input type="Submit" name="add_homework" value="Add Assignment" onClick="javascript:return validateNewHomework()">
</td></tr>

</table>
</form></td></tr></table>

</td></tr>

<!-- end of new homework -->

<?php
//add date comparisons
$homework_query = "SELECT * FROM homework WHERE homework.teacher_id = '$teacher->teachers_id'";
$homework = $db->get_results($homework_query);

if(is_array($homework)) {

	foreach($homework as $assignment) {
		?>
		<!-- existing homework -->
		<tr><td>
		<form name="homework_<?echo($assignment->homework_id);?>" method="POST" action="<?echo($PHP_SELF);?>">

		<!-- start of new homework table -->
		<table border=1><th><?echo($assignment->name);?></th><tr><td><table>

		<tr><td><table>
		<tr><td class="tblhead"><?php echo _TEACHER_HOMEWORK_SUBJECT?></td><td class="tblcont">
		<input type="text" size=70 name="subject" value="<?echo($assignment->subject);?>">
		</td></tr></table></td></tr>
		<tr><td><table><tr><td width="40%">
		
		<table>
		<tr><td class="tblhead"><?php echo _TEACHER_HOMEWORK_ASSIGNED_ON?></td>
		<td class="tblcont"><input type="text" size=10 name="date_assigned" 
		value="<?echo($assignment->date_assigned);?>" READONLY onclick="javascript:show_calendar	('homework_<?echo($assignment->homework_id);?>.date_assigned');">
		<a href="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_assigned');">
		<img src="images/cal.gif" border="0" class="imma"></a>
		</td></tr>
		<tr><td class="tblhead">
		<?php echo _TEACHER_HOMEWORK_DUE_ON?></td><td class="tblcont">
		<input type="text" size=10 name="date_due" value="<?echo($assignment->date_due);?>" 
			READONLY onclick="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_due');">
		<a href="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_due');">
		<img src="images/cal.gif" border="0" class="imma"></a></td></tr>

		</table></td>

		<td align="center" width="60%">

		<table>
		<tr><td align="center" class="tblhead"><?php echo _TEACHER_HOMEWORK_NOTES?></td></tr>
		<tr><td>
		<textarea name="notes" cols=50 rows=4><?echo($assignment->notes);?></textarea>
		</td></tr>
		</table>
		</td></tr>

		</table></td></tr>
		<tr><td align="right">
		<input type="hidden" name="action" value="<?echo($action);?>">
		<input type="hidden" name="homework_id" value="<?echo($assignment->homework_id);?>">
		<input type="button" name="delete_homework" value="<?php echo _TEACHER_HOMEWORK_DELETE_BUTTON?>" 
		onClick="javascript: deleteHomework('homework_<?echo($assignment->homework_id);?>')">
		<input type="submit" name="update_homework" value="<?php echo _TEACHER_HOMEWORK_UPDATE_BUTTON?>"
		onClick="javascript: validateHomework('homework_<?echo($assignment->homework_id);?>')">
		</td></tr>

		</table>
		</form></td></tr></table></td></tr>
		<!-- end of current homework table --><?php

	}

} else {
	//no homework returned
}

?>

</table>
</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>
