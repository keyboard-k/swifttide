<?
//*
// nurse_info_3.php
// Health Section
// Display and Manage Student Health Summary
//*
//pq - 2007-02-22 - Why is there multiple nurse menus?  Commented some out.

//Check if admin or nurse is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A" && $_SESSION['UserType'] != "N")
  {
    header ("Location: index.php?action=notauth");
	exit;
}


//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
include_once "ez_results.php";
// Include configuration
include_once "configuration.php";

//Gather student id
$studentid=get_param("studentid");

//Set variable for menu
$menustudent=1;

//Get all info to display
//Student
$sSQL="SELECT studentbio.*, DATE_FORMAT(studentbio.studentbio_dob, '%m/%d/%Y') as sdob, 
ethnicity.ethnicity_desc, school_names.school_names_desc, generations.generations_desc, 
grades.grades_desc, teachers.teachers_fname, teachers.teachers_lname, school_rooms_desc 
FROM (((((((studentbio 
INNER JOIN generations ON studentbio.studentbio_generation = generations.generations_id) 
INNER JOIN ethnicity ON studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id) 
INNER JOIN teachers ON studentbio.studentbio_teacher = teachers.teachers_id) 
INNER JOIN school_rooms ON school_rooms_id = studentbio_homeroom) 
WHERE studentbio.studentbio_id=$studentid";

$studentinfo=$db->get_row($sSQL);
$primarycontact=$studentinfo->studentbio_primarycontact;
//Primary Contact
$sSQL="SELECT studentcontact.*, contact_to_students.contact_to_students_internet, 
contact_to_students.contact_to_students_id, contact_to_students.contact_to_students_relation, 
relations_codes.relation_codes_desc, contact_to_students.contact_to_students_residence, tbl_states.state_name 
FROM (((studentcontact 
INNER JOIN contact_to_students ON studentcontact.studentcontact_id =  contact_to_students.contact_to_students_contact) 
INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id) 
INNER JOIN tbl_states ON studentcontact_state = state_code) 
WHERE studentcontact.studentcontact_id=$primarycontact AND 
contact_to_students.contact_to_students_student=$studentid";
$primcontinfo=$db->get_row($sSQL);

//doug fix so titles are stored and displayed properly
$sSQL="SELECT title_desc FROM tbl_titles WHERE 
title_id='$primcontinfo->studentcontact_title'";
$studentcontact_title=$db->get_var($sSQL);
//end of fix

//get the custom fields for this student by Joshua
$scfSQL = "SELECT * FROM custom_studentbio, custom_fields 
 	WHERE (custom_fields.custom_field_id = custom_studentbio.custom_field_id) 
  	AND (studentbio_id = '$studentid')";
$student_custom_fields = $db->get_results($scfSQL);

//get the entry action history for this student by Joshua
$entries_sql = "SELECT * from entry_actions, school_names, school_years, tbl_config
	WHERE (entry_actions.school_id = school_names.school_names_id)
	AND (entry_actions.school_year_id = school_years.school_years_id)
	AND (entry_actions.student_id = '$studentid') ";
$entries = $db->get_results($entries_sql);

//Additional Contacts
$sSQL="SELECT contact_to_students_contact FROM contact_to_students WHERE contact_to_students_contact<>$primarycontact AND contact_to_students_student=$studentid";
if($addcont=$db->get_results($sSQL)){
	$ac=1;
	$i=-1;
	foreach($addcont as $mlist){
		$i=$i+1;
		$list[$i]=$mlist->contact_to_students_contact;
	}
	$ylist=implode(",", $list);
	$sSQL="SELECT studentcontact.studentcontact_id, studentcontact.studentcontact_fname, studentcontact.studentcontact_lname, contact_to_students.contact_to_students_relation, contact_to_students.contact_to_students_residence, relations_codes.relation_codes_desc FROM (studentcontact INNER JOIN contact_to_students ON studentcontact.studentcontact_id = contact_to_students.contact_to_students_contact) INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id WHERE studentcontact.studentcontact_id IN ($ylist) AND contact_to_students_student=$studentid";
	$addcontlist=$db->get_results($sSQL);	
}else{
	$ac=0;
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _NURSE_INFO_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _NURSE_INFO_3_TITLE?></h1>
	<br>
	<h2><? echo $studentinfo->studentbio_fname . " " . $studentinfo->studentbio_mi . " " . $studentinfo->studentbio_lname . " " .  $studentinfo->generations_desc . " (" . $studentinfo->studentbio_gender . ")"; ?></h2>	
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _NURSE_INFO_3_DOB?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_SCHOOL?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_GRADE?></td>
		  </tr>
		  <tr class="tblcont">
			<td width="34%">&nbsp;<? echo $studentinfo->sdob; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->school_names_desc; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->grades_desc; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _NURSE_INFO_3_HOME?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_TEACHER?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_ROUTE?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->school_rooms_desc; ?></td>
		    <td width="33%">&nbsp;<? if($studentinfo->teachers_fname=="Select"){echo "";}else{echo $studentinfo->teachers_fname." ".$studentinfo->teachers_lname;}; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_bus; ?></td>
		  </tr>
		  <tr>
		  </tr></table> 
		<p><h2><? echo _NURSE_INFO_3_PRIMARY?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $studentcontact_title . " " . $primcontinfo->studentcontact_fname . " " .$primcontinfo->studentcontact_lname . " (" . $primcontinfo->relation_codes_desc . ")" ;?>
			<? if ($primcontinfo->contact_to_students_residence==1){echo " <font color=#FF0000><b>" . _NURSE_INFO_3_RESIDENCE . "</b></font>";}; ?>
			</td>
		  </tr>
		  <tr class="tblhead">
		    <td width="100%" colspan="3">&nbsp;<? echo _NURSE_INFO_3_ADDRESS?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $primcontinfo->studentcontact_address1 . " " . $primcontinfo->studentcontact_address2 ;?> </td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _NURSE_INFO_3_CITY?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_STATE?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_ZIP?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $primcontinfo->studentcontact_city ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->state_name ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_zip ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _NURSE_INFO_3_PHONE1?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_PHONE2?></td>
		    <td width="33%">&nbsp;<? echo _NURSE_INFO_3_PHONE3?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $primcontinfo->studentcontact_phone1 ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_phone2 ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_phone3 ; ?></td>
		  </tr>
	</table>
</div>
<? include "health_menu.inc.php"; ?>
</body>

</html>

<?

//so now let's try to get the medication info

$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserID'];

$studentid=get_param("studentid");
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get health_medicine history
	$sSQL="SELECT health_med_history.health_med_history_id, DATE_FORMAT(health_med_history.health_med_history_date, '%m/%d/%Y') as disdate, health_medicine.health_medicine_desc FROM health_med_history INNER JOIN health_medicine ON health_med_history.health_med_history_code = health_medicine.health_medicine_id WHERE health_med_history_student=$studentid AND health_med_history_year=$current_year";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td
width=40% align=center>" . _NURSE_INFO_3_DATE . "</td><td width=40% align=center>" . _NURSE_INFO_3_MEDICATION . "</td><td
width=20% align=center>" . _NURSE_INFO_3_DETAILS . "</td></tr>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40% align=center>COL2</td><td
class=paging width=40% align=center>COL3</td><td class=paging width=20% align=center><a href=health_med_student_2.php?studentid=$studentid&disid=COL1 class=aform>&nbsp;" . _NURSE_INFO_3_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<div id="Content">
	<h2><? echo _NURSE_INFO_3_MED_INFO?></h2>
	<?
	$ezr->display();
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
	</table>
</div>
<? //include "health_menu.inc.php"; ?>
</body>

</html>

<?
//ok, that worked, so let's get the allergy info

$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserID'];
$studentid=get_param("studentid");
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get allergy history
$sSQL="SELECT health_allergy_history.health_allergy_history_id, DATE_FORMAT(health_allergy_history.health_allergy_history_date, '%m/%d/%Y') as disdate, health_allergy.health_allergy_desc FROM health_allergy_history INNER JOIN health_allergy ON health_allergy_history.health_allergy_history_code = health_allergy.health_allergy_id WHERE health_allergy_history.health_allergy_history_student= $studentid AND health_allergy_history.health_allergy_history_year=$current_year ORDER BY health_allergy_history.health_allergy_history_date DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td width=40% align=center>" . _NURSE_INFO_3_DATE . "</td><td width=40% align=center>" . _NURSE_INFO_3_ALLERGY . "</td><td width=20% align=center>" . _NURSE_INFO_3_DETAILS . "</td></tr>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40% align=center>COL2</td><td 
class=paging width=40% align=center>COL3</td><td class=paging width=20%
align=center><a 
href=health_allergy_2.php?studentid=$studentid&disid=COL1
class=aform>&nbsp;" . _NURSE_INFO_3_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>

<div id="Content">
	<h2><? echo _NURSE_INFO_3_ALL_INFO?></h2>
	<?
	$ezr->display();
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
	  <tr>
	  </tr>
	</table>
</div>
<? //include "health_menu.inc.php"; ?>
</body>

</html>

<?
//looking sweet as well... now let's grab immunization info

$menustudent=1;
$current_year=$_SESSION['CurrentYear'];

//Get student id
$studentid=get_param("studentid");
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get immunization history
	$sSQL="SELECT health_immunz_history.health_immunz_history_id, DATE_FORMAT(health_immunz_history.health_immunz_history_date, '%m/%d/%Y') as disdate , health_immunz.health_immunz_desc FROM health_immunz_history INNER JOIN health_immunz ON health_immunz_history.health_immunz_history_code = health_immunz.health_immunz_id WHERE health_immunz_history.health_immunz_history_student=$studentid AND health_immunz_history.health_immunz_history_year=$current_year ORDER BY health_immunz_history.health_immunz_history_date DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td width=40% align=center>" . _NURSE_INFO_3_DATE . "</td><td width=40% align=center>" . _NURSE_INFO_3_IMM . "</td><td width=20% align=center>" . _NURSE_INFO_3_DETAILS . "</td></tr>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40% align=center>COL2</td><td
class=paging width=40% align=center>COL3</td><td class=paging width=20% 
align=center><a
href=health_immunz_2.php?studentid=$studentid&disid=COL1 
class=aform>&nbsp;" . _NURSE_INFO_3_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<body>

<div id="Content">
	<h2><? echo _NURSE_INFO_3_IMM_INFO?></h2>
	<?
	$ezr->display();
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
	</table>
</div>
</body></html>

<?
//all fine and dandy, but now let's add the 10 most recent office visits

$studentid=get_param("studentid");
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get health_visit history
	$sSQL="SELECT health_history.health_history_id, DATE_FORMAT(health_history.health_history_date, '%m/%d/%Y') as disdate, health_codes.health_codes_desc FROM health_history INNER JOIN health_codes ON  health_history.health_history_code = health_codes.health_codes_id WHERE health_history.health_history_student=$studentid AND health_history.health_history_year=$current_year ORDER BY health_history.health_history_date DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=70% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead><td width=40% align=center>" . _NURSE_INFO_3_DATE . "</td><td width=40% align=center>" . _NURSE_INFO_3_HEALTH . "</td><td width=20% align=center>" . _NURSE_INFO_3_DETAILS . "</td></tr>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=40% align=center>COL2</td><td
class=paging width=40% align=center>COL3</td><td class=paging width=20%
align=center><a href=health_manage_2.php?studentid=$studentid&disid=COL1
class=aform>&nbsp;" . _NURSE_INFO_3_DETAILS . "</a></td></tr>";
	$ezr->query_mysql($sSQL);
	$ezr->set_qs_val("studentid",$studentid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<div id="Content">
	<h2><? echo _NURSE_INFO_3_HEALTH_INFO?></h2>
	<?
	$ezr->display();
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="70%">
	</table>
</div>
<? if($_SESSION['UserType'] == "A") {
        include "admin_menu.inc.php";
        } else {
	include "health_menu.inc.php";
}; ?>
</body>

</html>

