<?
//*
// teacher_set_student_year.php
// Teachers Section
// Change Current year for selected operations on students
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration - not neccessary at the moment
include_once "configuration.php";

$yearid=get_param("yearid");
set_session("CurrentYear", $yearid);
$year_name=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$yearid");
set_session("YearName", $year_name);
header("Location: teachers_menu.php");
exit();
?>
