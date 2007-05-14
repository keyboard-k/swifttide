<?
//*
// teachers_homework.php
// Teachers Section
// Form to post/remove homework assignments
// Version 1.00 April 24 2005 cosmetic
//v1.5 12-31-05 had an error when deleting assignment.  Fixed.
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

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];

// Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$schoolrooms=$db->get_results($sSQL);

// Get list of subjects
$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_id";
$subjectcodes=$db->get_results($sSQL);

$action = get_param("action");
$homework_id = get_param("homework_id");
$name = get_param("name");
$subjectid = get_param("subjectid");
$roomid = get_param("roomid");
$date_assigned = get_param("date_assigned");
$date_due = get_param("date_due");
$notes = get_param("notes");
$new_homework_file_title = get_param("new_homework_file_title");
$homework_file_id = get_param("homework_file_id");

$teacher_query = "SELECT * FROM teachers, web_users 
	WHERE (web_users.web_users_id = " . $_SESSION['UserId'] . ") 
	AND (web_users.web_users_relid = teachers.teachers_id)";
$teacher = $db->get_row($teacher_query);

if ($date_assigned) { $fixed_date_assigned = fix_date($date_assigned); }
if ($date_due) { $fixed_date_due = fix_date($date_due); }

if($action == 'add') {
	$new_homework_query = "INSERT into homework SET 
		teacher_id = '$teacher->teachers_id', 
		name = '$name', 
		subjectid = '$subjectid', 
		roomid = '$roomid', 
		date_assigned = '$fixed_date_assigned', 
		date_due = '$fixed_date_due', 
		notes = '$notes'";
	$db->query($new_homework_query);
	
	unset($action);

} else if($action == 'update') {
	$update_homework_query = "UPDATE homework SET 
		subjectid = '$subjectid',
		roomid = '$roomid',
		date_assigned = '$fixed_date_assigned',
		date_due = '$fixed_date_due',
		date_assigned = '$fixed_date_assigned',
		notes = '$notes' 
		WHERE homework_id = '$homework_id'";
	$db->query($update_homework_query);	
	unset($action);

} else if($action == 'delete') {
	
	$homework_files_delete_query = "SELECT * FROM homework_files WHERE homework_id = '$homework_id'";
	$homework_files_to_delete = $db->get_results($homework_files_delete_query);
	//foreach($homework_files_to_delete as $file_to_delete) {
		if(file_exists($homework_files_to_delete->location)) {
		//if the file is successfully deleted
			if(unlink($homework_files_to_delete->location)) {
				//remove the db entry
				$homework_file_delete_query = "DELETE from 
homework_files WHERE homework_file_id = '$homework_files_to_delete->homework_file_id'";
				$db->query($homework_file_delete_query);
			}
		}
	
	
	$delete_homework_query = "DELETE from homework WHERE homework_id = '$homework_id'";
	$db->query($delete_homework_query);
	unset($action);	

} else if($action == 'add_file') {
	//if a directory for this teacher doesn't exist, create it
	if(!is_dir("homework/$teacher->web_users_username")) {
		mkdir("homework/$teacher->web_users_username");
	}

	$upload_file = "homework/$teacher->web_users_username/".$_FILES['new_homework_file']['name'];
	//if the file doesn't already exist
	if(!file_exists($upload_file)) {
	//move the file to it's propper location
		if(move_uploaded_file($_FILES['new_homework_file']['tmp_name'], $upload_file)) {
			//if upload was successful, record it in the database
			$new_homework_file_query = "INSERT into homework_files SET 
				homework_id = '$homework_id', 
				title = '$new_homework_file_title', 
				location = '$upload_file'";
			$db->query($new_homework_file_query);
		}
	}
	unset($action);
} else if($action == 'delete_file') {
	//get the location of the actual file from the db
	$homework_file_query = "SELECT location FROM homework_files WHERE homework_file_id = '$homework_file_id'";
	$homework_file_location = $db->get_var($homework_file_query);
	
	//if the file is successfully deleted
	if(file_exists($homework_file_location)) {
		if(unlink($homework_file_location)) {
			//remove the db entry
			$homework_file_delete_query = "DELETE from homework_files WHERE homework_file_id = '$homework_file_id'";
			$db->query($homework_file_delete_query);
		}
	}
	unset($action);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<SCRIPT language="JavaScript">

//validation just for new homework
function validateNewHomework() {

	if(!document.forms.new_homework.name.value || document.forms.new_homework.name.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_NEW_NAME?>");
		return false;
	}
	if(!document.forms.new_homework.subjectid.value 
		|| document.forms.new_homework.subjectid.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_NEW_SUBJECT?>");
		return false;
	}
	if(!document.forms.new_homework.date_assigned.value 
		|| document.forms.new_homework.date_assigned.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_NEW_DATE?>");
		return false;
	}
	if(!document.forms.new_homework.date_due.value 
		|| document.forms.new_homework.date_due.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_NEW_DUE_DATE?>");
		return false;
	}

	document.forms.new_homework.action.value = "add";
	return true;
	
}

//validation function for the updating of all existing homework entries
function validateHomework(homework_form_name) {

	var f = eval("document.forms." + homework_form_name);

	if(!f.subjectid.value || f.subjectid.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_SUBJECT?>");
		return false;
	}
	if(!f.date_assigned.value || f.date_assigned.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_DATE?>");
		return false;
	}
	if(!f.date_due.value || f.date_due.value == '') {
		alert("<? echo _TEACHERS_HOMEWORK_ENTER_DUE_DATE?>");
		return false;
	}

	f.action.value = "update";
	return true;
	
}

function deleteHomework(homework_form_name) {

	var f = eval("document.forms." + homework_form_name);
	if(confirm("<? echo _TEACHERS_HOMEWORK_DELETE?>")) {
		f.action.value = "delete";
		f.submit();
	} 

}	

function addHomeworkFile(homework_form_name) {
	var f = eval("document.forms." + homework_form_name);

	//validate fields
	if(!f.new_homework_file_title.value || f.new_homework_file_title.value == "") {
		alert("<? echo _TEACHERS_HOMEWORK_FILE_TITLE?>");
		return false;
	}
	if(!f.new_homework_file.value || f.new_homework_file.value == "") {
		alert("<? echo _TEACHERS_HOMEWORK_FILE_INVALID?>");
		return false;
	}
	f.action.value = "add_file";
	return true;
	
}
function deleteHomeworkFile(homework_form_name, homework_file_id) {
	if(confirm("<? echo _TEACHERS_HOMEWORK_DELETE_FILE?>")) {
		var f = eval("document.forms." + homework_form_name);
		f.homework_file_id.value = homework_file_id;
		f.action.value = "delete_file";
		f.submit();
	} else return false;
}
</script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
<script language="JavaScript" src="datepicker.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="95%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>

<!-- the homework content table -->
<div id="Content">
<h1><? echo _TEACHERS_HOMEWORK_TITLE?></h1>
<br>

<table width="100%">

<!-- new homework -->
<tr><td><form name="new_homework" method="POST" action="<?echo($PHP_SELF);?>">

<!-- start of new homework table -->
<table border=1><th><? echo _TEACHERS_HOMEWORK_NEW_TITLE?></th><tr><td><table>

<tr><td><table>
<tr>
  <td class="trtblhead"><? echo _TEACHERS_HOMEWORK_NEW_NAME?>:</td>
  <td class="tblinput"><input name="name" type="text" class="tdinput" size=70></td>
</tr>
<tr>
  <td class="trtblhead"><? echo _TEACHERS_HOMEWORK_NEW_SUBJECT?>:</td>
  <td class="tdinput">
  <select name="subjectid">
  <? //Display subjects from table
  foreach($subjectcodes as $subject){
  ?>
  <option value="<? echo $subject->grade_subject_id; ?>">
                 <? echo $subject->grade_subject_desc; ?></option>
  <? }; ?>
  </select>
  </td>
</tr>
<tr>
  <td class="trtblhead"><? echo _TEACHERS_HOMEWORK_NEW_ROOM?>:</td>
  <td class="tdinput">
  <select name="roomid">
  <? //Display rooms from table
  foreach($schoolrooms as $room){
  ?>
    <option value="<? echo $room->school_rooms_id; ?>">
                   <? echo $room->school_rooms_desc; ?></option>
  <? }; ?>
  </select>
  </td>
</tr>
</table></td></tr>

<tr><td><table>
<tr><td width="40%"><table>

<tr><td class="trtblhead"><? echo _TEACHERS_HOMEWORK_ASSIGNED_ON?></td>
<td class="tblcont"><input name="date_assigned" type="text" class="tdinput" onclick="javascript:show_calendar('new_homework.date_assigned');" size=10 READONLY>
<a href="javascript:show_calendar('new_homework.date_assigned');"><img src="images/cal.gif" border="0" class="imma"></a>
</td></tr>
<tr><td class="trtblhead">
<? echo _TEACHERS_HOMEWORK_DUE_ON?></td><td class="tblcont">
<input name="date_due" type="text" class="tdinput" onclick="javascript:show_calendar('new_homework.date_due');" size=10 READONLY>
<a href="javascript:show_calendar('new_homework.date_due');"><img src="images/cal.gif" border="0" class="imma"></a></td></tr>

</table></td>

<td align="center" width="60%">

<table>
<tr><td align="center" class="trtblhead"><? echo _TEACHERS_HOMEWORK_NOTES?></td></tr>
<tr><td>
<textarea name="notes" cols=50 rows=4 class="tdinput"></textarea>
</td></tr>
</table>
</td></tr>

</table></td></tr>
<tr><td align="right">
<input type="hidden" name="action" value="<?echo($action);?>">
<input name="add_homework" type="Submit" class="frmbut" onClick="javascript:return validateNewHomework()" value="<? echo _TEACHERS_HOMEWORK_ADD?>">
</td></tr>

</table>
</form></td></tr></table>

</td></tr>

<!-- end of new homework -->

<?
//add date comparisons
$homework_query = "SELECT * 
	FROM ((homework 
	INNER JOIN grade_subjects ON subjectid=grade_subject_id) 
	INNER JOIN school_rooms ON roomid=school_rooms_id) 
	WHERE homework.teacher_id = '$teacher->teachers_id' 
	ORDER BY date_due";
$homework = $db->get_results($homework_query);

if(is_array($homework)) {

	foreach($homework as $assignment) {
		?>
		<!-- existing homework -->
		<tr><td>
		<form name="homework_<?echo($assignment->homework_id);?>" enctype="multipart/form-data"  method="POST" action="<?echo($PHP_SELF);?>">

		<!-- start of new homework table -->
		<table border=1><th><?echo($assignment->name);?></th><tr><td><table>

		<tr><td><table>
		<tr>
		  <td class="trtblhead"><? echo _TEACHERS_HOMEWORK_SUBJECT?>:</td>
		  <td class="tblcont"><input name="subjectid" type="text" class="tdinput" value="<?echo($assignment->grade_subject_desc);?>" size=70></td>
		</tr>
		<tr>
		  <td class="trtblhead"><? echo _TEACHERS_HOMEWORK_ROOM?>:</td>
		  <td class="tblcont"><input name="roomid" type="text" class="tdinput" value="<?echo($assignment->school_rooms_desc);?>" size=70></td>
		</tr></table></td></tr>
		<tr><td><table><tr><td width="40%">
		
		<table>
		<tr><td class="trtblhead"><? echo _TEACHERS_HOMEWORK_ASSIGNED_ON?></td>
		<td class="tblcont"><input name="date_assigned" type="text" class="tdinput" onclick="javascript:show_calendar	('homework_<?echo($assignment->homework_id);?>.date_assigned');" 
		value="<?echo(break_date($assignment->date_assigned));?>" size=10 READONLY>
		<a href="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_assigned');">
		<img src="images/cal.gif" border="0" class="imma"></a>
		</td></tr>
		<tr><td class="trtblhead">
		<? echo _TEACHERS_HOMEWORK_DUE_ON?></td><td class="tblcont">
		<input name="date_due" type="text" class="tdinput" onclick="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_due');" value="<?echo(break_date($assignment->date_due));?>" size=10 
			READONLY>
		<a href="javascript:show_calendar('homework_<?echo($assignment->homework_id);?>.date_due');">
		<img src="images/cal.gif" border="0" class="imma"></a></td></tr>

		</table></td>

		<td align="center" width="60%">

		<table>
		<tr><td align="center" class="trtblhead"><? echo _TEACHERS_HOMEWORK_NOTES?></td></tr>
		<tr><td>
		<textarea name="notes" cols=50 rows=4 class="tdinput"><?echo($assignment->notes);?></textarea>
		</td></tr>
		</table>
		</td></tr>

		</table></td></tr>

		<!-- the main assignment control buttons -->
		<tr><td align="right">
		<input type="hidden" name="homework_file_id">
		<input type="hidden" name="action" value="<?echo($action);?>">
		<input type="hidden" name="homework_id" value="<?echo($assignment->homework_id);?>">
		<input name="delete_homework" type="button" class="frmbut" 
		onClick="javascript: deleteHomework('homework_<?echo($assignment->homework_id);?>')" value="<? echo _TEACHERS_HOMEWORK_DEL_ASSIGNMENT?>">
		<input name="update_homework" type="submit" class="frmbut"
		onClick="javascript: validateHomework('homework_<?echo($assignment->homework_id);?>')" value="<? echo _TEACHERS_HOMEWORK_UPD_ASSIGNMENT?>">
		</td></tr>

		<? //homework files
			?><tr><td><h2><? echo _TEACHERS_HOMEWORK_TITLE2?></h2></td></tr><tr><td><table width="100%"><tr>
			
			<!-- the form for adding a new homework file to this assignment -->
			<td class="trtblhead">
		<? echo _TEACHERS_HOMEWORK_FILES_TITLE?>:</td><td><input type="text" name="new_homework_file_title"></td><td class="trtblhead">
		<? echo _TEACHERS_HOMEWORK_FILES_LOCATION?>: <input name="new_homework_file" type="file"></td><td>
		<input name="add_homework_file" type="submit" class="frmbut" 
		onClick="javascript: return addHomeworkFile('homework_<?echo($assignment->homework_id);?>')"  value="<? echo _TEACHERS_HOMEWORK_FILES_ADD?>">
		</td></tr><?
		//query for existing homework files
		$homework_files_query = "SELECT * from homework_files WHERE homework_id = '$assignment->homework_id'";
		$homework_files = $db->get_results($homework_files_query);

		if(is_array($homework_files)) {
			foreach($homework_files as $homework_file) {
				echo"<tr><td class='tblhead'>" . _TEACHERS_HOMEWORK_FILES_TITLE . ":</td><td class='tblcont' colspan=2><a href='$homework_file->location' target='_blank'>$homework_file->title</a></td>";
				?><td>
				<input name="delete_homework_file" type="button" class="frmbut" 
				onClick="javascript: return deleteHomeworkFile('homework_<?echo($assignment->homework_id);?>', '<?echo($homework_file->homework_file_id);?>')" value="<? echo _TEACHERS_HOMEWORK_FILES_DELETE?>"></td></tr><?
			}
		}
		?></table></td></tr><?
		
		?>
		</table>
		</form></td></tr></table></td></tr>
		<!-- end of current homework table --><?

	}

} else {
	//no homework returned
}

?>

</table>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>
