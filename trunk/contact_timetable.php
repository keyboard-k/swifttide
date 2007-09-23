<?php
//*
// contact_timetable.php
// Contacts Section
// Display timetable for student
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
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

//Get current year
$cyear=$_SESSION['CurrentYear'];

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$current_year=$_SESSION['CurrentYear'];

// $schoolid=$_SESSION['tschool'];

$sSQL="SELECT DISTINCT teacher_schedule_termid FROM teacher_schedule ORDER BY teacher_schedule_termid";
$terms = $db->get_results($sSQL);

//Get student id
$studentid=$_SESSION['StudentId'];
if(!strlen($studentid)){
	$msgFormErr=_CONTACT_TIMETABLE_FORM_ERROR . "<br>";
}else{
	//Get Student Name and Homeroom!
	$sSQL="SELECT studentbio_lname, studentbio_fname, studentbio_homeroom FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sroom=$student->studentbio_homeroom;
}

// get schedule data
$sSQL="SELECT school_names_desc, grade_terms_desc, 
teacher_schedule_days, teacher_schedule_classperiod, 
grade_subject_desc, days_id, school_rooms_desc, days_desc, teacher_schedule_teacherid 
FROM (((((teacher_schedule 
INNER JOIN grade_terms ON teacher_schedule.teacher_schedule_termid=grade_terms.grade_terms_id) 
INNER JOIN grade_subjects ON teacher_schedule.teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
INNER JOIN school_names ON school_names.school_names_id=teacher_schedule.teacher_schedule_schoolid) 
INNER JOIN tbl_days ON tbl_days.days_id=teacher_schedule.teacher_schedule_days) 
INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
WHERE teacher_schedule_room=$sroom 
ORDER BY school_names_desc, grade_terms_desc, days_id, teacher_schedule_classperiod, grade_subject_desc";

if ($srch = $db->get_results($sSQL)){
//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_heading = "<tr class=tblhead>
<td width=20% align=center>" . _TEACHER_TIMETABLE_SCHOOL . "</td>
<td width=20% align=center>" . _TEACHER_TIMETABLE_TERM . "</td>
<td width=20% align=center>" . _TEACHER_TIMETABLE_DAYS . "</td>
<td width=10% align=center>" . _TEACHER_TIMETABLE_PERIOD . "</td>
<td width=20% align=center>" . _TEACHER_TIMETABLE_SUBJECT . "</td>
<td width=10% align=center>" . _TEACHER_TIMETABLE_ROOM . "</td>
</tr>";

$ezr->results_row = "<tr>
<td class=paging width=20% align=center>COL1</td>
<td class=paging width=20% align=center>COL2</td>
<td class=paging width=20% align=center>COL8</td>
<td class=paging width=10% align=center>COL4</td>
<td class=paging width=20% align=center>COL5</td>
<td class=paging width=10% align=center>COL7</td>
</tr>";
$ezr->results_close = "</table>";
$ezr->query_mysql($sSQL);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"></link><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>

	<h1><?php echo _CONTACT_TIMETABLE_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname; ?></h2>
	<br>


        <p><?php $ezr->display();?></p>
	<p>&nbsp;</p>


	<!--
	statistics: for each day and period, get the subject and room for the teacher
	-->

	<?php
	foreach ($terms as $term) {

	$sSQL="SELECT 
	teacher_schedule_days, teacher_schedule_classperiod, grade_subject_desc, days_id, school_rooms_desc, days_desc, teacher_schedule_teacherid 
	FROM (((((teacher_schedule 
	INNER JOIN grade_terms ON teacher_schedule.teacher_schedule_termid=grade_terms.grade_terms_id) 
	INNER JOIN grade_subjects ON teacher_schedule.teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
	INNER JOIN school_names ON school_names.school_names_id=teacher_schedule.teacher_schedule_schoolid) 
	INNER JOIN tbl_days ON tbl_days.days_id=teacher_schedule.teacher_schedule_days) 
	INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
	WHERE teacher_schedule_room='$sroom' AND 
	      teacher_schedule_termid=$term->teacher_schedule_termid 
	ORDER BY days_id, teacher_schedule_classperiod, grade_subject_desc";
	$test = $db->get_results($sSQL);
	if ($test) {
	$term_desc = $db->get_row("SELECT grade_terms_desc FROM grade_terms WHERE grade_terms_id=$term->teacher_schedule_termid");
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
	$max_period = $db->get_var("SELECT MAX(teacher_schedule_classperiod) FROM teacher_schedule WHERE teacher_schedule_room='$sroom'");

	for ($i=1; $i<=$max_period; $i++) {     // change 10 number of periods a day
	  echo '<tr><td align=center class=tblhead width=10%>' . $i . '</td>';
	  for ($j=1; $j<=5; $j++) {       // 5 = number of schooldays

	 // get schedule data
	  $sSQL="SELECT 
	  teacher_schedule_days, teacher_schedule_classperiod, grade_subject_desc, days_id, school_rooms_desc, days_desc, teacher_schedule_teacherid 
	  FROM (((((teacher_schedule 
	  INNER JOIN grade_terms ON teacher_schedule.teacher_schedule_termid=grade_terms.grade_terms_id) 
	  INNER JOIN grade_subjects ON teacher_schedule.teacher_schedule_subjectid=grade_subjects.grade_subject_id) 
	  INNER JOIN school_names ON school_names.school_names_id=teacher_schedule.teacher_schedule_schoolid) 
	  INNER JOIN tbl_days ON tbl_days.days_id=teacher_schedule.teacher_schedule_days) 
	  INNER JOIN school_rooms ON school_rooms_id=teacher_schedule_room) 
	  WHERE teacher_schedule_classperiod=$i AND 
		days_id=$j AND 
		teacher_schedule_room=$sroom AND 
		teacher_schedule_termid=$term->teacher_schedule_termid 
	  ORDER BY days_id, teacher_schedule_classperiod, grade_subject_desc";

	if ($srch = $db->get_row($sSQL)) {
		$subject = $srch->grade_subject_desc;
		$teacher = $srch->teacher_schedule_teacherid;
		$teach = $db->get_row("SELECT teachers_fname, teachers_lname FROM teachers WHERE teachers_id=$teacher");
		$tfname = $teach->teachers_fname;
		$tlname = $teach->teachers_lname;


//Set paging appearence
echo "<td class=paging width=15% align=center>" . $subject . "<br>(" . $tfname . " " . $tlname . ")</td>" . "\n";
}
else {
echo '<td class=paging width=15% align=center>&nbsp;</td>';
}

}     // for j
echo "</tr>\n";
}     // for i
echo '</table>';
echo '<br/><br/>';
}	// if
}	// foreach

	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<?php
	};
	?>
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
