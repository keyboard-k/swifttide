<?php
//*
// admin_schedule_teach_1.php
// Admin Section
// Display schedule for teacher
// 040907 doug support diff schedules for diff days
// 041307 support for rooms in schedules
// 041707 timetable listing
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

//Get current year
$cyear=$_SESSION['CurrentYear'];

// get action
$action=get_param("action");

if ($action=="remove") {
        $id_to_delete = get_param("schedid");
	$sSQL="DELETE FROM teacher_schedule WHERE teacher_schedule_id=$id_to_delete";
	$db->query($sSQL);
}

//Get teacher id
$teacherid=get_param("teacherid");
//Get school of teacher
$teacher=$db->get_row("SELECT * FROM teachers WHERE teachers_id=$teacherid");
$tlname=$teacher->teachers_lname;
$tfname=$teacher->teachers_fname;
$tschool=$teacher->teachers_school;


if (!strlen($teacherid) && ($action!="remove")) {
	$msgFormErr=_ADMIN_SCHEDULE_TEACH_1_FORM_ERROR . "<br>";
}else{
	$msgFormErr="";
	//Get Teacher Name
	$sSQL="SELECT teachers_fname, teachers_lname, teachers_school FROM teachers WHERE teachers_id=$teacherid";
	$teacher=$db->get_row($sSQL);
	$tlname=$teacher->teachers_lname;
	$tfname=$teacher->teachers_fname;
	$tschool=$teacher->teachers_school;
	
// Get terms where teacher is active
$sSQL="SELECT DISTINCT teacher_schedule_termid FROM teacher_schedule 
       WHERE teacher_schedule_teacherid='$teacherid' 
       ORDER BY teacher_schedule_termid"; 
$terms = $db->get_results($sSQL);

//Get current schedule
$sSQL="SELECT school_names_desc, grade_terms_desc, 
days_desc, teacher_schedule_classperiod, 
grade_subject_desc, school_rooms_desc, teacher_schedule_id, teacher_schedule_teacherid 
FROM (((((teacher_schedule 
INNER JOIN grade_terms ON teacher_schedule_termid=grade_terms_id) 
INNER JOIN grade_subjects ON teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
INNER JOIN school_names ON teacher_schedule_schoolid=school_names_id) 
INNER JOIN tbl_days ON teacher_schedule_days=days_id) 
INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
WHERE teacher_schedule_teacherid='$teacherid' AND 
      school_names.school_names_id=$tschool 
ORDER BY grade_terms.grade_terms_desc, days_id, teacher_schedule_classperiod, grade_subjects.grade_subject_desc";

	//Set paging appearence
	$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead>
	<td width=20%>" . _ADMIN_SCHEDULE_TEACH_1_SCHOOL . "</td>
	<td width=15%>" . _ADMIN_SCHEDULE_TEACH_1_TERM . "</td>
	<td width=10%>" . _ADMIN_SCHEDULE_TEACH_1_DAYS . "</td>
	<td width=10%>" . _ADMIN_SCHEDULE_TEACH_1_PERIOD . "</td>
	<td width=15%>" . _ADMIN_SCHEDULE_TEACH_1_SUBJECT . "</td>
	<td width=10%>" . _ADMIN_SCHEDULE_TEACH_1_ROOM . "</td>
	<td width=10%>&nbsp;</td>
	<td width=10%>&nbsp;</td>
	</tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr>
	<td class=paging width=25% align=center>COL1</td>
	<td class=paging width=15% align=center>COL2</td>
	<td class=paging width=10% align=center>COL3</td>
	<td class=paging width=10% align=center>COL4</td>
	<td class=paging width=20% align=center>COL5</td>
	<td class=paging width=10% align=center>COL6</td>
	<td class=paging width=10% align=center><a href=admin_schedule_teach_2.php?teacherid=$teacherid&schedid=COL7 
	  class=aform>&nbsp;" . _ADMIN_SCHEDULE_TEACH_1_DETAILS . "</a></td>
	<td class=paging width=15% align=center>
	<a name=href_remove href=#  onclick=cnfremove(COL7,COL8); class=aform>&nbsp;" . _ADMIN_SCHEDULE_TEACH_1_REMOVE. "</a></td>
	</tr>";
	$ezr->query_mysql($sSQL);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<SCRIPT language=JavaScript>
/* Javascript function to ask confirmation before removing record */
function cnfremove() {
        var answer;
	answer = window.confirm("<?php echo _ADMIN_ROOMS_SURE?>");
	if (answer == 1) {
		var url;
		id = arguments[0];
		teach = arguments[1];
		url = "admin_schedule_teach_1?action=remove&schedid=" + id;
		url = url + "&teacherid=";
		url = url + teach;
		window.location = url; // other browsers
		href_remove.href = url; // explorer
	}
	return false;
	}
</SCRIPT>

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_SCHEDULE_TEACH_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _ADMIN_SCHEDULE_TEACH_1_TITLE?></h1>
	<br>
	<h2><?php echo $tfname. " " .$tlname; ?></h2>
	<br>
	<?php
	$ezr->display();
	?>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a 
href="admin_add_edit_teacher_1.php?teacherid=<? 
echo $teacherid; ?>&action=edit" class="aform"><?php echo _ADMIN_SCHEDULE_TEACH_1_BACK?></a></td>
	    <td width="50%" align="right"><a 
href="admin_schedule_teach_3.php?teacherid=<?php echo $teacherid; 
?>&action=new" class="aform"><?php echo _ADMIN_SCHEDULE_TEACH_1_ADD?></a></td>
	  </tr>
	</table>
	<?php
	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<?php
	};
	?>

<br><br>

<!--
statistics: for each day and period, get the subject and room for the teacher
-->

<?php
if ($terms) {
foreach ($terms as $term) {

// get schedule data
$sSQL="SELECT school_names_desc, grade_terms_desc, 
teacher_schedule_days, teacher_schedule_classperiod, 
grade_subject_desc, days_id, school_rooms_desc, days_desc 
FROM (((((teacher_schedule 
INNER JOIN grade_terms ON teacher_schedule.teacher_schedule_termid=grade_terms.grade_terms_id) 
INNER JOIN grade_subjects ON teacher_schedule.teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
INNER JOIN school_names ON school_names.school_names_id=teacher_schedule.teacher_schedule_schoolid) 
INNER JOIN tbl_days ON tbl_days.days_id=teacher_schedule.teacher_schedule_days) 
INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
WHERE teacher_schedule_teacherid=$teacherid AND 
      school_names.school_names_id=$tschool AND 
      teacher_schedule_termid=$term->teacher_schedule_termid 
ORDER BY school_names_desc, grade_terms_desc, days_id, teacher_schedule_classperiod, grade_subjects.grade_subject_desc";
$test = $db->get_results($sSQL);
if ($test) {
$term_desc = $db->get_row("SELECT grade_terms_desc FROM grade_terms WHERE 
grade_terms_id=$term->teacher_schedule_termid");
?>

<table width=100% cellpadding=2 cellspacing=0 border=1>
<tr class=tblhead><td colspan=6 align=center><?php echo $term_desc->grade_terms_desc?></td></tr>
<tr class=tblhead>
<td width=10% align=center>&nbsp;</td>
<?php
$weekdays = $db->get_results("SELECT * FROM tbl_days ORDER BY days_id");
if(is_array($weekdays)) {
  foreach($weekdays as $day) {
    echo '<td width=15% align=center>' . $day->days_desc . '</td>';
  }
}
else echo '<td width=15% align=center>Error in table tbl_days</td>';
?>
</tr>

<?php
$max_period = $db->get_var("SELECT MAX(teacher_schedule_classperiod) FROM teacher_schedule WHERE 
teacher_schedule_teacherid='$teacherid'");

for ($i=1; $i<=$max_period; $i++) {     // change 10 number of periods a day
  echo '<tr><td align=center class=tblhead width=10%>' . $i . '</td>';
  for ($j=1; $j<=5; $j++) {     // 5 = number of schooldays

// get schedule data
$sSQL="SELECT 
teacher_schedule_days, teacher_schedule_classperiod, grade_subject_desc, days_id, school_rooms_desc, days_desc 
FROM (((((teacher_schedule 
INNER JOIN grade_terms ON teacher_schedule.teacher_schedule_termid=grade_terms.grade_terms_id) 
INNER JOIN grade_subjects ON teacher_schedule.teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
INNER JOIN school_names ON school_names.school_names_id=teacher_schedule.teacher_schedule_schoolid) 
INNER JOIN tbl_days ON tbl_days.days_id=teacher_schedule.teacher_schedule_days) 
INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
WHERE teacher_schedule_teacherid=$teacherid AND 
      school_names.school_names_id=$tschool AND 
      teacher_schedule_termid=$term->teacher_schedule_termid AND 
      teacher_schedule_classperiod='$i' AND 
      days_id='$j' 
ORDER BY days_id, teacher_schedule_classperiod, grade_subject_desc";

if ($srch = $db->get_row($sSQL)) {
$subject = $srch->grade_subject_desc;
$room = $srch->school_rooms_desc;

//Set paging appearence
echo '<td class=paging width=15% align=center>' . $subject . " " . $room . '</td>' . "\n";
}
else {
echo '<td calss=pagin width=15% align=center>&nbsp;</td>';
}

}       // for j
echo "</tr>\n";
}       // for i
echo '</table>';
echo '<br/><br/>';
}       // if
}       // foreach
}	// if
?>




</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
