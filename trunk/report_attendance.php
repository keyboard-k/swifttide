<?php
//v1.52 sort by last name on all reports
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
{
	header ("Location: index.php?action=notauth");
	exit;
}

//set up database connection
include_once"ez_sql.php";
include_once"common.php";
// Include configuration
include_once "configuration.php";

$sorted_1 = get_param("sorted_1");
$sorted_2 = get_param("sorted_2");
$start_db_date = get_param("start_date");
$end_db_date = get_param("end_date");

//make sure we have all the post variables no matter what settings apache has
// if(!$sorted_1) $sorted_1 = $GET['sorted_1'];
// if(!$sorted_2) $sorted_2 = $GET['sorted_2'];
// if(!$start_date) $start_date = $GET['start_date'];
// if(!$end_date) $end_date = $GET['end_date'];

if($start_db_date) $start_db_date = fix_date($start_db_date);
if($end_db_date) $end_db_date = fix_date($end_db_date);

$q = "SELECT * FROM attendance_history, attendance_codes, studentbio, 
	student_grade_year, school_names, ethnicity, grades, school_rooms, school_years 
	WHERE (attendance_history.attendance_history_student = studentbio.studentbio_id) 
	AND (attendance_history.attendance_history_code = attendance_codes.attendance_codes_id) 
	AND (studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
	AND (studentbio.studentbio_school = school_names.school_names_id) 
	AND (studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
	AND (grades.grades_id = student_grade_year.student_grade_year_grade) 
	AND (school_years.school_years_id = attendance_history.attendance_history_year)
	AND (studentbio.studentbio_homeroom = school_rooms.school_rooms_id) ";

if ($start_db_date != "") { $q .= "AND (attendance_history.attendance_history_date = '$start_db_date')"; }

$q .= " ORDER BY $sorted_1";
if($sorted_2 == $sorted_1) $sorted_2 = 'none';
if($sorted_2 != 'none') $q .= ", $sorted_2";

if($sorted_1 == "grades_id") $display_1 = 'grades_desc';
else if($sorted_1 == "studentbio_ethnicity") $display_1 = 'ethnicity_desc';
else if($sorted_1 == "studentbio_homeroom") $display_1 = 'school_rooms_desc';
else $display_1 = $sorted_1;

if($sorted_2 == "grades_id") $display_2 = 'grades_desc';
else if($sorted_2 == "studentbio_ethnicity") $display_2 = 'ethnicity_desc';
else if($sorted_2 == "studentbio_homeroom") $display_2 = 'school_rooms_desc';
else $display_2 = $sorted_2;

$q .= " , studentbio_lname ASC";
$r = $db->get_results($q);

?>
<html><title><? echo _REPORT_ATTENDANCE_BROWSER_TITLE?></title>
<head>
<style type="text/css" media="all">@import "student-admin.css";</style>
</head>
<body>
<?
if(is_array($r)) {
	echo"<table align='center' width='80%' cellpadding=5><th align='center'><h1>" . _REPORT_ATTENDANCE_TITLE . "$start_db_date</h1></th>";
	$ps1 = "";
	$ps2 = "";
	foreach($r as $s) {
	
		$cs1 = $s->{$sorted_1};
		if($cs1 != $ps1) {
			$cd1 = $s->{$display_1};
			$heading_text_1 = "";
			if($display_1 == 'studentbio_bus') $heading_text_1 = _REPORT_ATTENDANCE_ROUTE;
			else if($display_1 == 'studentbio_homeroom') $heading_text_1 = _REPORT_ATTENDANCE_HOME;

			echo"<tr><td align='left'><h1>$heading_text_1 $cd1</h1></td></tr>";
		}
	
		if($sorted_2 != 'none') {
			$cs2 = $s->{$sorted_2};
			if($cs2 != $ps2) {
				$cd2 = $s->{$display_2};
				$heading_text_2 = "";
				if($display_2 == 'studentbio_bus') $heading_text_2 = _REPORT_ATTENDANCE_ROUTE;
				else if($display_2 == 'studentbio_homeroom') $heading_text_2 = _REPORT_ATTENDANCE_HOME;
				echo"<tr><td align='right'><h2>$heading_text_2 $cd2</h2></td></tr>";	
			}
		}
	
		//display the students name
		echo"<tr><td align='center'><table border=1 width='100%'>
			<tr><td><table width='100%'><tr><td><table width='100%'><tr><td class='record_heading'>
			$s->attendance_codes_desc for $s->studentbio_fname $s->studentbio_lname</td>";
		
		//display the students gender
		if($sorted_1 != 'studentbio_gender' && $sorted_2 != 'studentbio_gender') 
			echo"<td class='gender' align='right'>($s->studentbio_gender)</td>";
		echo"</tr></table></td></tr>";

		//display notes
		if($s->attendance_history_notes && $s->attendance_history_notes != '')
			echo"<tr><td><table width='100%'><tr><td class='tblhead' width='10%'>" . _REPORT_ATTENDANCE_NOTES . ": </td>
				<td class='tblcont' width='90%' align='left'>$s->attendance_history_notes</td></tr></table></td></tr>";
		//the static column headers
		echo"<tr><td><table border=1 width='100%'><tr class='tblhead'><td>" . _REPORT_ATTENDANCE_INTERNAL . "</td><td>" . _REPORT_ATTENDANCE_DOB . "</td><td>" . _REPORT_ATTENDANCE_SCHOOL . "</td>";
		//the dynamic column headers
		if($sorted_1 != 'grades_id' && $sorted_2 != 'grades_id') 
			echo"<td>" . _REPORT_ATTENDANCE_GRADE . "</td>";
		if($sorted_1 != 'studentbio_ethnicity' && $sorted_2 != 'studentbio_ethnicity')
			echo"<td>" . _REPORT_ATTENDANCE_ETHNICITY . "</td>";
		if($sorted_1 != 'studentbio_homeroom' && $sorted_2 != 'studentbio_homeroom')
			echo"<td>" . _REPORT_ATTENDANCE_HOME . "</td>";
		if($sorted_1 != 'studentbio_bus' && $sorted_2 != 'studentbio_bus')
			echo"<td>" . _REPORT_ATTENDANCE_ROUTE . "</td>";

		echo"</tr><tr class='tblcont'>
			<td>$s->studentbio_internalid</td><td>$s->studentbio_dob</td>
			<td>$s->school_names_desc</td>";
		if($sorted_1 != 'grades_id' && $sorted_2 != 'grades_id') 
			echo"<td>$s->grades_desc</td>";
		if($sorted_1 != 'studentbio_ethnicity' && $sorted_2 != 'studentbio_ethnicity')
			echo"<td>$s->ethnicity_desc</td>";
		if($sorted_1 != 'studentbio_homeroom' && $sorted_2 != 'studentbio_homeroom')
			echo"<td>$s->school_rooms_desc</td>";
		if($sorted_1 != 'studentbio_bus' && $sorted_2 != 'studentbio_bus')
			echo"<td>$s->studentbio_bus</td>";

		echo"</tr></table></td></tr></table></td></tr></table></td></tr>";
		if ($sorted_2 != "none") { $ps2 = $s->{$sorted_2}; }
		$ps1 = $s->{$sorted_1};
	}	
		
	?></table></body></html><?
} else {
	echo"<center><h1>" . _REPORT_ATTENDANCE_NONE . "</h2></center>";
}
?>
