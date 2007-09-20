<?php
//*
// admin_conf_change_year.php
// Admin Section
// Proceed to Change Current year to next one and switch students grades
//v1.5 12-4-05 preserves all current year data.  Will not create a new year if it already exists
//v1.5.1 12-10-05 write primary field to studentcontact table
//v1.5.2 12-11-05 field change for primary contact
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
//Initiate special database functions
include_once "true_mysql.php";
//Use common ez_sql stuff too
include_once "ez_sql.php";
// config
include_once "configuration.php";

//Set the Message Form Error to Null
$msgFormErr="";

$current_year=$_SESSION['CurrentYear'];
$next_year=($current_year+1);
//echo $next_year;

//Is the new year already created??  then don't create it, it will be a mess if we do!
$tot = $db->get_var("SELECT count(*) FROM student_grade_year WHERE 
student_grade_year_year=$next_year");
//if the new year already exists, error out of script.

	if ($tot>0) {
		$msgFormErr.=_ADMIN_CONF_CHANGE_YEAR_FORM_ERROR . "<br>";
	  $url="admin_change_year_error.php";
	  header("Location: $url");
	  exit();
	};

	//ok, so now it gets ugly. use the true_mysql stuff to copy all the
	//data to new rows and preserve it.

//Create the new school year and preserve all the old data.

//*
//First, let's update the contact_to_students table

$isql="INSERT INTO contact_to_students (contact_to_students_contact, 
contact_to_students_student, contact_to_students_internet, 
contact_to_students_relation, contact_to_students_residence, 
contact_to_students_year) SELECT contact_to_students_contact, contact_to_students_student, 
contact_to_students_internet, contact_to_students_relation, 
contact_to_students_residence, $next_year AS contact_to_students_year FROM 
contact_to_students WHERE contact_to_students_year = $current_year";

mysql_query($isql) or die(mysql_error());

//*
//Now let's update the studentcontact table

$sSQL="INSERT INTO studentcontact (studentcontact_studentid,
studentcontact_title, studentcontact_fname, studentcontact_lname,
studentcontact_address1, studentcontact_address2, studentcontact_city,
studentcontact_state, studentcontact_zip, studentcontact_phone1,
studentcontact_phone2, studentcontact_phone3, studentcontact_email,
studentcontact_other, studentcontact_mailings, studentcontact_year) SELECT 
studentcontact_studentid,
studentcontact_title, studentcontact_fname, studentcontact_lname,
studentcontact_address1, studentcontact_address2, studentcontact_city,
studentcontact_state, studentcontact_zip, studentcontact_phone1,
studentcontact_phone2, studentcontact_phone3, studentcontact_email,
studentcontact_other, studentcontact_mailings, $next_year AS 
studentcontact_year FROM studentcontact WHERE 
studentcontact_year = $current_year";

mysql_query($sSQL) or die(mysql_error());

//Now we need to "refresh" the contact_to_students table, since new IDs are in the 
//studentcontact table (an automnumber field)
//$sSQL="UPDATE contact_to_students, studentcontact SET contact_to_students_contact=studentcontact.studentcontact_id WHERE contact_to_students.contact_to_students_student= studentcontact.studentcontact_studentid AND contact_to_students_year=$next_year";

//mysql_query($sSQL) or die(mysql_error());

//Now, the student_grade_year table needs to be updated

$sSQL="INSERT INTO student_grade_year (student_grade_year_student, student_grade_year_year, student_grade_year_grade) SELECT 
student_grade_year_student, $next_year AS 
student_grade_year_year, student_grade_year_grade+1 AS student_grade_year_grade 
FROM student_grade_year WHERE student_grade_year_year = $current_year";

mysql_query($sSQL) or die(mysql_error());

//Now all 3 tables should be updated with the new school year data.

$db->query("UPDATE tbl_config SET current_year=$next_year WHERE id=1");
set_session("CurrentYear", $next_year);
header ("Location: admin_change_year_success.php");
exit();
?>
